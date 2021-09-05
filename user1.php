<?php 
include 'init\script\function.php';
include 'init\script\constant.php';
	$res = getData(USER,$AllArr," WHERE USERLOGINID='0'");
	$resdata = mysqli_fetch_assoc($res);
	if(isset($_POST["user"]))
{
	
	$USERLOGINID = $_POST["USERLOGINID"];
	$PostArr_Key = is_array($_POST) ? array_keys($_POST) :array();
	$FieldArr_Col = array();
	$FieldArr_Val = array();
	//print_r($_POST);
	
	foreach($PostArr_Key as $tempctrl)
	{
		$colname_prefix = substr($tempctrl,0,3);
		$colname = substr($tempctrl,3);
		//print_r($colname);
		switch($colname_prefix)
		{
			case "txt":
				if($colname =="PASSWORD" )
				{
				array_push($FieldArr_Col,$colname);
				array_push($FieldArr_Val,"'".md5($_POST[$tempctrl])."'");
				//print_r($_POST[$tempctrl]);
				}elseif($colname =="CPASSWORD"){
				}else{
				array_push($FieldArr_Col,$colname);
				array_push($FieldArr_Val,"'".$_POST[$tempctrl]."'");	
				}
				
			break;
			case "lst":
				$strtemp = isset($_POST[$tempctrl]) ? implode("','",$_POST[$tempctrl]) : '';
				$strtemp = "'".$strtemp."'";
				$strtemp = addslashes($strtemp);
				array_push($FieldArr_Col,$colname);
				array_push($FieldArr_Val,"'".$strtemp."'");
			break;
		}
	}
	$POPUPSTOCKSTATUS = isset($_POST["chkPOPUPSTOCKSTATUS"]) ?"Y":"N";
	array_push($FieldArr_Col,"POPUPSTOCKSTATUS");
	array_push($FieldArr_Val,"'".$POPUPSTOCKSTATUS."'");
	array_push($FieldArr_Col,"UPDATEDATE");
	array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
	//array_push($FieldArr_Col,"USERNAME");
	//array_push($FieldArr_Val,"'".$loginuser_name."'");
	array_push($FieldArr_Col,"FLAG");
	array_push($FieldArr_Val,"'0'");
	//$TableName= USER;
	$Condition = " WHERE USERLOGINID='". $USERLOGINID ."'";
	
	

	$reccnt = getFieldDetail(USER,"count(*)"," WHERE USERLOGINID='". $USERLOGINID ."'");
	if ($reccnt == 0)
		{
			array_push($FieldArr_Col,"PASSWORD");
			array_push($FieldArr_Val,"'".md5($_POST["PASSWORD"])."'");
			array_push($FieldArr_Col,"ENTERYDATE");
			array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");
			
			$USERLOGINID = newData($FieldArr_Col,$FieldArr_Val,USER,TRUE);
			
			//exit();
			
		}
	else
		{
			if($_POST["PASSWORD"] != ''){
				array_push($FieldArr_Col,"PASSWORD");
				array_push($FieldArr_Val,"'".md5($_POST["PASSWORD"])."'");
			}
			
				editData($FieldArr_Col,$FieldArr_Val,USER,$Condition);
			
		}


?>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
                    <?php echo $Caption;?>
                </div>
				<div class="panel-body">
					<?php echo $back_button;?>
					<form id="frm_AccountGroup" action="<?php echo SITEURL; ?>?user" method="POST" >
						<input type="hidden" name="USERLOGINID" id="USERLOGINID" value="<?php echo $resdata["USERLOGINID"];?>">
						<div class="form-group">
                            <table width="100%" class="inputfieldtable">
								<tr>
									<td><label>User Name</label></td>
									<td><label>First Name</label></td>
									<td><label>Middle Name</label></td>
									<td><label>Last Name</label></td>
									
								</tr>
								<tr>
									<td>
										<input  type="text" class="form-control " name="txtUSERNAME" id="txtUSERNAME" value="<?php echo $resdata["USERNAME"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtFIRSTNAME" id="txtFIRSTNAME" value="<?php echo $resdata["FIRSTNAME"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtMIDDLENAME" id="txtMIDDLENAME" value="<?php echo $resdata["MIDDLENAME"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtLASTNAME" id="txtLASTNAME" value="<?php echo $resdata["LASTNAME"];?>">
									</td>
								</tr>
								</table>
                        </div>
						
						<div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control " name="txtADDRESS" id="txtADDRESS" ><?php echo $resdata["ADDRESS"];?></textarea>
                                <p class="help-block"></p>
                        </div>
						<div class="form-group">
                            <table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Phone Number</label></td>
									<td><label>Mobile Number</label></td>
									<td><label>Email</label></td>
									
								</tr>
								<tr>
									<td>
										<input type="text" class="form-control" name="txtPHONE" id="txtPHONE" value="<?php echo $resdata["PHONE"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtMOBILE" id="txtMOBILE" value="<?php echo $resdata["MOBILE"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtEMAIL" id="txtEMAIL" value="<?php echo $resdata["EMAIL"];?>">
									</td>
								</tr>
								</table>
                        </div>
						<div class="form-group">
                            <table width="100%" class="inputfieldtable">
								<tr>
									<td><label>Password</label></td>
									<td><label>Confirm Password</label></td>
									<td><label>Question</label></td>
									<td><label>Answer</label></td>
									
								</tr>
								<tr>
									<td>
										<input type="password" class="form-control" name="PASSWORD" id="PASSWORD">
									</td>
									<td>
										<input type="password" class="form-control" name="CPASSWORD" id="CPASSWORD" >
									</td>
									<td>
										<select type="text" class="form-control" name="txtQUESTION" id="txtQUESTION">
											<?php echo getList("SecurityQuestion",$resdata["QUESTION"]) ?>
										</select>
									</td>
									<td>
										<input type="text" class="form-control" name="txtANSWER" id="txtANSWER" value="<?php echo $resdata["ANSWER"];?>">
									</td>
								</tr>
								</table>
                        </div>
						
						<div class="form-group">
							<label>Popup Stock</label><br>
									<input type="checkbox" name="chkPOPUPSTOCKSTATUS" id="chkPOPUPSTOCKSTATUS" value="Y" <?php echo $resdata["POPUPSTOCKSTATUS"] == 'Y' ? "checked" : "";?>>
									<p class="help-block"></p>
							
						</div>
						<div class="form-group">
							<label>Report</label>
							<table width="110%" class="inputaddmorefieldtable customResponsiveTable">
								<thead>
									<tr >
										<th style="text-align:center;">Select All<br><input type="checkbox" id="SelectAllView"></th>
										<th>Report Name</th>
										
									</tr>
								</thead>
								<tbody>
								<?php				
											$REPORTLIST_arr = $resdata["REPORTLIST"] != ''  ? explode(",",$resdata["REPORTLIST"]) : array();
											$resreportlist  = getData(REPORTLIST,$AllArr," ORDER BY REPORTNAME ");
											while($resreportlistdata = mysqli_fetch_assoc($resreportlist))
											{
												?>
												<tr>
													<td style="text-align:center;">
													<input type="checkbox" title="<?php echo $resreportlistdata["REPORTNAME"];?>" value="<?php echo $resreportlistdata["REPORTNAME"];?>" <?php echo in_array("'".$resreportlistdata["REPORTNAME"]."'",$REPORTLIST_arr) ? 'checked' :'';?>  name="lstREPORTLIST[]" >
													</td>
													<td >
														<?php echo $resreportlistdata["REPORTNAME"];?>
													</td>
													
												</tr>
												<?php
											}
											?>	
								</tbody>
							</table>
							
						</div>
						<div class="form-group">
						<table width="110%" class="inputaddmorefieldtable customResponsiveTable">
								<thead>
									<tr>
										<th>Menu List</th>
										<th>All Rights</th>
										<th>View</th>
										<th>Add</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<tr align="center">
										<td><strong>ALL</strong></td>
										<td></td>
										<td><input type="checkbox" id="SelectAllView"></td>
										<td><input type="checkbox" id="SelectAllAdd"></td>
										<td><input type="checkbox" id="SelectAllEdit"></td>
										<td><input type="checkbox" id="SelectAllDelete"></td>
									</tr>
						
					
											
						 
						 <?php 
									$modlist_ul="";
									$editlist_ul="";
									$dellist_ul="";
									$addlist_ul="";
									$viewlist_ul="";
									
									$resgroup = getData(MENULIST,$AllArr," GROUP BY GROUPNAME ");
									while($resgroupdata = mysqli_fetch_assoc($resgroup))
									{
										?>
										<tr align="center" style="background-color:lightgray;">
												<td align="center" colspan="6"><?php echo $resgroupdata["GROUPNAME"]?></td>
										</tr>
										<?PHP
										$resMod = getData(MENULIST,$AllArr," where GROUPNAME='".$resgroupdata["GROUPNAME"]."' ORDER BY GROUPNAME,MENUDISPLAY ");
										
										while($resModdata = mysqli_fetch_assoc($resMod))
										{
											$rec_exist = getFieldDetail(EMPLOYEERIGHTS,"DISPLAYSTATUS"," WHERE MENUNAME='".$resModdata["MENUNAME"]."' AND EMPLOYEEID='".$resdata["USERLOGINID"]."'");
											$rec_viewexist = getFieldDetail(EMPLOYEERIGHTS,"VIEWSTATUS"," WHERE MENUNAME='".$resModdata["MENUNAME"]."' AND EMPLOYEEID='".$resdata["USERLOGINID"]."'");						
											$rec_addexist = getFieldDetail(EMPLOYEERIGHTS,"ADDSTATUS"," WHERE MENUNAME='".$resModdata["MENUNAME"]."' AND EMPLOYEEID='".$resdata["USERLOGINID"]."'");										
											$rec_editexist = getFieldDetail(EMPLOYEERIGHTS,"EDITSTATUS"," WHERE MENUNAME='".$resModdata["MENUNAME"]."' AND EMPLOYEEID='".$resdata["USERLOGINID"]."'");
											$rec_deleteexist = getFieldDetail(EMPLOYEERIGHTS,"DELETESTATUS"," WHERE MENUNAME='".$resModdata["MENUNAME"]."' AND EMPLOYEEID='".$resdata["USERLOGINID"]."'");
											
											?>
												<tr align="center">
													<td align="left"><?php echo $resModdata["MENUDISPLAY"]?></td>
													
													<input type="hidden" value="<?php echo $resModdata["MENUID"];?>" name="MENUID[]">
													
													<td><input type="checkbox" value="1" class="SelectAll singlechk" rel="<?php echo $resModdata["MENUID"];?>" name="chk<?php echo $resModdata["MENUID"];?>" <?php echo ($rec_exist ? "checked" : "");?>></td>
													<td><input type="checkbox" value="1" class="SelectAllView singlechk<?php echo $resModdata["MENUID"];?>" name="VIEWSTATUS<?php echo $resModdata["MENUID"];?>" <?php echo ($rec_viewexist ? "checked" : "");?>></td>
													<td><input type="checkbox" value="1" class="SelectAllAdd singlechk<?php echo $resModdata["MENUID"];?>" name="ADDSTATUS<?php echo $resModdata["MENUID"];?>" <?php echo ($rec_addexist ? "checked" : "");?>></td>
													<td><input type="checkbox" value="1" class="SelectAllEdit singlechk<?php echo $resModdata["MENUID"];?>" name="EDITSTATUS<?php echo $resModdata["MENUID"];?>" <?php echo ($rec_editexist ? "checked" : "");?>></td>
													<td><input type="checkbox" value="1" class="SelectAllDelete singlechk<?php echo $resModdata["MENUID"];?>" name="DELETESTATUS<?php echo $resModdata["MENUID"];?>" <?php echo ($rec_deleteexist ? "checked" : "");?>></td>
												</tr>
											<?php
											
										
			
										}
									}
									
									?>
									</tbody>
							</table>		
						
					
									</div>
					
					
					
					
						<button type="submit" class="btn btn-default" style="float: right;" name="user">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>

	<?php
}
?>