<?php //include ('connect.php');?>
<?php
$access_token = 'o4fb8viqFsb84FTpnYD7PDfjg+LuY7G/l+p/4o9aqRR/mH7ejXySBfTX5ejdftWxYJH6FTRlxQNBh5wC9rfE/IkSwYnhCvFYIWZMr+TG+Yj4eCPkFQKZnyDMu6YiYGTv9xRS3bYw7/OBbvXqZl3xmwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
 // Loop through each event
 foreach ($events['events'] as $event) {
  // Reply only when message sent is in 'text' format
  if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
   // Get text sent
   $text = $event['message']['text'];
   // Get replyToken
   $replyToken = $event['replyToken'];
   $sql= "SELECT * FROM member WHERE $text='Username'";
   $dbquery = mysql_db_query($dbname,$sql)or die("Error");
   
  // $textOutput = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');

   // Build message to reply back
   $messages = [
    'type' => 'text',
    'text' => 'xxxx'
    //'text' => $textOutput[$text]
   ];

   // Make a POST Request to Messaging API to reply to sender
   $url = 'https://api.line.me/v2/bot/message/reply';
   $data = [
    'replyToken' => $replyToken,
    'messages' => [$messages],
   ];
   $post = json_encode($data);
   $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   $result = curl_exec($ch);
   curl_close($ch);

   echo $result . "\r\n";
  }
 }
}
echo "TMN";
