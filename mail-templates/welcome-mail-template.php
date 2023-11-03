<?php
require_once dirname(__DIR__) . '/includes/constant.inc.php';


// echo welcomeMailToUser('Dipak', 'http://localhost/fastlinky/mail-templates/welcome-mail-template.php');


function mailFooter(){
    $body = '
        <tr style="padding: 0px; text-align: center; font-size: 12px; background-color: #f3b165;">
            <td style="padding: 0px; text-align: center; font-size: 12px; background-color: #f3b165;">
                <div style="margin-bottom: 2rem;
                margin-top: 2rem;" class="footer-text-address">
                    <h1 style="font-size: 2rem; color: darkblue; border-bottom: 2px solid #003399; padding-bottom: 5px; width: fit-content; margin: auto; margin-bottom: 20px;" >Get In Touch</h1>
                    <div>
                        <p style="margin: 0; font-size: 14px; line-height: 1.4;">Barasat, Kolkata, West Bengal, 700125, India</p>
                        <p style="margin: 0; font-size: 14px; line-height: 1.4; font-weight: 600; text-align: center;">
                            <a style="text-decoration: none; color: #000;" rel="noopener" href="tel:'.SITE_CONTACT_NO.'" target="_blank">
                            '.SITE_CONTACT_NO.'
                            </a>
                        </p>
                        <p style="margin: 0; font-size: 14px; line-height: 1.4; font-weight: 600; text-align: center; color: #fff;">
                            <a style="text-decoration: none; color: #000;" rel="noopener" href="tel:'.SITE_BILLING_CONTACT_NO.'" target="_blank">
                            '.SITE_BILLING_CONTACT_NO.'
                            </a>
                        </p>
                        <p style="margin: 0; font-size: 14px; line-height: 1.4; font-weight: 600; text-align: center;">
                            <a style="text-decoration: none;" rel="noopener" href="mailto:'.SITE_EMAIL.'" target="_blank">
                            '.SITE_EMAIL.'
                            </a>
                        </p>
                        <p style="margin: 0; font-size: 14px; line-height: 1.4; font-weight: 600; text-align: center;">
                            <a style="text-decoration: none;" rel="noopener" href="mailto:'.SITE_BILLING_EMAIL.'" target="_blank">
                            '.SITE_BILLING_EMAIL.'
                            </a>
                        </p>
                    </div>

                </div>

                <p class="social-icons-div" style="display: flex; justify-content: center; margin: 0; font-size: 14px; line-height: 1.4; text-align: center; background: #00008b; padding: 12px;">
                    <a href="'.FB_LINK.'" title="Facebook" target="_blank" style="text-decoration: none;">
                        <img style="display:inline-block; padding: 4px; vertical-align: sub !important;" src="https://fastlinky.com/images/icons/social-media-icons/facebook2x.png" width="35" height="35" alt="facebook">
                    </a>
                    <a href="'.TWITTER_LINK.'" title="Twitter" target="_blank" style="text-decoration: none;">
                        <img style="display:inline-block; padding: 4px; vertical-align: sub !important;" src="https://fastlinky.com/images/icons/social-media-icons/twitter2x.png" width="35" height="35" alt="t">
                    </a>
                    <a href="'.LINKDIN_LINK.'" title="Linkedin" target="_blank" style="text-decoration: none;">
                        <img style="display:inline-block; padding: 4px; vertical-align: sub !important;" src="https://fastlinky.com/images/icons/social-media-icons/linkedin2x.png" width="35" height="35" alt="Li">
                    </a>
                    <a href="'.INSTA_LINK.'" title="Instagram" target="_blank" style="text-decoration: none;">
                        <img style="display:inline-block; padding: 4px; vertical-align: sub !important;" src="https://fastlinky.com/images/icons/social-media-icons/instagram2x.png" width="35" height="35" alt="insta">
                    </a>
                </p>
            </td>
        </tr>
    ';
    return $body;
}




