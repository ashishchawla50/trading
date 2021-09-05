<?php
	session_start();
	include("init/script/constant.php");
	include(INIT."script/db.php");
	include(INIT."script/function.php");
	require_once("Classes/PHPExcel.php");
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("rstar.co.in")
               ->setLastModifiedBy("rstar.co.in")
               ->setTitle("Rstar")
               ->setSubject("")
               ->setDescription("")
               ->setKeywords("")
               ->setCategory("");
	$style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

   // $objPHPExcel->getDefaultStyle()->applyFromArray($style);
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(12);
	$icol = "A";
	$prefix_char='A';
	$dtfrm = $_POST["REPORTLIST_FROMDATE"];
	$dtto = $_POST["REPORTLIST_TODATE"];
	$VDATE = $_POST["REPORTLIST_VDATE"];
	$SHAPE = $_POST["REPORTLIST_SHAPE"];
	$COLOR = $_POST["REPORTLIST_COLOR"];
	$CLARITY = $_POST["REPORTLIST_CLARITY"];
	$CUT = $_POST["REPORTLIST_CUT"];
	$POLISH = $_POST["REPORTLIST_POLISH"];
	$SYMM = $_POST["REPORTLIST_SYMM"];
	$FLOURANCE = $_POST["REPORTLIST_FLOURANCE"];
	$WEIGHT = $_POST["REPORTLIST_WEIGHT"];
	$PARTY = $_POST["REPORTLIST_PARTY"];
	$DUEDATE = $_POST["REPORTLIST_DUEDATE"];
	$ORDERBY = $_POST["REPORTLIST_ORDERBY"];
	$MONTH = $_POST["REPORTLIST_MONTH"];
	$YEAR = $_POST["REPORTLIST_YEAR"];
	$VOUCHERDATE = $_POST["REPORTLIST_VOUCHERDATE"];
    $BARCODENO = $_POST["REPORTLIST_BARCODENO"];
	$PARTNER = $_POST["REPORTLIST_PARTNER"];
	$BROKER = $_POST["REPORTLIST_BROKER"];
	
	if(isset($_POST["REPORTLIST"]))
	{
		switch($_POST["REPORTLIST"])
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
					
					$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' ".$VDATE.$BARCODENO.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
					$headerarr = array();
					array_push($headerarr,"Sr No");
					array_push($headerarr,"Date");
					array_push($headerarr,"Stock Id");
					array_push($headerarr,"Party");
					array_push($headerarr,"Broker");
					array_push($headerarr,"WT");
					array_push($headerarr,"Shp");
					array_push($headerarr,"Cl");
					array_push($headerarr,"Cal");
					array_push($headerarr,"Ct");
					array_push($headerarr,"PO");
					array_push($headerarr,"Sy");
					array_push($headerarr,"Flu");
					array_push($headerarr,"Certi");
					array_push($headerarr,"Lb");
					array_push($headerarr,"Rate");
					array_push($headerarr,"Disc");
					array_push($headerarr,"$/Crt");
					array_push($headerarr,"Rate $");
					array_push($headerarr,"$");
					array_push($headerarr,"Rs/Crt");
					array_push($headerarr,"Rs Amt");
					foreach($headerarr as $tempheader)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
						$icol =(chr(ord($icol)+1));
					}
					
					$idx = 1;
					$ROWIDX=2;
					while($resdata = mysqli_fetch_assoc($res))
						{
							$icol="A";
							
							$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["VOUCHERDATE"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTY"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BROKER"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SHAPE"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CUT"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["POLISH"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SYMM"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["FLOURANCE"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CERTIFICATENO"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["LAB"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RATE"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["DISCPER"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PERCRTDOLLAR"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RATEDOLLAR"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CONVRATE"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RSPERCRT"]);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RSAMOUNT"]);
							$ROWIDX++;
						}
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
					
				$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Sale' " .$VDATE.$BARCODENO.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
				
				$headerarr = array();
				array_push($headerarr,"Sr No");
				array_push($headerarr,"Date");
				array_push($headerarr,"Stock Id");
				array_push($headerarr,"Party");
				array_push($headerarr,"Broker");
				array_push($headerarr,"WT");
				array_push($headerarr,"Shp");
				array_push($headerarr,"Cl");
				array_push($headerarr,"Cal");
				array_push($headerarr,"Ct");
				array_push($headerarr,"PO");
				array_push($headerarr,"Sy");
				array_push($headerarr,"Flu");
				array_push($headerarr,"Certi");
				array_push($headerarr,"Lb");
				array_push($headerarr,"Rate");
				array_push($headerarr,"Disc");
				array_push($headerarr,"$/Crt");
				array_push($headerarr,"Rate $");
				array_push($headerarr,"$");
				array_push($headerarr,"Rs/Crt");
				array_push($headerarr,"Rs Amt");
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
					$icol =(chr(ord($icol)+1));
				}
					
				$idx = 1;
				$ROWIDX=2;
				while($resdata = mysqli_fetch_assoc($res))
				{
					$icol="A";
					$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["VOUCHERDATE"]));
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTY"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BROKER"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SHAPE"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CUT"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["POLISH"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SYMM"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["FLOURANCE"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CERTIFICATENO"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["LAB"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RATE"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["DISCPER"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PERCRTDOLLAR"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RATEDOLLAR"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CONVRATE"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RSPERCRT"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RSAMOUNT"]);
					$ROWIDX++;		
				}
			}
			break;
			//=========================================================
			case "Broker Purchase-Sale P & L":
				{
					$VDATE = (isset( $_POST["REPORTLIST_FROMDATE"]) && !empty( $_POST["REPORTLIST_FROMDATE"])) && (isset($_POST["REPORTLIST_TODATE"]) && !empty($_POST["REPORTLIST_TODATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
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
					array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
					array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
					array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
					array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
					array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
					array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");
				switch($ORDERBY)
					{
						case 'Date':
							$ORDERBY_COND =' ORDER BY SP.VDATE';
						break;
						default:
							$ORDERBY_COND =' ORDER BY SP.VDATE';
						break;
					}
					
					$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE AND PS.BROKERID!='' AND PS.VOUCHERTYPE='Purchase'  INNER JOIN ".LEDGER." AS B ON B.LEDGERID=PS.BROKERID LEFT JOIN ".LEDGER." AS L ON L.LEDGERID=PS.LEDGERID LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO AND SP.PROCESSTYPE='Sale'   WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' ".
					$BROKER.$VDATE.$BARCODENO.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$ORDERBY_COND);
										
										$headerarr = array();
										array_push($headerarr,"Sr No");
										array_push($headerarr,"Date");
										array_push($headerarr,"Broker Name");
										array_push($headerarr,"Party Name");
										array_push($headerarr,"Stock ID");
										array_push($headerarr,"Weight");
										array_push($headerarr,"Color");
										array_push($headerarr,"Clarity");
										array_push($headerarr,"PUR AMT");
										array_push($headerarr,"SAL AMT");
										array_push($headerarr,"DIFF AMT");
										
										foreach($headerarr as $tempheader)
										{
											$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
											$icol =(chr(ord($icol)+1));
										}
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
											$ROWIDX=2;
											while($resdata = mysqli_fetch_assoc($res))
											{
														$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"];
														$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
														$PURAMT += $pur;
														$SALAMT += $sal;
														$WGTSUM += $resdata["WEIGHT"];
														$AMT = $AMT + ($sal-$pur);	
												$icol="A";
												$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)
												->getStyle("A".($ROWIDX))->applyFromArray($style);
												
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"]));
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BROKERNAME"]);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTY"]);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$pur);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX), $sal);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($sal-$pur));
												$ROWIDX++;		
											}
									
															
				}
				break;
			//=========================================================
			case "Monthly Purchase And Sale":
			{		
				$PURCHASETOTAL='';
				$FieldArr= array();
				array_push($FieldArr,"DR.VOUCHERDATE");
				array_push($FieldArr,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
				array_push($FieldArr,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
				array_push($FieldArr,"round(SUM(DR.THIRDPARTYCHARGES)) AS THIRDPARTYCHARGES");
				array_push($FieldArr,"round(SUM(DR.THIRDPARTYTCS)) AS THIRDPARTYTCS");
				array_push($FieldArr,"round(SUM(DR.TCSAMT)) AS TCSAMT");
				array_push($FieldArr,"SUM(DR.FINALTOTAL) AS FINALTOTALPURCHASE");			
				$respurchase = getData(PURCHASESALE,$FieldArr," AS DR WHERE VOUCHERTYPE='Purchase' ".$VOUCHERDATE." 
				GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
				
				$FieldArrsale= array();				
				array_push($FieldArrsale,"DR.VOUCHERDATE");
				array_push($FieldArrsale,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
				array_push($FieldArrsale,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
				array_push($FieldArrsale,"round(SUM(DR.TCSAMT)) AS TCSAMT");
				array_push($FieldArrsale,"SUM(DR.FINALTOTAL) AS FINALTOTALSALE");
				$ressale = getData(PURCHASESALE,$FieldArrsale," AS DR WHERE VOUCHERTYPE='Sale' ".$VOUCHERDATE." GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
			
				$PURCHASEcnt = mysqli_num_rows($respurchase);
				$SALEcnt = mysqli_num_rows($ressale);	
							
					$headerarr = array();
					array_push($headerarr,"Sr No");
					array_push($headerarr,"Year");
					array_push($headerarr,"Month");
					array_push($headerarr,"Purchase Amt");
					array_push($headerarr,"sale Amt");
					array_push($headerarr,"Ratio");
					array_push($headerarr,"Tax In");
					array_push($headerarr,"Tax Out");
					array_push($headerarr,"TCS In");
					array_push($headerarr,"TCS Out");
					array_push($headerarr,"Third Party Charges");
					array_push($headerarr,"Third Party TCS");
					array_push($headerarr,"Opening Stock");
					array_push($headerarr,"Closing Stock");
					array_push($headerarr,"Gross P/L");
					array_push($headerarr,"GP Ratio");
					
					foreach($headerarr as $tempheader)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
						$icol =(chr(ord($icol)+1));
					}
					
					if($PURCHASEcnt >= $SALEcnt)
					{
						$idx = 1;
						$ROWIDX=2;
						while($respurchasedata = mysqli_fetch_assoc($respurchase))
						{		
							$time=strtotime($respurchasedata["VOUCHERDATE"]);
							$dispmonth=date("F",$time);
							$month=date("m",$time);
							//$month=date("F",$time);
							$year=date("Y",$time);
							$dt1 = $year."-".$month."-"."01";
							$dt2 = $year."-".$month."-"."31";
							
							$FieldArrsale= array();				
							array_push($FieldArrsale,"DR.VOUCHERDATE");
							array_push($FieldArrsale,"round(SUM(DR.DALALIAMT)) AS BROKERAMT");
							array_push($FieldArrsale,"round(SUM(DR.IGSTAMT)) AS GSTAMT");
							array_push($FieldArrsale,"round(SUM(DR.TCSAMT)) AS TCSAMT");
							array_push($FieldArrsale,"SUM(round(DR.FINALTOTAL)) AS FINALTOTALSALE");
							
							$ressale = getData(PURCHASESALE,$FieldArrsale," AS DR WHERE VOUCHERTYPE='Sale' 
							and VOUCHERDATE BETWEEN '".$dt1."' AND '".$dt2."' GROUP BY YEAR(VOUCHERDATE), MONTH(VOUCHERDATE)");
							$ressaleData = mysqli_fetch_assoc($ressale);
							
							$totalsale_BROKERAMT= $ressaleData["BROKERAMT"];
							$totalsale_GSTAMT= $ressaleData["GSTAMT"];
							$totalsale_TCSAMT= $ressaleData["TCSAMT"];
							$totalsale= $ressaleData["FINALTOTALSALE"];
							
							$OPENSTOCK = getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' 
							and VDATE < '".$dt1."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." 
							WHERE VDATE < '".$dt1."' AND PROCESSTYPE='Sale')");
							
							$COSINGSTOCK = (getFieldDetail(BARCODE_PROCESS,"SUM(RSAMOUNT)"," where PROCESSTYPE='Purchase' 
							and VDATE <= '". $dt2 ."' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." 
							WHERE VDATE <= '". $dt2 ."' AND PROCESSTYPE='Sale')"));
							
							//$GP = ($COSINGSTOCK+$totalsale+$totalsale_GSTAMT) - ($OPENSTOCK+$respurchasedata["FINALTOTALPURCHASE"]+$respurchasedata["GSTAMT"]+$respurchasedata["THIRDPARTYCHARGES"]);
							
							
							$pur = $OPENSTOCK+$respurchasedata["FINALTOTALPURCHASE"] + $respurchasedata["BROKERAMT"] + $respurchasedata["GSTAMT"]+ $respurchasedata["THIRDPARTYCHARGES"]+ $respurchasedata["THIRDPARTYTCS"]+ $respurchasedata["TCSAMT"];
							
							$sal = $COSINGSTOCK + ($totalsale - $totalsale_BROKERAMT) + $totalsale_GSTAMT+ $totalsale_TCSAMT;
							
							if($pur == 0)
							{
								$GPRATIO=0;
							}
							else
							{								
								$GPRATIO = (($sal-$pur) / $pur) * 100;
								
							}
							$icol="A";
							$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$year);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$dispmonth);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($respurchasedata["FINALTOTALPURCHASE"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($totalsale));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($totalsale > 0 ? getCurrFormat0($totalsale/$respurchasedata["FINALTOTALPURCHASE"]): 0));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($respurchasedata["GSTAMT"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($totalsale_GSTAMT));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($respurchasedata["TCSAMT"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($totalsale_TCSAMT));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($respurchasedata["THIRDPARTYCHARGES"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($respurchasedata["THIRDPARTYTCS"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($OPENSTOCK));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($COSINGSTOCK));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($sal-$pur));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($GPRATIO));
							$ROWIDX++;	
						}
					}
					else
					{
						$idx = 1;
						$ROWIDX=2;
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
							
							$icol="A";
							$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$year);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$month);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($totalpurchase));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($ressaledata["FINALTOTALSALE"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($totalpurchase > 0 ? getCurrFormat0($ressaledata["FINALTOTALSALE"]/$totalpurchase): 0));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($totalpurchase_GST));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($ressaledata["GSTAMT"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($totalpurchase_TCS));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($ressaledata["TCSAMT"]));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($totalpurchase_THIRDPARTYCHARGES));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($totalpurchase_THIRDPARTYTCS));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($OPENSTOCK));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($COSINGSTOCK));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($GP));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($GPRATIO));
							$ROWIDX++;	
						}
					}
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
					
					$res = getData(BARCODE_PROCESS,$FieldArr," AS BP 
					INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE AND PS.PARTNERPER > 0 
					INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS PRL ON PRL.LEDGERID=BP.PARTNERLEDGERID 
					WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' AND BP.BARCODENO NOT IN(SELECT BARCODENO FROM ".BARCODE_PROCESS." 
					WHERE PROCESSTYPE='Sale') AND BP.PARTNERPER > 0 ".$BARCODENO.$VDATE.$COLOR.$CLARITY.$WEIGHT.$PARTY.$ORDERBY_COND);
				
					$headerarr = array();
					array_push($headerarr,"Sr No");
					array_push($headerarr,"Dt");
					array_push($headerarr,"Party");
					array_push($headerarr,"Stock Id");
					array_push($headerarr,"Partner Name");
					array_push($headerarr,"Weight");
					array_push($headerarr,"Color");
					array_push($headerarr,"Clarity");
					array_push($headerarr,"Amount");
					
					foreach($headerarr as $tempheader)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
						$icol =(chr(ord($icol)+1));
					}
					$idx = 1;
					$ROWIDX=2;
					$rstotal=0;	
					while($resdata = mysqli_fetch_assoc($res))
					{
						$rstotal += $resdata["RSAMOUNT"];
						$icol="A";	
						$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
					  $objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["VOUCHERDATE"]));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTNERNAME"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($resdata["RSAMOUNT"]));
				
						$ROWIDX++;
					}
							
					$icol="A";
					$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"Total");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($rstotal));				
		}
		break;
		
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
				$headerarr = array();
				array_push($headerarr,"Party");
				array_push($headerarr,"Amount");
				
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
					$icol =(chr(ord($icol)+1));
				}
					
				$idx = 1;
				$ROWIDX=2;			
				$resPur = getData(LEDGER_DEBIT,$FieldArr_PUR," AS DR INNER JOIN ".LEDGER." AS L ON L.LEDGERID=DR.LEDGERID 
				WHERE DR.LEDGERID !='' AND DR.GROUPID IN('25')".$PARTY.$VOUCHERDATE.$ORDERBY_COND);
				$SUMAMOUNT=0;
				while($resdata = mysqli_fetch_assoc($resPur))
				{
					$icol="A";
					$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$resdata["PARTY"]);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($resdata["AMOUNT"]));
					
					$ROWIDX++;		
					$SUMAMOUNT+=$resdata["AMOUNT"];
				}	
				$icol="A";
				$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"Total");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($SUMAMOUNT));
				$ROWIDX++;
		}
		
		break;
		//========================Period Wise Party Payment============================
		
		
		
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
					
				$resPur_STRING = " AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID 
				LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID 
				WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0' 
				AND DATE_FORMAT(P.VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'".$ORDERBY_COND.$BARCODENO;
				$headerarr = array();
				array_push($headerarr,"Id");
				array_push($headerarr,"Dt");
				array_push($headerarr,"Due Dt");
				array_push($headerarr,"Stock Id");
				array_push($headerarr,"Party");
				array_push($headerarr,"Broker");
				array_push($headerarr,"$");
				array_push($headerarr,"Final Total");
				array_push($headerarr,"GST");
				array_push($headerarr,"Third Party Charges");
				array_push($headerarr,"Last Total");
				array_push($headerarr,"Paid");
				array_push($headerarr,"Due");
				
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
					$icol =(chr(ord($icol)+1));
				}
					
				$idx = 1;
				$ROWIDX=2;
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
										$icol="A";
										if($styledue == '')
										{
											$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$resdata["ID"]);
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["VOUCHERDATE"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["DUEDATE"])."(".$resdata["DUEDAYS"].")");	
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$BARCODENO);
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTY"]);
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BROKER"]);
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($resdata["CONVRATE"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($resdata["FINALTOTAL"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["IGSTAMT"] > 0 ? getCurrFormat($resdata["IGSTAMT"]) : getCurrFormat(($resdata["SGSTAMT"]+$resdata["CGSTAMT"])));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($resdata["THIRDPARTYCHARGES"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($resdata["LASTAMOUNT"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($paid));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($due));
											$ROWIDX++;
										}
									}
							}
					}
			}
			break;
			case "Sale Outstanding":
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
					
				$resSal_STRING=" AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID 
				LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' 
				AND VOUCHERTYPE='Sale' AND DATE_FORMAT(P.VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'".$ORDERBY_COND.$BARCODENO;
				$headerarr = array();
				array_push($headerarr,"Id");
				array_push($headerarr,"Dt");
				array_push($headerarr,"Due Dt");
				array_push($headerarr,"Stock Id");
				array_push($headerarr,"Party");
				array_push($headerarr,"Broker");
				array_push($headerarr,"$");
				array_push($headerarr,"Final Total");
				array_push($headerarr,"GST");
				array_push($headerarr,"Last Total");
				array_push($headerarr,"Paid");
				array_push($headerarr,"Due");
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
					$icol =(chr(ord($icol)+1));
				}
				$idx = 1;
				$ROWIDX=2;
				$resledger = getData(LEDGER,$AllArr," WHERE FLAG='0' and LEDGERID IN (SELECT LEDGERID FROM ".PURCHASESALE." WHERE VOUCHERTYPE='Sale' and DUEDATE <= CURDATE())");
				while($resledgerdata = mysqli_fetch_assoc($resledger))
					{
						$resSal = getData(PURCHASESALE,$FieldArr_PUR,$resSal_STRING ." AND L.LEDGERID='".$resledgerdata["LEDGERID"]."'".$PARTY);
						$totalpaid= getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."'");
						while($resdata = mysqli_fetch_assoc($resSal))
							{
								$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ', ')" ," WHERE LEDGERID='".$resledgerdata["LEDGERID"]."' AND ID='".$resdata["ID"]."' AND FLAG='0' AND PROCESSTYPE='Sale'");
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
										if($days8 < $resdata["DUEDATE"] || $due==0)
											{
												$styledue = " display:none;";
											}
										$icol="A";
										if($styledue == '')
										{
											$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$resdata["ID"]);
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["VOUCHERDATE"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["DUEDATE"])."(".$resdata["DUEDAYS"].")");	
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$BARCODENO);
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTY"]);
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BROKER"]);
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($resdata["CONVRATE"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($resdata["FINALTOTAL"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["IGSTAMT"] > 0 ? getCurrFormat($resdata["IGSTAMT"]) : getCurrFormat(($resdata["SGSTAMT"]+$resdata["CGSTAMT"])));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($resdata["LASTAMOUNT"]));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($paid));
											$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($due));
											$ROWIDX++;
									}
								}
							}
					}
			}
			break;
			//===============Due Date Wise Pending Payment==================================
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
				
										
							$headerarr = array();
							array_push($headerarr,"Id");
							array_push($headerarr,"Dt");
							array_push($headerarr,"Due Days");
							array_push($headerarr,"Due Dt");
							array_push($headerarr,"Party");
							array_push($headerarr,"Last Total");
							array_push($headerarr,"Paid");
							array_push($headerarr,"Due");
							foreach($headerarr as $tempheader)
							{
								$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
								$icol =(chr(ord($icol)+1));
							}
							
							$idx = 1;
							$ROWIDX=2;
							$resPur = getData(PURCHASESALE,$FieldArr_PUR," AS P 
							INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID  
							WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' AND OPENSTATUS='0'".$PARTY.$DUEDATE.$ORDERBY_COND);
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
												$icol="A";
												$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$resdata["ID"])->getStyle("A".$ROWIDX)
												->getAlignment()
												->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["VOUCHERDATE"]));
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["DUEDAYS"]);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata["DUEDATE"]));	
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTY"]);
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($resdata["LASTAMOUNT"]));
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($paid));
												$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($due));
												$ROWIDX++;
												
											
								}
				}	
		
				break;
				case "Premium Size Current Stock":
				{
					$rptcolspan='8';
						
					$headerarr = array();
					array_push($headerarr,"Sr No");
					array_push($headerarr,"Stock Id");
					array_push($headerarr,"Shp");
					array_push($headerarr,"Carat");
					array_push($headerarr,"Col");
					array_push($headerarr,"Cla");
					array_push($headerarr,"Total $");
					array_push($headerarr,"Total Rs");
					foreach($headerarr as $tempheader)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
						$icol =(chr(ord($icol)+1));
					}
					
					$idx = 1;
					$ROWIDX=2;
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
						$icol="A";
						$objPHPExcel->getActiveSheet()
						->setCellValue(($icol.$ROWIDX),$sizeResData["FROMSIZE"]."-".$sizeResData["TOSIZE"])
						->mergeCells("A".($ROWIDX).":H".($ROWIDX))
						->getStyle("A".($ROWIDX).":H".($ROWIDX))
						->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '808080'))));
						
						$ROWIDX++;
						if(mysqli_num_rows($res) > 0)
						{
							$idx = 1;
							while($resdata = mysqli_fetch_assoc($res))
							{
								$ttlstone+=1;
								$ttlwgt+=$resdata["WEIGHT"];
								$ttldollar+=$resdata["TOTALDOLLAR"];
								$ttlrs+=$resdata["RSAMOUNT"];
								$icol="A";
								$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SHAPE"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$resdata["WEIGHT"]));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["TOTALDOLLAR"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["RSAMOUNT"]);
								
								$ROWIDX++;
							}
						}
						else
						{
							$icol="A";
							
							$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"No Data")->mergeCells("A".($ROWIDX).":H".($ROWIDX));
							$ROWIDX++;
											
						}
					}
					$icol="A";
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$ttlstone);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttlwgt));
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttldollar));
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttlrs));
					$ROWIDX++;
				}	
		
				break;
				case "Premium Size Purchase-Sale P & L":
				{
					$rptcolspan='12';
						
					$headerarr = array();
					array_push($headerarr,"Sr No");
					array_push($headerarr,"Date");
					array_push($headerarr,"Purchase Party");
					array_push($headerarr,"Stock ID");
					array_push($headerarr,"Weight");
					array_push($headerarr,"Color");
					array_push($headerarr,"Clarity");
					array_push($headerarr,"Pur Amt");
					array_push($headerarr,"Sal Amt");
					array_push($headerarr,"Diff Amt");
					array_push($headerarr,"GP Ratio");
					array_push($headerarr,"Day Diff");
					foreach($headerarr as $tempheader)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
						$icol =(chr(ord($icol)+1));
					}
					
					$idx = 1;
					$ROWIDX=2;
					$PURAMT_SIZE=0;
					$SALAMT_SIZE=0;
					$WGTSUM_SIZE=0;
					$sizeRes = getData(SIZE_MST,$AllArr," ORDER BY FROMSIZE");
					while($sizeResData = mysqli_fetch_assoc($sizeRes))
					{
						$VDATE = (isset($_POST["REPORTLIST_FROMDATE"]) && !empty( $_POST["REPORTLIST_FROMDATE"])) && (isset($_POST["REPORTLIST_TODATE"]) && !empty($_POST["REPORTLIST_TODATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
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
						array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
						array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
						array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
						array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
						array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
						array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");
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
						$res = getData(BARCODE_PROCESS,$FieldArr," AS BP 
						LEFT JOIN ".BARCODE_PROCESS." AS SP ON BP.BARCODENO = SP.BARCODENO 
						AND SP.PROCESSTYPE='Sale' LEFT JOIN ".LEDGER." AS L ON L.LEDGERID = BP.LEDGERID 
						WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Purchase' 
						AND BP.WEIGHT BETWEEN '".$sizeResData["FROMSIZE"]."' AND '".$sizeResData["TOSIZE"]."' ".
						$VDATE.$BARCODENO.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$ORDERBY_COND);
						
						$icol="A";
						$objPHPExcel->getActiveSheet()
						->setCellValue(($icol.$ROWIDX),$sizeResData["FROMSIZE"]."-".$sizeResData["TOSIZE"])
						->mergeCells("A".($ROWIDX).":L".($ROWIDX))
						->getStyle("A".($ROWIDX).":L".($ROWIDX))
						->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '808080'))));
						$ROWIDX++;
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
								//$GPRATIO = getCurrFormat((($resdata["SRSAMOUNT"] - $resdata["RSAMOUNT"]) / ($resdata["RSAMOUNT"]))*100);
								$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"];
								$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
								$PURAMT += $pur;
								$SALAMT += $sal;
								$WGTSUM += $resdata["WEIGHT"];
								
								$PURAMT_SIZE += $pur;
								$SALAMT_SIZE += $sal;
								$WGTSUM_SIZE += $resdata["WEIGHT"];
								
								$GPRATIO= round((($sal-$pur)/$pur)*100,2);
								
								$icol="A";
								$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["VDATE"] != '' ? getDateFormat($resdata["VDATE"]): '');
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["LEDGERNAME"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($pur));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($sal));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($sal - $pur));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$GPRATIO);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$diffdisp);
								$ROWIDX++;
							}
							$icol="A";
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$WGTSUM);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($PURAMT));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($SALAMT));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($SALAMT - $PURAMT));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$ROWIDX++;
											
						}
						else{
							$icol="A";
							$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"No Data")->mergeCells("A".($ROWIDX).":L".($ROWIDX));
							$ROWIDX++;
							
						}	
					}
					$icol="A";
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$WGTSUM_SIZE);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($PURAMT_SIZE));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($SALAMT_SIZE));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($SALAMT_SIZE - $PURAMT_SIZE));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				}	
		
				break;
				case "Party Wise Current Stock":
				{
						
					$headerarr = array();
					array_push($headerarr,"Sr No");
					array_push($headerarr,"Stock ID");
					array_push($headerarr,"Shape");
					array_push($headerarr,"Carat");
					array_push($headerarr,"Color");
					array_push($headerarr,"Clarity");
					array_push($headerarr,"Total $");
					
					foreach($headerarr as $tempheader)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
						$icol =(chr(ord($icol)+1));
					}
					
					$idx = 1;
					$ROWIDX=2;
					$ttlstone=0;
					$ttlwgt =0;
					$ttldollar=0;
					$FieldArr= array();	
					array_push($FieldArr,"BP.LEDGERID");
					array_push($FieldArr,"L.LEDGERNAME");
					array_push($FieldArr,"COUNT(BP.BARCODENO) AS TOTAL");
					$resParty = getData(BARCODE_PROCESS,$FieldArr," AS BP 
					INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID 
					where BP.PROCESSTYPE='Purchase' and BP.BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') "
					.$VDATE.$COLOR.$CLARITY.$WEIGHT.$PARTY.$BARCODENO." GROUP BY BP.LEDGERID");
					while($resPartyData = mysqli_fetch_assoc($resParty))
					{
						$res = getData(BARCODE_PROCESS,$AllArr," where PROCESSTYPE='Purchase' and BARCODENO NOT IN (SELECT BARCODENO FROM ".BARCODE_PROCESS." WHERE PROCESSTYPE='Sale') AND LEDGERID='".$resPartyData["LEDGERID"]."' ".$COLOR.$WEIGHT.$CLARITY.$BARCODENO);
									
						$icol="A";
						$objPHPExcel->getActiveSheet()
						->setCellValue(($icol.$ROWIDX),$resPartyData["LEDGERNAME"]."-".$resPartyData["TOTAL"])
						->mergeCells("A".($ROWIDX).":G".($ROWIDX))
						->getStyle("A".($ROWIDX))
						->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '808080'))));
						
						$ROWIDX++;
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
								$icol="A";
								$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SHAPE"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$resdata["WEIGHT"]));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["TOTALDOLLAR"]);
								$ROWIDX++;
							}
							$icol="A";
							$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$ttlstone_party);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttlwgt_party));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$ttldollar_party);
							$ROWIDX++;
						}
						else{
							$icol="A";
							$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"No Data")->mergeCells("A".($ROWIDX).":G".($ROWIDX));
							$ROWIDX++;
						}	
					}
					$icol="A";
					$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$ttlstone);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttlwgt));
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttldollar));
					$ROWIDX++;
				}	
		
				break;
				case "Deal Purchase Status":
				{
						
					$headerarr = array();
					array_push($headerarr,"Sr No");
					array_push($headerarr,"Status");
					array_push($headerarr,"Days");
					array_push($headerarr,"Stock ID");
					array_push($headerarr,"Shape");
					array_push($headerarr,"Carat");
					array_push($headerarr,"Color");
					array_push($headerarr,"Clarity");
					array_push($headerarr,"Pur");
					array_push($headerarr,"Sal");
					array_push($headerarr,"GP Ratio");
					array_push($headerarr,"Diff");
					array_push($headerarr,"Unsold");
					
					foreach($headerarr as $tempheader)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
						$icol =(chr(ord($icol)+1));
					}
					
					$idx = 1;
					$ROWIDX=2;
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
					
					$resParty = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID where BP.PROCESSTYPE='Purchase' ".$VDATE.$COLOR.$CLARITY.$WEIGHT.$BARCODENO.$PARTY." GROUP BY BP.LEDGERID");
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
						$temparr[10]='((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT';
						$temparr[11]='((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT';
						$temparr[12]='((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100)  AS THIRDPARTYTCS';
						$VDATE = (isset($PostArray["dtpFROMDATE"]) && !empty($PostArray["dtpFROMDATE"])) && (isset($PostArray["dtpENDDATE"]) && !empty($PostArray["dtpENDDATE"])) ? " AND BP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
						
						$res = getData(BARCODE_PROCESS,$temparr," AS BP 
						LEFT JOIN ". BARCODE_PROCESS ." AS SP ON SP.BARCODENO=BP.BARCODENO AND SP.PROCESSTYPE in ('Sale') 
						WHERE BP.PROCESSTYPE in ('Purchase') AND BP.LEDGERID='".$resPartyData["LEDGERID"]."' ".$VDATE." ");
										
						$icol="A";
						$objPHPExcel->getActiveSheet()
						->setCellValue(($icol.$ROWIDX),$resPartyData["LEDGERNAME"]."-".$resPartyData["TOTAL"])
						->mergeCells("A".($ROWIDX).":M".($ROWIDX))
						->getStyle("A".($ROWIDX))
						->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '808080'))))
						 ->getAlignment()
						->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						 
						$ROWIDX++;
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
								$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"] + $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"]+ $resdata["TCSAMT"];
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
								
								$icol="A";
								$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$SPROCESS)->getStyle("B".$ROWIDX)->applyFromArray($style);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SALEDATE"])->getStyle("C".$ROWIDX)->applyFromArray($style);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SHAPE"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$resdata["WEIGHT"]));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($pur));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($sal));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$GPRATIO);
								if($sal == 0)
								{
									$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
									$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($DIFF));
								}else{
									$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($DIFF));
									$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");		
								}
								$ROWIDX++;
							}
							$icol="A";
							
