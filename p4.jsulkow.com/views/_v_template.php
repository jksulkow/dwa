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
		
		<span id='menu'>
	
		<!--Menu for users who are logged in -->
		<? if($user): ?>
			
			<a href='/users/logout'>Logout</a>

			<a href='/gifts/'>View My List</a>
			<a href='/gifts/addrecipient/'>Add A Recipient</a>
			
		
		<!-- Menu options for users who are not logged in -->	
		<? else: ?>
		
			<a href='/users/signup'>Sign up</a>
			<a href='/users/login'>Log in</a>
		
		<? endif; ?>
		</span>
		</div>
	</div>

	
	<br>

	<?=$content;?>


</body>
</html>