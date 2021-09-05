<?php
$resPur_STRING = "";
$resSal_STRING = "";
if(isset($_GET["_vidsale"]))
{
	$action = "viewsale";
}
elseif(isset($_GET["_vidpurchase"]))
{
	$action = "viewpurchase";
}

if ($view_bol)
{

	if(isset($_POST["print-purchase"]))
	{
		//ECHO $_POST["print-purchase"];
		$dtfrm = $_POST["dtpFROMDATE"];
		$dtto = $_POST["dtpENDDATE"];
		
								
		$FieldArr_PUR= array();
								array_push($FieldArr_PUR,"ID");
								array_push($FieldArr_PUR,"P.VOUCHERDATE");
								array_push($FieldArr_PUR,"DUEDAYS");
								array_push($FieldArr_PUR,"DUEDATE");
								array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_PUR,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_PUR,"LOCATIONNAME");
								array_push($FieldArr_PUR,"CONVRATE");
								array_push($FieldArr_PUR,"FINALTOTAL");
								array_push($FieldArr_PUR,"CGSTPER");
								array_push($FieldArr_PUR,"IGSTPER");
								array_push($FieldArr_PUR,"SGSTPER");
								array_push($FieldArr_PUR,"CGSTAMT");
								array_push($FieldArr_PUR,"IGSTAMT");
								array_push($FieldArr_PUR,"SGSTAMT");
								array_push($FieldArr_PUR,"GRANDAMOUNT");
								array_push($FieldArr_PUR,"PARTNERAMOUNT");
								array_push($FieldArr_PUR,"LASTAMOUNT");
								
		array_push($FieldArr_PUR,"P.LEDGERID");
		$resPur_STRING = " AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0' AND DATE_FORMAT(VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'";
		$STRCAPTION="<center><h4>Purchase From " . getDateFormat($_POST["dtpFROMDATE"]) ." To " .getDateFormat($_POST["dtpENDDATE"])."</h4></center>";
		$xlsaction="&frmdate=".$_POST["dtpFROMDATE"]."&tdate=".$_POST["dtpENDDATE"];
	}
	else
	{
		$FieldArr_PUR= array();
								array_push($FieldArr_PUR,"ID");
								array_push($FieldArr_PUR,"P.VOUCHERDATE");
								array_push($FieldArr_PUR,"DUEDAYS");
								array_push($FieldArr_PUR,"DUEDATE");
								array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_PUR,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_PUR,"LOCATIONNAME");
								array_push($FieldArr_PUR,"CONVRATE");
								array_push($FieldArr_PUR,"FINALTOTAL");
								array_push($FieldArr_PUR,"CGSTPER");
								array_push($FieldArr_PUR,"IGSTPER");
								array_push($FieldArr_PUR,"SGSTPER");
								array_push($FieldArr_PUR,"CGSTAMT");
								array_push($FieldArr_PUR,"IGSTAMT");
								array_push($FieldArr_PUR,"SGSTAMT");
								array_push($FieldArr_PUR,"GRANDAMOUNT");
								array_push($FieldArr_PUR,"P.LEDGERID");
								array_push($FieldArr_PUR,"PARTNERAMOUNT");
								array_push($FieldArr_PUR,"LASTAMOUNT");
								//$resPur = getData(PURCHASESALE,$FieldArr_PUR," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND  OPENSTATUS='0'");
					$resPur_STRING=" AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND  OPENSTATUS='0'";
		$STRCAPTION="";
		$xlsaction="";
	}
	if(isset($_POST["print-sale"]))
	{
		$dtfrm = $_POST["dtpSALFROMDATE"];
		$dtto = $_POST["dtpSALENDDATE"];
		$FieldArr_PUR= array();
								array_push($FieldArr_PUR,"ID");
								array_push($FieldArr_PUR,"P.VOUCHERDATE");
								array_push($FieldArr_PUR,"DUEDAYS");
								array_push($FieldArr_PUR,"DUEDATE");
								array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_PUR,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_PUR,"LOCATIONNAME");
								array_push($FieldArr_PUR,"CONVRATE");
								array_push($FieldArr_PUR,"FINALTOTAL");
								array_push($FieldArr_PUR,"CGSTPER");
								array_push($FieldArr_PUR,"IGSTPER");
								array_push($FieldArr_PUR,"SGSTPER");
								array_push($FieldArr_PUR,"CGSTAMT");
								array_push($FieldArr_PUR,"IGSTAMT");
								array_push($FieldArr_PUR,"SGSTAMT");
								array_push($FieldArr_PUR,"GRANDAMOUNT");
								array_push($FieldArr_PUR,"P.LEDGERID");
								array_push($FieldArr_PUR,"PARTNERAMOUNT");
								array_push($FieldArr_PUR,"LASTAMOUNT");
		$resSal_STRING=" AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Sale' AND DATE_FORMAT(VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'";
		$salSTRCAPTION="<center><h4>Sale From " .  getDateFormat($_POST["dtpSALFROMDATE"]) ." To " .getDateFormat($_POST["dtpSALENDDATE"])."</h4></center>";				
		$SALxlsaction="&frmdate=".$_POST["dtpSALFROMDATE"]."&tdate=".$_POST["dtpSALENDDATE"];
	}
	else
	{
			$FieldArr_PUR= array();
								array_push($FieldArr_PUR,"ID");
								array_push($FieldArr_PUR,"P.VOUCHERDATE");
								array_push($FieldArr_PUR,"DUEDAYS");
								array_push($FieldArr_PUR,"DUEDATE");
								array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_PUR,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_PUR,"LOCATIONNAME");
								array_push($FieldArr_PUR,"CONVRATE");
								array_push($FieldArr_PUR,"FINALTOTAL");
								array_push($FieldArr_PUR,"CGSTPER");
								array_push($FieldArr_PUR,"IGSTPER");
								array_push($FieldArr_PUR,"SGSTPER");
								array_push($FieldArr_PUR,"CGSTAMT");
								array_push($FieldArr_PUR,"IGSTAMT");
								array_push($FieldArr_PUR,"SGSTAMT");
								array_push($FieldArr_PUR,"GRANDAMOUNT");
								array_push($FieldArr_PUR,"P.LEDGERID");
								array_push($FieldArr_PUR,"PARTNERAMOUNT");
								array_push($FieldArr_PUR,"LASTAMOUNT");
								//$resSal = getData(PURCHASESALE,$FieldArr_PUR," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Sale'");
				$resSal_STRING=" AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Sale'";
			$salSTRCAPTION="";
	$SALxlsaction="";			
	}
	?>
	<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
     <!-- /.col-lg-12 -->
