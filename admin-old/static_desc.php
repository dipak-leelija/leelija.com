<?php 
session_start();
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 

require_once("../classes/static.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php");

/* INSTANTIATING CLASSES */
$stat			= new StaticContent();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


?>



<!-- TinyMCE --> 
 <script type="text/javascript" src="../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "image,fontsizeselect,forecolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,bullist,numlist,|,outdent,indent",
		theme_advanced_buttons2 :
"undo,redo,|,emotions,|,pasteword,code",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		formats : {
			alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
			aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
			alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
			alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
			bold : {inline : 'span', 'classes' : 'bold'},
			italic : {inline : 'span', 'classes' : 'italic'},
			underline : {inline : 'span', 'classes' : 'underline', exact : true},
			strikethrough : {inline : 'del'}
		},

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

<?php 

if( (isset($_GET['selNum'])) && ($_GET['selNum'] > 0)  && ($_GET['selNum'] <= 10))
{
	$selNum		= $_GET['selNum'];

	if($selNum > 0)
	{
		for($k = 0; $k < $selNum; $k++)
		{
			$j = $k+1;
			
			//hold title in session
			if(isset($_SESSION['txtSubTitle'][$k]))
			{
				$txtSubTitle[$k]	= $_SESSION['txtSubTitle'][$k];
			}
			else
			{
				$txtSubTitle[$k]	= '';
			}
			
			//hold description in session
			if(isset($_SESSION['txtSubDesc'][$k]))
			{
				$txtSubDesc[$k]		= $_SESSION['txtSubDesc'][$k];
			}
			else
			{
				$txtSubDesc[$k]		= '';
			}
			
			//hold description in session
			if(isset($_SESSION['txtSubImgTitle'][$k]))
			{
				$txtSubImgTitle[$k]	= $_SESSION['txtSubImgTitle'][$k];
			}
			else
			{
				$txtSubImgTitle[$k]	= '';
			}
			
			//hold image width and image height in session
			if(isset($_SESSION['intSubImgW'][$k]))
			{
				$intSubImgW[$k]	= $_SESSION['intSubImgW'][$k];
			}
			else
			{
				$intSubImgW[$k]	= '200';
			}
			
			if(isset($_SESSION['intSubImgH'][$k]))
			{
				$intSubImgH[$k]	= $_SESSION['intSubImgH'][$k];
			}
			else
			{
				$intSubImgH[$k]	= '200';
			}
			
			
			//image position
			if(isset($_SESSION['selSubImgPos'][$k]))
			{
				$selSubImgPos[$k]	= $_SESSION['selSubImgPos'][$k];
			}
			else
			{
				$selSubImgPos[$k]	= 'center';
			}
			$arr_value	= array('left','center','right'); 
			$arr_label	= array('left','center','right');
			?>
            <h3>Section [<?php echo $selNum ?>]</h3>
            <label>Title<span class="orangeLetter">*</span></label>
            <input name="txtSubTitle[]" type="text" class="text_box_large" id="txtSubTitle[]" value="<?php echo $txtSubTitle[$k] ?>" size="50" />
            <div class="cl"></div>
            
            <label>Description<span class="orangeLetter">*</span></label>
            <textarea  name="txtSubDesc[]" id="txtSubDesc'.$k.'"  class="textAr padB20"><?php echo $txtSubDesc[$k] ?></textarea>
            <div class="cl"></div>
            
            <label>Image Title</label>
            <input name="txtSubImgTitle[]" type="text" class="text_box_large" id="txtSubImgTitle[]" value="<?php echo $txtSubImgTitle[$k] ?>" 
            size="50" />
            <div class="cl"></div>
            
            <label>Image</label>
            <input name="fileSubImg[]" type="file" class="text_box_large" id="fileSubImg[]"> (max 800 X 800 pixels in width by height)
            <div class="cl"></div> 
            
            <label>Image width</label>
            <input name="intSubImgW[]" type="text" class="text_box_large" id="intSubImgW[]" maxlength="4" size="6" 
			value="<?php echo $intSubImgW[$k] ?>" />
            <div class="cl"></div>
            
            <label>Image Height</label>
            <input name="intSubImgH[]" type="text" class="text_box_large" id="intSubImgH[]" maxlength="4" size="6"
			value="<?php echo $intSubImgH[$k] ?>" />
            <div class="cl"></div>
            
            <label>Image Position</label>
            <select name="selSubImgPos[]" class="textBoxA">
                <option value="left">left</option>
                <option value="center">center</option>
                <option value="right">right</option>
            </select>
            <div class="cl"></div>
                       
			<?php 
		}//for
	}//if

}
else
{
	//echo NRSPAN.$uMesg->dispMesgImg('ERROR', '../images/icon/', 'error.gif').ERSTCON003.ENDSPAN;
}


?>