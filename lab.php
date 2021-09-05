<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Lab Detail";
	$res = getData(LAB_MST,$AllArr," WHERE LABID='0'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$LABID = $_GET["_mid"];
	
	$Caption = "Edit Lab Detail";
	$res = getData(LAB_MST,$AllArr," WHERE LABID='".$LABID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$LABID = $_GET["_rid"];
	deleteData(LAB_MST," where LABID='".$LABID."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?lab&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}

if(isset($_POST["lab"]))
{
	
	$LABID = $_POST["LABID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	//array_push($FieldArr_Col,"LABID");
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
	//$TableName= LAB_MST;
	$Condition = " WHERE LABID='". $LABID ."'";
	
	

	$reccnt = getFieldDetail(LAB_MST,"count(*)"," WHERE LABID='". $LABID ."'");
	if ($reccnt == 0)
		{
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			$LABID = newData($FieldArr_Col,$FieldArr_Val,LAB_MST,TRUE);
			//exit();
			
		}
	else
		{
		
			editData($FieldArr_Col,$FieldArr_Val,LAB_MST,$Condition);
		}		
			//exit();
		?>
		<script>
	window.location.href="<?php echo SITEURL."?lab";?>";
	</script>
		<?php
	$action = "";	

}
elseif(isset($_POST["lab_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE LABID IN (".$DeleteString.")";
	deleteData(LAB_MST,$Condition);
	?>
	<script>
	window.location.href="<?php echo SITEURL."?lab&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Lab</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?lab&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?lab&_vid"><i class="fa fa-tasks"></i> View</a>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?lab" method="POST" onsubmit="return confirm('Do you really want to Delete selected Lab?');">
					<?php echo $back_button;?>
					<p>
						
						<?php 
						if($del_bol)
						{
							?>						
						<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?lab&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
						<button type="submit" name="lab_mul" class="btn btn-danger " ><i class="fa fa-trash-o"></i> Delete</button>
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
									<th>Lab Id</th>									
									<th>Lab Name</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(LAB_MST,$AllArr," WHERE FLAG='0'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["LABID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["LABID"];?></td>
												<td><?php echo $resdata["LABNAME"];?></td>
											
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?lab&_mid=<?php echo $resdata["LABID"];?>" class="btn btn-primary btn-circle " title="Edit">
																<i class="fa fa-edit"></i>
															</a>
														<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?lab&_rid=<?php echo $resdata["LABID"];?>" onclick="return confirm('Do you really want to Delete Lab : <?php echo $resdata["LABNAME"];?>?');" class="btn btn-danger btn-circle " title="Delete">
															<i class="fa fa-trash-o"></i></a>
															
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
					<form id="frm_Lab" action="<?php echo SITEURL; ?>?lab" method="POST" onsubmit="">
						<input type="hidden" name="LABID" id="LABID" value="<?php echo $resdata["LABID"];?>">
						<div class="form-group">
                            <label>Lab Name</label>
                            <input class="form-control onlyCharacter" name="txtLABNAME" id="txtLABNAME" value="<?php //echo $resdata["LABNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="lab">Submit Button</button>
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
					<form id="frm_Lab" action="<?php echo SITEURL; ?>?lab" method="POST" onsubmit="">
						<input type="hidden" name="LABID" id="LABID" value="<?php echo $resdata["LABID"];?>">
						<div class="form-group">
                            <label>Lab Name</label>
                            <input class="form-control onlyCharacter" name="txtLABNAME" id="txtLABNAME" value="<?php echo $resdata["LABNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="lab">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>

	<?php
}
?>


	
