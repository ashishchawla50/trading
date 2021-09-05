<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

if(isset($_GET["billstatus"]) && isset($_POST["invoicetype"]) && $_POST["invoicetype"] == "sale" && isset($_POST["voucherdate"]))
{
    $vdate=strtotime($_POST["voucherdate"]);
	$curmonth = date('M',$vdate);
	$curyear = date('y',$vdate);
	$prevyear= date('y',$vdate) - 1;
	$STARTDATE  =$prevyear."-04-01";
    $ENDDATE  = $curyear."-03-31";

	$invno= getMaxValue(PURCHASESALE,"INVOICENO"," WHERE VOUCHERTYPE='Sale' and INVOICECHAR LIKE '". $curyear."'");
	if ($invno >=99)
	{
		
		echo "RS/" .$invno."/".$prevyear ."-".$curyear;
	}
	elseif ($invno >=9)
	{
		
		echo "RS/"."0".$invno."/".$prevyear."-".$curyear;
	}
	else
	{
	
		echo "RS/" ."00".$invno."/".$prevyear."-".$curyear;
	}
	
	
}

else if(isset($_POST["invoicechar"]) && $_POST["invoicechar"] != "")
{
	$inno= getFieldDetail(PURCHASESALE,"count(*)"," WHERE VOUCHERTYPE='Sale' and INVOICECHAR='".$_POST["invoicechar"]."'");
	if($inno > 0 )
	{
		echo 0;
	}
	else
	{
			echo 1;
	}
}
?>