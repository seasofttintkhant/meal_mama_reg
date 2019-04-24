<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Kid;
use App\Child;
use App\PushMessage;
use App\Device;
use App\Notification;

class Kinder extends Model
{
	const NON_SERVICE = 0;
	const BUONO_SERVICE = 1;
	const EIBUN_SERVICE = 2;
	
    protected $dateFormat = 'U';

    protected $fillable=[
        "code",
        "user_id",
        "kinder_user_id",
        "name",
        "zipcode",
        "street_address",
        "prefecture",
        "city",
        "building",
        "phone",
        "fax",
        "email",
        "contact_name",
        "remark",
        "service",
        "deleted_flag",
        "shisetsu_id",
        "link_code",
    ];
	
	static public function generateRandomCode($length = 10) {
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	public function isService($service)
	{
		return ($this->service == $service)? true : false;
	}
	
	public function canUploadTimezoneMealtype()
	{
		$valid_services = [self::NON_SERVICE, self::EIBUN_SERVICE];
		return (in_array($this->service, $valid_services))? true : false;
	}
	
	public function canUploadMenu()
	{
		$valid_services = [self::EIBUN_SERVICE];
		return (in_array($this->service, $valid_services))? true : false;
	}
	
    public static function getCode($id)
    {
        return self::findOrFail($id)->value('code');
    }
	
	public static function getKinderData()
	{
		$kinders = self::where('deleted_flag', 0)->get();
		$data = array();
		foreach($kinders as $kinder)
		{
			$data[$kinder->id] = $kinder->name;
		}
		return $data;
	}
	
	public static function getKinderByUser($user_id)
	{
		return Kinder::where('kinder_user_id', $user_id)->where('deleted_flag', 0)->first();
	}
	
	public function getUser()
	{
		return User::find($this->kinder_user_id);
	}
	
	public function sendPush($type, $custom_data = array())
	{
		include_once(app_path() . '/Lib/push.php');
		
		//Get Push Message
		$push_message = PushMessage::getMessage($this->id, $type);
		$title =  strip_tags(trim($push_message['title'] ));
		$body = preg_replace( "/\r|\n/", "", strip_tags(trim($push_message['body'])));
		
		$custom_key['type'] = $type;
		foreach($custom_data as $key => $val)
		{
			$custom_key[$key] = $val;
		}
		
		//Add Notification
		$data=[
			'kinder_id' => $this->id,
			'type' => $type,
			'title' => $title,
			'content' => $body,
		];

		   
		$notification = new Notification;
		$notification->fill($data);
		$notification->save();
		
		//Get children
		$children = Child::select('account_id')
	    	->where('kinder_id', $this->id)
	    	->where('deleted_flag', 0)
	    	->distinct()->get();
		
		if(isset($children) &&! empty($children))
		{
			//Generate Delivery
			$notification->generateDelivery($children);
			
			//Send Push
			$android_registration_ids = array();
			$ios_registration_ids = array();
			
			foreach($children as $child)
			{
				$devices = Device::where('account_id', $child->account_id)
								->whereNotNull('app_user_id')
								->where('push_flag', 2)
								->where('deleted_flag', 0)->get();
			
				foreach($devices as $device)
				{
					if(isset($device) && !empty($device))
					{
						if($device->os_type == 1)
						{
							$android_registration_ids[] = $device->app_user_id;
						}
						elseif($device->os_type == 2)
						{
							$ios_registration_ids[] = $device->app_user_id;
						}
					}
				}
			}
			
			//Android
			if(isset($android_registration_ids) && !empty($android_registration_ids))
			{
				$offset = 0;
				$slice = array();
				while($offset == 0 || (isset($slice) && !empty($slice)))
				{
					$slice = (array_slice($android_registration_ids, 0, 1000));
					if(isset($slice) && !empty($slice))
					{
						sendPushNotification($slice, $title, $body, 1, $custom_key);
					}
					else 
					{
						break;
					}
					$android_registration_ids = array_slice($android_registration_ids, 1000);
					$offset++;
				}
			}
			
			//iOS
			if(isset($ios_registration_ids) && !empty($ios_registration_ids))
			{
				$offset = 0;
				$slice = array();
				while($offset == 0 || (isset($slice) && !empty($slice)))
				{
					$slice = (array_slice($ios_registration_ids, 0, 1000));
					if(isset($slice) && !empty($slice))
					{
						sendPushNotification($slice, $title, $body, 2, $custom_key);
					}
					else 
					{
						break;
					}
					$ios_registration_ids = array_slice($ios_registration_ids, 1000);
					$offset++;
				}
			}
		}
		
		//Update Notification status
	 	$notification->fill(['sent_status'=>1, 'sent_date' => time()]);
        $notification->update();
	}
}
