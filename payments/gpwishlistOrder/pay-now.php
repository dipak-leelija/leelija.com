<?php
session_start();
include('Crypto.php');
require_once "../../includes/constant.inc.php";
?>
<html>

<head>
    <title>Payment to <?php echo COMPANY_FULL_NAME?></title>
    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH; ?>" />

</head>

<body>
    <center>
    <?php 

	error_reporting(0);

	$working_key='23AA922A82711D538A1ED6BBE222DD01';//Shared by CCAVENUES
	$access_code='AVAM96HK83BN94MANB';//Shared by CCAVENUES
	$merchant_data='';

	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

	$production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
?>
        <iframe src="<?php echo $production_url?>" id="paymentFrame" width="482" height="450" frameborder="0"
            scrolling="No"></iframe>

        <script type="text/javascript" src="jquery-1.7.2.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            window.addEventListener('message', function(e) {
                $("#paymentFrame").css("height", e.data['newHeight'] + 'px');
            }, false);

        });
        </script>
    </center>
</body>

</html>