<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");
//require_once('lib/nusoap.php'); 
$rapid=getFieldDetail(COMPANY,"RAPNETID"," WHERE COMPANYID='1'");
$rappass=getFieldDetail(COMPANY,"RAPNETPASSWORD"," WHERE COMPANYID='1'");
if(isset($_FILES["Upload_file"]))
{
	

	$XLSPATH = isset($_FILES["Upload_file"]["tmp_name"]) ? $_FILES["Upload_file"]["tmp_name"] : "";
	$Path = UPLOAD."xls/";
	$XLSPATH = $Path."Bulk.xls";
	move_uploaded_file($_FILES["Upload_file"]["tmp_name"],$XLSPATH);
	require_once INIT.'phpExcelReader/Excel/reader.php';
	$data = new Spreadsheet_Excel_Reader();
	$data->read($XLSPATH);
	$row = $data->sheets[0]["cells"];
	$last_barcodeno= getMaxValue(BARCODE_PROCESS, "CAST(SUBSTRING(BARCODENO,2) as UNSIGNED)");
	$CONVRATE = $_POST["txtCONVRATE"];
	
	$last_barcodeno= getMaxValue(BARCODE_PROCESS, "CAST(SUBSTRING(BARCODENO,2) as UNSIGNED)");
	$last_= $last_barcodeno;
		
	for($i=2;$i<=count($row);$i++)
	{
		$BARCODENO = isset($row[$i][1])? $row[$i][1]:'';
		$barcnt = getFieldDetail(BARCODE_PROCESS,"count(*)"," WHERE BARCODENO='".$BARCODENO."' AND PROCESSTYPE='Purchase'");
		if($barcnt > 0)
		{
		}
		else
		{
	
			if(empty($BARCODENO))
			{
				
				$BARCODENO="GP".$last_;
				$last_= $last_barcodeno+1;
			}
			else
			{
				
				$last_barcodeno=substr($BARCODENO,2);
			}
			
		
		$SHAPE = isset($row[$i][2])? $row[$i][2]:'';
		$WEIGHT = isset($row[$i][3])? $row[$i][3]:'';
		$COLOR = isset($row[$i][4])? $row[$i][4]:'';
		$CLARITY = isset($row[$i][5])? $row[$i][5]:'';
		$CLARITY = str_replace(" ","",$CLARITY);
		$CUT = isset($row[$i][6])? $row[$i][6]:'';
		$POLISH = isset($row[$i][7])? $row[$i][7]:'';
		$SYMM = isset($row[$i][8])? $row[$i][8]:'';
		$FLOURANCE = isset($row[$i][9])? $row[$i][9]:'';
		$CERTIFICATENO = isset($row[$i][10])? $row[$i][10]:'';
		$LAB = isset($row[$i][14])? $row[$i][14]:'';
		$RAPRATE = isset($row[$i][11])? $row[$i][11]:'';
		//$VDATE=isset($row[$i][15])? $row[$i][15]:'';
		//exit();
		/*if($VDATE != '')
		{
					$dtarr = explode("/",$VDATE);
					$VDATE = $dtarr[2]."-".$dtarr[1]."-".$dtarr[0];
		}*/
		
		if(empty($RAPRATE))
		{
			$RATE=getRapPrice(strtoupper($SHAPE),$COLOR,strtoupper($CLARITY),$WEIGHT);
		}
		else
		{
			$RATE=$RAPRATE; 
		}
		
				
		$RATEDOLLAR = $RATE * $WEIGHT;
		$DISCPER = isset($row[$i][12])? $row[$i][12]:'';
		if($DISCPER > 0)
			{
				$RATEDOLLAR = $RATEDOLLAR  * (1 - $DISCPER / 100);
			}
		$DISC2PER = isset($row[$i][13])? $row[$i][13]:'';
		if($DISC2PER > 0)
			{
				$RATEDOLLAR = $RATEDOLLAR *  (1 - $DISC2PER/ 100);
			}
		/*$DISC3PER = isset($row[$i][16])? $row[$i][16]:'';
		if($DISC3PER > 0)
			{
				$RATEDOLLAR = $RATEDOLLAR * (1 - $DISC3PER/ 100);
			}*/
		$DISC3PER=0;
		$PERCRTDOLLAR= $RATEDOLLAR / $WEIGHT;
		$TOTALDOLLAR= $RATEDOLLAR;
		$RSPERCRT= $PERCRTDOLLAR * $CONVRATE;
		$RSAMOUNT = $TOTALDOLLAR * $CONVRATE;
		?>
					<tr>
							<td>
								<input type="text" class="form-control BARCODENO_" name="BARCODENO[]" id="BARCODENO<?php echo $last_barcodeno;?>" value="<?php echo $BARCODENO ;?>">
							</td>
							
							<td  class="ui-widget">
								<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $last_barcodeno;?>" id="SHAPE<?php echo $last_barcodeno;?>" value="<?php echo $SHAPE ;?>">
							</td>
							<td>
								<input type="text" class="form-control onlyNumber" name="PCS<?php echo $last_barcodeno;?>" id="PCS<?php echo $last_barcodeno;?>" value="1">
							</td>
							<td>
								<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $last_barcodeno;?>" id="WEIGHT<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo $WEIGHT ;?>">
							</td>
							<td class="ui-widget">
								<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $last_barcodeno;?>" id="COLOR<?php echo $last_barcodeno;?>" value="<?php echo $COLOR ;?>">
							</td>
							<td  class="ui-widget">
								<input type="text" class="form-control rapprice" name="CLARITY<?php echo $last_barcodeno;?>" id="CLARITY<?php echo $last_barcodeno;?>" value="<?php echo $CLARITY ;?>">
							</td>
							<td class="ui-widget">
								<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $last_barcodeno;?>" id="CUT<?php echo $last_barcodeno;?>" value="<?php echo $CUT ;?>">
							</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $last_barcodeno;?>" id="POLISH<?php echo $last_barcodeno;?>" value="<?php echo $POLISH ;?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $last_barcodeno;?>" id="SYMM<?php echo $last_barcodeno;?>" value="<?php echo $SYMM ;?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $last_barcodeno;?>" id="FLOURANCE<?php echo $last_barcodeno;?>" value="<?php echo $FLOURANCE ;?>">
										</td>
										<td>
											<input type="text" class="form-control" name="CERTIFICATENO<?php echo $last_barcodeno;?>" id="CERTIFICATENO<?php echo $last_barcodeno;?>" value="<?php echo $CERTIFICATENO ;?>">
										</td>
										<td>
											<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $last_barcodeno;?>" id="LAB<?php echo $last_barcodeno;?>" value="<?php echo $LAB ;?>">
										</td>
										
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $last_barcodeno;?>" id="RATE<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo round($RATE,2) ;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $last_barcodeno;?>" id="DISCPER<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo $DISCPER ;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $last_barcodeno;?>" id="RATEDOLLAR<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo round($RATEDOLLAR,2) ;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $last_barcodeno;?>" id="DISC2PER<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo $DISC2PER ;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $last_barcodeno;?>" id="DISC3PER<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo $DISC3PER ;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $last_barcodeno;?>" id="PERCRTDOLLAR<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo round($PERCRTDOLLAR,2) ;?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $last_barcodeno;?>" id="TOTALDOLLAR<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo round($TOTALDOLLAR,2) ;?>">
										</td>
								
										<td style="display:none;">
											 <input type="text"   class="form-control onlyNumber RMBPERCRT_" name="RMBPERCRT<?php echo $last_barcodeno;?>" id="RMBPERCRT<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" >
										</td>
										<td style="display:none;">
												<input type="text"  class="form-control onlyNumber RMBAMOUNT_" name="RMBAMOUNT<?php echo $last_barcodeno;?>" id="RMBAMOUNT<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" >
										</td>
													
								
								
										<td>
											<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $last_barcodeno;?>" id="RSPERCRT<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo round($RSPERCRT,2) ;?>">
										</td>
										<td>
											<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $last_barcodeno;?>" id="RSAMOUNT<?php echo $last_barcodeno;?>" rel="<?php echo $last_barcodeno;?>" value="<?php echo round($RSAMOUNT,2) ;?>">
										</td>
										<td>
													<input type="text" style="width: 60px;" class="form-control onlyCharacter" name="BGM<?php echo $last_barcodeno;?>" id="BGM<?php echo $last_barcodeno;?>" >
										</td>
										<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
									</tr>
								<script>
								   $("#SHAPE"+"<?php echo $last_barcodeno;?>" ).autocomplete({
											source: availableShape
									});
										$("#COLOR"+"<?php echo $last_barcodeno;?>" ).autocomplete({
											source: availableColor
									});
										$("#CLARITY"+"<?php echo $last_barcodeno;?>" ).autocomplete({
											source: availableClarity
									});
									$("#POLISH"+"<?php echo $last_barcodeno;?>" ).autocomplete({
											source: availablePolish
									});
										$("#SYMM"+"<?php echo $last_barcodeno;?>" ).autocomplete({
											source: availableSymm
									});
										$("#CUT"+"<?php echo $last_barcodeno;?>" ).autocomplete({
											source: availableCut
									});
										$("#FLOURANCE"+"<?php echo $last_barcodeno;?>" ).autocomplete({
											source: availableFlour
									});
									
								</script>
		
		
		<?php
		}
		$last_barcodeno++;
	}
					
}

?>
