<?php
$dispdate =  date('Y-m-d');
if(isset($_GET["dtto"]) && !empty($_GET["dtto"]))
{
	$dtto_DR  = " WHERE DR.VOUCHERDATE='" . $_GET["dtto"] . "'";
	$dtto_CR  = " WHERE CR.VOUCHERDATE='" . $_GET["dtto"] . "'";
	$dispdate =  $_GET["dtto"];
}
else
{
	$dtto_DR  = " WHERE DR.VOUCHERDATE='" . date('Y-m-d') . "'";
	$dtto_CR  = " WHERE CR.VOUCHERDATE='" . date('Y-m-d') . "'";
}

$drHTML='';
$drSRNO=1;
$DR_AMT=0;

$crHTML='';
$crSRNO=1;
$CR_AMT=0;
if(isset($_POST["print-daybook"]))
{
	$dtto_DR  = " WHERE DR.VOUCHERDATE='" . $_POST["dtpENDDATE"] . "'";
	$dtto_CR  = " WHERE CR.VOUCHERDATE='" . $_POST["dtpENDDATE"] . "'";	
	$dispdate =  $_POST["dtpENDDATE"];
}

	$DRArr = Array();
	array_push($DRArr,"L.LEDGERID");
	array_push($DRArr,"L.LEDGERNAME");
	array_push($DRArr,"DR.*");
	
	$resDR = getData(LEDGER,$DRArr," AS L  INNER JOIN ".LEDGER_DEBIT." AS DR ON DR.LEDGERID=L.LEDGERID " .$dtto_DR . " ORDER BY DR.SRNO");
	while($resDRdata = mysqli_fetch_assoc($resDR))
	{
		$drHTML.='<tr>
						<td>'.$drSRNO++.'</td>
						<td>'.$resDRdata["VOUCHERNO"].'</td>
						<td>'.$resDRdata["VOUCHERTYPE"].'</td>
						<td>'.$resDRdata["LEDGERNAME"].'</td>
						<td style="text-align:right;">'. getCurrFormat($resDRdata["AMOUNT"]).'</td>
				</tr>';
		$DR_AMT +=$resDRdata["AMOUNT"];
	}
	
	$CRArr = Array();
	array_push($CRArr,"L.LEDGERID");
	array_push($CRArr,"L.LEDGERNAME");
	array_push($CRArr,"CR.*");
	
	$resCR = getData(LEDGER,$CRArr," AS L  INNER JOIN ".LEDGER_CREDIT." AS CR ON CR.LEDGERID=L.LEDGERID " .$dtto_CR . " ORDER BY CR.SRNO");
	while($resCRdata = mysqli_fetch_assoc($resCR))
	{
		$crHTML.='<tr>
						<td>'.$crSRNO++.'</td>
						<td>'.$resCRdata["VOUCHERNO"].'</td>
						<td>'.$resCRdata["VOUCHERTYPE"].'</td>
						<td>'.$resCRdata["LEDGERNAME"].'</td>
						<td style="text-align:right;">'. getCurrFormat($resCRdata["AMOUNT"]).'</td>
				</tr>';
		$CR_AMT +=$resCRdata["AMOUNT"];
	}
	$diff = $DR_AMT-$CR_AMT;
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Day Book</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmledgertable" id="frmdaybooktable" action="<?php echo SITEURL; ?>?print-daybook" method="POST">
					<button type="submit" class="btn btn-default" style="float: right;margin-left:10px;" name="print-daybook" id="printdaybook">Submit Button</button>
					<button type="submit" class="btn btn-danger" style="float: right;" name="print-daybook-pdf" id="printdaybookpdf"><i class="fa fa-file-pdf-o"></i> Make PDF</button>
					
					<input type="hidden" class="form-control" name="ENDDATE"  value="<?php echo isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : '';?>">		
					
					<div class="form-group">
							<table width="50%" class="inputfieldtable">
								<tr>
									<td ><label>Date</label></td>
									
									<td>
										<input type="date" class="form-control" name="dtpENDDATE" id="dtpENDDATE" value="<?php echo isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : $dispdate;?>">
									</td>
								</tr>
							</table>
					</div>
					<div class="dataTable_wrapper">
					
					<table width="100%" class="table table-striped table-bordered table-hover">
						<tr>
							
									<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Day Book as at <?php echo getDateFormat($dispdate);?></h5></td>
								</tr>
						<tr>
							<td> 
							<table width="100%" class="table table-striped table-bordered table-hover">
								<thead>
								
									<tr>
										
										<th colspan="4" style="text-align:center;">Debit</th>		
									</tr>
									<tr>
										<th>No</th>
										<th>V No</th>
										<th>V Type</th>
										<th>Name</th>
										<th>Amount</th>
									</tr>
								 </thead>
								<tbody>
								<?php
								echo $drHTML;
								
								?>   
											<tr class="<?php echo $classname;?>">
															<td style="text-align:right;" colspan="2"></td>
															<td style="text-align:right;">Total:</td>
													<td style="text-align:right;"><?php echo  number_format((float)$DR_AMT, 2, '.', '');?></td>
												</tr>				
								</tbody>
							</table>
						</td>
						
							<td>	
								<table  width="100%" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>											
											<th colspan="4" style="text-align:center;">Credit</th>		
										</tr>
										<tr>
											
											
											<th>No</th>
											<th>V No</th>
											<th>V Type</th>
											<th>Name</th>
											<th>Amount</th>
										</tr>
									 </thead>
									<tbody>
									<?php
									echo $crHTML;
								
								?>     
										<tr class="<?php echo $classname;?>">
													<td style="text-align:right;" colspan="2"></td>
													<td style="text-align:right;">Total:</td>
													<td style="text-align:right;"><?php echo number_format((float)$CR_AMT, 2, '.', '');?></td>
													
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
	


	

	

	