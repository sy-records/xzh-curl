<?php
/**
 * @authors ShenYan (52o@qq52o.cn)
 * @date    2018-11-26 14:58:49
 * @boke    https://qq52o.me
 */

// 获取验证secret和url 增加权限判断 防止泄露
$getSecret = isset($_REQUEST['secret']) ? $_REQUEST['secret'] : '';
$getUrl = isset($_REQUEST['url']) ? $_REQUEST['url'] : '';

// 验证secret
$secret = '';

// 如果都为空 返回404
if (!$getSecret || !$getUrl) {
	return http_response_code(404);
}

// 验证失败 返回403
if ($getSecret != $secret) {
	return http_response_code(403);
}

// 配置 appid
$appid = '';

// 配置 token
$token = '';

if (!$appid) {
	echo '请配置: appid ^_^';
	exit;
}

if (!$token) {
	echo '请配置: token ^_^';
	exit;
}

// api接口
$api = 'http://data.zz.baidu.com/urls?appid=' . $appid . '&token=' . $token . '&type=newgood';

$ch = curl_init();
$options = array(
	CURLOPT_URL => $api,
	CURLOPT_POST => true,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POSTFIELDS => implode("\n", $getUrl),
	CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
if (!$result) {
	echo '请重试, ^_^';
	exit;
}

echo $result;
