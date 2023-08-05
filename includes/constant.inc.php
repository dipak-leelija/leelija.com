<?php 
	
	date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)


	function is_localhost() {
		// set the array for testing the local environment
		$whitelist = array( '127.0.0.1', '::1' );
		
		// check if the server is in the array
		if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist ) ) {
			
			// this is a local environment
			return true;
		}
	}

	if (is_localhost())
		define('LOCAL_DIR',			'/leelija.com');
	else
		define('LOCAL_DIR',			'');

	//URLS Details 
	$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';


	// database credentials 
	if (LOCAL_DIR == "") {
		define('DBHOST',				'localhost');
		define('DBUSER',				'');
		define('DBPASS',				'');
		define('DBNAME',				'');
	}else {
		define('DBHOST',				'localhost');
		define('DBUSER',				'root');
		define('DBPASS',				'');
		define('DBNAME',				'leelija_db');
	}


	define('URL', 				$protocol.$_SERVER['HTTP_HOST'].LOCAL_DIR.'/');
	define('ROOT_DIR', 			$_SERVER['DOCUMENT_ROOT'].LOCAL_DIR.'/');
	define('ADM_DIR', 			$_SERVER['DOCUMENT_ROOT'].LOCAL_DIR.'/admin/');
	define('SELLER_PATH', 		$_SERVER['DOCUMENT_ROOT'].LOCAL_DIR.'/seller/');
	define('USER_PATH', 		$_SERVER['DOCUMENT_ROOT'].LOCAL_DIR.'/user/');
	define('CONT_DIR', 			$_SERVER['DOCUMENT_ROOT'].LOCAL_DIR.'/uploads/contents/');




	define('PAGE',				$_SERVER['PHP_SELF']);
	define('ADM_URL',  			URL.'/admin/');
	define('SELLER_URL',  		URL.'/seller/');
	define('USER_URL',  		URL.'/user/');
	define('SELLER_AREA',  		URL."seller/dashboard.php");
	define('USER_AREA',  		URL."user/app.client.php");
	define('IMG_PATH',  		URL."/images");


	

	define('CLIENT_AREA',  		URL."/dashboard.php");
	
	define('SITE_EMAIL', 		"contact@leelija");		//blackbox@ansysoft.com anarul.elance@gmail.com//ranjan.basak@ansysoft.com //contact@continuecontent.com
	
	define('CURRENCY',			'$');
	define('START_YEAR',		'2019');
	define('END_YEAR',  		date('Y') + 2); 
	define('HOME',				'Home');
	
	// define('SITE_BILLING_EMAIL', "invoice@leelija");	//anarul.elance@gmail.com //invoice@continuecontent.com
	define('SITE_BILLING_EMAIL', "rahulmajumdar400@gmail.com");
	define('SITE_HELP_LINE_NO',  "+91 874224523");
	
	define('SITE_BILLING_NAME',  "Leelija Web Solutions");
		
	//company
	define('COMPANY_FULL_NAME', 'Leelija Web Solutions');						//company full name
	define('COMPANY_S', 		'LeeLija');										//company short name
	define('COMPANY_L', 		'LL');											//company short name
	define('COMPANY_H', 		"Website ".HOME);								//company home
	define('COMPANY_A', 		"Admin ".HOME);									//admin home
	define('BLOG_ADMIN', 		"Blog Admin");									//admin home
	
	//define company logo
	define("LOGO_WITH_PATH",	URL."/images/logo/logo.png");					//location of the logo
	define("LOGO_WIDTH",		'170');											//width of the logo
	define("LOGO_HEIGHT",		'50');											//height of the logo 
	define("FAVCON_PATH",		URL."/images/logo/favicon.png");				//location of the favcon
	define("LOGO_ALT",			'LeeLija');										//alternate text for the logo
	
	//define company logo
	define("LOGO_ADMIN_PATH",	'images/admin/icon/admin-logo.png');			//location of the logo
	define("LOGO_ADMIN_WIDTH",	'200');											//width of the logo
	define("LOGO_ADMIN_HEIGHT",	'55');											//height of the logo 
	
	
	//session constant
	define('ADM_SESS',   		"continuecontent_SESSION_2016ADM_SESS"); 		//admin session var	
	define('USR_SESS',   		"USERcontinuecontent_ecom_SESS2016"); 			//user session var	
	define('STAFF_SESS',   		"SESS_continuecontentMar2016");					//user session var
	
	
	//display style constant
	define('NRSPAN',  			"<span class='blackLarge'>");					//normal span
	define('ERSPAN',  			"<span class='orangeLetter'>");					//error span start
	define('SUSPAN',  			"<span class='greenLetter'>");					//success span start
	define('ENDSPAN', 			"</span>");										//end of span
	define('ER', 				'Error: ');
	define('SU', 				'Success !!! ');

	// SUORDERL101 -- Need to define
	
	// Social Media Handles
	define("FB_LINK", 			"https://www.facebook.com/leelijaweb/");
	define("TWITTER_LINK", 		"https://twitter.com/lee_lija");
	define("PINTEREST_LINK", 	"https://in.pinterest.com/leelijaa/");
	define("LINKDIN_LINK", 		"https://www.linkedin.com/in/leelija/");

?>