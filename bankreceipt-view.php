<?php 

if(isset($_POST["SRNO"]) && isset($_POST["VOUCHERTYPE"]) && isset($_POST["tran-bankreceipt"]))
{
	//exit();
	$tranFieldArr= array();
	$tranValueArr= array();
	array_push($tranFieldArr,"LEDGERID");
	array_push($tranFieldArr,"GROUPID");
	array_push($tranFieldArr,"AMOUNT");
	array_push($tranFieldArr,"DESCRIPTION");
	array_push($tranFieldArr,"VOUCHERDATE");
	array_push($tranFieldArr,"UPDATEDATE");
	array_push($tranFieldArr,"USERNAME");
	array_push($tranFieldArr,"CONVRATE");
	array_push($tranFieldArr,"AMOUNTDOLLAR");
	array_push($tranFieldArr,"RMBRATE");
	array_push($tranFieldArr,"RMBAMOUNT");
	
	$AMOUNT =$_POST["txtDRAMOUNT"];
	
	
	$RMBDOLSTATUS = isset($_POST["chkRMBSTATUS"]) ?"1":"0";
	array_push($tranValueArr,"'".$_POST["txtLEDGERID"]."'");
	array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$_POST["txtLEDGERID"]."'")."'");
	array_push($tranValueArr,"'".$AMOUNT."'");
	array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
	array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
	array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
	array_push($tranValueArr,"'".$user_name."'");
	array_push($tranValueArr,"'".$_POST["txtCONVRATE"]."'");
	array_push($tranValueArr,"'".$_POST["txtAMOUNTDOLLAR"]."'");
	array_push($tranValueArr,"".$_POST["txtRMBRATE"]."");
	array_push($tranValueArr,"".$_POST["txtRMBAMOUNT"]."");
	
	editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT," WHERE SRNO='". $_POST["SRNO"]."' AND VOUCHERTYPE='". $_POST["VOUCHERTYPE"] . "'");
	
	$tranValueArr=array();
	array_push($tranValueArr,"'".$_POST["txtBOOKLEDGERID"]."'");
	array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$_POST["txtBOOKLEDGERID"]."'")."'");
	array_push($tranValueArr,"'".$AMOUNT."'");
	array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
	array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
	array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
	array_push($tranValueArr,"'".$user_name."'");
	array_push($tranValueArr,"'".$_POST["txtCONVRATE"]."'");
	array_push($tranValueArr,"'".$_POST["txtAMOUNTDOLLAR"]."'");
	array_push($tranValueArr,"".$_POST["txtRMBRATE"]."");
	array_push($tranValueArr,"".$_POST["txtRMBAMOUNT"]."");
	
	editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT," WHERE SRNO='". $_POST["SRNO"]."' AND VOUCHERTYPE='". $_POST["VOUCHERTYPE"] . "'");
	
	
	if($_POST["TAXTYPE"] == "Tax Out")
	{
		$cnt_igst = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE  VOUCHERTYPE='Tax Out' AND SRNO='".$_POST["SRNO"]."' AND LEDGERID='" . IGSTOUT . "'");
		$cnt_cgst = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE VOUCHERTYPE='Tax Out' AND SRNO='".$_POST["SRNO"]."' AND LEDGERID='" . CGSTOUT . "'");
		$cnt_sgst = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE  VOUCHERTYPE='Tax Out' AND SRNO='".$_POST["SRNO"]."' AND LEDGERID='" . SGSTOUT . "'");
		
		$tranTAXFieldArr= array();
		$tranTAXValueArr= array();
		array_push($tranTAXFieldArr,"SRNO");
		array_push($tranTAXFieldArr,"VOUCHERNO");
		array_push($tranTAXFieldArr,"VOUCHERTYPE");
		array_push($tranTAXFieldArr,"LEDGERID");
		array_push($tranTAXFieldArr,"AMOUNT");
		array_push($tranTAXFieldArr,"DESCRIPTION");
		array_push($tranTAXFieldArr,"VOUCHERDATE");
		array_push($tranTAXFieldArr,"UPDATEDATE");
		array_push($tranTAXFieldArr,"USERNAME");
		array_push($tranTAXFieldArr,"CONVRATE");
		array_push($tranTAXFieldArr,"AMOUNTDOLLAR");
		array_push($tranTAXFieldArr,"GROUPID");
		array_push($tranTAXFieldArr,"TAXSTATUS");
		
		array_push($tranTAXValueArr,"'".$_POST["SRNO"]."'");
		array_push($tranTAXValueArr,"'0'");
		array_push($tranTAXValueArr,"'Tax Out'");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"'".$_POST["txtREMARK"]."'");
		array_push($tranTAXValueArr,"'".date('Y-m-d')."'");
		array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranTAXValueArr,"'".$loginuser_name."'");
		array_push($tranTAXValueArr,"'".$_POST["txtCONVRATE"]."'");
		array_push($tranTAXValueArr,"'".$_POST["txtTOTALDOLLAR"]."'");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"1");
		
		//==========================IGST====================================
		if($_POST["txtIGSTAMT"] > 0)
		{
			if ($cnt_igst == 0)
			{
				$tranTAXValueArr[3] = "'".IGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtIGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				array_push($tranTAXFieldArr,"ENTRYDATE");
				array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");			
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".IGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."'";					
				$tranTAXValueArr[3] = "'".IGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtIGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT,$Condition);			
			}	
		}
		else
		{
			$Condition = " WHERE LEDGERID='".IGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."'";			 
			 deleteData(LEDGER_CREDIT,$Condition);
		}
		
		//==========================CGST====================================
		if($_POST["txtCGSTAMT"] > 0)
		{
			if ($cnt_cgst == 0)
			{
				$tranTAXValueArr[3] = "'".CGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtCGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				array_push($tranTAXFieldArr,"ENTRYDATE");
				array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");			
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".CGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."'";				
				$tranTAXValueArr[3] = "'".CGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtCGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT,$Condition);			
			}	
		}
		else
		{
			$Condition = " WHERE LEDGERID='".CGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."' ";			 
			 deleteData(LEDGER_CREDIT,$Condition);
		}
		//==========================SGST====================================
		if($_POST["txtSGSTAMT"] > 0)
		{
			if ($cnt_sgst == 0)
			{
				$tranTAXValueArr[3] = "'".SGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtSGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
					
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".SGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."'";				
				$tranTAXValueArr[3] = "'".SGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtSGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT,$Condition);			
			}	
		}
		else
		{
			$Condition = " WHERE LEDGERID='".SGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."'";			 
			 deleteData(LEDGER_CREDIT,$Condition);
		}
		
		
	}
	elseif($_POST["TAXTYPE"] == "Tax In")
	{
		$cnt_igst = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE   VOUCHERTYPE='Tax In' AND SRNO='".$_POST["SRNO"]."' AND LEDGERID='" . IGSTIN . "'");
		$cnt_cgst = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE  VOUCHERTYPE='Tax In' AND SRNO='".$_POST["SRNO"]."' AND LEDGERID='" . CGSTIN . "'");
		$cnt_sgst = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE  VOUCHERTYPE='Tax In' AND SRNO='".$_POST["SRNO"]."' AND LEDGERID='" . SGSTIN . "'");
		
		$tranTAXFieldArr= array();
		$tranTAXValueArr= array();
		array_push($tranTAXFieldArr,"SRNO");
		array_push($tranTAXFieldArr,"VOUCHERNO");
		array_push($tranTAXFieldArr,"VOUCHERTYPE");
		array_push($tranTAXFieldArr,"LEDGERID");
		array_push($tranTAXFieldArr,"AMOUNT");
		array_push($tranTAXFieldArr,"DESCRIPTION");
		array_push($tranTAXFieldArr,"VOUCHERDATE");
		array_push($tranTAXFieldArr,"UPDATEDATE");
		array_push($tranTAXFieldArr,"USERNAME");
		array_push($tranTAXFieldArr,"CONVRATE");
		array_push($tranTAXFieldArr,"AMOUNTDOLLAR");
		array_push($tranTAXFieldArr,"GROUPID");
		array_push($tranTAXFieldArr,"TAXSTATUS");
		
		
		array_push($tranTAXValueArr,"'".$_POST["SRNO"]."'");
		array_push($tranTAXValueArr,"'0'");
		array_push($tranTAXValueArr,"'Tax In'");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"'".$_POST["txtREMARK"]."'");
		array_push($tranTAXValueArr,"'".date('Y-m-d')."'");
		array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranTAXValueArr,"'".$loginuser_name."'");
		array_push($tranTAXValueArr,"'".$_POST["txtCONVRATE"]."'");
		array_push($tranTAXValueArr,"'".$_POST["txtAMOUNTDOLLAR"]."'");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"1");
		
		//==========================IGST====================================
		if($_POST["txtIGSTAMT"] > 0)
		{
			if ($cnt_igst == 0)
			{
				$tranTAXValueArr[3] = "'".IGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtIGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				array_push($tranTAXFieldArr,"ENTRYDATE");
				array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");			
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".IGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."'";				
				$tranTAXValueArr[3] = "'".IGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtIGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT,$Condition);			
			}	
		}
		else
		{
			$Condition = " WHERE LEDGERID='".IGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."'";					
			deleteData(LEDGER_DEBIT,$Condition);
		}
		
		//==========================CGST====================================
		if($_POST["txtCGSTAMT"] > 0)
		{
			if ($cnt_cgst == 0)
			{
				$tranTAXValueArr[3] = "'".CGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtCGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				array_push($tranTAXFieldArr,"ENTRYDATE");
				array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");			
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".CGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."'";				
				$tranTAXValueArr[3] = "'".CGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtCGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT,$Condition);			
			}	
		}
		else
		{
				$Condition = " WHERE LEDGERID='".CGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."'";					 
			 deleteData(LEDGER_DEBIT,$Condition);
		}
		//==========================SGST====================================
		if($_POST["txtSGSTAMT"] > 0)
		{
		
			if ($cnt_sgst == 0)
			{
					
				$tranTAXValueArr[3] = "'".SGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtSGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".SGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."' ";		
				$tranTAXValueArr[3] = "'".SGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtSGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT,$Condition);			
			}	
		}
		else
		{
			
			 $Condition = " WHERE LEDGERID='".SGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."'";		
			 deleteData(LEDGER_DEBIT,$Condition);
		}
		
	}
	?>
	<script>
		window.location.href='<?php echo SITEURL; ?>?tran-bankreceipt-v';
	</script>
	<?php
	exit();
}
else
{
	
	$DebitCreditArr = Array();
	array_push($DebitCreditArr,"DR.SRNO");
	array_push($DebitCreditArr,"DR.VOUCHERNO");
	array_push($DebitCreditArr,"DR.VOUCHERTYPE");
	array_push($DebitCreditArr,"DR.LEDGERID AS DRLEDGERID");
	array_push($DebitCreditArr,"CR.LEDGERID AS CRLEDGERID");
	array_push($DebitCreditArr,"DR.AMOUNT AS DRAMOUNT");
	array_push($DebitCreditArr,"CR.AMOUNT AS CRAMOUNT");
	array_push($DebitCreditArr,"DR.DESCRIPTION");
	array_push($DebitCreditArr,"DR.VOUCHERDATE");
	array_push($DebitCreditArr,"DR.CONVRATE");
	array_push($DebitCreditArr,"DR.AMOUNTDOLLAR");	
	array_push($DebitCreditArr,"DR.RMBAMOUNT");	
	array_push($DebitCreditArr,"DR.RMBRATE");		
	if(isset($_GET["_mid"]))
	{
		$action ="modify";
		$SRNO = $_GET["_mid"];
		
		$Caption = "Edit Bank Voucher Detail";
		$res = getData(LEDGER_DEBIT,$DebitCreditArr,"  AS DR INNER JOIN ".LEDGER_CREDIT." AS CR ON CR.SRNO=DR.SRNO AND CR.VOUCHERTYPE=DR.VOUCHERTYPE WHERE CR.VOUCHERTYPE='Bank Receipt' AND DR.VOUCHERTYPE='Bank Receipt' AND DR.SRNO='".$SRNO."' AND CR.SRNO='".$SRNO."'");
		$resdata = mysqli_fetch_assoc($res);	
		
		$restaxout = getData(LEDGER_CREDIT,$AllArr,"  WHERE VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."'");
		$restaxin = getData(LEDGER_CREDIT,$AllArr,"  WHERE VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."'");
		$IGSTAMT=0;
		$CGSTAMT=0;
		$SGSTAMT=0;
		$GRANDAMOUNT=$resdata["DRAMOUNT"];
		$TAXTYPE="";
		if(mysqli_num_rows($restaxout) > 0)
		{
			while($resdatatax = mysqli_fetch_assoc($restaxout))
			{
				switch($resdatatax )
				{
					case IGSTOUT:
						$IGSTAMT = $resdatatax["AMOUNT"];
					break;
					case CGSTOUT:
						$CGSTAMT = $resdatatax["AMOUNT"];
					break;
					case SGSTOUT:
						$SGSTAMT = $resdatatax["AMOUNT"];
					break;
				}
			}
			$GRANDAMOUNT = $IGSTAMT+$CGSTAMT+$SGSTAMT+$resdata["CRAMOUNT"];
			$TAXTYPE="Tax Out";
		}
		elseif(mysqli_num_rows($restaxin) > 0)
		{
			while($resdatatax = mysqli_fetch_assoc($restaxin))
			{
				switch($resdatatax )
				{
					case IGSTIN:
						$IGSTAMT = $resdatatax["AMOUNT"];
					break;
					case CGSTIN:
						$CGSTAMT = $resdatatax["AMOUNT"];
					break;
					case SGSTIN:
						$SGSTAMT = $resdatatax["AMOUNT"];
					break;
				}
			}
			$GRANDAMOUNT = $IGSTAMT+$CGSTAMT+$SGSTAMT+$resdata["DRAMOUNT"];
			$TAXTYPE="Tax In";
		}

		$dtfrm = $resdata["VOUCHERDATE"];

		$CR_AMT = getFieldDetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$resdata["DRLEDGERID"]."' AND VOUCHERDATE <='".$dtfrm."' AND VOUCHERTYPE IN ('Journal','Cash Payment','Cash Receipt','Bank Payment','Bank Receipt','Opening')");
		$DR_AMT = getFieldDetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$resdata["DRLEDGERID"]."' AND VOUCHERDATE <='".$dtfrm."' AND VOUCHERTYPE IN ('Journal','Cash Payment','Cash Receipt','Bank Payment','Bank Receipt','Opening')");
		$BAL_DR = (($DR_AMT-$CR_AMT)) > 0 ? (($DR_AMT-$CR_AMT)) : Abs(($DR_AMT-$CR_AMT));
	
		
		$CR_AMT = getFieldDetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$resdata["CRLEDGERID"]."' AND VOUCHERDATE <='".$dtfrm."' AND VOUCHERTYPE IN ('Journal','Cash Payment','Cash Receipt','Bank Payment','Bank Receipt','Opening')");
		$DR_AMT = getFieldDetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$resdata["CRLEDGERID"]."' AND VOUCHERDATE <='".$dtfrm."' AND VOUCHERTYPE IN ('Journal','Cash Payment','Cash Receipt','Bank Payment','Bank Receipt','Opening')");
		$BAL_CR = (($DR_AMT-$CR_AMT)) > 0 ? (($DR_AMT-$CR_AMT)) : Abs(($DR_AMT-$CR_AMT));
		
		
		
	}
	elseif(isset($_GET["_rid"]))
	//if(isset($_GET["_rid"]))
	{
		$action ="remove";
		$SRNO = $_GET["_rid"];
		deleteData(LEDGER_DEBIT," where SRNO='".$SRNO."'");
		deleteData(LEDGER_CREDIT," where SRNO='".$SRNO."'");
		?>
		<script>
			window.location.href="<?php echo SITEURL."?tran-bankreceipt-v";?>";
		</script>
		<?php
	}
	else
	{
		$action ="";
	}
}

