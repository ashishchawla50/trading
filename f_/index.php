<?php
session_start();
if(isset($_GET["fmail"]) && isset($_GET["ex"]))
{
	$_SESSION["fmail"]=$_GET["ex"];
}
include("init/script/constant.php");
include(INIT."script/db.php");
include(INIT."script/function.php");
//print_r($_SERVER);
if (isset($_POST["btnSubmit"]))
{	
	
	$cnt = getFieldDetail(ADMINDETAIL,"count(*)"," WHERE EMAIL='".$_SESSION["fmail"]."'");
	
	if($cnt == 1)
	{
		$FieldArr = array();
		$FieldArr[0] = "PASSWORD";
		$FieldValueArr= array();
		$FieldValueArr[0] = "'".md5($_POST["NEWPASSWORD"])."'";
	
		editData($FieldArr,$FieldValueArr,ADMINDETAIL," WHERE EMAIL='".$_SESSION["fmail"]."'");
	
		$success = "Password Changed Successfully.";
	}
	else
	{
		$error ="There is something wrong with Email Id.";
	}
	
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

    <title><?php echo getFieldDetail(SITESETTINGS,"SITETITLE"," WHERE SITEID='1'");?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo SITEURL.INIT?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo SITEURL.INIT?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo SITEURL.INIT?>dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo SITEURL.INIT?>css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo SITEURL.INIT?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
					<?php
					echo isset($success) ? '<p>'.$success.'</p>
											<p>Go To <a href="'.SITEURL.'">Login</a></p>' :'';
					?>
                        <form role="form" action="<?php echo SITEURL."f_/"?>" method="post" id="frmpass" <?php echo isset($success) ? 'style="display:none;"' :''; ?>>
                           <?php
							echo isset($error) ? "<p>".$error."</p>" :'';
							?>
						   <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="NEWPASSWORD" id="NEWPASSWORD" type="password" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="CONFIRMPASSWORD" id="CONFIRMPASSWORD" type="password">
                                </div>
					
							   <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block" name="btnSubmit">Submit</button>
								
							</fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo SITEURL.INIT?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo SITEURL.INIT?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo SITEURL.INIT?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo SITEURL.INIT?>dist/js/sb-admin-2.js"></script>
	<script src="<?php echo SITEURL.INIT;?>js/jquery.validation.js"></script>
		<script>
	$("#frmpass").validate({
		rules: {
			NEWPASSWORD:"required",
			CONFIRMPASSWORD: {
			  equalTo: "#NEWPASSWORD"
			}
			
        },
        messages:{
			
			NEWPASSWORD:"Password required",
			CONFIRMPASSWORD: {
			  equalTo: "Password and Confirm Password must be same"
			}
		},
              
        submitHandler: function(form) {
            form.submit();
        }
    });
	</script>
</body>

</html>