<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Http\Request;
use App\Code;
use App\KinderRequest;
use App\Rules\Phone;
use App\Rules\Password;
use Validator;
use Session;



class RegisterController extends BaseController
{
     use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $rules=[
        'name' => "nullable|max:191",
        'contact_name' => "nullable|max:191",
        'password' => "",
        'zipcode' => "required|numeric|digits:7",
        'prefecture' => "required",
        'city' => 'required|max:191',
        'street_address' => 'required|max:191',
        'building' => 'nullable|max:191',
        'phone' => "required",
        'email' => "",
    ];

    private $messages=[
        'name.required' => '「幼稚園・保育園名称」の入力が必須です。',
        'name.max' => '「幼稚園・保育園名称」は191文字以内で入力してください。',

        'contact_name.required' => '「ご担当者様氏名」の入力が必須です。',
        'contact_name.max' => '「ご担当者様氏名」は191文字以内で入力してください。',
        
        'password.different' => 'ご登録されるメールアドレスをパスワードにすることはできません',
        'password.required' => '「パスワード」は必須項目です。',
        'password.min' => '「パスワード」は6文字以上で入力してください。',
        'password.max' =>'「パスワード」は64文字以内で入力してください。',
        'password_confirm.required' =>'「パスワード確認」は必須項目です。',
        'password_confirm.same' =>'入力された2つの「パスワード」が一致していません。',

        'confirm_password.required' =>'「パスワード確認」は必須項目です。',
        'confirm_password.same' =>'入力された2つの「パスワード」が一致していません。',
        
        'email.required' =>'「メールアドレス」の入力が必須です。',
        'email.unique' => '入力された「メールアドレス」は既に登録されています。',
        'email.email' =>'有効な「メールアドレス」を入力してください。',
        
        'zipcode.required'=> '「郵便番号」の入力が必須です。',
        'zipcode.numeric'=> '「郵便番号」は数字のみで入力してください。',
        'zipcode.digits'=> '「郵便番号」は7桁の数字で入力してください。',
        'prefecture.required'=>'「都道府県」の選択が必須です。',
        'city.required'=>'「市区町村」の入力が必須です。',
        'city.max'=>'「市区町村」は191文字以内で入力してください。',
        
        'street_address.required' => '「住所」の入力が必須です。',
        'street_address.max' => '「住所」は191文字以内で入力してください。',

        'building.max' => '「建物名等」は191文字以内で入力してください。',
        
        'phone.required' => '「電話番号」の入力が必須です。',
        'phone.max' => '「電話番号」は20文字以内で入力してください。',
        'phone.regex' => '「電話番号」は数字と(-)のみで入力してください。',
    ];

    public $attributes = [
        'fax' => 'FAX番号',
        'phone'=> '電話番号'
    ];

    public function __construct()
    {
        $this->middleware('guest');
        $this->rules['phone'] = ['required',new Phone];
    }


    public function showEmailForm()
    {
       return view('register.email_form');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveEmail(Request $request)
    {

        //Validation

        $this->validate($request,[
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|unique:mealmm_user_request'
        ],$this->messages);
        
        //Generate Code 
        $str_code = Code::generateRandomCode(8);
        $first_name = strip_tags(trim($request->first_name));
        $last_name = strip_tags(trim($request->last_name));
        $email = strip_tags(trim($request->email));

        //Perpare data
        $data =[
            "email" =>$email,
            "code" => hash('md5',$str_code),
        ];

        //Store Data
         $code = Code::firstOrCreate(["email" => $email],[
            "code" => hash("md5",$str_code),
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email
         ]);

         $code->update([
            "code" => hash("md5",$str_code),
            "first_name" => $first_name,
            "last_name" => $last_name
         ]);

         //Email to user 
         Code::kinder_registration_confirm($email,$str_code);

         return view("register.code_sent", compact('first_name','last_name','email'));

    }

    public function showRegisterForm(Request $request,$code){
        $code = strip_tags(trim($code));
        $codeData = Code::where('code',hash('md5',$code))->first();
        if(isset($codeData) && !empty($codeData)){
            if($codeData->updated_at->timestamp + (72 * 60 *60) < time())
            {
                return view('errors.expire');
            }

            $tempuserData  = [];
            if(Session::get("tempuserData")){
                $tempuserData = Session::get("tempuserData");
                Session::forget("tempuserData");
            }

            return view('register.register_form',[
                "email" => $codeData->email,
                "code" => $code ,
                "first_name" => $codeData->first_name ,
                "last_name" => $codeData->last_name ,
                "tempuserData" => $tempuserData 
            ]);
        }
        abort(404);
    }


    public function confirmRegisterForm(Request $request,KinderRequest $tempuser){
   
        $codeData= Code::where('code',hash('md5',$request->code))->firstOrFail();

        $this->rules['email'] ='required|email|unique:mealmm_user_request';
        $this->rules['password'] =['required','different:email',new Password];
        $this->rules['confirm_password'] = 'required|same:password';   

        $request["email"] = $codeData->email;

        $this->validate($request,$this->rules,$this->messages,$this->attributes);

        $first_name = isset($request->first_name) && !empty($request->first_name) ? strip_tags(trim($request->first_name))." " : "";
        $last_name = isset($request->last_name) && !empty($request->last_name) ? strip_tags(trim($request->last_name)) : "";
        $name = $first_name.$last_name;

        $tempuserData=[
            "name" => $name,
            "zipcode" => isset($request->zipcode) && !empty($request->zipcode) ? strip_tags(trim($request->zipcode)) : null,
            "prefecture" => isset($request->prefecture) && !empty($request->prefecture) ? strip_tags(trim($request->prefecture)) : null,
            "city" => isset($request->city) && !empty($request->city) ? strip_tags(trim($request->city)) : null,
            "street_address" => isset($request->street_address) && !empty($request->street_address) ? strip_tags(trim($request->street_address)) : null,
            "building" => isset($request->building) && !empty($request->building) ? strip_tags(trim($request->building)) : null,
            "phone" => isset($request->phone) && !empty($request->phone) ? strip_tags(trim($request->phone)) : null,
            'email' =>  isset($request->email) && !empty($request->email) ? strip_tags(trim($request->email)) : null,
            'password'=> isset($request->password) && !empty($request->password) ? bcrypt(strip_tags(trim($request->password))) : null,
            "contact_name" => isset($request->contact_name) && !empty($request->contact_name) ? strip_tags(trim($request->contact_name)) : null,
            'code' => $request->code
        ];

        Session::put("tempuserData",$tempuserData);

        return view("register.register_confirm_form", [
            "tempuserData" => $tempuserData,
        ]);
    }

    public function saveRegisterForm(Request $request){

        if(Session::get("tempuserData")){
            $tempuserData = Session::get("tempuserData");
            $code = $tempuserData["code"];
            unset($tempuserData["code"]);
            Session::forget("tempuserData");
        }else{
            abort(404);
        }

        $codeData= Code::where('code',hash('md5',$code))->firstOrFail();

        $temp_user = new KinderRequest;
        $temp_user->fill($tempuserData);
        $temp_user->save();
        
        $email=strip_tags(trim($temp_user->email));

        Code::new_kinder_registration_alert_to_admin($temp_user);

        $codeData->delete();

        return view("register.pre_complete", [
            "email" => $email
        ]);
    }
  }