function welcomeMailToUser($fistName, $verifyLink){
    $body = '
    <!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="x-apple-disable-message-reformatting">
        <title></title>
        <link rel="stylesheet" href="css/client-welcome-emails.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
        <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">

        <style>
            @import url("https://fonts.googleapis.com/css2?family=Pacifico&display=swap");
            
            
            .ts-td2-text-div {
                padding-bottom: 0px !important;
                padding: 20px 10px;
                background-color: #e7e7e74a;
            }
            /* ============== */

            .ts-td2-text-div-p{
                color: #000000;
                font-family: cabin, sans-serif;
                font-size: 14px;
                line-height: 21px;
            }
            
            .ts-td3-image {
                background-color: #f3b165;
                height: auto;
                display: block;
                border: none;
                text-decoration: none;
                color: #363636;
                margin: auto;
            }
            
            .ts-td4-img-section {
                background-color: #e7e7e74a;
                padding:10px;
            }
            
            .btn{
                box-sizing: border-box;
                padding: 6px 20px;
                display: inline-block;
                font-family: arial,helvetica,sans-serif;
                text-decoration: none;
                -webkit-text-size-adjust: none;
                text-align: center;
                color: #FFFFFF;
                background-color: #843fa1;
                border-radius: 20px;
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                width: auto;
                max-width: 100%;
                overflow-wrap: break-word;
                word-break: break-word;
                word-wrap: break-word;
            }
            
            table,
            td,
            div,
            h1 {
                font-family: Arial, sans-serif;
            }
            
            @media screen and (max-width: 530px) {
            
                .ts-td2-text-div-p{
                    margin: 0;
                    /* text-align: center; */
                }
            
            }
        </style>

    </head>

    <body style="margin: 0; padding: 0; word-spacing: normal;">
        <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
            <table role="presentation" style="width: 100%; border: none; border-spacing: 0;">
                <tr>
                    <td align="center" style="padding:0;">
                        <table role="presentation" style="width: 94%; max-width: 600px; border-spacing: 0; text-align: left; font-family: Arial, sans-serif; font-size: 16px; line-height: 22px;color: #363636;">
                            <!-- **************************  LOGO IMAGE SECTION ************************ -->
                            <tr>
                                <!--|| ts=table-second ||  -->
                                <td style="font-weight: bold;">
                                    <h1 style="margin: 0px; color: #843fa1; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-size: 25px;"> <strong> Hi '.$fistName.'!</strong></h1>
                                    <p>
                                        <strong>Welcome to '.COMPANY_FULL_NAME.'</strong>
                                    </p>
                                </td>
                            </tr>
                            <!-- **************************  LOGO IMAGE SECTION ENDS ************************ -->
                            <tr style="background-color: #e7e7e74a;">
                                <td style="padding: 0;">
                                    <a href="#" style="text-decoration:none;">
                                        <div>
                                            <img class="ts-td3-image" src="'.URL.'/mail-templates/images/verify-welcome.png"
                                                width="480" alt="">
                                        </div>

                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="ts-td2-text-div">
                                    <p class="ts-td2-text-div-p" style="margin:0; padding-top: 12px;">
                                        <span style="font-family: Cabin, sans-serif;">
                                        We have received your registration on our site and we are excited to have you join our community. In order to ensure the security of your account and to keep our site safe for all users, we kindly request that you verify your account.
                                        </span>


                                    </p>
                                    <p class="ts-td2-text-div-p" style="text-align: left; padding-top: 12px;">
                                        <strong style="font-size: 14px;">Click on the verify button bellow or copy the link to another tab to verify your account:</strong>
                                    </p>
                                    <p class="ts-td2-text-div-p" style="color: #3a47f8;margin: 2px;text-align: center;">
                                    '.$verifyLink.'
                                    </p>

                                </td>
                            </tr>

                            <tr>
                                <td style="background-color: #e7e7e74a; padding-top: 12px; text-align: center;">
                                    <a class="btn " href="'.$verifyLink.'" target="_blank">Verify</a>
                                </td>
                            </tr>

                            <tr>
                                <td class="ts-td4-img-section">
                                    <p class="ts-td2-text-div-p">
                                        <span style="font-family: Cabin, sans-serif;">
                                        Once you have verified your account, you will be able to access all of the features and benefits of being a member of our community.
                                        </span>
                                    </p>
                                    <p class="ts-td2-text-div-p">
                                        <span style="font-family: Cabin, sans-serif;">
                                        Thank you for your time and we look forward to having you as a part of our community.
                                        </span>
                                    </p>
                                </td>
                            </tr>';

                            // ====================  FOOTER STARTS ==================== -->
                            $body .= mailFooter();   
                            // ==================== FOOTER ENDS ==================== -->
                $body .='</table>
                    </td>
                </tr>
            </table>
        </div>
    </body>

    </html>
    ';
    return $body;
}


