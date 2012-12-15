//functions added or changed for p4
//have comments starting with p4

$(document).ready(function() { // start doc ready; do not delete this!
    
    //when an element with the class 'arrow' is clicked,
    //call the function "showItem", passing in the item with the arrow class.
    $(".arrow").click(function() {
        showItem(this);
        
    });
    
    $(".addgift").click(function() {
        addgift(this);
    });
    
    $(".addwish").click(function() {
        addwish();
    });
    

    
    $(".editgift").click(function() {
        editgift(this);
    });
    
    $(".done0").click(function() {
        editdone0(this);
    });
    
    $(".done1").click(function() {
        editdone1(this);
    });
     
    //p4--delete gift function
    $(".deletegift").click(function() {
        deletegift(this);
    });
    
    //p4--cancel adding a gift
    $(".canceladdgift").click(function() {
        canceladdgift(this);
    });

}); // end doc ready; do not delete this!

    
    //p4--modified addgift to be a hidden form
    function addgift(id){  
        giftee_id = $(id).parent().parent().data('ro_id');
        $(".addgiftform").css("display","block");
}
    
    //p4 Wish List functionality
    function addwish(){
        $("#addwishform").css("display", "block");
    }

    //p4--cancel adding a gift
    function canceladdgift(id){
        $(".addgiftform").css("display", "none");
    }


    //p4--labeled submit button 'Edit Gift'
    function editgift(id){
        giftname = $(id).parent().parent().data('giftname');
        giftlocation= $(id).parent().parent().data('giftlocation');
        giftgot = $(id).parent().parent().data('giftgot');
        giftid = $(id).parent().parent().data('giftid');
        checkedval = "";
        if (giftgot== '1') {
            checkedval = "checked";
        }
        
        form="<form method='POST' id='editgiftform' action='/gifts/p_editgift'>Name of Gift <input type='text' name='gift_name' value='"+giftname+"'><br>Where to Buy It<input type='text' name='location' value='"+giftlocation+"'>Got It?<input type='checkbox' name='got_it' value='1' "+checkedval+"> <br><input type='hidden' name='gift_id' value='"+giftid+"'><input type='submit' value='Edit Gift'></form>"
        $(id).parent().append(form);
    }
    
    
    //p4--delete gift function
    function deletegift(id) {
        giftid = $(id).parent().parent().data('giftid');
        giftname = $(id).parent().parent().data('giftname');
        form="<form method='POST' action='/gifts/p_deletegift'>Gift <input type='text' name='gift_name' value='"+giftname+"' readonly='readonly'><br><input type='hidden' name='gift_id' value='"+giftid+"'><input type='submit' value='Delete'></form>"
        $(id).parent().append(form);
    }
    



    //create an accordion effect, showing or
    //hiding the sub-list of gifts for the person
    //The argument "id" is an id of a div containing the arrow.
    //Jonathan Sulkow assisted in the code and teaching me about the parent and children elements.
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
    
    //toggle the giftee's status between done and not done.
    function editdone0(id) {
        giftee_id = $(id).parent().data('ro_id');
        
        $(id).removeClass('done0');
        $(id).addClass('done1');
        form="<form method='POST' action='/gifts/p_editdone'><input type='hidden' name='is_done' value='1'><input type='hidden' name='recipient_occasion_id' value='"+giftee_id+"'><input type='submit' value='update to done!'></form>"
        $(id).parent().append(form);
        }
    
    



