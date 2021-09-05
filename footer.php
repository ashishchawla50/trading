</div>

<div class="custom_overlay_wrapper" style="display:none">
			<div class="custom_overlay_outer">

				<div class="custom_overlay_inner">
					<div class="custom_overlay_content">
						
						<div class="close_custom_overlay"><i class="fa fa-close"></i></div>
						<span id="purchase_data">
						</span>
					
						
					</div>
				</div>
			</div>
		</div>


<!-- jQuery -->
    <script src="<?php echo SITEURL.INIT;?>js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo SITEURL.INIT;?>js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo SITEURL.INIT;?>js/metisMenu.min.js"></script>

	<!-- DataTables JavaScript -->
    <script src="<?php echo SITEURL.INIT;?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo SITEURL.INIT;?>js/dataTables.bootstrap.min.js"></script>



    <!-- Custom Theme JavaScript -->
    <script src="<?php echo SITEURL.INIT;?>js/sb-admin-2.js"></script>
	<script src="<?php echo SITEURL.INIT;?>js/frm-adminchangepass.js"></script>
	<script src="<?php echo SITEURL.INIT;?>js/jquery.validation.js"></script>
	<script src="<?php echo SITEURL.INIT;?>js/frm-admin_validation.js"></script>
	
	 <script src="<?php echo SITEURL.INIT;?>js/jquery-ui.js"></script>
	<script>
	
	
	var isAlt = false;
var isShift = false;

	$(document).keyup(function(e) {
		
		if(e.which == 18) {
			isAlt = false;
		}
		if(e.which == 16) {
			isShift = false;
		}
	});
	$(document).keydown(function(e) {
		if(e.which == 18) {
			isAlt = true; 
		}
		if(e.which == 16) {
			isShift = true; 
		}
		
	});
	

	$(window).keydown(function(e) {
			
		if(e.keyCode == 113)// DASHBOARD -F2
		{
			window.location.href="<?php echo SITEURL."?dashboard"?>";
		}
		else if(e.keyCode == 114)// DASHBOARD -F3
		{
			window.location.href="<?php echo SITEURL."?company"?>";
		}
		else if(e.keyCode == 115)// DASHBOARD -F4
		{
			window.location.href="<?php echo SITEURL."?party"?>";
		}
		else if(e.keyCode == 117)// DASHBOARD -F6
		{
			window.location.href="<?php echo SITEURL."?purchase"?>";
		}
		else if(e.keyCode == 119)// DASHBOARD -F8
		{
			window.location.href="<?php echo SITEURL."?sale"?>";
		}
		else if(e.keyCode == 120)// DASHBOARD -F9
		{
			window.location.href="<?php echo SITEURL."?filter"?>";
		}
		else if(e.keyCode == 121)// DASHBOARD -F10
		{
			window.location.href="<?php echo SITEURL."?sale-stock"?>";
		}


});

	</script>
