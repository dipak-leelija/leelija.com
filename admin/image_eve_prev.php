<?php
require_once("../includes/constant.inc.php");  

$upload_dir = URL.'images/static/download/'; 
//echo $upload_dir ; exit;
// Directory for file storing
$preview_url = URL.'images/static/download/';
$filename= '';

$result = 'ERROR';
$result_msg = '';
//$allowed_image = array ('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg','image/png');
$allowed_doc	= array('text/plain', 'application/msword',  'application/doc', 'application/docx', 'application/txt', 
						'application/pdf', 'application/postscript', 'application/rtf');
define('PICTURE_SIZE_ALLOWED', 1024000000); // bytes

if (isset($_FILES['txtUploadFile']))  // file was send from browser
{
	
 if ($_FILES['txtUploadFile']['error'] == UPLOAD_ERR_OK)  // no error 
 {
 if (in_array($_FILES['txtUploadFile']['type'], $allowed_doc)) {
 if(filesize($_FILES['txtUploadFile']['tmp_name']) <= PICTURE_SIZE_ALLOWED) // bytes
 {
 $filename = $_FILES['txtUploadFile']['name'];
 move_uploaded_file($_FILES['txtUploadFile']['tmp_name'], $upload_dir.$filename);

//phpclamav clamscan for scanning viruses
//passthru('clamscan -d /var/lib/clamav --no-summary '.$upload_dir.$filename, $virus_msg); //scan virus
$virus_msg = 'OK'; //assume clamav returing OK.
if ($virus_msg != 'OK') {
unlink($upload_dir.$filename);
$result_msg = $filename." : ".FILE_VIRUS_AFFECTED;
$result_msg = '<font color=red>'.$result_msg.'</font>';
$filename = '';

}else {
// main action -- move uploaded file to $upload_dir
$result = 'OK';
}
}else {
$filesize = filesize($_FILES['txtUploadFile']['tmp_name']);// or $_FILES['picture']['size']
$filetype = $_FILES['txtUploadFile']['type'];
$result_msg = PICTURE_SIZE;
}
}else {
$result_msg = SELECT_IMAGE;
}
}
elseif ($_FILES['txtUploadFile']['error'] == UPLOAD_ERR_INI_SIZE)
$result_msg = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
else
$result_msg = 'Unknown error';
}

// This is a PHP code outputing Javascript code.
echo '<script language="JavaScript" type="text/javascript">'."\n";
echo 'var parDoc = window.parent.document;';
if ($result == 'OK') {
echo 'parDoc.getElementById("picture_error").innerHTML =  "";';
}
else {
echo "parDoc.getElementById('picture_error').innerHTML = '".$result_msg."';";
}

if($filename != '') {
echo "parDoc.getElementById('picture_preview').innerHTML = '".$filename." <input type=\"button\" class=\"button-cancel\" name=\"cancel_button\" id=\"cancel_button\" value=\"cancel\" onclick=\"deleteFile()\" />';";//	
}
echo "\n".'</script>';
exit(); // do not go futher
//<img src=\'$preview_url$filename\' id=\'preview_picture_tag\' heigh=\'80\' width=\'90\' name=\'preview_picture_tag\' />

//
?>