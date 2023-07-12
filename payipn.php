<?php 
session_start();
require_once("_config/connect.php");

require_once("includes/constant.inc.php");
require_once("includes/user.inc.php");
require_once("includes/email.inc.php");
require_once("includes/registration.inc.php");
require_once("includes/company_contact.inc.php");
require_once("includes/order_landing.inc.php");
require_once("includes/paypal.inc.php");
require_once("classes/error.class.php"); 
require_once("classes/date.class.php"); 
require_once("classes/order.class.php");
require_once("classes/utility.class.php"); 
require_once("classes/utilityMesg.class.php"); 
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");
require_once("classes/utilityStr.class.php");

/* INSTANTIATING CLASSES */
$error			= new Error();
$dateUtil		= new DateUtil();


$ordObj			= new Order();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$header  	= "";


//'txtName','txtPhone','txtEmail', 'txtAddress','txtCity','txtState','txtPostalCode'
//'ordId', 'ordKey', 'ordAmt'

if(!isset($_SESSION['ordId']))
{
	header("Location: index.php");
}

//update the order status
//all the post vars
$txtName 		= $_SESSION['txtName'];
$txtEmail		= $_SESSION['txtEmail'];
$txtAddress		= $_SESSION['txtAddress'];

$txtCity		= $_SESSION['txtCity'];
$txtState		= $_SESSION['txtState'];
$txtPostalCode	= $_SESSION['txtPostalCode'];
$txtPhone		= $_SESSION['txtPhone'];

//get the country detail
//$countryDetail 	= $country->showCountry($cust_country);
//$countryName	= $countryDetail[0];

