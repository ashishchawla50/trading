<?php
$DR_AMT = 0;
$CR_AMT=0;
$OPEN_BAL=0;
$DR_CNT=0;
$CR_CNT=0;
$DHTML ='';
	$CHTML ='';
if(isset($_POST["print-trialbalance"]))
{

	$dtto = $_POST["dtpENDDATE"];
	$TrialArr = Array();
	array_push($TrialArr,"L.LEDGERID");
	array_push($TrialArr,"L.LEDGERNAME");
	
	$TrialDRArr = Array();
	array_push($TrialDRArr,"LEDGERID");
	array_push($TrialDRArr,"SUM(DR.AMOUNT) AS DRAMOUNT");
	
	$TrialCRArr = Array();
	array_push($TrialCRArr,"LEDGERID");
	array_push($TrialCRArr,"SUM(CR.AMOUNT) AS CRAMOUNT");
	
	
	$resledger = getData(LEDGER,$TrialArr," AS L  WHERE L.FLAG='0' ORDER BY GROUPID");
		
	while($resledgerdata = mysqli_fetch_assoc($resledger))
	{
		$bal_arr = getClosingBalance($comp_fromdt,$dtto,$resledgerdata["LEDGERID"],FALSE);		 
		if( ($bal_arr[0] != 0 && $bal_arr[1] != '') )
		{
			if($bal_arr[1] == "Dr" )
			{
				$DHTML.='<tr>
														
														<td>'.$resledgerdata["LEDGERNAME"].'</td>
														<td style="text-align:right;">'. getCurrFormat($bal_arr[0]).'</td>
														
													</tr>';
				$DR_AMT +=$bal_arr[0];
				$DR_CNT+=1;
			}
			elseif($bal_arr[1] == "Cr" )
			{
				$CHTML.='<tr>
														
														<td>'.$resledgerdata["LEDGERNAME"].'</td>
														<td style="text-align:right;">'. getCurrFormat($bal_arr[0]).'</td>
														
													</tr>';
				$CR_AMT +=$bal_arr[0];
				$CR_CNT+=1;
			}
		}
		
	}
	
	if($DR_CNT >= $CR_CNT)
		$maxcnt = $DR_CNT;
	else
		$maxcnt = $CR_CNT;
	for($i= $CR_CNT ; $i<=$maxcnt ; $i++)
			{
				$CHTML.='<tr>
														<td>&nbsp;</td>
															<td>&nbsp;</td>
												</tr>';
										
									}
	for($i= $DR_CNT ; $i<=$maxcnt ; $i++)
			{
				$DHTML.='<tr>
														<td>&nbsp;</td>
															<td>&nbsp;</td>
												</tr>';
										
									}
						
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Trial Balance</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmledgertable" id="frmTRIALtable" action="<?php echo SITEURL; ?>print-pdf.php" method="POST" target="_blank">
					<button type="submit" class="btn btn-default" style="float: right;margin-left:10px;" name="print-trialbalance" id="printtrialbalance">Submit Button</button>
					<button type="submit" class="btn btn-danger" style="float: right;" name="print-trial-pdf" id="printtrialpdf"><i class="fa fa-file-pdf-o"></i> Make PDF</button>
					
					<input type="hidden" class="form-control" name="ENDDATE"  value="<?php echo isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : '';?>">		
					
					<div class="form-group">
							<table width="50%" class="inputfieldtable">
								<tr>
									<td ><label>Date</label></td>
									
									<td>
										<input type="date" class="form-control" name="dtpENDDATE" id="dtpENDDATE" value="<?php echo isset($_POST["dtpENDDATE"]) ? $_POST["dtpENDDATE"] : date('Y-m-d');?>">
									</td>
								</tr>
							</table>
					</div>
					<div class="dataTable_wrapper">
					
					<table width="100%" class="table table-striped table-bordered table-hover">
					<tr>
							
									<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Trial Balance as at <?php echo isset($_POST["print-trialbalance"]) ? getDateFormat($_POST["dtpENDDATE"]) : '';?></h5></td>
								</tr>
						<tr>
							<td> 
								<table width="100%" class="table table-striped table-bordered table-hover">
								<thead>
								
									<tr>
										
										<th colspan="6" style="text-align:center;">Debit</th>		
									</tr>
									<tr>
										
										
										<th>Name</th>
										<th>Amount</th>
									</tr>
								 </thead>
								<tbody>
								<?php
								echo $DHTML;
								
								?>   
											<tr class="">
													
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
											<th colspan="6" style="text-align:center;">Credit</th>		
										</tr>
										<tr>
											
											
											<th>Name</th>
											<th>Amount</th>
										</tr>
									 </thead>
									<tbody>
									<?php
								echo $CHTML;
								
								?>     
										<tr class="">
													
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
	


	

	

	