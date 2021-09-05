<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Loan Schedual</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<div>

	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="panel-body" id="displayledger" style="">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example1">
						<thead>
							<tr>
								<th>Group Name:</th>
								<th colspan="6">
									<?php										
										$res = getData(ACGROUP,$AllArr," WHERE GROUPID IN (23) AND FLAG='0'");
										while($resdata = mysqli_fetch_assoc($res))
										{
											echo $resdata["GROUPNAME"];
										}
								?> 							
								</th>	
							</tr>
							<tr>		
								<th>Opening Date</th>
																
								<th>Closing Balance</th>
								<th>Today Date</th>
								<th>%</th>
								<th>Days</th>
								<th>Interest Amt</th>
									
							</tr>
						</thead>
						<tbody>
						<?php
							$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID IN (23)");
							while($resledgerdata = mysqli_fetch_assoc($resledger))
							{
								?>
							
							
								<tr>
									
									<td><a href="<?php echo SITEURL."?print-ledger&lid=".$resledgerdata["LEDGERID"]?>" target="_blank"><?php echo $resledgerdata["LEDGERNAME"];?></a></td>
									
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<?php
								$loandate = getFieldDetail(LEDGER_CREDIT,"MIN(VOUCHERDATE)"," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."'");
								$INTPERYEAR = $resledgerdata["INTERESTPER"];
								$date1 = $loandate; //$resledgerdata["LOANDATE"];
								$date2 = date('Y-m-d');								
								$date1Time = strtotime($date1);
								$date2Time = strtotime($date2);
								$difference=ceil(abs($date2Time - $date1Time) / 86400)+1;
								$idx = 1;
								$loanamount = 0;
								$INTPER = $INTPERYEAR  / 365;
								//echo "<br>";
								$bal_arr = getClosingBalanceonearg($resledgerdata["LEDGERID"]);	
								
								$AMTARR = getClosingBalanceledger($date1,$date1,$resledgerdata["GROUPID"],$resledgerdata["LEDGERID"]);
								$loanamount = round($AMTARR[0],2);
								$intamt = ($loanamount * $INTPER) / 100;
								$nextdate = $date1;
								while($idx < $difference)
								{
									$date1 = date('Y-m-d', strtotime($date1. ' + 1 days'));
									$AMTARR = getClosingBalanceledger($date1,$date1,$resledgerdata["GROUPID"],$resledgerdata["LEDGERID"]);
									$temploanamt = round($AMTARR[0],2);
									
									if($temploanamt == $loanamount)
									{
									
									}
									else
									{
										
										
										$AMTARR1 = getClosingBalanceledger($nextdate,$nextdate,$resledgerdata["GROUPID"],$resledgerdata["LEDGERID"]);
										$loanamount = $temploanamt;
										 
										$nextdateTime = strtotime($nextdate);
										$date1_Time = strtotime($date1);
										$difference_disp=ceil(abs($nextdateTime - $date1_Time) / 86400);
										$INTPER = ($INTPERYEAR  * $difference_disp ) / 365;
										$intamt = ($AMTARR1[0] * $INTPER) / 100;
										 
										?>
										<tr>
										
											<td><?php echo $idx > 1 ? getDateFormat($nextdate) : "" ;?></td>
										
											<td style="text-align:right;"><?php echo number_format((float)$AMTARR1[0], 2, '.', '');?> <?php echo $AMTARR1[1];?></td>
											<td><?php echo getDateFormat($date1);?></td>
											<td style="text-align:right;"><?php echo round($INTPER,2);	?></td>
											<td><?php echo $difference_disp;	?></td>
											<td style="text-align:right;"><?php echo round($intamt,2);	?></td>
											
										</tr>
										<?php
										$nextdate = $date1;
										
									}
									
									
									$intamt += ($loanamount * $INTPER) / 100;
									$idx++;
								}
								 
								?>
								
								<?php
							}
							?>                                        
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>
	
	</div>

</div>