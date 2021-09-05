<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");
$ledid = isset($_POST["tpid"]) ? $_POST["tpid"] :'';
$broid = isset($_POST["tbid"]) ? $_POST["tbid"] :'';

$arr = array();
array_push($arr,"ID");
//array_push($arr,"if(VOUCHERTYPE='Sale',INVOICENO,ID) as I_ID");
array_push($arr,"ID as I_ID");
array_push($arr,"VOUCHERTYPE");
array_push($arr,"PS.VOUCHERDATE");
array_push($arr,"L.LEDGERNAME");
array_push($arr,"DUEDAYS");
array_push($arr,"DUEDATE");
array_push($arr,"CONVRATE");
array_push($arr,"TOTALRSAMOUNT");
array_push($arr,"B.LEDGERNAME as BROKER");
array_push($arr,"PS.REMARK");
array_push($arr,"PS.LEDGERID");
array_push($arr,"CONVSTATUS");
array_push($arr,"TOTALDOLLAR");
array_push($arr,"TOTALRMBAMOUNT");
array_push($arr,"LASTAMOUNT AS GRANDAMOUNT");
if(empty($ledid) && empty($broid))
{
	$COND = "";
}
elseif(!empty($ledid) && empty($broid))
{
	$COND = " AND PS.LEDGERID='".$ledid."'";
}
elseif(empty($ledid) && !empty($broid))
{
	$COND = " AND PS.BROKERID='".$broid."'";
}
else
{
	$COND = " AND PS.LEDGERID='".$ledid."' AND PS.BROKERID='".$broid."'";
}

//if($_POST["flname"] == "tran-bankpayment" || $_POST["flname"] == "tran-cashpayment")
if($_POST["flname"] == "tran-bankpayment" || $_POST["flname"] == "tran-cashpayment" || $_POST["flname"] == "tran-journalpayment")
{
	$res = getData(PURCHASESALE,$arr," AS PS INNER JOIN ".LEDGER." L ON L.LEDGERID=PS.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=PS.BROKERID WHERE  PS.VOUCHERTYPE='Purchase' ".$COND . " ORDER BY PS.DUEDATE");
}
else
{
	$res = getData(PURCHASESALE,$arr," AS PS INNER JOIN ".LEDGER." L ON L.LEDGERID=PS.LEDGERID LEFT JOIN ".LEDGER." AS B on B.LEDGERID=PS.BROKERID WHERE  PS.VOUCHERTYPE='Sale' ".$COND . " ORDER BY PS.DUEDATE");
}

if(mysqli_num_rows($res) > 0)
{
	while($resdata = mysqli_fetch_assoc($res))
	{
		$TOTALRSAMOUNT = $resdata["GRANDAMOUNT"];
		$TOTALDOLLAR = $resdata["TOTALDOLLAR"];
		$TOTALRMBAMOUNT = $resdata["TOTALRMBAMOUNT"];
		$DUEAMOUNT = $resdata["GRANDAMOUNT"];
		
		if($resdata["VOUCHERTYPE"] == 'Purchase')
		{
			$paidamt = getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNT)"," WHERE VOUCHERNO='".$resdata["ID"]."' AND IDTYPE='Purchase' AND LEDGERID='".$resdata["LEDGERID"]."'");
			$DUEAMOUNT = $TOTALRSAMOUNT - $paidamt;
			
			$paidamt_DOLLAR = getFieldDetail(LEDGER_DEBIT,"SUM(AMOUNTDOLLAR)"," WHERE VOUCHERNO='".$resdata["ID"]."' AND IDTYPE='Purchase' AND LEDGERID='".$resdata["LEDGERID"]."'");
			$DUEDOLLAR = $TOTALDOLLAR - $paidamt_DOLLAR;
			
			$paidamt_RMB = getFieldDetail(LEDGER_DEBIT,"SUM(RMBAMOUNT)"," WHERE VOUCHERNO='".$resdata["ID"]."' AND IDTYPE='Purchase' AND LEDGERID='".$resdata["LEDGERID"]."'");
			$DUERMB = $TOTALRMBAMOUNT - $paidamt_RMB;
		}
		else{
			$paidamt = getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNT)"," WHERE VOUCHERNO='".$resdata["ID"]."' AND IDTYPE='Sale' AND LEDGERID='".$resdata["LEDGERID"]."'");
			$DUEAMOUNT = $TOTALRSAMOUNT - $paidamt;
			
			$paidamt_DOLLAR = getFieldDetail(LEDGER_CREDIT,"SUM(AMOUNTDOLLAR)"," WHERE VOUCHERNO='".$resdata["ID"]."' AND IDTYPE='Sale' AND LEDGERID='".$resdata["LEDGERID"]."'");
			$DUEDOLLAR = $TOTALDOLLAR - $paidamt_DOLLAR;
			
			$paidamt_RMB = getFieldDetail(LEDGER_CREDIT,"SUM(RMBAMOUNT)"," WHERE VOUCHERNO='".$resdata["ID"]."' AND IDTYPE='Sale' AND LEDGERID='".$resdata["LEDGERID"]."'");
			$DUERMB = $TOTALRMBAMOUNT - $paidamt_RMB;
		}
		
		?>
		<tr>
			<td><input type='checkbox' name="radID[]" class="radID" value="<?php echo $resdata["ID"];?>"/></td>
			<td><?php echo $resdata["I_ID"];?></td>
			<td><?php echo $resdata["VOUCHERTYPE"];?>
				<input  type="hidden" name="txtCONVSTATUS<?php echo $resdata["ID"]?>" id="txtCONVSTATUS<?php echo $resdata["ID"]?>" value="<?php echo $resdata["CONVSTATUS"];?>" />
				<input  type="hidden" name="txtCONVRATE<?php echo $resdata["ID"]?>" id="txtCONVRATE<?php echo $resdata["ID"]?>" value="<?php echo $resdata["CONVRATE"];?>" />
				<input  type="hidden" name="txtVOUCHERTYPE<?php echo $resdata["ID"]?>" id="txtVOUCHERTYPE<?php echo $resdata["ID"]?>" value="<?php echo $resdata["VOUCHERTYPE"];?>" />
			</td>
			<td><?php echo getDateFormat($resdata["VOUCHERDATE"]);?></td>
			<td><?php echo $resdata["LEDGERNAME"];?></td>
			<td style="text-align:right;"><?php echo $resdata["DUEDAYS"];?></td>
			<td><?php echo getDateFormat($resdata["DUEDATE"]);?></td>
			<td style="text-align:right;"><?php echo $resdata["CONVRATE"];?></td>
			<td style="text-align:right;"><?php echo $resdata["GRANDAMOUNT"];?></td>
			<td ><?php echo $resdata["BROKER"];?></td>
			<td style="text-align:right;"><?php echo round($DUEDOLLAR,2);?></td>
			
			
			<input  type="hidden" name="txtDUEAMOUNT<?php echo $resdata["ID"]?>" id="txtDUEAMOUNT<?php echo $resdata["ID"]?>" value="<?php echo round($DUEAMOUNT,2);?>" />
			</td>
			
			<td style="text-align:right;"><?php echo round($DUERMB,2);?></td>
			<td style="text-align:right;"><?php echo round($DUEAMOUNT,2);?>
			<td><?php echo $resdata["REMARK"];?></td>
										
		</tr>
		<?php
	}
}
else
{
	
}


?>
