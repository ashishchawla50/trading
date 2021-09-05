<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");
$Arr = explode("_",$_GET["makexls"]);

if(count($Arr) == 1)
{
	$XLSID= $Arr[0];
	$ID="";
}
elseif(count($Arr) == 2)
{
	$XLSID= $Arr[0];
	$ID= $Arr[1];
}
else
{
	
	$XLSID= $Arr[0]."_".substr($Arr[1],0,1);
	$ID= $Arr[2];
		
}

			$XLSPATH = $XLSID."-".date("d-m-Y")."_".$ID.".xls";
			//echo $XLSID;
			$xlsHeaderArr[0]="FIELDHEADER";
			$xlsHeaderArr[1]="FIELDDB";
			$resXLSHEADER = getData(XLSFORMATFIELD,$xlsHeaderArr," WHERE XLSID='".$XLSID."' ORDER BY ORDERNO");
			//exit();
			$ProductFieldArr = array();
			$FieldHeaderArr = array();
			while($resXLSHEADER_data = mysqli_fetch_assoc($resXLSHEADER))
			{
				
				array_push($FieldHeaderArr,trim($resXLSHEADER_data["FIELDHEADER"]));
				array_push($ProductFieldArr,$resXLSHEADER_data["FIELDDB"]);
			
				
			}
			
			if(count($Arr) > 2)
			{
				array_push($FieldHeaderArr,"Paid");
				array_push($FieldHeaderArr,"Due");
				array_push($FieldHeaderArr,"BarcodeNo");
			}
	
			if($Arr[0]=='sale-stock')
			{
				array_push($FieldHeaderArr,"P & L");
			}
			
			
			$filename = $XLSPATH;
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			array_walk($FieldHeaderArr, __NAMESPACE__ . '\cleanData');
			echo implode("\t", $FieldHeaderArr) . "\r";
			
			if($Arr[0] == 'balancesheet')
			{
				$TrialDrArr = Array();
				array_push($TrialDrArr,"G.GROUPID");
				array_push($TrialDrArr,"G.GROUPNAME");
				array_push($TrialDrArr,"SUM(ODR.AMOUNT) AS DROPEN");
				array_push($TrialDrArr,"SUM(DR.AMOUNT) AS DRAMOUNT");
				
				$TrialCrArr = Array();
				array_push($TrialCrArr,"G.GROUPID");
				array_push($TrialCrArr,"G.GROUPNAME");
				array_push($TrialCrArr,"SUM(OCR.AMOUNT) AS CROPEN");
				array_push($TrialCrArr,"SUM(CR.AMOUNT) AS CRAMOUNT");

				$res_dr = getData(ACGROUP,$TrialDrArr," AS G LEFT JOIN ". LEDGER_DEBIT ." AS ODR on ODR.GROUPID=G.GROUPID AND ODR.VOUCHERTYPE ='Opening' LEFT JOIN ". LEDGER_DEBIT ." AS DR on DR.GROUPID=G.GROUPID AND DR.VOUCHERTYPE !='Opening'  GROUP BY G.GROUPID");
				$res_dr_data = mysqli_num_rows($res_dr);
				
				$res_cr = getData(ACGROUP,$TrialCrArr," AS G LEFT JOIN ". LEDGER_CREDIT ." AS OCR on OCR.GROUPID=G.GROUPID AND OCR.VOUCHERTYPE ='Opening' LEFT JOIN ". LEDGER_CREDIT ." AS CR on CR.GROUPID=G.GROUPID AND CR.VOUCHERTYPE !='Opening' GROUP BY G.GROUPID");
				$res_cr_data = mysqli_num_rows($res_cr);
				$SRNO_CNT=1;
							$DR_AMT=0;
							$CR_AMT=0;
							$DR_open=0;
							$CR_open=0;
							$SUMDR_BALANCE=0;
							$SUMCR_BALANCE=0;
							$crArr = array();
							while($res_cr_data = mysqli_fetch_assoc($res_cr))
							{
								array_push($crArr,$res_cr_data);
							}
							
								$idx = 0;
								
								while($res_dr_data = mysqli_fetch_assoc($res_dr))
										{
											$valarr = array();
											$classname = ($SRNO_CNT / 2) == 0 ? 'odd gradeX' :'even gradeC';
											$DR_open += $res_dr_data["DROPEN"];
											$CR_open += $crArr[$idx]["CROPEN"];
											$DR_AMT += $res_dr_data["DRAMOUNT"];
											$CR_AMT += $crArr[$idx]["CRAMOUNT"];
											$BALANCE = ($res_dr_data["DROPEN"] + $res_dr_data["DRAMOUNT"]) - ($crArr[$idx]["CRAMOUNT"]);
											$DR_BALANCE=0;
											$CR_BALANCE=0;
											if($BALANCE > 0)
											{
												
												$DR_BALANCE = $BALANCE;
												$CR_BALANCE = 0;
											}
											elseif($BALANCE < 0)
											{
												$DR_BALANCE = 0;
												$CR_BALANCE = abs($BALANCE);
											}
											$SUMDR_BALANCE+=$DR_BALANCE;
											$SUMCR_BALANCE+=$CR_BALANCE;
											
											array_push($valarr,$res_dr_data["GROUPNAME"]);
											array_push($valarr, number_format((float)$res_dr_data["DROPEN"], 2, '.', ''));
											array_push($valarr, number_format((float)$crArr[$idx]["CROPEN"], 2, '.', ''));
											array_push($valarr, number_format((float)$res_dr_data["DRAMOUNT"], 2, '.', ''));
											array_push($valarr, number_format((float)$crArr[$idx]["CRAMOUNT"], 2, '.', ''));
											array_push($valarr, number_format((float)$DR_BALANCE, 2, '.', ''));
											array_push($valarr, number_format((float)$CR_BALANCE, 2, '.', ''));
											echo implode("\t", $valarr) . "\r\n";
											$idx++;
										}
										
											$valarr = array();
											array_push($valarr,"Total:");
											array_push($valarr,number_format((float)$DR_open, 2, '.', ''));
											array_push($valarr,number_format((float)$CR_open, 2, '.', ''));
											array_push($valarr,number_format((float)$DR_AMT, 2, '.', ''));
											array_push($valarr,number_format((float)$CR_AMT, 2, '.', ''));
											array_push($valarr,number_format((float)$SUMDR_BALANCE, 2, '.', ''));
											array_push($valarr,number_format((float)$SUMCR_BALANCE, 2, '.', ''));
										echo implode("\t", $valarr) . "\r\n";				
			}
			elseif($Arr[0] == 'trialbalance')
			{
				$TrialDrArr = Array();
				array_push($TrialDrArr,"L.LEDGERID");
				array_push($TrialDrArr,"L.LEDGERNAME");
				array_push($TrialDrArr,"SUM(ODR.AMOUNT) AS DROPEN");
				array_push($TrialDrArr,"SUM(DR.AMOUNT) AS DRAMOUNT");
				
				$TrialCrArr = Array();
				array_push($TrialCrArr,"L.LEDGERID");
				array_push($TrialCrArr,"L.LEDGERNAME");
				array_push($TrialCrArr,"SUM(OCR.AMOUNT) AS CROPEN");
				array_push($TrialCrArr,"SUM(CR.AMOUNT) AS CRAMOUNT");

				$res_dr = getData(LEDGER,$TrialDrArr," AS L LEFT JOIN ". LEDGER_DEBIT ." AS ODR on ODR.LEDGERID=L.LEDGERID AND ODR.VOUCHERTYPE ='Opening' LEFT JOIN ". LEDGER_DEBIT ." AS DR on DR.LEDGERID=L.LEDGERID AND DR.VOUCHERTYPE !='Opening' GROUP BY L.LEDGERID");
				$res_dr_data = mysqli_num_rows($res_dr);
				
				$res_cr = getData(LEDGER,$TrialCrArr," AS L LEFT JOIN ". LEDGER_CREDIT ." AS OCR on OCR.LEDGERID=L.LEDGERID AND OCR.VOUCHERTYPE ='Opening' LEFT JOIN ". LEDGER_CREDIT ." AS CR on CR.LEDGERID=L.LEDGERID AND CR.VOUCHERTYPE !='Opening' GROUP BY L.LEDGERID");
				$res_cr_data = mysqli_num_rows($res_cr);
				$SRNO_CNT=1;
							$DR_AMT=0;
							$CR_AMT=0;
							$DR_open=0;
							$CR_open=0;
							$SUMDR_BALANCE=0;
							$SUMCR_BALANCE=0;
							$crArr = array();
							while($res_cr_data = mysqli_fetch_assoc($res_cr))
							{
								array_push($crArr,$res_cr_data);
							}
							
								$idx = 0;
								
								while($res_dr_data = mysqli_fetch_assoc($res_dr))
										{
											$valarr = array();
											$classname = ($SRNO_CNT / 2) == 0 ? 'odd gradeX' :'even gradeC';
											$DR_open += $res_dr_data["DROPEN"];
											$CR_open += $crArr[$idx]["CROPEN"];
											$DR_AMT += $res_dr_data["DRAMOUNT"];
											$CR_AMT += $crArr[$idx]["CRAMOUNT"];
											$BALANCE = ($res_dr_data["DROPEN"] + $res_dr_data["DRAMOUNT"]) - ($crArr[$idx]["CRAMOUNT"]);
											$DR_BALANCE=0;
											$CR_BALANCE=0;
											if($BALANCE > 0)
											{
												
												$DR_BALANCE = $BALANCE;
												$CR_BALANCE = 0;
											}
											elseif($BALANCE < 0)
											{
												$DR_BALANCE = 0;
												$CR_BALANCE = abs($BALANCE);
											}
											$SUMDR_BALANCE+=$DR_BALANCE;
											$SUMCR_BALANCE+=$CR_BALANCE;
											
											array_push($valarr,$res_dr_data["LEDGERNAME"]);
											array_push($valarr, number_format((float)$res_dr_data["DROPEN"], 2, '.', ''));
											array_push($valarr, number_format((float)$crArr[$idx]["CROPEN"], 2, '.', ''));
											array_push($valarr, number_format((float)$res_dr_data["DRAMOUNT"], 2, '.', ''));
											array_push($valarr, number_format((float)$crArr[$idx]["CRAMOUNT"], 2, '.', ''));
											array_push($valarr, number_format((float)$DR_BALANCE, 2, '.', ''));
											array_push($valarr, number_format((float)$CR_BALANCE, 2, '.', ''));
											echo implode("\t", $valarr) . "\r\n";
											$idx++;
										}
										
										$valarr = array();
											array_push($valarr,"Total:");
											array_push($valarr,number_format((float)$DR_open, 2, '.', ''));
											array_push($valarr,number_format((float)$CR_open, 2, '.', ''));
											array_push($valarr,number_format((float)$DR_AMT, 2, '.', ''));
											array_push($valarr,number_format((float)$CR_AMT, 2, '.', ''));
											array_push($valarr,number_format((float)$SUMDR_BALANCE, 2, '.', ''));
											array_push($valarr,number_format((float)$SUMCR_BALANCE, 2, '.', ''));
										echo implode("\t", $valarr) . "\r\n";				
			}
			elseif(count($Arr) >= 2  &&  $Arr[1] == 'p')
			{
			
				$COND = " AND OPENSTATUS=0";
				if(isset($_GET["frmdate"]) && isset($_GET["tdate"]))
				{
					$dtfrm = $_GET["frmdate"];
					$dtto = $_GET["tdate"];
					$COND = " AND DATE_FORMAT(VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'";
				}
				
				$resprod = getData(PURCHASESALE,$ProductFieldArr," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' ".$COND);
				
				while($row = mysqli_fetch_array($resprod))
					{
						$GRANDAMOUNT = $row["LASTAMOUNT"];
						$ledid = getFieldDetail(PURCHASESALE,"LEDGERID"," WHERE VOUCHERTYPE='Purchase' AND ID='".$row["ID"]."'");
						//$paid = getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE VOUCHERNO='".$row["ID"]."' AND IDTYPE='Purchase' AND LEDGERID = '".$ledid."'");
						//$due = $GRANDAMOUNT - $paid;
						$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ',')" ," WHERE LEDGERID='".$ledid."' AND ID='".$row["ID"]."' AND FLAG='0' AND PROCESSTYPE='Purchase'");
						$paid= getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE LEDGERID='".$ledid."'");
						$due=$GRANDAMOUNT-$paid;
						$idx= 0;
						$valarr = array();
						//print_r($ProductFieldArr);
						foreach($ProductFieldArr as $temp)
						{
																
							if($due > 0)
							{
								array_push($valarr,$row[$idx++]);				
							}
											
						}
						if($due> 0)
						{
							array_push($valarr,$paid);
							array_push($valarr,$due);
						}
						array_push($valarr,$BARCODENO);
						echo implode("\t", $valarr) . "\r\n";
					}
					
			}
			elseif(count($Arr) >= 2  && $Arr[1] == 's' )
			{
			
				$COND = "";
				if(isset($_GET["frmdate"]) && isset($_GET["tdate"]))
				{
					$dtfrm = $_GET["frmdate"];
					$dtto = $_GET["tdate"];
					$COND = " AND DATE_FORMAT(VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'";
				}
				$resprod = getData(PURCHASESALE,$ProductFieldArr," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Sale'".$COND);
				while($row = mysqli_fetch_array($resprod))
					{
						
						$GRANDAMOUNT = $row["LASTAMOUNT"];
						$ledid = getFieldDetail(PURCHASESALE,"LEDGERID"," WHERE VOUCHERTYPE='Sale' AND ID='".$row["ID"]."'");
						$paid = getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)" ," WHERE VOUCHERNO='".$row["ID"]."' AND IDTYPE='Sale' AND LEDGERID = '".$ledid."'");
						
						$BARCODENO = getFieldDetail(BARCODE_PROCESS,"GROUP_CONCAT(DISTINCT BARCODENO ORDER BY BARCODENO SEPARATOR ',')" ," WHERE LEDGERID='".$ledid."' AND ID='".$row["ID"]."' AND FLAG='0' AND PROCESSTYPE='Sale'");$due = $GRANDAMOUNT - $paid;
						
						$idx= 0;
						$valarr = array();
						foreach($ProductFieldArr as $temp)
						{
							if($due> 0)
							{
								array_push($valarr,$row[$idx++]);				
							}
											
						}
						if($due> 0)
						{
							array_push($valarr,$paid);
							array_push($valarr,$due);
						}
						array_push($valarr,$BARCODENO);
						echo implode("\t", $valarr) . "\r\n";
					}
				
						
			}
			elseif($Arr[0] == 'rapnet')
			{
				$_barcheckbox_arr = isset($_POST["SELECT"]) ? $_POST["SELECT"] : array();
				$_barcheckboxstr = count($_barcheckbox_arr) == 0  ? "" : " and BP.BARCODENO IN ('".implode("','", $_barcheckbox_arr)."')";
								
				//$_bararr = $_POST["PURBARCODETEXT"];
				$resprod = getData(BARCODE_PROCESS,$ProductFieldArr," AS BP WHERE BP.PROCESSTYPE IN ('Purchase','Memo Issue','Memo Receive','Repair Issue','Repair Receive','Grading Issue','Grading Result','Grading Receive') ".$_barcheckboxstr." and BP.ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) ORDER BY CAST(SUBSTR(BP.BARCODENO,2) AS UNSIGNED)");
								
				while($row = mysqli_fetch_array($resprod))
				{
					$idx=0;
					$valarr = array();
					foreach($ProductFieldArr as $temp)
					{
						array_push($valarr,$row[$idx++]);
										
					}
					echo implode("\t", $valarr) . "\r\n";
				}	
							
			}
			elseif($Arr[0] == 'sale-stock')
			{
				$_bararr = $_POST["SALEBARCODETEXT"];
				$resprod = getData(BARCODE_PROCESS,$ProductFieldArr," AS BP INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID INNER JOIN ". PURCHASESALE ." AS P ON P.ID=BP.ID AND P.VOUCHERTYPE='Sale' WHERE BP.BARCODENO IN (".$_bararr.") AND BP.PROCESSTYPE='Sale'");
				while($row = mysqli_fetch_array($resprod))
				{
					$idx=0;
					$valarr = array();
					foreach($ProductFieldArr as $temp)
					{
					
						array_push($valarr,$row[$idx++]);				
					}
				
					array_push($valarr,($row[19]-$row[20]));
					
					echo implode("\t", $valarr) . "\r\n";
				}		
			}
			elseif(count($Arr) >= 2  && $Arr[1] == 'pe')
			{
			
				$COND = " AND OPENSTATUS=0";
				if(isset($_GET["frmdate"]) && isset($_GET["tdate"]))
				{
					$dtfrm = $_GET["frmdate"];
					$dtto = $_GET["tdate"];
					$COND = " AND DATE_FORMAT(VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'";
				}
				$resprod = getData(PURCHASESALE,$ProductFieldArr," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Purchase' ".$COND);
				while($row = mysqli_fetch_array($resprod))
					{
						$finaltotal = $row["FINALTOTAL"];
						$ledid = getFieldDetail(PURCHASESALE,"LEDGERID"," WHERE VOUCHERTYPE='Purchase' AND ID='".$row["ID"]."'");
						$paid = getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)" ," WHERE VOUCHERNO='".$row["ID"]."' AND IDTYPE='Purchase' AND LEDGERID = '".$ledid."'");
						$due = $finaltotal - $paid;
						
						$idx= 0;
						$valarr = array();
						foreach($ProductFieldArr as $temp)
						{
																
							array_push($valarr,$row[$idx++]);	
											
						}
						array_push($valarr,$paid);
						array_push($valarr,$due);
						echo implode("\t", $valarr) . "\r\n";
					}
					
			}
			elseif(count($Arr) >= 2  && $Arr[1] == 'se')
			{
			
				$COND = "";
				if(isset($_GET["frmdate"]) && isset($_GET["tdate"]))
				{
					$dtfrm = $_GET["frmdate"];
					$dtto = $_GET["tdate"];
					$COND = " AND DATE_FORMAT(VOUCHERDATE,'%Y-%m-%d') BETWEEN '".$dtfrm."' AND '". $dtto ."'";
				}
				$resprod = getData(PURCHASESALE,$ProductFieldArr," AS P INNER JOIN ".LEDGER." AS L ON L.LEDGERID=P.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=P.BROKERID WHERE P.FLAG='0' AND VOUCHERTYPE='Sale'".$COND);
				while($row = mysqli_fetch_array($resprod))
					{
						$finaltotal = $row["FINALTOTAL"];
						$ledid = getFieldDetail(PURCHASESALE,"LEDGERID"," WHERE VOUCHERTYPE='Sale' AND ID='".$row["ID"]."'");
						$paid = getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)" ," WHERE VOUCHERNO='".$row["ID"]."' AND IDTYPE='Sale' AND LEDGERID = '".$ledid."'");
						$due = $finaltotal - $paid;
						
						$idx= 0;
						$valarr = array();
						foreach($ProductFieldArr as $temp)
						{
							array_push($valarr,$row[$idx++]);
											
						}
						array_push($valarr,$paid);
						array_push($valarr,$due);
						echo implode("\t", $valarr) . "\r\n";
					}
				
						
			}
			elseif($Arr[0] == 'export')
			{
					
			
			$res_EXPORT = getData(EXPORTDIAMOND,$AllArr," WHERE ID='".$ID."' AND PROCESSTYPE='Export Diamond'");
			$SUMRAP=0;
			$SUMWEIGHT=0;
			while($res_EXPORTData =  mysqli_fetch_assoc($res_EXPORT))
			{
				$SUMRAP += $res_EXPORTData["TOTALDOLLAR"];
				$SUMWEIGHT += $res_EXPORTData["WEIGHT"];
				$FieldValueArr = array();
				array_push($FieldValueArr,"WH.RD");
				array_push($FieldValueArr,$res_EXPORTData["WEIGHT"]);
				array_push($FieldValueArr,$res_EXPORTData["COLOR"]);
				array_push($FieldValueArr,$res_EXPORTData["CLARITY"]);
				array_push($FieldValueArr,$res_EXPORTData["PERCRTDOLLAR"]);
				array_push($FieldValueArr,$res_EXPORTData["TOTALDOLLAR"]);
				array_push($FieldValueArr,$res_EXPORTData["CERTIFICATENO"]);
				echo implode("\t", $FieldValueArr) . "\r\n";
			}
				$FieldValueArr = array();
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,"");
				echo implode("\t", $FieldValueArr) . "\r\n";
				
				$FieldValueArr = array();
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,$SUMWEIGHT);
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,"");
				array_push($FieldValueArr,$SUMRAP);
				array_push($FieldValueArr,"");
				echo implode("\t", $FieldValueArr) . "\r\n";
				
				$FieldValueArr = array();
				array_push($FieldValueArr,"MISS YU 60201326");
				echo implode("\t", $FieldValueArr) . "\r\n";
				$FieldValueArr = array();
				array_push($FieldValueArr,"MS KHUSHI 63749491");
				echo implode("\t", $FieldValueArr) . "\r\n";
				
			}
			elseif($Arr[0] == 'cashregisterhkaavak')
			{
							
				$resdr = getData(CASHREGISTER,$ProductFieldArr," WHERE FLAG='0' and VTYPE='HK-Receipt'  ORDER BY VDATE");
								
				while($row = mysqli_fetch_array($resdr))
				{
					$idx=0;
					$valarr = array();
					foreach($ProductFieldArr as $temp)
					{
						array_push($valarr,$row[$idx++]);
										
					}
					echo implode("\t", $valarr) . "\r\n";
				}				
			}
			else
			{
				
				if(isset($_GET["ledgerid"]))
				{
					
					$COND = " AND LEDGERID='".$_GET["ledgerid"]."'";
					/*$valarr = array();
					array_push($valarr,getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID='".$_GET["ledgerid"]."'"));	
					echo implode("\t", $valarr) . "\r\n";*/
				}
				else
				{
					$COND = " AND ID='".$ID."'";
				}

				$resprod = getData(BARCODE_PROCESS,$ProductFieldArr," WHERE PROCESSTYPE='".$XLSID."'".$COND);
						while($row = mysqli_fetch_assoc($resprod))
						{
							$valarr = array();
							foreach($ProductFieldArr as $temp)
							{
								array_push($valarr,$row[$temp]);				
							}
							echo implode("\t", $valarr) . "\r\n";
						}	
						
			}
			exit();
	
?>
<script>
window.location.href='<?php echo SITEURL."?".$XLSID;?>';
</script>
<?php

?>