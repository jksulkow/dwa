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
		
			<div id='recipient_occasion_<?=$listitem['recipient_occasion_id']?>' class='recipient'>
				<a onclick='addgift(<?=$listitem['recipient_occasion_id']?>);' href='#'>Add Gift</a>

				<?=$listitem['nickname']?>
				<?=$listitem['occasion_name']?>
				<span class="hidden"><?=$listitem['recipient_occasion_id']?></span>
				<div class="arrow">V</div>
				<br>
				<div class="contents">
				<? foreach ($listitem["gifts"] as $gift): ?>
			
					<?=$gift['gift_name']?>
					<?=$gift['location']?>
					<?=$gift['got_it']?>
				<br>
				<? endforeach; ?>
				</div>
			

			</div>	
		<? endforeach; ?>
			
		
		
		
	</div>
	