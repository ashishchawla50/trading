<?php

//print_r($_SERVER);
//echo $_SERVER["QUERY_STRING"];
session_start();
include("init/script/constant.php");
//require 'mail/PHPMailerAutoload.php';

if(isset($_SESSION["rstar"]))
{
	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy();
}


if((isset($_SESSION["adminuser"]) && isset($_SESSION["adminpassword"])) || (isset($_SESSION["user"]) && isset($_SESSION["userpassword"])))
{
	
	include(INIT."script/db.php");
	include(INIT."script/function.php");
	

	$action="";
	$temparr = array_keys($_GET);
	
	if (count($temparr) > 0)
	{
		$filename = $temparr[0];
		$action = isset($temparr[1]) ? $temparr[1]:'';
		if($action == '_nid' || $action == '_vid' || $action == '_vidpurchase' || $action == '_vidsale')
		{
			$back_button ='<p>
						<a  class="btn btn-warning" href="'.SITEURL."?".$filename.'" style="float:right;" ><i class="fa fa-backward"></i> Back</a>
						<br>
					</p>';
		}
		else
		{
			$back_button ='<p>
						<a  class="btn btn-warning" href="'.SITEURL.'?'.$filename.'&_vid" style="float:right;" ><i class="fa fa-backward"></i> Back</a>
						<br>
					</p>';
		}
		
		if($filename=='user' && isset($_SESSION["user"]))
		{
			$filename="dashboard";
		}
		else
		{
			//include($filename.".php");
			
		}
	}
	else{
		$filename="dashboard";
	}
	include("header.php");
	include($filename.".php");
	include("footer.php");
}

else
{
	
	include("login.php");

}

mysqli_close($con);
?>