<?php
$DR_AMT = 0;
$CR_AMT=0;
$OPEN_BAL=0;
$disOPEN_BAL=0;
if(isset($_POST["print-salegst"]))
{
	$PurchasegstArr = Array();
	array_push($PurchasegstArr,"P.VOUCHERDATE");
	array_push($PurchasegstArr,"P.INVOICECHAR");
	array_push($PurchasegstArr,"L.LEDGERNAME");
	array_push($PurchasegstArr,"L.STATE");
	array_push($PurchasegstArr,"L.STATECODE");
	array_push($PurchasegstArr,"P.FINALTOTAL");
	array_push($PurchasegstArr,"P.IGSTAMT");
	array_push($PurchasegstArr,"P.CGSTAMT");
	array_push($PurchasegstArr,"P.SGSTAMT");
	array_push($PurchasegstArr,"P.TCSAMT");
	array_push($PurchasegstArr,"P.GRANDAMOUNT");
	$dtfrm = $_POST["dtpFROMDATE"];
	$dtto = $_POST["dtpENDDATE"];
	$res_dr = getData(PURCHASESALE,$PurchasegstArr,"  AS P left JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID  WHERE P.VOUCHERTYPE='Sale' AND P.BILLSTATUS='With Bill'  AND P.VOUCHERDATE BETWEEN '".$dtfrm."' and '".$dtto."' ");
	$drcnt = mysqli_num_rows($res_dr);
	$maxcnt = $drcnt;
	
}

	
			
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Sale GST</h1>
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
				 <form name="frmledgertable" id="frmledgertable" action="<?php echo SITEURL; ?>?print-salegst" method="POST">
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
								<button type="submit" class="btn btn-default" style="float: right;margin-left:10px;" name="print-salegst">Submit Button</button>
								<button type="submit" class="btn btn-danger" style="float: right;" name="print-salegst-pdf" id="printledgerpdf"><i class="fa fa-file-pdf-o"></i> Make PDF</button>
								<br/><br>
								</div>
						</div>
					
					
					<div class="dataTable_wrapper">
					<table width="100%" class="table table-striped table-bordered table-hover">
					<?php
					if(isset($_POST["print-salegst"]))
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
								<table width="100%" class="table table-striped table-bordered table-hover">
								<thead>
									
									<tr>
										
										<th>Date</th>	
										<th>Invoice No</th>
										<th>Account</th>
										<th>State</th>
										<th>Final Amount</th>
										<th>IGST</th>
										<th>CGST</th>
										<th>SGST</th>
										<th>TCS</th>
										<th>Grand Amount</th>
									</tr>
								 </thead>
								<tbody>
										
								<?php
								if(isset($_POST["print-salegst"]))
								{
									$SRNO_CNT = 1;
									$DR_AMT = 0;
							
									while($resdata = mysqli_fetch_assoc($res_dr))
										{
											$classname = ($SRNO_CNT / 2) == 0 ? 'odd gradeX' :'even gradeC';
											$DR_AMT += $resdata["GRANDAMOUNT"];
											?>
												<tr class="<?php echo $classname;?>">
													
													
													<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
													<td><?php echo $resdata["INVOICECHAR"];?></td>
													<td><?php echo $resdata["LEDGERNAME"];?></td>
													<td><?php echo $resdata["STATECODE"];?>-<?php echo $resdata["STATE"];?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["FINALTOTAL"], 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["IGSTAMT"], 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["CGSTAMT"], 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["SGSTAMT"], 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["TCSAMT"], 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$resdata["GRANDAMOUNT"], 2, '.', '');?></td>
												</tr>
											<?php
										}
									if($maxcnt >= $SRNO_CNT)
									{
										for($i= $SRNO_CNT ; $i<=$maxcnt ; $i++)
										{
											$classname = ($i / 2) == 0 ? 'odd gradeX' :'even gradeC';
											?>
											
											<?php
										}
									}
								}
									
								?>   
											<tr class="<?php echo $classname;?>">
													<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
															
															
															<td style="text-align:right;">Total:</td>
													<td style="text-align:right;"><?php echo  number_format((float)$DR_AMT, 2, '.', '');?></td>
												</tr>								
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


	
