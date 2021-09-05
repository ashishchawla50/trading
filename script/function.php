<?php
include("list.php");
function getRapPrice($shape,$color,$clarity,$weight)
{
	$shape = getShape($shape);
    $color = getColor($color);
	$clarity = getClarity($clarity);
	$rapprice = "";
    if($weight > 5.99 And $weight < 10)
	{
		 $rapprice = getFieldDetail(DIAMONDPRICE, "PRICE", " WHERE SHAPE='" . strtoupper($shape) . "' AND CLARITY='" . strtoupper($clarity) . "' AND COLOR='" . $color . "' AND LOWSIZE = 5 AND HIGHSIZE = 5.99  AND STATUS=''");
	}
     else
	 {
		 $rapprice = getFieldDetail(DIAMONDPRICE, "PRICE", " WHERE SHAPE='" .strtoupper($shape) . "' AND CLARITY='" . strtoupper($clarity) . "' AND COLOR='" . $color . "' AND " . $weight ." BETWEEN LOWSIZE AND HIGHSIZE  AND STATUS=''");
	 }
    return $rapprice;        
}
function getClarity($clarity)
{
	if($clarity != "")
	  {
		  $clarity = strtoupper($clarity);
		  switch(trim($clarity))
		  {
			  case "IF":
			  case "FL":
				return "IF";
			break;
			default:
				return $clarity;
		  }
	  }
	 else
	 {
		 return "";
	 }
	
}

function getShape($shape)
{
	if($shape != "")
	  {
		  $shape = strtoupper($shape);
		  switch(trim($shape))
		  {
			  case "RBC":
			  case "ROUND BRILLIENT":
			  case "ROUND BRILLIANT":
			  case "ROUND":
				return "ROUND";
			break;
			default:
				return "PEAR";
		  }
	  }
	 else
	 {
		 return "";
	 }
	
}
function getColor($color)
{
		
	  if($color != "")
	  {
		  $color = strpos($color,",") ? substr($color,0,1) :$color;
		  $color = strtoupper($color);
		  switch(trim($color))
		  {
			case "D":
			case "E":
			case "F":
			case "G":
			case "H":
			case "I":
			case "J":
			case "K":
			case "L":
			case "M":
				return $color;
			break;
			default:
				return "M";
			break;
		  }
	  }
      else
		   {
			   return "";
		   }
}
//============================ getList($ListName,$Selected='')=====================================

function getList($ListName,$Selected='',$disabled='')
{
	global $LIST;
	$keysarr = array_keys($LIST[$ListName]);
	$idx=0;
	foreach($LIST[$ListName] as $temp)
	{
		echo '<option value="'.$keysarr[$idx].'" '.($keysarr[$idx]==$Selected ? 'selected="selected"' : $disabled ).' >'.$temp.'</option>';
		$idx++;
	}
}

//============================ getList($ListName,$Selected='')=====================================


//============================ getData($TableName,$Field,$Condition='')=====================================
function getData($TableName,$FieldArr,$Condition='')
{
	global $con ;
	
	$Field = implode(",",$FieldArr);
	//echo "<br>SELECT ".$Field." FROM ".$TableName.$Condition;
	//exit;
	$res = mysqli_query($con,"SELECT ".$Field." FROM ".$TableName.$Condition);
	//$resdata = mysqli_fetch_all($res,MYSQLI_ASSOC);
	//mysqli_close($con);
	return $res;
	
}
//============================ getData($TableName,$Field,$Condition='')=====================================

//============================ onlyexeQuery($QueryStr)=====================================
function onlyexeQuery($QueryStr)
{
	global $con ;
	mysqli_query($con,$QueryStr);
		
}
//============================ exeQuery($QueryStr)=====================================

//============================ exeQuery($QueryStr)=====================================
function exeQuery($QueryStr)
{
	global $con ;
	
	//echo $QueryStr;
	$res = mysqli_query($con,$QueryStr);
	//$con->close();
	return $res;
	
}
//============================ exeQuery($QueryStr)=====================================


//============================ exeQuery($QueryStr)=====================================

function getFieldDetail($TableName,$Field,$Condition='')
{
	global $con ;
	//echo "SELECT ".$Field." FROM ".$TableName.$Condition;
	
	$res = mysqli_query($con,"SELECT ".$Field." FROM ".$TableName.$Condition);
	$resdata = mysqli_fetch_array($res);
	//return $resdata[$Field];
	$ans = isset($resdata[0]) ? $resdata[0] : '';
	//mysqli_close($con);
	return $ans;
}
//============================ exeQuery($QueryStr)=====================================

