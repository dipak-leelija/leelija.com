<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// require_once "../includes/constant.inc.php";


function tableCSS(){
    $css = '<style>
                * {
                    box-sizing: border-box;
                }

                body {
                    margin: 0;
                    padding: 0;
                }

                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                }

                .td-left {
                    border-bottom: 1px solid #666666;
                    border-right: 1px solid #666666;
                    padding: 6px;
                }

                .td-right {
                    border-bottom: 1px solid #666666;
                    padding: 6px;
                }

                .mso-space-0 {
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }
                .sec-header {
                    margin: 0;
                    color: #f9f9f9;
                    font-size: 20px;
                    font-family: Poppins, Arial, Helvetica Neue, Helvetica, sans-serif;
                    line-height: 180%;
                    text-align: center;
                    direction: ltr;
                    font-weight: 700;
                    letter-spacing: normal;
                    padding-top: 6px;
                    padding-bottom: 5px;
                }
                #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                }

                p {
                    line-height: inherit
                }

                .desktop_hide,
                .desktop_hide table {
                    mso-hide: all;
                    display: none;
                    max-height: 0px;
                    overflow: hidden;
                }

                @media (max-width:700px) {
                    .desktop_hide table.icons-inner {
                        display: inline-block !important;
                    }

                    .icons-inner {
                        text-align: center;
                    }

                    .icons-inner td {
                        margin: 0 auto;
                    }

                    .row-content {
                        width: 100% !important;
                    }

                    .mobile_hide {
                        display: none;
                    }

                    .stack .column {
                        width: 100%;
                        display: block;
                    }

                    .mobile_hide {
                        min-height: 0;
                        max-height: 0;
                        max-width: 0;
                        overflow: hidden;
                        font-size: 0px;
                    }

                    .desktop_hide,
                    .desktop_hide table {
                        display: table !important;
                        max-height: none !important;
                    }
                }
            </style>';

        return $css;
}

function tableHeader(){

    $head = '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2 mso-space-0"
            role="presentation" width=" 100%">
                <tbody>
                    <tr>
                        <td>
                            <table align="center" border="0" cellpadding="0" cellspacing="0"
                                class="row-content stack mso-space-0" role="presentation"
                                style=" border-radius: 0; color: #000000; background-color: #fff; width: 680px;"
                                width="680">
                                <tbody>
                                    <tr>
                                        <td class="column column-1 mso-space-0"
                                            style=" font-weight: 400; text-align: left; vertical-align: top; padding-top: 10px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="100%">
                                            <table border="0" cellpadding="0" cellspacing="0"
                                                class="image_block block-1 mso-space-0" role="presentation"
                                                width="100%">
                                                <tr>
                                                    <td class="pad"
                                                        style="width:100%;padding-right:0px;padding-left:0px;">
                                                        <div align="center" class="alignment"
                                                            style="line-height:10px">
                                                            <img src="'.LOGO_WITH_PATH.'" style="display: block; height: 50px; border: 0; width: 170px; max-width: 100%;" width="100" />
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>';
            return $head;
}


function tableDetails($tablename, $txndtls_arr, $txndata_arr){
    if ($txndtls_arr  != '' || $txndata_arr != '' || count($txndtls_arr)  > 0 || count($txndata_arr) > 0) {
    $section = '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5 mso-space-0"
                role="presentation" width="100%">
                    <tbody>
                        <tr>
                            <td>
                                <div style="background-color: #6f66f2; color: #fff; width: 680px; margin: auto;">
                                    <h1 class="sec-header">
                                        <span class="tinyMce-placeholder" style="text-transform: uppercase;">'.$tablename.'</span>
                                    </h1>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6 mso-space-0" role="presentation"
            width="100%">
                <tbody>
                    <tr>
                        <td>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack mso-space-0"
                                role="presentation" style="font-family: Poppins, sans-serif;  background-color: #ffffff; color: #000000; width: 680px; padding-bottom: 12px;" width="680">
                                    <tbody>
                                        <tr>
                                            <td class="column column-1" width="5%">
                                                <div class="spacer_block" style="height:5px;line-height:0px;font-size:1px;"> </div>
                                            </td>
                                            <td class="column column-2 mso-space-0" style=" font-weight: 400; text-align: left; vertical-align: top; " width="50%">
                                                <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2 mso-space-0" role="presentation" style=" word-break: break-word; margin-top: 10px;" width="100%">';

                                                        foreach($txndtls_arr as $txnHeader){
                                                            $txnData = array_shift($txndata_arr);

                                                            $section .='<tr>
                                                                        <td class="td-left">
                                                                            <b>'.$txnHeader.':</b>
                                                                        </td>
                                                                        <td class="td-right">
                                                                            &nbsp;
                                                                            '.$txnData.'
                                                                        </td>
                                                                    </tr>';
                                                        }

                                    $section .= '</table>
                                            </td>
                                        <td class="column column-3" width="5%">
                                            <div class="spacer_block" style="height:5px;line-height:0px;font-size:1px;"> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>';
            return $section;
    }

}


