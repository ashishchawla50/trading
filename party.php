<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	
	$Caption = "New Account Detail";
	$res = getData(LEDGER,$AllArr," WHERE LEDGERID='0'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$LEDGERID = $_GET["_mid"];
	
	$Caption = "Edit Account Detail";
	$res = getData(LEDGER,$AllArr," WHERE LEDGERID='".$LEDGERID."'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$LEDGERID = $_GET["_rid"];
	deleteData(LEDGER," where LEDGERID='".$LEDGERID."'");
	deleteData(LEDGER_DEBIT," WHERE LEDGERID ='".$LEDGERID."' AND VOUCHERTYPE='Opening'");
	deleteData(LEDGER_CREDIT," WHERE LEDGERID ='".$LEDGERID."' AND VOUCHERTYPE='Opening'");
	?>
	<script>
	window.location.href="<?php echo SITEURL."?party&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}


if(isset($_POST["shape_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE LEDGERID IN (".$DeleteString.")";
	deleteData(LEDGER,$Condition);
	deleteData(LEDGER_DEBIT," WHERE LEDGERID IN (".$DeleteString.") AND VOUCHERTYPE='Opening'");
	deleteData(LEDGER_CREDIT," WHERE LEDGERID IN (".$DeleteString.") AND VOUCHERTYPE='Opening'");
	?>
	<script>
	window.location.href="<?php echo SITEURL."?party&_vid";?>";
	</script>
	<?php
	exit();
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Account</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?party&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?party&_vid"><i class="fa fa-plus-tasks"></i>View</a>
							<?php
						}
						
}
else if($action == "view")
{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmACtable" action="<?php echo SITEURL; ?>?party" method="POST" onsubmit="return confirm('Do you really want to Delete selected Accounts?');">
					<?php echo $back_button;?>
					<p>
						<?php
					
						
						if($del_bol)
						{
							?>
						<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?party&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
						<button type="submit" name="shape_mul" class="btn btn-danger delcls" ><i class="fa fa-trash-o"></i> Delete</button>
					<?php
						}
						?>
					</p>
					<?php
					if ($view_bol)
					{
					?>
					<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="text-align:center;width:15%;" >
									SELECT ALL
									<br>
									<input type="checkbox" id="SelectAll" />
									</th>
									<th>Account Id</th>									
									<th>Account Name</th>
									<th>Group Name</th>
									<th>Mobile</th>
									<th>Email</th>
									
									<th>Open Dt</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(LEDGER,$AllArr," WHERE FLAG='0' order by LEDGERID");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
												<td align="center">
													<?php 
													if(!$resdata["DELETESTATUS"])
													{
														?>
														<input type="checkbox" value="<?php echo $resdata["LEDGERID"];?>" name="SELECT[]" class="SelectAll"/>
														<?php
													}
													?>													
												</td>
												<td><?php echo $resdata["LEDGERID"];?></td>
												<td><?php echo $resdata["LEDGERNAME"];?></td>
												<td><?php echo getFieldDetail(ACGROUP,"GROUPNAME"," WHERE GROUPID='".$resdata["GROUPID"]."'");?></td>
												<td><?php echo $resdata["MOBILENO"];?></td>
												<td><?php echo $resdata["EMAIL"];?></td>
												<td><?php echo getDateTimeFormat($resdata["VOUCHERDATE"]);?></td>
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?party&_mid=<?php echo $resdata["LEDGERID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													
													if(!$resdata["DELETESTATUS"])
													{
														?>
														<a href="<?php echo SITEURL; ?>?party&_rid=<?php echo $resdata["LEDGERID"];?>" onclick="return confirm('Do you really want to Delete Account : <?php echo $resdata["LEDGERNAME"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
															<i class="fa fa-trash-o"></i>
														</a>
														<?php
													}
													}
													?>	
													
													
												</td>
											</tr>
										<?php
										$idx++;
									}
							?>                                        
							</tbody>
						</table>
					</div>
					<?php
					}
					?>
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
elseif($action == "new")
{
	?>
		<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <?php echo $Caption;?>
                </div>
				<div class="panel-body">
					<?php echo $back_button;?>
					<form id="frm_ACtable" action="<?php echo SITEURL; ?>party_s.php" method="POST" >
						<input type="hidden" name="LEDGERID" id="LEDGERID" value="<?php echo $resdata["LEDGERID"];?>">
						<input type="hidden" name="VOUCHERNO" id="VOUCHERNO" value="<?php echo $resdata["VOUCHERNO"];?>">
						<input type="hidden" name="SRNO" id="SRNO" value="<?php echo $resdata["SRNO"];?>">
						
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Account Name</label></td>
									<td><label>Group</label></td>
									<td class="GROUPSTATUS" style="<?php echo $resdata["GROUPID"] != '23' ? "display:none;" :'' ;?>"><label>Interest %</label></td>
									<td style="display:none;"><label>Loan Date</label></td>
								</tr>
								<tr>
								
									<td>
									 <input class="form-control onlyCharacter" name="txtLEDGERNAME" id="txtLEDGERNAME" value="<?php //echo $resdata["LEDGERNAME"];?>">
									</td>
									<td class="ui-widget">
										 <select class="form-control" name="txtGROUPID" id="txtGROUPID">
											<option value=""> Select Group </option>
											<?php
											$res_acgrp = getData(ACGROUP,$AllArr," WHERE FLAG='0'");
											while($res_acgrp_data = mysqli_fetch_assoc($res_acgrp))
												{
													?>
													<option value="<?php echo $res_acgrp_data["GROUPID"];?>" <?php echo $res_acgrp_data["GROUPID"]==$resdata["GROUPID"] ? 'selected="selected"':'';?>><?php echo $res_acgrp_data["GROUPNAME"];?></option>
													<?php
												}
											?>
										</select>
									</td>
									
										
										<td class="GROUPSTATUS" style="<?php echo $resdata["GROUPID"] != '23' ? "display:none;" :'' ;?>">
											<input type="text" class="form-control " name="txtINTERESTPER" id="txtINTERESTPER" value="<?php //echo $resdata["INTERESTPER"];?>">
										</td>
										<td style="display:none;">
											<input type="date" class="form-control" name="dtpLOANDATE" id="dtpLOANDATE" value="<?php// echo isset($resdata["LOANDATE"]) ? $resdata["LOANDATE"] : "";?>">
										</td>
									
								</tr>
							</table>
						</div>

							
						<div class="form-group">
                            <label>* Address</label>
                            <textarea class="form-control" name="txtADDRESS" id="txtADDRESS"><?php //echo $resdata["ADDRESS"];?></textarea>
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>City</label></td>
									<td><label>State</label></td>
									<td><label>State Code</label></td>
									<td><label>Country</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control " name="txtCITY" id="txtCITY" value="<?php //echo $resdata["CITY"];?>">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSTATE" id="txtSTATE" value="<?php //echo $resdata["STATE"];?>">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSTATECODE" id="txtSTATECODE" value="<?php //echo $resdata["STATECODE"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtCOUNTRY" id="txtCOUNTRY" value="<?php //echo $resdata["COUNTRY"];?>">
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
                            <input type="checkbox" value="" name="sameshipadd" ID ="sameshipadd" class=""/><label> SAME AS ABOVE </label>
                            
                        </div>
						<div class="form-group">
                            <label>Shipping Address</label>
                            <textarea class="form-control" name="txtSHIPPINGADDRESS" id="txtSHIPPINGADDRESS"><?php //echo $resdata["SHIPPINGADDRESS"];?></textarea>
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Shipping City</label></td>
									<td><label>Shipping State</label></td>
									<td><label>Shipping State Code</label></td>
									<td><label>Shipping Country</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control " name="txtSHIPPINGCITY" id="txtSHIPPINGCITY" value="<?php //echo $resdata["SHIPPINGCITY"];?>">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSHIPPINGSTATE" id="txtSHIPPINGSTATE" value="<?php //echo $resdata["SHIPPINGSTATE"];?>">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSHIPPINGSTATECODE" id="txtSHIPPINGSTATECODE" value="<?php //echo $resdata["SHIPPINGSTATECODE"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtSHIPPINGCOUNTRY" id="txtSHIPPINGCOUNTRY" value="<?php //echo $resdata["SHIPPINGCOUNTRY"];?>">
									</td>
								</tr>
							</table>
						</div>
						
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Phone</label></td>
									<td><label>Mobile</label></td>
									<td><label>Fax</label></td>
									<td><label>Email</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtPHONE" id="txtPHONE" value="<?php //echo $resdata["PHONE"];?>">
									</td>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtMOBILENO" id="txtMOBILENO" value="<?php //echo $resdata["MOBILENO"];?>">
									</td>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtFAXNO" id="txtFAXNO" value="<?php //echo $resdata["FAXNO"];?>">
									</td>
									<td>
										<input type="email" class="form-control" name="txtEMAIL" id="txtEMAIL" value="<?php //echo $resdata["EMAIL"];?>">
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>GST TIN No</label></td>
									<td><label>PAN No</label></td>
								</tr>
								<tr>
								<td>
										<input type="text" class="form-control" name="txtGSTTINNO" id="txtGSTTINNO" value="<?php //echo $resdata["GSTTINNO"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtPANNO" id="txtPANNO" value="<?php //echo $resdata["PANNO"];?>">
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Bank Name</label></td>
									<td><label>Bank A/c No</label></td>
									<td><label>IFSC/RTGS Code</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="txtBANKNAME" id="txtBANKNAME" value="<?php //echo $resdata["BANKNAME"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtBANKACNO" id="txtBANKACNO" value="<?php //echo $resdata["BANKACNO"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtIFSCCODE" id="txtIFSCCODE" value="<?php //echo $resdata["IFSCCODE"];?>">
									</td>
								</tr>
								
								
							</table>
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Bank Address</label></td>
									
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="txtBANKADDRESS" id="txtBANKADDRESS" value="<?php //echo $resdata["BANKADDRESS"];?>">
									</td>
									
								</tr>
							
								
							</table>
						</div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Opening Balance</label></td>
								<tr>
								<tr>
									<td><label>Dt</label></td>
									<td><label>RS Amount</label></td>
									<td><label>RMB Amount</label></td>
									<td><label>Dollar</label></td>
									
								</tr>
								<tr>
									<td width="20%">
										<input type="date" class="form-control onlyNumber" name="txtVOUCHERDATE" id="txtVOUCHERDATE" value="<?php //echo $resdata["VOUCHERDATE"];?>">
									</td>
									<td width="25%">
										<input type="text" class="form-control onlyNumber" name="txtOPENINGBALANCE" id="txtOPENINGBALANCE" value="<?php //echo $resdata["OPENINGBALANCE"];?>">
									</td>
									<td width="20%">
										<input type="text" class="form-control onlyNumber" name="txtOPENINGRMBAMOUNT" id="txtOPENINGRMBAMOUNT" value="<?php //echo $resdata["OPENINGRMBAMOUNT"];?>">
									</td>
									<td width="25%">
										<input type="text" class="form-control onlyNumber" name="txtOPENINGDOLLAR" id="txtOPENINGDOLLAR" value="<?php //echo $resdata["OPENINGDOLLAR"];?>">
									</td>
									<td>
										<input type="radio" name="txtCRDR" id="txtCR" value="Cr" <?php //echo $resdata["CRDR"]=='Cr' ? 'checked' :'';?>> Cr
										<input type="radio" name="txtCRDR" id="txtDR" value="Dr" <?php //echo $resdata["CRDR"]=='Dr' ? 'checked' :'';?>> Dr
									</td>
								</tr>
							</table>
						</div>
						
						
						<!--<button type="submit" class="btn btn-default" style="float: right;" id="btnparty" name="party">Submit Button</button>-->
						<button type="submit" class="btn btn-default" style="float: right;" id="party" name="party">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>

	<?php
}
elseif($action == "modify")
{
	?>
		<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <?php echo $Caption;?>
                </div>
				<div class="panel-body">
					<?php echo $back_button;?>
					<form id="frm_ACtable" action="<?php echo SITEURL; ?>party_s.php" method="POST" >
						<input type="hidden" name="LEDGERID" id="LEDGERID" value="<?php echo $resdata["LEDGERID"];?>">
						<input type="hidden" name="VOUCHERNO" id="VOUCHERNO" value="<?php echo $resdata["VOUCHERNO"];?>">
						<input type="hidden" name="SRNO" id="SRNO" value="<?php echo $resdata["SRNO"];?>">
						
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Account Name</label></td>
									<td><label>Group</label></td>
									<td class="GROUPSTATUS" style="<?php echo $resdata["GROUPID"] != '23' ? "display:none;" :'' ;?>"><label>Interest %</label></td>
									<td style="display:none;"><label>Loan Date</label></td>
								</tr>
								<tr>
								
									<td>
									 <input class="form-control onlyCharacter" name="txtLEDGERNAME" id="txtLEDGERNAME" value="<?php echo $resdata["LEDGERNAME"];?>">
									</td>
									<td class="ui-widget">
										 <select class="form-control" name="txtGROUPID" id="txtGROUPID">
											<option value=""> Select Group </option>
											<?php
											$res_acgrp = getData(ACGROUP,$AllArr," WHERE FLAG='0'");
											while($res_acgrp_data = mysqli_fetch_assoc($res_acgrp))
												{
													?>
													<option value="<?php echo $res_acgrp_data["GROUPID"];?>" <?php echo $res_acgrp_data["GROUPID"]==$resdata["GROUPID"] ? 'selected="selected"':'';?>><?php echo $res_acgrp_data["GROUPNAME"];?></option>
													<?php
												}
											?>
										</select>
									</td>
									
										
										<td class="GROUPSTATUS" style="<?php echo $resdata["GROUPID"] != '23' ? "display:none;" :'' ;?>">
											<input type="text" class="form-control " name="txtINTERESTPER" id="txtINTERESTPER" value="<?php echo $resdata["INTERESTPER"];?>">
										</td>
										<td style="display:none;">
											<input type="date" class="form-control" name="dtpLOANDATE" id="dtpLOANDATE" value="<?php echo isset($resdata["LOANDATE"]) ? $resdata["LOANDATE"] : "";?>">
										</td>
									
								</tr>
							</table>
						</div>

							
						<div class="form-group">
                            <label>* Address</label>
                            <textarea class="form-control" name="txtADDRESS" id="txtADDRESS"><?php echo $resdata["ADDRESS"];?></textarea>
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>City</label></td>
									<td><label>State</label></td>
									<td><label>State Code</label></td>
									<td><label>Country</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control " name="txtCITY" id="txtCITY" value="<?php echo $resdata["CITY"];?>">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSTATE" id="txtSTATE" value="<?php echo $resdata["STATE"];?>">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSTATECODE" id="txtSTATECODE" value="<?php echo $resdata["STATECODE"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtCOUNTRY" id="txtCOUNTRY" value="<?php echo $resdata["COUNTRY"];?>">
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
                            <input type="checkbox" value="" name="sameshipadd" ID ="sameshipadd" class=""/><label> SAME AS ABOVE </label>
                            
                        </div>
						<div class="form-group">
                            <label>Shipping Address</label>
                            <textarea class="form-control" name="txtSHIPPINGADDRESS" id="txtSHIPPINGADDRESS"><?php echo $resdata["SHIPPINGADDRESS"];?></textarea>
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Shipping City</label></td>
									<td><label>Shipping State</label></td>
									<td><label>Shipping State Code</label></td>
									<td><label>Shipping Country</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control " name="txtSHIPPINGCITY" id="txtSHIPPINGCITY" value="<?php echo $resdata["SHIPPINGCITY"];?>">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSHIPPINGSTATE" id="txtSHIPPINGSTATE" value="<?php echo $resdata["SHIPPINGSTATE"];?>">
									</td>
									<td>
										<input type="text" class="form-control " name="txtSHIPPINGSTATECODE" id="txtSHIPPINGSTATECODE" value="<?php echo $resdata["SHIPPINGSTATECODE"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtSHIPPINGCOUNTRY" id="txtSHIPPINGCOUNTRY" value="<?php echo $resdata["SHIPPINGCOUNTRY"];?>">
									</td>
								</tr>
							</table>
						</div>
						
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Phone</label></td>
									<td><label>Mobile</label></td>
									<td><label>Fax</label></td>
									<td><label>Email</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtPHONE" id="txtPHONE" value="<?php echo $resdata["PHONE"];?>">
									</td>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtMOBILENO" id="txtMOBILENO" value="<?php echo $resdata["MOBILENO"];?>">
									</td>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtFAXNO" id="txtFAXNO" value="<?php echo $resdata["FAXNO"];?>">
									</td>
									<td>
										<input type="email" class="form-control" name="txtEMAIL" id="txtEMAIL" value="<?php echo $resdata["EMAIL"];?>">
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>GST TIN No</label></td>
									<td><label>PAN No</label></td>
								</tr>
								<tr>
								<td>
										<input type="text" class="form-control" name="txtGSTTINNO" id="txtGSTTINNO" value="<?php echo $resdata["GSTTINNO"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtPANNO" id="txtPANNO" value="<?php echo $resdata["PANNO"];?>">
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Bank Name</label></td>
									<td><label>Bank A/c No</label></td>
									<td><label>IFSC/RTGS Code</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="txtBANKNAME" id="txtBANKNAME" value="<?php echo $resdata["BANKNAME"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtBANKACNO" id="txtBANKACNO" value="<?php echo $resdata["BANKACNO"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtIFSCCODE" id="txtIFSCCODE" value="<?php echo $resdata["IFSCCODE"];?>">
									</td>
								</tr>
								
								
							</table>
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Bank Address</label></td>
									
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="txtBANKADDRESS" id="txtBANKADDRESS" value="<?php echo $resdata["BANKADDRESS"];?>">
									</td>
									
								</tr>
							
								
							</table>
						</div>
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Opening Balance</label></td>
								<tr>
								<tr>
									<td><label>Dt</label></td>
									<td><label>RS Amount</label></td>
									<td><label>RMB Amount</label></td>
									<td><label>Dollar</label></td>
									
								</tr>
								<tr>
									<td width="20%">
										<input type="date" class="form-control onlyNumber" name="txtVOUCHERDATE" id="txtVOUCHERDATE" value="<?php echo $resdata["VOUCHERDATE"];?>">
									</td>
									<td width="25%">
										<input type="text" class="form-control onlyNumber" name="txtOPENINGBALANCE" id="txtOPENINGBALANCE" value="<?php echo $resdata["OPENINGBALANCE"];?>">
									</td>
									<td width="20%">
										<input type="text" class="form-control onlyNumber" name="txtOPENINGRMBAMOUNT" id="txtOPENINGRMBAMOUNT" value="<?php echo $resdata["OPENINGRMBAMOUNT"];?>">
									</td>
									<td width="25%">
										<input type="text" class="form-control onlyNumber" name="txtOPENINGDOLLAR" id="txtOPENINGDOLLAR" value="<?php echo $resdata["OPENINGDOLLAR"];?>">
									</td>
									<td>
										<input type="radio" name="txtCRDR" id="txtCR" value="Cr" <?php echo $resdata["CRDR"]=='Cr' ? 'checked' :'';?>> Cr
										<input type="radio" name="txtCRDR" id="txtDR" value="Dr" <?php echo $resdata["CRDR"]=='Dr' ? 'checked' :'';?>> Dr
									</td>
								</tr>
							</table>
						</div>
						
						
						<!--<button type="submit" class="btn btn-default" style="float: right;" id="btnparty" name="party">Submit Button</button>-->
						<button type="submit" class="btn btn-default" style="float: right;" id="party" name="party">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>

	<?php
}
?>
	


	
