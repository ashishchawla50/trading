<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

$XLSPATH = isset($_FILES["Upload_file_aavakjaavak"]["tmp_name"]) ? $_FILES["Upload_file_aavakjaavak"]["tmp_name"] : "";
	$Path = UPLOAD."xls/AAVAKJAAVAK/";
	$XLSPATH = $Path."AAVAKJAAVAK.xls";
	move_uploaded_file($_FILES["Upload_file_aavakjaavak"]["tmp_name"],$XLSPATH);
	require_once INIT.'phpExcelReader/Excel/reader.php';
	$data = new Spreadsheet_Excel_Reader();
	$data->read($XLSPATH);
	 $row = $data->sheets[0]["cells"];
	//$last_ENTRYID= getMaxValue(CASHREGISTER, "ENTRYID");
	//$last_= $last_ENTRYID;
	
	
	$FILENAME_VTYPE = $_POST["FILENAME"];
	$VDATE = $_POST["dtpVDATE"];
	
	for($i=2;$i<=count($row);$i++)
	{
		$FieldArr_Col = array();
		$FieldArr_Val = array();
	
	    
		

		$AAVAK = isset($row[$i][2])? $row[$i][2]:'';
		$AAVAKDETAIL=isset($row[$i][3])? $row[$i][3]:'';
		$AAVAKDETAIL2 = isset($row[$i][4])? $row[$i][4]:'';
		$AAVAKDETAIL3 = isset($row[$i][5])? $row[$i][5]:'';
			
			array_push($FieldArr_Col,"VDATE");
			array_push($FieldArr_Val,"'".$VDATE."'");
			array_push($FieldArr_Col,"VTYPE");
			array_push($FieldArr_Val,"'".$FILENAME_VTYPE."-Receipt'");
			array_push($FieldArr_Col,"PARTYNAME");
			array_push($FieldArr_Val,"'".$AAVAKDETAIL."'");
			array_push($FieldArr_Col,"AMOUNT");
			array_push($FieldArr_Val,$AAVAK);
			array_push($FieldArr_Col,"REMARK");
			array_push($FieldArr_Val,"'".$AAVAKDETAIL2."'");
			array_push($FieldArr_Col,"REMARK2");
			array_push($FieldArr_Val,"'".$AAVAKDETAIL3."'");
			array_push($FieldArr_Col,"ENTRYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldArr_Col,"UPDATEDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			array_push($FieldArr_Col,"USERNAME");
			array_push($FieldArr_Val,"'".$loginuser_name."'");
			array_push($FieldArr_Col,"FLAG");
			array_push($FieldArr_Val,"'0'");
			
				newData($FieldArr_Col,$FieldArr_Val,CASHREGISTER,false);
	}
	for($i=2;$i<=count($row);$i++)
	{	
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	
	 $DATE = isset($row[$i][1])? $row[$i][1]:'';
		
		$VDATE = $_POST["dtpVDATE"];
		
		$JAAVAK = isset($row[$i][7])? $row[$i][7]:'';
		$JAAVAKDETAIL=isset($row[$i][8])? $row[$i][8]:'';
		$JAAVAKDETAIL2 = isset($row[$i][9])? $row[$i][9]:'';
		$JAAVAKDETAIL3 = isset($row[$i][10])? $row[$i][10]:'';
			
			array_push($FieldArr_Col,"VDATE");
			array_push($FieldArr_Val,"'".$VDATE."'");
			array_push($FieldArr_Col,"VTYPE");
			array_push($FieldArr_Val,"'".$FILENAME_VTYPE."-Payment'");
			array_push($FieldArr_Col,"PARTYNAME");
			array_push($FieldArr_Val,"'".$JAAVAKDETAIL."'");
			array_push($FieldArr_Col,"AMOUNT");
			array_push($FieldArr_Val,$JAAVAK);
			array_push($FieldArr_Col,"REMARK");
			array_push($FieldArr_Val,"'".$JAAVAKDETAIL2."'");
			array_push($FieldArr_Col,"REMARK2");
			array_push($FieldArr_Val,"'".$JAAVAKDETAIL3."'");
		
		array_push($FieldArr_Col,"ENTRYDATE");
		array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
		array_push($FieldArr_Col,"UPDATEDATE");
		array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
		array_push($FieldArr_Col,"USERNAME");
		array_push($FieldArr_Val,"'".$loginuser_name."'");
		array_push($FieldArr_Col,"FLAG");
		array_push($FieldArr_Val,"'0'");
		
	
		newData($FieldArr_Col,$FieldArr_Val,CASHREGISTER,false);
	}

?>
