<?php
set_time_limit(0);
date_default_timezone_set('PRC');
$url = 'http://info.z.qq.com/infocenter_v2.jsp?B_UID=7....'; //这里换成你登录后3g空间的网址

while(true) {
	$result = '';

	//获取空间内容
	$content = file_get_contents($url);
	$pattern = '{赞\(\d+\)}';
	preg_match_all($pattern, $content, $matchs);
	sleep(5);

	//点赞
	foreach ($matchs[1] as $val) {
		$tmp = file_get_contents(htmlspecialchars_decode($val));
		if (mb_strstr($tmp, '成功')) {
			$result = ' 有新的动态　　点赞成功';
		} else {
			$result = ' 有新的动态　　点赞失败';
		}
		sleep(5);
	}

	$log = 'time: ' . date('Y-m-d H:i:s') . ' count: ' . count($matchs[1]) . $result . PHP_EOL;
	file_put_contents('log.ini', $log, FILE_APPEND);
}
?>
