<?php 
//get album location data
$album_id 	 = 0;

if(isset($_GET['album_id']))
{
	$album_id  		= $_GET['album_id'];
	$albumDetail 	= $album->showAlbum($album_id);
}

//get the sort order
$numOrder	= $uNum->genSortOrderNum('Y', $_GET['album_id'], 'categories_id', 1, 'album_image');

?>



  <form action="<?php echo $_SERVER['PHP_SELF']."?action=addImage"?>" method="post" enctype="multipart/form-data" 
  name="formAddImage" id="formAddImage">
  
	
	<label>Photographer </label>
	   	<select name="cusId" class="textBoxA" id="cusId">
         <option value="0">-- <?php echo COMPANY_S; ?> --</option>
        </select>
        <div class="cl"></div>
        
    <label>Select Album <span class="orangeLetter">*</span></label>
		<select name="album_id" id="album_id" class="textBoxA">
			<?php 
                if(isset($_SESSION['album_id']))
                {
                   $utility->populateDropDown($_SESSION['album_id'], 'categories_id', 
				   							  'categories_name','album'); 
                }
                else if(isset($_GET['album_id']))
                {
                    $utility->populateDropDown($_GET['album_id'], 'categories_id', 
											   'categories_name','album');
                }
                else
                {
                    $utility->populateDropDown($albumId,'categories_id','categories_name','album');
                }
            ?>
        </select>      
		<div class="cl"></div>
        
		<label>>Meddia Type</label>
		<?php 
        $arr_value	= array('IMG', 'VIDEO', 'AUDIO'); 
        $arr_label  = array('Image', 'Video', 'Audio');
        
        ?>
        <select name="selMediaType" id="selMediaType" class="textBoxA">
        <?php 
            if(isset($_SESSION['selMediaType']))
            {
               $utility->genDropDown($_SESSION['selMediaType'], $arr_value, $arr_label); 
            }
            else if(isset($_GET['selMediaType']))
            {
                $utility->genDropDown($_GET['selMediaType'], $arr_value, $arr_label); 
            }
            else
            {
                $utility->genDropDown('IMG', $arr_value, $arr_label);
            }
            
        ?>
        </select>
		<div class="cl"></div>
	
	 <label>Title <span class="orangeLetter">*</span></label>
      	<input name="txtName" type="text" id="txtName" class="text_box_large" 
		value="<?php $utility->printSess('txtName'); ?>">	
		<div class="cl"></div>
	
	<label>Sort Order</label>
	  	<input name="intOrder" type="text" class="text_box_large" id="intOrder"
		 value="<?php $utility->printSess2('intOrder', $numOrder); ?>" maxlength="3"  
		 onKeyPress="return intOnly(this, event)"/>
		 (integer from 1 to 999)
         <div class="cl"></div>
         	
  	<label>Photoshot/Work On</label>
	  	<div class="fl">
		 <input name="dateShotOn" type="text" class="text_box_large" id="dateShotOn" readonly=""
		 value="<?php $utility->printSess2('dateShotOn', date("Y-m-d H:i:s")); ?>" />
		 </div>
		 <div class="fl padT2 padL5">
		  <a title="Select Date from Calendar" style="cursor:pointer; "
		  onClick="displayCalendar(document.formAddImage.dateShotOn,'yyyy-mm-dd',this); return false;"> 
			<img src="../js/js_calendar/images/cal.gif" width="16" height="16" 
			class="curP" value="Cal" /></a>
         </div>
		 <div class="cl"></div>
    
    
	<label>Image Description</label>
      	<textarea name="txtDesc" cols="60" rows="9" id="txtDesc" class="textAr">
		<?php $utility->printSess('txtDesc'); ?>
        </textarea>      
		<div class="cl"></div>
	
	<label>Photograph <span class="orangeLetter">*</span></label>
      	<input type="file" name="fileImage" id="fileImage" class="text_box_large" />
		<span class="orangeLetter">Best Size 800 px width &times; 800 px height </span>
        <div class="cl"></div>
    
    <label>Media File-Video/Audio</label>
    <td height="20" colspan="2" align="left" class="pad5"><input type="file" name="fileMedia" id="fileMedia" class="text_box_large" />
    (For Video and Audio Only, Use above photograph field to upload the thumbnail)
   <div class="cl"></div>
   
   	 <label>&nbsp;</label>
	 <label>&nbsp;</label>
     <div class="cl"></div>
	
	  <input name="btnAddImage" type="submit" class="button-add" id="btnAddImage"  value="add" />
	  <input name="btnCancel" type="submit" class="button-cancel" id="btnCancel"  value="cancel" />	 
	  
  
  </form>

