<?php
$DR_AMT = 0;
$CR_AMT=0;
$OPEN_BAL=0;
$disOPEN_BAL=0;
if(isset($_POST["print-purchasegst"]))
{
	$PurchasegstArr = Array();
	array_push($PurchasegstArr,"P.VOUCHERDATE");

	$dtmonth = $_POST["dtpmonth"];
	$dtyear = $_POST["dtpyear"];
		
	$res_dr = getData(LEDGER_DEBIT,$PurchasegstArr,"  AS P  WHERE date('m-Y',strtotime(P.VOUCHERDATE)) BETWEEN '".$dtmonth."' and '".$dtyear."' ");
	$drcnt = mysqli_num_rows($res_dr);
	

	
}		
?>


<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">GST Summary</h1>
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
				 <form name="frmledgertable" id="frmledgertable" action="<?php echo SITEURL; ?>?print-GSTSummary" method="POST">
					<input type="HIDDEN" class="form-control" name="dtpmonth" value="<?php echo isset($_POST["month"]) ? $_POST["month"] : '';?>">
					<input type="HIDDEN" class="form-control" name="dtpyear"  value="<?php echo isset($_POST["year"]) ? $_POST["year"] : '';?>">
					
					<div class="form-group">
							<table width="50%" class="inputfieldtable">
								<tr>
									<td ><label>Date</label></td>
									
									<td>
										 <select  type="date" class="form-control" name="month" id="month">
												<option value=""> Select Month </option>
												<option value="01">01</option>
												<option value="02"> 02 </option>
												<option value="03"> 03 </option>
												<option value="04"> 04 </option>
												<option value="05"> 05 </option>
												<option value="06"> 06</option>
												<option value="07"> 07 </option>
												<option value="08"> 08 </option>
												<option value="09"> 09 </option>
												<option value="10"> 10 </option>
												<option value="11"> 11 </option>
												<option value="12"> 12 </option>
		
											</select>
										</td>
										<td>
											 <select type="date"  class="form-control" name="year" id="year">
											<option value=""> Select Year</option>
												<option value="2017"> 2017 </option>
												<option value="2018"> 2018 </option>
											</select>
									</td>
								
								</tr>
							
							</table>
							<div class="form-group">
								<button type="submit" class="btn btn-default" style="float: right;margin-left:10px;" name="print-GSTSummary" id="printledger">Submit Button</button>
								<button type="submit" class="btn btn-danger" style="float: right;" name="print-GSTSummary-pdf" id="printledgerpdf"><i class="fa fa-file-pdf-o"></i> Make PDF</button>
								<br/><br>
								</div>
						</div>
					
					
					<div class="dataTable_wrapper">
					<table width="100%" class="table table-striped table-bordered table-hover">
					<?php
					if(isset($_POST["print-GSTSummary"]))
								{
									$totalpurchase = getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)"," WHERE VOUCHERTYPE='Tax In' AND TAXSTATUS=0 AND DATE_FORMAT(VOUCHERDATE,'%m-%Y') = '".$_POST["month"]."-".$_POST["year"]."' ");$totalpurchaseTCS = getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)"," WHERE VOUCHERTYPE='TCS In' AND TAXSTATUS=0 AND DATE_FORMAT(VOUCHERDATE,'%m-%Y') = '".$_POST["month"]."-".$_POST["year"]."' ");
									$totalsale = getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)"," WHERE VOUCHERTYPE='Tax Out' AND TAXSTATUS=0 AND DATE_FORMAT(VOUCHERDATE,'%m-%Y') = '".$_POST["month"]."-".$_POST["year"]."' ");$totalsaleTCS = getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)"," WHERE VOUCHERTYPE='TCS Out' AND TAXSTATUS=0 AND DATE_FORMAT(VOUCHERDATE,'%m-%Y') = '".$_POST["month"]."-".$_POST["year"]."' ");
									$totaljournalpurchasegst=getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)"," WHERE VOUCHERTYPE='Tax In'AND TAXSTATUS=1 AND DATE_FORMAT(VOUCHERDATE,'%m-%Y') = '".$_POST["month"]."-".$_POST["year"]."' ");
									$totaljournalsalegst=getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)"," WHERE VOUCHERTYPE='Tax Out' AND TAXSTATUS=1 AND DATE_FORMAT(VOUCHERDATE,'%m-%Y') = '".$_POST["month"]."-".$_POST["year"]."' ");
									$total=($totalpurchase+$totaljournalpurchasegst) - ($totalsale+$totaljournalsalegst);
									?>
									
									<tr>
										<td colspan="2" style="text-align:center;font-weight:bold;"><h5>Date: <?php echo  $_POST["month"];?>-<?php echo $_POST["year"];?></h5></td>
									</tr>
									<?php
								}
					?>
						
						<tr>
							<td> 
								<table width="100%" class="table table-striped table-bordered table-hover">
								<thead>
									
									<tr >
										
										
										<th>Purchase GST IN</th>
										<th>Journal Purchase GST IN</th>
										<th>Purchase TCS IN</th>
										<th>Sale GST OUT</th>
										<th>Journal Sale GST OUT</th>
										<th>Sale TCS OUT</th>
										<th>Total</th>
										
									</tr>
								 </thead>
								<tbody>
										
								<?php
								if(isset($_POST["print-GSTSummary"]))
								{
									
											?>
												<tr class="<?php echo $classname;?>">
													
													
													
													<td style="text-align:right;"><?php echo  number_format((float)$totalpurchase, 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$totaljournalpurchasegst, 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$totalpurchaseTCS, 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$totalsale, 2, '.', '');?></td>
													
													<td style="text-align:right;"><?php echo  number_format((float)$totaljournalsalegst, 2, '.', '');?></td>
													<td style="text-align:right;"><?php echo  number_format((float)$totalsaleTCS, 2, '.', '');?></td>
													
													<td style="text-align:right;"><?php echo  number_format((float)$total, 2, '.', '');?></td>
												</tr>
											<?php
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




	