<?php
	 if($filename=='rappriceupdate')
	 {
		 ?>
		 <script>
			$(document).ready(function(){
					
					 $.ajax({
									type:"post",
									url:"ajax-rappriceupdate.php?priceshape=Round",
									data:{},
									success:function(data){	
									//alert(data);
										//	window.location.href='<?php echo SITEURL.""?>';
										}
									});
									
					 $.ajax({
									type:"post",
									url:"ajax-rappriceupdate.php?priceshape=Pear",
									data:{},
									success:function(data){	
									//alert(data);
											window.location.href='<?php echo SITEURL.""?>';
										}
									});
				});
		</script>
		 <?php
	 }
	 
	 ?>
	 
	<script>
	
 var availableLab = [
		<?php echo implode(",",$LabArr);?>
    ];
	  var availableShape = [
		<?php echo implode(",",$ShapeArr);?>
    ];
	
	
	var availableColor = [
		<?php echo implode(",",$ColorArr);?>
    ];
	var availableClarity = [
		<?php echo implode(",",$ClarityArr);?>
    ];
	
	
	
	var availableCut = [
		<?php echo implode(",",$CutArr);?>
    ];
	
	
	  var availablePolish = [
		<?php echo implode(",",$PolishArr);?>
    ];
	
	
	  var availableSymm = [
		<?php echo implode(",",$SymmArr);?>
    ];
	  var availableFlour = [
		<?php echo implode(",",$FlourArr);?>
    ];
	
	var availableGreen = [
		<?php echo implode(",",$GreenArr);?>
    ];
	
	 var availableMilky = [
		<?php echo implode(",",$MilkyArr);?>
    ];
	
						
	
    $(document).ready(function() {
		
		
			$('#SEARCHBARCODE').blur(function(){
				var id = $(this).val();
				if (id != '')
				{
					getData(id);
				}
				
			});
			
			$('.close_custom_overlay').click(function(){
				$('.custom_overlay_wrapper').fadeOut();
			});
			
			
			$('.LEDGER_auto').click(function(){
					var id = "";
					var gid = $(this).attr("rel");
					getDataledger(id,gid);
					//alert(gid);
				
				
			});
			
			
			
		$("#xlsprintreport").click(function(){
			$("#frmreportprint").attr("action",'<?php echo SITEURL."reportxls.php"; ?>');
			$("#frmreportprint").trigger('submit');
		});
		$("#pdfprintreport").click(function(){
			$("#frmreportprint").attr("action",'<?php echo SITEURL."?report" ?>');
			$("#frmreportprint").trigger('submit');
		});
		$("#pdfcashpayment").click(function(){
			$("#frmcashpayment").attr("action",'<?php echo SITEURL."?tran-cashpayment-v" ?>');
			$("#frmcashpayment").trigger('submit');
		});
		$("#xlscashpayment").click(function(){
			$("#frmcashpayment").attr("action",'<?php echo SITEURL."tran-cashpaymentxls.php"; ?>');
			$("#frmcashpayment").trigger('submit');
		});
		$("#pdfcashreceipt").click(function(){
			$("#frmcashreceipt").attr("action",'<?php echo SITEURL."?tran-cashreceipt-v" ?>');
			$("#frmcashreceipt").trigger('submit');
		});
		$("#xlscashreceipt").click(function(){
			$("#frmcashreceipt").attr("action",'<?php echo SITEURL."tran-cashreceiptxls.php"; ?>');
			$("#frmcashreceipt").trigger('submit');
		});
		$("#pdfbankpayment").click(function(){
			$("#frmbankpayment").attr("action",'<?php echo SITEURL."?tran-bankpayment-v" ?>');
			$("#frmbankpayment").trigger('submit');
		});
		$("#xlsbankpayment").click(function(){
			$("#frmbankpayment").attr("action",'<?php echo SITEURL."tran-bankpaymentxls.php"; ?>');
			$("#frmbankpayment").trigger('submit');
		});
		$("#pdfbankreceipt").click(function(){
			$("#frmbankreceipt").attr("action",'<?php echo SITEURL."?tran-bankreceipt-v" ?>');
			$("#frmbankreceipt").trigger('submit');
		});
		$("#xlsbankreceipt").click(function(){
			$("#frmbankreceipt").attr("action",'<?php echo SITEURL."tran-bankreceiptxls.php"; ?>');
			$("#frmbankreceipt").trigger('submit');
		});
		
		$("#pdfbankpaymentsale").click(function(){
			$("#frmbankpaymentsale").attr("action",'<?php echo SITEURL."?tran-bankpayment-sale-v" ?>');
			$("#frmbankpaymentsale").trigger('submit');
		});
		$("#xlsbankpaymentsale").click(function(){
			$("#frmbankpaymentsale").attr("action",'<?php echo SITEURL."tran-bankpaymentsalexls.php"; ?>');
			$("#frmbankpaymentsale").trigger('submit');
		});
		
		$("#pdfjournalpayment").click(function(){
			$("#frmjournalpayment").attr("action",'<?php echo SITEURL."?tran-journalpayment-v" ?>');
			$("#frmjournalpayment").trigger('submit');
		});
		$("#xlsjournalpayment").click(function(){
			$("#frmjournalpayment").attr("action",'<?php echo SITEURL."tran-journalpaymentxls.php"; ?>');
			$("#frmjournalpayment").trigger('submit');
		});
		
		$("#pdfjournalreceipt").click(function(){
			$("#frmjournalreceipt").attr("action",'<?php echo SITEURL."?tran-journalreceipt-v" ?>');
			$("#frmjournalreceipt").trigger('submit');
		});
		$("#xlsjournalreceipt").click(function(){
			$("#frmjournalreceipt").attr("action",'<?php echo SITEURL."tran-journalreceiptxls.php"; ?>');
			$("#frmjournalreceipt").trigger('submit');
		});
		
		$("#pdfnetprofitloss").click(function(){
			$("#frmnettprofitloss").attr("action",'<?php echo SITEURL."?netprofitloss&_vid" ?>');
			$("#frmnettprofitloss").trigger('submit');
		});
		$("#xlsnetprofitloss").click(function(){
			$("#frmnettprofitloss").attr("action",'<?php echo SITEURL."netprofitlossxls.php"; ?>');
			$("#frmnettprofitloss").trigger('submit');
		});
<?php
if($filename == "dashboard")
{
	?>
	$(".clearid").click(function(){
			
			 var relID = $(this).attr("rel");
			
				$.ajax({
						type:"post",
						url:"ajax.php",
						data:{clearid:relID},
						success:function(data){
							//alert(data);
							if(data == "1")
							{
								alert("Successfully Cleared");
								window.location.href='<?php echo SITEURL."?dashboard"?>';	
							}
							else
							{
								alert("Not Cleared");
							}
						
						}
						});
		 });
		 
		 
		 $(".clearid_ledger").click(function(){
			
			 var relID = $(this).attr("rel");
			
			$.ajax({
						type:"post",
						url:"ajax.php",
						data:{led_clearid:relID},
						success:function(data){
							
							if(data.trim() == "")
							{
								alert("Successfully Cleared");
								window.location.href='<?php echo SITEURL."?dashboard"?>';	
							}
							else
							{
								alert("Not Cleared");
							}
						
						}
						});
		 });
		 
	<?php
}
elseif($filename == "print-grouplist" && isset($_GET["_gid"]) && !empty($_GET["_gid"]))
{
	?>
	$(".clearid_ledger").click(function(){
			
			 var relID = $(this).attr("rel");
			
			$.ajax({
						type:"post",
						url:"ajax.php",
						data:{led_clearid:relID},
						success:function(data){
							//alert(data);
							if(data == "1")
							{
								alert("Successfully Cleared");
								window.location.href='<?php echo SITEURL."?print-grouplist&_gid=".$_GET["_gid"]?>';	
							}
							else
							{
								alert("Not Cleared");
							}
						
						}
						});
		 });
	<?php
}
?>		
		
	
	$("#search_barcode_sal").blur(function(){
		var search_barcode_sal = $(this).val();
		$.ajax({
					type:"post",
					url:"ajax.php?salebarcode",
					data:{search_barcode_sal:search_barcode_sal},
					success:function(data){	
							window.location.href='<?php echo SITEURL;?>' + '?sale&_mid='+data;
						}
					});
		
	});
	$("#search_barcode_pur").blur(function(){
		var search_barcode_pur = $(this).val();
		$.ajax({
					type:"post",
					url:"ajax.php?purchasebarcode",
					data:{search_barcode_pur:search_barcode_pur},
				
					success:function(data){
							<?php
							if($filename=="purchase")	
							{
								?>
								window.location.href='<?php echo SITEURL;?>' + '?purchase&_mid='+data;
							<?php
							}
							else
							{
								?>
								window.location.href='<?php echo SITEURL;?>' + '?partnerpurchase&_mid='+data;
							<?php
							}
							?>
						}
					});
		
	});
	
	$("#btnparty").click(function(){
		$(this).prop("disabled",true);
	});
	
	
	$("#txtCOMMISSIONPER").blur(function(){
		
		var commper = parseFloat($(this).val());
		var commamt =  0 ;
		
		
		<?php
		if($filename=="tran-cashpayment" || $filename=="tran-journalpayment" ||$filename=="tran-journalpayment-v")
		{
			?>
				
				var cramt = parseFloat($("#txtCRAMOUNT").val());
				commamt = (cramt * commper) / 100
			<?php
		}
		elseif($filename=="tran-cashreceipt" || $filename=="tran-journalreceipt" ||$filename=="tran-journalreceipt-v" )
		{
			?>
				var dramt = parseFloat($("#txtDRAMOUNT").val());
				commamt = (dramt * commper) / 100
			<?php
		}
		?>
		$("#txtCOMMISSIONAMT").val(getNum(commamt));
	});
	
	
	
	$("#txtCOMMISSIONAMT").blur(function(){
		
		var commamt = parseFloat($(this).val());
		var commper =  0 ;
		
		
		<?php
		if($filename=="tran-cashpayment" || $filename=="tran-journalpayment" || $filename=="tran-journalpayment-v")
		{
			?>
				var cramt = parseFloat($("#txtCRAMOUNT").val());
				commper = (commamt / cramt ) * 100;
			<?php
		}
		elseif($filename=="tran-cashreceipt" || $filename=="tran-journalreceipt" || $filename=="tran-journalreceipt-v")
		{
			?>
				var dramt = parseFloat($("#txtDRAMOUNT").val());
				commper = (commamt/dramt ) * 100
			<?php
		}
		?>
		$("#txtCOMMISSIONPER").val(getNum(commper));
	});
	
	
	$("#MONEYCOL").change(function(){
		
		var money_format = $(this).val();
		switch(money_format)
		{
			case "$":
			{
				$(".TRAN_USD").show();
				$(".TRAN_USD_CONV").hide();
				$(".TRAN_RMB").val(0);
				$(".TRAN_INR").val(0);
				$(".TRAN_RMB_CONV").hide();
				$(".TRAN_RMB").hide();
				$(".TRAN_INR").hide();
			}
			break;
			case "RMB":
			{
				$(".TRAN_RMB").show();
				$(".TRAN_USD").val(0);
				$(".TRAN_INR").val(0);
				$(".TRAN_USD").hide();
				$(".TRAN_RMB_CONV").hide();
				$(".TRAN_USD_CONV").hide();
				$(".TRAN_INR").hide();
			}
			break;
			case "₹":
			{
				$(".TRAN_INR").show();
				$(".TRAN_USD").val(0);
				$(".TRAN_RMB").val(0);
				$(".TRAN_USD").hide();
				$(".TRAN_USD_CONV").hide();
				$(".TRAN_RMB_CONV").hide();
				$(".TRAN_RMB").hide();
			}
			break;
			case "$-₹":
				$(".TRAN_INR").show();
				$(".TRAN_INR").val(0);
				$(".TRAN_RMB").val(0);
				$(".TRAN_USD").show();
				$(".TRAN_USD_CONV").show();
				$(".TRAN_RMB_CONV").hide();
				$(".TRAN_RMB").hide();
			break;
			case "$-RMB":
				$(".TRAN_INR").hide();
				$(".TRAN_INR").val(0);
				$(".TRAN_RMB").val(0);
				$(".TRAN_USD").show();
				$(".TRAN_USD_CONV").show();
				$(".TRAN_RMB_CONV").hide();
				$(".TRAN_RMB").show();
			break;
			case "RMB-₹":
				$(".TRAN_INR").show();
				$(".TRAN_INR").val(0);
				$(".TRAN_USD").val(0);
				$(".TRAN_RMB").show();
				$(".TRAN_RMB_CONV").show();
				$(".TRAN_USD_CONV").hide();
				$(".TRAN_USD").hide();
			break;
			case "$-RMB-₹":
				$(".TRAN_INR").show();
				$(".TRAN_RMB").show();
				$(".TRAN_RMB_CONV").show();
				$(".TRAN_USD_CONV").show();
				$(".TRAN_USD").show();
			break;
		}
		
	});
										
		$(".prodall").click(function(){
			if($(".prodall").is(":checked"))
			{
				$(".prodchk").prop("checked",true);
			}
			else
			{
				$(".prodchk").prop("checked",false);
			}
			
			
		});
		
		
		<?php
		if(isset($_GET["_mid"]) && $filename=="user")
		{
			?>
			$(".divpass").remove();
			<?php
		}
		?>
		<?php
		
		if(isset($_SESSION["user"]))
		{
			
			?>
			$(".menucls").hide();
			var id_numbers = new Array();
			 $.ajax({
					type:"post",
					url:"ajax.php?viewstatus",
					data:{mname:MENUNAME},
					success:function(data){	
					id_numbers=data.split('|');
						
						for (i = 0; i < id_numbers.length; i++) {
							$("li[rel='"+id_numbers[i].trim()+"']").show();
								
							}
					}
				  });
				  
			var MENUNAME = '<?php echo $filename; ?>';
			
			$(".diffcls").hide();
			<?php
		}
		else
		{
			?>
		$(".diffcls").show();
			<?php
		}
		?>
		
			
		
		 $("#barcodeprint").click(function(e){
			 $("#frmstock").attr("target","_blank");
			 $("#frmstock").attr("action","<?php echo SITEURL;?>makepdf.php");
		 });
		 $("#xlsprint").click(function(e){
			 $("#frmstock").attr("target","");
			 $("#frmstock").attr("action","<?php echo SITEURL; ?>makexls.php?makexls=rapnet_1");
		 });
		 
		 $("#printledgerpdf").click(function(e){
		
			$("#frmledgertable").attr("target","_blank");
			$("#frmledgertable").attr("action","<?php echo SITEURL;?>print-pdf.php");
		 });
		 $("#printledger").click(function(e){
		
			$("#frmledgertable").attr("target","");
			<?php
			if($filename == "print-ledger")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-ledger");
				<?php
			}
			elseif($filename == "print-cash")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-cash");
				<?php
			}
			elseif($filename == "print-bank")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-bank");
				<?php
			}
			elseif($filename == "print-profitloss")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-profitloss");
				<?php
			}
			elseif($filename == "print-balancesheet")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-balancesheet");
				<?php
			}
		
			elseif($filename == "print-purchasegst")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-purchasegst");
				<?php
			}
		
			elseif($filename == "print-salegst")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-salegst");
				<?php
			}
			elseif($filename == "print-profitlossschedual")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-profitlossschedual");
				<?php
			}
			elseif($filename == "print-balancesheetschedual")
			{
				?>
				$("#frmledgertable").attr("action","<?php echo SITEURL; ?>?print-balancesheetschedual");
				<?php
			}
			?>
		 });
		 <?php
		 if(isset($_GET["_mid"]))
		 {
		 }
		 else
		 {
			 ?>
			 $(".RMB").hide();
			 <?php
		 }
		 ?>
		  
		  
		  $(".COMMCAL").blur(function(){
			
			  
			
			 
			  getAllTotal();
		  });
		 
		  $(".stockchange").blur(function(){
		     
			 var bar_disc = $(this).val();
			 var status_change=$(this).attr("id");
			 var bar_field=$(this).attr("rel");
			 
			 var arr =bar_field.split("-");
			 var entid = $("#ENTID"+arr[1]).val();
			 var bar_temp = arr[1];
			     
			 $.ajax({
						type:"get",
						url:"ajax-stock.php?bar_disc="+bar_disc+"&bar_field="+bar_field+"&entid="+entid+"&status_change="+status_change,
						success:function(data){
							
						}
					});
			
		 });
		 
		 $(".stockrapchange").blur(function(){
		     
			 var bar_disc = $(this).val();
			 var status_change=$(this).attr("id");
			 var bar_field=$(this).attr("rel");
			 
			 var arr =bar_field.split("-");
			 var entid = $("#ENTID"+arr[1]).val();
			 var bar_temp = arr[1];
			     
			 $.ajax({
						type:"get",
						url:"ajax-stockrapdiscount.php?bar_disc="+bar_disc+"&bar_field="+bar_field+"&entid="+entid+"&status_change="+status_change,
						success:function(data){
							if(data != '' && status_change.substring(0,7) =='RAPDISC')
							{
								var arr_temp = data.split("-");
								
								$("#RAPPERCRT"+bar_temp).val(arr_temp[0]);
								$("#RAPTOTALDOLLAR"+bar_temp).val(arr_temp[1]);
								
							}
						}
					});
			
		 });
		 
		 $("#printtrialpdf").click(function(e){
		
			$("#frmTRIALtable").attr("target","_blank");
			$("#frmTRIALtable").attr("action","<?php echo SITEURL;?>print-pdf.php");
		 });
		 $("#printtrialbalance").click(function(e){
		
			$("#frmTRIALtable").attr("target","");
			$("#frmTRIALtable").attr("action","<?php echo SITEURL; ?>?print-trialbalance");
		 });
		 
		  $("#printdaybookpdf").click(function(e){
		
			$("#frmdaybooktable").attr("target","_blank");
			$("#frmdaybooktable").attr("action","<?php echo SITEURL;?>print-pdf.php");
		 });
		 $("#printdaybook").click(function(e){
		
			$("#frmdaybooktable").attr("target","");
			$("#frmdaybooktable").attr("action","<?php echo SITEURL; ?>?print-daybook");
		 });
		 
		
		//===================uploadFILE RAPNETSTOCK===================
			  $("#Upload_file_stock").change(function(e){
			  if(confirm('Do you really want to upload the file?'))
			  {
				  $("#lodimg").show();
				var formData = new FormData($("#frmstock")[0]);
					
				$.ajax({
					type:"post",
					url:"ajax-xls-filter.php",
					data: formData,
					 processData: false,
					 contentType: false,
					success:function(data){	
					$("#lodimg").hide();
						window.location.href='<?php echo SITEURL."?".$filename;?>';
						
			}
				  });
			  }
		  });
		  
		//===================uploadfileaavakjaavak===================
			  $("#Upload_file_aavakjaavak").change(function(e){
			  if(confirm('Do you really want to upload the file?'))
			  {
				var formData = new FormData($("#frm_upload")[0]);
					
				$.ajax({
					type:"post",
					url:"ajax-xls-aavakjaavak.php",
					data: formData,
					 processData: false,
					 contentType: false,
					success:function(data){	
						//alert(data);
						window.location.href='<?php echo SITEURL."?".$filename;?>';
						
			}
				  });
			  }
		  });
		//===================end of uploadfile=====================
		 
		 $("#Upload_file").change(function(e){
			  if(confirm('Do you really want to upload the file?'))
			  {
				 
				  $("#btnpurchase").prop("disabled",true);
				  $("#lodimg").show();
				  var formData = new FormData($("#frm_Purchase")[0]);
				   
				
				  $.ajax({
					type:"post",
					url:"ajax-xls-bulk.php",
					data: formData,
					 processData: false,
					 contentType: false,
	  
					success:function(data){	
						
						//alert(data);
						$("#listbarcode").html(data); 
						$("#lodimg").hide();
						$("#btnpurchase").prop("disabled",false);

					getAllTotal();
			}
				  });
			  }
		  });
		  
		  
		   $("#Upload_file_sale").change(function(e){
			  if(confirm('Do you really want to upload the file?'))
			  {
				  $("#btnSale").prop("disabled",true);
				  $("#lodimg").show();
				  var formData = new FormData($("#frm_Sale")[0]);
				   
				
				  $.ajax({
					type:"post",
					url:"ajax-xls-bulk-sale.php",
					data: formData,
					 processData: false,
					 contentType: false,
	  
					success:function(data){	
						
						//alert(data);
						$("#listbarcode").html(data); 
						$("#lodimg").hide();
						$("#btnSale").prop("disabled",false);

					getAllTotal();
			}
				  });
			  }
		  });
		  $("#Upload_file_gradingresult").change(function(e){
			  if(confirm('Do you really want to upload the file?'))
			  {
				  $("#btngradingresult").prop("disabled",true);
				  $("#lodimg").show();
				  var formData = new FormData($("#frm_gradingresult")[0]);
				   
				
				  $.ajax({
					type:"post",
					url:"ajax-xls-bulk-gradingresult.php",
					data: formData,
					 processData: false,
					 contentType: false,
	  
					success:function(data){	
						
						//alert(data);
						$("#listbarcode").html(data); 
						$("#lodimg").hide();
						$("#btngradingresult").prop("disabled",false);

					getAllTotal();
			}
				  });
			  }
		  });
		   
		$('.onlyNumber').keypress(function (event) {
			var keycode = event.which;
			if (!(keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57))) 
			{
				event.preventDefault();
			}	
		});
		
		
		/* user name validation */
	
		$('.onlyCharacter').keypress(function (event) {
			var keycode = event.which;
			if (!(keycode == 41 || keycode == 40 || keycode == 92 || keycode == 45 || keycode == 46 || keycode == 47 || keycode == 32 || (keycode >= 65 && keycode <= 90) || (keycode >= 97 && keycode <= 122))) 
			{
				event.preventDefault();
			}	
		});
		
		$("#txtVATAVPER").blur(function(){
			var vatavper =$(this).val();
			var amt_d = parseFloat($("#txtDRAMOUNT").val());
			var amt_c = parseFloat($("#txtCRAMOUNT").val());
			var vatav_a = "";
			if(amt_d > 0)
			{
				vatav_a = (vatavper * amt_d) / 100;
			}
			else if(amt_c > 0 )
			{
				vatav_a = (vatavper * amt_c) / 100;
			}
			 $("#txtVATAVAMOUNT").val(parseFloat(vatav_a));
		});
	
		$("#SelectAll").click(function(){
			
			if($("#SelectAll").is(":checked"))
			{
				$(".SelectAll").prop("checked",true);
			}
			else
			{
				$(".SelectAll").prop("checked",false);
			}
		});
		
		$("#SelectAllView").click(function(){
			
			if($("#SelectAllView").is(":checked"))
			{
				$(".SelectAllView").prop("checked",true);
			}
			else
			{
				$(".SelectAllView").prop("checked",false);
			}
		});
		
		$("#SelectAllAdd").click(function(){
			
			if($("#SelectAllAdd").is(":checked"))
			{
				$(".SelectAllAdd").prop("checked",true);
			}
			else
			{
				$(".SelectAllAdd").prop("checked",false);
			}
		});
		
		
		$("#SelectAllEdit").click(function(){
			
			if($("#SelectAllEdit").is(":checked"))
			{
				$(".SelectAllEdit").prop("checked",true);
			}
			else
			{
				$(".SelectAllEdit").prop("checked",false);
			}
		});
		
		
		$("#SelectAllDelete").click(function(){
			
			if($("#SelectAllDelete").is(":checked"))
			{
				$(".SelectAllDelete").prop("checked",true);
			}
			else
			{
				$(".SelectAllDelete").prop("checked",false);
			}
		});
		
		$(".singlechk").click(function(){
			var rel1= $(this).attr("rel");
			if($(this).is(":checked"))
			{
				$(".singlechk"+rel1).prop("checked",true);
				
			}
			else
			{
					$(".singlechk"+rel1).prop("checked",false);
			}
		});
		
		<?php
		if($filename == "report")
		{
			?>
			$("#examplereport").DataTable({
                responsive: true,
				paging:false,
				sort:false
        });
		$("#examplereport").find(".sizecls").attr('colspan',<?php echo $rptcolspan?>);
		$("#examplereport").find(".sizecls1").css('display','none');
		$("#examplereport").find(".nocls").attr('colspan',<?php echo $rptcolspan?>);
		$("#examplereport").find(".nocls1").css('display','none');
		$("#examplereport").find(".PARTYLIST").hide();
		
		
		
		
		$(".PARTYHEAD").click(function(){
			var lid= $(this).attr("rel");
			$(".PARTYLIST"+lid).toggle();
		});
			<?php
		}?>
		
		<?php
		if($filename == "dashboard")
		{
			?>
			$('#dataTables-example').DataTable({
                responsive: true,
				pageLength:25,
				sort:false
			});
			$('#dataTables-example1').DataTable({
					responsive: true,
					pageLength:25,
					sort:false
			});
			<?php
		}
		else if($filename == "purchase" || $filename == "partnerpurchase" || $filename == "sale" || $filename == "filter" || $filename == "sale-stock")
		{
			?>
			$('#dataTables-example').DataTable({
                responsive: true,
				pageLength:10,
				sort:false
        });
		$('#dataTables-example1').DataTable({
                responsive: true,
				pageLength:10,
				sort:false
        });
			<?php
		}
		else
		{
			?>
		
			$('#dataTables-example').DataTable({
                responsive: true,
				pageLength:10,
				sort:false
        });
		$('#dataTables-example1').DataTable({
                responsive: true,
				pageLength:50,
				sort:false
        });
			<?php
		}
		?>
      
		
		
		$(function(){
			var dtToday = new Date();

			var month = dtToday.getMonth() + 1;
			var day = dtToday.getDate();
			var year = dtToday.getFullYear();

			if(month < 10)
				month = '0' + month.toString();
			if(day < 10)
				day = '0' + day.toString();

			var maxDate = year + '-' + month + '-' + day;    
			$('#dtpENTRYDATE').attr('max', maxDate);
			$('#dtpVOUCHERDATE').attr('max', maxDate);
		});
	
			$('.amtchange_mid').blur(function(){
				
				var rateUSD = $("#txtCONVRATE").val();
				var rateRMB = $("#txtRMBRATE").val();	
				
				var crUSD = $("#txtCRAMOUNTDOLLAR").val();
				var drUSD = $("#txtDRAMOUNTDOLLAR").val();
				
				var crRMB = $("#txtCRRMBAMOUNT").val();
				var drRMB = $("#txtDRRMBAMOUNT").val();
				
				var crINR = $("#txtCRAMOUNT").val();
				var drINR = $("#txtDRAMOUNT").val();
				
				
				var money_format = $("#MONEYCOL").val();
				
				switch(money_format)
				{
					case "$":
					{
						
					}
					break;
					case "RMB":
					{
						
					}
					break;
					case "₹":
					{
						
					}
					break;
					case "$-₹":
					{
						
						if(crUSD > 0)
						{
							//alert("sss");
							$("#txtCRAMOUNT").val((crUSD*rateUSD).toFixed(2))
						}
						else if(drUSD > 0)
						{
							//alert("1");
							$("#txtDRAMOUNT").val((drUSD*rateUSD).toFixed(2))
						}
					}
					break;
					case "$-RMB":
					{
						
						if(crUSD > 0)
						{
							//alert("sss");
							$("#txtCRRMBAMOUNT").val((crUSD*rateUSD).toFixed(2))
						}
						else if(drUSD > 0)
						{
							//alert("1");
							$("#txtDRRMBAMOUNT").val((drUSD*rateUSD).toFixed(2))
						}
					}
					break;
					case "RMB-₹":
					{
						
						if(crRMB > 0)
						{
							//alert(crRMB);
							$("#txtCRAMOUNT").val((crRMB*rateRMB).toFixed(2))
						}
						else if(drRMB > 0)
						{
							//alert(drRMB);
							$("#txtDRAMOUNT").val((drRMB*rateRMB).toFixed(2))
						}
					}
					break;
					case "$-RMB-₹":
					{
						if(crUSD > 0)
						{
							$("#txtCRRMBAMOUNT").val((crUSD*rateUSD).toFixed(2));
							$("#txtCRAMOUNT").val(((crUSD*rateUSD).toFixed(2)*rateRMB).toFixed(2));
						}
						else if(drUSD > 0)
						{
							$("#txtDRRMBAMOUNT").val((drUSD*rateUSD).toFixed(2));
							$("#txtDRAMOUNT").val(((drUSD*rateUSD).toFixed(2)*rateRMB).toFixed(2));
						}
					}
					break;
				}
				$('.gstchange').blur();
		});
	
		
		$('.amtchange').blur(function(){
			
			
			var rateUSD = $("#txtCONVRATE").val();
			var rateRMB = $("#txtRMBRATE").val();	
			
			var crUSD = $("#txtCRAMOUNTDOLLAR").val();
			var drUSD = $("#txtDRAMOUNTDOLLAR").val();
			
			var crRMB = $("#txtCRRMBAMOUNT").val();
			var drRMB = $("#txtDRRMBAMOUNT").val();
			
			var crINR = $("#txtCRAMOUNT").val();
			var drINR = $("#txtDRAMOUNT").val();
			
			
			var money_format = $("#MONEYCOL").val();
			switch(money_format)
			{
				case "$":
				{
					
				}
				break;
				case "RMB":
				{
					
				}
				break;
				case "₹":
				{
					
				}
				break;
				case "$-₹":
				{
					
					if(crUSD > 0)
					{
						//alert("sss");
						$("#txtCRAMOUNT").val((crUSD*rateUSD).toFixed(2))
					}
					else if(drUSD > 0)
					{
						//alert("1");
						$("#txtDRAMOUNT").val((drUSD*rateUSD).toFixed(2))
					}
				}
				break;
				case "$-RMB":
				{
					
					if(crUSD > 0)
					{
						//alert("sss");
						$("#txtCRRMBAMOUNT").val((crUSD*rateUSD).toFixed(2))
					}
					else if(drUSD > 0)
					{
						//alert("1");
						$("#txtDRRMBAMOUNT").val((drUSD*rateUSD).toFixed(2))
					}
				}
				break;
				case "RMB-₹":
				{
					if(crRMB > 0)
					{
						//alert(crRMB);
						$("#txtCRAMOUNT").val((crRMB*rateRMB).toFixed(2))
					}
					else if(drRMB > 0)
					{
						//alert(drRMB);
						$("#txtDRAMOUNT").val((drRMB*rateRMB).toFixed(2))
					}
				}
				break;
				case "$-RMB-₹":
				{
					if(crUSD > 0)
					{
						$("#txtCRRMBAMOUNT").val((crUSD*rateUSD).toFixed(2));
						$("#txtCRAMOUNT").val(((crUSD*rateUSD).toFixed(2)*rateRMB).toFixed(2));
					}
					else if(drUSD > 0)
					{
						$("#txtDRRMBAMOUNT").val((drUSD*rateUSD).toFixed(2));
						$("#txtDRAMOUNT").val(((drUSD*rateUSD).toFixed(2)*rateRMB).toFixed(2));
					}
				}
				break;
			}
			
				
			
		
			
			$('.gstchange').blur();
		});
		
		//gstamount
		
		$('.gstchange').blur(function(){
			var IGST = $("#txtIGSTAMT").val();
			 $("#txtIGSTAMT").val(getNum(IGST));
			 var igstamt= getNum(parseFloat($("#txtIGSTAMT").val()));
			 
			var SGST = $("#txtSGSTAMT").val();
			 $("#txtSGSTAMT").val(getNum(SGST));
			 var sgstamt= getNum(parseFloat($("#txtSGSTAMT").val()));
			
			var CGST = $("#txtCGSTAMT").val();
			 $("#txtCGSTAMT").val(getNum(CGST));
			 var cgstamt= getNum(parseFloat($("#txtCGSTAMT").val()));
			
			var FINALTOTAL = $("#txtCRAMOUNT").val();
			 $("#txtCRAMOUNT").val(getNum(FINALTOTAL));
			 var finalamt=getNum(parseFloat($("#txtCRAMOUNT").val()));
						
			var FINALTOTAL2 = $("#txtDRAMOUNT").val();
			 $("#txtDRAMOUNT").val(getNum(FINALTOTAL2));
			 var finalamt1= getNum(parseFloat($("#txtDRAMOUNT").val()));
			
			var ttl = Math.round(Number(igstamt)) + Math.round(Number(sgstamt)) + Math.round(Number(cgstamt)) + Math.round(Number(finalamt)) + Math.round(Number(finalamt1));
		
			$("#txtGRANDAMOUNT").val(Math.round(ttl));	
				
						
		});
		
		
		
		//===============================================================================
			$('#txtDUEDAYS').blur(function(){
				  var interval = $('#txtDUEDAYS').val();
				  var dd = $('#dtpVOUCHERDATE').val()
					d = new Date(dd);
					//alert(d);
					d.setDate(d.getDate() + parseInt(interval)); 
					
					var days_dd = d.getDate();
					days_dd = days_dd > 9 ? days_dd : "0"+days_dd;
					
					var mm = d.getMonth()+1;
					mm = mm > 9 ? mm : "0"+mm;
					
					var y = d.getFullYear();
			
				
				$('#dtpDUEDATE').val(y + "-" + mm + "-" +days_dd);
		});
	
	$('#txtDALALIPER').blur(function(){
			 
			 var dalaliper = $(this).val();
			 var rsamount = $("#txtTOTALRSAMOUNT").val();
			 $("#txtDALALIAMT").val((rsamount*dalaliper)/100);
			 var rsamount = parseFloat($("#txtTOTALRSAMOUNT").val());
			 $("#txtFINALTOTAL").val(rsamount.toFixed(2));
			 
			 if (dalaliper != '')
			 {
				// alert(dalaliper);
				 $("#txtDALALIAMT").val(((rsamount*dalaliper)/100).toFixed(2));
				 $("#txtFINALTOTAL").val((rsamount -  ((rsamount*dalaliper)/100)).toFixed(2));
			 }
			 getAllTotal();
		});
			
	//-----------sale invoice------
		$('#txtTOTALRSRSPERCRT').blur(function(){
			 
			var TWEIGHT = $("#txtTOTALWEIGHT").val();
			 var TRSPERCRT1 = $("#txtTOTALRSRSPERCRT").val();
			  $("#txtTOTALRSAMOUNT").val((TWEIGHT * TRSPERCRT1 ));			 
			 
			getAllTotalsaleinvoicegst();
		});

	//============================
	
	var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var xno = '<?php echo getMaxValue(BARCODE_PROCESS, "CAST(SUBSTRING(BARCODENO,3) as UNSIGNED)");?>';
	 //alert(xno)
    var x = 1; //initlal text box count
    $(".add_field_button").click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
         xno=$(this).attr("rel");   
		 //alert(xno);
			$.ajax({
				type:"post",
				url:"ajax-field-sale.php",
				data:{addfield:xno,processtype:'<?php echo $filename;?>'},
				success:function(data){
					
					$("#listbarcode").append(data); //add input box
					
					  x++; //text box increment
					  xno++;
					 
					  $(".add_field_button").attr("rel",xno);  
					}
				});
				
            
        }
    });
	
	
	
	 var x = 1; //initlal text box count
    $(".add_field_button_").click(function(e){ //on add input button click
		xno=$(this).attr("rel");     
			
	   e.preventDefault();
        if(x < max_fields){ //max input box allowed
         
			$.ajax({
				type:"post",
				url:"ajax-field-sale.php",
				data:{addfield:xno,sid:'0',processtype:'<?php echo $filename?>'},
				success:function(data){
					
					$("#listbarcode").append(data); //add input box
					  x++; //text box increment
					  xno++;
					 $(".add_field_button_").attr("rel",xno); 
					}
				});
				
            
        }
    });
	
	
	
	//bill status event purchase&sales		 
		
		$('.clsbillstatus').click(function(){
			// alert("s");
			 var bill=$(this).val();
			 var cdate=$("#dtpVOUCHERDATE").val();
			if(bill == "With Bill")
			 {
				  $.ajax({
					type:"post",
					url:"ajax-combo.php?billstatus",
					data: {invoicetype:'<?php echo $filename;?>',voucherdate:cdate},
	  				success:function(data){	
					//alert(data);
						var strarr = data.split('/');
						//$("#txtINVOICECHAR").val(strarr[0]);
						//$("#txtINVOICENO").val(strarr[1]);
						$("#txtINVOICECHAR").val(data);
						$("#txtINVOICENO").val(strarr[1]);
						}
				  });
				 $("#txtINVOICENO").hide("");
				 $("#txtINVOICECHAR").show();
				 $(".ivc").show();
				
			 }
			 else if(bill == "Thid Party Bill")
			 {
				$("#txtINVOICENO").hide("");
				$("#txtINVOICECHAR").show();
				$(".ivc").show();
			 }
			 else
			 {
				
					$("#txtINVOICENO").val("");
					$("#txtINVOICECHAR").val("");
					$("#txtINVOICENO").hide("");
					$("#txtINVOICECHAR").hide("");
					$(".ivc").hide();
				
					
			 }
			  
		 });
		 //bill status sales blur event
		 $('#txtINVOICECHAR').blur(function(){
			 var inchar = $(this).val();
			 if (inchar != '')
			 {
				 //alert(inchar);
				 $.ajax({
						type:"post",
						url:"ajax-combo.php",
						data: {invoicechar:inchar},
						success:function(data){	
							 if (data == 0)
							 {
								 alert("Invoice No:" + inchar + " is already available.")
							 }
							 
							}
					  });
			 }
			 
		});
		
	
		
		
		
		
		
		
	
	$( function() {
		
    $.widget( "custom.combobox", {
		
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox ")
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
       // this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";

        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
		  .attr( "id", $(this.element).attr("id")+"_" )
		   .attr( "name", $(this.element).attr("id")+"_" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left form-control")
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
   
	
      _source: function( request, response ) {
       //alert(request.term);
	    //var re = $.ui.autocomplete.escapeRegex(req.term);
		var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
		
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
	$( "#txtBANKBOOKLEDGERID" ).combobox();
	$( "#txtGROUPID" ).combobox();
    $( "#txtLEDGERID" ).combobox();
	 $( "#txtTHIREDPERID" ).combobox();
	$( "#txtBROKERID" ).combobox();
	
	$("#txtBOOKLEDGERID").combobox();
	$("#txtPARTNERID").combobox();
	
	<?php
	if($filename != 'location')
	{
	?>
	$( "#txtLOCATIONNAME" ).combobox();
<?php	
	}
	?>
  <?php
	if($filename != 'lab')
	{
	?>
	$( "#txtISSUELAB" ).combobox();
<?php	
	}
	?>
  });
  



//===================================================================================
    });
	$(document).keyup(function(e) {
			  if (e.keyCode == 27) { $('.custom_overlay_wrapper').fadeOut(); }   // esc
			});	
	
	
    $(document).on('keypress', 'input,select', function (e) {
			if (e.which == 13) {
				e.preventDefault();
				// Get all focusable elements on the page
				var $canfocus = $(':focusable');
				var index = $canfocus.index(this) + 1;
				if (index >= $canfocus.length) index = 0;
				$canfocus.eq(index).focus();
			}
		});

		$(document).on("blur","#txtBROKERID_", function(e){
		
			var tbid = $("#txtBROKERID").val();
			var tpid = $("#txtLEDGERID").val();
			var flname = '<?php echo $filename;?>';
			if(tbid != '' || tpid != '')
			{
				$.ajax({
					type:"post",
					url:"ajax-tran.php",
					data:{tbid:tbid,tpid:tpid,flname:flname},
					success:function(data){	
					
						$("#listtran").html(data); 			 
						}
					});
			}
				
		});
		
		 $(document).on("click","#chkRMB",function(){
			  
			  if($("#chkRMB").is(":checked"))
			  {
				  $(".RMB").show();
			  }
			  else
			  {
				  $(".RMB").hide();
			  }
		  });
		  
		$(document).on("blur",".rapprice", function(e){
			
			
			
			var rid = $(this).attr("rel");
			var shape = $("#SHAPE"+rid).val();
			var color = $("#COLOR"+rid).val();
			var clarity = $("#CLARITY"+rid).val();
			var weight = getNum($("#WEIGHT"+rid).val());
			
			
			if (shape != "" && color != "" && clarity != "" && weight > 0 )
			{
					$("#btnpurchase").prop("disabled",true);
					$("#lodimg").show();
					$.ajax({
						type:"post",
						url:"ajax-price.php",
						data:{shape:shape,color:color,clarity:clarity,weight:weight},
						success:function(data){
							//alert(data);
								$("#RATE"+rid).val(parseFloat(data).toFixed(2)); 
								
								
								$("#lodimg").hide();
								$("#btnpurchase").prop("disabled",false);
							//$(".txtweightrate").blur();
							}
						});
				
			}
			
				
		});
		<?php 
		if($filename == 'sale')
		{
			?>
			$(document).on("blur","#txtLOCATIONNAME_", function(e){
				
					var tbid = $("#txtLOCATIONNAME_").val();
					if(tbid=="SZ")
					{
						$("#chkRMB").prop("checked",true);
						 if($("#chkRMB").is(":checked"))
						  {
							  $(".RMB").show();
						  }
						  else
						  {
							  $(".RMB").hide();
						  }
						$("#txtBROKERID_").val("MISS YU");
					}
					else
					{
							$("#chkRMB").prop("checked",false);
						if($("#chkRMB").is(":checked"))
						  {
							  $(".RMB").show();
						  }
						  else
						  {
							  $(".RMB").hide();
						  }
						$("#txtBROKERID_").val("");
					}
			});
			<?php
		}
		if($filename == 'tran-cashreceipt' || $filename == 'tran-cashpayment' || $filename =='tran-bankreceipt' || $filename =='tran-bankpayment' || $filename =='tran-bankpayment-sale' || $filename == 'tran-journalreceipt' || $filename == 'tran-journalpayment' || $filename == 'tran-journalreceipt-v' || $filename == 'tran-journalpayment-v')
		{
			?>
			$(document).on("blur","#txtBOOKLEDGERID_", function(e){
					var tbid = $("#txtBOOKLEDGERID").val();
					
					$.ajax({
						type:"post",
						url:"ajax-balance.php",
						data:{tbid:tbid},
						success:function(data){
							//alert(data);
							$("#txtBOOKLEDGERIDBALANCE").html(" ("+data+")"); 
							$("#BOOKLEDGERIDBALANCE").val(data); 	

													
							}
						});
			});
			$(document).on("blur","#txtLEDGERID_", function(e){
					var tbid = $("#txtLEDGERID").val();
					
					$.ajax({
						type:"post",
						url:"ajax-balance.php",
						data:{tbid:tbid},
						success:function(data){
							//alert(data);
							$("#txtLEDGERIDBALANCE").html(" ("+data+")"); 
							$("#LEDGERIDBALANCE").val(data); 	

													
							}
						});
			});
				$(document).on("blur","#txtBROKERID_", function(e){
					var tbid = $("#txtBROKERID").val();
					
					$.ajax({
						type:"post",
						url:"ajax-balance.php",
						data:{tbid:tbid},
						success:function(data){
							//alert(data);
							$("#txtBROKERIDBALANCE").html(" ("+data+")"); 
							$("#BROKERIDBALANCE").val(data); 	

													
							}
						});
			});
			<?php
		}
		?>
		
		
		$(document).on("blur",".GSTCAL",function(){
			getAllTotal();
			
		});
		//===================SALE INVOICE GST====================
		$(document).on("blur",".GSTCALSALEINVOICE",function(){
			getAllTotalsaleinvoicegst();
			
		});
		//================SALE INVOICE GST==================
		
		//=============================================
	$(document).on("blur","#txtLEDGERID_", function(e){
		
			var tpid = $("#txtLEDGERID").val();
			var state = $("#companystate").val();
			if(tpid != '')
			{
			$.ajax({
				type:"post",
				url:"getajax.php",
				data:{tpid:tpid},
				
				success:function(data){
				
					$("#STATE").val(data); 
					if($("#radwithoutbillstatus").is(":checked"))
					{
						$(".thirdpartycls").hide();
						$(".IGST").hide();
						$(".GST").hide();
						$("#txtTHIRDPARTYCHARGESPER").val("0");
						$("#txtSGSTPER").val("0");
						$("#txtCGSTPER").val("0");
						$("#txtIGSTPER").val("0");
						$("#txtTCSPER").val("0");
					}
					else if($("#radthirdpartybillstatus").is(":checked"))
					{
						$(".thirdpartycls").show();
						$(".IGST").hide();
						$(".GST").hide();
						
						$("#txtSGSTPER").val("0");
						$("#txtCGSTPER").val("0");
						$("#txtIGSTPER").val("0");
						$("#txtTCSPER").val("0");
					}
					else if($("#radwithbillstatus").is(":checked"))
					{
						
						if(state != $("#STATE").val(data))
						{
							$(".IGST").show();
							$("#txtIGSTPER").val("<?php echo $rescompanydata["IGSTPER"]?>");
							$(".GST").hide();
							$("#txtSGSTPER").val(0);
							$("#txtCGSTPER").val(0);
						}
						else
						{
							$(".IGST").hide();
							$("#txtIGSTPER").val(0);
							$(".GST").show();
							$("#txtSGSTPER").val("<?php echo $rescompanydata["SGSTPER"]?>");
							$("#txtCGSTPER").val("<?php echo $rescompanydata["CGSTPER"]?>");
						}
						$("#txtTCSPER").val("0");
						$("#txtTHIRDPARTYCHARGESPER").val("0");
						$("#txtTHIRDPARTYTCSPER").val("0");
						$(".thirdpartycls").hide();
					}
					}
				});
			}
			var flname = '<?php echo $filename;?>';
			//alert(flname);
			var tbid = $("#txtBROKERID").val();
			if(tbid != '' || tpid != '')
			{
			$.ajax({
				type:"post",
				url:"ajax-tran.php",
				data:{tbid:tbid,tpid:tpid,flname:flname},
				success:function(data){
					
					$("#listtran").html(data); 			 
					}
				});
			}
				
		});
		

	


			
		//==================================================================================
		$(document).on("blur","#txtTHIRDPARTYCHARGESPER",function(e){
		
		getAllTotal();
			
		});
		$(document).on("blur","#txtTHIRDPARTYTCSPER",function(e){
		
		getAllTotal();
			
		});
		$(document).on("blur",".txtweightrate", function(e){
		
		
			var relval = $(this).attr("rel");
			
				
			<?php
			if($filename=='gradingissue' || $filename=='gradingresult' || $filename=='gradingreceive' || $filename=='repairissue' || $filename=='repairreceive' || $filename=='recutissue' || $filename=='recutreceive')
			{
				?>
				var dollar = parseFloat($("#CONVRATE"+relval).val());
				<?php
			}
			else
			{
				?>
				var dollar = parseFloat($("#txtCONVRATE").val());
				<?php
			}
			?>
			
			var rmb = parseFloat($("#txtRMBRATE").val());
			var weight = parseFloat($("#WEIGHT"+relval).val());
			var rate = parseFloat($("#RATE"+relval).val());
			var DISCPER = getNum($("#DISCPER"+relval).val());
			var DISC2PER = getNum($("#DISC2PER"+relval).val());
			var DISC3PER = getNum($("#DISC3PER"+relval).val());
			
			var RateDollar = (weight * rate);
			
			
			if(!isNaN(DISCPER))
			{
				RateDollar = RateDollar * (1 - DISCPER / 100);
			}
			if(!isNaN(DISC2PER))
			{
				RateDollar = RateDollar * (1 - DISC2PER/ 100)
			}
			
			if(!isNaN(DISC3PER))
			{
				RateDollar  =  RateDollar * (1 - DISC3PER/ 100);
				
			}
			
			
			//RateDollar = getNum(RateDollar);
			$("#RATEDOLLAR"+relval).val(getNum(RateDollar));
			var percrtrate = RateDollar / weight;
			
			//RateDollar = getNum(RateDollar);
			$("#TOTALDOLLAR"+relval).val(getNum(RateDollar));
			$("#PERCRTDOLLAR"+relval).val(getNum((percrtrate)));
			
			
			
			 <?php
			 if($filename == 'purchase' || $filename == 'partnerpurchase' || $filename == 'opening')
			 {
				 ?>
				 
				 if($("#chkRMB").is(":checked"))
					{
						$("#RMBAMOUNT"+relval).attr("value",getNum((RateDollar * dollar)));
						
						$("#RMBPERCRT"+relval).attr("value",getNum((percrtrate * dollar)));	
						
						$("#RSAMOUNT"+relval).val(getNum(($("#RMBAMOUNT"+relval).val() * rmb)));
						$("#RSPERCRT"+relval).val(getNum(($("#RMBPERCRT"+relval).val() * rmb)));						
					}
				else
					{
						 $("#RSAMOUNT"+relval).val(getNum((RateDollar * dollar)));
						 $("#RSPERCRT"+relval).val(getNum((percrtrate * dollar)));
					}
				
				 <?php
			 }
			 else
			 {
				 ?>
				
					if($("#chkRMB").is(":checked"))
					{
						
						$("#RMBAMOUNT"+relval).attr("value",getNum((RateDollar * dollar)));
						$("#RMBPERCRT"+relval).attr("value",getNum((percrtrate * dollar)));	
						
						var rsexp =  parseFloat($("#EXPENCE"+relval).val()) ;
						rsexp = getNum(rsexp);
						var rsamt =  parseFloat(($("#RMBAMOUNT"+relval).val() * rmb) + rsexp) ;
						$("#RSAMOUNT"+relval).val(getNum(rsamt));
						$("#RSPERCRT"+relval).val(getNum(($("#RMBPERCRT"+relval).val() * rmb)));					
					}
					else
					{
				
						var rsexp =  parseFloat($("#EXPENCE"+relval).val()) ;
						var expamt = isNaN(rsexp) ? 0 : rsexp;
					
						var rsamt =  parseFloat((RateDollar * dollar)  + expamt) ;
				
						$("#RSAMOUNT"+relval).val(getNum(rsamt));
						$("#RSPERCRT"+relval).val(getNum((percrtrate * dollar)));
					}
					var sal_Amt = $("#RSAMOUNT"+relval).val();
					var PUR_Amt = $("#PURAMOUNT"+relval).val();
					 var diffamt =  sal_Amt - PUR_Amt;
					 $("#DIFFAMOUNT"+relval).val(getNum(diffamt));
				 <?php
			 }
				 ?>
			
			
			getAllTotal();
			
			 
		});
		
		
		
	//===================showfilter==================
	
	$(document).on("click","#showfilter", function(e){ 
			
				$("#displayfilter").slideToggle();
	});
	//===================showfilter=====================
	//=================partnerstatus================

	$(document).on("click","#chkPARTNERSTATUS", function(e){ 
			
				if($("#chkPARTNERSTATUS").is(":checked"))
					{
						
							$(".PARTNERSTATUS").slideDown();
							getAllTotal();
							
					}
					else
					{
							
							$(".PARTNERSTATUS").slideUp();
							$("#txtPARTNERID").val("");
							$("#txtPARTNERPER").val("0");
							$("#txtPARTNERAMOUNT").val("0");
							getAllTotal();
							
					}
	});
	$(document).on("blur","#txtPARTNERPER", function(e){ 
	getAllTotal();
	});
	//=================partnerstatus================
	
	
	//=================paymentstatus================

	$(document).on("click","#chkPAYMENTSTATUS", function(e){ 
			
				if($("#chkPAYMENTSTATUS").is(":checked"))
					{
						
							$(".PAYMENTSTATUS").slideDown();
					}
					else
					{
							
							$(".PAYMENTSTATUS").slideUp();
					}
	});
	//=================paymentstatus================
	
	//================withoutbill==================================
		$(document).on("click","#radwithoutbillstatus", function(e){ 
				$("#txtSGSTPER").val("0");
				$("#txtCGSTPER").val("0");
				$("#txtIGSTPER").val("0");
				$("#txtTHIRDPARTYCHARGESPER").val("0");
				$("#txtTHIRDPARTYTCSPER").val("0");
				$("#txtTCSPER").val("0");
			
				$(".thirdpartycls").hide();
				$(".GST").hide();
				getAllTotal();
			
	});
	
	//================withoutbill==================================
	//====================withbill=========================================
	$(document).on("click","#radwithbillstatus", function(e){ 
			
			var state_cd = $("#STATE").val(); 
			
			if(state_cd != $("#companystate").val())
				{
					
					
					$("#txtIGSTPER").val("<?php echo $rescompanydata["IGSTPER"]?>");
					$(".GST").show();
						
				}
			else
					{
						$(".GST").hide();
					
					}
			
			$("#txtTHIRDPARTYCHARGESPER").val("0");
			$("#txtTHIRDPARTYCHARGES").val("0");
			$("#txtTHIRDPARTYTCSPER").val("0");
			$("#txtTHIRDPARTYTCS").val("0");
			$(".thirdpartycls").hide();
			getAllTotal();
			
	});
		
	//======================withbill=======================================
	$(document).on("click","#radthirdpartybillstatus", function(e){ 
			$("#txtSGSTPER").val("0");
			$("#txtCGSTPER").val("0");
			$("#txtIGSTPER").val("0");
			$("#txtTCSPER").val("0");	
			$(".GST").hide();
			$(".thirdpartycls").show();
				
				getAllTotal();
			
	});
	//=================================================
	
	
	//================sale invoicewithoutbill==================================
		$(document).on("click","#radwithoutbillstatussaleinvoice", function(e){ 
				$("#txtSGSTPER").val("0");
				$("#txtCGSTPER").val("0");
				$("#txtIGSTPER").val("0");
				
				$("#txtTHIRDPARTYCHARGESPER").val("0");
				$("#txtTHIRDPARTYTCSPER").val("0");
				$(".GSTSALEINVOICE").hide();
				getAllTotalsaleinvoicegst();
			
	});
	
	//================sale invoice withoutbill==================================
	//====================sale invoice withbill=========================================
	$(document).on("click","#radwithbillstatussaleinvoice", function(e){ 
			var state_cd = $("#STATE").val(); 
			
			if(state_cd != $("#companystate").val())
				{
					
						$(".GSTSALEINVOICE").show();
						
					}
			else
					{
						$(".GSTSALEINVOICE").hide();
					
					}
			
				
				getAllTotalsaleinvoicegst();
			
	});
		
	
    $("#listbarcode").on("click",".remove_field", function(e){ //user click on remove text
     
		var barno = $(this).attr("rel");
		$.ajax({
				type:"post",
				url:"ajax.php?remove_field=Y",
				data:{barno:barno},
				success:function(data){
					
					}
				});
				
		$(this).parent().parent().remove(); x--;
		 $(".txtweightrate").blur();
		
			 
    });
		
	$(document).on("blur",".bs_", function(e){ //========================================saling barcode data
    var tempstr = $(this).val();
		<?php
		if($filename == "purchase" || $filename == "partnerpurchase")
		{
		}
		else{
			?>
			if(tempstr.substr(0,2)=="GP")
			{
			
			}
			else
			{
			    $(this).val("GP"+$(this).val());
			}
			
			<?php
		}
		
		?>
		var sid = $(this).val();
		var convrate = $("#txtCONVRATE").val();
		
	
		var RMBSTATUS = $("#chkRMB").is(":checked") ? "Y" :"";
		var rmbrate  = $("#txtRMBRATE").val();
		var relval =sid.substring(2);
		var processtype = $(this).attr("rel");
		
		<?php
		if($filename=='gradingresult')
		{
			?>
			var isslab = $("#txtISSUELAB").val();
			<?php
		}
		?>
		if (sid != "" && !$(this).prop("readonly"))
		{
		$(this).attr("value","GP"+relval);			
		$(this).attr("id","BARCODENO"+relval);	
		$(this).parent().parent().attr("id","bar"+relval);
			

			$("#lodimg").show();
			$.ajax({
				type:"post",
				url:"ajax_.php",
				<?php
				if($filename=='gradingresult')
				{
					?>
					data:{sid:sid,convrate:convrate,processtype:processtype,RMBSTATUS:RMBSTATUS,rmbrate:rmbrate,isslab:isslab},
					<?php
				}
				else
				{
					?>
					data:{sid:sid,convrate:convrate,processtype:processtype,RMBSTATUS:RMBSTATUS,rmbrate:rmbrate},
					<?php
				}
				?>
				
				success:function(data){
					//alert(data);
						if(data == "1")
						{						
							alert("Stock Id Is Already Available");
			
							$("#BARCODENO"+relval).val("");	
						}
						else if(data == "")
						{
							
							alert("Stock Id Is Not Available");
							$("#BARCODENO"+relval).val("");	
						}
						else	
						{
							$(this).val("GP"+relval);	
							$("#BARCODENO"+relval).prop("readonly",true);
							$("#bar"+relval).append(data);
							
					
						}
						$("#btnpurchase").prop("disabled",false);
						$("#lodimg").hide();
						getAllTotal();
						window.location.hash = '#SHAPE'+relval;
					}
				});
				
		}
	
			 
    });
	
	
	
		$(document).on('keyup', ".myAjax",function () {
		
			var currentElement=$(this);
		
			$.ajax({
				type:"post",
				url:'myval.php',
				success:function(data){
					$($(currentElement).closest('.myParentAjax').find('.myAjaxArea')).html(data);
					}
				});
		});
		
		
			$(document).on("click","#sameshipadd",function(){
			if($("#sameshipadd").is(":checked"))
			{
				$("#txtSHIPPINGADDRESS").val($("#txtADDRESS").val());
				$("#txtSHIPPINGCITY").val($("#txtCITY").val());
				$("#txtSHIPPINGSTATE").val($("#txtSTATE").val());
				$("#txtSHIPPINGSTATECODE").val($("#txtSTATECODE").val());
				$("#txtSHIPPINGCOUNTRY").val($("#txtCOUNTRY").val());
			}
			else
			{
				$("#txtSHIPPINGADDRESS").val('');
				$("#txtSHIPPINGCITY").val('');
				$("#txtSHIPPINGSTATE").val('');
				$("#txtSHIPPINGSTATECODE").val('');
				$("#txtSHIPPINGCOUNTRY").val('');
			}
			
		});
		
		
		$(document).on('click', ".open_custom_overlay",function () {
		
			var id = $(this).attr("rel");
				//alert(id)
				
				if(id.indexOf('-') > 0)
				{
					getData1(id);
				}
				else
				{
					//alert(id)
					getData(id);
				}
		});
		
		
			$(document).on("click","#ledgerPOPUP",function(){
			var mydata = $("#frmnewledger").serialize();
			$.ajax({
					url : '<?php echo SITEURL?>ajax_ledger.php?ledgersave',
					type: 'POST',
					data:mydata,
					success : function(data){
						var outstr = data;
						var arrstr = outstr.split(";");
				
						
						if(arrstr[1] ==40)
						{
							
						$("#txtTHIREDPERID").html(arrstr[0]);	
						$( "#txtTHIREDPERID").combobox();
						}
						else if(arrstr[1] ==41)
						{
							
						$("#txtPARTNERID").html(arrstr[0]);	
						$( "#txtPARTNERID").combobox();
						}
						else if(arrstr[1]==29)
						{
							$("#txtBROKERID").html(arrstr[0]);	
						$( "#txtBROKERID").combobox();
						}
						else
						{
								
							$("#txtLEDGERID").html(arrstr[0]);	
							$( "#txtLEDGERID").combobox();
							
							<?php
							if($filename!='sale')
							{
								?>
								$("#txtBOOKLEDGERID").html(arrstr[0]);	
							$( "#txtBOOKLEDGERID").combobox();
								<?php
							}
							?>
						}
					$('.custom_overlay_wrapper').fadeOut();	
						
						
					}
				});
	});
	$(document).on("blur","#txtGROUPID_",function(){
		var state_cd = $(this).val(); 
		if(state_cd == 'Secured Loans')
		{
			$(".GROUPSTATUS").show();	
		}
		else
		{
			$(".GROUPSTATUS").hide();
		}
	});
	
			
			$(document).on("change","input[type='search']",function(){

			var sum = 0;
			var sum_PCS = 0;
			$('.rsamount_cls').each(function(){
				sum += parseFloat(this.value);
				sum_PCS += 1;
			});
		$("#stock_rsamount_total").val(sum);
		$("#stock_pcs_total").val(sum_PCS);
		
		});


$(document).on('blur', ".EXPENCE_",function () {
		getAllTotal();
		
		});
		
		
function getAllTotalsaleinvoicegst()
{
			 	if($("#radwithbillstatussaleinvoice").is(":checked"))
				{
					 var igstper = $("#txtIGSTPER").val();
					if (igstper != '')
					{
					 var rsamount = $("#txtTOTALRSAMOUNT").val();
					 var igstamt = getNum(((rsamount*igstper)/100))
					 $("#txtIGSTAMT").val(Math.round(igstamt));
					}
				  var cgstper = $("#txtCGSTPER").val();
					if (cgstper != '')
					{
					 var rsamount = $("#txtTOTALRSAMOUNT").val();
					 $("#txtCGSTAMT").val(getNum(((rsamount*cgstper)/100)));
					}
				  var sgstper = $("#txtSGSTPER").val();
					if (sgstper != '')
					{
					 var rsamount = $("#txtTOTALRSAMOUNT").val();
					 $("#txtSGSTAMT").val(getNum(((rsamount*sgstper)/100)));
					}
				}
				else{
					$("#txtIGSTAMT").val(0);
					 $("#txtSGSTAMT").val(0);
					 $("#txtCGSTAMT").val(0);
				}
			
			  
				
				var igstamt= Math.round(parseFloat($("#txtIGSTAMT").val()));
				var cgstamt= Math.round(parseFloat($("#txtCGSTAMT").val()));
				var sgstamt= Math.round(parseFloat($("#txtSGSTAMT").val()));
				
				
				
				//var dalaliamt = parseFloat($("#txtDALALIAMT").val());
				var finalamount = parseFloat( $("#txtTOTALRSAMOUNT").val());
				var ttl = igstamt + cgstamt + sgstamt + finalamount ;
				$("#txtGRANDAMOUNT").val(Math.round(ttl));
			
				var anstemp = parseFloat(ttl)
			
				 var LASTAMOUNT = anstemp ;
					$("#txtLASTAMOUNT").val(Math.round(LASTAMOUNT));
				
					
}

function getAllTotal()
{	
	var partnerper = 100 - parseFloat($("#txtPARTNERPER").val());
	var partnerper_ =  parseFloat($("#txtPARTNERPER").val());
	
	var barcodenocnt = 0;
			$('.BARCODENO_').each(function (index, value){
			 barcodenocnt++;
			});
			 $("#txtTOTALQTY").val(barcodenocnt);
			 
			var weightcnt = 0;
			$('.WEIGHT_').each(function (index, value){
			 weightcnt += parseFloat($(this).val());
			});
			 $("#SUMWEIGHT").val(getNum((weightcnt)));
			 
			var cnt = 0;
			$('.RATE_').each(function (index, value){
			 cnt += parseFloat($(this).val());
			});
			 $("#SUMRATE").val(getNum(cnt));
			 
			var cnt = 0;
			var cntSUM = 0;
			$('.DISCPER_').each(function (index, value){
			cnt++;
			 cntSUM += parseFloat($(this).val());
			});
			 $("#AVGDISCPER").val(getNum((cntSUM/cnt)));
			
			var cnt = 0;
			$('.RATEDOLLAR_').each(function (index, value){
			 cnt += parseFloat($(this).val());
			});
			 $("#SUMRATEDOLLAR").val(getNum(cnt));
			 
			var cnt = 0;
			var cntSUM = 0;
			$('.DISC2PER_').each(function (index, value){
				cnt++;
				cntSUM += parseFloat($(this).val());
			});
			 $("#AVGDISC2PER").val(getNum((cntSUM/cnt)));
			 
			var cnt = 0;
			var cntSUM = 0;
			$('.DISC3PER_').each(function (index, value){
				cnt++;
				cntSUM += parseFloat($(this).val());
			});
			 $("#AVGDISC3PER").val(getNum((cntSUM / cnt)));
			 
			var cnt = 0;
			$('.PERCRTDOLLAR_').each(function (index, value){
			 cnt += parseFloat($(this).val());
			});
			 $("#txtPERCRTTOTALDOLLAR").val(getNum(cnt));
			
			var cnt = 0;
			$('.TOTALDOLLAR_').each(function (index, value){
			 cnt += parseFloat($(this).val());
			});
			 $("#txtTOTALDOLLAR").val(getNum(cnt));
			 
		
			 var cnt = 0;
			$('.RSPERCRT_').each(function (index, value){
			 cnt += parseFloat($(this).val());
			});					
			 $("#txtTOTALRSRSPERCRT").val(getNum(cnt));
			 
			var cnt = 0;
			$('.RMBPERCRT_').each(function (index, value){
			 cnt += parseFloat($(this).val());
			});					
			 $("#txtTOTALRMBPERCRT").val(getNum(cnt));

			 
			
			 
			 <?php
			 if($filename == 'purchase' || $filename == 'partnerpurchase'|| $filename == 'opening' )
			 {
				 ?>
				 var cnt = 0;
				$('.RSAMOUNT_').each(function (index, value){
				 cnt += parseFloat($(this).val());
				});
				 $("#txtTOTALRSAMOUNT").val(getNum(cnt));
				 
				  var cnt = 0;
				$('.RMBAMOUNT_').each(function (index, value){
				 cnt += parseFloat($(this).val());
				});
				
				 $("#txtTOTALRMBAMOUNT").val(getNum(cnt));
				 
				 <?php
			 }
			 elseif($filename == 'sale' || $filename == 'memoissue' || $filename == 'memoreceive' || $filename == 'repairreceive' || $filename == 'repairissue' || $filename == 'recutreceive' || $filename == 'recutissue' || $filename == 'gradingissue' || $filename == 'gradingresult' || $filename == 'gradingreceive')
			 {
				 ?>
				
				  var cnt = 0;
				$('.EXPENCE_').each(function (index, value){
				 cnt += parseFloat($(this).val());
				});
				 $("#txtTOTALEXPENCE").val(getNum(cnt));
				 var cnt = 0;
				$('.RSAMOUNT_').each(function (index, value){
				 cnt += parseFloat($(this).val());
				});
				 $("#txtTOTALRSAMOUNT").val(getNum(cnt));
				 
				 var cnt = 0;
				$('.RMBAMOUNT_').each(function (index, value){
				 cnt += parseFloat($(this).val());
				});
				 $("#txtTOTALRMBAMOUNT").val(getNum(cnt));
				 
				 <?php
			 }
			 ?>
			
			   var ttl = parseFloat($("#txtTOTALRSAMOUNT").val());
			  $("#txtFINALTOTAL").val(ttl);
			  
			  
			
			  
			 var dalaliper = parseFloat($("#txtDALALIPER").val());
			 if (dalaliper > 0 )
			 {
				 var rsamount = $("#txtTOTALRSAMOUNT").val();
				 $("#txtDALALIAMT").val(getNum(((rsamount*dalaliper)/100)));
				 $("#txtFINALTOTAL").val((rsamount -  ((rsamount*dalaliper)/100)).toFixed(2));
			 }
			 $("#txtCOMMCHARGE").val($("#txtFINALTOTAL").val());
			 
			 //==============================================
			  
			  if($("#txtTHIREDPERID_").val() != "")
			  {
				  
				  var txtCOMMCHARGE = parseFloat($("#txtCOMMCHARGE").val());
				  var txtCOMMDISC1PER = parseFloat($("#txtCOMMDISC1PER").val());
				  var txtCOMMDISC2PER = parseFloat($("#txtCOMMDISC2PER").val());
				  var txtTOTALCOMM = parseFloat($("#txtCOMMCHARGE").val());
				  
				 
				  var txtCOMM1 = 0;
				  var txtCOMM2 = 0;
				 
				  if(txtCOMMDISC1PER > 0 )
				  {
					  txtCOMM1 =  ((txtCOMMCHARGE * txtCOMMDISC1PER) / 100);
					  txtCOMMCHARGE = txtCOMMCHARGE + txtCOMM1;
					 
				  }
				   if(txtCOMMDISC2PER > 0 )
				  {
					  
					  txtCOMM2 =  ((txtCOMMCHARGE * txtCOMMDISC2PER) / 100);
				
					   
				  }
				
					   txtTOTALCOMM = parseFloat(txtCOMM1)+parseFloat(txtCOMM2);
						$("#txtTOTALCOMM").val(txtTOTALCOMM);
			  }
			  else
			  {
				  $("#txtTOTALCOMM").val(0);
			  }
			  //================================================
				
			 
			 
			 	if($("#radwithbillstatus").is(":checked"))
				{
					var igstper = $("#txtIGSTPER").val();
					if (igstper != '')
					{
					 var rsamount = $("#txtFINALTOTAL").val();
					 var igstamt = getNum(((rsamount*igstper)/100));
					 $("#txtIGSTAMT").val(Math.round(igstamt));
					}
					var cgstper = $("#txtCGSTPER").val();
					if (cgstper != '')
					{
					 var rsamount = $("#txtFINALTOTAL").val();
					 $("#txtCGSTAMT").val(getNum(((rsamount*cgstper)/100)));
					}
					var sgstper = $("#txtSGSTPER").val();
					if (sgstper != '')
					{
					 var rsamount = $("#txtFINALTOTAL").val();
					 $("#txtSGSTAMT").val(getNum(((rsamount*sgstper)/100)));
					}
					var tcsper = $("#txtTCSPER").val();
					if (tcsper != '')
					{
					var rsamount = $("#txtFINALTOTAL").val();
					var tcsper = getNum(((rsamount*tcsper)/100));
					$("#txtTCSAMT").val(Math.round(tcsper));
					}
					
					
				}
				else if($("#radthirdpartybillstatus").is(":checked"))
				{
					$("#txtIGSTAMT").val(0);
					$("#txtSGSTAMT").val(0);
					$("#txtCGSTAMT").val(0);
					$("#txtTCSAMT").val(0);
					var thirdpartchargesper = $("#txtTHIRDPARTYCHARGESPER").val();
					if (thirdpartchargesper != '')
					{
					 var rsamount = $("#txtFINALTOTAL").val();
					 var temp3partycharges = getNum(((rsamount*thirdpartchargesper)/100));
					 $("#txtTHIRDPARTYCHARGES").val(Math.round(temp3partycharges));
					}
					var thirdpartytcsper = $("#txtTHIRDPARTYTCSPER").val();
					if (thirdpartytcsper != '')
					{
					 var rsamount = $("#txtFINALTOTAL").val();
					 var temp3partytcs = getNum(((rsamount*thirdpartytcsper)/100));
					 $("#txtTHIRDPARTYTCS").val(Math.round(temp3partytcs));
					}
					
				}
				else{
				
					$("#txtIGSTAMT").val(0);
					$("#txtSGSTAMT").val(0);
					$("#txtCGSTAMT").val(0);
					$("#txtTCSAMT").val(0);
				}
				
				
				if($("#radwithbillstatus").is(":checked"))
				{
				
					var igstper = $("#txtIGSTPER").val();
					if (igstper != '')
					{
					 var rsamount_ = (($("#txtTOTALRSAMOUNT").val()*partnerper_)/100);
					 var igstamount = parseFloat(((rsamount_*igstper)/100));
					 $("#txtPARTNERAMOUNT").val(Math.round(rsamount_ + igstamount));
					}
					var tcsper = $("#txtTCSPER").val();
					if (tcsper != '')
					{
					 var rsamount_ = (($("#txtTOTALRSAMOUNT").val()*partnerper_)/100);
					 var tcsamount = parseFloat(((rsamount_*tcsper)/100));
					 $("#txtPARTNERAMOUNT").val(Math.round(rsamount_ + tcsamount));
					}
				  
					
				}
				else if($("#radthirdpartybillstatus").is(":checked"))
				{
					var thirdpartychargesper = $("#txtTHIRDPARTYCHARGESPER").val();
									
					if (thirdpartychargesper != '')
					{
						var rsamount_ = (($("#txtTOTALRSAMOUNT").val()*partnerper_)/100);
						var thirdpartyamount = parseFloat(((rsamount_*thirdpartychargesper)/100));
						$("#txtPARTNERAMOUNT").val(Math.round(rsamount_ + thirdpartyamount));
					}
				  var thirdpartytcsper = $("#txtTHIRDPARTYTCSPER").val();
									
					if (thirdpartytcsper != '')
					{
						var rsamount_ = (($("#txtTOTALRSAMOUNT").val()*partnerper_)/100);
						var thirdpartytcsamount = parseFloat(((rsamount_*thirdpartytcsper)/100));
						$("#txtPARTNERAMOUNT").val(Math.round(rsamount_ + thirdpartytcsamount));
					}
				  
					
				}
				else{
					var patamt = getNum((($("#txtTOTALRSAMOUNT").val()*partnerper_)/100));
					$("#txtPARTNERAMOUNT").val(Math.round(patamt));
				}
			
			  
				
				var igstamt= parseFloat($("#txtIGSTAMT").val());
				var cgstamt= parseFloat($("#txtCGSTAMT").val());
				var sgstamt= parseFloat($("#txtSGSTAMT").val());
				var tcsamt= parseFloat($("#txtTCSAMT").val());
				
				var thirdpartycharges_amt = parseFloat($("#txtTHIRDPARTYCHARGES").val());
				var thirdpartycharges_tcs = parseFloat($("#txtTHIRDPARTYTCS").val());
				
				var finalamount = parseFloat($("#txtFINALTOTAL").val());
				
				igstamt = getNum(igstamt);
				cgstamt = getNum(cgstamt);
				sgstamt = getNum(sgstamt);
				tcsamt = getNum(tcsamt);
				thirdpartycharges_amt = getNum(thirdpartycharges_amt);
				thirdpartycharges_tcs = getNum(thirdpartycharges_tcs);
				
				
				var ttl = Math.round(igstamt) +  Math.round(cgstamt) +  Math.round(sgstamt) +  Math.round(tcsamt) + Math.round(thirdpartycharges_amt)+ Math.round(thirdpartycharges_tcs) +  Math.round(finalamount) ;
				
				$("#txtGRANDAMOUNT").val(getNum(ttl));
			
			
				
				
				var ttlcomm = parseFloat($("#txtTOTALCOMM").val());
				
				var parentamount = getNum(parseFloat($("#txtPARTNERAMOUNT").val()));
				var anstemp = Math.round(ttl); //parseFloat(ttl - parentamount)
				 <?php
			 if($filename == 'purchase' || $filename == 'partnerpurchase' || $filename == 'opening' )
			 {
				 ?>
				 var LASTAMOUNT = anstemp + Number(getNum(ttlcomm));
					$("#txtLASTAMOUNT").val(getNum(LASTAMOUNT));
				 <?php
			 }
			 else
			 {
				 ?>
				 var LASTAMOUNT = anstemp - Number(getNum(ttlcomm));
				$("#txtLASTAMOUNT").val(getNum(LASTAMOUNT));
				 <?php
			 }
				 ?>
				 
				
					
}

function getNum(val1) {
	
   if (isNaN(val1)) {
	   return 0;
   }
   var ans =  parseFloat(val1);
   return ans.toFixed(2);
}

	
function callAjax(url,val1,val2,val3)
		{
			$.ajax({
				type:"post",
				url:url,
				data:{val1:val1,val2:val2,val3:val3},
				success:function(data){
				
					$("#"+val3).html(data);
					}
				});
			
		}


		function getDataledger(id,gid="") {
			
			if (id=="")
			{
				$.ajax({
					url : '<?php echo SITEURL?>ajax_ledger.php?gid='+gid,
					type: 'POST',
					success : function(data){
						$("#purchase_data").html(data);						
						
						$('.custom_overlay_wrapper').fadeIn();
					}
				});
			}	
		}
		
		function getData(id) {
			$.ajax({
				url : '<?php echo SITEURL?>ajax.php?newbarcode='+id,
				type: 'POST',
				success : function(data){
					//alert(data);
					$("#purchase_data").html(data)
					$('.custom_overlay_content').addClass('single_entry');
					
					$('.custom_overlay_wrapper').fadeIn();
					$("#SEARCHBARCODE").val("");
				}
			});
		}
		
		function getData1(id) {
			
			$.ajax({
				url : '<?php echo SITEURL?>ajax.php?id='+id,
				type: 'POST',
				success : function(data){
					$("#purchase_data").html(data)
					
					$('.custom_overlay_content').addClass('single_entry');
					
					
					$('.custom_overlay_wrapper').fadeIn();
				}
			});
		}
		
		
		
	</script>
	<style>
	.custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
		.myParentAjax {
			position: relative;
		}
		.myAjaxArea {
			position: absolute;
			border: 1px solid #000;
			background: #fff;
			width: 100%;
			max-height: 150px;
    overflow: auto;
		}
		input.error, textarea.error, select.error
			{
				border: solid 2px red !important;
				color:#000;
			}
			label.error{
				color:red;
				display:none !important;
			}
			.ui-widget.ui-widget-content {
    max-height: 200px;
    overflow-y: auto;
    overflow-x:hidden;
	z-index:1111;
}
	</style>
	
	<!--
<script type='text/javascript'>
(function(){ var widget_id = 'b8IR7x5aGB';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
-->
</body>

</html>
