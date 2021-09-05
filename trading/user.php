<?php
if(isset($_GET["_nid"]))
{
	$action ="new";
	$Caption = "New Account Group Detail";
	$res = getData(USER,$AllArr," WHERE USERLOGINID='0'");
	$resdata = mysqli_fetch_assoc($res);	
	

	
}
elseif(isset($_GET["_mid"]))
{
	
	$action ="modify";
	$USERLOGINID = $_GET["_mid"];
	
	$Caption = "Edit Account Group Detail";
	$res = getData(USER,$AllArr," WHERE USERLOGINID='".$USERLOGINID."'");
	$resdata = mysqli_fetch_assoc($res);	

}
elseif(isset($_GET["_rid"]))
{
	$action ="remove";
	$USERLOGINID = $_GET["_rid"];
	$empid = getFieldDetail(USER,"EMPLOYEEID"," WHERE USERLOGINID='".$USERLOGINID."'");
	deleteData(USER," where USERLOGINID='".$USERLOGINID."'");
	deleteData(EMPLOYEERIGHTS," where EMPLOYEEID='".$empid."'");
	?>
	<script>
		window.location.href="<?php echo SITEURL."?user_vid";?>";
	</script>
	<?php
}
elseif(isset($_GET["_vid"]))
{
	$action = "view";
}

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

	deleteData(EMPLOYEERIGHTS," WHERE EMPLOYEEID='". $USERLOGINID ."'");
	
	$menuarr = $_POST["MENUID"];
	
	foreach($menuarr as $tempctrl)
		{
			$mid=$tempctrl;
			
			$modualname=getFieldDetail(MENULIST,"MENUNAME"," WHERE MENUID='".$mid."'");
					
					$FieldArr_Col=array();
					$FieldArr_Val=array();
					array_push($FieldArr_Col,"EMPLOYEEID");
					array_push($FieldArr_Val,"'".$USERLOGINID."'");
					array_push($FieldArr_Col,"MENUNAME");
					array_push($FieldArr_Val,"'".$modualname."'");
					
					
					
					array_push($FieldArr_Col,"UPDATEDATE");
					array_push($FieldArr_Val,"'".date('Y-m-d h:i:s')."'");	
					
				
					array_push($FieldArr_Col,"EDITSTATUS");
					array_push($FieldArr_Val,(isset($_POST["EDITSTATUS".$mid]) ? 1 : 0));
					
					array_push($FieldArr_Col,"DELETESTATUS");
					array_push($FieldArr_Val,(isset($_POST["DELETESTATUS".$mid]) ? 1 : 0));
					
					array_push($FieldArr_Col,"ADDSTATUS");
					array_push($FieldArr_Val,(isset($_POST["ADDSTATUS".$mid]) ? 1 : 0));
					
					array_push($FieldArr_Col,"VIEWSTATUS");
					array_push($FieldArr_Val,(isset($_POST["VIEWSTATUS".$mid]) ? 1 : 0));

			
					
					newData($FieldArr_Col,$FieldArr_Val,EMPLOYEERIGHTS,FALSE);	
				
			
			
		}	
		
		
		
			//exit();
		?>
		<script>
			window.location.href="<?php echo SITEURL."?user";?>";
		</script>
		<?php
	exit();
	$action = "";	

}
elseif(isset($_POST["shape_mul"]))
{
	$DeleteArr = $_POST["SELECT"];
	$DeleteString = "'".implode("','",$DeleteArr)."'";
	$Condition = " WHERE USERLOGINID IN (".$DeleteString.")";
	deleteData(USER,$Condition);
	?>
	<script>
	window.location.href="<?php echo SITEURL."?user_vid";?>";
	</script>
	<?php
}

?>

	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">User</h1>
	</div>
	 <!-- /.col-lg-12 -->
