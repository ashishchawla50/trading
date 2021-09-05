<?php
$view_bol = true;
$add_bol = true;
$edit_bol = true;
$del_bol = true;
$comp_fromdt = "2017-01-01";
$RPT_LST='';
if(isset($_SESSION["adminuser"]))
	{
		$loginuser_name = $_SESSION["adminuser"];
		$user_name = $_SESSION["adminuser"];
	}
	elseif(isset($_SESSION["user"]))
	{
		$loginuser_name = $_SESSION["user"];
		$user_name = getFieldDetail(USER,"CONCAT(FIRSTNAME,' ',LASTNAME)"," WHERE USERNAME='".$_SESSION["user"]."'");
		$RPT_LST = getFieldDetail(USER,"REPORTLIST"," WHERE USERNAME='".$_SESSION["user"]."'");
		$RPT_LST = $RPT_LST == '' ? '' : ' AND REPORTNAME IN ('.$RPT_LST.')';
		
		$filenamearr = explode("-",$filename);
		$condfilename = $filename;
		if(count($filenamearr) >= 2)
		{
			$condfilename = $filenamearr[0] ."-" . $filenamearr[1];
		}
			$user_loginid = getFieldDetail(USER,"USERLOGINID"," WHERE USERNAME='".$_SESSION["user"]."'");
			$view_bol = getFieldDetail(EMPLOYEERIGHTS,"VIEWSTATUS"," WHERE MENUNAME='".$condfilename."' AND EMPLOYEEID in ('".$user_loginid."')");
			$add_bol = getFieldDetail(EMPLOYEERIGHTS,"ADDSTATUS"," WHERE MENUNAME='".$condfilename."' AND EMPLOYEEID in ('".$user_loginid."')");
			$edit_bol = getFieldDetail(EMPLOYEERIGHTS,"EDITSTATUS"," WHERE MENUNAME='".$condfilename."' AND EMPLOYEEID in ('".$user_loginid."')");
			$del_bol = getFieldDetail(EMPLOYEERIGHTS,"DELETESTATUS"," WHERE MENUNAME='".$condfilename."' AND EMPLOYEEID in ('".$user_loginid."')");
			
	}

$getcompany=getData(COMPANY,$AllArr," WHERE COMPANYID='1'");
$rescompanydata=mysqli_fetch_assoc($getcompany);


