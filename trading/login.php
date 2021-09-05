<?php

include(INIT."script/db.php");
include(INIT."script/function.php");

if(isset($_POST["btnSubmit"]))
{	
	$usertype= $_POST["Usertype"];

		if($usertype == "Admin" ){
			$FieldArr = array();
			$FieldArr[0]  = "ADMINLOGINID";
			$FieldArr[1] = "PASSWORD";
			
			$res = getData(ADMINDETAIL,$FieldArr," WHERE ADMINLOGINID='".$_POST["UserId"]."' AND PASSWORD='".md5($_POST["Password"])."'");
			
			if(mysqli_num_rows($res) == 1)
			{
				
				
				$_SESSION["adminuser"] = $_POST["UserId"];
				$_SESSION["adminpassword"] = $_POST["Password"];
				$_SESSION["logintime"] = date('Y-m-d h:i:s');
				$_SESSION["rstar2"] = true;
					
				$FieldArr = array();
				$FieldValueArr = array();
				$FieldArr[0] = "ADMINLOGINID";
				$FieldArr[1] = "PASSWORD";
				$FieldArr[2] = "LOGINTIME";
				
				
				$FieldValueArr[0] = "'".$_SESSION["adminuser"]."'";
				$FieldValueArr[1] = "'".md5($_SESSION["adminpassword"])."'";
				$FieldValueArr[2] = "'".$_SESSION["logintime"]."'";	
				newData($FieldArr,$FieldValueArr,ADMINLOGINDETAIL);
				header("Location: ?dashboard");
				exit();
			}
			$error ="";
		}
		elseif($usertype == "Employee"){
			
			$FieldArr = array();
			$FieldArr[0]  = "USERNAME";
			$FieldArr[1] =  "PASSWORD";
			
			$res = getData(USER,$FieldArr," WHERE USERNAME='".$_POST["UserId"]."' AND PASSWORD='".md5($_POST["Password"])."'");
			
			if(mysqli_num_rows($res) == 1)
			{
				
				
				$_SESSION["user"] = $_POST["UserId"];
				$_SESSION["userpassword"] = $_POST["Password"];
				$_SESSION["logintime"] = date('Y-m-d h:i:s');
				$_SESSION["rstar2"] = true;
					
				$FieldArr = array();
				$FieldValueArr = array();
				$FieldArr[0] = "USERNAME";
				$FieldArr[1] = "PASSWORD";
				$FieldArr[2] = "LOGINTIME";
				
					
				$FieldValueArr[0] = "'".$_SESSION["user"]."'";
				$FieldValueArr[1] = "'".md5($_SESSION["userpassword"])."'";
				$FieldValueArr[2] = "'".$_SESSION["logintime"]."'";
				
				
				newData($FieldArr,$FieldValueArr,USERLOGINDETAIL);
				header("Location: ?dashboard");
				exit();
			}
			$error ="";
				
	}
	else
	{
	
	}
	$error ="";
}
else
{
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="www.softeriainfotech.com">

    <title><?php echo getFieldDetail(COMPANY,"COMPANYNAME"," WHERE COMPANYID='1'");?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo SITEURL.INIT?>css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo SITEURL.INIT?>css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo SITEURL.INIT?>css/sb-admin-2.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="<?php echo SITEURL.INIT?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="<?php echo SITEURL.INIT;?>images/favicon.ico">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.panel-title 
		{
			text-align:center;
		}
		.LoginLogo img
{
	border-radius:20px;
	width:70%;
}
	</style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title LoginLogo"><img src="<?php echo SITEURL.INIT?>images/logo.png" /></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo SITEURL.""?>" method="post" name="frmlogin">
                            <fieldset>
							
								  <div class="form-group">
										<label class="radio-inline"><input name="Usertype" type="radio" value="Admin" required> <b>Admin</b></label>
										<label class="radio-inline"><input name="Usertype" type="radio" value="Employee" required> <b>Employee</b></label>
									</div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User Id" name="UserId" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="Password" type="password" required>
                                </div>
								<?php echo isset($error) && !empty($error)? '<p>User Id and Password is incorrect</p>' :'';?>
							                              
							   <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block" name="btnSubmit">Login</button>
									<!--<p class="pull-right"><a href="<?php echo SITEURL."forgotpassword.php";?>">Forgot Password?</a></p> -->
							</fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo SITEURL.INIT?>js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo SITEURL.INIT?>js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo SITEURL.INIT?>js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo SITEURL.INIT?>js/sb-admin-2.js"></script>

</body>

</html>