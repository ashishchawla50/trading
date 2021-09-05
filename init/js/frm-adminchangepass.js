// JavaScript Document
$(document).ready(
  function(){
	 
	$("#errormsg1").html("");
	  $("#OLDPASSWORD").blur(function(){
		  
		  var temppass = $(this).val();
		  $.ajax({
			type:"post",
			url:"ajax-combo.php?oldpassword",
			data:{oldpassword:temppass},
			success:function(data){
				//alert(data);
					if(data == '1')
					{
						$("#errormsg1").html("");
						$("#changepassword").prop("disabled",false);
					}
					
					else
					{
						$("#errormsg1").html("Old Password doesn't match"); 
						$("#changepassword").prop("disabled",true);
					}
					
				}
		});
	  });
		 
	$("#frmadminchangepass").validate({
		rules: {
			OLDPASSWORD:"required",
			NEWPASSWORD:"required",
			CONFIRMPASSWORD: {
			  required:true,
			  equalTo: "#NEWPASSWORD"
			}			
        },
        messages:{
			OLDPASSWORD:"Old Password is required",
			NEWPASSWORD:"New Password is required",
			CONFIRMPASSWORD: {
			  required:"Confirm Password is required",
			  equalTo: "Password and Confirm Password must be same"
			}
		},   
        submitHandler: function(form) {
            form.submit();
        }
    });
});
