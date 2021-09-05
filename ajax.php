<?php
session_start();
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");

if(isset($_SESSION["adminuser"]))
	{
		$loginuser_name = $_SESSION["adminuser"];
		$user_name = $_SESSION["adminuser"];
	}
	elseif(isset($_SESSION["user"]))
	{
		$loginuser_name = $_SESSION["user"];
		$user_name = getFieldDetail(USER,"CONCAT(FIRSTNAME,' ',LASTNAME)"," WHERE USERNAME='".$_SESSION["user"]."'");
		$popupstock_bol = getFieldDetail(USER,"POPUPSTOCKSTATUS"," WHERE USERNAME='".$_SESSION["user"]."'");
	}
	
$getcompany=getData(COMPANY,$AllArr," WHERE COMPANYID='1'");
$rescompanydata=mysqli_fetch_assoc($getcompany);



if(isset($_GET["barcode"]))
{
	$res = getData(BARCODE_PROCESS,$AllArr," WHERE  BARCODENO='GP". $_GET["barcode"] ."' ORDER BY ID");
	
	
	
	if(mysqli_num_rows($res) == 1 )
	{
		$resdata = mysqli_fetch_assoc($res);
		$resPur = getData(PURCHASESALE,$AllArr," WHERE  ID='".$resdata["ID"]."' and VOUCHERTYPE='Purchase'");
		$resPurdata = mysqli_fetch_assoc($resPur);
		?>
		<div class="overlay_container left_overlay_content" >
		<h1>Barcode No : GP<?php echo $_GET["barcode"];?></h1>
		<table class="pur" width="100%" border="1">
		<tr bgcolor="white" style="color:#000;">
					<td colspan="2" align="center"><h4>Purchase</h4></td>
				</tr>
		<tr>
			<td>Id:</td><td width="50%"><?php echo $resdata["ID"];?></td>
		</tr>
		<tr>
			<td>Party:</td><td><?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resdata["LEDGERID"]."'");?></td>
		</tr>
		<tr>
			<td>Date:</td><td><?php echo getDateFormat($resPurdata["VOUCHERDATE"]);?></td>
		</tr>
		<tr>
			<td>Due Date:</td><td><?php echo getDateFormat($resPurdata["DUEDATE"])."(".$resPurdata["DUEDAYS"].")";?></td>
		</tr>
		<tr>
			<td>Rap Rate:</td><td><?php echo getCurrFormat0($resdata["RATE"]);?></td>
		</tr>
		<tr>
			<td>Dis %:</td><td><?php echo $resdata["DISCPER"];?></td>
		</tr>
		<tr>
			<td>$ Rate:</td><td><?php echo $resdata["RATEDOLLAR"];?></td>
		</tr>
		<tr>
			<td>Dis 1 %:</td><td><?php echo $resdata["DISC2PER"];?></td>
		</tr>
		<tr>
			<td>Dis 2 %:</td><td><?php echo $resdata["DISC3PER"];?></td>
		</tr>
		<tr>
			<td>$/Crt:</td><td><?php echo $resdata["PERCRTDOLLAR"];?></td>
		</tr>
		<tr>
			<td>$ Total:</td><td><?php echo $resdata["TOTALDOLLAR"];?></td>
		</tr>
		<tr>
			<td>$:</td><td><?php echo $resdata["CONVRATE"];?></td>
		</tr>
		<tr>
			<td>Rs/Crt:</td><td><?php echo $resdata["RSPERCRT"];?></td>
		</tr>
		<tr>
			<td>Rs Total:</td><td><?php echo $resdata["RSAMOUNT"];?></td>
		</tr>
		<tr>
			<td>Lab:</td><td><?php echo $resdata["LAB"];?></td>
		</tr>
		<tr>
			<td>Certi:</td><td><?php echo $resdata["CERTIFICATENO"];?></td>
		</tr>
		<tr>
			<td>Shape:</td><td><?php echo $resdata["SHAPE"];?></td>
		</tr>
		<tr>
			<td>Weight:</td><td><?php echo $resdata["WEIGHT"];?></td>
		</tr>
		<tr>
			<td>Color-Clarity:</td><td><?php echo $resdata["COLOR"]."-".$resdata["CLARITY"];?></td>
		</tr>
		<tr>
			<td>C-P-S:</td><td><?php echo $resdata["CUT"]."-".$resdata["POLISH"]."-".$resdata["SYMM"];?></td>
		</tr>
		<tr>
			<td>Flour:</td><td><?php echo $resdata["FLOURANCE"];?></td>
		</tr>
		<tr>
			<td>Green-Milky:</td><td><?php echo $resdata["GREEN"]."-".$resdata["MILKY"];?></td>
		</tr>
		<tr>
			<td>Mesu:</td><td><?php echo $resdata["MESU1"]."-".$resdata["MESU2"]."x".$resdata["MESU3"];?> mm</td>
		</tr>
		<tr>
			<td>TB-TD(%):</td><td><?php echo $resdata["DEPTHPER"]."-".$resdata["TABLEPER"];?></td>
		</tr>
		</table>
		</div>
		<?php
	}
	elseif(mysqli_num_rows($res) == 2 )
	{
		?>
		<h2>Barcode No :  GP<?php echo $_GET["barcode"];?></h2>
		
			<?php
			$idx= 1;
			while($resdata = mysqli_fetch_assoc($res))
			{
				$resPur = getData(PURCHASESALE,$AllArr," WHERE  ID='".$resdata["ID"]."' and VOUCHERTYPE='".$resdata["PROCESSTYPE"]."'");
				$resPurdata = mysqli_fetch_assoc($resPur);
				if($idx++==1)
				{
					
					?>
				<div class="overlay_container left_overlay_content" >
				
				<table class="sale" width="100%" border="1">
					<tr bgcolor="white" style="color:#000;">
						<td colspan="2" align="center"><h5>Purchase</h5></td>
					</tr>
				<tr>
					<td width="20%">Id:</td><td width="50%"><?php echo $resdata["ID"];?></td>
				</tr>
				<tr>
			<td>Party:</td><td><?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resdata["LEDGERID"]."'");?></td>
		</tr>
		<tr>
			<td>Date:</td><td><?php echo getDateFormat($resPurdata["VOUCHERDATE"]);?></td>
		</tr>
		<tr>
			<td>Due Date:</td><td><?php echo getDateFormat($resPurdata["DUEDATE"])."(".$resPurdata["DUEDAYS"].")";?></td>
		</tr>
		<tr>
			<td>Rap Rate:</td><td><?php echo getCurrFormat0($resdata["RATE"]);?></td>
		</tr>
		<tr>
			<td>Dis %:</td><td><?php echo $resdata["DISCPER"];?></td>
		</tr>
		<tr>
			<td>$ Rate:</td><td><?php echo $resdata["RATEDOLLAR"];?></td>
		</tr>
		<tr>
			<td>Dis 1 %:</td><td><?php echo $resdata["DISC2PER"];?></td>
		</tr>
		<tr>
			<td>Dis 2 %:</td><td><?php echo $resdata["DISC3PER"];?></td>
		</tr>
		<tr>
			<td>$/Crt:</td><td><?php echo $resdata["PERCRTDOLLAR"];?></td>
		</tr>
		<tr>
			<td>$ Total:</td><td><?php echo $resdata["TOTALDOLLAR"];?></td>
		</tr>
		<tr>
			<td>$:</td><td><?php echo $resdata["CONVRATE"];?></td>
		</tr>
		<tr>
			<td>Rs/Crt:</td><td><?php echo $resdata["RSPERCRT"];?></td>
		</tr>
		<tr>
			<td>Rs Total:</td><td><?php echo $resdata["RSAMOUNT"];?></td>
		</tr>
		<tr>
			<td>Lab:</td><td><?php echo $resdata["LAB"];?></td>
		</tr>
		<tr>
			<td>Certi:</td><td><?php echo $resdata["CERTIFICATENO"];?></td>
		</tr>
		<tr>
			<td>Shape:</td><td><?php echo $resdata["SHAPE"];?></td>
		</tr>
		<tr>
			<td>Weight:</td><td><?php echo $resdata["WEIGHT"];?></td>
		</tr>
		<tr>
			<td>Color-Clarity:</td><td><?php echo $resdata["COLOR"]."-".$resdata["CLARITY"];?></td>
		</tr>
		<tr>
			<td>C-P-S:</td><td><?php echo $resdata["CUT"]."-".$resdata["POLISH"]."-".$resdata["SYMM"];?></td>
		</tr>
		<tr>
			<td>Flour:</td><td><?php echo $resdata["FLOURANCE"];?></td>
		</tr>
		<tr>
			<td>Green-Milky:</td><td><?php echo $resdata["GREEN"]."-".$resdata["MILKY"];?></td>
		</tr>
		<tr>
			<td>Mesu:</td><td><?php echo $resdata["MESU1"]."-".$resdata["MESU2"]."x".$resdata["MESU3"];?> mm</td>
		</tr>
		<tr>
			<td>TB-TD(%):</td><td><?php echo $resdata["DEPTHPER"]."-".$resdata["TABLEPER"];?></td>
		</tr>
				
				</table>
				</div>
				<?php
				}
				else
				{
					?>
				<div class="overlay_container right_overlay_content" >
				
				<table class="sale" width="100%" border="1" cellspacing="3">
				<tr bgcolor="white" style="color:#000;">
					<td colspan="2" align="center"><h5>Sale</h5></td>
				</tr>
						<tr>
			<td width="20%">Id:</td><td width="50%"><?php echo $resdata["ID"];?></td>
		</tr>
		<tr>
			<td>Party:</td><td><?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resdata["LEDGERID"]."'");?></td>
		</tr>
		<tr>
			<td>Date:</td><td><?php echo getDateFormat($resPurdata["VOUCHERDATE"]);?></td>
		</tr>
		<tr>
			<td>Due Date:</td><td><?php echo getDateFormat($resPurdata["DUEDATE"])."(".$resPurdata["DUEDAYS"].")";?></td>
		</tr>
		<tr>
			<td>Rap Rate:</td><td><?php echo getCurrFormat0($resdata["RATE"]);?></td>
		</tr>
		<tr>
			<td>Dis %:</td><td><?php echo $resdata["DISCPER"];?></td>
		</tr>
		<tr>
			<td>$ Rate:</td><td><?php echo $resdata["RATEDOLLAR"];?></td>
		</tr>
		<tr>
			<td>Dis 1 %:</td><td><?php echo $resdata["DISC2PER"];?></td>
		</tr>
		<tr>
			<td>Dis 2 %:</td><td><?php echo $resdata["DISC3PER"];?></td>
		</tr>
		<tr>
			<td>$/Crt:</td><td><?php echo $resdata["PERCRTDOLLAR"];?></td>
		</tr>
		<tr>
			<td>$ Total:</td><td><?php echo $resdata["TOTALDOLLAR"];?></td>
		</tr>
		<tr>
			<td>$:</td><td><?php echo $resdata["CONVRATE"];?></td>
		</tr>
		<tr>
			<td>Rs/Crt:</td><td><?php echo $resdata["RSPERCRT"];?></td>
		</tr>
		<tr>
			<td>Rs Total:</td><td><?php echo $resdata["RSAMOUNT"];?></td>
		</tr>
		<tr>
			<td>Lab:</td><td><?php echo $resdata["LAB"];?></td>
		</tr>
		<tr>
			<td>Certi:</td><td><?php echo $resdata["CERTIFICATENO"];?></td>
		</tr>
		<tr>
			<td>Shape:</td><td><?php echo $resdata["SHAPE"];?></td>
		</tr>
		<tr>
			<td>Weight:</td><td><?php echo $resdata["WEIGHT"];?></td>
		</tr>
		<tr>
			<td>Color-Clarity:</td><td><?php echo $resdata["COLOR"]."-".$resdata["CLARITY"];?></td>
		</tr>
		<tr>
			<td>C-P-S:</td><td><?php echo $resdata["CUT"]."-".$resdata["POLISH"]."-".$resdata["SYMM"];?></td>
		</tr>
		<tr>
			<td>Flour:</td><td><?php echo $resdata["FLOURANCE"];?></td>
		</tr>
		<tr>
			<td>Green-Milky:</td><td><?php echo $resdata["GREEN"]."-".$resdata["MILKY"];?></td>
		</tr>
		<tr>
			<td>Mesu:</td><td><?php echo $resdata["MESU1"]."-".$resdata["MESU2"]."x".$resdata["MESU3"];?> mm</td>
		</tr>
		<tr>
			<td>TB-TD(%):</td><td><?php echo $resdata["DEPTHPER"]."-".$resdata["TABLEPER"];?></td>
		</tr>
				
				</table>
				</div>
				<?php
				}
				
			}

	}
	else
	{
		?>
		<h1>No Data Available</h1>
		<?php
	}
}
elseif(isset($_GET["newbarcode"]))
{

	if((isset($_SESSION["adminuser"])) || (isset($_SESSION["user"]) and $popupstock_bol == 'Y' ))
	{
		$NEWBAR = $_GET["newbarcode"];
		if(isset($_SESSION["adminuser"]))
		{
			$res = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO like'%".$NEWBAR."' AND PROCESSTYPE='Purchase' ");
		}
		else
		{
			$res = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO like'%".$NEWBAR."' AND PROCESSTYPE='Purchase' AND BARCODENO NOT IN (SELECT BARCODENO FROM ". BARCODE_PROCESS ." WHERE BARCODENO like'%".$NEWBAR."' AND PROCESSTYPE='Sale')");
		}
		if(mysqli_num_rows($res) !=0 )
		{
			$puramt =0;
			$salamt=0;
			$DALALIAMT=0;
			$EXPENCEAMOUNT=0;
			$resPur = getData(PURCHASESALE,$AllArr," WHERE ID IN (SELECT ID FROM ". BARCODE_PROCESS ." WHERE BARCODENO like'%".$NEWBAR."' AND PROCESSTYPE='Purchase') AND VOUCHERTYPE='Purchase'");
			$resPurdata = mysqli_fetch_assoc($resPur);
			?>
		
			<style>
				
				.tblmain {
					width: 100%;
					display:block;
				}
				.tblmain  thead,.tblmain  tbody { display: block; }

				.tblmain tbody {
					
					overflow-y: auto;    /* Trigger vertical scroll    */
					overflow-x: auto;  /* Hide the horizontal scroll */
				}
				  
	  
				.tblmaintop, .tblmaintop tr td
				{
					font-size:1.1em;
					vertical-align:top;
				}
				.tblmaintop td,.popiptbl td,.popiptbl th{
					
					padding:5px;
				}
				.tblmain thead tr th
				{
					text-align:center;
				}
				.tblmain
				{
					font-size:0.8em;
					background-color:#fff;
					color:#000;
					
				}
				</style>
				<div class="overlay_container" >
					<h1>Stock Id: <?php echo getFieldDetail(BARCODE_PROCESS,"BARCODENO"," WHERE BARCODENO like'%".$NEWBAR."' AND PROCESSTYPE='Purchase' ");?></h1>
					<table width="100%" align="center" class="tblmaintop">
						<tr  style="background-color:#fff;color:#000;">
							<td colspan="4" style="text-align:center">Purchase</td>
						</tr>
						<tr>
							<td width="10%" >ID :<?php echo $resPurdata["ID"];?></td>
							<td width="50%" >Party :<?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resPurdata["LEDGERID"]."'");?></td>
							<td width="20%">Date:<?php echo getDateFormat($resPurdata["VOUCHERDATE"]);?></td>
							<td width="20%">Due Days:(<?php echo $resPurdata["DUEDAYS"];?>)<?php echo getDateFormat($resPurdata["DUEDATE"]);?></td>
						</tr>
						
					</table>
		
		
					<table width="100%" border="1" class="tblmain customResponsiveTable" >
						<tbody>
								<tr align="center" class="popiptbl">
									
									<th >Lab</th>
									<th >Cert.</th>
									<th >Shape</th>
									<th >Pcs</th>
									<th >Wgt</th>
									<th >Col</th>
									<th >Cla</th>
									<th >Cut</th>
									<th >Pol</th>
									<th >Sym</th>
									<th >Flou</th>
									
									<th >Rap</th>
									<th >Dis</th>
									<th >$ Rate</th>
									<th >RMB Rate</th>
									<th >Dis 1</th>
									<th >Dis 2</th>
									<th >$/Crt</th>
									<th >$ Total</th>
									<th >$</th>
									<th >Rs/Crt</th>
									<th >Rs Amt</th>
									
								</tr>								
						
						
						<?php
										while($resdata = mysqli_fetch_assoc($res))
										{
										$puramt = getFieldDetail(BARCODE_PROCESS,"RSAMOUNT"," WHERE BARCODENO='". $resdata["BARCODENO"] ."' and PROCESSTYPE='Purchase'");
										
										
											
						?>
						<tr class="popiptbl">
											
											<td>
												<?php echo $resdata["LAB"];?>
											</td>
											<td>
												<?php echo $resdata["CERTIFICATENO"];?>
											</td>
											<td>
												<?php echo $resdata["SHAPE"];?>
											</td>
											<td>
												<?php echo $resdata["PCS"];?>
											</td>
											<td>
												<?php echo $resdata["WEIGHT"];?>
											</td>
											<td>
												<?php echo $resdata["COLOR"];?>
											</td>
											<td>
												<?php echo $resdata["CLARITY"];?>
											</td>
											<td>
												<?php echo $resdata["CUT"];?>
											</td>
											<td>
												<?php echo $resdata["POLISH"];?>
											</td>
											<td>
												<?php echo $resdata["SYMM"];?>
											</td>
											<td>
												<?php echo $resdata["FLOURANCE"];?>
											</td>
											
											<td align="right">
												<?php echo getCurrFormat0($resdata["RATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISCPER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RATEDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RMBRATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISC2PER"];?>
											</td>
											<td>
												<?php echo $resdata["DISC3PER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["PERCRTDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["TOTALDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo $resdata["CONVRATE"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RSPERCRT"]);?>
											</td>
											<td  align="right">
												<?php echo getCurrFormat($resdata["RSAMOUNT"]);?>
											</td>
							</tr>
							
						<?php
						}
						
						?>
						
						</tbody>
		
	
		</table>
		<?php
		//==================================RECUT ISSUE /RECEIVE============================================================================================
		$resRecut = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO like '%".$NEWBAR."' AND PROCESSTYPE in ('Recut Issue','Recut Receive')");
		if(mysqli_num_rows($resRecut) > 0)
			{
				?>
					<hr>
						<table width="100%" align="center" class="tblmaintop">
							<tr style="background-color:#fff;color:#000;">
								<td colspan="4" style="text-align:center">Recut</td>
							</tr>
				<?php
				$resRecutdata = mysqli_fetch_assoc($resRecut);
				
					?>
					<tr>
						<td width="10%" >ID :<?php echo $resRecutdata["ID"];?></td>
						<td width="50%" >Party :<?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resRecutdata["LEDGERID"]."'");?></td>
						<td width="20%">Date:<?php echo getDateFormat($resRecutdata["VDATE"]);?></td>
						<td width="20%">&nbsp;</td>
					</tr>
			
						
					</table>
					<table width="100%" border="1"  class="tblmain customResponsiveTable" >
						<tbody>
								<tr align="center" class="popiptbl">
									<th>Status</th>
									<th>Lab</th>
									<th >Cert.</th>
									<th >Shape</th>
									<th >Pcs</th>
									<th >Wgt</th>
									<th >Col</th>
									<th >Cla</th>
									<th >Cut</th>
									<th >Pol</th>
									<th >Sym</th>
									<th >Flou</th>
									
									<th >Rap</th>
									<th >Dis</th>
									<th >$ Rate</th>
									<th >RMB Rate</th>
									<th >Dis 1</th>
									<th >Dis 2</th>
									<th >$/Crt</th>
									<th >$ Total</th>
									<th >$</th>
									<th >Rs/Crt</th>
									<th >Rs Amt</th>
									<th>Expense</th>
									
								</tr>
								<?php
								$resRecut = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO like '%".$NEWBAR."' AND PROCESSTYPE in ('Recut Issue','Recut Receive')");
								while($resdata = mysqli_fetch_assoc($resRecut))
								{
									$EXPENCEAMOUNT+=$resdata["EXPENCE"];
									?>
									<tr class="popiptbl">
											<td>
												<?php echo $resdata["PROCESSTYPE"];?>
											</td>
											<td>
												<?php echo $resdata["LAB"];?>
											</td>
											<td>
												<?php echo $resdata["CERTIFICATENO"];?>
											</td>
											<td>
												<?php echo $resdata["SHAPE"];?>
											</td>
											<td>
												<?php echo $resdata["PCS"];?>
											</td>
											<td>
												<?php echo $resdata["WEIGHT"];?>
											</td>
											<td>
												<?php echo $resdata["COLOR"];?>
											</td>
											<td>
												<?php echo $resdata["CLARITY"];?>
											</td>
											<td>
												<?php echo $resdata["CUT"];?>
											</td>
											<td>
												<?php echo $resdata["POLISH"];?>
											</td>
											<td>
												<?php echo $resdata["SYMM"];?>
											</td>
											<td>
												<?php echo $resdata["FLOURANCE"];?>
											</td>
										
											<td align="right">
												<?php echo getCurrFormat0($resdata["RATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISCPER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RATEDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RMBRATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISC2PER"];?>
											</td>
											<td>
												<?php echo $resdata["DISC3PER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["PERCRTDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["TOTALDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo $resdata["CONVRATE"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RSPERCRT"]);?>
											</td>
											<td  align="right">
												<?php echo getCurrFormat($resdata["RSAMOUNT"]);?>
											</td>
											<td  align="right">
												<?php echo getCurrFormat($resdata["EXPENCE"]);?>
											</td>
							</tr>
									<?php
								}
								?>
						</tbody>
						</table>
					<?php
				
			}

		//==================================GRADING ISSUE /RESULT /RECEIVE============================================================================================
		$resGrad = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO like '%".$NEWBAR."' AND PROCESSTYPE in ('Grading Issue')");
		if(mysqli_num_rows($resGrad) > 0)
			{
				?>
						<hr>
						<table width="100%" align="center" class="tblmaintop">
							<tr style="background-color:#fff;color:#000;">
								<td colspan="4" style="text-align:center">Grading</td>
							</tr>
							<?php
								$resGraddata = mysqli_fetch_assoc($resGrad);
				
							?>
							<tr>
								<td width="10%" >ID :<?php echo $resGraddata["ID"];?></td>
								<td width="50%" >Party :<?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resGraddata["LEDGERID"]."'");?></td>
								<td width="20%">Date:<?php echo getDateFormat($resGraddata["VDATE"]);?></td>
								<td width="20%">Issue Lab:<?php echo $resGraddata["ISSUELAB"];?></td>
							</tr>
						</table>
						<table width="100%" border="1"  class="tblmain customResponsiveTable" >
						<tbody>
								<tr align="center" class="popiptbl">
									<th>Status</th>
									<th>Lab</th>
									<th >Cert.</th>
									<th >Shape</th>
									<th >Pcs</th>
									<th >Wgt</th>
									<th >Col</th>
									<th >Cla</th>
									<th >Cut</th>
									<th >Pol</th>
									<th >Sym</th>
									<th >Flou</th>
									
									<th >Rap</th>
									<th >Dis</th>
									<th >$ Rate</th>
									<th >RMB Rate</th>
									<th >Dis 1</th>
									<th >Dis 2</th>
									<th >$/Crt</th>
									<th >$ Total</th>
									<th >$</th>
									<th >Rs/Crt</th>
									<th >Rs Amt</th>
									<th>Expense</th>
									
								</tr>
								<?php
								$resGrad = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO like '%".$NEWBAR."' AND PROCESSTYPE in ('Grading Issue','Grading Result','Grading Receive') ORDER BY ENTRYID");
								while($resdata = mysqli_fetch_assoc($resGrad))
								{
									$EXPENCEAMOUNT+=$resdata["EXPENCE"];
									?>
									<tr class="popiptbl">
											<td>
												<?php echo $resdata["PROCESSTYPE"];?>
											</td>
											<td>
												<?php echo $resdata["LAB"];?>
											</td>
											<td>
												<?php echo $resdata["CERTIFICATENO"];?>
											</td>
											<td>
												<?php echo $resdata["SHAPE"];?>
											</td>
											<td>
												<?php echo $resdata["PCS"];?>
											</td>
											<td>
												<?php echo $resdata["WEIGHT"];?>
											</td>
											<td>
												<?php echo $resdata["COLOR"];?>
											</td>
											<td>
												<?php echo $resdata["CLARITY"];?>
											</td>
											<td>
												<?php echo $resdata["CUT"];?>
											</td>
											<td>
												<?php echo $resdata["POLISH"];?>
											</td>
											<td>
												<?php echo $resdata["SYMM"];?>
											</td>
											<td>
												<?php echo $resdata["FLOURANCE"];?>
											</td>
											
											<td align="right">
												<?php echo getCurrFormat0($resdata["RATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISCPER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RATEDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RMBRATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISC2PER"];?>
											</td>
											<td>
												<?php echo $resdata["DISC3PER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["PERCRTDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["TOTALDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo $resdata["CONVRATE"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RSPERCRT"]);?>
											</td>
											<td  align="right">
												<?php echo getCurrFormat($resdata["RSAMOUNT"]);?>
											</td>
											<td  align="right">
												<?php echo getCurrFormat($resdata["EXPENCE"]);?>
											</td>
							</tr>
									<?php
								}
								?>
						</tbody>
						</table>
						
					<?php
			}
		//==================================SALE============================================================================================		
		$resSale = getData(PURCHASESALE,$AllArr," WHERE ID IN (SELECT ID FROM ". BARCODE_PROCESS ." WHERE BARCODENO like '%".$NEWBAR."' AND PROCESSTYPE='Sale') AND VOUCHERTYPE='Sale'");
						
						
			if(mysqli_num_rows($resSale) > 0)
			{
				?>
					<hr>
						<table width="100%" align="center" class="tblmaintop">
							<tr style="background-color:#fff;color:#000;">
								<td colspan="4" style="text-align:center">Sale</td>
							</tr>
						</table>
				<?php
						while($resSaledata = mysqli_fetch_assoc($resSale))
						{
							$res = getData(BARCODE_PROCESS,$AllArr," WHERE BARCODENO like '%".$NEWBAR ."' AND PROCESSTYPE='Sale' and ID='". $resSaledata["ID"]."'");
							while($resdata = mysqli_fetch_assoc($res))
								{	
								?>
									<table width="100%" align="center" class="tblmaintop">
										<tr>
											<td width="10%" >ID :<?php echo $resSaledata["ID"];?></td>
											<td width="50%" >Party :<?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resSaledata["LEDGERID"]."'");?></td>
											<td width="20%">Date:<?php echo getDateFormat($resSaledata["VOUCHERDATE"]);?></td>
											<td width="20%">Due Days:(<?php echo $resSaledata["DUEDAYS"];?>)<?php echo getDateFormat($resSaledata["DUEDATE"]);?></td>
										</tr>
			
										
									</table>
						<table width="100%" border="1"  class="tblmain customResponsiveTable" >
						<tbody>
								<tr align="center" class="popiptbl">
									
									<th >Lab</th>
									<th >Cert.</th>
									<th >Shape</th>
									<th >Pcs</th>
									<th >Wgt</th>
									<th >Col</th>
									<th >Cla</th>
									<th >Cut</th>
									<th >Pol</th>
									<th >Sym</th>
									<th >Flou</th>
									
									<th >Rap</th>
									<th >Dis</th>
									<th >$ Rate</th>
									<th >RMB Rate</th>
									<th >Dis 1</th>
									<th >Dis 2</th>
									<th >$/Crt</th>
									<th >$ Total</th>
									<th >$</th>
									<th >Rs/Crt</th>
									<th >Rs Amt</th>
									
								</tr>
								
						<?php
						$DALALIPER= getFieldDetail(PURCHASESALE,"DALALIPER"," WHERE ID='". $resdata["ID"] ."' AND VOUCHERTYPE='Sale'"); 
						$DALALIAMT += (($resdata["RSAMOUNT"] * $DALALIPER) / 100);
						$salamt += $resdata["RSAMOUNT"];				
						?>
						<tr class="popiptbl">
											
											<td>
												<?php echo $resdata["LAB"];?>
											</td>
											<td>
												<?php echo $resdata["CERTIFICATENO"];?>
											</td>
											<td>
												<?php echo $resdata["SHAPE"];?>
											</td>
											<td>
												<?php echo $resdata["PCS"];?>
											</td>
											<td>
												<?php echo $resdata["WEIGHT"];?>
											</td>
											<td>
												<?php echo $resdata["COLOR"];?>
											</td>
											<td>
												<?php echo $resdata["CLARITY"];?>
											</td>
											<td>
												<?php echo $resdata["CUT"];?>
											</td>
											<td>
												<?php echo $resdata["POLISH"];?>
											</td>
											<td>
												<?php echo $resdata["SYMM"];?>
											</td>
											<td>
												<?php echo $resdata["FLOURANCE"];?>
											</td>
											
											<td align="right">
												<?php echo getCurrFormat0($resdata["RATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISCPER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RATEDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RMBRATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISC2PER"];?>
											</td>
											<td>
												<?php echo $resdata["DISC3PER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["PERCRTDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["TOTALDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo $resdata["CONVRATE"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RSPERCRT"]);?>
											</td>
											<td  align="right">
												<?php echo getCurrFormat($resdata["RSAMOUNT"]);?>
											</td>
							</tr>
							
						<?php
			}		
										?>
						</tbody>
						<?php
				}
			
		?>
	
		</table>
		
		<?php
		
			}	
if(isset($_SESSION["adminuser"]))
{
	$diff=round($salamt-($puramt+$DALALIAMT+$EXPENCEAMOUNT),2);
	
	?>
	<h1 class="diffcls">Diff: <?php echo round($diff);?></h1>
	<?php
	if($salamt>0)
	{
		?>
		<h1 class="diffcls">GP Ratio: <?php echo round(($diff / $salamt)*100);?></h1>
		<?php
	}
	
	
	
}	
						?>
						
		
		</div>
		<?php
	
}
	else
	{
		?>
		<h1>No Data Available</h1>
		<?php
	}
}
	else
	{
		?>
		<h1>No Data Available</h1>
		<?php
	}
}
elseif(isset($_GET["id"]))
{
	$res = getData(BARCODE_PROCESS,$AllArr," WHERE ID='".$_GET["id"] ."'");
	if(mysqli_num_rows($res) !=0 )
	{
		//$resdata = mysqli_fetch_assoc($res);
		
				$resPur = getData(PURCHASESALE,$AllArr," WHERE ID='".$_GET["id"] ."'");
				$resPurdata = mysqli_fetch_assoc($resPur);
		?>
		<div class="overlay_container" >
		<table width="100%" align="center" class="tblmaintop">
			<tr>
				<td width="50px" >ID :<?php echo getFieldDetail(BARCODE_PROCESS,"ID"," WHERE ID='".$_GET["id"] ."'");?></td>
				<td width="90px" >Party :<?php echo getFieldDetail(LEDGER,"LEDGERNAME"," WHERE LEDGERID ='".$resPurdata["LEDGERID"]."'");?></td>
			</tr>
			<tr>
				<td>Date:<?php echo getDateFormat($resPurdata["VOUCHERDATE"]);?></td>
				<td>Due Days:(<?php echo $resPurdata["DUEDAYS"];?>)<?php echo getDateFormat($resPurdata["DUEDATE"]);?></td>
			</tr>
		</table>
		
		
		
		
			<style>
			
			.tblmain {
				width: 100%;
				display:block;
			}
			.tblmain  thead,.tblmain  tbody { display: block; }

			.tblmain tbody {
				height: 400px;       /* Just for the demo          */
				overflow-y: auto;    /* Trigger vertical scroll    */
				overflow-x: auto;  /* Hide the horizontal scroll */
			}
			  
  
			.tblmaintop, .tblmaintop tr td
			{
				font-size:1.2em;
				vertical-align:top;
			}
			.tblmaintop td,.popiptbl td,.popiptbl th{
				
				padding:7px;
			}
			.tblmain thead tr th
			{
				text-align:center;
			}
			.tblmain
			{
				background-color:#fff;
				color:#000;
				
			}
			</style>
			<table width="100%" border="1"  class="tblmain customResponsiveTable" >
						<tbody>
								<tr align="center" class="popiptbl">
									<th >Stock No</th>
									<th >Lab</th>
									<th >Cert.</th>
									<th >Shape</th>
									<th >Pcs</th>
									<th >Wgt</th>
									<th >Col</th>
									<th >Cla</th>
									<th >Cut</th>
									<th >Pol</th>
									<th >Sym</th>
									<th >Flou</th>
									<th >Green</th>
									<th >Milky</th>
									<th >Rap</th>
									<th >Dis</th>
									<th >$ Rate</th>
									<th >Dis 1</th>
									<th >Dis 2</th>
									<th >$/Crt</th>
									<th >$ Total</th>
									<th >$</th>
									<th >Rs/Crt</th>
									<th >Rs Amt</th>
									
								</tr>								
						
						
						<?php
										while($resdata = mysqli_fetch_assoc($res))
										{
		
											
						?>
						<tr class="popiptbl">
											<td>
												<?php echo $resdata["BARCODENO"];?>
											</td>
											<td>
												<?php echo $resdata["LAB"];?>
											</td>
											<td>
												<?php echo $resdata["CERTIFICATENO"];?>
											</td>
											<td>
												<?php echo $resdata["SHAPE"];?>
											</td>
											<td>
												<?php echo $resdata["PCS"];?>
											</td>
											<td>
												<?php echo $resdata["WEIGHT"];?>
											</td>
											<td>
												<?php echo $resdata["COLOR"];?>
											</td>
											<td>
												<?php echo $resdata["CLARITY"];?>
											</td>
											<td>
												<?php echo $resdata["CUT"];?>
											</td>
											<td>
												<?php echo $resdata["POLISH"];?>
											</td>
											<td>
												<?php echo $resdata["SYMM"];?>
											</td>
											<td>
												<?php echo $resdata["FLOURANCE"];?>
											</td>
											<td>
												<?php echo $resdata["GREEN"];?>
											</td>
											<td>
												<?php echo $resdata["MILKY"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat0($resdata["RATE"]);?>
											</td>
											<td>
												<?php echo $resdata["DISCPER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RATEDOLLAR"]);?>
											</td>
											<td>
												<?php echo $resdata["DISC2PER"];?>
											</td>
											<td>
												<?php echo $resdata["DISC3PER"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["PERCRTDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["TOTALDOLLAR"]);?>
											</td>
											<td align="right">
												<?php echo $resPurdata["CONVRATE"];?>
											</td>
											<td align="right">
												<?php echo getCurrFormat($resdata["RSPERCRT"]);?>
											</td>
											<td  align="right">
												<?php echo getCurrFormat($resdata["RSAMOUNT"]);?>
											</td>
							</tr>
							
						<?php
										}

										?>
										<tr class="popiptbl">
											
											<td colspan="23" align="right">
												FINALTOTAL:
											</td>
											<td align="right">
												<?php echo getCurrFormat($resPurdata["FINALTOTAL"]);?>
											</td>
							</tr>
							<tr class="popiptbl">
											
											<td colspan="23" align="right">
												CGST:
											</td>
											<td align="right">
												<?php echo getCurrFormat($resPurdata["CGSTAMT"]);?>
											</td>
							</tr>
							<tr class="popiptbl">
											
											<td colspan="23" align="right">
												SGST:
											</td>
											<td align="right">
												<?php echo getCurrFormat($resPurdata["SGSTAMT"]);?>
											</td>
							</tr>
							<tr class="popiptbl">
											
											<td colspan="23" align="right">
												IGST:
											</td>
											<td align="right">
												<?php echo getCurrFormat($resPurdata["IGSTAMT"]);?>
											</td>
							</tr>
										<tr class="popiptbl">
											
											<td colspan="23" align="right">
												FINALTOTAL:
											</td>
											<td align="right">
												<?php echo getCurrFormat($resPurdata["FINALTOTAL"]);?>
											</td>
							</tr>
										<tr class="popiptbl">
											
											<td colspan="23" align="right">
												GRANDAMOUNT:
											</td>
											<td align="right">
												<?php echo getCurrFormat($resPurdata["GRANDAMOUNT"]);?>
											</td>
							</tr>
						</tbody>
		
	
		</table>
		</div>
		<?php
	
}
	else
	{
		?>
		<h1>No Data Available</h1>
		<?php
	}
}


//journal data
elseif(isset($_GET["journal"]))
{
	$DebitCreditArr = Array();
	array_push($DebitCreditArr,"DR.SRNO");
	array_push($DebitCreditArr,"DR.VOUCHERTYPE");
	array_push($DebitCreditArr,"DR.LEDGERID AS DRLEDGERID");
	array_push($DebitCreditArr,"CR.LEDGERID AS CRLEDGERID");
	array_push($DebitCreditArr,"DR.AMOUNT AS DRAMOUNT");
	array_push($DebitCreditArr,"CR.AMOUNT AS CRAMOUNT");
	array_push($DebitCreditArr,"DR.DESCRIPTION");
	array_push($DebitCreditArr,"DR.VOUCHERDATE");
	array_push($DebitCreditArr,"DR.CONVRATE");
	array_push($DebitCreditArr,"DR.AMOUNTDOLLAR");	
		$res = getData(LEDGER_DEBIT,$DebitCreditArr,"  AS DR INNER JOIN ".LEDGER_CREDIT." AS CR ON CR.SRNO=DR.SRNO AND CR.VOUCHERTYPE=DR.VOUCHERTYPE WHERE CR.VOUCHERTYPE='Journal' AND DR.VOUCHERTYPE='Journal' AND DR.SRNO='".$_GET["journal"]."' AND CR.SRNO='".$_GET["journal"]."'");
		$resdata = mysqli_fetch_assoc($res);	
		if(mysqli_num_rows($res) !=0 )
		{
		$restaxout = getData(LEDGER_CREDIT,$AllArr,"  WHERE VOUCHERTYPE='Tax Out' AND SRNO='".$_GET["journal"]."'");
		$restaxin = getData(LEDGER_CREDIT,$AllArr,"  WHERE VOUCHERTYPE='Tax In' AND SRNO='".$_GET["journal"]."'");
		$IGSTAMT=0;
		$CGSTAMT=0;
		$SGSTAMT=0;
		$GRANDAMOUNT=0;
		$TAXTYPE="";
		if(mysqli_num_rows($restaxout) > 0)
		{
			while($resdatatax = mysqli_fetch_assoc($restaxout))
			{
				switch($resdatatax )
				{
					case IGSTOUT:
						$IGSTAMT = $resdatatax["AMOUNT"];
					break;
					case CGSTOUT:
						$CGSTAMT = $resdatatax["AMOUNT"];
					break;
					case SGSTOUT:
						$SGSTAMT = $resdatatax["AMOUNT"];
					break;
				}
			}
			$GRANDAMOUNT = $IGSTAMT+$CGSTAMT+$SGSTAMT+$resdata["CRAMOUNT"];
			$TAXTYPE="Tax Out";
		}
		elseif(mysqli_num_rows($restaxin) > 0)
		{
			while($resdatatax = mysqli_fetch_assoc($restaxin))
			{
				switch($resdatatax )
				{
					case IGSTIN:
						$IGSTAMT = $resdatatax["AMOUNT"];
					break;
					case CGSTIN:
						$CGSTAMT = $resdatatax["AMOUNT"];
					break;
					case SGSTIN:
						$SGSTAMT = $resdatatax["AMOUNT"];
					break;
				}
			}
			$GRANDAMOUNT = $IGSTAMT+$CGSTAMT+$SGSTAMT+$resdata["DRAMOUNT"];
			$TAXTYPE="Tax In";
		}

		$dtfrm = $resdata["VOUCHERDATE"];

		$CR_AMT = getFieldDetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$resdata["DRLEDGERID"]."' AND VOUCHERDATE <='".$dtfrm."' AND VOUCHERTYPE IN ('Journal','Cash','Bank','Opening')");
		$DR_AMT = getFieldDetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$resdata["DRLEDGERID"]."' AND VOUCHERDATE <='".$dtfrm."' AND VOUCHERTYPE IN ('Journal','Cash','Bank','Opening')");
		$BAL_DR = (($DR_AMT-$CR_AMT)) > 0 ? (($DR_AMT-$CR_AMT)) : Abs(($DR_AMT-$CR_AMT));
	
		
		$CR_AMT = getFieldDetail(LEDGER_CREDIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$resdata["CRLEDGERID"]."' AND VOUCHERDATE <='".$dtfrm."' AND VOUCHERTYPE IN ('Journal','Cash','Bank','Opening')");
		$DR_AMT = getFieldDetail(LEDGER_DEBIT, "SUM(AMOUNT)", " WHERE LEDGERID='".$resdata["CRLEDGERID"]."' AND VOUCHERDATE <='".$dtfrm."' AND VOUCHERTYPE IN ('Journal','Cash','Bank','Opening')");
		$BAL_CR = (($DR_AMT-$CR_AMT)) > 0 ? (($DR_AMT-$CR_AMT)) : Abs(($DR_AMT-$CR_AMT));
		
	?>
	 <div >
		<div >
			<div >
				
				<div >

					
						<input type="hidden" value="<?php echo $resdata["SRNO"]?>" name="SRNO">
						<input type="hidden" value="<?php echo $resdata["VOUCHERTYPE"]?>" name="VOUCHERTYPE">
						<input  type="hidden" value="<?php echo $TAXTYPE?>" name="TAXTYPE">
							
						<div >
							<table width="15%" class="inputfieldtable">
								<tr>
									<td width="15%"><label>Date</label></td>
								</tr>
								<tr>
									<td>
										<input type="date" class="form-control" name="dtpVOUCHERDATE" id="dtpVOUCHERDATE" value="<?php echo $resdata["VOUCHERDATE"];?>" readonly>
									</td>
								
								</tr>
								
							</table>
							
						</div>
						<div class="form-group">
							<table width="60%" class="inputfieldtable">
								<tr>
									<td width="35%"><label>Receiver Name</label></td>
									<td><label>Giver Name</label></td>
								</tr>
								<tr>
									<td>
										<?php
												$DRledgername =getFieldDetail(LEDGER,"LEDGERNAME"," WHERE FLAG='0' and LEDGERID= '".$resdata["DRLEDGERID"]."'");
										
										?>
									
										<input type="text" class="form-control" name="txtDRLEDGERID" id="txtBOOKLEDGERID" value="<?php echo $DRledgername;?>" readonly>
								
										<br>Bal.<span id="txtBOOKLEDGERIDBALANCE">(<?php echo $BAL_DR; ?>)</span>
										<input type="hidden" id="BOOKLEDGERIDBALANCE" name="DRLEDGERIDBALANCE" val="<?php echo $BAL_DR; ?>"/>
									</td>
									<td>
										
											<?php
												$CRledgername =getFieldDetail(LEDGER,"LEDGERNAME"," WHERE FLAG='0' and LEDGERID= '".$resdata["CRLEDGERID"]."'");
										
										?>
									
										<input type="text" class="form-control" name="txtCRLEDGERID" id="txtLEDGERID" value="<?php echo $CRledgername;?>" readonly>
								
											<br>Bal.<span id="txtLEDGERIDBALANCE">(<?php echo $BAL_CR; ?>)</span>
										<input type="hidden" id="LEDGERIDBALANCE" name="CRLEDGERIDBALANCE" valUE="<?php echo $BAL_CR; ?>" />
									</td>
								</tr>
								
							</table>
							
						</div>
						
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>DR Amount</label></td>
									<td><label>CR Amount</label></td>
									<td><label>Conv Rate</label></td>
									<td><label>$ Amount</label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control onlyNumber amtchange DRAMOUNT" name="txtDRAMOUNT" id="txtDRAMOUNT" value="<?php echo $resdata["DRAMOUNT"]?>" readonly>
									</td>
									<td>
										<input type="text" class="form-control onlyNumber amtchange CRAMOUNT" name="txtCRAMOUNT" id="txtCRAMOUNT" value="<?php echo $resdata["CRAMOUNT"]?>" readonly>
									</td>
									<td>
										<input type="text" class="form-control onlyNumber amtchange" name="txtCONVRATE" id="txtCONVRATE" value="<?php echo $resdata["CONVRATE"]?>" readonly>
									</td>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtAMOUNTDOLLAR" id="txtAMOUNTDOLLAR" value="<?php echo $resdata["AMOUNTDOLLAR"]?>" readonly>
									</td>
								</tr>
								
							</table>
							
						</div>
						
						
						<div class="form-group">
							<table width="100%" class="inputfieldtable">
								<tr>
									<td><label>IGST Amount</label></td>
									<td><label>CGST Amount</label></td>
									<td><label>SGST Amount</label></td>
									<td><label>Final Total </label></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control onlyNumber gstchange CRDRAMOUNT" name="txtIGSTAMT" id="txtIGSTAMT" value="<?php echo $IGSTAMT;?>" readonly>
									</td>
									<td>
										<input type="text" class="form-control onlyNumber gstchange CRDRAMOUNT" name="txtCGSTAMT" id="txtCGSTAMT" value="<?php echo $CGSTAMT;?>" readonly>
									</td>
									<td>
										<input type="text" class="form-control onlyNumber gstchange CRDRAMOUNT" name="txtSGSTAMT" id="txtSGSTAMT" value="<?php echo $SGSTAMT;?>" readonly>
									</td>
									<td>
										<input type="text" class="form-control onlyNumber" name="txtGRANDAMOUNT" id="txtGRANDAMOUNT" value="<?php echo $GRANDAMOUNT;?>" readonly>
									</td>
								</tr>
								
							</table>
							
						</div>
						
	
						
					
				</div>
			</div>
		</div>
		
	</div>
	
	

		
		<?php
	
}
	else
	{
		?>
		<h1>No Data Available</h1>
		<?php
	}
}


