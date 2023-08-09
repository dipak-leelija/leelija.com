<?php 
session_start();
include_once('checkSession.php');
include_once('../_config/connect.php'); 

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Welcome to Admin Control Panel</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="
 ">
  <tr>
    <td><?php require_once('header.inc.php'); ?></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="160" valign="top"><?php require_once('menu.inc.php'); ?></td>
        <td align="center" valign="top" class="maroonErrorLarge">Error 404 : The page you are looking for could not be found.
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php require_once('footer.inc.php'); ?></td>
  </tr>
</table>
</body>
</html>
