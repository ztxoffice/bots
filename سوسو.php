<?php
/*
DEV: @hadminztx
CH : @sourcehamdy

*/
ob_start();
$API_KEY = "1185216447:AAGtk36jey4YIbTyY7H2g-BmsJfE3fKkI1o";
define('API_KEY',$API_KEY);
echo "https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME'];
  
define('NO', '❌');
define('YES', '✅');
define('API_KEY', $API_KEY);
#                    sourcehamdy                      #
function Antar($method,$datas=[]){
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
#                     sourcehamdy                      #
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$message_id = $message->message_id;
$reply = $message->reply_to_message;
$user = '@'.$message->from->username;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$get = json_decode(file_get_contents('data.json'),true);
if($user == null){
	$user = $message->from->first_name;
}
$userid = $message->from->id;
$GLOBALS['id'] = $chat_id;
$get = file_get_contents("https://api.telegram.org/bot$API_KEY/getChatMember?chat_id=$chat_id&user_id=".$userid);
$info = json_decode($get, true);
$you = $info['result']['status'];
#                     sourcehamdy                      #
function lock($media,$type = 'del'){
    $id = $GLOBALS['id'];
    $get = json_decode(file_get_contents('data.json'),true);
    if ($type == 'del') {
        $get[$id][$media]['del'] = NO;
        $get[$id][$media]['ban'] = YES;
        $get[$id][$media]['warn'] = YES;
    }
    if ($type == 'ban') {
        $get[$id][$media]['del'] = YES;
        $get[$id][$media]['ban'] = NO;
        $get[$id][$media]['warn'] = YES;
    }
    if ($type == 'warn') {
        $get[$id][$media]['del'] = YES;
        $get[$id][$media]['ban'] = YES;
        $get[$id][$media]['warn'] = NO;
    }
    file_put_contents('data.json', json_encode($get));
}
function open($media){
    $id = $GLOBALS['id'];
    $get = json_decode(file_get_contents('data.json'),true);
    $get[$id][$media]['del'] = YES;
    $get[$id][$media]['ban'] = YES;
    $get[$id][$media]['warn'] = YES;
    file_put_contents('data.json', json_encode($get));
}
function check($media){
    $id = $GLOBALS['id'];
    $get = json_decode(file_get_contents('data.json'),true);
    foreach ($get[$id][$media] as $key => $value) {
        if ($get[$id][$media][$key] == NO) {
            return $key;
        }
    }
}
#                     sourcehamdy                      #

if($text == '/start') {
    Antar('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"📩￤اهلا عزيزي :- $name  
▪️￤مرحبا بك في بوت الحماية
🔘￤قم باضافت البوت وارفعه ادمن وسيتم التفعيل :) 🤖
-↭",
'reply_to_message_id'=>$mid,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [['text'=>"اضفني الى المجموعهh&m⚜️",'url'=>"t.me/Sixty6bot?startgroup=new"]],
        [['text'=>"~ تابعh&m-⚜️", 'url'=>"t.me/sourcehamdy"]]
    ]

  ])
  ]);
}
// بدايه القفل والفتح
if ($you == "creator" or $you == "administrator") {
    if($text == 'تفعيل الترحيب'){
    		
    	 Antar('sendmessage',[
              'chat_id'=>$chat_id,                   'text'=>" • تم تفعيل الترحيب - ✅
- الترحيب الحالي : ".$get[$chat_id]['wel']
                    ]);
                    $get[$chat_id]['_wel'] = true; 	file_put_contents('data.json',json_encode($get));
    }
    if($text == 'تعطيل الترحيب'){
    		
    	 Antar('sendmessage',[
              'chat_id'=>$chat_id,                   'text'=>" • تم تعطيل الترحيب - ".NO."
- الترحيب الحالي : ".$get[$chat_id]['wel']
                    ]);
                    $get[$chat_id]['_wel'] = false; 	file_put_contents('data.json',json_encode($get));
    }
    if($reply and $text == 'طرد' or $text == 'حظر'){
	Antar('kickchatmember',[
		'chat_id'=>$chat_id,
		'user_id'=>$reply->from->id
	]);
	Antar('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=>"
    العضو :h&m-⚜️  ⇚〈   @".$reply->from->username."  〉
 { <h&m تم الحظرh&m > } 

    ",
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		
		]
		])
	]);
}
  
    if($reply and $text == 'طرد' or $text == 'حظر'){
	Antar('unbanchatmember',[
		'chat_id'=>$chat_id2,
		'user_id'=>$data
	]);
	Antar('editmessagetext',[
		'chat_id'=>$chat_id2,
		'text'=>"
العضو :h&m-⚜️  ⇚〈   @".$reply->from->username."  〉
 { <h&m تم الغاء حظرh&m > } 

    ",
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		
		]
		])
	]);
}
  
