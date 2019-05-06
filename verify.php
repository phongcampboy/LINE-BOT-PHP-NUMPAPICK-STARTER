<?php
$access_token = 'o4fb8viqFsb84FTpnYD7PDfjg+LuY7G/l+p/4o9aqRR/mH7ejXySBfTX5ejdftWxYJH6FTRlxQNBh5wC9rfE/IkSwYnhCvFYIWZMr+TG+Yj4eCPkFQKZnyDMu6YiYGTv9xRS3bYw7/OBbvXqZl3xmwdB04t89/1O/w1cDnyilFU=
';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