function VerifiedMailtoUser($fastName){
    $body = '
            <!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
            
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <meta name="x-apple-disable-message-reformatting">
                <title></title>
                <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
                <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
                <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">


                <style>
                @import url("https://fonts.googleapis.com/css2?family=Pacifico&display=swap");
    
                /* =================== */
                
                .ts-td2-text-div {
                    padding-bottom: 0px !important;
                    padding: 30px;
                }
                
                .ts-td2-text-div-p {
                    margin: 0;
                }
                /* ============== */
                
                .ts-td2-text-div-h1 {
                    margin-top: 0;
                    margin-bottom: 16px;
                    font-size: 26px;
                    line-height: 32px;
                    font-weight: bold;
                    letter-spacing: -0.02em;
                    font-family: "Satoshi-Variable";
                }
                
                .ts-td3-img-div {
                    font-size: 24px;
                    line-height: 28px;
                }
                
                .ts-td3-image {
                    background-color: aliceblue;
                    width: 70%;
                    height: auto;
                    display: block;
                    border: none;
                    text-decoration: none;
                    color: #363636;
                }
                
                .explore-section {
                    padding: 35px 30px 11px 30px;
                    font-size: 0;
                    border-bottom: 1px solid #f0f0f5;
                    border-color: rgba(201, 201, 207, .35);
                    font-family: cabin, sans-serif;
                }
                
                .col-sml {
                    display: inline-block;
                    width: 100%;
                    max-width: 145px;
                    vertical-align: top;
                    text-align: left;
                    font-family: cabin, sans-serif;
                    font-size: 14px;
                    color: #363636;
                }
                
                .col-sml-img {
                    width: 115px;
                    max-width: 80%;
                    margin-bottom: 20px;
                }
                
                .col-lge {
                    display: inline-block;
                    width: 100%;
                    max-width: 395px;
                    vertical-align: top;
                    padding-bottom: 20px;
                    font-family: cabin, sans-serif;
                    font-size: 16px;
                    line-height: 22px;
                    color: #363636;
                }
                
                .col-lge-p1 {
                    margin-top: 0;
                    margin-bottom: 12px;
                }
                
                .col-lge-p2 {
                    margin-top: 0;
                    margin-bottom: 18px;
                }
                
                .col-lge-p3 {
                    margin: 0;
                    text-align: center;
                }
                
                .col-lge-p3-atag {
                    background: #ff3884;
                    text-decoration: none;
                    padding: 10px 25px;
                    color: #ffffff;
                    border-radius: 4px;
                    display: inline-block;
                    mso-padding-alt: 0;
                    text-underline-color: #ff3884;
                }
                
                .col-lge-p3-span {
                    mso-text-raise: 10pt;
                    font-weight: bold;
                }
                
                .ts-td6-text-div {
                    padding: 30px;
                    background-color: aliceblue;
                }
                
                table,
                td,
                div,
                h1,
                p {
                    font-family: cabin, sans-serif;
                    
                }
                
                @media screen and (max-width: 530px) {
                    .col-lge {
                        max-width: 100% !important;
                        text-align: center;
                    }
                    .ts-td2-text-div-h1 {
                        text-align: center;
                    }
                    .ts-td2-text-div-p {
                        margin: 0;
                        text-align: center;
                    }
                    .col-sml {
                        max-width: 100%;
                        text-align: center;
                    }
                }
                
                @media screen and (min-width: 531px) {
                    .col-sml {
                        max-width: 27% !important;
                    }
                    .col-lge {
                        max-width: 73% !important;
                    }
                }
            </style>

            
            </head>
            
            <body style="margin: 0; padding: 0; word-spacing: normal;">
                <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                    <table role="presentation" style="width: 100%; border: none; border-spacing: 0;">
                        <tr>
                            <td align="center" style="padding: 0;">
                                <table role="presentation" style="width: 94%; max-width: 600px; border-spacing: 0; text-align: left; font-family: Arial, sans-serif; font-size: 16px; line-height: 22px; color: #363636;">
                                    <!-- **************************  LOGO IMAGE SECTION ************************ -->
                                    <tr>
                                        <!--|| ts=table-second ||  -->
                                        <td style="padding: 15px 30px 0px 30px; text-align: center; font-size: 24px; background: aliceblue;">
                                            <a href="#" style="text-decoration:none;">
                                                <img style="width: 270px; max-width: 100%; height: auto; border: none; text-decoration: none; color: #ffffff;" src="'.LOGO_WITH_PATH.'" width="300" alt="Logo">
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- **************************  LOGO IMAGE SECTION ENDS ************************ -->
                                    <tr style="background-color: #e7e7e74a;">
                                        <td class="ts-td3-img-div" style="padding: 0; font-weight: bold;">
                                            <img class="ts-td3-image" style="margin: auto;" src="'.URL.'/mail-templates/images/emails-img1.png" width="600" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ts-td2-text-div">
                                            <h1 class="ts-td2-text-div-h1">Congratulations! Your Account is Verified</h1>

                                            <p class="ts-td2-text-div-p">Thanks '.$fastName.' for taking the time to verify your account on FastLinky. Your verification ensures that our community remains safe and secure for all users. Keep sharing and connecting with others on our platform!
                                            </p>
                                        </td>
                                    </tr>
                                    <tr style="background-color: #e7e7e74a;">
                                        <td class="explore-section">
                                            <div class="col-sml">
                                                <img class="col-sml-img" src="'.URL.'/mail-templates/images/email-verify.png" width="115" alt="">
                                            </div>
                                            <div class="col-lge">
                                                <p class="col-lge-p1">'.COMPANY_FULL_NAME.' use special strategy to increase your visibility and reach by publishing content on other websites. It involves writing and submitting articles or blog posts to be published on relevant websites in exchange for a link back to the author\'s website. </p>

                                                <p class="col-lge-p2" style="">This can help to increase website traffic, build brand awareness, and improve search engine rankings.</p>
                                                <p class="col-lge-p3">
                                                    <a href="#" class="col-lge-p3-atag">
                                                        <span class="col-lge-p3-span">Explore Now</span>
                                                    </a>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ts-td6-text-div">
                                            <p style="margin:0;">Beware of online fraud and scams. Always verify the authenticity of offers and transactions before providing personal or financial information. We are not responsible for any loss or damages resulting from any fraudulent activities.</p>
                                        </td>
                                    </tr>';

                                    // ====================  FOOTER STARTS ==================== -->
                                    $body .= mailFooter();   
                                    // ==================== FOOTER ENDS ==================== -->

                        $body .= '</table>
                            </td>
                        </tr>
                    </table>
                </div>
            </body>
            </html>
    ';
    return $body;
}