if($reply and $text == 'تثبيت'){
	Antar('pinchatmessage',[
		'chat_id'=>$chat_id,
		'message_id'=>$reply->message_id
	]);
}
if($reply and $text == 'الغاء التثبيت'){
	Antar('unpinchatmessage',[
		'chat_id'=>$chat_id,
		'message_id'=>$reply->message_id
	]);
}
if(preg_match('/ضع اسم .*/',$text)){
	$text = str_replace('ضع اسم ','',$text);
	Antar('setchattitle',[
		'chat_id'=>$chat_id,
		'title'=>$text
	]);
}



    if (preg_match('/(قفل)(.*)(.*)/', $text)) {
        $text = trim(str_replace('قفل', '', $text));
        $text = explode(' ', $text);
        if (isset($text[0])) {
            if ($text[0] == 'الصور' or $text[0] == 'الفيديو' or $text[0] == 'التسجيلات' or $text[0] == 'الموسيقى' or $text[0] == 'المتحركه' or $text[0] == 'الروابط' or $text[0] == 'الجهات' or $text[0] == 'الملفات' or $text[0] == 'الماركداون' or $text[0] == 'التوجيه' or $text[0] == 'البوتات' or $text[0] == 'الملصقات' or $text[0] == 'المعرف' or $text[0] == 'البوتات' and $text[1] == 'بالحذف' or $text[1] == 'بالطرد' or $text[1] == 'بالتحذير'){
                switch ($text[0]) {
                    case 'الصور':$m = 'photo';break;
                    case 'الفيديو':$m = 'video';break;
                    case 'التسجيلات':$m = 'voice';break;
                    case 'الموسيقى':$m = 'audio';break;
                    case 'المتحركه':$m = 'gif';break;
                    case 'الروابط':$m = 'link';break;
                    case 'الجهات':$m = 'contact';break;
                    case 'الملفات':$m = 'doc';break;
                    case 'الماركداون':$m = 'mark';break;
                    case 'التوجيه':$m = 'fwd';break;
                    case 'الملصقات':$m = 'sticker';break;
                    case 'المعرف':$m = 'user';break;
                    case 'البوتات':$m='bots';break;
                           if($text[1] == null){
              	$text[1] = 'بالحذف';
              }
                }
                switch ($text[1]) {
                    case 'بالحذف':$t='del';break;
                    case 'بالطرد':$t='ban';break;
                    case 'بالتحذير':$t='warn';break;
                    default:
                        $t='del';
                        break;
                }
      
                lock($m,$t);
                Antar('sendmessage',[
                    'chat_id'=>$chat_id,
                    'text'=>"
                    ـ تــم قــفل 🔐 ⇚〈 $text[0]  〉
 { <h&m خاصية : $text[1]h&m > } 
                    "
                ]);
            }
        }
    }
    #                     Antar                       #
    if (preg_match('/(فتح)(.*)(.*)/', $text)) {
        $text = trim(str_replace('فتح', '', $text));
        $text = explode(' ', $text);
        if (isset($text[0])) {
            if ($text[0] == 'الصور' or $text[0] == 'الفيديو' or $text[0] == 'التسجيلات' or $text[0] == 'الموسيقى' or $text[0] == 'المتحركه' or $text[0] == 'الروابط' or $text[0] == 'الجهات' or $text[0] == 'الملفات' or $text[0] == 'الماركداون' or $text[0] == 'التوجيه' or $text[0] == 'الملصقات' or $text[0] == 'المعرف' or $text[0] == 'البوتات'){
                switch ($text[0]) {
                    case 'الصور':$m = 'photo';break;
                    case 'الفيديو':$m = 'video';break;
                    case 'التسجيلات':$m = 'voice';break;
                    case 'الموسيقى':$m = 'audio';break;
                    case 'المتحركه':$m = 'gif';break;
                    case 'الروابط':$m = 'link';break;
                    case 'الجهات':$m = 'contact';break;
                    case 'الملفات':$m = 'doc';break;
                    case 'الماركداون':$m = 'mark';break;
                    case 'التوجيه':$m = 'fwd';break;
                    case 'الملصقات':$m = 'sticker';break;
                    case 'المعرف':$m = 'user';break;
                    case 'البوتات':$m='bots';break;
                }
                open($m);
               switch(check($m)){
               	case 'del':$t='بالحذف';
               	case 'warn':$t='بالتحذير';
               	case 'ban':$t='بالطرد';
               	default:$t='بالحذف';
               } Antar('sendmessage',[
                    'chat_id'=>$chat_id,
                    'text'=>"
                    تم فتحh&m-⚜️  ⇚〈 $text[0]  〉
 { <h&m خاصية : $th&m > } 
                    "
                ]);
            }
        }
    }
    
}
// نهايه القفل والفتح
if ($you != "creator" and $you != "administrator") {
    if($message->photo){    #                     Antar                       #
        if (check('photo') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('photo') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"• ممنوع ارسال الصور #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('photo') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->video){
        if (check('video') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('video') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال فيديو #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('video') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->contact){
        if (check('contact') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('contact') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الجهات #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('contact') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->sticker){
        if (check('sticker') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('sticker') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الملصقات #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('sticker') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->forward_from or $message->forward_from_chat){
        if (check('fwd') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('fwd') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال التوجيه #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('fwd') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->document){
        if (check('doc') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('doc') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الملفات #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('doc') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if(preg_match('/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me|(.*)telesco.me|telesco.me(.*)/i',$text)){
        if (check('link') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('link') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الروابط #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('link') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->new_chat_member->is_bot == true){
        if (check('bots') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$ $message->new_chat_member->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('bots') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع اضافه البوتات #:  ".$user." - ".NO
            ]);
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$ $message->new_chat_member->id
                ]);
        }
        if (check('bots') == 'del') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$ $message->new_chat_member->id
                ]);
        }
    }
    if($message->entities){
        if (check('mark') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('mark') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الماركدوان #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('mark') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if(preg_match('/^(.*) | (.*)|(.*) (.*)|(.*)#(.*)|#(.*)|(.*)#/',$text)){
        if (check('user') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('user') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال المعرفات #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('user') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->voice){
        if (check('voice') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
        }
            Antar('deleteMessage',[
                'cthat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('voice') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال التسجيلات #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('voice') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->audio){
        if (check('audio') == 'ban') {
            Antar('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
        
        }
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('audio') == 'warn') {
            Antar('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الأغاني #:  ".$user." - ".NO
            ]);
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('audio') == 'del') {
            Antar('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);

}


if (preg_match("/\/bc .*/", $text) and $chat_id == 323823995) {
            $f = explode("\n", file_get_contents("users.txt"));
            $text = str_replace("/bc ", "", $text);
            for ($i=0; $i < count($f); $i++) { 
                Antar("sendMessage",[
                    "chat_id"=>$f[$i],
                    "text"=>$text
                ]);
            }
        }
        $f = explode("\n", file_get_contents("users.txt"));
        if ($update and !in_array($chat_id, $f)) {
            file_put_contents("users.txt", $chat_id."\n",FILE_APPEND);
        } 
        if ($text == "المجموعات" or $text == "/us" and $chat_id == 323823995) {
            Antar("sendMessage",[
                "chat_id"=>$chat_id,
                "text"=>count($f)
            ]);
        }

    $info = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@sourcehamdy&user_id=".$chat_id));
$per = $info->result->status;
if ($per == 'left') {
  Antar('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>" عليك الأشتراك في القناه لأستخدام اشترك في القناه @sourcehamdy"
  ]);
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id =$message->chat->id;
$time = time() + (979 * 11 + 1 + 30);
$ex = explode('قول',$text);
$sudo = 323823995;
$id_sudo = 323823995;
$id = $message->from->id; 
$getid = file_get_contents('ied.txt');
$exid = explode("\n", $getid);
$count = count($exid);
$sudo = 323823995;
$bc = explode("/bc", $text);
$user = $update->message->from->username;
$name = $update->message->from->first_name;
$last_name = $update->message->from->last_name;
$from_id = $update->message->from->id;
$message_id = $update->message->message_id;
$user_id = $update->message->from->user_id;
$sudo = 323823995;
$user_id = $message->from->id;
$name = $message->from->first_name;
$username = $message->from->username;

$sudo = 323823995;
$get = explode("\n", file_get_contents('memberbot.txt'));

$sudo == 323823995;
if($text == "رفع عضو مميز" and $id == $sudo){
Antar('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"العضو تم رفعه عضو مميز بنجاح😹✅",
'reply_to_message_id'=>$message_id
]);
}
if($text == "رفع عضو مميز" and $id != $sudo){
Antar('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"انت لست المطور⚙️
🔖اسمك:- $name
💳ايديك:- $from_id",
'reply_to_message_id'=>$message_id
]);
}

if($text == '/start' and !in_array($chat_id, $get)){
file_put_contents('users.txt',"\n" . $chat_id, FILE_APPEND);
}

if($text == '/start' and !in_array($chat_id, $get)){
file_put_contents('memberbot.txt',"\n" . $chat_id, FILE_APPEND);
}

if($text == 'بوتي' and $id == $sudo){
Antar('sendmessage',[
chat_id=>$chat_id,
'text'=>"هَــْـِْـْْـِلاّ مــْـِْـْْـِطــْـِْـْْـِوري"
]);
}

if($text == 'تفعيل' ){
Antar('sendmessage',[
chat_id=>$chat_id,
'text'=>"h&m-⚜️ تم تفعيل البوت بنجاح 

🔖اسمك:- $name 
💳ايديك:- $from_id"
]);
}

  $rep = $message->reply_to_message;
if(preg_match('/^(تاق)(.*)/',$text)){
 $text = str_replace('تاق للعضو  ','',$text);
 Antar('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"[$text](tg://user?id=".$rep->from->id.")",
 'parse_mode'=>'markdown'
 ]);
}

if($text == "م3"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"⚙️- اهلا بيك عزيزي $name في قائمة المدير🔹 
➖➖➖➖➖➖➖➖➖➖➖
📌معلوماتي ↭ لعرض معلوماتك الشخصيه

📌- ايدي القروب ↭ لعرض ايدي القروب

📌- قول+الكلمه

📌اضف+كلمة ↭ لاضافة رد عام
جواب الرد

📌- اسمي ↭ لعرض اسمك
➖➖➖➖➖➖➖➖➖➖➖
قناة البوت :@sourcehamdy
",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($rep && $text == "ايدي"){
Antar('sendmessage', [
'chat_id' => $chat_id,
'text' => "id = $re_id
name = $re_name
user = $re_user",
]);
}

include 'rd.php';
if (preg_match('/^(اضف)(.*)/', $text) ) {
  $rd = str_replace('اضف ', $rd, $text);
  $ex = explode("\n", $rd);

    $put = "\n".'
    if ($text == "'.$ex[0].'") {
      Antar(\'sendMessage\',[
        \'chat_id\'=>$chat_id,
        \'text\'=>"'.$ex[1].'"
      ]);
    }';
    file_put_contents('rd.php', $put,FILE_APPEND);
    Antar('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"تــم اضــافــة الـرد بـنـجـاح✅
بـواسـطـه $name",
'reply_to_message_id'=> $message_id,
                ]);
  
}

if($text== 'الاوامر'){
Antar('sendMessage',[
"chat_id"=>$chat_id,
'text'=>'اهلا بك عزيزي في قائمة الاوامر

〰〰〰〰〰〰〰〰
⚙️اوامر بوت الحمايه
 
🔘اوامر الحمايه🔹  م1

🔘 اوامر المنشئ &الادمن🔹 م 2

🔘اوامر اضافيه🔹  م3

‏‎🔘اوامر الاغاني🔹 م4
➖➖➖➖➖➖➖➖
قناة البوت :@sourcehamdy'
]);
}

if($text=="اسمي"){
Antar('sendmessage',[
'chat_id' => $chat_id,
'text'=>$name
]);
}
if($text == "م1"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"🔐 اليك اوامر حماية المجموعه 
〰〰〰〰〰〰〰〰〰〰〰
🔹 استخدم امر ( قفل ) للقفل 🔒•
🔹 استخدم امر ( فتح ) للفتح 🔓•

🔘اليك الاوامر الحمايه المتوفره -
➖➖➖➖➖➖➖➖➖➖➖
📌- الصور • 📷

📌- الفيديو • 📹

📌- الملصقات • 🎆

📌- الروابط • 🔗
️
📌- التوجيه • 🔀

📌- الجهات • 👥

📌- المعرف • #⃣

📌-  المتحركه • 🎞

📌- الملفات  • 🗂

📌- البوتات 🤖👾

📌- الموسيقى • 🎶
️
📌- التسجيلات 🔉 ؛ 

⚙️- كل الاوامر تعمل مع ( بالحذف ، بالطرد ، بالتحذير ) ؛ 🔱
مثل : قفل الروابط بالطرد 
➖➖➖➖➖➖➖➖➖➖➖ 
قناة البوت :@sourcehamdy
",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "م2"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"☑️• اليك الاوامر الاضافيه ✨ 
➖➖➖➖➖➖➖➖➖➖➖
🔘- هذه الاوامر متاحه للادمن والمنشئ 🔹

📍- طرد ( بالرد ) • ⚠️
📍- تثبيت ( بالرد ) • 🔰
📍- الغاء التثبيت • ❗️
📍- ضع اسم + الاسم • 📜
📍- ضع وصف + الوصف • 🗒
📍- ضع ترحيب + الترحيب • ?
📍- (تفعيل ، تعطيل) الترحيب • 📝
📍- الرابط • 
〰〰〰〰〰〰〰〰〰〰〰
قناة البوت :@sourcehamdy
",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text =="الوقت"){
Antar('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"h&m البلد : 🔥السودان \n" . "✨🔥  السنه  : " . date("Y") . "\n" . "🌟  الشهر🔥 : " . date("n") . "\n" . "💫  اليوم🔥 :" . date("j") . "\n" . "💏 الساعه🔥 :" . date('g', $time) . "\n" . "💋 الدقيقه🔥 :" . date('i', $time) . "\n" . " 😍",
'reply_to_message_id'=>$message->message_id
]);
}

