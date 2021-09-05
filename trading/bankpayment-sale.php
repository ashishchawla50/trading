<?php
if(isset($_POST["tran-bankpayment-sale"]))
{
	
	
	//========================bank payment entry=====================================================
		$tranFieldArr= array();
		$tranValueArr= array();
		array_push($tranFieldArr,"SRNO");
		array_push($tranFieldArr,"VOUCHERNO");
		array_push($tranFieldArr,"VOUCHERTYPE");
		array_push($tranFieldArr,"LEDGERID");
		array_push($tranFieldArr,"GROUPID");
		array_push($tranFieldArr,"AMOUNT");
		array_push($tranFieldArr,"DESCRIPTION");
		array_push($tranFieldArr,"VOUCHERDATE");
		array_push($tranFieldArr,"UPDATEDATE");
		array_push($tranFieldArr,"USERNAME");
		array_push($tranFieldArr,"CONVRATE");
		array_push($tranFieldArr,"AMOUNTDOLLAR");
		array_push($tranFieldArr,"IDTYPE");
		array_push($tranFieldArr,"RMBRATE");
		array_push($tranFieldArr,"RMBAMOUNT");
		
		$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
		$VOUCHERNO = "";
		
		
		$VOUCHERTYPE = "";
		$CRLEDGERID = $_POST["txtBOOKLEDGERID"];
		$DRLEDGERID = $_POST["txtLEDGERID"];

		$AMOUNT =isset($_POST["txtCRAMOUNT"]) ? $_POST["txtCRAMOUNT"] : 0;

		$AMOUNT_usd =isset($_POST["txtAMOUNTDOLLAR"]) ? $_POST["txtAMOUNTDOLLAR"] : 0;
		$AMOUNT_rmb =isset($_POST["txtRMBAMOUNT"]) ? $_POST["txtRMBAMOUNT"] : 0;
		
		$conv_usd =isset($_POST["txtCONVRATE"]) ? $_POST["txtCONVRATE"] : 0;
		$conv_rmb =isset($_POST["txtRMBRATE"]) ? $_POST["txtRMBRATE"] : 0;
		
			
		$RMBDOLSTATUS = isset($_POST["chkRMBSTATUS"]) ?"1":"0";
		array_push($tranValueArr,"'".$SRNO."'");
		array_push($tranValueArr,"'".$VOUCHERNO."'");
		array_push($tranValueArr,"'Bank Payment'");
		array_push($tranValueArr,"'".$DRLEDGERID."'");
		array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$DRLEDGERID."'")."'");
		array_push($tranValueArr,"'".$AMOUNT."'");
		array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
		array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranValueArr,"'".$loginuser_name."'");
		array_push($tranValueArr,"'".$conv_usd."'");
		array_push($tranValueArr,"'".$AMOUNT_usd."'");
		array_push($tranValueArr,"'".$VOUCHERTYPE."'");
		array_push($tranValueArr,"'".$conv_rmb."'");
		array_push($tranValueArr,"'".$AMOUNT_rmb."'");
		
		array_push($tranFieldArr,"ENTRYDATE");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranFieldArr,"DOLLARSALE");
		array_push($tranValueArr,"1");
	
		newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
		$tranValueArr[3] = $CRLEDGERID;
		$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'");
		newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
	
	
	
	//========================bank payment entry=====================================================
	
	
	
	
		
		
	//===============================BANK RECEIPT ENTRY AUTO======================================================================
		$tranFieldArr= array();
		$tranValueArr= array();
		array_push($tranFieldArr,"SRNO");
		array_push($tranFieldArr,"VOUCHERNO");
		array_push($tranFieldArr,"VOUCHERTYPE");
		array_push($tranFieldArr,"LEDGERID");
		array_push($tranFieldArr,"GROUPID");
		array_push($tranFieldArr,"AMOUNT");
		array_push($tranFieldArr,"DESCRIPTION");
		array_push($tranFieldArr,"VOUCHERDATE");
		array_push($tranFieldArr,"UPDATEDATE");
		array_push($tranFieldArr,"USERNAME");
		array_push($tranFieldArr,"CONVRATE");
		array_push($tranFieldArr,"AMOUNTDOLLAR");
		array_push($tranFieldArr,"IDTYPE");
		array_push($tranFieldArr,"RMBRATE");
		array_push($tranFieldArr,"RMBAMOUNT");
		array_push($tranFieldArr,"DOLLARSALE");
		
		
		
		$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
		$VOUCHERNO = "";
		$VOUCHERTYPE = "Sale";
		$DRLEDGERID = $_POST["txtBANKBOOKLEDGERID"];
		$CRLEDGERID = $_POST["txtLEDGERID"];

		$AMOUNT =isset($_POST["txtCRAMOUNT"]) ? $_POST["txtCRAMOUNT"] : 0;

		$AMOUNT_usd =isset($_POST["txtAMOUNTDOLLAR"]) ? $_POST["txtAMOUNTDOLLAR"] : 0;
		$AMOUNT_rmb =isset($_POST["txtRMBAMOUNT"]) ? $_POST["txtRMBAMOUNT"] : 0;
		
		$conv_usd =isset($_POST["txtCONVRATE"]) ? $_POST["txtCONVRATE"] : 0;
		$conv_rmb =isset($_POST["txtRMBRATE"]) ? $_POST["txtRMBRATE"] : 0;
		
			
		
		array_push($tranValueArr,"'".$SRNO."'");
		array_push($tranValueArr,"'".$VOUCHERNO."'");
		array_push($tranValueArr,"'Bank Receipt'");
		array_push($tranValueArr,"'".$DRLEDGERID."'");
		array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$DRLEDGERID."'")."'");
		array_push($tranValueArr,"'".$AMOUNT."'");
		array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
		array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranValueArr,"'".$loginuser_name."'");
		array_push($tranValueArr,"'".$conv_usd."'");
		array_push($tranValueArr,"'".$AMOUNT_usd."'");
		array_push($tranValueArr,"'".$VOUCHERTYPE."'");
		array_push($tranValueArr,"'".$conv_rmb."'");
		array_push($tranValueArr,"'".$AMOUNT_rmb."'");
		array_push($tranValueArr,"1");
		
		
		array_push($tranFieldArr,"ENTRYDATE");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
	
		newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
		$tranValueArr[3] = $CRLEDGERID;
		$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'");
		newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
		
	//===============================CASH RECEIPT ENTRY AUTO=====================================================================
		//exit();
		?>
		<script>
			alert("Added Sucessfully");
		window.location.href="<?php echo SITEURL."?tran-bankpayment-sale";?>";
		</script>
		<?php
		exit();
}
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Bank - Payment - Sale - Voucher</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    Bank - Payment - Sale - Voucher - New
                </div>
				<div class="panel-body">
					<?php
					if ($view_bol)
					{
					?>
					<p>
						<a  class="btn btn-warning" href="<?php echo SITEURL; ?>?bankpayment-sale-view" style="float:right;" ><i class="fa fa-tasks"></i> View All</a>
						<br>
					</p>
					<?php
					}
					?>
					<form id="tran-bankpayment-sale" action="<?php echo SITEURL; ?>?tran-bankpayment-sale" method="POST">
						
						<div class="form-group">
							<table width="15%" class="inputfieldtable">
								<tr>
									<td width="15%"><label>Date</label></td>
									
								</tr>
								<tr>
									<td>
										<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php echo date('Y-m-d');?>" >
									</td>
									
								</tr>								
							</table>
							
						</div>	
