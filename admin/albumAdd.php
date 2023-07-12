<?php 

//get the sort order
if(isset($_GET['txtParentId']))
{
	$numOrder	= $uNum->genSortOrderNum('Y', $_GET['txtParentId'], 'parent_id', 1, 'album');
}
else
{
	$numOrder	= $uNum->genSortOrderNum('Y', 0, 'parent_id', 1, 'album');
}
?>


<form action="<?php echo $_SERVER['PHP_SELF']."?action=addAlbum"?>" method="post" enctype="multipart/form-data" name="formAddAlbum">


 	<label>Select Album<span class="orangeLetter">*</span> </label>
   <td height="30" align="left">
  	<select name="txtParentId" class="textBoxA" id="txtParentId">
	  <option value="0">Top Level</option>
	  <?php
	  if(isset($_GET['txtParentId']))
	  {
		$category->getRootCatList($_GET['txtParentId'], 'album');
	  }
	  elseif(isset($_SESSION['txtParentId']))
	  {
		$category->getRootCatList($_SESSION['txtParentId'], 'album');
	  }
	  else
	  {
		$category->getRootCatList(0, 'album');
	  }
	  ?>
	</select>  
   <div class="cl"></div>
   
  	  <label>Select Type</label>
      <select name="selType" id="selType" class="textBoxA"   onchange="getTypeIdList()" >
        <option value="0">-- Select One --</option>
        <?php 
            if(isset($_SESSION['selType']))
            {
                $utility->populateDropDown($_SESSION['selType'],'constant_code',
                                          'constant_code','album_type'); 
            }
            else if(isset($_GET['selType']))
            {
                $utility->populateDropDown($_GET['selType'],'constant_code',
                                           'constant_code','album_type');
            }
            else
            {
                $utility->populateDropDown(6,'constant_code','constant_code',
                                           'album_type');
            }
            
        ?>
      </select>
 	  <div class="cl"></div>
    
    <div id="dispIdVal">
		<?php 
        if( (isset($_SESSION['selTypeId'])) && (isset($_SESSION['selType'])) )
        {
        $album->genAlbumTypeIds($_SESSION['selType'], $_SESSION['selTypeId']);
        }
        else
        {
        echo "<label>Select One</label>
                <select name='selTypeId' id='selTypeId' class='textBoxA'>
                </select>";
        }
        ?>
    </div>
    <div class="cl"></div>


  	<label>Album Name <span class="orangeLetter">*</span>  </label>
  	 <input name="txtName" type="text" class="text_box_large" id="txtName"
	 value="<?php $utility->printSess2('txtName', ''); ?>" onBlur="verifyAlbumCat()" />  
  	 <span id="resAltCat"></span> 
	<div class="cl"></div>
    
	<label>Sort Order</label>
  	<input name="intOrder" type="text" class="text_box_large" id="intOrder"
	 value="<?php $utility->printSess2('intOrder', $numOrder); ?>" maxlength="3"  
	 onKeyPress="return intOnly(this, event)"/>
	 (integer from 1 to 999)
     <div class="cl"></div>
     
	<label>Photoshot/Work On </label>
  	 <div class="fl">
  	 <input name="dateShotOn" type="text" class="text_box_large" id="dateShotOn" readonly=""
	 value="<?php $utility->printSess2('dateShotOn', date("Y-m-d H:i:s")); ?>" />
	 </div>
	 <div class="fl padT2 padL5">
	  <a title="Select Date from Calendar" style="cursor:pointer; "
	  onClick="displayCalendar(document.formAddAlbum.dateShotOn,'yyyy-mm-dd',this); return false;"> 
		<img src="../js/js_calendar/images/cal.gif" width="16" height="16" 
		class="curP" value="Cal" />	  </a>
	 <div class="cl"></div>
     </div> 
     <div class="cl"></div>
    

	<label>Album Description </label>
  	<textarea name="txtDesc" cols="35" rows="5" class="textAr" id="txtDesc"><?php $utility->printSess2('txtDesc', ''); ?></textarea> 
	<div class="cl"></div>
    
   <label>Album Image</label>
   <input name="fileImage" type="file" class="text_box_large" /> 
	<span class="orangeLetter">(Best Size 100 &times; 75 pixels)</span>
	<div class="cl"></div>
    
    <label>&nbsp;</label>
    <div class="cl"></div>

  <input name="btnAddAlbum" type="submit" class="button-add" id="btnAddAlbum" value="add" /> 
  <input name="btnCancel" type="submit" class="button-cancel" id="btnCancel" value="cancel" />  

</form>