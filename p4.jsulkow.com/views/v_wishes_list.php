<div class = "wishlist">
    <span class = "wishFor">I Wish For...</span>
    
    
        <? if ($countw >= 1) {
	foreach($wishes as $wish): ?>
	
	 <div class = "wishitem"><?=$wish['item_name']?></div>
            <div class = "wishdate">added <?=Time::display($wish['created'])?></div>
		
        <? endforeach;
	}	
	?>
	
	<? if ($countw == 0) {
	echo "<div class = 'nowishes'>(No Wishes Yet!)</div>";
	} ?>
</div>