<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Book Name</label> <a href="javascript:void(0)" class="addcls LEDGER_auto" rel="1" ><i class="fa fa-plus-circle"></i> Add New</a></td>
									
									<td><label>Party Name</label></td>
									<td><label>Book Name</label></td>
									<td><label>Money</label></td>
									
								</tr>
								<tr>
									<td>
										<select class="form-control" name="txtBOOKLEDGERID" id="txtBOOKLEDGERID">
											<option value=""> Select Bank A/c </option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID in (1,2)");
											
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>"><?php echo $res_led_data["LEDGERNAME"];?></option>
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
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID != '5'");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>"><?php echo $res_led_data["LEDGERNAME"];?></option>
													<?php
												}
											?>
										</select><br>Bal.<span id="txtLEDGERIDBALANCE">(0.00)</span>
										<input type="hidden" id="LEDGERIDBALANCE" name="LEDGERIDBALANCE" val="0.00"/>
									</td>
									
									<td>
										 <select class="form-control" name="txtBANKBOOKLEDGERID" id="txtBANKBOOKLEDGERID">
											<option value=""> Select Bank A/c </option>
											<?php
											
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID in (1,2)");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>"><?php echo $res_led_data["LEDGERNAME"];?></option>
													<?php
												}
											?>
										</select><br>Bal.<span id="txtLEDGERIDBALANCE">(0.00)</span>
										<input type="hidden" id="LEDGERIDBALANCE" name="LEDGERIDBALANCE" val="0.00"/>
									</td>
									<td>
									<select class="form-control" name="MONEYCOL" id="MONEYCOL">
												
											<option value="$-RMB" <?php echo isset($_POST["MONEYCOL"]) && $_POST["MONEYCOL"] == '$-RMB' ? 'selected="selected"' : ''?>>$-RMB</option>
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
									
									<td class="TRAN_USD" width="20%"><label>$ Amount</label></td>
									<td class="TRAN_USD_CONV " width="20%"><label>$ Rate</label></td>
									<td class="TRAN_RMB " width="20%"><label>RMB Amount</label></td>
									<td class="TRAN_RMB_CONV " width="20%"><label>RMB Rate</label></td>
									<td class="TRAN_INR " width="20%"><label>Rs Amount</label></td>
									
								</tr>
								
								<tr>
									<td class="TRAN_USD">
										<input type="text" class="form-control onlyNumber amtchange" name="txtAMOUNTDOLLAR" id="txtCRAMOUNTDOLLAR" >
									</td>
									<td class="TRAN_USD_CONV ">
										<input type="text" class="form-control onlyNumber amtchange" name="txtCONVRATE" id="txtCONVRATE" >
									</td>
									<td class="TRAN_RMB ">
										<input type="text" class="form-control onlyNumber amtchange" name="txtRMBAMOUNT" id="txtCRRMBAMOUNT" >
									</td>
									<td class="TRAN_RMB_CONV ">
										<input type="text" class="form-control onlyNumber amtchange" name="txtRMBRATE" id="txtRMBRATE" >
									</td>
									<td class="TRAN_INR ">
										<input type="text" class="form-control onlyNumber  CRDRAMOUNT" name="txtCRAMOUNT" id="txtCRAMOUNT" >
									</td>
								</tr>								
							</table>							
						</div>
				
						
						<div class="form-group">
							<label>Remark</label>
							<input type="text" class="form-control" name="txtREMARK" id="txtREMARK" >
						</div>
						<input type="hidden" class="form-control" name="txtMaxVal" id="txtMaxVal" >
						<button type="submit" class="btn btn-default" style="float: right;" name="tran-bankpayment-sale">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>