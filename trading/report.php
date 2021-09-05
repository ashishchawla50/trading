<?php
$rptcolspan='';
?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Report</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>

<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading" id="filterpanel">
                   Filter
                </div>
				<div class="panel-body" id="filterpanelbody">
					<!--<form id="frm_FILTEtable" action="<?php echo SITEURL; ?>?report" method="POST">-->
					<form action="<?php echo SITEURL; ?>?report" method="POST" id="frmstock" enctype="multipart/form-data">
							
							<div class="row  ">
								<div class="col-lg-3">
										<label>Report List:</label>
										<select  class="form-control" name="cmbREPORTLIST" id="cmbREPORTLIST">
											<option value=""> Select Report </option>
											<?php				
											$strrpt = isset($PostArrayReport["cmbREPORTLIST"]) ? $PostArrayReport["cmbREPORTLIST"] : "";
											
											$resreportlist  = getData(REPORTLIST,$AllArr," WHERE REPORTNAME != '' ".$RPT_LST." ORDER BY REPORTNAME ");
											
											while($resreportlistdata = mysqli_fetch_assoc($resreportlist))
											{
												?>
												<option title="<?php echo $resreportlistdata["REPORTNAME"];?>" value="<?php echo $resreportlistdata["REPORTNAME"];?>" <?php echo $resreportlistdata["REPORTNAME"] == $strrpt ? 'selected="selected"' :'';?>  ><?php echo $resreportlistdata["REPORTNAME"]?></option>
												<?php
											}
											?>								
										</select>
									</div>
								<div class="col-lg-2">
									<label>Date:</label>	
									<input type="date" class="form-control " name="dtpFROMDATE" id="dtpFROMDATE" value=""/> <span style="padding-left:10px;padding-right:10px;">To</span> <input type="date" class="form-control"  name="dtpENDDATE" id="dtpENDDATE" value=""/>									
								</div>
								
								<div class="col-lg-1">
									<label>Weight:</label>
									<input type="text" class="form-control onlyNumber" name="txtFRMWEIGHT" id="txtFRMWEIGHT" value="<?php echo isset($PostArrayReport["txtFRMWEIGHT"]) && !empty($PostArrayReport["txtFRMWEIGHT"]) ? $PostArrayReport["txtFRMWEIGHT"] : ''; ?>" /> <span style="padding-left:10px;padding-right:10px;">To</span> <input type="text" class="form-control onlyNumber"  name="txtTOWEIGHT" id="txtTOWEIGHT" value="<?php echo isset($PostArrayReport["txtTOWEIGHT"]) && !empty($PostArrayReport["txtTOWEIGHT"]) ? $PostArrayReport["txtTOWEIGHT"] : ''; ?>" />
								</div>
								<div class="col-lg-1">
									<label>Stock Id:</label>
									<input type="text" class="form-control" name="txtFRMBARCODENO" id="txtFRMBARCODENO" value="<?php echo isset($PostArrayReport["txtFRMBARCODENO"]) && !empty($PostArrayReport["txtFRMBARCODENO"]) ? $PostArrayReport["txtFRMBARCODENO"] : ''; ?>" /> <span style="padding-left:10px;padding-right:10px;">To</span> <input type="text" class="form-control"  name="txtTOBARCODENO" id="txtTOBARCODENO" value="<?php echo isset($PostArrayReport["txtTOBARCODENO"]) && !empty($PostArrayReport["txtTOBARCODENO"]) ? $PostArrayReport["txtTOBARCODENO"] : ''; ?>" />
								</div>
								<div class="col-lg-2" style="display:none">
									<label>Month:</label>
									<select class="form-control" name="txtMONTH" id="txtMONTH" size='1'>
									<option value=""></option>	
									<?php
										$month_result = isset($PostArrayReport["txtMONTH"]) ? $PostArrayReport["txtMONTH"] : '';
										
										for ($i = 0; $i < 12; $i++) 
										{
											$time = strtotime(sprintf('%d months', $i));   
											$label = date('F', $time);   
											$value = date('n', $time);
										?>
											<option value="<?php echo $value;?>" <?php echo $value== $month_result ? 'selected="selected"':'';?> ><?php echo $label;?></option>
											 
										<?php
										}
										?>
									</select>
								</div>
									<div class="col-lg-2" style="display:none">
									<label>Year:</label>
									<select class="form-control" name="txtYEAR" id="txtYEAR">
									<option value=""></option>
									<?php
										$year_result = isset($PostArrayReport["txtYEAR"]) ? $PostArrayReport["txtYEAR"] : '';
										
										for ($year=2000; $year <= 2030; $year++)
										{
										?>
										  <option value="<?php echo $year;?>"  <?php echo $year== $year_result ? 'selected="selected"':'';?>><?php echo $year;?></option>
														
										<?php
										}
										?>
									</select>
								</div>
									
							</div>	
							<div class="row">
							
							
								<div class="col-lg-2">
									<label>Party:</label>
									<select class="form-control" name="txtLEDGERID" id="txtLEDGERID">
									
										<option value=""></option>
										<?php
										$led_result = isset($PostArrayReport["txtLEDGERID"]) ? $PostArrayReport["txtLEDGERID"] : '';
										
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID IN('25','26') ORDER BY LEDGERNAME");
											while($res_led_data = mysqli_fetch_assoc($res_led))
														{
														
															?>
															<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]== $led_result ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								<div class="col-lg-2">
									<label>Broker:</label>
									<select class="form-control" name="txtBROKERID" id="txtBROKERID">
									
										<option value=""></option>
										<?php
										$bro_result = isset($PostArrayReport["txtBROKERID"]) ? $PostArrayReport["txtBROKERID"] : '';
										
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID IN('29') ORDER BY LEDGERNAME");
											while($res_led_data = mysqli_fetch_assoc($res_led))
														{
														
															?>
															<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]== $bro_result ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								
								<div class="col-lg-2">
									<label>Partner:</label>
									<select class="form-control" name="txtPARTNERID" id="txtPARTNERID">
									
										<option value=""></option>
										<?php
										$led_result = isset($PostArrayReport["txtPARTNERID"]) ? $PostArrayReport["txtPARTNERID"] : '';
										
											$res_partled = getData(LEDGER,$AllArr," WHERE FLAG='0' AND LEDGERID IN(SELECT DISTINCT(PARTNERID) FROM ".PURCHASESALE." WHERE FLAG='0')");
											
											while($res_partled_data = mysqli_fetch_assoc($res_partled))
														{
														
															?>
															<option value="<?php echo $res_partled_data["LEDGERID"];?>" <?php echo $res_partled_data["LEDGERID"]== $led_result ? 'selected="selected"':'';?>><?php echo $res_partled_data["LEDGERNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
							</div>
							<div class="row">
								
								
								<div class="col-lg-1">
									<label>Shape:</label>
									<select class="form-control" name="txtSHAPE" id="txtSHAPE">
									
										<option value=""></option>
										<?php
										$shape_result = isset($PostArrayReport["txtSHAPE"]) ? $PostArrayReport["txtSHAPE"] : '';
										
											$resShape = getData(SHAPE_MST,$AllArr," WHERE FLAG='0' ORDER BY SHAPENAME");
											while($resShape_data = mysqli_fetch_assoc($resShape))
														{
														
															?>
															<option value="<?php echo $resShape_data["SHAPENAME"];?>" <?php echo $resShape_data["SHAPENAME"]== $shape_result ? 'selected="selected"':'';?>><?php echo $resShape_data["SHAPENAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								
								<div class="col-lg-1">
									<label>Color:</label>
									<select class="form-control" name="txtCOLOR" id="txtCOLOR">
									
										<option value=""></option>
										<?php
										$color_result = isset($PostArrayReport["txtCOLOR"]) ? $PostArrayReport["txtCOLOR"] : '';
										
											$resColor = getData(COLOR_MST,$AllArr," WHERE FLAG='0' ORDER BY COLORNAME");
											while($resColor_data = mysqli_fetch_assoc($resColor))
														{
														
															?>
															<option value="<?php echo $resColor_data["COLORNAME"];?>" <?php echo $resColor_data["COLORNAME"]== $color_result ? 'selected="selected"':'';?>><?php echo $resColor_data["COLORNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								
								<div class="col-lg-1">
									<label>Clarity:</label>
									<select class="form-control" name="txtCLARITY" id="txtCLARITY">
									
										<option value=""></option>
										<?php
										$clarity_result = isset($PostArrayReport["txtCLARITY"]) ? $PostArrayReport["txtCLARITY"] : '';
										
											$resClarity = getData(CLARITY_MST,$AllArr," WHERE FLAG='0' ORDER BY CLARITYNAME");
											while($resClarity_data = mysqli_fetch_assoc($resClarity))
														{
														
															?>
															<option value="<?php echo $resClarity_data["CLARITYNAME"];?>" <?php echo $resClarity_data["CLARITYNAME"]== $clarity_result ? 'selected="selected"':'';?>><?php echo $resClarity_data["CLARITYNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								<div class="col-lg-1">
									<label>Cut:</label>
									<select class="form-control" name="txtCUT" id="txtCUT">
									
										<option value=""></option>
										<?php
										$cut_result = isset($PostArrayReport["txtCUT"]) ? $PostArrayReport["txtCUT"] : '';
										
											$resCut = getData(CUT_MST,$AllArr," WHERE FLAG='0' ORDER BY CUTNAME");
											while($resCut_data = mysqli_fetch_assoc($resCut))
														{
														
															?>
															<option value="<?php echo $resCut_data["CUTNAME"];?>" <?php echo $resCut_data["CUTNAME"]== $cut_result ? 'selected="selected"':'';?>><?php echo $resCut_data["CUTNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								<div class="col-lg-1">
									<label>Polish:</label>
									<select class="form-control" name="txtPOLISH" id="txtPOLISH">
									
										<option value=""></option>
										<?php
										$polish_result = isset($PostArrayReport["txtPOLISH"]) ? $PostArrayReport["txtPOLISH"] : '';
										
											$resPolish = getData(POLISH_MST,$AllArr," WHERE FLAG='0' ORDER BY POLISHNAME");
											while($resPolish_data = mysqli_fetch_assoc($resPolish))
														{
														
															?>
															<option value="<?php echo $resPolish_data["POLISHNAME"];?>" <?php echo $resPolish_data["POLISHNAME"]== $polish_result ? 'selected="selected"':'';?>><?php echo $resPolish_data["POLISHNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								
								<div class="col-lg-1">
									<label>Symm:</label>
									<select class="form-control" name="txtSYMM" id="txtSYMM">
									
										<option value=""></option>
										<?php
										$symm_result = isset($PostArrayReport["txtSYMM"]) ? $PostArrayReport["txtSYMM"] : '';
										
											$resSymm = getData(SYMM_MST,$AllArr," WHERE FLAG='0' ORDER BY SYMMNAME");
											while($resSymm_data = mysqli_fetch_assoc($resSymm))
														{
														
															?>
															<option value="<?php echo $resSymm_data["SYMMNAME"];?>" <?php echo $resSymm_data["SYMMNAME"]== $symm_result ? 'selected="selected"':'';?>><?php echo $resSymm_data["SYMMNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								<div class="col-lg-1">
									<label>Flour:</label>
									<select class="form-control" name="txtFLOURANCE" id="txtFLOURANCE">
									
										<option value=""></option>
										<?php
										$flour_result = isset($PostArrayReport["txtFLOURANCE"]) ? $PostArrayReport["txtFLOURANCE"] : '';
										
											$resFlour = getData(FLOUR_MST,$AllArr," WHERE FLAG='0' ORDER BY FLOURNAME");
											while($resFlour_data = mysqli_fetch_assoc($resFlour))
														{
														
															?>
															<option value="<?php echo $resFlour_data["FLOURNAME"];?>" <?php echo $resFlour_data["FLOURNAME"]== $flour_result ? 'selected="selected"':'';?>><?php echo $resFlour_data["FLOURNAME"];?></option>
															
															
															<?php
														}
													?>
									</select>
												
									
								</div>
								<div class="col-lg-2">
									<label>Order By:</label>
									<select class="form-control" name="txtORDERBY" id="txtORDERBY">
									
										<option value=""></option>
										<option value="Date" <?php echo isset($PostArrayReport["txtORDERBY"]) && $PostArrayReport["txtORDERBY"] == 'Date' ? 'selected="selected"' :'';?>>Date</option>
										<option value="GP" <?php echo isset($PostArrayReport["txtORDERBY"]) && $PostArrayReport["txtORDERBY"] == 'GP' ? 'selected="selected"' :'';?>>GP</option>
									</select>
								</div>
							</div>
							<BR>
							<button type="submit" class="btn btn-success" style="float: right;" name="report">Submit Button</button>
						<button type="submit" class="btn btn-primary" style="float: right;" id="resetreport"  name="resetreport">Clear Button</button>
						
					</form>
				</div>
			</div>
		</div>
</div>

<?php
	
	$WEIGHT = (isset($PostArrayReport["txtFRMWEIGHT"]) && !empty($PostArrayReport["txtFRMWEIGHT"])) && (isset($PostArrayReport["txtTOWEIGHT"]) && !empty($PostArrayReport["txtTOWEIGHT"])) ? " AND BP.WEIGHT BETWEEN '".$PostArrayReport["txtFRMWEIGHT"]."' AND '".$PostArrayReport["txtTOWEIGHT"]."'" : '';
	$dtfrm = isset($PostArrayReport["dtpFROMDATE"]) ? $PostArrayReport["dtpFROMDATE"] : '' ;
	$dtto = isset($PostArrayReport["dtpENDDATE"]) ? $PostArrayReport["dtpENDDATE"] : '' ;	
	$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND BP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
	$VOUCHERDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND DR.VOUCHERDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
	$x = 1;
	$str =  (isset($PostArrayReport["txtFRMBARCODENO"]) && !empty($PostArrayReport["txtFRMBARCODENO"])) ? $PostArrayReport["txtFRMBARCODENO"]: ''; //$PostArrayReport["txtFRMBARCODENO"];
	$strto = (isset($PostArrayReport["txtTOBARCODENO"]) && !empty($PostArrayReport["txtTOBARCODENO"])) ? $PostArrayReport["txtTOBARCODENO"]: '';//$PostArrayReport["txtTOBARCODENO"];
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
	
	$BARCODENO = (isset($PostArrayReport["txtFRMBARCODENO"]) && !empty($PostArrayReport["txtFRMBARCODENO"])) && (isset($PostArrayReport["txtTOBARCODENO"]) && !empty($PostArrayReport["txtTOBARCODENO"])) ? " AND BP.BARCODENO LIKE CONCAT('" .$id."','%') AND substr(BP.BARCODENO,(".$frombarcodecount."+1)) BETWEEN '" .$frombar . "' AND  '" .$tobar."'" : '';
	
	//$DUEDATE = (isset($PostArrayReport["dtpDUEDATE"]) && !empty($PostArrayReport["dtpDUEDATE"])) ? " AND P.DUEDATE = '".$PostArrayReport["dtpDUEDATE"]."'" : '';
	$DUEDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND  P.DUEDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
	
	
	$MONTH = isset($PostArrayReport["txtMONTH"]) ? $PostArrayReport["txtMONTH"] : '' ;
	$YEAR = isset($PostArrayReport["txtYEAR"]) ? $PostArrayReport["txtYEAR"] : '' ;
	//$MONTH = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND DATE_FORMAT(VOUCHERDATE,'%m') BETWEEN '".$dtfrm."' AND '".$dtto."'" : '' ;
	//$YEAR = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND DATE_FORMAT(VOUCHERDATE,'%Y') BETWEEN '".$dtfrm."' AND '".$dtto."'" : '' ;
	
	if(isset($PostArrayReport["txtLEDGERID"]) && !empty($PostArrayReport["txtLEDGERID"]))
	{
		$PARTY =  $PostArrayReport["txtLEDGERID"];		
		$PARTY =  " AND L.LEDGERID IN ('".$PARTY."')" ;
	}
	else
	{
		$PARTY='';
	}
	
	
	if(isset($PostArrayReport["txtPARTNERID"]) && !empty($PostArrayReport["txtPARTNERID"]))
	{
		$PARTNER =  $PostArrayReport["txtPARTNERID"];		
		$PARTNER =  " AND PRL.LEDGERID IN ('".$PARTNER."')" ;
	}
	else
	{
		$PARTNER='';
	}
	
	if(isset($PostArrayReport["txtBROKERID"]) && !empty($PostArrayReport["txtBROKERID"]))
	{
		$BROKER =  $PostArrayReport["txtBROKERID"];		
		$BROKER =  " AND B.LEDGERID IN ('".$BROKER."')" ;
	}
	else
	{
		$BROKER='';
	}
	
	
	if(isset($PostArrayReport["txtSHAPE"]) && !empty($PostArrayReport["txtSHAPE"]))
	{
		$SHAPE =  $PostArrayReport["txtSHAPE"];		
		$SHAPE =  " AND BP.SHAPE IN ('".$SHAPE."')" ;
	}
	else
	{
		$SHAPE='';
	}
	
	if(isset($PostArrayReport["txtCOLOR"]) && !empty($PostArrayReport["txtCOLOR"]))
	{
		$COLOR =  $PostArrayReport["txtCOLOR"];	
		$COLOR =  " AND BP.COLOR IN ('".$COLOR."')" ;
	}
	else
	{
		$COLOR='';
	}
	
	if(isset($PostArrayReport["txtCLARITY"]) && !empty($PostArrayReport["txtCLARITY"]))
	{
		$CLARITY =  $PostArrayReport["txtCLARITY"];		
		$CLARITY =  " AND BP.CLARITY IN ('".$CLARITY."')" ;
	}
	else
	{
		$CLARITY='';
	}
	
	if(isset($PostArrayReport["txtCUT"]) && !empty($PostArrayReport["txtCUT"]))
	{
		$CUT =  $PostArrayReport["txtCUT"];		
		$CUT =  " AND BP.CUT IN ('".$CUT."')" ;
	}
	else
	{
		$CUT='';
	}
	if(isset($PostArrayReport["txtPOLISH"]) && !empty($PostArrayReport["txtPOLISH"]))
	{
		$POLISH =  $PostArrayReport["txtPOLISH"];		
		$POLISH =  " AND BP.POLISH IN ('".$POLISH."')" ;
	}
	else
	{
		$POLISH='';
	}
	if(isset($PostArrayReport["txtSYMM"]) && !empty($PostArrayReport["txtSYMM"]))
	{
		$SYMM =  $PostArrayReport["txtSYMM"];		
		$SYMM =  " AND BP.SYMM IN ('".$SYMM."')" ;
	}
	else
	{
		$SYMM='';
	}
	if(isset($PostArrayReport["txtFLOURANCE"]) && !empty($PostArrayReport["txtFLOURANCE"]))
	{
		$FLOURANCE =  $PostArrayReport["txtFLOURANCE"];		
		$FLOURANCE =  " AND BP.FLOURANCE IN ('".$FLOURANCE."')" ;
	}
	else
	{
		$FLOURANCE='';
	}
	if(isset($PostArrayReport["txtORDERBY"]) && !empty($PostArrayReport["txtORDERBY"]))
	{
		$ORDERBY =  $PostArrayReport["txtORDERBY"];		
		//$ORDERBY =  " AND BP.FLOURANCE IN ('".$FLOURANCE."')" ;
	}
	else
	{
		$ORDERBY='';
	}

if(isset($_POST["pdfprintreport"]))
{
	require_once(INIT.'script/tcpdf/tcpdf.php');
	class MYPDF extends TCPDF {
		public function Header() {
				$this->SetFont('times', '', 14);
				$html = '<table width="100%">
							<tr>
								<td colspan="2" style="text-align:center;font-weight:bold;">'.getFieldDetail(COMPANY,"COMPANYNAME","").'</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:center;font-weight:bold;">'.getFieldDetail(COMPANY,"ADDRESS","").". ".getFieldDetail(COMPANY,"PINCODE","").'</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:center;font-weight:bold;"> Ph.:'.getFieldDetail(COMPANY,"PHONE","").' Email:'.getFieldDetail(COMPANY,"EMAIL","").'</td>
							</tr>
							</table>
							<hr>';
					$this->writeHTML($html, true, false, false, false, '');			
			}
						
			// Page footer
		public function Footer() {
						
						
				// Position at 15 mm from bottom
				$this->SetY(-15);
				// Set font
				$this->SetFont('helvetica', 'I', 8);
				// Page number
				$this->Cell(0, 15, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
				}
		}
		$pdf = new MYPDF("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set margins
		$pdf->SetMargins(0.2, PDF_MARGIN_TOP, 0.2);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE,12);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set font
		$pdf->SetFont('times', 6);

		// add a page
		
		
	if(isset($_POST["REPORTLIST"]))
	{
		switch($PostArrayReport["cmbREPORTLIST"])
		{
			case "Purchase":
			{
				$pdf->AddPage("L","A4");
				
									$FieldArr= array();				
									array_push($FieldArr,"BP.ENTRYID");
									array_push($FieldArr,"BP.ID");
									array_push($FieldArr,"BP.ENTRYDATE");
									array_push($FieldArr,"L.LEDGERNAME AS PARTY");
									array_push($FieldArr,"B.LEDGERNAME AS BROKER");
									array_push($FieldArr,"BP.REMARK");
									array_push($FieldArr,"BARCODENO");
									array_push($FieldArr,"WEIGHT");
									array_push($FieldArr,"SHAPE");
									array_push($FieldArr,"COLOR");
									array_push($FieldArr,"CLARITY");
									array_push($FieldArr,"CUT");
									array_push($FieldArr,"POLISH");
									array_push($FieldArr,"SYMM");
									array_push($FieldArr,"FLOURANCE");
									array_push($FieldArr,"GREEN");
									array_push($FieldArr,"MILKY");
									array_push($FieldArr,"LAB");
									array_push($FieldArr,"CERTIFICATENO");
									array_push($FieldArr,"RATE");
									array_push($FieldArr,"DISCPER");
									array_push($FieldArr,"PERCRTDOLLAR");
									array_push($FieldArr,"RATEDOLLAR");
									array_push($FieldArr,"BP.CONVRATE");
									array_push($FieldArr,"BP.RSPERCRT");
									array_push($FieldArr,"BP.RSAMOUNT");
									array_push($FieldArr,"PS.VOUCHERDATE");
					switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
						break;
					}
					
					$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID 
					AND PS.VOUCHERTYPE=BP.PROCESSTYPE INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID 
					LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' "
					.$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
					$html ='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Purchase</h5></td>
						</tr>
						
						</table>
					<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
													<th  >Sr No</th>
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>
													
																				
													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>	
													
													
													<th>Rate</th>
													<th>Disc</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
													
												</tr>
											</thead>
								<tbody>
								
							';
				
									$idx = 1;
									while($resdata = mysqli_fetch_assoc($res))
										{
											$html.='<tr>
												
													<td >'.$idx++.'</td>
													<td>'.getDateFormat($resdata["VOUCHERDATE"]).'</td>
													<td>'.$resdata["BARCODENO"].'</td>
													<td>'.$resdata["PARTY"].'</td>
													<td>'.$resdata["BROKER"].'</td>
													<td>'.$resdata["WEIGHT"].'</td>
													<td>'.$resdata["SHAPE"].'</td>
													<td>'.$resdata["COLOR"].'</td>
													<td>'.$resdata["CLARITY"].'</td>
													<td>'.$resdata["CUT"].'</td>
													<td>'.$resdata["POLISH"].'</td>
													<td>'.$resdata["SYMM"].'</td>
													<td>'.$resdata["FLOURANCE"].'</td>
													<td>'.$resdata["CERTIFICATENO"].'</td>
													<td>'.$resdata["LAB"].'</td>
													
												
													<td class="amountalign">'.getCurrFormat0($resdata["RATE"]) .'</td>
													<td class="amountalign">'.getCurrFormat($resdata["DISCPER"]) .'</td>
													<td class="amountalign">'.getCurrFormat($resdata["PERCRTDOLLAR"]) .'</td>
													<td class="amountalign">'.getCurrFormat($resdata["RATEDOLLAR"]) .'</td>
													<td class="amountalign">'.getCurrFormat($resdata["CONVRATE"]) .'</td>
													<td class="amountalign">'.getCurrFormat($resdata["RSPERCRT"]) .'</td>
													<td class="amountalign">'.getCurrFormat($resdata["RSAMOUNT"]) .'</td>
													
												</tr>';
										}
								$html.='                                       
								</tbody>
							</table>';
			}
			break;
			case "Sale":
			{
				$pdf->AddPage("L","A4");
				$FieldArr= array();
				array_push($FieldArr,"BP.ENTRYID");
				array_push($FieldArr,"BP.ID");
				array_push($FieldArr,"BP.ENTRYDATE");
				array_push($FieldArr,"L.LEDGERNAME AS PARTY");
				array_push($FieldArr,"B.LEDGERNAME AS BROKER");
				array_push($FieldArr,"BP.REMARK");
				array_push($FieldArr,"BARCODENO");
				array_push($FieldArr,"WEIGHT");
				array_push($FieldArr,"SHAPE");
				array_push($FieldArr,"COLOR");
				array_push($FieldArr,"CLARITY");
				array_push($FieldArr,"CUT");
				array_push($FieldArr,"POLISH");
				array_push($FieldArr,"SYMM");
				array_push($FieldArr,"FLOURANCE");
				array_push($FieldArr,"GREEN");
				array_push($FieldArr,"MILKY");
				array_push($FieldArr,"LAB");
				array_push($FieldArr,"CERTIFICATENO");
				array_push($FieldArr,"RATE");
				array_push($FieldArr,"DISCPER");
				array_push($FieldArr,"PERCRTDOLLAR");
				array_push($FieldArr,"RATEDOLLAR");
				array_push($FieldArr,"BP.CONVRATE");
				array_push($FieldArr,"BP.RSPERCRT");
				array_push($FieldArr,"BP.RSAMOUNT");
				array_push($FieldArr,"PS.VOUCHERDATE");
				
				switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
						break;
					}
					
				$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE 
				INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID 
				WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Sale' " .$VDATE .$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
				$html ='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Sale</h5></td>
						</tr>
						
						</table>
				
				<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
														<th >Sr No</th>														
														<th>Date</th>	
														<th>Stock Id</th>
														<th>Party</th>
														<th>Broker</th>	

														<th>WT</th>	
														<th>Shp</th>	
														<th>Cl</th>	
														<th>Cal</th>	
														<th>Ct</th>	
														<th>PO</th>	
														<th>Sy</th>	
														<th>Flu</th>
														<th>Certi</th>										
														<th>Lb</th>	

													
														
														
														<th>Rate</th>
														<th>Disc %</th>
														<th>$/Crt</th>
														<th>Rate $</th>
														<th>$</th>
														<th>Rs/Crt</th>
														<th>Rs Amt</th>
													</tr>
												 </thead>
												<tbody>';
												$idx = 1;
				while($resdata = mysqli_fetch_assoc($res))
						{
							$html.='<tr>
										<td >'.$idx++.'</td>
										<td>'.getDateFormat($resdata["VOUCHERDATE"]).'</td>
										<td>'.$resdata["BARCODENO"].'</td>
										<td>'.$resdata["PARTY"].'</td>
										<td>'.$resdata["BROKER"].'</td>
										<td>'.$resdata["WEIGHT"].'</td>
										<td>'.$resdata["SHAPE"].'</td>
										<td>'.$resdata["COLOR"].'</td>
										<td>'.$resdata["CLARITY"].'</td>
										<td>'.$resdata["CUT"].'</td>
										<td>'.$resdata["POLISH"].'</td>
										<td>'.$resdata["SYMM"].'</td>
										<td>'.$resdata["FLOURANCE"].'</td>
										<td>'.$resdata["CERTIFICATENO"].'</td>
										<td>'.$resdata["LAB"].'</td>
										<td class="amountalign">'.getCurrFormat0($resdata["RATE"]) .'</td>
										<td class="amountalign">'.getCurrFormat($resdata["DISCPER"]) .'</td>
										<td class="amountalign">'.getCurrFormat($resdata["PERCRTDOLLAR"]) .'</td>
										<td class="amountalign">'.getCurrFormat($resdata["RATEDOLLAR"]) .'</td>
										<td class="amountalign">'.getCurrFormat($resdata["CONVRATE"]) .'</td>
										<td class="amountalign">'.getCurrFormat($resdata["RSPERCRT"]) .'</td>
										<td class="amountalign">'.getCurrFormat($resdata["RSAMOUNT"]) .'</td>
									</tr>';
							}
					$html.='</tbody>
								</table>';
			
			}
			break;
			
			//=============================Monthly Purchase And Sale===================
		case "Monthly Purchase And Sale":
		{
				$pdf->AddPage("L","A4");						
				
				$FieldArr= array();
				array_push($FieldArr,"DR.VOUCHERDATE");
				array_push($FieldArr,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
				array_push($FieldArr,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
				array_push($FieldArr,"round(SUM(DR.TCSAMT)) AS TCSAMT");
				array_push($FieldArr,"round(SUM(DR.THIRDPARTYCHARGES)) AS THIRDPARTYCHARGES");
				array_push($FieldArr,"round(SUM(DR.THIRDPARTYTCS)) AS THIRDPARTYTCS");
				array_push($FieldArr,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALPURCHASE");			
				$respurchase = getData(PURCHASESALE,$FieldArr," AS DR WHERE VOUCHERTYPE='Purchase' ".$VOUCHERDATE." GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
				
				$FieldArrsale= array();				
				array_push($FieldArrsale,"DR.VOUCHERDATE");
				array_push($FieldArrsale,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
				array_push($FieldArrsale,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
				array_push($FieldArrsale,"round(SUM(DR.TCSAMT)) AS TCSAMT");
				array_push($FieldArrsale,"round(SUM(DR.THIRDPARTYCHARGES)) AS THIRDPARTYCHARGES");
				array_push($FieldArrsale,"round(SUM(DR.THIRDPARTYTCS)) AS THIRDPARTYTCS");

				array_push($FieldArrsale,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALSALE");
				$ressale = getData(PURCHASESALE,$FieldArrsale," AS DR WHERE VOUCHERTYPE='Sale' ".$VOUCHERDATE." GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
			

				$PURCHASEcnt = mysqli_num_rows($respurchase);
				$SALEcnt = mysqli_num_rows($ressale);
				
				$html='<table width="100%" style="font-size:0.8em;">
								<tr>
									<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Monthly Purchase And Sale</h5></td>
								</tr>
						
							</table>
								<table width="100%" border="1">
								<thead>
									<tr>
										<th style="text-align:center;" >Sr No.</th>
										<th style="text-align:center;">Year</th>	
										<th style="text-align:center;">Month</th>
										<th style="text-align:center;">Purchase Amt</th>
										<th style="text-align:center;">Sale Amt</th>
										<th style="text-align:center;">Ratio</th>
										<th style="text-align:center;">Tax In</th>
										<th style="text-align:center;">Tax Out</th>
										<th style="text-align:center;">TCS In</th>
										<th style="text-align:center;">TCS Out</th>
										<th style="text-align:center;">Third Party Charges</th>
										<th style="text-align:center;">Third Party TCS</th>
										<th style="text-align:center;">Opening Stock</th>
										<th style="text-align:center;">Closing Stock</th>
										<th style="text-align:center;">Gross P/L</th>
										<th style="text-align:center;">GP Ratio</th>
									</tr>
								 </thead>
								<tbody>';
				if($PURCHASEcnt >= $SALEcnt)
				{
					$idx = 1;
					while($respurchasedata = mysqli_fetch_assoc($respurchase))
						{		
							$time=strtotime($respurchasedata["VOUCHERDATE"]);
							$month=date("m",$time);
							$year=date("Y",$time);
							
							$dt1 = $year."-".$month."-"."01";
							$dt2 = $year."-".$month."-"."31";
							
							$FieldArrsale= array();				
							array_push($FieldArrsale,"DR.VOUCHERDATE");
							array_push($FieldArrsale,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
							array_push($FieldArrsale,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
							array_push($FieldArrsale,"round(SUM(DR.TCSAMT)) AS TCSAMT");
							array_push($FieldArrsale,"round(SUM(DR.THIRDPARTYCHARGES)) AS THIRDPARTYCHARGES");
							array_push($FieldArrsale,"round(SUM(DR.THIRDPARTYTCS)) AS THIRDPARTYTCS");
							array_push($FieldArrsale,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALSALE");
							$ressale = getData(PURCHASESALE,$FieldArrsale," AS DR WHERE VOUCHERTYPE='Sale' and VOUCHERDATE BETWEEN '".$dt1."' AND '".$dt2."' GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
							$ressaleData = mysqli_fetch_assoc($ressale);
							$totalsale_BROKERAMT= $ressaleData["BROKERAMT"];
							$totalsale_GSTAMT= $ressaleData["GSTAMT"];
							$totalsale_TCSAMT= $ressaleData["TCSAMT"];
							$totalsale= $ressaleData["FINALTOTALSALE"];
							
							$OPENSTOCK = getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE < '".$dt1."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE < '".$dt1."' AND PROCESSTYPE='Sale')");
							
							$COSINGSTOCK = (getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE <= '". $dt2 ."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE <= '". $dt2 ."' AND PROCESSTYPE='Sale')"));
							
							
							
							$pur = $OPENSTOCK+$respurchasedata["FINALTOTALPURCHASE"] + $respurchasedata["BROKERAMT"] + $respurchasedata["GSTAMT"]+ $respurchasedata["THIRDPARTYCHARGES"]+ $respurchasedata["THIRDPARTYTCS"]+ $respurchasedata["TCSAMT"];
							
							$sal = $COSINGSTOCK + ($totalsale - $totalsale_BROKERAMT) + $totalsale_GSTAMT+ $totalsale_TCSAMT;
							

//$GP = ($COSINGSTOCK+$totalsale_GSTAMT+($totalsale - $totalsale_BROKERAMT)) - ($OPENSTOCK+$respurchasedata["FINALTOTALPURCHASE"]+$respurchasedata["GSTAMT"]+$respurchasedata["BROKERAMT"]+$respurchasedata["THIRDPARTYCHARGES"]);

							
							if($totalsale == 0)
							{
								$GPRATIO=0;
							}
							else
							{								
								$GPRATIO = (($sal-$pur) / $pur) * 100;
								
							}
							
							$html .= '<tr>
											<td>'.$idx++.'</td>
											<td>'.$year.'</td>
											<td>'.$LIST["Month"][$month].'</td>
											<td style="text-align:right;">'. getCurrFormat($respurchasedata["FINALTOTALPURCHASE"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalsale).'</td>
											<td style="text-align:right;">'.($totalsale > 0 ? getCurrFormat($totalsale/$respurchasedata["FINALTOTALPURCHASE"]) : 0).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["GSTAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalsale_GSTAMT).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["TCSAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalsale_TCSAMT).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["THIRDPARTYCHARGES"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["THIRDPARTYTCS"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($OPENSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($COSINGSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat(($COSINGSTOCK+$totalsale+$totalsale_GSTAMT+$totalsale_TCSAMT) - ($OPENSTOCK+$respurchasedata["FINALTOTALPURCHASE"]+$respurchasedata["GSTAMT"]+$respurchasedata["TCSAMT"]+$respurchasedata["THIRDPARTYCHARGES"]+$respurchasedata["THIRDPARTYTCS"])).'</td>
											<td style="text-align:right;">'.getCurrFormat($GPRATIO).'</td>
									
									</tr>';
						}
				}
				else
				{
					$idx = 1;
					while($ressaledata = mysqli_fetch_assoc($ressale))
						{		
							$time=strtotime($ressaledata["VOUCHERDATE"]);
							$month=date("m",$time);
							$year=date("Y",$time);
							
							$dt1 = $year."-".$month."-"."01";
							$dt2 = $year."-".$month."-"."31";
							
							$FieldArrpur= array();				
							array_push($FieldArrpur,"DR.VOUCHERDATE");
							array_push($FieldArrpur,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
							array_push($FieldArrpur,"round(SUM(DR.TCSAMT)) AS TCSAMT");
							array_push($FieldArrpur,"round(SUM(DR.THIRDPARTYCHARGES)) AS THIRDPARTYCHARGES");
							array_push($FieldArrpur,"round(SUM(DR.THIRDPARTYTCS)) AS THIRDPARTYTCS");
							array_push($FieldArrpur,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALPURCHASE");
							$respurchase = getData(PURCHASESALE,$FieldArrpur," AS DR WHERE VOUCHERTYPE='Purchase' and VOUCHERDATE BETWEEN '".$dt1."' AND '".$dt2."' GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
							$respurchasedata=mysqli_fetch_assoc($respurchase);
							$totalpurchase=$respurchasedata["FINALTOTALPURCHASE"];
							$totalpurchase_GST=$respurchasedata["GSTAMT"];
							$totalpurchase_TCS=$respurchasedata["TCSAMT"];
							$totalpurchase_THIRDPARTYCHARGES=$respurchasedata["THIRDPARTYCHARGES"];
							$totalpurchase_THIRDPARTYTCS=$respurchasedata["THIRDPARTYTCS"];
							
							$OPENSTOCK = getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE < '".$dt1."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE < '".$dt1."' AND PROCESSTYPE='Sale')");
							
							$COSINGSTOCK = (getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE <= '". $dt2 ."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE <= '". $dt2 ."' AND PROCESSTYPE='Sale')"));
							$GP = ($COSINGSTOCK+$ressaledata["FINALTOTALSALE"]+$ressaledata["GSTAMT"]+$ressaledata["TCSAMT"]) - ($OPENSTOCK+$totalpurchase+$totalpurchase_GST+$totalpurchase_TCS+$totalpurchase_THIRDPARTYCHARGES+$totalpurchase_THIRDPARTYTCS);
							
							$GPRATIO = ($GP / $ressaledata["FINALTOTALSALE"]) * 100;
	
							$html .= '<tr>
											<td>'.$idx++.'</td>
											<td>'.$year.'</td>
											<td>'.$LIST["Month"][$month].'</td>
											<td style="text-align:right;">'. getCurrFormat($totalpurchase).'</td>
											<td style="text-align:right;">'. getCurrFormat($ressaledata["FINALTOTALSALE"]).'</td>
											<td style="text-align:right;">'.($totalpurchase > 0 ? getCurrFormat($ressaledata["FINALTOTALSALE"]/$totalpurchase) : 0).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalpurchase_GST).'</td>
											<td style="text-align:right;">'.getCurrFormat($ressaledata["GSTAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalpurchase_TCS).'</td>
											<td style="text-align:right;">'.getCurrFormat($ressaledata["TCSAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalpurchase_THIRDPARTYCHARGES).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalpurchase_THIRDPARTYTCS).'</td>
											<td style="text-align:right;">'.getCurrFormat($OPENSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($COSINGSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($GP).'</td>
											<td style="text-align:right;">'.getCurrFormat($GPRATIO).'</td>
									</tr>';
																						
						}
				}
				
				$html.='</tbody>
				</table>';
				
		}
		break;
		//=============================MONTHLY SALE AND PURCHASE===================
		//============================PREMIUM SIZE CURRENT STOCK===============================
		case "Premium Size Current Stock":
		{
		$rptcolspan='8';
		$pdf->AddPage("L","A4");
		
			$html='	<table width="100%" style="font-size:0.8em;">
								<tr>
									<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Premium Size Current Stock</h5></td>
								</tr>
						
					</table>
					<table width="100%" border="1">
					<thead>
							<tr>
								<th style="text-align:center;width:5%;" >Sr No</th>
								<th style="text-align:center;width:15%;" >Stock Id</th>
								<th style="text-align:center;width:10%;" >Shp</th>	
								<th style="text-align:center;width:10%;" >Carat</th>									
								<th style="text-align:center;width:10%;">Col</th>
								<th style="text-align:center;width:10%;">Cla</th>								
								<th style="text-align:center;width:20%;">Total $</th>
								<th style="text-align:center;width:20%;">Total Rs</th>
							</tr>
					</thead>
					<tbody>	';
							$ttlstone=0;
							$ttlwgt =0;
							$ttldollar=0;
							$ttlrs =0;
								$sizeRes = getData(SIZE_MST,$AllArr," ORDER BY FROMSIZE");
								while($sizeResData = mysqli_fetch_assoc($sizeRes))
								{
									$res = getData(BARCODE_PROCESS,$AllArr," AS BP where PROCESSTYPE='Purchase' 
									and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') 
									AND WEIGHT BETWEEN '".$sizeResData["FROMSIZE"]."' AND '".$sizeResData["TOSIZE"]."' ".$COLOR.$CLARITY.$BARCODENO);
									
									$html.='<tr style="background-color:gray;color:#fff;text-align:center;font-size:1.1em;">
													<td colspan="8" style="text-align:center;">'.$sizeResData["FROMSIZE"].'-'.$sizeResData["TOSIZE"].'</td>
																				
									</tr>';
									if(mysqli_num_rows($res) > 0)
									{
										$idx = 1;
										while($resdata = mysqli_fetch_assoc($res))
										{
											$ttlstone+=1;
											$ttlwgt+=$resdata["WEIGHT"];
											$ttldollar+=$resdata["TOTALDOLLAR"];
											$ttlrs+=$resdata["RSAMOUNT"];
																		
											
											$html.='<tr>												
												<td align="center" width="5%">'. $idx++.'</td>
												<td align="center" width="15%">'.$resdata["BARCODENO"].'</td>
												<td align="center" width="10%">'. $resdata["SHAPE"].'</td>
												<td align="right" width="10%">'.sprintf("%.2f",$resdata["WEIGHT"]).'</td>
												<td align="center" width="10%">'.$resdata["COLOR"].'</td>
												<td align="center" width="10%">'. $resdata["CLARITY"].'</td>
												<td align="right" width="20%">'.$resdata["TOTALDOLLAR"].'</td>
												<td align="right" width="20%">'.$resdata["RSAMOUNT"].'</td>
											</tr>
											';
										}
										
									}
									else{
										
										$html.='<tr>
												<td colspan="8" align="center">No Data</td>																						
											</tr>
									';
									}
								}
								$html.='<tr>
												
												<td align="center">'.$ttlstone.'</td>
												<td></td>
												<td></td>
												<td align="right">'.sprintf("%.2f",$ttlwgt).'</td>
												<td></td>
												<td></td>
												<td align="right">'.sprintf("%.2f",$ttldollar).'</td>
												<td align="right">'.sprintf("%.2f",$ttlrs).'</td>
											</tr>';
					$html.='</tbody>
					</table>';
		}
		break;
		//==========================================================================
		//===================Deal Purchase Status====================================
		case "Deal Purchase Status":
		{
			$pdf->AddPage("L","A4");		
			$html='	<table width="100%" style="font-size:0.8em;">
								<tr>
									<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Deal Purchase Status</h5></td>
								</tr>
						
					</table>
					<table width="100%" border="1">
					<thead>
								<tr>
									<th style="text-align:center;width:5%;">Sr No</th>
									<th style="text-align:center;width:10%;">Status</th>							
									<th style="text-align:center;width:5%;" >Days</th>							
									<th style="text-align:center;width:10%;">Stock Id</th>
									<th style="text-align:center;width:5%;">Shp</th>	
									<th style="text-align:center;width:10%;">Carat</th>									
									<th style="text-align:center;width:5%;">Col</th>
									<th style="text-align:center;width:5%;">Cla</th>								
									<th style="text-align:center;width:10%;">Pur</th>
									<th style="text-align:center;width:10%;">Sal</th>
									<th style="text-align:center;width:5%;">GP RATIO</th>
									<th style="text-align:center;width:10%;">Diff</th>
									<th style="text-align:center;width:10%;">Unsold</th>
								</tr>
						</thead>
						<tbody>';
								$ttlstone=0;
								$ttlwgt =0;
								$ttldollar=0;
								$PURAMT_ttl = 0;
								$SALAMT_ttl = 0;
								$FINALTOTALDIFF = 0;
								$FINALTOTALUNSOLD = 0;
								$AMT =0;
								$FieldArr= array();	
								array_push($FieldArr,"BP.LEDGERID");
								array_push($FieldArr,"L.LEDGERNAME");
								
								
								array_push($FieldArr,"COUNT(BP.BARCODENO) AS TOTAL");
								
								$resParty = getData(BARCODE_PROCESS,$FieldArr," AS BP 
								INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID 
								where BP.PROCESSTYPE='Purchase' ".$VDATE.$COLOR.$CLARITY.$WEIGHT.$PARTY.$BARCODENO." GROUP BY BP.LEDGERID");
								while($resPartyData = mysqli_fetch_assoc($resParty))
									{
										$temparr = array();
										$temparr[0]='BP.*';
										$temparr[1]='SP.RSAMOUNT AS SRSAMOUNT';
										$temparr[2]='((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT';
										$temparr[3]='((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT';
										$temparr[4]='((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT';
										$temparr[5]='((BP.RSAMOUNT * BP.IGSTPER)/100)  AS IGSTAMT';
										$temparr[6]='SP.PROCESSTYPE AS SPROCESS';
										$temparr[7]='DATEDIFF(SP.VDATE,BP.VDATE) AS SALEDATE';
										$temparr[8]='round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100,2) as GPRATIO';
										$temparr[9]='((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100)  AS THIRDPARTYCHARGES';
										$temparr[12]='((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100)  AS THIRDPARTYTCS';
										//$temparr[10]='((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT';
										$temparr[11]='((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT';
										$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND BP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
										
										$res = getData(BARCODE_PROCESS,$temparr," AS BP 
										LEFT JOIN ". BARCODE_PROCESS ." AS SP ON SP.BARCODENO=BP.BARCODENO 
										AND SP.PROCESSTYPE in ('Sale') WHERE BP.PROCESSTYPE in ('Purchase') AND BP.LEDGERID='".$resPartyData["LEDGERID"]."' ".$VDATE.$BARCODENO." ");
										
									
										$html.='
											<tr style="background-color:gray;color:#fff;text-align:center;font-size:1.1em;">
												<td colspan="13">'. $resPartyData["LEDGERNAME"]."-".$resPartyData["TOTAL"].'</td>
											
										</tr>';
										
										if(mysqli_num_rows($res) > 0)
										{
											$PURAMT = 0 ;
											$SALAMT = 0 ;
											$DIFF=0;
											$DIFF_TOTAL = 0;
											$UNSOLD_TOTAL = 0;
											$ttlstone_party=0;
											$ttlwgt_party =0;
											$ttldollar_party=0;
											
											$idx = 1;
											while($resdata = mysqli_fetch_assoc($res))
											{
												$ttlstone+=1;
												$ttlwgt+=$resdata["WEIGHT"];
												$ttldollar+=$resdata["TOTALDOLLAR"];
												$ttlstone_party+=1;
												$ttlwgt_party+=$resdata["WEIGHT"];
												$ttldollar_party+=$resdata["TOTALDOLLAR"];
												$SPROCESS = $resdata["SPROCESS"];	
												$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
												$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"];
												$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
												$PURAMT += $pur;
												$SALAMT += $sal;
												
												$DIFF = ($sal == 0) ? $pur : ($sal - $pur);
												$DIFF_TOTAL += ($sal == 0) ? 0 : ($sal - $pur) ;
												
												$UNSOLD_TOTAL += ($sal == 0) ? $pur : 0 ;
												
												$PURAMT_ttl += $pur;
												$SALAMT_ttl += $sal;
												$AMT = $AMT + ($pur);
												$GPRATIO = round((($sal - $pur)  / $pur)*100,2);
										
											$html.='<tr style="font-size:0.8em;">
													<td align="center" width="5%">'.$idx++.'</td>
													<td align="center" width="10%">'. $SPROCESS.'</td>
													<td align="center" width="5%">'. $resdata["SALEDATE"].'</td>
													<td width="10%">'.$resdata["BARCODENO"].'</td>
													<td width="5%">'. $resdata["SHAPE"].'</td>
													<td align="right" width="10%">'.sprintf("%.2f",$resdata["WEIGHT"]).'</td>
													<td width="5%">'.$resdata["COLOR"].'</td>
													<td width="5%">'.$resdata["CLARITY"].'</td>
													<td align="right" width="10%">'. round($pur).'</td>
													<td align="right" width="10%">'. round($sal).'</td>
													<td align="right" width="5%">'.$GPRATIO.'</td>';
													
													if($sal == 0){
														$html.='
														<td width="10%"></td>
														<td align="right" width="10%">'.round($DIFF).'</td>
														';
													}else{
														$html.='
													<td align="right" width="10%">'.round($DIFF).'</td>
													<td width="10%"></td>
													';
													}
													$html.='
												</tr>';												
											}
												$html.='
													<tr>
													<td></td>													
													<td></td>
													<td></td>
													<td align="center">'. $ttlstone_party.'</td>
													<td></td>
													<td align="right">'. sprintf("%.2f",$ttlwgt_party).'</td>
													<td></td>
													<td></td>
													<td align="right">'. round($PURAMT).'</td>
													<td align="right">'. round($SALAMT).'</td>
													<td></td>';
												
													if($SALAMT == 0){
														$html.='
														<td></td>
														<td align="right">'.round($PURAMT).'</td>
														';
													}else{
														$html.='
														<td align="right">'.round($DIFF_TOTAL).'</td>
														<td align="right">'. round($UNSOLD_TOTAL).'</td>
													';
													}
													
													$html.='
												</tr>
											';
											
										}
										else{
										
											$html.='<tr>
													<td colspan="13" align="center" >No Data</td>
												
												</tr>
											';
										}
										$FINALTOTALDIFF +=  $DIFF_TOTAL ;
										$FINALTOTALUNSOLD +=  $UNSOLD_TOTAL ;
									}
				
									
							$html.='      
									<tr>
												<td></td>
												<td></td>
												<td></td>
												<td align="center">'. $ttlstone.'</td>
												<td></td>
												<td align="right">'. sprintf("%.2f",$ttlwgt).'</td>
												<td></td>
												<td></td>
												<td align="right">'.round($PURAMT_ttl).'</td>
												<td align="right">'. round($SALAMT_ttl).'</td>
												<td></td>
												';
													if($SALAMT_ttl == 0){
														$html.='
														<td></td>
														<td align="right">'.round($PURAMT_ttl).'</td>
														';
													}else{
													$html.='
													<td align="right">'.round($FINALTOTALDIFF).'</td>
													<td align="right">'.round($FINALTOTALUNSOLD).'</td>
													
													';
													}
													$html.='
												
											</tr>
						</tbody>
					</table>';
							
		}
		break;
		//=========================================================================
		//====================================Premium Size Purchase-Sale P & L=======================================
		case "Premium Size Purchase-Sale P & L":
		{
			$pdf->AddPage("L","A4");
			$rptcolspan='12';
	
		$html='	<table width="100%" style="font-size:0.8em;">
								<tr>
									<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Premium Size Purchase-Sale P & L</h5></td>
								</tr>
						
					</table>
					<table width="100%" border="1">
					<thead>
							<tr style="font-weight:bold;font-size:0.8em">
								<th style="text-align:center;width:5%;" >Sr No</th>
								<th style="text-align:center;width:5%;">DATE</th>	
								<th style="text-align:center;width:20%;">PURCHASE PARTY</th>
								<th style="text-align:center;width:7%;">STOCK ID</th>
								<th style="text-align:center;width:5%;">WEIGHT</th>
								<th style="text-align:center;width:3%;">COLOR</th>
								<th style="text-align:center;width:5%;">CLARITY</th>
								<th style="text-align:center;width:10%;">PUR AMT</th>
								<th style="text-align:center;width:10%;">SAL AMT</th>
								<th style="text-align:center;width:10%;">DIFF AMT</th>
								<th style="text-align:center;width:10%;">GP RATIO</th>
								<th style="text-align:center;width:10%;">DAY DIFF</th>
													
							</tr>
					</thead>
					<tbody>';
					
						$PURAMT_SIZE=0;
						$SALAMT_SIZE=0;
						$WGTSUM_SIZE=0;
						$sizeRes = getData(SIZE_MST,$AllArr," ORDER BY FROMSIZE");
						while($sizeResData = mysqli_fetch_assoc($sizeRes))
							{
							//=========================
							$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
							$FieldArr= array();				
							array_push($FieldArr,"BP.LEDGERID");
							array_push($FieldArr,"L.LEDGERNAME");
							array_push($FieldArr,"BP.RSAMOUNT");
							array_push($FieldArr,"BP.BARCODENO");
							array_push($FieldArr,"BP.COLOR");
							array_push($FieldArr,"BP.CLARITY");
							array_push($FieldArr,"BP.WEIGHT");
							array_push($FieldArr,"IF(BP.VDATE IS NULL,'',BP.VDATE) AS PDATE ");
							array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");
							array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
							array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
							array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
							//array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
							//array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
							//array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
							array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
							//array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
							//array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");
							array_push($FieldArr,"round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100) as GPRATIO");
							
							
							
							switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									case 'GP':
										$ORDERBY_COND =' ORDER BY round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100)';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
							$res = getData(BARCODE_PROCESS,$FieldArr," AS BP LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale' LEFT JOIN ".LEDGER." AS L ON L.LEDGERID = BP.LEDGERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' AND BP.WEIGHT BETWEEN '".$sizeResData["FROMSIZE"]."' AND '".$sizeResData["TOSIZE"]."' ".
							$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$ORDERBY_COND);
									$html.='
									<tr style="background-color:gray;color:#fff;text-align:center;font-size:1.1em;">
										<td colspan="12">'.$sizeResData["FROMSIZE"].'-'.$sizeResData["TOSIZE"].'</td>
																			
									</tr>';
									if(mysqli_num_rows($res) > 0)
									{
										$PURAMT=0;
										$SALAMT=0;
										$WGTSUM=0;
										$idx = 1;
										while($resdata = mysqli_fetch_assoc($res))
										{
											if($resdata["VDATE"] != '' )
											{
												$date1=date_create($resdata["PDATE"]);
												$date2=date_create($resdata["VDATE"]);
												$diff=date_diff($date1,$date2);
												$diffdisp=$diff->format("%R%a days");
											}
											else{
												$diffdisp = '';
											}
											
											
											$GPRATIO = getCurrFormat((($resdata["SRSAMOUNT"] - $resdata["RSAMOUNT"]) / ($resdata["RSAMOUNT"]))*100);
																				
												
											$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"] + $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"];
											$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
											$PURAMT += $pur;
											$SALAMT += $sal;
											$WGTSUM += $resdata["WEIGHT"];
											
											$PURAMT_SIZE += $pur;
											$SALAMT_SIZE += $sal;
											$WGTSUM_SIZE += $resdata["WEIGHT"];
											
											$GPRATIO= round((($sal-$pur)/$pur)*100,2);
											
											$html.='<tr  style="font-size:0.7em;">
															<td style="text-align:center;width:5%;">'.$idx++.'</td>
																<td style="text-align:center;width:5%;">'.($resdata["VDATE"] != '' ? getDateFormat($resdata["VDATE"]) : '').'</td>
																<td style="text-align:left;width:20%;">'.$resdata["LEDGERNAME"].'</td>
																<td style="text-align:center;width:7%;">'.$resdata["BARCODENO"].'</td>
																<td style="text-align:center;width:5%;">'.$resdata["WEIGHT"].'</td>
																<td style="text-align:center;width:3%;">'.$resdata["COLOR"].'</td>
																<td style="text-align:center;width:5%;" >'. $resdata["CLARITY"].'</td>
																<td style="text-align:right;width:10%;">'. getCurrFormat($pur).'</td>
																<td style="text-align:right;width:10%;">'. getCurrFormat($sal).'</td>
																<td style="text-align:right;width:10%;">'. getCurrFormat($sal-$pur).'</td>
																<td style="text-align:right;width:10%;">'. $GPRATIO.'</td>
																<td style="text-align:right;width:10%;">'.$diffdisp.'</td>
															</tr>';
											
										}
									
										$html.='<tr>
										<td align="center"></td>
										<td></td>
																<td></td>
																<td></td>
																<td>'.$WGTSUM.'</td>
																<td></td>
																<td></td>
																<td align="right">'.getCurrFormat($PURAMT).'</td>
																<td align="right">'. getCurrFormat($SALAMT).'</td>
																<td align="right">'. getCurrFormat($SALAMT-$PURAMT).'</td>
																<td align="right"></td>
																<td></td>
															</tr>';
										
									}
									else{
										
										$html.='<tr>
												
												<td colspan="12" align="center">No Data</td>
											</tr>';
										
									}
									
								}
								$html.='
								<tr>
										<td align="center"></td>
										<td></td>
																<td></td>
																<td></td>
																<td>'.$WGTSUM_SIZE.'</td>
																<td></td>
																<td></td>
																<td align="right">'.getCurrFormat($PURAMT_SIZE).'</td>
																<td align="right">'.getCurrFormat($SALAMT_SIZE).'</td>
																<td align="right">'.getCurrFormat($SALAMT_SIZE-$PURAMT_SIZE).'</td>
																<td align="right"></td>
																<td align="right"></td>
															</tr>	
							</tbody>
						</table>
					';
		}
		break;
		//============================================================================
		//======================Party Wise Current Stock====================================
		case "Party Wise Current Stock":
		{
			$pdf->AddPage("L","A4");
			$html='	<table width="100%" style="font-size:0.8em;">
								<tr>
									<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Party Wise Current Stock</h5></td>
								</tr>
						
					</table>
					<table width="100%" border="1">
					<thead>
							<tr>
								<th style="text-align:center;width:15%;" >Sr No</th>
								<th style="text-align:center;width:15%;">Stock Id</th>
								<th style="text-align:center;width:15%;">Shp</th>	
								<th style="text-align:center;width:15%;">Carat</th>									
								<th style="text-align:center;width:10%;">Col</th>
								<th style="text-align:center;width:10%;">Cla</th>								
								<th style="text-align:center;width:20%;">Total $</th>
							</tr>
					</thead>
					<tbody>';
							$ttlstone=0;
							$ttlwgt =0;
							$ttldollar=0;
							$FieldArr= array();	
							array_push($FieldArr,"BP.LEDGERID");
							array_push($FieldArr,"L.LEDGERNAME");
							array_push($FieldArr,"COUNT(BP.BARCODENO) AS TOTAL");
							$resParty = getData(BARCODE_PROCESS,$FieldArr," AS BP 
							INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID 
							where BP.PROCESSTYPE='Purchase' 
							and BP.BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') "
							.$VDATE.$COLOR.$CLARITY.$WEIGHT.$PARTY.$BARCODENO." GROUP BY BP.LEDGERID");
							while($resPartyData = mysqli_fetch_assoc($resParty))
								{
									$res = getData(BARCODE_PROCESS,$AllArr," where PROCESSTYPE='Purchase' 
									and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') 
									AND LEDGERID='".$resPartyData["LEDGERID"]."' ".$COLOR.$WEIGHT.$CLARITY.$BARCODENO);
									
								$html.='
									<tr style="background-color:gray;color:#fff;text-align:center;font-size:1.1em;">
										<td colspan="7">'.$resPartyData["LEDGERNAME"].'-'.$resPartyData["TOTAL"].'</td>										
									</tr>
									';
									if(mysqli_num_rows($res) > 0)
									{
										$ttlstone_party=0;
										$ttlwgt_party =0;
										$ttldollar_party=0;
										$idx = 1;
										while($resdata = mysqli_fetch_assoc($res))
										{
											$ttlstone+=1;
											$ttlwgt+=$resdata["WEIGHT"];
											$ttldollar+=$resdata["TOTALDOLLAR"];
											
											$ttlstone_party+=1;
											$ttlwgt_party+=$resdata["WEIGHT"];
											$ttldollar_party+=$resdata["TOTALDOLLAR"];
																		
											$html.='
											<tr>
												<td align="center" width="15%">'. $idx++.'</td>
												<td align="center" width="15%">'. $resdata["BARCODENO"].'</td>
												<td align="center" width="15%">'. $resdata["SHAPE"].'</td>
												<td align="right" width="15%">'.sprintf("%.2f",$resdata["WEIGHT"]).'</td>
												<td align="center" width="10%">'.$resdata["COLOR"].'</td>
												<td align="center" width="10%">'.$resdata["CLARITY"].'</td>
												<td align="right" width="20%">'. $resdata["TOTALDOLLAR"].'</td>
											</tr>';
											
										}
											$html.='
											<tr>
												<td align="center">'. $ttlstone_party.'</td>
												<td></td>
												<td></td>
												<td align="right">'. sprintf("%.2f",$ttlwgt_party).'</td>
												<td></td>
												<td></td>
												<td align="right">'. $ttldollar_party.'</td>
											</tr>';
										
									}
									else{
										$html.='
										<tr>
												<td colspan="7" align="center">No Data</td>
												
											</tr>
									';
									}
									
								}
								$html.='    
									<tr>
												<td align="center">'. $ttlstone.'</td>
												<td></td>
												<td></td>
												<td align="right">'. sprintf("%.2f",$ttlwgt).'</td>
												<td></td>
												<td></td>
												<td align="right">'.sprintf("%.2f",$ttldollar).'</td>
											</tr>
							</tbody>
						</table>';
					
				
		}
		break;
		//==============================================================
		
		//========================Period Wise Party Payment==============================
		case "Period Wise Party Payment":
		{
			$pdf->AddPage("P","A4");
			$FieldArr_PUR= array();
			array_push($FieldArr_PUR,"DR.VOUCHERDATE");
			array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
			array_push($FieldArr_PUR,"SUM(AMOUNT) AS AMOUNT");								
			array_push($FieldArr_PUR,"DR.LEDGERID");
			switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' GROUP BY DR.LEDGERID ORDER BY DR.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' GROUP BY DR.LEDGERID ORDER BY DR.VOUCHERDATE';
						break;
					}	
							$html='<table width="100%" style="font-size:0.8em;">
									<tr>
										<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Period Wise Party Payment</h5></td>
									</tr>
									
									</table>
								<table width="100%" border="1">
										<thead>
											<tr>
												<th>Party</th>
												<th>Amount</th>
											</tr>
										</thead>
										<tbody>
						';
								$idx = 1;
									$resPur = getData(LEDGER_DEBIT,$FieldArr_PUR," AS DR INNER JOIN ".LEDGER." AS L ON L.LEDGERID=DR.LEDGERID  WHERE DR.LEDGERID !='' AND DR.GROUPID IN('25')".$PARTY.$VOUCHERDATE.$ORDERBY_COND);
									$SUMAMOUNT=0;
									while($resdata = mysqli_fetch_assoc($resPur))
									{
												$html.='<tr class="" style="">
														<td>'. $resdata["PARTY"].'</td>
														<td align="right">'. getCurrFormat0($resdata["AMOUNT"]).'</td>
														
													</tr>
											';
											$SUMAMOUNT+=$resdata["AMOUNT"];
											
										}   
                                 
							$html.='<tr class="" style="">
										<td><b>Total:</b></td>
										<td align="right"><b>'.getCurrFormat0($SUMAMOUNT).'</b></td>
									</tr>
									</tbody>
						</table>';
		}
		
		break;
		//========================Period Wise Party Payment============================
		
			case "Purchase Outstanding":
			{
				$pdf->AddPage("L","A4");
				$FieldArr_PUR= array();
				array_push($FieldArr_PUR,"ID");
				array_push($FieldArr_PUR,"P.VOUCHERDATE");
				array_push($FieldArr_PUR,"DUEDAYS");
				array_push($FieldArr_PUR,"DUEDATE");
				array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
				array_push($FieldArr_PUR,"B.LEDGERNAME AS BROKER");
				array_push($FieldArr_PUR,"LOCATIONNAME");
				array_push($FieldArr_PUR,"CONVRATE");
				array_push($FieldArr_PUR,"FINALTOTAL");
				array_push($FieldArr_PUR,"CGSTPER");
				array_push($FieldArr_PUR,"IGSTPER");
				array_push($FieldArr_PUR,"SGSTPER");
				array_push($FieldArr_PUR,"CGSTAMT");
				array_push($FieldArr_PUR,"IGSTAMT");
				array_push($FieldArr_PUR,"SGSTAMT");
				array_push($FieldArr_PUR,"GRANDAMOUNT");
				array_push($FieldArr_PUR,"PARTNERAMOUNT");
				array_push($FieldArr_PUR,"LASTAMOUNT");								
				array_push($FieldArr_PUR,"P.LEDGERID");
				array_push($FieldArr_PUR,"THIRDPARTYCHARGESPER");
				array_push($FieldArr_PUR,"THIRDPARTYCHARGES");
				
				switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY P.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY P.VOUCHERDATE';
						break;
					}
					
				$resPur_STRING = " AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID 
				LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID 
				WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0' 
				AND DATE_FORMAT(P.VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."' ".$BARCODENO.$ORDERBY_COND;
				$html='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Purchase Outstanding</h5></td>
						</tr>
						
						</table>
				<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
									<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
												<th>Id</th>	
												<th>Dt</th>	
												<th>Due Dt</th>
												<th>Stock Id</th>
												<th>Party</th>
												<th>Broker</th>
												<th>$</th>
												<th>Final Total</th>
												<th>GST</th>
												<th>Third Party Charges</th>
												<th>Last Total</th>
												<th>Paid</th>
												<th>Due</th>
											</tr>
								</thead>
						<tbody>';
					
								$idx = 1;
								$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' and LEDGERID IN (SELECT LEDGERID FROM ".PURCHASESALE." WHERE VOUCHERTYPE='Purchase' and DUEDATE <= CURDATE())");
								while($resledgerdata = mysqli_fetch_assoc($resledger))
									{
										$resPur = getData(PURCHASESALE,$FieldArr_PUR,$resPur_STRING ." AND L.LEDGERID='".$resledgerdata["LEDGERID"]."'".$PARTY);
										
										$totalpaid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."'");
										
										while($resdata = mysqli_fetch_assoc($resPur))
										{
											$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ', ')" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."' AND ID='".$resdata["ID"]."' AND FLAG='0' AND PROCESSTYPE='Purchase'");
											$GRANDAMOUNT = $resdata["LASTAMOUNT"];
											
											if($totalpaid > 0 )
											{
													$paid = $totalpaid;
													$totalpaid = $totalpaid - $GRANDAMOUNT ;
											
													$due=$GRANDAMOUNT-$paid;
											}
											else
											{
												
												$paid = $totalpaid > 0 ?$totalpaid :0;
												$due = $GRANDAMOUNT;
											}
										
											if($resdata["IGSTAMT"] > 0)
											{
												$GSTAMOUNT= getCurrFormat($resdata["IGSTAMT"]) ;
											}
											else
											{
												$GSTAMOUNT = getCurrFormat(($resdata["SGSTAMT"]+$resdata["CGSTAMT"]));
											}
											if($due > 5)
											{
												$html.='<tr>
														<td>'.$resdata["ID"].'</td>
														<td>'.getDateFormat($resdata["VOUCHERDATE"]).'</td>
														<td>'.getDateFormat($resdata["DUEDATE"])."(".$resdata["DUEDAYS"].")".'</td>
														<td >'.$BARCODENO.'</td>
														<td>'.$resdata["PARTY"].'</td>
														<td>'.$resdata["BROKER"].'</td>
														<td class="amountalign">'.getCurrFormat($resdata["CONVRATE"]).'</td>
														<td class="amountalign">'.getCurrFormat($resdata["FINALTOTAL"]).'</td>
														<td class="amountalign">'.$GSTAMOUNT.'</td>
														<td class="amountalign">'.getCurrFormat($resdata["THIRDPARTYCHARGES"]).'</td>
														<td class="amountalign">'.getCurrFormat0($resdata["LASTAMOUNT"]).'</td>
														<td class="amountalign">'.getCurrFormat($paid).'</td>
														<td class="amountalign">'.getCurrFormat0($due).'</td>
														
														
													</tr>';
										
											}
										}
											
										}
									
							$html.='                                        
							</tbody>
						</table>';
					
			}
			break;
			case "Sale Outstanding":
			{
				$pdf->AddPage("L","A4");
				$FieldArr_PUR= array();
				array_push($FieldArr_PUR,"ID");
				array_push($FieldArr_PUR,"P.VOUCHERDATE");
				array_push($FieldArr_PUR,"DUEDAYS");
				array_push($FieldArr_PUR,"DUEDATE");
				array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
				array_push($FieldArr_PUR,"B.LEDGERNAME AS BROKER");
				array_push($FieldArr_PUR,"LOCATIONNAME");
				array_push($FieldArr_PUR,"CONVRATE");
				array_push($FieldArr_PUR,"FINALTOTAL");
				array_push($FieldArr_PUR,"CGSTPER");
				array_push($FieldArr_PUR,"IGSTPER");
				array_push($FieldArr_PUR,"SGSTPER");
				array_push($FieldArr_PUR,"CGSTAMT");
				array_push($FieldArr_PUR,"IGSTAMT");
				array_push($FieldArr_PUR,"SGSTAMT");
				array_push($FieldArr_PUR,"GRANDAMOUNT");
				array_push($FieldArr_PUR,"P.LEDGERID");
				array_push($FieldArr_PUR,"PARTNERAMOUNT");
				array_push($FieldArr_PUR,"LASTAMOUNT");
				
				switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY P.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY P.VOUCHERDATE';
						break;
					}
					
				$resSal_STRING=" AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Sale' AND DATE_FORMAT(P.VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."' " .$ORDERBY_COND;
				$html = '<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Sale Outstanding</h5></td>
						</tr>
						
						</table>
				<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
												<th>Id</th>	
												<th>Dt</th>	
												<th>Due Dt</th>
												<th>Stock Id</th>
												<th>Party</th>
												<th>Broker</th>
												<th>$</th>
												<th>Final Total</th>
												<th>GST</th>
												<th>Last Total</th>
												<th>Paid</th>
												<th>Due</th>
											</tr>
										</thead>
										<tbody>';
							
							$idx = 1;
								
								
							$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' and LEDGERID IN (SELECT LEDGERID FROM ".PURCHASESALE." WHERE VOUCHERTYPE='Sale' and DUEDATE <= CURDATE())");
								while($resledgerdata = mysqli_fetch_assoc($resledger))
								{
									$resSal = getData(PURCHASESALE,$FieldArr_PUR,$resSal_STRING ." AND L.LEDGERID='".$resledgerdata["LEDGERID"]."'".$PARTY);
										
									$totalpaid= getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."'");
										
									while($resdata = mysqli_fetch_assoc($resSal))
									{
											$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ', ')" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."' AND ID='".$resdata["ID"]."' AND FLAG='0' AND PROCESSTYPE='Sale'");
											$GRANDAMOUNT = $resdata["LASTAMOUNT"];
											//$totalpaid = $totalpaid - $GRANDAMOUNT ;
											if($totalpaid > 0 )
											{
													$paid = $totalpaid;
													$totalpaid = $totalpaid - $GRANDAMOUNT ;
											
													$due=$GRANDAMOUNT-$paid;
											}
											else
											{
												
												$paid = $totalpaid > 0 ?$totalpaid :0;
												$due = $GRANDAMOUNT;
											}
											if($resdata["IGSTAMT"] > 0)
											{
												$GSTAMOUNT= getCurrFormat($resdata["IGSTAMT"]) ;
											}
											else
											{
												$GSTAMOUNT = getCurrFormat(($resdata["SGSTAMT"]+$resdata["CGSTAMT"]));
											}
											if($due > 5)
											{
											
										$html .= '<tr>
												<td>'.$resdata["ID"].'</td>
												<td>'.getDateFormat($resdata["VOUCHERDATE"]).'</td>
												<td>'.getDateFormat($resdata["DUEDATE"])."(".$resdata["DUEDAYS"].")".'</td>
												<td >'.$BARCODENO.'</td>
												<td>'.$resdata["PARTY"].'</td>
												<td>'.$resdata["BROKER"].'</td>
												<td >'.getCurrFormat($resdata["CONVRATE"]).'</td>
												<td >'.getCurrFormat($resdata["FINALTOTAL"]).'</td>
												<td >'.$GSTAMOUNT.'</td>
												<td >'.getCurrFormat0($resdata["LASTAMOUNT"]).'</td>
												<td >'.getCurrFormat($paid).'</td>
												<td >'.getCurrFormat0($due).'</td>
											</tr>';
											}
									}
								}
						$html .='                                        
							</tbody>
						</table>';
		
			}
			break;
			case "Due Date Wise Pending Payment":
			{
					$pdf->AddPage("P","A4");
					$FieldArr_PUR= array();
					array_push($FieldArr_PUR,"ID");
					array_push($FieldArr_PUR,"P.VOUCHERDATE");
					array_push($FieldArr_PUR,"DUEDAYS");
					array_push($FieldArr_PUR,"DUEDATE");
					array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
					array_push($FieldArr_PUR,"LASTAMOUNT");								
					array_push($FieldArr_PUR,"P.LEDGERID");
							switch($ORDERBY)
							{
								case 'Date':
									$ORDERBY_COND =' ORDER BY DUEDATE';
								break;
								default:
									$ORDERBY_COND =' ORDER BY DUEDATE';
								break;
							}
							$html='<table width="100%" style="font-size:0.8em;">
									<tr>
										<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Due Date Wise Pending Payment</h5></td>
									</tr>
									</table>
								<table width="100%" border="1" style="font-size:0.8em;">
										<thead>
											<tr>
												<th>Id</th>	
												<th>Dt</th>	
												<th>Due Days</th>
												<th>Due Date</th>
												<th>Party</th>
												<th>Last Total</th>
												<th>Paid</th>
												<th>Due</th>
											</tr>
										</thead>
										<tbody>
							';
									
									//$resPur = getData(PURCHASESALE,$FieldArr_PUR," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID  WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0'".$PARTY.$DUEDATE.$ORDERBY_COND);
									//while($resdata = mysqli_fetch_assoc($resPur))
										//{
											//$GRANDAMOUNT = $resdata["LASTAMOUNT"];
											//$totalpaid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resdata["LEDGERID"]."' AND VOUCHERNO ='".$resdata["ID"]."'");
											//$totalpaid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resdata["LEDGERID"]."' AND VOUCHERDATE ='".$resdata["DUEDATE"]."'");
									$resPur = getData(PURCHASESALE,$FieldArr_PUR," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID  WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0'".$PARTY.$DUEDATE.$ORDERBY_COND);
									while($resdata = mysqli_fetch_assoc($resPur))
									{
										$GRANDAMOUNT = $resdata["LASTAMOUNT"];
										$totalpaid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resdata["LEDGERID"]."' AND VOUCHERNO ='".$resdata["ID"]."'");
											
											if($totalpaid > 0 )
											{
													$paid = $totalpaid;
													$totalpaid = $totalpaid - $GRANDAMOUNT ;
											
													$due=$GRANDAMOUNT-$paid;
											}
											else
											{
												
												$paid = $totalpaid > 0 ?$totalpaid :0;
												$due = $GRANDAMOUNT;
											}	
										$html.='
													<tr >
														<td >'. $resdata["ID"].'</td>
														<td>'.getDateFormat($resdata["VOUCHERDATE"]).'</td>
														<td>'. $resdata["DUEDAYS"].'</td>
														<td>'.getDateFormat($resdata["DUEDATE"]).'</td>
														<td>'. $resdata["PARTY"].'</td>
														<td align="right">'. getCurrFormat($resdata["LASTAMOUNT"]).'</td>
														<td align="right">'. getCurrFormat($paid) .'</td>
														<td align="right">'. getCurrFormat($due) .'</td>
														
													</tr>
												';
											
										}
									
							                                    
							$html.='</tbody>
						</table>';
			}
			break;
			case "Purchase-Sale P & L":
			{
				$pdf->AddPage("P","A4");
				$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
			$FieldArr= array();				
							
								//array_push($FieldArr,"BP.STOCKIDVALUE");
								array_push($FieldArr,"BP.LEDGERID");
								array_push($FieldArr,"L.LEDGERNAME");
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"BP.BARCODENO");
								array_push($FieldArr,"BP.WEIGHT");
								array_push($FieldArr,"BP.COLOR");
								array_push($FieldArr,"BP.CLARITY");
								array_push($FieldArr,"SP.VDATE");
								array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
								
								array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
								//array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
								//array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
								//array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
								array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
								//array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
								//array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");
								array_push($FieldArr,"round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100) as GPRATIO");
				
			
				
				switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									case 'GP':
										$ORDERBY_COND =' ORDER BY round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100)';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
								
	
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale' LEFT JOIN ".LEDGER." AS L ON L.LEDGERID = BP.LEDGERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase'".
								$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$ORDERBY_COND);
							
				
				
				$html='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Purchase-Sale P & L</h5></td>
						</tr>
						
						</table>
				<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
										
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
													<th>NO</th>
													<th>DATE</th>
													<th>PURCHASE PARTY</th>														
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>PUR AMT</th>
													<th>SAL AMT</th>
													<th>DIFF AMT</th>
													<th>GP RATIO</th>
												</tr>
											 </thead>
											<tbody>';
				
												$idx = 1;
												$PURAMT = 0;
												$SALAMT = 0;
												
												while($resdata = mysqli_fetch_assoc($res))
													{
														
														$PURAMT += $resdata["RSAMOUNT"];
														$SALAMT += $resdata["SRSAMOUNT"];
														
														$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
														$sal = ($resdata["SRSAMOUNT"]  - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
														$GPRATIO = round((($sal-$pur)/$pur)*100,2);
														$html.='<tr>
															<td align="center">'.$idx++.'</td>
																<td>'.($resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"])).'</td>
																<td>'.$resdata["LEDGERNAME"].'</td>
																<td>'.$resdata["BARCODENO"].'</td>
																<td>'.$resdata["WEIGHT"].'</td>
																<td>'.$resdata["COLOR"].'</td>
																<td>'.$resdata["CLARITY"].'</td>
																<td align="right">'.getCurrFormat($pur).'</td>
																
																<td align="right">'.getCurrFormat($sal).'</td>
																<td align="right">'.getCurrFormat($sal-$pur).'</td>
																<td align="right">'.$GPRATIO.'</td>
															</tr>';
													}
								$html .='<tr>
															<td align="center"></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td align="right">'.getCurrFormat($PURAMT).'</td>
																<td align="right">'.getCurrFormat($SALAMT).'</td>
																<td align="right">'.getCurrFormat($SALAMT - $PURAMT).'</td>
																<td></td>
															</tr>
															</tbody>
										</table>';
			}
			break;
			case "Partner Purchase-Sale P & L":
			{
				$pdf->AddPage("P","A4");
				$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND BP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
			$FieldArr= array();				
							
								array_push($FieldArr,"PRL.LEDGERNAME AS PARTNERNAME");
								array_push($FieldArr,"BP.PARTNERPER");
								//array_push($FieldArr,"BP.STOCKIDVALUE");
								array_push($FieldArr,"BP.WEIGHT");
								array_push($FieldArr,"BP.COLOR");
								array_push($FieldArr,"BP.CLARITY");
								
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"BP.BARCODENO");
								array_push($FieldArr,"SP.VDATE");
								//array_push($FieldArr,"SP.STOCKIDVALUE AS SSTOCKIDVALUE");
								array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
								/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");*/
								array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
								/*array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
								array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
								array_push($FieldArr,"round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100) AS GPRATIO");
								
								switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
				
	
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP LEFT JOIN ".LEDGER." AS PRL ON PRL.LEDGERID=BP.PARTNERLEDGERID LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale'  WHERE BP.FLAG='0' AND BP.PARTNERPER > 0 AND BP.PARTNERLEDGERID !=''   AND BP.PROCESSTYPE='Purchase' ".
								$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTNER.$ORDERBY_COND);
						
				
				
				$html='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5> Partner Purchase-Sale P & L</h5></td>
						</tr>
						
						</table>
				<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
										
												<tr style="text-align:center;font-weight:bold;font-size:0.8em;">
													<th>NO</th>
													<th>DATE</th>	
													<th>PARTNER NAME</th>
													<th>PARTNER %</th>													
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>PUR AMT</th>
													<th>SAL AMT</th>
													<th>DIFF AMT</th>
													<th>AMT</th>
													<th>GP RATIO</th>
												</tr>
											 </thead>
											<tbody>';
				
												$idx = 1;
												$PURAMT=0;;
												$SALAMT=0;
												$DIFFAMT=0;
												$DIFF_TOTAL=0;
												$IGSTAMT=0;
												$BROKERAMT=0;
												$SIGSTAMT=0;
												$SBROKERAMT=0;
												$PURAMT_ttl =0;
												$SALAMT_ttl =0;
												$UNSOLD_TOTAL=0;
												$AMT=0;
												
												while($resdata = mysqli_fetch_assoc($res))
													{
														$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
														$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
														$PURAMT += $pur;
														$SALAMT += $sal;
														
														$DIFF = ($sal == 0) ? $pur : ($sal - $pur);
														$DIFF_TOTAL += ($sal == 0) ? 0 : ($sal - $pur) ;
														
														$UNSOLD_TOTAL += ($sal == 0) ? $pur : 0 ;
														
														$PURAMT_ttl += $pur;
														$SALAMT_ttl += $sal;
														$AMT = $AMT + ($pur);
														$GPRATIO = round((($sal-$pur) / $pur)*100,2);
														$html.='<tr style="font-size:0.8em;">
																<td align="center">'.$idx++.'</td>
																<td>'.($resdata["VDATE"]== '' ? '' : getDateFormat($resdata["VDATE"])).'</td>
																
																<td>'. $resdata["PARTNERNAME"].'</td>
																<td>'. $resdata["PARTNERPER"].'</td>
																<td>'.$resdata["BARCODENO"].'</td>
																<td>'.$resdata["WEIGHT"].'</td>
																<td>'.$resdata["COLOR"].'</td>
																<td>'. $resdata["CLARITY"].'</td>
																<td align="right">'. getCurrFormat($pur).'</td>
															    <td align="right">'. getCurrFormat($sal).'</td>																
																';
																if($sal == 0){
																	
																	$html.='<td></td>
																	<td align="right">'.round($DIFF).'</td>
																	';
																}else
																{
																	
																$html.='<td align="right">'.round($DIFF).'</td>
																<td></td>
																';
																}
																$html.='<td align="right">'. $GPRATIO.'</td>
																
																
															</tr>';
													}
															$html.='<tr style="font-size:0.8em;">
																<td align="center"></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td align="right">'.getCurrFormat($PURAMT_ttl).'</td>
																<td align="right">'. getCurrFormat($SALAMT_ttl).'</td>
																<td align="right">'. round($DIFF_TOTAL).'</td>
																<td align="right">'. round($UNSOLD_TOTAL).'</td>
																<td></td>
															</tr>	
															</tbody>
										</table>';
			}
			break;
			case "Purchase-Sale":
			{
				$pdf->AddPage("L","A2");
				$FieldArr_Pur= array();				
				array_push($FieldArr_Pur,"BP.ENTRYID");
				array_push($FieldArr_Pur,"BP.ID");
				array_push($FieldArr_Pur,"BP.ENTRYDATE");
				array_push($FieldArr_Pur,"L.LEDGERNAME AS PARTY");
				array_push($FieldArr_Pur,"B.LEDGERNAME AS BROKER");
				array_push($FieldArr_Pur,"BP.REMARK");
				array_push($FieldArr_Pur,"BP.BARCODENO");
				array_push($FieldArr_Pur,"BP.WEIGHT");
				array_push($FieldArr_Pur,"BP.SHAPE");
				array_push($FieldArr_Pur,"BP.COLOR");
				array_push($FieldArr_Pur,"BP.CLARITY");
				array_push($FieldArr_Pur,"BP.CUT");
				array_push($FieldArr_Pur,"BP.POLISH");
				array_push($FieldArr_Pur,"BP.SYMM");
				array_push($FieldArr_Pur,"BP.FLOURANCE");
				array_push($FieldArr_Pur,"BP.GREEN");
				array_push($FieldArr_Pur,"BP.MILKY");
				array_push($FieldArr_Pur,"BP.LAB");
				array_push($FieldArr_Pur,"BP.CERTIFICATENO");
				array_push($FieldArr_Pur,"BP.RATE");
				array_push($FieldArr_Pur,"BP.DISCPER");
				array_push($FieldArr_Pur,"BP.PERCRTDOLLAR");
				array_push($FieldArr_Pur,"BP.RATEDOLLAR");
				array_push($FieldArr_Pur,"BP.CONVRATE");
				array_push($FieldArr_Pur,"BP.RSPERCRT");
				array_push($FieldArr_Pur,"BP.RSAMOUNT");
				array_push($FieldArr_Pur,"PS.VOUCHERDATE");
				
				switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
								}
								
				$res_pur = getData(BARCODE_PROCESS,$FieldArr_Pur," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID WHERE BP.PROCESSTYPE='Purchase' ".$VDATE.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
								
								
				$FieldArr_Sal= array();						
								
				array_push($FieldArr_Sal,"BP.ENTRYID");
				array_push($FieldArr_Sal,"BP.ID");
				array_push($FieldArr_Sal,"BP.ENTRYDATE");
				array_push($FieldArr_Sal,"L.LEDGERNAME AS PARTY");
				array_push($FieldArr_Sal,"B.LEDGERNAME AS BROKER");
				array_push($FieldArr_Sal,"BP.REMARK");
				array_push($FieldArr_Sal,"BP.BARCODENO");
				array_push($FieldArr_Sal,"BP.WEIGHT");
				array_push($FieldArr_Sal,"BP.SHAPE");
				array_push($FieldArr_Sal,"BP.COLOR");
				array_push($FieldArr_Sal,"BP.CLARITY");
				array_push($FieldArr_Sal,"BP.CUT");
				array_push($FieldArr_Sal,"BP.POLISH");
				array_push($FieldArr_Sal,"BP.SYMM");
				array_push($FieldArr_Sal,"BP.FLOURANCE");
				array_push($FieldArr_Sal,"BP.GREEN");
				array_push($FieldArr_Sal,"BP.MILKY");
				array_push($FieldArr_Sal,"BP.LAB");
				array_push($FieldArr_Sal,"BP.CERTIFICATENO");
				array_push($FieldArr_Sal,"BP.RATE");
				array_push($FieldArr_Sal,"BP.DISCPER");
				array_push($FieldArr_Sal,"BP.PERCRTDOLLAR");
				array_push($FieldArr_Sal,"BP.RATEDOLLAR");
				array_push($FieldArr_Sal,"BP.CONVRATE");
				array_push($FieldArr_Sal,"BP.RSPERCRT");
				array_push($FieldArr_Sal,"BP.RSAMOUNT");
				array_push($FieldArr_Sal,"PS.VOUCHERDATE");
								
								
				$res_sal = getData(BARCODE_PROCESS,$FieldArr_Sal," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID WHERE BP.PROCESSTYPE='Sale' ".$VDATE.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY);
				$maxcnt = 0;
								
				if(mysqli_num_rows($res_pur) >= mysqli_num_rows($res_sal))
					{
						$maxcnt = mysqli_num_rows($res_pur);
					}
				else
					{
						$maxcnt = mysqli_num_rows($res_sal);
					}
				$html='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Purchase-Sale</h5></td>
						</tr>
						
						</table>
						<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
													
													<th colspan="22" style="text-align:center;">Purchase</th>
													<th style="text-align:center;"></th>
													<th colspan="21" style="text-align:center;">Sale</th>
												</tr>
												<tr>
												
													<th>Sr No</th>
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	
													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>		
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
													<th></th>
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	
													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>										
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
												</tr>
											 </thead>
											<tbody>';
											
											$purdataarr= array();
											$saldataarr= array();
											$i = 0;
											while($resdata_pur = mysqli_fetch_assoc($res_pur))
													{
														$purdataarr[$i++]= '
																		
																		<td>'.getDateFormat($resdata_pur["VOUCHERDATE"]).'</td>
																		<td>'.$resdata_pur["BARCODENO"].'</td>
																		<td>'.$resdata_pur["PARTY"].'</td>
																		<td>'.$resdata_pur["BROKER"].'</td>
																		<td>'.$resdata_pur["WEIGHT"].'</td>
																		<td>'.$resdata_pur["SHAPE"].'</td>
																		<td>'.$resdata_pur["COLOR"].'</td>
																		<td>'.$resdata_pur["CLARITY"].'</td>
																		<td>'.$resdata_pur["CUT"].'</td>
																		<td>'.$resdata_pur["POLISH"].'</td>
																		<td>'.$resdata_pur["SYMM"].'</td>
																		<td>'.$resdata_pur["FLOURANCE"].'</td>
																		<td>'.$resdata_pur["CERTIFICATENO"].'</td>
																		<td>'.$resdata_pur["LAB"].'</td>
																		<td>'.getCurrFormat0($resdata_pur["RATE"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["DISCPER"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["PERCRTDOLLAR"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["RATEDOLLAR"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["CONVRATE"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["PERCRTDOLLAR"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["RSAMOUNT"]).'</td>
															';
												
													}
											while($i< $maxcnt)
												{
													$purdataarr[$i] ='';
													for($j=1;$j<=21;$j++)
													{
														$purdataarr[$i].='<td></td>';
													}
													$i++;
													
												}
											$i = 0;
											while($resdata_sal = mysqli_fetch_assoc($res_sal))
													{
														$saldataarr[$i++]= '<td>'.getDateFormat($resdata_sal["VOUCHERDATE"]).'</td>
																		<td>'.$resdata_sal["BARCODENO"].'</td>
															<td>'.$resdata_sal["PARTY"].'</td>
															<td>'.$resdata_sal["BROKER"].'</td>
															<td>'.$resdata_sal["WEIGHT"].'</td>
															<td>'.$resdata_sal["SHAPE"].'</td>
															<td>'.$resdata_sal["COLOR"].'</td>
															<td>'.$resdata_sal["CLARITY"].'</td>
															<td>'.$resdata_sal["CUT"].'</td>
															<td>'.$resdata_sal["POLISH"].'</td>
															<td>'.$resdata_sal["SYMM"].'</td>
															<td>'.$resdata_sal["FLOURANCE"].'</td>
															<td>'.$resdata_sal["CERTIFICATENO"].'</td>
															<td>'.$resdata_sal["LAB"].'</td>
															<td>'.getCurrFormat0($resdata_sal["RATE"]).'</td>
															<td>'.getCurrFormat($resdata_sal["DISCPER"]).'</td>
															<td>'.getCurrFormat($resdata_sal["PERCRTDOLLAR"]).'</td>
															<td>'.getCurrFormat($resdata_sal["RATEDOLLAR"]).'</td>
															<td>'.getCurrFormat($resdata_sal["CONVRATE"]).'</td>
															<td>'.getCurrFormat($resdata_sal["PERCRTDOLLAR"]).'</td>
															<td>'.getCurrFormat($resdata_sal["RSAMOUNT"]).'</td>
															';
													}
											
											for($i= 0; $i< $maxcnt ;$i++)
												{
													$html.='
													<tr>
														<td>'.($i+1).'</td>
														'.(count($purdataarr) >= $i+1 ? $purdataarr[$i] : '').'<td></td>'.(count($saldataarr) >= $i+1 ? $saldataarr[$i] : '').'
													</tr>';
												}
											
							$html.='</tbody>
							
										</table>';
			}
			break;
			
			
			case "Sale With Purchase":
			{
				$pdf->AddPage("L","A2");
				$FieldArr_Pur= array();				
				array_push($FieldArr_Pur,"BP.ENTRYID");
				array_push($FieldArr_Pur,"BP.ID");
				array_push($FieldArr_Pur,"BP.ENTRYDATE");
				array_push($FieldArr_Pur,"L.LEDGERNAME AS PARTY");
				array_push($FieldArr_Pur,"B.LEDGERNAME AS BROKER");
				array_push($FieldArr_Pur,"BP.REMARK");
				array_push($FieldArr_Pur,"BP.BARCODENO");
				array_push($FieldArr_Pur,"BP.WEIGHT");
				array_push($FieldArr_Pur,"BP.SHAPE");
				array_push($FieldArr_Pur,"BP.COLOR");
				array_push($FieldArr_Pur,"BP.CLARITY");
				array_push($FieldArr_Pur,"BP.CUT");
				array_push($FieldArr_Pur,"BP.POLISH");
				array_push($FieldArr_Pur,"BP.SYMM");
				array_push($FieldArr_Pur,"BP.FLOURANCE");
				array_push($FieldArr_Pur,"BP.GREEN");
				array_push($FieldArr_Pur,"BP.MILKY");
				array_push($FieldArr_Pur,"BP.LAB");
				array_push($FieldArr_Pur,"BP.CERTIFICATENO");
				array_push($FieldArr_Pur,"BP.RATE");
				array_push($FieldArr_Pur,"BP.DISCPER");
				array_push($FieldArr_Pur,"BP.PERCRTDOLLAR");
				array_push($FieldArr_Pur,"BP.RATEDOLLAR");
				array_push($FieldArr_Pur,"BP.CONVRATE");
				array_push($FieldArr_Pur,"BP.RSPERCRT");
				array_push($FieldArr_Pur,"BP.RSAMOUNT");
				array_push($FieldArr_Pur,"PS.VOUCHERDATE");
				

				switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
								}
								
				$res_pur = getData(BARCODE_PROCESS,$FieldArr_Pur," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID WHERE BP.PROCESSTYPE='Purchase' AND BP.BARCODENO IN(SELECT SBP.BARCODENO FROM ".BARCODE_PROCESS." AS SBP WHERE SBP.PROCESSTYPE IN('Sale'))".$ORDERBY_COND);
												
								
				$FieldArr_Sal= array();						
								
				array_push($FieldArr_Sal,"BP.ENTRYID");
				array_push($FieldArr_Sal,"BP.ID");
				array_push($FieldArr_Sal,"BP.ENTRYDATE");
				array_push($FieldArr_Sal,"L.LEDGERNAME AS PARTY");
				array_push($FieldArr_Sal,"B.LEDGERNAME AS BROKER");
				array_push($FieldArr_Sal,"BP.REMARK");
				array_push($FieldArr_Sal,"BP.BARCODENO");
				array_push($FieldArr_Sal,"BP.WEIGHT");
				array_push($FieldArr_Sal,"BP.SHAPE");
				array_push($FieldArr_Sal,"BP.COLOR");
				array_push($FieldArr_Sal,"BP.CLARITY");
				array_push($FieldArr_Sal,"BP.CUT");
				array_push($FieldArr_Sal,"BP.POLISH");
				array_push($FieldArr_Sal,"BP.SYMM");
				array_push($FieldArr_Sal,"BP.FLOURANCE");
				array_push($FieldArr_Sal,"BP.GREEN");
				array_push($FieldArr_Sal,"BP.MILKY");
				array_push($FieldArr_Sal,"BP.LAB");
				array_push($FieldArr_Sal,"BP.CERTIFICATENO");
				array_push($FieldArr_Sal,"BP.RATE");
				array_push($FieldArr_Sal,"BP.DISCPER");
				array_push($FieldArr_Sal,"BP.PERCRTDOLLAR");
				array_push($FieldArr_Sal,"BP.RATEDOLLAR");
				array_push($FieldArr_Sal,"BP.CONVRATE");
				array_push($FieldArr_Sal,"BP.RSPERCRT");
				array_push($FieldArr_Sal,"BP.RSAMOUNT");
				array_push($FieldArr_Sal,"PS.VOUCHERDATE");
								
								
				$res_sal = getData(BARCODE_PROCESS,$FieldArr_Sal," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID WHERE BP.PROCESSTYPE='Sale' ".$VDATE.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY .$ORDERBY_COND);
				$maxcnt = 0;
								
				if(mysqli_num_rows($res_sal) >= mysqli_num_rows($res_pur))
								{
									
									$maxcnt = mysqli_num_rows($res_pur);
								}
								else
								{
									$maxcnt = mysqli_num_rows($res_sal);
									
								}
				$html='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Sale With Purchase</h5></td>
						</tr>
						
						</table>
						<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
													
													<th colspan="22" style="text-align:center;">Sale</th>
													<th style="text-align:center;"></th>
													<th colspan="21" style="text-align:center;">Purchase</th>
												</tr>
												<tr>
												
													<th>Sr No</th>
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	
													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>										
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
													
													<th></th>
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	
													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>		
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
												</tr>
											 </thead>
											<tbody>';
											
											$purdataarr= array();
											$saldataarr= array();
											$i = 0;
											while($resdata_sal = mysqli_fetch_assoc($res_sal))
													{
														$saldataarr[$i++]= '<td>'.getDateFormat($resdata_sal["VOUCHERDATE"]).'</td>
																		<td>'.$resdata_sal["BARCODENO"].'</td>
															<td>'.$resdata_sal["PARTY"].'</td>
															<td>'.$resdata_sal["BROKER"].'</td>
															<td>'.$resdata_sal["WEIGHT"].'</td>
															<td>'.$resdata_sal["SHAPE"].'</td>
															<td>'.$resdata_sal["COLOR"].'</td>
															<td>'.$resdata_sal["CLARITY"].'</td>
															<td>'.$resdata_sal["CUT"].'</td>
															<td>'.$resdata_sal["POLISH"].'</td>
															<td>'.$resdata_sal["SYMM"].'</td>
															<td>'.$resdata_sal["FLOURANCE"].'</td>
															<td>'.$resdata_sal["CERTIFICATENO"].'</td>
															<td>'.$resdata_sal["LAB"].'</td>
															<td>'.getCurrFormat0($resdata_sal["RATE"]).'</td>
															<td>'.getCurrFormat($resdata_sal["DISCPER"]).'</td>
															<td>'.getCurrFormat($resdata_sal["PERCRTDOLLAR"]).'</td>
															<td>'.getCurrFormat($resdata_sal["RATEDOLLAR"]).'</td>
															<td>'.getCurrFormat($resdata_sal["CONVRATE"]).'</td>
															<td>'.getCurrFormat($resdata_sal["PERCRTDOLLAR"]).'</td>
															<td>'.getCurrFormat($resdata_sal["RSAMOUNT"]).'</td>
															';
													}
												while($i< $maxcnt)
												{
													$saldataarr[$i] ='';
													for($j=1;$j<=21;$j++)
													{
														$saldataarr[$i].='<td>&nbsp;</td>';
													}
													$i++;
													
												}
											
											$i = 0;
											while($resdata_pur = mysqli_fetch_assoc($res_pur))
													{
														$purdataarr[$i++]= '
																		
																		<td>'.getDateFormat($resdata_pur["VOUCHERDATE"]).'</td>
																		<td>'.$resdata_pur["BARCODENO"].'</td>
																		<td>'.$resdata_pur["PARTY"].'</td>
																		<td>'.$resdata_pur["BROKER"].'</td>
																		<td>'.$resdata_pur["WEIGHT"].'</td>
																		<td>'.$resdata_pur["SHAPE"].'</td>
																		<td>'.$resdata_pur["COLOR"].'</td>
																		<td>'.$resdata_pur["CLARITY"].'</td>
																		<td>'.$resdata_pur["CUT"].'</td>
																		<td>'.$resdata_pur["POLISH"].'</td>
																		<td>'.$resdata_pur["SYMM"].'</td>
																		<td>'.$resdata_pur["FLOURANCE"].'</td>
																		<td>'.$resdata_pur["CERTIFICATENO"].'</td>
																		<td>'.$resdata_pur["LAB"].'</td>
																		<td>'.getCurrFormat0($resdata_pur["RATE"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["DISCPER"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["PERCRTDOLLAR"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["RATEDOLLAR"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["CONVRATE"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["PERCRTDOLLAR"]).'</td>
																		<td>'.getCurrFormat($resdata_pur["RSAMOUNT"]).'</td>
															';
												
													}
											while($i< $maxcnt)
												{
													$purdataarr[$i] ='';
													for($j=1;$j<=21;$j++)
													{
														$purdataarr[$i].='<td></td>';
													}
													$i++;
													
												}
											
											
											for($i= 0; $i< $maxcnt ;$i++)
												{
													$html.='
													<tr>
														<td>'.($i+1).'</td>
														'.(count($saldataarr) >= $i+1 ? $saldataarr[$i] : '').'<td></td>'.(count($purdataarr) >= $i+1 ? $purdataarr[$i] : '').'
													</tr>';
												}
											
							$html.='</tbody>
							
										</table>';
			}
			break;
			
			case "Purchase Party Wise Profit":
			{
				$pdf->AddPage("P","A4");
				$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
					$FieldArr= array();				
							
								array_push($FieldArr,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"BP.BARCODENO");
								array_push($FieldArr,"BP.WEIGHT");
								array_push($FieldArr,"BP.COLOR");
								array_push($FieldArr,"BP.CLARITY");
								array_push($FieldArr,"SP.VDATE");
								
								array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
								array_push($FieldArr,"ROUND(((SP.RSAMOUNT - BP.RSAMOUNT) / BP.RSAMOUNT)*100) AS GPRATIO");
								
								
								array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
								/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
								
								
								array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
								array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
								array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
								
								switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									case 'GP':
										$ORDERBY_COND =' ORDER BY ROUND(((SP.RSAMOUNT - BP.RSAMOUNT) / BP.RSAMOUNT)*100)';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
								
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID  LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale'  WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' ".
								$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
						
				
				
				$html='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Purchase Party Wise Profit</h5></td>
						</tr>
						
						</table>
				<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
										
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
													<th>NO</th>
													<th>DATE</th>	
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>PUR AMT</th>
													<th>SAL AMT</th>
													<th>DIFF AMT</th>
													<th>GP RATIO</th>
												</tr>
											 </thead>
											<tbody>';
										
												$idx = 1;
												$WEIGHT = 0;
												$PURAMT = 0;
												$SALAMT = 0;
												$GPRATIO=0;
												while($resdata = mysqli_fetch_assoc($res))
													{
														
														
														
														$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
														$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
														$GPRATIO = round((($sal-$pur)/$pur)*100,2);
														
														$WEIGHT += $resdata["WEIGHT"];
														$PURAMT += $pur;
														$SALAMT += $sal;
													
														$html.='<tr>
															<td align="center">'.$idx++.'</td>
																<td>'.($resdata["VDATE"]=='' ? '' : getDateFormat($resdata["VDATE"])).'</td>
																<td>'.$resdata["BARCODENO"].'</td>
																<td>'.$resdata["WEIGHT"].'</td>
																<td>'.$resdata["COLOR"].'</td>
																<td>'.$resdata["CLARITY"].'</td>
																<td align="right">'.getCurrFormat($pur).'</td>
																<td align="right">'.getCurrFormat($sal).'</td>
																<td align="right">'.getCurrFormat($sal - $pur).'</td>
																<td align="right">'.$GPRATIO.'</td>
																
															</tr>';
													}
								$html .='<tr>
															<td align="center"></td>
																<td></td>
																<td></td>
																<td>'.$WEIGHT.'</td>
																<td></td>
																<td></td>
																<td align="right">'.getCurrFormat($PURAMT).'</td>
																<td align="right">'.getCurrFormat($SALAMT).'</td>
																<td align="right">'.getCurrFormat($SALAMT - $PURAMT).'</td>
																<td></td>
															</tr>
															</tbody>
										</table>';
			}
			break;
			
			case "Sale Party Wise Profit":
			{
				$pdf->AddPage("P","A4");
				$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
				$FieldArr= array();				
							
				array_push($FieldArr,"L.LEDGERNAME AS PARTY");
				array_push($FieldArr,"BP.RSAMOUNT");
				array_push($FieldArr,"BP.BARCODENO");
				array_push($FieldArr,"BP.WEIGHT");
				array_push($FieldArr,"BP.COLOR");
				array_push($FieldArr,"BP.CLARITY");
				array_push($FieldArr,"SP.VDATE");
				array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
				array_push($FieldArr,"ROUND(((BP.RSAMOUNT - SP.RSAMOUNT) / SP.RSAMOUNT)*100) AS GPRATIO");

				array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS BROKERAMT");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS IGSTAMT");
				/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");

				array_push($FieldArr,"((SP.RSAMOUNT * SP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
				
				
				array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS SIGSTAMT");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS SBROKERAMT");
								
								switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									case 'GP':
										$ORDERBY_COND =' ORDER BY ROUND(((BP.RSAMOUNT - SP.RSAMOUNT) / SP.RSAMOUNT)*100)';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID  LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Purchase'  WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Sale' ".
								$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
						
				
				
				$html='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Sale Party Wise Profit</h5></td>
						</tr>
						
						</table>
				<table width="100%" border="1" style="font-size:0.8em;">
								<thead>
										
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
													<th>NO</th>
													<th>DATE</th>	
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>SAL AMT</th>
													<th>PUR AMT</th>
													<th>DIFF AMT</th>
													<th>GP RATIO</th>
												</tr>
											 </thead>
											<tbody>';
				
												$idx = 1;
												$PURAMT = 0;
												$WEIGHT =0;
												$SALAMT = 0;
												$GPRATIO=0;
												while($resdata = mysqli_fetch_assoc($res))
													{
														$pur = $resdata["SRSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"];
														$sal = ($resdata["RSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
														
														$GPRATIO = round((($sal-$pur)/$pur)*100,2);
														
														$WEIGHT += $resdata["WEIGHT"];
														$PURAMT += $pur;
														$SALAMT += $sal;
													
														$html.='<tr>
															<td align="center">'.$idx++.'</td>
																<td>'.($resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"])).'</td>
																<td>'.$resdata["BARCODENO"].'</td>
																<td>'.$resdata["WEIGHT"].'</td>
																<td>'.$resdata["COLOR"].'</td>
																<td>'.$resdata["CLARITY"].'</td>
																<td align="right">'.getCurrFormat($sal).'</td>
																<td align="right">'.getCurrFormat($pur).'</td>
																<td align="right">'.getCurrFormat($sal - $pur).'</td>
																<td align="right">'. $GPRATIO.'</td>
																
															</tr>';
													}
								$html .='<tr>
															<td align="center"></td>
																<td></td>
																<td></td>
																<td>'.$WEIGHT .'</td>
																<td></td>
																<td></td>
																<td align="right">'.getCurrFormat($SALAMT).'</td>
																<td align="right">'.getCurrFormat($PURAMT).'</td>
																<td align="right">'.getCurrFormat($SALAMT - $PURAMT).'</td>
																<td></td>
															</tr>
															</tbody>
										</table>';
			}
			break;
			case "Unsold Partnership Stock":
				{
						$pdf->AddPage("P","A4");
						$FieldArr= array();	
						array_push($FieldArr,"PS.VOUCHERDATE");
						array_push($FieldArr,"L.LEDGERNAME AS PARTY");
						array_push($FieldArr,"BARCODENO");
						array_push($FieldArr,"WEIGHT");
						array_push($FieldArr,"COLOR");
						array_push($FieldArr,"CLARITY");
						array_push($FieldArr,"BP.RSAMOUNT");
						array_push($FieldArr,"PRL.LEDGERNAME AS PARTNERNAME");
						
							switch($ORDERBY)
							{
								case 'Date':
									$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
								break;
								default:
									$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
								break;
							}
							
						$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID 
						AND PS.VOUCHERTYPE=BP.PROCESSTYPE AND PS.PARTNERPER > 0 INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID 
						LEFT JOIN ".LEDGER." AS PRL ON PRL.LEDGERID=BP.PARTNERLEDGERID 
						WHERE  BP.PROCESSTYPE='Purchase' 
						AND BP.BARCODENO NOT IN(SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') AND BP.PARTNERPER > 0 "
						.$VDATE.$COLOR.$BARCODENO.$CLARITY.$WEIGHT.$PARTY.$PARTNER.$ORDERBY_COND);
						
							$html ='<table width="100%" style="font-size:0.8em;">
									<tr>
										<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Unsold Partnership Stock</h5></td>
									</tr>
									
									</table>
											<table width="100%" border="1">	
											<thead>
													<tr style="text-align:center;">
														<th style="text-align:center;width:5%;" >
														Sr No
														</th>
														<th>Date</th>	
														<th style="width:20%;">Party</th>
														<th>Stock Id</th>
														<th style="width:20%;">Partner Name</th>														
														<th style="width:5%;">WT</th>	
														<th style="width:5%;">Cl</th>	
														<th>Cal</th>
														<th>Rs Amt</th>
														
													</tr>
												</thead>
												<tbody>
									';
										$idx = 1;
										$rstotal=0;
										while($resdata = mysqli_fetch_assoc($res))
											{
												$rstotal += $resdata["RSAMOUNT"];
												$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
											
											$html .='<tr class="">
													
														<td style="text-align:center;width:5%;">'.$idx++ .'</td>
														<td>'. getDateFormat($resdata["VOUCHERDATE"]).'</td>
														<td style="width:20%;">'. $resdata["PARTY"].'</td>
														
														<td>'. $resdata["BARCODENO"].'</td>
														<td style="width:20%;">'. $resdata["PARTNERNAME"].'</td>
														
														<td style="width:5%;">'. $resdata["WEIGHT"].'</td>
														<td style="text-align:center;width:5%;">'. $resdata["COLOR"].'</td>
														<td style="text-align:center;">'. $resdata["CLARITY"].'</td>
														<td align="right">'. getCurrFormat($resdata["RSAMOUNT"]) .'</td>
														
													</tr>
												';
											}
									                                        
									$html .='
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td align="center"><b>Total</b></td>
										<td align="right">'. getCurrFormat($rstotal).'</td>																	
									</tr>
									</tbody>
								</table>
							';
				}
				break;
			
			case "Stock Comparison":
			{
				$pdf->AddPage("P","A4");
				$FieldArr= array();		
				$FieldArr[0]="BP.*";
				$FieldArr[1]="(BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT))) AS CURRWGT";
				$res = getData(BARCODE_PROCESS,$FieldArr," AS BP 
				LEFT JOIN ". BARCODE_PROCESS ." AS SP ON BP.BARCODENO=SP.BARCODENO AND SP.PROCESSTYPE='Sale' 
				WHERE BP.PROCESSTYPE IN ('Purchase','Memo Issue','Memo Receive','Repair Issue','Repair Receive','Grading Issue','Grading Result','Grading Receive') 
				and BP.ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO)" .$BARCODENO .$WEIGHT.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE." GROUP BY BP.BARCODENO HAVING BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT)) > 0 ORDER BY CAST(SUBSTR(BP.BARCODENO,3) AS UNSIGNED)");
				$end_from = mysqli_num_rows($res);
				$html='<table width="100%" style="font-size:0.8em;">
						<tr>
							<td colspan="2" style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Stock Comparison</h5></td>
						</tr>
						
						</table>
				<table width="100%" border="1" style="font-size:0.7em;">
								<thead>
										
												<tr style="text-align:center;font-weight:bold;font-size:1.5em;">
													<th>NO</th>
														
														<th>STOCK ID</th>
														<th>WEIGHT</th>
														<th>COLOR</th>
														<th>CLARITY</th>
														<th>CUT</th>
														<th>POLISH</th>
														<th>SYMM</th>
														<th>FLOUR</th>
														<th colspan="3" style="text-align:center;">DISCOUNT</th>
														<th colspan="3" style="text-align:center;">AMOUNT</th>
												</tr>
												<tr style="text-align:center;font-weight:bold;font-size:1em;">
													<th colspan="9"></th>
													<th>PUR DISC</th>
													<th>DISC 2</th>
													<th>MKT DISC</th>
													<th>PUR Amt</th>
													<th>CURR Amt</th>
													<th>DIFF</th>
													
												</tr>
											 </thead>
											<tbody>';
							$idx=1;
						$ttlwgt = 0;
						$ttldollar = 0;
						$ttlcurr_rsamount=0;
						while($resdata = mysqli_fetch_assoc($res))
							{
								
								//$RAPRATE = getRapPrice($resdata["SHAPE"],$resdata["COLOR"],$resdata["CLARITY"],$resdata["WEIGHT"]);
									if($resdata["COLOR"] == '')
									{
										$RAPRATE =$resdata["CURRRAP"];
									}
									else
									{
										$RAPRATE = getRapPrice($resdata["SHAPE"],$resdata["COLOR"],$resdata["CLARITY"],$resdata["WEIGHT"]);
									}									
									$curr_rsamount = ($RAPRATE * $resdata["WEIGHT"]) ;
														if($resdata["RAPDISCOUNT"] >0)
														{
															$curr_rsamount = $curr_rsamount * (1 - $resdata["RAPDISCOUNT"]/ 100);
														}
														/*if($resdata["DISC2PER"] >0)
														{
															$curr_rsamount = $curr_rsamount * (1 - $resdata["DISC2PER"]/ 100);
														}*/
								$ttlwgt  += $resdata["WEIGHT"];
								$ttldollar  += $resdata["TOTALDOLLAR"];
								$ttlcurr_rsamount +=$curr_rsamount;
								$html.='<tr>
											<td align="center">'.$idx++.'</td>
																<td>'.$resdata["BARCODENO"].'</td>
																<td>'.sprintf("%.2f",$resdata["WEIGHT"]).'</td>
																
																<td>'.$resdata["COLOR"].'</td>
																<td>'.$resdata["CLARITY"].'</td>
																<td>'.$resdata["CUT"].'</td>
																<td>'.$resdata["POLISH"].'</td>
																<td>'.$resdata["SYMM"].'</td>
																<td>'.$resdata["FLOURANCE"].'</td>
																<td align="right">'.sprintf("%.3f",$resdata["DISCPER"]).'</td>
																<td align="right">'.sprintf("%.3f",$resdata["DISC2PER"]).'</td>
																<td align="right">'.sprintf("%.3f",$resdata["RAPDISCOUNT"]).'</td>
																<td align="right">'.sprintf("%.2f",$resdata["TOTALDOLLAR"]).'</td>
																<td align="right">'.sprintf("%.2f",$curr_rsamount).'</td>
																<td align="right">'.sprintf("%.2f",($curr_rsamount-$resdata["TOTALDOLLAR"])).'</td>
																
																
															</tr>';
															
							}
						$html .='<tr>
									<td></td>
									<td></td>
									<td>'.sprintf("%.2f",$ttlwgt).'</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>'.sprintf("%.2f",$ttldollar).'</td>
									<td>'.sprintf("%.2f",$ttlcurr_rsamount).'</td>
									<td>'.sprintf("%.2f",$ttlcurr_rsamount-$ttldollar).'</td>
						</tr>
															</tbody>
										</table>';					
			}
			break;
			case "Broker Purchase-Sale P & L":
			{
				
				$pdf->AddPage("L","A4");				
				$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				$FieldArr= array();				
									array_push($FieldArr,"B.LEDGERNAME AS BROKERNAME");
									array_push($FieldArr,"L.LEDGERNAME AS PARTY");
									array_push($FieldArr,"BP.COLOR");
									array_push($FieldArr,"BP.CLARITY");
									array_push($FieldArr,"BP.WEIGHT");
									array_push($FieldArr,"BP.RSAMOUNT");
									array_push($FieldArr,"BP.BARCODENO");
									array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");
									array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
									array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
									array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
									/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
									array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
									array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
									
									array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
									array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
					array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
								switch($ORDERBY)
									{
										case 'Date':
											$ORDERBY_COND =' ORDER BY SP.VDATE';
										break;
										default:
											$ORDERBY_COND =' ORDER BY SP.VDATE';
										break;
									}
									
									$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID 
									AND PS.VOUCHERTYPE=BP.PROCESSTYPE AND PS.BROKERID!='' AND PS.VOUCHERTYPE='Purchase'  
									INNER JOIN ".LEDGER." AS B ON B.LEDGERID=PS.BROKERID LEFT JOIN ".LEDGER." AS L ON L.LEDGERID=PS.LEDGERID 
									LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale' 
									WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' ".
									$BROKER.$VDATE.$BARCODENO.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$ORDERBY_COND);
									$end_from = mysqli_num_rows($res);
				
					$html ='<table width="100%" style="font-size:0.8em;">
							<tr>
								<td style="text-align:center;font-weight:bold;font-size:1.5em;"><h5>Broker Purchase-Sale P & L</h5></td>
							</tr>
							</table>
							<table width="100%" border="1" style="font-size:0.7em;">
											
												<thead>																									
													<tr>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:5%">NO</th>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:10%">DATE</th>	
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:15%">BROKER NAME</th>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:15%">PARTY NAME</th>	
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:10%">STOCK ID</th>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:5%">WEIGHT</th>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:5%">COLOR</th>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:5%">CLARITY</th>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:10%">PUR AMT</th>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:10%">SAL AMT</th>
														<th style="text-align:center;font-weight:bold;font-size:1.5em;width:10%">DIFF AMT</th>																										
													</tr>
												 </thead>
												<tbody>	';
												$PURAMT=0;
												$SALAMT=0;
												$DIFFAMT=0;
												$WGTSUM =0;
												$IGSTAMT=0;
												$BROKERAMT=0;
												$SIGSTAMT=0;
												$SBROKERAMT=0;
											    $AMT=0;
												$idx = 1;
													while($resdata = mysqli_fetch_assoc($res))
														{
															$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"];
															$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
															$PURAMT += $pur;
															$SALAMT += $sal;
															$WGTSUM += $resdata["WEIGHT"];
															$AMT = $AMT + ($sal-$pur);
																
															$html .='<tr>
																	<td align="center" width="5%">'.$idx++.'</td>
																	<td width="10%">'.($resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"])).'</td>
																	<td width="15%">'. $resdata["BROKERNAME"].'</td>
																	<td width="15%">'. $resdata["PARTY"].'</td>
																	<td width="10%">'. $resdata["BARCODENO"].'</td>
																	<td width="5%">'. $resdata["WEIGHT"].'</td>
																	<td width="5%">'. $resdata["COLOR"].'</td>
																	<td width="5%">'. $resdata["CLARITY"].'</td>
																	<td align="right" width="10%">'.getCurrFormat($pur).'</td>
																	<td align="right" width="10%">'. getCurrFormat($sal).'</td>
																	<td align="right" width="10%">'.getCurrFormat($sal-$pur).'</td>
																	</tr>';
															
														}
												$html .='<tr>		
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td align="right">'.getCurrFormat($PURAMT).'</td>
																	<td align="right">'. getCurrFormat($SALAMT).'</td>
																	<td align="right">'. getCurrFormat($AMT).'</td>
																
																</tr>		
												</tbody>
								</table>
						
					';
			}
					
		}
		$pdf->writeHTML($html, true, false, false, false, '');	
		$pdf->Output("upload/report/".$PostArrayReport["cmbREPORTLIST"].".pdf", 'F');
		?>
		<script>
			window.open('<?php echo "upload/report/".$PostArrayReport["cmbREPORTLIST"].".pdf";?>');
			//window.location.href='<?php echo "upload/report/".$PostArrayReport["cmbREPORTLIST"].".pdf";?>';
		</script>
		
		<?php
	}		
}

elseif(isset($_POST["report"]))
{
?>
<div class="row">
	<div class="col-lg-12">
	<form action="<?php echo SITEURL."?report" ?>" method="post" id="frmreportprint">
	<div class="panel panel-primary">
		<div class="panel-heading"><?php echo $PostArrayReport["cmbREPORTLIST"];?> Report</div>
		<button type="submit" class="btn btn-danger" name="pdfprintreport"  id="pdfprintreport"><i class="fa fa-file-pdf-o"></i> PDF</button>
		<button type="button" class="btn btn-success" name="xlsprintreport"  id="xlsprintreport"><i class="fa fa-file-excel-o"></i> XLS</button>
		
		<input type="hidden" name="REPORTLIST" value="<?php echo $PostArrayReport["cmbREPORTLIST"]?>" >
		<input type="hidden" name="REPORTLIST_FROMDATE" value="<?php echo $dtfrm;?>" >
		<input type="hidden" name="REPORTLIST_TODATE" value="<?php echo $dtto;?>" >
		<input type="hidden" name="REPORTLIST_VDATE" value="<?php echo $VDATE;?>" >
		<input type="hidden" name="REPORTLIST_DUEDATE" value="<?php echo $DUEDATE;?>" >
		<input type="hidden" name="REPORTLIST_SHAPE" value="<?php echo $SHAPE;?>" >
		<input type="hidden" name="REPORTLIST_COLOR" value="<?php echo $COLOR;?>" >
		<input type="hidden" name="REPORTLIST_CLARITY" value="<?php echo $CLARITY;?>" >
		<input type="hidden" name="REPORTLIST_CUT" value="<?php echo $CUT;?>" >
		<input type="hidden" name="REPORTLIST_POLISH" value="<?php echo $POLISH;?>" >
		<input type="hidden" name="REPORTLIST_SYMM" value="<?php echo $SYMM;?>" >
		<input type="hidden" name="REPORTLIST_FLOURANCE" value="<?php echo $FLOURANCE;?>" >
		<input type="hidden" name="REPORTLIST_WEIGHT" value="<?php echo $WEIGHT;?>" >
		<input type="hidden" name="REPORTLIST_PARTY" value="<?php echo $PARTY;?>" >
		<input type="hidden" name="REPORTLIST_ORDERBY" value="<?php echo $ORDERBY;?>" >
		<input type="hidden" name="REPORTLIST_MONTH" value="<?php echo $MONTH;?>" >
		<input type="hidden" name="REPORTLIST_YEAR" value="<?php echo $YEAR;?>" >
		<input type="hidden" name="REPORTLIST_VOUCHERDATE" value="<?php echo $VOUCHERDATE;?>" >
		<input type="hidden" name="REPORTLIST_BARCODENO" value="<?php echo $BARCODENO;?>" >
		<input type="hidden" name="REPORTLIST_PARTNER" value="<?php echo $PARTNER;?>" >
		<input type="hidden" name="REPORTLIST_BROKER" value="<?php echo $BROKER;?>" >
<?php
	switch($PostArrayReport["cmbREPORTLIST"])
	{
		case "Purchase":
		{
								$FieldArr= array();				
								array_push($FieldArr,"BP.ENTRYID");
								array_push($FieldArr,"BP.ID");
								array_push($FieldArr,"BP.ENTRYDATE");
								array_push($FieldArr,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr,"BP.REMARK");
								array_push($FieldArr,"BARCODENO");
								array_push($FieldArr,"WEIGHT");
								array_push($FieldArr,"SHAPE");
								array_push($FieldArr,"COLOR");
								array_push($FieldArr,"CLARITY");
								array_push($FieldArr,"CUT");
								array_push($FieldArr,"POLISH");
								array_push($FieldArr,"SYMM");
								array_push($FieldArr,"FLOURANCE");
								array_push($FieldArr,"GREEN");
								array_push($FieldArr,"MILKY");
								array_push($FieldArr,"LAB");
								array_push($FieldArr,"CERTIFICATENO");
								array_push($FieldArr,"RATE");
								array_push($FieldArr,"DISCPER");
								array_push($FieldArr,"PERCRTDOLLAR");
								array_push($FieldArr,"RATEDOLLAR");
								array_push($FieldArr,"BP.CONVRATE");
								array_push($FieldArr,"BP.RSPERCRT");
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"PS.VOUCHERDATE");
					
					
					switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
						break;
					}
					
				$res = getData(BARCODE_PROCESS,$FieldArr," AS BP 
				INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE 
				INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID 
				WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' ".$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
				
				?>
				
							
							
							<div class="panel-body">
							
								<div class="dataTable_wrapper">
								
									<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
										<thead>
											<tr>
												<th style="text-align:center;width:5%;" >
												Sr No
											
												</th>
												<th>Date</th>	
												<th>Stock Id</th>
												<th>Party</th>
												<th>Broker</th>
												
																			
												<th>WT</th>	
												<th>Shp</th>	
												<th>Cl</th>	
												<th>Cal</th>	
												<th>Ct</th>	
												<th>PO</th>	
												<th>Sy</th>	
												<th>Flu</th>
												<th>Certi</th>										
												<th>Lb</th>	
												
												
												<th>Rate</th>
												<th>Disc</th>
												<th>$/Crt</th>
												<th>Rate $</th>
												<th>$</th>
												<th>Rs/Crt</th>
												<th>Rs Amt</th>
												
											</tr>
										</thead>
										<tbody>
							<?php
								$idx = 1;
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											
											<td align="center"><?php echo $idx++;?></td>
												<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
												<td><?php echo $resdata["BARCODENO"];?></td>
												<td><?php echo $resdata["PARTY"];?></td>
												<td><?php echo $resdata["BROKER"];?></td>
												
												
												<td><?php echo $resdata["WEIGHT"];?></td>
												<td><?php echo $resdata["SHAPE"];?></td>
												<td><?php echo $resdata["COLOR"];?></td>
												<td><?php echo $resdata["CLARITY"];?></td>
												<td><?php echo $resdata["CUT"];?></td>
												<td><?php echo $resdata["POLISH"];?></td>
												<td><?php echo $resdata["SYMM"];?></td>
												<td><?php echo $resdata["FLOURANCE"];?></td>
												<td><?php echo $resdata["CERTIFICATENO"];?></td>
												<td><?php echo $resdata["LAB"];?></td>
												
											
												<td class="amountalign"><?php echo getCurrFormat0($resdata["RATE"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["DISCPER"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["PERCRTDOLLAR"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["RATEDOLLAR"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["CONVRATE"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["PERCRTDOLLAR"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["RSAMOUNT"]) ;?></td>
												
																							
										
												
											</tr>
										<?php
									}
							?>                                        
							</tbody>
						</table>
					</div>
					</div>
					
					
				<?php
		}
		break;
		case "Sale":
		{
			$FieldArr= array();
			
								array_push($FieldArr,"BP.ENTRYID");
								array_push($FieldArr,"BP.ID");
								array_push($FieldArr,"BP.ENTRYDATE");
								array_push($FieldArr,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr,"BP.REMARK");
								array_push($FieldArr,"BARCODENO");
								array_push($FieldArr,"WEIGHT");
								array_push($FieldArr,"SHAPE");
								array_push($FieldArr,"COLOR");
								array_push($FieldArr,"CLARITY");
								array_push($FieldArr,"CUT");
								array_push($FieldArr,"POLISH");
								array_push($FieldArr,"SYMM");
								array_push($FieldArr,"FLOURANCE");
								array_push($FieldArr,"GREEN");
								array_push($FieldArr,"MILKY");
								array_push($FieldArr,"LAB");
								array_push($FieldArr,"CERTIFICATENO");
								array_push($FieldArr,"RATE");
								array_push($FieldArr,"DISCPER");
								array_push($FieldArr,"PERCRTDOLLAR");
								array_push($FieldArr,"RATEDOLLAR");
								array_push($FieldArr,"BP.CONVRATE");
								array_push($FieldArr,"BP.RSPERCRT");
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"PS.VOUCHERDATE");
								
								switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
								}
					
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE 
								INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID 
								WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Sale' " .$VDATE .$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
					?>
					
								
								<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
											<thead>
												<tr>
													<th style="text-align:center;width:5%;" >
													Sr No
													</th>
													
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	

													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>	

												
													
													
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
												</tr>
											 </thead>
											<tbody>
											<?php
												$idx = 1;
												
												
												
												
												while($resdata = mysqli_fetch_assoc($res))
													{
														$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
														?>
															<tr class="<?php echo $classname;?>">
															<td align="center"><?php echo $idx++;?></td>
																<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
																<td><?php echo $resdata["BARCODENO"];?></td>
																<td><?php echo $resdata["PARTY"];?></td>
																<td><?php echo $resdata["BROKER"];?></td>
																
																
																<td><?php echo $resdata["WEIGHT"];?></td>
																<td><?php echo $resdata["SHAPE"];?></td>
																<td><?php echo $resdata["COLOR"];?></td>
																<td><?php echo $resdata["CLARITY"];?></td>
																<td><?php echo $resdata["CUT"];?></td>
																<td><?php echo $resdata["POLISH"];?></td>
																<td><?php echo $resdata["SYMM"];?></td>
																<td><?php echo $resdata["FLOURANCE"];?></td>
																<td><?php echo $resdata["CERTIFICATENO"];?></td>
																<td><?php echo $resdata["LAB"];?></td>
																
																
																<td class="amountalign"><?php echo getCurrFormat0($resdata["RATE"]) ;?></td>
																<td class="amountalign"><?php echo getCurrFormat($resdata["DISCPER"]) ;?></td>
																<td class="amountalign"><?php echo getCurrFormat($resdata["PERCRTDOLLAR"]) ;?></td>
																<td class="amountalign"><?php echo getCurrFormat($resdata["RATEDOLLAR"]) ;?></td>
																<td class="amountalign"><?php echo getCurrFormat($resdata["CONVRATE"]) ;?></td>
																<td class="amountalign"><?php echo getCurrFormat($resdata["PERCRTDOLLAR"]) ;?></td>
																<td class="amountalign"><?php echo getCurrFormat($resdata["RSAMOUNT"]) ;?></td>
																
															</tr>
														<?php
													}
											?>                                        
											</tbody>
										</table>
									</div>
								</div>
							
					
					<?php
		}
		break;
		//=============================Monthly Purchase And Sale===================
		case "Monthly Purchase And Sale":
		{				
				$PURCHASETOTAL='';
				
				$FieldArr= array();
				array_push($FieldArr,"DR.VOUCHERDATE");
				array_push($FieldArr,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
				array_push($FieldArr,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
				//array_push($FieldArr,"round(SUM(DR.TCSAMT)) AS TCSAMT");
				//array_push($FieldArr,"round(SUM(DR.THIRDPARTYCHARGES)) AS THIRDPARTYCHARGES");
				//array_push($FieldArr,"round(SUM(DR.THIRDPARTYTCS)) AS THIRDPARTYTCS");
				array_push($FieldArr,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALPURCHASE");			
				$respurchase = getData(PURCHASESALE,$FieldArr," AS DR WHERE VOUCHERTYPE='Purchase' ".$VOUCHERDATE." 
				GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
				
				$FieldArrsale= array();				
				array_push($FieldArrsale,"DR.VOUCHERDATE");
				array_push($FieldArrsale,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
				array_push($FieldArrsale,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
				//array_push($FieldArrsale,"round(SUM(DR.TCSAMT)) AS TCSAMT");
				//array_push($FieldArrsale,"round(SUM(DR.THIRDPARTYCHARGES)) AS THIRDPARTYCHARGES");
				//array_push($FieldArrsale,"round(SUM(DR.THIRDPARTYTCS)) AS THIRDPARTYTCS");
				array_push($FieldArrsale,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALSALE");
				$ressale = getData(PURCHASESALE,$FieldArrsale," AS DR WHERE VOUCHERTYPE='Sale' ".$VOUCHERDATE." 
				GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
			

				$PURCHASEcnt = mysqli_num_rows($respurchase);
				$SALEcnt = mysqli_num_rows($ressale);
				
				
				if($PURCHASEcnt >= $SALEcnt)
				{
					$idx = 1;
					while($respurchasedata = mysqli_fetch_assoc($respurchase))
						{		
							$time=strtotime($respurchasedata["VOUCHERDATE"]);
							$month=date("m",$time);
							$year=date("Y",$time);
							
							$dt1 = $year."-".$month."-"."01";
							$dt2 = $year."-".$month."-"."31";
							
							$FieldArrsale= array();				
							array_push($FieldArrsale,"DR.VOUCHERDATE");
							array_push($FieldArrsale,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
							array_push($FieldArrsale,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
							//array_push($FieldArrsale,"round(SUM(DR.TCSAMT)) AS TCSAMT");
							array_push($FieldArrsale,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALSALE");
							$ressale = getData(PURCHASESALE,$FieldArrsale," AS DR WHERE VOUCHERTYPE='Sale' 
							and VOUCHERDATE BETWEEN '".$dt1."' AND '".$dt2."' GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
							$ressaleData = mysqli_fetch_assoc($ressale);
							$totalsale_GSTAMT= $ressaleData["GSTAMT"];
							//$totalsale_TCSAMT= $ressaleData["TCSAMT"];
							$totalsale_BROKERAMT= $ressaleData["BROKERAMT"];
							$totalsale= $ressaleData["FINALTOTALSALE"];
							
							$OPENSTOCK = getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' 
							and VDATE < '".$dt1."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE < '".$dt1."' 
							AND PROCESSTYPE='Sale')");
							
							$COSINGSTOCK = (getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' 
							and VDATE <= '". $dt2 ."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." 
							WHERE VDATE <= '". $dt2 ."' AND PROCESSTYPE='Sale')"));
							//array_push($FieldArr,"round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100) as GPRATIO");
							//$GP = ($COSINGSTOCK+$totalsale+$totalsale_GSTAMT) - ($OPENSTOCK+$respurchasedata["FINALTOTALPURCHASE"]+$respurchasedata["GSTAMT"]+$respurchasedata["THIRDPARTYCHARGES"]);
							
							
							//$pur = $OPENSTOCK+$respurchasedata["FINALTOTALPURCHASE"] + $respurchasedata["BROKERAMT"] + $respurchasedata["GSTAMT"]+ $respurchasedata["TCSAMT"] + $respurchasedata["THIRDPARTYCHARGES"]+ $respurchasedata["THIRDPARTYTCS"];
							
							$pur = $OPENSTOCK+$respurchasedata["FINALTOTALPURCHASE"] + $respurchasedata["BROKERAMT"] + $respurchasedata["GSTAMT"];
							
							//$sal = $COSINGSTOCK + ($totalsale - $totalsale_BROKERAMT) + $totalsale_GSTAMT+ $totalsale_TCSAMT;
							$sal = $COSINGSTOCK + ($totalsale - $totalsale_BROKERAMT) + $totalsale_GSTAMT;
							
							
							if($pur == 0)
							{
								$GPRATIO=0;
							}
							else
							{								
								$GPRATIO = (($sal-$pur) / $pur) * 100;
								
							}
							//$GPRATIO = ($GP / $totalsale) * 100;
							/*$PURCHASETOTAL .= '<tr>
											<td>'.$idx++.'</td>
											<td>'.$year.'</td>
											<td>'.$LIST["Month"][$month].'</td>
											<td  style="text-align:right;">'. getCurrFormat($respurchasedata["FINALTOTALPURCHASE"]).'</td>
											<td  style="text-align:right;">'.getCurrFormat($totalsale).'</td>
											<td  style="text-align:right;">'.($totalsale > 0 ? getCurrFormat($totalsale/$respurchasedata["FINALTOTALPURCHASE"]) : 0).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["GSTAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalsale_GSTAMT).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["TCSAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalsale_TCSAMT).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["THIRDPARTYCHARGES"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["THIRDPARTYTCS"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($OPENSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($COSINGSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($sal-$pur).'</td>
											<td style="text-align:right;">'.getCurrFormat($GPRATIO).'</td>
									</tr>';*/
									
									$PURCHASETOTAL .= '<tr>
											<td>'.$idx++.'</td>
											<td>'.$year.'</td>
											<td>'.$LIST["Month"][$month].'</td>
											<td  style="text-align:right;">'. getCurrFormat($respurchasedata["FINALTOTALPURCHASE"]).'</td>
											<td  style="text-align:right;">'.getCurrFormat($totalsale).'</td>
											<td  style="text-align:right;">'.($totalsale > 0 ? getCurrFormat($totalsale/$respurchasedata["FINALTOTALPURCHASE"]) : 0).'</td>
											<td style="text-align:right;">'.getCurrFormat($respurchasedata["GSTAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalsale_GSTAMT).'</td>
											
											<td style="text-align:right;">'.getCurrFormat($OPENSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($COSINGSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($sal-$pur).'</td>
											<td style="text-align:right;">'.getCurrFormat($GPRATIO).'</td>
									</tr>';
						}
				}
				else
				{
					$idx = 1;
					while($ressaledata = mysqli_fetch_assoc($ressale))
						{		
							$time=strtotime($ressaledata["VOUCHERDATE"]);
							$month=date("m",$time);
							$year=date("Y",$time);
							
							$dt1 = $year."-".$month."-"."01";
							$dt2 = $year."-".$month."-"."31";
							
							$FieldArrpur= array();				
							array_push($FieldArrpur,"DR.VOUCHERDATE");
							array_push($FieldArrpur,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
							//array_push($FieldArrpur,"round(SUM(DR.TCSAMT)) AS TCSAMT");
							//array_push($FieldArrpur,"round(SUM(DR.THIRDPARTYCHARGES)) AS THIRDPARTYCHARGES");
						//	array_push($FieldArrpur,"round(SUM(DR.THIRDPARTYTCS)) AS THIRDPARTYTCS");
							//array_push($FieldArrpur,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALPURCHASE");
							$respurchase = getData(PURCHASESALE,$FieldArrpur," AS DR WHERE VOUCHERTYPE='Purchase' and VOUCHERDATE BETWEEN '".$dt1."' AND '".$dt2."' GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
							$respurchasedata=mysqli_fetch_assoc($respurchase);
							//$totalpurchase=$respurchasedata["FINALTOTALPURCHASE"];
							$totalpurchase_GST=$respurchasedata["GSTAMT"];
						//	$totalpurchase_TCS=$respurchasedata["TCSAMT"];
							//$totalpurchase_THIRDPARTYCHARGES=$respurchasedata["THIRDPARTYCHARGES"];
						//	$totalpurchase_THIRDPARTYTCS=$respurchasedata["THIRDPARTYTCS"];
							
							$OPENSTOCK = getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE < '".$dt1."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE < '".$dt1."' AND PROCESSTYPE='Sale')");
							
							$COSINGSTOCK = (getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' and VDATE <= '". $dt2 ."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE VDATE <= '". $dt2 ."' AND PROCESSTYPE='Sale')"));
							
							$GP = ($COSINGSTOCK+$ressaledata["FINALTOTALSALE"]+$ressaledata["GSTAMT"]+$ressaledata["TCSAMT"]) - ($OPENSTOCK+$totalpurchase+$totalpurchase_GST+$totalpurchase_TCS+$totalpurchase_THIRDPARTYCHARGES+$totalpurchase_THIRDPARTYTCS);
							
							$GPRATIO = ($GP / $ressaledata["FINALTOTALSALE"]) * 100;
							
						/*	$PURCHASETOTAL .= '<tr>
											<td>'.$idx++.'</td>
											<td>'.$year.'</td>
											<td>'.$LIST["Month"][$month].'</td>
											<td style="text-align:right;">'. getCurrFormat($totalpurchase).'</td>
											<td style="text-align:right;">'. getCurrFormat($ressaledata["FINALTOTALSALE"]).'</td>
											<td style="text-align:right;">'.($totalpurchase > 0 ? getCurrFormat($ressaledata["FINALTOTALSALE"]/$totalpurchase) : 0).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalpurchase_GST).'</td>
											<td style="text-align:right;">'.getCurrFormat($ressaledata["GSTAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalpurchase_TCS).'</td>
											<td style="text-align:right;">'.getCurrFormat($ressaledata["TCSAMT"]).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalpurchase_THIRDPARTYCHARGES).'</td>
											<td style="text-align:right;">'.getCurrFormat($totalpurchase_THIRDPARTYTCS).'</td>
											<td style="text-align:right;">'.getCurrFormat($OPENSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($COSINGSTOCK).'</td>
											<td style="text-align:right;">'.getCurrFormat($GP).'</td>
											<td style="text-align:right;">'.getCurrFormat($GPRATIO).'</td>
									</tr>';*/

							$PURCHASETOTAL .= '<tr>
									<td>'.$idx++.'</td>
									<td>'.$year.'</td>
									<td>'.$LIST["Month"][$month].'</td>
									<td style="text-align:right;">'. getCurrFormat($totalpurchase).'</td>
									<td style="text-align:right;">'. getCurrFormat($ressaledata["FINALTOTALSALE"]).'</td>
									<td style="text-align:right;">'.($totalpurchase > 0 ? getCurrFormat($ressaledata["FINALTOTALSALE"]/$totalpurchase) : 0).'</td>
									<td style="text-align:right;">'.getCurrFormat($totalpurchase_GST).'</td>
									<td style="text-align:right;">'.getCurrFormat($ressaledata["GSTAMT"]).'</td>
									<td style="text-align:right;">'.getCurrFormat($totalpurchase_TCS).'</td>
									
									<td style="text-align:right;">'.getCurrFormat($OPENSTOCK).'</td>
									<td style="text-align:right;">'.getCurrFormat($COSINGSTOCK).'</td>
									<td style="text-align:right;">'.getCurrFormat($GP).'</td>
									<td style="text-align:right;">'.getCurrFormat($GPRATIO).'</td>
							</tr>';
																						
						}
				}
				
				
				?>
				<div class="panel-body">
								<div class="dataTable_wrapper">
												<table width="100%" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th style="text-align:center;" >Sr No</th>
															<th>Year</th>	
															<th>Month</th>
															<th>Purchase Amt</th>
															<th>sale Amt</th>
															<th>Ratio</th>
															<th>Tax In</th>
															<th>Tax Out</th>
															<!--<th>TCS In</th>
															<th>TCS Out</th>
															<th>Third Party Charges</th>
															<th>Third Party TCS</th>-->
															<th>Opening Stock</th>
															<th>Closing Stock</th>
															
															<th>Gross P/L</th>
															<th>GP Ratio</th>
														</tr>
													 </thead>
													<tbody>
													<?php
													echo $PURCHASETOTAL;
													?>
													</tbody>
												</table>
									
								</div>
							</div>
									
					
				<?php
		}
		break;
		//=============================MONTHLY SALE AND PURCHASE===================
		case "Purchase Outstanding":
		{
			$FieldArr_PUR= array();
			array_push($FieldArr_PUR,"ID");
			array_push($FieldArr_PUR,"P.VOUCHERDATE");
			array_push($FieldArr_PUR,"DUEDAYS");
			array_push($FieldArr_PUR,"DUEDATE");
			array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
			array_push($FieldArr_PUR,"B.LEDGERNAME AS BROKER");
			array_push($FieldArr_PUR,"LOCATIONNAME");
			array_push($FieldArr_PUR,"CONVRATE");
			array_push($FieldArr_PUR,"FINALTOTAL");
			array_push($FieldArr_PUR,"CGSTPER");
			array_push($FieldArr_PUR,"IGSTPER");
			array_push($FieldArr_PUR,"SGSTPER");
			array_push($FieldArr_PUR,"CGSTAMT");
			array_push($FieldArr_PUR,"IGSTAMT");
			array_push($FieldArr_PUR,"SGSTAMT");
			array_push($FieldArr_PUR,"GRANDAMOUNT");
			array_push($FieldArr_PUR,"PARTNERAMOUNT");
			array_push($FieldArr_PUR,"LASTAMOUNT");								
			array_push($FieldArr_PUR,"P.LEDGERID");
			array_push($FieldArr_PUR,"THIRDPARTYCHARGES");
			array_push($FieldArr_PUR,"THIRDPARTYCHARGESPER");
								switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY P.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY P.VOUCHERDATE';
						break;
					}
					
					
		$resPur_STRING = " AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0' AND DATE_FORMAT(P.VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'" .$ORDERBY_COND;
				?>
				
							
							<div class="panel-body">
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
										<thead>
											<tr>
												<th>Id</th>	
												<th>Dt</th>	
												<th>Due Dt</th>
												<th>Stock Id</th>
												<th>Party</th>
												<th>Broker</th>
												<th>$</th>
												<th>Final Total</th>
												<th>GST</th>
												<th>Third Party Charges</th>
												<th>Last Total</th>
												<th>Paid</th>
												<th>Due</th>
											</tr>
										</thead>
										<tbody>
							<?php
								$idx = 1;
								$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' and LEDGERID IN (SELECT LEDGERID FROM ".PURCHASESALE." WHERE VOUCHERTYPE='Purchase' and DUEDATE <= CURDATE())");
								while($resledgerdata = mysqli_fetch_assoc($resledger))
									{
										$resPur = getData(PURCHASESALE,$FieldArr_PUR,$resPur_STRING ." AND L.LEDGERID='".$resledgerdata["LEDGERID"]."'".$PARTY);
										
										$totalpaid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."'");
										
										while($resdata = mysqli_fetch_assoc($resPur))
										{
											$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ', ')" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."' AND ID='".$resdata["ID"]."' AND FLAG='0' AND PROCESSTYPE='Purchase'");
											$GRANDAMOUNT = $resdata["LASTAMOUNT"];
											
											if($totalpaid > 0 )
											{
													$paid = $totalpaid;
													$totalpaid = $totalpaid - $GRANDAMOUNT ;
											
													$due=$GRANDAMOUNT-$paid;
											}
											else
											{
												
												$paid = $totalpaid > 0 ?$totalpaid :0;
												$due = $GRANDAMOUNT;
											}
											if($due > 5)
											{
																				
												$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
												$dueclassname = "";
												$styledue = "";
												$days8 = date('Y-m-d', strtotime("+8 days"));
												
											if($resdata["DUEDATE"] <= date('Y-m-d'))
												{
													$dueclassname = " reddue";
												}
												
												elseif($days8 < $resdata["DUEDATE"])
												{
													$styledue = " display:none;";
												}
												?>
													<tr class="<?php echo $classname;?> " style="<?php echo $styledue;?>">
														<td  rel="<?php echo $resdata["ID"];?>-pur"><?php echo $resdata["ID"];?></a></td>
														
														<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
														<td><?php echo getDateFormat($resdata["DUEDATE"])."(".$resdata["DUEDAYS"].")";?></td>
														<td  width="15%"><?php echo $BARCODENO;?></td>
														<td><?php echo $resdata["PARTY"];?></td>
														<td><?php echo $resdata["BROKER"];?></td>
														<td class="amountalign"><?php echo getCurrFormat($resdata["CONVRATE"]) ;?></td>
														<td class="amountalign"><?php echo getCurrFormat($resdata["FINALTOTAL"]);?></td>
														<td class="amountalign"><?php echo $resdata["IGSTAMT"] > 0 ? getCurrFormat($resdata["IGSTAMT"]) : getCurrFormat(($resdata["SGSTAMT"]+$resdata["CGSTAMT"]));?></td>
														<td class="amountalign"><?php echo getCurrFormat($resdata["THIRDPARTYCHARGES"]);?></td>
													
														<td class="amountalign"><?php echo getCurrFormat0($resdata["LASTAMOUNT"]);?></td>
														<td class="amountalign"><?php echo getCurrFormat($paid) ;?></td>
														<td class="amountalign"><?php echo getCurrFormat0($due);?></td>
														
													</tr>
												<?php
												
											}
											
										}
									}
							?>                                        
							</tbody>
						</table>
					</div>
					</div>
					
				<?php
		}
		
		break;
		
		//========================Due Date Wise Pending Payment==============================
		case "Due Date Wise Pending Payment":
		{
			$FieldArr_PUR= array();
			array_push($FieldArr_PUR,"ID");
			array_push($FieldArr_PUR,"P.VOUCHERDATE");
			array_push($FieldArr_PUR,"DUEDAYS");
			array_push($FieldArr_PUR,"DUEDATE");
			array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
			array_push($FieldArr_PUR,"LASTAMOUNT");								
			array_push($FieldArr_PUR,"P.LEDGERID");
								switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY DUEDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY DUEDATE';
						break;
					}
				
				?>
				
							
							<div class="panel-body">
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>Id</th>	
												<th>Dt</th>	
												<th>Due Days</th>
												<th>Due Date</th>
												<th>Party</th>
												<th>Last Total</th>
												<th>Paid</th>
												<th>Due</th>
											</tr>
										</thead>
										<tbody>
							<?php
								$idx = 1;
									//$resPur = getData(PURCHASESALE,$FieldArr_PUR," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID  WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0'".$PARTY.$DUEDATE.$ORDERBY_COND);
									//while($resdata = mysqli_fetch_assoc($resPur))
										//{
										//	$GRANDAMOUNT = $resdata["LASTAMOUNT"];
										//	$totalpaid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resdata["LEDGERID"]."' AND VOUCHERDATE ='".$resdata["DUEDATE"]."'");
										$resPur = getData(PURCHASESALE,$FieldArr_PUR," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID  WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0'".$PARTY.$DUEDATE.$ORDERBY_COND);
										while($resdata = mysqli_fetch_assoc($resPur))
										{
											$GRANDAMOUNT = $resdata["LASTAMOUNT"];
											$totalpaid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resdata["LEDGERID"]."' AND VOUCHERNO ='".$resdata["ID"]."'");
												
											if($totalpaid > 0 )
											{
													$paid = $totalpaid;
													$totalpaid = $totalpaid - $GRANDAMOUNT ;
											
													$due=$GRANDAMOUNT-$paid;
											}
											else
											{
												
												$paid = $totalpaid > 0 ?$totalpaid :0;
												$due = $GRANDAMOUNT;
											}							
												$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
												$dueclassname = "";
												$styledue = "";
												
											
												?>
													<tr class="<?php echo $classname;?> " style="">
														<td><?php echo $resdata["ID"];?></a></td>
														
														<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
														<td><?php echo $resdata["DUEDAYS"];?></td>
														<td><?php echo getDateFormat($resdata["DUEDATE"]);?></td>
														<td><?php echo $resdata["PARTY"];?></td>
														<td class="amountalign"><?php echo getCurrFormat0($resdata["LASTAMOUNT"]);?></td>
														<td class="amountalign"><?php echo getCurrFormat($paid) ;?></td>
														<td class="amountalign"><?php echo getCurrFormat0($due);?></td>
													</tr>
												<?php
											
										}
									
							?>                                        
							</tbody>
						</table>
					</div>
					</div>
					
				<?php
		}
		
		break;
		//========================Due Date Wise Pending Payment============================
		
		//========================Period Wise Party Payment==============================
		case "Period Wise Party Payment":
		{
			$FieldArr_PUR= array();
			array_push($FieldArr_PUR,"DR.VOUCHERDATE");
			array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
			array_push($FieldArr_PUR,"SUM(AMOUNT) AS AMOUNT");								
			array_push($FieldArr_PUR,"DR.LEDGERID");
								switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' GROUP BY DR.LEDGERID ORDER BY DR.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' GROUP BY DR.LEDGERID ORDER BY DR.VOUCHERDATE';
						break;
					}
				
				?>
				
							
							<div class="panel-body">
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>Party</th>
												<th>Amount</th>
											</tr>
										</thead>
										<tbody>
							<?php
								$idx = 1;
									$resPur = getData(LEDGER_DEBIT,$FieldArr_PUR," AS DR INNER JOIN ".LEDGER." AS L ON L.LEDGERID=DR.LEDGERID  WHERE DR.LEDGERID !='' AND DR.GROUPID IN('25')".$PARTY.$VOUCHERDATE.$ORDERBY_COND);
									$SUMAMOUNT=0;
									while($resdata = mysqli_fetch_assoc($resPur))
									{
												?>
													<tr class="<?php echo $classname;?> " style="">
														<td><?php echo $resdata["PARTY"];?></td>
														<td class="amountalign"><?php echo getCurrFormat0($resdata["AMOUNT"]);?></td>
														
													</tr>
												<?php
												$SUMAMOUNT+=$resdata["AMOUNT"];
											
										}
									
							?>  
							<tr class="<?php echo $classname;?> " style="">
														<td><b>Total:</b></td>
														<td class="amountalign"><b><?php echo getCurrFormat0($SUMAMOUNT);?></b></td>
														
													</tr>
							</tbody>
						</table>
					</div>
					</div>
					
				<?php
		}
		
		break;
		//========================Period Wise Party Payment============================
		
		
		case "Sale Outstanding":
		{
			//echo "hello Sale Outstanding";
			//exit();
			$FieldArr_PUR= array();
								array_push($FieldArr_PUR,"ID");
								array_push($FieldArr_PUR,"P.VOUCHERDATE");
								array_push($FieldArr_PUR,"DUEDAYS");
								array_push($FieldArr_PUR,"DUEDATE");
								array_push($FieldArr_PUR,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_PUR,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_PUR,"LOCATIONNAME");
								array_push($FieldArr_PUR,"CONVRATE");
								array_push($FieldArr_PUR,"FINALTOTAL");
								array_push($FieldArr_PUR,"CGSTPER");
								array_push($FieldArr_PUR,"IGSTPER");
								array_push($FieldArr_PUR,"SGSTPER");
								array_push($FieldArr_PUR,"CGSTAMT");
								array_push($FieldArr_PUR,"IGSTAMT");
								array_push($FieldArr_PUR,"SGSTAMT");
								array_push($FieldArr_PUR,"GRANDAMOUNT");
								array_push($FieldArr_PUR,"P.LEDGERID");
								array_push($FieldArr_PUR,"PARTNERAMOUNT");
								array_push($FieldArr_PUR,"LASTAMOUNT");
						switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY P.VOUCHERDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY P.VOUCHERDATE';
						break;
					}
					
							$resSal_STRING=" AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Sale' AND DATE_FORMAT(P.VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'".$ORDERBY_COND;
		
						?>
			
							
							<div class="panel-body">
								<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered " id="dataTables-example">
										<thead>
											<tr>
												<th>Id</th>	
												<th>Dt</th>	
												<th>Due Dt</th>
												<th>Stock Id</th>
												<th>Party</th>
												<th>Broker</th>
												<th>$</th>
												<th>Final Total</th>
												<th>GST</th>
												<th>Last Total</th>
												<th>Paid</th>
												<th>Due</th>
								</tr>
											</tr>
										</thead>
										<tbody>
							<?php
							$idx = 1;
								
								
							$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' and LEDGERID IN (SELECT LEDGERID FROM ".PURCHASESALE." WHERE VOUCHERTYPE='Sale' and DUEDATE <= CURDATE())");
								while($resledgerdata = mysqli_fetch_assoc($resledger))
								{
									$resSal = getData(PURCHASESALE,$FieldArr_PUR,$resSal_STRING ." AND L.LEDGERID='".$resledgerdata["LEDGERID"]."'".$PARTY);
										
									$totalpaid= getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."'");
										
									while($resdata = mysqli_fetch_assoc($resSal))
									{
											$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ', ')" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."' AND ID='".$resdata["ID"]."' AND FLAG='0' AND PROCESSTYPE='Sale'");
											$GRANDAMOUNT = $resdata["LASTAMOUNT"];
											//$totalpaid = $totalpaid - $GRANDAMOUNT ;
											if($totalpaid > 0 )
											{
													$paid = $totalpaid;
													$totalpaid = $totalpaid - $GRANDAMOUNT ;
											
													$due=$GRANDAMOUNT-$paid;
											}
											else
											{
												
												$paid = $totalpaid > 0 ?$totalpaid :0;
												$due = $GRANDAMOUNT;
											}
											if($due > 5)
											{
												
											$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
											$dueclassname = "";
											$styledue = "";
											$days8 = date('Y-m-d', strtotime("+8 days"));
											
											if($resdata["DUEDATE"] <= date('Y-m-d'))
											{
												$dueclassname = " reddue";
											}
											
											if($days8 < $resdata["DUEDATE"] || $due==0)
											{
												$styledue = " display:none;";
											}
										?>
											<tr class="<?php echo $classname;?> " style="<?php echo $styledue;?>">
												<td class="open_custom_overlay" rel="<?php echo $resdata["ID"];?>-pur"><a href="javascript:void(0)" style="color:#fff;"><?php echo $resdata["ID"];?></a></td>
												<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
												<td><?php echo getDateFormat($resdata["DUEDATE"])."(".$resdata["DUEDAYS"].")";?></td>
												<td width="15%"><?php echo $BARCODENO;?></td>
												<td><?php echo $resdata["PARTY"];?></td>
												<td><?php echo $resdata["BROKER"];?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["CONVRATE"]) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["FINALTOTAL"]);?></td>
												<td class="amountalign"><?php echo $resdata["IGSTAMT"] > 0 ? getCurrFormat($resdata["IGSTAMT"]) : getCurrFormat(($resdata["SGSTAMT"]+$resdata["CGSTAMT"]));?></td>
												<td class="amountalign"><?php echo getCurrFormat0($resdata["LASTAMOUNT"]);?></td>
												<td class="amountalign"><?php echo getCurrFormat($paid) ;?></td>
												<td class="amountalign"><?php echo getCurrFormat0($due);?></td>
											</tr>
										<?php
											}
									}
								}
							?>                                        
							</tbody>
						</table>
					</div>
					</div>
					
				
				<?php
		
		
		
		}
		break;
		case "Purchase-Sale P & L":
		{
			
			$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
			$FieldArr= array();				
							
			//array_push($FieldArr,"BP.STOCKIDVALUE");
			array_push($FieldArr,"BP.LEDGERID");
			array_push($FieldArr,"L.LEDGERNAME");
			array_push($FieldArr,"BP.RSAMOUNT");
			array_push($FieldArr,"BP.BARCODENO");
			array_push($FieldArr,"BP.COLOR");
			array_push($FieldArr,"BP.CLARITY");
			array_push($FieldArr,"BP.WEIGHT");
			array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");
			//array_push($FieldArr,"SP.STOCKIDVALUE AS SSTOCKIDVALUE");
			array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
			array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
			array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
			/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
			array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
			array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
			
			array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
			array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
			
			array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
			array_push($FieldArr,"round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100) as GPRATIO");
				
			
				
				switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									case 'GP':
										$ORDERBY_COND =' ORDER BY round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100)';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale' LEFT JOIN ".LEDGER." AS L ON L.LEDGERID = BP.LEDGERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase'".
								$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$ORDERBY_COND);
								$end_from = mysqli_num_rows($res);
			
			?>
				<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
											<thead>
												
												
												<tr>
													<th style="text-align:center;width:5%;" >NO</th>
													<th>DATE</th>	
													<th>Purchase Party</th>
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>PUR AMT</th>
													<th>SAL AMT</th>
													<th>DIFF AMT</th>
													<th>GP RATIO</th>
												</tr>
											 </thead>
											<tbody>
											<?php
												$PURAMT=0;;
												$SALAMT=0;
												$IGSTAMT=0;
												$BROKERAMT=0;
												$SIGSTAMT=0;
												$SBROKERAMT=0;
												$idx = 1;
												while($resdata = mysqli_fetch_assoc($res))
													{
														
														$GPRATIO = getCurrFormat((($resdata["SRSAMOUNT"] - $resdata["RSAMOUNT"]) / ($resdata["RSAMOUNT"]))*100);
													
														$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
														
														//$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
														
														$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"];
														
														
														//$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
														$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]);
														$PURAMT += $pur;
														$SALAMT += $sal;
														$GPRATIO = round((($sal-$pur)/$pur)*100,2);
														?>
															<tr class="<?php echo $classname;?>">
															<td align="center"><?php echo $idx++;?></td>
																<td><?php echo $resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"]);?></td>
																<td><?php echo $resdata["LEDGERNAME"];?></td>
																<td><?php echo $resdata["BARCODENO"];?></td>
																<td><?php echo $resdata["WEIGHT"];?></td>
																<td><?php echo $resdata["COLOR"];?></td>
																<td><?php echo $resdata["CLARITY"];?></td>
																<td class="amountalign"><?php echo getCurrFormat($pur);?></td>
																<td class="amountalign"><?php echo getCurrFormat($sal);?></td>
																<td class="amountalign"><?php echo getCurrFormat($sal-$pur);?></td>
																<td class="amountalign"><?php echo $GPRATIO;?></td>
															</tr>
														<?php
													}
													
											?>    
											<tr>
															<td align="center"></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td align="right"><?php echo getCurrFormat($PURAMT);?></td>
																<td align="right"><?php echo getCurrFormat($SALAMT);?></td>
																<td align="right"><?php echo getCurrFormat($SALAMT - $PURAMT);?></td>
																<td></td>
															</tr>											
											</tbody>
										</table>
									</div>
								</div>
							
					
					<?php
		}
		break;
		case "Partner Purchase-Sale P & L":
		{
			
			$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
			$FieldArr= array();				
							
								array_push($FieldArr,"PRL.LEDGERNAME AS PARTNERNAME");
								array_push($FieldArr,"BP.PARTNERPER");
								//array_push($FieldArr,"BP.STOCKIDVALUE");
								array_push($FieldArr,"BP.COLOR");
								array_push($FieldArr,"BP.CLARITY");
								array_push($FieldArr,"BP.WEIGHT");
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"BP.BARCODENO");
								array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");
								//array_push($FieldArr,"SP.STOCKIDVALUE AS SSTOCKIDVALUE");
								array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
								/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");*/
								array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
								/*array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
								array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
								array_push($FieldArr,"round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100) AS GPRATIO");
								
							switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
								
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP LEFT JOIN ".LEDGER." AS PRL ON PRL.LEDGERID=BP.PARTNERLEDGERID LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale'   WHERE BP.FLAG='0' AND  BP.PARTNERPER > 0 AND BP.PARTNERLEDGERID !='' AND BP.PROCESSTYPE='Purchase' ".
								$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTNER.$ORDERBY_COND);
								
								
								
								$end_from = mysqli_num_rows($res);
			
			?>
				<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
											<thead>
												
												
												<tr>
													<th style="text-align:center;width:5%;" >NO</th>
													<th>DATE</th>	
													<th>PARTNER NAME</th>
													<th>PARTNER %</th>	
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>PUR AMT</th>
													<th>SAL AMT</th>
													<th>DIFF AMT</th>
													<th>AMT</th>
													<th>GP RATIO</th>
												</tr>
											 </thead>
											<tbody>
											<?php
											$PURAMT=0;;
											$SALAMT=0;
											$DIFFAMT=0;
											$DIFF_TOTAL=0;
											$IGSTAMT=0;
											$TCSAMT=0;
											$BROKERAMT=0;
											$SIGSTAMT=0;
											$STCSAMT=0;
											$SBROKERAMT=0;
											$PURAMT_ttl =0;
											$SALAMT_ttl =0;
											$UNSOLD_TOTAL=0;
											$AMT=0;
											$idx = 1;
												while($resdata = mysqli_fetch_assoc($res))
													{
														//$PURAMT += $resdata["STOCKIDVALUE"];
														//$SALAMT += $resdata["SSTOCKIDVALUE"];
														$PURAMT += $resdata["RSAMOUNT"];
														$SALAMT += $resdata["SRSAMOUNT"];
														
														$BROKERAMT += $resdata["BROKERAMT"];
														$IGSTAMT += $resdata["IGSTAMT"];
														//$TCSAMT += $resdata["TCSAMT"];
														
														$SBROKERAMT += $resdata["SBROKERAMT"];
														//$SIGSTAMT += $resdata["SIGSTAMT"];
														//$STCSAMT += $resdata["STCSAMT"];
														
														//$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
														$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"] ;
														//$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
														$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]);
														$PURAMT += $pur;
														$SALAMT += $sal;
														
														$DIFF = ($sal == 0) ? $pur : ($sal - $pur);
														$DIFF_TOTAL += ($sal == 0) ? 0 : ($sal - $pur) ;
														
														$UNSOLD_TOTAL += ($sal == 0) ? $pur : 0 ;
														
														$PURAMT_ttl += $pur;
														$SALAMT_ttl += $sal;
														$AMT = $AMT + ($pur);
														$GPRATIO = round((($sal-$pur) / $pur)*100,2);
														
														
														//$GPRATIO=0;
														$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
														?>
															<tr class="<?php echo $classname;?>">
															<td align="center"><?php echo $idx++;?></td>
																<td><?php echo $resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"]);?></td>
																
																<td><?php echo $resdata["PARTNERNAME"];?></td>
																<td><?php echo $resdata["PARTNERPER"];?></td>
																<td><?php echo $resdata["BARCODENO"];?></td>
																<td><?php echo $resdata["WEIGHT"];?></td>
																<td><?php echo $resdata["COLOR"];?></td>
																<td><?php echo $resdata["CLARITY"];?></td>
																<td class="amountalign"><?php echo getCurrFormat($pur);?></td>
															    <td class="amountalign"><?php echo getCurrFormat($sal);?></td>
																
																<?php
																if($sal == 0){
																	?>
																	<td></td>
																	<td class="amountalign"><?php echo round($DIFF);?></td>
																	<?php
																}else
																{
																	?>
																<td class="amountalign"><?php echo round($DIFF);?></td>
																<td></td>
																<?php
																}?>
																<td align="right"><?php echo $GPRATIO;?></td>
																
																
															</tr>
														<?php
													}
											?>   
															<tr>
															<td align="center"></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td align="right"><?php echo getCurrFormat($PURAMT_ttl);?></td>
																<td align="right"><?php echo getCurrFormat($SALAMT_ttl);?></td>
																<td align="right"><?php echo round($DIFF_TOTAL);?></td>
																<td align="right"><?php echo round($UNSOLD_TOTAL);?></td>
																	<td></td>
															</tr>											
											</tbody>
										</table>
									</div>
								</div>
							
					
					<?php
		}
		break;
		
		case "Purchase-Sale":
		{
			$FieldArr_Pur= array();				
								array_push($FieldArr_Pur,"BP.ENTRYID");
								array_push($FieldArr_Pur,"BP.ID");
								array_push($FieldArr_Pur,"BP.ENTRYDATE");
								array_push($FieldArr_Pur,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_Pur,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_Pur,"BP.REMARK");
								array_push($FieldArr_Pur,"BP.BARCODENO");
								array_push($FieldArr_Pur,"BP.WEIGHT");
								array_push($FieldArr_Pur,"BP.SHAPE");
								array_push($FieldArr_Pur,"BP.COLOR");
								array_push($FieldArr_Pur,"BP.CLARITY");
								array_push($FieldArr_Pur,"BP.CUT");
								array_push($FieldArr_Pur,"BP.POLISH");
								array_push($FieldArr_Pur,"BP.SYMM");
								array_push($FieldArr_Pur,"BP.FLOURANCE");
								array_push($FieldArr_Pur,"BP.GREEN");
								array_push($FieldArr_Pur,"BP.MILKY");
								array_push($FieldArr_Pur,"BP.LAB");
								array_push($FieldArr_Pur,"BP.CERTIFICATENO");
								array_push($FieldArr_Pur,"BP.RATE");
								array_push($FieldArr_Pur,"BP.DISCPER");
								array_push($FieldArr_Pur,"BP.PERCRTDOLLAR");
								array_push($FieldArr_Pur,"BP.RATEDOLLAR");
								array_push($FieldArr_Pur,"BP.CONVRATE");
								array_push($FieldArr_Pur,"BP.RSPERCRT");
								array_push($FieldArr_Pur,"BP.RSAMOUNT");
								array_push($FieldArr_Pur,"PS.VOUCHERDATE");
								
								switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
								}
								
								
								$res_pur = getData(BARCODE_PROCESS,$FieldArr_Pur," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID WHERE BP.PROCESSTYPE='Purchase' ".$VDATE.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
								
								
				$FieldArr_Sal= array();						
								
								array_push($FieldArr_Sal,"BP.ENTRYID");
								array_push($FieldArr_Sal,"BP.ID");
								array_push($FieldArr_Sal,"BP.ENTRYDATE");
								array_push($FieldArr_Sal,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_Sal,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_Sal,"BP.REMARK");
								array_push($FieldArr_Sal,"BP.BARCODENO");
								array_push($FieldArr_Sal,"BP.WEIGHT");
								array_push($FieldArr_Sal,"BP.SHAPE");
								array_push($FieldArr_Sal,"BP.COLOR");
								array_push($FieldArr_Sal,"BP.CLARITY");
								array_push($FieldArr_Sal,"BP.CUT");
								array_push($FieldArr_Sal,"BP.POLISH");
								array_push($FieldArr_Sal,"BP.SYMM");
								array_push($FieldArr_Sal,"BP.FLOURANCE");
								array_push($FieldArr_Sal,"BP.GREEN");
								array_push($FieldArr_Sal,"BP.MILKY");
								array_push($FieldArr_Sal,"BP.LAB");
								array_push($FieldArr_Sal,"BP.CERTIFICATENO");
								array_push($FieldArr_Sal,"BP.RATE");
								array_push($FieldArr_Sal,"BP.DISCPER");
								array_push($FieldArr_Sal,"BP.PERCRTDOLLAR");
								array_push($FieldArr_Sal,"BP.RATEDOLLAR");
								array_push($FieldArr_Sal,"BP.CONVRATE");
								array_push($FieldArr_Sal,"BP.RSPERCRT");
								array_push($FieldArr_Sal,"BP.RSAMOUNT");
								array_push($FieldArr_Sal,"PS.VOUCHERDATE");
								
								
								$res_sal = getData(BARCODE_PROCESS,$FieldArr_Sal," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID WHERE BP.PROCESSTYPE='Sale' ".$VDATE.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
								$maxcnt = 0;
								
								if(mysqli_num_rows($res_pur) >= mysqli_num_rows($res_sal))
								{
									$maxcnt = mysqli_num_rows($res_pur);
								}
								else
								{
									$maxcnt = mysqli_num_rows($res_sal);
								}
								
			
			?>
							
					
								
								<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
											<thead>
												<tr>
													<th style="text-align:center;">
													Sr No
													</th>
													<th colspan="21" style="text-align:center;">Purchase</th>
													<th style="text-align:center;"></th>
													<th colspan="21" style="text-align:center;">Sale</th>
												</tr>
												<tr>
													<th style="text-align:center;">
													&nbsp;
													</th>
													
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	

													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>										
													
													
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
													
													<th></th>
													
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	

													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>										
													
													
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
												</tr>
											 </thead>
											<tbody>
											
											<?php
											$purdataarr= array();
											$saldataarr= array();
											$i = 0;
											while($resdata_pur = mysqli_fetch_assoc($res_pur))
													{
														$purdataarr[$i++]= '<td>'.getDateFormat($resdata_pur["VOUCHERDATE"]).'</td>
																		<td>'.$resdata_pur["BARCODENO"].'</td>
															<td>'.$resdata_pur["PARTY"].'</td>
															<td>'.$resdata_pur["BROKER"].'</td>
															<td>'.$resdata_pur["WEIGHT"].'</td>
															<td>'.$resdata_pur["SHAPE"].'</td>
															<td>'.$resdata_pur["COLOR"].'</td>
															<td>'.$resdata_pur["CLARITY"].'</td>
															<td>'.$resdata_pur["CUT"].'</td>
															<td>'.$resdata_pur["POLISH"].'</td>
															<td>'.$resdata_pur["SYMM"].'</td>
															<td>'.$resdata_pur["FLOURANCE"].'</td>
															<td>'.$resdata_pur["CERTIFICATENO"].'</td>
															<td>'.$resdata_pur["LAB"].'</td>
															<td class="amountalign">'.getCurrFormat0($resdata_pur["RATE"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["DISCPER"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["PERCRTDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["RATEDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["CONVRATE"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["PERCRTDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["RSAMOUNT"]).'</td>
															';
												
													}
											while($i< $maxcnt)
												{
													$purdataarr[$i] ='';
													for($j=1;$j<=21;$j++)
													{
														$purdataarr[$i].='<td>&nbsp;</td>';
													}
													$i++;
													
												}
											$i = 0;
											while($resdata_sal = mysqli_fetch_assoc($res_sal))
													{
														$saldataarr[$i++]= '<td>'.getDateFormat($resdata_sal["VOUCHERDATE"]).'</td>
																		<td>'.$resdata_sal["BARCODENO"].'</td>
															<td>'.$resdata_sal["PARTY"].'</td>
															<td>'.$resdata_sal["BROKER"].'</td>
															<td>'.$resdata_sal["WEIGHT"].'</td>
															<td>'.$resdata_sal["SHAPE"].'</td>
															<td>'.$resdata_sal["COLOR"].'</td>
															<td>'.$resdata_sal["CLARITY"].'</td>
															<td>'.$resdata_sal["CUT"].'</td>
															<td>'.$resdata_sal["POLISH"].'</td>
															<td>'.$resdata_sal["SYMM"].'</td>
															<td>'.$resdata_sal["FLOURANCE"].'</td>
															<td>'.$resdata_sal["CERTIFICATENO"].'</td>
															<td>'.$resdata_sal["LAB"].'</td>
															<td class="amountalign">'.getCurrFormat0($resdata_sal["RATE"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["DISCPER"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["PERCRTDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["RATEDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["CONVRATE"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["PERCRTDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["RSAMOUNT"]).'</td>';
													}
											while($i< $maxcnt)
												{
													$saldataarr[$i] ='';
													for($j=1;$j<=21;$j++)
													{
														$saldataarr[$i].='<td>&nbsp;</td>';
													}
													$i++;
													
												}
											for($i= 0; $i< $maxcnt ;$i++)
												{
													?>
													<tr class="<?php echo $classname;?>">
														<td align="center"><?php echo $i+1;?></td>
														<?php
															echo (count($purdataarr) >= $i+1 ? $purdataarr[$i] : '').'<td align="center"></td>'.(count($saldataarr) >= $i+1 ? $saldataarr[$i] : '');
														?>
													</tr>
													<?php
												}
												
											?>                                        
											</tbody>
										</table>
									</div>
								</div>
							
				
					<?php
		}
		break;
		case "Sale With Purchase":
		{
			$FieldArr_Pur= array();				
								array_push($FieldArr_Pur,"BP.ENTRYID");
								array_push($FieldArr_Pur,"BP.ID");
								array_push($FieldArr_Pur,"BP.ENTRYDATE");
								array_push($FieldArr_Pur,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_Pur,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_Pur,"BP.REMARK");
								array_push($FieldArr_Pur,"BP.BARCODENO");
								array_push($FieldArr_Pur,"BP.WEIGHT");
								array_push($FieldArr_Pur,"BP.SHAPE");
								array_push($FieldArr_Pur,"BP.COLOR");
								array_push($FieldArr_Pur,"BP.CLARITY");
								array_push($FieldArr_Pur,"BP.CUT");
								array_push($FieldArr_Pur,"BP.POLISH");
								array_push($FieldArr_Pur,"BP.SYMM");
								array_push($FieldArr_Pur,"BP.FLOURANCE");
								array_push($FieldArr_Pur,"BP.GREEN");
								array_push($FieldArr_Pur,"BP.MILKY");
								array_push($FieldArr_Pur,"BP.LAB");
								array_push($FieldArr_Pur,"BP.CERTIFICATENO");
								array_push($FieldArr_Pur,"BP.RATE");
								array_push($FieldArr_Pur,"BP.DISCPER");
								array_push($FieldArr_Pur,"BP.PERCRTDOLLAR");
								array_push($FieldArr_Pur,"BP.RATEDOLLAR");
								array_push($FieldArr_Pur,"BP.CONVRATE");
								array_push($FieldArr_Pur,"BP.RSPERCRT");
								array_push($FieldArr_Pur,"BP.RSAMOUNT");
								array_push($FieldArr_Pur,"PS.VOUCHERDATE");
								
								switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
								}
								
								$res_pur = getData(BARCODE_PROCESS,$FieldArr_Pur," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID WHERE BP.PROCESSTYPE='Purchase' AND BP.BARCODENO IN(SELECT SBP.BARCODENO FROM ".BARCODE_PROCESS." AS SBP WHERE SBP.PROCESSTYPE IN('Sale')) ".$ORDERBY_COND);
								
								
				$FieldArr_Sal= array();						
								
								array_push($FieldArr_Sal,"BP.ENTRYID");
								array_push($FieldArr_Sal,"BP.ID");
								array_push($FieldArr_Sal,"BP.ENTRYDATE");
								array_push($FieldArr_Sal,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr_Sal,"B.LEDGERNAME AS BROKER");
								array_push($FieldArr_Sal,"BP.REMARK");
								array_push($FieldArr_Sal,"BP.BARCODENO");
								array_push($FieldArr_Sal,"BP.WEIGHT");
								array_push($FieldArr_Sal,"BP.SHAPE");
								array_push($FieldArr_Sal,"BP.COLOR");
								array_push($FieldArr_Sal,"BP.CLARITY");
								array_push($FieldArr_Sal,"BP.CUT");
								array_push($FieldArr_Sal,"BP.POLISH");
								array_push($FieldArr_Sal,"BP.SYMM");
								array_push($FieldArr_Sal,"BP.FLOURANCE");
								array_push($FieldArr_Sal,"BP.GREEN");
								array_push($FieldArr_Sal,"BP.MILKY");
								array_push($FieldArr_Sal,"BP.LAB");
								array_push($FieldArr_Sal,"BP.CERTIFICATENO");
								array_push($FieldArr_Sal,"BP.RATE");
								array_push($FieldArr_Sal,"BP.DISCPER");
								array_push($FieldArr_Sal,"BP.PERCRTDOLLAR");
								array_push($FieldArr_Sal,"BP.RATEDOLLAR");
								array_push($FieldArr_Sal,"BP.CONVRATE");
								array_push($FieldArr_Sal,"BP.RSPERCRT");
								array_push($FieldArr_Sal,"BP.RSAMOUNT");
								array_push($FieldArr_Sal,"PS.VOUCHERDATE");
								$res_sal = getData(BARCODE_PROCESS,$FieldArr_Sal," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID WHERE BP.PROCESSTYPE='Sale' ".$VDATE.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
								
								$maxcnt = 0;
								
							
								if(mysqli_num_rows($res_sal) >= mysqli_num_rows($res_pur))
								{
									
									$maxcnt = mysqli_num_rows($res_pur);
								}
								else
								{
									$maxcnt = mysqli_num_rows($res_sal);
									
								}
								
			
			?>
							
					
								
								<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
											<thead>
												<tr>
													<th style="text-align:center;">
													Sr No
													</th>
													<th colspan="21" style="text-align:center;">Sale</th>
													<th style="text-align:center;"></th>
													<th colspan="21" style="text-align:center;">Purchase</th>
												</tr>
												<tr>
													<th style="text-align:center;">
													&nbsp;
													</th>
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	
													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>		
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
													
													<th></th>
													
													<th>Date</th>	
													<th>Stock Id</th>
													<th>Party</th>
													<th>Broker</th>	
													<th>WT</th>	
													<th>Shp</th>	
													<th>Cl</th>	
													<th>Cal</th>	
													<th>Ct</th>	
													<th>PO</th>	
													<th>Sy</th>	
													<th>Flu</th>
													<th>Certi</th>										
													<th>Lb</th>		
													<th>Rate</th>
													<th>Disc %</th>
													<th>$/Crt</th>
													<th>Rate $</th>
													<th>$</th>
													<th>Rs/Crt</th>
													<th>Rs Amt</th>
													
													
													
													
												</tr>
											 </thead>
											<tbody>
											
											<?php
											$purdataarr= array();
											$saldataarr= array();
											$i = 0;
											while($resdata_sal = mysqli_fetch_assoc($res_sal))
													{
														$saldataarr[$i++]= '<td>'.getDateFormat($resdata_sal["VOUCHERDATE"]).'</td>
																		<td>'.$resdata_sal["BARCODENO"].'</td>
															<td>'.$resdata_sal["PARTY"].'</td>
															<td>'.$resdata_sal["BROKER"].'</td>
															<td>'.$resdata_sal["WEIGHT"].'</td>
															<td>'.$resdata_sal["SHAPE"].'</td>
															<td>'.$resdata_sal["COLOR"].'</td>
															<td>'.$resdata_sal["CLARITY"].'</td>
															<td>'.$resdata_sal["CUT"].'</td>
															<td>'.$resdata_sal["POLISH"].'</td>
															<td>'.$resdata_sal["SYMM"].'</td>
															<td>'.$resdata_sal["FLOURANCE"].'</td>
															<td>'.$resdata_sal["CERTIFICATENO"].'</td>
															<td>'.$resdata_sal["LAB"].'</td>
															<td class="amountalign">'.getCurrFormat0($resdata_sal["RATE"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["DISCPER"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["PERCRTDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["RATEDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["CONVRATE"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["PERCRTDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_sal["RSAMOUNT"]).'</td>';
													}
											while($i< $maxcnt)
												{
													$saldataarr[$i] ='';
													for($j=1;$j<=21;$j++)
													{
														$saldataarr[$i].='<td>&nbsp;</td>';
													}
													$i++;
													
												}
											
											
											$i = 0;
											while($resdata_pur = mysqli_fetch_assoc($res_pur))
													{
														$purdataarr[$i++]= '<td>'.getDateFormat($resdata_pur["VOUCHERDATE"]).'</td>
																		<td>'.$resdata_pur["BARCODENO"].'</td>
															<td>'.$resdata_pur["PARTY"].'</td>
															<td>'.$resdata_pur["BROKER"].'</td>
															<td>'.$resdata_pur["WEIGHT"].'</td>
															<td>'.$resdata_pur["SHAPE"].'</td>
															<td>'.$resdata_pur["COLOR"].'</td>
															<td>'.$resdata_pur["CLARITY"].'</td>
															<td>'.$resdata_pur["CUT"].'</td>
															<td>'.$resdata_pur["POLISH"].'</td>
															<td>'.$resdata_pur["SYMM"].'</td>
															<td>'.$resdata_pur["FLOURANCE"].'</td>
															<td>'.$resdata_pur["CERTIFICATENO"].'</td>
															<td>'.$resdata_pur["LAB"].'</td>
															<td class="amountalign">'.getCurrFormat0($resdata_pur["RATE"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["DISCPER"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["PERCRTDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["RATEDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["CONVRATE"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["PERCRTDOLLAR"]).'</td>
															<td class="amountalign">'.getCurrFormat($resdata_pur["RSAMOUNT"]).'</td>
															';
												
													}
											while($i< $maxcnt)
												{
													$purdataarr[$i] ='';
													for($j=1;$j<=21;$j++)
													{
														$purdataarr[$i].='<td>&nbsp;</td>';
													}
													$i++;
													
												}
											
											for($i= 0; $i< $maxcnt ;$i++)
												{
													?>
													<tr class="<?php echo $classname;?>">
														<td align="center"><?php echo $i+1;?></td>
														<?php
															//echo (count($purdataarr) >= $i+1 ? $purdataarr[$i] : '').'<td align="center"></td>'.(count($saldataarr) >= $i+1 ? $saldataarr[$i] : '');
															echo (count($saldataarr) >= $i+1 ? $saldataarr[$i] : '').'<td align="center"></td>'.(count($purdataarr) >= $i+1 ? $purdataarr[$i] : '');
														?>
													</tr>
													<?php
												}
												
											?>                                        
											</tbody>
										</table>
									</div>
								</div>
							
				
					<?php
		}
		break;
		case "Purchase Party Wise Profit":
		{
			$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
			$FieldArr= array();				
								array_push($FieldArr,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"BP.BARCODENO");
								array_push($FieldArr,"BP.WEIGHT");
								array_push($FieldArr,"BP.COLOR");
								array_push($FieldArr,"BP.CLARITY");
								array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");								
								array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
								array_push($FieldArr,"ROUND(((SP.RSAMOUNT - BP.RSAMOUNT) / BP.RSAMOUNT)*100) AS GPRATIO");
								
								array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
								/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
								array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
								array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
								array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
								
								switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									case 'GP':
										$ORDERBY_COND =' ORDER BY ROUND(((SP.RSAMOUNT - BP.RSAMOUNT) / BP.RSAMOUNT)*100)';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
								
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale' WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase'".
							$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
								
								
								
								$end_from = mysqli_num_rows($res);
			
			?>
				<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
											<thead>
												
												<tr>
													<th style="text-align:center;width:5%;" >NO</th>
													<th>DATE</th>	
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>PUR AMT</th>													
													<th>SAL AMT</th>												
													<th>DIFF AMT</th>
													<th>GP RATIO</th>
												</tr>
											 </thead>
											<tbody>
											<?php
												$WEIGHT =0;
												$PURAMT=0;
												$SALAMT=0;
												$DIFF=0;
												$idx = 1;
												while($resdata = mysqli_fetch_assoc($res))
													{
														//$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
														$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"];
														//$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
														$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]);
														$GPRATIO = round((($sal-$pur)/$pur)*100,2);
														$WEIGHT += $resdata["WEIGHT"];
														$PURAMT += $pur ; //$resdata["RSAMOUNT"];
														$SALAMT += $sal; //["SRSAMOUNT"];
														
														$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
														?>
															<tr class="<?php echo $classname;?>">
															<td align="center"><?php echo $idx++;?></td>
																<td><?php echo $resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"]);?></td>
																<td><?php echo $resdata["BARCODENO"];?></td>
																<td><?php echo $resdata["WEIGHT"];?></td>
																<td><?php echo $resdata["COLOR"];?></td>
																<td><?php echo $resdata["CLARITY"];?></td>
																
																<td class="amountalign"><?php echo getCurrFormat($pur);?></td>															
																<td class="amountalign"><?php echo getCurrFormat($sal);?></td>																
																<td class="amountalign"><?php echo getCurrFormat($sal - $pur);?></td>
																<td class="amountalign"><?php echo $GPRATIO;?></td>
															</tr>
														<?php
													}
													
											?>    
											<tr>
															<td align="center"></td>
																<td></td>
																<td></td>
																<td><?php echo $WEIGHT;?></td>
																<td></td>
																<td></td>
																<td align="right"><?php echo getCurrFormat($PURAMT);?></td>																
																<td align="right"><?php echo getCurrFormat($SALAMT);?></td>																
																<td align="right"><?php echo getCurrFormat($SALAMT - $PURAMT);?></td>
																<td></td>
															</tr>											
											</tbody>
										</table>
									</div>
								</div>
							
					<?php
		}
		break;
		case "Sale Party Wise Profit":
		{
			
			$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
			$FieldArr= array();				
							
			array_push($FieldArr,"L.LEDGERNAME AS PARTY");
			array_push($FieldArr,"BP.RSAMOUNT");
			array_push($FieldArr,"BP.BARCODENO");
			array_push($FieldArr,"BP.WEIGHT");
			array_push($FieldArr,"BP.COLOR");
			array_push($FieldArr,"BP.CLARITY");
			array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");								
			array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
			array_push($FieldArr,"ROUND(((BP.RSAMOUNT - SP.RSAMOUNT) / SP.RSAMOUNT)*100) AS GPRATIO");
				
			array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS BROKERAMT");
			array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS IGSTAMT");
			array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS SBROKERAMT");
			/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");

			array_push($FieldArr,"((SP.RSAMOUNT * SP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
			array_push($FieldArr,"((SP.RSAMOUNT * SP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
			
			
			array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS SIGSTAMT");
			array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/

			switch($ORDERBY)
			{
				case 'Date':
					$ORDERBY_COND =' ORDER BY SP.VDATE';
				break;
				case 'GP':
					$ORDERBY_COND =' ORDER BY ROUND(((BP.RSAMOUNT - SP.RSAMOUNT) / SP.RSAMOUNT)*100)';
				break;
				default:
					$ORDERBY_COND =' ORDER BY SP.VDATE';
				break;
			}
								
			$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Purchase' WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Sale'".
			$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
			$end_from = mysqli_num_rows($res);
			
			?>
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
						<thead>
							<tr>
								<th style="text-align:center;width:5%;" >NO</th>
								<th>DATE</th>	
								<th>STOCK ID</th>
								<th>WEIGHT</th>
								<th>COLOR</th>
								<th>CLARITY</th>
								<th>SAL AMT</th>
								<th>PUR AMT</th>
								<th>DIFF AMT</th>
								<th>GP RATIO</th>
							</tr>
						 </thead>
						<tbody>
						<?php
							$PURAMT=0;
							$WEIGHT=0;
							$SALAMT=0;
							$GPRATIO=0;
							$idx = 1;
							while($resdata = mysqli_fetch_assoc($res))
							{
								/*$pur = $resdata["SRSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
								$sal = ($resdata["RSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];*/
								
								$pur = $resdata["SRSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"];
								$sal = ($resdata["RSAMOUNT"] - $resdata["SBROKERAMT"]);
								
								$GPRATIO = round((($sal-$pur)/$pur)*100,2);
								
								$WEIGHT += $resdata["WEIGHT"];
								$PURAMT += $pur;
								$SALAMT += $sal;
								
								$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
								?>
									<tr class="<?php echo $classname;?>">
									<td align="center"><?php echo $idx++;?></td>
									<td><?php echo $resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"]);?></td>
									<td><?php echo $resdata["BARCODENO"];?></td>
									<td><?php echo $resdata["WEIGHT"];?></td>
									<td><?php echo $resdata["COLOR"];?></td>
									<td><?php echo $resdata["CLARITY"];?></td>
									<td class="amountalign"><?php echo getCurrFormat($sal);?></td>																
									<td class="amountalign"><?php echo getCurrFormat($pur);?></td>																
									<td class="amountalign"><?php echo getCurrFormat($sal - $pur);?></td>
									<td class="amountalign"><?php echo $GPRATIO;?></td>
									</tr>
									<?php
							}
								
						?>    
						<tr>
							<td align="center"></td>
								<td></td>
								<td></td>
								<td><?php echo $WEIGHT;?></td>															
								<td></td>
								<td></td>
								<td align="right"><?php echo getCurrFormat($SALAMT);?></td>																
								<td align="right"><?php echo getCurrFormat($PURAMT);?></td>																
								<td align="right"><?php echo getCurrFormat($SALAMT - $PURAMT);?></td>
								<td></td>
						</tr>											
						</tbody>
					</table>
				</div>
			</div>
			<?php
		}
		break;
		case "Stock Comparison":
		{
			
			$FieldArr= array();		
			$FieldArr[0]="BP.*";
			$FieldArr[1]="(BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT))) AS CURRWGT";
			$res = getData(BARCODE_PROCESS,$FieldArr," AS BP LEFT JOIN ". BARCODE_PROCESS ." AS SP ON BP.BARCODENO=SP.BARCODENO 
			AND SP.PROCESSTYPE='Sale' WHERE BP.PROCESSTYPE IN ('Purchase','Memo Issue','Memo Receive','Repair Issue','Repair Receive','Grading Issue','Grading Result','Grading Receive') and BP.ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO)" .$BARCODENO.$WEIGHT.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE."  GROUP BY BP.BARCODENO HAVING BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT)) > 0 ORDER BY CAST(SUBSTR(BP.BARCODENO,3) AS UNSIGNED)");
			$end_from = mysqli_num_rows($res);
			?>
			<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
											<thead>
												<tr>
													<th style="text-align:center;width:5%;" >NO</th>
													
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>CUT</th>
													<th>POLISH</th>
													<th>SYMM</th>
													<th>FLOURANCE</th>
													<th colspan="3" style="text-align:center;">DISCOUNT</th>
													<th colspan="3" style="text-align:center;">AMOUNT</th>
												</tr>
												<tr>
													<th colspan="9">&nbsp;</th>
													<th>PUR DISC</th>
													<th>DISC 2</th>
													<th>MKT DISC</th>
													<th>PUR Amt</th>
													<th>CURR Amt</th>
													<th>DIFF</th>
													
												</tr>
											</thead>
											<tbody>
											<?php
											$ttlwgt=0;
											$ttldollar = 0;
											$ttlcurr_rsamount=0;
												$idx = 1;
												while($resdata = mysqli_fetch_assoc($res))
													{
														//$RAPRATE = getRapPrice($resdata["SHAPE"],$resdata["COLOR"],$resdata["CLARITY"],$resdata["WEIGHT"]);
														if($resdata["COLOR"] == '')
														{
															$RAPRATE =$resdata["CURRRAP"];
														}
														else
														{
															$RAPRATE = getRapPrice($resdata["SHAPE"],$resdata["COLOR"],$resdata["CLARITY"],$resdata["WEIGHT"]);
														}
													 
														$curr_rsamount = ($RAPRATE * $resdata["WEIGHT"]) ;
														if($resdata["RAPDISCOUNT"] >0)
														{
															$curr_rsamount = $curr_rsamount * (1 - $resdata["RAPDISCOUNT"]/ 100);
														}
														
														$ttlwgt +=$resdata["WEIGHT"];
														$ttldollar += $resdata["TOTALDOLLAR"];
														$ttlcurr_rsamount+=$curr_rsamount;
														$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
														?>
															<tr class="<?php echo $classname;?>">
																<td align="center"><?php echo $idx++;?></td>
																<td><?php echo $resdata["BARCODENO"];?></td>
																<td class="amountalign"><?php echo sprintf("%.2f",$resdata["WEIGHT"]);?></td>
																<td><?php echo $resdata["COLOR"];?></td>
																<td><?php echo $resdata["CLARITY"];?></td>
																<td><?php echo $resdata["CUT"];?></td>
																<td><?php echo $resdata["POLISH"];?></td>
																<td><?php echo $resdata["SYMM"];?></td>
																<td><?php echo $resdata["FLOURANCE"];?></td>
																<!--<td class="amountalign"><?php echo sprintf("%.2f",$resdata["DISCPER"]);?></td>
																<td class="amountalign"><?php echo sprintf("%.2f",$resdata["DISC2PER"]);?></td>
																<td class="amountalign"><?php echo sprintf("%.2f",$resdata["RAPDISCOUNT"]);?></td>
																<td class="amountalign"><?php echo sprintf("%.2f",$resdata["TOTALDOLLAR"]);?></td>-->
																<td class="amountalign"><?php echo sprintf("%.3f",$resdata["DISCPER"]);?></td>
																<td class="amountalign"><?php echo sprintf("%.3f",$resdata["DISC2PER"]);?></td>
																<td class="amountalign"><?php echo sprintf("%.3f",$resdata["RAPDISCOUNT"]);?></td>
																<td class="amountalign"><?php echo sprintf("%.3f",$resdata["TOTALDOLLAR"]);?></td>
																<td class="amountalign"><?php echo sprintf("%.2f",$curr_rsamount);?></td>
																<td class="amountalign"><?php echo sprintf("%.2f",($curr_rsamount-$resdata["TOTALDOLLAR"]));?></td>
															</tr>
														<?php
													}
													
											?>    
											<tr>
												<td></td>
												<td></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttlwgt);?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttldollar);?></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttlcurr_rsamount);?></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttlcurr_rsamount-$ttldollar);?></td>
											</tr>										
											</tbody>
											
												
										</table>
									</div>
								</div>
			<?php
		}
		break;
		case "Unsold Partnership Stock":
		{
			$FieldArr= array();	
			array_push($FieldArr,"PS.VOUCHERDATE");
			array_push($FieldArr,"L.LEDGERNAME AS PARTY");
			array_push($FieldArr,"BARCODENO");
			array_push($FieldArr,"WEIGHT");
			array_push($FieldArr,"COLOR");
			array_push($FieldArr,"CLARITY");
			array_push($FieldArr,"BP.RSAMOUNT");
			array_push($FieldArr,"PRL.LEDGERNAME AS PARTNERNAME");
			switch($ORDERBY)
			{
				case 'Date':
					$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
				break;
				default:
					$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
				break;
			}
					
			$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID 
			AND PS.VOUCHERTYPE=BP.PROCESSTYPE AND PS.PARTNERPER > 0 INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID 
			LEFT JOIN ".LEDGER." AS PRL ON PRL.LEDGERID=BP.PARTNERLEDGERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' 
			AND BP.BARCODENO NOT IN(SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE FLAG='0'  AND PROCESSTYPE='Sale') AND BP.PARTNERPER > 0 "
			.$PARTNER.$VDATE.$BARCODENO.$COLOR.$CLARITY.$WEIGHT.$PARTY.$ORDERBY_COND);
				
				?>
				
							
							
							<div class="panel-body">
							
								<div class="dataTable_wrapper">
								
									<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
										<thead>
											<tr>
												<th style="text-align:center;width:5%;" >
												Sr No
												</th>
												<th>Date</th>
												<th>Party</th>												
												<th>Stock Id</th>
												<th>Partner Name</th>														
												<th>WT</th>	
												<th>Cl</th>	
												<th>Cal</th>
												<th>Rs Amt</th>
												
											</tr>
										</thead>
										<tbody>
							<?php
								$idx = 1;
								$rstotal=0;
								while($resdata = mysqli_fetch_assoc($res))
									{
										$rstotal += $resdata["RSAMOUNT"];
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											
											<td align="center"><?php echo $idx++;?></td>
												<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
												<td><?php echo $resdata["PARTY"];?></td>
												<td><?php echo $resdata["BARCODENO"];?></td>
												<td><?php echo $resdata["PARTNERNAME"];?></td>
												<td><?php echo $resdata["WEIGHT"];?></td>
												<td><?php echo $resdata["COLOR"];?></td>
												<td><?php echo $resdata["CLARITY"];?></td>
												<td class="amountalign"><?php echo getCurrFormat($resdata["RSAMOUNT"]) ;?></td>
												
																							
										
												
											</tr>
										<?php
									}
							?>       
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><b>Total</b></td>
								<td class="amountalign"><?php echo getCurrFormat($rstotal) ;?></td>																	
							</tr>
							</tbody>
						</table>
					</div>
					</div>
					
					
				<?php
		}
		break;
		case "Premium Size Current Stock":
		{
		$rptcolspan='8';
		?>
		<div class="panel-body">
			<div class="dataTable_wrapper">
				<table class="table table-striped table-bordered table-hover customResponsiveTable" id="examplereport">
					<thead>
							<tr>
								<th style="text-align:center;width:5%;" >Sr No</th>
								<th>Stock Id</th>
								<th>Shp</th>	
								<th>Carat</th>									
								<th>Col</th>
								<th>Cla</th>								
								<th>Total $</th>
								<th>Total Rs</th>
							</tr>
					</thead>
					<tbody>
							<?php
							$ttlstone=0;
							$ttlwgt =0;
							$ttldollar=0;
							$ttlrs =0;
								$sizeRes = getData(SIZE_MST,$AllArr," ORDER BY FROMSIZE");
								while($sizeResData = mysqli_fetch_assoc($sizeRes))
								{
									$res = getData(BARCODE_PROCESS,$AllArr," AS BP where PROCESSTYPE='Purchase' 
									and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') 
									AND WEIGHT BETWEEN '".$sizeResData["FROMSIZE"]."' AND '".$sizeResData["TOSIZE"]."' ".$COLOR.$CLARITY.$BARCODENO);
									
									?>
									<tr style="background-color:gray;color:#fff;text-align:center;font-size:1.1em;">
										<td class="sizecls"><?php echo $sizeResData["FROMSIZE"]."-".$sizeResData["TOSIZE"]?></td>
										
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
									</tr>
									<?php
									if(mysqli_num_rows($res) > 0)
									{
										$idx = 1;
										while($resdata = mysqli_fetch_assoc($res))
										{
											$ttlstone+=1;
											$ttlwgt+=$resdata["WEIGHT"];
											$ttldollar+=$resdata["TOTALDOLLAR"];
											$ttlrs+=$resdata["RSAMOUNT"];
																		
											$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
											?>
											<tr class="<?php echo $classname;?>">
												
												<td align="center"><?php echo $idx++;?></td>
												<td><?php echo $resdata["BARCODENO"];?></td>
												<td><?php echo $resdata["SHAPE"];?></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$resdata["WEIGHT"]);?></td>
												<td><?php echo $resdata["COLOR"];?></td>
												<td><?php echo $resdata["CLARITY"];?></td>
												<td class="amountalign"><?php echo $resdata["TOTALDOLLAR"];?></td>
												<td class="amountalign"><?php echo $resdata["RSAMOUNT"];?></td>
											</tr>
											<?php
										}
									}
									else{
										?>
										<tr>
												
												<td align="center" class="nocls">No Data</td>
												<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
											</tr>
										<?php
									}
									
								}
			
								
							?>      
									<tr>
												
												<td align="center"><?php echo $ttlstone;?><td>
												<td></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttlwgt);?></td>
												<td></td>
												<td></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttldollar);?></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttlrs);?></td>
											</tr>
							</tbody>
						</table>
					</div>
					</div>
					
					
				<?php
		}
		break;
		case "Premium Size Purchase-Sale P & L":
		{
			$rptcolspan='12';
		?>
		<div class="panel-body">
			<div class="dataTable_wrapper">
				<table class="table table-striped table-bordered table-hover customResponsiveTable" id="examplereport">
					<thead>
							<tr>
								<th style="text-align:center;width:5%;" >Sr No</th>
								<th>DATE</th>	
								<th>Purchase Party</th>
								<th>STOCK ID</th>
								<th>WEIGHT</th>
								<th>COLOR</th>
								<th>CLARITY</th>
								<th>PUR AMT</th>
								<th>SAL AMT</th>
								<th>DIFF AMT</th>
								<th>GP RATIO</th>
								<th>DAY DIFF</th>
													
							</tr>
					</thead>
					<tbody>
					<?php
						$PURAMT_SIZE=0;
						$SALAMT_SIZE=0;
						$WGTSUM_SIZE=0;
						$sizeRes = getData(SIZE_MST,$AllArr," ORDER BY FROMSIZE");
						while($sizeResData = mysqli_fetch_assoc($sizeRes))
							{
							//=========================
							$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
							$FieldArr= array();				
							array_push($FieldArr,"BP.LEDGERID");
							array_push($FieldArr,"L.LEDGERNAME");
							array_push($FieldArr,"BP.RSAMOUNT");
							array_push($FieldArr,"BP.BARCODENO");
							array_push($FieldArr,"BP.COLOR");
							array_push($FieldArr,"BP.CLARITY");
							array_push($FieldArr,"BP.WEIGHT");
							array_push($FieldArr,"IF(BP.VDATE IS NULL,'',BP.VDATE) AS PDATE ");
							array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");
							array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
							array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
							array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
							/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");

							array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
							array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
							
							array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
							array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
							array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
							array_push($FieldArr,"round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100) as GPRATIO");
							switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									case 'GP':
										$ORDERBY_COND =' ORDER BY round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100)';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
							$res = getData(BARCODE_PROCESS,$FieldArr," AS BP LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale' LEFT JOIN ".LEDGER." AS L ON L.LEDGERID = BP.LEDGERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' AND BP.WEIGHT BETWEEN '".$sizeResData["FROMSIZE"]."' AND '".$sizeResData["TOSIZE"]."' ".
							$VDATE.$SHAPE.$BARCODENO.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$ORDERBY_COND);
								
									
									?>
									<tr style="background-color:gray;color:#fff;text-align:center;font-size:1.1em;">
										<td class="sizecls"><?php echo $sizeResData["FROMSIZE"]."-".$sizeResData["TOSIZE"]?></td>
										
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										
									</tr>
									<?php
									if(mysqli_num_rows($res) > 0)
									{
										$PURAMT=0;
										$SALAMT=0;
										$WGTSUM=0;
										$idx = 1;
										while($resdata = mysqli_fetch_assoc($res))
										{
											if($resdata["VDATE"] != '' )
											{
												$date1=date_create($resdata["PDATE"]);
												$date2=date_create($resdata["VDATE"]);
												$diff=date_diff($date1,$date2);
												$diffdisp=$diff->format("%R%a days");
											}
											else{
												$diffdisp = '';
											}
											
											
											$GPRATIO = getCurrFormat((($resdata["SRSAMOUNT"] - $resdata["RSAMOUNT"]) / ($resdata["RSAMOUNT"]))*100);
													
											$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
														
											//$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"] + $resdata["TCSAMT"] + $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
											$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"];
											//$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
											$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]);
											$PURAMT += $pur;
											$SALAMT += $sal;
											$WGTSUM += $resdata["WEIGHT"];
											
											$PURAMT_SIZE += $pur;
											$SALAMT_SIZE += $sal;
											$WGTSUM_SIZE += $resdata["WEIGHT"];
														
											$GPRATIO= round((($sal-$pur)/$pur)*100,2);
											?>
											<tr class="<?php echo $classname;?>">
															<td align="center"><?php echo $idx++;?></td>
																<td><?php echo $resdata["VDATE"] != '' ? getDateFormat($resdata["VDATE"]) : '';?></td>
																<td><?php echo $resdata["LEDGERNAME"];?></td>
																<td><?php echo $resdata["BARCODENO"];?></td>
																<td><?php echo $resdata["WEIGHT"];?></td>
																<td><?php echo $resdata["COLOR"];?></td>
																<td><?php echo $resdata["CLARITY"];?></td>
																<td class="amountalign"><?php echo getCurrFormat($pur);?></td>
																<td class="amountalign"><?php echo getCurrFormat($sal);?></td>
																<td class="amountalign"><?php echo getCurrFormat($sal-$pur);?></td>
																<td class="amountalign"><?php echo $GPRATIO;?></td>
															<td><?php echo $diffdisp;?></td>
															</tr>
											<?php
										}
										?>
										<tr class="<?php echo $classname;?>">
										<td align="center"></td>
										<td></td>
																<td></td>
																<td></td>
																<td><?php echo $WGTSUM;?></td>
																<td></td>
																<td></td>
																<td class="amountalign"><?php echo getCurrFormat($PURAMT);?></td>
																<td class="amountalign"><?php echo getCurrFormat($SALAMT);?></td>
																<td class="amountalign"><?php echo getCurrFormat($SALAMT-$PURAMT);?></td>
																<td class="amountalign"></td>
																<td></td>
															</tr>
										<?PHP
									}
									else{
										?>
										<tr>
												
												<td align="center" class="nocls">No Data</td>
												<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
											</tr>
										<?php
									}
									
								}
			
								
							?>      
								<tr class="<?php echo $classname;?>">
										<td align="center"></td>
										<td></td>
																<td></td>
																<td></td>
																<td><?php echo $WGTSUM_SIZE;?></td>
																<td></td>
																<td></td>
																<td class="amountalign"><?php echo getCurrFormat($PURAMT_SIZE);?></td>
																<td class="amountalign"><?php echo getCurrFormat($SALAMT_SIZE);?></td>
																<td class="amountalign"><?php echo getCurrFormat($SALAMT_SIZE-$PURAMT_SIZE);?></td>
																<td class="amountalign"></td>
																<td class="amountalign"></td>
															</tr>	
							</tbody>
						</table>
					</div>
					</div>
					
					
				<?php
		}
		break;
		case "Party Wise Current Stock":
		{
			?>
			
			
			<div class="panel-body">
			<div class="dataTable_wrapper">
				<table class="table table-striped table-bordered table-hover customResponsiveTable" id="examplereport">
					<thead>
							<tr>
								<th style="text-align:center;width:5%;" >Sr No</th>
								<th>Stock Id</th>
								<th>Shp</th>	
								<th>Carat</th>									
								<th>Col</th>
								<th>Cla</th>								
								<th>Total $</th>
							</tr>
					</thead>
					<tbody>
							<?php
							$ttlstone=0;
							$ttlwgt =0;
							$ttldollar=0;
							$FieldArr= array();	
							array_push($FieldArr,"BP.LEDGERID");
							array_push($FieldArr,"L.LEDGERNAME");
							array_push($FieldArr,"COUNT(BP.BARCODENO) AS TOTAL");
							$resParty = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID 
							where BP.PROCESSTYPE='Purchase' and BP.BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') "
							.$VDATE.$SHAPE.$COLOR.$CLARITY.$WEIGHT.$BARCODENO.$PARTY." GROUP BY BP.LEDGERID");
							while($resPartyData = mysqli_fetch_assoc($resParty))
								{
									$res = getData(BARCODE_PROCESS,$AllArr," AS BP where BP.PROCESSTYPE='Purchase' 
									and BP.BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') AND BP.LEDGERID='".$resPartyData["LEDGERID"]."' ".$WEIGHT.$COLOR.$CLARITY.$BARCODENO.$SHAPE);
									
									?>
									<tr class="PARTYHEAD" rel="<?php echo $resPartyData["LEDGERID"]?>" style="background-color:gray;color:#fff;text-align:center;font-size:1.1em;">
										<td class="sizecls"><?php echo $resPartyData["LEDGERNAME"]."-".$resPartyData["TOTAL"]?></td>
										
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
										<td class="sizecls1"></td>
									</tr>
									<?php
									if(mysqli_num_rows($res) > 0)
									{
										$ttlstone_party=0;
										$ttlwgt_party =0;
										$ttldollar_party=0;
										$idx = 1;
										while($resdata = mysqli_fetch_assoc($res))
										{
											$ttlstone+=1;
											$ttlwgt+=$resdata["WEIGHT"];
											$ttldollar+=$resdata["TOTALDOLLAR"];
											
											$ttlstone_party+=1;
											$ttlwgt_party+=$resdata["WEIGHT"];
											$ttldollar_party+=$resdata["TOTALDOLLAR"];
																		
											$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
											?>
											<tr class="<?php echo $classname;?> PARTYLIST PARTYLIST<?PHP echo $resPartyData["LEDGERID"]?>">
												
												<td align="center"><?php echo $idx++;?></td>
												<td><?php echo $resdata["BARCODENO"];?></td>
												<td><?php echo $resdata["SHAPE"];?></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$resdata["WEIGHT"]);?></td>
												<td><?php echo $resdata["COLOR"];?></td>
												<td><?php echo $resdata["CLARITY"];?></td>
												<td class="amountalign"><?php echo $resdata["TOTALDOLLAR"];?></td>
											</tr>
											<?php
										}
										?>
											<tr class="<?php echo $classname;?> PARTYLIST PARTYLIST<?PHP echo $resPartyData["LEDGERID"]?>">
												
												<td align="center"><?php echo $ttlstone_party;?></td>
												<td></td>
												<td></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttlwgt_party);?></td>
												<td></td>
												<td></td>
												<td class="amountalign"><?php echo $ttldollar_party;?></td>
											</tr>
										<?php
									}
									else{
										?>
										<tr>
												
												<td align="center" class="nocls">No Data</td>
												<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
										<td class="nocls1"></td>
											</tr>
										<?php
									}
									
								}
			
								
							?>      
									<tr>
												
												<td align="center"><?php echo $ttlstone;?><td>
												<td></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttlwgt);?></td>
												<td></td>
												<td></td>
												<td class="amountalign"><?php echo sprintf("%.2f",$ttldollar);?></td>
											</tr>
							</tbody>
						</table>
					</div>
					</div>			
		
				<?php
		}
		break;
		
		case "Broker Purchase-Sale P & L":
		{
			
			$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
			$FieldArr= array();				
							
								array_push($FieldArr,"B.LEDGERNAME AS BROKERNAME");
								array_push($FieldArr,"L.LEDGERNAME AS PARTY");
								array_push($FieldArr,"BP.COLOR");
								array_push($FieldArr,"BP.CLARITY");
								array_push($FieldArr,"BP.WEIGHT");
								array_push($FieldArr,"BP.RSAMOUNT");
								array_push($FieldArr,"BP.BARCODENO");
								array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");
								
								array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
								/*array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
								array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
								
								array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
								array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");*/
								array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
				
							switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY SP.VDATE';
									break;
								}
								
								$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE AND PS.BROKERID!='' AND PS.VOUCHERTYPE='Purchase'  
								INNER JOIN ".LEDGER." AS B ON B.LEDGERID=PS.BROKERID LEFT JOIN ".LEDGER." AS L ON L.LEDGERID=PS.LEDGERID LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale'   WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' ".
								$BROKER.$VDATE.$BARCODENO.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$ORDERBY_COND);
								
							
								
								$end_from = mysqli_num_rows($res);
			
			?>
				<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
											<thead>
												
												
												<tr>
													<th style="text-align:center;width:5%;" >NO</th>
													<th>DATE</th>	
													<th>BROKER NAME</th>
													<th>PARTY NAME</th>	
													<th>STOCK ID</th>
													<th>WEIGHT</th>
													<th>COLOR</th>
													<th>CLARITY</th>
													<th>PUR AMT</th>
													<th>SAL AMT</th>
													<th>DIFF AMT</th>
													
												
												</tr>
											 </thead>
											<tbody>
											<?php
											$PURAMT=0;;
											$SALAMT=0;
											$DIFFAMT=0;
											$WGTSUM =0;
											$IGSTAMT=0;
											$BROKERAMT=0;
											$SIGSTAMT=0;
											$SBROKERAMT=0;
											$AMT=0;
											$idx = 1;
												while($resdata = mysqli_fetch_assoc($res))
													{
														//$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"] + /*$resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"]; * */
														//$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"])  /* + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];*/
														$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"] ;$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]);
														
														$PURAMT += $pur;
														$SALAMT += $sal;
														$WGTSUM += $resdata["WEIGHT"];
														$AMT = $AMT + ($sal-$pur);
														
														//$GPRATIO=0;
														$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
														?>
															<tr class="<?php echo $classname;?>">
															<td align="center"><?php echo $idx++;?></td>
																<td><?php echo $resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"]);?></td>
																
																<td><?php echo $resdata["BROKERNAME"];?></td>
																<td><?php echo $resdata["PARTY"];?></td>
																<td><?php echo $resdata["BARCODENO"];?></td>
																<td><?php echo $resdata["WEIGHT"];?></td>
																<td><?php echo $resdata["COLOR"];?></td>
																<td><?php echo $resdata["CLARITY"];?></td>
																<td class="amountalign"><?php echo getCurrFormat($pur);?></td>
																<td class="amountalign"><?php echo getCurrFormat($sal);?></td>
																<td class="amountalign"><?php echo getCurrFormat($sal-$pur);?></td>
																
															</tr>
														<?php
													}
											?>   
<tr>
															<td align="center"></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td align="right"><?php echo getCurrFormat($PURAMT);?></td>
																<td align="right"><?php echo getCurrFormat($SALAMT);?></td>
																<td align="right"><?php echo getCurrFormat($AMT);?></td>
																	<td></td>
															</tr>											
											</tbody>
										</table>
									</div>
								</div>
							
					
					<?php
		}
		break;
		case "Deal Purchase Status":
		{
			
			?>
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover customResponsiveTable" id="examplereport">
						<thead>
								<tr>
									<th style="text-align:center;width:5%;">Sr No</th>
									<th>Status</th>							
									<th>Days</th>							
									<th>Stock Id</th>
									<th>Shp</th>	
									<th>Carat</th>									
									<th>Col</th>
									<th>Cla</th>								
									<th>Pur</th>
									<th>Sal</th>
									<th>GP RATIO</th>
									<th>Diff</th>
									<th>Unsold</th>
								</tr>
						</thead>
						<tbody>
								<?php
								$ttlstone=0;
								$ttlwgt =0;
								$ttldollar=0;
								$PURAMT_ttl = 0;
								$SALAMT_ttl = 0;
								$FINALTOTALDIFF = 0;
								$FINALTOTALUNSOLD = 0;
								$AMT =0;
								$FieldArr= array();	
								array_push($FieldArr,"BP.LEDGERID");
								array_push($FieldArr,"L.LEDGERNAME");
								
								
								array_push($FieldArr,"COUNT(BP.BARCODENO) AS TOTAL");
								
								$resParty = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID 
								where BP.PROCESSTYPE='Purchase' ".$VDATE.$COLOR.$CLARITY.$WEIGHT.$BARCODENO.$PARTY." GROUP BY BP.LEDGERID");
								while($resPartyData = mysqli_fetch_assoc($resParty))
									{
										$temparr = array();
										$temparr[0]='BP.*';
										$temparr[1]='SP.RSAMOUNT AS SRSAMOUNT';
										$temparr[2]='((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT';
										$temparr[3]='((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT';
										$temparr[4]='((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT';
										$temparr[5]='((BP.RSAMOUNT * BP.IGSTPER)/100)  AS IGSTAMT';
										
										$temparr[6]='SP.PROCESSTYPE AS SPROCESS';
										$temparr[7]='DATEDIFF(SP.VDATE,BP.VDATE) AS SALEDATE';
										$temparr[8]='round(((SP.RSAMOUNT - BP.RSAMOUNT)  / BP.RSAMOUNT)*100,2) as GPRATIO';
										/*$temparr[9]='((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100)  AS THIRDPARTYCHARGES';
										$temparr[10]='((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT';
										$temparr[11]='((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT';
										$temparr[12]='((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100)  AS THIRDPARTYTCS';*/
										
										$VDATE = (isset($PostArrayReport["dtpFROMDATE"]) && !empty($PostArrayReport["dtpFROMDATE"])) && (isset($PostArrayReport["dtpENDDATE"]) && !empty($PostArrayReport["dtpENDDATE"])) ? " AND BP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
										
										$res = getData(BARCODE_PROCESS,$temparr," AS BP LEFT JOIN ". BARCODE_PROCESS ." AS SP ON SP.BARCODENO=BP.BARCODENO 
										AND SP.PROCESSTYPE in ('Sale') WHERE BP.PROCESSTYPE in ('Purchase') AND BP.LEDGERID='".$resPartyData["LEDGERID"]."' ".$BARCODENO.$VDATE." ");
										
										?>
										<tr class="PARTYHEAD" rel="<?php echo $resPartyData["LEDGERID"]?>" style="background-color:gray;color:#fff;text-align:center;font-size:1.1em;">
											<td class="sizecls"><?php echo $resPartyData["LEDGERNAME"]."-".$resPartyData["TOTAL"]?></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
										
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
											<td class="sizecls1"></td>
										</tr>
										<?php
 										if(mysqli_num_rows($res) > 0)
										{
											$PURAMT = 0 ;
											$SALAMT = 0 ;
											$DIFF=0;
											$DIFF_TOTAL = 0;
											$UNSOLD_TOTAL = 0;
											$ttlstone_party=0;
											$ttlwgt_party =0;
											$ttldollar_party=0;
											
											$idx = 1;
											while($resdata = mysqli_fetch_assoc($res))
											{
												$ttlstone+=1;
												$ttlwgt+=$resdata["WEIGHT"];
												$ttldollar+=$resdata["TOTALDOLLAR"];
												$ttlstone_party+=1;
												$ttlwgt_party+=$resdata["WEIGHT"];
												$ttldollar_party+=$resdata["TOTALDOLLAR"];
												$SPROCESS = $resdata["SPROCESS"];	
												$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
												//$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"];
												$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"];
												//$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
												$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]);
												$PURAMT += $pur;
												$SALAMT += $sal;
												
												$DIFF = ($sal == 0) ? $pur : ($sal - $pur);
												$DIFF_TOTAL += ($sal == 0) ? 0 : ($sal - $pur) ;
												
												$UNSOLD_TOTAL += ($sal == 0) ? $pur : 0 ;
												
												$PURAMT_ttl += $pur;
												$SALAMT_ttl += $sal;
												$AMT = $AMT + ($pur);
												$GPRATIO = round((($sal - $pur)  / $pur)*100,2);
												?>
												<tr class="<?php echo $classname;?> PARTYLIST PARTYLIST<?PHP echo $resPartyData["LEDGERID"]?>">
													
													<td align="center"><?php echo $idx++;?></td>
													<td align="center"><?php echo $SPROCESS;?></td>
													<td align="center"><?php echo $resdata["SALEDATE"];?></td>
													<td><?php echo $resdata["BARCODENO"];?></td>
													<td><?php echo $resdata["SHAPE"];?></td>
													<td class="amountalign"><?php echo sprintf("%.2f",$resdata["WEIGHT"]);?></td>
													<td><?php echo $resdata["COLOR"];?></td>
													<td><?php echo $resdata["CLARITY"];?></td>
													<td class="amountalign"><?php echo round($pur);?></td>
													<td class="amountalign"><?php echo round($sal);?></td>
													<td align="right"><?php echo $GPRATIO;?></td>
													<?php
													if($sal == 0){
														?>
														<td></td>
														<td class="amountalign"><?php echo round($DIFF);?></td>
														<?php
													}else{
														?>
													<td class="amountalign"><?php echo round($DIFF);?></td>
													<td></td>
													<?php
													}
													?>
												</tr>
												<?php
											}
											?>
												<tr class="<?php echo $classname;?> PARTYLIST PARTYLIST<?PHP echo $resPartyData["LEDGERID"]?>">
													<td></td>
													
													<td></td>
													<td></td>
													<td align="center"><?php echo $ttlstone_party;?></td>
													<td></td>
													<td class="amountalign"><?php echo sprintf("%.2f",$ttlwgt_party);?></td>
													<td></td>
													<td></td>
													<td class="amountalign"><?php echo round($PURAMT);?></td>
													<td class="amountalign"><?php echo round($SALAMT);?></td>
													<td></td>
													<?php
													if($SALAMT == 0){
														?>
														<td></td>
														<td class="amountalign"><?php echo round($PURAMT);?></td>
														<?php
													}else{
														?>
														<td class="amountalign"><?php echo round($DIFF_TOTAL);?></td>
														<td class="amountalign"><?php echo round($UNSOLD_TOTAL);?></td>
													<?php
													}
													?>
													
												</tr>
											<?php
											
										}
										else{
											?>
											<tr>
													<td align="center" class="nocls">No Data</td>
													<td class="nocls1"></td>					
													<td class="nocls1"></td>					
													<td class="nocls1"></td>
													<td class="nocls1"></td>
													<td class="nocls1"></td>
													<td class="nocls1"></td>
													<td class="nocls1"></td>
													<td class="nocls1"></td>
													<td class="nocls1"></td>
													<td class="nocls1"></td>
													<td class="nocls1"></td>
												</tr>
											<?php
										}
										$FINALTOTALDIFF +=  $DIFF_TOTAL ;
										$FINALTOTALUNSOLD +=  $UNSOLD_TOTAL ;
									}
				
									
								?>      
									<tr>
												<td></td>
												<td></td>
												<td></td>
												<td align="center"><?php echo $ttlstone;?><td>
												
												<td class="amountalign"><?php echo sprintf("%.2f",$ttlwgt);?></td>
												<td></td>
												<td></td>
												<td class="amountalign"><?php echo round($PURAMT_ttl);?></td>
												<td class="amountalign"><?php echo round($SALAMT_ttl);?></td>
												<td></td>
												<?php
													if($SALAMT_ttl == 0){
														?>
														<td></td>
														<td class="amountalign"><?php echo round($PURAMT_ttl);?></td>
														<?php
													}else{
													
														?>
													<td class="amountalign"><?php echo round($FINALTOTALDIFF);?></td>
													<td class="amountalign"><?php echo round($FINALTOTALUNSOLD);?></td>
													
													<?php
													}
													?>
												
											</tr>
						</tbody>
					</table>
				</div>
			</div>	
	<?php					
		}
		break;
		default:
		{
			?>
			<script>
				alert("Select Any One Report");
			</script>
			<?php
		}
		break;
	}
	?>
	</div>
</form>
</div>
</div>
	<?php
}
?>

