<?php

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
	array_push($FieldArr,"PS.PARTNERSTATUS");
	array_push($FieldArr,"PS.PARTNERPER");
	
	$BARCODENOSEARCH = isset($_POST["STOCKIDSEARCH"]) && !empty($_POST["STOCKIDSEARCH"])? " AND (BARCODENO='GP".$_POST["STOCKIDSEARCH"]."' OR CERTIFICATENO='".$_POST["STOCKIDSEARCH"]."' )" : '';
	$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID WHERE BP.FLAG='0' AND BP.PROCESSTYPE='Sale' " .$BARCODENOSEARCH ." ORDER BY PS.VOUCHERDATE DESC ");
		
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Sale Detail";
	$res = getData(PURCHASESALE,$AllArr," WHERE ID='0' AND VOUCHERTYPE='Sale'");
	$resdata = mysqli_fetch_assoc($res);	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$ID = $_GET["_mid"];
	
	$Caption = "Edit Sale Detail";
	$res = getData(PURCHASESALE,$AllArr," WHERE ID='".$ID."'");
	$resdata = mysqli_fetch_assoc($res);	
	
}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$ID = $_GET["_rid"];
	deleteData(PURCHASESALE," where ID='".$ID."' AND VOUCHERTYPE='Sale'");
	deleteData(BARCODE_PROCESS," where ID='".$ID."' AND PROCESSTYPE='Sale'");
	
	deleteData(LEDGER_DEBIT," WHERE VOUCHERNO IN (".$DeleteString.") AND VOUCHERTYPE='Sale' AND BROKERSTATUS='Y'");
	deleteData(LEDGER_CREDIT," WHERE VOUCHERNO IN (".$DeleteString.") AND VOUCHERTYPE='Sale' AND BROKERSTATUS='Y'");
	
	deleteData(LEDGER_CREDIT ," WHERE VOUCHERNO ='".$ID."' AND VOUCHERTYPE IN ('Sale','Tax Out','TCS Out')");
	deleteData(LEDGER_DEBIT," WHERE VOUCHERNO ='".$ID."' AND VOUCHERTYPE='Sale'");
	
	
	
	?>
	<script>
		window.location.href="<?php echo SITEURL."?sale&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]) || isset($_POST["search"]))
{
	$action = "view";
}