if($filename=='report')
{
	$PostArrayReport = array(); 
	if(isset($_POST["resetreport"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["report"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpost', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayReport = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpost"]))
	{
		$cookie = $_COOKIE['filterpost'];
		$cookie = stripslashes($cookie);
		$PostArrayReport = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpost", "", time() - 3600);
}

if($filename == 'tran-cashpayment-v')
{
	$PostArrayCashPay = array(); 
	if(isset($_POST["resetcashpayment"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["transcashpayment"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpostcashpay', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayCashPay = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpostcashpay"]))
	{
		$cookie = $_COOKIE['filterpostcashpay'];
		$cookie = stripslashes($cookie);
		$PostArrayCashPay = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpostcashpay", "", time() - 3600);
}

if($filename == 'tran-cashreceipt-v')
{
	$PostArrayCashReceipt = array(); 
	if(isset($_POST["resetcashreceipt"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["transcashreceipt"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpostcashreceipt', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayCashReceipt = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpostcashreceipt"]))
	{
		$cookie = $_COOKIE['filterpostcashreceipt'];
		$cookie = stripslashes($cookie);
		$PostArrayCashReceipt = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpostcashreceipt", "", time() - 3600);
}

if($filename == 'tran-bankpayment-v')
{
	$PostArrayBankPay = array(); 
	if(isset($_POST["resetbankpayment"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["transbankpayment"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpostbankpay', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayBankPay = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpostbankpay"]))
	{
		$cookie = $_COOKIE['filterpostbankpay'];
		$cookie = stripslashes($cookie);
		$PostArrayBankPay = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpostbankpay", "", time() - 3600);
}

if($filename == 'tran-bankreceipt-v')
{
	$PostArrayBankReceipt = array(); 
	if(isset($_POST["resetbankreceipt"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["transbankreceipt"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpostbankreceipt', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayBankReceipt = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpostbankreceipt"]))
	{
		$cookie = $_COOKIE['filterpostbankreceipt'];
		$cookie = stripslashes($cookie);
		$PostArrayBankReceipt = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpostbankreceipt", "", time() - 3600);
}

if($filename == 'tran-bankpayment-sale-v')
{
	$PostArrayBankPaySale = array(); 
	if(isset($_POST["resetbankpaymentsale"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["transbankpaymentsale"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpostbankpaysale', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayBankPaySale = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpostbankpaysale"]))
	{
		$cookie = $_COOKIE['filterpostbankpaysale'];
		$cookie = stripslashes($cookie);
		$PostArrayBankPaySale = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpostbankpaysale", "", time() - 3600);
}

if($filename == 'tran-journalpayment-v')
{
	$PostArrayJournalPay = array(); 
	if(isset($_POST["resetjournalpayment"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["transjournalpayment"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpostjournalpayment', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayJournalPay = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpostjournalpayment"]))
	{
		$cookie = $_COOKIE['filterpostjournalpayment'];
		$cookie = stripslashes($cookie);
		$PostArrayJournalPay = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpostjournalpayment", "", time() - 3600);
}
if($filename == 'tran-journalreceipt-v')
{
	$PostArrayJournalReceipt = array(); 
	if(isset($_POST["resetjournalreceipt"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["transjournalreceipt"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpostjournalreceipt', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayJournalReceipt = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpostjournalreceipt"]))
	{
		$cookie = $_COOKIE['filterpostjournalreceipt'];
		$cookie = stripslashes($cookie);
		$PostArrayJournalReceipt = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpostjournalreceipt", "", time() - 3600);
}
if($filename == 'netprofitloss')
{
	$PostArrayNetProLoss = array(); 
	if(isset($_POST["resetnetprofitloss"]))
	{
		unset($_POST);
		setcookie("user", "", time() - 3600);
	}
	elseif(isset($_POST["transnetprofitloss"]))
	{
		$json = json_encode($_POST);	
		setcookie('filterpostnetprofitloss', $json);
		$cookie = $json;
		$cookie = stripslashes($cookie);
		$PostArrayNetProLoss = json_decode($cookie, true);
	}
	elseif(isset($_COOKIE["filterpostnetprofitloss"]))
	{
		$cookie = $_COOKIE['filterpostnetprofitloss'];
		$cookie = stripslashes($cookie);
		$PostArrayNetProLoss = json_decode($cookie, true);
	}
	else
	{
	}
}
else
{
	setcookie("filterpostnetprofitloss", "", time() - 3600);
}


$BarAllArr = array();
	$BarAll_NumFieldArr = array();
	
	$AcgArr = array();
	
	$BarFieldArr = array();
	$Bar_NumFieldArr = array();
	$BarcodeArr = array();
	
	$LabArr = array();
	$res_lab = getData(LAB_MST,$AllArr," WHERE FLAG='0' ORDER BY LABNAME");
	while($res_lab_data = mysqli_fetch_assoc($res_lab))
	{
		array_push($LabArr,'"'.$res_lab_data["LABNAME"].'"');
	}
	$ShapeArr = array();
	$res_shape = getData(SHAPE_MST,$AllArr," WHERE FLAG='0' ORDER BY SHAPENAME");
	while($res_shape_data = mysqli_fetch_assoc($res_shape))
	{
		array_push($ShapeArr,'"'.$res_shape_data["SHAPENAME"].'"');
	}
	$ColorArr = array();
	$res_color = getData(COLOR_MST,$AllArr," WHERE FLAG='0' ORDER BY COLORNAME");
	while($res_color_data = mysqli_fetch_assoc($res_color))
	{
		array_push($ColorArr,'"'.$res_color_data["COLORNAME"].'"');
	}
	$ClarityArr = array();
	$res_clarity = getData(CLARITY_MST,$AllArr," WHERE FLAG='0' ORDER BY CLARITYNAME");
	while($res_clarity_data = mysqli_fetch_assoc($res_clarity))
	{
		array_push($ClarityArr,'"'.$res_clarity_data["CLARITYNAME"].'"');
	}
	$CutArr = array();
	$res_cut = getData(CUT_MST,$AllArr," WHERE FLAG='0' ORDER BY CUTNAME");
	while($res_cut_data = mysqli_fetch_assoc($res_cut))
	{
		array_push($CutArr,'"'.$res_cut_data["CUTNAME"].'"');
	}
	$PolishArr = array();
	$res_polish = getData(POLISH_MST,$AllArr," WHERE FLAG='0' ORDER BY POLISHNAME");
	while($res_pol_data = mysqli_fetch_assoc($res_polish))
	{
		array_push($PolishArr,'"'.$res_pol_data["POLISHNAME"].'"');
	}
	$SymmArr = array();
	$res_symm = getData(SYMM_MST,$AllArr," WHERE FLAG='0' ORDER BY SYMMNAME");
	while($res_symm_data = mysqli_fetch_assoc($res_symm))
	{
		array_push($SymmArr,'"'.$res_symm_data["SYMMNAME"].'"');
	}
	$FlourArr = array();
	$res_flour = getData(FLOUR_MST,$AllArr," WHERE FLAG='0' ORDER BY FLOURNAME");
	while($res_flour_data = mysqli_fetch_assoc($res_flour))
	{
		array_push($FlourArr,'"'.$res_flour_data["FLOURNAME"].'"');
	}
	
	$GreenArr = array();
	$res_green = getData(GREEN_MST,$AllArr," WHERE FLAG='0' ORDER BY GREENNAME");
	while($res_green_data = mysqli_fetch_assoc($res_green))
	{
		array_push($GreenArr,'"'.$res_green_data["GREENNAME"].'"');
	}
	
	$MilkyArr = array();
	$res_milky = getData(MILKY_MST,$AllArr," WHERE FLAG='0' ORDER BY MILKYNAME");
	while($res_milky_data = mysqli_fetch_assoc($res_milky))
	{
		array_push($MilkyArr,'"'.$res_milky_data["MILKYNAME"].'"');
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

   <title><?php echo $rescompanydata["COMPANYNAME"];?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo SITEURL.INIT;?>css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo SITEURL.INIT;?>css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo SITEURL.INIT;?>css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo SITEURL.INIT;?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo SITEURL.INIT;?>css/morris.css" rel="stylesheet">

	<!-- DataTables CSS -->
    <link href="<?php echo SITEURL.INIT;?>css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo SITEURL.INIT;?>css/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom Fonts -->
	
	<style>
	@font-face{font-family:'FontAwesome';src:url('fontawesome-webfont.eot?v=4.2.0');src:url('fontawesome-webfont.eot?#iefix&v=4.2.0') format('embedded-opentype'),url('fontawesome-webfont.woff?v=4.2.0') format('woff'),url('fontawesome-webfont.ttf?v=4.2.0') format('truetype'),url('fontawesome-webfont.svg?v=4.2.0#fontawesomeregular') format('svg');font-weight:normal;font-style:normal}
</style>

    <link href="<?php echo SITEURL.INIT;?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
	 <link href="<?php echo SITEURL.INIT;?>css/jquery-ui.css" rel="stylesheet" type="text/css">
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="<?php echo SITEURL.INIT;?>images/favicon.ico">
	<style>	
	.usdcol,.rmbcol
	{
		display:none;
	}
	
.gbpcolor
{
	color:red;
}
/* Pagination links */
.pagination
{
	margin: 0px 0;
}
	.pagination a {
		color: black;
		float: left;
		padding: 8px 16px;
		text-decoration: none;
		transition: background-color .3s;
	}

	/* Style the active/current link */
	.pagination a.active {
		background-color: dodgerblue;
		color: white;
	}

/* Add a grey background color on mouse-over */
.pagination a:hover:not(.active) {background-color: #ddd;}

	h1,h3, table>thead, label
	{
		text-transform: uppercase;
	}
	
	table.sale td ,table.pur td{
		padding:0.7%;
	}
.custom_overlay_wrapper {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.6);
	z-index:1001;
	overflow-x: auto;
}
.custom_overlay_inner {
    background-color: #00BCD4;
    max-width: 1260px;
	
    margin: 0 auto;
       padding: 1px;
    margin-top: 5px;
    color: #fff;
}
.close_custom_overlay {
    display: inline-block;
    float: right;
    font-size: 40px;
    line-height: 29px;
    cursor: pointer;
    position: relative;
    top: -5px;
    right: 5px;
	color:red;
}
.single_entry .right_overlay_content {
    display: none;
}
.overlay_container {
    display: inline-block;
    width: 48%;
}
.single_entry .overlay_container 
{
	width:100%;
}
.custom_overlay_outer {
    padding: 15px;
}

</style>

	<style>
	
	.amountalign,.rightaling
	{
		text-align:right;
	}
	.inputfieldtable tr td
	{
		padding: 1px 1px;
		vertical-align:top;
	}
	.inputaddmorefieldtable tr td
	{
		padding: 1px 2px;
		vertical-align:top;
		border: solid 1px;
	}
	.inputaddmorefieldtable tr th
	{
		padding: 1px 5px;
		vertical-align:top;
		border: dotted 1px;
	}
	.inputaddmorefieldtable .form-control {
		display: block;
		/*width: 100%;*/
		height: 25px;
		padding: 3px 3px;
		font-size: 12px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
	

	#SEARCHBARCODE  {
		display: inline;
		width: 40%;
		height: 30px;
		padding: 3px 3px;
		font-size: 12px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
	
	 .form-control[readonly]{
    background-color: #eee;
    opacity: 1;
}

	label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}

.btn-circle {
    width: 20px;
    height: 20px;
    padding: 1px 0;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.428571429;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 1px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
.customResponsiveTable {
    width: 100%;
    display: inline-block;
    overflow-x: auto;
}
.reddue
{
	background-color:red !important ;
	color:#fff !important;
}


	</style>
</head>

<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand LoginLogo" href="<?php echo SITEURL.""?>"><?php echo getFieldDetail(COMPANY,"COMPANYNAME"," WHERE COMPANYID='1'");?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                      <li>
						 <div class="form-group">
								<label>Stock Id:</label>
								<input class="form-control" name="SEARCHBARCODE" id="SEARCHBARCODE">
                        </div>
						
					 </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $user_name; ?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
						<li><a href="<?php echo SITEURL; ?>?profile"><i class="fa fa-user fa-fw"></i> Profile</a>
                        </li>
						<?php
						  if(isset($_SESSION["adminuser"]))
						{
							?>
							<li class="divider"></li>
							<li><a href="<?php echo SITEURL; ?>?setting"><i class="fa fa-tasks fa-fw"></i> Setting</a>
							</li>
							<?php
							
							
							
						}
						?>
						<li class="divider"></li>
                        <li><a href="<?php echo SITEURL; ?>?changepassword"><i class="fa fa-user fa-fw"></i> Change Password</a>
                        </li>
						<!--<li class="divider"></li>
                        <li><a href="<?php echo SITEURL; ?>?rappriceupdate"><i class="fa fa-money fa-fw"></i> Rap Price Update</a>
                        </li>-->
                        <li class="divider"></li>
                        <li><a href="<?php echo SITEURL; ?>?logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="<?php echo SITEURL; ?>?dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard <small>(F2)</small></a>
                        </li>
						 <li rel="company" class="menucls">
                            <a href="<?php echo SITEURL; ?>?company"><i class="fa fa-gear fa-fw"></i> Company Info <small>(F3)</small></a>
                        </li>
						 <li style="display:;">
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Masters<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li rel="lab" class="menucls ">
                                    <a href="<?php echo SITEURL; ?>?lab&_vid">Lab</a>
                                </li>
								<li rel="shape" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?shape&_vid">Shape</a>
                                </li>
								<li rel="color" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?color&_vid">Color</a>
                                </li>
								<li rel="clarity" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?clarity&_vid">Clarity</a>
                                </li>
								<li rel="cut" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?cut&_vid">Cut</a>
                                </li>
								<li rel="polish" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?polish&_vid">Polish</a>
                                </li>
								<li rel="symmetry" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?symmetry&_vid">Symmetry</a>
                                </li>
								<li rel="flour" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?flour&_vid">Flouraosance</a>
                                </li>
							
								<li rel="location" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?location&_vid">Location</a>
                                </li>
								
							
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Accounts <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							<!--<li rel="mainaccountgroup" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?mainaccountgroup">Main Account Group</a>
                                </li>-->
								<li rel="accountgroup" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?accountgroup&_vid">Account Group</a>
                                </li>
								<li rel="party" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?party&_vid">Account <small>(F4)</small></a>
                                </li>
							
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						 <li rel="purchase" class="menucls">
                            <a href="<?php echo SITEURL; ?>?purchase"><i class="fa fa-shopping-cart fa-fw"></i> Purchase <small>(F6)</small></a>
                        </li>
						 <li rel="partnerpurchase" class="menucls">
                            <a href="<?php echo SITEURL; ?>?partnerpurchase&_vid"><i class="fa fa-shopping-cart fa-fw"></i> Partner Purchase</a>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-exchange fa-fw"></i> Memo <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li rel="memoissue" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?memoissue&_vid">Issue</a>
                                </li>
								<li rel="memoreceive" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?memoreceive&_vid">Receive</a>
                                </li>
																
								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
				
						<li>
                            <a href="#"><i class="fa fa-exchange fa-fw"></i> Repair <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li rel="repairissue" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?repairissue&_vid">Issue</a>
                                </li>
								<li rel="repairreceive" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?repairreceive&_vid">Receive</a>
                                </li>
																
								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa fa-exchange fa-fw"></i> Grading <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li rel="gradingissue" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?gradingissue&_vid">Issue</a>
                                </li>
								<li rel="gradingresult" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?gradingresult&_vid">Result</a>
                                </li>
								<li rel="gradingreceive" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?gradingreceive&_vid">Receive</a>
                                </li>
																
								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa fa-exchange fa-fw"></i> Recut <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li rel="recutissue" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?recutissue&_vid">Issue</a>
                                </li>
								<li rel="recutreceive" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?recutreceive&_vid">Receive</a>
                                </li>
																
								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
					
						
						 <li rel="sale" class="menucls">
                            <a href="<?php echo SITEURL; ?>?sale"><i class="fa  fa-shopping-cart fa-fw"></i> Sale <small>(F8)</small></a>
                        </li>
						 <li rel="saleinvoice" class="menucls">
                            <a href="<?php echo SITEURL; ?>?saleinvoice&_vid"><i class="fa  fa-shopping-cart fa-fw"></i> Sale Invoice</a>
                        </li>
						 <li rel="exportdiamond" class="menucls">
                            <a href="<?php echo SITEURL; ?>?exportdiamond&_vid"><i class="fa  fa-shopping-cart fa-fw"></i> Export Diamond</a>
                        </li>
						<li rel="filter" class="menucls">
                            <a href="<?php echo SITEURL; ?>?filter"><i class="fa fa-filter fa-fw"></i> Stock <small>(F9)</small></a>
                        </li>
						
							<!--	<li rel="sale-stock" class="menucls">
									<a href="<?php echo SITEURL; ?>?sale-stock"><i class="fa fa-filter fa-fw"></i> Sale Stock <small>(F10)</small></a>
								</li>-->
						
						
						<li>
                            <a href="#"><i class="fa fa-exchange fa-fw"></i> Vouchers <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li rel="cashpayment" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?cashpayment&_vid">Cash Payment</a>
                                </li>
								<li rel="tran-cashreceipt" class="menucls">	
                                    <a href="<?php echo SITEURL; ?>?cashreceipt&_vid">Cash Receipt</a>
                                </li>
								
								<li rel="tran-bankpayment" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?bankpayment&_vid">Bank Payment</a>
                                </li>
								<li rel="tran-bankreceipt" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?bankreceipt&_vid">Bank Receipt</a>
                                </li>
								
								<li rel="tran-bankpayment-sale" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?bankpayment-sale&_vid">Bank Payment (Sale)</a>
                                </li>
								<li rel="tran-journalpayment" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?journalpayment&_vid">Journal Payment</a>
                                </li>
								<li rel="tran-journalreceipt" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?journalreceipt&_vid">Journal Receipt</a>
                                </li>
								<li rel="tran-netprofitloss" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?netprofitloss&_vid">Net P & L</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						<!--<li>
                            <a href="#"><i class="fa fa-exchange fa-fw"></i> Register <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li rel="cashregister-surat" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?cashregister-surat">Surat <small>(Alt+S)</small></a>
                                </li>
								<li rel="cashregister-mumbai" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?cashregister-mumbai">Mumbai <small>(Alt+M)</small></a>
                                </li>
								<li rel="cashregister-hk" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?cashregister-hk">HK <small>(Alt+H)</small></a>
                                </li>
								
								
                            </ul>
                            <!-- /.nav-second-level -->
                        <!--</li>-->
						
					
						<li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Account Reports <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li rel="print-grouplist" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?grouplist">Group List</a>
                                </li>
								
								<li rel="print-ledger" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?ledger">Ledger Book</a>
                                </li>
								<li rel="print-daybook" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?daybook">Day Book</a>
                                </li>
								<li rel="print-daybook" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?datebook">Date Wise Book</a>
                                </li>
								<li rel="print-cash" class="menucls">
                                    <a href="<?php echo SITEURL; ?>cash">Cash Book</a>
                                </li>
								<li rel="print-bank" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?bankbook">Bank Book</a>
                                </li>
								<li rel="print-profitloss" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?profitloss">Profit & Loss</a>
                                </li>
								<li rel="print-profitlossschedual" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?profitlossschedual">Profit & Loss Schedual</a>
                                </li>
								<li rel="print-balancesheet" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?balancesheet">Balance Sheet</a>
                                </li>
								<li rel="print-balancesheetschedual" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?balancesheetschedual">Balance Sheet Schedual</a>
                                </li>
								<li rel="print-trialbalance" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?trialbalance">Trial Balance</a>
                                </li>
								<li rel="print-loanschedual" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?loanschedual">Loan Schedual</a>
                                </li>
								<li rel="print-purchasegst" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?purchasegst">Purchase GST</a>
                                </li>
								<li rel="print-salegst" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?salegst">Sale GST</a>
                                </li>
								<li rel="print-GSTSummary" class="menucls">
                                    <a href="<?php echo SITEURL; ?>?GSTSummary">GST Summary</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li class="delcls">
                            <a href="<?php echo SITEURL ?>?diamondreport"><i class="fa fa-user fa-fw"></i> Diamond Reports </a>
                            <!-- /.nav-second-level -->
                        </li>
						<li class="delcls">
                            <a href="<?php echo SITEURL ?>?user&_vid"><i class="fa fa-user fa-fw"></i> User</a>
                            <!-- /.nav-second-level -->
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
	</div>
	<div id="page-wrapper">