//$res_dr = getData(LEDGER_DEBIT,$DebitCreditArr,"  AS DR INNER JOIN ".LEDGER_CREDIT." AS CR ON CR.SRNO=DR.SRNO AND CR.VOUCHERTYPE=DR.VOUCHERTYPE WHERE CR.VOUCHERTYPE='Bank Receipt' AND DR.VOUCHERTYPE='Bank Receipt' ORDER BY DR.VOUCHERDATE DESC,DR.SRNO ASC");
$res_dr = getData(LEDGER_DEBIT,$DebitCreditArr,"  AS DR INNER JOIN ".LEDGER_CREDIT." AS CR ON CR.SRNO=DR.SRNO AND CR.VOUCHERTYPE=DR.VOUCHERTYPE WHERE CR.VOUCHERTYPE='Bank Receipt' AND DR.VOUCHERTYPE='Bank Receipt' ORDER BY DR.SRNO DESC");

?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Bank - Receipt - Voucher - View</h1>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?tran-bankreceipt-v" method="POST" onsubmit="return confirm('Do you really want to Delete?');">
					
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
								while($resdata = mysqli_fetch_assoc($res_dr))
										{
											$classname = ($SRNO_CNT / 2) == 0 ? 'odd gradeX' :'even gradeC';
											
											?>
												<tr class="<?php echo $classname;?>">
												<td class="delcls">
													<?php
													if($resdata["VOUCHERNO"] == 0)
													{
														?>
														<a href="<?php echo SITEURL; ?>?bankreceipt-view&_mid=<?php echo $resdata["SRNO"];?>" class="btn btn-primary btn-circle" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
														<?PHP
													}
													?>
													
													
													
													<?php
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?bankreceipt-view&_rid=<?php echo $resdata["SRNO"];?>" onclick="return confirm('Do you really want to Delete This Transaction : <?php echo $resdata["SRNO"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
															
													<?php
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
	$moneycol= "";
	if($resdata["AMOUNTDOLLAR"] > 0 && $resdata["RMBAMOUNT"] == 0 && $resdata["DRAMOUNT"] ==0)
	{
		$moneycol = "$";
	}
	elseif($resdata["AMOUNTDOLLAR"] == 0 && $resdata["RMBAMOUNT"] > 0 && $resdata["DRAMOUNT"] ==0)
	{
		$moneycol = "RMB";
	}
	elseif($resdata["AMOUNTDOLLAR"] == 0 && $resdata["RMBAMOUNT"] == 0 && $resdata["DRAMOUNT"] >0)
	{
		$moneycol = "₹";
	}
	elseif($resdata["AMOUNTDOLLAR"] > 0 && $resdata["RMBAMOUNT"] == 0 && $resdata["DRAMOUNT"] >0)
	{
		$moneycol = "$-₹";
	}
	elseif($resdata["AMOUNTDOLLAR"] == 0 && $resdata["RMBAMOUNT"] > 0 && $resdata["DRAMOUNT"] >0)
	{
		$moneycol = "RMB-₹";
	}
	elseif($resdata["AMOUNTDOLLAR"] > 0 && $resdata["RMBAMOUNT"] > 0 && $resdata["DRAMOUNT"] >0)
	{
		$moneycol = "$-RMB-₹";
	}
	
	
	
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    Cash - Voucher - New
                </div>
				<div class="panel-body">
					<p>
						<a  class="btn btn-warning" href="<?php echo SITEURL; ?>?bankreceipt-view" style="float:right;" ><i class="fa fa-tasks"></i> View All</a>
						<br>
					</p>
					<form id="frm_journaltable_edit" action="<?php echo SITEURL; ?>?tran-bankreceipt-v" method="POST" >
						<input type="hidden" value="<?php echo $resdata["SRNO"]?>" name="SRNO">
						<input type="hidden" value="<?php echo $resdata["VOUCHERTYPE"]?>" name="VOUCHERTYPE">
						<input type="hidden" value="<?php echo $TAXTYPE?>" name="TAXTYPE">
						<input type="hidden" value="<?php echo $moneycol?>" name="MONEYCOL" id="MONEYCOL">
						<div class="form-group">
							<table width="15%" class="inputfieldtable">
								<tr>
									<td width="15%"><label>Date</label></td>
								</tr>
								<tr>
									<td>
										<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php echo $resdata["VOUCHERDATE"];?>" >
									</td>
								
								</tr>
								
							</table>
							
						</div>
						<div class="form-group">
							<table width="60%" class="inputfieldtable">
								<tr>
									<td width="35%"><label>Book Name</label></td>
									<td><label>Party Name</label></td>
								</tr>
								<tr>
									<td>
										<select class="form-control" name="txtBOOKLEDGERID" id="txtBOOKLEDGERID">
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0'");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $resdata["DRLEDGERID"] == $res_led_data["LEDGERID"] ? 'selected="selected"' : '' ?>><?php echo $res_led_data["LEDGERNAME"];?></option>
													<?php
												}
											?>
										</select><br>Bal.<span id="txtBOOKLEDGERIDBALANCE">(<?php echo $BAL_DR; ?>)</span>
										<input type="hidden" id="BOOKLEDGERIDBALANCE" name="DRLEDGERIDBALANCE" val="<?php echo $BAL_DR; ?>"/>
									</td>
									<td>
										 <select class="form-control" name="txtLEDGERID" id="txtLEDGERID">
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0'");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $resdata["CRLEDGERID"] == $res_led_data["LEDGERID"] ? 'selected="selected"' : '' ?>><?php echo $res_led_data["LEDGERNAME"];?></option>
													<?php
												}
											?>
											</select><br>Bal.<span id="txtLEDGERIDBALANCE">(<?php echo $BAL_CR; ?>)</span>
										<input type="hidden" id="LEDGERIDBALANCE" name="CRLEDGERIDBALANCE" val="<?php echo $BAL_CR; ?>"/>
									</td>
								</tr>
								
							</table>
							
						</div>
						
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>$ Amount</label></td>
									<td><label>Conv Rate</label></td>
									
									<td><label>RMB</label></td>
									<td><label>RMB Rate</label></td>
									<td><label>Rec Amount</label></td>
									
									
									
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control onlyNumber amtchange_mid" name="txtAMOUNTDOLLAR" id="txtDRAMOUNTDOLLAR" value="<?php echo $resdata["AMOUNTDOLLAR"]?>">
									</td>
									<td>
										<input type="text" class="form-control onlyNumber amtchange_mid" name="txtCONVRATE" id="txtCONVRATE" value="<?php echo $resdata["CONVRATE"]?>">
									</td>
										
									<td>
										
										<input type="text" class="form-control onlyNumber amtchange_mid" name="txtRMBAMOUNT" id="txtDRRMBAMOUNT" value="<?php echo $resdata["RMBAMOUNT"]?>">
										<p class="help-block"></p>
									</td>
									<td>
										
										<input type="text" class="form-control onlyNumber amtchange_mid" name="txtRMBRATE" id="txtRMBRATE" value="<?php echo $resdata["RMBRATE"]?>">
										<p class="help-block"></p>
									</td>
									<td>
										<input type="text" class="form-control onlyNumber amtchange_mid DRAMOUNT" name="txtDRAMOUNT" id="txtDRAMOUNT" value="<?php echo $resdata["DRAMOUNT"]?>" >
									</td>
									
									
									
								
								</tr>
								
							</table>
							
						</div>
						
				
						
						
						
						<div class="form-group">
							<label>Remark</label>
							<input type="text" class="form-control" name="txtREMARK" id="txtREMARK" value="<?php echo $resdata["DESCRIPTION"]?>">
						</div>
						<button type="submit" class="btn btn-default" style="float: right;" name="tran-bankreceipt">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	<?php
}
?>