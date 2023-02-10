<?php
	include_once('./base.php');

	if (!$is_admin) {
		to('/');
		exit;
	}

	$do = $_GET['do'] ?? 'main';
	$do = file_exists('./back/' . $do . '.php') ? $do : 'main';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>健康促進網</title>
	<link href="./home_files/css.css" rel="stylesheet" type="text/css">
	<script src="./home_files/jquery-1.9.1.min.js"></script>
	<script src="./home_files/js.js"></script>
</head>

<body>
	<div id="alerr" style="background:rgba(51,51,51,0.8); color:#FFF; min-height:100px; width:300px; position:fixed; display:none; z-index:9999; overflow:auto;">
		<pre id="ssaa"></pre>
	</div>
	<div id="all">
		<div id="title">
			<?= date("m 月 d 號 l") ?> | 今日瀏覽: <?= $today_total ?> | 累積瀏覽: <?= $total ?>
			<a href="/" style="float: right;">回首頁</a>
		</div>
		<div id="title2">
			<img src="./home_files/02B01.jpg" alt="健康促進網－回首頁">
		</div>
		<div id="mm">
			<div class="hal" id="lef">
				<a class="blo" href="/back.php?do=user">帳號管理</a>
				<a class="blo" href="/back.php?do=po">分類網誌</a>
				<a class="blo" href="/back.php?do=news">最新文章管理</a>
				<a class="blo" href="/back.php?do=know">講座訊息</a>
				<a class="blo" href="/back.php?do=que">問卷調查</a>
			</div>
			<div class="hal" id="main">
				<div>
					<marquee behavior="" direction="left" style="width: 80%;">
						請民眾踴躍投稿電子報，讓電子報成為大家相互交流、分享的園地！詳見最新文章
					</marquee>
					<span style="width:18%; display:inline-block;">
						<?php if($is_login): ?>
							歡迎，<?= $user ?>
							<a href="/back.php">管理</a>|
							<a href="/api/logout.php">登出</a>
						<?php else: ?>
							<a href="?do=login">會員登入</a>
						<?php endif ?>
					</span>
				</div>
				<div class="content">
					<?php require_once('./back/' . $do . '.php') ?>
				</div>
			</div>
		</div>
		<div id="bottom">
		<div style="text-align: center;">本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © 2023健康促進網社群平台 All Right Reserved</div>
			服務信箱：health@test.labor.gov.tw<img src="./home_files/02B02.jpg" width="45">
		</div>
	</div>

</body>

</html>