</div>
<?php
$sumwgt_pur = getFieldDetail(BARCODE_PROCESS,"count(PCS)"," WHERE PROCESSTYPE='Purchase'");
//print_r($sumwgt_pur);
//$sumwgt_sal = getFieldDetail(PURCHASESALE,"count(PCS)"," WHERE VOUCHERTYPE='sale'");
//$sumwgt_sal = getFieldDetail(PURCHASESALE,"SUM(if(VOUCHERTYPE = 'sale',ISSUEWEIGHT,WEIGHT))"," WHERE SIZENAME !='' AND VOUCHERTYPE in ('Polish Receive','Rough Re-Sale')");

//$sumwgt_R = $sumwgt_pur-$sumwgt_sal;
?>
<div class="row">
	<div class="col-lg-4 col-md-4">
        <div class="panel panel-green">
			<div class="panel-heading">
                 <div class="row">
                    <div class="col-xs-3">
						<i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $sumwgt_pur;?> crt</div>
                        <div>Current Stock</div>
                    </div>
                </div>
            </div>
             <a href="<?php echo SITEURL; ?>?filter">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
            </a>
        </div>
    </div>
</div>

 <div class="row">
 <div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <h3 class="page-header">Purchase
									<a href="<?php echo SITEURL; ?>makexls.php?makexls=dashboard_p_2<?php echo $xlsaction;?>" onclick="return confirm('Do you really want to Make XLS);" class="btn btn-success btn-circle" title="XLS">
														<i class="fa fa-file-excel-o"></i>
													</a>
						<?php
						if($action=="")
						{
								if($view_bol)
								{
									?>
									<a class="btn btn-primary" href="<?php echo SITEURL; ?>?dashboard&_vidpurchase"><i class="fa fa-tasks"></i> View</a>
									<?php
								}
						
						}?>
				</h3>
					<form action="<?php echo SITEURL."?dashboard"?>" method="post">	
						
						<input type="hidden" class="form-control" name="FROMDATE" value="<?php echo isset($_POST["dtpFROMDATE"]) ? $_POST["dtpFROMDATE"] : '';?>">
						<input type="hidden" class="form-control" name="ENDDATE"  value="<?php echo isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : '';?>">
						
						<div class="row form-group">
							<div class="col-lg-2">
									<label>Date</label>
									<input type="date" class="form-control" name="dtpFROMDATE" id="dtpFROMDATE" value="<?php echo date('Y-m-d');?>">
						
							</div>
							<div class="col-lg-2">
									<label>&nbsp;</label>
									<input type="date" class="form-control" name="dtpENDDATE" id="dtpENDDATE" value="<?php echo date('Y-m-d');?>">
						
							</div>
							<div class="col-lg-4">
							<br>
									<button type="submit" class="btn btn-default" style="margin-bottom:10px;" name="print-purchase">Submit Button</button>
						
							</div>
						</div>
					</form>
					
					<?php if($action == "viewpurchase")
					{
						echo $STRCAPTION;?>
					<div class="dataTable_wrapper customResponsiveTable">
						 <?php echo $back_button;?>
						 <br>
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Id</th>	
									<th>Dt</th>	
									<th>Due Dt</th>
									<th>Stock Id</th>
									<th>Party</th>
									<th>Broker</th>
									<th>$</th>
									<th>Final Total</th>
									<th>GST</th>
									<th>Last Total</th>
									<th>Paid</th>
									<th>Due</th>
									<?php
									if(isset($_SESSION["adminuser"]))
															{
									?><th>Clear</th>
									<?php
															}?>
								</tr>
							 </thead>
							<tbody>
							
						<?php
							$idx = 1;
							$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' and LEDGERID IN (SELECT LEDGERID FROM ".PURCHASESALE." WHERE VOUCHERTYPE='Purchase' and DUEDATE <= CURDATE())");
							while($resledgerdata = mysqli_fetch_assoc($resledger))
							{
								$resPur = getData(PURCHASESALE,$FieldArr_PUR,$resPur_STRING ." AND L.LEDGERID='".$resledgerdata["LEDGERID"]."'");
								$totalpaid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."'");
								while($resdata = mysqli_fetch_assoc($resPur))
								{
									$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ', ')" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."' AND ID='".$resdata["ID"]."' AND FLAG='0' AND PROCESSTYPE='Purchase'");
									$GRANDAMOUNT = $resdata["LASTAMOUNT"];
									if($totalpaid > 0 )
									{
										$paid = $totalpaid;
										$totalpaid = $totalpaid - $GRANDAMOUNT ;
										$due=$GRANDAMOUNT-$paid;
									}
									else
									{
										$paid = $totalpaid > 0 ?$totalpaid :0;
										$due = $GRANDAMOUNT;
									}
									if($due > 5)
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										$dueclassname = "";
										$styledue = "";
										$days8 = date('Y-m-d', strtotime("+8 days"));
										if($resdata["DUEDATE"] <= date('Y-m-d'))
										{
											$dueclassname = " reddue";
										}
										elseif($days8 < $resdata["DUEDATE"])
										{
											$styledue = " display:none;";
										}
												?>
										<tr class="<?php echo $classname.$dueclassname;?> " style="<?php echo $styledue;?>">
										<td class="open_custom_overlay" rel="<?php echo $resdata["ID"];?>-pur"><a href="javascript:void(0)" style="color:#fff;"><?php echo $resdata["ID"];?></a></td>
										<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
										<td><?php echo getDateFormat($resdata["DUEDATE"])."(".$resdata["DUEDAYS"].")";?></td>
										<td  width="15%"><?php echo $BARCODENO;?></td>
										<td><?php echo $resdata["PARTY"];?></td>
										<td><?php echo $resdata["BROKER"];?></td>
										<td class="amountalign"><?php echo getCurrFormat($resdata["CONVRATE"]) ;?></td>
										<td class="amountalign"><?php echo getCurrFormat($resdata["FINALTOTAL"]);?></td>
										<td class="amountalign"><?php echo $resdata["IGSTAMT"] > 0 ? getCurrFormat($resdata["IGSTAMT"]) : getCurrFormat(($resdata["SGSTAMT"]+$resdata["CGSTAMT"]));?></td>
										<td class="amountalign"><?php echo getCurrFormat0($resdata["LASTAMOUNT"]);?></td>
										<td class="amountalign"><?php echo getCurrFormat($paid) ;?></td>
										<td class="amountalign"><?php echo getCurrFormat0($due);?></td>
										<?php
											if(isset($_SESSION["adminuser"]))
											{
										?>
										<td class="clearid" rel="<?php echo $resdata["ID"];?>-Purchase-<?php echo $due."-".$resdata["LEDGERID"] ;?>">
										<?PHP
											if($due < 100)
											{
										?>
										<a href="javascript:void(0)" style="color:#000;">Click Here</a>
										<?php
											}
										?>
										</td>
										<?php
											}
										?>
										</tr>
										<?php
											}
											
										}
									}
								
						?>
				</tbody>
			</table>
			</div>
			<?php
					}?>

			
          </div>
		</div>
