<? foreach($posts as $post): ?>
	
	<h2><?=$post['first_name']?> <?=$post['last_name']?> said:</h2>
	<?=$post['content']?>
	
	<br><br>
	
<? endforeach; ?>