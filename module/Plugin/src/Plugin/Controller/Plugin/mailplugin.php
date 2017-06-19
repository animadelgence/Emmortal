<?php

namespace Plugin\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class mailplugin extends routeplugin {

    public function confirmationmail($from, $to, $subject, $confirmationMailBody) {
        //echo $from;exit;
        $response = $this->curlpost($from, $to, $subject, $confirmationMailBody);
       echo $response; exit;
    }

    public function curlpost($to, $from, $subject, $body) {
        $jsonArray = $this->jsondynamic();
        $url = 'https://api.sendgrid.com/';
        $request = $url . 'api/mail.send.json';
        $user = $jsonArray['sendgridaccount']['username'];
        $pass = $jsonArray['sendgridaccount']['password'];
        $params = array(
            'api_user' => $user,
            'api_key' => $pass,
            'to' => $to,
            'subject' => $subject,
            'html' => $body,
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
        $responseGet = 1;
        return $responseGet;
    }

}

?>
