<?php

function sendPushNotificationToAll($title, $body, $os_type, $custom_key, $type = NULL)
{
	if($type == "camera")
	{
		if($os_type == 1)
		{
			$url = "api.core-asp.com/android_push_request.php";
			$config_key = config('custom.camera_android_key');
		}
		else
		{
			$url = "api.core-asp.com/iphone_push_request.php";
			$config_key = config('custom.camera_iphone_key');
		}
	}
	else
	{
		if($os_type == 1)
		{
			$url = "api.core-asp.com/android_push_request.php";
			$config_key = config('custom.android_key');
		}
		else
		{
			$url = "api.core-asp.com/iphone_push_request.php";
			$config_key = config('custom.iphone_key');
		}
	}
 	
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $data = array();
	$tmp = array();
	$tmp['app_user_id'] = 9999999999;
	$tmp['title'] = $custom_key['title'] = $title;
	$tmp['message'] = $body;
	$tmp['custom_key'] = $custom_key;
	$data[] = $tmp;
    
    $data = array(
    	'config_key' => $config_key,
    	'request_data' => base64_encode(json_encode($data)),
	);
	
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
	
    return json_decode($server_output, true);
}

function sendPushNotification($registrationIds,$title, $body, $os_type, $custom_key, $type = NULL)
{
	if($type == "camera")
	{
		if($os_type == 1)
		{
			$url = "api.core-asp.com/android_push_request.php";
			$config_key = config('custom.camera_android_key');
		}
		else
		{
			$url = "api.core-asp.com/iphone_push_request.php";
			$config_key = config('custom.camera_iphone_key');
		}
	}
	else
	{
		if($os_type == 1)
		{
			$url = "api.core-asp.com/android_push_request.php";
			$config_key = config('custom.android_key');
		}
		else
		{
			$url = "api.core-asp.com/iphone_push_request.php";
			$config_key = config('custom.iphone_key');
		}
	}
 	
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $data = array();
   	foreach($registrationIds as $app_user_id)
   	{
   		$tmp = array();
		$tmp['app_user_id'] = $app_user_id;
		$tmp['title'] = $custom_key['title'] =$title;
		$tmp['message'] = $body;
		$tmp['custom_key'] = $custom_key;
		$data[] = $tmp;
   	}
	// dd($data);
	// $file = '/var/www/kidsmealprodev/app/Lib/data'.$app_user_id.'.txt';
	// file_put_contents($file,base64_encode(json_encode($data)));
    $data = array(
    	'config_key' => $config_key,
    	'request_data' => base64_encode(json_encode($data)),
	);


	
	
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
	curl_close ($ch);

	
    return json_decode($server_output, true);
}