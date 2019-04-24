<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;

use Illuminate\Http\Request;
use App\Kinder;
use App\KinderRequest;
use App\User;
use App\Code;
use App\Buono\Shisetsu;
use App\Rules\Phone;
use App\Rules\Password;
use App\KinderRegistrationLog;




class KinderRequestController extends Controller
{
    private $rules=[
        'service' => 'required',
    	'code' => '',
    	'name' => 'required',
        'email' => 'required|email|unique:users,email|unique:kinders,email',
        'zipcode' => 'required',
        'prefecture' => 'required:string|max:191',
        'city' => 'required|string|max:191',
        'street_address' => 'required|max:191',
        'building' => 'nullable|max:191',
        'phone' => '',
        'fax' => '',
        'contact_name' => 'required|max:191'
    ];


    private $messages=[
    	
        'code.unique' => '入力された「コード」は既に使用されています。',
		'code.required' => '「コード」は必須項目です。',
    	'name.required' => '「お名前」の入力が必須です。',
        'service.required' => '献立ソフトは必須項目です。',
        
        'contact_name.required' => '「担当者名」は必須項目です。',
        'contact_name.max' => '「担当者名」は191文字以下で指定してください。',
    
        'password.different' => 'ご登録されるメールアドレスをパスワードにすることはできません',
	 	'password.required' => '「パスワード」は必須項目です。',
        'password.min' => '「パスワード」は6文字以上で入力してください。',
        'password.max' =>'「パスワード」は64文字以内で入力してください。',
        'password_confirm.required' =>'「パスワード確認」は必須項目です。',
        'password_confirm.same' =>'入力された2つの「パスワード」が一致していません。',
		
		'email.required' =>'「メールアドレス」の入力が必須です。',
        'email.unique' => '入力された「メールアドレス」は既に登録されています。',
        'email.email' =>'有効な「メールアドレス」を入力してください。',
        
        'zipcode.required'=> '「郵便番号」の入力が必須です。',
        'prefecture.required'=>'「都道府県」の選択が必須です。',
        'city.required'=>'「市区町村〜番地」の入力が必須です。',

        'street_address.required'=>'「住所」の入力が必須です。',
        'street_address.max' => '「住所」は191文字以内で入力してください。',

        'building.max' => '「建物名等」は191文字以内で入力してください。',
        
        'phone.max' => '「電話番号」は20文字以内で入力してください。',
        'fax.max' => '「Fax番号」は20文字以内で入力してください。',

        'phone.regex' => '電話番号は数字と(-)のみで入力してください。',
        'fax.regex' => 'ファックスは数字とハイフン(-)のみで入力してください。'
    ];

    private $attributes = [
        'fax' => 'FAX番号',
        'phone'=> '電話番号'
    ];

    public function __construct(){
        $this->middleware('systemuser');
        $this->middleware(function($request,$next){
          if(!auth()->check())
          {
            abort(404);
          }
          return $next($request);
        });
        $this->rules['phone'] = ['nullable',new Phone];
        $this->rules['fax'] = ['nullable',new Phone];
    }
     
    public function index()
    {
        $tempusers= KinderRequest::all();
        $codes = Code::all();


        foreach($codes as $code){
            if($code->updated_at->timestamp + (72 * 60* 60) < time())
            {
                $code->delete();
            }
        }
        return view('user_management.index', compact('tempusers'));
    }


    public function show(KinderRequest $tempuser){
         return view('user_management.show',compact('tempuser'));
    }


    public function store(Request $request, KinderRequest $tempuser){
        if($request->service == 1)
        {
            $this->rules['code'] ='required|unique:kinders|numeric';
        }
        
        $this->validate($request,$this->rules,$this->messages);


        $userData=[
            'contact_name'=>$tempuser->contact_name,
            'password'=> $tempuser->password,
            'email' =>  $tempuser->email,
            'contact_name'=>$tempuser->contact_name,
            'group' => 0,
        ];

        $kinder_user=new User;
        $kinder_user->fill($userData);
        $kinder_user->save();

        $data =[
            "kinder_user_id" => $kinder_user->id,
            "user_id" => auth()->user()->id,
            "code" => (isset($request->code) && !empty($request->code))? strip_tags(trim($request->code)) : NULL,
            "name"=>$tempuser->name,
            "zipcode" => $tempuser->zipcode,
            "prefecture"=>$tempuser->prefecture,
            "city"=>$tempuser->city,
            "street_address"=>$tempuser->street_address,
            "building" =>$tempuser->building,
            "phone" => $tempuser->phone,  
            "fax" => $tempuser->fax,
            "email" => $tempuser->email,
            "remark" => strip_tags(trim($request->remark)),
            "service" => (isset($request->service) && !empty($request->service))? strip_tags(trim($request->service)) : 0,
            "link_code" => Kinder::generateRandomCode(8),
        ];
        
        $kinder=new Kinder;
        $kinder->fill($data);
        $kinder->save();

        // Register shisetsu if using other services than Buono
        if($data['service'] != Kinder::BUONO_SERVICE)
        {
            $shisetsu = new Shisetsu;
            $shisetsu->service = $data['service'];
            $shisetsu->shisetsu_name = $data['name'];
            $shisetsu->save();
            
            //update to kinder
            $kinder->shisetsu_id = $shisetsu->id;
            $kinder->save();
        }
        else
        {
            $kinder->shisetsu_id = $data['code'];
            $kinder->save();
        }

       // kinderregistrationlog to email approved from admin
        $kinderlogData= [
            "name" => $tempuser->name,
            "contact_name" =>$tempuser->contact_name,
            "prefecture" =>$tempuser->prefecture,
            "phone" =>$tempuser->phone,
            "email" =>$tempuser->email,
            "status" => 1,
        ];

        $kinderlog = new KinderRegistrationLog();
        $kinderlog ->fill($kinderlogData);
        $kinderlog ->save();


        Code::kinder_registration_approved($tempuser);

        $tempuser->delete();

        return redirect()->route('kinder_requestlist');
    }


    public function destroy(KinderRequest $tempuser){

       // kinderregistrationlog to email declined from admin
        $kinderregistrationlogData= [
            "name" => $tempuser->name,
            "contact_name" =>$tempuser->contact_name,
            "prefecture" =>$tempuser->prefecture,
            "phone" =>$tempuser->phone,
            "email" =>$tempuser->email,
            "status" => 2,
        ];

        $kinderlogdata = new KinderRegistrationLog();
        $kinderlogdata ->fill($kinderregistrationlogData);
        $kinderlogdata ->save();

        Code::kinder_registration_decline($tempuser);

        $tempuser->delete();

        return redirect()->route('kinder_requestlist');

    }

}
