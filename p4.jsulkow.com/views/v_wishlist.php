<div class = "wishlist">
    <span class = "wishFor">I Wish For...</span>
        <?  if (!empty($wishes))  
        
        foreach($wishes as $wish): ?>
	
	 <div class = "wishitem"><?=$wish['item_name']?></div>
            <div class = "wishdate">added <?=Time::display($wish['created'])?></div>
		
        <? endforeach; ?>
</div>