

$(document).ready(function() {
    
    //vanilla javascript
    //document.getElementById('lucy').style.backgroundColor = "red";
    
    //jQuery
    $('#lucy').css('background-color', 'red');
    
    //make all the divs disappear
    //$('div').hide();
    
    //When lucy is clicked, change the width of ricky              
    $('#lucy').click(function() {
        console.log("Lucy was clicked");
        $('#ricky').css('width', '400px');
    });
                  
                  
                  
} ); //end of doc ready

