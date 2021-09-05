<?php
	
if(isset($_POST["setting"]))
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
		if(substr($tempctrl,strlen($tempctrl)-1,1) != "_")
		{
		switch($colname_prefix)
		{
			case "txt":
				array_push($FieldArr_Col,$colname);
				array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");
			break;
			case "dtp":				
					array_push($FieldArr_Col,$colname);
					array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");
				break;
		}
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
$Caption = "Edit Settings";
$res = getData(COMPANY,$FieldArr," WHERE COMPANYID='".$COMPANYID."'");
$resdata = mysqli_fetch_assoc($res);	
?>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Settings</h1>
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
						<a  class="btn btn-warning" href="<?php echo SITEURL; ?>?setting" style="float:right;" ><i class="fa fa-backward"></i> Back</a>
						<br>
					</p>
					<form id="frm_settings" action="<?php echo SITEURL; ?>?setting" method="POST">
						
						<div class="row form-group">
							<div class="col-lg-3">
								<label>Auto Commission Entry In</label><br>
								<select class="form-control" name="txtCOMMAC" id="txtCOMMAC" >
													<option value=""> Select Account </option>
													<?php
													$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID='5' ORDER BY LEDGERNAME");
													while($res_led_data = mysqli_fetch_assoc($res_led))
														{
															?>
															<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==$resdata["COMMAC"] ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
															<?php
														}
													?>
												</select>
									<p class="help-block"></p>
							</div>
							
							<div class="col-lg-3">
								<label>From Date</label>
								<input class="form-control" type="date" name="txtFROMDATE" id="txtFROMDATE" value="<?php echo $resdata["FROMDATE"];?>">
                                <p class="help-block"></p>
							</div>
                        </div>
						
						
					
						
						<button type="submit" class="btn btn-default" style="float: right;" name="setting">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
<?php
?>

	
