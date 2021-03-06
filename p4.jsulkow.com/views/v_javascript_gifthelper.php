<div id="gifthelper">
	
	
	<div id="instructions1">
		<div id="listlength"><?=$listlength ?></div>
		<h2>Get Started!</h2>
		<p>A Giftee is someone you want to buy a gift for, such as "Mom".
		Your giftee might be a friend who is also using GIFTR.  <a href='/gifts/find_friends'>Find friends</a>
		and they'll automatically become giftees. (They won't see your gift checklist).</p>
		<p>You can add anyone as a giftee!  If they aren't on GIFTR, just click <a href='/gifts/addrecipient'>Add Giftee</a>
		and give them a nickname.</p>
		<p>If your giftee is another GIFTR user you "friended", you can also see their wish list by clicking the Wish List button to the left of their name below.</p>
	</div>
	<div id="instructions2">
		<p>Now add a gift idea using the Add Gift button next to the Giftee.
		Make sure you say where you want to shop for it, too. </p>
		<p>Use the Edit button to change a gift or to place a checkmark next to "got it".</p>
		
	</div>
	
	<div id="giftlist">
		<? foreach ($listitems as $listitem): ?>
		
			<div id='recipient_occasion_<?=$listitem['recipient_occasion_id']?>' class='recipient' data-ro_id="<?=$listitem['recipient_occasion_id']?>">
				<div class="addgiftbutton"><a class="addgift" href='#'>+Add Gift</a></div>
				<? if (isset($listitem['recip_as_user_id'])) { ?>
					<!-- link to the friend's wish list -->
					<div class = "addgiftbutton">
					<a class="" href='/wishes/getWishList/<?=$listitem['recip_as_user_id']?>'>WishList</a>
					</div>
					<!-- end showwishlist div -->
				<? } ?>
				
				
				
				
				<span class="done<?=$listitem['is_done']?>"> <span><a href='#'></a></span></span>
				

				
				<div class="giftee"><?=$listitem['nickname']?></div>
				<div class = "occasion"><?=$listitem['occasion_name']?></div>
				
				<!--if recipient is also a user, can link to their wish list -->
				<div class="recip_as_user">
					
				</div>
				<div class="clear"></div>
				
				
				
				
				<div class="arrow open"><a href='#'>V</a></div>
				
				
				
				<!--hidden form-->
				<form id='addgiftform_<?=$listitem['recipient_occasion_id']?>' class='addgiftform' >
				Name of Gift <input type='text' name='gift_name'><br>
				Where to Buy It<input type='text' name='location'><br>
				<input type='hidden' name='recipient_occasion_id' value= '<?=$listitem['recipient_occasion_id']?>'>
				Got It?<input type='checkbox' name='got_it' value='1'> <br>
				<button type="button" class="canceladdgift" >X</button>
				<input type='submit' value='Add'>
				</form>
																					     
				
				<br>
				<div class="contents" id="contents_<?=$listitem['recipient_occasion_id']?>">
					
					
				<? foreach ($listitem["gifts"] as $gift): ?>
					<div id = "gift_<?=$gift['gift_id']?>">
						<div class="got_it">
						<span class="got_icon<?=$gift['got_it']?>"> <span></span></span>
						Got It?
						</div>
					
						<div class='giftlist' data-giftid="<?=$gift['gift_id']?>" data-giftname="<?=$gift['gift_name']?>" data-giftlocation="<?=$gift['location']?>" data-giftgot="<?=$gift['got_it']?>">
						<div class='gift_name'><?=$gift['gift_name']?></div>
						<div class="location">Where to Buy?</div><div class = "answer"><?=$gift['location']?></div>
						
					
						<div class="editgiftbutton"><a class="editgift" href='#'>Edit</a></div>
						<div class="deletegiftbutton"><a class="deletegift" href='#'>Delete</a></div>
						
						
						
						<!--hidden form-->
						<form id='editgiftform_<?=$gift['gift_id']?>' class='editgiftform' >
						Name of Gift <input type='text' name='gift_name' value="<?=$gift['gift_name']?>" ><br>
						Where to Buy It<input type='text' name='location' value="<?=$gift['location']?>" ><br>
						<input type='hidden' name='gift_id' value="<?=$gift['gift_id']?>">
						Got It?
							<!-- need to give a checkbox a 'checked' attribute to display it already checked -->
							<? $checkedval = "";
							if($gift['got_it'] == 1) {
								$checkedval = "checked";
							}
							?>
						<!-- value='1' indicates the value that WILL BE sent if the user checks the box -->
						<input type='checkbox' name='got_it' value='1' <? echo $checkedval ?> >
						<br>
						<button type="button" class="canceleditgift" >X</button>
						<input type='submit' value='Save'>
						</form>
						
						</div> <!--close class giftlist div-->
						
						
					</div> <!--close gift id div -->
					<div class="clear"></div>
					
				<br>
				<? endforeach; ?>
				</div> <!--close contents div-->
			

			</div>	<!--close recipient_occasion_id div-->
		<? endforeach; ?>
	</div> <!--close id giftlist div -->
	
<script type='text/javascript'>



    
</script>