if($text == "غني"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/4336",
 reply_to_message_id =>$message->message_id, 
]);
}

if($text == "هلا"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"هلا وغلا",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "قول والله"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"والله",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "1$"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"غـِْاليّے شديد",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "عايز بوت"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ضيفني وخليني ادمن ورسل كلمة تفعيل",
'reply_to_message_id'=>$message->message_id, 
]);
}


if($text== "ايدي القروب"){
Antar('sendMessage',[
"chat_id"=>$chat_id,
'text'=> 'هاذ ايدي القروب ' .$chat_id,
]);
}


if($text== "ايدي"){
Antar('sendMessage',[
"chat_id"=>$chat_id,
'text'=>'الايدي الخاص بك : ' .$chat_id,
]);
}

if($text == "لا"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ووجعا 😂",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "م4"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"اهلا بك عزيزي في قائمة الاغاني🔘
➖➖➖➖➖➖➖➖➖➖➖
📍الاغاني المتوفره م̷ـــِْن 1الى10 اغنيه🔹 
📌اكتب اغنيه+الرقم
مثال🔻
اغنيه1
او 
اغنيه7
وسوف ارسل ڵـڱ الاغنيه

〰〰〰〰〰〰〰〰
قناة البوت :@sourcehamdy
",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "اغنيه1"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2663",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه2"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2660",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == ""){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2657",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه3"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2656",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه4"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2652",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه5"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2643",
 reply_to_message_id =>$message->message_id, 
]);
}

