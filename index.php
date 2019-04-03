<?php
include "connect.php";
include "function.php";
header('Content-Type: text/html; charset=utf-8');
$botToken = "YOUR_BOT_TOKEN";
$webSite = "https://api.telegram.org/bot" . $botToken;
$update= file_get_contents("php://input");
$arrayMessage= json_decode($update, true);
$chatId= $arrayMessage['message']['chat']['id'];
$username= $arrayMessage['message']['chat']['username'];
$first_name= $arrayMessage['message']['chat']['first_name'];
$message= $arrayMessage['message']['text'];
$id = str_replace("/start ", "", $message);
$date= $arrayMessage['message']['date'];
//Register user when Insert First Command  And  Inset Database
$query = "SELECT * FROM user WHERE chat_id=:chat_id ";
$result = $connect->prepare($query);
$result->bindParam(":chat_id", $chatId);
$result->execute();
$rows=$result->fetch(PDO::FETCH_ASSOC);
$cheke=$rows["chat_id"];
$type=$rows["type"];
$state=$rows["state"];
$command=$rows["command"];
$connect_user=$rows["connect_id"];
if ((empty($cheke))&&(!empty($chatId))) {
    if(isset($username)) {
        $res = $connect->prepare("INSERT INTO user (chat_id,username,name )VALUES (:chat_id,:username,:name)");
        $res->bindParam(':chat_id', $chatId);
        $res->bindParam(':username', $username);
        $res->bindParam(':name', $first_name);
        $res->execute();
    }else{
        $nothing="nothing";
        $res = $connect->prepare("INSERT INTO user (chat_id,username,name )VALUES (:chat_id,:username,:name)");
        $res->bindParam(':chat_id', $chatId);
        $res->bindParam(':name', $first_name);
        $res->bindParam(':username', $nothing);
        $res->execute();
    }
}

