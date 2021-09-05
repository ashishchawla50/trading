<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");
include("init/script/words.php");
require_once(INIT.'script/tcpdf/tcpdf.php');



		class MYPDF extends TCPDF {
		
		
		
			
		public function Header() {
			
		}
						
			// Page footer
		public function Footer() {
						
					
				// Position at 15 mm from bottom
				$this->SetY(-15);
				// Set font
				$this->SetFont('helvetica', 'I', 8);
				// Page number
				//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
				
		}
		}
		// create new PDF document
		$pdf = new MYPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set margins
		$pdf->SetMargins(10, 10, 10,10);

		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE,1);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set font
		
		$pdf->SetFont('times', 9);

		// add a page
		//$pdf->AddPage();
		$pdf->AddPage('P','A4');


		if(isset($_GET["saleinvoice"]))
		{	
						$html_design='<table width="100%">
							<tr> 
								
								<td style="text-align:center;font-weight:bold;font-size:25pt;"><img src="'.SITEURL.INIT.'images/logo.jpg" width="70" height="40"/>'.strtoupper(getFieldDetail(COMPANY,"COMPANYNAME","")).'</td>
							</tr>
							<tr>
									<td  style="font-family:times;text-align:center;font-weight:bold;font-size:9pt;">DIAMONDS MANUFACTURER - IMPORTER - EXPORTER -TRADERS</td>
							</tr>
								
								<tr>
									<td style="font-family:times;text-align:center;font-weight:bold;font-size:9pt;">OFFICE:'.getFieldDetail(COMPANY,"ADDRESS","").". ".getFieldDetail(COMPANY,"PINCODE","").'</td>
								</tr>
								
							</table>
							<table width="100%" style="font-size:12px;">
								<tr height="2%"><td></td></tr>
						</table>
						<div width="100%"  style="font-size:10pt;border:1pt solid black ">
						
							<table width="100%"  cellpadding="2">  
							<tr>
							<td colspan="4" style="text-align:center;font-size:10pt;font-family:times;">Invoice Issued u/g 31 of CGST act 2017 read with rules 46of CGST RULES 2017</td> 
							</tr>
							<tr>
								  <td colspan="3" style="text-align:center;font-size:13pt;font-family:times;" color="black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TAX  INVOICE</b></td>
								  <td style="text-align:center;font-size:10pt;font-family:times;width:20%" bgcolor="DarkGray" color="black"><b>BUYER COPY</b></td>
							</tr>
							<tr> 
								<td width="15%" style="text-align:right;font-size:10pt;font-family:times;font-weight:bold;">Sold To:</td> 
								<td width="45%" style="text-align:left;font-size:10pt;font-family:times;">'.getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</td> 
								<td  width="20%" style="text-align:right;font-size:10pt;font-family:times;">Invoice No. :</td> 
								<td  width="20%" style="text-align:left;font-size:10pt;font-family:times;font-weight:bold;">'.getFieldDetail(PURCHASESALE,"INVOICECHAR"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'").'</td> 
								
							</tr> 
							<tr> 
								<td width="15%" style="text-align:right;font-size:10pt;font-family:times;font-weight:bold;">State Code:</td> 
								<td width="45%" style="text-align:left;font-size:10pt;font-family:times;">'.getFieldDetail(LEDGER,"STATE"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'/'.getFieldDetail(LEDGER,"STATECODE"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</td> 
								<td  width="20%" style="text-align:right;font-size:10pt;font-family:times;">Date :</td> 
								<td  width="20%" style="text-align:left;font-size:10pt;font-family:times;font-weight:bold;">'.getFieldDetail(PURCHASESALE,"VOUCHERDATE"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'").'</td> 
								
							</tr> 
							<tr> 
								<td width="15%" style="text-align:right;font-size:10pt;font-family:times;font-weight:bold;">Address :</td> 
								<td width="45%" style="text-align:left;font-size:10pt;font-family:times;">'.getFieldDetail(LEDGER,"ADDRESS"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')") .".".getFieldDetail(LEDGER,"PINCODE"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</td> 
								<td  width="20%" style="text-align:right;font-size:10pt;font-family:times;">Mode/Terms of Payment:</td> 
								<td  width="20%" style="text-align:left;font-size:10pt;font-family:times;font-weight:bold;">'.getFieldDetail(COMPANY,"TERMSOFPAYMENT","").'</td> 								
							</tr> 
							<tr> 
								<td width="15%" ></td> 
								<td width="45%" ></td> 
								<td  width="20%" style="text-align:right;font-size:10pt;font-family:times;">Terms of Delivery:</td> 
								<td  width="20%" style="text-align:left;font-size:10pt;font-family:times;font-weight:bold;">'.getFieldDetail(COMPANY,"TERMSOFDELIVERY","").'</td> 								
							</tr> 
							
						</table>
						<table border="1" width="100%" style="font-family:times;" cellpadding="2">
						
						<tr>
							<td width="100%" style="text-align:left;" color="black">We had sold the following goods and debited your account with the amount mentioned below:</td>
								
						</tr>
							<tr>
								<td width="10%" style="text-align:center;"color="black"><b>Sr. No.</b></td>
								<td width="25%" style="text-align:center;" color="black"><b>Description of Goods</b></td>
								<td width="20%" style="text-align:center;" color="black"><b>HSN Code</b></td>
								<td width="15%" style="text-align:center;" color="black"><b>Weight in Carats</b></td>
								<td width="15%" style="text-align:center;" color="black"><b>Rate Per Carat</b></td>
								<td width="15%" style="text-align:center;" color="black"><b>Taxable Amount(in inr)</b></td>
							</tr>';
							
							$ressaleissue = getData(PURCHASESALE,$AllArr," WHERE ID = '".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale' ");
							$idx = 1;
							$sumwgt =0;
							$sumamount =0;
							$sumtotaldollar =0;
							$sumtotal=0;
							$cntrow=0;
							
							$cgstper=getFieldDetail(PURCHASESALE,"CGSTPER"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$sgstper=getFieldDetail(PURCHASESALE,"SGSTPER"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$igstper=getFieldDetail(PURCHASESALE,"IGSTPER"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							
							$cgstamt=getFieldDetail(PURCHASESALE,"CGSTAMT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$sgstamt=getFieldDetail(PURCHASESALE,"SGSTAMT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$igstamt=getFieldDetail(PURCHASESALE,"IGSTAMT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							
							$LASTAMOUNT=getFieldDetail(PURCHASESALE,"LASTAMOUNT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$GRANDAMOUNT=getFieldDetail(PURCHASESALE,"GRANDAMOUNT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$sumwgt=getFieldDetail(BARCODE_PROCESS,"SUM(WEIGHT)"," WHERE ID ='".$_GET["saleinvoice"]."' AND PROCESSTYPE='Sale'");
							//exit();
							while($ressaledata = mysqli_fetch_assoc($ressaleissue))
							{
								
								//$sumwgt +=$ressaledata["TOTALWEIGHT"];
								
								$sumtotal +=$ressaledata["TOTALRSAMOUNT"];
								
								
								$html_design.='
										<tr>
											<td width="10%" style="text-align:center;">'.$idx++.'</td>
											<td width="25%" style="text-align:center;">Cut & Polished Diamonds</td>
											<td width="20%" style="text-align:center;">'.getFieldDetail(COMPANY,"HSNCODE","").'</td>
											<td width="15%" style="border:1px solid #000;text-align:center;">'.$sumwgt.'</td>
											<td width="15%" style="border:1px solid #000;text-align:center;">'.number_format($ressaledata["TOTALRSRSPERCRT"],2).'</td>													
											<td width="15%" style="border:1px solid #000;text-align:center;">'.number_format($ressaledata["TOTALRSAMOUNT"],2).'</td>
											
										</tr>
										';
										$cntrow++;
							}
							$amountobj = new toWords($LASTAMOUNT);							
									for($i=$cntrow;$i<=7;$i++)
										{
											$html_design.='
													<tr>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															
															
															
														</tr>
														';
										}				
									$html_design.='
										<tr>
											<td colspan="5" align="right"><b>Sub Total</b></td>
											
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($sumtotal,2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">ADD(+): CGST @ '.$cgstper.'%</td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($cgstamt,2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">ADD(+): SGST @ '.$sgstper.'%</td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($sgstamt,2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">ADD(+): IGST @ '.$igstper.'%</td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($igstamt,2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">( + - )ROUND OFF. </td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format(($LASTAMOUNT - $GRANDAMOUNT),2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">Grand Total :</td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($LASTAMOUNT,2).'</b></td>
										</tr>
										
										
					</table>
					<table width="100%" cellpadding="2"> 
						<tr>
											<td  width="15%" align="right"><b>Rs.(in words):</b></td>
											<td  width="70%" style="font-size:10pt;" align="center"><b>'.strtoupper($amountobj->words).'</b></td>
											<td width="15%" align="center"><b>E. & O. E.</b></td>
										
						</tr>
							<tr>
								<td width="15%" align="right">Terms of payment</td>
								<td width="85%" align="left"> 1) Payment should be made by way of electronic mode only(Our bankers details are mentioned below)  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> A/c. No. '.getFieldDetail(COMPANY,"BANKACNO","").'  IFSC Code: '.getFieldDetail(COMPANY,"IFSCCODE","") .'</b>
								<br> 2) If any Liability of Sales Tax/VAT arises in future for this transaction you (the buyer) are liable to pay the amount of such taxes to us.
								</td>
							</tr>
							<tr>
								<td width="15%" align="right">GSTIN:</td>
								<td width="35%" align="left"><b>'.getFieldDetail(COMPANY,"GSTNO","").'</b></td>
								<td width="15%" align="right">STATE CODE:</td>
								<td width="35%" align="left"><b>'.getFieldDetail(COMPANY,"STATECODE","").'/'.getFieldDetail(COMPANY,"STATE","").'</b></td>
							</tr>
							<tr>
								<td width="15%" align="right">IEC :</td>
								<td width="85%" align="left"><b>5217504161</b></td>
								
							</tr>
							<tr>
								<td width="15%" align="right">PAN :</td>
								<td width="85%" align="left"><b>'.getFieldDetail(COMPANY,"PANNO","").'</b></td>
								
							</tr>
					</table>
				
						<table width="100%" border="0"> 
							<tr>
								<td width="1%"></td>
								<td width="70%" style="font-size:7pt; border:1px solid black;text-align: justify;">Declaration: 
									<br>“Diamonds herein invoiced have been purchased from legitimate sources & not involved in funding conflict and in compliance with
									United Nations resolutions. The seller hereby Guarantees that diamonds are conflict free based on personal knowledge and/or written
									guarantees provided by the supplier of these diamonds. And Diamonds invoiced are “Natural, Untreated and not Lab Grown
									(CVD/HPHT) Diamonds”. The Diamonds herein invoiced are axclusively of natural origin and untreated based on personal knowledge
									and/or written guarantees provided by the supplier of these diamonds. The Acceptance of goods herein invoiced will be as per WFDB
									guideline. To the best of knoledge and/or written assurance from our suppliers, we state that diamond herein invoiced have not been
									obtained in violation of applicable national laws and/or section by US departments of Treasuries office of foreign assets control
									(OFAC).  </td>
								<td width="29%" align="center" style="font-size:10pt;"> 
								<b><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOR,&nbsp;&nbsp;'.getFieldDetail(COMPANY,"COMPANYNAME","") .',</i></b>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								
								<b>
								Partner or Authorized Signatory</b>
								</td>
							</tr>
							
					</table>
					
					<table width="100%" border="0" style="font-size:10pt;" cellpadding="2"> 
							<tr>
								<td width="30%" align="left">
								<b>FOR,</b>
								<br>
								<br>
								<br>
								<br>
								<b>
							    (seal & Signatur of the receiver)</b>
								</td>
								<td width="70%" style="text-align: justify;">I, the undersigned (Signatur of the receiver), do hereby confirm the terms & condition as mentioned above. I have checked quality and purity of goods and taken the delivery of the goods. Goods sold and delivered at
Mumbai.
								<br>
								
								<br>
								<b>GSTIN.: '.getFieldDetail(LEDGER,"GSTTINNO"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</b>
								<br>
								<b>P.A.N.: '.getFieldDetail(LEDGER,"PANNO"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</b>
								</td>
							</tr>
							
					</table>
					
					</div>
					<table align="center" style="font-size:10pt;"><tr><td>This is a Computer Generated Invoice.</td></tr></table>
					';
			
				/* SELLER COPY*/
			$html_designseller='<table width="100%">
							<tr> 
								
								<td style="text-align:center;font-weight:bold;font-size:25pt;"><img src="'.SITEURL.INIT.'images/logo.jpg" width="70" height="40"/>'.strtoupper(getFieldDetail(COMPANY,"COMPANYNAME","")).'</td>
							</tr>
							<tr>
									<td  style="font-family:times;text-align:center;font-weight:bold;font-size:9pt;">DIAMONDS MANUFACTURER - IMPORTER - EXPORTER -TRADERS</td>
							</tr>
								
								<tr>
									<td style="font-family:times;text-align:center;font-weight:bold;font-size:9pt;">OFFICE:'.getFieldDetail(COMPANY,"ADDRESS","").". ".getFieldDetail(COMPANY,"PINCODE","").'</td>
								</tr>
								
							</table>
							<table width="100%" style="font-size:12px;">
								<tr height="2%"><td></td></tr>
						</table>
						<div width="100%"  style="font-size:10pt;border:1pt solid black ">
						
							<table width="100%"  cellpadding="2">  
							<tr>
							<td colspan="4" style="text-align:center;font-size:10pt;font-family:times;">Invoice Issued u/g 31 of CGST act 2017 read with rules 46of CGST RULES 2017</td> 
							</tr>
							<tr>
								  <td colspan="3" style="text-align:center;font-size:13pt;font-family:times;" color="black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TAX  INVOICE</b></td>
								  <td style="text-align:center;font-size:10pt;font-family:times;width:20%" bgcolor="DarkGray" color="black"><b>SELLER COPY</b></td>
							</tr>
							<tr> 
								<td width="15%" style="text-align:right;font-size:10pt;font-family:times;font-weight:bold;">Sold To:</td> 
								<td width="45%" style="text-align:left;font-size:10pt;font-family:times;">'.getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</td> 
								<td  width="20%" style="text-align:right;font-size:10pt;font-family:times;">Invoice No. :</td> 
								<td  width="20%" style="text-align:left;font-size:10pt;font-family:times;font-weight:bold;">'.getFieldDetail(PURCHASESALE,"INVOICECHAR"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'").'</td> 
								
							</tr> 
							<tr> 
								<td width="15%" style="text-align:right;font-size:10pt;font-family:times;font-weight:bold;">State Code:</td> 
								<td width="45%" style="text-align:left;font-size:10pt;font-family:times;">'.getFieldDetail(LEDGER,"STATE"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'/'.getFieldDetail(LEDGER,"STATECODE"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</td> 
								<td  width="20%" style="text-align:right;font-size:10pt;font-family:times;">Date :</td> 
								<td  width="20%" style="text-align:left;font-size:10pt;font-family:times;font-weight:bold;">'.getFieldDetail(PURCHASESALE,"VOUCHERDATE"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'").'</td> 
								
							</tr> 
							<tr> 
								<td width="15%" style="text-align:right;font-size:10pt;font-family:times;font-weight:bold;">Address :</td> 
								<td width="45%" style="text-align:left;font-size:10pt;font-family:times;">'.getFieldDetail(LEDGER,"ADDRESS"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')") .".".getFieldDetail(LEDGER,"PINCODE"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</td> 
								<td  width="20%" style="text-align:right;font-size:10pt;font-family:times;">Mode/Terms of Payment:</td> 
								<td  width="20%" style="text-align:left;font-size:10pt;font-family:times;font-weight:bold;">'.getFieldDetail(COMPANY,"TERMSOFPAYMENT","").'</td> 								
							</tr> 
							<tr> 
								<td width="15%" ></td> 
								<td width="45%" ></td> 
								<td  width="20%" style="text-align:right;font-size:10pt;font-family:times;">Terms of Delivery:</td> 
								<td  width="20%" style="text-align:left;font-size:10pt;font-family:times;font-weight:bold;">'.getFieldDetail(COMPANY,"TERMSOFDELIVERY","").'</td> 								
							</tr> 
							
						</table>
						<table border="1" width="100%" style="font-family:times;" cellpadding="2">
						
						<tr>
							<td width="100%" style="text-align:left;" color="black">We had sold the following goods and debited your account with the amount mentioned below:</td>
								
						</tr>
							<tr>
								<td width="10%" style="text-align:center;"color="black"><b>Sr. No.</b></td>
								<td width="25%" style="text-align:center;" color="black"><b>Description of Goods</b></td>
								<td width="20%" style="text-align:center;" color="black"><b>HSN Code</b></td>
								<td width="15%" style="text-align:center;" color="black"><b>Weight in Carats</b></td>
								<td width="15%" style="text-align:center;" color="black"><b>Rate Per Carat</b></td>
								<td width="15%" style="text-align:center;" color="black"><b>Taxable Amount(in inr)</b></td>
							</tr>';
							
							$ressaleissue = getData(PURCHASESALE,$AllArr," WHERE ID = '".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale' ");
							$idx = 1;
							$sumwgt =0;
							$sumamount =0;
							$sumtotaldollar =0;
							$sumtotal=0;
							$cntrow=0;
							
							$cgstper=getFieldDetail(PURCHASESALE,"CGSTPER"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$sgstper=getFieldDetail(PURCHASESALE,"SGSTPER"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$igstper=getFieldDetail(PURCHASESALE,"IGSTPER"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							
							$cgstamt=getFieldDetail(PURCHASESALE,"CGSTAMT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$sgstamt=getFieldDetail(PURCHASESALE,"SGSTAMT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$igstamt=getFieldDetail(PURCHASESALE,"IGSTAMT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							
							$LASTAMOUNT=getFieldDetail(PURCHASESALE,"LASTAMOUNT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$GRANDAMOUNT=getFieldDetail(PURCHASESALE,"GRANDAMOUNT"," WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale'");
							$sumwgt=getFieldDetail(BARCODE_PROCESS,"SUM(WEIGHT)"," WHERE ID ='".$_GET["saleinvoice"]."' AND PROCESSTYPE='Sale'");
							//exit();
							while($ressaledata = mysqli_fetch_assoc($ressaleissue))
							{
								
								//$sumwgt +=$ressaledata["TOTALWEIGHT"];
								
								$sumtotal +=$ressaledata["TOTALRSAMOUNT"];
								
								
								$html_designseller.='
										<tr>
											<td width="10%" style="text-align:center;">'.$idx++.'</td>
											<td width="25%" style="text-align:center;">Cut & Polished Diamonds</td>
											<td width="20%" style="text-align:center;">'.getFieldDetail(COMPANY,"HSNCODE","").'</td>
											<td width="15%" style="border:1px solid #000;text-align:center;">'.$sumwgt.'</td>
											<td width="15%" style="border:1px solid #000;text-align:center;">'.number_format($ressaledata["TOTALRSRSPERCRT"],2).'</td>													
											<td width="15%" style="border:1px solid #000;text-align:center;">'.number_format($ressaledata["TOTALRSAMOUNT"],2).'</td>
											
										</tr>
										';
										$cntrow++;
							}
							$amountobj = new toWords($LASTAMOUNT);							
									for($i=$cntrow;$i<=7;$i++)
										{
											$html_designseller.='
													<tr>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															
															
															
														</tr>
														';
										}				
									$html_designseller.='
										<tr>
											<td colspan="5" align="right"><b>Sub Total</b></td>
											
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($sumtotal,2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">ADD(+): CGST @ '.$cgstper.'%</td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($cgstamt,2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">ADD(+): SGST @ '.$sgstper.'%</td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($sgstamt,2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">ADD(+): IGST @ '.$igstper.'%</td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($igstamt,2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">( + - )ROUND OFF. </td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format(($LASTAMOUNT - $GRANDAMOUNT),2).'</b></td>
										</tr>
										<tr>
											<td colspan="5" align="right">Grand Total :</td>
											
											<td style="border:1px solid #000;text-align:right;"><b>'.number_format($LASTAMOUNT,2).'</b></td>
										</tr>
										
										
					</table>
					<table width="100%" cellpadding="2"> 
						<tr>
											<td  width="15%" align="right"><b>Rs.(in words):</b></td>
											<td  width="70%" style="font-size:10pt;" align="center"><b>'.strtoupper($amountobj->words).'</b></td>
											<td width="15%" align="center"><b>E. & O. E.</b></td>
										
						</tr>
							<tr>
								<td width="15%" align="right">Terms of payment</td>
								<td width="85%" align="left"> 1) Payment should be made by way of electronic mode only(Our bankers details are mentioned below)  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> A/c. No. '.getFieldDetail(COMPANY,"BANKACNO","").'  IFSC Code: '.getFieldDetail(COMPANY,"IFSCCODE","") .'</b>
								<br> 2) If any Liability of Sales Tax/VAT arises in future for this transaction you (the buyer) are liable to pay the amount of such taxes to us.
								</td>
							</tr>
							<tr>
								<td width="15%" align="right">GSTIN:</td>
								<td width="35%" align="left"><b>'.getFieldDetail(COMPANY,"GSTNO","").'</b></td>
								<td width="15%" align="right">STATE CODE:</td>
								<td width="35%" align="left"><b>'.getFieldDetail(COMPANY,"STATECODE","").'/'.getFieldDetail(COMPANY,"STATE","").'</b></td>
							</tr>
							<tr>
								<td width="15%" align="right">IEC :</td>
								<td width="85%" align="left"><b>5217504161</b></td>
								
							</tr>
							<tr>
								<td width="15%" align="right">PAN :</td>
								<td width="85%" align="left"><b>'.getFieldDetail(COMPANY,"PANNO","").'</b></td>
								
							</tr>
					</table>
				
						<table width="100%" border="0"> 
							<tr>
								<td width="1%"></td>
								<td width="70%" style="font-size:7pt; border:1px solid black;text-align: justify;">Declaration: 
									<br>“Diamonds herein invoiced have been purchased from legitimate sources & not involved in funding conflict and in compliance with
									United Nations resolutions. The seller hereby Guarantees that diamonds are conflict free based on personal knowledge and/or written
									guarantees provided by the supplier of these diamonds. And Diamonds invoiced are “Natural, Untreated and not Lab Grown
									(CVD/HPHT) Diamonds”. The Diamonds herein invoiced are axclusively of natural origin and untreated based on personal knowledge
									and/or written guarantees provided by the supplier of these diamonds. The Acceptance of goods herein invoiced will be as per WFDB
									guideline. To the best of knoledge and/or written assurance from our suppliers, we state that diamond herein invoiced have not been
									obtained in violation of applicable national laws and/or section by US departments of Treasuries office of foreign assets control
									(OFAC).  </td>
								<td width="29%" align="center" style="font-size:10pt;"> 
								<b><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOR,&nbsp;&nbsp;'.getFieldDetail(COMPANY,"COMPANYNAME","") .',</i></b>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								
								<b>
								Partner or Authorized Signatory</b>
								</td>
							</tr>
							
					</table>
					
					<table width="100%" border="0" style="font-size:10pt;" cellpadding="2"> 
							<tr>
								<td width="30%" align="left">
								<b>FOR,</b>
								<br>
								<br>
								<br>
								<br>
								<b>
							    (seal & Signatur of the receiver)</b>
								</td>
								<td width="70%" style="text-align: justify;">I, the undersigned (Signatur of the receiver), do hereby confirm the terms & condition as mentioned above. I have checked quality and purity of goods and taken the delivery of the goods. Goods sold and delivered at
                               Mumbai.
								<br>
								
								<br>
								<b>GSTIN.: '.getFieldDetail(LEDGER,"GSTTINNO"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</b>
								<br>
								<b>P.A.N.: '.getFieldDetail(LEDGER,"PANNO"," WHERE LEDGERID IN(SELECT LEDGERID FROM ".PURCHASESALE." WHERE ID ='".$_GET["saleinvoice"]."' AND VOUCHERTYPE='Sale')").'</b>
								</td>
							</tr>
							
					</table>
					
					</div>
					<table align="center" style="font-size:10pt;"><tr><td>This is a Computer Generated Invoice.</td></tr></table>
					';
			
				
			
					$html = '
				<table>
				<tr>
					<td>'.$html_design.'</td>
					
				</tr>
				</table>
				<br>
				<br>
				<br>
				<table>
				<tr>
					<td>'.$html_designseller.'</td>
					
				</tr>
				</table>
				';
				
			
			$pdf->writeHTML($html, true, false, false, false, '');
			$FLNAME= date('Ymdhis').".pdf";
			$pdf->Output("upload/saleinvoice/".$FLNAME, 'F');
			
			?>
			<script>
				window.location.href='<?php echo "upload/saleinvoice/".$FLNAME;?>';
			</script>
		
		
			
		
			<?php
		}
		
		
		
?>
