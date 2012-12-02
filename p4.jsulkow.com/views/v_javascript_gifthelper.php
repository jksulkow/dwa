<div id="gifthelper">
	
	
	<div id="instructions1">
		<h2>Get Started!</h2>
		A Giftee is someone you want to buy a gift for, such as "Mom".  Add a giftee!<br>
		Now add a gift idea using the Add Gift button next to the Giftee.
		Make sure you say where you want to shop for it, too. <br>
		Use the Edit button to change a gift or to place a checkmark next to "got it".<br><br>
	</div>
	
	<div id="giftlist">

		
		<? foreach ($listitems as $listitem): ?>
		
			<div id='recipient_occasion_<?=$listitem['recipient_occasion_id']?>' class='recipient' data-ro_id="<?=$listitem['recipient_occasion_id']?>">
				<div class="addgiftbutton"><a class="addgift" href='#'>+Add Gift</a></div>
				<span class="done<?=$listitem['is_done']?>"> <span><a href='#'></a></span></span>
				<div class="giftee"><?=$listitem['nickname']?></div>
				<div class = "occasion"><?=$listitem['occasion_name']?></div>
				
				<div class="arrow open"><a href='#'>V</a></div>
				<br>
				<div class="contents">
				<? foreach ($listitem["gifts"] as $gift): ?>
				
					<div class="got_it">
					<span class="got_icon<?=$gift['got_it']?>"> <span></span></span>
					Got It?
					</div>
				
					<div class='giftlist' data-giftid="<?=$gift['gift_id']?>" data-giftname="<?=$gift['gift_name']?>" data-giftlocation="<?=$gift['location']?>" data-giftgot="<?=$gift['got_it']?>">
					<div class='gift_name'><?=$gift['gift_name']?></div>
					<div class="location">Where to Buy?</div><div class = "answer"><?=$gift['location']?></div>
					
				
					<div class="editgiftbutton"><a class="editgift" href='#'>Edit</a></div>
					<div class="deletegiftbutton"><a class="deletegift" href='#'>Delete</a></div>
					<div class="clear"></div>
					</div>
				<br>
				<? endforeach; ?>
				</div>
			

			</div>	
		<? endforeach; ?>
			
		
		
		
	</div>
	