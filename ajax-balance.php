<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

	
	$dtfrm = date('Y-m-d');

	 $CR_AMT = getFieldDetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$_POST["tbid"]."' AND VOUCHERDATE <='".$dtfrm."'");

	 $DR_AMT = getFieldDetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$_POST["tbid"]."' AND VOUCHERDATE <='".$dtfrm."'");
	//$OPEN_BAL = ($DROPEN - $CROPEN) + ($DR_AMT_OPEN-$CR_AMT_OPEN);
	
	$BAL_DR = (($DR_AMT-$CR_AMT)) > 0 ? (($DR_AMT-$CR_AMT)) : Abs(($DR_AMT-$CR_AMT));
	echo $BAL_DR;
exit();
?>