<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");
$rapid=getFieldDetail(COMPANY,"RAPNETID"," WHERE COMPANYID='1'");
$rappass=getFieldDetail(COMPANY,"RAPNETPASSWORD"," WHERE COMPANYID='1'");

$arr = array();
$PCSsale=getFieldDetail(BARCODE_PROCESS,"sum(PCS)","  WHERE BARCODENO='".$_POST["sid"]."' AND PROCESSTYPE='Sale'");
$PCSpurchase=getFieldDetail(BARCODE_PROCESS,"sum(PCS)","  WHERE BARCODENO='".$_POST["sid"]."' AND PROCESSTYPE='Purchase'");

$WEIGHTsale=getFieldDetail(BARCODE_PROCESS,"sum(WEIGHT)","  WHERE BARCODENO='".$_POST["sid"]."' AND PROCESSTYPE='Sale'");
$WEIGHTpurchase=getFieldDetail(BARCODE_PROCESS,"WEIGHT","  WHERE BARCODENO='".$_POST["sid"]."' AND PROCESSTYPE NOT IN ('Sale') order by ENTRYID DESC");

if($_POST["processtype"] == "PURCHASE" || $_POST["processtype"] == "PARTNERPURCHASE")
{
	$barcnt = getFieldDetail(BARCODE_PROCESS,"count(*)"," where BARCODENO='".$_POST["sid"]."'");
	if($barcnt > 0)
	{
		echo "1";
	}
	else
	{
	
	$BAR_TEMP = substr($_POST["sid"],2);
	?>
	
									
										<td  class="ui-widget">
											<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
											<input type="text" class="form-control onlyCharacter  movecls rapprice " name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="ROUND">
										</td>
											<td>
											<input type="text" class="form-control onlyNumber movecls" name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="1">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber rapprice movecls txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" >
										</td>
										
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter rapprice movecls" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" >
										</td>
										<td  class="ui-widget">
											<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" >
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" >
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text" class="form-control movecls" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text" class="form-control onlyCharacter movecls " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="GIA">
										</td>
										
										
										
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										
										<td class="RMB" <?php echo isset($_POST["RMBSTATUS"]) && $_POST["RMBSTATUS"] == 'Y' ? '' : 'style="display:none;"'?>>
											<input type="text"  class="form-control RMBPERCRT_" name="RMBPERCRT<?php echo $BAR_TEMP;?>" id="RMBPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td class="RMB"  <?php echo isset($_POST["RMBSTATUS"]) && $_POST["RMBSTATUS"] == 'Y' ? '' : 'style="display:none;"'?>>
											<input type="text"  class="form-control RMBAMOUNT_" name="RMBAMOUNT<?php echo $BAR_TEMP;?>" id="RMBAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										
										<td>
											<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td>
											<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>">
										</td>
										<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
									
								<script>
								
								
								$("#LAB"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availableLab
									});
								   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availableShape
									});
										$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availableColor
									});
										$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availableClarity
									});
									$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availablePolish
									});
										$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availableSymm
									});
										$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availableCut
									});
										$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availableFlour
									});
									$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
											source: availableGreen
									});
								
								
								</script>
								<?php
}
								exit();
}

