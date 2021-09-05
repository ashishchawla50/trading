<?php

$FieldArr= array();
			
								array_push($FieldArr,"BP.ENTRYID");
								array_push($FieldArr,"BP.ID");
								array_push($FieldArr,"BP.ENTRYDATE");
								array_push($FieldArr,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr,"BP.REMARK");
								array_push($FieldArr,"BARCODENO");
								array_push($FieldArr,"WEIGHT");
								
								array_push($FieldArr,"BP.RSPERCRT");
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"PS.VOUCHERDATE");
								
								$BARCODENOSEARCH = isset($_POST["STOCKIDSEARCH"]) && !empty($_POST["STOCKIDSEARCH"])? " AND (BARCODENO='GP".$_POST["STOCKIDSEARCH"]."' OR CERTIFICATENO='".$_POST["STOCKIDSEARCH"]."' )" : '';
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Sale Invoice' " .$BARCODENOSEARCH ." ORDER BY PS.VOUCHERDATE ");
		
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Sale Invoice Detail";
	$res = getData(PURCHASESALE,$AllArr," WHERE ID='0' AND VOUCHERTYPE='Sale Invoice'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$ID = $_GET["_mid"];
	
	$Caption = "Edit Sale Invoice Detail";
	$res = getData(PURCHASESALE,$AllArr," WHERE ID='".$ID."'");
	$resdata = mysqli_fetch_assoc($res);	
	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$ID = $_GET["_rid"];
	deleteData(PURCHASESALE," where ID='".$ID."' AND VOUCHERTYPE='Sale Invoice'");
	
	
	deleteData(LEDGER_DEBIT," WHERE VOUCHERNO ='".$ID."' AND VOUCHERTYPE='Sale Invoice'");
	deleteData(LEDGER_CREDIT," WHERE VOUCHERNO ='".$ID."' AND VOUCHERTYPE='Sale Invoice'");
	
	deleteData(LEDGER_CREDIT," WHERE VOUCHERNO ='".$ID."' AND VOUCHERTYPE='Tax Out'");
	
	?>
	<script>
		window.location.href="<?php echo SITEURL."?saleinvoice&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]) || isset($_POST["search"]))

{
	$action = "view";	
	
}

