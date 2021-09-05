<?php 
if(isset($_POST["changepassword"])){
			if(isset($_SESSION["adminuser"]))
			{
				$FieldArr[0]="ADMINLOGINID";
				$FieldArr[1]="PASSWORD";
				
				$FieldValueArr[0]="'".$loginuser_name."'";
				$FieldValueArr[1]="'".md5($_POST["NEWPASSWORD"])."'";
				
				$TableName= ADMINDETAIL;
				$Condition = " WHERE ADMINLOGINID='".$loginuser_name."'";
				editdata($FieldArr,$FieldValueArr,ADMINDETAIL,$Condition);
			}
			elseif(isset($_SESSION["user"])){
				$FieldArr[0]="USERNAME";
				$FieldArr[1]="PASSWORD";
				
				$FieldValueArr[0]="'".$_SESSION["user"]."'";
				$FieldValueArr[1]="'".md5($_POST["NEWPASSWORD"])."'";
				
				$TableName= USER;
				$Condition = " WHERE USERNAME='".$_SESSION["user"]."'";
				editdata($FieldArr,$FieldValueArr,USER,$Condition);
			}?>
			<script>
	window.location.href="<?php echo SITEURL."?logout";?>";
	</script>
			<?php
		exit();
}else{
	$error= "";
}
?>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Change Password</h1>
		</div>
		 <!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
			
				<div class="panel-body">
					
					<form role="form" action="" method="POST" name="frmchangepassword" id="frmchangepassword">
						
						<div class="form-group">
                            <label>Old Password</label>
                            <input class="form-control" name="OLDPASSWORD" id="OLDPASSWORD" type="password" required> 
                                <p class="help-block" id="errormsg1"></p>
                        </div>
						<div class="form-group">
                            <label>New Password</label>
                            <input class="form-control" name="NEWPASSWORD" id="NEWPASSWORD" type="password" required>
                                <p class="help-block" id="errormsg2"></p>
                        </div>
						<div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" name="CONFIRMPASSWORD" id="CONFIRMPASSWORD" type="password" required>
                                <p class="help-block" id="errormsg3"></p>
                        </div>
						<button type="submit" class="btn btn-default" style="float: right;" name="changepassword">Submit Button</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>


	
