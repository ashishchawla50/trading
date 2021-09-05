<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");
require_once(INIT.'script/tcpdf/tcpdf.php');

		class MYPDF extends TCPDF {
		
		
		
			//Page header
		public function Header() {
		}
						
			// Page footer
		public function Footer() {
						
						
				// Position at 15 mm from bottom
				//$this->SetY(-15);
				// Set font
				//$this->SetFont('helvetica', 'I', 8);
				// Page number
				//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
				}
		}
		// create new PDF document
		$pdf = new MYPDF("L", "cm", PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		// set default header data
	//	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set margins
		$pdf->SetMargins(0.3, 0.3, 0.3, false);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	//	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set font
		$pdf->SetFont('times', 7);

		$style = array(
			'position' => 'C',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => 'C',
			'border' => false,
			'hpadding' => '0',
			'vpadding' => '0',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255),
			'text' => true,
			'font' => 'helvetica',
			'fontsize' => 9,
			'stretchtext' => 5
		);

		if(isset($_POST["barcodeprint"]))
		{
			
			$bararr = $_POST["SELECT"];
			if(count($bararr)>0)
			{
				foreach($bararr as $temp)
				{
					// add a page
					$resolution= array(7, 3);
					$pdf->AddPage('', $resolution);
					//$pdf->setPage(1);
					$resBar = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO='".$temp."'");
					$resBarData = mysqli_fetch_assoc($resBar);
					$pdf->write1DBarcode($resBarData["BARCODENO"], 'C128A', '', '', '',2, 0.04, $style, 'N');
					$pdf->AddPage('', $resolution);
					//$pdf->setPage(2);
					$html='	<table width="100%">
							<tr>
								<td align="left" style="font-size:0.7em;">'.$resBarData["BARCODENO"].'</td>
								<td align="right" style="font-size:0.7em;">'.$resBarData["COLOR"].'/'.$resBarData["CLARITY"].'</td>
							</tr>
							<tr>
								<td height="30px" align="left" style="font-size:0.7em;">'.$resBarData["LAB"].' '.$resBarData["CERTIFICATENO"].'</td>
								<td></td>
							</tr>
							
							<tr>
								<td align="left">
									<table width="100%">
										<tr>
											<td style="font-size:0.7em;"><b>TD:</b>'.$resBarData["DEPTHPER"].'%</td>
											<td style="font-size:0.7em;"><b>TA:</b>'.$resBarData["TABLEPER"].'%</td>
										</tr>
										<tr>
											<td colspan="2" style="font-size:0.7em;">'.$resBarData["MESU1"].' x '.$resBarData["MESU2"].' x '.$resBarData["MESU3"].'</td>
										</td>
									</table>
								</td>
								<td></td>
							</tr>

							<tr>
								<td align="left" style="font-size:0.7em;" width="75%">'.$resBarData["CUT"].'/'.$resBarData["POLISH"].'/'.$resBarData["SYMM"].'-'.$resBarData["FLOURANCE"].'</td>
								<td align="right" style="font-size:0.9em;font-weight:bold;" width="25%">'. number_format((float)$resBarData["WEIGHT"], 2, '.', '').'</td>
							</tr>
						</table>';
					$pdf->writeHTML($html, true, false, true, false, '');
				}
			}
			
			$pdf->Output("upload/barcode/barcode_list".date('Ymdhis').".pdf", 'F');
			?>
			<script>
				window.location.href='<?php echo "upload/barcode/barcode_list".date('Ymdhis').".pdf";?>';
			</script>
			
			<?php
		}
		else
		{
			
		
		// add a page
		$resolution= array(7, 3);
		$pdf->AddPage('', $resolution);
		$pdf->setPage(1);


		$resBar = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO='".$_GET["bar"]."'");
		$resBarData = mysqli_fetch_assoc($resBar);
		$pdf->write1DBarcode($resBarData["BARCODENO"], 'C128A', '', '', '',2, 0.04, $style, 'N');
		$pdf->AddPage('', $resolution);
		$pdf->setPage(2);
		$html='	<table width="100%">
					<tr>
						<td align="left" style="font-size:0.9em;font-weight:bold;">'.$resBarData["BARCODENO"].'</td>
						<td align="right" style="font-size:0.9em;font-weight:bold;">'.$resBarData["COLOR"].'/'.$resBarData["CLARITY"].'</td>
					</tr>
					<tr>
						<td  height="30px" align="left" style="font-size:0.7em;">'.$resBarData["LAB"].' '.$resBarData["CERTIFICATENO"].'</td>
						<td></td>
					</tr>
					<tr>
						<td align="left">
							<table width="100%">
								<tr>
									<td style="font-size:0.7em;">TD:'.$resBarData["DEPTHPER"].'%</td>
									<td style="font-size:0.7em;">TA:'.$resBarData["TABLEPER"].'%</td>
								</tr>
								<tr>
									<td colspan="2" style="font-size:0.7em;">'.$resBarData["MESU1"].' x '.$resBarData["MESU2"].' x '.$resBarData["MESU3"].'</td>
								</td>
							</table>
						</td>
						<td></td>
					</tr>

					<tr >
						<td align="left" style="font-size:0.7em;" width="75%">'.$resBarData["CUT"].'/'.$resBarData["POLISH"].'/'.$resBarData["SYMM"].'-'.$resBarData["FLOURANCE"].'</td>
						<td align="right" style="font-size:0.9em;font-weight:bold;" width="25%">'.number_format((float)$resBarData["WEIGHT"], 2, '.', '').'</td>
					</tr>
				</table>';
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output("upload/barcode/".$resBarData["BARCODENO"].".pdf", 'F');
		?>
		<script>
			window.location.href='<?php echo "upload/barcode/".$resBarData["BARCODENO"].".pdf";?>';
		</script>
		
		<?php
		}
		
?>
