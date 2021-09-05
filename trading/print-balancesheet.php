<?php
$DR_AMT = 0;
$CR_AMT=0;
$OPEN_BAL=0;
$CRHTML='';
$DRHTML='';
$DR_AMTDOLLAR=0;
$CR_AMTDOLLAR=0;
$OPEN_DOLLARBAL=0;
$DR_RMBAMOUNT=0;
$CR_RMBAMOUNT=0;
$OPEN_RMBBAL=0;

$DRBALTOTAL=0;
	$CRBALTOTAL=0;
	
if(isset($_POST["print-balancesheet"]))
{

	$startdate = strtotime($_POST["dtpENDDATE"]);
	if(date('m',$startdate) >=1 && date('m',$startdate) <=10)
	{
		$startdate = date('Y',$startdate)-1 . "-11-01";
	}
	else{
		$startdate = date('Y',$startdate). "-10-01";
	}
	
	 $dtfrm = $startdate;

	
	 $dtto = $_POST["dtpENDDATE"];
	
	$DRCNT=0;
	$CRCNT=0;
	//=========================*pROFIT aND loSS*/BETWEEN PROfi LOSS

	$OPENSTOCK = getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE < '".$dtfrm."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE < '".$dtfrm."' AND PROCESSTYPE='Sale')");
		
	
	$COSINGSTOCK = (getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE <= '". $dtto ."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE <= '". $dtto ."' AND PROCESSTYPE='Sale')"));
			
	$drarr = array();
	array_push($drarr,"DR.GROUPID");
	array_push($drarr,"G.GROUPNAME");
	array_push($drarr,"SUM(DR.AMOUNT) AS AMOUNT");
	array_push($drarr,"SUM(DR.AMOUNTDOLLAR) AS AMOUNTDOLLAR");
	array_push($drarr,"SUM(DR.RMBAMOUNT) AS RMBAMOUNT");
	
	$crarr = array();
	array_push($crarr,"CR.GROUPID");
	array_push($crarr,"G.GROUPNAME");
	array_push($crarr,"SUM(CR.AMOUNT) AS AMOUNT");
	array_push($crarr,"SUM(CR.AMOUNTDOLLAR) AS AMOUNTDOLLAR");
	array_push($crarr,"SUM(CR.RMBAMOUNT) AS RMBAMOUNT");
	
	//$res_gbp = getData(ACGROUP,$AllArr," where MAINACCGRPID IN (1)");
	$res_gbp = getData(ACGROUP,$AllArr," where MAINACCGRPID IN (1) ORDER BY ORDERNO,GROUPNAME");
	$DR_AMT = 0;
	$CR_AMT = 0;
	$DR_AMTDOLLAR = 0;
	$CR_AMTDOLLAR = 0;
	$DR_RMBAMOUNT=0;
	$CR_RMBAMOUNT=0;
	
	
	$DR_AMT +=$OPENSTOCK;
	while($resdata = mysqli_fetch_assoc($res_gbp))
	{
		$bal_arr = getBetweenData($dtfrm,$dtto,$resdata["GROUPID"],true);		 
		if( ($bal_arr[0] != 0 && $bal_arr[1] != '') )
		{
			//===============================DR==============
			if($bal_arr[1] == "Dr" )
			{
				if($bal_arr[1] == "Dr")
				{
					$DR_AMT += $bal_arr[0];
				}
				
			}
			//=======================DR==============
			//=======================CR==============
			elseif($bal_arr[1] == "Cr" )
			{				
				if($bal_arr[1] == "Cr")
				{
					$CR_AMT += $bal_arr[0];
				}
			}//=======================CR==============
		}	
	}
	$CR_AMT += $COSINGSTOCK;
	$grossprofit = $CR_AMT - $DR_AMT;
	$flagtrue =  $COSINGSTOCK != 0  ? true:false;
	if($flagtrue)
		{
			$DRHTML_CLOSING='
							<tr class="">
								<td>CLOSING STOCK</td>
								<td style="text-align:right;">'. getCurrFormat($COSINGSTOCK).'</td>
							</tr>';				
				}	

		$DR_AMT=0;
		$CR_AMT=abs($grossprofit);
		//$res_gbp = getData(ACGROUP,$AllArr," where MAINACCGRPID IN (3)");
		$res_gbp = getData(ACGROUP,$AllArr," where MAINACCGRPID IN (3) ORDER BY ORDERNO,GROUPNAME");
		while($res_gbpdata = mysqli_fetch_assoc($res_gbp))
			{
				$bal_arr = getBetweenData($dtfrm,$dtto,$res_gbpdata["GROUPID"],true);		 
				if( ($bal_arr[0] != 0 && $bal_arr[1] != '') )
				{
					//===============================DR==============
					if($bal_arr[1] == "Dr" )
					{
						if($bal_arr[1] == "Dr")
						{
							$DR_AMT += $bal_arr[0];
						}
						
					}
					//=======================DR==============
					//=======================CR==============
					elseif($bal_arr[1] == "Cr" )
					{				
						if($bal_arr[1] == "Cr")
						{
							$CR_AMT += $bal_arr[0];
						}
					}//=======================CR==============
				}							
			}
		$NetProfit = $CR_AMT - $DR_AMT;
		
	//=========================*pROFIT aND loSS*/ BETWEEN PROfi LOSS
	//====================================================
	$res_gbp = getData(ACGROUP,$AllArr," where MAINACCGRPID IN (2) ORDER BY ORDERNO,GROUPNAME");
	while($res_gbp_data = mysqli_fetch_assoc($res_gbp))
	{
		$bal_arr = getClosingBalance($dtfrm,$dtto,$res_gbp_data["GROUPID"],true);		 
		if(($bal_arr[0] != 0 && $bal_arr[1] != ''))
		{
			
			//==============================DEBIT==========================================
			if($bal_arr[1] == "Dr" )
			{
				$DRCNT+=1;
				$DRHTML.='<tr>
								<td>'.strtoupper($res_gbp_data["GROUPNAME"]).'</td>';
			
				if($bal_arr[1] == "Dr")
				{
					$DRHTML.='<td class="rightaling">'.getCurrFormat($bal_arr[0]).'</td>';
					$DRBALTOTAL+=$bal_arr[0];
				}
				else
				{
					$DRHTML.='<td class="rightaling">'.getCurrFormat(0.00).'</td>';
				}
				$DRHTML.='</tr>';
			}
			//==============================DEBIT==========================================
			//==============================CREDIT=========================================
			elseif($bal_arr[1] == "Cr" )
			{
				$CRCNT+=1;
				$CRHTML.='<tr>
								<td>'.strtoupper($res_gbp_data["GROUPNAME"]).'</td>';
			
			
				if($bal_arr[1] == "Cr")
				{
					$CRHTML.='<td class="rightaling">'.getCurrFormat($bal_arr[0]).'</td>';
					$CRBALTOTAL+=$bal_arr[0];
				}
				else
				{
					$CRHTML.='<td class="rightaling">'.getCurrFormat(0.00).'</td>';
				}
				$CRHTML.='</tr>';
			}
			//==============================CREDIT==========================================	
		}
					
	}
	$PLRES = getData(NETPL_MST,$AllArr," WHERE NETDATE <= '".$dtfrm."'");
	$PLamtCR =0;
	$PLamtDR =0;			
	while($PLRESdata = mysqli_fetch_assoc($PLRES))
	{
		$startdate = strtotime($PLRESdata["NETDATE"]);
		$ENDYEAR = date('Y',$startdate);
		$STARTYEAR = date('Y',$startdate)-1;
		if($PLRESdata["PL"] == 'Profit')
		{
			$PLamtCR += $PLRESdata["AMOUNT"];
			$CRCNT+=1;
			$CRHTML.='<tr>
								<td>NET PROFIT ('.$STARTYEAR.'-'.$ENDYEAR.')</td>
								<td class="rightaling">'.getCurrFormat($PLRESdata["AMOUNT"]).'</td>
							</tr>';
			$CRBALTOTAL+=$PLRESdata["AMOUNT"];
		}
		elseif($PLRESdata["PL"] == 'Loss')
		{
			$PLamtDR += $PLRESdata["AMOUNT"];
			$DRCNT+=1;
			$DRHTML.='<tr>
								<td>NET LOSS ('.$PLRESdata["NETDATE"].')</td>
								<td class="rightaling">'.getCurrFormat($PLRESdata["AMOUNT"]).'</td>
							</tr>';
			$DRBALTOTAL+=$PLRESdata["AMOUNT"];
		}
	}

					
	if($flagtrue)
				{
					$DRHTML.=$DRHTML_CLOSING;
					$DRCNT+=1;
					$DRBALTOTAL += $COSINGSTOCK;
				}		
	if($NetProfit > 0)
		{
			
				$CRHTML.='      
												<tr class="">
															
																	
																	<td>NET PROFIT</td>
															<td style="text-align:right;">'.getCurrFormat(abs($NetProfit)).'</td>
														</tr>';
					$CRCNT+=1;
					$CRBALTOTAL += ABS($NetProfit);

		}	
		else
		{

			
			$DRHTML.='      
												<tr class="">
															
																	
																	<td>NET LOSS</td>
															<td style="text-align:right;">'.getCurrFormat(abs($NetProfit)).'</td>
														</tr>';
			$DRCNT+=1;
					$DRBALTOTAL += ABS($NetProfit);
		}
	$Diff =  ABS($CRBALTOTAL - $DRBALTOTAL);
	
	if(($DRBALTOTAL > $CRBALTOTAL) && $Diff > 0)
	{
		$Diff =  ABS($CRBALTOTAL - $DRBALTOTAL);
		$CRHTML.='<tr>
							<td>Diff In Opening Balance</td>
							<td class="rightaling">'.getCurrFormat($Diff).'</td>
							
						</tr>';
		$CRCNT+=1;
		$CRBALTOTAL +=$Diff;
	
	}
	elseif(($CRBALTOTAL > $DRBALTOTAL) && $Diff > 0 )
	{
		$Diff =  ABS($DRBALTOTAL - $CRBALTOTAL);
		$DRHTML.='<tr>
							<td>Diff In Opening Balance</td>
							<td class="rightaling">'.getCurrFormat($Diff).'</td>
							
						</tr>';
		$DRCNT+=1;
		$DRBALTOTAL +=$Diff;
		
	}
	if($DRCNT <$CRCNT)
		$MAXCNT= $CRCNT;
	else
		$MAXCNT=$DRCNT;
	for($i=$DRCNT;$i<=$MAXCNT;$i++)
	{
		$DRHTML.='<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							
						</tr>';
		
	}
	
	for($i=$CRCNT;$i<=$MAXCNT;$i++)
	{
		$CRHTML.='<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							
						</tr>';
	}
	$DRHTML.='<tr>
							<td style="text-align:right;font-weight:bold;font-size:1.3em;">Total:</td>
							<td class="rightaling" style="text-align:right;font-weight:bold;font-size:1.3em;">'.getCurrFormat($DRBALTOTAL).'</td>
							
						</tr>';
	$CRHTML.='<tr>
							<td style="text-align:right;font-weight:bold;font-size:1.3em;">Total:</td>
							<td class="rightaling" style="text-align:right;font-weight:bold;font-size:1.3em;">'.getCurrFormat($CRBALTOTAL).'</td>
							
						</tr>';
		
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Balance Sheet</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if ($view_bol)
{
?>
<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmledgertable" id="frmledgertable" action="<?php echo SITEURL; ?>print-balancesheet" method="POST" target="_blank">
					<button type="submit" class="btn btn-default" style="float: right;margin-left:10px;" name="print-balancesheet" id="printledger">Submit Button</button>
					<button type="submit" class="btn btn-danger" style="float: right;" name="print-balancesheet-pdf" id="printledgerpdf"><i class="fa fa-file-pdf-o"></i> Make PDF</button>
					
					<input type="hidden" class="form-control" name="ENDDATE"  value="<?php echo isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : '';?>">		
					<input type="hidden" class="form-control" name="STARTDATE"  value="<?php echo isset($_POST["dtpSTARTDATE"]) ? $_POST["dtpSTARTDATE"] : '';?>">
											
					
					<div class="form-group">
							<table width="50%" class="inputfieldtable">
								<tr>
									<td ><label>Date</label></td>
									<td style="display:none;">
										<input type="date" class="form-control" name="dtpSTARTDATE" id="dtpSTARTDATE" value="<?php echo $comp_fromdt;?>">
									</td>
									<td>
										<input type="date" class="form-control" name="dtpENDDATE" id="dtpENDDATE" value="<?php echo isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : date('Y-m-d');?>">
									</td>
								</tr>
							</table>
					</div>
					<div class="dataTable_wrapper">
					
					<table width="100%" class="table table-striped table-bordered table-hover">
						<tr>
									<!--<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Balance Sheet: <?php echo isset($_POST["print-balancesheet"]) ? getDateFormat($_POST["STARTDATE"]) ." To ". getDateFormat($_POST["ENDDATE"]) : '';?></h5></td>-->
									<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Balance Sheet: <?php echo isset($_POST["print-balancesheet"]) ? getDateFormat($_POST["dtpENDDATE"]) : '';?></h5></td>
						</tr>
						<tr>
							<td> 
								<table width="100%" class="table table-striped table-bordered table-hover">
								<thead>
								
									<tr>
										
										<th colspan="2" style="text-align:center;">Liabilities</th>		
									</tr>
									<tr>
										
										<th>Name</th>
										<th>Amount</th>
										<!--<th class="usdcol">AMOUNTDOLLAR</th>
										<th class="rmbcol">RMBAmount</th>-->
									</tr>
								 </thead>
								 <tbody>
								<?php
								echo $CRHTML;
								?>
								</tbody>
							</table>
						</td>
						
							<td>	
								<table  width="100%" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>											
											<th colspan="2" style="text-align:center;">Assets</th>		
										</tr>
										<tr>
												
											<th>Name</th>
											<th>Amount</th>
											<!--<th class="usdcol">AMOUNTDOLLAR</th>
											<th class="rmbcol">RMBAmount</th>-->
										</tr>
									 </thead>
									<tbody>
									<?php
									
									echo $DRHTML;
								?>										
									</tbody>
								</table>
							</td>							
						</tr>
								
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
?>


	

	

	