if(isset($_POST["sale"]))
{
	
	$ID = $_POST["ID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	

	foreach($PostArr_Key as $tempctrl)
	{
		$colname_prefix = substr($tempctrl,0,3);
		$colname = substr($tempctrl,3);
		if(substr($tempctrl,strlen($tempctrl)-1,1) != "_")
		{
			switch($colname_prefix)
			{
				case "txt":
					array_push($FieldArr_Col,$colname);
					array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");
				break;
				case "dtp":
							
					array_push($FieldArr_Col,$colname);
					array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");
				break;
				case "rad":
					
					array_push($FieldArr_Col,$colname);
					array_push($FieldArr_Val,"'".(isset($_POST[$tempctrl])? $_POST[$tempctrl] : '')."'");
					
				break;
			}
		}
	}
	
	array_push($FieldArr_Col,"CONVSTATUS");
	array_push($FieldArr_Val,"'".(isset($_POST["chkCONVSTATUS"]) ?"Y":"N")."'");
	
	$RMBSTATUS = isset($_POST["chkRMBSTATUS"]) ?"Y":"N";
	array_push($FieldArr_Col,"RMBSTATUS");
	array_push($FieldArr_Val,"'".$RMBSTATUS."'");
	
	$PARTNERSTATUS = isset($_POST["chkPARTNERSTATUS"]) ?"Y":"N";
	array_push($FieldArr_Col,"PARTNERSTATUS");
	array_push($FieldArr_Val,"'".$PARTNERSTATUS."'");
	
	array_push($FieldArr_Col,"VOUCHERTYPE");
	array_push($FieldArr_Val,"'Sale'");
	array_push($FieldArr_Col,"UPDATEDATE");
	array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
	array_push($FieldArr_Col,"USERNAME");
	array_push($FieldArr_Val,"'".$loginuser_name."'");
	array_push($FieldArr_Col,"FLAG");
	array_push($FieldArr_Val,"'0'");
	array_push($FieldArr_Col,"TRANCONVRATE");
	array_push($FieldArr_Val,"'".$_POST["txtCONVRATE"]."'");
	
	$RMBDOLSTATUS = isset($_POST["chkRMBSTATUS"]) ?"1":"0";
	array_push($FieldArr_Col,"RMBDOLSTATUS");
	array_push($FieldArr_Val,"".$RMBDOLSTATUS."");
	
	$PAYMENTSTATUS = isset($_POST["chkPAYMENTSTATUS"]) ?"1":"0";
	array_push($FieldArr_Col,"PAYMENTSTATUS");
	array_push($FieldArr_Val,"".$PAYMENTSTATUS."");
	
	$Condition = " WHERE ID='". $ID ."' AND VOUCHERTYPE='Sale' ORDER BY VOUCHERDATE DESC";
	
	$reccnt = getFieldDetail(PURCHASESALE,"count(*)"," WHERE ID='". $ID ."' AND VOUCHERTYPE='Sale'");
	$reccnt_Ledger = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Sale' ORDER BY VOUCHERDATE DESC");
	$reccnt_Broker_Ledger = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Sale' AND BROKERSTATUS='Y' ORDER BY VOUCHERDATE DESC");
	
	$cnt_igst = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Tax Out' AND LEDGERID='" . IGSTOUT . "'");
	$cnt_cgst = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Tax Out' AND LEDGERID='" . CGSTOUT . "'");
	$cnt_sgst = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Tax Out' AND LEDGERID='" . SGSTOUT . "'");
	$cnt_tcs = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='TCS Out' AND LEDGERID='" . TCSOUT . "'");
	
	if ($reccnt == 0)
	{
	
		array_push($FieldArr_Col,"ENTRYDATE");
		array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
		$ID = newData($FieldArr_Col,$FieldArr_Val,PURCHASESALE,TRUE);	
	}
	else
	{
		editData($FieldArr_Col,$FieldArr_Val,PURCHASESALE,$Condition);
	}		
	
	
	$idx = 0;
	
	$Barcode_Arr = $_POST["BARCODENO"];

	foreach ($Barcode_Arr as $Barcode)
	{
			
		$FieldBarcode= array();
		$ValueBarcode= array();
		
		
		array_push($FieldBarcode,"PCS");
		array_push($FieldBarcode,"LAB");
		array_push($FieldBarcode,"CERTIFICATENO");
		array_push($FieldBarcode,"WEIGHT");
		array_push($FieldBarcode,"SHAPE");
		array_push($FieldBarcode,"COLOR");
		array_push($FieldBarcode,"CLARITY");
		array_push($FieldBarcode,"CUT");
		array_push($FieldBarcode,"POLISH");
		array_push($FieldBarcode,"SYMM");
		array_push($FieldBarcode,"FLOURANCE");
		array_push($FieldBarcode,"BGM");
		array_push($FieldBarcode,"RATE");
		array_push($FieldBarcode,"DISCPER");
		array_push($FieldBarcode,"RATEDOLLAR");
		array_push($FieldBarcode,"DISC2PER");
		array_push($FieldBarcode,"DISC3PER");
		array_push($FieldBarcode,"PERCRTDOLLAR");
		array_push($FieldBarcode,"TOTALDOLLAR");
		array_push($FieldBarcode,"RSPERCRT");
		array_push($FieldBarcode,"RSAMOUNT");
		array_push($FieldBarcode,"RMBAMOUNT");
		
		
		$reccnt = getFieldDetail(BARCODE_PROCESS,"count(*)"," WHERE ID='". $ID ."' AND BARCODENO='".$Barcode."' AND PROCESSTYPE='Sale' ORDER BY VOUCHERDATE DESC");
		if ($reccnt == 0)
		{
			
			$cnt_idx = substr($Barcode,2);
			foreach($FieldBarcode as $Field)
			{
				array_push($ValueBarcode,"'".$_POST[$Field.$cnt_idx]."'");
			
			}
			
			$PARTNERPER = 100-$_POST["txtPARTNERPER"];
			$STOCKIDVALUE = ($_POST["RSAMOUNT".$cnt_idx]* $PARTNERPER)/100;
			
			array_push($FieldBarcode,"STOCKIDVALUE");
			array_push($ValueBarcode,"'".$STOCKIDVALUE."'");
			array_push($FieldBarcode,"PARTNERPER");
			array_push($ValueBarcode,"'".$_POST["txtPARTNERPER"]."'");
			array_push($FieldBarcode,"PARTNERLEDGERID");
			array_push($ValueBarcode,"'".$_POST["txtPARTNERID"]."'");
			
			
			array_push($FieldBarcode,"BARCODENO");
			array_push($ValueBarcode,"'". $Barcode ."'");
			array_push($FieldBarcode,"PROCESSTYPE");
			array_push($ValueBarcode,"'Sale'");
			array_push($FieldBarcode,"ID");
			array_push($ValueBarcode,"'". $ID ."'");
			array_push($FieldBarcode,"LEDGERID");
			array_push($ValueBarcode,"'". $_POST["txtLEDGERID"] ."'");
			array_push($FieldBarcode,"BROKERID");
			array_push($ValueBarcode,"'". $_POST["txtBROKERID"] ."'");
			array_push($FieldBarcode,"CONVRATE");
			array_push($ValueBarcode,"'". $_POST["txtCONVRATE"] ."'");
			array_push($FieldBarcode,"RMBRATE");
			array_push($ValueBarcode,"'". $_POST["txtRMBRATE"] ."'");	
			array_push($FieldBarcode,"BROKERPER");
			array_push($ValueBarcode,"'". $_POST["txtDALALIPER"] ."'");				
			array_push($FieldBarcode,"IGSTPER");
			array_push($ValueBarcode,"'". $_POST["txtIGSTPER"] ."'");
			array_push($FieldBarcode,"TCSPER");
			array_push($ValueBarcode,"'". $_POST["txtTCSPER"] ."'");
			array_push($FieldBarcode,"REMARK");	
			array_push($ValueBarcode,"'". $_POST["txtREMARK"] ."'");				
			array_push($FieldBarcode,"UPDATEDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldBarcode,"FLAG");
			array_push($ValueBarcode,"'0'");
			array_push($FieldBarcode,"USERNAME");
			array_push($ValueBarcode,"'".$loginuser_name."'");
			
			array_push($FieldBarcode,"ENTRYDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldBarcode,"BILLSTATUS");
			array_push($ValueBarcode,"'".(isset($_POST["radBILLSTATUS"]) ? $_POST["radBILLSTATUS"] : '')."'");
			array_push($FieldBarcode,"LOCATIONNAME");
			array_push($ValueBarcode,"'".$_POST["txtLOCATIONNAME"]."'");
			//ADD VDATE
			array_push($FieldBarcode,"VDATE");
			array_push($ValueBarcode,"'".$_POST["dtpVOUCHERDATE"]."'");
			$ENTRYID = newData($FieldBarcode,$ValueBarcode,BARCODE_PROCESS,TRUE);
//EXIT();			
		}
		else
		{
			$cnt_idx = substr($Barcode,2);
			foreach($FieldBarcode as $Field)
			{
				array_push($ValueBarcode,"'".$_POST[$Field.$cnt_idx]."'");
			}
			
			$PARTNERPER = 100-$_POST["txtPARTNERPER"];
			$STOCKIDVALUE = ($_POST["RSAMOUNT".$cnt_idx]* $PARTNERPER)/100;
			
			array_push($FieldBarcode,"STOCKIDVALUE");
			array_push($ValueBarcode,"'".$STOCKIDVALUE."'");
			array_push($FieldBarcode,"PARTNERPER");
			array_push($ValueBarcode,"'".$_POST["txtPARTNERPER"]."'");
			array_push($FieldBarcode,"PARTNERLEDGERID");
			array_push($ValueBarcode,"'".$_POST["txtPARTNERID"]."'");
			
			array_push($FieldBarcode,"BARCODENO");
			array_push($ValueBarcode,"'". $Barcode ."'");
			array_push($FieldBarcode,"PROCESSTYPE");
			array_push($ValueBarcode,"'Sale'");
			array_push($FieldBarcode,"ID");
			array_push($ValueBarcode,"'". $ID ."'");
			array_push($FieldBarcode,"LEDGERID");
			array_push($ValueBarcode,"'". $_POST["txtLEDGERID"] ."'");
			array_push($FieldBarcode,"BROKERID");
			array_push($ValueBarcode,"'". $_POST["txtBROKERID"] ."'");
			array_push($FieldBarcode,"CONVRATE");
			array_push($ValueBarcode,"'". $_POST["txtCONVRATE"] ."'");	
			array_push($FieldBarcode,"BROKERPER");
			array_push($ValueBarcode,"'". $_POST["txtDALALIPER"] ."'");	
			array_push($FieldBarcode,"IGSTPER");
			array_push($ValueBarcode,"'". $_POST["txtIGSTPER"] ."'");
			array_push($FieldBarcode,"TCSPER");
			array_push($ValueBarcode,"'". $_POST["txtTCSPER"] ."'");
			array_push($FieldBarcode,"REMARK");	
			array_push($ValueBarcode,"'". $_POST["txtREMARK"] ."'");				
			array_push($FieldBarcode,"UPDATEDATE");
			array_push($ValueBarcode,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldBarcode,"FLAG");
			array_push($ValueBarcode,"'0'");
			array_push($FieldBarcode,"USERNAME");
			array_push($ValueBarcode,"'".$loginuser_name."'");
			array_push($FieldBarcode,"BILLSTATUS");
			array_push($ValueBarcode,"'".(isset($_POST["radBILLSTATUS"]) ? $_POST["radBILLSTATUS"] : '')."'");
			array_push($FieldBarcode,"LOCATIONNAME");
			array_push($ValueBarcode,"'".$_POST["txtLOCATIONNAME"]."'");
		//ADD VDATE
			array_push($FieldBarcode,"VDATE");
			array_push($ValueBarcode,"'".$_POST["dtpVOUCHERDATE"]."'");
			editData($FieldBarcode,$ValueBarcode,BARCODE_PROCESS," WHERE ID='". $ID ."' AND BARCODENO='".$Barcode."' AND PROCESSTYPE='Sale' ORDER BY VOUCHERDATE DESC");
		}		
	}
	
	
		if($reccnt_Ledger== 0)
		{
			$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
		}
		else
		{
			$SRNO = $_POST["SRNO"];
		}
		
		$tranFieldArr= array();
		$tranValueArr= array();
		array_push($tranFieldArr,"SRNO");
		array_push($tranFieldArr,"VOUCHERNO");
		array_push($tranFieldArr,"VOUCHERTYPE");
		array_push($tranFieldArr,"LEDGERID");
		array_push($tranFieldArr,"AMOUNT");
		array_push($tranFieldArr,"DESCRIPTION");
		array_push($tranFieldArr,"VOUCHERDATE");
		array_push($tranFieldArr,"UPDATEDATE");
		array_push($tranFieldArr,"USERNAME");
		array_push($tranFieldArr,"CONVRATE");
		array_push($tranFieldArr,"AMOUNTDOLLAR");
		array_push($tranFieldArr,"GROUPID");
		array_push($tranFieldArr,"BILLSTATUS");
		array_push($tranFieldArr,"RMBDOLSTATUS");
		array_push($tranFieldArr,"RMBRATE");
		array_push($tranFieldArr,"RMBAMOUNT");
	
		array_push($tranValueArr,"'".$SRNO."'");
		array_push($tranValueArr,"'".$ID."'");
		array_push($tranValueArr,"'Sale'");
		array_push($tranValueArr,"'".$_POST["txtLEDGERID"]."'");
		array_push($tranValueArr,"'".$_POST["txtLASTAMOUNT"]."'"); //$_POST["txtLASTAMOUNT"]
		array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
		array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranValueArr,"'".$loginuser_name."'");
		array_push($tranValueArr,"'".$_POST["txtCONVRATE"]."'");
		array_push($tranValueArr,"'".$_POST["txtTOTALDOLLAR"]."'");
		array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$_POST["txtLEDGERID"]."'")."'");
		array_push($tranValueArr,"'".(isset($_POST["radBILLSTATUS"]) ? $_POST["radBILLSTATUS"] : '')."'");
		array_push($tranValueArr,"".$RMBDOLSTATUS."");
		array_push($tranValueArr,"'".$_POST["txtRMBRATE"]."'");
		array_push($tranValueArr,"'".$_POST["txtTOTALRMBAMOUNT"]."'");
		
		if ($reccnt_Ledger == 0)
		{
			array_push($tranFieldArr,"ENTRYDATE");
			array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
			newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
			$tranValueArr[3] = "'".SALAC."'";
			$tranValueArr[4] = "'".round($_POST["txtFINALTOTAL"])."'";
			$tranValueArr[11] = "'".SALGBP."'";
			newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);		
		}
		else
		{
			$Condition = " WHERE VOUCHERTYPE='Sale' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."' ORDER BY VOUCHERDATE DESC";			
			editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT,$Condition);
			$tranValueArr[3] = "'".SALAC."'";
			$tranValueArr[4] = "'". round($_POST["txtFINALTOTAL"]) ."'"; // $_POST["txtFINALTOTAL"]
			$tranValueArr[11] = "'".SALGBP."'";
			editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT,$Condition);			
		}	
		
		
		//=================================================TAX OUT DEBIT==============================================
		$tranTAXFieldArr= array();
		$tranTAXValueArr= array();
		array_push($tranTAXFieldArr,"SRNO");
		array_push($tranTAXFieldArr,"VOUCHERNO");
		array_push($tranTAXFieldArr,"VOUCHERTYPE");
		array_push($tranTAXFieldArr,"LEDGERID");
		array_push($tranTAXFieldArr,"AMOUNT");
		array_push($tranTAXFieldArr,"DESCRIPTION");
		array_push($tranTAXFieldArr,"VOUCHERDATE");
		array_push($tranTAXFieldArr,"UPDATEDATE");
		array_push($tranTAXFieldArr,"USERNAME");
		array_push($tranTAXFieldArr,"CONVRATE");
		array_push($tranTAXFieldArr,"AMOUNTDOLLAR");
		array_push($tranTAXFieldArr,"GROUPID");
		array_push($tranTAXFieldArr,"BILLSTATUS");
		
		array_push($tranTAXValueArr,"'".$SRNO."'");
		array_push($tranTAXValueArr,"'".$ID."'");
		array_push($tranTAXValueArr,"'Tax Out'");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"'".$_POST["txtREMARK"]."'");
		array_push($tranTAXValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
		array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranTAXValueArr,"'".$loginuser_name."'");
		array_push($tranTAXValueArr,"'".$_POST["txtCONVRATE"]."'");
		array_push($tranTAXValueArr,"'".$_POST["txtTOTALDOLLAR"]."'");
		array_push($tranTAXValueArr,"''");
		array_push($tranTAXValueArr,"'".(isset($_POST["radBILLSTATUS"]) ? $_POST["radBILLSTATUS"] : '')."'");
		
		//==========================IGST====================================
		if($_POST["txtIGSTAMT"] > 0)
		{
			if ($cnt_igst == 0)
			{
				$tranTAXValueArr[3] = "'".IGSTOUT."'";
				$tranTAXValueArr[4] = "'".round($_POST["txtIGSTAMT"])."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				array_push($tranTAXFieldArr,"ENTRYDATE");
				array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");			
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".IGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."' ORDER BY VOUCHERDATE DESC";			
				$tranTAXValueArr[3] = "'".IGSTOUT."'";
				$tranTAXValueArr[4] = "'".round($_POST["txtIGSTAMT"])."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT,$Condition);			
			}	
		}
		else
		{
			 $Condition = " WHERE LEDGERID='".IGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."' ORDER BY VOUCHERDATE DESC ";		
			 deleteData(LEDGER_CREDIT,$Condition);
		}
		
		//==========================CGST====================================
		if($_POST["txtCGSTAMT"] > 0)
		{
			if ($cnt_cgst == 0)
			{
				$tranTAXValueArr[3] = "'".CGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtCGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				array_push($tranTAXFieldArr,"ENTRYDATE");
				array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");			
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".CGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."' ORDER BY VOUCHERDATE DESC";			
				$tranTAXValueArr[3] = "'".CGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtCGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT,$Condition);			
			}	
		}
		else
		{
			 $Condition = " WHERE LEDGERID='".CGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."' ORDER BY VOUCHERDATE DESC";		
			 deleteData(LEDGER_CREDIT,$Condition);
		}
		//==========================SGST====================================
		if($_POST["txtSGSTAMT"] > 0)
		{
			if ($cnt_sgst == 0)
			{
				$tranTAXValueArr[3] = "'".SGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtSGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
					
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".SGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."' ORDER BY VOUCHERDATE DESC";			
				$tranTAXValueArr[3] = "'".SGSTOUT."'";
				$tranTAXValueArr[4] = "'".$_POST["txtSGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_CREDIT,$Condition);			
			}	
		}
		else
		{
			 $Condition = " WHERE LEDGERID='".SGSTOUT."' AND VOUCHERTYPE='Tax Out' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."' ORDER BY VOUCHERDATE DESC";		
			 deleteData(LEDGER_CREDIT,$Condition);
		}
		$tranTCSFieldArr= array();
		$tranTCSValueArr= array();
		array_push($tranTCSFieldArr,"SRNO");
		array_push($tranTCSFieldArr,"VOUCHERNO");
		array_push($tranTCSFieldArr,"VOUCHERTYPE");
		array_push($tranTCSFieldArr,"LEDGERID");
		array_push($tranTCSFieldArr,"AMOUNT");
		array_push($tranTCSFieldArr,"DESCRIPTION");
		array_push($tranTCSFieldArr,"VOUCHERDATE");
		array_push($tranTCSFieldArr,"UPDATEDATE");
		array_push($tranTCSFieldArr,"USERNAME");
		array_push($tranTCSFieldArr,"CONVRATE");
		array_push($tranTCSFieldArr,"AMOUNTDOLLAR");
		array_push($tranTCSFieldArr,"GROUPID");
		array_push($tranTCSFieldArr,"BILLSTATUS");
		
		array_push($tranTCSValueArr,"'".$SRNO."'");
		array_push($tranTCSValueArr,"'".$ID."'");
		array_push($tranTCSValueArr,"'TCS Out'");
		array_push($tranTCSValueArr,"''");
		array_push($tranTCSValueArr,"''");
		array_push($tranTCSValueArr,"'".$_POST["txtREMARK"]."'");
		array_push($tranTCSValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
		array_push($tranTCSValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranTCSValueArr,"'".$loginuser_name."'");
		array_push($tranTCSValueArr,"'".$_POST["txtCONVRATE"]."'");
		array_push($tranTCSValueArr,"'".$_POST["txtTOTALDOLLAR"]."'");
		array_push($tranTCSValueArr,"''");
		array_push($tranTCSValueArr,"'".(isset($_POST["radBILLSTATUS"]) ? $_POST["radBILLSTATUS"] : '')."'");
		//==========================TCS====================================
		if($_POST["txtTCSAMT"] > 0)
		{
			if ($cnt_tcs == 0)
			{
				$tranTCSValueArr[3] = "'".TCSOUT."'";
				$tranTCSValueArr[4] = "'".round($_POST["txtTCSAMT"])."'";
				$tranTCSValueArr[11] = "'".GSTGB."'";
						
				newData($tranTCSFieldArr,$tranTCSValueArr,LEDGER_CREDIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".TCSOUT."' AND VOUCHERTYPE='TCS Out' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";			
				$tranTCSValueArr[3] = "'".TCSOUT."'";
				$tranTCSValueArr[4] = "'".round($_POST["txtTCSAMT"])."'";
				$tranTCSValueArr[11] = "'".GSTGB."'";
				editData($tranTCSFieldArr,$tranTCSValueArr,LEDGER_CREDIT,$Condition);			
			}	
		}
		else
		{
			 $Condition = " WHERE LEDGERID='".TCSOUT."' AND VOUCHERTYPE='TCS Out' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";		
			 deleteData(LEDGER_CREDIT,$Condition);
		}
		
		//==============================BROKER=================================================================================================
		if(isset($_POST["txtBROKERID"]) &&  !empty($_POST["txtBROKERID"]) && isset($_POST["txtBROKERID"]) && $_POST["txtBROKERID"] > 0 )
		{
			
			if($reccnt_Broker_Ledger== 0)
			{
				$BROKERSRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
			}
			else
			{
				$BROKERSRNO = $_POST["BROKERSRNO"];
			}	
			
			$tranFieldArr= array();
			$tranValueArr= array();
			array_push($tranFieldArr,"SRNO");
			array_push($tranFieldArr,"VOUCHERNO");
			array_push($tranFieldArr,"VOUCHERTYPE");
			array_push($tranFieldArr,"LEDGERID");
			array_push($tranFieldArr,"AMOUNT");
			array_push($tranFieldArr,"DESCRIPTION");
			array_push($tranFieldArr,"VOUCHERDATE");
			array_push($tranFieldArr,"UPDATEDATE");
			array_push($tranFieldArr,"USERNAME");
			array_push($tranFieldArr,"CONVRATE");
			array_push($tranFieldArr,"AMOUNTDOLLAR");
			array_push($tranFieldArr,"GROUPID");
			array_push($tranFieldArr,"BILLSTATUS");
			array_push($tranFieldArr,"BROKERSTATUS");
			array_push($tranFieldArr,"RMBDOLSTATUS");
		
			array_push($tranValueArr,"'".$BROKERSRNO."'");
			array_push($tranValueArr,"'".$ID."'");
			array_push($tranValueArr,"'Sale'");
			array_push($tranValueArr,"'".$_POST["txtBROKERID"]."'");
			array_push($tranValueArr,"'".$_POST["txtDALALIAMT"]."'");
			array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
			array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
			array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
			array_push($tranValueArr,"'".$loginuser_name."'");
			array_push($tranValueArr,"'".$_POST["txtCONVRATE"]."'");
			array_push($tranValueArr,"'".($_POST["txtDALALIAMT"] / $_POST["txtCONVRATE"])."'");
			array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$_POST["txtBROKERID"]."'")."'");
			array_push($tranValueArr,"'".$_POST["radBILLSTATUS"]."'");
			array_push($tranValueArr,"'Y'");
			array_push($tranValueArr,"".$RMBDOLSTATUS."");
			
			if ($reccnt_Broker_Ledger == 0)
			{
				array_push($tranFieldArr,"ENTRYDATE");
				array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
				newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
				$tranValueArr[3] = "'".BROKAC."'";
				$tranValueArr[11] = "'".BROKGBP."'";
				newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);		
			}
			else
			{
				$Condition = " WHERE VOUCHERTYPE='Sale' AND SRNO='".$BROKERSRNO."' AND VOUCHERNO='".$ID."'";			
				editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT,$Condition);
				$tranValueArr[3] = "'".BROKAC."'";
				$tranValueArr[11] = "'".BROKGBP."'";
				editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT,$Condition);			
			}	
		}
	//==================================================PAYMENT ENTRY=======================================================
	
	//if(isset($_POST["chkPAYMENTSTATUS"]) == "Y" )
	if(isset($_POST["chkPAYMENTSTATUS"]) == "Y" && isset($_POST["txtBOOKLEDGERID"]) &&  !empty($_POST["txtBOOKLEDGERID"]))
	{
		$tranFieldArr= array();
		$tranValueArr= array();
		array_push($tranFieldArr,"SRNO");
		array_push($tranFieldArr,"VOUCHERNO");
		array_push($tranFieldArr,"VOUCHERTYPE");
		array_push($tranFieldArr,"LEDGERID");
		array_push($tranFieldArr,"GROUPID");
		array_push($tranFieldArr,"AMOUNT");
		array_push($tranFieldArr,"DESCRIPTION");
		array_push($tranFieldArr,"VOUCHERDATE");
		array_push($tranFieldArr,"UPDATEDATE");
		array_push($tranFieldArr,"USERNAME");
		array_push($tranFieldArr,"CONVRATE");
		array_push($tranFieldArr,"AMOUNTDOLLAR");
		array_push($tranFieldArr,"IDTYPE");
		array_push($tranFieldArr,"RMBRATE");
		array_push($tranFieldArr,"RMBAMOUNT");
		
		$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
		$VOUCHERNO = $ID;
		
		
		$VOUCHERTYPE = "Bank Receipt";
		
		$DRLEDGERID = $_POST["txtBOOKLEDGERID"];
		$CRLEDGERID = $_POST["txtLEDGERID"];

		$AMOUNT =isset($_POST["txtLASTAMOUNT"]) ? $_POST["txtLASTAMOUNT"] : 0;

		$AMOUNT_usd =isset($_POST["txtTOTALDOLLAR"]) ? $_POST["txtTOTALDOLLAR"] : 0;
		$AMOUNT_rmb =isset($_POST["txtTOTALRMBAMOUNT"]) ? $_POST["txtTOTALRMBAMOUNT"] : 0;
		
		$conv_usd =isset($_POST["txtCONVRATE"]) ? $_POST["txtCONVRATE"] : 0;
		$conv_rmb =isset($_POST["txtRMBRATE"]) ? $_POST["txtRMBRATE"] : 0;
		
			
		$RMBDOLSTATUS = isset($_POST["chkRMBSTATUS"]) ?"1":"0";
		
		$cond_payment_CR=" WHERE VOUCHERNO='". $ID ."' AND LEDGERID='". $CRLEDGERID ."' AND IDTYPE='Sale'  AND VOUCHERTYPE='Bank Receipt'";
		$cond_payment_DR=" WHERE VOUCHERNO='". $ID ."' AND LEDGERID='". $DRLEDGERID ."' AND IDTYPE='Sale'  AND VOUCHERTYPE='Bank Receipt'";
		$cond_payment_SRNO = 0;
		
		 $reccnt_PAYMENT_dr = getFieldDetail(LEDGER_DEBIT,"count(*)",$cond_payment_DR);
		 $reccnt_PAYMENT_cr = getFieldDetail(LEDGER_DEBIT,"count(*)",$cond_payment_CR);
		if($reccnt_PAYMENT_dr ==0 && $reccnt_PAYMENT_cr ==0)
			{
				$cond_payment_SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
			}
		elseif($reccnt_PAYMENT_dr >=1 && $reccnt_PAYMENT_cr ==0)
			{
				$cond_payment_SRNO = getFieldDetail(LEDGER_DEBIT,"SRNO",$cond_payment_DR);
			}
		elseif($reccnt_PAYMENT_dr ==0&& $reccnt_PAYMENT_cr >=1)
			{
				$cond_payment_SRNO = getFieldDetail(LEDGER_CREDIT,"SRNO",$cond_payment_CR);
			}
		else
			{
				$cond_payment_SRNO = getFieldDetail(LEDGER_CREDIT,"SRNO",$cond_payment_CR);
			}
			
		
		array_push($tranValueArr,"'".$cond_payment_SRNO."'");
		array_push($tranValueArr,"'".$VOUCHERNO."'");
		array_push($tranValueArr,"'Bank Receipt'");
		array_push($tranValueArr,"'".$DRLEDGERID."'");
		array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$DRLEDGERID."'")."'");
		array_push($tranValueArr,"'".$AMOUNT."'");
		//array_push($tranValueArr,"'0'");
		array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
		array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranValueArr,"'".$loginuser_name."'");
		array_push($tranValueArr,"'".$conv_usd."'");
		array_push($tranValueArr,"'".$AMOUNT_usd."'");
		array_push($tranValueArr,"'Sale'");
		array_push($tranValueArr,"'".$conv_rmb."'");
		array_push($tranValueArr,"'".$AMOUNT_rmb."'");
		
		array_push($tranFieldArr,"ENTRYDATE");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
	
	
		$crcount = getFieldDetail(LEDGER_CREDIT,"COUNT(*)"," WHERE SRNO ='".$cond_payment_SRNO."' AND VOUCHERTYPE='Bank Receipt'");
		$drcount = getFieldDetail(LEDGER_DEBIT,"COUNT(*)"," WHERE SRNO ='".$cond_payment_SRNO."' AND VOUCHERTYPE='Bank Receipt'");
		
		
		if($drcount == 0)
		{
			newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
		}
		else
		{
			editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT, $cond_payment_DR);
		}
		
		if($crcount == 0)
		{
			$tranValueArr[3] = "'".$CRLEDGERID."'";
			$tranValueArr[4] = "'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'")."'";
			newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
		}
		else
		{
			$tranValueArr[3] = "'".$CRLEDGERID."'";
			$tranValueArr[4] = "'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'")."'";
			editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT,$cond_payment_CR);
		}
		
	
	}
	
	
	
	
	//COMMISION START================================================
