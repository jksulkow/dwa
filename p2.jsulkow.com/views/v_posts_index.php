
 <div class="middle">
    <div class="text">
    <?=$msg?>
    </div>
    <br><br>
<? foreach($posts as $post): ?>
	
	<div class="username"><?=$post['first_name']?> <?=$post['last_name']?> said:</div>
	<div class="quote"><?=$post['content']?></div>
        <div class ="rightside">   
        </div>
	
	<br><br>
	
<? endforeach; ?>
 </div>