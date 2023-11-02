<?php
require_once "constant.inc.php";
require_once ROOT_DIR . "/_config/dbconnect.php";
require_once ROOT_DIR . "/classes/orderStatus.class.php";

$OrderStatus    = new OrderStatus();

$allStatus = $OrderStatus->allStatus();

foreach ($allStatus as $value) {
    
    $statusname =  $value['orders_status_name'];

    if ($statusname == 'Failed') {
        define('FAILED',                    $statusname );
        define('FAILEDCODE',                $value['orders_status_id']);
    }

    if ($statusname == 'Delivered') {
        define('DELIVERED',                 $statusname);
        define('DELIVEREDCODE',             $value['orders_status_id']);
    }

    if ($statusname == 'Pending') {
        define('PENDING',                   $statusname);
        define('PENDINGCODE',               $value['orders_status_id']);
    }

    if ($statusname == 'Processing') {
        define('PROCESSING',                $statusname);
        define('PROCESSINGCODE',            $value['orders_status_id']);
    }

    if ($statusname == 'Ordered') {
        define('ORDERED',                   $statusname);
        define('ORDEREDCODE',               $value['orders_status_id']);

    }

    if ($statusname == 'Completed') {
        define('COMPLETED',                 $statusname);
        define('COMPLETEDCODE',             $value['orders_status_id']);
    }

    if ($statusname == 'Hold') {
        define('HOLD',                      $statusname);
        define('HOLDCODE',                  $value['orders_status_id']);
    }

    if ($statusname == 'Incomplete') {
        define('INCOMPLETE',               $statusname);
        define('INCOMPLETECODE',           $value['orders_status_id']);
    }

    if ($statusname == 'Rejected') {
        define('REJECTED',                  $statusname);
        define('REJECTEDCODE',              $value['orders_status_id']);
    }

}

const SELF_INTEGRATION                     = '1';
const LEELIJA_INTEGRATION                  = '2';

const ACTIVECODE                           = '1';
const ACTIVE                               = 'Active';
const DEACTIVATEDCODE                      = '0';
const DEACTIVATED                          = 'Deactivated';



define("CONTENT_ORDER",                      'Guest Post Order');
define("PACKAGE_ORDER",                      'Package Order');

define("CONTENTPRICE",                      10);
define("PAYLATER",                          'PayLater');


define("SUMMARYDOMAIN",                     'SUMMARYDOMAIN');
define("ORDERDOMAIN",                       'ORDERDOMAIN');

define("SUMMARYSITECOST",                   'SUMMARYSITECOST');
define("ORDERSITECOST",                     'ORDERSITECOST');
define("ORDERID",                           'ORDERID');


	define('ORD_UPDATE', 		'Order Update');
	define('PRFL_UPDATE', 		'Profile Update');
	define('OFFER', 			'Offer Update');
	define('OTHERS', 			'Others Update');


	//Constant for Advertiser
	define('ERSTCON001', ' No static has created so far');
	define('ERSTCON002', ' Static content title can not be empty');
	define('ERSTCON003', ' Invalid number of sub section or sub description selected or you have not selected any option from the drop down selection box');
	define('ERSTCON004', ' No category for this content is selected.');
	define('ERSTCON005', ' Title can not be empty');
	define('ERSTCON006', ' File can not be empty');
	
	
	
	
	define('SUSTCON001', ' Static content has been added successfully');
	define('SUSTCON002', ' Static content has been edited');
	define('SUSTCON003', ' Static content has been deleted');
	define('SUSTCON004', ' Additional section(s) is(are) added successfuly');
	
	define('SUSTCON101', ' File has been added successfully');
	


	// Order Messages
	define('ORDS001', 					'Order Placed');
	define('ORD_SUC', 					'Article Published Successfully');
	define('ORD_ACPT', 					'Order Accepted');
	define('ORD_DEL', 					'Order has been delivered!');
	define('ORD_COMP', 					'Order has been completed!');
	define('ORD_CNG_REQ', 				'Requested for changes!');
	define('CONT_UPDT', 				'Content file is successfully updated!');

	define('LVURL_UPDT', 				'Live URL is Updated!');


	define('ERR_LINK', 					'Something is error with the provided link');
	define('ERR', 						'Something is error');

	define('PACK_ORD',					'package');
	define('ORDPY001', 					'Payment Completed!');
	define('ORDPY006', 					'Payment Failed!');


define("ORD_PLCD_M",                          "Thank you for placing your order! We have successfully received it and will begin processing it promptly. Stay tuned!");

define("ORD_ACPT_M",                          "Congratulations! Your order has been accepted and is now being processed. Thank you  for choosing our services!");

define("ORD_RCJTD_M",                          "We regret to inform you that your order has been rejected. We apologize for any inconvenience caused and appreciate your understanding.");


define("ORD_DLVRD_M",                          "Your order has been delivered successfully. We hope you enjoy your purchase. Thank you for choosing our services!");

define('ORD_CNG_REQ_M', 				        "A change has been requested for your order. Our team will reach out to you shortly to discuss the details.");


define("ORD_CMPLT_M",                           "Your order has been successfully completed. We hope you are satisfied with your purchase. Thank you for choosing our services!");

define("ORD_PY_SUCESS",                           "Great news! Your payment has been successfully processed. Thank you for your purchase and trust in our services.");

define("ORD_PY_FAILED",                           "Apologies, the payment attempt has failed. Please try again later.");


?>