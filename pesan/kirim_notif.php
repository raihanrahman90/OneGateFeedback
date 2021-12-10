<?php
function sendPushNotification($to='', $judulNotif='',$isiNotif='', $action='', $message='', $id=''){
    $url = "https://fcm.googleapis.com/fcm/send";
    $token =$to;
    $serverKey = "AAAA3vEDnEE:APA91bGFfQQZkaO1AAKtHw7uls1FxrBAtZxhJfcsQoE5yxYLukj-TVAz54uExMc9LHfWx3hieI-jLronJ9a3-GDQwXt86af3Fseei428U0aFdQ55oyIAfkU-CJqR1NbBf_V_Y6QaIMGq";
    $title = $judulNotif;
    $body = $isiNotif;
    $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
    $data = array('halaman'=>$message,'akses'=>$action,'id'=>$id);
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