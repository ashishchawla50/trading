<?php
	$DebitCreditArr = Array();
	array_push($DebitCreditArr,"DR.SRNO");
	
	array_push($DebitCreditArr,"DR.VOUCHERTYPE");
	array_push($DebitCreditArr,"DR.LEDGERID AS DRLEDGERID");
	array_push($DebitCreditArr,"CR.LEDGERID AS CRLEDGERID");
	array_push($DebitCreditArr,"DR.AMOUNT AS DRAMOUNT");
	array_push($DebitCreditArr,"CR.AMOUNT AS CRAMOUNT");
	//array_push($DebitCreditArr,"CR.AMOUNTDOLLAR AS AMOUNTDOLLAR"); 
	array_push($DebitCreditArr,"CR.RMBRATE AS RMBRATE"); 
	
	array_push($DebitCreditArr,"DR.DESCRIPTION");
	array_push($DebitCreditArr,"DR.VOUCHERDATE");
	array_push($DebitCreditArr,"DR.CONVRATE");
	array_push($DebitCreditArr,"DR.AMOUNTDOLLAR");	
    array_push($DebitCreditArr,"DR.RMBAMOUNT");	
	array_push($DebitCreditArr,"DR.COMMPER");	
	array_push($DebitCreditArr,"DR.COMMAMT" );	
	//$res_dr = getData(LEDGER_DEBIT,$DebitCreditArr,"  AS DR INNER JOIN ".LEDGER_CREDIT." AS CR ON CR.SRNO=DR.SRNO AND CR.VOUCHERTYPE=DR.VOUCHERTYPE   WHERE CR.VOUCHERTYPE='Journal Payment' AND DR.VOUCHERTYPE='Journal Payment' ORDER BY DR.VOUCHERDATE DESC,DR.SRNO ASC");
	$res_dr = getData(LEDGER_DEBIT,$DebitCreditArr,"  AS DR INNER JOIN ".LEDGER_CREDIT." AS CR ON CR.SRNO=DR.SRNO AND CR.VOUCHERTYPE=DR.VOUCHERTYPE   WHERE CR.VOUCHERTYPE='Journal Payment' AND DR.VOUCHERTYPE='Journal Payment' ORDER BY DR.SRNO DESC");
//$resdata = mysqli_fetch_assoc($res_dr);

