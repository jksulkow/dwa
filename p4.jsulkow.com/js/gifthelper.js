$(document).ready(function() { // start doc ready; do not delete this!

    //if rowcount in recipients_occasions ===0, make instructional div appear
    //$('#instructions1').css('display', 'none');

}); // end doc ready; do not delete this!

function addgift(id){
    rec="#recipient_occasion_"+id;
    form="<form method='POST' action='/gifts/p_addgift'>Name of Gift <input type='text' name='gift_name'><br>Where to Buy It<input type='text' name='location'><br><input type='hidden' name='recipient_occasion_id' value="+id+">Got It?<input type='checkbox' name='got_it'> <br><input type='submit'></form>"
   // alert(rec);
     $(rec).append(form);
   
}

