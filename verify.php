<?php
$access_token = 'eoPjLHkuwSEop+ZSg2WD+2Bd8IzZ6GgCXvreQNFZtJVUatlve5vG/HpXMkGhwlc/YJH6FTRlxQNBh5wC9rfE/IkSwYnhCvFYIWZMr+TG+YjotcXzRLEysvjijtEBezB2G6qabt1oogcgrXvH8bwrTAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
