<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/image.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/search.class.php");
include_once('../classes/image.class.php');
require_once("../classes/customer.class.php");


require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/pagination.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$search_obj		= new Search();
$album			= new Album();
$photo  		= new Photo();
$customer	    = new Customer();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$page			= new Pagination();

#########################################################################################

//declare type 
$typeM		= $utility->returnGetVar('typeM','');
$image_id	= $utility->returnGetVar('image_id',0);

$numEntry 	= $utility->getNoOfEntry($image_id, 'im_id', 'album_image');

$imgDtl		= $photo->showImage($image_id);
$vName		= $imgDtl[15];
$vTitle		= $imgDtl[1];


?><head>
<title><?php echo COMPANY_S; ?> - View Video</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" />

<link href="../skin/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.jplayer.min.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function(){

	// Local copy of jQuery selectors, for performance.
	var jpPlayTime = $("#jplayer_play_time");
	var jpTotalTime = $("#jplayer_total_time");

	$("#jquery_jplayer").jPlayer({
		ready: function () {
			this.element.jPlayer("setFile", "../images/gallery/audio/<?php echo $vName; ?>").jPlayer("play");
		},
		volume: 50,
		/*oggSupport: ,*/
		swfPath: "../js",
		preload: 'none'
	})
	.jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
		jpPlayTime.text($.jPlayer.convertTime(playedTime));
		jpTotalTime.text($.jPlayer.convertTime(totalTime));
	})
	.jPlayer("onSoundComplete", function() {
		this.element.jPlayer("play");
	});
});
-->
</script>

</head>

	
<div align="">
    	<div class=" invoiceFont mar10 padB10 bdrB" align="center"><?php echo $vTitle; ?></div>
		<!--Video Column -->
        <div class=" padL20">
            <div id="jquery_jplayer"></div>
    
            <div class="jp-single-player">
                <div class="jp-interface">
                    <ul class="jp-controls">
                        <li><a href="#" id="jplayer_play" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="#" id="jplayer_pause" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="#" id="jplayer_stop" class="jp-stop" tabindex="1">stop</a></li>
                        <li><a href="#" id="jplayer_volume_min" class="jp-volume-min" tabindex="1">min volume</a></li>
                        <li><a href="#" id="jplayer_volume_max" class="jp-volume-max" tabindex="1">max volume</a></li>
                    </ul>
                    <div class="jp-progress">
                        <div id="jplayer_load_bar" class="jp-load-bar">
                            <div id="jplayer_play_bar" class="jp-play-bar"></div>
                        </div>
                    </div>
                    <div id="jplayer_volume_bar" class="jp-volume-bar">
                        <div id="jplayer_volume_bar_value" class="jp-volume-bar-value"></div>
                    </div>
                    <div id="jplayer_play_time" class="jp-play-time"></div>
                    <div id="jplayer_total_time" class="jp-total-time"></div>
                </div>
                <div id="jplayer_playlist" class="jp-playlist">
                    <ul>
                        <li><?php echo $vTitle; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Close -->
        <div class="invoiceFont mar20 padT10 bdrT" align="center">
		<input name="btnCancel" type="button" class="button-cancel" id="btnCancel"
			onClick="self.close()" value="close" />
        </div>
        

	</div>	
		
		
	
	