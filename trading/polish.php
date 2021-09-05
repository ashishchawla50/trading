<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Polish Detail";
	$res = getData(POLISH_MST,$AllArr," WHERE POLISHID='0'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$POLISHID = $_GET["_mid"];
	
	$Caption = "Edit Polish Detail";
	$res = getData(POLISH_MST,$AllArr," WHERE POLISHID='".$POLISHID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$POLISHID = $_GET["_rid"];
	deleteData(POLISH_MST," where POLISHID='".$POLISHID."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?polish&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}

if(isset($_POST["polish"]))
{
	
	$POLISHID = $_POST["POLISHID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	//array_push($FieldArr_Col,"POLISHID");
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
	//$TableName= POLISH_MST;
	$Condition = " WHERE POLISHID='". $POLISHID ."'";
	
	

	$reccnt = getFieldDetail(POLISH_MST,"count(*)"," WHERE POLISHID='". $POLISHID ."'");
	if ($reccnt == 0)
		{
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			$POLISHID = newData($FieldArr_Col,$FieldArr_Val,POLISH_MST,TRUE);
			//exit();
			
		}
	else
		{
		
			editData($FieldArr_Col,$FieldArr_Val,POLISH_MST,$Condition);
		}		
			//exit();
		?>
		<script>
	window.location.href="<?php echo SITEURL."?polish";?>";
	</script>
		<?php
	$action = "";	

}
elseif(isset($_POST["polish_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE POLISHID IN (".$DeleteString.")";
	deleteData(POLISH_MST,$Condition);
	?>
	<script>
	window.location.href="<?php echo SITEURL."?polish&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Polish</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?polish&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?polish&_vid"><i class="fa fa-plus-tasks"></i>View</a>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?polish" method="POST" onsubmit="return confirm('Do you really want to Delete selected Polish?');">
					<?php echo $back_button;?>
					<p>
						<?php 
						
						
						if($del_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?polish&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
						<button type="submit" name="polish_mul" class="btn btn-danger delcls" ><i class="fa fa-trash-o"></i> Delete</button>
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
									<th>Polish Id</th>									
									<th>Polish Name</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(POLISH_MST,$AllArr," WHERE FLAG='0'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["POLISHID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["POLISHID"];?></td>
												<td><?php echo $resdata["POLISHNAME"];?></td>
											
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?polish&_mid=<?php echo $resdata["POLISHID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?polish&_rid=<?php echo $resdata["POLISHID"];?>" onclick="return confirm('Do you really want to Delete Polish : <?php echo $resdata["POLISHNAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
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
					<form id="frm_Polish" action="<?php echo SITEURL; ?>?polish" method="POST" onsubmit="">
						<input type="hidden" name="POLISHID" id="POLISHID" value="<?php echo $resdata["POLISHID"];?>">
						<div class="form-group">
                            <label>Polish Name</label>
                            <input class="form-control onlyCharacter" name="txtPOLISHNAME" id="txtPOLISHNAME" value="<?php //echo $resdata["POLISHNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="polish">Submit Button</button>
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
					<form id="frm_Polish" action="<?php echo SITEURL; ?>?polish" method="POST" onsubmit="">
						<input type="hidden" name="POLISHID" id="POLISHID" value="<?php echo $resdata["POLISHID"];?>">
						<div class="form-group">
                            <label>Polish Name</label>
                            <input class="form-control onlyCharacter" name="txtPOLISHNAME" id="txtPOLISHNAME" value="<?php echo $resdata["POLISHNAME"];?>">
                                <p class="help-block"></p>
                        </div>
						
					
						<button type="submit" class="btn btn-default" style="float: right;" name="polish">Submit Button</button>
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

	
