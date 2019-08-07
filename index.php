<?php
$hostname = "tmnserver1.dyndns.tv"; //ชื่อโฮสต์
$user = "bot"; //ชื่อผู้ใช้
$password = "series7"; //รหัสผ่าน
$dbname = "hispeed"; //ชื่อฐานข้อมูล
$tblname = "tblmember"; //ชื่อตาราง

// เริ่มติดต่อฐานข้อมูล
mysql_connect($hostname, $user, $password) or die("Error conect db");
// เลือกฐานข้อมูล
mysql_select_db($dbname) or die("Error connet db");
// คำสั่ง SQL และสั่งให้ทำงาน
	  $globals_test = @ini_get('register_globals');
	mysql_query("SET NAME utf8",$mysql_connect);
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");

if ( isset($globals_test) && empty($globals_test) ) {
   $types_to_register = array('GET', 'POST', 'COOKIE', 'SESSION', 'SERVER');
   foreach ($types_to_register as $type) {
      $arr = @${'_' . $type};
      if (@count($arr) > 0)
         extract($arr, EXTR_SKIP);
   }
}

?>
<?php header('HTTP/1.1 200 OK');?>
<?php
   $accessToken = "eoPjLHkuwSEop+ZSg2WD+2Bd8IzZ6GgCXvreQNFZtJVUatlve5vG/HpXMkGhwlc/YJH6FTRlxQNBh5wC9rfE/IkSwYnhCvFYIWZMr+TG+YjotcXzRLEysvjijtEBezB2G6qabt1oogcgrXvH8bwrTAdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า

   $content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);

   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";

   //รับข้อความจากผู้ใช้
   $message = $arrayJson['events'][0]['message']['text'];

   //รับ id ของผู้ใช้
   $id = $arrayJson['events'][0]['source']['userId'];

if($message<>""){
   $check = "SELECT * FROM tblmember  WHERE  MemberID = '$message'";
	$result = mysql_query($check) or die(mysql_error());
   $num=mysql_num_rows($result); 
   while($objResult = mysql_fetch_array($result)){

    if($num!=""){
		      if($objResult['MemberStatusID']=="00001"){
               $MemberStatusID="ปกติ";
            }elseif($objResult['MemberStatusID']=="00002"){
               $MemberStatusID="ตัดสาย";
            }elseif($objResult['MemberStatusID']=="00003"){
               $MemberStatusID="ยกเลิก";
            }elseif($objResult['MemberStatusID']=="00004"){
               $MemberStatusID="VIP";
            }elseif($objResult['MemberStatusID']=="00005"){
               $MemberStatusID="สวัสดิการ พนักงาน";
            }elseif($objResult['MemberStatusID']=="00006"){
               $MemberStatusID="รอตัดสาย";
            }elseif($objResult['MemberStatusID']=="00007"){
               $MemberStatusID="บล็อคสัญญาณชั่วคราว";
            }
		
            $putmessage= "TMN ตรวจสอบแล้วพบข้อมูล  "."\n"."\n".$message."\n"."แพ็คเก็จ:"."\n".$objResult['Fax2']."\n"."\n"."USER: "."\n".$objResult['Email1']."\n"."\n"."สถานะ: "."\n".$MemberStatusID."\n"."\n"."ราคา: "."\n".$objResult['ValueRate']."";
            $arrayPostData['to'] = $id;
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = $putmessage;
            pushMsg($arrayHeader,$arrayPostData);		 
    
   }
}


$check1 = "SELECT * FROM tblmember  WHERE  MemberID = '$message'";
$result1 = mysql_query($check1) or die(mysql_error());
$num1=mysql_num_rows($result); 

if ($num1 == "") {
   $putmessage= "TMN ตรวจสอบแล้วไม่พบข้อมูล :".""."$message"; 
   $arrayPostData['to'] = $id;
   $arrayPostData['messages'][0]['type'] = "text";
   $arrayPostData['messages'][0]['text'] = $putmessage;
   pushMsg($arrayHeader,$arrayPostData);
}
}

   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }

   
   exit;
?>
echo "OK TMN CABLE TV";

