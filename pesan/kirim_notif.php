<?php
function sendPushNotification($to='', $judulNotif='',$isiNotif='', $action='', $message='', $id=''){
    $url = "https://fcm.googleapis.com/fcm/send";
    $token =$to;
    $serverKey = "AAAAJcvh1pc:APA91bHUYop_UOqbZ4Jfb6s90vu6pT9OhCiKosOR03jb4c7cec0pF_lKMiSd1HMp1MBblhogkaBk8HzatbBsx136FyckPodf9cg79TYoX-z_LJnw5exzH5G6B0pC5vMnT2A2pIS2IveI";
    $title = $judulNotif;
    $body = $isiNotif;
    $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
    $data = array('message'=>$message,'action'=>$action,'id'=>$id);
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high', 'data'=>$data);
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    curl_close($ch);
}
?>