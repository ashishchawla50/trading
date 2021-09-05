<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

	$XLSPATH = isset($_FILES["Upload_file_stock"]["tmp_name"]) ? $_FILES["Upload_file_stock"]["tmp_name"] : "";
	$Path = UPLOAD."xls/FILTER/";
	$XLSPATH = $Path."FILTER.xls";
	move_uploaded_file($_FILES["Upload_file_stock"]["tmp_name"],$XLSPATH);
	require_once INIT.'phpExcelReader/Excel/reader.php';
	$data = new Spreadsheet_Excel_Reader();
	$data->read($XLSPATH);
	$row = $data->sheets[0]["cells"];

	
	for($i=2;$i<=count($row);$i++)
	{
	
		$FieldArr_Col = array();
		$FieldArr_Val = array();
	
		$BARCODENO = isset($row[$i][1])? $row[$i][1]:'';
		$AVAILABLE = isset($row[$i][2])? $row[$i][2]:'';
		$LOCATION=isset($row[$i][37])? $row[$i][37]:'';
		$RAPDISCOUNT = isset($row[$i][17])? $row[$i][17]:'';
		$DIAMONDIMAGE = isset($row[$i][43])? $row[$i][43]:'';
			
		array_push($FieldArr_Col,"AVAILABLE");
		array_push($FieldArr_Val,"'".$AVAILABLE."'");
		array_push($FieldArr_Col,"LOCATIONNAME");
		array_push($FieldArr_Val,"'".$LOCATION."'");
		array_push($FieldArr_Col,"RAPDISCOUNT");
		array_push($FieldArr_Val,"'".$RAPDISCOUNT."'");
		array_push($FieldArr_Col,"DIAMONDIMAGE");
		array_push($FieldArr_Val,"'".$DIAMONDIMAGE."'");
		$entid = getFieldDetail(BARCODE_PROCESS,"ENTRYID"," WHERE BARCODENO='".$BARCODENO."' AND PROCESSTYPE IN ('Purchase','Memo Issue','Memo Receive') and ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." WHERE BARCODENO='".$BARCODENO."' GROUP BY BARCODENO)");
		editData($FieldArr_Col,$FieldArr_Val,BARCODE_PROCESS," WHERE ENTRYID='".$entid."'");
	}
	
?>