if($id >0){
    if($chatId ==$id){
        $poets = array(
            'keyboard' => array(
                array('دریافت لینک اینستاگرام','🔗 دریافت لینک من'),
                array('📍 درباره ربات')
            ),'resize_keyboard' => true,);
        $jsonPoets = json_encode($poets);
        sendMessage($chatId, "اینکه ادم گاهی با خودش حرف بزنه خوبه، ولی اینجا نمی‌تونی به خودت پیام ناشناس بفرستی.

چه کاری برات انجام بدم؟", $jsonPoets);
    }else{
        update_connect_user($id,null);
        update_connect_user($chatId,null);
        update_connect_user($chatId,$id);
        $query_connectr = "SELECT * FROM user WHERE chat_id=:chat_id ";
        $result_connectr = $connect->prepare($query_connectr);
        $result_connectr->bindParam(":chat_id", $id);
        $result_connectr->execute();
        $rows_connectr=$result_connectr->fetch(PDO::FETCH_ASSOC);
        $name_connect=$rows_connectr['name'];
        $poets = array(
            'keyboard' => array(
                array('بستن گپ ناشناس')
            ),'resize_keyboard' => true,);
        $jsonPoets = json_encode($poets);
        sendMessage($chatId, $first_name."  👋🏻

شما در حال نوشتن پیام ناشناس به « ".$name_connect." »  هستید.

می‌تونید نقد یا هر حرفی که تو دلتون هست رو بنویسید چون پیام شما به صورت ناشناس ارسال می‌شه.

⚠️دقت داشته باشید که باید کل متن رو در یک پیام بفرستید نه چند پیام پشت سر هم و ناقص...

👈متن مورد نظر خود را بنویسید و ارسال کنید.
همه‌ی حرفهاتون رو در یک پست بگید.

🔥در ضمن voice و آهنگ و تصویر هم میشه به صورت رایگان بفرستین😉


پیامتون رو ارسال کنید...👇👇👇", $jsonPoets);
    }

}
if(!isset($id) || $id ==0){
if (isset($connect_user)){
    if($message=="بستن گپ ناشناس"){
        update_connect_user($chatId,null);
        $poets = array(
            'keyboard' => array(
                array('دریافت لینک اینستاگرام','🔗 دریافت لینک من'),
                array('📍 درباره ربات')
            ),'resize_keyboard' => true,);
        $jsonPoets = json_encode($poets);
        sendMessage($chatId, "گفتگو با موفقیت بسته شد.", $jsonPoets);
    }else{
        $poets = array(
            'keyboard' => array(
                array('بستن گپ ناشناس')
            ),'resize_keyboard' => true,);
        $jsonPoets = json_encode($poets);
        sendMessage($chatId, "پیام ارسال شد ", $jsonPoets);
        $query_connect = "SELECT * FROM user WHERE chat_id=:chat_id ";
        $result_connect = $connect->prepare($query_connect);
        $result_connect->bindParam(":chat_id", $connect_user);
        $result_connect->execute();
        $rows_connect=$result_connect->fetch(PDO::FETCH_ASSOC);
        $connect_username=$rows_connect["username"];
        $type_connect=$rows_connect['state'];
        $name_connect=$rows_connect['name'];

        if($type_connect==1){

            $poets3 = array(
                'keyboard' => array(
                    array('دریافت لینک اینستاگرام','🔗 دریافت لینک من'),
                    array('📍 درباره ربات')
                ),'resize_keyboard' => true,);
            $jsonPoets3 = json_encode($poets3);
            sendMessage($connect_user, "🔷 اطلاعات کاربر مورد نظر:

• نام:".$first_name."
• آیدی: @".$username."
• پیام نوشته شده: ".$message, $jsonPoets3);
        }else{
            $poets3 = array(
                'keyboard' => array(
                    array('دریافت لینک اینستاگرام','🔗 دریافت لینک من'),
                    array('📍 درباره ربات')
                ),'resize_keyboard' => true,);
            $jsonPoets3 = json_encode($poets3);
            sendMessage($connect_user, "پیام از طرف نا شناس:".$message, $jsonPoets3);
        }

    }
}else{
switch ($message) {

    case "/start":
        $poets = array(
            'keyboard' => array(
                array('دریافت لینک اینستاگرام','🔗 دریافت لینک من'),
                array('📍 درباره ربات')
            ),'resize_keyboard' => true,);
        $jsonPoets = json_encode($poets);
               sendMessage($chatId, "چکاری برات بکنم ", $jsonPoets);

        break;
    case "🔗 دریافت لینک من":
        $poets = array(
            'keyboard' => array(
                array('دریافت لینک اینستاگرام','🔗 دریافت لینک من'),
                array('📍 درباره ربات')
            ),'resize_keyboard' => true,);
        $jsonPoets = json_encode($poets);
        sendMessage($chatId, "سلام  ".$first_name. "هستم 😉
لینک زیر رو لمس کن و هر انتقادی که نسبت به من داری یا حرفی که تو دلت هست رو با خیال راحت بنویس و بفرست. بدون اینکه از اسمت باخبر بشم پیامت به من می‌رسه. خودتم می‌تونی امتحان کنی و از همه بخوای راحت و ناشناس بهت پیام بفرستن، حرفای خیلی جالبی می‌شنوی:
👇👇👇

t.me/Gapbamanbot?start=".$chatId, $jsonPoets);

        break;
    case "📍 درباره ربات":
        $poets = array(
            'keyboard' => array(
                array('دریافت لینک اینستاگرام','🔗 دریافت لینک من'),
                array('📍 درباره ربات')
            ),'resize_keyboard' => true,);
        $jsonPoets = json_encode($poets);
        sendMessage($chatId, "با این روبات میتونی از دوستات بخوای به صورت ناشناس بهت پیام بدن و نظرشونو بهت بگن😉😜

اگه دوست داری بدونی بقیه چه حرفایی درموردت تو دلشون هست و بهت نمیگن🙊🙈 از این روبات استفاده کن😊😜

درضمن میتونی لینک اختصاصی دریافت کنی و بذاری تو اینستاگرامت😊

از دوستاتم بخواه که لینک اختصاصی خودشونو بسازن و بهت بدن تا توهم بتونی حرفتو ناشناس بهشون بگی😃😁", $jsonPoets);
        break;
    case "دریافت لینک اینستاگرام":
        $poets = array(
            'keyboard' => array(
                array('دریافت لینک اینستاگرام','🔗 دریافت لینک من'),
                array('📍 درباره ربات')
            ),'resize_keyboard' => true,);
        $jsonPoets = json_encode($poets);
        SendPhoto($chatId,"عکس اینستاگرام", $jsonPoets);
        sendMessage($chatId,"✅ لینک اینستاگرام مخصوص شما ساخته شد
برای اینکه دنبال‌کننده‌های اینستاگرامت بتونن برات پیام ناشناس بفرستن عکسی که در بالا فرستاده شده رو دانلود کن، 
روی اینستاگرامت پست کن و این لینک رو در قسمت website ویرایش پروفایل اینستاگرامت بذار: 👇👇👇 

t.me/Gapbamanbot?start=".$chatId, $jsonPoets);

        break;



}}
}
function sendMessage($chatId, $message, $r)
{
    $url = $GLOBALS['webSite'] . "/sendMessage?chat_id=" . $chatId . "&text=" . urlencode($message) . "&reply_markup=" . $r;
    file_get_contents($url);
}
function SendPhoto($chatId, $message, $r)
{
    $url = $GLOBALS['webSite'] . "//sendPhoto?chat_id=" . $chatId . "&caption=" . urlencode($message) . "&reply_markup=" . $r;
    file_get_contents($url);
    $post = array(
        'photo'     => new CURLFile(realpath("instagram.jpg"))
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_exec($ch);

}
function update_user_state($chatId,$message)
{
    $upquery = "UPDATE user SET state = :state WHERE chat_id = :chat_id";
    $result = $GLOBALS['connect']->prepare($upquery);
    $result->bindParam(":chat_id", $chatId);
    $result->bindParam(":state", $message);


    $result->execute();
}
function update_connect_user($chatId,$connect_value){

    $upquery = "UPDATE user SET connect_id = :connect_id WHERE chat_id = :chat_id";
    $result = $GLOBALS['connect']->prepare($upquery);
    $result->bindParam(":chat_id", $chatId);
    $result->bindParam(":connect_id", $connect_value);


    $result->execute();
}
function update_user($chatId,$message)
{
    $upquery = "UPDATE user SET command = :command WHERE chat_id = :chat_id";
    $result = $GLOBALS['connect']->prepare($upquery);
    $result->bindParam(":chat_id", $chatId);
    $result->bindParam(":command", $message);
    $result->execute();
}
function insert_request($chatId,$message){
    $res = $GLOBALS['connect']->prepare("INSERT INTO request (chat_id_send ,chat_id_receive)VALUES (:chat_id_send,:chat_id_receive)");
    $res->bindParam(':chat_id_send', $chatId);
    $res->bindParam(':chat_id_receive', $message);
    $res->execute();
}
function delete_request($chatId){
    $res = $GLOBALS['connect']->prepare("DELETE FROM request WHERE chat_id_send =:chat_id_send");
    $res->bindParam(':chat_id_send', $chatId);
    $res->execute();
}
update_user($chatId,$message);
