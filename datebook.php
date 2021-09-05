<?php
$dtto = "2014-10-31";
$dtto_DR  = " WHERE DR.VOUCHERDATE='" . date('Y-m-d') . "'";
$dtto_CR  = " WHERE CR.VOUCHERDATE='" . date('Y-m-d') . "'";
$HTML='';
$SRNO=1;
$DR_AMT=0;
$CR_AMT=0;
while($dtto <= date('Y-m-d'))
{
	$DRAMOUNT = getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)"," WHERE VOUCHERDATE='" . $dtto . "'");
	$CRAMOUNT = getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)"," WHERE VOUCHERDATE='" . $dtto . "'");
	if($DRAMOUNT!=$CRAMOUNT)
	{
		$HTML.='<tr>
						<td>'.$SRNO++.'</td>
						<td><a href="'.(SITEURL."?print-daybook&dtto=".$dtto).'" target="_blank">'.getDateFormat($dtto).'</a></td>
						<td style="text-align:right;">'. getCurrFormat($DRAMOUNT).'</td>
						<td style="text-align:right;">'. getCurrFormat($CRAMOUNT).'</td>
						<td style="text-align:right;">'. getCurrFormat($DRAMOUNT-$CRAMOUNT).'</td>
				</tr>';
		$DR_AMT+=$DRAMOUNT;
		$CR_AMT+=$CRAMOUNT;
	}
	$dtto = date('Y-m-d', strtotime($dtto. ' + 1 days'));
}

?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Date Wise Book</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmledgertable" id="frmdaybooktable" action="<?php echo SITEURL; ?>?print-datebook" method="POST">
					
			
						<div class="dataTable_wrapper">
					
							<table width="100%" class="table table-striped table-bordered table-hover">
									<thead>
									
										<tr>
											<th>No</th>
											<th>V Date</th>
											<th>Debit</th>
											<th>Credit</th>
											<th>Diff</th>
										</tr>
									 </thead>
									<tbody>
									<?php
									echo $HTML;
									
									?>   
												<tr class="<?php echo $classname;?>">
																<td style="text-align:right;" colspan="2">Total:</td>
																
														<td style="text-align:right;"><?php echo  number_format((float)$DR_AMT, 2, '.', '');?></td>
														<td style="text-align:right;"><?php echo  number_format((float)$CR_AMT, 2, '.', '');?></td>
														<td style="text-align:right;"><?php echo  number_format((float)($DR_AMT-$CR_AMT), 2, '.', '');?></td>
													</tr>				
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
	


	

	

	