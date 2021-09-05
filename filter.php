
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Current Stock</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

<div class="row">

		<div class="col-lg-12">
			
			<div class="panel panel-primary">
				<div class="panel-heading">
                   <a href="javascript:void(0)" id="showfilter" style="color:#fff;"> <i class="fa fa-filter"></i> Filter</a>
                </div>
				<div class="panel-body" id="displayfilter" style="display:none;">
					
					<form id="frm_FILTEtable" action="<?php echo SITEURL; ?>?filter" method="POST" onsubmit="">
							<div class="form-group">
								<table class="inputfieldtable filter_table" >
									<tr>
										<td width="5%"><label>Stock Id:</label></td>
										<td width="8%"><input type="text" class="form-control" style="width:100%;" name="txtSTOCKID" id="txtSTOCKID" /></td>
										<td width="7%"><label>Certificate No:</label></td>
										<td width="10%"><input type="text" class="form-control" style="width:100%;" name="txtCERTIFICATENO" id="txtCERTIFICATENO" /></td>
										<td width="7%"><label>Location:</label></td>
										<td width="10%"><input type="text" class="form-control" style="width:100%;" name="txtLOCATIONNAME" /></td>
									</tr>
								
								</table>
								
							</div>
							
							<div class="form-group">
							<table width="100%" class="inputfieldtable filter_table">
								<tr>
									<th valign="top"><label>Stock Id:</label></th>
									<td><input type="text" class="form-control" style="width:10%;float:left;" name="txtFRMBARCODENO" id="txtFRMBARCODENO" /> <span style="float:left;padding-left:10px;padding-right:10px;">To</span> <input type="text" class="form-control" style="width:10%;" name="txtTOBARCODENO" id="txtTOBARCODENO" />
									</td>
									
								</tr>
								<tr>
									<th valign="top"><label>Weight:</label></th>
									<td><input type="text" class="form-control onlyNumber" style="width:10%;float:left;" name="txtFRMWEIGHT" id="txtFRMWEIGHT" /> <span style="float:left;padding-left:10px;padding-right:10px;">To</span> <input type="text" class="form-control onlyNumber" style="width:10%;" name="txtTOWEIGHT" id="txtTOWEIGHT" />
									</td>
									
								</tr>
								<tr>
									<th valign="top"><label>Lab:</label></th>
									<td>
										<?php
											$idx=1;
											$res_LAB = getData(LAB_MST,$AllArr," WHERE FLAG='0' ");
											while($res_LAB_data = mysqli_fetch_assoc($res_LAB))
											{
											?>
												<div class="checkbox-inline">
												<label>
												<input type="checkbox" name="chkLAB[]" id="chkLAB<?php echo $idx++;?>" value="'<?php echo $res_LAB_data["LABNAME"];?>'" /> <?php echo $res_LAB_data["LABNAME"];?>
											</label>
											</div>
											<?php
											}
										?>
									</td>
									
								</tr>
								<tr>
									<th valign="top"><label>Shape:</label></th>
									<td>
										<?php
											$idx=1;
											$res_SHAPE = getData(SHAPE_MST,$AllArr," WHERE FLAG='0' ");
											while($res_SHAPE_data = mysqli_fetch_assoc($res_SHAPE))
											{
											?>
												<div class="checkbox-inline">
												<label>
												<input type="checkbox" name="chkSHAPE[]" id="chkSHAPE<?php echo $idx++;?>" value="'<?php echo $res_SHAPE_data["SHAPENAME"];?>'" /> <?php echo $res_SHAPE_data["SHAPENAME"];?>
											</label>
											</div>
											<?php
											}
										?>
									</td>
									
								</tr>
								<tr>
									<th valign="top"><label>Color:</label></th>
									<td>
										<?php
											$idx=1;
											$res_COL = getData(COLOR_MST,$AllArr," WHERE FLAG='0' ");
											while($res_COL_data = mysqli_fetch_assoc($res_COL))
											{
											?>
											<div class="checkbox-inline">
												<label>
													<input type="checkbox" name="chkCOLOR[]" id="chkCOLOR<?php echo $idx++;?>" value="'<?php echo $res_COL_data["COLORNAME"];?>'"/> <?php echo $res_COL_data["COLORNAME"];?>
												</label>
											</div>
												
											<?php
											}
										?>
									</td>
								</tr>
								<tr>
									<th valign="top"><label>Clarity:</label></th>
									<td>
										<?php
											$idx=1;
											$res_CLA = getData(CLARITY_MST,$AllArr," WHERE FLAG='0' ORDER BY CLARITYID");
											while($res_CLA_data = mysqli_fetch_assoc($res_CLA))
											{
											?>
												<div class="checkbox-inline">
												<label>
												<input type="checkbox" name="chkCLARITY[]" id="chkCLARITY<?php echo $idx++;?>" value="'<?php echo $res_CLA_data["CLARITYNAME"];?>'"/> <?php echo $res_CLA_data["CLARITYNAME"];?>
												</label>
												</div>
											<?php
											}
										?>
									</td>
								</tr>
								<tr>
									<th valign="top"><label>Cut:</label></th>
									<td>
										<?php
											$idx=1;
											$res_CUT = getData(CUT_MST,$AllArr," WHERE FLAG='0' ");
											while($res_CUT_data = mysqli_fetch_assoc($res_CUT))
											{
											?>
												<div class="checkbox-inline">
												<label>
												<input type="checkbox" name="chkCUT[]" id="chkCUT<?php echo $idx++;?>" value="'<?php echo $res_CUT_data["CUTNAME"];?>'"/> <?php echo $res_CUT_data["CUTNAME"];?>
												</label>
												</div>
											<?php
											}
										?>
									</td>
								</tr>
								<tr>
									<th valign="top"><label>Polish:</label></th>
									<td>
										<?php
											$idx=1;
											$res_POLISH = getData(POLISH_MST,$AllArr," WHERE FLAG='0' ");
											while($res_POLISH_data = mysqli_fetch_assoc($res_POLISH))
											{
											?>
												<div class="checkbox-inline">
												<label>
												<input type="checkbox" name="chkPOLISH[]" id="chkPOLISH<?php echo $idx++;?>" value="'<?php echo $res_POLISH_data["POLISHNAME"];?>'"/> <?php echo $res_POLISH_data["POLISHNAME"];?>
												</label>
												</div>
											<?php
											}
										?>
									</td>
								</tr>
								<tr>
									<th valign="top"><label>Symmetry:</label></th>
									<td>
										<?php
											$idx=1;
											$res_SYMM = getData(SYMM_MST,$AllArr," WHERE FLAG='0' ");
											while($res_SYMM_data = mysqli_fetch_assoc($res_SYMM))
											{
											?>
												<div class="checkbox-inline">
												<label>
												<input type="checkbox" name="chkSYMM[]" id="chkSYMM<?php echo $idx++;?>" value="'<?php echo $res_SYMM_data["SYMMNAME"];?>'"/> <?php echo $res_SYMM_data["SYMMNAME"];?>
												</label>
												</div>
											<?php
											}
										?>
									</td>
								</tr>
								<tr>
									<th valign="top"><label>Flourance:</label></th>
									<td>
										<?php
											$idx=1;
											$res_FLOUR = getData(FLOUR_MST,$AllArr," WHERE FLAG='0' ");
											while($res_FLOUR_data = mysqli_fetch_assoc($res_FLOUR))
											{
											?>
												<div class="checkbox-inline">
												<label>
												<input type="checkbox" name="chkFLOUR[]" id="chkFLOUR<?php echo $idx++;?>" value="'<?php echo $res_FLOUR_data["FLOURNAME"];?>'"/> <?php echo $res_FLOUR_data["FLOURNAME"];?>
												</label>
												</div>
											<?php
											}
										?>
									</td>
								</tr>
								<tr>
									<th valign="top"><label>Green:</label></th>
									<td>
										<?php
											$idx=1;
											$res_GREEN = getData(GREEN_MST,$AllArr," WHERE FLAG='0' ");
											while($res_GREEN_data = mysqli_fetch_assoc($res_GREEN))
											{
											?>
											<div class="checkbox-inline">
												<label>
													<input type="checkbox" name="chkGREEN[]" id="chkGREEN<?php echo $idx++;?>" value="'<?php echo $res_GREEN_data["GREENNAME"];?>'"/> <?php echo $res_GREEN_data["GREENNAME"];?>
												</label>
											</div>
												
											<?php
											}
										?>
									</td>
								</tr>
								<tr>
									<th valign="top"><label>Milky:</label></th>
									<td>
										<?php
											$idx=1;
											$res_MILKY = getData(MILKY_MST,$AllArr," WHERE FLAG='0' ");
											while($res_MILKY_data = mysqli_fetch_assoc($res_MILKY))
											{
											?>
											<div class="checkbox-inline">
												<label>
													<input type="checkbox" name="chkMILKY[]" id="chkMILKY<?php echo $idx++;?>" value="'<?php echo $res_MILKY_data["MILKYNAME"];?>'"/> <?php echo $res_MILKY_data["MILKYNAME"];?>
												</label>
											</div>
												
											<?php
											}
										?>
									</td>
								</tr>
							</table>
						</div>
					
						<button type="submit" class="btn btn-default" style="float: right;" name="filter">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	