/*$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"PARTY TOTAL");*/
							
							$objPHPExcel->getActiveSheet()
							->setCellValue(($icol.$ROWIDX),"PARTY TOTAL")
							->mergeCells("A".($ROWIDX).":C".($ROWIDX))
							->getStyle("A".($ROWIDX))
							->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '808080'))))
							 ->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
							$icol++;
							$icol++;
						
						
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$ttlstone_party);
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttlwgt_party));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($PURAMT));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($SALAMT));
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
							
							if($SALAMT == 0)
							{
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($PURAMT));
							}else{
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($DIFF_TOTAL));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($UNSOLD_TOTAL));
							}
							$ROWIDX++;
						}
						else{
							$icol="A";
							$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"No Data")->mergeCells("A".($ROWIDX).":M".($ROWIDX));
							$ROWIDX++;
						}	
						$FINALTOTALDIFF +=  $DIFF_TOTAL ;
						$FINALTOTALUNSOLD +=  $UNSOLD_TOTAL ;
					}
					$icol="A";
					
					/*$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");*/
					$objPHPExcel->getActiveSheet()
							->setCellValue(($icol.$ROWIDX),"FINAL TOTAL")
							->mergeCells("A".($ROWIDX).":C".($ROWIDX))
							->getStyle("A".($ROWIDX))
							->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '808080'))))
							 ->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
							$icol++;
							$icol++;
							
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$ttlstone);
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttlwgt));
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($PURAMT_ttl));
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($SALAMT_ttl));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					if($SALAMT_ttl == 0)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($PURAMT_ttl));
					}else{
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($FINALTOTALDIFF));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($FINALTOTALUNSOLD));
					}
					$ROWIDX++;
				}	
		
				break;
				case "Stock Comparison":
				{
				
					$FieldArr= array();		
					$FieldArr[0]="BP.*";
					$FieldArr[1]="(BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT))) AS CURRWGT";
					$res = getData(BARCODE_PROCESS,$FieldArr," AS BP 
					LEFT JOIN ". BARCODE_PROCESS ." AS SP ON BP.BARCODENO=SP.BARCODENO 
					AND SP.PROCESSTYPE='Sale' 
					WHERE BP.PROCESSTYPE IN ('Purchase','Memo Issue','Memo Receive','Repair Issue','Repair Receive','Grading Issue','Grading Result','Grading Receive') 
					and BP.ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO)" .$BARCODENO.$WEIGHT.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE."  GROUP BY BP.BARCODENO HAVING BP.WEIGHT-IF(ISNULL(SUM(SP.WEIGHT)),0,SUM(SP.WEIGHT)) > 0 ORDER BY CAST(SUBSTR(BP.BARCODENO,3) AS UNSIGNED)");
					$end_from = mysqli_num_rows($res);
					$headerarr = array();
					array_push($headerarr,"No");
					array_push($headerarr,"Stock ID");
					array_push($headerarr,"Weight");
					array_push($headerarr,"Color");
					array_push($headerarr,"Clarity");
					array_push($headerarr,"Cut");
					array_push($headerarr,"Polish");
					array_push($headerarr,"Symm");
					array_push($headerarr,"Flourance");
					array_push($headerarr,"");
					array_push($headerarr,"Discount");
					array_push($headerarr,"");
					array_push($headerarr,"");
					array_push($headerarr,"Amount");
					array_push($headerarr,"");
					foreach($headerarr as $tempheader)
					{
						$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
						$icol =(chr(ord($icol)+1));
					}
					$ROWIDX=2;
					$icol="A";
					$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");	
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");	
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");	
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");	
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");	
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");	
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"PUR DISC");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"DISC 2");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"MKT DISC");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"PUR Amt");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"CURR Amt");
					$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"Diff");
					
					$ROWIDX++;
							$idx = 1;
							
							$ttlwgt=0;
							$ttldollar = 0;
							$ttlcurr_rsamount=0;
							while($resdata = mysqli_fetch_assoc($res))
							{
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
								
								$icol="A";
								$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$resdata["ID"])->getStyle("A".$ROWIDX)->applyFromArray($style);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$resdata["WEIGHT"]));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);	
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CUT"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["POLISH"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["SYMM"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["FLOURANCE"]);
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.3f",$resdata["DISCPER"]));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.3f",$resdata["DISC2PER"]));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.3f",$resdata["RAPDISCOUNT"]));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.3f",$resdata["TOTALDOLLAR"]));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$curr_rsamount));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",($curr_rsamount-$resdata["TOTALDOLLAR"])));
								$ROWIDX++;			
								}
								$icol="A";
								$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttlwgt));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
								
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttldollar));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",$ttlcurr_rsamount));
								$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),sprintf("%.2f",($ttlcurr_rsamount-$ttldollar)));
								
				}	
		
				break;
			//======================Due Date Wise Pending Payment=============================
			
			
			
			case "Purchase-Sale P & L":
			{
				$VDATE = (isset($_POST["REPORTLIST_FROMDATE"]) && !empty( $_POST["REPORTLIST_FROMDATE"])) && (isset($_POST["REPORTLIST_TODATE"]) && !empty($_POST["REPORTLIST_TODATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
				$FieldArr= array();				
							
				//array_push($FieldArr,"BP.STOCKIDVALUE");
				array_push($FieldArr,"BP.LEDGERID");
				array_push($FieldArr,"L.LEDGERNAME");
				array_push($FieldArr,"BP.RSAMOUNT");
				array_push($FieldArr,"BP.BARCODENO");
				array_push($FieldArr,"BP.WEIGHT");
				array_push($FieldArr,"BP.COLOR");
				array_push($FieldArr,"BP.CLARITY");
				array_push($FieldArr,"IF(SP.VDATE IS NULL,'',SP.VDATE) AS VDATE ");
				array_push($FieldArr,"SP.RSAMOUNT AS SRSAMOUNT");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS BROKERAMT");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS IGSTAMT");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");
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
				$VDATE.$SHAPE.$COLOR.$BARCODENO.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$ORDERBY_COND);
				
				$end_from = mysqli_num_rows($res);
				$headerarr = array();
				array_push($headerarr,"NO");
				array_push($headerarr,"DATE");
				array_push($headerarr,"PURCHASE PARTY");
				array_push($headerarr,"STOCK ID");
				array_push($headerarr,"WEIGHT");
				array_push($headerarr,"COLOR");
				array_push($headerarr,"CLARITY");
				array_push($headerarr,"PUR AMT");
				array_push($headerarr,"SAL AMT");
				array_push($headerarr,"DIFF AMT");
				array_push($headerarr,"GP RATIO");
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
					$icol =(chr(ord($icol)+1));
				}
				$idx = 1;
				$ROWIDX=2;
				$PURAMT=0;;
				$SALAMT=0;
				$IGSTAMT=0;
				$BROKERAMT=0;
				$SIGSTAMT=0;
				$SBROKERAMT=0;
				while($resdata = mysqli_fetch_assoc($res))
					{
						$GPRATIO = getCurrFormat((($resdata["SRSAMOUNT"] - $resdata["RSAMOUNT"]) / ($resdata["RSAMOUNT"]))*100);
						$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
						$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
						$PURAMT += $pur;
						$SALAMT += $sal;
						
						$GPRATIO = round((($sal-$pur)/$pur)*100,2);
						$icol="A";
						$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"]));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["LEDGERNAME"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($pur));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($sal));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat0($sal-$pur));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($GPRATIO));
						$ROWIDX++;		
					}
				$icol="A";
				$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"TOTAL");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$PURAMT);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$SALAMT);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($SALAMT-$PURAMT));
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
			}
			break;
			case "Partner Purchase-Sale P & L":
			{
				$VDATE = (isset( $_POST["REPORTLIST_FROMDATE"]) && !empty( $_POST["REPORTLIST_FROMDATE"])) && (isset($_POST["REPORTLIST_TODATE"]) && !empty($_POST["REPORTLIST_TODATE"])) ? " AND BP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
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
				array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");
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
				$headerarr = array();
				array_push($headerarr,"NO");
				array_push($headerarr,"DATE");
				array_push($headerarr,"PARTNERNAME");
				array_push($headerarr,"PARTNERPER");
				array_push($headerarr,"STOCK ID");
				array_push($headerarr,"WEIGHT");
				array_push($headerarr,"COLOR");
				array_push($headerarr,"CLARITY");
				array_push($headerarr,"PUR AMT");
				array_push($headerarr,"SAL AMT");
				array_push($headerarr,"DIFF AMT");
				array_push($headerarr,"AMT");
				array_push($headerarr,"GP RATIO");
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
					$icol =(chr(ord($icol)+1));
				}
				$idx = 1;
				$ROWIDX=2;
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
						$PURAMT += $resdata["RSAMOUNT"];
						$SALAMT += $resdata["SRSAMOUNT"];
						
						$BROKERAMT += $resdata["BROKERAMT"];
						$IGSTAMT += $resdata["IGSTAMT"];
						
						$SBROKERAMT += $resdata["SBROKERAMT"];
						$SIGSTAMT += $resdata["SIGSTAMT"];
						
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
						
						
						$icol="A";
						$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["VDATE"]=='' ? '' : getDateFormat($resdata["VDATE"]));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTNERNAME"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["PARTNERPER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($pur));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getCurrFormat($sal));
						
						if($sal == 0) 
						{
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");	
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($DIFF));
						}
						
						else
						{								
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($DIFF));	
							$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
						}
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$GPRATIO);
						$ROWIDX++;
					}	
				$icol="A";
				$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$PURAMT_ttl);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$SALAMT_ttl);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($DIFF_TOTAL));
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),round($UNSOLD_TOTAL));
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
				$headerarr = array();
			
				array_push($headerarr,"Date");
				array_push($headerarr,"Stock Id");
				array_push($headerarr,"Party");
				array_push($headerarr,"Broker");
				array_push($headerarr,"WT");
				array_push($headerarr,"Shp");
				array_push($headerarr,"Cl");
				array_push($headerarr,"Cal");
				array_push($headerarr,"Ct");
				array_push($headerarr,"PO");
				array_push($headerarr,"Sy");
				array_push($headerarr,"Flu");
				array_push($headerarr,"Certi");
				array_push($headerarr,"Lb");
				array_push($headerarr,"Rate");
				array_push($headerarr,"Disc");
				array_push($headerarr,"$/Crt");
				array_push($headerarr,"Rate $");
				array_push($headerarr,"$");
				array_push($headerarr,"Rs/Crt");
				array_push($headerarr,"Rs Amt");
				
				array_push($headerarr,"");
				
				array_push($headerarr,"Date");
				array_push($headerarr,"Stock Id");
				array_push($headerarr,"Party");
				array_push($headerarr,"Broker");
				array_push($headerarr,"WT");
				array_push($headerarr,"Shp");
				array_push($headerarr,"Cl");
				array_push($headerarr,"Cal");
				array_push($headerarr,"Ct");
				array_push($headerarr,"PO");
				array_push($headerarr,"Sy");
				array_push($headerarr,"Flu");
				array_push($headerarr,"Certi");
				array_push($headerarr,"Lb");
				array_push($headerarr,"Rate");
				array_push($headerarr,"Disc");
				array_push($headerarr,"$/Crt");
				array_push($headerarr,"Rate $");
				array_push($headerarr,"$");
				array_push($headerarr,"Rs/Crt");
				array_push($headerarr,"Rs Amt");
				$objPHPExcel->getActiveSheet()->setCellValue("A1","Sr No");
				$objPHPExcel->getActiveSheet()->mergeCells("B1:V1");    
				$objPHPExcel->getActiveSheet()->setCellValue("B1","Purchase");
				$objPHPExcel->getActiveSheet()->mergeCells("X1:AR1"); 
				$objPHPExcel->getActiveSheet()->setCellValue("X1","Sale");
				
				$icol =  "B";
				$prefix_char="A";
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."2"),$tempheader);
					if($icol == "Z")
					{
						$icol =$prefix_char."A";
					}
					elseif(strlen($icol) == 2)
					{
						$icol =(chr(ord(substr($icol,1,1))+1));
						$icol =$prefix_char.$icol;
					}
					else{
						$icol =(chr(ord($icol)+1));
					}
				}
				$icol="A";
				$ROWIDX=3;
				for($i= 1; $i<= $maxcnt ;$i++)
					{
						
						$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX++),$i);
					}
				$prefix_char="A";
				$idx = 1;
				$ROWIDX=3;
				while($resdata_pur = mysqli_fetch_assoc($res_pur))
					{
						$icol = "A";
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata_pur["VOUCHERDATE"]));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["PARTY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["BROKER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["SHAPE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["CUT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["POLISH"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["SYMM"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["FLOURANCE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["CERTIFICATENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["LAB"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["RATE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["DISCPER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["PERCRTDOLLAR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["RATEDOLLAR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["CONVRATE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["RSPERCRT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["RSAMOUNT"]);
						$ROWIDX++;
					}
				$ROWIDX=3;
				while($resdata_sal = mysqli_fetch_assoc($res_sal))
					{
						$icol = "W";
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata_sal["VOUCHERDATE"]));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["PARTY"]);
						$icol = "A";
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol)+1)).$ROWIDX),$resdata_sal["BROKER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["SHAPE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["CUT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["POLISH"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["SYMM"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["FLOURANCE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["CERTIFICATENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["LAB"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["RATE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["DISCPER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["PERCRTDOLLAR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["RATEDOLLAR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["CONVRATE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["RSPERCRT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["RSAMOUNT"]);
						$ROWIDX++;
					}
			}
			break;
			
			
			
			case "Sale With Purchase":
			{
				$FieldArr_Pur= array();				
				array_push($FieldArr_Pur,"BPP.ENTRYID");
				array_push($FieldArr_Pur,"BPP.ID");
				array_push($FieldArr_Pur,"BPP.ENTRYDATE");
				array_push($FieldArr_Pur,"LPP.LEDGERNAME AS PARTY");
				array_push($FieldArr_Pur,"B.LEDGERNAME AS BROKER");
				array_push($FieldArr_Pur,"BPP.REMARK");
				array_push($FieldArr_Pur,"BPP.BARCODENO");
				array_push($FieldArr_Pur,"BPP.WEIGHT");
				array_push($FieldArr_Pur,"BPP.SHAPE");
				array_push($FieldArr_Pur,"BPP.COLOR");
				array_push($FieldArr_Pur,"BPP.CLARITY");
				array_push($FieldArr_Pur,"BPP.CUT");
				array_push($FieldArr_Pur,"BPP.POLISH");
				array_push($FieldArr_Pur,"BPP.SYMM");
				array_push($FieldArr_Pur,"BPP.FLOURANCE");
				array_push($FieldArr_Pur,"BPP.GREEN");
				array_push($FieldArr_Pur,"BPP.MILKY");
				array_push($FieldArr_Pur,"BPP.LAB");
				array_push($FieldArr_Pur,"BPP.CERTIFICATENO");
				array_push($FieldArr_Pur,"BPP.RATE");
				array_push($FieldArr_Pur,"BPP.DISCPER");
				array_push($FieldArr_Pur,"BPP.PERCRTDOLLAR");
				array_push($FieldArr_Pur,"BPP.RATEDOLLAR");
				array_push($FieldArr_Pur,"BPP.CONVRATE");
				array_push($FieldArr_Pur,"BPP.RSPERCRT");
				array_push($FieldArr_Pur,"BPP.RSAMOUNT");
				array_push($FieldArr_Pur,"PSP.VOUCHERDATE");
								
				switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY PSP.VOUCHERDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY PSP.VOUCHERDATE';
									break;
								}
											
				$res_pur = getData(BARCODE_PROCESS,$FieldArr_Pur," AS BPP INNER JOIN ".LEDGER." AS LPP ON LPP.LEDGERID=BPP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BPP.BROKERID INNER JOIN ".PURCHASESALE." AS PSP ON PSP.ID=BPP.ID WHERE BPP.PROCESSTYPE='Purchase' AND BPP.BARCODENO IN (SELECT BP.BARCODENO FROM ".BARCODE_PROCESS." AS BP INNER JOIN ".LEDGER." AS L ON BP.LEDGERID = L.LEDGERID WHERE BP.PROCESSTYPE IN('Sale')".$VDATE.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY .") ".$ORDERBY_COND);
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
								
					switch($ORDERBY)
								{
									case 'Date':
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
									default:
										$ORDERBY_COND =' ORDER BY PS.VOUCHERDATE';
									break;
								}			
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
				$headerarr = array();
			
				array_push($headerarr,"Date");
				array_push($headerarr,"Stock Id");
				array_push($headerarr,"Party");
				array_push($headerarr,"Broker");
				array_push($headerarr,"WT");
				array_push($headerarr,"Shp");
				array_push($headerarr,"Cl");
				array_push($headerarr,"Cal");
				array_push($headerarr,"Ct");
				array_push($headerarr,"PO");
				array_push($headerarr,"Sy");
				array_push($headerarr,"Flu");
				array_push($headerarr,"Certi");
				array_push($headerarr,"Lb");
				array_push($headerarr,"Rate");
				array_push($headerarr,"Disc");
				array_push($headerarr,"$/Crt");
				array_push($headerarr,"Rate $");
				array_push($headerarr,"$");
				array_push($headerarr,"Rs/Crt");
				array_push($headerarr,"Rs Amt");
				
				array_push($headerarr,"");
				
				array_push($headerarr,"Date");
				array_push($headerarr,"Stock Id");
				array_push($headerarr,"Party");
				array_push($headerarr,"Broker");
				array_push($headerarr,"WT");
				array_push($headerarr,"Shp");
				array_push($headerarr,"Cl");
				array_push($headerarr,"Cal");
				array_push($headerarr,"Ct");
				array_push($headerarr,"PO");
				array_push($headerarr,"Sy");
				array_push($headerarr,"Flu");
				array_push($headerarr,"Certi");
				array_push($headerarr,"Lb");
				array_push($headerarr,"Rate");
				array_push($headerarr,"Disc");
				array_push($headerarr,"$/Crt");
				array_push($headerarr,"Rate $");
				array_push($headerarr,"$");
				array_push($headerarr,"Rs/Crt");
				array_push($headerarr,"Rs Amt");
				
				$objPHPExcel->getActiveSheet()->setCellValue("A1","Sr No");
				$objPHPExcel->getActiveSheet()->mergeCells("B1:V1");    
				$objPHPExcel->getActiveSheet()->setCellValue("B1","Sale");
				$objPHPExcel->getActiveSheet()->mergeCells("X1:AR1"); 
				$objPHPExcel->getActiveSheet()->setCellValue("X1","Purchase");
				
				$icol =  "B";
				$prefix_char="A";
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."2"),$tempheader);
					if($icol == "Z")
					{
						$icol =$prefix_char."A";
					}
					elseif(strlen($icol) == 2)
					{
						$icol =(chr(ord(substr($icol,1,1))+1));
						$icol =$prefix_char.$icol;
					}
					else{
						$icol =(chr(ord($icol)+1));
					}
				}
				$icol="A";
				$ROWIDX=3;
				for($i= 1; $i<= $maxcnt ;$i++)
					{
						
						$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX++),$i);
					}
				$prefix_char="A";
				$idx = 1;
				
				$ROWIDX=3;
				while($resdata_sal = mysqli_fetch_assoc($res_sal))
					{
						$icol = "A";
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata_sal["VOUCHERDATE"]));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["PARTY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["BROKER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["SHAPE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["CUT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["POLISH"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["SYMM"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["FLOURANCE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["CERTIFICATENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["LAB"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["RATE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["DISCPER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["PERCRTDOLLAR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["RATEDOLLAR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["CONVRATE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["RSPERCRT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_sal["RSAMOUNT"]);
						$ROWIDX++;
					}
				$ROWIDX=3;
				while($resdata_pur = mysqli_fetch_assoc($res_pur))
					{
						$icol = "W";
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),getDateFormat($resdata_pur["VOUCHERDATE"]));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["PARTY"]);
						$icol = "A";
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol)+1)).$ROWIDX),$resdata_pur["BROKER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["SHAPE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["CUT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["POLISH"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["SYMM"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["FLOURANCE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["CERTIFICATENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["LAB"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["RATE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["DISCPER"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["PERCRTDOLLAR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["RATEDOLLAR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["CONVRATE"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["RSPERCRT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(($prefix_char.(chr(ord($icol++)+1)).$ROWIDX),$resdata_pur["RSAMOUNT"]);
						$ROWIDX++;
					}
				
				
			}
			break;
			case "Purchase Party Wise Profit":
			{
				$VDATE = (isset( $_POST["REPORTLIST_FROMDATE"]) && !empty( $_POST["REPORTLIST_FROMDATE"])) && (isset($_POST["REPORTLIST_TODATE"]) && !empty($_POST["REPORTLIST_TODATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
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
				array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
				array_push($FieldArr,"((BP.RSAMOUNT * BP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
				
				array_push($FieldArr,"((SP.RSAMOUNT * SP.BROKERPER)/100) AS SBROKERAMT");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.IGSTPER)/100) AS SIGSTAMT");
				array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");
								
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
				$VDATE.$BARCODENO.$SHAPE.$COLOR.$CLARITY.$CUT.$POLISH.$SYMM.$FLOURANCE.$WEIGHT.$PARTY.$ORDERBY_COND);
								
				$end_from = mysqli_num_rows($res);
				$headerarr = array();
				array_push($headerarr,"NO");
				array_push($headerarr,"DATE");
				array_push($headerarr,"STOCK ID");
				array_push($headerarr,"WEIGHT");
				array_push($headerarr,"COLOR");
				array_push($headerarr,"CLARITY");
				array_push($headerarr,"PUR AMT");
				array_push($headerarr,"SAL AMT");
				array_push($headerarr,"DIFF AMT");
				array_push($headerarr,"GP RATIO");
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
					$icol =(chr(ord($icol)+1));
				}
				$idx = 1;
				$ROWIDX=2;
				$WEIGHT =0;
				$PURAMT=0;
				$SALAMT=0;
				$DIFF=0;					
				while($resdata = mysqli_fetch_assoc($res))
					{
						$pur = $resdata["RSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
						$sal = ($resdata["SRSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
						$GPRATIO = round((($sal-$pur)/$pur)*100,2);
						
						$WEIGHT += $resdata["WEIGHT"];
						$PURAMT += $pur;
						$SALAMT += $sal;
						
						//$GPRATIO = ROUND(getCurrFormat((($resdata["SRSAMOUNT"] - $resdata["RSAMOUNT"]) / ($resdata["RSAMOUNT"]))*100));
				
						$icol="A";
						$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($resdata["VDATE"] == '' ? '' :getDateFormat($resdata["VDATE"])));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$pur);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$sal);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($sal-$pur));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$GPRATIO);
						$ROWIDX++;		
					}
				$icol="A";
				$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$WEIGHT);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$PURAMT);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$SALAMT);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($SALAMT-$PURAMT));
			}
			break;
			case "Sale Party Wise Profit":
			{
				$VDATE = (isset( $_POST["REPORTLIST_FROMDATE"]) && !empty( $_POST["REPORTLIST_FROMDATE"])) && (isset($_POST["REPORTLIST_TODATE"]) && !empty($_POST["REPORTLIST_TODATE"])) ? " AND SP.VDATE BETWEEN '".$dtfrm."' AND '".$dtto."'" : '';
				
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
					array_push($FieldArr,"((BP.RSAMOUNT * BP.TCSPER)/100) AS TCSAMT");

					array_push($FieldArr,"((SP.RSAMOUNT * SP.THIRDPARTYCHARGESPER)/100) AS THIRDPARTYCHARGES");
					array_push($FieldArr,"((SP.RSAMOUNT * SP.THIRDPARTYTCSPER)/100) AS THIRDPARTYTCS");
					
					array_push($FieldArr,"((BP.RSAMOUNT * BP.BROKERPER)/100) AS SBROKERAMT");
					array_push($FieldArr,"((BP.RSAMOUNT * BP.IGSTPER)/100) AS SIGSTAMT");
					array_push($FieldArr,"((SP.RSAMOUNT * SP.TCSPER)/100) AS STCSAMT");

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
				$headerarr = array();
				array_push($headerarr,"NO");
				array_push($headerarr,"DATE");
				array_push($headerarr,"STOCK ID");
				array_push($headerarr,"WEIGHT");
				array_push($headerarr,"COLOR");
				array_push($headerarr,"CLARITY");
				array_push($headerarr,"SAL AMT");
				array_push($headerarr,"PUR AMT");				
				array_push($headerarr,"DIFF AMT");
				array_push($headerarr,"GP RATIO");
				foreach($headerarr as $tempheader)
				{
					$objPHPExcel->getActiveSheet()->setCellValue(($icol."1"),$tempheader);
					$icol =(chr(ord($icol)+1));
				}
				$idx = 1;
				$ROWIDX=2;
				$PURAMT=0;
				$WEIGHT=0;
				$SALAMT=0;
				$GPRATIO=0;
				while($resdata = mysqli_fetch_assoc($res))
					{
						
						$pur = $resdata["SRSAMOUNT"] + $resdata["BROKERAMT"] + $resdata["IGSTAMT"]+ $resdata["TCSAMT"]
						+ $resdata["THIRDPARTYCHARGES"]+ $resdata["THIRDPARTYTCS"];
						$sal = ($resdata["RSAMOUNT"] - $resdata["SBROKERAMT"]) + $resdata["SIGSTAMT"]+ $resdata["STCSAMT"];
						
						$GPRATIO = round((($sal-$pur)/$pur)*100,2);
						
						$WEIGHT += $resdata["WEIGHT"];
						$PURAMT += $pur;
						$SALAMT += $sal;
														
														
						$icol="A";
						$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["VDATE"] == '' ? '' : getDateFormat($resdata["VDATE"]));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["BARCODENO"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["WEIGHT"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["COLOR"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$resdata["CLARITY"]);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$sal);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$pur);
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($sal-$pur));
						$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$GPRATIO);
						$ROWIDX++;		
					}
				$icol="A";
				$objPHPExcel->getActiveSheet()->setCellValue(($icol.$ROWIDX),$idx++)->getStyle("A".$ROWIDX)->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$WEIGHT);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),"");
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$SALAMT);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),$PURAMT);
				$objPHPExcel->getActiveSheet()->setCellValue(((chr(ord($icol++)+1)).$ROWIDX),($SALAMT-$PURAMT));
			}
			break;
			
			
		}
		$objPHPExcel->setActiveSheetIndex(0);
		$filename = $_POST["REPORTLIST"].".xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"".$filename."\"");
		header("Cache-Control: max-age=0");

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
		ob_end_clean();
		$objWriter->save("php://output");
	}
?>