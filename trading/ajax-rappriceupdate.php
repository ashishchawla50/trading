<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

$rapid=getFieldDetail(COMPANY,"RAPNETID"," WHERE COMPANYID='1'");
$rappass=getFieldDetail(COMPANY,"RAPNETPASSWORD"," WHERE COMPANYID='1'");
require_once('lib/nusoap.php'); 


//prepare soap request to Rapaport: 
$rap_soapUrl = "https://technet.rapaport.com/webservices/prices/rapaportprices.asmx?wsdl"; 
$soap_Client = new nusoap_client($rap_soapUrl, 'wsdl'); 
$rap_credentials['Username'] = $rapid;  
$rap_credentials['Password'] = $rappass;  

//do login, and save authentication ticket for further use: 
$result = $soap_Client->call('Login', $rap_credentials); 
$rap_auth_ticket = $soap_Client->getHeaders(); 

//get complete price sheet, and save as a file (call this both for Round and Pear): 
$paramsB["shape"] = $_GET["priceshape"]; 
$soap_Client->setHeaders($rap_auth_ticket); 
$result = $soap_Client->call('GetPriceSheet', $paramsB); 


$i=0;

$rowcnt = count($result['GetPriceSheetResult']['Prices']['diffgram']['NewDataSet']['Table']);

$FieldArr_Col = array();
$FieldArr_Val = array();
array_push($FieldArr_Col,"STATUS");
array_push($FieldArr_Val,"'D'");	
editData($FieldArr_Col,$FieldArr_Val,DIAMONDPRICE," WHERE SHAPE='".$_GET["priceshape"]."'");
	
for($i=0;$i<$rowcnt;$i++) 
{
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	$PRICEDATE = $result['GetPriceSheetResult']['!Date']; 
	$SHAPE = $result['GetPriceSheetResult']['!Shape']; 
	$LOWSIZE =$result['GetPriceSheetResult']['Prices']['diffgram']['NewDataSet']['Table'][$i]['LowSize']; 
	$HIGHSIZE =$result['GetPriceSheetResult']['Prices']['diffgram']['NewDataSet']['Table'][$i]['HighSize']; 
	$COLOR =$result['GetPriceSheetResult']['Prices']['diffgram']['NewDataSet']['Table'][$i]['Color']; 
	$CLARITY =$result['GetPriceSheetResult']['Prices']['diffgram']['NewDataSet']['Table'][$i]['Clarity']; 
	$PRICE = $result['GetPriceSheetResult']['Prices']['diffgram']['NewDataSet']['Table'][$i]['Price']; 
	
	array_push($FieldArr_Col,"PRICEDATE");
	array_push($FieldArr_Val,"'".$PRICEDATE."'");
	array_push($FieldArr_Col,"SHAPE");
	array_push($FieldArr_Val,"'".$SHAPE."'");
	array_push($FieldArr_Col,"LOWSIZE");
	array_push($FieldArr_Val,"'".$LOWSIZE."'");
	array_push($FieldArr_Col,"HIGHSIZE");
	array_push($FieldArr_Val,"'".$HIGHSIZE."'");
	array_push($FieldArr_Col,"COLOR");
	array_push($FieldArr_Val,"'".$COLOR."'");
	array_push($FieldArr_Col,"CLARITY");
	array_push($FieldArr_Val,"'".$CLARITY."'");
	array_push($FieldArr_Col,"PRICE");
	array_push($FieldArr_Val,"'".$PRICE."'");
	array_push($FieldArr_Col,"STATUS");
	array_push($FieldArr_Val,"''");	
	newData($FieldArr_Col,$FieldArr_Val,DIAMONDPRICE,FALSE);	

}
exit();
?>