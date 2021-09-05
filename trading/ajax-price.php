<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");
//require_once('lib/nusoap.php'); 
//$rapid=getFieldDetail(COMPANY,"RAPNETID"," WHERE COMPANYID='1'");
//$rappass=getFieldDetail(COMPANY,"RAPNETPASSWORD"," WHERE COMPANYID='1'");

	/*$rap_soapUrl = "https://technet.rapaport.com/webservices/prices/rapaportprices.asmx?wsdl"; 
	$soap_Client = new nusoap_client($rap_soapUrl, 'wsdl'); 
	$rap_credentials['Username'] = $rapid; 
		$rap_credentials['Password'] = $rappass;  
		
		$result = $soap_Client->call('Login', $rap_credentials); 
		$rap_auth_ticket = $soap_Client->getHeaders(); 
		if(strtoupper($_POST["shape"]) == "ROUND")
		{
			$paramsA["shape"] = "ROUND";
		}
		else
		{
			$paramsA["shape"] = "PEAR";
		}
		 
		$paramsA["size"] = $_POST["weight"]; 
		$paramsA["color"] = $_POST["color"]; 
		$paramsA["clarity"] = $_POST["clarity"]; 
		$soap_Client->setHeaders($rap_auth_ticket); 
		$result = $soap_Client->call('GetPrice', $paramsA); 
		*/
	
		echo $rap = getRapPrice(strtoupper($_POST["shape"]),$_POST["color"],strtoupper($_POST["clarity"]),$_POST["weight"]);
	
		//echo $result['GetPriceResult']['price']; 	
		
		
		
exit();
?>