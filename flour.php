<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Flouraosance Detail";
	$res = getData(FLOUR_MST,$AllArr," WHERE FLOURID='0'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$FLOURID = $_GET["_mid"];
	
	$Caption = "Edit Flouraosance Detail";
	$res = getData(FLOUR_MST,$AllArr," WHERE FLOURID='".$FLOURID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$FLOURID = $_GET["_rid"];
	deleteData(FLOUR_MST," where FLOURID='".$FLOURID."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?flour&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}


if(isset($_POST["flour"]))
{
	
	$FLOURID = $_POST["FLOURID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	//array_push($FieldArr_Col,"FLOURID");
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
	//$TableName= FLOUR_MST;
	$Condition = " WHERE FLOURID='". $FLOURID ."'";
	
	

	$reccnt = getFieldDetail(FLOUR_MST,"count(*)"," WHERE FLOURID='". $FLOURID ."'");
	if ($reccnt == 0)
		{
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			$FLOURID = newData($FieldArr_Col,$FieldArr_Val,FLOUR_MST,TRUE);
			//exit();
			
		}
	else
		{
		
			editData($FieldArr_Col,$FieldArr_Val,FLOUR_MST,$Condition);
		}		
			//exit();
		?>
		<script>
	window.location.href="<?php echo SITEURL."?flour";?>";
	</script>
		<?php
	$action = "";	

}
elseif(isset($_POST["flour_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE FLOURID IN (".$DeleteString.")";
	deleteData(FLOUR_MST,$Condition);
	?>
	<script>
	window.location.href="<?php echo SITEURL."?flour&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Flouraosance</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?flour&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?flour&_vid"><i class="fa fa-plus-tasks"></i>View</a>
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
				 <form name="frmflourtable" action="<?php echo SITEURL; ?>?flour" method="POST" onsubmit="return confirm('Do you really want to Delete selected Flouraosance?');">
						<?php echo $back_button;?>
					<p>
						<?php 
						if($del_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?flour&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<button type="submit" name="flour_mul" class="btn btn-danger delcls" ><i class="fa fa-trash-o"></i> Delete</button>
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
									<th>Flouraosance Id</th>									
									<th>Flouraosance Name</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(FLOUR_MST,$AllArr," WHERE FLAG='0'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["FLOURID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["FLOURID"];?></td>
												<td><?php echo $resdata["FLOURNAME"];?></td>
											
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?flour&_mid=<?php echo $resdata["FLOURID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?flour&_rid=<?php echo $resdata["FLOURID"];?>" onclick="return confirm('Do you really want to Delete Flouraosance : <?php echo $resdata["FLOURNAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
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
					<form id="frm_Flour" action="<?php echo SITEURL; ?>?flour" method="POST" onsubmit="">
						<input type="hidden" name="FLOURID" id="FLOURID" value="<?php echo $resdata["FLOURID"];?>">
						<div class="form-group">
                            <label>Flouraosance Name</label>
                            <input class="form-control onlyCharacter" name="txtFLOURNAME" id="txtFLOURNAME" value="<?php //echo $resdata["FLOURNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="flour">Submit Button</button>
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
					<form id="frm_Flour" action="<?php echo SITEURL; ?>?flour" method="POST" onsubmit="">
						<input type="hidden" name="FLOURID" id="FLOURID" value="<?php echo $resdata["FLOURID"];?>">
						<div class="form-group">
                            <label>Flouraosance Name</label>
                            <input class="form-control onlyCharacter" name="txtFLOURNAME" id="txtFLOURNAME" value="<?php echo $resdata["FLOURNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="flour">Submit Button</button>
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

	