if(isset($_POST["saleinvoice"]))
{
	
	$ID = $_POST["ID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	

	foreach($PostArr_Key as $tempctrl)
	{
		$colname_prefix = substr($tempctrl,0,3);
		$colname = substr($tempctrl,3);
		if(substr($tempctrl,strlen($tempctrl)-1,1) != "_")
		{
			switch($colname_prefix)
			{
				case "txt":
					array_push($FieldArr_Col,$colname);
					array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");
				break;
				case "dtp":
							
					array_push($FieldArr_Col,$colname);
					array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");
				break;
				case "rad":
					
					array_push($FieldArr_Col,$colname);
					array_push($FieldArr_Val,"'".(isset($_POST[$tempctrl])? $_POST[$tempctrl] : '')."'");
					
				break;
			}
		}
	}
	
	
	
	array_push($FieldArr_Col,"VOUCHERTYPE");
	array_push($FieldArr_Val,"'Sale Invoice'");
	array_push($FieldArr_Col,"UPDATEDATE");
	array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
	array_push($FieldArr_Col,"USERNAME");
	array_push($FieldArr_Val,"'".$loginuser_name."'");
	array_push($FieldArr_Col,"FLAG");
	array_push($FieldArr_Val,"'0'");
	
	$Condition = " WHERE ID='". $ID ."' AND VOUCHERTYPE='Sale Invoice'";
	
	$reccnt = getFieldDetail(PURCHASESALE,"count(*)"," WHERE ID='". $ID ."' AND VOUCHERTYPE='Sale Invoice'");

	if ($reccnt == 0)
		{
		
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			$ID = newData($FieldArr_Col,$FieldArr_Val,PURCHASESALE,TRUE);	
		}
	else
		{
			editData($FieldArr_Col,$FieldArr_Val,PURCHASESALE,$Condition);
		}		


	?>
	<script>
		window.location.href="<?php echo SITEURL."?saleinvoice";?>";
	</script>
		<?php
	exit();
	$action = "";	

}
elseif(isset($_POST["shape_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE ID IN (".$DeleteString.") AND VOUCHERTYPE='Sale Invoice'";
	deleteData(PURCHASESALE,$Condition);
	?>
	<script>
	window.location.href="<?php echo SITEURL."?saleinvoice&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Sale Invoice</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="" )
{?>
			<div class="row form-group">
				<div class="col-lg-1">
						<?php
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" style="margin-right:10px;" href="<?php echo SITEURL; ?>?saleinvoice&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}?>
				</div>
				<div class="col-lg-1">
						<?php								
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" style="margin-left:10px;" href="<?php echo SITEURL;?>?saleinvoice&_vid"><i class="fa fa-plus-tasks"></i>View</a>
							<?php
						}
						?>
				</div>
				
						</div>
<?php
}
else if($action == "view")
{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?saleinvoice" method="POST" onsubmit="return confirm('Do you really want to Delete selected Invoice?');">
					<?php echo $back_button;?>
					<p>
						<?php
						if($del_bol)
						{
							?>
							<a class="btn btn-success addcls" style="margin-right:10px;" href="<?php echo SITEURL; ?>?saleinvoice&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
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
						 <table class="table table-striped table-bordered table-hover " id="dataTables-example">
							<thead>
								<tr>
									<th style="text-align:center;width:5%;" >
									Sel
									<input type="checkbox" id="SelectAll" />
									</th>
									<th>ID</td>
									<th>Date</th>									
									<th>Party</th>
									<th>Broker</th>	
									<th>WT</th>										
									<th>Rs/Crt</th>
									<th>Rs Amt</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								
								
								
								$res = getData(PURCHASESALE,$AllArr," WHERE VOUCHERTYPE='Sale Invoice'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										
											
										
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php echo $resdata["ID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["ID"];?></td>
												<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>												
												<td><?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resdata["LEDGERID"]."'");?></td>
												<td><?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resdata["BROKERID"]."'");?></td>
																						
												<td><?php echo $resdata["TOTALWEIGHT"];?></td>												
												<td class="amountalign"><?php echo getCurrFormat($resdata["TOTALRSRSPERCRT"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["TOTALRSAMOUNT"]) ;?></td>
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?saleinvoice&_mid=<?php echo $resdata["ID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?saleinvoice&_rid=<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Delete Sale Invoice : <?php echo $resdata["SHAPENAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
													<?php
													}
													?>
													
													<a href="<?php echo SITEURL; ?>makesaleinvoiceprintpdf.php?saleinvoice=<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Make PDF: <?php echo $resdata["ID"];?>?');"  target="_blank" class="btn btn-danger btn-circle" title="PDF">
																<i class="fa fa-file-pdf-o"></i>
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
					}?>
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
					<form id="frm_Sale" action="<?php echo SITEURL; ?>?saleinvoice" method="POST" >
						<input type="hidden" name="ID" id="ID" value="<?php echo $resdata["ID"];?>">
						<input type="hidden" name="SRNO" id="SRNO" value="<?php echo getFieldDetail(LEDGER_DEBIT,"SRNO"," WHERE VOUCHERNO='".$resdata["ID"]."' AND VOUCHERTYPE='Sale Invoice'");?>">
						<input type="hidden" name="BROKERSRNO" id="BROKERSRNO" value="<?php echo getFieldDetail(LEDGER_DEBIT,"SRNO"," WHERE VOUCHERNO='".$resdata["ID"]."' AND VOUCHERTYPE='Sale Invoice' ");?>">
						
						<div class="row form-group">
							<div class="col-lg-2">
									<label>Date</label>
									<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php //echo isset($resdata["VOUCHERDATE"]) ? $resdata["VOUCHERDATE"] : date('Y-m-d');?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>Due Days</label>
									<input type="text" class="form-control onlyNumber" name="txtDUEDAYS" id="txtDUEDAYS" value="<?php //echo $resdata["DUEDAYS"] == '' ? 0 :  $resdata["DUEDAYS"];?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
									<label>Due Date</label>
									<input type="date" class="form-control" readonly name="dtpDUEDATE" id="dtpDUEDATE" value="<?php //echo $resdata["DUEDATE"];?>">
									<p class="help-block"></p>
							</div>
							</div>
							<div class="row form-group">
								<div class="col-lg-2">
										<label>Party</label>
										 <select class="form-control" name="txtLEDGERID" id="txtLEDGERID">
												<option value="">Select Party</option>
												<?php
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID='26' ORDER BY LEDGERNAME");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														?>
														<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==$resdata["LEDGERID"] ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
														<?php
													}
												?>
											</select>
											<input type="hidden"  class="form-control" readonly name="STATE" id="STATE" value="">
										<a href="javascript:void(0)" class="addcls LEDGER_auto" rel="26" ><i class="fa fa-plus-circle"></i> Add New</a>	
										<p class="help-block"></p>
								</div>
							
								<div class="col-lg-2">
									<label>Broker</label>
									 <select class="form-control" name="txtBROKERID" id="txtBROKERID">
											<option value="">Select Broker</option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID='29' order by LEDGERNAME");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==$resdata["BROKERID"] ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
													<?php
												}
											?>
										</select>
									<a href="javascript:void(0)" class="addcls LEDGER_auto" rel="29" ><i class="fa fa-plus-circle"></i> Add New</a>
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
													<option value="<?php echo $res_LOC_data["LOCATIONNAME"];?>" <?php echo $res_LOC_data["LOCATIONNAME"]==$resdata["LOCATIONNAME"] ? 'selected="selected"':'';?>><?php echo $res_LOC_data["LOCATIONNAME"];?></option>
													<?php
												}
											?>
										</select>
									<p class="help-block"></p>
							</div>
							
							</div>
							
							
							
					
						
						<br>
						<div class="row form-group">
							<div class="col-lg-2">
								<label>Weight</label>									
								<input type="text"  class="form-control"  name="txtTOTALWEIGHT" id="txtTOTALWEIGHT"  value="<?php //echo $resdata["TOTALWEIGHT"];?>">
								<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Rs/Crt</label>									
								<input type="text"  style="text-align:right;" class="form-control onlyNumber" name="txtTOTALRSRSPERCRT" id="txtTOTALRSRSPERCRT"   value="<?php echo $resdata["TOTALRSRSPERCRT"];?>">
								<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Rs Amt</label>                            
								<input type="text" style="text-align:right;" class="form-control onlyNumber " name="txtTOTALRSAMOUNT" id="txtTOTALRSAMOUNT" value="<?php //echo $resdata["TOTALRSAMOUNT"];?>">
								
								<p class="help-block"></p>
							</div>
                        </div>
						
						
						
							<div class="row form-group">
							<div class="col-lg-3">
								<div class="checkbox-inline">
											<label>Bill Status</label><br/>
											<label>
												<input class="checkbox-inline " type="radio" id="radwithbillstatussaleinvoice" name="radBILLSTATUS" value="With Bill" <?php //echo $resdata["BILLSTATUS"] == 'With Bill'  ? "checked" : "";?>/> With Bill
												<input class="checkbox-inline " type="radio" id="radwithoutbillstatussaleinvoice" name="radBILLSTATUS" value="Without Bill" <?php //echo $resdata["BILLSTATUS"] == 'Without Bill' || $resdata["BILLSTATUS"] == '' ? "checked" : "";?>/> Without Bill
											</label>
											</div>
											
								
				
							</div>
						
								
						
						</div>
						
							<div class="row form-group GSTSALEINVOICE" style="<?php //echo $resdata["BILLSTATUS"] == 'With Bill' ? '' : "display:none;";?>">
							
								<div class="col-lg-12">
											
												<div class="col-lg-1"><label></label></div>
												<div class="col-lg-1"><label>Per</label></div>
												<div class="col-lg-2"><label>Amount</label></div>
											
								</div>
								<div class="col-lg-12">
											
												<div class="col-lg-1"><label>GST</label></div>
												<div class="col-lg-1"><input class="form-control GSTCALSALEINVOICE" name="txtIGSTPER" id="txtIGSTPER" value="<?php //echo $resdata["IGSTPER"];?>"></div>
												<div class="col-lg-2"><label><input style="text-align:right;" class="form-control" name="txtIGSTAMT" id="txtIGSTAMT" value="<?php echo $resdata["IGSTAMT"];?>">	</label></div>
											
								</div>
								<div class="col-lg-12"  style="display:none;">
											
												<div class="col-lg-1"><label>SGST</label></div>
												<div class="col-lg-1"><input  class="form-control GSTCALSALEINVOICE" name="txtSGSTPER" id="txtSGSTPER" value="<?php //echo $resdata["SGSTPER"];?>"></div>
												<div class="col-lg-2"><label><input style="text-align:right;" class="form-control" name="txtSGSTAMT" id="txtSGSTAMT" value="<?php //echo $resdata["SGSTAMT"];?>">	</label></div>
											
								</div>
								<div class="col-lg-12"  style="display:none;">
											
												<div class="col-lg-1"><label>CGST</label></div>
												<div class="col-lg-1"><input  class="form-control GSTCALSALEINVOICE" name="txtCGSTPER" id="txtCGSTPER" value="<?php //echo $resdata["CGSTPER"];?>"></div>
												<div class="col-lg-2"><label><input  style="text-align:right;" class="form-control" name="txtCGSTAMT" id="txtCGSTAMT" value="<?php //echo $resdata["CGSTAMT"];?>">	</label></div>
											
								</div>
						
							
									
						</div>
						<div class="row form-group">
					
							<div class="col-lg-2" >
								<label>Grand Amount</label>
								<input type="text" style="text-align:right;" class="form-control onlyNumber" readonly name="txtGRANDAMOUNT" id="txtGRANDAMOUNT" value="<?php echo $resdata["GRANDAMOUNT"];?>">
                                <p class="help-block"></p>
							</div>
							<div class="col-lg-2" style="display:none;">
								<label>Last Amount</label>
								<input style="text-align:right;" type="text"  class="form-control onlyNumber" readonly name="txtLASTAMOUNT" id="txtLASTAMOUNT" value="<?php echo $resdata["LASTAMOUNT"];?>">
								<p class="help-block"></p>
							</div>							
							
									
						</div>
							
									
									
									<input type="hidden"  class="form-control" readonly name="companystate" id="companystate" value="<?php echo $rescompanydata["STATE"];?>">
                             
					
						
						<div class="form-group">
                            <label>Remark</label>
                            <input class="form-control" name="txtREMARK" id="txtREMARK" value="<?php echo $resdata["REMARK"];?>">
                                <p class="help-block"></p>
                        </div>
					
							
							
						
						<button type="submit" class="btn btn-default" style="float: right;margin-left: 10px;" name="saleinvoice" id="btnSaleInvoice">Submit Button</button>
						<img id="lodimg" src="<?php echo SITEURL.INIT."images/loading.gif";?>" style="float: right;display:none;"/>
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

	