elseif(isset($_GET["remove_field"]))
{
	$val = $_POST["barno"];
	$arr = explode("/",$val);
	deleteData(BARCODE_PROCESS," WHERE PROCESSTYPE='".$arr[1]."' AND BARCODENO='".$arr[0]."'");
}


elseif(isset($_GET["viewstatus"]))
{
	$res = getData(EMPLOYEERIGHTS,$AllArr," where (VIEWSTATUS =1 OR ADDSTATUS=1 OR DELETESTATUS=1 OR EDITSTATUS=1) AND EMPLOYEEID in (SELECT USERLOGINID FROM ".USER." WHERE USERNAME='".$_SESSION["user"]."')");
	$str ="";
	while($resdata= mysqli_fetch_assoc($res))
	{
		$str .= $resdata["MENUNAME"]."|";
	}
	
	echo $str!='' ? substr($str,0,strlen($str)-1) :'';
}
elseif(isset($_POST["txtLEDGERNAME"]))
{
	$cnt = getFieldDetail(LEDGER,"COUNT(*)"," WHERE LEDGERNAME='".$_POST["txtLEDGERNAME"]."'");
	if($cnt > 0)
		echo"1";
	else	
		echo "";
}
elseif(isset($_POST["getconvrate"]))
{
	echo getFieldDetail(BARCODE_PROCESS,"CONVRATE"," WHERE BARCODENO='".$_POST["getconvrate"]."'");
}
elseif(isset($_GET["purchasebarcode"]))
{
	echo getFieldDetail(BARCODE_PROCESS,"ID"," WHERE BARCODENO='".$_POST["search_barcode_pur"]."' and PROCESSTYPE='Purchase'");
}
elseif(isset($_GET["salebarcode"]))
{
	echo getFieldDetail(BARCODE_PROCESS,"ID"," WHERE BARCODENO='".$_POST["search_barcode_sal"]."' and PROCESSTYPE='Sale'");
}
elseif(isset($_POST["clearid"]))
{
	if(!empty($rescompanydata["CLEARANCEAC_CR"]) || !empty($rescompanydata["CLEARANCEAC_DR"]))
	{
		
		$clearid = $_POST["clearid"];
		$arr = explode("-",$clearid);
	
		$ID = $arr[0];
		$VOUCHERTYPE = $arr[1];
		$AMOUNT = $arr[2];
		$LEDID = $arr[3];
		
	
		$tranFieldArr= array();
		$tranValueArr= array();
		array_push($tranFieldArr,"SRNO");
		array_push($tranFieldArr,"VOUCHERNO");
		array_push($tranFieldArr,"VOUCHERTYPE");
		array_push($tranFieldArr,"LEDGERID");
		array_push($tranFieldArr,"GROUPID");
		array_push($tranFieldArr,"AMOUNT");
		array_push($tranFieldArr,"DESCRIPTION");
		array_push($tranFieldArr,"VOUCHERDATE");
		array_push($tranFieldArr,"UPDATEDATE");
		array_push($tranFieldArr,"USERNAME");
		array_push($tranFieldArr,"CONVRATE");
		array_push($tranFieldArr,"AMOUNTDOLLAR");
		array_push($tranFieldArr,"IDTYPE");
		
		$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
		$VOUCHERNO = $ID;
				
		if($VOUCHERTYPE == "Purchase")
		{
			$LEDGERID = $rescompanydata["CLEARANCEAC_CR"];
			$DRLEDGERID = $LEDID;
		}
		elseif($VOUCHERTYPE == "Sale")
		{			
			$LEDGERID = $rescompanydata["CLEARANCEAC_DR"];
			$CRLEDGERID = $LEDID;
		}
			
		array_push($tranValueArr,"'".$SRNO."'");
		array_push($tranValueArr,"'".$VOUCHERNO."'");
		array_push($tranValueArr,"'Journal Payment'");
		array_push($tranValueArr,"'".$LEDGERID."'");
		array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$LEDGERID."'")."'");
		array_push($tranValueArr,"'".$AMOUNT."'");
		array_push($tranValueArr,"'Clearance'");
		array_push($tranValueArr,"'".date("Y-m-d")."'");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranValueArr,"'".$user_name."'");
		array_push($tranValueArr,"'1'");
		array_push($tranValueArr,"'".$AMOUNT."'");
		array_push($tranValueArr,"'".$VOUCHERTYPE."'");
		
		array_push($tranFieldArr,"ENTRYDATE");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		
		if($VOUCHERTYPE == "Purchase")
		{
			newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
			$tranValueArr[3] = $DRLEDGERID;
			$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$DRLEDGERID."'");
			newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
					
		}
		elseif($VOUCHERTYPE == "Sale")
		{
			newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
			$tranValueArr[2] = "'Journal Receipt'";
			$tranValueArr[3] = $CRLEDGERID;
			$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'");
			newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
		}
		
		echo "1";
	}
	else
	{
		echo "0";
	}
	 
}
elseif(isset($_POST["led_clearid"]))
{
	if(!empty($rescompanydata["CLEARANCEAC_CR"]) || !empty($rescompanydata["CLEARANCEAC_DR"]))
	{
		
		$clearid = $_POST["led_clearid"];
		$arr = explode("-",$clearid);
	
		$LEDID = $arr[0];
		$DRCR = $arr[1];
		$AMOUNT = $arr[2];
		
		$VOUCHERTYPE = $DRCR == "Cr" ? "Journal Receipt" : "Journal Payment";
		
	
		$tranFieldArr= array();
		$tranValueArr= array();
		array_push($tranFieldArr,"SRNO");
		array_push($tranFieldArr,"VOUCHERNO");
		array_push($tranFieldArr,"VOUCHERTYPE");
		array_push($tranFieldArr,"LEDGERID");
		array_push($tranFieldArr,"GROUPID");
		array_push($tranFieldArr,"AMOUNT");
		array_push($tranFieldArr,"DESCRIPTION");
		array_push($tranFieldArr,"VOUCHERDATE");
		array_push($tranFieldArr,"UPDATEDATE");
		array_push($tranFieldArr,"USERNAME");
		
		$SRNO = getMaxValue(LEDGER_DEBIT,"SRNO");
		$VOUCHERNO = 0;
				
		if($VOUCHERTYPE == "Journal Receipt")
		{
			$LEDGERID = $rescompanydata["CLEARANCEAC_CR"];
			$DRLEDGERID = $LEDID;
		}
		elseif($VOUCHERTYPE == "Journal Payment")
		{			
			$LEDGERID = $rescompanydata["CLEARANCEAC_DR"];
			$CRLEDGERID = $LEDID;
		}
			
		array_push($tranValueArr,"'".$SRNO."'");
		array_push($tranValueArr,"'".$VOUCHERNO."'");
		array_push($tranValueArr,"'".$VOUCHERTYPE."'");
		array_push($tranValueArr,"'".$LEDGERID."'");
		array_push($tranValueArr,"'".getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$LEDGERID."'")."'");
		array_push($tranValueArr,"'".$AMOUNT."'");
		array_push($tranValueArr,"'Clearance'");
		array_push($tranValueArr,"'".date("Y-m-d")."'");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		array_push($tranValueArr,"'".$user_name."'");
		
		array_push($tranFieldArr,"ENTRYDATE");
		array_push($tranValueArr,"'".date('Y-m-d h:i:s')."'");
		
		if($VOUCHERTYPE == "Journal Receipt")
		{
			newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
			$tranValueArr[3] = $DRLEDGERID;
			$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$DRLEDGERID."'");
			newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
					
		}
		elseif($VOUCHERTYPE == "Journal Payment")
		{
			newData($tranFieldArr,$tranValueArr,LEDGER_DEBIT);
			$tranValueArr[3] = $CRLEDGERID;
			$tranValueArr[4] = getFieldDetail(LEDGER,"GROUPID"," WHERE LEDGERID='".$CRLEDGERID."'");
			newData($tranFieldArr,$tranValueArr,LEDGER_CREDIT);
		}
		
		echo "";
	}
	else
	{
		echo "0";
	}
	 
}
?>