<?php
set_time_limit(0);

//url，默认使用上一次的
$url_file = dirname(__FILE__)."/url";
if(!empty($_POST['url'])){
	file_put_contents($url_file, $_POST['url']);
}
$url = file_get_contents($url_file);

//url，默认使用上一次的
$fields_file = dirname(__FILE__)."/fields";
if(!empty($_POST['fields'])){
	file_put_contents($fields_file, $_POST['fields']);
}
$fields = file_get_contents($fields_file);

//cookie，默认使用上一次的
$cookie_file = dirname(__FILE__)."/cookies";
if(!empty($_POST['cookies'])){
	file_put_contents($cookie_file, $_POST['cookies']);
}
$cookie = file_get_contents($cookie_file);

$type = $_POST['type'];
$origin = $_POST['origin'];
$referer = $_POST['referer'];

$header = array(
        "accept: */*",
        "accept-encoding: gzip, deflate",
        "accept-language: zh-CN,zh;q=0.8,en;q=0.6,zh-TW;q=0.4,ja;q=0.2",
        "cache-control: no-cache",
        "connection: keep-alive",
        "content-type: application/x-www-form-urlencoded",
        "origin: ".$origin,
        "pragma: no-cache",
        "referer: ".$referer,
        "user-agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36",
        "x-requested-with: XMLHttpRequest"
    );

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_POSTFIELDS => $fields,
	CURLOPT_COOKIE => $cookie,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 60,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $type,
    CURLOPT_HTTPHEADER => $header,
));

$response = curl_exec($curl);
$err = curl_error($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
echo $response;
?>