<?PHP

	error_reporting(E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
	include_once("libmail.php") ;

	function replaceHTMLtag($string)
	{
		//$replaced = strip_tags($string,"<br>") ;
		
		$replaced = str_replace("<br />","!br!",$string) ;
		$replaced = str_replace("<br/>","!br!",$replaced) ;
		$replaced = str_replace("<br>","!br!",$replaced) ;
		$replaced = str_replace("<BR>","!br!",$replaced) ;
		$replaced = str_replace("<BR/>","!br!",$replaced) ;
		$replaced = str_replace("<BR />","!br!",$replaced) ;
		$replaced = ereg_replace("<[^>]*>","",$replaced); 
		$replaced = str_replace("!br!","<br />",$replaced) ;
		
		return $replaced ;
	}	

	function checkVal($objval)
	{
		if (!empty($objval))
			return replaceHTMLtag(stripslashes($objval)) ;
		else
			return "-";
	}	

	#----------------------------------------------------------------------------------------------------


	define("EMAIL_TABLE_CSS", 'background:url(assets/img/pattern.jpg)' ) ;
	define("EMAIL_LOGO_COLUMN_CSS", 'border-bottom:3px solid #54C7E3; Padding:1px;' ) ;
	define("EMAIL_CONTENT_COLUMN_CSS", 'font-family:Arial, Helvetica, sans-serif;font-size:12px;' ) ;
	define("CONTENT_COLUMN_CSS", 'background-color:#CCCCCC;' ) ;
	define("EMAIL_FOOTER_COLUMN_CSS", 'color:#000; font-family:Arial, Helvetica, sans-serif;font-size:12px;padding:10px;' ) ;
	define("EMAIL_CONTENT_CSS", 'color:#000; font-family:Arial, Helvetica, sans-serif;font-size:12px;padding:3px;' ) ;
	//define("EMAIL_CONTENT_URL_CSS", 'text-decoration:underline; color:#043e89;' ) ;


	#----------------------------------------------------------------------------------------------------

	function getMailMessage($MessageText)
	{
		
		
		
		/*$header_image = get_header_image();
        if (  !empty( $header_image ) ) 
             $LogoImg = '<a href="'.esc_url( home_url( '/' ) ).'" target="_blank"><img src="'.esc_url( $header_image ).'" alt=""  border="0" style="margin-top:40px;"/></a>';
        else
             $LogoImg = '<h1 class="TextColor2" style="margin-top:40px;"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></h1>';*/
   
 
		
		$MailMessageText = '
		<table width="600" border="1" cellspacing="0" cellpadding="0"  style="'.EMAIL_TABLE_CSS.'" >
			  <tr>
				<td  style="'.EMAIL_LOGO_COLUMN_CSS.'" align="left"><a href="#" target="_blank"><img src="'.SITEURL.INIT.'images/logo.png" alt=""  border="0" width="266" height="100"/></a></td>
			  </tr>
			 
			 
			  <tr>
				<td style="'.EMAIL_CONTENT_COLUMN_CSS.'" height="200" valign="top" >
				'.$MessageText.'
			</td>
			  </tr>
<tr>
				<td style="'.EMAIL_FOOTER_COLUMN_CSS.'"><p>For More Detail PLlease Visit www.ronikaboutique.com</p></td>
			  </tr>
			<tr>
				<td style="'.EMAIL_FOOTER_COLUMN_CSS.'"><p>Copyright &copy; '.date('Y').'Ronika Boutique. All rights reserved.</p></td>
			  </tr>
			</table>';
		
		return $MailMessageText;
	
	}
	
	#----------------------------------------------------------------------------------------------------



?>