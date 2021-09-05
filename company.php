<?php
	
if(isset($_POST["company"]))
{
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	array_push($FieldArr_Col,"COMPANYID");
	array_push($FieldArr_Val,"'1'");
	foreach($PostArr_Key as $tempctrl)
	{
		$colname_prefix = substr($tempctrl,0,3);
		$colname = substr($tempctrl,3);
		switch($colname_prefix)
		{
			case "txt":
				array_push($FieldArr_Col,$colname);
				array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");
			break;
		}
	}
	$TableName= COMPANY;
	$Condition = " WHERE COMPANYID='1'";
	
	$reccnt = getFieldDetail(COMPANY,"count(*)"," WHERE COMPANYID='1'");
	if ($reccnt == 0)
		{
			newData($FieldArr_Col,$FieldArr_Val,$TableName);
		}
	else
		{
			editData($FieldArr_Col,$FieldArr_Val,$TableName,$Condition);
		}	
		
	
}
$FieldArr[0] = "*";
$COMPANYID = 1;
$Caption = "Edit Company Detail";
$res = getData(COMPANY,$FieldArr," WHERE COMPANYID='".$COMPANYID."'");
$resdata = mysqli_fetch_assoc($res);	
?>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Company</h1>
		</div>
		 <!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <?php echo $Caption;?>
                </div>
				<div class="panel-body">
					<p>
						<a  class="btn btn-warning" href="<?php echo SITEURL; ?>?company" style="float:right;" ><i class="fa fa-backward"></i> Back</a>
						<br>
					</p>
					<form id="frm_sitesettings" action="<?php echo SITEURL; ?>?company" method="POST">
						
						<div class="form-group">
                            <label>Company Name</label>
                            <input class="form-control" name="txtCOMPANYNAME" id="txtCOMPANYNAME" value="<?php echo $resdata["COMPANYNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
						<div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="txtADDRESS" id="txtADDRESS"><?php echo $resdata["ADDRESS"];?></textarea>
                                <p class="help-block"></p>
                        </div>
						<div class="row form-group">
							<div class="col-lg-2">
								<label>Pin Code</label>
                            <input class="form-control" name="txtPINCODE" id="txtPINCODE" value="<?php echo $resdata["PINCODE"];?>">
                                <p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Phone</label>
									<input type="text" class="form-control onlyNumber" name="txtPHONE" id="txtPHONE" value="<?php echo $resdata["PHONE"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Mobile</label>
									<input type="text" class="form-control onlyNumber" name="txtMOBILENO" id="txtMOBILENO" value="<?php echo $resdata["MOBILENO"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Fax</label>
									<input type="text" class="form-control onlyNumber" name="txtFAXNO" id="txtFAXNO" value="<?php echo $resdata["FAXNO"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-3">
								<label>Email</label>
									<input type="email" class="form-control" name="txtEMAIL" id="txtEMAIL" value="<?php echo $resdata["EMAIL"];?>">
										<p class="help-block"></p>
							</div>
						</div>
						
						
						<div class="row form-group">
							<div class="col-lg-2">
								<label>City</label>
                            <input type="text" class="form-control" name="txtCITY" id="txtCITY" value="<?php echo $resdata["CITY"];?>">
                                <p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>State</label>
									<input type="text" class="form-control" name="txtSTATE" id="txtSTATE" value="<?php echo $resdata["STATE"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>State Code</label>
									<input type="text" class="form-control" name="txtSTATECODE" id="txtSTATECODE" value="<?php echo $resdata["STATECODE"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Country</label>
									<input type="text" class="form-control" name="txtCOUNTRY" id="txtCOUNTRY" value="<?php echo $resdata["COUNTRY"];?>">
										<p class="help-block"></p>
							</div>
							
						</div>
						
						
						
						<div class="row form-group">
							<div class="col-lg-2">
								<label>CST TIN No</label>
									<input class="form-control" name="txtCSTTINNO" id="txtCSTTINNO" value="<?php echo $resdata["CSTTINNO"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>GST TIN No</label>
									<input class="form-control" name="txtGSTTINNO" id="txtGSTTINNO" value="<?php echo $resdata["GSTTINNO"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>PAN No</label>
									<input class="form-control" name="txtPANNO" id="txtPANNO" value="<?php echo $resdata["PANNO"];?>">
										<p class="help-block"></p>
							</div>
							<!--<div class="col-lg-2">
								<label>HSN Code</label>
									<input class="form-control" name="txtHSNCODE" id="txtHSNCODE" value="<?php //echo $resdata["HSNCODE"];?>">
										<p class="help-block"></p>
							</div>-->
						</div>
						<div class="row form-group">
							<div class="col-lg-2">
								<label>Bank Name</label>
									<input class="form-control" name="txtBANKNAME" id="txtBANKNAME" value="<?php echo $resdata["BANKNAME"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Bank A/c No</label>
									<input class="form-control" name="txtBANKACNO" id="txtBANKACNO" value="<?php echo $resdata["BANKACNO"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>IFSC/RTGS Code</label>
									<input class="form-control" name="txtIFSCCODE" id="txtIFSCCODE" value="<?php echo $resdata["IFSCCODE"];?>">
										<p class="help-block"></p>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-lg-2">
								<label>Rapnet Id</label>
								<input class="form-control" name="txtRAPNETID" id="txtRAPNETID" value="<?php echo $resdata["RAPNETID"];?>">
									<p class="help-block"></p>
							</div>
						
							<div class="col-lg-2">
								<label>Rapnet Pass</label>
								<input type="password" class="form-control" name="txtRAPNETPASSWORD" id="txtRAPNETPASSWORD" value="<?php echo $resdata["RAPNETPASSWORD"];?>">
									<p class="help-block"></p>
							</div>
                        </div>
						<div class="row form-group">
							<div class="col-lg-2">
								<label>GST NO</label>
								<input class="form-control" name="txtGSTNO" id="txtGSTNO" value="<?php echo $resdata["GSTNO"];?>">
									<p class="help-block"></p>
							</div>
						
							<div class="col-lg-2">
								<label>IGST %</label>
								<input  class="form-control" name="txtIGSTPER" id="txtIGSTPER" value="<?php echo $resdata["IGSTPER"];?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>CGST %</label>
								<input  class="form-control" name="txtCGSTPER" id="txtCGSTPER" value="<?php echo $resdata["CGSTPER"];?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>SGST %</label>
								<input  class="form-control" name="txtSGSTPER" id="txtSGSTPER" value="<?php echo $resdata["SGSTPER"];?>">
									<p class="help-block"></p>
							</div>
                        </div>
						<!--<div class="row form-group">
							<div class="col-lg-2">
								<label>Terms of Payment</label>
									<input class="form-control" name="txtTERMSOFPAYMENT" id="txtTERMSOFPAYMENT" value="<?php echo $resdata["TERMSOFPAYMENT"];?>">
										<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Terms of Delivery</label>
									<input class="form-control" name="txtTERMSOFDELIVERY" id="txtTERMSOFDELIVERY" value="<?php echo $resdata["TERMSOFDELIVERY"];?>">
										<p class="help-block"></p>
							</div>
						
						</div>-->
						<button type="submit" class="btn btn-default" style="float: right;" name="company">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
<?php
?>

	