/*==================================================================================================
|                                                                                                   |
|                               New Customer Registered Mail to Admin                               |
|                                                                                                   |
===================================================================================================*/

function welcomeMailToAdmin($data, $data_val){
    $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    
    <head>
        <!--[if gte mso 9]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="x-apple-disable-message-reformatting">
        <!--[if !mso]><!-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<![endif]-->
        <title></title>
    
        <style type="text/css">
            @media only screen and (min-width: 520px) {
                .u-row {
                    width: 500px !important;
                }
                .u-row .u-col {
                    vertical-align: top;
                }
                .u-row .u-col-100 {
                    width: 500px !important;
                }
            }
            
            @media (max-width: 520px) {
                .u-row-container {
                    max-width: 100% !important;
                    padding-left: 0px !important;
                    padding-right: 0px !important;
                }
                .u-row .u-col {
                    min-width: 320px !important;
                    max-width: 100% !important;
                    display: block !important;
                }
                .u-row {
                    width: 100% !important;
                }
                .u-col {
                    width: 100% !important;
                }
                .u-col>div {
                    margin: 0 auto;
                }
            }
            
            body {
                margin: 0;
                padding: 0;
            }
            
            table,
            tr,
            td {
                vertical-align: top;
                border-collapse: collapse;
            }
            
            p {
                margin: 0;
            }
            
            .ie-container table,
            .mso-container table {
                table-layout: fixed;
            }
            
            * {
                line-height: inherit;
            }
            
            a[x-apple-data-detectors=\'true\'] {
                color: inherit !important;
                text-decoration: none !important;
            }
            
            table,
            td {
                color: #000000;
            }
            
            #u_body a {
                color: #0000ee;
                text-decoration: underline;
            }
            
            @media (max-width: 480px) {
                #u_content_heading_1 .v-container-padding-padding {
                    padding: 2px 10px 1px !important;
                }
                #u_column_2 .v-col-background-color {
                    background-color: #ecf0f1 !important;
                }
                #u_content_text_4 .v-color {
                    color: #000000 !important;
                }
            }
        </style>
    
    
    
        <!--[if !mso]><!-->
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">
        <!--<![endif]-->
    
    </head>
    
    <body class="clean-body u_body" style="margin: 0;padding: 0; word-spacing: normal; -webkit-text-size-adjust: 100%;background-color: #e7e7e7;color: #000000;">
        <!--[if IE]><div class="ie-container"><![endif]-->
        <!--[if mso]><div class="mso-container"><![endif]-->
        <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #e7e7e7;width:100%" cellpadding="0" cellspacing="0">
            <tbody>
                <tr style="vertical-align: top">
                    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #e7e7e7;"><![endif]-->
    
    
                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                            <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
    
                                    <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
                                        <div class="v-col-background-color" style="background-color: #ffffff;height: 100%;width: 100% !important;">
                                            <!--[if (!mso)&(!IE)]><!-->
                                            <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                <!--<![endif]-->
    
                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
    
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="padding-right: 0px;padding-left: 0px;" align="center">
    
                                                                            <img align="center" border="0" src="'.LOGO_WITH_PATH.'" alt="" title="" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 35%;max-width: 168px;"
                                                                                width="168" />
    
                                                                        </td>
                                                                    </tr>
                                                                </table>
    
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
                                                <table id="u_content_heading_1" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:2px 10px 1px;font-family:arial,helvetica,sans-serif;" align="left">
    
                                                                <h2 class="v-color" style="margin: 0px; color: #34495e; line-height: 140%; text-align: left; word-wrap: break-word; font-weight: normal; font-size: 18px;"><strong>Hi Admin,</strong></h2>
    
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 2px;font-family:arial,helvetica,sans-serif;" align="left">
    
                                                                <div class="v-color" style="color: #34495e; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                                    <p style="font-size: 14px; line-height: 140%;"><strong><span style="line-height: 22.4px;">
                                                                    A new user has just registered. Their information has been captured and is ready for your review.</span></strong></p>
                                                                </div>
    
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
                                                <!--[if (!mso)&(!IE)]><!-->
                                            </div>
                                            <!--<![endif]-->
                                        </div>
                                    </div>
                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                </div>
                            </div>
                        </div>
    
    
    
                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                            <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
    
                                    <div id="u_column_2" class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
                                        <div class="v-col-background-color" style="background-color: #ffffff;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                            <!--[if (!mso)&(!IE)]><!-->
                                            <div style="height: 100%; padding: 0px;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--<![endif]-->
    
                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
    
                                                                <div style="margin-left:18px; font-family: Cabin, sans-serif;">';
                                                                foreach ($data as $d) {
                                                                    $body .= '<p>'.$d.' : <b>'.array_shift($data_val).'</b></p>';
                                                                }
                                                    $body .= '</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
                                                <hr style="width: 90%;">
    
                                                <table id="u_content_text_4" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:12px 10px 18px;font-family:arial,helvetica,sans-serif;" align="left">
    
                                                                <div class="v-color" style="line-height: 150%; text-align: left; word-wrap: break-word;">
                                                                    <p style="font-size: 14px; line-height: 150%;"><span style="font-family: Cabin, sans-serif; font-size: 14px; line-height: 21px;">Please take a moment to review their account and ensure that everything is in order.</span></p>
                                                                </div>
    
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
                                                <!--[if (!mso)&(!IE)]><!-->
                                            </div>
                                            <!--<![endif]-->
                                        </div>
                                    </div>
                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                </div>
                            </div>
                        </div>
    
    
    
                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                            <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
    
                                    <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
                                        <div class="v-col-background-color" style="background-color: #483fee;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                            <!--[if (!mso)&(!IE)]><!-->
                                            <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--<![endif]-->
    
                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="v-container-padding-padding" style="color: #ffffff;overflow-wrap:break-word;word-break:break-word;padding:8px;font-family:arial,helvetica,sans-serif;font-weight: 600; font-size: 14ps;" align="left">
    
                                                                <div align="center">'.COMPANY_FULL_NAME.'</div>
    
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
                                                <!--[if (!mso)&(!IE)]><!-->
                                            </div>
                                            <!--<![endif]-->
                                        </div>
                                    </div>
                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                </div>
                            </div>
                        </div>
    
    
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                    </td>
                </tr>
            </tbody>
        </table>
        <!--[if mso]></div><![endif]-->
        <!--[if IE]></div><![endif]-->
    </body>
    
    </html>';

    return $body;
}

?>