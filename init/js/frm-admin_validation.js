$(document).ready(function(){

	$("#frm_AccountGroup").validate({
    
        // Specify the validation rules
        rules: {
            txtGROUPNAME: "required"
			
        },
              
        submitHandler: function(form) {
            if (confirm('Do you really want to Submit?')) {
					form.submit();
				}
        }
    });
	
	$("#frm_Location").validate({
    
        // Specify the validation rules
        rules: {
            txtLOCATIONNAME: "required"
			
        },
              
        submitHandler: function(form) {
            if (confirm('Do you really want to Submit?')) {
					form.submit();
				}
        }
    });
	
	$("#frm_ACtable").validate({
    
        // Specify the validation rules
        rules: {
            txtLEDGERNAME: "required",
			txtGROUPID_:"required",
			txtADDRESS:"required"
			
        },
              
        submitHandler: function(form) {
            if (confirm('Do you really want to Submit?')) {
					form.submit();
				}
        }
    });
	
	$("#frm_Purchase").validate({
    
        // Specify the validation rules
        rules: {
			dtpVOUCHERDATE: "required",
			txtDUEDAYS:"required",
            txtLEDGERID: "required",
			txtENTRYDATE: "required",
			txtLOCATIONNAME:"required",
			txtCONVRATE:"required",
			txtFINALTOTAL:"required"			
        },
              
        submitHandler: function(form) {
             if (confirm('Do you really want to Submit?')) {
					form.submit();
				}
        }
    });
	
	
	$("#frm_Sale").validate({
    
        // Specify the validation rules
        rules: {
			dtpVOUCHERDATE: "required",
			txtDUEDAYS:"required",
            txtLEDGERID: "required",
			txtENTRYDATE: "required",
			txtLOCATIONNAME:"required",
			txtCONVRATE:"required",
			txtFINALTOTAL:"required"			
        },
              
        submitHandler: function(form) {
			
			 if (confirm('Do you really want to Submit?')) {
					form.submit();
				}
            //form.submit();
        }
    });
	
	$("#frm_trantable").validate({
    
        // Specify the validation rules
        rules: {
            txtBOOKLEDGERID_: "required",
			txtLEDGERID_: "required"
			
        },
              
        submitHandler: function(form) {
			form.submit();
			
           
        }
    });
	
	$("#frm_journaltable").validate({
    
        // Specify the validation rules
        rules: {
            txtBOOKLEDGERID_: "required",
			txtLEDGERID_: "required"
			
        },
              
        submitHandler: function(form) {
			var cramt = parseFloat($("#txtCRAMOUNT").val());
			var balamt = parseFloat($("#BOOKLEDGERIDBALANCE").val());
			if(!$("#txtCRAMOUNT").prop("disabled"))
			{
				
				if(cramt <= balamt)
				{
					if (confirm('Do you really want to Submit?')) {
						form.submit();
					}
				}
				else
				{
					alert('Amount is wrong2');
				}
			}
				 
		
           
        }
    });
	
		$("#frm_journaltable_edit").validate({
    
        // Specify the validation rules
        rules: {
            txtBOOKLEDGERID_: "required",
			txtLEDGERID_: "required"
			
        },
              
        submitHandler: function(form) {
			if (confirm('Do you really want to Submit?')) {
						form.submit();
					}
				 
		
           
        }
    });
	

 });
 
 