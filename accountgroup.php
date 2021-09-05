<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Account Group Detail";
	$res = getData(ACGROUP,$AllArr," WHERE GROUPID='0'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$GROUPID = $_GET["_mid"];
	
	$Caption = "Edit Account Group Detail";
	$res = getData(ACGROUP,$AllArr," WHERE GROUPID='".$GROUPID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$GROUPID = $_GET["_rid"];
	deleteData(ACGROUP," where GROUPID='".$GROUPID."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?accountgroup&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}
if(isset($_POST["accountgroup"]))
{
	
	$GROUPID = $_POST["GROUPID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	//array_push($FieldArr_Col,"GROUPID");
	//array_push($FieldArr_Val,"'1'");
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
	array_push($FieldArr_Col,"USERNAME");
	array_push($FieldArr_Val,"'".$loginuser_name."'");
	array_push($FieldArr_Col,"FLAG");
	array_push($FieldArr_Val,"'0'");
	//$TableName= ACGROUP;
	$Condition = " WHERE GROUPID='". $GROUPID ."'";
	
	

	$reccnt = getFieldDetail(ACGROUP,"count(*)"," WHERE GROUPID='". $GROUPID ."'");
	if ($reccnt == 0)
		{
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			$GROUPID = newData($FieldArr_Col,$FieldArr_Val,ACGROUP,TRUE);
			//exit();
			
		}
	else
		{
		
			editData($FieldArr_Col,$FieldArr_Val,ACGROUP,$Condition);
		}		
			//exit();
		?>
		<script>
	window.location.href="<?php echo SITEURL."?accountgroup";?>";
	</script>
		<?php
	$action = "";	

}
elseif(isset($_POST["shape_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE GROUPID IN (".$DeleteString.")";
	deleteData(ACGROUP,$Condition);
	?>
	<script>
	window.location.href="<?php echo SITEURL."?accountgroup&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Account Group</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?accountgroup&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?accountgroup&_vid"><i class="fa fa-plus-tasks"></i>View</a>
							<?php
						}
						
}
else if($action == "view")
{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?accountgroup" method="POST" onsubmit="return confirm('Do you really want to Delete selected Account Groups?');">
						<?php echo $back_button;?>
					<p>
					
						<!--<button type="submit" name="shape_mul" class="btn btn-danger delcls" ><i class="fa fa-trash-o"></i> Delete</button>-->
					</p>
					<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="text-align:center;width:15%;" >
									SELECT ALL
									<br>
									<input type="checkbox" id="SelectAll" />
									</th>
									<th>Group Id</th>									
									<th>Group Name</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(ACGROUP,$AllArr," WHERE FLAG='0'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["GROUPID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["GROUPID"];?></td>
												<td><?php echo $resdata["GROUPNAME"];?></td>
											
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?accountgroup&_mid=<?php echo $resdata["GROUPID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													?>
													<!--<a href="<?php echo SITEURL; ?>?accountgroup&_rid=<?php echo $resdata["GROUPID"];?>" onclick="return confirm('Do you really want to Delete Account Group : <?php echo $resdata["GROUPNAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>-->
													</a>
												</td>
											</tr>
										<?php
									}
							?>                                        
							</tbody>
						</table>
					</div>
					</form>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
     <!-- /.col-lg-12 -->
	</div>
	
	<?php


}
elseif($action == "new")
{
	?>
		<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <?php echo $Caption;?>
                </div>
				<div class="panel-body">
						<?php echo $back_button;?>
					<form id="frm_AccountGroup" action="<?php echo SITEURL; ?>?accountgroup" method="POST" >
						<input type="hidden" name="GROUPID" id="GROUPID" value="<?php echo $resdata["GROUPID"];?>">
						<div class="form-group">
                            <label>Group Name</label>
                            <input class="form-control onlyCharacter" name="txtGROUPNAME" id="txtGROUPNAME" value="<?php //echo $resdata["GROUPNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="accountgroup">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>

	<?php
}
elseif($action == "modify")
{
	?>
		<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <?php echo $Caption;?>
                </div>
				<div class="panel-body">
						<?php echo $back_button;?>
					<form id="frm_AccountGroup" action="<?php echo SITEURL; ?>?accountgroup" method="POST" >
						<input type="hidden" name="GROUPID" id="GROUPID" value="<?php echo $resdata["GROUPID"];?>">
						<div class="form-group">
                            <label>Group Name</label>
                            <input class="form-control onlyCharacter" name="txtGROUPNAME" id="txtGROUPNAME" value="<?php echo $resdata["GROUPNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="accountgroup">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>

	<?php
}
?>
	
<?php
?>

	
