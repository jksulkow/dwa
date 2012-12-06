<!DOCTYPE html>
<html>
<head>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
        
        <script type="text/javascript" src="jquery.form.js"></script>
        
<script type='text/javascript'>
                
        $(document).ready(function() {
                
                var options = {
                        beforeSend: function() {
                            $('#results').html("Loading...");
                        },
                        type: 'post',
                        url: 'processor.php',
                        
                        success: function(response) { 
                                    // Load the results we get back from process.php into the results div
                                $('#results').html(response);            
                        } 
                };                    

                
// Attach the Ajax form plugin to this form so that when it's submitted, it will be submitted via Ajax        
        $('form').ajaxForm(options);
                
}); // end doc ready
</script>
</head>
<body>
        <form id='reverser'>
        Enter your name:<br>
        <input type='text' name='first_name'><br><br>
        
        <input type='submit' value='Reverse'>
        </form>
<!-- We'll put the results in this empty div -->
        <div id='results'></div>
        
        
</body>
</html>