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
								array_push($FieldArr,"PS.PARTNERAMOUNT");
								array_push($FieldArr,"PR.LEDGERNAME AS PARTNERNAME");
								
		$BARCODENOSEARCH = isset($_POST["STOCKIDSEARCH"]) && !empty($_POST["STOCKIDSEARCH"])? " AND (BARCODENO='GP".$_POST["STOCKIDSEARCH"]."' OR CERTIFICATENO='".$_POST["STOCKIDSEARCH"]."' )" : '';
		
		$res = getData(BARCODE_PROCESS,$FieldArr," AS BP INNER JOIN ".PURCHASESALE." AS PS ON PS.ID=BP.ID AND PS.VOUCHERTYPE=BP.PROCESSTYPE AND PS.PARTNERSTATUS='Y' INNER JOIN ".LEDGER." AS L ON L.LEDGERID=BP.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=BP.BROKERID LEFT JOIN ".LEDGER." AS PR on PR.LEDGERID=PS.PARTNERID WHERE BP.FLAG='0'  AND BP.PROCESSTYPE='Purchase'" .$BARCODENOSEARCH." ORDER BY PS.VOUCHERDATE DESC");
		
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Purchase Detail";
	$res = getData(PURCHASESALE,$AllArr," WHERE  ID='0' AND VOUCHERTYPE='Purchase'");
	$resdata = mysqli_fetch_assoc($res);
	
}
elseif(isset($_GET["_mid"]))
{
	$action ="modify";
	$ID = $_GET["_mid"];
	
	$Caption = "Edit Purchase Detail";
	$res = getData(PURCHASESALE,$AllArr," WHERE ID='".$ID."' AND VOUCHERTYPE='Purchase'");
	$resdata = mysqli_fetch_assoc($res);	

}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$ID = $_GET["_rid"];
	deleteData(PURCHASESALE," where ID='".$ID."' AND VOUCHERTYPE='Purchase'");
	deleteData(BARCODE_PROCESS," where ID='".$ID."' AND PROCESSTYPE='Purchase'");
	
	deleteData(LEDGER_DEBIT," WHERE VOUCHERNO ='".$ID."' AND VOUCHERTYPE='Purchase'");
	deleteData(LEDGER_CREDIT," WHERE VOUCHERNO ='".$ID."' AND VOUCHERTYPE='Purchase'");
	
	deleteData(LEDGER_DEBIT," WHERE VOUCHERNO ='".$ID."' AND VOUCHERTYPE='Tax In'");
	
	?>
	<script>
		window.location.href="<?php echo SITEURL."?partnerpurchase&_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]) || isset($_POST["search"]))
{
	$action = "view";
}
if(isset($_POST["purchase"]))
{
	$CERTIARR = array();

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
	$CONVSTATUS = isset($_POST["chkCONVSTATUS"]) ?"Y":"N";
	array_push($FieldArr_Col,"CONVSTATUS");
	array_push($FieldArr_Val,"'".$CONVSTATUS."'");
	
	$RMBSTATUS = isset($_POST["chkRMBSTATUS"]) ?"Y":"N";
	array_push($FieldArr_Col,"RMBSTATUS");
	array_push($FieldArr_Val,"'".$RMBSTATUS."'");
	
	$PARTNERSTATUS = isset($_POST["chkPARTNERSTATUS"]) ?"Y":"N";
	array_push($FieldArr_Col,"PARTNERSTATUS");
	array_push($FieldArr_Val,"'".$PARTNERSTATUS."'");
	
	array_push($FieldArr_Col,"VOUCHERTYPE");
	array_push($FieldArr_Val,"'Purchase'");
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
	

	$Condition = " WHERE ID='". $ID ."' AND VOUCHERTYPE='Purchase'";
	
	$reccnt = getFieldDetail(PURCHASESALE,"count(*)"," WHERE ID='". $ID ."' AND VOUCHERTYPE='Purchase'");
	 $reccnt_Ledger = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Purchase'");
	$reccnt_Broker_Ledger = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Purchase' AND BROKERSTATUS='Y'");
	
	$cnt_igst = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Tax In' AND LEDGERID='" . IGSTIN . "'");
	$cnt_cgst = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Tax In' AND LEDGERID='" . CGSTIN . "'");
	$cnt_sgst = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE VOUCHERNO='". $ID ."' AND VOUCHERTYPE='Tax In' AND LEDGERID='" . SGSTIN . "'");
	
	if ($reccnt == 0)
		{
						
			
			$last_dt = date('Y-m-d h:i:s');
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".$last_dt."'");
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
		array_push($FieldBarcode,"RMBPERCRT");
		
		array_push($FieldBarcode,"BGM");
		
		$cnt_idx = substr($Barcode,2);
		array_push($CERTIARR,$_POST["CERTIFICATENO".$cnt_idx]);
		
		$reccnt = getFieldDetail(BARCODE_PROCESS,"count(*)"," WHERE ID='". $ID ."' AND BARCODENO='".$Barcode."' AND PROCESSTYPE='Purchase'");
		if ($reccnt == 0)
		{
			
			
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
			array_push($ValueBarcode,"'Purchase'");
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
			array_push($ValueBarcode,"'".(isset($_POST["radBILLSTATUS"]) ?$_POST["radBILLSTATUS"] : '')."'");
			array_push($FieldBarcode,"LOCATIONNAME");
			array_push($ValueBarcode,"'".$_POST["txtLOCATIONNAME"]."'");
			//ADD VDATE
			array_push($FieldBarcode,"VDATE");
			array_push($ValueBarcode,"'".$_POST["dtpVOUCHERDATE"]."'");
			
			$ENTRYID = newData($FieldBarcode,$ValueBarcode,BARCODE_PROCESS,TRUE);	
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
			array_push($ValueBarcode,"'Purchase'");
			array_push($FieldBarcode,"ID");
			array_push($ValueBarcode,"'". $ID ."'");
			array_push($FieldBarcode,"LEDGERID");
			array_push($ValueBarcode,"'". $_POST["txtLEDGERID"] ."'");
			array_push($FieldBarcode,"BROKERID");
			array_push($ValueBarcode,"'". $_POST["txtBROKERID"] ."'");
			array_push($FieldBarcode,"CONVRATE");
			array_push($ValueBarcode,"'". $_POST["txtCONVRATE"] ."'");	

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
			//EXIT();
			editData($FieldBarcode,$ValueBarcode,BARCODE_PROCESS," WHERE ID='". $ID ."' AND BARCODENO='".$Barcode."' AND PROCESSTYPE='Purchase'");
		}		
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
	
	
		if($reccnt_Ledger== 0)
		{
			$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
		}
		else
		{
			$SRNO = $_POST["SRNO"];
		}
		array_push($tranValueArr,"'".$SRNO."'");
		array_push($tranValueArr,"'".$ID."'");
		array_push($tranValueArr,"'Purchase'");
		array_push($tranValueArr,"'".$_POST["txtLEDGERID"]."'");
		array_push($tranValueArr,"'".$_POST["txtLASTAMOUNT"]."'");
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
			newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
			$tranValueArr[3] = "'".PURAC."'";
			$tranValueArr[4] = "'".round($_POST["txtFINALTOTAL"])."'";
			
			$tranValueArr[11] = "'".PURGBP."'";
			newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);		
		}
		else
		{
			$Condition = " WHERE VOUCHERTYPE='Purchase' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";			
			editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT,$Condition);
			$tranValueArr[3] = "'".PURAC."'";
			$tranValueArr[4] = "'".round($_POST["txtFINALTOTAL"])."'";
			
			$tranValueArr[11] = "'".PURGBP."'";
			
			editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT,$Condition);			
		}	
		//exit();
		//=================================================TAX IN DEBIT==============================================
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
		array_push($tranTAXValueArr,"'Tax In'");
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
				$tranTAXValueArr[3] = "'".IGSTIN."'";
				$tranTAXValueArr[4] = "'".round($_POST["txtIGSTAMT"])."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				array_push($tranTAXFieldArr,"ENTRYDATE");
				array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");			
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".IGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";			
				$tranTAXValueArr[3] = "'".IGSTIN."'";
				$tranTAXValueArr[4] = "'".round($_POST["txtIGSTAMT"])."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT,$Condition);			
			}	
		}
		else
		{
			$Condition = " WHERE LEDGERID='".IGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";		
			deleteData(LEDGER_DEBIT,$Condition);
		}
		
		//==========================CGST====================================
		if($_POST["txtCGSTAMT"] > 0)
		{
			if ($cnt_cgst == 0)
			{
				$tranTAXValueArr[3] = "'".CGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtCGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				array_push($tranTAXFieldArr,"ENTRYDATE");
				array_push($tranTAXValueArr,"'".date('Y-m-d h:i:s')."'");			
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".CGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";			
				$tranTAXValueArr[3] = "'".CGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtCGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT,$Condition);			
			}	
		}
		else
		{
			 $Condition = " WHERE LEDGERID='".CGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";		
			 deleteData(LEDGER_DEBIT,$Condition);
		}
		//==========================SGST====================================
		if($_POST["txtSGSTAMT"] > 0)
		{
		
			if ($cnt_sgst == 0)
			{
					
				$tranTAXValueArr[3] = "'".SGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtSGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				
				newData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT);		
			}
			else
			{
				$Condition = " WHERE LEDGERID='".SGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";			
				$tranTAXValueArr[3] = "'".SGSTIN."'";
				$tranTAXValueArr[4] = "'".$_POST["txtSGSTAMT"]."'";
				$tranTAXValueArr[11] = "'".GSTGB."'";
				editData($tranTAXFieldArr,$tranTAXValueArr,LEDGER_DEBIT,$Condition);			
			}	
		}
		else
		{
			$Condition = " WHERE LEDGERID='".SGSTIN."' AND VOUCHERTYPE='Tax In' AND SRNO='".$SRNO."' AND VOUCHERNO='".$ID."'";		
			deleteData(LEDGER_DEBIT,$Condition);
		}
		//==============================BROKER=================================================================================================
		if(isset($_POST["txtBROKERID"]) &&  !empty($_POST["txtBROKERID"]) && isset($_POST["txtBROKERID"]) && $_POST["txtBROKERID"] > 0  && $_POST["txtDALALIAMT"] > 0)
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
			array_push($tranValueArr,"'Purchase'");
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
	//COMMISION START================================================
	if(isset($_POST["txtTOTALCOMM"]) && !empty($_POST["txtTOTALCOMM"]))
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
			
			
		}
		//COMMISION END
    //======================================================================================================================

	?>
	<script>
		window.location.href="<?php echo SITEURL."?partnerpurchase";?>";
	</script>
		<?php
		exit();
	$action = "";	

}
elseif(isset($_POST["shape_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE ID IN (".$DeleteString.") AND VOUCHERTYPE='Purchase'";
	deleteData(PURCHASESALE,$Condition);
	
	deleteData(BARCODE_PROCESS," where ID IN ('".$DeleteString."') AND VOUCHERTYPE='Purchase'");
	
	deleteData(LEDGER_DEBIT," WHERE VOUCHERNO IN ('".$DeleteString."') AND VOUCHERTYPE='Purchase'");
	deleteData(LEDGER_CREDIT," WHERE VOUCHERNO IN ('".$DeleteString."') AND VOUCHERTYPE='Purchase'");
	?>
	<script>
	window.location.href="<?php echo SITEURL."?partnerpurchase&_vid";?>";
	</script>
	<?php
	
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Partner Purchase</h1>
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
							<a class="btn btn-success addcls" style="margin-right:10px;" href="<?php echo SITEURL; ?>?partnerpurchase&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}?>
				</div>
				<div class="col-lg-1">
						<?php								
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" style="margin-left:10px;" href="<?php echo SITEURL;?>?partnerpurchase&_vid"><i class="fa fa-plus-tasks"></i>View</a>
							<?php
						}
						?>
				</div>
				
						 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?partnerpurchase&_vid" method="POST" onsubmit="">
							<div class="col-lg-2">
								Barcode No : <input type="text" class="form-control " name="search_barcode_pur" id="search_barcode_pur"/>
							</div>
							<div class="col-lg-2">
								Search : <input style="margin-right:0px;" class="form-control" name="STOCKIDSEARCH" id="STOCKIDSEARCH" placeholder="Search">
							</div>
							<div class="col-lg-2">
								<button type="submit" style="margin-left:0px;" class="btn btn-default" style=";" name="search">Submit Button</button>
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
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?partnerpurchase" method="POST" onsubmit="return confirm('Do you really want to Delete selected Invoice?');">
					<?php echo $back_button;?>
					<p>
						
						<a class="btn btn-success addcls"  href="<?php echo SITEURL; ?>?partnerpurchase&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							
						<a class="btn btn-primary" href="<?php echo SITEURL; ?>?partnerpurchase&_nid=b"><i class="fa fa-plus-circle"></i> Add Bulk</a>
						<?php
						if($del_bol)
						{
							?>
						<button type="submit" name="shape_mul" class="btn btn-danger delcls" ><i class="fa fa-trash-o"></i> Delete</button>
						<?php
						}
						?>
						<a class="btn btn-primary" href="<?php echo SITEURL.UPLOAD."PurchaseBulkFormat.xls"; ?>"><i class="fa fa-download"></i> XLS Format</a>
						<a class="btn btn-success" href="<?php echo SITEURL; ?>makexls.php?makexls=dashboard_pe_2<?php echo $xlsaction;?>" onclick="return confirm('Do you really want to Make XLS);" class="btn btn-success btn-circle" title="XLS">
							<i class="fa fa-file-excel-o"></i> Make XLS
													</a>	
						<a class="btn btn-primary" href="<?php echo SITEURL; ?>makexls.php?makexls=purchase_<?php echo $xlsaction1;?>" onclick="return confirm('Do you really want to Make XLS:?');" class="btn btn-primary btn-circle" title="XLS">
															<i class="fa fa-file-excel-o"></i> Make XLS Party
						</a>							
													
					</p>
					
				<?php
				if ($view_bol)
				{
				?>
				<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover customResponsiveTable" id="dataTables-example">
							<thead>
								<tr style="font-size:10px;">
									<th style="text-align:center;width:5%;" >
									Sel
									<input type="checkbox" id="SelectAll" />
									</th>
									<th>Date</th>	
									
									<th>Stock Id</th>
									<th>Part. Name</th>	
									<th>Pt. %</th>	
									<th>Part. Amt.</th>	
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
									<th>Certi.</th>										
									<th>Lb</th>	
									
									
									<th>RT.</th>
									<th>Disc.</th>
									<th>$ /Crt</th>
									<th>RT. $</th>
									<th>$</th>
									<th>Rs /Crt</th>
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
										$bararray= array();
										
										//$LEDGERID= getFieldDetail(LEDGER,LEDGERID," where LEDGERID ='".$res_led_data["LEDGERID"]."'");
										$bar = getData(BARCODE_PROCESS,$AllArr," where ID='".$resdata["ID"]."' and PROCESSTYPE='Purchase' ORDER BY ID DESC");
										while($bardata = mysqli_fetch_assoc($bar))
										{
											array_push($bararray,$bardata["BARCODENO"]);
										}
										$barcnt= getFieldDetail(BARCODE_PROCESS,"count(*)"," where BARCODENO IN ('". implode("','",$bararray) . "') AND PROCESSTYPE='Sale'");
										
										
										?>
											<tr style="font-size:10px;" class="<?php echo $classname;?>">
											
											<td align="center">
											<?php
													if($barcnt==0)
													{
														?>
														
											<input type="checkbox" value="<?php echo $resdata["ID"];?>" name="SELECT[]" class="SelectAll"/>
											<?php
													}
													?>
											</td>
												
												<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
												
												<td><?php echo $resdata["BARCODENO"];?></td>
												<td><?php echo $resdata["PARTNERNAME"];?></td>
												<td><?php echo $resdata["PARTNERPER"];?></td>
												<td><?php echo $resdata["PARTNERAMOUNT"];?></td>
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
													<a href="<?php echo SITEURL; ?>?partnerpurchase&_mid=<?php echo $resdata["ID"];?>" class="btn btn-primary btn-circle editcls" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													
													<?php
													}
													if($del_bol)
													{	
													
													if($barcnt==0)
													{
														?>
													<a href="<?php echo SITEURL; ?>?partnerpurchase&_rid=<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Delete Purchase : <?php echo $resdata["ID"];?>?');" class="btn btn-danger btn-circle delcls" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
													<?php
													}
													}
													?>
														<a href="<?php echo SITEURL; ?>makexls.php?makexls=purchase_<?php echo $resdata["ID"];?>" onclick="return confirm('Do you really want to Make XLS: <?php echo $resdata["ID"];?>?');" class="btn btn-success btn-circle" title="XLS">
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
					<form id="frm_Purchase" action="<?php echo SITEURL; ?>?partnerpurchase" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="ID" id="ID" value="<?php echo $resdata["ID"];?>">
						<input type="hidden" name="SRNO" id="SRNO" value="<?php echo getFieldDetail(LEDGER_DEBIT,"SRNO"," WHERE VOUCHERNO='".$resdata["ID"]."' AND VOUCHERTYPE='Purchase'");?>">
						<input type="hidden" name="BROKERSRNO" id="BROKERSRNO" value="<?php echo getFieldDetail(LEDGER_DEBIT,"SRNO"," WHERE VOUCHERNO='".$resdata["ID"]."' AND VOUCHERTYPE='Purchase' AND BROKERSTATUS='Y'");?>">
						<div class="row form-group">
							<div class="col-lg-2">
									<label>Date</label>
									<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php echo isset($resdata["VOUCHERDATE"]) ? $resdata["VOUCHERDATE"] : date('Y-m-d');?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>Due Days</label>
									<input type="text" class="form-control onlyNumber" name="txtDUEDAYS" id="txtDUEDAYS" value="<?php echo $resdata["DUEDAYS"];?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
									<label>Due Date</label>
									<input type="date" class="form-control" readonly name="dtpDUEDATE" id="dtpDUEDATE" value="<?php echo $resdata["DUEDATE"];?>">
									<p class="help-block"></p>
							</div>
							</div>
								<div class="row form-group">
								<div class="col-lg-2">
										<label>Party</label>
										 <select class="form-control" name="txtLEDGERID" id="txtLEDGERID">
												<option value="">Select Party</option>
												<?php
												$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0'  and GROUPID in ('25','26') ORDER BY LEDGERNAME");
												while($res_led_data = mysqli_fetch_assoc($res_led))
													{
														?>
														<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==$resdata["LEDGERID"] ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
														<?php
													}
												?>
											</select>
											<input type="hidden"  class="form-control" readonly name="STATE" id="STATE" value="">
											<a href="javascript:void(0)" class="LEDGER_auto" rel="25" ><i class="fa fa-plus-circle"></i> Add New</a>
										<p class="help-block"></p>
								</div>
								
								
								
								<div class="col-lg-2">
									<label>Broker</label>
									 <select class="form-control" name="txtBROKERID" id="txtBROKERID">
											<option value="">Select Broker</option>
											<?php
											$res_led = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID='29' ORDER BY LEDGERNAME");
											while($res_led_data = mysqli_fetch_assoc($res_led))
												{
													?>
													<option value="<?php echo $res_led_data["LEDGERID"];?>" <?php echo $res_led_data["LEDGERID"]==$resdata["BROKERID"] ? 'selected="selected"':'';?>><?php echo $res_led_data["LEDGERNAME"];?></option>
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
													<option value="<?php echo $res_LOC_data["LOCATIONNAME"];?>" <?php echo $res_LOC_data["LOCATIONNAME"]==$resdata["LOCATIONNAME"] ? 'selected="selected"':'';?>><?php echo $res_LOC_data["LOCATIONNAME"];?></option>
													<?php
												}
											?>
										</select>
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>$</label>
									<input type="text" class="form-control onlyNumber" name="txtCONVRATE" id="txtCONVRATE" value="<?php echo $resdata["CONVRATE"];?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>RMB</label><br>
									<input type="checkbox" name="chkRMBSTATUS" id="chkRMB" value="Y" <?php echo $resdata["RMBSTATUS"] == 'Y' ? "checked" : "";?>>
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1 RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
									<label>RMB Rate</label><br>
									<input type="text"  class="form-control onlyNumber" name="txtRMBRATE" id="txtRMBRATE" value="<?php echo $resdata["RMBRATE"];?>" / >
									<p class="help-block"></p>
							</div>
							<div class="col-lg-1">
									<label>$ Fix</label><br>
									<input type="checkbox" name="chkCONVSTATUS" id="chkCONVSTATUS" value="Y" <?php echo $resdata["CONVSTATUS"] == 'Y' || $resdata["CONVSTATUS"] == '' ? "checked" : "";?>>
									<p class="help-block"></p>
							</div>
							</div>
							
							
						
						
						<div class="form-group">
							<table id="addmorefield" width="110%" class="inputaddmorefieldtable customResponsiveTable">
								<thead>
								<tr>
									<th>Stock Id</th>
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
									<th>$ Rate</th>
									<th >Dis 1</th>
									<th >Dis 2</th>
									<th >$/Crt</th>
									<th >$ Total</th>
									<th class="RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">RMD/Crt</th>
									<th class="RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">RMD Amt</th>
									<th >Rs/Crt</th>
									<th >Rs Amt</th>
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
										$BARCODEMAX = getMaxValue(BARCODE_PROCESS, "CAST(SUBSTRING(BARCODENO,3) as UNSIGNED)");
									if(isset($_GET["_nid"]))
									{
										?>
										<tr>
											<td>
												
												<input type="text" style="width:70px;" class="form-control bs_ BARCODENO_" name="BARCODENO[]" rel="<?php echo strtoupper($filename);?>" id="BARCODENO<?PHP echo $BARCODEMAX;?>" value="GP<?PHP echo $BARCODEMAX;?>" >
											</td>
											
										</tr>
										<?php
									}
									else
									{
										$resprod = getData(BARCODE_PROCESS,$AllArr," WHERE ID='".$resdata["ID"]."' AND PROCESSTYPE='Purchase'");
										
										while($resproddata = mysqli_fetch_assoc($resprod))
										{
											$CNT_IDX = substr($resproddata["BARCODENO"],2);
											$SUMWEIGHT += $resproddata["WEIGHT"];
											$SUMRATE += $resproddata["RATE"];
											$SUMRATEDOLLAR += $resproddata["RATEDOLLAR"];
											$DISCPER += $resproddata["DISCPER"];
											$DISC2PER += $resproddata["DISC2PER"];
											$DISC3PER += $resproddata["DISC3PER"];
											$barstatus = getFieldDetail(BARCODE_PROCESS,"count(*)"," where BARCODENO='".$resproddata["BARCODENO"]."' and PROCESSTYPE='Sale'")
											?>
											<tr>
												<td>
													<input type="text" style="width: 80px;" class="form-control BARCODENO_" name="BARCODENO[]" id="BARCODENO<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["BARCODENO"];?>">
												</td>
												<td>
													<input type="text" style="width: 80px;" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $CNT_IDX;?>" id="SHAPE<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["SHAPE"];?>">
												</td>
												<td>
													<input type="text" style="width: 30px;" class="form-control onlyNumber" name="PCS<?php echo $CNT_IDX;?>" id="PCS<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["PCS"];?>">
												</td>
												<td>
													<input type="text"  style="width: 40px;" class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $CNT_IDX;?>" id="WEIGHT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["WEIGHT"];?>">
												</td>
																							
												<td>
													<input type="text" style="width: 30px;" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $CNT_IDX;?>" id="COLOR<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["COLOR"];?>">
												</td>
												<td>
													<input type="text" style="width: 40px;" class="form-control rapprice" name="CLARITY<?php echo $CNT_IDX;?>" id="CLARITY<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CLARITY"];?>">
												</td>
												<td>
													<input type="text" style="width: 30px;" class="form-control onlyCharacter" name="CUT<?php echo $CNT_IDX;?>" id="CUT<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CUT"];?>">
												</td>
												<td>
													<input type="text" style="width: 30px;" class="form-control onlyCharacter" name="POLISH<?php echo $CNT_IDX;?>" id="POLISH<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["POLISH"];?>">
												</td>
												<td>
													<input type="text" style="width: 30px;" class="form-control onlyCharacter" name="SYMM<?php echo $CNT_IDX;?>" id="SYMM<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["SYMM"];?>">
												</td>
												<td>
													<input type="text" style="width: 60px;" class="form-control onlyCharacter" name="FLOURANCE<?php echo $CNT_IDX;?>" id="FLOURANCE<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["FLOURANCE"];?>">
												</td>
												<td>
													<input type="text"  style="width: 80px;" class="form-control" name="CERTIFICATENO<?php echo $CNT_IDX;?>" id="CERTIFICATENO<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["CERTIFICATENO"];?>">
												</td>
												<td>
													<input type="text"  style="width: 30px;" class="form-control onlyCharacter" name="LAB<?php echo $CNT_IDX;?>" id="LAB<?php echo $CNT_IDX;?>" value="<?php echo $resproddata["LAB"];?>">
												</td>
												
												
												<td>
													<input type="text" style="width: 60px;text-align:right;" class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $CNT_IDX;?>" id="RATE<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RATE"];?>">
												</td>
												<td>
													<input type="text" style="width: 40px;text-align:right;" class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $CNT_IDX;?>" id="DISCPER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISCPER"];?>">
												</td>
												<td>
													<input type="text" style="width: 60px;text-align:right;" class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $CNT_IDX;?>" id="RATEDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RATEDOLLAR"];?>">
												</td>
												<td>
													<input type="text" style="width: 40px;text-align:right;"  class="form-control txtweightrate DISC2PER_" name="DISC2PER<?php echo $CNT_IDX;?>" id="DISC2PER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISC2PER"];?>">
												</td>
												<td>
													<input type="text" style="width: 40px;text-align:right;" class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $CNT_IDX;?>" id="DISC3PER<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["DISC3PER"];?>">
												</td>
												<td>
													<input type="text" style="width: 70px;text-align:right;" class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $CNT_IDX;?>" id="PERCRTDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["PERCRTDOLLAR"];?>">
												</td>
												<td>
													<input type="text"  style="width: 70px;text-align:right;" class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $CNT_IDX;?>" id="TOTALDOLLAR<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["TOTALDOLLAR"];?>">
												</td>
												
												<td class="RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
													<input type="text"  style="width: 70px;text-align:right;" class="form-control onlyNumber RMBPERCRT_" name="RMBPERCRT<?php echo $CNT_IDX;?>" id="RMBPERCRT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RMBPERCRT"];?>">
												</td>
												<td class="RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
													<input type="text" style="width: 70px;text-align:right;" class="form-control onlyNumber RMBAMOUNT_" name="RMBAMOUNT<?php echo $CNT_IDX;?>" id="RMBAMOUNT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RMBAMOUNT"];?>">
												</td>
												
												
												<td>
													<input type="text"  style="width: 70px;text-align:right;" class="form-control onlyNumber RSPERCRT_" name="RSPERCRT<?php echo $CNT_IDX;?>" id="RSPERCRT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RSPERCRT"];?>">
												</td>
												<td>
													<input type="text" style="width: 70px;text-align:right;" class="form-control onlyNumber RSAMOUNT_" name="RSAMOUNT<?php echo $CNT_IDX;?>" id="RSAMOUNT<?php echo $CNT_IDX;?>" rel="<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["RSAMOUNT"];?>">
												</td>
												<td>
													<input type="text" style="width: 60px;" class="form-control onlyCharacter" name="BGM<?php echo $CNT_IDX;?>" id="BGM<?php echo $CNT_IDX;?>"  value="<?php echo $resproddata["BGM"];?>">
												</td>
											
												
												
												
												
												<td style="text-align:center;">
												<?php
												if($barstatus == 0)
												{
												?>
												<a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" rel="<?php echo $resproddata["BARCODENO"];?>/Purchase" ><i class="fa fa-remove"></i></a>
												<?php											
												}
												?>
												</td>
											</tr>
											<?php
										}
									}
									
								?>
								</tbody>
								<tr>
										<td>
											<input type="text" style="width: 80px;text-align:right;" class="form-control onlyNumber" name="txtTOTALQTY" readonly id="txtTOTALQTY" value="<?php echo $resdata["TOTALQTY"]?>">
										</td>
										<td colspan="2">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control onlyNumber txtweightrate" readonly name="SUMWEIGHT" id="SUMWEIGHT" value="<?php echo $SUMWEIGHT?>">
										</td>
										
										<td colspan="8">
											
										</td>
										
									
										
										<td>
											<input type="text"  style="width: 60px;text-align:right;" class="form-control onlyNumber txtweightrate" readonly name="SUMRATE" id="SUMRATE" value="<?php echo $SUMRATE?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control onlyNumber txtweightrate" readonly name="AVGDISCPER" id="AVGDISCPER" value="<?php echo $resdata["TOTALQTY"] > 0 ? $DISCPER/$resdata["TOTALQTY"] : 0 ;?>">
										</td>
										<td>
											<input type="text" style="width: 60px;text-align:right;"  class="form-control onlyNumber" name="SUMRATEDOLLAR" readonly id="SUMRATEDOLLAR" value="<?php echo $SUMRATEDOLLAR?>">
										</td>
										<td>
											<input type="text" style="width: 40px;text-align:right;" class="form-control onlyNumber txtweightrate" readonly name="AVGDISC2PER" id="AVGDISC2PER" value="<?php echo $resdata["TOTALQTY"] > 0 ? $DISC2PER/$resdata["TOTALQTY"] : 0;?>">
										</td>
										<td>
											<input type="text"  style="width: 40px;text-align:right;" class="form-control onlyNumber txtweightrate" readonly name="AVGDISC3PER" id="AVGDISC3PER" value="<?php echo $resdata["TOTALQTY"] > 0 ? $DISC3PER/$resdata["TOTALQTY"] : 0;?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;"  class="form-control onlyNumber" readonly name="txtPERCRTTOTALDOLLAR" id="txtPERCRTTOTALDOLLAR" value="<?php echo $resdata["PERCRTTOTALDOLLAR"]?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control onlyNumber" readonly name="txtTOTALDOLLAR" id="txtTOTALDOLLAR" value="<?php echo $resdata["TOTALDOLLAR"]?>">
										</td>
										
										<td class="RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
											<input type="text" style="width: 70px;text-align:right;" class="form-control onlyNumber" readonly name="txtTOTALRMBPERCRT" id="txtTOTALRMBPERCRT" value="<?php echo $resdata["TOTALRMBPERCRT"]?>">
										</td>
										<td class="RMB" style="<?php echo $resdata["RMBSTATUS"] == 'Y' ? '' : "display:none;";?>">
											<input type="text" style="width: 70px;text-align:right;" class="form-control onlyNumber" readonly name="txtTOTALRMBAMOUNT" id="txtTOTALRMBAMOUNT" value="<?php echo $resdata["TOTALRMBAMOUNT"]?>">
										</td>
										
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control onlyNumber" readonly name="txtTOTALRSRSPERCRT" id="txtTOTALRSRSPERCRT" value="<?php echo $resdata["TOTALRSRSPERCRT"]?>">
										</td>
										<td>
											<input type="text" style="width: 70px;text-align:right;" class="form-control onlyNumber" readonly name="txtTOTALRSAMOUNT" id="txtTOTALRSAMOUNT" value="<?php echo $resdata["TOTALRSAMOUNT"]?>">
										</td>
										<td></td>
								</tr>
							</table>
						</div>
						<?php
						if(isset($_GET["_nid"]) && $_GET["_nid"] == 'b')
						{
							?>
							<button type="button" class="btn btn-success pull-right" onclick="document.getElementById('Upload_file').click();"  style="margin-bottom:10px;" ><i class="fa fa-upload"></i> Upload XLS File</button>
							<input type="file" style="display:none;" id="Upload_file" name="Upload_file"/>
							<?php
						}
						else
						{
							?>
							
							<a  class="btn btn-success add_field_button pull-right" href="javascript:void(0)" style="margin-bottom:10px;" rel="<?php echo $BARCODEMAX+1;?>" ><i class="fa fa-plus-circle"></i> Add More Fields</a>
							<?php
						}
						?>
						
						<br>
						<div class="row form-group">
								<div class="col-lg-2">
									
										<label>Partner Status</label><br>
										<input type="checkbox" name="chkPARTNERSTATUS" id="chkPARTNERSTATUS" value="Y" <?php echo $resdata["PARTNERPER"] > 0 ? "checked" : "";?>>
										<p class="help-block"></p>
									
								</div>
										
									<div class="col-lg-2 PARTNERSTATUS" style="<?php echo $resdata["PARTNERPER"] > 0 ? '' : "display:none;";?>">
										<label>Partner Name</label><br>
												 <select class="form-control" name="txtPARTNERID" id="txtPARTNERID">
													<option value=""> Select Partner </option>
													<?php
													$res_Partnerled = getData(LEDGER,$AllArr," WHERE FLAG='0' AND GROUPID=41 ORDER BY LEDGERNAME");
													while($res_Partnerled_data = mysqli_fetch_assoc($res_Partnerled))
														{
															?>
															<option value="<?php echo $res_Partnerled_data["LEDGERID"];?>" <?php echo $res_Partnerled_data["LEDGERID"]==$resdata["PARTNERID"] ? 'selected="selected"':'';?>><?php echo $res_Partnerled_data["LEDGERNAME"];?></option>
															<?php
														}
													?>
												</select>
												<a href="javascript:void(0)" class="addcls LEDGER_auto" rel="41" ><i class="fa fa-plus-circle"></i> Add New</a>
									</div>
										<div class="col-lg-2 PARTNERSTATUS" style="<?php echo $resdata["PARTNERPER"] > 0 ? '' : "display:none;";?>">
											<label>%</label>
											<input style="text-align:right;" class="form-control" name="txtPARTNERPER" id="txtPARTNERPER" value="<?php echo $resdata["PARTNERPER"];?>">
										</div>
										<div class="col-lg-2 PARTNERSTATUS" style="<?php echo $resdata["PARTNERPER"] > 0 ? '' : "display:none;";?>">
											<label>Partner Amount</label>
	
												<input style="text-align:right;" type="text"  class="form-control onlyNumber" readonly name="txtPARTNERAMOUNT" id="txtPARTNERAMOUNT" value="<?php echo $resdata["PARTNERAMOUNT"];?>">
												</div>
						
								
						</div>
						
						<div class="row form-group">
							<div class="col-lg-2" style="display:none;">
									<label>Dalali (%)</label>
									<input type="text"  class="form-control onlyNumber" name="txtDALALIPER" id="txtDALALIPER" value="<?php echo $resdata["DALALIPER"];?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2" style="display:none;">
									<label>Dalali Amt</label>
									<input type="text" class="form-control onlyNumber" name="txtDALALIAMT" id="txtDALALIAMT" value="<?php echo $resdata["DALALIAMT"];?>">
									<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
									 <label>Final Total</label>
                            <input type="text" style="text-align:right;" class="form-control onlyNumber" readonly name="txtFINALTOTAL" id="txtFINALTOTAL" value="<?php echo $resdata["FINALTOTAL"];?>">
                                <p class="help-block"></p>
							</div>
                        </div>
						
						<div class="row form-group"  style="display:none;">
										<div class="col-lg-2">
										<label>Third Party</label>
										 <select class="form-control" name="txtTHIREDPERID" id="txtTHIREDPERID">
												<option value=""> Select Third Party </option>
												<?php
												$res_thiredpartyled = getData(LEDGER,$AllArr," WHERE FLAG='0' and GROUPID='40' ORDER BY LEDGERNAME");
												while($res_thiredpartyled_data = mysqli_fetch_assoc($res_thiredpartyled))
													{
														?>
														<option value="<?php echo $res_thiredpartyled_data["LEDGERID"];?>" <?php echo $res_thiredpartyled_data["LEDGERID"]==$resdata["THIREDPERID"] ? 'selected="selected"':'';?>><?php echo $res_thiredpartyled_data["LEDGERNAME"];?></option>
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
										<input type="text" class="form-control onlyNumber COMMCAL"  name="txtCOMMCHARGE" id="txtCOMMCHARGE" value="<?php echo $resdata["COMMCHARGE"];?>">
										<p class="help-block"></p>
									</div>
									<div class="col-lg-2">
										<label>Comm 1</label>
										<!--<input type="text" class="form-control onlyNumber COMMCAL" name="txtCOMMDISC1PER" id="txtCOMMDISC1PER" value="<?php echo empty($resdata["COMMDISC1PER"]) ? 0.25 : $resdata["COMMDISC1PER"];?>">-->
										<input type="text" class="form-control onlyNumber COMMCAL" name="txtCOMMDISC1PER" id="txtCOMMDISC1PER" value="<?php echo  $resdata["COMMDISC1PER"];?>">
										<p class="help-block"></p>
									</div>
									<div class="col-lg-2">
										<label>Comm 2</label>
										<input type="text" class="form-control onlyNumber COMMCAL" name="txtCOMMDISC2PER" id="txtCOMMDISC2PER" value="<?php echo $resdata["COMMDISC2PER"];?>">
										<p class="help-block"></p>
									</div>
									<div class="col-lg-2">
										<label>Total Comm</label>
										<input type="text" class="form-control onlyNumber COMMCAL" readonly name="txtTOTALCOMM" id="txtTOTALCOMM" value="<?php echo $resdata["TOTALCOMM"];?>">
										<p class="help-block"></p>
									</div>
						
						
							</div>
							
							
						<div class="row form-group">
							<div class="col-lg-3">
								<div class="checkbox-inline">
											<label>Bill Status</label><br/>
											<label>
												<input class="checkbox-inline clsbillstatus" type="radio" id="radwithbillstatus" name="radBILLSTATUS" value="With Bill" <?php echo $resdata["BILLSTATUS"] == 'With Bill'  ? "checked" : "";?>/> With Bill
												<input class="checkbox-inline clsbillstatus" type="radio" id="radwithoutbillstatus" name="radBILLSTATUS" value="Without Bill" <?php echo $resdata["BILLSTATUS"] == 'Without Bill' || $resdata["BILLSTATUS"] == '' ? "checked" : "";?>/> Without Bill
											</label>
											</div>
											
								
				
							</div>
						
								
					
						</div>
							<div class="row form-group GST" style="<?php echo $resdata["BILLSTATUS"] == 'With Bill' ? '' : "display:none;";?>" >
							
								<div class="col-lg-12" >
											
												<div class="col-lg-1"><label></label></div>
												<div class="col-lg-1"><label>Per</label></div>
												<div class="col-lg-2"><label>Amount</label></div>
											
								</div>
								<div class="col-lg-12">
											
												<div class="col-lg-1"><label>GST</label></div>
												<div class="col-lg-1"><input class="form-control GSTCAL" name="txtIGSTPER" id="txtIGSTPER" value="<?php echo $resdata["IGSTPER"];?>"></div>
												<div class="col-lg-2"><label><input style="text-align:right;" class="form-control" name="txtIGSTAMT" id="txtIGSTAMT" value="<?php echo $resdata["IGSTAMT"];?>">	</label></div>
											
								</div>
								<div class="col-lg-12"  style="display:none;">
											
												<div class="col-lg-1"><label>SGST</label></div>
												<div class="col-lg-1"><input  class="form-control GSTCAL" name="txtSGSTPER" id="txtSGSTPER" value="<?php echo $resdata["SGSTPER"];?>"></div>
												<div class="col-lg-2"><label><input style="text-align:right;" class="form-control" name="txtSGSTAMT" id="txtSGSTAMT" value="<?php echo $resdata["SGSTAMT"];?>">	</label></div>
											
								</div>
								<div class="col-lg-12"  style="display:none;">
											
												<div class="col-lg-1"><label>CGST</label></div>
												<div class="col-lg-1"><input  class="form-control GSTCAL" name="txtCGSTPER" id="txtCGSTPER" value="<?php echo $resdata["CGSTPER"];?>"></div>
												<div class="col-lg-2"><label><input  style="text-align:right;" class="form-control" name="txtCGSTAMT" id="txtCGSTAMT" value="<?php echo $resdata["CGSTAMT"];?>">	</label></div>
											
								</div>
						
							
									
						</div>
						<div class="row form-group">
							<div class="col-lg-2">
									 <label>Grand Amount</label>
									<input style="text-align:right;" type="text"  class="form-control onlyNumber" readonly name="txtGRANDAMOUNT" id="txtGRANDAMOUNT" value="<?php echo $resdata["GRANDAMOUNT"];?>">
									
								<p class="help-block"></p>
							</div>
							<div class="col-lg-2">
									 <label>Last Amount</label>
									<input style="text-align:right;" type="text"  class="form-control onlyNumber" readonly name="txtLASTAMOUNT" id="txtLASTAMOUNT" value="<?php echo $resdata["LASTAMOUNT"];?>">
									
								<p class="help-block"></p>
							</div>
                      </div>
						
									<input type="hidden"  class="form-control" readonly name="companystate" id="companystate" value="<?php echo $rescompanydata["STATE"];?>">
                             
                   
						<div class="form-group">
                            <label>Remark</label>
                            <input class="form-control" name="txtREMARK" id="txtREMARK" value="<?php echo $resdata["REMARK"];?>">
                                <p class="help-block"></p>
                        </div>
						
						<button type="submit" class="btn btn-default" style="float: right;margin-left: 10px;" id="btnpurchase" name="purchase">Submit Button</button> 
						<img id="lodimg" src="<?php echo SITEURL.INIT."images/loading.gif";?>" style="float: right;display:none;"/>
					</form>
				</div>
			</div>
		</div>
		
	</div>

	<?php
}
?>
	
<?php
?>

	
