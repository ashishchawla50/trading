<?php
$DR_AMT = 0;
$CR_AMT=0;
$OPEN_BAL=0;
$DRHTML='';
$CRHTML='';
$DR_AMTDOLLAR=0;
$CR_AMTDOLLAR=0;
$DR_RMBAMOUNT=0;
$CR_RMBAMOUNT=0;

if(isset($_POST["print-profitloss"]))
{
	$dtfrm = $_POST["dtpFROMDATE"];
	$dtto = $_POST["dtpENDDATE"];

	$OPENSTOCK = getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE < '".$dtfrm."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE < '".$dtfrm."' AND PROCESSTYPE='Sale')");
	$COSINGSTOCK = ( getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE <= '". $dtto ."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE <= '". $dtto ."' AND PROCESSTYPE='Sale')"));
	
	
	
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
	
	$res_gbp = getData(ACGROUP,$AllArr," where MAINACCGRPID IN (1)");
	
	$classname='';
	$DIRECTINC=0;
	$DIRECTEXP=0;


	$INDIRECTINC=0;
	$INDIRECTEXP=0;
	
	$SRNO_CNT_DR = 1;
	$SRNO_CNT_CR = 1;
	$DR_AMT = 0;
	$CR_AMT = 0;
	$DR_AMTDOLLAR=0;
    $CR_AMTDOLLAR=0;
	$DR_RMBAMOUNT=0;
	$CR_RMBAMOUNT=0;
	
	$DRHTML='<tr class="'.$classname.'">
						
						<td>OPENING STOCK</td>
						<td style="text-align:right;">'.getCurrFormat($OPENSTOCK).'</td>
					
			</tr>' ;
	$DR_AMT +=$OPENSTOCK;
	
	$SRNO_CNT_DR+=1;
	
	//==============================================cal gross start=================================================
	while($resdata = mysqli_fetch_assoc($res_gbp))
	{
		$bal_arr = getBetweenData($dtfrm,$dtto,$resdata["GROUPID"],true);		 
		
		if( ($bal_arr[0] != 0 && $bal_arr[1] != '') )
		{
			//===============================DR==============
			if($bal_arr[1] == "Dr" )
			{
				$DRHTML.=  '
							<tr class="'.$classname.'">
								
								<td>'.strtoupper($resdata["GROUPNAME"]).'</td>';
				if($bal_arr[1] == "Dr")
				{
					$DRHTML.=  '<td style="text-align:right;">'.getCurrFormat($bal_arr[0]) .'</td>';
					$DR_AMT += $bal_arr[0];
				}
				else
				{
					$DRHTML.=  '<td style="text-align:right;">'.getCurrFormat(0.00) .'</td>';
				
				}
				$DRHTML.='</tr>';
				$SRNO_CNT_DR+=1;
			}
			//=======================DR==============
			//=======================CR==============
			elseif($bal_arr[1] == "Cr")
			{
				$CRHTML.='
							<tr class="'.$classname.'">
								
								<td>'.strtoupper($resdata["GROUPNAME"]).'</td>';
				if($bal_arr[1] == "Cr")
				{
					$CRHTML.='<td style="text-align:right;">'.getCurrFormat($bal_arr[0]) .'</td>';
					$CR_AMT += $bal_arr[0];
				}
				else
				{
					$CRHTML.='<td style="text-align:right;">'.getCurrFormat(0.00) .'</td>';
				}
		
				$CRHTML.='</tr>';
				$SRNO_CNT_CR+=1;
			}
				//=======================CR==============
			
		}			
	
	}
		$CR_AMT += $COSINGSTOCK;
		$flagtrue =  $COSINGSTOCK!= 0  ? true:false;
		if($flagtrue)
				{
					$CRHTML.='
							<tr class="'.$classname.'">
								
								<td>CLOSING STOCK</td>
								<td style="text-align:right;">'. getCurrFormat($COSINGSTOCK).'</td>
							
							</tr>';
					$SRNO_CNT_CR+=1;
				}
		
		$grossprofit = $CR_AMT-$DR_AMT;
	$flagtrue =  $grossprofit!= 0 ? true:false;
		if($flagtrue)
				{
					$CRHTML.='      
												<tr class="'.$classname.'">
															
																	
															<td>GROSS '.($grossprofit >=0 ? 'PROFIT' : 'LOSS').'</td>
															<td style="text-align:right;">'.getCurrFormat(abs($grossprofit)).'</td>
															
														</tr>';	
						$SRNO_CNT_CR+=1;
				}
//==============================================cal gross END=================================================
		
		
	//==============================================cal NET start=================================================
		$DR_AMT=0;
		$CR_AMT=abs($grossprofit);
		
		
	
		

	$res_gbp = getData(ACGROUP,$AllArr," where MAINACCGRPID IN (3)");
	while($res_gbpdata = mysqli_fetch_assoc($res_gbp))
	{
		
		$bal_arr = getBetweenData($dtfrm,$dtto,$res_gbpdata["GROUPID"],true);		 
		
	if( ($bal_arr[0] != 0 && $bal_arr[1] != ''))
		{
			
			//===============================DR==============
			//if($bal_arr[1] == "Dr" || $dollarbal_arr[1] == "Dr" || $rmbbal_arr[1] == "Dr")
			if($bal_arr[1] == "Dr")
			{
				$DRHTML.=  '
							<tr class="'.$classname.'">
								
								<td>'.strtoupper($res_gbpdata["GROUPNAME"]).'</td>';
				if($bal_arr[1] == "Dr")
				{
					$DRHTML.=  '<td style="text-align:right;">'.getCurrFormat($bal_arr[0]) .'</td>';
					$DR_AMT += $bal_arr[0];
				}
				else
				{
					$DRHTML.=  '<td style="text-align:right;">'.getCurrFormat(0.00) .'</td>';
				
				}
				
				$DRHTML.='</tr>';
				$SRNO_CNT_DR+=1;
			}
			//=======================DR==============
			//=======================CR==============
		//	elseif($bal_arr[1] == "Cr" || $dollarbal_arr[1] == "Cr" || $rmbbal_arr[1] == "Cr")
		elseif($bal_arr[1] == "Cr")
			{
				$CRHTML.='
							<tr class="'.$classname.'">
								
								<td>'.strtoupper($res_gbpdata["GROUPNAME"]).'</td>';
				if($bal_arr[1] == "Cr")
				{
					$CRHTML.='<td style="text-align:right;">'.getCurrFormat($bal_arr[0]) .'</td>';
					$CR_AMT += $bal_arr[0];
				}
				else
				{
					$CRHTML.='<td style="text-align:right;">'.getCurrFormat(0.00) .'</td>';
				}
				
				$CRHTML.='</tr>';
				$SRNO_CNT_CR+=1;
			}
				//=======================CR==============
				
				
		}
		
		
	}
	$NetProfit = $CR_AMT - $DR_AMT;
	if($NetProfit > 0)
		{
			
				$DRHTML.='      
												<tr class="'.$classname.'">
															
																	
																	<td>NET PROFIT </td>
															<td style="text-align:right;">'.getCurrFormat(abs($NetProfit)).'</td>
															
														</tr>';
				$DR_AMT +=abs($NetProfit);
				$SRNO_CNT_DR+=1;

		}	
		else
		{

			
			$CRHTML.='      
												<tr class="'.$classname.'">
															
																	
															<td>NET LOSS</td>
															<td style="text-align:right;">'.getCurrFormat(abs($NetProfit)).'</td>
															
														</tr>';
			$CR_AMT +=abs($NetProfit);
			$SRNO_CNT_CR+=1;
		}
		if($SRNO_CNT_CR == $SRNO_CNT_DR)
		{
			$DRHTML.='<tr class="'.$classname.'>">
														
																	<td style="text-align:right;">Total:</td>
															<td style="text-align:right;">'.getCurrFormat($DR_AMT).'</td>
															
														</tr>';
			$CRHTML.='      
												<tr class="'.$classname.'">
															
																	
																	<td style="text-align:right;">Total:</td>
															<td style="text-align:right;">'.getCurrFormat($CR_AMT).'</td>
															
														</tr>';	
														
		}
		else
		{
			if($SRNO_CNT_CR > $SRNO_CNT_DR)
			{
				for($i=$SRNO_CNT_DR ;$i<$SRNO_CNT_CR;$i++)
				{
					$DRHTML.='<tr class="'.$classname.'>">
									<td style="text-align:right;">&nbsp;</td>
									<td style="text-align:right;">&nbsp;</td>
									
							</tr>';
				}
				
			}
			elseif($SRNO_CNT_CR < $SRNO_CNT_DR)
			{
				for($i=$SRNO_CNT_CR ;$i<$SRNO_CNT_DR;$i++)
				{
					$CRHTML.='<tr class="'.$classname.'>">
									<td style="text-align:right;">&nbsp;</td>
									<td style="text-align:right;">&nbsp;</td>
									
							</tr>';
				}
				
			}
			$DRHTML.='<tr class="'.$classname.'>">
														
																	<td style="text-align:right;font-weight:bold;font-size:1.3em;">Total:</td>
															<td style="text-align:right;font-weight:bold;font-size:1.3em;">'.getCurrFormat($DR_AMT).'</td>
															
														</tr>';
			$CRHTML.='      
												<tr class="'.$classname.'">
															
																	
																	<td style="text-align:right;font-weight:bold;font-size:1.3em;">Total:</td>
															<td style="text-align:right;font-weight:bold;font-size:1.3em;">'.getCurrFormat($CR_AMT).'</td>
															
														</tr>';	
		}
	
}

			
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Profit & Loss</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <!--<form name="frmledgertable" id="frmledgertable" action="<?php echo SITEURL; ?>?print-pdf" method="POST">-->
				 <form name="frmledgertable" id="frmledgertable" action="<?php echo SITEURL; ?>?print-profitloss" method="POST">
					<input type="hidden" class="form-control" name="FROMDATE" value="<?php echo isset($_POST["dtpFROMDATE"]) ? $_POST["dtpFROMDATE"] : '';?>">
					<input type="hidden" class="form-control" name="ENDDATE"  value="<?php echo isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : '';?>">
					<div class="form-group">
							<table width="50%" class="inputfieldtable">
								<tr>
									<td ><label>Date</label></td>
									<td>
										<input type="date" class="form-control" name="dtpFROMDATE" id="dtpFROMDATE" value="<?php echo date('Y-m-d');?>">
									</td>
									<td>
										<input type="date" class="form-control" name="dtpENDDATE" id="dtpENDDATE" value="<?php echo date('Y-m-d');?>">
									</td>
								</tr>
								
							</table>
							<div class="form-group">
								<button type="submit" class="btn btn-default" style="float: right;margin-left:10px;" name="print-profitloss" id="printledger">Submit Button</button>
								<button type="submit" class="btn btn-danger" style="float: right;" name="print-profitloss-pdf" id="printledgerpdf"><i class="fa fa-file-pdf-o"></i> Make PDF</button>
								<br/><br>
								</div>
						</div>
					
					
					<div class="dataTable_wrapper">
					<table width="100%" class="table table-striped table-bordered table-hover">
					<?php
					if(isset($_POST["print-profitloss"]))
								{
									?>
									<tr>
										<td colspan="2" style="text-align:center;font-weight:bold;"><h5>Date: <?php echo getDateFormat($_POST["dtpFROMDATE"])?> To <?php echo getDateFormat($_POST["dtpENDDATE"])?></h5></td>
									</tr>
									<?php
								}
					?>
						
						<tr>
							
						
							<td>	
								<table  width="100%" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>											
											<th colspan="7" style="text-align:center;">Debit</th>		
										</tr>
										<tr>
											
											
											<th>Name</th>
											<th>Amount</th>
											<!--<th>AMOUNTDOLLAR</th>
											<th>RMBAmount</th>-->
										</tr>
									 </thead>
									<tbody>
									<?php
									if(isset($_POST["print-profitloss"]))
									{
										echo $DRHTML;
									}?>										
									</tbody>
								</table>
							</td>	
<td> 
								<table width="100%" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										
										<th colspan="7" style="text-align:center;">Credit</th>		
									</tr>
									<tr>
										
										<th>Name</th>
										<th>Amount</th>
										<!--<th>AMOUNTDOLLAR</th>
										<th>RMBAmount</th>-->
									</tr>
								 </thead>
								<tbody>
								<?php
									if(isset($_POST["print-profitloss"]))
									{
										echo $CRHTML;
									}?>					
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
	


	
