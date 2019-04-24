<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Kinder;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $dateFormat = 'U';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


	const KINDER_USER = 0;
	const EDUCE_USER = 1;
	const SYSTEM_USER = 2;


    public function member($value)
    {
        if ( $this->group == $value )
        {
          return true;
        }
        return false;
    }
	
	public static function getSystemUsers()
	{
        return self::where('group', 2)->where('deleted_flag',0)->get();
	}
		
	public static function getKinderUsers()
	{
        return self::where('group', 0)->where('deleted_flag',0)->get();
	}
	
	
	public function getShisetsuIdAttribute()
	{
	   $kinder= Kinder::getKinderByUser(auth()->user()->id);
	   
	   if(isset($kinder) && !empty($kinder))
	   {
			return $kinder->shisetsu_id;
	   }
	    return 0;
	}
	//Get kinder Id as an attribute
	public function getKinderIdAttribute()
	{
		$kinder = Kinder::getKinderByUser(auth()->user()->id);
		if(isset($kinder) && !empty($kinder))
		{
			return $kinder->id;
		}
		return 0;
	}
	
	//Kinder User Authorization
	public function isAllowed($kinder_id)
	{

		if($kinder_id == $this->kinder_id){
			
			return true;
		}
		abort(404);
	}

	//Kinder User Authorization with Shisetsu ID
	public function isAllowedShisetsu($shisetsu_id)
	{
		if($shisetsu_id === $this->shisetsu_id){
			return true;
		}
		abort(404);
	}
}