/*	if(isset($_POST["txtTOTALCOMM"]) && !empty($_POST["txtTOTALCOMM"]))
		{
			
			$tranFieldArr= array();
			$tranValueArr= array();
			array_push($tranFieldArr,"SRNO");
			array_push($tranFieldArr,"VOUCHERNO");
			array_push($tranFieldArr,"VOUCHERTYPE");
			array_push($tranFieldArr,"LEDGERID");
			array_push($tranFieldArr,"GROUPID");
			array_push($tranFieldArr,"AMOUNT");
		
			array_push($tranFieldArr,"DESCRIPTION");
			array_push($tranFieldArr,"VOUCHERDATE");
			array_push($tranFieldArr,"UPDATEDATE");
			array_push($tranFieldArr,"USERNAME");
			array_push($tranFieldArr,"AMOUNTDOLLAR");
			
		
			
			$book_group =  getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$rescompanydata["COMMAC"]."'");
			
				$amt_INR =  ($book_group == 5 ? $_POST["txtTOTALCOMM"] : 0);
				$amt_USD =  ($book_group != 5 ? $_POST["txtTOTALCOMM"] : 0);
				
			
			$commsrno = getFieldDetail(LEDGER_DEBIT,"SRNO"," WHERE VOUCHERNO='". $ID ."' AND LEDGERID='". COMM ."' AND VOUCHERTYPE LIKE '%Payment%'");
			$cond_comm=" WHERE SRNO='". $commsrno ."'";
			$reccnt_COMM = getFieldDetail(LEDGER_DEBIT,"count(*)",$cond_comm);
			if($reccnt_COMM ==0)
			{
				$commsrno = getMaxValue(LEDGER_DEBIT,"SRNO");
			}
		
			array_push($tranValueArr,"'".$commsrno."'");
			array_push($tranValueArr,"'".$ID."'");
			array_push($tranValueArr,"'".($book_group == 5 ? "Cash" : "Bank")." Payment'");
			array_push($tranValueArr,"'".COMM."'");
			array_push($tranValueArr,"'".COMMGBP."'");
			array_push($tranValueArr,"'".$amt_INR."'");
			array_push($tranValueArr,"'".$_POST["txtREMARK"]."'");
			array_push($tranValueArr,"'".$_POST["dtpVOUCHERDATE"]."'");
			array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
			array_push($tranValueArr,"'".$loginuser_name."'");
			array_push($tranValueArr,"'".$amt_USD."'");
			
			
			array_push($tranFieldArr,"ENTRYDATE");
			array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
			
		
			if($reccnt_COMM ==0)
			{
				newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
				$tranValueArr[3] = $rescompanydata["COMMAC"];
				$tranValueArr[4] =$book_group;
				newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
			}
			else
			{
				editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT,$cond_comm);
				$tranValueArr[3] = $rescompanydata["COMMAC"];
				$tranValueArr[4] =$book_group;
				editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT,$cond_comm);
			}
			
			
		}*/
		//COMMISION END
    //======================================================================================================================	
		
		
		
		//exit();
	?>
	<script>
		window.location.href="<?php echo SITEURL."?sale";?>";
	</script>
		<?php
	exit();
	$action = "";	

}
elseif(isset($_POST["shape_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE ID IN (".$DeleteString.") AND VOUCHERTYPE='Sale'";
	deleteData(PURCHASESALE,$Condition);
	
	deleteData(BARCODE_PROCESS," where ID IN (".$DeleteString.") AND PROCESSTYPE='Sale'");
	
	deleteData(LEDGER_DEBIT," WHERE VOUCHERNO IN (".$DeleteString.") AND VOUCHERTYPE='Sale'");
	deleteData(LEDGER_CREDIT," WHERE VOUCHERNO IN (".$DeleteString.") AND VOUCHERTYPE IN ('Sale','Tax Out') ");
	
	
	deleteData(LEDGER_DEBIT," WHERE VOUCHERNO IN (".$DeleteString.") AND VOUCHERTYPE='Sale' AND BROKERSTATUS='Y'");
	deleteData(LEDGER_CREDIT," WHERE VOUCHERNO IN (".$DeleteString.") AND VOUCHERTYPE='Sale' AND BROKERSTATUS='Y'");
	?>
	<script>
	window.location.href="<?php echo SITEURL."?sale&_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Sale</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="" )
{?>
			<div class="row form-group">
				<div class="col-lg-1">
						<?php
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" style="margin-right:10px;" href="<?php echo SITEURL; ?>?sale&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}?>
				</div>
				<div class="col-lg-1">
						<a class="btn btn-primary addcls" style="margin-left:8px;" href="<?php echo SITEURL; ?>?sale&_nid=b"><i class="fa fa-plus-circle"></i> Add Bulk</a>
					</div>
					<div class="col-lg-1">
						<a class="btn btn-primary addcls" style="margin-left:15px;" href="<?php echo SITEURL.UPLOAD."PurchaseBulkFormat.xls"; ?>"><i class="fa fa-download"></i> XLS Format</a>
					</div>
				<div class="col-lg-2">
						<?php								
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" style="margin-left:40px;" href="<?php echo SITEURL;?>?sale&_vid"><i class="fa fa-plus-tasks"></i>View</a>
							<?php
						}
						?>
				</div>
						 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?sale&_vid" method="POST" onsubmit="">
							<div class="col-lg-2">
								Barcode No : <input type="text" class="form-control " name="search_barcode_sal" id="search_barcode_sal"/>
							</div>
							<div class="col-lg-2">
								<input style="margin-right:0px;margin-top:18px;" class="form-control" name="STOCKIDSEARCH" id="STOCKIDSEARCH" placeholder="Search">
							</div>
							<div class="col-lg-2">
							<button type="submit" style="margin-left:0px;margin-top:16px;" class="btn btn-default" style=";" name="search">Submit Button</button>
							</div>
							
						</form>
						</div>
<?php
}
else if($action == "view")
{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?sale" method="POST" onsubmit="return confirm('Do you really want to Delete selected Invoice?');">
					<?php echo $back_button;?>
					<p>
						<?php
						if($del_bol)
						{
							?>
						
						
						<a class="btn btn-success addcls" style="margin-right:0px;" href="<?php echo SITEURL; ?>?sale&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
						<a class="btn btn-primary addcls" style="margin-left:0px;" href="<?php echo SITEURL; ?>?sale&_nid=b"><i class="fa fa-plus-circle"></i> Add Bulk</a>
						<a class="btn btn-primary addcls" style="margin-left:0px;" href="<?php echo SITEURL.UPLOAD."PurchaseBulkFormat.xls"; ?>"><i class="fa fa-download"></i> XLS Format</a>
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
						 <table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
							<thead>
								<tr>
									<th style="text-align:center;width:5%;" >
									Sel
									<input type="checkbox" id="SelectAll" />
									</th>
									<th>ID</td>
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
									<th>Action</th>
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
											<td align="center"><input type="checkbox" value="<?php echo $resdata["ID"];?>" name="SELECT[]" class="SelectAll"/></td>
												<td><?php echo $resdata["ID"];?></td>
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
												<td>
													<?php 
													if($edit_bol)
													{
														?>
													<a href="<?php echo SITEURL; ?>?sale&_mid=<?php echo $resdata["ID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<?php
													}
													if($del_bol)
													{	
													?>
													<a href="<?php echo SITEURL; ?>?sale&_rid=<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Delete Sale : <?php echo $resdata["ID"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
													<?php
													}
													?>
													<a href="<?php echo SITEURL; ?>makexls.php?makexls=sale_<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Make XLS: <?php echo $resdata["ID"];?>?');" class="btn btn-success btn-circle" title="XLS">
														<i class="fa fa-file-excel-o"></i>
													</a>
													
												</td>
											</tr>
										<?php
									}
							?>                                        
							</tbody>
						</table>
					</div>
					<?php
					}?>
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
elseif($action == "modify" || $action == "new")
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
					<form id="frm_Sale" action="<?php echo SITEURL; ?>?sale" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="ID" id="ID" value="<?php echo isset($resdata) ? $resdata["ID"] : '';?>">
						<input type="hidden" name="SRNO" id="SRNO" value="<?php echo getFieldDetail(LEDGER_DEBIT,"SRNO"," WHERE VOUCHERNO='".( isset($resdata) ? $resdata["ID"] : '')."' AND VOUCHERTYPE='Sale'");?>">
						<input type="hidden" name="BROKERSRNO" id="BROKERSRNO" value="<?php echo getFieldDetail(LEDGER_DEBIT,"SRNO"," WHERE VOUCHERNO='".( isset($resdata) ? $resdata["ID"] : '')."' AND VOUCHERTYPE='Sale' AND BROKERSTATUS='Y'");?>">
						
						<div class="row form-group">
							<div class="col-lg-2">
									<label>Date</label>
									<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php echo isset($resdata) ? $resdata["VOUCHERDATE"] : date('Y-m-d');?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
									<label>Due Days</label>
									<input type="text" class="form-control onlyNumber" name="txtDUEDAYS" id="txtDUEDAYS" value="<?php echo isset($resdata) ? $resdata["DUEDAYS"] : 0 ;?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
									<label>Due Date</label>
									<input type="date" class="form-control" readonly name="dtpDUEDATE" id="dtpDUEDATE" value="<?php echo isset($resdata) ? $resdata["DUEDATE"] : date('Y-m-d');?>">
									<p class="help-block"></p>
							</div>
							</div>
							<div class="row form-group">
								<div class="col-lg-2">
										<label>Party</label>
										 <select class="form-control" name="txtLEDGERID" id="txtLEDGERID">
												<option value="">Select Party</option>
												<?php
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID in ('25','26') ORDER BY LEDGERNAME");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														?>
														<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==(isset($resdata) ? $resdata["LEDGERID"] : '') ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
														<?php
													}
												?>
											</select>
											<input type="hidden"  class="form-control" readonly name="STATE" id="STATE" value="">
										<a href="javascript:void(0)" class="addcls LEDGER_auto" rel="26" ><i class="fa fa-plus-circle"></i> Add New</a>	
										<p class="help-block"></p>
								</div>
							
								<div class="col-lg-2">
									<label>Broker</label>
									 <select class="form-control" name="txtBROKERID" id="txtBROKERID">
											<option value="">Select Broker</option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID='29' order by LEDGERNAME");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==(isset($resdata) ? $resdata["BROKERID"] : '') ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
													<?php
												}
											?>
										</select>
									<a href="javascript:void(0)" class="addcls LEDGER_auto" rel="29" ><i class="fa fa-plus-circle"></i> Add New</a>
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>Location</label>
									 <select class="form-control" name="txtLOCATIONNAME" id="txtLOCATIONNAME">
											<option value="">Select Location</option>
											<?php
											$res_LOC = getData(LOCATION_MST,$AllArr," WHERE FLAG='0'");
											while($res_LOC_data = mysqli_fetch_assoc($res_LOC))
												{
													?>
													<option value="<?php echo $res_LOC_data["LOCATIONNAME"];?>" <?php echo $res_LOC_data["LOCATIONNAME"]==(isset($resdata) ? $resdata["LOCATIONNAME"] : '') ? 'selected="selected"':'';?>><?php echo $res_LOC_data["LOCATIONNAME"];?></option>
													<?php
												}
											?>
										</select>
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>$</label>
									<input type="text" class="form-control onlyNumber" name="txtCONVRATE" id="txtCONVRATE" value="<?php echo isset($resdata) ?  $resdata["CONVRATE"] : '';?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>RMB</label><br>
									<input type="checkbox" name="chkRMB" id="chkRMB" value="Y" <?php echo isset($resdata) && $resdata["RMBRATE"] > 0 ? "checked" : "";?>>
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1 RMB" style="<?php echo isset($resdata) && $resdata["RMBRATE"] > 0 ? '' : "display:none;";?>">
									<label>RMB Rate</label><br>
									<input type="text"  class="form-control onlyNumber" name="txtRMBRATE" id="txtRMBRATE" value="<?php echo isset($resdata) ?  $resdata["RMBRATE"] :'';?>" / >
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>$ Fix</label><br>
									<input type="checkbox" name="chkCONVSTATUS" id="chkCONVSTATUS" value="Y" <?php echo isset($resdata) && $resdata["CONVSTATUS"] == 'Y' ? "checked" : "";?>>
									<p class="help-block"></p>
							</div>
							</div>
							
							
							
						
						<div class="form-group">
							<table id="addmorefield" width="110%" class="inputaddmorefieldtable customResponsiveTable">
								<thead>
								<tr>
									<th >Stock Id</th>
									
									<th >Shape</th>
									
									<th >Pcs</th>
									<th >Wt</th>
									
									<th >Cl</th>
									<th >Cla</th>
									<th >Ct</th>
									<th >Po</th>
									<th >Sy</th>
									<th >Flu</th>
									<th>Cert.</th>
									<th >Lb</th>
															
									<th >Rap</th>
									<th >Dis</th>
									<th >$ Rate</th>
									<th >Dis 1</th>
									<th >Dis 2</th>
									<th >$/Crt</th>
									<th >$ Total</th>
									
									<th class="RMB" style="<?php echo isset($resdata) && $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">RMB/Crt</th>
									<th class="RMB" style="<?php echo isset($resdata) && $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">RMB Amt</th>
									
									<th >Rs/Crt</th>
									<th >Rs Amt</th>
									<th >Diff</th>
									<th >BGM</th>
									<th></th>
								</tr>								
								</thead>
								<tbody id="listbarcode">
								<?php
								$SUMWEIGHT = 0;
									$SUMRATE = 0;
									$SUMRATEDOLLAR = 0;
									$DISCPER=0;
									$DISC2PER=0;
									$DISC3PER=0;
									if(isset($_GET["_nid"]))
									{
										?>
										<tr>
										<td>
											
											<input type="text" style="width:70px;" class="form-control bs_ BARCODENO_" name="BARCODENO[]" rel="<?php echo strtoupper($filename);?>" id="BARCODENO" >
										</td>
										
									</tr>
										<?php
									}
									else
									{
											$resprod = getData(BARCODE_PROCESS,$AllArr," WHERE ID='".(isset($resdata) ?  $resdata["ID"] : '')."' AND PROCESSTYPE='Sale'");
									
											while($resproddata = mysqli_fetch_assoc($resprod))
											{
												$CNT_IDX = substr($resproddata["BARCODENO"],2);
												
												$SUMWEIGHT += $resproddata["WEIGHT"];
												$SUMRATE += $resproddata["RATE"];
												$SUMRATEDOLLAR += $resproddata["RATEDOLLAR"];
												$DISCPER += $resproddata["DISCPER"];
												$DISC2PER += $resproddata["DISC2PER"];
												$DISC3PER += $resproddata["DISC3PER"];
												?>
												<tr>
													<td>
														<input type="text" style="width: 80px;" class="form-control BARCODENO_" name="BARCODENO[]" id="BARCODENO<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["BARCODENO"];?>">
													</td>
													
													<td>
														<input type="text" style="width: 80px;" class="form-control rapprice" name="SHAPE<?php echo $CNT_IDX;?>" id="SHAPE<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["SHAPE"];?>">
													</td>
													
													<td>
														<input type="text" style="width: 30px;" class="form-control" name="PCS<?php echo $CNT_IDX;?>" id="PCS<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["PCS"];?>">
													</td>
													<td>
														<input type="text" style="width: 40px;" class="form-control rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $CNT_IDX;?>" id="WEIGHT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["WEIGHT"];?>">
													</td>
													<td>
														<input type="text" style="width: 30px;" class="form-control rapprice" name="COLOR<?php echo $CNT_IDX;?>" id="COLOR<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["COLOR"];?>">
													</td>
													<td>
														<input type="text" style="width: 40px;" class="form-control rapprice" name="CLARITY<?php echo $CNT_IDX;?>" id="CLARITY<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CLARITY"];?>">
													</td>
													<td>
														<input type="text" style="width: 30px;" class="form-control" name="CUT<?php echo $CNT_IDX;?>" id="CUT<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CUT"];?>">
													</td>
													<td>
														<input type="text" style="width: 30px;" class="form-control" name="POLISH<?php echo $CNT_IDX;?>" id="POLISH<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["POLISH"];?>">
													</td>
													<td>
														<input type="text" style="width: 30px;" class="form-control" name="SYMM<?php echo $CNT_IDX;?>" id="SYMM<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["SYMM"];?>">
													</td>
													<td>
														<input type="text" style="width: 60px;" class="form-control" name="FLOURANCE<?php echo $CNT_IDX;?>" id="FLOURANCE<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["FLOURANCE"];?>">
													</td>
													<td>
														<input type="text"  style="width: 80px;" class="form-control" name="CERTIFICATENO<?php echo $CNT_IDX;?>" id="CERTIFICATENO<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CERTIFICATENO"];?>">
													</td>
													<td>
														<input type="text"  style="width: 30px;" class="form-control" name="LAB<?php echo $CNT_IDX;?>" id="LAB<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["LAB"];?>">
													</td>
													<td>
														<input type="text" style="width: 60px;text-align:right;" class="form-control txtweightrate RATE_" name="RATE<?php echo $CNT_IDX;?>" id="RATE<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RATE"];?>">
													</td>
													<td>
														<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate DISCPER_" name="DISCPER<?php echo $CNT_IDX;?>" id="DISCPER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISCPER"];?>">
													</td>
													<td>
														<input type="text" style="width: 60px;text-align:right;" class="form-control RATEDOLLAR_" name="RATEDOLLAR<?php echo $CNT_IDX;?>" id="RATEDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RATEDOLLAR"];?>">
													</td>
													<td>
														<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate DISC2PER_" name="DISC2PER<?php echo $CNT_IDX;?>" id="DISC2PER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate DISC3PER_" name="DISC3PER<?php echo $CNT_IDX;?>" id="DISC3PER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text" style="width: 70px;text-align:right;" class="form-control PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $CNT_IDX;?>" id="PERCRTDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["PERCRTDOLLAR"];?>">
													</td>
													<td>
														<input type="text" style="width: 70px;text-align:right;" class="form-control TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $CNT_IDX;?>" id="TOTALDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["TOTALDOLLAR"];?>">
													</td>
													
													
													<td class="RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
														<input type="text"  style="width: 70px;text-align:right;" class="form-control RMBPERCRT_" name="RMBPERCRT<?php echo $CNT_IDX;?>" id="RMBPERCRT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RMBPERCRT"];?>">
													</td>
													<td class="RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
														<input type="text" style="width: 70px;text-align:right;" class="form-control RMBAMOUNT_" name="RMBAMOUNT<?php echo $CNT_IDX;?>" id="RMBAMOUNT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RMBAMOUNT"];?>">
													</td>
													
													
													<td>
														<input type="text"  style="width: 70px;text-align:right;" class="form-control RSPERCRT_" name="RSPERCRT<?php echo $CNT_IDX;?>" id="RSPERCRT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RSPERCRT"];?>">
													</td>
													<td>
														<input type="text" style="width: 70px;text-align:right;" class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $CNT_IDX;?>" id="RSAMOUNT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RSAMOUNT"];?>">
													</td>
													<td>
														<input type="text" style="width: 70px;text-align:right;" class="form-control DIFFAMOUNT_" name="DIFFAMOUNT<?php echo $CNT_IDX;?>" id="DIFFAMOUNT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DIFFAMOUNT"];?>">
													</td>
													<td>
														<input type="text" style="width: 60px;" class="form-control" name="BGM<?php echo $CNT_IDX;?>" id="BGM<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["BGM"];?>">
													</td>
													<td style="text-align:center;">
														<a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" rel="<?php echo $resproddata["BARCODENO"];?>/Sale" ><i class="fa fa-remove"></i></a>
													</td>
												</tr>
												<?php
											}
									}
									
									
								?>
								</tbody>
								<tr>
										<td>
											<input type="text" style="width: 80px;text-align:right;" class="form-control" name="txtTOTALQTY" readonly id="txtTOTALQTY" value="<?php echo isset($resdata) ?  $resdata["TOTALQTY"] : 0?>">
										</td>
										<td colspan="2">
										</td>
										<td>
											<input type="text" style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="SUMWEIGHT" id="SUMWEIGHT" value="<?php echo $SUMWEIGHT?>">
										</td>
										<td colspan="8">
											
										</td>
										
										<td>
											<input type="text" style="width: 60px;text-align:right;" class="form-control txtweightrate" readonly name="SUMRATE" id="SUMRATE" value="<?php echo $SUMRATE?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="AVGDISCPER" id="AVGDISCPER" value="<?php echo isset($resdata) &&  $resdata["TOTALQTY"] > 0 ? $DISCPER/$resdata["TOTALQTY"] : 0 ;?>">
										</td>
										<td>
											<input type="text" style="width: 60px;text-align:right;" class="form-control" name="SUMRATEDOLLAR" readonly id="SUMRATEDOLLAR" value="<?php echo $SUMRATEDOLLAR?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="AVGDISC2PER" id="AVGDISC2PER" value="<?php echo isset($resdata) && $resdata["TOTALQTY"] > 0 ? $DISC2PER/$resdata["TOTALQTY"] : 0;?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control txtweightrate" readonly name="AVGDISC3PER" id="AVGDISC3PER" value="<?php echo isset($resdata) &&  $resdata["TOTALQTY"] > 0 ? $DISC3PER/$resdata["TOTALQTY"] : 0;?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control" readonly name="txtPERCRTTOTALDOLLAR" id="txtPERCRTTOTALDOLLAR" value="<?php echo isset($resdata) ?  $resdata["PERCRTTOTALDOLLAR"] : 0?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;"  class="form-control" readonly name="txtTOTALDOLLAR" id="txtTOTALDOLLAR" value="<?php echo isset($resdata) ?  $resdata["TOTALDOLLAR"] :0?>">
										</td>
										
										
										<td class="RMB" style="<?php echo isset($resdata) &&  $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
											<input type="text" style="width: 70px;text-align:right;" class="form-control" readonly name="txtTOTALRMBPERCRT" id="txtTOTALRMBPERCRT" value="<?php echo isset($resdata) ?  $resdata["TOTALRMBPERCRT"] : 0?>">
										</td>
										<td class="RMB" style="<?php echo isset($resdata) && $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
											<input type="text" style="width: 70px;text-align:right;"class="form-control" readonly name="txtTOTALRMBAMOUNT" id="txtTOTALRMBAMOUNT" value="<?php echo isset($resdata) ?  $resdata["TOTALRMBAMOUNT"] : 0?>">
										</td>
										
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control" readonly name="txtTOTALRSRSPERCRT" id="txtTOTALRSRSPERCRT" value="<?php echo isset($resdata) ?  $resdata["TOTALRSRSPERCRT"] : 0?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;"class="form-control" readonly name="txtTOTALRSAMOUNT" id="txtTOTALRSAMOUNT" value="<?php echo isset($resdata) ?  $resdata["TOTALRSAMOUNT"] : 0?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;"class="form-control" readonly name="txtTOTALDIFFAMOUNT" id="txtTOTALDIFFAMOUNT" value="<?php echo isset($resdata) ?  $resdata["TOTALDIFFAMOUNT"] : 0?>">
										</td>
										<td>
										</td>
								</tr>
							</table>
						</div>
						<?php
						if(isset($_GET["_nid"]) && $_GET["_nid"] == 'b')
						{
							?>
							<button type="button" class="btn btn-success pull-right" onclick="document.getElementById('Upload_file_sale').click();"  style="margin-bottom:10px;" ><i class="fa fa-upload"></i> Upload XLS File</button>
							<input type="file" style="display:none;" id="Upload_file_sale" name="Upload_file_sale"/>
							<?php
						}
						else
						{
							?>
							
						<a  class="btn btn-success add_field_button_ pull-right"  rel="1" href="javascript:void(0)" style="margin-bottom:10px;" ><i class="fa fa-plus-circle"></i> Add More Fields</a>
						<?php
						}
						?>
						<br>
						
								<div class="row form-group">
								<div class="col-lg-2">
									
										<label>Partner Status</label><br>
										<input type="checkbox" name="chkPARTNERSTATUS" id="chkPARTNERSTATUS" value="Y" <?php echo isset($resdata) &&  $resdata["PARTNERPER"] > 0 ? "checked" : "";?>>
										<p class="help-block"></p>
									
								</div>
										
									<div class="col-lg-2 PARTNERSTATUS" style="<?php echo isset($resdata) && $resdata["PARTNERPER"] > 0 ? '' : "display:none;";?>">
										<label>Partner Name</label><br>
												 <select class="form-control" name="txtPARTNERID" id="txtPARTNERID">
													<option value=""> Select Partner </option>
													<?php
													$res_Partnerled = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID=41 ORDER BY LEDGERNAME");
													while($res_Partnerled_data = mysqli_fetch_assoc($res_Partnerled))
														{
															?>
															<option value="<?php echo $res_Partnerled_data["LEDGERID"];?>" <?php echo $res_Partnerled_data["LEDGERID"]==(isset($resdata) ? $resdata["PARTNERID"] : '') ? 'selected="selected"':'';?>><?php echo $res_Partnerled_data["LEDGERNAME"];?></option>
															<?php
														}
													?>
												</select>
												<a href="javascript:void(0)" class="addcls LEDGER_auto" rel="41" ><i class="fa fa-plus-circle"></i> Add New</a>
									</div>
										<div class="col-lg-2 PARTNERSTATUS" style="<?php echo isset($resdata) &&  $resdata["PARTNERPER"] > 0 ? '' : "display:none;";?>">
											<label>%</label>
											<input style="text-align:right;" class="form-control" name="txtPARTNERPER" id="txtPARTNERPER" value="<?php echo isset($resdata) ?  $resdata["PARTNERPER"] : 0; ?>">
										</div>
										<div class="col-lg-2 PARTNERSTATUS" style="<?php echo isset($resdata) &&  $resdata["PARTNERPER"] > 0 ? '' : "display:none;";?>">
											<label>Partner Amount</label>
	
												<input style="text-align:right;" type="text"  class="form-control onlyNumber" readonly name="txtPARTNERAMOUNT" id="txtPARTNERAMOUNT" value="<?php echo isset($resdata) ?  $resdata["PARTNERAMOUNT"] : 0;?>">
												</div>
						
								
						</div>
					
						<div class="row form-group">
							<div class="col-lg-2">
									<label>Brokerage (%)</label>
									<input type="text"  class="form-control onlyNumber" name="txtDALALIPER" id="txtDALALIPER" value="<?php echo isset($resdata) ?  $resdata["DALALIPER"] : 0;?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
									<label>Brokerage Amt</label>
									<input type="text" style="text-align:right;" class="form-control onlyNumber" name="txtDALALIAMT" id="txtDALALIAMT" value="<?php echo isset($resdata) ?  $resdata["DALALIAMT"] : 0;?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
									 <label>Final Total</label>
                            <input type="text" style="text-align:right;" class="form-control onlyNumber" readonly name="txtFINALTOTAL" id="txtFINALTOTAL" value="<?php echo isset($resdata) ?  $resdata["FINALTOTAL"] : 0;?>">
                                <p class="help-block"></p>
							</div>
                        </div>
						<div class="row form-group" style="display:none;">
										<div class="col-lg-2">
										<label>Third Party</label>
										 <select class="form-control" name="txtTHIREDPERID" id="txtTHIREDPERID">
												<option value=""> Select Third Party </option>
												<?php
												$res_thiredpartyled = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID='40' ORDER BY LEDGERNAME");
												while($res_thiredpartyled_data = mysqli_fetch_assoc($res_thiredpartyled))
													{
														?>
														<option value="<?php echo $res_thiredpartyled_data["LEDGERID"];?>" <?php echo $res_thiredpartyled_data["LEDGERID"]== (isset($resdata) ? $resdata["THIREDPERID"] : '') ? 'selected="selected"':'';?>><?php echo $res_thiredpartyled_data["LEDGERNAME"];?></option>
														<?php
													}
												?>
											</select>
											<input type="hidden"  class="form-control" readonly name="STATE" id="STATE" value="">
											<a href="javascript:void(0)" class="addcls LEDGER_auto" rel="40" ><i class="fa fa-plus-circle"></i> Add New</a>
										<p class="help-block"></p>
								</div>
									<div class="col-lg-2" style="display:none;">
										<label>Comm Charges</label>
										<input type="text" class="form-control onlyNumber COMMCAL"  name="txtCOMMCHARGE" id="txtCOMMCHARGE" value="<?php echo isset($resdata) ?  $resdata["COMMCHARGE"] : 0;?>">
										<p class="help-block"></p>
									</div>
									<div class="col-lg-2">
										<label>Comm 1</label>
										<input type="text" class="form-control onlyNumber COMMCAL" name="txtCOMMDISC1PER" id="txtCOMMDISC1PER" value="<?php echo isset($resdata) ?  $resdata["COMMDISC1PER"] : 0;?>">
										<p class="help-block"></p>
									</div>
									<div class="col-lg-2">
										<label>Comm 2</label>
										<input type="text" class="form-control onlyNumber COMMCAL" name="txtCOMMDISC2PER" id="txtCOMMDISC2PER" value="<?php echo isset($resdata) ?  $resdata["COMMDISC2PER"] : 0;?>">
										<p class="help-block"></p>
									</div>
									<div class="col-lg-2">
										<label>Total Comm</label>
										<input type="text" class="form-control onlyNumber COMMCAL" readonly name="txtTOTALCOMM" id="txtTOTALCOMM" value="<?php echo isset($resdata) ?  $resdata["TOTALCOMM"] : 0;?>">
										<p class="help-block"></p>
									</div>
						
						
							</div>
							<div class="row form-group">
							<div class="col-lg-3">
								<div class="checkbox-inline">
											<label>Bill Status</label><br/>
											<label>
												<input class="checkbox-inline clsbillstatus" type="radio" id="radwithbillstatus" name="radBILLSTATUS" value="With Bill" <?php echo isset($resdata) &&  $resdata["BILLSTATUS"] == 'With Bill'  ? "checked" : "";?>/> With Bill
												<input class="checkbox-inline clsbillstatus" type="radio" id="radwithoutbillstatus" name="radBILLSTATUS" value="Without Bill" <?php echo isset($resdata) &&  $resdata["BILLSTATUS"] == 'Without Bill' ? "checked" : "";?>/> Without Bill
											</label>
											</div>
											
								
				
							</div>
						
								
				
						</div>
						
						
						
						
							<div class="row form-group GST" style="<?php echo isset($resdata) &&  $resdata["BILLSTATUS"] == 'With Bill' ? '' : "display:none;";?>">
							
								<div class="col-lg-12">
											
												<div class="col-lg-1"><label></label></div>
												<div class="col-lg-1"><label>Per</label></div>
												<div class="col-lg-2"><label>Amount</label></div>
											
								</div>
								<div class="col-lg-12">
											
												<div class="col-lg-1"><label>GST</label></div>
												<div class="col-lg-1"><input class="form-control GSTCAL" name="txtIGSTPER" id="txtIGSTPER" value="<?php echo isset($resdata) ?  $resdata["IGSTPER"] : 0;?>"></div>
												<div class="col-lg-2"><label><input style="text-align:right;" class="form-control" name="txtIGSTAMT" id="txtIGSTAMT" value="<?php echo isset($resdata) ?  $resdata["IGSTAMT"] : 0;?>">	</label></div>
											
								</div>
								<div class="col-lg-12"  style="display:none;">
											
												<div class="col-lg-1"><label>SGST</label></div>
												<div class="col-lg-1"><input  class="form-control GSTCAL" name="txtSGSTPER" id="txtSGSTPER" value="<?php echo isset($resdata) ?  $resdata["SGSTPER"] : 0;?>"></div>
												<div class="col-lg-2"><label><input style="text-align:right;" class="form-control" name="txtSGSTAMT" id="txtSGSTAMT" value="<?php echo isset($resdata) ?  $resdata["SGSTAMT"] : 0;?>">	</label></div>
											
								</div>
								<div class="col-lg-12"  style="display:none;">
											
												<div class="col-lg-1"><label>CGST</label></div>
												<div class="col-lg-1"><input  class="form-control GSTCAL" name="txtCGSTPER" id="txtCGSTPER" value="<?php echo isset($resdata) ?  $resdata["CGSTPER"] : 0;?>"></div>
												<div class="col-lg-2"><label><input  style="text-align:right;" class="form-control" name="txtCGSTAMT" id="txtCGSTAMT" value="<?php echo isset($resdata) ?  $resdata["CGSTAMT"] : 0;?>">	</label></div>
											
								</div>
								<div class="col-lg-12" style="display:none;">
											
												<div class="col-lg-1"><label>Invoice No</label></div>
												<div class="col-lg-1"><input  class="form-control GSTCAL" name="txtINVOICENO" id="txtINVOICENO" value="<?php echo isset($resdata) ?  $resdata["INVOICENO"] : '';?>"></div>
											
								</div>
								<div class="col-lg-12" style="display:none;">
									<div class="col-lg-2"><label>Invoice No</label></div>	
									<div class="col-lg-2"><input type="text" class="form-control GSTCAL" style="width:300px;<?php echo isset($resdata) &&   $resdata["BILLSTATUS"] == 'With Bill' ? '' : "display:none;";?>" id="txtINVOICECHAR" name="txtINVOICECHAR" value="<?php echo isset($resdata) ?  $resdata["INVOICECHAR"] : '';?>">
									</div>
								</div>
							
									
						</div>
						<div class="row form-group GST" style="<?php echo isset($resdata) && $resdata["BILLSTATUS"] == 'With Bill' ? '' : "display:none;";?>" >
							
								<div class="col-lg-12" >
											
												<div class="col-lg-1"><label></label></div>
												<div class="col-lg-1"><label>Per</label></div>
												<div class="col-lg-2"><label>Amount</label></div>
											
								</div>
								<div class="col-lg-12">
											
												<div class="col-lg-1"><label>TCS</label></div>
												<div class="col-lg-1"><input class="form-control GSTCAL" name="txtTCSPER" id="txtTCSPER" value="<?php echo isset($resdata) ?  $resdata["TCSPER"] : 0;?>"></div>
												<div class="col-lg-2"><label><input style="text-align:right;" class="form-control" name="txtTCSAMT" id="txtTCSAMT" value="<?php echo isset($resdata) ?  $resdata["TCSAMT"] : 0;?>">	</label></div>
											
								</div>
							</div>
						<div class="row form-group">
					
							<div class="col-lg-2">
								<label>Grand Amount</label>
								<input type="text" style="text-align:right;" class="form-control onlyNumber" readonly name="txtGRANDAMOUNT" id="txtGRANDAMOUNT" value="<?php echo isset($resdata) ?  $resdata["GRANDAMOUNT"] : 0;?>">
                                <p class="help-block"></p>
							</div>
							<div class="col-lg-2">
								<label>Last Amount</label>
								<input style="text-align:right;" type="text"  class="form-control onlyNumber" readonly name="txtLASTAMOUNT" id="txtLASTAMOUNT" value="<?php echo isset($resdata) ?  $resdata["LASTAMOUNT"] : 0;?>">
								<p class="help-block"></p>
							</div>							
							<div class="col-lg-2">									
								<label>Payment Status</label><br>
								<input type="checkbox" name="chkPAYMENTSTATUS" id="chkPAYMENTSTATUS" value="Y" <?php echo isset($resdata) &&  $resdata["PAYMENTSTATUS"] == '1' ? "checked" : "";?>>
								<p class="help-block"></p>									
							</div>
							<div class="col-lg-2 PAYMENTSTATUS" style="<?php echo isset($resdata) && $resdata["PAYMENTSTATUS"] == '1' ? '' : "display:none;";?>">
								<label>Book Name</label><br> 
								<select class="form-control" name="txtBOOKLEDGERID" id="txtBOOKLEDGERID">
									<option value=""> Select Book A/c </option>
									<?php
									$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID in (1,2)");
									while($res_led_data = mysqli_fetch_assoc($res_led))
									{
									?>
										<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo (isset($resdata) ? $resdata["BOOKLEDGERID"] : '') == $res_led_data["LEDGERID"]? 'selected="selected"' : '' ?>><?php echo $res_led_data["LEDGERNAME"];?></option>
										
									<?php
									}
									?>
								</select>								
							</div>	
									
						</div>
							
						<input type="hidden" readonly name="companystate" id="companystate" value="<?php echo $rescompanydata["STATE"];?>">
                             
					
						
						<div class="form-group">
                            <label>Remark</label>
                            <input class="form-control" name="txtREMARK" id="txtREMARK" value="<?php echo isset($resdata) ?  $resdata["REMARK"] : '';?>">
                                <p class="help-block"></p>
                        </div>
					
							
							
						
						<button type="submit" class="btn btn-default" style="float: right;margin-left: 10px;" name="sale" id="btnSale">Submit Button</button>
						<img id="lodimg" src="<?php echo SITEURL.INIT."images/loading.gif";?>" style="float: right;display:none;"/>
					</form>
				</div>
			</div>
		</div>
		
	</div>

	<?php
}
?>