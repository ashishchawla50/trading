<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Location Detail";
	$res = getData(LOCATION_MST,$AllArr," WHERE LOCATIONID='0'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$LOCATIONID = $_GET["_mid"];
	
	$Caption = "Edit Location Detail";
	$res = getData(LOCATION_MST,$AllArr," WHERE LOCATIONID='".$LOCATIONID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$LOCATIONID = $_GET["_rid"];
	deleteData(LOCATION_MST," where LOCATIONID='".$LOCATIONID."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?location&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}

if(isset($_POST["location"]))
{
	
	$LOCATIONID = $_POST["LOCATIONID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	//array_push($FieldArr_Col,"LOCATIONID");
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
	//$TableName= LOCATION_MST;
	$Condition = " WHERE LOCATIONID='". $LOCATIONID ."'";
	
	

	$reccnt = getFieldDetail(LOCATION_MST,"count(*)"," WHERE LOCATIONID='". $LOCATIONID ."'");
	if ($reccnt == 0)
		{
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			$LOCATIONID = newData($FieldArr_Col,$FieldArr_Val,LOCATION_MST,TRUE);
			//exit();
			
		}
	else
		{
		
			editData($FieldArr_Col,$FieldArr_Val,LOCATION_MST,$Condition);
		}		
			//exit();
		?>
		<script>
	window.location.href="<?php echo SITEURL."?location";?>";
	</script>
		<?php
	$action = "";	

}
elseif(isset($_POST["loc_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE LOCATIONID IN (".$DeleteString.")";
	deleteData(LOCATION_MST,$Condition);
	?>
	<script>
	window.location.href="<?php echo SITEURL."?location&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Location</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?location&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?location&_vid"><i class="fa fa-plus-tasks"></i>View</a>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?location" method="POST" onsubmit="return confirm('Do you really want to Delete selected Account Groups?');">
					<?php echo $back_button;?>
					<p>
						<?php 
						
						
						if($del_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?location&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<button type="submit" name="loc_mul" class="btn btn-danger delcls" ><i class="fa fa-trash-o"></i> Delete</button>
					<?php
						}
						?>
					</p>
					<?php
					if ($view_bol)
					{
					?>
					<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="text-align:center;width:15%;" >
									SELECT ALL
									<br>
									<input type="checkbox" id="SelectAll" />
									</th>
									<th>Location Id</th>									
									<th>Location Name</th>
									<th>State Name</th>
									<th>Country Name</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(LOCATION_MST,$AllArr," WHERE FLAG='0'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["LOCATIONID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["LOCATIONID"];?></td>
												<td><?php echo $resdata["LOCATIONNAME"];?></td>
												<td><?php echo $resdata["STATE"];?></td>
												<td><?php echo $resdata["COUNTRY"];?></td>
											
												<td>
												<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?location&_mid=<?php echo $resdata["LOCATIONID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?location&_rid=<?php echo $resdata["LOCATIONID"];?>" onclick="return confirm('Do you really want to Delete Location : <?php echo $resdata["LOCATIONNAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
														<?php
													}
													?>
												</td>
											</tr>
										<?php
									}
							?>                                        
							</tbody>
						</table>
					</div>
					<?php
					}
					?>
					
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
					<form id="frm_AccountGroup" action="<?php echo SITEURL; ?>?location" method="POST" >
						<input type="hidden" name="LOCATIONID" id="LOCATIONID" value="<?php //echo $resdata["LOCATIONID"];?>">
						<div class="form-group">
                            <label>Location Name</label>
                            <input class="form-control onlyCharacter" name="txtLOCATIONNAME" id="txtLOCATIONNAME" value="<?php //echo $resdata["LOCATIONNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
						<div class="form-group">
                            <label>State Name</label>
                            <input class="form-control onlyCharacter" name="txtSTATE" id="txtSTATE" value="<?php //echo $resdata["STATE"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Country Name</label>
                            <input class="form-control onlyCharacter" name="txtCOUNTRY" id="txtCOUNTRY" value="<?php //echo $resdata["COUNTRY"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="location">Submit Button</button>
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
					<form id="frm_AccountGroup" action="<?php echo SITEURL; ?>?location" method="POST" >
						<input type="hidden" name="LOCATIONID" id="LOCATIONID" value="<?php echo $resdata["LOCATIONID"];?>">
						<div class="form-group">
                            <label>Location Name</label>
                            <input class="form-control onlyCharacter" name="txtLOCATIONNAME" id="txtLOCATIONNAME" value="<?php echo $resdata["LOCATIONNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
						<div class="form-group">
                            <label>State Name</label>
                            <input class="form-control onlyCharacter" name="txtSTATE" id="txtSTATE" value="<?php echo $resdata["STATE"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Country Name</label>
                            <input class="form-control onlyCharacter" name="txtCOUNTRY" id="txtCOUNTRY" value="<?php echo $resdata["COUNTRY"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="location">Submit Button</button>
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

	
