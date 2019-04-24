<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rules\Password;

class UserController extends AccessController
{
    
    private $rules=[
        'contact_name' => 'required|max:191',
        'company_name' => 'required|max:191',
        'password' => '',
        'password_confirm' => 'required|same:password',
    ];
	
	private $messages=[
        'required'=> '「:attribute」は必須項目です。',
        'min'=> '「:attribute」は:min文字以上で入力してください。',
        'max' => '「ユーザー名」は:max文字以下で指定してください。',
        'email'=>'正しい「:attribute」を入力してください。',
        'unique' =>'入力された「:attribute」は既に使われています。',
        'same' =>'入力された2つの「:other」が一致していません。',
        'password.different' => 'ご登録されるメールアドレスをパスワードにすることはできません',
    ];

    private $attributes = [
        'contact_name' => '担当者名',
        'company_name' => '貴社名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirm' => 'パスワード確認',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->rules['password'] =['required','different:email',new Password];
      
    }
    public function index(Request $request)
    {  
        if(!\Auth::user()->member(2))
        {
             abort(404);       
        }
        else
        {
            $limit = 10;
            $users = User::where('group', 1)->orderby('id','desc')->where('deleted_flag',0)->paginate($limit);
            return view('system.user.index',compact('users', 'limit'));
        }
    }

    public function create()
    {   
        if(!\Auth::user()->member(2))
        {
           abort(404);
        }
        
        return view('system.user.create');
    }

    public function store(Request $request)
    {   

        if(\Auth::user()->member(0))
        {
            abort(404);
        }
        $this->rules['email']= 'required|email|max:255|unique:users';
        $this->validate($request, $this->rules, $this->messages,$this->attributes);

        $userData=[
            'contact_name' => strip_tags(trim($request->contact_name)),
            'company_name' => strip_tags(trim($request->company_name)),
            'password'=> bcrypt($request->password),
            'email' =>  strip_tags(trim($request->email)),
            'group' => User::EDUCE_USER,
        ];

        $user = new User;
        $user->fill($userData);
        $user->save();
		
		flash('マネージャーユーザーの登録が完了しました。')->success();
        return redirect("user");
        
    }

    public function edit($id)
    {
        $user_id=\Auth::user()->id;

        if(!\Auth::user()->member(2))
        {
           abort(404);
        }

        $user=User::findOrFail($id);
        if($user->group != 1)
        {
            return redirect()->back();
        }
		
        return view('system.user.edit',compact('user'));
    }

    public function update(Request $request,$id)
    {   
        $userData=[
            'contact_name' => strip_tags(trim($request->contact_name)),
            'company_name' => strip_tags(trim($request->company_name)),
            'password'=> bcrypt($request->password),
            'email' =>  strip_tags(trim($request->email)),
            'group' => User::EDUCE_USER,
        ];
		
		$user=User::findOrFail($id);
 
    	if($userData['email'] !== $user->email)
        {
            $this->rules['email'][] = 'unique:users';
        }

		
        if(isset($request->password) && !empty($request->password))
        {
        	$userData['password']=bcrypt($request->password);
        }
		else
		{
			unset($this->rules['password']);
			unset($this->rules['password_confirm']);
		}
        $this->validate($request, $this->rules, $this->messages,$this->attributes);
      
        $user->fill($userData);
        $user->update();
		
		flash('マネージャーユーザーの編集が完了しました。')->success();
        return redirect("user");

    }

    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->update(['deleted_flag'=>1]);
		
		flash('マネージャーユーザーを削除しました。')->success();
        return redirect("user");
    }
}