function mailFooter(){

    return '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-8 mso-space-0" role="presentation"
                width="100%">
                <tbody>
                    <tr>
                        <td>

                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack mso-space-0"
                                role="presentation" style=" background-color: #6f66f2; color: #000000; width: 680px;" width="680">
                                <tbody>
                                    <tr>
                                        <td class="column column-1 mso-space-0"
                                            style=" font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                            width="100%">

                                            <div style="background-color: #6f66f2; min-height: 20px; max-width: 680px;     margin: auto;">

                                                <div class="txtTinyMce-wrapper"
                                                    style="font-size: 14px; mso-line-height-alt: 21px; color: #f9f9f9; line-height: 1.5; font-family: Poppins, Arial, Helvetica Neue, Helvetica, sans-serif; padding-top: 12px; padding-bottom: 12px;">
                                                    <p
                                                        style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 18px;">
                                                        <span>Barasat, Kolkata</span>
                                                    </p>
                                                    <p
                                                        style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 18px;">
                                                        <span><a style="text-decoration: none; color: #fff;"
                                                                href="mailto:'.SITE_BILLING_EMAIL.'">'.SITE_BILLING_EMAIL.'</a>
                                                        </span>
                                                    </p>
                                                    <p
                                                        style="margin: 0; font-size: 12px; text-align: center; mso-line-height-alt: 18px;">
                                                        <span><a style="text-decoration: none; color: #fff;" href="tel:'.SITE_HELP_LINE_NO.'">'.SITE_HELP_LINE_NO.'</span>
                                                    </p>
                                                </div>

                                                <div class="alignment"
                                                            style="text-align: center; margin-top: 10px; padding-bottom: 12px;">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="social-table mso-space-0" role="presentation"
                                                                style=" display: inline-block;">
                                                                <tr>
                                                                    <td style="padding:0 10px 0 10px;">
                                                                        <a href="'.FB_LINK.'"
                                                                            target="_blank"><img alt="Facebook"
                                                                                height="32" src="'.URL.'/images/icons/social-media-icons/facebook2x.png"
                                                                                style="display: block; height: auto; border: 0;"
                                                                                title="Facebook" width="32" /></a>
                                                                    </td>
                                                                    <td style="padding:0 10px 0 10px;">
                                                                        <a href="'.TWITTER_LINK.'"
                                                                            target="_blank"><img alt="Twitter"
                                                                                height="32" src="'.URL.'/images/icons/social-media-icons/twitter2x.png"
                                                                                style="display: block; height: auto; border: 0;"
                                                                                title="Twitter" width="32" /></a>
                                                                    </td>
                                                                    <td style="padding:0 10px 0 10px;">
                                                                        <a href="'.PINTEREST_LINK.'"
                                                                            target="_blank"><img alt="Instagram"
                                                                                height="32" src="'.URL.'/images/icons/social-media-icons/pinterest2x.png"
                                                                                style="display: block; height: auto; border: 0;"
                                                                                title="Instagram" width="32" /></a>
                                                                    </td>
                                                                    <td style="padding:0 10px 0 10px;">
                                                                        <a href="'.LINKDIN_LINK.'>"
                                                                            target="_blank"><img alt="Instagram"
                                                                                height="32" src="'.URL.'/images/icons/social-media-icons/linkedin2x.png"
                                                                                style="display: block; height: auto; border: 0;"
                                                                                title="Instagram" width="32" /></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>';
}

