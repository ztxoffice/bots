<?php 

ob_start();

$API_KEY = '1917528362:AAFSi5Wu3KDGwbrEnylfQJ_hOGVpUAQo_PM';
##-----hamdy ahmed ‏ ⌯┆-‏𖤍-----##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
	function Forward($KojaShe,$AzKoja,$KodomMSG)
{
    bot('ForwardMessage',[
        'chat_id'=>$KojaShe,
        'from_chat_id'=>$AzKoja,
        'message_id'=>$KodomMSG
    ]);
}
function sendphoto($chat_id, $photo, $action){
	bot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>$photo,
	'action'=>$action
	]);
	}
	function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
	//======hamdy ahmed ‏ ⌯┆-‏𖤍=========//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
mkdir("data/$from_id");
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $message->text;
$ali = file_get_contents("data/$from_id/ali.txt");
$ADMIN = 682572594;
$to =  file_get_contents("data/$from_id/token.txt");
$url =  file_get_contents("data/$from_id/url.txt");
//========〇ᙢᗩᖇ ᕼᗩᔕᕼᙢ===================//
if($text == "/start"){

if (!file_exists("data/$from_id/ali.txt")) {
        mkdir("data/$from_id");
        file_put_contents("data/$from_id/ali.txt","none");
        $myfile2 = fopen("Member.txt", "a") or die("Unable to open file!");
        fwrite($myfile2, "$from_id\n");
        fclose($myfile2);
    }
    
        sendAction($chat_id, 'typing');
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• مرحبا بك في بوت 💭 عمل ويب هوك وحذف 🌙 ويب هوك بلأضافه الى 📃 استخراج معلومات التوكن ☑️ •",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"عمل ويب هوك 🔧"],['text'=>"معلومات التوكن📝"]],
	[['text'=>"حذف ويب هوك 💧"]]
	]
	])
	]);
	}
elseif($text == "العودة 🔁"){
file_put_contents("data/$from_id/ali.txt","no");
file_put_contents("data/$from_id/token.txt","no");
file_put_contents("data/$from_id/url.txt","no");
        sendAction($chat_id, 'typing');
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"• تم الرجوع 💧 الى القائمههہ ☄ الرئيسيةه :-",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"عمل ويب هوك 🔧"],['text'=>"معلومات التوكن 📝"]],
	[['text'=>"حذف ويب هوك 💧"]]
	]
	])
	]);
	}
//===================〇ᙢᗩᖇ ᕼᗩᔕᕼᙢ===============//
elseif($text == "عمل ويب هوك 🔧"){
     sendAction($chat_id, 'typing');
			file_put_contents("data/$from_id/ali.txt","to");
				bot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"• حسنآ عزيزي ⚡️ قم بارسال التوكن الان 📊 •",
                 'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[
	['text'=>"العودة 🔁"]
	],
	]
	])
	]);
	}
elseif($ali == "to"){
$token = $text;

    $ali1 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
    $ali2 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getme"));
        //==================
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["result"]["url"];
    $ok2 = $tik2["ok"];
    $tik1 = objectToArrays($ali2);
    $un = $tik1["result"]["username"];
    $fr = $tik1["result"]["first_name"];
    $id = $tik1["result"]["id"];
    $ok = $tik1["ok"];
    if ($ok != 1) {
        //Token Not True
        SendMessage($chat_id, "");
    } else{
    file_put_contents("data/$from_id/ali.txt","url");
    file_put_contents("data/$from_id/token.txt",$text);
	SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>" حسنا عزيزي 🔬 الان قم بارسال 🔖 رابط الملف 🕸",
  ]);
}
}
elseif($ali == "url"){
if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$text))
  {
  SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"هناك خطاء رسائل متعددة 🚫",
  ]);
 }
 else {
 file_put_contents("data/$from_id/ali.txt","no");
 file_put_contents("data/$from_id/url.txt",$text);
 	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"• انتظر قليلا 📡 من فضلك 🍥 •",
  ]);
  sleep(1);
   	bot('editmessagetext',[
    'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
    'text'=>"• انتظر قليلا ⚡️ جار العمل ⚙ •",
  ]);
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
    'text'=>"• هل انت متاكد 💧 من عمل الويب هوك 🍥 •
    
• توكن البوت 📢 •
    $to
• رابط الملف 🖱 •
    $text
    