//get all radio button
$orders_amount	= $_SESSION['ordAmt'];
$ordCode		= $_SESSION['ordCode'];
$ordId			= $_SESSION['ordId'];


	//change the order status
	$ordObj->updateOrderStatus($_SESSION['ordId'], 3);  

	//initialise a variable with the requried cmd parameter
	$req = 'cmd=_notify-validate';
	
	// go through each of the POSTed vars and add them to the variable
	foreach ($_POST as $key => $value) 
	{
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
		
	}
	
	// post back to PayPal system to validate
	$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	// In a live application send it back to www.paypal.com
	$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
	
	if (!$fp) 
	{
		//update order status
		$ordObj->updateOrderStatus($ordId, 13); 
		
		//send email 
	}
	else
	{
	  fputs ($fp, $header . $req);
	  
	  while (!feof($fp)) 
	  {
		$res = fgets ($fp, 1024);
		
		
		$item_name 			= $_POST['item_name'];
		$item_number 		= $_POST['item_number'];
		$payment_status 	= $_POST['payment_status'];
		$payment_amount 	= $_POST['mc_gross'];         		//full amount of payment. payment_gross in US
		$payment_currency 	= $_POST['mc_currency'];
		$txn_id 			= $_POST['txn_id'];                 //unique transaction id
		$receiver_email 	= $_POST['receiver_email'];
		$payer_email 		= $_POST['payer_email'];
		
		//check if that transaction id exists
		$trxnIdRes	= $error->duplicateEntry($txn_id, 'trxn_id', 'orders', 'NO', '', '');

		/*echo $payment_status."<br /> ".
			 $receiver_email."<br /> ".
			 $txn_id."<br /> ".
			 $payment_currency."<br /> ".
			 $payment_amount."<br /> ".
			 $trxnIdRes."<br /> ".$res;
		exit;*/

		//check if payment_status Completed, receiver_email is same as your account email, the amount is same, currency same 
		//and the transaction id is new
		
		if (($payment_status == 'Completed') && ($receiver_email == PAYPAL_BUSINESS) &&   ($payment_amount == $orders_amount ) &&    
			($payment_currency == PAYPAL_CURRENCY_CODE) &&  ($trxnIdRes != 'ER020')  ) 
		{  

			//update the status
			$ordObj->updateOrderStatus($ordId, 6);
			
			//insert the transaction id
			$ordObj->updateOrderTrxnId($ordId, $txn_id); 
			
			//register success variable
			$_SESSION['pay_success']	= 'pay_success';
			$_SESSION['trxn_id']		= $txn_id;
			
			
			//forward to success page
			header("Location: pay-success.php");//
		}
		
		else if(($payment_status == 'Pending') && ($receiver_email == PAYPAL_BUSINESS) &&   ($payment_amount == $orders_amount ) &&    
			($payment_currency == PAYPAL_CURRENCY_CODE) &&  ($trxnIdRes != 'ER020')){
			
			//update the status
			$ordObj->updateOrderStatus($ordId, 2);
			
			//insert the transaction id
			$ordObj->updateOrderTrxnId($ordId, $txn_id); 
			
			//register success variable
			$_SESSION['pay_pending']	= 'pay_pending';
			$_SESSION['trxn_id']		= $txn_id;
			
			
			//forward to success page
			header("Location: pay-pending.php");//	
		}
		
		
		else
		{	
			//echo "Bad Request";exit;
			//update the status
			$ordObj->updateOrderStatus($ordId, 9);
			
			//insert the transaction id
			$ordObj->updateOrderTrxnId($ordId, $txn_id);
					
			//forward to error
			header("Location: error-pay.php");
			
			if (strcmp ($res, "VERIFIED") == 0) 
			{
				// assign posted variables to local variables
				// the actual variables POSTed will vary depending on your application.
				// there are a huge number of possible variables that can be used. See the paypal documentation.
				
				// the ones shown here are what is needed for a simple purchase
				// a "custom" variable is available for you to pass whatever you want in it. 
				// if you have many complex variables to pass it is possible to use session variables to pass them.
				
				$item_name = $_POST['item_name'];
				$item_number = $_POST['item_number'];
				//$item_colour = $_POST['custom'];  
				$payment_status = $_POST['payment_status'];
				$payment_amount = $_POST['mc_gross'];         //full amount of payment. payment_gross in US
				$payment_currency = $_POST['mc_currency'];
				$txn_id = $_POST['txn_id'];                   //unique transaction id
				$receiver_email = $_POST['receiver_email'];
				$payer_email = $_POST['payer_email'];
				
				// use the above params to look up what the price of "item_name" should be.
	
				$amount_they_should_have_paid = .01; // you need to create this code to find out what the price for the item they bought really is so that you can check it against what they have paid. This is an anti hacker check.
	
				// the next part is also very important from a security point of view
				// you must check at the least the following...
				//echo "Verified";
				
				if (($payment_status == 'Completed') &&   //payment_status = Completed
					 ($receiver_email == PAYPAL_BUSINESS) &&   // receiver_email is same as your account email
					 ($payment_amount == $orders_amount ) &&  //check they payed what they should have
					 ($payment_currency == PAYPAL_CURRENCY_CODE)  )  // and its the correct currency &&(!txn_id_used_before($txn_id))
					 //txn_id isn't same as previous to stop duplicate payments. You will need to write a function to do this check.
				{  
	
					//update the status
					$ordObj->updateOrderStatus($ordId, 6);
					
					//insert the transaction id
					$ordObj->updateOrderTrxnId($ordId, $txn_id); 
					
					// everything is ok
					// you will probably want to do some processing here such as logging the purchase in a database etc
					
					
					// you can also during development or debugging send yourself an email to say it worked.
					// email is a good choice because you can't display messages on the screen as this processing is happening totally independently of
					// the main web page processing.
					
					//        uncomment this section during development to receive an email to indicate whats happened
					//            $mail_To = "payit@designertuts.com";
					//            $mail_Subject = "completed status received from paypal";
					//            $mail_Body = "completed: $item_number  $txn_id";
					//            mail($mail_To, $mail_Subject, $mail_Body);
	
					//echo "Completed";
				  }
				  else
				  {
					//
					// paypal replied with something other than completed or one of the security checks failed.
					// you might want to do some extra processing here
					//
					//in this application we only accept a status of "Completed" and treat all others as failure. You may want to handle the other possibilities differently
					//payment_status can be one of the following
					//Canceled_Reversal: A reversal has been canceled. For example, you won a dispute with the customer, and the funds for
					//                           Completed the transaction that was reversed have been returned to you.
					//Completed:            The payment has been completed, and the funds have been added successfully to your account balance.
					//Denied:                 You denied the payment. This happens only if the payment was previously pending because of possible
					//                            reasons described for the PendingReason element.
					//Expired:                 This authorization has expired and cannot be captured.
					//Failed:                   The payment has failed. This happens only if the payment was made from your customerâ€™s bank account.
					//Pending:                The payment is pending. See pending_reason for more information.
					//Refunded:              You refunded the payment.
					//Reversed:              A payment was reversed due to a chargeback or other type of reversal. The funds have been removed from
					//                          your account balance and returned to the buyer. The reason for the
					//                           reversal is specified in the ReasonCode element.
					//Processed:            A payment has been accepted.
					//Voided:                 This authorization has been voided.
					//
					
					//
					// we will send an email to say that something went wrong
					//$mail_To = "payit@designertuts.com";
					//$mail_Subject = "PayPal IPN status not completed or security check fail";
					
					//you can put whatever debug info you want in the email
					
					//$mail_Body = "Something wrong. \n\nThe transaction ID number is: $txn_id \n\n Payment status = $payment_status \n\n Payment amount = $payment_amount";
					//mail($mail_To, $mail_Subject, $mail_Body);
					
					//update the status
					$ordObj->updateOrderStatus($ordId, 9);
					
					//insert the transaction id
					$ordObj->updateOrderTrxnId($ordId, $txn_id);
					//echo "Failed"; 
					
				  }
			 }
			 else if (strcmp ($res, "INVALID") == 0) 
			 {
				//
				// Paypal didnt like what we sent. If you start getting these after system was working ok in the past, check if Paypal has altered its IPN format
				//
				//$mail_To = "payit@designertuts.com";
				//$mail_Subject = "PayPal - Invalid IPN ";
				//$mail_Body = "We have had an INVALID response. \n\nThe transaction ID number is: $txn_id \n\n username = $username";
				//mail($mail_To, $mail_Subject, $mail_Body);
				//update the status
				$ordObj->updateOrderStatus($ordId, 14);
				
				//insert the transaction id
				$ordObj->updateOrderTrxnId($ordId, $txn_id); 
				
				//echo "Invalid";
			  }
			  else
			  {
				  //echo $res." ".$payment_status;
			  }
			  
			}//if not completed
			
		} //end of while
		
		
		
		fclose ($fp);
	}
					
				

?>