if(isset($_GET["_mid"]))
{
	$action ="modify";
	$ID = $_GET["_mid"];
	
	$Caption = "Edit JournalReceipt Detail";
	$res_dredit = getData(LEDGER_DEBIT,$AllArr," WHERE SRNO='".$ID."' AND VOUCHERTYPE='Journal Payment'");
	$resdataedit = mysqli_fetch_assoc($res_dredit);	
	$res_cr = getData(LEDGER_CREDIT,$AllArr," WHERE SRNO='".$ID."' AND VOUCHERTYPE='Journal Payment'");
	$rescrdata = mysqli_fetch_assoc($res_cr);	

}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$ID = $_GET["_rid"];
	$deletecommsrno = getFieldDetail(LEDGER_DEBIT,"COMMISIONSRNO"," WHERE SRNO ='".$ID."' AND VOUCHERTYPE='Journal Payment'");
	
	deleteData(LEDGER_DEBIT," WHERE SRNO ='".$ID."' AND VOUCHERTYPE='Journal Payment'");
	deleteData(LEDGER_DEBIT," WHERE SRNO ='".$deletecommsrno."' AND VOUCHERTYPE='Journal Payment' ");
	deleteData(LEDGER_CREDIT," WHERE SRNO ='".$ID."' AND VOUCHERTYPE='Journal Payment'");
	deleteData(LEDGER_CREDIT," WHERE SRNO ='".$deletecommsrno."' AND VOUCHERTYPE='Journal Payment' ");
	
	
	?>
	<script>
		window.location.href='<?php echo SITEURL; ?>?tran-journalpayment-v';
	</script>
	<?php
}
else
{
	$action = "";
}
if(isset($_POST["tran-journalpayment"]))
{
			$SRNO = $_POST["SRNO"];
			$COMMISIONSRNO = $_POST["COMMISIONSRNO"];
			$tranFieldArr= array();
			$tranValueArr= array();
			$VOUCHERNO = $_POST["VOUCHERNO"];
			$AMOUNT =isset($_POST["txtCRAMOUNT"]) ? $_POST["txtCRAMOUNT"] : 0;
			$AMOUNT_usd =isset($_POST["txtAMOUNTDOLLAR"]) ? $_POST["txtAMOUNTDOLLAR"] : 0;
			$AMOUNT_rmb =isset($_POST["txtRMBAMOUNT"]) ? $_POST["txtRMBAMOUNT"] : 0;
			$conv_usd =isset($_POST["txtCONVRATE"]) ? $_POST["txtCONVRATE"] : 0;
			$conv_rmb =isset($_POST["txtRMBRATE"]) ? $_POST["txtRMBRATE"] : 0;	
			$RMBDOLSTATUS = isset($_POST["chkRMBSTATUS"]) ?"1":"0";
			
			array_push($tranFieldArr,"VOUCHERNO");
			array_push($tranValueArr,"'".$VOUCHERNO."'");
			array_push($tranFieldArr,"VOUCHERTYPE");
			array_push($tranValueArr,"'Journal Payment'");
			array_push($tranFieldArr,"LEDGERID");
			array_push($tranValueArr,"'".$_POST["txtLEDGERID"]."'");
			array_push($tranFieldArr,"GROUPID");
			array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$_POST["txtLEDGERID"]."'")."'");

			array_push($tranFieldArr,"AMOUNT");
			array_push($tranValueArr,"'".$AMOUNT."'");
			array_push($tranFieldArr,"DESCRIPTION");
			array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
			array_push($tranFieldArr,"VOUCHERDATE");
			array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
			array_push($tranFieldArr,"UPDATEDATE");
			array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
			array_push($tranFieldArr,"USERNAME");
			array_push($tranValueArr,"'".$loginuser_name."'");
			array_push($tranFieldArr,"CONVRATE");
			array_push($tranValueArr,"'".$conv_usd."'");
			array_push($tranFieldArr,"AMOUNTDOLLAR");
			array_push($tranValueArr,"'".$AMOUNT_usd."'");
			array_push($tranFieldArr,"IDTYPE");
			array_push($tranValueArr,"''");
			array_push($tranFieldArr,"RMBRATE");
			array_push($tranValueArr,"'".$conv_rmb."'");
			array_push($tranFieldArr,"RMBAMOUNT");
			array_push($tranValueArr,"'".$AMOUNT_rmb."'");
			array_push($tranFieldArr,"COMMPER");
			array_push($tranValueArr,"'".$_POST["txtCOMMISSIONPER"]."'");
			array_push($tranFieldArr,"COMMAMT");
			array_push($tranValueArr,"'".$_POST["txtCOMMISSIONAMT"]."'");
			array_push($tranFieldArr,"ENTRYDATE");
			array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
			array_push($tranFieldArr,"COMMISIONSRNO");
			array_push($tranValueArr,"'".$COMMISIONSRNO."'");
			
			editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT," WHERE SRNO='". $SRNO."' AND VOUCHERTYPE='Journal Payment'");
			
			$tranValueArr[2] = $_POST["txtBOOKLEDGERID"];
			$tranValueArr[3] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$_POST["txtBOOKLEDGERID"]."'");
			editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT," WHERE SRNO='". $SRNO."' AND VOUCHERTYPE='Journal Payment'");




			
			$tranFieldArr_COMM= array();
			$tranValueArr_COMM= array();
			
			array_push($tranFieldArr_COMM,"LEDGERID");
			array_push($tranValueArr_COMM,"'".$_POST["txtBOOKLEDGERID"]."'");
			array_push($tranFieldArr_COMM,"GROUPID");
			array_push($tranValueArr_COMM,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$_POST["txtBOOKLEDGERID"]."'")."'");

			array_push($tranFieldArr_COMM,"VOUCHERNO");
			array_push($tranValueArr_COMM,"'".$VOUCHERNO."'");
			array_push($tranFieldArr_COMM,"VOUCHERTYPE");
			array_push($tranValueArr_COMM,"'Journal Payment'");
			array_push($tranFieldArr_COMM,"ENTRYDATE");
			array_push($tranValueArr_COMM,"'".date('Y-m-d h:i:s')."'");
			
			array_push($tranFieldArr_COMM,"VOUCHERDATE");
			array_push($tranValueArr_COMM,"'".$_POST["dtpVOUCHERDATE"]."'");
			array_push($tranFieldArr_COMM,"UPDATEDATE");
			array_push($tranValueArr_COMM,"'".date('Y-m-d h:i:s')."'");
			array_push($tranFieldArr_COMM,"USERNAME");
			array_push($tranValueArr_COMM,"'".$loginuser_name."'");
			
			
			array_push($tranFieldArr_COMM,"AMOUNT");
			array_push($tranValueArr_COMM,"'".$_POST["txtCOMMISSIONAMT"]."'");
			array_push($tranFieldArr_COMM,"DESCRIPTION");
			array_push($tranValueArr_COMM,"'".$_POST["txtREMARK"]."'");
			array_push($tranFieldArr_COMM,"COMMPER");
			array_push($tranValueArr_COMM,"'".$_POST["txtCOMMISSIONPER"]."'");
			array_push($tranFieldArr_COMM,"COMMAMT");
			array_push($tranValueArr_COMM,"'".$_POST["txtCOMMISSIONAMT"]."'");
			
		$RECCENT = getFieldDetail(LEDGER_DEBIT,"COUNT(*)"," WHERE SRNO='".$COMMISIONSRNO."' and VOUCHERTYPE='Journal Payment' and LEDGERID='".COMM."'");
		if(($COMMISIONSRNO == '' || $COMMISIONSRNO == 0) && $RECCENT == 0)
			{
			
					$COMMISIONSRNO = getMaxValue_TRAN(LEDGER_CREDIT,"SRNO");
					array_push($tranFieldArr_COMM,"SRNO");
					array_push($tranValueArr_COMM,"'".$COMMISIONSRNO."'");
					
					newData($tranFieldArr_COMM,$tranValueArr_COMM,LEDGER_CREDIT);
			
					$tranValueArr_COMM[0] = COMM;
					$tranValueArr_COMM[1] = COMMGBP;
					
					newData($tranFieldArr_COMM,$tranValueArr_COMM,LEDGER_DEBIT);
					
					
					$tranFieldArr_main= array();
					$tranValueArr_main= array();
					array_push($tranFieldArr_main,"COMMISIONSRNO");
					array_push($tranValueArr_main,"".$COMMISIONSRNO."");
					
					
					editData($tranFieldArr_main,$tranValueArr_main,LEDGER_CREDIT," WHERE SRNO='". $SRNO."'");
					editData($tranFieldArr_main,$tranValueArr_main,LEDGER_DEBIT," WHERE SRNO='". $SRNO."'");
					//exit();
			}
			else
			{
				
				editData($tranFieldArr_COMM,$tranValueArr_COMM,LEDGER_CREDIT," WHERE SRNO='".$COMMISIONSRNO."'");
			
				$tranValueArr_COMM[0] = COMM;
				$tranValueArr_COMM[1] = COMMGBP;
				
				editData($tranFieldArr_COMM,$tranValueArr_COMM,LEDGER_DEBIT," WHERE SRNO='".$COMMISIONSRNO."'");
			}
			
	?>
	
	<script>
		window.location.href='<?php echo SITEURL; ?>?tran-journalpayment-v';
	</script>
		<?php
		exit();
	$action = "";	

}

