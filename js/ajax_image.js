$(document).ready(function() 
{ 

$('#photoimg').change(function() 
 {
var A=$("#imageloadstatus");
var B=$("#imageloadbutton");
$("#preview").html('');
$("#imageform").ajaxForm({target: '#preview', 
beforeSubmit:function(){
A.show();
B.hide();
}, 
success:function(){
$("#add_image_offer").text("CHANGE PHOTO");
A.hide();
B.show();
}, 
error:function(){
A.hide();
B.show();
} }).submit();
});

}); 