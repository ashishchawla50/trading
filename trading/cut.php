<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Cut Detail";
	$res = getData(CUT_MST,$AllArr," WHERE CUTID='0'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$CUTID = $_GET["_mid"];
	
	$Caption = "Edit Cut Detail";
	$res = getData(CUT_MST,$AllArr," WHERE CUTID='".$CUTID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$CUTID = $_GET["_rid"];
	deleteData(CUT_MST," where CUTID='".$CUTID."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?cut&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}


if(isset($_POST["cut"]))
{
	
	$CUTID = $_POST["CUTID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	//array_push($FieldArr_Col,"CUTID");
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
	//$TableName= CUT_MST;
	$Condition = " WHERE CUTID='". $CUTID ."'";
	
	

	$reccnt = getFieldDetail(CUT_MST,"count(*)"," WHERE CUTID='". $CUTID ."'");
	if ($reccnt == 0)
		{
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			$CUTID = newData($FieldArr_Col,$FieldArr_Val,CUT_MST,TRUE);
			//exit();
			
		}
	else
		{
		
			editData($FieldArr_Col,$FieldArr_Val,CUT_MST,$Condition);
		}		
			//exit();
		?>
		<script>
	window.location.href="<?php echo SITEURL."?cut";?>";
	</script>
		<?php
	$action = "";	

}
elseif(isset($_POST["cut_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE CUTID IN (".$DeleteString.")";
	deleteData(CUT_MST,$Condition);
	?>
	<script>
	window.location.href="<?php echo SITEURL."?cut&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Cut</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?cut&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?cut&_vid"><i class="fa fa-plus-tasks"></i>View</a>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?cut" method="POST" onsubmit="return confirm('Do you really want to Delete selected Cut?');">
					<?php echo $back_button;?>
					<p>
						<?php 
						
						
						if($del_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?cut&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
						<button type="submit" name="cut_mul" class="btn btn-danger delcls" ><i class="fa fa-trash-o"></i> Delete</button>
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
									<th>Cut Id</th>									
									<th>Cut Name</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(CUT_MST,$AllArr," WHERE FLAG='0'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["CUTID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["CUTID"];?></td>
												<td><?php echo $resdata["CUTNAME"];?></td>
											
												<td>
												<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?cut&_mid=<?php echo $resdata["CUTID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?cut&_rid=<?php echo $resdata["CUTID"];?>" onclick="return confirm('Do you really want to Delete Cut : <?php echo $resdata["CUTNAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
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
					<form id="frm_Cut" action="<?php echo SITEURL; ?>?cut" method="POST" onsubmit="">
						<input type="hidden" name="CUTID" id="CUTID" value="<?php echo $resdata["CUTID"];?>">
						<div class="form-group">
                            <label>Cut Name</label>
                            <input class="form-control onlyCharacter" name="txtCUTNAME" id="txtCUTNAME" value="<?php //echo $resdata["CUTNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="cut">Submit Button</button>
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
					<form id="frm_Cut" action="<?php echo SITEURL; ?>?cut" method="POST" onsubmit="">
						<input type="hidden" name="CUTID" id="CUTID" value="<?php echo $resdata["CUTID"];?>">
						<div class="form-group">
                            <label>Cut Name</label>
                            <input class="form-control onlyCharacter" name="txtCUTNAME" id="txtCUTNAME" value="<?php echo $resdata["CUTNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="cut">Submit Button</button>
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

	
