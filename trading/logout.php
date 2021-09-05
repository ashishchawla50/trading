<?php	

$filepath = backupTables();
/*$mail = new PHPMailer();
				$mail->SMTPAuth   	= false; 
				$mail->Username 	= "softeriainfotech@gmail.com";                 	   // SMTP username
				$mail->Password 	= "8511613355@RAVI";                // SMTP password
				
				$mail->SMTPSecure = 'none';
				$mail->Host = 'localhost' ;
				$mail->Port = 25; 	
				$mail->setFrom("softeriainfotech@gmail.com", "Softeria Infotech");
				$mail->addReplyTo("softeriainfotech@gmail.com", "Softeria Infotech");
				$mail->addAddress("isha.parekh23@gmail.com", "Isha Parekh");
				$mail->addAddress("helygandhi15@gmail.com", "Hely Gandhi");
				$mail->isHTML(true);
				$mail->Subject = $rescompanydata["COMPANYNAME"].' : Back Up';
				$mail->Body    = "Data Base Backup : ".date('Y-m-d H:i:s');
				$mail->addAttachment($filepath);
	if(!$mail->send()) {
				   echo 'Mailer Error: ' . $mail->ErrorInfo;
				   echo 'Email Has not Sent';
				   exit;
				}
				 else{
				  //echo "email sent";
				}*/

	$arr[0]="LOGOUTTIME";
	$valuearr[0]="'".date('Y-m-d h:i:s')."'";
	if(isset($_SESSION["adminuser"]))
	{
	editData($arr,$valuearr,ADMINLOGINDETAIL," WHERE LOGINTIME='".$_SESSION["logintime"]."' AND ADMINLOGINID='".$loginuser_name."'");					
	}elseif(isset($_SESSION["user"]))
	{
	editData($arr,$valuearr,USERLOGINDETAIL," WHERE LOGINTIME='".$_SESSION["logintime"]."' AND USERNAME='".$_SESSION["user"]."'");					
	}
	// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>
<script>
	window.location.href='<?php echo SITEURL."";?>';
</script>
<?php
exit();
?>