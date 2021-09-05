<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

$BAR_TEMP = isset($_POST["sid"]) && $_POST["sid"] == 0 ? '' : 'GP'.$_POST["addfield"];
$processtype = $_POST["processtype"] ;
switch($processtype) 
{
    case "sale":
        $processtype = "SALE";
        break;
    case "purchase":
	case "partnerpurchase":
	case "opening":
        $processtype = "PURCHASE";
        break;
    case "memoissue":
         $processtype = "MEMOISSUE";
        break;
	case "memoreceive":
         $processtype = "MEMORECEIVE";
        break;
	case "repairissue":
         $processtype = "REPAIRISSUE";
        break;
	case "repairreceive":
         $processtype = "REPAIRRECEIVE";
        break;
	case "exportdiamond":
         $processtype = "EXPORTDIAMOND";
        break;
	case "gradingissue":
         $processtype = "GRADINGISSUE";
        break;
	case "gradingresult":
         $processtype = "GRADINGRESULT";
        break;
	case "gradingreceive":
         $processtype = "GRADINGRECEIVE";
        break;
    	case "recutissue":
         $processtype = "RECUTISSUE";
        break;
    	case "recutreceive":
         $processtype = "RECUTRECEIVE";
        break;
}
?>

			<tr>
										<td>
											
											<input type="text" style="width:70px;" class="form-control bs_ BARCODENO_" name="BARCODENO[]" rel="<?php echo $processtype;?>" id="BARCODENO<?php echo $_POST["addfield"];?>" value="<?php echo $processtype == "PURCHASE" ? "GP".$_POST["addfield"] : "" ?>" >
										</td>
										
									</tr>
								<script>
								   $("#BARCODENO<?php echo $_POST["addfield"];?>" ).autocomplete({
											
											source: availableBar
									});
								 
								</script>
								<?php
								exit();
								?>