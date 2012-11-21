<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!--<link rel="stylesheet" type="text/css" href="/css/applicationstyle.css" />-->
	
	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
				
	<!-- Controller Specific JS/CSS -->
	<?=@$client_files; ?>
	
</head>

<body>
	
	<!-- <div class="titlebar">-->
	<!--	<div class="raventitle">Raven-->
	<!---->
	<!--	<span id='menu'>-->
	<!---->
	<!--	<!-- Menu for users who are logged in -->-->
	<!--	<? if($user): ?>-->
	<!--		-->
	<!--		<a href='/users/logout'>Logout</a>-->
	<!--		<a href='/posts/users'>Follow/Find People</a>-->
	<!--		<a href='/posts/'>View posts</a>-->
	<!--		<a href='/posts/add'>Add a new post</a>-->
	<!--		<a href='/users/profile'>View My Profile</a>-->
	<!--		<a href='/users/editProfile'>Edit My Profile</a>-->
	<!--	-->
	<!--	<!-- Menu options for users who are not logged in -->	-->
	<!--	<? else: ?>-->
	<!--	-->
	<!--		<a href='/users/signup'>Sign up</a>-->
	<!--		<a href='/users/login'>Log in</a>-->
	<!--	-->
	<!--	<? endif; ?>-->
	<!--	</span>-->
	<!--	</div>-->
	<!--</div>-->
	<!--<div class="leftside">-->
	<!--	<img src= "/images/raven.jpg" alt="raven"/>-->
	<!--</div>-->
	<!---->
	<!--<br>-->

	<?=$content;?>


</body>
</html>