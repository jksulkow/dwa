<div class="addwishbutton"><a class="addwish" href='#'>+Add Wish</a></div>

    


<div class = "wishlist">
    <span class = "wishFor">I Wish For...</span>
        <?  if (!empty($wishes))  
        
        foreach($wishes as $wish): ?>
	
	 <div class = "wishitem"><?=$wish['item_name']?></div>
            <div class = "wishdate">added <?=Time::display($wish['created'])?></div>
		
        <? endforeach; ?>
</div>


<!--hidden form-->
<form id="addwishform" method='POST' action='/wishes/p_add'>

	<div>I Wish For...</div>
	<textarea name='item_name'></textarea>

	<br><br>
	<input type='submit'>

</form>

