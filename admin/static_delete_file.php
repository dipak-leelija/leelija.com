<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/pagination.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();

/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');

$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 10);

$downloadDtl	= $stat->getContentDownloadData($id);

if($title == '')
{
	echo "Title is empty~";
}
else
{
	$stat->updateDownloadContent($id, $downloadDtl[0], $title, $pagePos, $linkAlign, $status, $intSort);
	echo "sucess~";
}
$static_id		= $downloadDtl[0];
?>
File updated sucessfully
<div id="data-column">
    <table class="single-column" cellpadding="0" cellspacing="0">

        <!-- SHOWING ALL CONTENT -->
         <?php 
         $downloadIds		= $stat->getContentDownloadId($static_id, 'static_id');
         //check number of rows
         if(count($downloadIds) == 0)
         {
         ?>
         <tr align="left">
           <td height="20" colspan="7"> <?php echo "No file has been added for this content.";?> </td>
         </tr>
        <?php 
        }
        else
        {
        ?>  
        <thead>
          <th width="4%">id</th>
          <th width="28%">Title</th>
          <th width="13%">File</th>
          <th width="23%">Page Position</th>
          <th width="12%">Added On </th>
          <th width="20%">Action</th>
          </thead>
          
        <?php 
           $i	= $pages->getPageSerialNum($numResDisplay);
           
            foreach($downloadIds as $k)
            {
                $downloadDtl 	= $stat->getContentDownloadData($k);
                $bgColor 	= $utility->getRowColor($i);	
        ?>
            
            <tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
              <td><?php echo $i++; ?></td>
              <td>
                <?php echo $downloadDtl[1]; ?>
              </td>
              <td align="center">
                <?php 
                if(($downloadDtl[8] != '') && (file_exists("../images/static/download/".$downloadDtl[8])))
                {
                    $fileLink		= "../images/static/download/".$downloadDtl[8];
                }
                else
                {
                    $fileLink		= "javascript:void(0)";
                }
                ?>
                
                <a href="<?php echo $fileLink ?>" target="_blank">
                <?php 
                $fileType		= $utility->getFileExtension($downloadDtl[8]);
                if($fileType == 'pdf')
                {
                    ?>
                    <img src="../images/icon/pdf.png" width="20" />
                    <?php 
                }
                elseif(($fileType == 'docx') || ($fileType == 'doc'))
                {
                    ?>
                    <img src="../images/icon/word.png" width="20" />
                    <?php
                }
                else
                {
                    ?>
                    <img src="../images/icon/text.png" width="20" />
                    <?php
                }
                ?>
                </a>
              </td>
              <td><?php echo $downloadDtl[2] ?></td>
              <td>
                <?php echo $dateUtil->printDate($downloadDtl[6]); ?> </td>
              <td>


              
              <?php /*?>[ 
                <a href="javascript:void(0)" 
              onClick="MM_openBrWindow('static_edit_file.php?action=static_edit_file&id=<?php echo $k; ?>','StaticDelete','scrollbars=yes,width=800,height=600')">
              edit					  </a> ]<?php */?>
              
              [ 
                <a href="javascript:void(0)" id="edit-file<?php echo $k ?>" class="edit-file" onClick="editFile('<?php echo $k ?>')" >
              edit					  </a> ]
              
                <?php /*?>[ 
                <a href="javascript:void(0)" 
              onClick="MM_openBrWindow('static_file_delete.php?action=delete&id=<?php echo $k; ?>','StaticDelete','scrollbars=yes,width=400,height=300')">
              delete					  </a> ]<?php */?>
              [ 
                <a href="javascript:void(0)" id="delete-file<?php echo $k ?>" class="delete-file" onClick="deleteFile('<?php echo $k ?>')" >
              delete					  </a> ]
              
              </td>
             
            </tr>
            
      <?php 
            }
      }
      ?>
      
      
  </table>

  <div class="first-column">
     
        <!-- Bottom Pagination-->
        <div class="pagination-bottom">
            <div class="upper-block">Total  File(s): <?php echo count($downloadIds);?></div>
        </div>
      <div class="cl"></div>
      
  </div>
</div>

<div class="cl"></div>

<div id="edit-file">
</div>