//============================ exeModifyQuery($QueryStr)=====================================
function exeModifyQuery($QueryStr)
{
	global $con ;
	
	//echo $QueryStr;
	mysqli_query($con,$QueryStr);
	//$con->close();
}
//============================ exeModifyQuery($QueryStr)=====================================
//============================ exeMultiDeleteQuery($TableName,$Condition)=====================================
function exeMultiDeleteQuery($TableName,$Condition)
{
	global $con ;
	
	$QueryStr = "DELETE FROM " .$TableName . $Condition;
	mysqli_query($con,$QueryStr);
	//$con->close();
}
//============================ exeMultiDeleteQuery($TableName,$Condition)=====================================

//============================ newData($TableName,$Field,$Value)=============================================
function newData($FieldArr,$FieldValueArr,$TableName,$lastId=false)
{
	global $con ;
	
	$Field = implode(",",$FieldArr);
	$Value = implode(",",$FieldValueArr);
 	$InsSql = "INSERT INTO ".$TableName. "(".$Field.")"." VALUES(".$Value.")";

	mysqli_query($con,$InsSql);
	$ANS = mysqli_insert_id($con);
	//$con->close();
	if ($lastId)
	{
		return $ANS;
	}
}
//============================ newData($TableName,$Field,$Value)=============================================

//============================ editData($TableName,$FieldValue,$Condition)=====================================
function editData($FieldArr,$FieldValueArr,$TableName,$Condition="")
{
	global $con ;
	
	$cnt = 0;
	$FieldValue='';
	foreach ($FieldArr as $temp)
	{
		$FieldValue .= $temp ."=".$FieldValueArr[$cnt++].",";
	}
	$FieldValue = substr($FieldValue,0,strlen($FieldValue)-1);
	$UpaSql = "UPDATE ".$TableName. " SET ". $FieldValue . $Condition;
	mysqli_query($con,$UpaSql);
	//$con->close();
}
//============================ editData($TableName,$FieldValue,$Condition)=====================================


//============================ deleteData($TableName,$Condition)=====================================

function deleteData($TableName,$Condition)
{
	global $con ;
	
	$DelSql = "DELETE FROM ".$TableName.$Condition;
	mysqli_query($con,$DelSql);
	//$con->close();
	}
//============================ deleteData($TableName,$Condition)=====================================

//============================ getMaxValue_TRAN($TableName,$FieldName)=====================================
function getMaxValue_TRAN($TableName,$FieldName)
	{
		global $con ;
		$count_CR = getFieldDetail(LEDGER_CREDIT,"count(*)","");
		$count_DR = getFieldDetail(LEDGER_DEBIT,"count(*)","");
		
		$MaxVal ='';
		if($count_CR > $count_DR) 
		{
			$count_CR = mysqli_query($con,"select max(".$FieldName.") as 'maxval' from ".LEDGER_CREDIT);
			while( $row = mysqli_fetch_array($count_CR) ) 
			{
				$MaxVal = $row["maxval"];
			}
			return ($MaxVal+1);
		}
		else
		{
			$count_DR = mysqli_query($con,"select max(".$FieldName.") as 'maxval' from ".LEDGER_DEBIT);
			while( $row = mysqli_fetch_array($count_DR) ) 
			{
				$MaxVal = $row["maxval"];
			}
			return ($MaxVal+1);
		}
	}
//============================ getMaxValue_TRAN($TableName,$FieldName)=====================================

//============================ getMaxValue($TableName,$FieldName)=====================================
function getMaxValue($TableName,$FieldName)
	{
		global $con ;
		
		//echo "select max(".$FieldName.") as 'maxval' from ".$TableName;
		$count = mysqli_query($con,"select max(".$FieldName.") as 'maxval' from ".$TableName);
		$MaxVal ='';
		if(mysqli_num_rows($count) > 0) 
		{
			while( $row = mysqli_fetch_array($count) ) 
			{
				$MaxVal = $row["maxval"];
			}
			//$con->close();
			return ($MaxVal+1);
		}
		else
		{
			//$con->close();
			return 1;
		}
	}
//============================ getMaxValue($TableName,$FieldName)=====================================


//============================ ImageUpload($ObjName,$Path)=====================================

