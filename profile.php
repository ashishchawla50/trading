<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Admin Profile Detail";
	$res = getData(ADMINDETAIL,$AllArr," WHERE ADMINLOGINID='0'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$ADMINLOGINID = $_GET["_mid"];
	
	$Caption = "Edit Admin Profile Detail";
	$res = getData(ADMINDETAIL,$AllArr," WHERE ADMINLOGINID='".$ADMINLOGINID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$ADMINLOGINID = $_SESSION["adminuser"];
	deleteData(ADMINDETAIL," where ADMINLOGINID='".$ADMINLOGINID."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?profile";?>";
	</script>
	<?php
}
else
{
	$action ="";
}

if(isset($_POST["profile"]))
{
	
	$ADMINLOGINID = $_SESSION["adminuser"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();

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
	
	array_push($FieldArr_Col,"UPDATEDATE");
	array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
	array_push($FieldArr_Col,"FLAG");
	array_push($FieldArr_Val,"'0'");
	//$TableName= ADMINDETAIL;
	$Condition = " WHERE ADMINLOGINID='". $ADMINLOGINID ."'";
	
	

	$reccnt = getFieldDetail(ADMINDETAIL,"count(*)"," WHERE ADMINLOGINID='". $ADMINLOGINID ."'");
	if ($reccnt == 0)
		{
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			$ADMINLOGINID = newData($FieldArr_Col,$FieldArr_Val,ADMINDETAIL,TRUE);
			//exit();
			
		}
	else
		{
		
			editData($FieldArr_Col,$FieldArr_Val,ADMINDETAIL,$Condition);
		}		
			//exit();
		?>
		<script>
	window.location.href="<?php echo SITEURL."?profile";?>";
	</script>
	<?php
	$action = "";	

}

?>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Admin Profile</h1>
		</div>
		 <!-- /.col-lg-12 -->
	</div>
	
	<?php
if($action == "")
{
	
	if(isset($_SESSION["adminuser"])){
	
	$Caption = "Edit Admin Profile Detail";
	$res = getData(ADMINDETAIL,$AllArr," WHERE ADMINLOGINID='".$loginuser_name."'");
	$resdata = mysqli_fetch_assoc($res);	
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <?php echo $Caption;?>
                </div>
				<div class="panel-body">
					
					<form id="frm_profile" action="<?php echo SITEURL; ?>?profile" method="POST">
						
						<div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" name="txtFIRSTNAME" id="txtFIRSTNAME" value="<?php echo $resdata["FIRSTNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Middle Name</label>
                            <input class="form-control" name="txtMIDDLENAME" id="txtMIDDLENAME" value="<?php echo $resdata["MIDDLENAME"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" name="txtLASTNAME" id="txtLASTNAME" value="<?php echo $resdata["LASTNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="txtADDRESS" id="txtADDRESS"><?php echo $resdata["ADDRESS"];?></textarea>
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" name="txtPHONE" id="txtPHONE" value="<?php echo $resdata["PHONE"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Mobile</label>
                            <input class="form-control" name="txtMOBILE" id="txtMOBILE" value="<?php echo $resdata["MOBILE"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="txtEMAIL" id="txtEMAIL" value="<?php echo $resdata["EMAIL"];?>">
                                <p class="help-block"></p>
                        </div>
						   
						<button type="submit" class="btn btn-default" style="float: right;" name="profile">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	<?php }
elseif(isset($_SESSION["user"])){
	
	$Caption = "Edit Admin Profile Detail";
	$res = getData(USER,$AllArr," WHERE USERNAME='".$_SESSION["user"]."'");
	$resdata = mysqli_fetch_assoc($res);	
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <?php echo $Caption;?>
                </div>
				<div class="panel-body">
					
					<form id="frm_profile" action="<?php echo SITEURL; ?>?profile" method="POST">
						
						<div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" name="txtFIRSTNAME" id="txtFIRSTNAME" value="<?php echo $resdata["FIRSTNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Middle Name</label>
                            <input class="form-control" name="txtMIDDLENAME" id="txtMIDDLENAME" value="<?php echo $resdata["MIDDLENAME"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" name="txtLASTNAME" id="txtLASTNAME" value="<?php echo $resdata["LASTNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="txtADDRESS" id="txtADDRESS"><?php echo $resdata["ADDRESS"];?></textarea>
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" name="txtPHONE" id="txtPHONE" value="<?php echo $resdata["PHONE"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Mobile</label>
                            <input class="form-control" name="txtMOBILE" id="txtMOBILE" value="<?php echo $resdata["MOBILE"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="txtEMAIL" id="txtEMAIL" value="<?php echo $resdata["EMAIL"];?>">
                                <p class="help-block"></p>
                        </div>
						   
						<button type="submit" class="btn btn-default" style="float: right;" name="profile">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	<?php } ?>
<?php
}
?>
	
