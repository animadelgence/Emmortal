<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);
$string = file_get_contents($_SERVER['DOCUMENT_ROOT']."/setting.json");
$json = json_decode($string, true);
$link = mysqli_connect($json['database']["database_host"], $json['database']["database_username"], $json['database']["database_password"], $json['database']["database_name"]);
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;


$email = 'anima.adhikary@delgence.com';
            $mailBody = '<div class="container" style="width: 50%; margin-left: auto; margin-right: auto; font-family: verdana;"><div class="header" style="background-color: #B2AA93; padding: 2px; text-align: center; color: #fff;"><h3 style="font-size: 13px;">Emmortal</h3></div><div class="text-content" style="padding: 15px;"><p style="font-size: 13px;">Welcome on Emmortal, <span style="font-weight: 600;">Anima Adhikary</span></p><p style="font-size: 13px;">Before you start using Emmortal , you need to confirm your email address.
                Click the link below: </p><a class="confirm-link" href="#" style="text-decoration: none;">
                <div class="btn" style="width: 125px; padding: 12px 11px; background-color: #579942; border-radius: 5px; color: #fff; font-size: 14px; margin-top: 46px !important;">Confirm Email</div></a><p style="font-size: 13px;">Best, your Emmortal Team</p></div></div>';
            $subject = "Confirm your email address";
            $from = $json['sendgridaccount']['addfrom'];
$url = 'https://api.sendgrid.com/';
        $request = $url . 'api/mail.send.json';
        $user = $json['sendgridaccount']['username'];
        $pass = $json['sendgridaccount']['password'];
        $params = array(
            'api_user' => $user,
            'api_key' => $pass,
            'to' => $email,
            'subject' => $subject,
            'html' => $mailBody,
            'text' => '',
            'from' => $from,
        );
        $request = $url . 'api/mail.send.json';
        $session = curl_init($request);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($session);
        curl_close($session);
        return $response;
?>
