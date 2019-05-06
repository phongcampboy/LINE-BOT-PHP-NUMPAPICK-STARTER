<?php 
	/*Get Data From POST Http Request*/
	$datas = file_get_contents('php://input');
	/*Decode Json From LINE Data Body*/
	$deCode = json_decode($datas,true);

	file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

	$replyToken = $deCode['events'][0]['replyToken'];

	$messages = [];
	$messages['replyToken'] = $replyToken;
	$messages['messages'][0] = getFormatTextMessage("เอ้ย ถามอะไรก็ตอบได้");

	$encodeJson = json_encode($messages);

	$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
  	$LINEDatas['token'] = "o4fb8viqFsb84FTpnYD7PDfjg+LuY7G/l+p/4o9aqRR/mH7ejXySBfTX5ejdftWxYJH6FTRlxQNBh5wC9rfE/IkSwYnhCvFYIWZMr+TG+Yj4eCPkFQKZnyDMu6YiYGTv9xRS3bYw7/OBbvXqZl3xmwdB04t89/1O/w1cDnyilFU=";

  	$results = sentMessage($encodeJson,$LINEDatas);

	/*Return HTTP Request 200*/
	http_response_code(200);

	echo $$replyToken;
