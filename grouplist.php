
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Group List</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?grouplist" method="POST" onsubmit="return confirm('Do you really want to Delete selected Account Groups?');">
					
					<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								
								<tr>
									
									<th>Group Id</th>									
									<th>Group Name</th>
									<th>Amount</th>
									
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$dtfrm='2017-09-01';
								$dtto = date('Y-m-d');
								$res = getData(ACGROUP,$AllArr," WHERE FLAG='0'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										$bal_arr = getClosingBalance($dtfrm,$dtto,$resdata["GROUPID"],true);
										?>
											<tr class="<?php echo $classname;?>">
											
												<td><?php echo $resdata["GROUPID"];?></td>
												<td><a id="showledger" href="<?php echo SITEURL."?grouplist&_gid=".$resdata["GROUPID"]?>"><?php echo $resdata["GROUPNAME"];?></a></td>
												<td style="text-align:right;"><?php echo $bal_arr[0] != 0 ? $bal_arr[0]." ".$bal_arr[1] : "";?></td>
											
											</tr>
										<?php
									}
							?>                                        
							</tbody>
						</table>
					</div>
					</form>
				</div>
				<!-- /.panel-body -->
		</div>
	</div>
			<!-- /.panel -->
		
     <!-- /.col-lg-12 -->

	<div class="col-lg-6">
<?php
								if(isset($_GET["_gid"]) && !empty($_GET["_gid"]))
								{
									?>
										<div class="panel panel-primary">
				 <div class="panel-body">
					<div class="panel-body" id="displayledger" style="">
					<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
							<thead>
								<tr>
									<th>Group Name:</th>
									<th colspan="2"><?php echo getFieldDetail(ACGROUP,"GROUPNAME"," WHERE GROUPID='".$_GET["_gid"]."'")?></th>
									
								</tr>
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
									$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID='".$_GET["_gid"]."'");
									while($resledgerdata = mysqli_fetch_assoc($resledger))
										{
										$bal_arr = getClosingBalanceonearg($resledgerdata["LEDGERID"]);	
											?>
												<tr>
												
												<td><a href="<?php echo SITEURL."?print-ledger&lid=".$resledgerdata["LEDGERID"]?>" target="_blank"><?php echo $resledgerdata["LEDGERNAME"];?></a></td>
												<td style="text-align:right;"><?php echo number_format((float)$bal_arr[0], 2, '.', '');?> <?php echo $bal_arr[1];?></td>
													<td class="clearid_ledger"  rel="<?php echo $resledgerdata["LEDGERID"];?>-<?php echo $bal_arr[1];?>-<?php echo $bal_arr[0];?>">
														
														<?PHP
														
														if(round($bal_arr[0],2) > 0 && round($bal_arr[0],2) < 100 && isset($_SESSION["adminuser"]))
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

	</div>

</div>