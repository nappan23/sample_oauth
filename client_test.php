<?php

require 'vendor/autoload.php';
set_include_path(get_include_path().PATH_SEPARATOR.'./pear');

try {
	// 認証
	$consumer_key = 'key';
        $consumer_secret = 'secret';
	$consumer = new HTTP_OAuth_Consumer($consumer_key, $consumer_secret);

	$http_request = new HTTP_Request2();
	$consumer_request = new HTTP_OAuth_Consumer_Request;
	$consumer_request->accept($http_request);
	$consumer->accept($consumer_request);

	$consumer->getRequestToken('http://term.ie/oauth/example/request_token.php');
	$_SESSION['access_token'] = $consumer->getToken();
	$_SESSION['access_token_secret'] = $consumer->getTokenSecret();

        $consumer->getAccessToken('http://term.ie/oauth/example/access_token.php');

	$_SESSION['access_token'] = $consumer->getToken();
	$_SESSION['access_token_secret'] = $consumer->getTokenSecret();

	print_r($_SESSION);

	// キャンディデイト登録
	$param = array('candidate_name' => 'テスト太郎');
	$consumer->sendRequest('http://term.ie/oauth/example/echo_api.php', $param);
	$response = $consumer->getLastResponse();
	print_r($response);

} catch(Exception $e) {
	print_r($e);
}
