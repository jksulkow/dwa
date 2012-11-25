<div id="gifthelper">
	<h1>My Gift Helper Shopping List</h1>
	
	<div id="instructions1">
		Get Started!<br>
		Enter a Nickname for someone you want to buy a gift for, such as "Mom".
		Then pick the occasion for the gift.  Write the name of the gift you have in mind
		and where you want to shop for it. <br> <br>
	</div>
	
	<div>

		
		<? foreach ($listitems as $listitem): ?>
		
			<div id='recipient_occasion_<?=$listitem['recipient_occasion_id']?>' class='recipient' data-ro_id="<?=$listitem['recipient_occasion_id']?>">
				<a class="addgift" href='#'>Add Gift</a>

				<?=$listitem['nickname']?>
				<?=$listitem['occasion_name']?>
				
				<div class="arrow">V</div>
				<br>
				<div class="contents">
				<? foreach ($listitem["gifts"] as $gift): ?>
					<div class='giftlist' data-giftid="<?=$gift['gift_id']?>" data-giftname="<?=$gift['gift_name']?>" data-giftlocation="<?=$gift['location']?>" data-giftgot="<?=$gift['got_it']?>">
					<?=$gift['gift_name']?>
					<?=$gift['location']?>
					<?=$gift['got_it']?>
				
					<a class="editgift" href='#'>Edit</a>
					</div>
				<br>
				<? endforeach; ?>
				</div>
			

			</div>	
		<? endforeach; ?>
			
		
		
		
	</div>
	