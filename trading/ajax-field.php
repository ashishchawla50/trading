<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

$BAR_TEMP = isset($_POST["sid"]) && $_POST["sid"] == 0 ? '' : 'GP'.$_POST["addfield"];
?>
	<tr>
										<td>
											<input type="text" style="width:70px;" class="form-control <?php echo isset($_POST["sid"]) && $_POST["sid"] == 0 ? 'bs_' :''; ?> BARCODENO_" name="BARCODENO[]" id="BARCODENO<?php echo $_POST["addfield"];?>" value="<?php echo $BAR_TEMP ;?>">
										</td>
										
										<td>
											<input type="text" class="form-control onlyCharacter " name="LAB<?php echo $_POST["addfield"];?>" id="LAB<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text" class="form-control" name="CERTIFICATENO<?php echo $_POST["addfield"];?>" id="CERTIFICATENO<?php echo $_POST["addfield"];?>">
										</td>
										<td  class="ui-widget">
											<input type="text" class="form-control onlyCharacter rapprice" name="SHAPE<?php echo $_POST["addfield"];?>" id="SHAPE<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>" >
										</td>
										<td>
											<input type="text" class="form-control onlyNumber " name="PCS<?php echo $_POST["addfield"];?>" id="PCS<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber rapprice txtweightrate WEIGHT_" name="WEIGHT<?php echo $_POST["addfield"];?>" id="WEIGHT<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>" >
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter rapprice" name="COLOR<?php echo $_POST["addfield"];?>" id="COLOR<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>" >
										</td>
										<td  class="ui-widget">
											<input type="text" class="form-control rapprice" name="CLARITY<?php echo $_POST["addfield"];?>" id="CLARITY<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>" >
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="CUT<?php echo $_POST["addfield"];?>" id="CUT<?php echo $_POST["addfield"];?>" >
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="POLISH<?php echo $_POST["addfield"];?>" id="POLISH<?php echo $_POST["addfield"];?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="SYMM<?php echo $_POST["addfield"];?>" id="SYMM<?php echo $_POST["addfield"];?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="FLOURANCE<?php echo $_POST["addfield"];?>" id="FLOURANCE<?php echo $_POST["addfield"];?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="GREEN<?php echo $_POST["addfield"];?>" id="GREEN<?php echo $_POST["addfield"];?>">
										</td>
										<td class="ui-widget">
											<input type="text" class="form-control onlyCharacter" name="MILKY<?php echo $_POST["addfield"];?>" id="MILKY<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate RATE_" name="RATE<?php echo $_POST["addfield"];?>" id="RATE<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISCPER_" name="DISCPER<?php echo $_POST["addfield"];?>" id="DISCPER<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber RATEDOLLAR_" name="RATEDOLLAR<?php echo $_POST["addfield"];?>" id="RATEDOLLAR<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISC2PER_" name="DISC2PER<?php echo $_POST["addfield"];?>" id="DISC2PER<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber txtweightrate DISC3PER_" name="DISC3PER<?php echo $_POST["addfield"];?>" id="DISC3PER<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber PERCRTDOLLAR_" name="PERCRTDOLLAR<?php echo $_POST["addfield"];?>" id="PERCRTDOLLAR<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control onlyNumber TOTALDOLLAR_" name="TOTALDOLLAR<?php echo $_POST["addfield"];?>" id="TOTALDOLLAR<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<?php
										echo isset($_POST["sid"]) && $_POST["sid"] == 0 ? '<td>
											<input type="text"  class="form-control onlyNumber EXPENCE_ txtweightrate " name="EXPENCE'.$_POST["addfield"].'" id="EXPENCE'.$_POST["addfield"].'" rel="'.$_POST["addfield"].'">
										</td>' :'';
										?>
										<td>
											<input type="text"  class="form-control RSPERCRT_" name="RSPERCRT<?php echo $_POST["addfield"];?>" id="RSPERCRT<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<td>
											<input type="text"  class="form-control RSAMOUNT_" name="RSAMOUNT<?php echo $_POST["addfield"];?>" id="RSAMOUNT<?php echo $_POST["addfield"];?>" rel="<?php echo $_POST["addfield"];?>">
										</td>
										<td style="text-align:center;"><a href="javascript:void(0)" class="btn btn-danger btn-circle remove_field" ><i class="fa fa-remove"></i></a></td>
									</tr>
								<script>
								$("#LAB"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableLab
									});
								   $("#SHAPE"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableShape
									});
										$("#COLOR"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableColor
									});
										$("#CLARITY"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableClarity
									});
									$("#POLISH"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availablePolish
									});
										$("#SYMM"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableSymm
									});
										$("#CUT"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableCut
									});
										$("#FLOURANCE"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableFlour
									});
									$("#GREEN"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableGreen
									});
									$("#MILKY"+"<?php echo $_POST["addfield"];?>" ).autocomplete({
											source: availableMilky
									});
								</script>
								<?php
								exit();
								?>