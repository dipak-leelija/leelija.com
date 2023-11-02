<?php
require_once dirname(__DIR__) . '/includes/constant.inc.php';



function commonCss(){
    $css = '
    @import url("https://fonts.googleapis.com/css2?family=Pacifico&display=swap");
    body {
        margin: 0;
        padding: 0;
        word-spacing: normal;
    }
    
    .maindivofpage {
        text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    
    .table-first {
        width: 100%;
        border: none;
        border-spacing: 0;
    }
    
    .table-second {
        width: 94%;
        max-width: 600px;
        /* border: 1px solid #c9c6c6; */
        border-spacing: 0;
        text-align: left;
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 22px;
        color: #363636;
    }
    
    .ts-td1-img-div {
        padding: 15px 30px 0px 30px;
        text-align: center;
        font-size: 24px;
        background: aliceblue;
    }
    
    .ts-td-image {
        width: 270px;
        max-width: 100%;
        height: auto;
        border: none;
        text-decoration: none;
        color: #ffffff;
    }

    .t-d-none{
        text-decoration: none;
    }

    .p-0 {
        padding: 0;
    }

    .fw-bold{
        font-weight: bold;
    }
    ';
    return $css;
}
// function verifiedCss(){

// }

function headerCss(){

    $css = commonCss();
    $css .= '
    /* ============== */
    .ts-td1-img-div h1{
        margin: 0px;
        color: #843fa1;
        line-height: 140%;
        text-align: center;
        word-wrap: break-word;
        font-weight: normal;
        font-size: 25px;
    }
    .ts-td1-img-div p{
        color: #3598db;
        font-size: 22px;
        line-height: 1;
        margin: 5px 0px 38px;
    }
    /* ============== */

    .ts-td-image {
        width: 270px;
        max-width: 100%;
        height: auto;
        border: none;
        text-decoration: none;
        color: #ffffff;
    }
    
    .ts-td2-text-div {
        padding-bottom: 0px !important;
        padding: 20px 10px;
        background-color: #e7e7e74a;
    }
    /* ============== */

    .ts-td2-text-div-p{
        color: #000000;
        font-family: arial,helvetica,sans-serif;
        font-size: 14px;
        line-height: 21px;
    }
    .ts-td2-text-div strong{
        font-size: 12px;
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
    
    .ts-td4-img-section a{
        box-sizing: border-box;
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
    .ts-td4-img-section strong{
        display: block;
        padding: 6px 20px;
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
    
    ';
    return $css;
}



function mailFooter(){
    $body = '
        <style>
        /* FOOTER DIVISION CSS STARTS */
        /* footer */
        .ts-td7-footer-div {
            padding: 0px;
            text-align: center;
            font-size: 12px;
            background-color: #f3b165;
        }
        .footer-text-address{
            margin-bottom: 2rem;
            margin-top: 2rem;
        }
        .footer-text-address h1{
            font-size: 2rem;
            color: darkblue;
            border-bottom: 2px solid #003399;
            padding-bottom: 5px;
            width: fit-content;
            margin: auto;
            margin-bottom: 20px;
        }
        .footer-text-address p{
            margin: 0;
            font-size: 14px;
            line-height: 1.4;
        }
        .social-icons-div{
            background: darkblue;
                padding: 12px;
                margin: 0px;
        }
        .social-icons-div a{
            text-decoration:none;
        }
        .social-icons-div img{
            display:inline-block;
            padding: 4px;
            vertical-align: sub !important;
        }
    </style>
        <tr>
            <td class="ts-td7-footer-div">
                <div class="footer-text-address">
                    <h1>Get In Touch</h1>
                    <div>
                        <p>Barasat, Kolkata, West Bengal, 700125, India</p>
                        <p style="font-size: 15px; font-weight: 600; line-height: 23.8px; text-align: center;">
                            <a class="t-d-none" style="color: #000;" rel="noopener" href="tel:'.SITE_CONTACT_NO.'" target="_blank">
                            '.SITE_CONTACT_NO.'
                            </a>
                        </p>
                        <p style="font-size: 15px; font-weight: 600; line-height: 23.8px; text-align: center; color: #fff;">
                            <a style="text-decoration: none; color: #000;" rel="noopener" href="tel:'.SITE_BILLING_CONTACT_NO.'" target="_blank">
                            '.SITE_BILLING_CONTACT_NO.'
                            </a>
                        </p>
                        <p style="font-size: 15px; font-weight: 600; line-height: 23.8px; text-align: center;">
                            <a style="text-decoration: none;" rel="noopener" href="mailto:'.SITE_EMAIL.'" target="_blank">
                            '.SITE_EMAIL.'
                            </a>
                        </p>
                        <p style="font-size: 15px; font-weight: 600; line-height: 23.8px; text-align: center;">
                            <a style="text-decoration: none;" rel="noopener" href="mailto:'.SITE_BILLING_EMAIL.'" target="_blank">
                            '.SITE_BILLING_EMAIL.'
                            </a>
                        </p>
                    </div>

                </div>

                <p class="social-icons-div">
                    <a href="'.FB_LINK.'" title="Facebook" target="_blank">
                        <img src="https://fastlinky.com/images/icons/social-media-icons/facebook2x.png" width="35" height="35" alt="facebook">
                    </a>
                    <a href="'.TWITTER_LINK.'" title="Twitter" target="_blank">
                        <img src="https://fastlinky.com/images/icons/social-media-icons/twitter2x.png" width="35" height="35" alt="t">
                    </a>
                    <a href="'.LINKDIN_LINK.'" title="Linkedin" target="_blank">
                        <img src="https://fastlinky.com/images/icons/social-media-icons/linkedin2x.png" width="35" height="35" alt="Li">
                    </a>
                    <a href="'.INSTA_LINK.'" title="Instagram" target="_blank">
                        <img src="https://fastlinky.com/images/icons/social-media-icons/instagram2x.png" width="35" height="35" alt="insta">
                    </a>
                </p>
            </td>
        </tr>
    ';
    return $body;
}




echo welcomeMailToUser('Suman', 'salkdjmfcksauhdfcjvudhsrfvynhduh');
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

    <style>';
    $body .= headerCss();
    $body .= '</style>

</head>

<body>
    <div role="article" aria-roledescription="email" lang="en" class="maindivofpage">
        <table role="presentation" class="table-first">
            <tr>
                <td align="center" style="padding:0;">
                    <table role="presentation" class="table-second">
                        <!-- **************************  LOGO IMAGE SECTION ************************ -->
                        <tr>
                            <!--|| ts=table-second ||  -->
                            <td class="ts-td1-img-div fw-bold">
                                <h1> <strong> Hi '.$fistName.'!</strong></h1>
                                <p>
                                    <strong>Welcome to '.COMPANY_FULL_NAME.'</strong>
                                </p>
                            </td>
                        </tr>
                        <!-- **************************  LOGO IMAGE SECTION ENDS ************************ -->
                        <tr>
                            <td class="p-0">
                                <a href="#" style="text-decoration:none;">
                                    <div style="background: #f3b165;" class="">
                                        <img class="ts-td3-image" src="images/verify-welcome.png"
                                            width="480" alt="">
                                    </div>

                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="ts-td2-text-div">
                                <p class="ts-td2-text-div-p" style="margin:0;">
                                    <span style="font-family: Cabin, sans-serif;">
                                    We have received your registration on our site and we are excited to have you join our community. In order to ensure the security of your account and to keep our site safe for all users, we kindly request that you verify your account.
                                    </span>


                                </p>
                                <p class="ts-td2-text-div-p" style="text-align: left;"><strong>Click on the verify button bellow or copy the link to another tab to verify your account:</strong></p>
                                <p class="ts-td2-text-div-p" style="color: #3a47f8;margin: 2px;text-align: center;">
                                '.$verifyLink.'
                                </p>

                            </td>
                        </tr>
                        <tr>
                            <td class="ts-td4-img-section">
                                <div style="text-align: center;">
                                    <a href="'.$verifyLink.'" target="_blank">
                                        <strong class="">Verify</strong>
                                    </a>
                                </div>
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


echo VerifiedMailtoUser();

function VerifiedMailtoUser(){
    $body = '
            <!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
            
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <meta name="x-apple-disable-message-reformatting">
                <title></title>
                <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
                <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
                <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
                <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">

                <style>';
        $body .= commonCss();
        $body .= '
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
            width: 100%;
            height: auto;
            display: block;
            border: none;
            text-decoration: none;
            color: #363636;
        }
        
        .ts-td4-img-section {
            padding: 35px 30px 11px 30px;
            font-size: 0;
            border-bottom: 1px solid #f0f0f5;
            border-color: rgba(201, 201, 207, .35);
        }
        
        .col-sml {
            display: inline-block;
            width: 100%;
            max-width: 145px;
            vertical-align: top;
            text-align: left;
            font-family: Arial, sans-serif;
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
            font-family: Arial, sans-serif;
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
            font-family: Arial, sans-serif;
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
            
            <body>
                <div role="article" aria-roledescription="email" lang="en" class="maindivofpage">
                    <table role="presentation" class="table-first">
                        <tr>
                            <td align="center" class="p-0">
                                <table role="presentation" class="table-second">
                                    <!-- **************************  LOGO IMAGE SECTION ************************ -->
                                    <tr>
                                        <!--|| ts=table-second ||  -->
                                        <td class="ts-td1-img-div">
                                            <a href="#" style="text-decoration:none;">
                                                <img class="ts-td-image" src="'.LOGO_WITH_PATH.'" width="300" alt="Logo">
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- **************************  LOGO IMAGE SECTION ENDS ************************ -->
                                    <tr>
                                        <td class="ts-td3-img-div fw-bold p-0">
                                            <a href="#" style="text-decoration:none;">
                                                <img class="ts-td3-image" src="images/emails-img1.png" width="600" alt="">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ts-td2-text-div">
                                            <h1 class="ts-td2-text-div-h1">
                                                Congratulations! Your Account is Verified</h1>
                                            <p class="ts-td2-text-div-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                                tempus
                                                adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor,
                                                nisi
                                                libero ultricies ipsum, in posuere mauris neque at erat.
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ts-td4-img-section">
                                            <div class="col-sml">
                                                <img class="col-sml-img" src="images/email-verify.png" width="115" alt="">
                                            </div>
                                            <div class="col-lge">
                                                <p class="col-lge-p1">Nullam mollis sapien vel cursus
                                                    fermentum. Integer porttitor augue id ligula facilisis pharetra. In eu ex et
                                                    elit ultricies ornare nec ac ex. Mauris sapien massa, placerat non venenatis et,
                                                    tincidunt eget leo.</p>
                                                <p class="col-lge-p2" style="">Nam non ante risus. Vestibulum vitae
                                                    eleifend nisl, quis vehicula justo. Integer viverra efficitur pharetra. Nullam
                                                    eget erat nibh.</p>
                                                <p class="col-lge-p3">
                                                    <a href="#" class="col-lge-p3-atag">
                                                        <span class="col-lge-p3-span">Claim yours now</span>
                                                    </a>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ts-td6-text-div">
                                            <p style="margin:0;">Duis sit amet accumsan nibh, varius tincidunt lectus. Quisque
                                                commodo, nulla ac feugiat cursus, arcu orci condimentum tellus, vel placerat libero
                                                sapien et libero. Suspendisse auctor vel orci nec finibus.</p>
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


?>