• الان ارسل امر ⚡️ •
    /setwebhook",
  ]);
 }
}
elseif($text == "/setwebhook" ){
if($to != "no"){
 	 	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"• انتظر قليلا 📡 من فضلك 🍥 •",
  ]);
  sleep(1);
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
      'text'=>"• انتظر قليلا 📡 من فضلك 🍥 •",
  ]);
  file_get_contents("https://api.telegram.org/bot$to/setwebhook?url=$url");
    sleep(1);
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
      'text'=>"• انتظر قليلا ⚡️ جار العمل ⚙ •",
  ]);
  sleep(1);
  file_put_contents("data/$from_id/ali.txt","no");
	bot('sendmessage',[
	'chat_id'=>$chat_id,
		    'message_id'=>$message_id + 1,
	'text'=>"• تم عمل الويب ⚡️ هوك بنجاح !! 🗒 •",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"عمل ويب هوك 💎"],['text'=>" معلومات التوكن 📝"]],
	[['text'=>"حذف ويب هوك 💧"]]
	]
	])
	]);
}

}
/////--------
elseif($text == "معلومات التوكن 📝" ){
    file_put_contents("data/$from_id/ali.txt","token");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"• حسنآ عزيزي ⚡️ قم بارسال التوكن الان 📊 •",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'العودة 🔁']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "token"){
$token = $text;

    $ali1 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
    $ali2 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getme"));
        //==================
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["result"]["url"];
    $ok2 = $tik2["ok"];
    $tik1 = objectToArrays($ali2);
    $un = $tik1["result"]["username"];
    $fr = $tik1["result"]["first_name"];
    $id = $tik1["result"]["id"];
    $ok = $tik1["ok"];
    if ($ok != 1) {
        //Token Not True
        SendMessage($chat_id, "لقد ارسلت التوكن بشكل غير صحيح 
.! الرجاء ارسال التوكن بشكل صحيح 📬");
    } else{
    file_put_contents("data/$from_id/ali.txt","no");
    
	SendAction($chat_id,'typing');
 	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"• انتظر قليلا 📡 من فضلك 🍥 •",
  ]);
  sleep(1);
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
    'text'=>"• معلومات 📬 التوكن هي 💬 •

• معرف البوت 💭 • @$un
• ايدي البوت 🔖 • $id
• اسم البوت 🌙 • $fr
• رابط الملف 💧•
$ur
",
  ]);
}
}
elseif($text == "حذف ويب هوك 💧" ){
    file_put_contents("data/$from_id/ali.txt","del");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"• حسنآ عزيزي ⚡️ قم بارسال التوكن الان 📊 •",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'العودة 🔁']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "del"){
$token = $text;

    $ali1 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
    $ali2 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getme"));
        //==================
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["result"]["url"];
    $ok2 = $tik2["ok"];
    $tik1 = objectToArrays($ali2);
    $un = $tik1["result"]["username"];
    $fr = $tik1["result"]["first_name"];
    $id = $tik1["result"]["id"];
    $ok = $tik1["ok"];
    if ($ok != 1) {
        //Token Not True
        SendMessage($chat_id, "لقد ارسلت التوكن بشكل غير صحيح 
.! الرجاء ارسال التوكن بشكل صحيح 📬");
    } else{
    file_put_contents("data/$from_id/ali.txt","no");
    
	SendAction($chat_id,'typing');
 	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"• انتظر قليلا 📡 من فضلك 🍥 •",
  ]);
  sleep(1);
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
    'text'=>"• انتظر قليلا ⚡️ جار الحذف ⚙ •",
  ]);
}
file_get_contents("https://api.telegram.org/bot$text/deletewebhook");
sleep(1);
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
    'text'=>"• تم حذف الويب ⚡️ هوك بنجاح !! 🗒 •",
  ]);
  sleep(1);
  file_put_contents("data/$from_id/ali.txt","no");
	bot('sendmessage',[
	'chat_id'=>$chat_id,
		    'message_id'=>$message_id + 1,
	'text'=>"• تم الرجوع 💧 الى القائمههہ ☄ الرئيسيةه :-",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"عمل ويب هوك🔧"],['text'=>"معلومات التوكن 📝"]],
	[['text'=>"حذف ويب هوك 💧"]]
	]
	])
	]);
}
//===============hamdy ahmed ‏ ⌯┆-‏𖤍===============//
elseif($text == "/panel" && $chat_id == $ADMIN){
sendaction($chat_id, typing);
        bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"اعزيزي المشرف، مرحبا بك في لوحة مشرف الروبوت 🌿",
                'parse_mode'=>'html',
      'reply_markup'=>json_encode([
            'keyboard'=>[
              [
              ['text'=>"عدد اعضاء البوت  👬"],['text'=>"رسالة للمشتركين 📄"],['text'=>"توجيه للمشتركين 💎"]
              ]
              ],'resize_keyboard'=>true
        ])
            ]);
        }
elseif($text == "عدد اعضاء البوت 👬" && $chat_id == $ADMIN){
	sendaction($chat_id,'typing');
    $user = file_get_contents("Member.txt");
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
	sendmessage($chat_id , " عدد الاعضاء البوت : $member_count" , "html");
}
elseif($text == "رسالة للمشتركين 📄" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/ali.txt","send");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"ارسل الرسالة التي تريد ارسالها بتنسيق نصي 📝",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'/panel']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "send" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/ali.txt","no");
	SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"تم إرسال رسالة عامة 🎉",
  ]);
	$all_member = fopen( "Member.txt", "r");
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			SendMessage($user,$text,"html");
		}
}
elseif($text == "توجيه للمشتركين 💎" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/ali.txt","fwd");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"نشر توجيهك 👣",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'/panel']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "fwd" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/ali.txt","no");
	SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"استمرار 🍁",
  ]);
$forp = fopen( "Member.txt", 'r'); 
while( !feof( $forp)) { 
$fakar = fgets( $forp); 
Forward($fakar, $chat_id,$message_id); 
  } 
   bot('sendMessage',[ 
   'chat_id'=>$chat_id, 
   'text'=>"تم نشر توجيهك بنجاح 🌟", 
   ]);
}
//===============hamdy ahmed ‏ ⌯┆-‏𖤍================//
?>
