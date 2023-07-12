<?php 

	/**
	*	Constants defined for paypal only
	*
	*	@author		Safikul Islam
	*	@date		Mar 15, 2019
	*	@version	1.0 
	*	@copyright	Analyze System 
	*	@url		http://www.leelija.com
	*	@email		safikulislamwb@gmail.com
	*  
	*/ 
	define('PAYPAL_BUSINESS',				"newsforshopping@gmail.com");		//
	define('PAYPAL_SITE_URL',       		URL); // URL constant is defined in constant.inc.php in includes folder 			 	 
	define('PAYPAL_IMAGE_URL',     			"");
	define('PAYPAL_SUCCESS_URL',    		PAYPAL_SITE_URL."/payments/paypal-payment-response.php");
	define('PAYPAL_CANCEL_URL',     		PAYPAL_SITE_URL."/payments/error-pay.php");
	define('PAYPAL_NOTIFY_URL',     		PAYPAL_SITE_URL."payipn.php");

	// define('PAYPAL_SITE_URL',       		"http://" . $_SERVER['HTTP_HOST']);			 	 
	// define('PAYPAL_IMAGE_URL',     			"");
	// define('PAYPAL_SUCCESS_URL',    		"http://" . $_SERVER['HTTP_HOST']."/payments/paypal-payment-response.php");
	// define('PAYPAL_CANCEL_URL',     		"http://" . $_SERVER['HTTP_HOST']."/payments/error-pay.php");
	// define('PAYPAL_NOTIFY_URL',     		"payipn.php");
	define('PAYPAL_RETURN_METHOD',  		"2"); //1=GET 2=POST  --> Use post since we will need the return values to check if order is valid
	define('PAYPAL_CURRENCY_CODE',  		"USD"); //['USD,GBP,JPY,CAD,EUR
	define('PAYPAL_LC',             		"GB");
	
	
	//Payment Page Settings
	define('PAYPAL_DISPLAY_COMMENT',           "0"); //0yes 1no
	define('PAYPAL_COMMENT_HEADER',            "Comments");
	define('PAYPAL_CONTINUE_BUTTON_TEXT',      "Continue >>");
	define('PAYPAL_BACKGROUND_COLOR',          ""); //""=white 1=black
	define('PAYPAL_DISPLAY_SHIPPING_ADDRESS',  "1"); //""=yes 1=no --> We already asked for the shipping address so tell paypal not to ask it again

?>