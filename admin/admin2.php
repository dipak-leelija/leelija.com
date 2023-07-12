<?php 
session_start();
include_once('checkSession.php');
include_once('../_config/connect.php'); 

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Admin Control Panel</title>
    
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<script type="text/javascript">
function startTime()
{
	var today=new Date();
	d=today.toString('dddd, MMMM ,yyyy');
	//document.getElementById('server-date').innerHTML= d;
	t=setTimeout('startTime()',500);
}

function checkTime(i)
{
	if (i<10)
  	{
  		i="0" + i;
 	}
	return i;
}
</script>

</head>

<body onload="startTime()">
	
    <!-- Header -->
	<?php require_once('header.inc.php'); ?>
    
    <!-- Container -->
    <div class="container">
        <div class="inner-container">
        	<div id="admin-menu">
				<?php require_once('menu.inc.php'); ?>
            </div>
            <div id="admin-body">
            	<div id="admin-top">
					&nbsp;
                </div>
                <?php require_once('admin_body.inc.php'); ?>
            </div>
            <div class="cl"></div>
        </div>  
    </div>
    <!-- eof Container -->
    
    <!-- Footer -->
	<?php require_once('footer.inc.php'); ?>
</body>
</html>