function customerOrderPlacedMail($fromMail, $toMail, $toName, $orddtls_arr, $orddata_arr, $txndtls_arr, $txndata_arr, $addedOn){
    $fromMail   = $fromMail;
    $from       = SITE_BILLING_NAME.'<'.$fromMail.'>';
    $to         = $toName.'<'.$toMail.'>';
	$subject    = 'Your order has been placed - '.date("d-m-Y");


    $body =  '

    <!DOCTYPE html>
    <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
        <title></title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,500;0,600;1,100;1,200&display=swap"
            rel="stylesheet">';
            
            
        $body .= tableCSS();


    $body .= '
    </head>

    <body style="background-color: #f9f9f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
        <table border="0" cellpadding="0" cellspacing="0" class="nl-container mso-space-0" role="presentation"
            style=" background-color: #f9f9f9;" width="100%">
            <tbody>
                <tr>
                    <td>';

                    $body .= tableHeader();
                        
                    $body .= '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4
                            mso-space-0" role="presentation" style="" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack mso-space-0" role="presentation" style=" background-color: #ffffff; color: #000000; width: 680px;" width="680">
                                            <tbody>
                                                <tr>
                                                    <td class="column column-1 mso-space-0" style=" font-weight: 400; text-align: left; vertical-align: top; padding-top: 40px; padding-bottom: 20px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                                        <table border="0" cellpadding="0" cellspacing="0" class="text_block block-1 mso-space-0" role="presentation" style=" word-break: break-word;" width="100%">
                                                            <tr>
                                                                <td class="pad" style="padding-bottom:10px;padding-left:30px;padding-right:30px;padding-top:10px;">
                                                                    <div style="font-family: Poppins\', sans-serif">
                                                                        <div class="txtTinyMce-wrapper" style=" font-family: Poppins, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 21px; color: #393d47; line-height: 1.5;">
                                                                            <p style="margin: 0; font-size: 16px; text-align: left;">
                                                                                <span style="font-size:20px;">
                                                                                    Hi <strong>'.$toName.'</strong>,
                                                                                </span>
                                                                                <br>
                                                                                <br>
                                                                                Thank you for your order.
                                                                                <br>
                                                                                Your order has been placed <span>on '.$addedOn.'.</span>
                                                                                <br>
                                                                                Please find your order details below:
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>';


                        // Order Details Start
                        $body .= tableDetails('Order Details', $orddtls_arr, $orddata_arr);
                        // Order Details End

                        // Transection Details Start
                        $body .= tableDetails('Transection Details', $txndtls_arr, $txndata_arr);
                        // Transection Details End

                        $body .= '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7 mso-space-0"
                                role="presentation" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="mso-space-0" style="background-color: #ffffff; width: 680px; font-weight: 400; font-size: 14px; font-family: Poppins, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 21px; color: #2f2f2f; line-height: 1.5; margin: 0px auto;padding: 20px; text-align: center;" width="680">
                                                        <p style="margin: 0; font-size: 15px; margin-top: 5px;">
                                                            If you find anything wrong, please contact
                                                            us as soon as possible.</p>
                                                        <p style="margin: 0; font-size: 13px; margin-top: 8px;">
                                                            This is an auto generated mail during
                                                            transection on <a href="'.URL.'">leelija.com</a>
                                                        </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';


                        // <!-- Footer Here -->
                        $body .= mailFooter();
                        // <!-- Footer Here -->

        $body .= '</td>
                </tr>
            </tbody>
        </table>
    </body>
    </html>';


    //normal mail
    $headers = "From: ".$from."\r\n";
    $headers .= "Return-Path: <".$fromMail.">\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1";

    $mailsended = mail($to, $subject, $body, $headers);

    return $mailsended;

    }

    function adminOrderPlacedMail($fromMail, $toMail, $toName, $cusDtls_arr, $cusData_arr,  $orddtls_arr, $orddata_arr, $txndtls_arr, $txndata_arr, $addedOn){
        $fromMail   = $fromMail;
        $from       = SITE_BILLING_NAME.'<'.$fromMail.'>';
        $to         = $toName.'<'.$toMail.'>';
        $subject    = 'New Order From  -'.$toName.' - '.date("d-m-Y");
    
    
        $body =  '
    
        <!DOCTYPE html>
        <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
        <head>
            <title></title>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    
            <link
                href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,500;0,600;1,100;1,200&display=swap"
                rel="stylesheet">';
                
                
            $body .= tableCSS();
    
    
        $body .= '
        </head>
    
        <body style="background-color: #f9f9f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
            <table border="0" cellpadding="0" cellspacing="0" class="nl-container mso-space-0" role="presentation"
                style=" background-color: #f9f9f9;" width="100%">
                <tbody>
                    <tr>
                        <td>';
                    
                        $body .= tableHeader();
                            
                    $body .= '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4 mso-space-0"
                            role="presentation" style="" width="100%">
                            <tbody>
                                <tr>
                                    <td>
    
                                        <div align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="row-content stack mso-space-0" role="presentation"
                                            style="font-weight: 400; text-align: left; vertical-align: top; background-color: #ffffff;  width: 680px; margin: auto; font-family: Poppins, Helvetica Neue, Helvetica, sans-serif; padding: 10px 30px 10px 30px;"
                                            width="680">
    
                                            <p style="margin: 0; font-size: 16px; text-align: left; color: #393d47; line-height: 1.5;">
                                                <span style="font-size:20px;"> Hi
                                                    <strong>'.$toName.'</strong>, </span>
                                                <br>
                                                <br>
                                                Thank you for your order.
                                                <br>
                                                Your order has been placed <span>on '.$addedOn.'..</span>
                                                <br>
                                                Please find your order details below:
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>';
    

                            // Customer Details Start
                            $body .= tableDetails('Customer Details', $cusDtls_arr, $cusData_arr);
                            // Customer Details End


    
                            // Order Details Start
                            $body .= tableDetails('Order Details', $orddtls_arr, $orddata_arr);
                            // Order Details End
    
    
    
                            // Transection Details Start
                            $body .= tableDetails('Transection Details', $txndtls_arr, $txndata_arr);
                            // Transection Details End
    
    
                            $body .= '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7 mso-space-0"
                                    role="presentation" width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="mso-space-0" style="background-color: #ffffff; width: 680px; font-weight: 400; font-size: 14px; font-family: Poppins, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 21px; color: #2f2f2f; line-height: 1.5; margin: 0px auto;padding: 20px; text-align: center;" width="680">
                                                            <p style="margin: 0; font-size: 15px; margin-top: 5px;">
                                                                If you find anything wrong, please contact
                                                                us as soon as possible.</p>
                                                            <p style="margin: 0; font-size: 13px; margin-top: 8px;">
                                                                This is an auto generated mail during
                                                                transection on <a href="'.URL.'">leelija.com</a>
                                                            </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
    
    
                            // <!-- Footer Here -->
                            $body .= mailFooter();
                            // <!-- Footer Here -->
    
            $body .= '</td>
                    </tr>
                </tbody>
            </table>
        </body>
        </html>';
    
    
        //normal mail
        $headers = "From: ".$from."\r\n";
        $headers .= "Return-Path: <".$fromMail.">\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1";
    
        $mailsended = mail($to, $subject, $body, $headers);
    
        return $mailsended;
    
        }
        function sellerOrderinformMail($fromMail, $sellerMail, $sellerName, $blogName, $orddtls_arr, $orddata_arr, $addedOn){
            $fromMail   = $fromMail;
            $from       = SITE_BILLING_NAME.'<'.$fromMail.'>';
            $to         = $sellerName.'<'.$sellerMail.'>';
            $subject    = 'New Order For  -'.$blogName.' - '.date("d-m-Y");
            $body =  '
        
            <!DOCTYPE html>
            <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
            <head>
                <title></title>
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        
                <link
                    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,500;0,600;1,100;1,200&display=swap"
                    rel="stylesheet">';
                    
                    
                $body .= tableCSS();
        
        
            $body .= '
            </head>
        
            <body style="background-color: #f9f9f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
                <table border="0" cellpadding="0" cellspacing="0" class="nl-container mso-space-0" role="presentation"
                    style=" background-color: #f9f9f9;" width="100%">
                    <tbody>
                        <tr>
                            <td>';
                        
                            $body .= tableHeader();
                                
                        $body .= '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4 mso-space-0"
                                role="presentation" style="" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
        
                                            <div align="center" border="0" cellpadding="0" cellspacing="0"
                                                class="row-content stack mso-space-0" role="presentation"
                                                style="font-weight: 400; text-align: left; vertical-align: top; background-color: #ffffff;  width: 680px; margin: auto; font-family: Poppins, Helvetica Neue, Helvetica, sans-serif; padding: 10px 30px 10px 30px;"
                                                width="680">
        
                                                <p style="margin: 0; font-size: 16px; text-align: left; color: #393d47; line-height: 1.5;">
                                                    <span style="font-size:20px;"> Hi
                                                        <strong>'.$sellerName.'</strong>, </span>
                                                    <br>
                                                    <br>
                                                    you have recived an order for the domain '.$blogName.'.
                                                    <br>
                                                    Your order has been placed <span>on '.$addedOn.'..</span>
                                                    <br>
                                                    Please order details below:
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>';
        
                                // Order Details Start
                                $body .= tableDetails('Order Details', $orddtls_arr, $orddata_arr);
                                // Order Details End
        
        
                                $body .= '<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7 mso-space-0"
                                        role="presentation" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="mso-space-0" style="background-color: #ffffff; width: 680px; font-weight: 400; font-size: 14px; font-family: Poppins, Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 21px; color: #2f2f2f; line-height: 1.5; margin: 0px auto;padding: 20px; text-align: center;" width="680">
                                                                <p style="margin: 0; font-size: 15px; margin-top: 5px;">
                                                                    If you find anything wrong, please contact
                                                                    us as soon as possible.</p>
                                                                <p style="margin: 0; font-size: 13px; margin-top: 8px;">
                                                                    This is an auto generated mail during
                                                                    transection on <a href="'.URL.'">leelija.com</a>
                                                                </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>';
        
        
                                // <!-- Footer Here -->
                                $body .= mailFooter();
                                // <!-- Footer Here -->
        
                $body .= '</td>
                        </tr>
                    </tbody>
                </table>
            </body>
            </html>';
        
        
            //normal mail
            $headers = "From: ".$from."\r\n";
            $headers .= "Return-Path: <".$fromMail.">\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1";
        
            $mailsended = mail($to, $subject, $body, $headers);
        
            return $mailsended;
        
            }

?>




