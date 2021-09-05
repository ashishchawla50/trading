<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Sale - Stock</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                   <a href="javascript:void(0)" id="showfilter" style="color:#fff;"> <i class="fa fa-filter fa-fw"></i> Filter</a>
                </div>
				<div class="panel-body" id="displayfilter" style="display:none;">
					
					<form id="frm_FILTERtable" action="<?php echo SITEURL; ?>?sale-stock" method="POST" onsubmit="">
							<table width="35%" class="inputfieldtable filter_table">
									<tr>
										<td width="5%"><label>Stock Id:</label></td>
										<td width="8%"><input type="text" class="form-control" style="width:100%;" name="txtSTOCKID" id="txtSTOCKID" /></td>
										<td width="7%"><label>Certificate No:</label></td>
										<td width="10%"><input type="text" class="form-control" style="width:100%;" name="txtCERTIFICATENO" id="txtCERTIFICATENO" /></td>
									</tr>
								</table>
							<div class="form-group">
							<table width="100%" class="inputfieldtable filter_table">
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
					
						<button type="submit" class="btn btn-default" style="float: right;" name="sale-stock">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	
<?php
if(isset($_POST["sale-stock"]) || $action == "")
{
	$BARCODENO = isset($_POST["txtSTOCKID"]) && !empty($_POST["txtSTOCKID"])? " AND BARCODENO='GP".$_POST["txtSTOCKID"]."'" : '';
	$CERTIFICATENO = isset($_POST["txtCERTIFICATENO"]) && !empty($_POST["txtCERTIFICATENO"])? " AND CERTIFICATENO='".$_POST["txtCERTIFICATENO"]."'" : '';
	
	$WEIGHT = (isset($_POST["txtFRMWEIGHT"]) && !empty($_POST["txtFRMWEIGHT"])) && (isset($_POST["txtTOWEIGHT"]) && !empty($_POST["txtTOWEIGHT"])) ? " AND WEIGHT BETWEEN '".$_POST["txtFRMWEIGHT"]."' AND '".$_POST["txtTOWEIGHT"]."'" : '';
	
	$LABarr = isset($_POST["chkLAB"]) ? $_POST["chkLAB"] : array();
	$LAB = count($LABarr) > 0 ? " AND LAB IN (".implode(',',$LABarr).")" : '';
	
	$SHAPEarr = isset($_POST["chkSHAPE"]) ? $_POST["chkSHAPE"] : array();
	$SHAPE = count($SHAPEarr) > 0 ? " AND SHAPE IN (".implode(',',$SHAPEarr).")" : '';
	
	$COLORarr = isset($_POST["chkCOLOR"]) ? $_POST["chkCOLOR"] : array();
	$COLOR =  count($COLORarr) > 0 ? " AND COLOR IN (".implode(',',$COLORarr).")" : '';
	
	$CLARITYarr = isset($_POST["chkCLARITY"]) ? $_POST["chkCLARITY"] : array();
	$CLARITY =  count($CLARITYarr) > 0 ? " AND CLARITY IN (".implode(',',$CLARITYarr).")" : '';
	
	$CUTarr = isset($_POST["chkCUT"]) ? $_POST["chkCUT"] : array();
	$CUT = count($CUTarr) > 0 ? " AND CUT IN (".implode(',',$CUTarr).")" : '';
	
	$POLISHarr = isset($_POST["chkPOLISH"]) ? $_POST["chkPOLISH"] : array();
	$POLISH = count($POLISHarr) > 0 ? " AND POLISH IN (".implode(',',$POLISHarr).")" : '';
	
	$SYMMarr = isset($_POST["chkSYMM"]) ? $_POST["chkSYMM"] : array();
	$SYMM = count($SYMMarr) > 0 ? " AND SYMM IN (".implode(',',$SYMMarr).")" : '';
	
	$FLOURarr = isset($_POST["chkFLOUR"]) ? $_POST["chkFLOUR"] : array();
	$FLOUR = count($FLOURarr) > 0 ? " AND FLOURANCE IN (".implode(',',$FLOURarr).")" : '';
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
				 <form action="<?php echo SITEURL; ?>makexls.php?makexls=sale-stock_1" method="post">
					<p>
						<button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> XLS</button>
					</p>
					
					<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
							<thead>
								<tr>
									
									
									<th>StockId</th>			
									<th>New StockId</th>			
									<th>Location</th>												
									<th>Party</th>		
									<th>Date</th>		
									<th>Lb</th>
									<th>Certi</th>
									<th>Shp</th>	
									<th>Wt</th>									
									<th>Cl/Cla</th>
									<th>$</th>									
									<th>Per/Crt</th>
									<th>Rs Amt(Sale)</th>
									<th>Rs Amt(Pur)</th>
									<th class="diffcls">P & l</th>
									<th>C/P/S</th>
									<th>Flu</th>
									<th>Mesu</th>
									<th>TB(%)</th>
									<th>TD(%)</th>
									
								</tr>
							 </thead>
							<tbody>
						
							<?php
							$idx = 1;
							
							$res = getData(BARCODE_PROCESS,$AllArr," WHERE PROCESSTYPE='Sale'" . $BARCODENO.$CERTIFICATENO.$LAB.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOUR.$GREEN.$MILKY." ORDER BY CAST(SUBSTR(BARCODENO,3) AS UNSIGNED)");
							$SALEBARCODETEXT='';
							while($resdata = mysqli_fetch_assoc($res))
							{
								$NEWBARCODENO = getFieldDetail(BARCODE_PROCESS,"NEWBARCODENO"," WHERE PROCESSTYPE='Recut Receive' AND BARCODENO='".$resdata["BARCODENO"]."'");
								$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
								$PUR_AMT = getFieldDetail(BARCODE_PROCESS,"RSAMOUNT"," WHERE BARCODENO ='".$resdata["BARCODENO"]."' AND PROCESSTYPE='Purchase'");
								$SALEBARCODETEXT .= "'".$resdata["BARCODENO"]."',"
								?>
								
										<tr class="<?php echo $classname;?>">
										
											<td class="open_custom_overlay" rel="<?php echo substr($resdata["BARCODENO"],2);?>"><a href="javascript:void(0)"><?php echo $resdata["BARCODENO"];?></a></td>
											<td><?php echo $NEWBARCODENO;?></td>
											<td><?php echo $resdata["LOCATIONNAME"];?></td>
											<td><?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resdata["LEDGERID"]."'");?></td>
											
											<td><?php echo getDateFormat(getFieldDetail(PURCHASESALE,"VOUCHERDATE"," WHERE ID ='".$resdata["ID"]."' AND VOUCHERTYPE='Sale'"));?></td>
											
											<td><?php echo $resdata["LAB"];?></td>
											<td><?php echo $resdata["CERTIFICATENO"];?></td>
											<td><?php echo $resdata["SHAPE"];?></td>
											
											<td class="amountalign"><?php echo number_format((float)$resdata["WEIGHT"], 2, '.', '');?></td>
											<td><?php echo $resdata["COLOR"]."-".$resdata["CLARITY"];?></td>
											<td class="amountalign"><?php echo $resdata["CONVRATE"];?></td>
											<td class="amountalign"><?php echo getCurrFormat($resdata["RSPERCRT"]);?></td>
											<td class="amountalign"><?php echo getCurrFormat($resdata["RSAMOUNT"]);?></td>
											<td class="amountalign"><?php echo getCurrFormat($PUR_AMT);?></td>
											<td class="amountalign diffcls"><?php echo getCurrFormat($resdata["RSAMOUNT"]- $PUR_AMT)?></td>
											<td><?php echo $resdata["CUT"]."/".$resdata["POLISH"]."/".$resdata["SYMM"];?></td>
											<td><?php echo $resdata["FLOURANCE"];?></td>
											
											<td><?php echo $resdata["MESU1"]."-".$resdata["MESU2"]."x".$resdata["MESU3"];?> mm</td>
											<td><?php echo $resdata["DEPTHPER"];?></td>
											<td><?php echo $resdata["TABLEPER"];?></td>
										
										</tr>
								<?php
							}
							$SALEBARCODETEXT = empty($SALEBARCODETEXT) ? '' : substr($SALEBARCODETEXT,0,strlen($SALEBARCODETEXT)-1);
							?>
							</tbody>
							<input type="hidden" name="SALEBARCODETEXT" value="<?php echo $SALEBARCODETEXT;?>"/>
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