?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Journal - Payment - Voucher - View</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action == "")
{
	?>
<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?tran-journalpayment-v" method="POST" onsubmit="return confirm('Do you really want to Delete?');">
					
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<td colspan="5"></td>
									<td colspan="4" style="text-align:center;font-size:1.2em;"><label>Debit</label></td>
									<td colspan="4" style="text-align:center;font-size:1.2em;"><label>Credit</label></td>
									<td colspan="1"></td>
									
								</tr>
								<tr>
									<th class="delcls">Action</th>
									<th>Sr No</th>	
									<th>V No</th>
									<th>V Dt</th>
									<th>V Type</th>
									
									
									<th>Name</th>
									<th>$</th>									
									<th>RMB</th>
									<th>Amount</th>
									
									<th>Name</th>
									<th>$</th>									
									<th>RMB</th>
									<th>Amount</th>
									
									<th>Remark</th>
								</tr>
								
							 </thead>
							 <tbody>
							 <?php
								$SRNO_CNT = 1;
								
								//exit();
								//$resdata = mysqli_fetch_assoc($res_dr);
								while($resdata = mysqli_fetch_assoc($res_dr))
										//print_r($resdata);
									//exit();
										{
											$classname = ($SRNO_CNT / 2) == 0 ? 'odd gradeX' :'even gradeC';
											
											?>
												<tr class="<?php echo $classname;?>">
												<td class="delcls">
													<?php 
													
													if($edit_bol)
													{
													?>
													<a href="<?php echo SITEURL; ?>?journalpayment-view&_mid=<?php echo $resdata["SRNO"];?>" class="btn btn-primary btn-circle" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
														<?php
													
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?journalpayment-view&_rid=<?php echo $resdata["SRNO"];?>" onclick="return confirm('Do you really want to Delete This Transaction : <?php echo $resdata["SRNO"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
															
													<?php
													}
													}
													?>
													
												</td>
												<td><?php echo $SRNO_CNT++;?></td>
													<td><?php echo $resdata["SRNO"];?></td>
													<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
													<td><?php echo $resdata["VOUCHERTYPE"];?></td>
													<td><?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID='".$resdata["DRLEDGERID"]."'");?></td>
													
													<td style="text-align:right;"><?php echo  getCurrFormat($resdata["AMOUNTDOLLAR"]);?></td>
													<td style="text-align:right;"><?php echo  getCurrFormat($resdata["RMBAMOUNT"]);?></td>
													<td style="text-align:right;"><?php echo  getCurrFormat($resdata["DRAMOUNT"]);?></td>
													
													
													<td><?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID='".$resdata["CRLEDGERID"]."'");?></td>
													
													<td style="text-align:right;"><?php echo  getCurrFormat($resdata["AMOUNTDOLLAR"]);?></td>
												<td style="text-align:right;"><?php echo  getCurrFormat($resdata["RMBAMOUNT"]);?></td>
												<td style="text-align:right;"><?php echo  getCurrFormat($resdata["CRAMOUNT"]);?></td>
													<td style="text-align:left;"><?php echo $resdata["DESCRIPTION"];?></td>									
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
elseif($action == "modify")
{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    Journal - Voucher - New
                </div>
				<div class="panel-body">
					<p>
						<a  class="btn btn-warning" href="<?php echo SITEURL; ?>?journalpayment-view" style="float:right;" ><i class="fa fa-tasks"></i> View All</a>
						<br>
					</p>
					<form id="frm_journaltable_edit" action="<?php echo SITEURL; ?>?tran-journalpayment-v" method="POST" >
						<input type="hidden" value="<?php echo $resdataedit["SRNO"]?>" name="SRNO">
						<input type="hidden" value="<?php echo $resdataedit["VOUCHERNO"]?>" name="VOUCHERNO">
						<input type="hidden" value="<?php echo $resdataedit["COMMISIONSRNO"]?>" name="COMMISIONSRNO">
						<input type="hidden" value="<?php echo $resdataedit["VOUCHERTYPE"]?>" name="VOUCHERTYPE">
						
						<div class="form-group">
							<table width="15%" class="inputfieldtable">
								<tr>
									<td width="15%"><label>Date</label></td>
								</tr>
								<tr>
									<td>
										<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php echo $resdataedit["VOUCHERDATE"];?>" >
									</td>
								
								</tr>
								
							</table>
							
						</div>
						<div class="form-group">
							<table width="60%" class="inputfieldtable">
								<tr>
									<td><label>Book Name</label> <a href="javascript:void(0)" class="addcls LEDGER_auto" rel="1" ><i class="fa fa-plus-circle"></i> Add New</a></td>
									
									<td><label>Party Name</label></td>
									<td><label>Money</label></td>
									
								</tr>
								<tr>
									<td>
										<select class="form-control" name="txtBOOKLEDGERID" id="txtBOOKLEDGERID">
											<option value=""> Select Cash A/c </option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0'");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $rescrdata["LEDGERID"] == $res_led_data["LEDGERID"] ? 'selected="selected"' : '' ?>><?php echo $res_led_data["LEDGERNAME"];?></option>
													
													
													<?php
												}
											?>
										</select><br>Bal.<span id="txtBOOKLEDGERIDBALANCE">(0.00)</span>
										<input type="hidden" id="BOOKLEDGERIDBALANCE" name="BOOKLEDGERIDBALANCE" val="0.00"/>
									</td>
									
									<td>
										 <select class="form-control" name="txtLEDGERID" id="txtLEDGERID">
											<option value="">Select Party</option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0'");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													
													<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $resdataedit["LEDGERID"] == $res_led_data["LEDGERID"] ? 'selected="selected"' : '' ?>><?php echo $res_led_data["LEDGERNAME"];?></option>
													
													<?php
												}
											?>
										</select><br>Bal.<span id="txtLEDGERIDBALANCE">(0.00)</span>
										<input type="hidden" id="LEDGERIDBALANCE" name="LEDGERIDBALANCE" val="0.00"/>
									</td>
									<td>
									<select class="form-control" name="MONEYCOL" id="MONEYCOL">
												<option value="₹" <?php echo isset($_POST["MONEYCOL"]) && $_POST["MONEYCOL"] == '₹' ? 'selected="selected"' : ''?>>₹</option>
												<option value="$" <?php echo isset($_POST["MONEYCOL"]) && $_POST["MONEYCOL"] == '$' ? 'selected="selected"' : ''?>>$</option>
												<option value="RMB" <?php echo isset($_POST["MONEYCOL"]) && $_POST["MONEYCOL"] == 'RMB' ? 'selected="selected"' : ''?>>RMB</option>
												<option value="$-₹" <?php echo isset($_POST["MONEYCOL"]) && $_POST["MONEYCOL"] == '$-₹' ? 'selected="selected"' : ''?>>$-₹</option>
												<option value="RMB-₹" <?php echo isset($_POST["MONEYCOL"]) && $_POST["MONEYCOL"] == 'RMB-₹' ? 'selected="selected"' : ''?>>RMB-₹</option>
												<option value="$-RMB-₹" <?php echo isset($_POST["MONEYCOL"]) && $_POST["MONEYCOL"] == '$-RMB-₹' ? 'selected="selected"' : ''?>>$-RMB-₹</option>
												
									</select>
									</td>
									
								</tr>	
								
							</table>
							
						</div>
						
						<div class="form-group">
							<table  class="inputfieldtable">
								<tr>
									
									<!--<td class="TRAN_USD" width="15%"><label>$ Amount</label></td>
									<td class="TRAN_USD_CONV" width="15%"><label>$ Rate</label></td>
									<td class="TRAN_RMB" width="15%"><label>RMB Amount</label></td>
									<td class="TRAN_RMB_CONV" width="15%"><label>RMB Rate</label></td>
									-->
									<td class="TRAN_INR" width="15%"><label>Rs Amount</label></td>
									
									<td class="" width="10%"><label>Commision %</td>
									<td class="" width="15%"><label>Commision Amt</td>
									
								</tr>
								
								<tr>
									<!--<td class="TRAN_USD">
										<input type="text" class="form-control onlyNumber amtchange" name="txtAMOUNTDOLLAR" id="txtCRAMOUNTDOLLAR" value="<?php echo $resdataedit["AMOUNTDOLLAR"];?>">
									</td>
									<td class="TRAN_USD_CONV">
										<input type="text" class="form-control onlyNumber amtchange" name="txtCONVRATE" id="txtCONVRATE" value="<?php echo $resdataedit["CONVRATE"];?>">
									</td>
									<td class="TRAN_RMB">
										<input type="text" class="form-control onlyNumber amtchange" name="txtRMBAMOUNT" id="txtDRRMBAMOUNT" value="<?php echo $resdataedit["RMBAMOUNT"];?>">
									</td>
									<td class="TRAN_RMB_CONV">
										<input type="text" class="form-control onlyNumber amtchange" name="txtRMBRATE" id="txtRMBRATE" value="<?php echo $resdataedit["RMBRATE"];?>">
									</td>-->
									<td class="TRAN_INR">
										<input type="text" class="form-control onlyNumber  CRDRAMOUNT" name="txtCRAMOUNT" id="txtCRAMOUNT" value="<?php echo $resdataedit["AMOUNT"];?>">
									</td>
									<td class="">
									<input type="text" class="form-control onlyNumber " name="txtCOMMISSIONPER" id="txtCOMMISSIONPER" value="<?php echo $resdataedit["COMMPER"];?>" >
									</td>
									
									<td class="">
									<input type="text" class="form-control onlyNumber " name="txtCOMMISSIONAMT" id="txtCOMMISSIONAMT" value="<?php echo $resdataedit["COMMAMT"];?>">
									</td>
								</tr>
								
							</table>							
						</div>
						
						
						
						
						
						
						<div class="form-group">
							<label>Remark</label>
							<input type="text" class="form-control" name="txtREMARK" id="txtREMARK" value="<?php echo $resdataedit["DESCRIPTION"]?>">
						</div>
						<button type="submit" class="btn btn-default" style="float: right;" name="tran-journalpayment">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	<?php
}
?>
