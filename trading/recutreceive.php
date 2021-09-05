<?php
$FieldArr= array();
			
								array_push($FieldArr,"BP.ENTRYID");
								array_push($FieldArr,"BP.ID");
								array_push($FieldArr,"BP.ENTRYDATE");
								array_push($FieldArr,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr,"BP.REMARK");
								array_push($FieldArr,"BARCODENO");
								//array_push($FieldArr,"NEWBARCODENO");
								array_push($FieldArr,"WEIGHT");
								array_push($FieldArr,"SHAPE");
								array_push($FieldArr,"COLOR");
								array_push($FieldArr,"CLARITY");
								array_push($FieldArr,"CUT");
								array_push($FieldArr,"POLISH");
								array_push($FieldArr,"SYMM");
								array_push($FieldArr,"FLOURANCE");
								array_push($FieldArr,"EXPENCE");
								array_push($FieldArr,"MILKY");
								array_push($FieldArr,"LAB");
								array_push($FieldArr,"CERTIFICATENO");
								array_push($FieldArr,"RATE");
								array_push($FieldArr,"DISCPER");
								array_push($FieldArr,"PERCRTDOLLAR");
								array_push($FieldArr,"RATEDOLLAR");
								array_push($FieldArr,"CONVRATE");
									array_push($FieldArr,"VDATE");
			$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Recut Receive' ORDER BY BP.ID DESC");
			$salSTRCAPTION="";
			$SALxlsaction="";		
			$xlsaction1="";	
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Recut Receive Detail";
	$ID = $_GET["_nid"];
	
	$res = getData(BARCODE_PROCESS,$AllArr," WHERE ID='".$ID."' AND PROCESSTYPE='Recut Receive'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$ID = $_GET["_mid"];
	//echo $ID ;
	$Caption = "Edit Recut Receive Detail";
	$res = getData(BARCODE_PROCESS,$AllArr," WHERE ENTRYID='".$ID."' AND PROCESSTYPE='Recut Receive'");
	$resdata = mysqli_fetch_assoc($res);	
	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$ENTRYID = $_GET["_rid"];	
	$ID = $_GET["_IDSTR"];	
	deleteData(BARCODE_PROCESS," where ENTRYID='".$ENTRYID."' AND PROCESSTYPE='Recut Receive'");
	deleteData(LEDGER_CREDIT," where VOUCHERNO='".$ID."' AND VOUCHERTYPE='Recut Receive Expense'");
	deleteData(LEDGER_DEBIT," where VOUCHERNO='".$ID."' AND VOUCHERTYPE='Recut Receive Expense'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?recutreceive&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}
if(isset($_POST["recutreceive"]))
{
	
	$idx = 0;
	$Barcode_Arr = $_POST["BARCODENO"];
	$ID=($_POST["ID"] == 0 ? getMaxValue(BARCODE_PROCESS,"ID"," WHERE PROCESSTYPE='Recut Receive'") : $_POST["ID"]);
	foreach ($Barcode_Arr as $Barcode)
	{
			
		$FieldBarcode= array();
		$ValueBarcode= array();
		
		$tranFieldArr= array();
		$tranValueArr= array();
		
		//array_push($FieldBarcode,"NEWBARCODENO");
		array_push($FieldBarcode,"PCS");
		array_push($FieldBarcode,"LAB");
		array_push($FieldBarcode,"CERTIFICATENO");
		array_push($FieldBarcode,"WEIGHT");
		array_push($FieldBarcode,"SHAPE");
		array_push($FieldBarcode,"COLOR");
		array_push($FieldBarcode,"CLARITY");
		array_push($FieldBarcode,"CUT");
		array_push($FieldBarcode,"POLISH");
		array_push($FieldBarcode,"SYMM");
		array_push($FieldBarcode,"FLOURANCE");
		
		
		
		array_push($FieldBarcode,"RATE");
		array_push($FieldBarcode,"DISCPER");
		array_push($FieldBarcode,"RATEDOLLAR");
		array_push($FieldBarcode,"DISC2PER");
		array_push($FieldBarcode,"DISC3PER");
		array_push($FieldBarcode,"PERCRTDOLLAR");
		array_push($FieldBarcode,"TOTALDOLLAR");
		array_push($FieldBarcode,"BGM");
		array_push($FieldBarcode,"EXPENCE");
		array_push($FieldBarcode,"RSPERCRT");
		array_push($FieldBarcode,"RSAMOUNT");
		array_push($FieldBarcode,"CONVRATE");


		array_push($FieldBarcode,"RAPDISCOUNT");
		array_push($FieldBarcode,"RAPPERCRT");
		array_push($FieldBarcode,"RAPTOTALDOLLAR");
		
		
		$cnt_idx = substr($Barcode,2);
		$reccnt = getFieldDetail(BARCODE_PROCESS,"count(*)"," WHERE ENTRYID = '".$_POST["ENTRYID".$cnt_idx]."' AND ID='". $_POST["ID"] ."' AND BARCODENO='".$Barcode."' AND PROCESSTYPE='Recut Receive'");
		
		
		if ($reccnt == 0)
		{
			
					
			foreach($FieldBarcode as $Field)
			{
				array_push($ValueBarcode,"'".$_POST[$Field.$cnt_idx]."'");
			
			}
			
			array_push($FieldBarcode,"BARCODENO");
			array_push($ValueBarcode,"'". $Barcode ."'");
			array_push($FieldBarcode,"PROCESSTYPE");
			array_push($ValueBarcode,"'Recut Receive'");
			array_push($FieldBarcode,"ID");
			array_push($ValueBarcode,"'". $ID ."'");
			array_push($FieldBarcode,"LEDGERID");
			array_push($ValueBarcode,"'". $_POST["txtLEDGERID"] ."'");
			array_push($FieldBarcode,"BROKERID");
			array_push($ValueBarcode,"'". $_POST["txtBROKERID"] ."'");
			

			array_push($FieldBarcode,"REMARK");	
			array_push($ValueBarcode,"'". $_POST["txtREMARK"] ."'");				
			array_push($FieldBarcode,"UPDATEDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldBarcode,"FLAG");
			array_push($ValueBarcode,"'0'");
			array_push($FieldBarcode,"USERNAME");
			array_push($ValueBarcode,"'".$loginuser_name."'");
			
			array_push($FieldBarcode,"ENTRYDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			
			array_push($FieldBarcode,"LOCATIONNAME");
			array_push($ValueBarcode,"'".$_POST["txtLOCATIONNAME"]."'");		

			array_push($FieldBarcode,"VDATE");
			array_push($ValueBarcode,"'".$_POST["dtpVOUCHERDATE"]."'");
			
			$ENTRYID = newData($FieldBarcode,$ValueBarcode,BARCODE_PROCESS,TRUE);	
			
		//exit();
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
			array_push($ValueBarcode,"'Recut Receive'");
			array_push($FieldBarcode,"ID");
			array_push($ValueBarcode,"'". $_POST["ID"] ."'");
			array_push($FieldBarcode,"LEDGERID");
			array_push($ValueBarcode,"'". $_POST["txtLEDGERID"] ."'");
			array_push($FieldBarcode,"BROKERID");
			array_push($ValueBarcode,"'". $_POST["txtBROKERID"] ."'");
			

			array_push($FieldBarcode,"REMARK");	
			array_push($ValueBarcode,"'". $_POST["txtREMARK"] ."'");				
			array_push($FieldBarcode,"UPDATEDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldBarcode,"FLAG");
			array_push($ValueBarcode,"'0'");
			array_push($FieldBarcode,"USERNAME");
			array_push($ValueBarcode,"'".$loginuser_name."'");
			array_push($FieldBarcode,"LOCATIONNAME");
			array_push($ValueBarcode,"'".$_POST["txtLOCATIONNAME"]."'");
		
			array_push($FieldBarcode,"VDATE");
			array_push($ValueBarcode,"'".$_POST["dtpVOUCHERDATE"]."'");
			
			editData($FieldBarcode,$ValueBarcode,BARCODE_PROCESS," WHERE ENTRYID = '".$_POST["ENTRYID".$cnt_idx]."' AND ID='". $_POST["ID"] ."' AND BARCODENO='".$Barcode."' AND PROCESSTYPE='Recut Receive'");
		}	

			$EXPENCE = ($_POST["EXPENCE".$cnt_idx]);
		
		//=====================ledger entry========================
			if ($EXPENCE != 0)
			{
				
				
				$DRLEDGERID =2733;//MEMORECEIVE_ANG_EXPENSE_LEDGERID
				$CRLEDGERID= $_POST["txtLEDGERID"];//cmbEXPENSELEDGERID.SelectedValue
				$DRGROUPID=getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$DRLEDGERID."'");
				$CRGROUPID=getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'");
				$cnt_ledger_DR  = getFieldDetail(LEDGER_DEBIT,"count(*)", " WHERE VOUCHERNO = '".$ID."' AND DESCRIPTION = '".$Barcode."' AND LEDGERID = '".$DRLEDGERID. "' and VOUCHERTYPE='Recut Receive Expense'");
				$dr = $cnt_ledger_DR;
				$cnt_ledger_CR =  getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE VOUCHERNO = '" .$ID. "' AND DESCRIPTION = '" .$Barcode. "' AND LEDGERID = '".$CRLEDGERID ."' and VOUCHERTYPE='Recut Receive Expense'");
                $cr=$cnt_ledger_CR; 
				
				if ($cnt_ledger_DR = 0 && $cnt_ledger_CR = 0)
				{
                    $SRNO = getMaxValue_TRAN(LEDGER_DEBIT, "SRNO");
				}
			    elseif ($cnt_ledger_DR > 0 && $cnt_ledger_CR = 0)
				{
                    $SRNO = getfielddetail(LEDGER_DEBIT, "SRNO", " WHERE VOUCHERNO = '" .$ID. "' AND DESCRIPTION = '".$Barcode."' AND LEDGERID = '".$DRLEDGERID . "' and VOUCHERTYPE='Recut Receive Expense'");
			    }
				elseif ($cnt_ledger_DR = 0 && $cnt_ledger_CR > 0 )
				{
                    $SRNO = getfielddetail(LEDGER_DEBIT, "SRNO", " WHERE VOUCHERNO = '" .$ID."' AND DESCRIPTION = '" .$Barcode."' AND LEDGERID = '".$CRLEDGERID ."' and VOUCHERTYPE='Recut Receive Expense'");
				}
				else
				{
					$SRNO = getMaxValue_TRAN(LEDGER_DEBIT, "SRNO");
				}
								
					
					array_push($tranFieldArr,"VOUCHERNO");
					array_push($tranFieldArr,"VOUCHERTYPE");					
					array_push($tranFieldArr,"AMOUNT");
					array_push($tranFieldArr,"DESCRIPTION");
					array_push($tranFieldArr,"VOUCHERDATE");
					array_push($tranFieldArr,"UPDATEDATE");
					array_push($tranFieldArr,"USERNAME");
					
					array_push($tranFieldArr,"LEDGERID");
					array_push($tranFieldArr,"GROUPID");
					
					
					
					array_push($tranValueArr,"'".$ID."'");
					array_push($tranValueArr,"'Recut Receive Expense'");					
					array_push($tranValueArr,"'".$EXPENCE."'");
					array_push($tranValueArr,"'".$Barcode."'");
					array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
					array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
					array_push($tranValueArr,"'".$loginuser_name."'");
					
					$Condition = " WHERE VOUCHERTYPE='Recut Receive Expense' AND DESCRIPTION='".$Barcode."' AND VOUCHERNO='".$ID."'";
				 if ($dr  == 0)
				 {
					
					$tranValueArr[7] = "'".$DRLEDGERID."'";
					
					$tranValueArr[8] = "'".$DRGROUPID."'";
					array_push($tranFieldArr,"SRNO");
					array_push($tranFieldArr,"ENTRYDATE");
					array_push($tranValueArr,"'".$SRNO."'");
					array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
					newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);		
				}
				else
				{
					
					
					$tranValueArr[7] = "'".$DRLEDGERID."'";
					
					$tranValueArr[8] = "'".$DRGROUPID."'";				
					editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT,$Condition);	
				}
					
				 if ($cr == 0)
				 {
					 
					$tranValueArr[7] = "'".$CRLEDGERID."'";
					$tranValueArr[8] = "'".$CRGROUPID."'";
					
					
					newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);		
				}
				else
				{
					$tranValueArr[7] = "'".$CRLEDGERID."'";
					$tranValueArr[8] = "'".$CRGROUPID."'";	
					editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT,$Condition);	
				}
				
				//exit();
				
				
				
			}
			//==================ledgerid=================================
		
	}
	
	//exit();
	?>
	<script>
		window.location.href="<?php echo SITEURL."?recutreceive";?>";
	</script>
		<?php
		exit();
	$action = "";	

}
elseif(isset($_POST["shape_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE ID IN (".$DeleteString.") AND VOUCHERTYPE='Recut Receive'";
	
	
	deleteData(BARCODE_PROCESS," where ID IN (".$DeleteString.") AND PROCESSTYPE='Recut Receive'");
	deleteData(LEDGER_CREDIT," where VOUCHERNO IN (".$DeleteString.") AND VOUCHERTYPE='Recut Receive Expense'");
	deleteData(LEDGER_DEBIT," where VOUCHERNO IN (".$DeleteString.") AND VOUCHERTYPE='Recut Receive Expense'");
	
	?>
	<script>
	window.location.href="<?php echo SITEURL."?recutreceive&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Recut Receive</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?recutreceive&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?recutreceive&_vid"><i class="fa fa-plus-tasks"></i>View</a>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?recutreceive" method="POST" onsubmit="return confirm('Do you really want to Delete selected Invoice?');">
					<?php echo $back_button;?>
					<p>
						<?php
						if($del_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?recutreceive&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
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
									Recut Receive
									<input type="checkbox" id="SelectAll" />
									</th>
									
									<th>Id</th>	
									<th>Date</th>	
									<th>Party</th>
									<th>Broker</th>
									<th>Lab</th>	
									<th>Certi</th>	
									<th>Barcodeno</th>							
									<!--<th>New Barcodeno</th>-->
									<th>Weight</th>	
									<th>Shape</th>	
									<th>Col</th>	
									<th>Cal</th>	
									<th>Cut</th>	
									<th>Polish</th>	
									<th>Symm</th>	
									<th>Flou</th>		
									<th>$</th>
									<th>Rate</th>
									<th>Disc%</th>
									<th>Percrt$</th>
									<th>Rate$</th>
									<th>Expense</th>
									<th>Remark</th>
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
												<!--<td class="open_custom_overlay" rel="<?php echo $resdata["ID"];?>-pur"><a href="javascript:void(0)"><?php echo $resdata["ID"];?></a></td>-->
												<td><?php echo $resdata["ID"];?></td>
												<td><?php echo getDateFormat($resdata["VDATE"]);?></td>
												<td><?php echo $resdata["PARTY"];?></td>
												<td><?php echo $resdata["BROKER"];?></td>
												<td><?php echo $resdata["LAB"];?></td>
												<td><?php echo $resdata["CERTIFICATENO"];?></td>
												<td><?php //echo $resdata["BARCODENO"];?></td>
												<td><?php echo $resdata["NEWBARCODENO"];?></td>
												<td><?php echo $resdata["WEIGHT"];?></td>
												<td><?php echo $resdata["SHAPE"];?></td>
												<td><?php echo $resdata["COLOR"];?></td>
												<td><?php echo $resdata["CLARITY"];?></td>
												<td><?php echo $resdata["CUT"];?></td>
												<td><?php echo $resdata["POLISH"];?></td>
												<td><?php echo $resdata["SYMM"];?></td>
												<td><?php echo $resdata["FLOURANCE"];?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["CONVRATE"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat0($resdata["RATE"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["DISCPER"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["PERCRTDOLLAR"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["RATEDOLLAR"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["EXPENCE"]) ;?></td>
												
																							
											<td><?php echo $resdata["REMARK"];?></td>
												
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?recutreceive&_mid=<?php echo $resdata["ENTRYID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?recutreceive&_rid=<?php echo $resdata["ENTRYID"];?>&_IDSTR=<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Delete Sale : <?php echo $resdata["SHAPENAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
													<?php
													}
													?>
													<a href="<?php echo SITEURL; ?>makexls.php?makexls=sale_<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Make XLS: <?php echo $resdata["ID"];?>?');" class="btn btn-success btn-circle" title="XLS">
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
					<form id="frm_Sale" action="<?php echo SITEURL; ?>?recutreceive" method="POST" >
						
						<input type="hidden" name="ID" id="ID" value="<?php echo $resdata["ID"];?>">
						
						
						<div class="row form-group">
							<div class="col-lg-2">
									<label>Date</label>
									<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php echo isset($resdata["VOUCHERDATE"]) ? $resdata["VOUCHERDATE"] : date('Y-m-d');?>">
									<p class="help-block"></p>
							</div>
							
							
								<div class="col-lg-2">
										<label>Party</label>
										 <select class="form-control" name="txtLEDGERID" id="txtLEDGERID">
												<option value="">Select Party</option>
												<?php
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' ORDER BY LEDGERNAME");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														?>
														<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==$resdata["LEDGERID"] ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
														<?php
													}
												?>
											</select>
											<input type="hidden"  class="form-control" readonly name="STATE" id="STATE" value="">
										<p class="help-block"></p>
								</div>
							
								<div class="col-lg-2">
									<label>Broker</label>
									 <select class="form-control" name="txtBROKERID" id="txtBROKERID">
											<option value="">Select Broker</option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID='29'");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==$resdata["BROKERID"] ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
													<?php
												}
											?>
										</select>
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>Location</label>
									 <select class="form-control" name="txtLOCATIONNAME" id="txtLOCATIONNAME">
											<option value="">Select Location</option>
											<?php
											$res_LOC = getData(LOCATION_MST,$AllArr," WHERE FLAG='0'");
											while($res_LOC_data = mysqli_fetch_assoc($res_LOC))
												{
													?>
													<option value="<?php echo $res_LOC_data["LOCATIONNAME"];?>" <?php echo $res_LOC_data["LOCATIONNAME"]==$resdata["LOCATIONNAME"] ? 'selected="selected"':'';?>> <?php echo $res_LOC_data["LOCATIONNAME"];?> </option>
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
									<th >New Stock Id</th>
									<th >Lab</th>
									<th>Cert.</th>
									<th >Shape</th>
									<th >Pcs</th>
									<th >Wgt</th>
									<th >Col</th>
									<th >Cla</th>
									<th >Cut</th>
									<th >Pol</th>
									<th >Sym</th>
									<th >Flou</th>
									<th >Rap</th>
									<th >Dis</th>
									<th >$ Rate</th>
									<th >Dis 1</th>
									<th >Dis 2</th>
									<th >$/Crt</th>
									<th >$ Total</th>
									<th >$</th>
									<th >Expense</th>
									<th >Rs/Crt</th>
									<th >Rs Amt</th>
									<th >BGM</th>
									<th ></th>
								</tr>								
								</thead>
								<tbody id="listbarcode">
								<?php
									$resprod = getData(BARCODE_PROCESS,$AllArr," WHERE ID='".$resdata["ID"]."' AND PROCESSTYPE='Recut Receive'");
									
									$BARCODENO=0;
									$SUMWEIGHT = 0;
									$SUMRATE = 0;
									$SUMRATEDOLLAR = 0;
									$DISCPER=0;
									$DISC2PER=0;
									$DISC3PER=0;
									$EXPENSEAMT =0;
									
									$RSAMOUNTSUM=0;
									$RSPERCRTSUM=0;
									$BARArr = array();
									while($resproddata = mysqli_fetch_assoc($resprod))
									{
										$CNT_IDX = substr($resproddata["BARCODENO"],2);
										$BARCODENO=$resproddata["BARCODENO"];
										$SUMWEIGHT += $resproddata["WEIGHT"];
										$SUMRATE += $resproddata["RATE"];
										$SUMRATEDOLLAR += $resproddata["RATEDOLLAR"];
										$DISCPER += $resproddata["DISCPER"];
										$DISC2PER += $resproddata["DISC2PER"];
										$DISC3PER += $resproddata["DISC3PER"];
										$EXPENSEAMT += $resproddata["EXPENCE"];
										
										$RSAMOUNTSUM += $resproddata["RSAMOUNT"];
										$RSPERCRTSUM += $resproddata["RSPERCRT"];
										$BARArr[] = $BARCODENO;
										?>
										<tr>
											<td>
											<input type="hidden"  class="form-control BARCODENO_" name="ENTRYID<?php echo $CNT_IDX;?>" id="ENTRYID<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["ENTRYID"];?>">
											
												<input type="text" style="width: 80px;" class="form-control BARCODENO_" name="BARCODENO[]" id="BARCODENO<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["BARCODENO"];?>">
											</td>
											<td>
												<input type="text"  style="width: 100px;" class="form-control" name="NEWBARCODENO<?php echo $CNT_IDX;?>" id="NEWBARCODENO<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["NEWBARCODENO"];?>">
											</td>
											<td>
												<input type="text"  style="width: 30px;" class="form-control" name="LAB<?php echo $CNT_IDX;?>" id="LAB<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["LAB"];?>">
											</td>
											<td>
												<input type="text"  style="width: 80px;" class="form-control" name="CERTIFICATENO<?php echo $CNT_IDX;?>" id="CERTIFICATENO<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CERTIFICATENO"];?>">
											</td>
											<td>
												<input type="text" style="width: 80px;" class="form-control rapprice" name="SHAPE<?php echo $CNT_IDX;?>" id="SHAPE<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["SHAPE"];?>">
											</td>
											<td>
												<input type="text" style="width: 30px;" class="form-control" name="PCS<?php echo $CNT_IDX;?>" id="PCS<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["PCS"];?>">
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
												<input type="text" style="width: 30px;" class="form-control" name="CUT<?php echo $CNT_IDX;?>" id="CUT<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CUT"];?>">
											</td>
											<td>
												<input type="text" style="width: 30px;" class="form-control" name="POLISH<?php echo $CNT_IDX;?>" id="POLISH<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["POLISH"];?>">
											</td>
											<td>
												<input type="text" style="width: 30px;" class="form-control" name="SYMM<?php echo $CNT_IDX;?>" id="SYMM<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["SYMM"];?>">
											</td>
											<td>
												<input type="text" style="width: 60px;" class="form-control" name="FLOURANCE<?php echo $CNT_IDX;?>" id="FLOURANCE<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["FLOURANCE"];?>">
											</td>
											
											<td>
												<input type="text" style="width: 60px;text-align:right;" class="form-control txtweightrate RATE_" name="RATE<?php echo $CNT_IDX;?>" id="RATE<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RATE"];?>">
											</td>
											<td>
												<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate DISCPER_" name="DISCPER<?php echo $CNT_IDX;?>" id="DISCPER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISCPER"];?>">
											</td>
											<td>
												<input type="text" style="width: 60px;text-align:right;" class="form-control RATEDOLLAR_" name="RATEDOLLAR<?php echo $CNT_IDX;?>" id="RATEDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RATEDOLLAR"];?>">
											</td>
											<td>
												<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate DISC2PER_" name="DISC2PER<?php echo $CNT_IDX;?>" id="DISC2PER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISC2PER"];?>">
											</td>
											<td>
												<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate DISC3PER_" name="DISC3PER<?php echo $CNT_IDX;?>" id="DISC3PER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISC3PER"];?>">
											</td>
											<td>
												<input type="text" style="width: 70px;text-align:right;" class="form-control PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $CNT_IDX;?>" id="PERCRTDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["PERCRTDOLLAR"];?>">
											</td>
											<td>
												<input type="text" style="width: 70px;text-align:right;" class="form-control TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $CNT_IDX;?>" id="TOTALDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["TOTALDOLLAR"];?>">
											</td>
											<td>
												<input type="text" style="width: 70px;text-align:right;" class="form-control txtweightrate CONVRATE_" name="CONVRATE<?php echo $CNT_IDX;?>" id="CONVRATE<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CONVRATE"];?>">
											</td>
											<td>
												<input type="text" style="width: 70px;text-align:right;" class="form-control EXPENCE_" name="EXPENCE<?php echo $CNT_IDX;?>" id="EXPENCE<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["EXPENCE"];?>">
											</td>
											<td>
												<input type="text"  style="width: 70px;text-align:right;" class="form-control RSPERCRT_" name="RSPERCRT<?php echo $CNT_IDX;?>" id="RSPERCRT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RSPERCRT"];?>">
											</td>
											<td>
												<input type="text" style="width: 70px;text-align:right;" class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $CNT_IDX;?>" id="RSAMOUNT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RSAMOUNT"];?>">
											</td>
											<td>
												<input type="text" style="width: 70px;text-align:right;" class="form-control" name="BGM<?php echo $CNT_IDX;?>" id="BGM<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["BGM"];?>">
											</td>
											<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" rel="<?php echo $resproddata["BARCODENO"];?>/RecutReceive" ><i class="fa fa-remove"></i></a></td>
										</tr>
										<?php
									}
								?>
								</tbody>
								<tr>
										<td>
											<input type="text" style="width: 80px;text-align:right;" class="form-control" name="txtTOTALQTY" readonly id="txtTOTALQTY" value="<?php echo count($BARArr);?>">
										</td>
										<td colspan="5">
											
										</td>
										<td>
											<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="SUMWEIGHT" id="SUMWEIGHT" value="<?php echo $SUMWEIGHT?>">
										</td>
										<td colspan="6">
											
										</td>
										
										<td>
											<input type="text" style="width: 60px;text-align:right;" class="form-control txtweightrate" readonly name="SUMRATE" id="SUMRATE" value="<?php echo $SUMRATE?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="AVGDISCPER" id="AVGDISCPER" value="<?php echo $DISCPER;?>">
										</td>
										<td>
											<input type="text" style="width: 60px;text-align:right;" class="form-control" name="SUMRATEDOLLAR" readonly id="SUMRATEDOLLAR" value="<?php echo $SUMRATEDOLLAR?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="AVGDISC2PER" id="AVGDISC2PER" value="<?php echo $DISC2PER;?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="AVGDISC3PER" id="AVGDISC3PER" value="<?php echo $DISC3PER;?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control" readonly name="txtPERCRTTOTALDOLLAR" id="txtPERCRTTOTALDOLLAR" value="<?php echo $resdata["PERCRTDOLLAR"]?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;"  class="form-control" readonly name="txtTOTALDOLLAR" id="txtTOTALDOLLAR" value="<?php echo $resdata["TOTALDOLLAR"]?>">
										</td>
										<td></td>
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control" readonly name="txtTOTALEXPENCE" id="txtTOTALEXPENCE" value="<?php echo $EXPENSEAMT;?>">
										</td>
									
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control" readonly name="txtTOTALRSRSPERCRT" id="txtTOTALRSRSPERCRT" value="<?php echo $RSPERCRTSUM ;?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;"class="form-control" readonly name="txtTOTALRSAMOUNT" id="txtTOTALRSAMOUNT" value="<?php echo $RSAMOUNTSUM;?>">
										</td>
								</tr>
							</table>
						</div>
						<a  class="btn btn-success add_field_button_ pull-right"  rel="1" href="javascript:void(0)" style="margin-bottom:10px;" ><i class="fa fa-plus-circle"></i> Add More Fields</a>
						<br>
							
				
						
						
									<input type="hidden"  class="form-control" readonly name="companystate" id="companystate" value="<?php echo $rescompanydata["STATE"];?>">
                             
					
						
						<div class="form-group">
                            <label>Remark</label>
                            <input class="form-control" name="txtREMARK" id="txtREMARK" value="<?php echo $resdata["REMARK"];?>">
                                <p class="help-block"></p>
                        </div>
					
							
							
						
						<button type="submit" class="btn btn-default" style="float: right;margin-left: 10px;" name="recutreceive" id="btnSale">Submit Button</button>
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

	
