
 <div class="middle">
    <span class="button">
    <?=$msg?>
    </span>
    <br><br>
<? foreach($posts as $post): ?>
	
	<div class="username"><?=$post['first_name']?> <?=$post['last_name']?> said:</div>
	<div class="quote"><?=$post['content']?></div>
        <div class ="rightside">   
        </div>
	
	<br><br>
	
<? endforeach; ?>
 </div>