if($text == "اغنيه6"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2643",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه7"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2638",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه8"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2638",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه9"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2631",
 reply_to_message_id =>$message->message_id, 
]);
}

if($text == "اغنيه10"){
Antar( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/Prog_SD/2626",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه11"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"كفاية ما تجيب شلف",
'reply_to_message_id'=>$message->message_id, 
]);
}

#--                              أو شوف نهاية الكود  لاضافة ردود لاتتحزف انسخ أحد الكودين وقم بكتابته                       --#

if($text == "هه" or $text =="ههه" or $text == "هههه" or $text =="ههههه" or $text=="هههههه"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"⌣{دِْۈۈۈۈ/يّارٌبْ_مـْو_يـّوّمٌ/ۈۈۈۈمْ}⌣",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "السلام عليكم"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"وعليكم السلام ورحمة الله وبركاته",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "المطور"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"@sourcehamdy",
'reply_to_message_id'=>$message->message_id, 
]);
}

$Antar = explode('قول',$text);
if($Antar){
Antar('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$Antar[1],
]);
}

$mid = $message->message_id;
$memb = $update->message->message_id;
$id = $message->from->id;
$us = $update->message->from->username;
if($text == "ايدي" and  $you == "creator"){
$get_progile = file_get_contents("https://api.telegram.org/bot$API_KEY/getUserProfilePhotos?user_id=$id&limit=1");
$json = json_decode($get_progile);
$user_photo = $json->result->photos[0][0]->file_id;

Antar('sendPhoto',[
'chat_id'=>$chat_id,
'photo'=>$user_photo,
'caption'=>"
🔸 • ايديك : $id
🔸 • معرفك : @$us
🔸 • موقعك ← منشئ تقيل 🙊💥
🔸 • رسائل المجموعه ← $memb ",
'reply_to_message_id'=>$mid,
]);
}
if($text == "ايدي" and  $you == "administrator"){
$get_progile = file_get_contents("https://api.telegram.org/bot$API_KEY/getUserProfilePhotos?user_id=$id&limit=1");
$json = json_decode($get_progile);
$user_photo = $json->result->photos[0][0]->file_id;

Antar('sendPhoto',[
'chat_id'=>$chat_id,
'photo'=>$user_photo,
'caption'=>"
🔸 • ايديك : $id
🔸 • معرفك : @$us
🔸 • موقعك ← ادمن كارب 😀🍂
🔸 • رسائل المجموعه ← $memb ",
'reply_to_message_id'=>$mid,
]);
}
if($text == "ايدي" and  $you == "member"){
$get_progile = file_get_contents("https://api.telegram.org/bot$API_KEY/getUserProfilePhotos?user_id=$id&limit=1");
$json = json_decode($get_progile);
$user_photo = $json->result->photos[0][0]->file_id;

Antar('sendPhoto',[
'chat_id'=>$chat_id,
'photo'=>$user_photo,
'caption'=>"
🔸 • ايديك : $id
🔸 • معرفك : @$us
🔸 • موقعك ← عضو مهتلف 😹❕
🔸 • رسائل المجموعه ← $memb ",
'reply_to_message_id'=>$mid,
]);
}

#--               موقع لاضافة ردود جديدة    --#
if($text == "بوت"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"أنا شغال يا راستا",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "تبادل"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"@sourcehamdy",
'reply_to_message_id'=>$message->message_id, 
]);
}
#--                     اضافة رد واحد لاكثر من كلمة             --#
if($text == "يلا مع السلامة"or $text== "جاوو"or $text=="باي"){
Antar('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"مع الف سلامة",
'reply_to_message_id'=>$message->message_id, 
]);
}
