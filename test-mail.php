<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once "includes/constant.inc.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


<?php

    $to         = 'Dipak Majumdar <dipakmajumdar.leelija@gmail.com>';
    $from       = 'Rahul Majumdar <rahulmajumdar400@gmail.com>';
    $fromMail   = 'rahulmajumdar400@gmail.com';
	$subject    = 'This is a Testing Mail - '.date("d-m-Y");

    echo $body = "<div style='font-family: Poppins, Verdana, Arial, Helvetica,
					sans-serif;
					font-size: 11px;
					color: #000000;
                    display: grid;
                    justify-content: center;
					'>

        <div style='margin-bottom:20px;'>
            <div style='text-align: center;'>
                <img src='".LOGO_WITH_PATH."' width='".LOGO_WIDTH."' height='".LOGO_HEIGHT."' />
            </div>

            <!-- <div style='clear:right'></div> -->
        </div>

        <div>

            <h2 align='left'
                style='padding-bottom:40px; font-family: Poppins, Arial, Helvetica, sans-serif; color: #000000;font-style: normal;font-weight: 900; text-align: center;'>
                Order from - Data Here</h2>

            <h3 style='margin:0 0 20px 0; font-weight:bold'>Personal Detail</h3>
            <div style='margin:0 0 40px 0'>
                <table width='545' style=' font-size: 11px; border:1px solid #666666'>
                    <tr>
                        <td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>NAME: </td>
                        <td style='border-bottom:1px solid #666666;'>&nbsp;
                            'Data Here'
                        </td>
                    </tr>
                    <tr>
                        <td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>EMAIL: </td>
                        <td style='border-bottom:1px solid #666666;'>&nbsp;
                            'Data Here'
                        </td>
                    </tr>
                    <tr>
                        <td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>BUSINESS NAME: </td>
                        <td style='border-bottom:1px solid #666666;'>&nbsp;
                            'Data Here'
                        </td>
                    </tr>
                    <tr>
                        <td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CITY: </td>
                        <td style='border-bottom:1px solid #666666;'>&nbsp;
                            'Data Here'
                        </td>
                    </tr>
                    <tr>
                        <td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>STATE: </td>
                        <td style='border-bottom:1px solid #666666;'>&nbsp;
                            'Data Here'
                        </td>
                    </tr>

                    <tr>
                        <td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>POSTAL CODE: </td>
                        <td style='border-bottom:1px solid #666666;'>&nbsp;
                            'Data Here'
                        </td>
                    </tr>
                    <tr>
                        <td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PHONE: </td>
                        <td style='border-bottom:1px solid #666666;'>&nbsp;
                            'Data Here'
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div>This is a Auto Generated Mail From === During Client Order.</div>

    </div>";


    //normal mail
	$headers  = "From: ".$from."\r\n";
	$headers .= "Return-Path: <".$fromMail.">\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1";
    $headers .= "MIME-Version: 1.0" . "\r\n";

	mail($to, $subject, $body, $headers);

?>
</body>

</html>