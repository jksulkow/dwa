<h1>Control Panel</h2>

Number of posts: <div id='post_count'></div><br>
Number of users: <div id='user_count'></div><br>
Most recent post: <div id='most_recent_post'></div><br>

<button id='refresh-button'>Refresh</button>
 
<script type='text/javascript'>
		
	$('#refresh-button').click(function() {
	 	
		$.ajax({
			type: 'POST',
			url: '/posts/p_control_panel',
			success: function(response) { 
			
				// For debugging purposes
				console.log(response);
				
				// Example response: {"post_count":"9","user_count":"13","most_recent_post":"May 23, 2012 1:14am"}
				var data = jQuery.parseJSON(response);
				
				// Inject the data into the page
				$('#post_count').html(data['post_count']);
				$('#user_count').html(data['user_count']);
				$('#most_recent_post').html(data['most_recent_post']);
							
			},
		});
	});

</script>
