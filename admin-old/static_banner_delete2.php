<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/pagination.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 



/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

########################################################################################################


//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');
$bannerDtl		= $stat->getStaticBannerDataById($id);
$static_id		= $bannerDtl[7];
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 10);

//delete from database
$stat->deleteStaticBanner($id, "../images/static/banner/");
?>
<div id="banner-del-sucess"></div>
Banner deleted sucessfully
<div id="data-column">
    <table class="single-column" cellpadding="0" cellspacing="0">

        <!-- SHOWING ALL CONTENT -->
         <?php 
         $bannerIds		= $stat->getStaticBannerId($static_id);
         //check number of rows
         if(count($bannerIds) == 0)
         {
         ?>
         <tr align="left">
           <td height="20" colspan="7"> <?php echo "No banner has been added for this content.";?> </td>
         </tr>
        <?php 
        }
        else
        {
        ?>  
        <thead>
          <th width="4%">id</th>
          <th width="20%">Title</th>
          <th width="30%">Banner</th>
          <th width="14%">Open In</th>
          <th width="12%">Added On </th>
          <th width="20%">Action</th>
          </thead>
          
        <?php 
           $i	= $pages->getPageSerialNum($numResDisplay);
           
            foreach($bannerIds as $k)
            {
                $bannerDtl 	= $stat->getStaticBannerData($k, $static_id);
                $bgColor 	= $utility->getRowColor($i);	
        ?>
            
            <tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
              <td><?php echo $i++; ?></td>
              <td>
                <?php echo $bannerDtl[0]; ?>
              </td>
              <td align="center">
                <?php 
                if(($bannerDtl[2] != '') && (file_exists("../images/static/banner/".$bannerDtl[2])))
                {
                    echo $utility->imageDisplay2("../images/static/banner/", $bannerDtl[2], 50, 150, 0, '', $bannerDtl[0]);
                }
				
                ?>
                </a>
              </td>
              <td><?php echo $bannerDtl[9] ?></td>
              <td>
                <?php echo $dateUtil->printDate($bannerDtl[4]); ?> </td>
              <td>


              
              <?php /*?>[ 
                <a href="javascript:void(0)" 
              onClick="MM_openBrWindow('static_edit_file.php?action=static_edit_file&id=<?php echo $k; ?>','StaticDelete','scrollbars=yes,width=800,height=600')">
              edit					  </a> ]<?php */?>
              
              [ 
                <a href="javascript:void(0)" id="edit-banner<?php echo $k ?>" class="edit-banner" onClick="editBanner('<?php echo $k ?>')" >
              edit					  </a> ]
              
                <?php /*?>[ 
                <a href="javascript:void(0)" 
              onClick="MM_openBrWindow('static_file_delete.php?action=delete&id=<?php echo $k; ?>','StaticDelete','scrollbars=yes,width=400,height=300')">
              delete					  </a> ]<?php */?>
              
              [ 
                <a href="javascript:void(0)" id="delete-banner<?php echo $k ?>" class="delete-banner" onClick="deleteBanner('<?php echo $k ?>')" >
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
            <div class="upper-block">Total  Banner(s): <?php echo count($bannerIds);?></div>
        </div>
      <div class="cl"></div>
      
  </div>
</div>
<div id="edit-banner">
</div>