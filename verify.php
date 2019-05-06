<?php
$access_token = 'd+BUUybaRpjRGOvx3PrIITg6h0nvnVO1uUaUNSCCfE++0qghRMeJ4HncYjoZuUgKYJH6FTRlxQNBh5wC9rfE/IkSwYnhCvFYIWZMr+TG+YipmVZz0D48i5AIgUa+66ErowEUCTd1qlNzw2zwOsjIFwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
