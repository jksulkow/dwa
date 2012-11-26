$(document).ready(function() { // start doc ready; do not delete this!
    
    //client-side validation on signup or login
    //for p4, I will try jQuery's Validate plugin,
    //but first I wanted to see if I could create a simple function.
    $("#firstname").blur(function() {
        validateFirst(this);
    });
    
    $("#lastname").blur(function() {
        validateLast(this);
    });
    
    $("#email").blur(function() {
        validateEmail(this);
    });
    
    

}); // end doc ready; do not delete this!

    
    function validateFirst(id) {
        var firstname = $(":input[name=first_name]").val();
        if(firstname.length < 1) {
            $('#firstnamemsg').css('color','red');
            $('#firstnamemsg').html("First Name must be provided.");
        }
    }
    
    function validateLast(id) {
        var lastname = $(":input[name=last_name]").val();
        if(lastname.length < 1) {
            $('#lastnamemsg').css('color','red');
            $('#lastnamemsg').html("Last Name must be provided.");
        }
    }
    
    function validateEmail(id) {
        var email = $(":input[name=email]").val();
        if(!email.contains("@") {
            $('#emailmsg').css('color','red');
            $('#emailmsg').html("Email must contain @ sign.");
        }
    }



