<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");


if(isset($_SESSION["adminuser"]))
	{
		$loginuser_name = $_SESSION["adminuser"];
		$user_name = $_SESSION["adminuser"];
	}
	elseif(isset($_SESSION["user"]))
	{
		$loginuser_name = $_SESSION["user"];
		$user_name = getFieldDetail(USER,"CONCAT(FIRSTNAME,' ',LASTNAME)"," WHERE USERNAME='".$_SESSION["user"]."'");
	}
	
if(isset($_GET["ledgersave"]))
{
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	
	foreach($PostArr_Key as $tempctrl)
	{
		$colname_prefix = substr($tempctrl,0,3);
		$colname = substr($tempctrl,3);
		if(substr($tempctrl,strlen($tempctrl)-1,1) != "_")
		{
			
		switch($colname_prefix)
		{
			case "txt":
				array_push($FieldArr_Col,$colname);
				array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");
			break;
		}
		}
	}
	array_push($FieldArr_Col,"FLAG");
	array_push($FieldArr_Val,"'0'");
	array_push($FieldArr_Col,"UPDATEDATE");
	array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
	array_push($FieldArr_Col,"USERNAME");
	array_push($FieldArr_Val,"'".$loginuser_name."'");
	array_push($FieldArr_Col,"ENTRYDATE");
	array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
    $LEDGERID = newData($FieldArr_Col,$FieldArr_Val,LEDGER,TRUE);
	$stroutput="";
	
	if(($_POST["txtGROUPID"]) == "40")
	{
		$stroutput = '<option value=""> Select Third Party </option>';
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID='40'");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														$stroutput .='<option value="'.$res_led_data["LEDGERID"].'" >'.$res_led_data["LEDGERNAME"].'</option>';
													}
		$stroutput .=";".$_POST["txtGROUPID"];
	}
	elseif(($_POST["txtGROUPID"]) == "41")
	{
		$stroutput = '<option value=""> Select Partner </option>';
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID='41'");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														$stroutput .='<option value="'.$res_led_data["LEDGERID"].'" >'.$res_led_data["LEDGERNAME"].'</option>';
													}
		$stroutput .=";".$_POST["txtGROUPID"];
	}
	elseif(($_POST["txtGROUPID"]) == "29")
	{
		$stroutput = '<option value="">Select Broker</option>';
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID='29'");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														$stroutput .='<option value="'.$res_led_data["LEDGERID"].'" >'.$res_led_data["LEDGERNAME"].'</option>';
													}
		$stroutput .=";".$_POST["txtGROUPID"];
	}
	else
	{
		$stroutput = '<option value="">Select Party</option>';
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID='". $_POST["txtGROUPID"] ."'");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														$stroutput .='<option value="'.$res_led_data["LEDGERID"].'" >'.$res_led_data["LEDGERNAME"].'</option>';
													}
		$stroutput .=";".$_POST["txtGROUPID"];
	}
	echo $stroutput;
}
else
{
	
?>
			
	
	

		<h1 class="page-header">Account</h1>



		<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				
				<div class="panel-body">
					
					<form id="frmnewledger" method="POST" >
						<input type="hidden" name="GROUPID" id="GROUPID" value="<?php echo $_GET["gid"];?>">
						
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label style="color:#000;">Account Name</label></td>
									<td><label style="color:#000;">Group</label></td>
								</tr>
								<tr>
									<td>
									 <input class="form-control" name="txtLEDGERNAME" id="txtLEDGERNAME" value="">
									</td>
									<td class="ui-widget">
										 <select class="form-control" name="txtGROUPID" id="txtGROUPID">
											<option value=""> Select Group </option>
											<?php
											$res_acgrp = getData(ACGROUP,$AllArr," WHERE FLAG='0'");
											while($res_acgrp_data = mysqli_fetch_assoc($res_acgrp))
												{
													?>
													<option value="<?php echo $res_acgrp_data["GROUPID"];?>" <?php echo $res_acgrp_data["GROUPID"] == $_GET["gid"] ? 'selected="selected"':'';?>><?php echo $res_acgrp_data["GROUPNAME"];?></option>
													<?php
												}
											?>
										</select>
									</td>
								</tr>
								
								
                            <tr>
							<td><label style="color:#000;"> Address</label></td>
							</tr>
							<tr>
							<td>
                            <textarea class="form-control" name="txtADDRESS" id="txtADDRESS"></textarea>
                                <p class="help-block"></p>
                        
						
							</td>						
						</tr>
						<tr>
							<td><label style="color:#000;">City</label></td>
							<td><label style="color:#000;">State</label></td>
							<td><label style="color:#000;">State Code</label></td>
							<td><label style="color:#000;">Country</label></td>
						</tr>
						<tr>
							<td>
								<input type="text" class="form-control " name="txtCITY" id="txtCITY" value="">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSTATE" id="txtSTATE" value="">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSTATECODE" id="txtSTATECODE" value="">
									</td>
									<td>
										<input type="text" class="form-control" name="txtCOUNTRY" id="txtCOUNTRY" value="">
									</td>
                                <p class="help-block"></p>			
						</tr>
						<tr>
						<td>
						<input type="checkbox" value="" name="sameshipadd" ID ="sameshipadd" class=""/><label style="color:#000;"> SAME AS ABOVE </label>
						</td>
						</tr>
						<tr>
						<tr>
									<td><label style="color:#000;">Shipping City</label></td>
									<td><label style="color:#000;">Shipping State</label></td>
									<td><label style="color:#000;">Shipping State Code</label></td>
									<td><label style="color:#000;">Shipping Country</label></td>
								
						</tr>
						<tr>
						<td>
										<input type="text" class="form-control " name="txtSHIPPINGCITY" id="txtSHIPPINGCITY" value="">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSHIPPINGSTATE" id="txtSHIPPINGSTATE" value="">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSHIPPINGSTATECODE" id="txtSHIPPINGSTATECODE" value="">
									</td>
									<td>
										<input type="text" class="form-control" name="txtSHIPPINGCOUNTRY" id="txtSHIPPINGCOUNTRY" value="">
									</td>
						</tr>
						<tr>
									<td><label style="color:#000;">Phone</label></td>
									<td><label style="color:#000;">Mobile</label></td>
									<td><label style="color:#000;">Fax</label></td>
									<td><label style="color:#000;">Email</label></td>
						</tr>
						<tr>
						
									<td>
										<input type="text" class="form-control onlyNumber" name="txtPHONE" id="txtPHONE" value="">
									</td>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtMOBILENO" id="txtMOBILENO" value="">
									</td>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtFAXNO" id="txtFAXNO" value="">
									</td>
									<td>
										<input type="email" class="form-control" name="txtEMAIL" id="txtEMAIL" value="">
									</td>
						</tr>
								<tr>
									<td><label style="color:#000;">GST TIN No</label></td>
									<td><label style="color:#000;">PAN No</label></td>
								</tr>
								<tr>
								<td>
										<input type="text" class="form-control" name="txtGSTTINNO" id="txtGSTTINNO" value="">
									</td>
									<td>
										<input type="text" class="form-control" name="txtPANNO" id="txtPANNO" value="">
									</td>
								</tr>
								<tr>
									<td><label style="color:#000;">Bank Name</label></td>
									<td><label style="color:#000;">Bank A/c No</label></td>
									<td><label style="color:#000;">IFSC/RTGS Code</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="txtBANKNAME" id="txtBANKNAME" value="">
									</td>
									<td>
										<input type="text" class="form-control" name="txtBANKACNO" id="txtBANKACNO" value="">
									</td>
									<td>
										<input type="text" class="form-control" name="txtIFSCCODE" id="txtIFSCCODE" value="">
									</td>
								</tr>
								<tr>
									<td><label style="color:#000;">Bank Address</label></td>
									
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="txtBANKADDRESS" id="txtBANKADDRESS" value="">
									</td>
									
								</tr>
								<tr>
									<td><label style="color:#000;">Opening Balance</label></td>
									<td><label></label></td>
								</tr>
								<tr>
									<td width="25%">
										<input type="text" class="form-control onlyNumber" name="txtOPENINGBALANCE" id="txtOPENINGBALANCE" value="">
									</td>
									<td>
										<input type="radio" name="txtCRDR" id="txtCRDR" value="Cr"> <label style="color:#000;">Cr</label>
										<input type="radio" name="txtCRDR" id="txtCRDR" value="Dr"> <label style="color:#000;">Dr</label>
									</td>
								</tr>
							</table>
						</div>
						<button type="button" class="btn btn-default" style="float: right;" id="ledgerPOPUP">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	<script>
	$(document).on("blur","#txtLEDGERNAME", function(e){
	
					var txtLEDGERNAME = $("#txtLEDGERNAME").val();
					
					$.ajax({
						type:"post",
						url:"ajax.php",
						data:{txtLEDGERNAME:txtLEDGERNAME},
						success:function(data){
							if(data == "1")
							{
								alert("Ledger Name Is Already Available");
								$("#txtLEDGERNAME").val(""); 	
							}
							
						

													
							}
						});
			});
	</script>
	<?php
}
	?>




	
