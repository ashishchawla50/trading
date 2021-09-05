<?php
$DR_AMT = 0;
$CR_AMT=0;
$DR_AMTDOLLAR=0;
$CR_AMTDOLLAR=0;

$DR_RMBAMOUNT=0;
$CR_RMBAMOUNT=0;

$OPEN_BAL=0;
$disOPEN_BAL_AMT_DR=0;
$disOPEN_BAL_USD_DR=0;
$disOPEN_BAL_RMB_DR=0;

$disOPEN_BAL_AMT_CR=0;
$disOPEN_BAL_USD_CR=0;
$disOPEN_BAL_RMB_CR=0;

$colspan_=1;
$THSTR ="<th>Amount</th>";
$blank_td="";

$MONEYCOL= isset($_POST["MONEYCOL"]) ? $_POST["MONEYCOL"] : '₹';
$lid ="";
if(isset($_POST["print-ledger"]) && !empty($_POST["txtLEDGERID"]) || (isset($_GET["lid"]) && !empty($_GET["lid"])))
{
	$lid = isset($_POST["txtLEDGERID"])  && !empty($_POST["txtLEDGERID"]) ? $_POST["txtLEDGERID"] : $_GET["lid"];
	
	$DebitArr = Array();
	array_push($DebitArr,"DR.SRNO");
	array_push($DebitArr,"IF(DR.VOUCHERNO=0,DR.SRNO,DR.VOUCHERNO) AS VOUCHERNO");
	array_push($DebitArr,"DR.VOUCHERTYPE");
	array_push($DebitArr,"(SELECT LEDGERNAME FROM ".LEDGER." WHERE LEDGERID IN (SELECT LEDGERID FROM ".LEDGER_CREDIT." WHERE SRNO=DR.SRNO AND VOUCHERTYPE=DR.VOUCHERTYPE  AND VOUCHERTYPE !='Opening' AND SRNO!=0)) AS LEDGERNAME");
	
	/*if($MONEYCOL == "$")
	{
		
			array_push($DebitArr,"DR.AMOUNTDOLLAR AS AMOUNT");
			$THSTR ="<th>Amount</th>";
			$colspan_ =1;
			$blank_td=1;
	}	
	elseif($MONEYCOL == "RMB")
	{
			array_push($DebitArr,"DR.RMBAMOUNT AS AMOUNT");
			$THSTR ="<th>Amount</th>";
			$colspan_ =1;
			$blank_td=1;
	}
	elseif($MONEYCOL == "$-₹")
	{
			array_push($DebitArr,"DR.AMOUNT");
			array_push($DebitArr,"DR.CONVRATE");
			array_push($DebitArr,"DR.AMOUNTDOLLAR");
			$THSTR ="
			<th>$</th>
		
			<th>Amount</th>";
			$colspan_ =3;
			$blank_td=3;
	}	
	elseif($MONEYCOL == "RMB-₹")
	{
			array_push($DebitArr,"DR.AMOUNT");
			array_push($DebitArr,"DR.RMBRATE");
			array_push($DebitArr,"DR.RMBAMOUNT");
			$THSTR ="
			<th>RMB</th>
			
			<th>Amount</th>";
			$colspan_ =3;
			$blank_td=3;
	}	
	elseif($MONEYCOL == "$-RMB-₹")
	{
			array_push($DebitArr,"DR.CONVRATE");
			array_push($DebitArr,"DR.AMOUNTDOLLAR");
			array_push($DebitArr,"DR.AMOUNT");
			array_push($DebitArr,"DR.RMBRATE");
			array_push($DebitArr,"DR.RMBAMOUNT");
			$THSTR ="
			
			<th>$</th>
		
			<th>RMB</th>
			
			<th>Amount</th>";
			$colspan_ =3;
			$blank_td=3;
	}	
	else
	{
			array_push($DebitArr,"DR.AMOUNT");
			$THSTR ="<th>Amount</th>";
			$colspan_ =1;
			$blank_td=1;
	}*/
	
	//add================
			array_push($DebitArr,"DR.AMOUNTDOLLAR");
			array_push($DebitArr,"DR.RMBAMOUNT");
			array_push($DebitArr,"DR.AMOUNT");
			
			$THSTR ="			
			<th>$</th>		
			<th>RMB</th>			
			<th>Amount</th>";
			$colspan_ =3;
			$blank_td=3;
	//======================
	
	array_push($DebitArr,"DR.DESCRIPTION");
	array_push($DebitArr,"DR.VOUCHERDATE");
	$CreditArr = Array();
	array_push($CreditArr,"CR.SRNO");
	array_push($CreditArr,"IF(CR.VOUCHERNO=0,CR.SRNO,CR.VOUCHERNO) AS VOUCHERNO");
	array_push($CreditArr,"CR.VOUCHERTYPE");
	array_push($CreditArr,"(SELECT LEDGERNAME FROM ".LEDGER." WHERE LEDGERID IN (SELECT LEDGERID FROM ".LEDGER_DEBIT." WHERE SRNO=CR.SRNO AND VOUCHERTYPE=CR.VOUCHERTYPE  AND VOUCHERTYPE !='Opening' AND SRNO!=0)) AS LEDGERNAME");
	
	/*if($MONEYCOL == "$")
	{
			array_push($CreditArr,"CR.AMOUNTDOLLAR AS AMOUNT");
		
	}	
	elseif($MONEYCOL == "RMB")
	{
			array_push($CreditArr,"CR.RMBAMOUNT AS AMOUNT");
		
	}		
	elseif($MONEYCOL == "$-₹")
	{
			array_push($CreditArr,"CR.AMOUNT");
			array_push($CreditArr,"CR.CONVRATE");
			array_push($CreditArr,"CR.AMOUNTDOLLAR");
			
			
	}	
	elseif($MONEYCOL == "RMB-₹")
	{
			array_push($CreditArr,"CR.AMOUNT");
			array_push($CreditArr,"CR.RMBRATE");
			array_push($CreditArr,"CR.RMBAMOUNT");
			
	}	
	elseif($MONEYCOL == "$-RMB-₹")
	{
			array_push($CreditArr,"CR.CONVRATE");
			array_push($CreditArr,"CR.AMOUNTDOLLAR");
			array_push($CreditArr,"CR.AMOUNT");
			array_push($CreditArr,"CR.RMBRATE");
			array_push($CreditArr,"CR.RMBAMOUNT");
			
	}	
	else
	{
			array_push($CreditArr,"CR.AMOUNT");
	}*/
	
	array_push($CreditArr,"CR.AMOUNT");
	array_push($CreditArr,"CR.AMOUNTDOLLAR");
	array_push($CreditArr,"CR.RMBAMOUNT");
	array_push($CreditArr,"CR.DESCRIPTION");
	array_push($CreditArr,"CR.VOUCHERDATE");

	//$dtfrm = $_POST["dtpFROMDATE"];
	//$dtto = $_POST["dtpENDDATE"];
	
	$dtfrm = isset($_POST["dtpFROMDATE"]) ? $_POST["dtpFROMDATE"] : $comp_fromdt ;
	$dtto = isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : date('Y-m-d') ;
	
	
	$res_dr = getData(LEDGER_DEBIT,$DebitArr,"  AS DR WHERE DR.LEDGERID='".$lid."' AND DR.VOUCHERDATE BETWEEN '".$dtfrm."' and '".$dtto."' ORDER BY DR.VOUCHERDATE, SRNO ");
	$res_cr = getData(LEDGER_CREDIT,$CreditArr,"  AS CR WHERE CR.LEDGERID='".$lid."' AND CR.VOUCHERDATE BETWEEN '".$dtfrm."' and '".$dtto."' ORDER BY CR.VOUCHERDATE, SRNO ");
	$drcnt = mysqli_num_rows($res_dr);
	$crcnt = mysqli_num_rows($res_cr);
	if($drcnt >= $crcnt)
		$maxcnt = $drcnt;
	else
		$maxcnt = $crcnt;
	
	$DROPEN_AMT = getFieldDetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$lid."' AND VOUCHERDATE <'".$dtfrm."'");
	$CROPEN_AMT = getFieldDetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$lid."' AND VOUCHERDATE <'".$dtfrm."'");
	
	$DROPEN_USD = getFieldDetail(LEDGER_DEBIT, "SUM(AMOUNTDOLLAR)", " WHERE LEDGERID='".$lid."' AND VOUCHERDATE <'".$dtfrm."'");
	$CROPEN_USD = getFieldDetail(LEDGER_CREDIT, "SUM(AMOUNTDOLLAR)", " WHERE LEDGERID='".$lid."' AND VOUCHERDATE <'".$dtfrm."'");
	
	$DROPEN_RMB = getFieldDetail(LEDGER_DEBIT, "SUM(RMBAMOUNT)", " WHERE LEDGERID='".$lid."' AND VOUCHERDATE <'".$dtfrm."'");
	$CROPEN_RMB = getFieldDetail(LEDGER_CREDIT, "SUM(RMBAMOUNT)", " WHERE LEDGERID='".$lid."' AND VOUCHERDATE <'".$dtfrm."'");

	$OPEN_BAL_AMT = ($DROPEN_AMT-$CROPEN_AMT);
	
	$OPEN_BAL_USD = ($DROPEN_USD-$CROPEN_USD);
	
	$OPEN_BAL_RMB = ($DROPEN_RMB-$CROPEN_RMB);
	
	if($OPEN_BAL_AMT < 0)
	{
		$disOPEN_BAL_AMT_CR =  ABS($OPEN_BAL_AMT);
	}
	else
	{
		$disOPEN_BAL_AMT_DR =  ABS($OPEN_BAL_AMT);
	}
	
	if($OPEN_BAL_USD < 0)
	{
		$disOPEN_BAL_USD_CR =  ABS($OPEN_BAL_USD);
	}
	else
	{
		$disOPEN_BAL_USD_DR =  ABS($OPEN_BAL_USD);
	}
	
	if($OPEN_BAL_RMB < 0)
	{
		$disOPEN_BAL_RMB_CR =  ABS($OPEN_BAL_RMB);
	}
	else
	{
		$disOPEN_BAL_RMB_DR =  ABS($OPEN_BAL_RMB);
	}
	
}

	
			
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ledger Book</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmledgertable" id="frmledgertable" action="<?php echo SITEURL; ?>?print-ledger" method="POST">
					<input type="hidden" class="form-control" name="FROMDATE" value="<?php echo isset($dtfrm) ? $dtfrm : '';?>">
					<input type="hidden" class="form-control" name="ENDDATE"  value="<?php echo isset($dtto) ? $dtto : '';?>">
					<input type="hidden" class="form-control" name="LEDGERID" value="<?php echo isset($lid) ? $lid : '';?>">
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
								<tr>
									<td><label>Account</label></td>
									<td colspan ="2">
										
											 <select class="form-control" name="txtLEDGERID" id="txtLEDGERID">
												<option value=""> Select Account </option>
												<?php
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0'");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														?>
														<option  <?php echo $res_led_data["LEDGERID"] == $lid ? 'selected="selected"' : '';?> value="<?php echo $res_led_data["LEDGERID"];?>"> <?php echo $res_led_data["LEDGERNAME"];?></option>
														<?php
													}
												?>
											</select>
										
									</td>
								</tr>
									<tr style="display:none;">
									<td><label>Money</label></td>
									<td colspan ="2">
										
											 <select class="form-control" name="MONEYCOL" id="MONEYCOL">
												<!--<option value="₹" <?php echo isset($MONEYCOL) && $MONEYCOL == '₹' ? 'selected="selected"' : ''?>>₹</option>
												<option value="$" <?php echo isset($MONEYCOL) && $MONEYCOL == '$' ? 'selected="selected"' : ''?>>$</option>
												<option value="RMB" <?php echo isset($MONEYCOL) && $MONEYCOL == 'RMB' ? 'selected="selected"' : ''?>>RMB</option>
												<option value="$-₹" <?php echo isset($MONEYCOL) && $MONEYCOL == '$-₹' ? 'selected="selected"' : ''?>>$-₹</option>
												<option value="RMB-₹" <?php echo isset($MONEYCOL) && $MONEYCOL == 'RMB-₹' ? 'selected="selected"' : ''?>>RMB-₹</option>-->
												<!--<option value="$-RMB-₹" selected="selected">$-RMB-₹</option>-->
												<option value="₹" <?php echo isset($MONEYCOL) && $MONEYCOL == '₹' ? 'selected="selected"' : ''?>>₹</option>
											</select>
										
									</td>
								</tr>
							</table>
							<div class="form-group">
								<button type="submit" class="btn btn-default" style="float: right;margin-left:10px;" name="print-ledger" id="printledger">Submit Button</button>
								<button type="submit" class="btn btn-danger" style="float: right;" name="print-ledger-pdf" id="printledgerpdf"><i class="fa fa-file-pdf-o"></i> Make PDF</button>
								<br/><br>
								</div>
						</div>
					
					
					<div class="dataTable_wrapper">
					<table width="100%" class="table table-striped table-bordered table-hover">
					<?php
					if(!empty($lid))
								{
									?>
									<tr>
										<td colspan="2" style="text-align:center;font-weight:bold;"><h5>Name: <?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID='". $lid ."'")?></h5></td>
									</tr>
									<tr>
										<td colspan="2" style="text-align:center;font-weight:bold;"><h5>Date: <?php echo getDateFormat($dtfrm)?> To <?php echo getDateFormat($dtto)?></h5></td>
									</tr>
									<?php
								}
					?>
						
						<tr>
							<td> 
								<table width="100%" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										
										<th colspan="<?php echo 6+$colspan_;?>" style="text-align:center;">Debit</th>		
									</tr>
									<tr>
										
										<th>Sr No</th>	
										<th>V No</th>
										<th>V Dt</th>
										<th>V Type</th>
										<th>Name</th>
										<?php echo $THSTR;?>
										
										<th>Remark</th>
										
									</tr>
								 </thead>
								<tbody>
										
								<?php
								if(!empty($lid))
								{
									$SRNO_CNT = 1;
									$DR_AMT = 0;
									$DR_AMTDOLLAR=0;
									$DR_RMBAMOUNT=0;
									
									while($resdata = mysqli_fetch_assoc($res_dr))
										{
											if($resdata["AMOUNT"] > 0 || $resdata["AMOUNTDOLLAR"] > 0 || $resdata["RMBAMOUNT"] > 0 )
												//if($resdata["AMOUNT"] > 0)
											{
												$classname = ($SRNO_CNT / 2) == 0 ? 'odd gradeX' :'even gradeC';
												$DR_AMT += $resdata["AMOUNT"];
												$DR_AMTDOLLAR += isset($resdata["AMOUNTDOLLAR"]) ? $resdata["AMOUNTDOLLAR"] : 0;
												$DR_RMBAMOUNT += isset($resdata["RMBAMOUNT"]) ? $resdata["RMBAMOUNT"] : 0;
											?>
												<tr class="<?php echo $classname;?>">
													<td><?php echo $SRNO_CNT++;?></td>
													
													<?php 
													if ($resdata["VOUCHERTYPE"]=='Purchase' or $resdata["VOUCHERTYPE"]=='Sale')
													{
													?>
													<td class="open_custom_overlay" rel="<?php echo $resdata["VOUCHERNO"];?>-pur"><a href="javascript:void(0)"><?php echo $resdata["VOUCHERNO"];?></a></td>
													<?php
													}
													else if ($resdata["VOUCHERTYPE"]=='Journal')
													{
													?>
													<td class="open_custom_overlay" rel="<?php echo $resdata["VOUCHERNO"];?>/pur"><a href="javascript:void(0)"><?php echo $resdata["VOUCHERNO"];?></a></td>
													<?php
													}
													else
													{
														?>
														<td><?php echo $resdata["VOUCHERNO"];?></td>
													<?php }
													?>
													
													
													<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
													<td><?php echo $resdata["VOUCHERTYPE"];?></td>
													<td><?php echo $resdata["LEDGERNAME"];?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNTDOLLAR"], 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["RMBAMOUNT"], 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
													
													<?php
														
														/*if($MONEYCOL == "$" || $MONEYCOL == "RMB" || $MONEYCOL == "₹")
														{
															
															?>
															<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
															<?php
															
														}
														elseif($MONEYCOL == "$-₹" || $MONEYCOL == "RMB-₹")
														{
																
																?>
																<td style="text-align:right;"><?php echo  number_format((float)($MONEYCOL == '$-₹' ? $resdata["AMOUNTDOLLAR"] : $resdata["RMBAMOUNT"]), 2, '.', '');?></td>
																<!--<td style="text-align:right;"><?php echo  number_format((float)($MONEYCOL == '$-₹' ? $resdata["CONVRATE"] : $resdata["RMBRATE"]), 2, '.', '');?></td>-->
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
																<?php
																	
														}	
														elseif($MONEYCOL == "$-RMB-₹" )
														{
																
																?>
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNTDOLLAR"], 2, '.', '');?></td>
																<!--<td style="text-align:right;"><?php echo  number_format((float)$resdata["CONVRATE"], 2, '.', '');?></td>-->
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["RMBAMOUNT"], 2, '.', '');?></td>
																<!--<td style="text-align:right;"><?php echo  number_format((float)$resdata["RMBRATE"], 2, '.', '');?></td>-->
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
																<?php
																	
														}	
														else
														{
																?>
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
																<?php
																	
														}*/
													
													?>
													
													
													<td style="text-align:left;"><?php echo $resdata["DESCRIPTION"];?></td>
												</tr>
											<?php
											}
											else
											{
												$maxcnt-=1;
											}
										}
									if($maxcnt >= $SRNO_CNT)
									{
										for($i= $SRNO_CNT ; $i<=$maxcnt ; $i++)
										{
											$classname = ($i / 2) == 0 ? 'odd gradeX' :'even gradeC';
											?>
											<tr class="<?php echo $classname;?>">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<?php
															for ($j=1;$j<=$blank_td;$j++)
															{
																echo "<td>&nbsp;</td>";
															}
															?>
															
												</tr>
											<?php
										}
									}
								}
									
								?>   
											<tr class="">
													<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															
															<td style="text-align:right;">Total:</td>
															<?php
															if($blank_td == 3)
															{
																?>
																<td style="text-align:right;"><?php echo  number_format((float)$DR_AMTDOLLAR, 2, '.', '');?></td>
															
																<td style="text-align:right;"><?php echo  number_format((float)$DR_RMBAMOUNT, 2, '.', '');?></td>
																
																<td style="text-align:right;"><?php echo  number_format((float)$DR_AMT, 2, '.', '');?></td>
																<?php
															}
															else
															{
																?>
																<td style="text-align:right;"><?php echo  number_format((float)$DR_AMT, 2, '.', '');?></td>
																<?php
															}
															?>
													
												<td>&nbsp;</td>
												
												</tr>								
								</tbody>
							</table>
						</td>
						
							<td>	
								<table  width="100%" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>											
											<th colspan="<?php echo 6+$colspan_;?>" style="text-align:center;">Credit</th>		
										</tr>
										<tr>
											
											<th>Sr No</th>	
											<th>V No</th>
											<th>V Dt</th>
											<th>V Type</th>
											<th>Name</th>
											<?php echo $THSTR;?>
											
											<th>Remark</th>
											
										</tr>
									 </thead>
									<tbody>
									<?php
									if(!empty($lid))
									{
										$CR_AMT = 0;
										$CR_AMTDOLLAR=0;
										$CR_RMBAMOUNT=0;
										$SRNO_CNT = 1;
										
										while($resdata = mysqli_fetch_assoc($res_cr))
											{
											if($resdata["AMOUNT"] > 0 || $resdata["AMOUNTDOLLAR"] > 0 || $resdata["RMBAMOUNT"] > 0 )
											//if($resdata["AMOUNT"] > 0 )			
											{
												$classname = ($SRNO_CNT / 2) == 0 ? 'odd gradeX' :'even gradeC';
												$CR_AMT += $resdata["AMOUNT"];
												$CR_AMTDOLLAR += isset($resdata["AMOUNTDOLLAR"]) ? $resdata["AMOUNTDOLLAR"] : 0;
												$CR_RMBAMOUNT += isset($resdata["RMBAMOUNT"]) ? $resdata["RMBAMOUNT"] : 0;
												?>
													<tr class="<?php echo $classname;?>">
														<td><?php echo $SRNO_CNT++;?></td>
														
													<?php 
													if ($resdata["VOUCHERTYPE"]=='Purchase' or $resdata["VOUCHERTYPE"]=='Sale')
													{
													?>
													<td class="open_custom_overlay" rel="<?php echo $resdata["VOUCHERNO"];?>-pur"><a href="javascript:void(0)"><?php echo $resdata["VOUCHERNO"];?></a></td>
													<?php
													}
													else if ($resdata["VOUCHERTYPE"]=='Journal')
													{
													?>
													<td class="open_custom_overlay" rel="<?php echo $resdata["VOUCHERNO"];?>/pur"><a href="javascript:void(0)"><?php echo $resdata["VOUCHERNO"];?></a></td>
													<?php
													}
													else
													{
														?>
														<td><?php echo $resdata["VOUCHERNO"];?></td>
													<?php }
													?>
														
														<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
														<td><?php echo $resdata["VOUCHERTYPE"];?></td>
														<td><?php echo $resdata["LEDGERNAME"];?></td>
														<?php
														
														?>
														<?php
														
														/*if($MONEYCOL == "$" || $MONEYCOL == "RMB" || $MONEYCOL == "₹")
														{
															
															?>
															<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
															<?php
															
														}
														elseif($MONEYCOL == "$-₹" || $MONEYCOL == "RMB-₹")
														{
																
																?>
																<td style="text-align:right;"><?php echo  number_format((float)($MONEYCOL == '$-₹' ? $resdata["AMOUNTDOLLAR"] : $resdata["RMBAMOUNT"]), 2, '.', '');?></td>
																<!--<td style="text-align:right;"><?php echo  number_format((float)($MONEYCOL == '$-₹' ? $resdata["CONVRATE"] : $resdata["RMBRATE"]), 2, '.', '');?></td>-->
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
																<?php
															
														}	
														elseif($MONEYCOL == "$-RMB-₹" )
														{
																
																?>
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNTDOLLAR"], 2, '.', '');?></td>
																<!--<td style="text-align:right;"><?php echo  number_format((float)$resdata["CONVRATE"], 2, '.', '');?></td>-->
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["RMBAMOUNT"], 2, '.', '');?></td>
																<!--<td style="text-align:right;"><?php echo  number_format((float)$resdata["RMBRATE"], 2, '.', '');?></td>-->
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
																<?php
															
														}	
														else
														{
																?>
																<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
																<?php
															
														}*/
													?>
														<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNTDOLLAR"], 2, '.', '');?></td>
														<td style="text-align:right;"><?php echo  number_format((float)$resdata["RMBAMOUNT"], 2, '.', '');?></td>
														<td style="text-align:right;"><?php echo  number_format((float)$resdata["AMOUNT"], 2, '.', '');?></td>
														
														<td style="text-align:left;"><?php echo $resdata["DESCRIPTION"];?></td>
													</tr>
												<?php
											}
											
											}
											//echo $SRNO_CNT;
											if($maxcnt >= $SRNO_CNT)
											{
												for($i= $SRNO_CNT ; $i<=$maxcnt ; $i++)
												{
													$classname = ($i / 2) == 0 ? 'odd gradeX' :'even gradeC';
													?>
													<tr class="<?php echo $classname;?>">
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>														
															<?php
															for ($j=1;$j<=$blank_td;$j++)
															{
																echo "<td>&nbsp;</td>";
															}
															?>
														</tr>
													<?php
												}
											}
									}
										
									?>      
										<tr class="">
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td style="text-align:right;">Total:</td>
																		<?php
															if($blank_td == 3)
															{
																?>
																<td style="text-align:right;"><?php echo  number_format((float)$CR_AMTDOLLAR, 2, '.', '');?></td>
																
																<td style="text-align:right;"><?php echo  number_format((float)$CR_RMBAMOUNT, 2, '.', '');?></td>
																
																<td style="text-align:right;"><?php echo  number_format((float)$CR_AMT, 2, '.', '');?></td>
																<?php
															}
															else
															{
																?>
																<td style="text-align:right;"><?php echo  number_format((float)$CR_AMT, 2, '.', '');?></td>
																<?php
															}
															?>		
													<td>&nbsp;</td>
												</tr>										
									</tbody>
								</table>
							</td>							
						</tr>
								
					</table>
					</div>
					<?php
					
					$CLOSE_BAL_DR_AMT =0;
					$CLOSE_BAL_CR_AMT = 0;
					
					$CLOSE_BAL_DR_USD =0;
					$CLOSE_BAL_CR_USD = 0;
					
					$CLOSE_BAL_DR_RMB =0;
					$CLOSE_BAL_CR_RMB = 0;
					
					if(!empty($lid))
					{
						$CLOSE_BAL_DR_AMT = (($DR_AMT-$CR_AMT) + $OPEN_BAL_AMT) > 0 ? (($DR_AMT-$CR_AMT) + $OPEN_BAL_AMT) : 0;
						$CLOSE_BAL_CR_AMT = (($DR_AMT-$CR_AMT) + $OPEN_BAL_AMT) < 0 ? Abs(($DR_AMT-$CR_AMT) + $OPEN_BAL_AMT): 0;
						
						$CLOSE_BAL_DR_USD = (($DR_AMTDOLLAR-$CR_AMTDOLLAR) + $OPEN_BAL_USD) > 0 ? (($DR_AMTDOLLAR-$CR_AMTDOLLAR) + $OPEN_BAL_USD) : 0;
						$CLOSE_BAL_CR_USD = (($DR_AMTDOLLAR-$CR_AMTDOLLAR) + $OPEN_BAL_USD) < 0 ? Abs(($DR_AMTDOLLAR-$CR_AMTDOLLAR) + $OPEN_BAL_USD): 0;
						
						$CLOSE_BAL_DR_RMB = (($DR_RMBAMOUNT-$CR_RMBAMOUNT) + $OPEN_BAL_RMB) > 0 ? (($DR_RMBAMOUNT-$CR_RMBAMOUNT) + $OPEN_BAL_RMB) : 0;
						$CLOSE_BAL_CR_RMB = (($DR_RMBAMOUNT-$CR_RMBAMOUNT) + $OPEN_BAL_RMB) < 0 ? Abs(($DR_RMBAMOUNT-$CR_RMBAMOUNT) + $OPEN_BAL_RMB): 0;

					}
					
					?>
					<table width="100%" class="table table-striped table-bordered table-hover">
					<thead>
									<tr>											
										<th></th>
										<th colspan="2"style="text-align:center;">Opening</th>
										<th colspan="2" style="text-align:center;">Total</th>
										<th colspan="2" style="text-align:center;">Closing</th>											
									</tr>
										<tr>
											<th></th>
											<th style="text-align:center;">DR</th>
											<th style="text-align:center;">CR</th>
											
										
											<th style="text-align:center;">DR</th>
											<th style="text-align:center;">CR</th>
										
											<th style="text-align:center;">DR</th>
											<th style="text-align:center;">CR</th>
										</tr>
									 </thead>
									
									<tbody>
									 <tr style="text-align:right;font-size:1.2em;">
										<td  width="10%" style="text-align:right;font-weight:bold;">USD</td>
										<td width="15%"><?php echo number_format((float)$disOPEN_BAL_USD_DR, 2, '.', '');?> Dr</td>
										<td width="15%"><?php echo number_format((float)$disOPEN_BAL_USD_CR, 2, '.', '');?> Cr</td>
										<td width="15%"><?php echo number_format((float)$DR_AMTDOLLAR, 2, '.', '');?> Dr </td>
										<td width="15%"><?php echo number_format((float)$CR_AMTDOLLAR, 2, '.', '');?> Cr </td>
										<td width="15%"><?php echo number_format((float)$CLOSE_BAL_DR_USD, 2, '.', '');?> Dr </td>
										<td width="15%"><?php echo number_format((float)$CLOSE_BAL_CR_USD, 2, '.', '');?> Cr </td>
									 </tr>
									<tr style="text-align:right;font-size:1.2em;">
										<td style="text-align:right;font-weight:bold;">RMB</td>
										<td><?php echo number_format((float)$disOPEN_BAL_RMB_DR, 2, '.', '');?> Dr</td>
										<td><?php echo number_format((float)$disOPEN_BAL_RMB_CR, 2, '.', '');?> Cr</td>
										<td><?php echo number_format((float)$DR_RMBAMOUNT, 2, '.', '');?> Dr</td>
										<td><?php echo number_format((float)$CR_RMBAMOUNT, 2, '.', '');?> Cr</td>
										<td><?php echo number_format((float)$CLOSE_BAL_DR_RMB, 2, '.', '');?> Dr</td>
										<td><?php echo number_format((float)$CLOSE_BAL_CR_RMB, 2, '.', '');?> Cr</td>
									</tr>
									<tr style="text-align:right;font-size:1.2em;">
										<td style="text-align:right;font-weight:bold;">INR</td>
										<td><?php echo number_format((float)$disOPEN_BAL_AMT_DR, 2, '.', '');?> Dr</td>
										<td><?php echo number_format((float)$disOPEN_BAL_AMT_CR, 2, '.', '');?> Cr</td>
										<td><?php echo number_format((float)$DR_AMT, 2, '.', '');?> Dr</td>
										<td><?php echo number_format((float)$CR_AMT, 2, '.', '');?> Cr</td>
										<td><?php echo number_format((float)$CLOSE_BAL_DR_AMT, 2, '.', '');?> Dr</td>
										<td><?php echo number_format((float)$CLOSE_BAL_CR_AMT, 2, '.', '');?> Cr</td>
									</tr>
									</tbody>
					
					</table>
				
					</form>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
     <!-- /.col-lg-12 -->
	</div>