function ImageUpload($ObjName,$Path,$ImageName)
{
	if ($_FILES[$ObjName]["error"] > 0)
	{
		echo "Error: " . $_FILES[$ObjName]["error"] . "<br>";
		exit();
	}
	else
	{
		$Path.$ImageName;				  
		if (file_exists($Path.$ImageName))
		{
		 	echo $_FILES[$ObjName]["name"] . " already exists. ";
			exit();
		}
		else
		{
			 move_uploaded_file($_FILES[$ObjName]["tmp_name"],$Path.$ImageName);
		}
	}
	
	return $Path.$ImageName;
}
//============================ ImageUpload($ObjName,$Path)=====================================




//============================ getDateFormat()=====================================
function getDateFormat($tempdate)
{
	return date('d-m-Y',strtotime($tempdate));
}
//============================ getDateFormat()=====================================
//============================ getDateTimeFormat()=====================================
function getDateTimeFormat($tempdate)
{
	return date('d-m-Y H:i:s',strtotime($tempdate));
}
//============================ getDateTimeFormat()=====================================

//============================ getDateFormat()=====================================

 function getCurrFormat($number){ 
return sprintf("%.2f",$number); 
        /*$decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
 
        return $result;*/
    }
	
/*function getCurrFormat($tempamoount)
{
	return number_format((float)$tempamoount, 2, '.', ',');
}*/
function getCurrFormat0($tempamoount)
{
	$ANS = getCurrFormat($tempamoount);
	return $ANS;
}
//============================ getDateFormat()=====================================


//============================ checkData($fieldvalue)=====================================
function checkData($fieldvalue)
{
	return empty($fieldvalue) ? '-' : $fieldvalue;
}
//============================ checkData($fieldvalue)=====================================
//============================ compress_image($source_url, $destination_url, $quality)=====================================

function compress_image($source_url, $destination_url, $quality) 
{
	$info = getimagesize($source_url); 
	if ($info['mime'] == 'image/jpeg') 
		$image = imagecreatefromjpeg($source_url); 
	elseif ($info['mime'] == 'image/gif') 
		$image = imagecreatefromgif($source_url); 
	elseif ($info['mime'] == 'image/png') 
		$image = imagecreatefrompng($source_url); 
	imagejpeg($image, $destination_url, $quality); 
	return $destination_url; 
}
//============================ compress_image($source_url, $destination_url, $quality)=====================================
//============================ checkData($fieldvalue)=====================================
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  //============================================getClosingBalanceonearg($groupid)========================================================
   function getClosingBalanceonearg($groupid)
  {
	
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "'   ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "'  ");
	
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= abs($bal);
	$arr[1]= $bal < 0 ? 'Cr' : 'Dr';
	return $arr;
  }
  
  //=================================================getClosingBalanceonearg($groupid)===================================================
  //============================ getClosingBalance($fromdt,$todate,$groupid,$group_ledger_status)=====================================
 function getClosingBalance($fromdt,$todate,$groupid,$group_ledger_status)
  {
	if($group_ledger_status)
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE GROUPID='" .$groupid . "' AND VOUCHERDATE <='". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE GROUPID='" . $groupid . "' AND VOUCHERDATE <='" .$todate . "' ");
	}
	else
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE <='". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE <='" . $todate . "' ");
	}
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= round(abs($bal),2);
	$arr[1]= $bal < 0 ? 'Cr' : ($bal > 0 ? 'Dr' : '');
	return $arr;
  }
 
//============================================================================================================= 
function getDollarClosingBalance($fromdt,$todate,$groupid,$group_ledger_status)
{
 if($group_ledger_status)
 {
  $CR_AMTDOLLAR  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNTDOLLAR)", " WHERE GROUPID='" .$groupid . "' AND VOUCHERDATE <='". $todate . "' ");

  $DR_AMTDOLLAR  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNTDOLLAR)", " WHERE GROUPID='" . $groupid . "' AND VOUCHERDATE <='" .$todate . "' ");
 }
 else
 {
  $CR_AMTDOLLAR  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNTDOLLAR)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE <='". $todate . "' ");

  $DR_AMTDOLLAR  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNTDOLLAR)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE <='" . $todate . "' ");
 }
 $dollarbal = ((($DR_AMTDOLLAR - $CR_AMTDOLLAR)) > 0? (($DR_AMTDOLLAR - $CR_AMTDOLLAR)): ($DR_AMTDOLLAR - $CR_AMTDOLLAR));
 $arr[0]= abs($dollarbal);
	$arr[1]= $dollarbal < 0 ? 'Cr' : ($dollarbal > 0 ? 'Dr' : '');
 return $arr;
  }
  //===============================================================================================================
