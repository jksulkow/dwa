

<div id="instructions1">
<h2>Have any friends using GIFTR?</h2>
If you "friend" someone, you'll be able to see their wish list, which makes you a better GIFTR!
</div>
<br><br>

	
<? foreach($recipients as $recipient): ?>

	<!-- Print this user's name -->
	<span class="giftee_name"><?=$recipient['first_name']?> <?=$recipient['last_name']?>

</span>

<!-- If already a friend, show an unfriend link -->
<? if(isset($friends[$recipient['recipient_id']])): ?>
	<span class= "unfriend"><a href='/gifts/unfriend/<?=$recipient['recipient_id']?>'>Unfriend</a>
	</span>
<!-- Otherwise, show the friend link -->
<? else: ?>
	<span class= "friend"><a href='/gifts/friend/<?=$recipient['recipient_id']?>'>Friend</a></span>
<? endif; ?>


<br><br>

<? endforeach; ?>
	