<?php
if(isset($_POST["filter"]) || $action == "")
{
	$BARCODENO = isset($_POST["txtSTOCKID"]) && !empty($_POST["txtSTOCKID"])? " AND BP.BARCODENO='GP".$_POST["txtSTOCKID"]."'" : '';
	
	$CERTIFICATENO = isset($_POST["txtCERTIFICATENO"]) && !empty($_POST["txtCERTIFICATENO"])? " AND BP.CERTIFICATENO='".$_POST["txtCERTIFICATENO"]."'" : '';
	
	$LOCATIONNAME = isset($_POST["txtLOCATIONNAME"]) && !empty($_POST["txtLOCATIONNAME"])? " AND BP.LOCATIONNAME='".$_POST["txtLOCATIONNAME"]."'" : '';
	
	$WEIGHT = (isset($_POST["txtFRMWEIGHT"]) && !empty($_POST["txtFRMWEIGHT"])) && (isset($_POST["txtTOWEIGHT"]) && !empty($_POST["txtTOWEIGHT"])) ? " AND BP.WEIGHT BETWEEN '".$_POST["txtFRMWEIGHT"]."' AND '".$_POST["txtTOWEIGHT"]."'" : '';
	//======================barcodeno filter=========================
	
		$x = 1;
		$str = isset($_POST["txtFRMBARCODENO"]) && !empty($_POST["txtFRMBARCODENO"])? $_POST["txtFRMBARCODENO"] : '';//$_POST["txtFRMBARCODENO"];
		$strto = isset($_POST["txtTOBARCODENO"]) && !empty($_POST["txtTOBARCODENO"])? $_POST["txtTOBARCODENO"] : '';//$_POST["txtTOBARCODENO"];
		$strlen = strlen($str);
		$strtolen=strlen($strto);
		$id = "";
		for($i = 0; $i <= $strlen; $i++) 
		{
			$char = substr($str,$i,1);
			if(is_numeric($char) ) 
			{ 
				break; 
			}
			$id .= $char;
		}	
		$frombarcodecount  = substr(strlen($id),0);	
		$frombar  = substr($str,strlen($frombarcodecount)+1,$strlen - strlen($frombarcodecount) );
		$tobar  = substr($strto,strlen($frombarcodecount)+1,$strtolen - strlen($frombarcodecount) );
		$BARCODENOBETWEEN = (isset($_POST["txtFRMBARCODENO"]) && !empty($_POST["txtFRMBARCODENO"])) && (isset($_POST["txtTOBARCODENO"]) && !empty($_POST["txtTOBARCODENO"])) ? " AND BP.BARCODENO LIKE CONCAT('" .$id."','%') AND substr(BP.BARCODENO,(".$frombarcodecount."+1)) BETWEEN '" .$frombar . "' AND  '" .$tobar."'" : '';
	
	//======================barcodeno filter=========================
	
	$LABarr = isset($_POST["chkLAB"]) ? $_POST["chkLAB"] : array();
	$LAB = count($LABarr) > 0 ? " AND BP.LAB IN (".implode(',',$LABarr).")" : '';
	
	$SHAPEarr = isset($_POST["chkSHAPE"]) ? $_POST["chkSHAPE"] : array();
	$SHAPE = count($SHAPEarr) > 0 ? " AND BP.SHAPE IN (".implode(',',$SHAPEarr).")" : '';
	
	$COLORarr = isset($_POST["chkCOLOR"]) ? $_POST["chkCOLOR"] : array();
	$COLOR =  count($COLORarr) > 0 ? " AND BP.COLOR IN (".implode(',',$COLORarr).")" : '';
	
	$CLARITYarr = isset($_POST["chkCLARITY"]) ? $_POST["chkCLARITY"] : array();
	$CLARITY =  count($CLARITYarr) > 0 ? " AND BP.CLARITY IN (".implode(',',$CLARITYarr).")" : '';
	
	$CUTarr = isset($_POST["chkCUT"]) ? $_POST["chkCUT"] : array();
	$CUT = count($CUTarr) > 0 ? " AND BP.CUT IN (".implode(',',$CUTarr).")" : '';
	
	$POLISHarr = isset($_POST["chkPOLISH"]) ? $_POST["chkPOLISH"] : array();
	$POLISH = count($POLISHarr) > 0 ? " AND BP.POLISH IN (".implode(',',$POLISHarr).")" : '';
	
	$SYMMarr = isset($_POST["chkSYMM"]) ? $_POST["chkSYMM"] : array();
	$SYMM = count($SYMMarr) > 0 ? " AND BP.SYMM IN (".implode(',',$SYMMarr).")" : '';
	
	$FLOURarr = isset($_POST["chkFLOUR"]) ? $_POST["chkFLOUR"] : array();
	$FLOUR = count($FLOURarr) > 0 ? " AND BP.FLOURANCE IN (".implode(',',$FLOURarr).")" : '';
	
	
	$GREENarr = isset($_POST["chkGREEN"]) ? $_POST["chkGREEN"] : array();
	$GREEN = count($GREENarr) > 0 ? " AND BP.GREEN IN (".implode(',',$GREENarr).")" : '';
	
	$MILKYarr = isset($_POST["chkMILKY"]) ? $_POST["chkMILKY"] : array();
	$MILKY = count($MILKYarr) > 0 ? " AND BP.MILKY IN (".implode(',',$MILKYarr).")" : '';

if ($view_bol)
{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form action="<?php echo SITEURL; ?>makexls.php?makexls=rapnet_1" method="post" id="frmstock">
					
					<p>
						<a class="btn btn-success" href="<?php echo SITEURL; ?>?purchase&_nid"><i class="fa fa-plus"></i> Add New Stock</a>
						<button type="submit" class="btn btn-success" name="xlsprint"  id="xlsprint"><i class="fa fa-download"></i> RAPNET XLS</button>
						
						<button type="button" class="btn btn-danger" onclick="document.getElementById('Upload_file_stock').click();" ><i class="fa fa-upload"></i> RAPNET XLS</button>
						<input type="file" style="display:none;" id="Upload_file_stock" name="Upload_file_stock"/>
						<?php
							$PURArr[0]="BP.*";
							$PURArr[1]="(BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT))) AS CURRWGT";
							
							$res = getData(BARCODE_PROCESS,$PURArr," AS BP LEFT JOIN ". BARCODE_PROCESS ." AS SP ON BP.BARCODENO=SP.BARCODENO 
							AND SP.PROCESSTYPE='Sale' WHERE BP.PROCESSTYPE IN ('Purchase','Memo Issue','Memo Receive','Repair Issue',
							'Repair Receive','Grading Issue','Grading Result','Grading Receive','Recut Issue','Recut Receive') and BP.ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO)" . $BARCODENO.$BARCODENOBETWEEN.$CERTIFICATENO.$WEIGHT.$LAB.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOUR.$GREEN.$MILKY.$LOCATIONNAME." GROUP BY BP.BARCODENO HAVING BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT)) > 0 ORDER BY CAST(SUBSTR(BP.BARCODENO,3) AS UNSIGNED)");
							
							$rstotal =0;
							$rmbtotal =0;
							$dollartotal =0;
							$barcodecount = 0;
							$curr_dollartotal=0;
							while($resdata = mysqli_fetch_assoc($res))
							{
								$RAPRATE = getRapPrice($resdata["SHAPE"],$resdata["COLOR"],$resdata["CLARITY"],$resdata["WEIGHT"]);
								$curr_dollor = ($RAPRATE * $resdata["WEIGHT"]) ;
								if($resdata["RAPDISCOUNT"] >0)
									{
										$curr_dollor = $curr_dollor * (1 - $resdata["RAPDISCOUNT"]/ 100);
									}
								$rstotal += $resdata["RSAMOUNT"]; 
								$rmbtotal += $resdata["RMBAMOUNT"]; 
								$dollartotal += $resdata["TOTALDOLLAR"]; 
								$curr_dollartotal += $curr_dollor; 
							
							}
						?>
						
						<div class="row from-group">
							<!--<div class="col-lg-2">
								<label  style="font-size:18px">Total $:</label>
								<input type="text" readonly class="form-control" id="stock_dollaramount_total"  value="<?php echo getCurrFormat($dollartotal);?>" />
							</div>
							
							<div class="col-lg-3">
								<label  style="font-size:18px">Total Current $:</label>
								<input type="text" readonly class="form-control" id="stock_dollaramount_total"  value="<?php echo getCurrFormat($curr_dollartotal);?>" />
							</div>
							<div class="col-lg-2">
								<label  style="font-size:18px">Total RMB:</label>
								<input type="text" readonly class="form-control" id="stock_rmbamount_total"  value="<?php echo getCurrFormat($rmbtotal);?>" />
							</div>
							<div class="col-lg-2">
								<label  style="font-size:18px">Total : </label>
								<input type="text" readonly class="form-control" id="stock_rsamount_total"  value="<?php echo getCurrFormat($rstotal);?>" />
							</div>							
							<div class="col-lg-2">
								<label  style="font-size:18px">Total Stock:</label>
								<input type="text" readonly class="form-control" id="stock_pcs_total"  value="<?php echo mysqli_num_rows($res);?>" />
						
							</div>-->
						</div>
						<img id="lodimg" src="<?php echo SITEURL.INIT."images/loading.gif";?>" style="float: right;display:none;"/>
					</p>

					<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
							<thead>
								<tr>
									<th>Sel
									<input type="checkbox" id="SelectAll" /></th>	
									
									<th>Stock Id</th>
									<th>New Stock Id</th>
									<th>Ava</th>
									<th>Shp</th>	
									<th>Size</th>									
									<th>Col/ Cla</th>
									<th>C/P/S</th>
									<th>Flo</th>
									
									<th>Loc</th>
									<th>Cert</th>				
									<th>Lab</th>
									
									
									
									
									<th>Rate</th>	
									<th>Curr Rap</th>
									<!--<th style="text-align:center;">Back<br/>$/Crt - Ttl $</th>-->
									<th>Per/Crt</th>
									<th>Total $</th>
									<th>Diamond Image</th>
									<th>Mesu</th>
									<th>TB(%)</th>
									<th>TD(%)</th>
									<th>Days Diff</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
						
							<?php
							$idx = 1;
							$PURArr[0]="BP.*";
							$PURArr[1]="(BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT))) AS CURRWGT";
							$res = getData(BARCODE_PROCESS,$PURArr," AS BP LEFT JOIN ". BARCODE_PROCESS ." AS SP ON BP.BARCODENO=SP.BARCODENO 
							AND SP.PROCESSTYPE='Sale'
							WHERE BP.PROCESSTYPE IN ('Purchase','Memo Issue','Memo Receive','Repair Issue','Repair Receive','Grading Issue',
							'Grading Result','Grading Receive','Recut Receive','Recut Issue') and BP.ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO)" . $BARCODENO.$BARCODENOBETWEEN.$CERTIFICATENO.$WEIGHT.$LAB.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOUR.$GREEN.$MILKY.$LOCATIONNAME." GROUP BY BP.BARCODENO HAVING BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT)) > 0 ORDER BY CAST(SUBSTR(BP.BARCODENO,3) AS UNSIGNED)");
							$Totaldollarsum=0;
							$PURBARCODETEXT='';
							$TTLWGT=0;
							while($resdata = mysqli_fetch_assoc($res))
							{
							
								$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
								$TTLWGT+=$resdata["WEIGHT"];
								$PURBARCODETEXT .= "'".$resdata["BARCODENO"]."',";
								
								$RATEDOLLAR= $resdata["RATE"] * $resdata["WEIGHT"]; 	
					
								if($resdata["RAPDISCOUNT"] > 0)
								{
									$RATEDOLLAR = $RATEDOLLAR * (1 - $resdata["RAPDISCOUNT"] / 100);
								}
								
								$PERCRTDOLLAR= $RATEDOLLAR / $resdata["WEIGHT"]; 	
								$TOTALDOLLAR= $RATEDOLLAR; 
								$Totaldollarsum += $TOTALDOLLAR;
								$purdate = getFieldDetail(PURCHASESALE,"VOUCHERDATE"," WHERE ID='".$resdata["ID"]."' and VOUCHERTYPE='Purchase'");
								
								$todate_ = date('Y-m-d');
							
								$datetime1 = new DateTime($purdate);
								$datetime2 = new DateTime($todate_);
								$interval = $datetime1->diff($datetime2);
								$days_diff = $interval->format('%R%a');

								$RAPRATE = getRapPrice($resdata["SHAPE"],$resdata["COLOR"],$resdata["CLARITY"],$resdata["WEIGHT"]);


								?>
								
										<tr class="<?php echo $classname;?>">
											
											
										
											<td>
											<input type="checkbox" value="<?php echo $resdata["BARCODENO"];?>" name="SELECT[]" class="SelectAll"/></td>
										
											
											<td class="open_custom_overlay" rel="<?php echo substr($resdata["BARCODENO"],2);?>"><a href="javascript:void(0)"><?php echo $resdata["BARCODENO"];?></a><br><small>(<?php echo $resdata["PROCESSTYPE"]?>)</small></td>
											<td><?php echo $resdata["BARCODENO"];?></td>

											<td><input type="text" <?php echo $edit_bol ? 'class="stockchange"' : 'readonly';?> size="2" rel="AVAILABLE-<?php echo $resdata["BARCODENO"];?>"  id="AVAI<?php echo $resdata["BARCODENO"];?>" name="AVAI<?php echo $resdata["BARCODENO"];?>" value="<?php echo $resdata["AVAILABLE"];?>"></td>
												<td><?php echo $resdata["SHAPE"];?></td>
												
												<td class="amountalign"><?php echo number_format((float)$resdata["CURRWGT"], 2, '.', '');?></td>
											<td><?php echo $resdata["COLOR"];?>-<?php echo $resdata["CLARITY"];?></td>
											<td><?php echo $resdata["CUT"]."/".$resdata["POLISH"]."/".$resdata["SYMM"];?></td>
											<td><?php echo $resdata["FLOURANCE"];?></td>
											
											<td>
											<input type="hidden" id="ENTID<?php echo $resdata["BARCODENO"]; ?>" value="<?php echo $resdata["ENTRYID"]; ?>"/>
											<input type="text" rel="LOCATIONNAME-<?php echo $resdata["BARCODENO"];?>" id="LOCATIONNAME<?php echo $resdata["BARCODENO"];?>" name="LOCATIONNAME<?php echo $resdata["BARCODENO"];?>" size="5" value="<?php echo $resdata["LOCATIONNAME"]; ?>" class="stockchange" /><span style="display:none;"><?php echo $resdata["LOCATIONNAME"]; ?></span></td>
											<td><?php echo $resdata["CERTIFICATENO"];?></td>
											<td><?php echo $resdata["LAB"];?></td>
											
											
											
											
										
											
											<td class="amountalign"><?php echo sprintf("%.2f",$resdata["RATE"]);?></td>
											<?PHP
											if($resdata["COLOR"] == ''){
											?>
											<td><input style="text-align:right;" type="text" rel="CURRRAP-<?php echo $resdata["BARCODENO"];?>" size="5" value="<?php echo $resdata["CURRRAP"] == '0' ? sprintf("%.2f",$RAPRATE) : $resdata["CURRRAP"] ; ?>" class="stockchange" /><span style="display:none;"><?php echo $resdata["CURRRAP"] == '0' ? sprintf("%.2f",$RAPRATE) : $resdata["CURRRAP"] ; ?></span></td>
											<?php
											}else{
												?>
												<td class="amountalign"><?php echo sprintf("%.2f",$RAPRATE) ;?></td>
												<?php
											}
											
											?>
											
											<!--<td style="text-align:center;">
											<input type="text" <?php echo $edit_bol ? 'class="stockrapchange"' : 'readonly';?> size="2" rel="RAPDISCOUNT-<?php echo $resdata["BARCODENO"];?>" id="RAPDISC<?php echo $resdata["BARCODENO"];?>" name="RAPDISC<?php echo $resdata["BARCODENO"];?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
											<table style="margin-top:5px;">
												<tr>
												<td><input type="text" class=""  size="10" readonly rel="RAPPERCRT-<?php echo $resdata["BARCODENO"];?>" id="RAPPERCRT<?php echo $resdata["BARCODENO"];?>" name="RAPPERCRT<?php echo $resdata["BARCODENO"];?>" value="<?php echo $resdata["RAPPERCRT"];?>"></td>
												<td><input type="text" class=""  size="10" readonly rel="RAPTOTALDOLLAR-<?php echo $resdata["BARCODENO"];?>" id="RAPTOTALDOLLAR<?php echo $resdata["BARCODENO"];?>" name="RAPTOTALDOLLAR<?php echo $resdata["BARCODENO"];?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>"></td>
												
											</table>
											
											</td>-->
											
											<td class="amountalign"><?php echo sprintf("%.2f",$PERCRTDOLLAR);?></td>
											<td class="amountalign"><?php echo sprintf("%.2f",$TOTALDOLLAR);?></td>
											
											<td><input type="text" <?php echo $edit_bol ? 'class="stockchange"' : 'readonly';?>  size="5" rel="DIAMONDIMAGE-<?php echo $resdata["BARCODENO"];?>" id="DIAMONDIMAGE<?php echo $resdata["BARCODENO"];?>" name="DIAMONDIMAGE<?php echo $resdata["BARCODENO"];?>" value="<?php echo $resdata["DIAMONDIMAGE"];?>"></td>
											
											
											<td><?php echo $resdata["MESU1"]."-".$resdata["MESU2"]."x".$resdata["MESU3"];?> mm</td>
											
											
											<td><?php echo $resdata["DEPTHPER"];?></td>
											<td><?php echo $resdata["TABLEPER"];?></td>
											<td><?php echo $days_diff;?></td>
											<td>
												<a href="<?php echo SITEURL; ?>?memoissue&_mid=<?php echo $resdata["BARCODENO"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
												<a target="_blank" href="<?php echo SITEURL; ?>makepdf.php?bar=<?php echo $resdata["BARCODENO"];?>" class="btn btn-primary btn-circle" title="Print">
														<i class="fa fa-print"></i>
													</a>
											</td>
											<input type="hidden" name="RSAMOUNT[]" class="rsamount_cls" value="<?php echo $resdata["RSAMOUNT"];?>" />
										</tr>
								<?php
								
							}
							?>
							
							 
								<?php
							$PURBARCODETEXT = empty($PURBARCODETEXT) ? '' : substr($PURBARCODETEXT,0,strlen($PURBARCODETEXT)-1);
							?>
							<tr>
							<td><b>Total:</b></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?PHP echo $TTLWGT?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="amountalign"><?php echo $Totaldollarsum;?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							</tr>
							</tbody>
					
					
							<input type="hidden" name="PURBARCODETEXT" value="<?php echo $PURBARCODETEXT;?>"/>
						</table>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php		
}
}
?>