</div>
<?php
if($action=="")
{
		
						if($add_bol)
						{
							?>
							<a class="btn btn-success addcls" href="<?php echo SITEURL; ?>?user&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
							<?php
						}
						if($view_bol)
						{
							?>
							<a class="btn btn-primary" href="<?php echo SITEURL; ?>?user&_vid"><i class="fa fa-plus-tasks"></i>View</a>
							<?php
						}
						
}
else if($action == "view")
{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				 <div class="panel-body">
				 <form name="frmacgrouptable" action="<?php echo SITEURL; ?>?user" method="POST" onsubmit="return confirm('Do you really want to Delete selected user?');">
					<?php echo $back_button;?>
					<p>
						<a class="btn btn-success " href="<?php echo SITEURL; ?>?user&_nid"><i class="fa fa-plus-circle"></i> Add New</a>
						<!--<button type="submit" name="shape_mul" class="btn btn-danger" ><i class="fa fa-trash-o"></i> Delete</button>-->
					</p>
					<div class="dataTable_wrapper">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="text-align:center;width:15%;" >
									SELECT ALL
									<br>
									<input type="checkbox" id="SelectAll" />
									</th>
																		
									<th>User Name</th>
									<th>User Email</th>
									<th>Action</th>
								</tr>
							 </thead>
							<tbody>
							<?php
								$idx = 1;
								$res = getData(USER,$AllArr," WHERE FLAG='0'");
								while($resdata = mysqli_fetch_assoc($res))
									{
										$classname = ($idx / 2) == 0 ? 'odd gradeX' :'even gradeC';
										?>
											<tr class="<?php echo $classname;?>">
											<td align="center"><input type="checkbox" value="<?php //echo $resdata["USERLOGINID"];?>" name="SELECT[]" class="SelectAll"/></td>
												
												<td><?php echo $resdata["USERNAME"];?></td>
												<td><?php echo $resdata["EMAIL"];?></td>
												<td>
													<a href="<?php echo SITEURL; ?>?user&_mid=<?php //echo $resdata["USERLOGINID"];?>" class="btn btn-primary btn-circle" title="Edit">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo SITEURL; ?>?user&_rid=<?php //echo $resdata["USERLOGINID"];?>" onclick="return confirm('Do you really want to Delete User : <?php //echo $resdata["USERNAME"];?>?');" class="btn btn-danger btn-circle" title="Delete">
														<i class="fa fa-trash-o"></i>
													</a>
												</td>
											</tr>
										<?php
									}
							?>                                        
							</tbody>
						</table>
					</div>
					</form>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
     <!-- /.col-lg-12 -->
	</div>
	
	<?php


}
elseif($action == "modify" || $action == "new")
{
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
										<input  type="text" class="form-control " name="txtUSERNAME" id="txtUSERNAME" value="<?php //echo $resdata["USERNAME"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtFIRSTNAME" id="txtFIRSTNAME" value="<?php //echo $resdata["FIRSTNAME"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtMIDDLENAME" id="txtMIDDLENAME" value="<?php //echo $resdata["MIDDLENAME"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtLASTNAME" id="txtLASTNAME" value="<?php //echo $resdata["LASTNAME"];?>">
									</td>
								</tr>
								</table>
                        </div>
						
						<div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control " name="txtADDRESS" id="txtADDRESS" ><?php //echo $resdata["ADDRESS"];?></textarea>
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
										<input type="text" class="form-control" name="txtPHONE" id="txtPHONE" value="<?php //echo $resdata["PHONE"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtMOBILE" id="txtMOBILE" value="<?php //echo $resdata["MOBILE"];?>">
									</td>
									<td>
										<input type="text" class="form-control" name="txtEMAIL" id="txtEMAIL" value="<?php //echo $resdata["EMAIL"];?>">
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
										<input type="text" class="form-control" name="txtANSWER" id="txtANSWER" value="<?php //echo $resdata["ANSWER"];?>">
									</td>
								</tr>
								</table>
                        </div>
						
						<div class="form-group">
							<label>Popup Stock</label><br>
									<input type="checkbox" name="chkPOPUPSTOCKSTATUS" id="chkPOPUPSTOCKSTATUS" value="Y" <?php //echo $resdata["POPUPSTOCKSTATUS"] == 'Y' ? "checked" : "";?>>
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
												<td align="center" colspan="6"><?php //echo $resgroupdata["GROUPNAME"]?></td>
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
													
													<input type="hidden" value="<?php //echo $resModdata["MENUID"];?>" name="MENUID[]">
													
													<td><input type="checkbox" value="1" class="SelectAll singlechk" rel="<?php echo $resModdata["MENUID"];?>" name="chk<?php //echo $resModdata["MENUID"];?>" <?php echo ($rec_exist ? "checked" : "");?>></td>
													<td><input type="checkbox" value="1" class="SelectAllView singlechk<?php echo $resModdata["MENUID"];?>" name="VIEWSTATUS<?php //echo $resModdata["MENUID"];?>" <?php echo ($rec_viewexist ? "checked" : "");?>></td>
													<td><input type="checkbox" value="1" class="SelectAllAdd singlechk<?php echo $resModdata["MENUID"];?>" name="ADDSTATUS<?php //echo $resModdata["MENUID"];?>" <?php echo ($rec_addexist ? "checked" : "");?>></td>
													<td><input type="checkbox" value="1" class="SelectAllEdit singlechk<?php echo $resModdata["MENUID"];?>" name="EDITSTATUS<?php //echo $resModdata["MENUID"];?>" <?php echo ($rec_editexist ? "checked" : "");?>></td>
													<td><input type="checkbox" value="1" class="SelectAllDelete singlechk<?php echo $resModdata["MENUID"];?>" name="DELETESTATUS<?php //echo $resModdata["MENUID"];?>" <?php echo ($rec_deleteexist ? "checked" : "");?>></td>
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
	
<?php
?>

	
