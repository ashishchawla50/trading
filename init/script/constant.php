<?php
############################################
//Define Constant
############################################

/** The name of the database for Website */
define('DB_NAME', 'Softeria_new');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'sait@2015');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('SITEURL', 'http://localhost:8080/trading/');

//Table Constant

define('ADMINDETAIL','admindetail');
define('ADMINLOGINDETAIL','adminlogindetail');
define('COMPANY','company');
define('LOCATION_MST','locationmaster');
define('LAB_MST','labmaster');
define('SHAPE_MST','shapemaster');
define('COLOR_MST','colormaster');
define('CLARITY_MST','claritymaster');
define('CUT_MST','cutmaster');
define('POLISH_MST','polishmaster');
define('SYMM_MST','symmmaster');
define('FLOUR_MST','flourmaster');
define('SIZE_MST','sizemaster');
define('GREEN_MST','greenmaster');
define('MILKY_MST','milkymaster');
define('NETPL_MST','netprofitloss');

define('LEDGER','ledger');
define('ACGROUP','accountgroup');
define('LEDGER_DEBIT','ledgertransaction_dr');
define('LEDGER_CREDIT','ledgertransaction_cr');

define('PURCHASESALE','_purchasesale');
define('SALE','_sale');
define('BARCODE_PROCESS','barcodeprocessdetail');
define('XLSFORMATFIELD','xlsformatfields');
define('USER','userdetail');
define('USERLOGINDETAIL','userlogindetail');

define('DIAMONDPRICE','diamondprice');
define('MENULIST','menulist');
define('EMPLOYEERIGHTS','employeerights');
define('CASHREGISTER','cashregisterdetail');

define('EXPORTDIAMOND','exportdiamond');
define('REPORTLIST','reportlist');
//Floder Constant

define('TABLES',"*");
define("OUTPUT_DIR", 'upload/db_backup');
define('UPLOAD',"upload/");
define('INIT',"init/");
define('SOFTERIAINFOTECH',"softeriainfotech/");
define('FILEROOT',"../");

$AllArr[0]="*";

define('PURAC',"1105");
define('PURGBP',"20");
define('SALAC',"1106");
define('SALGBP',"22");
define('BROKAC',"1109");
define('BROKGBP',"12");
define('COMMGBP',"12");
define('THIRDPARTYCHARGESAC',"3197");
define('THIRDPARTYCHARGESGB',"12");
define('THIRDPARTYTCSAC',"3517");
define('THIRDPARTYTCSGB',"12");

define('IGSTIN',"1111");
define('CGSTIN',"1112");
define('SGSTIN',"1113");
define('IGSTOUT',"1114");
define('CGSTOUT',"1115");
define('SGSTOUT',"1116");
define('GSTGB',"11");
define('COMM',"1760");

define('TCSIN',"3515");
define('TCSOUT',"3516");


?>