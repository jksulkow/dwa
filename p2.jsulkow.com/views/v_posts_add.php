<form method='POST' action='/posts/p_add'>

	<div class="text">Your Post:</div>
	<textarea name='content'></textarea>

	<br><br>
	<input type='submit'>

</form>
<div id='results'></div>
<script type='text/javascript'>
    
    var options = {
        beforeSubmit: function() {
            $('#results').html("Loading...");
        },
        success: function(response) {
            if(response == "1") {
                $('#results').html("Success");
            }
            else {
                $('#results').html("Fail");
            }
        }
    };
    
    $('form').ajaxForm(options);
</script>