function getRmbClosingBalance($fromdt,$todate,$groupid,$group_ledger_status)
  {
	if($group_ledger_status)
	{
	$CR_AMTRMB  = getfielddetail(LEDGER_CREDIT, "SUM(RMBAMOUNT)", " WHERE GROUPID='" .$groupid . "' AND VOUCHERDATE <='". $todate . "' ");

	$DR_AMTRMB  = getfielddetail(LEDGER_DEBIT, "SUM(RMBAMOUNT)", " WHERE GROUPID='" . $groupid . "' AND VOUCHERDATE <='" .$todate . "' ");
	}
	else
	{
	$CR_AMTRMB  = getfielddetail(LEDGER_CREDIT, "SUM(RMBAMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE <='". $todate . "' ");

	$DR_AMTRMB  = getfielddetail(LEDGER_DEBIT, "SUM(RMBAMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE <='" . $todate . "' ");
	}
	 $rmbbal = ((($DR_AMTRMB - $CR_AMTRMB)) > 0? (($DR_AMTRMB - $CR_AMTRMB)): ($DR_AMTRMB - $CR_AMTRMB));
	 $arr[0]= abs($rmbbal);
	 $arr[1]= $rmbbal < 0 ? 'Cr' : ($rmbbal > 0 ? 'Dr' : '');
	 return $arr;
  }
  
  
  //==========================profiloss schedual amount=================================================================
   function getClosingBalanceledger($fromdt,$todate,$groupid,$ledgerid)
  {
	
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE GROUPID='".$groupid."' AND LEDGERID='" . $ledgerid . "'  AND VOUCHERDATE <='". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE GROUPID='".$groupid."' AND LEDGERID='" . $ledgerid . "'   AND VOUCHERDATE <='". $todate . "' ");
	
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= round(abs($bal),2);
	$arr[1]= $bal < 0 ? 'Cr' : ($bal > 0 ? 'Dr' : '');
	return $arr;
  }
    //==========================profiloss schedual dollar=================================================================
   function getdollarClosingBalanceledger($fromdt,$todate,$groupid,$ledgerid)
  {
	
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNTDOLLAR)", " WHERE GROUPID='".$groupid."' AND LEDGERID='" . $ledgerid . "'  AND VOUCHERDATE <='". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNTDOLLAR)", " WHERE GROUPID='".$groupid."' AND LEDGERID='" . $ledgerid . "'   AND VOUCHERDATE <='". $todate . "' ");
	
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= abs($bal);
$arr[1]= $bal < 0 ? 'Cr' : ($bal > 0 ? 'Dr' : '');
	return $arr;
  }
   //==========================profiloss schedual rmb=================================================================
   function getrmbClosingBalanceledger($fromdt,$todate,$groupid,$ledgerid)
  {
	
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(RMBAMOUNT)", " WHERE GROUPID='".$groupid."' AND LEDGERID='" . $ledgerid . "'  AND VOUCHERDATE <='". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(RMBAMOUNT)", " WHERE GROUPID='".$groupid."' AND LEDGERID='" . $ledgerid . "'   AND VOUCHERDATE <='". $todate . "' ");
	
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= abs($bal);
	$arr[1]= $bal < 0 ? 'Cr' : ($bal > 0 ? 'Dr' : '');
	return $arr;
  }
  
  
  
 //========================getOpeningData($fromdt,$todate,$groupid,$group_ledger_status)==========================================
  
  
  function getOpeningData($fromdt,$groupid,$group_ledger_status)
  {
	  
	if($group_ledger_status)
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE GROUPID='" .$groupid . "' AND VOUCHERDATE  < '". $fromdt ."' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE GROUPID='" . $groupid . "' AND VOUCHERDATE  < '". $fromdt ."' ");
	}
	else
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE < '". $fromdt ."' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE  < '". $fromdt ."'");
	}
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= abs($bal);
	$arr[1]= $bal < 0 ? 'Cr' : 'Dr';
	return $arr;
  }
  
  
  
   //========================getOpeningData($fromdt,$todate,$groupid,$group_ledger_status)==========================================
   

 //========================getBetweenData($fromdt,$todate,$groupid,$group_ledger_status)==========================================
  
  
  function getBetweenData($fromdt,$todate,$groupid,$group_ledger_status)
  {
	  
	if($group_ledger_status)
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE GROUPID='" .$groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE GROUPID='" . $groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '" .$todate . "' ");
	}
	else
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE between '". $fromdt ."' and '". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '" . $todate . "' ");
	}
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]=  round(abs($bal),2); //abs($bal);
	$arr[1]= $bal < 0 ? 'Cr' : 'Dr';
	return $arr;
  }
  
  
  
   //========================getDollarBetweenData($fromdt,$todate,$groupid,$group_ledger_status)==========================================
  
  
  function getDollarBetweenData($fromdt,$todate,$groupid,$group_ledger_status)
  {
	if($group_ledger_status)
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNTDOLLAR)", " WHERE GROUPID='" .$groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNTDOLLAR)", " WHERE GROUPID='" . $groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '" .$todate . "' ");
	}
	else
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNTDOLLAR)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE between '". $fromdt ."' and '". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNTDOLLAR)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '" . $todate . "' ");
	}
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= abs($bal);
	$arr[1]= $bal < 0 ? 'Cr' : 'Dr';
	return $arr;
  }
  
   //========================getRMBBetweenData($fromdt,$todate,$groupid,$group_ledger_status)==========================================
  
  
  function getRMBBetweenData($fromdt,$todate,$groupid,$group_ledger_status)
  {
	if($group_ledger_status)
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(RMBAMOUNT)", " WHERE GROUPID='" .$groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(RMBAMOUNT)", " WHERE GROUPID='" . $groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '" .$todate . "' ");
	}
	else
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(RMBAMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE between '". $fromdt ."' and '". $todate . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(RMBAMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE  between '". $fromdt ."' and '" . $todate . "' ");
	}
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= abs($bal);
	$arr[1]= $bal < 0 ? 'Cr' : 'Dr';
	return $arr;
  }
  
  function getClosingBalanceCapital($fromdt,$todate,$groupid,$group_ledger_status)
  {
	if($group_ledger_status)
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE GROUPID='" .$groupid . "' AND VOUCHERDATE <='". $fromdt . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE GROUPID='" . $groupid . "' AND VOUCHERDATE <='" .$fromdt . "' ");
	}
	else
	{
		$CR_AMT  = getfielddetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE <='". $fromdt . "' ");

		$DR_AMT  = getfielddetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='" . $groupid . "' AND VOUCHERDATE <='" . $fromdt . "' ");
	}
	$bal = ((($DR_AMT - $CR_AMT)) > 0? (($DR_AMT - $CR_AMT)): ($DR_AMT - $CR_AMT));
	$arr[0]= abs($bal);
	$arr[1]= $bal < 0 ? 'Cr' : ($bal > 0 ? 'Dr' : '');
	return $arr;
  }
 //==========================
 function backupTables()
    {
		
		global $con ;
        $tables = array();
                $result = mysqli_query($con,'SHOW TABLES');
                while($row = mysqli_fetch_row($result))
                {
                    $tables[] = $row[0];
                }

            $sql = 'CREATE DATABASE IF NOT EXISTS '.DB_NAME.";\n\n";
            $sql .= 'USE '.DB_NAME.";\n\n";
			 foreach($tables as $table)
            {
                //echo "Backing up ".$table." table...";

                $result = mysqli_query($con,'SELECT * FROM '.$table);
                $numFields = mysqli_num_fields($result);

                $sql .= 'DROP TABLE IF EXISTS '.$table.';';
                $row2 = mysqli_fetch_row(mysqli_query($con,'SHOW CREATE TABLE '.$table));
                $sql.= "\n\n".$row2[1].";\n\n";

                for ($i = 0; $i < $numFields; $i++) 
                {
                    while($row = mysqli_fetch_row($result))
                    {
                        $sql .= 'INSERT INTO '.$table.' VALUES(';
                        for($j=0; $j<$numFields; $j++) 
                        {
                            $row[$j] = addslashes($row[$j]);
                            if (isset($row[$j]))
                            {
                                $sql .= '"'.$row[$j].'"' ;
                            }
                            else
                            {
                                $sql.= '""';
                            }

                            if ($j < ($numFields-1))
                            {
                                $sql .= ',';
                            }
                        }

                        $sql.= ");\n";
                    }
                }

                $sql.="\n\n\n";

              // echo " OK" . "";
            }
			
			
			$strFileName = "upload/db_backup/db-backup-".date("Ymd-His", time()).".sql";
			try
			{
				$handle = fopen($strFileName,'w+');
				fwrite($handle, $sql);
				fclose($handle);
			}
			catch (Exception $e)
			{
				var_dump($e->getMessage());
				
			}
			return $strFileName;
		
    }
  
?>
