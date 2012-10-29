
 
 <div class="middle">

<form method='POST' action='/posts/p_follow'>
	
		<? foreach($users as $user): ?>
	
			<!-- Print this user's name -->
			<span class="username">	<?=$user['first_name']?> <?=$user['last_name']?>
	<!--end of username-->
	</span>
	
		<!-- If there exists a connection with this user, show a unfollow link -->
		<? if(isset($connections[$user['user_id']])): ?>
			<span class= "unfollow"><a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
			</span>
		<!-- Otherwise, show the follow link -->
		<? else: ?>
			<span class= "follow"><a href='/posts/follow/<?=$user['user_id']?>'>Follow</a></span>
		<? endif; ?>
	
		<br><br>
	
	<? endforeach; ?>
	
</form>

<!--end of middle div-->
</div>  
