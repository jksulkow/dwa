

<form method='POST' action='/wishes/p_add'>

	<div>Item Name:</div>
	<textarea name='item_name'></textarea>

	<br><br>
	<input type='submit'>

</form>

<div id='wish_results'></div>

<script type='text/javascript'>
    
    var options = {
        beforeSubmit: function() {
            $('#wish_results').html("Loading...");
        },
        success: function(response) {
            $('#wish_results').html(response);
        },
    };
    
    $('form').ajaxForm(options);
</script>