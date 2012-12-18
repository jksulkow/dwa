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
    
    //p4--cancel editing a gift
    $(".canceleditgift").click(function() {
        canceleditgift(this);
    });

}); // end doc ready; do not delete this!


       var addGiftOptions = {
            type: 'post',
            url: '/gifts/p_addgift',
	    clearForm: true,
            success: function(response) {
                var newgift = jQuery.parseJSON(response);
		var r_o_id = newgift.recipient_occasion_id;
		r_o_id = "#contents_"+r_o_id;
		var giftlist =          "<div id = 'gift_"+newgift.gift_id+"'>"+
                                        "<div class='got_it'>"+
					"<span class='got_icon"+newgift.got_it+"'> <span></span></span>"+
					"Got It?"+
					"</div>"+
				
					"<div class='giftlist' data-giftid = '"+newgift.gift_id+"' data-giftname = '"+newgift.gift_name+
                                        "' data-giftlocation = '"+newgift.location+"' data-giftgot = '"+newgift.got_it+"'>"+
					"<div class='gift_name'>"+newgift.gift_name+"</div>"+
					"<div class='location'>Where to Buy?</div><div class = 'answer'>"+newgift.location+"</div>"+
					
				
					"<div class='editgiftbutton'><a class='editgift' href='#'>Edit</a></div>"+
					"<div class='deletegiftbutton'><a class='deletegift' href='#'>Delete</a></div>"+
					"<div class='clear'></div>"+
					"</div>"+
                                        "</div>"
                $(r_o_id).append(giftlist);
            },
    };
    
    //p4--modified addgift to be a hidden form
    //and to use json/Ajax for posting
    function addgift(id){  
        giftee_id = $(id).parent().parent().data('ro_id');
        $("#addgiftform_"+giftee_id).css("display","block");
        $("#addgiftform_"+giftee_id).ajaxForm(addGiftOptions);
}

    //p4--modified edit gift to use json/Ajax for posting
    var editGiftOptions = {
        type: 'post',
        url: '/gifts/p_editgift',
        success: function(response) {
            var newgift = jQuery.parseJSON(response);
            var giftdiv = newgift.gift_id;
            giftdiv = "#gift_"+giftdiv;
            var gift =          "<div id = 'gift_"+newgift.gift_id+"'>"+
                                        "<div class='got_it'>"+
					"<span class='got_icon"+newgift.got_it+"'> <span></span></span>"+
					"Got It?"+
					"</div>"+
				
					"<div class='giftlist' data-giftid = '"+newgift.gift_id+"' data-giftname = '"+newgift.gift_name+
                                        "' data-giftlocation = '"+newgift.location+"' data-giftgot = '"+newgift.got_it+"'>"+
					"<div class='gift_name'>"+newgift.gift_name+"</div>"+
					"<div class='location'>Where to Buy?</div><div class = 'answer'>"+newgift.location+"</div>"+
					
				
					"<div class='editgiftbutton'><a class='editgift' href='#'>Edit</a></div>"+
					"<div class='deletegiftbutton'><a class='deletegift' href='#'>Delete</a></div>"+
					"<div class='clear'></div>"+
					"</div>"+
                                        "</div>"
            $(giftdiv).html(gift);
        },
    };


    
    //p4 Wish List functionality
    function addwish(){
        $("#addwishform").css("display", "block");
    }

    //p4--cancel adding a gift
    function canceladdgift(id){
        giftee_id = $(id).parent().parent().data('ro_id');
        $("#addgiftform_"+giftee_id).css("display", "none");
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
        $("#editgiftform_"+giftid).css("display","block");
        $("#editgiftform_"+giftid).ajaxForm(editGiftOptions);
    }
    
    //p4--cancel editing a gift
    function canceleditgift(id){
        giftid = $(id).parent().parent().data('giftid');
        $("#editgiftform_"+giftid).css("display", "none");
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
    
    