elseif(($WEIGHTpurchase - $WEIGHTsale) > 0 )
{
	
	if($_POST["processtype"] == "SALE")
	{
	
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO ='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) AND PROCESSTYPE IN ('Purchase','Grading Issue','Grading Result','Grading Receive','Memo Issue','Memo Receive','Repair Issue','Recut Receive','Recut Issue')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					$arr["GREEN"]=$resdata["GREEN"];
					$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
						
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATE * $WEIGHT; 
					$CONVRATE = $_POST["convrate"];	
					$RMBRATE = $_POST["rmbrate"];	

					if($RMBRATE > 0)
					{
						$RMBPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
						$RMBAMOUNT= $TOTALDOLLAR * $CONVRATE; 
						$RSPERCRT= $PERCRTDOLLAR * $RMBRATE; 	
						$RSAMOUNT= $TOTALDOLLAR * $RMBRATE;
					}
					else
					{
						$RMBPERCRT= 0; 	
						$RMBAMOUNT= 0; 
						$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
						$RSAMOUNT= $TOTALDOLLAR * $CONVRATE;
					}
					
					 
					
					$DALALIPER_pur= getFieldDetail(PURCHASESALE,"DALALIPER"," WHERE ID='". $resdata["ID"] ."' AND VOUCHERTYPE='Purchase'"); 
					$PURAMOUNT= getFieldDetail(BARCODE_PROCESS,"RSAMOUNT"," WHERE BARCODENO='". $_POST["sid"] ."' ORDER BY ENTRYID DESC LIMIT 1"); 
					$DALALIAMT = ($PURAMOUNT * $DALALIPER_pur) / 100;
					$DIFFAMOUNT = $RSAMOUNT-($PURAMOUNT+$DALALIAMT);
					?>
							
			<td  class="ui-widget">
			<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
				<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
			</td>
				
			<td>
				<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
			</td>
			<td>
				<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
			</td>
			
			
			<td class="ui-widget">
				<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
			</td>
			<td  class="ui-widget">
				<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
			</td>
			<td class="ui-widget">
				<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
			</td>
			<td class="ui-widget">
				<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
			</td>
			<td class="ui-widget">
				<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
			</td>
			<td class="ui-widget">
				<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
			</td>
			<td>
				<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
			</td>
			<td>
				<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
			</td>
		
			<td>
				<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
			</td>
			<td>
				<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
			</td>
			<td>
				<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
			</td>
			<td>
				<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
			</td>
			<td>
				<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>">
			</td>
			<td>
				<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
			</td>
			<td>
				<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
			</td>
			
			<td class="RMB" <?php echo isset($_POST["RMBSTATUS"]) && $_POST["RMBSTATUS"] == 'Y' ? '' : 'style="display:none;"'?>>
				<input type="text"  class="form-control RMBPERCRT_" name="RMBPERCRT<?php echo $BAR_TEMP;?>" id="RMBPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RMBPERCRT,2);?>">
			</td>
			<td class="RMB"  <?php echo isset($_POST["RMBSTATUS"]) && $_POST["RMBSTATUS"] == 'Y' ? '' : 'style="display:none;"'?>>
				<input type="text"  class="form-control RMBAMOUNT_" name="RMBAMOUNT<?php echo $BAR_TEMP;?>" id="RMBAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RMBAMOUNT,2);?>">
			</td>
			
			<td>
				<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
			</td>
			<td>
				<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
			</td>
			<td>
				<input type="hidden" name="PURAMOUNT<?php echo $BAR_TEMP;?>" id="PURAMOUNT<?php echo $BAR_TEMP;?>" value ="<?php echo $PURAMOUNT?>"/>
				<input type="text"  class="form-control DIFFAMOUNT_" name="DIFFAMOUNT<?php echo $BAR_TEMP;?>" id="DIFFAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($DIFFAMOUNT,2);?>">
			</td>
			
			<td class="ui-widget">
				<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
			</td>
			
			<td style="text-align:center;">
				<a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a>
			</td>
												
			<script>
			   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
						source: availableShape
				});
					$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
						source: availableColor
				});
					$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
						source: availableClarity
				});
				$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
						source: availablePolish
				});
					$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
						source: availableSymm
				});
					$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
						source: availableCut
				});
					$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
						source: availableFlour
				});
				$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
						source: availableGreen
				});
				
			</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	//===========================
	elseif($_POST["processtype"] == "MEMORECEIVE")
	{
		
			$res = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO='".$_POST["sid"]."' AND PROCESSTYPE='Memo Issue' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO)");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					$arr["GREEN"]=$resdata["GREEN"];
					$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];	
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATE * $WEIGHT; 
					$CONVRATE = $_POST["convrate"];		
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
				
							<td>
							<input type="hidden" name="NEWBARCODENO<?php echo $BAR_TEMP;?>" id="NEWBARCODENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["NEWBARCODENO"];?>">
								<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
								<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
													</td>
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													<?php
													echo isset($_POST["sid"]) && $_POST["sid"] == 0 ? '<td>
														<input type="text"  class="form-control onlyNumber EXPENCE_ txtweightrate " name="EXPENCE'.$BAR_TEMP.'" id="EXPENCE'.$BAR_TEMP.'" rel="'.$BAR_TEMP.'">
													</td>' :'';
													?>
													<td>
														<input type="text"  class="form-control RMBPERCRT_" name="RMBPERCRT<?php echo $BAR_TEMP;?>" id="RMBPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="0">
													</td>
													<td>
														<input type="text"  class="form-control RMBAMOUNT_" name="RMBAMOUNT<?php echo $BAR_TEMP;?>" id="RMBAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="0">
													</td>
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	
	//===========================
	elseif($_POST["processtype"] == "MEMOISSUE")
	{
		//$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE FLAG='0' AND BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Purchase','Memo Receive','Grading Receive')");
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Purchase','Memo Receive','Grading Receive','Repair Receive','Recut Receive')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					$arr["GREEN"]=$resdata["GREEN"];
					$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
					$CONVRATE = $_POST["convrate"];		
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
					
							<td>
							
							<input type="hidden" name="NEWBARCODENO<?php echo $BAR_TEMP;?>" id="NEWBARCODENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["NEWBARCODENO"];?>">
							
							<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
							<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
							<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
							<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
													</td>
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													<?php
													echo isset($_POST["sid"]) && $_POST["sid"] == 0 ? '<td>
														<input type="text"  class="form-control onlyNumber EXPENCE_ txtweightrate " name="EXPENCE'.$BAR_TEMP.'" id="EXPENCE'.$BAR_TEMP.'" rel="'.$BAR_TEMP.'">
													</td>' :'';
													?>
													
													<td>
														<input type="text"  class="form-control RMBPERCRT_" name="RMBPERCRT<?php echo $BAR_TEMP;?>" id="RMBPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="0">
													</td>
													<td>
														<input type="text"  class="form-control RMBAMOUNT_" name="RMBAMOUNT<?php echo $BAR_TEMP;?>" id="RMBAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="0">
													</td>
													
													
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	//===========================
	elseif($_POST["processtype"] == "GRADINGISSUE")
	{
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Purchase','Memo Receive','Grading Receive','Repair Receive','Recut Receive')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					//$arr["GREEN"]=$resdata["GREEN"];
					//$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
					$CONVRATE = $resdata["CONVRATE"];	
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
					
							<td>
							<input type="hidden" name="NEWBARCODENO<?php echo $BAR_TEMP;?>" id="NEWBARCODENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["NEWBARCODENO"];?>">
							<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
								
												<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
													</td>
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													
													<td>
														<input type="text" style="width:40px;" class="form-control onlyNumber txtweightrate CONVRATE_" name="CONVRATE<?php echo $BAR_TEMP;?>" id="CONVRATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["CONVRATE"];?>">
													</td>
												
													
													
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	
	//===========================
	elseif($_POST["processtype"] == "GRADINGRESULT")
	{
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Grading Issue')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$_POST["isslab"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					//$arr["GREEN"]=$resdata["GREEN"];
					//$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
					$CONVRATE = $resdata["CONVRATE"];	
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
					
							<td>
							<input type="hidden" name="NEWBARCODENO<?php echo $BAR_TEMP;?>" id="NEWBARCODENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["NEWBARCODENO"];?>">
							<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
								
												<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $_POST["isslab"];?>">
													</td>
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													
													<td>
														<input type="text" style="width:40px;" class="form-control onlyNumber txtweightrate CONVRATE_" name="CONVRATE<?php echo $BAR_TEMP;?>" id="CONVRATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["CONVRATE"];?>">
													</td>
												
													
													
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	
		//===========================
	elseif($_POST["processtype"] == "GRADINGRECEIVE")
	{
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Grading Result')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					$arr["GREEN"]=$resdata["GREEN"];
					$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
					$CONVRATE = $resdata["CONVRATE"];
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
	
							<td>
							<input type="hidden" name="NEWBARCODENO<?php echo $BAR_TEMP;?>" id="NEWBARCODENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["NEWBARCODENO"];?>">
							<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
							<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
													</td>
													
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													
													<td>
														<input type="text"  class="form-control txtweightrate CONVRATE_" name="CONVRATE<?php echo $BAR_TEMP;?>" id="CONVRATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($CONVRATE,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber EXPENCE_" name="EXPENCE<?php echo $BAR_TEMP;?>" id="EXPENCE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" >
													</td>
													
													
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  style="width:50px;" class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	
	//===========================
	elseif($_POST["processtype"] == "REPAIRISSUE")
	{
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Purchase','Memo Receive','Grading Receive','Repair Receive','Recut Receive')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					//$arr["GREEN"]=$resdata["GREEN"];
					//$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
					$CONVRATE = $resdata["CONVRATE"];	
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
					
							<td>
							
							<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
												<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
													</td>
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													
													<td>
														<input type="text" style="width:40px;" class="form-control onlyNumber txtweightrate CONVRATE_" name="CONVRATE<?php echo $BAR_TEMP;?>" id="CONVRATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["CONVRATE"];?>">
													</td>
												
													
													
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	//============================
	elseif($_POST["processtype"] == "REPAIRRECEIVE")
	{
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Repair Issue')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					$arr["GREEN"]=$resdata["GREEN"];
					$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
					$CONVRATE = $resdata["CONVRATE"];
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
					
							<td>
							
							<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
							<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
													</td>
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													
													<td>
														<input type="text"  class="form-control txtweightrate CONVRATE_" name="CONVRATE<?php echo $BAR_TEMP;?>" id="CONVRATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($CONVRATE,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate EXPENCE_" name="EXPENCE<?php echo $BAR_TEMP;?>" id="EXPENCE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($resdata["EXPENCE"],2);?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  style="width:50px;" class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	//===================================
	elseif($_POST["processtype"] == "RECUTISSUE")
	{
		//echo "hello";
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Purchase','Memo Receive','Grading Receive','Repair Receive')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					//$arr["GREEN"]=$resdata["GREEN"];
					//$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
					$CONVRATE = $resdata["CONVRATE"];	
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
					
							<td>
							
							<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
												<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
													</td>
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													
													<td>
														<input type="text" style="width:40px;" class="form-control onlyNumber txtweightrate CONVRATE_" name="CONVRATE<?php echo $BAR_TEMP;?>" id="CONVRATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["CONVRATE"];?>">
													</td>
												
													
													
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	//===================================
		//============================
	elseif($_POST["processtype"] == "RECUTRECEIVE")
	{
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Recut Issue')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					$arr["GREEN"]=$resdata["GREEN"];
					$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = $resdata["DISCPER"];
					$DISC2PER = $resdata["DISC2PER"];
					$DISC3PER = $resdata["DISC3PER"];
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					if($DISC2PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC2PER / 100);
					}	
					if($DISC3PER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER / 100);
					}
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
					$CONVRATE = $resdata["CONVRATE"];
					$RSPERCRT= $PERCRTDOLLAR * $CONVRATE; 	
					$RSAMOUNT= $TOTALDOLLAR * $CONVRATE; 
					
					?>
					<td>
					
					<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
								
														<input type="text" class="form-control" name="NEWBARCODENO<?php echo $BAR_TEMP;?>" id="NEWBARCODENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["NEWBARCODENO"];?>">
													</td>
							<td>
							<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">
														<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $BAR_TEMP;?>" id="LAB<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["LAB"];?>">
													</td>
													
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $BAR_TEMP;?>" id="SHAPE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SHAPE"];?>">
													</td>
													<td>
														<input type="text" class="form-control onlyNumber " name="PCS<?php echo $BAR_TEMP;?>" id="PCS<?php echo $BAR_TEMP;?>" value="<?php echo $PCS;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $BAR_TEMP;?>" id="CUT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CUT"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $BAR_TEMP;?>" id="POLISH<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["POLISH"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $BAR_TEMP;?>" id="SYMM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["SYMM"];?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $BAR_TEMP;?>" id="FLOURANCE<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["FLOURANCE"];?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISCPER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATEDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $BAR_TEMP;?>" id="DISC2PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["DISC2PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $BAR_TEMP;?>" id="DISC3PER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>"value="<?php echo $resdata["DISC3PER"];?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													
													<td>
														<input type="text"  class="form-control txtweightrate CONVRATE_" name="CONVRATE<?php echo $BAR_TEMP;?>" id="CONVRATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($CONVRATE,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber EXPENCE_" name="EXPENCE<?php echo $BAR_TEMP;?>" id="EXPENCE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" >
													</td>
													
													
													<td>
														<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $BAR_TEMP;?>" id="RSPERCRT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSPERCRT,2);?>">
													</td>
													<td>
														<input type="text"  style="width:50px;" class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $BAR_TEMP;?>" id="RSAMOUNT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RSAMOUNT,2);?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter" name="BGM<?php echo $BAR_TEMP;?>" id="BGM<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["BGM"];?>">
													</td>
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											   $("#SHAPE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableShape
												});
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												$("#POLISH"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availablePolish
												});
													$("#SYMM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableSymm
												});
													$("#CUT"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableCut
												});
													$("#FLOURANCE"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableFlour
												});
												$("#BGM"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableGreen
												});
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}
	//======================================
	//===============================
	elseif($_POST["processtype"] == "EXPORTDIAMOND")
	{
		$res = getData(BARCODE_PROCESS,$AllArr,"  WHERE BARCODENO='".$_POST["sid"]."' AND ENTRYID IN (SELECT MAX(ENTRYID) FROM ".BARCODE_PROCESS." GROUP BY BARCODENO) and PROCESSTYPE IN ('Purchase','Memo Issue','Memo Receive','Grading Receive')");
			if(mysqli_num_rows($res) > 0)
			{
				
				while($resdata = mysqli_fetch_assoc($res))
				{
					$arr["LAB"]=$resdata["LAB"];
					$arr["CERTIFICATENO"]=$resdata["CERTIFICATENO"];
					$arr["SHAPE"]=$resdata["SHAPE"];
					$arr["WEIGHT"]=$resdata["WEIGHT"];
					$arr["COLOR"]=$resdata["COLOR"];
					$arr["CLARITY"]=$resdata["CLARITY"];
					$arr["CUT"]=$resdata["CUT"];
					$arr["POLISH"]=$resdata["POLISH"];
					$arr["SYMM"]=$resdata["SYMM"];
					$arr["FLOURANCE"]=$resdata["FLOURANCE"];
					$arr["GREEN"]=$resdata["GREEN"];
					$arr["MILKY"]=$resdata["MILKY"];
					$BAR_TEMP = substr($_POST["sid"],2);
					$PCS = $PCSpurchase - $PCSsale;
					$WEIGHT = $WEIGHTpurchase - $WEIGHTsale;
					$RATE=getRapPrice(strtoupper($resdata["SHAPE"]),$resdata["COLOR"],strtoupper($resdata["CLARITY"]),$WEIGHT);
					$DISCPER = 50;
					$RATEDOLLAR= $RATE * $WEIGHT; 	
					if($DISCPER > 0)
					{
						$RATEDOLLAR = $RATEDOLLAR * (1 - $DISCPER / 100);
					}
					
					$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT; 	
					$TOTALDOLLAR= $RATEDOLLAR; 
				
					
					?>
						
											
													<td>
													
													<input type="hidden" name="RAPDISCOUNT<?php echo $BAR_TEMP;?>" id="RAPDISCOUNT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPDISCOUNT"];?>">
								<input type="hidden" name="RAPPERCRT<?php echo $BAR_TEMP;?>" id="RAPPERCRT<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPPERCRT"];?>">
								<input type="hidden" name="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" id="RAPTOTALDOLLAR<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["RAPTOTALDOLLAR"];?>">
								
								
															<input type="hidden"  class="form-control" name="ENTRYID<?php echo $BAR_TEMP;?>" id="ENTRYID<?php echo $BAR_TEMP;?>">	
												
														<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $BAR_TEMP;?>" id="WEIGHT<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $WEIGHT;?>">
													</td>
													<td class="ui-widget">
														<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $BAR_TEMP;?>" id="COLOR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["COLOR"];?>">
													</td>
													<td  class="ui-widget">
														<input type="text" class="form-control rapprice" name="CLARITY<?php echo $BAR_TEMP;?>" id="CLARITY<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CLARITY"];?>" >
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $BAR_TEMP;?>" id="RATE<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $RATE;?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $BAR_TEMP;?>" id="RATEDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($RATE * $WEIGHT,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $BAR_TEMP;?>" id="DISCPER<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo $DISCPER;?>">
													</td>
													
													
													<td>
														<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" id="PERCRTDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($PERCRTDOLLAR,2);?>">
													</td>
													<td>
														<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $BAR_TEMP;?>" id="TOTALDOLLAR<?php echo $BAR_TEMP;?>" rel="<?php echo $BAR_TEMP;?>" value="<?php echo round($TOTALDOLLAR,2);?>">
													</td>
													<td>
														<input type="text" class="form-control" name="CERTIFICATENO<?php echo $BAR_TEMP;?>" id="CERTIFICATENO<?php echo $BAR_TEMP;?>" value="<?php echo $resdata["CERTIFICATENO"];?>">
													</td>
													
													
													
													<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
												
											<script>
											
													$("#COLOR"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableColor
												});
													$("#CLARITY"+"<?php echo $BAR_TEMP;?>" ).autocomplete({
														source: availableClarity
												});
												
												
											</script>
					<?php
				exit;
				}
			}
			else
			{
				echo "";
				exit;
			}
	}		
}
else
{
	echo "";
	exit;
}

?>
