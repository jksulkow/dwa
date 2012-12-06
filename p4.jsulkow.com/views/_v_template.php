<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="/css/applicationstyle.css" />
	
	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
				
	<!-- Controller Specific JS/CSS -->
	<?=@$client_files; ?>
	
</head>

<body>
		<div id='logo'>
			<a href='/gifts/'><img src='/images/giftrlogo.png'></a>
		</div>
		<!--logo image created by Jonathan Sulkow-->
		
		<div id='menu'>
	
		<!--Menu for users who are logged in -->
		<? if($user): ?>
			
			<a href='/users/logout'>Logout</a>
			<a href='/gifts/'>View My Giftr</a>
			<a href='/gifts/addrecipient/'>Add A Giftee</a>
			<a href='/gifts/find_friends'>Find Friends</a>
		
		<!-- Menu options for users who are not logged in -->	
		<? else: ?>
		
			<a href='/users/signup'>Sign up</a>
			<a href='/users/login'>Log in</a>
			
		
		<? endif; ?>
		
		</div>


	<?=$content;?>


</body>
</html>