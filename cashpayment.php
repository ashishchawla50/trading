<?php
if(isset($_POST["tran-cashpayment"]))
{
	$idarr = array();
	$idarr = isset($_POST["radID"]) ? $_POST["radID"] : array();
	
		
	if(count($idarr) == 1 )
	{
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
		array_push($tranFieldArr,"COMMPER");
		array_push($tranFieldArr,"COMMAMT");
		$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
		
		if(isset($idarr[0]) && !empty($idarr[0]))
		{
			$VOUCHERNO = $idarr[0];
		}
		else
		{
			$VOUCHERNO = getFieldDetail(PURCHASESALE,"ID"," WHERE LEDGERID='".$_POST["txtLEDGERID"]."' AND VOUCHERTYPE='Purchase'");
		}
		
		$VOUCHERTYPE = isset($_POST["txtVOUCHERTYPE".$VOUCHERNO]) ? $_POST["txtVOUCHERTYPE".$VOUCHERNO] : '';
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
		array_push($tranValueArr,"'Cash Payment'");
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
		array_push($tranValueArr,"'".$_POST["txtCOMMISSIONPER"]."'");
		array_push($tranValueArr,"'".$_POST["txtCOMMISSIONAMT"]."'");
			
			
			
		array_push($tranFieldArr,"ENTRYDATE");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
	
		newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
		$tranValueArr[3] = $CRLEDGERID;
		$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'");
		newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
	
	
		
	}
	elseif(count($idarr) > 1 )
	{
		$amt = $_POST["txtCRAMOUNT"];
		foreach($idarr as $id)
		{
			if($amt > 0 )
			{
				
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
				array_push($tranFieldArr,"COMMPER");
				array_push($tranFieldArr,"COMMAMT");
				
				
				
				$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
				$VOUCHERNO = $id;
				$IDTYPE = 'Purchase';
				$updateamt = $_POST["txtDUEAMOUNT".$id];
				$VOUCHERTYPE = isset($_POST["txtVOUCHERTYPE".$VOUCHERNO]) ? $_POST["txtVOUCHERTYPE".$VOUCHERNO] : '';
				$AMOUNT_usd =isset($_POST["txtAMOUNTDOLLAR"]) ? $_POST["txtAMOUNTDOLLAR"] : 0;
				$AMOUNT_rmb =isset($_POST["txtRMBAMOUNT"]) ? $_POST["txtRMBAMOUNT"] : 0;
				$conv_usd =isset($_POST["txtCONVRATE"]) ? $_POST["txtCONVRATE"] : 0;
				$conv_rmb =isset($_POST["txtRMBRATE"]) ? $_POST["txtRMBRATE"] : 0;
				$CRLEDGERID = $_POST["txtBOOKLEDGERID"];
				$DRLEDGERID = $_POST["txtLEDGERID"];
				if($amt >= $updateamt)
				{
					$AMOUNT =$updateamt;
				}
				else
				{
					
					$AMOUNT =$amt;
				}
					$RMBDOLSTATUS = isset($_POST["chkRMBSTATUS"]) ?"1":"0";
					array_push($tranValueArr,"'".$SRNO."'");
					array_push($tranValueArr,"'".$VOUCHERNO."'");
					array_push($tranValueArr,"'Cash Payment'");
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
					array_push($tranValueArr,"'".$_POST["txtCOMMISSIONPER"]."'");
					array_push($tranValueArr,"'".$_POST["txtCOMMISSIONAMT"]."'");
					
					array_push($tranFieldArr,"ENTRYDATE");
					array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
					
						newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
						$tranValueArr[3] = $CRLEDGERID;
						$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'");
						newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
				$amt -= $_POST["txtDUEAMOUNT".$id];
			}
		}
	}
	else
	{
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
			$DRLEDGERID = $_POST["txtLEDGERID"];
			$CRLEDGERID = $_POST["txtBOOKLEDGERID"] ;
			$AMOUNT =isset($_POST["txtCRAMOUNT"]) ? $_POST["txtCRAMOUNT"] : 0;
			$AMOUNT_usd =isset($_POST["txtAMOUNTDOLLAR"]) ? $_POST["txtAMOUNTDOLLAR"] : 0;
			$AMOUNT_rmb =isset($_POST["txtRMBAMOUNT"]) ? $_POST["txtRMBAMOUNT"] : 0;			
			$conv_usd =isset($_POST["txtCONVRATE"]) ? $_POST["txtCONVRATE"] : 0;
			$conv_rmb =isset($_POST["txtRMBRATE"]) ? $_POST["txtRMBRATE"] : 0;
			
			$RMBDOLSTATUS = isset($_POST["chkRMBSTATUS"]) ?"1":"0";
			array_push($tranValueArr,"'".$SRNO."'");
			array_push($tranValueArr,"'0'");
			array_push($tranValueArr,"'Cash Payment'");
			array_push($tranValueArr,"'".$DRLEDGERID."'");
			array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$DRLEDGERID."'")."'");
			array_push($tranValueArr,"'".$AMOUNT."'");
			array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
			array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
			array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
			array_push($tranValueArr,"'".$loginuser_name."'");
			array_push($tranValueArr,"'".$conv_usd."'");
			array_push($tranValueArr,"'".$AMOUNT_usd."'");
			array_push($tranValueArr,"''");
			array_push($tranValueArr,"'".$conv_rmb."'");
			array_push($tranValueArr,"'".$AMOUNT_rmb."'");
			array_push($tranFieldArr,"ENTRYDATE");
			array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
			newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
			$tranValueArr[3] = $CRLEDGERID;
			$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'");
			newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
	}
		//exit();	
		?>
		<script>
		alert("Added Sucessfully");
		window.location.href="<?php echo SITEURL."?tran-cashpayment";?>";
		</script>
		<?php
		exit();
}
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Cash - Payment - Voucher</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    Cash - Payment - Voucher - New
                </div>
				<div class="panel-body">
					<?php
					if ($view_bol)
					{
					?>
					<p>
						<a  class="btn btn-warning" href="<?php echo SITEURL; ?>?cashpayment-view" style="float:right;" ><i class="fa fa-tasks"></i> View All</a>
						<br>
					</p>
					<?php
					}
					?>
					<form id="tran-cashpayment" action="<?php echo SITEURL; ?>?tran-cashpayment" method="POST">
						
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
									<td><label>Broker Name</label></td>
									<td><label>Party Name</label></td>
									<td><label>Money</label></td>
									
								</tr>
								<tr>
									<td>
										<select class="form-control" name="txtBOOKLEDGERID" id="txtBOOKLEDGERID" required>
											<option value=""> Select Cash A/c </option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID in (5)");
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
										<select class="form-control" name="txtBROKERID" id="txtBROKERID">
											<option value="">Select Broker</option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID='29'");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>"><?php echo $res_led_data["LEDGERNAME"];?></option>
													<?php
												}
											?>
										</select><br>Bal.<span id="txtBROKERIDBALANCE">(0.00)</span>
										<input type="hidden" id="BROKERIDBALANCE" name="BROKERIDBALANCE" val="0.00"/>
									</td>
									<td>
										 <select class="form-control" name="txtLEDGERID" id="txtLEDGERID" required> 
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
									
									<td class="TRAN_USD" width="15%"><label>$ Amount</label></td>
									<td class="TRAN_USD_CONV" width="15%"><label>$ Rate</label></td>
									<td class="TRAN_RMB" width="15%"><label>RMB Amount</label></td>
									<td class="TRAN_RMB_CONV" width="15%"><label>RMB Rate</label></td>
									<td class="TRAN_INR" width="15%"><label>Rs Amount</label></td>
									
									<td class="" width="10%" style="display:none;"><label>Commision %</td>
									<td class="" width="15%" style="display:none;"><label>Commision Amt</td>
									
								</tr>
								
								<tr>
									<td class="TRAN_USD">
										<input type="text" class="form-control onlyNumber amtchange" name="txtAMOUNTDOLLAR" id="txtCRAMOUNTDOLLAR" >
									</td>
									<td class="TRAN_USD_CONV">
										<input type="text" class="form-control onlyNumber amtchange" name="txtCONVRATE" id="txtCONVRATE" >
									</td>
									<td class="TRAN_RMB">
										<input type="text" class="form-control onlyNumber amtchange" name="txtRMBAMOUNT" id="txtCRRMBAMOUNT" >
									</td>
									<td class="TRAN_RMB_CONV">
										<input type="text" class="form-control onlyNumber amtchange" name="txtRMBRATE" id="txtRMBRATE" >
									</td>
									<td class="TRAN_INR">
										<input type="text" class="form-control onlyNumber  CRDRAMOUNT" name="txtCRAMOUNT" id="txtCRAMOUNT" required>
									</td>
									<td class="" style="display:none;">
									<input type="text" class="form-control onlyNumber" name="txtCOMMISSIONPER" id="txtCOMMISSIONPER" >
									</td>
									
									<td class="" style="display:none;">
									<input type="text" class="form-control onlyNumber" name="txtCOMMISSIONAMT" id="txtCOMMISSIONAMT" >
									</td>
								</tr>
								
							</table>							
						</div>
						<div class="form-group">
							<table id="addmorefield" width="100%" class="inputaddmorefieldtable">
								<thead>
									<tr>
										<th width="4%">Sel</th>
										<th width="5%">I No</th>
										<th width="7%">V Type</th>
										<th width="7%">V Date</th>
										<th width="15%">Party</th>
										<th width="4%">Days</th>
										<th width="7%">Due Date</th>
										<th width="6%">$ Rate</th>
										<th width="8%">Rs Amt</th>
										<th>Broker</th>										
										<th width="8%">Due $</th>
										<th width="8%">Due RMB</th>
										<th width="9%">Due Amt</th>
										<th>Remark</th>
									</tr>
								</thead>
								<tbody id="listtran">
									
								</tbody>
							</table>
							
						</div>
						
						<div class="form-group">
							<label>Remark</label>
							<input type="text" class="form-control" name="txtREMARK" id="txtREMARK" >
						</div>
						<input type="hidden" class="form-control" name="txtMaxVal" id="txtMaxVal" >
						<button type="submit" class="btn btn-default" style="float: right;" name="tran-cashpayment">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>