<!DOCTYPE HTML>
<html>
	<head>
		<title>Instagram Feed Grabber</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<a href="index.html" class="logo">Instagram <strong>Feed Grabber</strong></a>
			</header>

		<!-- Nav -->
			
<?php
$access_token = "Your access token here";
$photo_count = 100;
$json_link = "https://api.instagram.com/v1/users/self/media/recent/?";
$json_link .="access_token={$access_token}&count={$photo_count}";
$json = file_get_contents($json_link);
$obj = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json), true);

$profilepic = $obj['data']['0']['user']['profile_picture'];
$profilename = $obj['data']['0']['user']['full_name'];
$username = $obj['data']['0']['user']['username'];
$profilelink = "https://www.instagram.com/{$username}/";
?>
		<!-- Banner -->
			<section id="banner">
			<!--banner css effect taken from https://gist.github.com/gottalovelattes/4ef338c9e2187c1c09c28a0c70fbcf0a-->
				<div class="inner">
					<!--h1>Grab your instagram feed in website using PHP <br> Follow me at <a href="https://wwww.instagram.com/prathm_._/">@prathm_._</a></h1-->
					<?php
					echo "<a href={$profilelink}><img src={$profilepic} style='border-radius: 50%;'></a>";
					echo "<h2> Follow me at <a href={$profilelink}>{$profilename}(@{$username})</a></h2>";
					echo "<h3><a href='https://github.com/PrathmeshPure'><i class='fa fa-code'></i>Get source code from my Github profile<i class='fa fa-code'></i></a></h3>";
					?>
					<ul class="actions">
						<li><a href="#one" class="button alt scrolly small">Continue</a></li>
					</ul>
				</div>
			</section>

			
<?php
foreach ($obj['data'] as $id => $post){
    $pic_text = $post['caption']['text'];
    $pic_link = $post['link'];
    $pic_like_count = $post['likes']['count'];
    $pic_comment_count=$post['comments']['count'];
    $pic_src=str_replace("http://", "https://", $post['images']['standard_resolution']['url']);    //low_resolution
    $pic_created_time=date("F j, Y", $post['caption']['created_time']);
    $pic_created_time=date("F j, Y", strtotime($pic_created_time . " +1 days"));
	if($id % 2 == 0){
    echo '
	<article id="one" class="post style1">';
	}
	else{
	echo '
	<article id="two" class="post invert style1 alt">';
	}
	echo '
		<div class="image">
			<img src='.$pic_src.' alt="" data-position="75% center" height="500" width="500" />
		</div>
		<div class="content">
			<div class="inner">
				<header>
					<h2><a href='.$pic_link.' target="_blank">See this post on instagram</a></h2>
					<p class="info"><i class="fa fa-heart"></i> '.$pic_like_count.' likes, <i class="fa fa-comment"></i> '.$pic_comment_count.' comments.<br>
						Posted on '.$pic_created_time.'</p>
				</header>
				<p>'.$pic_text.'</p>
			</div>
		</div>
	</article>';
}
?>
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="https://www.facebook.com/prathamesh.pure" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="https://www.instagram.com/prathm_._/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="https://github.com/PrathmeshPure" class="icon fa-github"><span class="label">Github</span></a></li>
				</ul>
				<!--
					Binary by TEMPLATED
					templated.co @templatedco
					Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
				-->
				<!--Untitled theme by TEMPLATED-->
				<!--Edited by Prathmesh Pure-->
				<div class="copyright">
					&copy; Copyrights are included in source.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
