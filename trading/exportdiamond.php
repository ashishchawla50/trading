<?php
	
			$res = getData(EXPORTDIAMOND,$AllArr," AS ED WHERE FLAG='0' ORDER BY ENTRYID DESC");
			$salSTRCAPTION="";
			$SALxlsaction="";		
			$xlsaction1="";	
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Export Diamond Detail";
	$ID = $_GET["_nid"];
	
	$res = getData(EXPORTDIAMOND,$AllArr," WHERE ID='".$ID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$ID = $_GET["_mid"];
	$Caption = "Edit Export Diamond Detail";
	$res = getData(EXPORTDIAMOND,$AllArr," WHERE ENTRYID='".$ID."'");
	$resdata = mysqli_fetch_assoc($res);	
	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$ID = $_GET["_rid"];	
	deleteData(EXPORTDIAMOND," where ENTRYID='".$ID."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?exportdiamond&_vid";?>";
	</script>
	<?php
}

elseif(isset($_GET["_vid"]))
{
	$action = "view";
}

if(isset($_POST["exportdiamond"]))
{
	$idx = 0;
	$Barcode_Arr = $_POST["BARCODENO"];
	$ID=($_POST["ID"] == 0 ? getMaxValue(EXPORTDIAMOND,"ID"," WHERE PROCESSTYPE='Export Diamond'") : $_POST["ID"]);
	foreach ($Barcode_Arr as $Barcode)
	{
			
		$FieldBarcode= array();
		$ValueBarcode= array();
		
		array_push($FieldBarcode,"CERTIFICATENO");
		array_push($FieldBarcode,"WEIGHT");
		array_push($FieldBarcode,"COLOR");
		array_push($FieldBarcode,"CLARITY");
		array_push($FieldBarcode,"RATE");
		array_push($FieldBarcode,"DISCPER");
		array_push($FieldBarcode,"RATEDOLLAR");
		array_push($FieldBarcode,"PERCRTDOLLAR");
		array_push($FieldBarcode,"TOTALDOLLAR");
		
	
		$cnt_idx = substr($Barcode,2);
		$reccnt = getFieldDetail(EXPORTDIAMOND,"count(*)"," WHERE ENTRYID = '".$_POST["ENTRYID".$cnt_idx]."' AND BARCODENO='".$Barcode."'");
		
		
		if ($reccnt == 0)
		{
			
					
			foreach($FieldBarcode as $Field)
			{
				array_push($ValueBarcode,"'".$_POST[$Field.$cnt_idx]."'");
			
			}
			
			array_push($FieldBarcode,"BARCODENO");
			array_push($ValueBarcode,"'". $Barcode ."'");			
			array_push($FieldBarcode,"UPDATEDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldBarcode,"FLAG");
			array_push($ValueBarcode,"'0'");
			array_push($FieldBarcode,"USERNAME");
			array_push($ValueBarcode,"'".$loginuser_name."'");
			array_push($FieldBarcode,"ID");
			array_push($ValueBarcode,"'". $ID ."'");
			array_push($FieldBarcode,"ENTRYDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			
			array_push($FieldBarcode,"LOCATIONNAME");
			array_push($ValueBarcode,"'".$_POST["txtLOCATIONNAME"]."'");
			array_push($FieldBarcode,"PROCESSTYPE");
			array_push($ValueBarcode,"'Export Diamond'");			
			$ENTRYID = newData($FieldBarcode,$ValueBarcode,EXPORTDIAMOND,TRUE);	
		}
		else
		{
			$cnt_idx = substr($Barcode,2);
			foreach($FieldBarcode as $Field)
			{
				array_push($ValueBarcode,"'".$_POST[$Field.$cnt_idx]."'");
			}
			array_push($FieldBarcode,"BARCODENO");
			array_push($ValueBarcode,"'". $Barcode ."'");
			array_push($FieldBarcode,"PROCESSTYPE");
			array_push($ValueBarcode,"'Export Diamond'");
			array_push($FieldBarcode,"ID");
			array_push($ValueBarcode,"'". $ID ."'");
		
				
			array_push($FieldBarcode,"UPDATEDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldBarcode,"FLAG");
			array_push($ValueBarcode,"'0'");
			array_push($FieldBarcode,"USERNAME");
			array_push($ValueBarcode,"'".$loginuser_name."'");
			array_push($FieldBarcode,"LOCATIONNAME");
			array_push($ValueBarcode,"'".$_POST["txtLOCATIONNAME"]."'");
		
			editData($FieldBarcode,$ValueBarcode,EXPORTDIAMOND," WHERE ENTRYID = '".$_POST["ENTRYID".$cnt_idx]."' AND ID='". $_POST["ID"] ."' AND BARCODENO='".$Barcode."' AND PROCESSTYPE='Export Diamond'");
		}		
	}
	
		
	?>
	<script>
		window.location.href="<?php echo SITEURL."?exportdiamond";?>";
	</script>
		<?php
		exit();
	$action = "";	

}
elseif(isset($_POST["shape_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE ID IN (".$DeleteString.") AND VOUCHERTYPE='Export Diamond'";
	
	
	deleteData(EXPORTDIAMOND," where ID IN (".$DeleteString.") AND PROCESSTYPE='Export Diamond'");
	
	
	?>
	<script>
	window.location.href="<?php echo SITEURL."?exportdiamond&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Export Diamond</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?exportdiamond&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?exportdiamond&_vid"><i class="fa fa-plus-tasks"></i>View</a>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?exportdiamond" method="POST" onsubmit="return confirm('Do you really want to Delete selected Invoice?');">
					<?php echo $back_button;?>
					<p>
						<?php
						
						if($del_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?exportdiamond&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
						<button type="submit" name="shape_mul" class="btn btn-danger delcls" ><i class="fa fa-trash-o"></i> Delete</button>
						<?php
						}
						?>
					
					</p>
					
				
					<?php
					if ($view_bol)
					{
						?>
						<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
							<thead>
								<tr>
									<th style="text-align:center;width:5%;" >
									MemoIssue
									<input type="checkbox" id="SelectAll" />
									</th>
									
									<th>Id</th>	
									<th>Date</th>	
									<th>Stock Id</th>								
															
									<th>Weight</th>	
								
									<th>Col</th>	
									<th>Cal</th>	
								
									<th>Rate</th>
									<th>Rate $</th>
									<th>Disc%</th>
									<th>Percrt$</th>
									<th>Rate$</th>
									<th>Certi</th>	
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								
								
								
								
								while($resdata = mysqli_fetch_assoc($res))
									{
										//echo $resdata["ENTRYID"];
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["ID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td class="open_custom_overlay" rel="<?php echo $resdata["ID"];?>-pur"><a href="javascript:void(0)"><?php echo $resdata["ID"];?></a></td>
												<td><?php echo getDateFormat($resdata["ENTRYDATE"]);?></td>
												<td><?php echo $resdata["BARCODENO"];?></td>
											
											
												<td><?php echo $resdata["WEIGHT"];?></td>
												
												<td><?php echo $resdata["COLOR"];?></td>
												<td><?php echo $resdata["CLARITY"];?></td>
												
												<td class="amountalign"><?php echo getCurrFormat0($resdata["RATE"]) ;?></td>
													<td class="amountalign"><?php echo getCurrFormat($resdata["RATEDOLLAR"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["DISCPER"]) ;?></td>
											
												<td class="amountalign"><?php echo getCurrFormat($resdata["PERCRTDOLLAR"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["RATEDOLLAR"]) ;?></td>
												
																							
												<td><?php echo $resdata["CERTIFICATENO"];?></td>
												
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?exportdiamond&_mid=<?php echo $resdata["ENTRYID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?exportdiamond&_rid=<?php echo $resdata["ENTRYID"];?>" onclick="return confirm('Do you really want to Delete Sale : <?php echo $resdata["SHAPENAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
													<?php
													}
													?>
													<a href="<?php echo SITEURL; ?>makexls.php?makexls=export_<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Make XLS: <?php echo $resdata["ID"];?>?');" class="btn btn-success btn-circle" title="XLS">
														<i class="fa fa-file-excel-o"></i>
													</a>
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
					<form id="frm_Sale" action="<?php echo SITEURL; ?>?exportdiamond" method="POST" >
						
						<input type="hidden" name="ID" id="ID" value="<?php echo $resdata["ID"];?>">
						
						
						<div class="row form-group">
							<div class="col-lg-2">
									<label>Date</label>
									<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php echo isset($resdata["VOUCHERDATE"]) ? $resdata["VOUCHERDATE"] : date('Y-m-d');?>">
									<p class="help-block"></p>
							</div>
							
							<div class="col-lg-1">
									<label>Location</label>
									 <select class="form-control" name="txtLOCATIONNAME" id="txtLOCATIONNAME">
											<option value="">Select Location</option>
											<?php
											$res_LOC = getData(LOCATION_MST,$AllArr," WHERE FLAG='0'");
											$selected_location = $resdata["LOCATIONNAME"] == ''?"MUMBAI":$resdata["LOCATIONNAME"];
											while($res_LOC_data = mysqli_fetch_assoc($res_LOC))
												{
													?>
													<option value="<?php echo $res_LOC_data["LOCATIONNAME"];?>" <?php echo $res_LOC_data["LOCATIONNAME"]==$selected_location ? 'selected="selected"':'';?>> <?php echo $res_LOC_data["LOCATIONNAME"];?> </option>
													<?php
												}
											?>
										</select>
									<p class="help-block"></p>
							</div>
					
							
						</div>
						
						<div class="form-group">
							<table id="addmorefield" width="110%" class="inputaddmorefieldtable customResponsiveTable">
								<thead>
								<tr>
									<th >Stock Id</th>
									<th >Wgt</th>
									<th >Col</th>
									<th >Cla</th>
									<th >Rap</th>
									<th >Rate $</th>
									<th >Disc %</th>
									
									<th >$/Crt </th>
									<th >$ Rate</th>
									<th>Cert.</th>
									<th ></th>
								</tr>								
								</thead>
								<tbody id="listbarcode">
								<?php
									$resprod = getData(EXPORTDIAMOND,$AllArr," WHERE ID='".$resdata["ID"]."' AND PROCESSTYPE='Export Diamond'");
									
									$BARCODENO=0;
									$SUMWEIGHT = 0;
									$SUMRATE = 0;
									$SUMRATEDOLLAR = 0;
									$DISCPER=0;
									$DISC2PER=0;
									$DISC3PER=0;
									
									if(isset($_GET["_nid"]))
									{
										?>
										<tr>
										<td>
											
											<input type="text" style="width:70px;" class="form-control bs_ BARCODENO_" name="BARCODENO[]" rel="<?php echo strtoupper($filename);?>" id="BARCODENO" >
										</td>
										
									</tr>
										<?php
									}
									else
									{
											while($resproddata = mysqli_fetch_assoc($resprod))
									{
										$CNT_IDX = substr($resproddata["BARCODENO"],2);
										$BARCODENO=$resproddata["BARCODENO"];
										$SUMWEIGHT += $resproddata["WEIGHT"];
										$SUMRATE += $resproddata["RATE"];
										$SUMRATEDOLLAR += $resproddata["RATEDOLLAR"];
										$DISCPER += $resproddata["DISCPER"];
										
										?>
										<tr>
											
											
											<td>
											<input type="hidden"  class="form-control BARCODENO_" name="ENTRYID<?php echo $CNT_IDX;?>" id="ENTRYID<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["ENTRYID"];?>">
											
												<input type="text" style="width: 80px;" class="form-control BARCODENO_" name="BARCODENO[]" id="BARCODENO<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["BARCODENO"];?>">
											</td>
											
										
											<td>
												<input type="text" style="width: 40px;" class="form-control rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $CNT_IDX;?>" id="WEIGHT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["WEIGHT"];?>">
											</td>
											<td>
												<input type="text" style="width: 30px;" class="form-control rapprice" name="COLOR<?php echo $CNT_IDX;?>" id="COLOR<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["COLOR"];?>">
											</td>
											<td>
												<input type="text" style="width: 40px;" class="form-control rapprice" name="CLARITY<?php echo $CNT_IDX;?>" id="CLARITY<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CLARITY"];?>">
											</td>
											
											
											<td>
												<input type="text" style="width: 60px;text-align:right;" class="form-control txtweightrate RATE_" name="RATE<?php echo $CNT_IDX;?>" id="RATE<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RATE"];?>">
											</td>
												<td>
												<input type="text" style="width: 60px;text-align:right;" class="form-control RATEDOLLAR_" name="RATEDOLLAR<?php echo $CNT_IDX;?>" id="RATEDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RATEDOLLAR"];?>">
											</td>
											<td>
												<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate DISCPER_" name="DISCPER<?php echo $CNT_IDX;?>" id="DISCPER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISCPER"];?>">
											</td>
										
										
											<td>
												<input type="text" style="width: 70px;text-align:right;" class="form-control PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $CNT_IDX;?>" id="PERCRTDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["PERCRTDOLLAR"];?>">
											</td>
											<td>
												<input type="text" style="width: 70px;text-align:right;" class="form-control TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $CNT_IDX;?>" id="TOTALDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["TOTALDOLLAR"];?>">
											</td>
											<td>
												<input type="text"  style="width: 80px;" class="form-control" name="CERTIFICATENO<?php echo $CNT_IDX;?>" id="CERTIFICATENO<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CERTIFICATENO"];?>">
											</td>
											
											<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" rel="<?php echo $resproddata["BARCODENO"];?>/MemoIssue" ><i class="fa fa-remove"></i></a></td>
										</tr>
										<?php
									}
									}
									
								?>
								</tbody>
								<tr>
										<td>
											<input type="text" style="width: 80px;text-align:right;" class="form-control" name="txtTOTALQTY" readonly id="txtTOTALQTY" value="<?php echo mysqli_num_rows($resprod);?>">
										</td>
										<td>
											<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="SUMWEIGHT" id="SUMWEIGHT" value="<?php echo $SUMWEIGHT?>">
										</td>
										<td colspan="2"></td>
										<td>
											<input type="text" style="width: 60px;text-align:right;" class="form-control txtweightrate" readonly name="SUMRATE" id="SUMRATE" value="<?php echo $SUMRATE?>">
										</td>
										<td>
											<input type="text" style="width: 60px;text-align:right;" class="form-control" name="SUMRATEDOLLAR" readonly id="SUMRATEDOLLAR" value="<?php echo $SUMRATEDOLLAR?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="AVGDISCPER" id="AVGDISCPER" value="<?php echo $DISCPER;?>">
										</td>
										
										
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control" readonly name="txtPERCRTTOTALDOLLAR" id="txtPERCRTTOTALDOLLAR" value="<?php echo $resdata["PERCRTDOLLAR"]?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;"  class="form-control" readonly name="txtTOTALDOLLAR" id="txtTOTALDOLLAR" value="<?php echo $resdata["TOTALDOLLAR"]?>">
										</td>
										<td colspan="2"></td>
									
								</tr>
							</table>
							<a  class="btn btn-success add_field_button_ pull-right"  rel="1" href="javascript:void(0)" style="margin-bottom:10px;" ><i class="fa fa-plus-circle"></i> Add More Fields</a>
						
						</div>
						<div class="form-group">
						&nbsp;
						</div>
						<div class="form-group">
						<button type="submit" class="btn btn-default" style="float: right;margin-left: 10px;" name="exportdiamond" id="btnSale">Submit Button</button>
						</div>
						<img id="lodimg" src="<?php echo SITEURL.INIT."images/loading.gif";?>" style="float: right;display:none;"/>
					</form>
				</div>
				  </div>
			</div>
		</div>
		
	</div>

	<?php
}
?>
	
<?php
?>

	
