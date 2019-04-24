<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Code extends Model
{
    protected $dateFormat = 'U';

    protected $table = 'mealmm_codes';

     protected $guarded =[];

  public static function generateRandomCode($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

  public static function generateRandomUniqueNumber($min=0, $max=1000) {
        $code = rand($min,$max);

        $code_exist = self::checkUniqueCode();
        if($code_exist){
            $code = rand($min,$max);
        }
        return $randomString;
    }

    public static function checkUniqueCode(){
        $code_exist self::where("unique_code",$number)->first();
        if(isset($code_exist) && !empty($code_exist)){
            return true;
        }
        return false;
    }


    public static function kinder_registration_confirm($email,$code){
            $mail = new PHPMailer(true);  
            $url = secure_url('/').'/register/kinder/'.$code;

            try {
                //Server settings
                $mail->CharSet = 'UTF-8';    
                $mail->SMTPDebug = false;                         // Enable verbose debug output
                $mail->isSMTP();                                  // Set mailer to use SMTP
                $mail->Host = 'email-smtp.us-west-2.amazonaws.com';                // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                           // Enable SMTP authentication
                $mail->Username = 'AKIAJPKQ7YVZUPZPLAWQ';    // SMTP username
                $mail->Password = 'AvczTrbdzRsg7rRA2c3GxxbgsR5NJKOYl4ZiWzWKg5xJ';         // SMTP password
                $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                // TCP port to connect to
            

                $view =  view('emails.registration_url',['url'=>$url])->render();
                $content = htmlspecialchars_decode(str_replace("\\","",  $view ));

                //Recipients
                $mail->setFrom('kidzmealmaster@gmail.com','Kids Meal');
                $mail->addAddress($email);     // Add a recipient
                $mail->Subject = "[KIDS MEAL Pro] 幼稚園・保育園ユーザー新規アカウント登録";
                $mail->Body    = strip_tags(trim($content));

                $mail->send();
               
    
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            } 
    }

    public static function kinder_registration_pre_complete($email){
            $mail = new PHPMailer(true);  
            try {
                //Server settings
                $mail->CharSet = 'UTF-8';    
                $mail->SMTPDebug = false;                         // Enable verbose debug output
                $mail->isSMTP();                                  // Set mailer to use SMTP
                $mail->Host = 'email-smtp.us-west-2.amazonaws.com';                // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                           // Enable SMTP authentication
                $mail->Username = 'AKIAJPKQ7YVZUPZPLAWQ';    // SMTP username
                $mail->Password = 'AvczTrbdzRsg7rRA2c3GxxbgsR5NJKOYl4ZiWzWKg5xJ';         // SMTP password
                $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                // TCP port to connect to
            

                $view =  view('emails.register_complete')->render();
                $content = htmlspecialchars_decode(str_replace("\\","",  $view ));

                //Recipients
                $mail->setFrom('kidzmealmaster@gmail.com','Kids Meal');
                $mail->addAddress($email);     // Add a recipient
                $mail->Subject = "[KIDS MEAL] 園連携コード変更のお知らせ";
                $mail->Body    = strip_tags(trim($content));

                $mail->send();
    
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            } 
    }

    public static function kinder_registration_approved(KinderRequest $kinder){

        if(!empty($kinder) && !empty($kinder))
        {
            $mail = new PHPMailer(true); 
            
            $data = $kinder->toArray();

            try {
                //Server settings
                $mail->CharSet = 'UTF-8';    
                $mail->SMTPDebug = false;                         // Enable verbose debug output
                $mail->isSMTP();                                  // Set mailer to use SMTP
                $mail->Host = 'email-smtp.us-west-2.amazonaws.com';                // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                           // Enable SMTP authentication
                $mail->Username = 'AKIAJPKQ7YVZUPZPLAWQ';    // SMTP username
                $mail->Password = 'AvczTrbdzRsg7rRA2c3GxxbgsR5NJKOYl4ZiWzWKg5xJ';         // SMTP password
                $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                // TCP port to connect to
            

                $view =  view('emails.register_approve',$data)->render();
                $content = htmlspecialchars_decode(str_replace("\\","",  $view ));

                //Recipients
                $mail->setFrom('kidzmealmaster@gmail.com','Kids Meal');
                $mail->addAddress($data["email"]);     // Add a recipient
                $mail->Subject = "KIDS MEAL Pro] 貴園アカウント発行完了のお知らせ";
                $mail->Body    = strip_tags(trim($content));

                $mail->send();
    
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
    }

    public static function kinder_registration_decline(KinderRequest $kinder){

        if(!empty($kinder) && !empty($kinder))
        {
            $mail = new PHPMailer(true); 
            
            $data = $kinder->toArray();

            try {
                //Server settings
                $mail->CharSet = 'UTF-8';    
                $mail->SMTPDebug = false;                         // Enable verbose debug output
                $mail->isSMTP();                                  // Set mailer to use SMTP
                $mail->Host = 'email-smtp.us-west-2.amazonaws.com';                // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                           // Enable SMTP authentication
                $mail->Username = 'AKIAJPKQ7YVZUPZPLAWQ';    // SMTP username
                $mail->Password = 'AvczTrbdzRsg7rRA2c3GxxbgsR5NJKOYl4ZiWzWKg5xJ';         // SMTP password
                $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                // TCP port to connect to
            

                $view =  view('emails.register_decline',$data)->render();
                $content = htmlspecialchars_decode(str_replace("\\","",  $view ));

                //Recipients
                $mail->setFrom('kidzmealmaster@gmail.com','Kids Meal');
                $mail->addAddress($data["email"]);     // Add a recipient
                $mail->Subject = "[KIDS MEAL Pro] アカウント発行お断りのお知らせ";
                $mail->Body    = strip_tags(trim($content));

                $mail->send();
    
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
    }

    public static function new_kinder_registration_alert_to_admin(KinderRequest $tempuser){
        $mail = new PHPMailer(true); 
        $data = $tempuser->toArray();
            

        try {
            //Server settings
            $mail->CharSet = 'UTF-8';    
            $mail->SMTPDebug = false;                         // Enable verbose debug output
            $mail->isSMTP();                                  // Set mailer to use SMTP
            $mail->Host = 'email-smtp.us-west-2.amazonaws.com';                // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                           // Enable SMTP authentication
            $mail->Username = 'AKIAJPKQ7YVZUPZPLAWQ';    // SMTP username
            $mail->Password = 'AvczTrbdzRsg7rRA2c3GxxbgsR5NJKOYl4ZiWzWKg5xJ';         // SMTP password
            $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                // TCP port to connect to
        

            $view =  view('emails.new_kinder_registration',$data)->render();
            $content = htmlspecialchars_decode(str_replace("\\","",  $view ));

            //Recipients
            $mail->setFrom('kidzmealmaster@gmail.com','Kids Meal');
            $mail->addAddress('kidzmealmaster@gmail.com');     // Add a recipient
            $mail->Subject = "KIDS MEAL Pro の幼稚園・保育園ユーザー 新規アカウント登録フォームにて以下の申し込みがありました。";
            $mail->Body    = strip_tags(trim($content));

            $mail->send();

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }


    public static function send_code_changes_email($email,$code)
    {
        if(!empty($email) && !empty($code))
        {
            $mail = new PHPMailer(true);   

            try {
                //Server settings
                $mail->CharSet = 'UTF-8';    
                $mail->SMTPDebug = false;                         // Enable verbose debug output
                $mail->isSMTP();                                  // Set mailer to use SMTP
                $mail->Host = 'email-smtp.us-west-2.amazonaws.com';                // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                           // Enable SMTP authentication
                $mail->Username = 'AKIAJPKQ7YVZUPZPLAWQ';    // SMTP username
                $mail->Password = 'AvczTrbdzRsg7rRA2c3GxxbgsR5NJKOYl4ZiWzWKg5xJ';         // SMTP password
                $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                // TCP port to connect to
            

                $view =  view('emails.code_change',['code'=>$code])->render();
                $content = htmlspecialchars_decode(str_replace("\\","",  $view ));

                //Recipients
                $mail->setFrom('kidzmealmaster@gmail.com','Kids Meal');
                $mail->addAddress($email);     // Add a recipient
                $mail->Subject = "[KIDS MEAL] 園連携コード変更のお知らせ";
                $mail->Body    = strip_tags(trim($content));

                $mail->send();
    
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

        }
    }
}