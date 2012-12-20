<div class="addwishbutton"><a class="addwish" href='#'>+Add Wish</a></div>

    


<? echo $wishlist ?>


<!--hidden form-->
<form id="addwishform" method='POST' action='/wishes/p_add'>

	<div>I Wish For...</div>
	<textarea name='item_name'></textarea>

	<br><br>
	<input type='submit'>

</form>

