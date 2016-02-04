$(document).ready(function() 
{ 

$('#photoimg').change(function(e) 
 {
var offer_id = $(this).parents("form").find("#offer_id_temp").val();
//alert(offer_id);

var A=$("#imageloadstatus");
var B=$("#imageloadbutton");
$("#preview_"+offer_id).html('');
$("#imageform").ajaxForm({target: '#preview_'+offer_id, 
beforeSubmit:function(){
A.show();
B.hide();
}, 
success:function(){
$("#add_image_offer"+offer_id).text("CHANGE PHOTO");
$("#gallery_img"+offer_id).hide();
run_counter();
A.hide();
B.show();
}, 
error:function(){
A.hide();
B.show();
} }).submit();
});

}); 
