<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Net P &  L Detail";
	$res = getData(NETPL_MST,$AllArr," WHERE DATE_FORMAT(NETDATE, '%Y') = 0");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$NETDATE = $_GET["_mid"];
	
	$Caption = "Edit Net P &  L Detail";
	$res = getData(NETPL_MST,$AllArr," WHERE NETDATE='".$NETDATE."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$NETDATE = $_GET["_rid"];
	deleteData(NETPL_MST," where NETDATE='".$NETDATE."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?netprofitloss&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}


if(isset($_POST["netprofitloss"]))
{
	
	$NETDATE = $_POST["txtNETDATE"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	//array_push($FieldArr_Col,"NETDATE");
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
			case "rad":
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
	$Condition = " WHERE NETDATE='". $NETDATE ."'";
	$reccnt = getFieldDetail(NETPL_MST,"count(*)"," WHERE NETDATE='". $NETDATE ."'");
	if ($reccnt == 0)
		{
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			 newData($FieldArr_Col,$FieldArr_Val,NETPL_MST,false);	
		}
	else
		{
		
			editData($FieldArr_Col,$FieldArr_Val,NETPL_MST,$Condition);
		}		
		?>
	<script>
		window.location.href="<?php echo SITEURL."?netprofitloss";?>";
	</script>
		<?php
		exit();
	$action = "";	
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Net P &  L</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php

if($action=="")
{
	if($add_bol)
		{
			?>
			<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?netprofitloss&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
			<?php
		}
	if($view_bol)
		{
			?>
			<a class="btn btn-primary" href="<?php echo SITEURL; ?>?netprofitloss&_vid"><i class="fa fa-plus-tasks"></i>View</a>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?netprofitloss" method="POST" onsubmit="return confirm('Do you really want to Delete selected Net P &  L?');">
					<?php echo $back_button;?>
					
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
									<th>Date</th>									
									<th>Amount</th>
									<th>P / L</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(NETPL_MST,$AllArr," ");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["NETDATE"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["NETDATE"];?></td>
												<td><?php echo $resdata["AMOUNT"];?></td>
												<td><?php echo $resdata["PL"];?></td>
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?netprofitloss&_mid=<?php echo $resdata["NETDATE"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?netprofitloss&_rid=<?php echo $resdata["NETDATE"];?>" onclick="return confirm('Do you really want to Delete Net P &  L : <?php echo $resdata["NETDATE"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
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
elseif($action == "modify" || $action == "new")
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
					<form id="frm_Clarity" action="<?php echo SITEURL; ?>?netprofitloss" method="POST" onsubmit="">
						<div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="txtNETDATE" id="txtNETDATE" value="<?php echo $resdata["NETDATE"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="txtAMOUNT" id="txtAMOUNT" value="<?php echo $resdata["AMOUNT"];?>">
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <label>P/L</label>
                            <input type="radio" class="" name="radPL" id="radP" value="Profit" <?php echo $resdata["PL"] == "Profit" ? "checked" : "" ;?>> Profit
							<input type="radio" class="" name="radPL" id="radL" value="Loss" <?php echo $resdata["PL"] == "Loss" ? "checked" : "" ;?>> Loss
                                <p class="help-block"></p>
                        </div>
						<button type="submit" class="btn btn-default" style="float: right;" name="netprofitloss">Submit Button</button>
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

	
