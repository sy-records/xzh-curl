<?php
/**
 * @authors ShenYan (52o@qq52o.cn)
 * @date    2018-11-26 13:35:41
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

// 配置信息见：https://ziyuan.baidu.com/xzh/home/index

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

$html = file_get_contents($getUrl);

$dom = new DOMDocument();
// 从一个字符串加载HTML
@$dom->loadHTML($html);
// 使该HTML规范化
$dom->normalize();

// 用DOMXpath加载DOM，用于查询
$xpath = new DOMXPath($dom);
// 获取对应的xpath数据
$hrefs = $xpath->query("//script[@type='application/ld+json']/text()");
for ($i = 0; $i < $hrefs->length; $i++) {
	$href = $hrefs->item($i);
	$json = $href->nodeValue;
}

// api接口
$api = 'http://data.zz.baidu.com/ping?appid=' . $appid . '&token=' . $token . '&type=xzhome';

$ch = curl_init();
$options = array(
	CURLOPT_URL => $api,
	CURLOPT_POST => true,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POSTFIELDS => $json,
	CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
if (!$result) {
	echo '请重试, ^_^';
	exit;
}

print_r($result);