</div>		     
</div>
 <div class="row">
 <div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				  <h3 class="page-header">Sale
				  <a href="<?php echo SITEURL; ?>makexls.php?makexls=dashboard_s_1<?php echo $SALxlsaction;?>" onclick="return confirm('Do you really want to Make XLS;" class="btn btn-success btn-circle" title="XLS">
														<i class="fa fa-file-excel-o"></i>
				</a>
					<?php
					if($action=="")
						{
						if($view_bol)
						{
							?>
								<a class="btn btn-primary" href="<?php echo SITEURL; ?>?dashboard&_vidsale"><i class="fa fa-tasks"></i> View</a>
								<?php
						}
					}?>
				  </h3>
				  
				
				  <form action="<?php echo SITEURL."?dashboard"?>" method="post">	
						
						<input type="hidden" class="form-control" name="SALFROMDATE" value="<?php echo isset($_POST["dtpSALFROMDATE"]) ? $_POST["dtpSALFROMDATE"] : '';?>">
						<input type="hidden" class="form-control" name="SALENDDATE"  value="<?php echo isset($_POST["dtpSALENDDATE"]) ? $_POST["dtpSALENDDATE"] : '';?>">
						<div class="row form-group">
							<div class="col-lg-2">
									<label>Date</label>
									<input type="date" class="form-control" name="dtpSALFROMDATE" id="dtpSALFROMDATE" value="<?php echo date('Y-m-d');?>">
						
							</div>
							<div class="col-lg-2">
									<label>&nbsp;</label>
									<input type="date" class="form-control" name="dtpSALENDDATE" id="dtpSALENDDATE" value="<?php echo date('Y-m-d');?>">
						
							</div>
							<div class="col-lg-4">
							<br>
									<button type="submit" class="btn btn-default" style="margin-bottom:10px;" name="print-sale">Submit Button</button>
							
							</div>
						</div>
					
						
						
					</form>
					<?php if($action == "viewsale")
					{
					 echo $salSTRCAPTION;?>
				 <div class="dataTable_wrapper customResponsiveTable">
						 <?php echo $back_button;?>
						 <br>
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
							<thead>
								<tr>
									<th>Id</th>	
									<th>Dt</th>	
									<th>Due Dt</th>
									<th>Stock Id</th>
									<th>Party</th>
									<th>Broker</th>
									<th>$</th>
									<th>Final Total</th>
									<th>GST</th>
									<th>Last Total</th>
									<th>Paid</th>
									<th>Due</th>
									<?php
									if(isset($_SESSION["adminuser"]))
															{
									?><th>Clear</th>
									<?php
															}?>
								</tr>
							 </thead>
							<tbody>
							
						<?php
							$idx = 1;
								
								
							$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' and LEDGERID IN (SELECT LEDGERID FROM ".PURCHASESALE." WHERE VOUCHERTYPE='Sale' and DUEDATE <= CURDATE())");
								while($resledgerdata = mysqli_fetch_assoc($resledger))
								{
									
									$resSal = getData(PURCHASESALE,$FieldArr_PUR,$resSal_STRING ." AND L.LEDGERID='".$resledgerdata["LEDGERID"]."'");
										
									$totalpaid= getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."'");
										
									while($resdata = mysqli_fetch_assoc($resSal))
									{
											$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ', ')" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."' AND ID='".$resdata["ID"]."' AND FLAG='0' AND PROCESSTYPE='Sale'");
											$GRANDAMOUNT = $resdata["LASTAMOUNT"];
											//$totalpaid = $totalpaid - $GRANDAMOUNT ;
											if($totalpaid > 0 )
											{
													$paid = $totalpaid;
													$totalpaid = $totalpaid - $GRANDAMOUNT ;
											
													$due=$GRANDAMOUNT-$paid;
											}
											else
											{
												
												$paid = $totalpaid > 0 ?$totalpaid :0;
												$due = $GRANDAMOUNT;
											}
											if($due > 5)
											{
												
											$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
											$dueclassname = "";
											$styledue = "";
											$days8 = date('Y-m-d', strtotime("+8 days"));
											
											if($resdata["DUEDATE"] <= date('Y-m-d'))
											{
												$dueclassname = " reddue";
											}
											
											if($days8 < $resdata["DUEDATE"] || $due==0)
											{
												$styledue = " display:none;";
											}
										?>
											<tr class="<?php echo $classname.$dueclassname;?> " style="<?php echo $styledue;?>">
												<td class="open_custom_overlay" rel="<?php echo $resdata["ID"];?>-pur"><a href="javascript:void(0)" style="color:#fff;"><?php echo $resdata["ID"];?></a></td>
												<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
												<td><?php echo getDateFormat($resdata["DUEDATE"])."(".$resdata["DUEDAYS"].")";?></td>
												<td width="15%"><?php echo $BARCODENO;?></td>
												<td><?php echo $resdata["PARTY"];?></td>
												<td><?php echo $resdata["BROKER"];?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["CONVRATE"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["FINALTOTAL"]);?></td>
												<td class="amountalign"><?php echo $resdata["IGSTAMT"] > 0 ? getCurrFormat($resdata["IGSTAMT"]) : getCurrFormat(($resdata["SGSTAMT"]+$resdata["CGSTAMT"]));?></td>
												<td class="amountalign"><?php echo getCurrFormat0($resdata["LASTAMOUNT"]);?></td>
												<td class="amountalign"><?php echo getCurrFormat($paid) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat0($due);?></td>
												<?php
													if(isset($_SESSION["adminuser"]))
													{
															
												?>
													<td class="clearid" rel="<?php echo $resdata["ID"];?>-Purchase-<?php echo $due."-".$resdata["LEDGERID"] ;?>">
													<?PHP
														if($due < 100)
														{
													?>
														<a href="javascript:void(0)" style="color:#000;">Click Here</a>
													<?php
														}
													?>
														</td>
													<?php
													}
												?>
											</tr>
										<?php
											}
									}
								}
								
			?>
			</tbody>
			</table>
			</div>
				<?php
				}?>				
	
				     </div>
		</div>
