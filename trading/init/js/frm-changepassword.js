// JavaScript Document
$(document).ready(
  function(){
	$("#errormsg1").html("");
	  $("#OLDPASSWORD").blur(function(){
		  var temppass = $(this).val();
		  $.ajax({
			type:"post",
			url:"ajax.php?oldpassword",
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
		 $("#SECURITYQUESTION").blur(function(){
		  var temppass = $(this).val();
		  $.ajax({
			type:"post",
			url:"ajax.php?securityquestion",
			data:{securityquestion:temppass},
			success:function(data){
				//alert(data);
					if(data == '1')
					{
						$("#errormsgques").html("");
						$("#changepassword").prop("disabled",false);
					}
					
					else
					{
						$("#errormsgques").html("Sequrity Question doesn't match"); 
						$("#changepassword").prop("disabled",true);
					}
					
				}
		});
		 });
		 $("#SECURITYANSWER").blur(function(){
		  var temppass = $(this).val();
		  $.ajax({
			type:"post",
			url:"ajax.php?sequrityanswer",
			data:{sequrityanswer:temppass},
			success:function(data){
				//alert(data);
					if(data == '1')
					{
						$("#errormsgansw").html("");
						$("#changepassword").prop("disabled",false);
					}
					
					else
					{
						$("#errormsgansw").html("Sequrity Answer doesn't match"); 
						$("#changepassword").prop("disabled",true);
					}
					
				}
		});
		 });
	
	
	$("#frmchangepassword").validate({
		rules: {
			SECURITYQUESTION:"required",
			SECURITYANSWER:"required",
			OLDPASSWORD:"required",
			NEWPASSWORD:"required",
			CONFIRMPASSWORD: {
			  required:true,
			  equalTo: "#NEWPASSWORD"
			}			
        },
        messages:{
			SECURITYQUESTION:"Security Question is required",
			SECURITYANSWER:"Security Answer is required",
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
