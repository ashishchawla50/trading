<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

$fieldarr = array();
$fieldvaluearr = array();

$arr = array();
$arr = explode("-",$_GET["bar_field"]);
if(isset($_GET["bar_field"]) && isset($_GET["bar_disc"]))
{
	$fieldarr[0]=$arr[0];
	$fieldvaluearr[0]="'".$_GET["bar_disc"]."'";
	$resBar = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO='".$arr[1]."' and ENTRYID='".$_GET["entid"]."'");
	$resBarData = mysqli_fetch_assoc($resBar);
	
	if($resBarData["COLOR"] == ''){
		$rate = $resBarData["CURRRAP"];
	}
	else
	{
		$rate = getRapPrice($resBarData["SHAPE"],$resBarData["COLOR"],$resBarData["CLARITY"],$resBarData["WEIGHT"]);
	}
	
	$WEIGHT = $resBarData["WEIGHT"];  //getFieldDetail(BARCODE_PROCESS,"WEIGHT"," WHERE BARCODENO='".$arr[1]."' and ENTRYID='".$_GET["entid"]."'");
	
	$ans="-";
	$ratedollar= $rate * $WEIGHT;
	if($_GET["bar_disc"] != 0)
	{
		$totaldollar=  $ratedollar * (1 - $_GET["bar_disc"] / 100);
		$percrtdollar= $totaldollar / $WEIGHT;
		array_push($fieldarr,"RAPPERCRT");
		array_push($fieldvaluearr,"'".$percrtdollar."'");
		array_push($fieldarr,"RAPTOTALDOLLAR");
		array_push($fieldvaluearr,"'".$totaldollar."'"); 
		$ans = $percrtdollar ."-" .$totaldollar;
	}
	else
		
		{
		array_push($fieldarr,"RAPPERCRT");
		array_push($fieldvaluearr,"'0'");
		array_push($fieldarr,"RAPTOTALDOLLAR");
		array_push($fieldvaluearr,"'0'"); 
		}
	
	editData($fieldarr,$fieldvaluearr,BARCODE_PROCESS," WHERE BARCODENO='".$arr[1]."' and ENTRYID='".$_GET["entid"]."'");
	echo $ans;
	exit();
}
?>