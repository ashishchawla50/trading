<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

$filename = "party";
if(isset($_SESSION["adminuser"]))
	{
		$loginuser_name = $_SESSION["adminuser"];
		$user_name = $_SESSION["adminuser"];
	}
	elseif(isset($_SESSION["user"]))
	{
		$loginuser_name = $_SESSION["user"];
		$user_name = getFieldDetail(USER,"CONCAT(FIRSTNAME,' ',LASTNAME)"," WHERE USERNAME='".$_SESSION["user"]."'");
		
	}

include("loading.php");

if(isset($_POST["party"]))
{
	
	$LEDGERID = $_POST["LEDGERID"];
	//exit();
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	//array_push($FieldArr_Col,"LEDGERID");
	//array_push($FieldArr_Val,"'1'");
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
				array_push($FieldArr_Val,"'".addslashes($_POST[$tempctrl])."'");
			break;
		}
		}
	}
	
	array_push($FieldArr_Col,"UPDATEDATE");
	array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
	array_push($FieldArr_Col,"USERNAME");
	array_push($FieldArr_Val,"'".$loginuser_name."'");
	array_push($FieldArr_Col,"FLAG");
	array_push($FieldArr_Val,"'0'");
	
	array_push($FieldArr_Col,"LOANDATE");
	array_push($FieldArr_Val,"'".$_POST["dtpLOANDATE"]."'");
			
	$Condition = " WHERE LEDGERID='". $LEDGERID ."'";
	
	

	$reccnt = getFieldDetail(LEDGER,"count(*)"," WHERE LEDGERID='". $LEDGERID ."'");
	if ($reccnt == 0)
		{
			$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
			$VOUCHERNO = getMaxValue(LEDGER_DEBIT,"VOUCHERNO"," WHERE VOUCHERTYPE='Opening'");
			
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldArr_Col,"SRNO");
			array_push($FieldArr_Val,"'".$SRNO."'");
			array_push($FieldArr_Col,"VOUCHERNO");
			array_push($FieldArr_Val,"'".$VOUCHERNO."'");
			
			$LEDGERID = newData($FieldArr_Col,$FieldArr_Val,LEDGER,TRUE);
		
		}
	else
		{
			
			 $SRNO = $_POST["SRNO"] == 0 || $_POST["SRNO"] == '' ? getMaxValue(LEDGER_DEBIT,"SRNO") : $_POST["SRNO"] ;
			 $VOUCHERNO = $_POST["VOUCHERNO"] == 0 || $_POST["VOUCHERNO"] == '' ? getMaxValue(LEDGER_DEBIT,"VOUCHERNO"," WHERE VOUCHERTYPE='Opening'") : $_POST["VOUCHERNO"] ;
			
			array_push($FieldArr_Col,"SRNO");
			array_push($FieldArr_Val,"'".$SRNO."'");
			array_push($FieldArr_Col,"VOUCHERNO");
			array_push($FieldArr_Val,"'".$VOUCHERNO."'");			
			editData($FieldArr_Col,$FieldArr_Val,LEDGER,$Condition);
		}		
		
		exeModifyQuery("UPDATE " . LEDGER_CREDIT . " SET GROUPID='". $_POST["txtGROUPID"] ."' WHERE LEDGERID='". $LEDGERID . "'");
		exeModifyQuery("UPDATE " . LEDGER_DEBIT . " SET GROUPID='". $_POST["txtGROUPID"] ."' WHERE LEDGERID='". $LEDGERID . "'");
			
	
		$entdate = isset($_POST["txtVOUCHERDATE"]) ? $_POST["txtVOUCHERDATE"] : getFieldDetail(LEDGER,"DATE_FORMAT(ENTRYDATE,'%Y-%m-%d')"," WHERE LEDGERID='". $LEDGERID ."'");
		
			
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
		array_push($tranFieldArr,"CRDR");
		array_push($tranFieldArr,"GROUPID");
		array_push($tranFieldArr,"RMBAMOUNT");
		array_push($tranFieldArr,"AMOUNTDOLLAR");
		
		array_push($tranValueArr,"'".$SRNO."'");
		array_push($tranValueArr,"'".$VOUCHERNO."'");
		array_push($tranValueArr,"'Opening'");
		array_push($tranValueArr,"'".$LEDGERID."'");
		array_push($tranValueArr,"'".$_POST["txtOPENINGBALANCE"]."'");
		array_push($tranValueArr,"'Opening Balance'");
		array_push($tranValueArr,"'".$entdate."'");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranValueArr,"'".$loginuser_name."'");
		array_push($tranValueArr,"'".(isset($_POST["txtCRDR"]) ? $_POST["txtCRDR"] : 'Dr')."'");
		array_push($tranValueArr,"'".$_POST["txtGROUPID"]."'");
		array_push($tranValueArr,"'".$_POST["txtOPENINGRMBAMOUNT"]."'");
		array_push($tranValueArr,"'".$_POST["txtOPENINGDOLLAR"]."'");
		
		
	 	$reccnt_open_cr = getFieldDetail(LEDGER_CREDIT,"count(*)"," WHERE LEDGERID='". $LEDGERID ."' AND VOUCHERTYPE='Opening'");
		$reccnt_open_dr = getFieldDetail(LEDGER_DEBIT,"count(*)"," WHERE LEDGERID='". $LEDGERID ."' AND VOUCHERTYPE='Opening'");
		
		
		if(isset($_POST["txtCRDR"]) && $_POST["txtCRDR"] == 'Cr')
		{
			
			deleteData(LEDGER_DEBIT," WHERE LEDGERID='".$LEDGERID."'  AND VOUCHERTYPE='Opening'");
			if ($reccnt_open_cr == 0)
			{
				$entdate = getFieldDetail(LEDGER,"ENTRYDATE"," WHERE LEDGERID='". $LEDGERID ."'");
				array_push($tranFieldArr,"ENTRYDATE");
				array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
				newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
			}
			else
			{
				$Condition = " WHERE LEDGERID='".$LEDGERID."' and VOUCHERTYPE='Opening'";			
				editData($tranFieldArr,$tranValueArr,LEDGER_CREDIT,$Condition);
			}
		}
		else
		{
			
			
			deleteData(LEDGER_CREDIT," WHERE LEDGERID='".$LEDGERID."'  AND VOUCHERTYPE='Opening'");
			if ($reccnt_open_dr == 0)
			{
				
				$entdate = getFieldDetail(LEDGER,"ENTRYDATE"," WHERE LEDGERID='". $LEDGERID ."'");
				array_push($tranFieldArr,"ENTRYDATE");
				array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
				newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
				
			}
			else
			{
				$Condition = " WHERE LEDGERID='".$LEDGERID."' and VOUCHERTYPE='Opening'";			
				editData($tranFieldArr,$tranValueArr,LEDGER_DEBIT,$Condition);
			}
		}
		
		?>
		<script>
	window.location.href="<?php echo SITEURL."?party";?>";
	</script>
		<?php
		exit();
	$action = "";	

}
?>