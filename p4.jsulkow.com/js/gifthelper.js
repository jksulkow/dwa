$(document).ready(function() { // start doc ready; do not delete this!
    
    //when an element with the class 'arrow' is clicked,
    //call the function "showItem", passing in the item with the arrow class.
    $(".arrow").click(function() {
        showItem(this);
        
    });
    
    $(".addgift").click(function() {
        addgift(this);
    });
    
    $(".editgift").click(function() {
        editgift(this);
    });
     
    //add a delete gift function in p4

    //if rowcount in recipients_occasions ===0, make instructional div appear
    //$('#instructions1').css('display', 'none');

}); // end doc ready; do not delete this!

    function addgift(id){

    form="<form method='POST' action='/gifts/p_addgift'>Name of Gift <input type='text' name='gift_name'><br>Where to Buy It<input type='text' name='location'><br><input type='hidden' name='recipient_occasion_id' value="+$(id).parent().data('ro_id')+">Got It?<input type='checkbox' name='got_it' value='1'> <br><input type='submit'></form>"
   // alert(rec);
     $(id).parent().append(form);
}

    function editgift(id){
        giftname = $(id).parent().data('giftname');
        giftlocation= $(id).parent().data('giftlocation');
        giftgot = $(id).parent().data('giftgot');
        giftid = $(id).parent().data('giftid');
        checkedval = "";
        if (giftgot== '1') {
            checkedval = "checked";
        }
        
        form="<form method='POST' action='/gifts/p_editgift'>Name of Gift <input type='text' name='gift_name' value='"+giftname+"'><br>Where to Buy It<input type='text' name='location' value='"+giftlocation+"'>Got It?<input type='checkbox' name='got_it' value='1' "+checkedval+"> <br><input type='hidden' name='gift_id' value='"+giftid+"'><input type='submit'></form>"
        $(id).parent().append(form);
    }
    
    //add a delete gift function in p4.


    //create an accordion effect, showing or
    //hiding the sub-list of gifts for the person
    //The argument "id" is an id of a div containing the arrow.
    function showItem(id){
        //assign a variable to be all the children of the parent div.
        //so if the parent of the arrow is Jane Doe/Christmas, the children
        //are all Jane's Christmas gifts.
        target = $(id).parent().children(".contents");
        arrow = id;
       // alert(target);
        if ($(target).css("display")=="none")
        {
        
            $(target).show('fast');
            $(arrow).removeClass('open');
            $(arrow).addClass('close');
        
        } else {
       
            $(target).hide('fast');
            $(arrow).addClass('open');
            $(arrow).removeClass('close');
        }
    }
            