</div>		  
        
</div>

	<?php
}

if(isset($_SESSION["adminuser"]))
{
	
	?>
	<div class="row">
 <div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-body">
				 <h3 class="page-header">Account List</h3>
						
					
		 </div>
		 <div class="panel-body">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example1">
							<thead>
							
								<tr>							
									<th>Ledger Name</th>
									<th>Closing Balance</th>
									<?php
									if(isset($_SESSION["adminuser"]))
															{
									?><th>Clear</th>
									<?php
															}?>
								</tr>
							 </thead>
							<tbody>
							<?php
									$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID NOT IN (9,10,11,12,13,18)");
									while($resledgerdata = mysqli_fetch_assoc($resledger))
										{
											$bal_arr = getClosingBalanceonearg($resledgerdata["LEDGERID"]);	
											if(round($bal_arr[0],2) > 0 && round($bal_arr[0],2) < 100)
											{
												?>
													<tr>
													
													<td><a href="<?php echo SITEURL."?print-ledger&lid=".$resledgerdata["LEDGERID"]?>" target="_blank"><?php echo $resledgerdata["LEDGERNAME"];?></a></td>
													<td style="text-align:right;"><?php echo number_format((float)$bal_arr[0], 2, '.', '');?> <?php echo $bal_arr[1];?></td>
														<td class="clearid_ledger"  rel="<?php echo $resledgerdata["LEDGERID"];?>-<?php echo $bal_arr[1];?>-<?php echo $bal_arr[0];?>">
															
															<?PHP
															
															if(round($bal_arr[0],2) > 0 && round($bal_arr[0],2) < 100)
															{
																?>
																<a href="javascript:void(0)" style="color:#000;">Click Here</a>
																<?php
															}
															?>
															</td>
													</tr>
												<?php
											}
										
										}
							?>                                        
							</tbody>
						</table>
		 </div>
		</div>
</div>		  
        
</div>
	<?php
}
?>