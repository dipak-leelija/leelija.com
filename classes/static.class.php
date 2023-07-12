<?php 
/**
*	This class will work with static contents of the website like about us and other static pages.
*
*	Update January 21, 2012
*	Added section to display content or from Admin
*
*	Update October 14, 2011
*	Added display height and display width in static detail table
*	
*	UPDATE October 10, 2011
*	Added upload download file system along with the CMS, so that we do not need manage upload download files
*	forms separately.
*
*	UPDATE September 22, 2011
*	1) Added image size manipulation based on per page
*	2) Page tile for all pages
*	3) Introduction of SEO friendly URL for url rewriting
*	4) SEO friendly content by introducing meta title, meta keyword and meta tags
*
*
*	UPDATE March 30, 2011
*	Link to youtube video or other video has been added to classified table
*
*
*	@author     	Himadri Shekhar Roy
*	@date   	 	April 03, 2009
*	@version 		2.0
*	@copyright 		Analyze System 
*	@email			info@ansysoft.com
*
* 
*/

include_once("utility.class.php");

class StaticContent extends Utility
{	
	// use DBConnection;
	############################################################################################################
	#
	#													Static 
	#
	############################################################################################################
	
	/**
	* 	Add a new Static content
	*
	*	@update	March 30, 2011, September 22, 2011	
	*
	*	@update August 29, 2012
	*	Added a section that is going to identify the sub content of a main content through Parent Static Id;  
	*	e.g. Diploma courses belongs to main category Courses. 
	*		
	*	@param
	*			$categories_id	Categories Id
	*			$psId			Parent Static Id // August 29, 2012
	*			$title			Static content title
	*			$page_title		Page title if it is different from original title
	*			$seo_url		SEO friendly url
	*			$brief			Brief about the static content usable to display in the small area
	*			$description	Description of the content
	*			$image_title	Title of the image
	*			$image_position Position of image
	*			$sort_order		Sorting order
	*			$disp_w			Display width of the image
	*			$disp_h			Display height of the image
	*			$meta_title		Meta Title
	*			$meta_keyword	Meta keywords
	*			$meta_desc		Meta description
	*			$canonical		SEO Canonical
	*	@return	int
	*/
	function addStatic($categories_id, $psId, $title, $page_title, $seo_url, $url, $brief, $description, $image_title, $image_position, 
					   $sort_order, $disp_w, $disp_h, $meta_title, $meta_keyword, $meta_desc, $display_banner, $dis_slide_show,$canonical)
	{
		//security
		$title			= trim(mysql_real_escape_string($title));
		$page_title		= trim(mysql_real_escape_string(strip_tags($page_title)));
		$brief			= trim(mysql_real_escape_string(strip_tags($brief)));
		$description	= trim(mysql_real_escape_string($description)); 
		$image_title	= trim(mysql_real_escape_string($image_title));
		$meta_title		= trim(mysql_real_escape_string($meta_title));
		$meta_keyword	= trim(mysql_real_escape_string($meta_keyword));
		$meta_desc		= trim(mysql_real_escape_string($meta_desc)); 
		$brief			= trim(mysql_real_escape_string(strip_tags($brief)));
		$canonical		= trim(mysql_real_escape_string(strip_tags($canonical)));
		$sort_order		= (int)$sort_order;
		
		//statement
		$sql 	= "INSERT INTO static
				   (categories_id, parent_static_id, title, page_title, seo_url, url, brief, description, 
				    image_title, image_position, sort_order, display_width, display_height, meta_title, meta_keywords, meta_description,
				    display_banner, dis_slide_show,canonical, added_on)
				   VALUES
				   ('$categories_id', '$psId', '$title', '$page_title', '$seo_url', '$url', '$brief', '$description', 
				    '$image_title', '$image_position', '$sort_order', '$disp_w', '$disp_h', '$meta_title', '$meta_keyword', '$meta_desc', 	
					'$display_banner', '$dis_slide_show', '$canonical',now())";
				    
				    
		
		//execute query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		//get the primary key
		$result = mysql_insert_id();
		
		//return result
		return $result;
	}//eof
	
	
	/**
	* 	Add a new Static content detail
	*	
	*	@param
	*			$static_id		Static id associated with static contents
	*			$title			Static content title
	*			$brief			Brief about the static content usable to display in the small area
	*			$description	Description of the content
	*			$image_title	Title of the image
	*			$sort_order		Sorting order
	*			$dispW			Display width of the image
	*			$dispH			Display height of the image
	*			
	*	@return	int
	*/
	function addStaticDtl($static_id, $title, $brief, $description, $image_title, $image_position, $dispW, $dispH)
	{
		//security
		$static_id		= (int)$static_id;
		$title			= trim(mysql_real_escape_string($title));
		$brief			= trim(mysql_real_escape_string($brief)); //nl2br()
		$description	= trim(mysql_real_escape_string($description)); //nl2br()
		$image_title	= trim(mysql_real_escape_string($image_title)); 
		
		//statement
		$sql 	= "INSERT INTO static_detail
				   (static_id, title, brief, description, image_title, image_position, display_width, display_height, added_on)
				   VALUES
				   ('$static_id','$title', '$brief', '$description', '$image_title', '$image_position', $dispW, $dispH, now())";
		
		//execute query
		$query	= mysql_query($sql);
		
		/*echo $sql.mysql_error();
		echo "<br/>";*/
		//get the primary key
		$result = mysql_insert_id();
		
		
		
		//return result
		return $result;
	}//eof
	
	
	
	
	/**
	*	Update 	static
	*
	*	@update	March 30, 2011	
	*
	*	@update August 29, 2012
	*	Added a section that is going to identify the sub content of a main content through Parent Static Id;  
	*	e.g. Diploma courses belongs to main category Courses. 
	*
	*	@param
	*			$id					static identity
	*			$psId				Parent Static Id // August 29, 2012
	*			$categories_id		Categories Id
	*			$title				Static content title
	*			$page_title			Page title if it is different from original title
	*			$seo_url			SEO friendly url
	*			$brief				Brief about the static content usable to display in the small area
	*			$description		Description of the content
	*			$image_title		Title of the image
	*			$image_position 	Position of image
	*			$sort_order			Sorting order
	*			$disp_w				Display width of the image
	*			$disp_h				Display height of the image
	*			$meta_title			Meta Title
	*			$meta_keyword		Meta keywords
	*			$meta_desc			Meta description
	*			$canonical			SEO Canonical
	*	@return string
	*/
	function updateStatic($id,$categories_id, $psId,$title, $page_title, $seo_url, $url,  $brief, $description, $image_title, $image_position, 
					      $sort_order, $disp_w, $disp_h, $meta_title, $meta_keyword, $meta_desc, $display_banner, $dis_slide_show,$canonical, $table)
	{
		//security
		$title			= trim(addslashes($title));
		$page_title		= trim(addslashes($page_title));
		$brief			= trim(mysql_real_escape_string($brief)); //nl2br()()strip_tags
		$description	= trim(mysql_real_escape_string($description)); 
		$image_title	= trim(mysql_real_escape_string($image_title));
		$meta_title		= trim(mysql_real_escape_string($meta_title));
		$meta_keyword	= trim(mysql_real_escape_string($meta_keyword));
		$meta_desc		= trim(mysql_real_escape_string($meta_desc)); 
		$canonical		= trim(mysql_real_escape_string($canonical)); 
		$sort_order		= (int)$sort_order;
		
		//statement
		$sql	= "UPDATE ".$table." SET
				  categories_id		='$categories_id',
				  parent_static_id	= '$psId',
				  title 			='$title',
				  page_title		='$page_title',
				  seo_url			='$seo_url',
				  url				='$url',
				  brief				='$brief',
				  description		='$description',
				  image_title		='$image_title',
				  image_position	='$image_position',
				  sort_order		='$sort_order',
				  display_width		='$disp_w',
				  display_height	='$disp_h',
				  meta_title		='$meta_title',
				  meta_keywords		='$meta_keyword',
				  meta_description	='$meta_desc',
				  display_banner	='$display_banner',
				  dis_slide_show	='$dis_slide_show',
				 canonical			='$canonical',
				  modified_on 		= now()
				  WHERE 
				  static_id 		= '$id'
				  ";
				  
		//execute query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		//echo $sql;exit;
		$result = '';
		if(!$query)
		{
			$result = "ER102";
		}
		else
		{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof

	
	/**
	*	Update 	static detail
	*	
	*	@param
	*			$id				Static detail identity
	*			$title			Static content title
	*			$brief			Brief about the static content usable to display in the small area
	*			$description	Description of the content
	*			$image_title	Title of the image
	*			$dispW			Display width of the image
	*			$dispH			Display height of the image
	*
	*	@return string
	*/
	function updateStaticDtl($id, $title, $brief, $description, $image_title, $image_position, $dispW, $dispH)
	{
		//security
		$title			= trim(mysql_real_escape_string($title));
		$brief			= trim(mysql_real_escape_string($brief)); //nl2br()
		$description	= trim(mysql_real_escape_string($description)); //nl2br()
		$image_title	= trim(mysql_real_escape_string($image_title)); 
		
		//statement
		$sql	= "UPDATE static_detail SET
				  title 			='$title',
				  brief				='$brief',
				  description		='$description',
				  image_title		='$image_title',
				  image_position	='$image_position',
				  display_width		= $dispW,
				  display_height	= $dispH,
				  modified_on 		= now()
				  WHERE 
				  static_detail_id	= '$id'
				  ";
				  
		//execute query
		$query	= mysql_query($sql);
		
		//echo $sql;exit;
		$result = '';
		if(!$query)
		{
			$result = "ER102";
		}
		else
		{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof
	
	
	
	
	/**
	*	Delete a static from the database
	*
	*	@param 
	*			$id			static id
	*			$path		Path to the images
	*
	*	@return string
	*/
	function deleteStatic($id, $path)
	{
		//delete the image first
		$this->deleteFile($id, 'static_id' , $path, 'image', 'static');
		
		//get all static detail id
		$statDtlIds	= $this->getStaticDtlId($id);
		
		if( count($statDtlIds) > 0 )
		{
			//loop to delete the static detail files
			foreach($statDtlIds as $k)
			{
				$this->deleteStaticDtl($k, $path);
			}//foreach
		}
		
		//delete from static
		$sql	= "DELETE FROM static WHERE static_id='$id'";
		$query	= mysql_query($sql);
		
		$result = '';
		if(!$query)
		{
			$result = "ER103";
		}
		else
		{
			$result = "SU103";
		}
		
		//return the result
		return $result;
	}//eof
	
	
	/**
	*	Delete a static detail
	*
	*	@param 
	*			$id			Static id
	*			$path		Path to the images
	*
	*	@return string
	*/
	function deleteStaticDtl($id, $path)
	{
		//delete the image first
		$this->deleteFile($id, 'static_detail_id' , $path, 'image', 'static_detail');
		
		//delete from static detail
		$sql	= "DELETE FROM static_detail WHERE static_detail_id='$id'";
		$query	= mysql_query($sql);
		
		
		$result = '';
		if(!$query)
		{
			$result = "ER103";
		}
		else
		{
			$result = "SU103";
		}
		
		//return the result
		return $result;
	}//eof
	
	
	/**
	*	Retrieve all static id depending on conditions
	*
	*	@param
	*			$id		Value of the type to search for
	*			$type	Type of result set id
	* 
	*
	*	@return array
	*/
	function getStaticId($id, $type)
	{
		//declare variables
		$sql	= '';
		$data	= array();
		
		//conditions
		if($type == '')
		{
			$sql	= "SELECT static_id FROM static ORDER BY added_on DESC, sort_order ASC  ";
		}
		else
		{
			$sql	= "SELECT static_id FROM static 
					   WHERE ".$type." = '$id'	
					   ORDER BY sort_order, added_on";
		}
		
		//execute the query
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		
		if($query->num_rows > 0)
		{
			while($result = $query->fetch_object())
			{
				$data[] = $result->static_id;
			}
		}
		return $data;
	}//eof
	
	
	/**
	*	Retrieve all static detail id associated with static id
	*
	*	@param
	*			$id		Static id
	*
	*	@return array
	*/
	function getStaticDtlId($id)
	{
		//declare variables
		$data	= array();
		
		//conditions
		$sql	= "SELECT static_detail_id FROM static_detail WHERE static_id='$id'";
				
		$query	= mysql_query($sql);
		
		
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->static_detail_id;
			}
		}
		return $data;
	}//eof
	
	
	
	/**
	*	Retrieve all static data
	*
	*	@update	March 30, 2011	
	*
	*
	*	@param	
	*			$id		id of the static
	*
	*	@return array
	*/
	function getStaticData($id){
		$data	= array();
		
		//get the table name 
		//$tableName	= $this->getTableName("static");
		//echo $tableName;exit;
		
		$sql	= "SELECT * FROM static WHERE static_id= '$id' GROUP BY categories_id";	  
		$query	= $this->conn->query($sql);
		
		if($query->num_rows == 1)
		{
			$result = $query->fetch_object();
			
			//hold in array
			$data = array(
						 $result->categories_id,	//0
						 $result->title,			//1
						 $result->brief,			//2
						 $result->description,		//3
						 $result->image,			//4 
						 $result->image_title,		//5
						 $result->status,			//6
						 $result->sort_order,		//7
						 $result->added_on,			//8
						 $result->modified_on,		//9
						 
						 $result->video,			//10		Update March 30, 2011
						 
						 $result->image_position,	//11		Update June 14, 2011
						 $result->upload_video,		//12
						 
						 $result->page_title,		//13		Added On: September 22, 2011
						 $result->seo_url,			//14
						 $result->display_width,	//15		
						 $result->display_height,	//16
						 $result->meta_title,		//17		
						 $result->meta_keywords,	//18		
						 $result->meta_description,	//19		
						 
						 $result->url,				//20		Added On: 
						 $result->display_banner,	//21
						 $result->dis_slide_show,	//22
						 $result->parent_static_id,	//23		Added On: August 29, 2012
						 $result->canonical			//24		Added On: December 12, 2014

						 );
		}
		//echo $data.mysql_error();exit;
		return $data;
	}//eof
	
	
	/**
	*	Retrieve all static detail data
	*
	*	@param	
	*			$id		Static detail id
	*
	*	@return array
	*/
	function getStaticDtlData($id)
	{
		//declare variables
		$data	= array();
		
		//create the statement
		$sql	= "SELECT * FROM static_detail WHERE static_detail_id= '$id'";
				 
		//execute query		  
		$query	= mysql_query($sql);
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			
			//hold in array
			$data = array(
						 $result->static_id,		//0
						 $result->title,			//1
						 $result->brief,			//2
						 $result->description,		//3
						 $result->image,			//4
						 $result->image_title,		//5
						 $result->added_on,			//6
						 $result->modified_on,		//7
						 
						 $result->image_position,	//8		Update June 14, 2011
						 
						 $result->display_width,	//9		Update October 14, 2011
						 $result->display_height	//10
						 );
		}
		
		//return the value
		return $data;
	}//eof



	
	/**
	*	Display static detail in the webpage
	*
	*	@param 
	*			$static_id		Static Id
	*			$path			Path to the image
	*			$head			Heading tag to be used, e.g. h1, h2 etc.
	*			$imgAlign		Image alignment, float left or right
	*			$mainClass		Class to render the data
	*			$headClass		Heading class
	*			$descClass		Text Description class
	*
	*	@return string
	*/
	function showStaticContent($static_id, $path, $imgAlign, $mainClass, $headClass, 
							   $imgStrClass, $descClass)
	{
		//declare variables
		$contStr	= '';
	
		//get static
		$staticDtl = $this->getStaticData($static_id);
		
		if(count($staticDtl) > 0)
		{
			
			//image title
			if( ($staticDtl[4] != '' ) && (file_exists($path.$staticDtl[4]) ) )
			{
				$imgStr	= '<br /><span class="'.$imgStrClass.'">'.$staticDtl[5].'</span>';
			}
			else
			{
				$imgStr	= '';
			}
			
			//start display
			$contStr	.=  '<div class="'.$mainClass.'">';
			$contStr	.=    '<div class="fr">';
			$contStr	.= 		$this->imgDisplay($path, $staticDtl[4], $staticDtl[15], $staticDtl[16], 0, '',$staticDtl[5], "");
			$contStr	.= 		$imgStr;
			$contStr	.= 	 '</div>';
			$contStr	.=	 '<span class="'.$descClass.'">'.stripslashes($staticDtl[3]).'</span>';
			$contStr	.=	 '<div class="cl"></div>';
			$contStr	.=  '</div>';
			
			
		}//if
		
	}//eof

	
	
	


	/**
	*	Hold the sub-sections in session array
	*
	*	@param
	*			$num	Number of sub-section or additional pragraphs
	*
	*	@return array
	*/
	function regSubInSess($num)
	{
		//declare variables
		$data	= array();
		$num	= (int)$num;
		
		if($num >= 1)
		{
			for($m = 0; $m < $num; $m++)
			{
				//title
				if(isset($_POST['txtSubTitle'][$m]))
				{
					$_SESSION['txtSubTitle'][$m]	= $_POST['txtSubTitle'][$m];
				}
				else
				{
					$_SESSION['txtSubTitle'][$m]	= '';
				}
				
				//description
				if(isset($_POST['txtSubDesc'][$m]))
				{
					$_SESSION['txtSubDesc'][$m]	= $_POST['txtSubDesc'][$m];
				}
				else
				{
					$_SESSION['txtSubDesc'][$m]	= '';
				}
				
				//image title
				if(isset($_POST['txtSubImgTitle'][$m]))
				{
					$_SESSION['txtSubImgTitle'][$m]	= $_POST['txtSubImgTitle'][$m];
				}
				else
				{
					$_SESSION['txtSubImgTitle'][$m]	= '';
				}
				
				//display width
				if(isset($_POST['intSubImgW'][$m]))
				{
					$_SESSION['intSubImgW'][$m]	= $_POST['intSubImgW'][$m];
				}
				else
				{
					$_SESSION['intSubImgW'][$m]	= '';
				}
				
				//display height
				if(isset($_POST['intSubImgH'][$m]))
				{
					$_SESSION['intSubImgH'][$m]	= $_POST['intSubImgH'][$m];
				}
				else
				{
					$_SESSION['intSubImgH'][$m]	= '';
				}
				
				//image position
				if(isset($_POST['selSubImgPos'][$m]))
				{
					$_SESSION['selSubImgPos'][$m]	= $_POST['selSubImgPos'][$m];
				}
				else
				{
					$_SESSION['selSubImgPos'][$m]	= '';
				}
				
				$data[]	= $_SESSION['txtSubTitle'][$m];
				$data[]	= $_SESSION['txtSubDesc'][$m];
				$data[]	= $_SESSION['txtSubImgTitle'][$m];
				$data[]	= $_SESSION['intSubImgW'][$m];
				$data[]	= $_SESSION['intSubImgH'][$m];
				$data[]	= $_SESSION['selSubImgPos'][$m];
				
			}//for
		}//if
		
		
		//return data
		return $data;
		
	}//eof
	
	
	
	/**
	*	Delete the sub-sections variables registered in session array
	*
	*	@param
	*			$num	Number of sub-section or additional pragraphs
	*
	*	@return null
	*/
	function delSubInSess($num)
	{
		//declare variables
		$num	= (int)$num;
		
		if($num >= 1)
		{
			for($m = 0; $m < $num; $m++)
			{
				//title
				if( isset($_SESSION['txtSubTitle'][$m]) )
				{
					$_SESSION['txtSubTitle'][$m] = '';
					unset($_SESSION['txtSubTitle'][$m]);
				}
				
				//description
				if( isset($_SESSION['txtSubDesc'][$m]) )
				{
					$_SESSION['txtSubDesc'][$m] = '';
					unset($_SESSION['txtSubDesc'][$m]);
				}
				
				//title
				if( isset($_SESSION['txtSubImgTitle'][$m]) )
				{
					$_SESSION['txtSubImgTitle'][$m] = '';
					unset($_SESSION['txtSubImgTitle'][$m]);
				}
				
				//width
				if( isset($_SESSION['intSubImgW'][$m]) )
				{
					$_SESSION['intSubImgW'][$m] = '';
					unset($_SESSION['intSubImgW'][$m]);
				}
				
				//height
				if( isset($_SESSION['intSubImgH'][$m]) )
				{
					$_SESSION['intSubImgH'][$m] = '';
					unset($_SESSION['intSubImgH'][$m]);
				}
				
				
				//image position
				if( isset($_SESSION['selSubImgPos'][$m]) )
				{
					$_SESSION['selSubImgPos'][$m] = '';
					unset($_SESSION['selSubImgPos'][$m]);
				}
				
			}//for
			
		}//if
				
	}//eof
	
	

	/**
	*	Generate number of sub section fields
	*
	*	@param
	*			$num		Number of sub section or description
	*
	*	@return string
	*/
	function genDesc($num)
	{
		//declare variables
		$data		= '';
		$num		= (int)$num;
		$arr_value	= array('left','center','right'); 
		$arr_label	= array('left','center','right');
		
		if($num >= 1)
		{
			$data	= '<table width="100%">';
			//loop
			for($k = 0; $k < $num; $k++)
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
				
				$data	.= '
						   <tr>
							 <td colspan="2" class="bld padT10 padB10">Section['.$j.']</td>
						   </tr>	
						   <tr>
							 <td width="22%" align="left" class="menuText">Title </td>
							 <td align="left" class="bodyText pad5">
								<input name="txtSubTitle[]" type="text" class="text_box_large" 
								id="txtSubTitle[]" value="'.$txtSubTitle[$k].'" size="50" />
							 </td>
						   </tr>
						   <tr>
							 <td width="22%" align="left" class="menuText">Description </td>
							 <td align="left" class="bodyText pad5">
								<textarea  name="txtSubDesc[]" id="txtSubDesc'.$k.'"  class="textAr padB20">'.$txtSubDesc[$k].'</textarea>
							 </td>
						   </tr>
						   <tr>
							 <td width="22%" align="left" class="menuText">Image Title </td>
							 <td align="left" class="bodyText pad5">
								<input name="txtSubImgTitle[]" type="text" class="text_box_large" 
								id="txtSubImgTitle[]" value="'.$txtSubImgTitle[$k].'" size="50" />
							 </td>
						   </tr>
						   <tr>
							 <td width="22%" align="left" class="menuText">Image </td>
							 <td align="left" class="bodyText pad5">
								<input name="fileSubImg[]" type="file" class="text_box_large"
								 id="fileSubImg[]"> (max 800 X 800 pixels in width by height) 
							 </td>
						   </tr>
						   <tr>
							<td align="left" class="menuText">Image Display Size in Pixels</td>
							<td align="left" class=" blackLarge pad5">
							 	 <span>Display Width</span>
								 <input name="intSubImgW[]" type="text" class="text_box_large" id="intSubImgW[]" maxlength="4" size="6" 
								 value="'.$intSubImgW[$k].'" />
								 
								 <span>Display Height</span>
								 <input name="intSubImgH[]" type="text" class="text_box_large" id="intSubImgH[]" maxlength="4" size="6"
								 value="'.$intSubImgH[$k].'" />
								 
							 </td>
						   </tr>
						   <tr>
							 <td width="22%" align="left" class="menuText">Image Position </td>
							 <td align="left" class="bodyText pad5">
							 	<select name="selSubImgPos[]" class="textBoxA">
									'.$this->genDropDownR($selSubImgPos[$k], $arr_value, $arr_label).'
								</select>
							 </td>
						   </tr>
						   ';
			}
			
			//concate
			$data	.= '</table>';
		}
		
		//return the value
		return $data;
		
	}//eof
	
	
	/**
	*	Display static detail with delete options
	*
	*	@param 
	*			$static_id		Static Id
	*			$path			Path to the image
	*
	*	@return string
	*/
	function showDelStaticDtl($static_id, $path)
	{
		//declare variables
		$data		= '';
		$arr_value	= array('left','center','right'); 
		$arr_label	= array('left','center','right');
	
		//static detail ids detail
		$staticSubDtlIds 	= $this->getStaticDtlId($static_id);
		
		$j = 1;
		if(count($staticSubDtlIds) > 0)
		{
			$data	.=  "<table width='100%' cellspacing='0' cellpadding='0' border='0'>";
			
			foreach($staticSubDtlIds as $x)
			{
				$staticSubDtl = $this->getStaticDtlData($x);
				
				if( ($staticSubDtl[4] != '' ) && (file_exists($path.$staticSubDtl[4])) )
				{
					$delSubStr	= "<input name=\"delSubImg[]\" type=\"checkbox\" value=\"1\"> <span class='blackLarge'>Delete this image</span>";
				}
				else
				{
					$delSubStr	= '';
				}
				
				$data	.=  '
				  
				  <tr>
					 <td colspan="2" class="bld padT10 padB10">
					 	<h4>Section['.$j.']
					 	<input name="delOption[]" type="checkbox" value="'.$x.'" />
					 	<span class="orangeLetter"> Delete </span>
						</h4>
					 </td>
				   </tr>	
				   <tr>
					 <td width="22%" align="left" class="menuText">Title </td>
					 <td align="left" class="bodyText pad5">
						<input name="txtSubTitle[]" type="text" class="text_box_large" 
						id="txtSubTitle[]" value="'.$staticSubDtl[1].'" size="50" />
					 </td>
				   </tr>
				   <tr>
					 <td width="22%" align="left" class="menuText">Description </td>
					 <td align="left" class="bodyText pad5">
						<textarea  name="txtSubDesc[]" id="txtSubDesc[]" cols="70" 
						class="textAr" rows="10" wrap="PHYSICAL" >
						'.str_replace('<br />','',trim(stripslashes($staticSubDtl[3]))).'
						</textarea>
						
					 </td>
				   </tr>
				   <tr>
					 <td width="22%" align="left" class="menuText">Image Title </td>
					 <td align="left" class="bodyText pad5">
						<input name="txtSubImgTitle[]" type="text" class="text_box_large" 
						id="txtSubImgTitle[]" value="'.$staticSubDtl[5].'" size="50" />
					 </td>
				   </tr>
				   <tr>
					 <td width="22%" align="left" class="menuText padT5" valign="top">Image </td>
					 <td align="left" class="bodyText pad5">
						 <div class="fr">
						 '.$this->imgDisplay($path, $staticSubDtl[4], 75, 100, 0, 
						  					 'greyBorder',$staticSubDtl[5], "").'
						 </div>
						 <input name="fileSubImg[]" type="file" class="text_box_large"
						 id="fileSubImg[]"> (max. 800 X 800 pixels in width by height)<br />
						 '.$delSubStr.'
						  
						<div class="cl"></div>
					 </td>
				   </tr>
				   <tr>
					<td align="left" class="menuText">Image Display Size in Pixels</td>
					<td align="left" class=" blackLarge pad5">
						 <span>Display Width</span>
						 <input name="intSubImgW[]" type="text" class="text_box_large" id="intSubImgW[]" maxlength="4" size="6" 
						 value="'.$staticSubDtl[9].'" />
						 
						 <span>Display Height</span>
						 <input name="intSubImgH[]" type="text" class="text_box_large" id="intSubImgH[]" maxlength="4" size="6"
						 value="'.$staticSubDtl[10].'" />
						 
					 </td>
				   </tr>
				   <tr>
					 <td width="22%" align="left" class="menuText">Image Position </td>
					 <td align="left" class="bodyText pad5">
						<select name="selSubImgPos[]" class="textBoxA">
							'.$this->genDropDownR($staticSubDtl[8], $arr_value, $arr_label).'
						</select>
					 </td>
				   </tr>
				 ';
				  $j++;
			}
			
			$data	.=  " </table>";
		}
		
		//return the value
		return $data;
		
	}//eof
	
	
	/**
	*	Display static detail in the webpage
	*
	*	@param 
	*			$static_id		Static Id
	*			$path			Path to the image
	*			$head			Heading tag to be used, e.g. h1, h2 etc.
	*			$imgHolder		Image alignment, float left or right
	*			$mainClass		Class to render the data
	*			$headClass		Heading class
	*			$descClass		Text Description class
	*
	*	@return string
	*/
	function showStaticDtl($static_id, $path, $head, $imgHolder, $mainClass, $headClass, 
						   $imgStrClass, $descClass)
	{
		//declare variables
		$data	= '';
	
		//static detail ids detail
		$staticSubDtlIds 	= $this->getStaticDtlId($static_id);
		
		
		if(count($staticSubDtlIds) > 0)
		{
			
			foreach($staticSubDtlIds as $x)
			{
				//get sub section detail
				$staticSubDtl = $this->getStaticDtlData($x);
				
				//set for head
				if($staticSubDtl[1] != '')
				{
					$headStr	= '<'.$head.' class="'.$headClass.'"> '.$staticSubDtl[1].' </'.$head.'>';
				}
				else
				{
					$headStr	= '';
				}
				
				//image title
				if( ($staticSubDtl[4] != '' ) && (file_exists($path.$staticSubDtl[4]) ) )
				{
					$imgStr  = '<div class="'.$imgHolder.'">';
					$imgStr	.= $this->showImgWithAbsPath("YES", URL, $path, $staticSubDtl[4], $staticSubDtl[10], $staticSubDtl[9], 0, '', '', '');
					if($staticSubDtl[5] != '')
					{
						$imgStr	.= '<div class="'.$imgStrClass.'">'.$staticSubDtl[5].'</div>';
					}
					$imgStr .= '</div>';
				}
				else
				{
					$imgStr	= '';
				}
				
				//start display
				
				echo  '<div class="'.$mainClass.'">';
				echo 	$headStr;
				
				//echo  	'<div class="'.$imgHolder.'">';
				//echo 		$this->showImgWithAbsPath("YES", URL, $path, $staticSubDtl[4], $staticSubDtl[10], $staticSubDtl[9], 0, '', '', '');
				echo 		$imgStr;
				//echo 	'</div>';
					
				
				echo	 '<div class="'.$descClass.'">'.stripslashes($staticSubDtl[3]).'</div>';
				echo	 '<div class="cl"></div>';
				echo  '</div>';
					   
			}//foreach		
			
		}//if
		
	}//eof

	
	
	/**
	*	Get category page URL by static content id
	*
	*	@date July 27, 2010
	*
	*	@param
	*			$static_id		Static content primary key
	*
	*	@return	atring
	*/
	function getCatUrlByStaticId($static_id)
	{
		//declare var
		$staticDtl	= array();
		$catId		= 0;
		$catName	= '';
		
		//get the static detail
		$staticDtl	= $this->getStaticData($static_id);
		
		if(count($staticDtl) > 0 )
		{
			//get the category id
			$catId		= $staticDtl[0];
			
			//create the statement
			$sql		= "SELECT * from static_categories	WHERE categories_id = $catId";
			
			//execute query
			$query		= mysql_query($sql);
			
			//get the result set
			$result		= mysql_fetch_object($query);
			
			//get the category name
			$catName	= $result->url;
		}
		
		
		//return the values
		return $catName;
		
	}//eof
	
	
	
	#####################################################################################################
	#
	#										Get contents based uopn criteria
	#
	#####################################################################################################
	
	
	
	/**
	*	Returns the static ids belongs to a category
	*
	*	@param
	*			$catId		Category id
	*
	*	@return	array
	*/
	function getCatStatic($catId)
	{
		//initialize vars
		$data	= array();
		
		//statement
		$select = "SELECT 	* 
				   FROM 	static 
				   WHERE 	categories_id = $catId 
				   ORDER BY added_on DESC";
		
		//execute statement
		$query  = mysql_query($select);
		
		//check if products are there
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->static_id;
			}
		}
		
		//return the data
		return $data;
	}//eof
	
	
	
	
	/**
	*	This function will return all the category belongs directly to a category
	*
	*	@param
	*			$catId			Category Id
	*			$level			Depth to search
	*
	*	@return array
	*/
	function getAllChildId($catId,$level)
	{
		//declare vars
		$data	= array();
		
		//statement
		$select = "SELECT * FROM static_categories WHERE parent_id='$catId' ORDER BY categories_name ";
		
		//execute statement
		$query  = mysql_query($select);
		
		
		while($result = mysql_fetch_array($query))
		{
			//hold the data
			$data[]	= $result['categories_id'];
			
			//recursive call
			$this->getAllChildId($result['categories_id'], $level+1);
			
		}
		
		//return the data
		return $data;
		
	}//eof
	
	
	/**
	*	Returns all the static ids belongs to a category in direct or indirect manner
	*
	*	@param
	*			$catId			Category id
	*			$type			Type defines whether the category will search recursively through all the childs, or only to that category.
	*							The constant 'all' refers to recursive call that search through the parent and childs as well; otherwise 
	*							the function will search for the product those directly belong to the category
	*
	*	@return array
	*/
	function getStaticList($catId, $level, $type)
	{
		//declare vars
		$data	= array();
		$data1	= array();
		$data2	= array();
		
		if($type == 'ALL')
		{
			//statement
			$select = "SELECT 	* 
					   FROM 	static_categories 
					   WHERE 	parent_id='$catId' 
					   ORDER BY categories_name";
			
			//execute statement
			$query  = mysql_query($select);
			
			while($result = mysql_fetch_array($query))
			{
				//get the categories ids
				$data1[]	=  $result['categories_id'];
				$cat_id		=  $result['categories_id'];
				
				//statement to get contents
				$select2 = "SELECT 	 S.static_id AS SID 
							FROM 	 static S
						    WHERE 	 S.categories_id='".$result['categories_id']."'
						    ORDER BY S.added_on DESC
						   ";
				
				//execute statement
				$query2  = mysql_query($select2);
				
				//get the results
				while($result2 = mysql_fetch_array($query2))
				{
					//get the static content ids
					$scId 	= $result2['SID'];
					
					//hold in array
					$data[] = $scId;
				}
				
				//call the function again
				$this->getStaticList($result['categories_id'], $level+1,'all');
			}
		}
		else
		{
			//get the contents
			$contents = $this->getCatStatic($catId);
			
			
			//get the values in variable 
			$data	  = $contents;
		}
		
		
		//return the values
		return $data;
		
	}//eof
	
	
	
	
	/**
	*	Display static detail in the webpage
	*
	*	@param 
	*			$static_id		Static Id
	*			$path			Path to the image
	*			$head			Heading tag to be used, e.g. h1, h2 etc.
	*			$imgAlign		Image alignment, float left or right
	*			$mainClass		Class to render the data
	*			$headClass		Heading class
	*			$descClass		Text Description class
	*
	*	@return string
	*/
	function showContent($static_id, $path, $imgCls, $imgCaptionCls)					 
	{
		//declare variables
		$contStr	= '';
		$duFiles	= array();
	
		//get static
		$staticDtl = $this->getStaticData($static_id);
		
		//get download upload file section
		$duFiles	= $this->getContentDownloadId($static_id, '');
		
		
		if(count($staticDtl) > 0)
		{
			//page title
			//get the title
			if($staticDtl[13] != '')
			{
				$titleStr	= $staticDtl[13];
			}
			else
			{
				$titleStr 	= $staticDtl[1];
			}
			
		
			//display heading
			//$contStr	= '<h1>'.$this->displayContent(0, $titleStr).'</h1>';
			
			//draw a horizontal line after h1 tag
			//$contStr	.= '<div class="title-divider">&nbsp;</div>';
			
			//image title
			/*if( ($staticDtl[4] != '' ) && (file_exists($path.$staticDtl[4]) ) && ($staticDtl[5] != '') )
			{
				$imgStr	= '<br /><span class="'.$imgCaptionCls.'">'.$staticDtl[5].'</span>';
			}
			else
			{
				$imgStr	= '';
			}*/
			
			
			
			//display image
			if( ($staticDtl[4] != '' ) && (file_exists($path.$staticDtl[4]) ) )
			{
				$imgAlign = $this->getImageAlignStr($staticDtl[11]);
				$contStr .= '<div class="'.$imgCls.' '.$imgAlign.'">';
				$contStr .=	 $this->showImgWithAbsPath("YES", URL, $path, $staticDtl[4], $staticDtl[16], $staticDtl[15], 0, '', '', '');
				$contStr .= '</div>';
			}
			
			//display description
			$contStr	.=	'<p>'.$this->displayContent(0, $staticDtl[3]).'</p>';
			
			//clear
			$contStr	.=	'<div class="cl"></div>';
			
			
		}//if
		
		//return content
		return $contStr;
		
	}//eof
	

	/**
	*	Get the content title. If Page title is empty, it is going to accept title
	*
	*	@param
	*			$content_id			Static content id
	*
	*	@return string
	*/
	function getContentTitle($content_id)
	{
		//declare var
		$titleStr	= '';
		
		//get the detail
		$staticDtl	= $this->getStaticData($content_id);
		
		
		//get the title
		if($staticDtl[13] != '')
		{
			$titleStr	= $staticDtl[13];
		}
		else
		{
			$titleStr 	= $staticDtl[1];
		}
		
		//return the title
		return $titleStr;
		
	}//eof
	
	
	
	###########################################################################################################################
	#
	#											Static Content Download Upload section
	#
	###########################################################################################################################
	
	/**
	*	Add, edit, delete, getAll, show
	*/
	
	
	/**
	* 	Add download content
	*
	*	@		October 10, 2011	
	*		
	*	@param
	*			$static_id			Static Id
	*			$download_title		Download content title
	*			$download_file		Download file
	*			$page_position		Position of the page
	*			$link_alignment		Link alignment
	*			$status				Status
	*			$sort_order			Sorting order
	*			
	*	@return	int
	*/
	function addDownloadContent($static_id, $download_title, $page_position, $link_alignment, $status, $sort_order)
	{
		//security
		$static_id			= (int)$static_id;
		$download_title		= trim(mysql_real_escape_string($download_title));
		$page_position		= $page_position; 
		$link_alignment		= $link_alignment;
		$status				= $status;
		$sort_order			= (int)$sort_order;
		
		//statement
		$sql 	= "INSERT INTO static_download
				   (static_id, download_title, page_position, link_alignment, status, sort_order, added_on)
				   VALUES
				   ('$static_id','$download_title', '$page_position', '$link_alignment', '$status', '$sort_order', now())";
				    
		
		//execute query
		$query	= mysql_query($sql);
		
		//echo $sql.mysql_error();exit;
		
		//get the primary key
		$result = mysql_insert_id();
		
		//return result
		return $result;
	}//eof
	
	
	
	
	/**
	*	Update 	static Download Content
	*
	*	@		October 10, 2011	
	*	
	*	@param
	*			$id					static download id (pk)
	*			$static_id			Static Id
	*			$download_title		Title of the downloaded file
	*			$download_file		Downloaded file
	*			$page_position		Position of the page
	*			$link_alignment		Link Alignment
	*			$status				Status (active or Deactive)
	*			$sort_order			Shorting order
	*			
	*	@return string
	*/
	function updateDownloadContent($id, $static_id, $download_title, $page_position, $link_alignment, $status, $sort_order)
	{
		//security
		$download_title			= trim(mysql_real_escape_string($download_title));
		$page_position			= $page_position; 
		$link_alignment			= $link_alignment; 
		$status					= $status;
		$sort_order				= (int)$sort_order;
		
		//statement
		$sql	= "UPDATE static_download SET
				  static_id				='$static_id',
				  download_title 		='$download_title',
				  page_position			='$page_position',
				  link_alignment		='$link_alignment',
				  status				='$status',
				  sort_order			='$sort_order',
				  modified_on 			= now()
				  WHERE 
				  static_id 			= '$static_id'
				  AND
				  static_download_id	='$id'
				  ";
				  
		//execute query
		$query	= mysql_query($sql);
		
		//echo $sql.mysql_error();exit;
		
		//echo $sql;exit;
		$result = '';
		if(!$query)
		{
			$result = "ER102";
		}
		else
		{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof
	
	
	
	/**
	*	Delete Download Content from the database
	*
	*	@param 
	*			$id			static download id
	*			$path		Path to the images
	*
	*	@return string
	*/
	function deleteDownloadContent($id, $path)
	{
		//delete the image first
		$this->deleteFile($id, 'static_download_id' , $path, 'download_file', 'static_download');
		
		//get all static detail id
		$statDtlIds	= $this->getStaticDtlId($id);
		
		if( count($statDtlIds) > 0 )
		{
			//loop to delete the static detail files
			foreach($statDtlIds as $k)
			{
				//$this->deleteStaticDtl($k, $path);
			}//foreach
		}
		
		//delete from static
		$sql	= "DELETE FROM static_download WHERE static_download_id = '$id'";
		$query	= mysql_query($sql);
		
		$result = '';
		if(!$query)
		{
			$result = "ER103";
		}
		else
		{
			$result = "SU103";
		}
		
		//return the result
		return $result;
	}//eof
	
	
	
	/**
	*	Retrieve all static download id depending on conditions
	*
	*	@param
	*			$id		Value of the type to search for
	*			$type	Type of result set id
	* 
	*
	*	@return array
	*/
	function getContentDownloadId($id, $type)
	{
		//declare variables
		$sql	= '';
		$data	= array();
		
		//conditions
		if($type == '')
		{
			$sql	= "SELECT static_download_id FROM static_download ORDER BY static_download_id DESC";
		}
		else
		{
			$sql	= "SELECT static_download_id FROM static_download 
					   WHERE ".$type." = '$id'	
					   ORDER BY sort_order ASC,
					   static_download_id DESC";
		}
		
		
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->static_download_id;
			}
		}
		return $data;
	}//eof
	
	
	
	/**
	*	Retrieve all activated static download id associated with the static content id 
	*
	*	@param
	*			$id		Value of the type to search for
	*			$type	Type of result set id
	* 
	*
	*	@return array
	*/
	function getActiveContentDownloadId($id)
	{
		//declare variables
		$sql	= '';
		$data	= array();
		
		//statement
		$sql	= "SELECT 	static_download_id FROM static_download 
				   WHERE 	static_id = ".$id."	
				   AND 		status	  = 'a'
				   ORDER BY sort_order ASC, static_download_id DESC";
				   
		
		//execute query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->static_download_id;
			}
		}
		
		//return the dataset
		return $data;
	}//eof
	
	
	
	
	/**
	*	Retrieve all static download content data
	*
	*	@update	October 10, 2011	
	*
	*
	*	@param	
	*			$id		id of the static_download_id
	*
	*	@return array
	*/
	function getContentDownloadData($id)
	{
		//declare variables
		$data	= array();
		
		//create the statement
		$sql	= "SELECT * FROM static_download WHERE static_download_id= '$id' GROUP BY static_id  ";
				 
		//execute query		  
		$query	= mysql_query($sql);
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			
			//hold in array
			$data = array(
						 $result->static_id,			//0
						 $result->download_title,		//1
						 $result->page_position,		//2
						 $result->link_alignment,		//3
						 $result->status,				//4 
						 
						 $result->sort_order,			//5
						 $result->added_on,				//6
						 $result->modified_on,			//7	
						 $result->download_file			//8
						 );
		}
		return $data;
	}//eof



/////////////////////////////////////////////////////////////////////////////////////////////
	//
	//      		************* Static Search ***********************
	//
	/////////////////////////////////////////////////////////////////////////////////////////////
	
	
	/**
	*	Search the Static
	*
	*	Added On:	December 8,2011
	*	Author:		Nafia Hassan Halder
	*
	*	@param
	*			$keyword	Keyword to search
	*			$status		Status  to search
	*
	*	@return array
	*/
	function getStaticBySearch($keyword, $status)
	{
		
		$statRes	= $this->getStaticByStatus($status);
		$keyRes		= $this->getStaticKeyword($keyword);
		
		$final  	= array_intersect($statRes, $keyRes);
		
		return $final;
	}//eof
	
	
	/**
	*	Search Static by keyword only
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getStaticKeyword($keyword)
	{
		//declare variables
		$data  = array();
		$keyword = mysql_escape_string($keyword);
		
		//create the statement
		if($keyword == '')
		{
			$sql =  "SELECT static_id FROM static";
		}
		else
		{
			$sql =  "SELECT static_id,
					MATCH( title, page_title, seo_url, brief, description,  image, image_title, video, meta_title, meta_keywords, meta_description)
					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  static
					WHERE 
					MATCH(title, page_title, seo_url, brief, description,  image, image_title, video, meta_title, meta_keywords, meta_description)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		//execute query	
		$query = mysql_query($sql);
		
		
		while($result = mysql_fetch_object($query))
		{
			$data[] = $result->static_id;
			
		} 
		if(!$query)
		{
			return mysql_error();
		}
		else
		{
			return $data;
		}
		 
	}//eof
	
	
	
	/**
	*	Get Static by Published Status only
	*
	*	@return array
	*/
	function getStaticByStatus($status){
		 //declare variables
		 $data = array();
		 
		 //create the statement
		 if($status != ''){
		 	$sql =  "SELECT static_id FROM static WHERE status='$status' ";
		 }
		 else{
		 	$sql =  "SELECT static_id FROM static ";
		 }
		 
		 //execute query
		 $query = $this->conn->query($sql);
		 		 
		 
		 while($result = $query->fetch_object()){
			$data[] = $result->static_id;
		 } 
		 if(!$query){
			return mysql_error();
		 }else{
			return $data;
		 }
	}//eof	
	
	
	/**
	*	Display All Active banner Ids
	*
	*	@return 
	*/

	function getAllActiveBannerIds()
	{
		
		$data	= array();
		
		//statement
		$sql 	= "SELECT photo_id FROM front_photo WHERE status='a' ORDER BY sort_order ASC, added_on DESC";
		$query 	= mysql_query($sql);
		
		//check for the rows
		if(mysql_num_rows($query) > 0)
		{
			while($row  = mysql_fetch_object($query))
			{
				$data[]  = $row->photo_id;
			}
		}
		
		//return the value
		return $data;

	}//eof
	
	
	
	/**
	*	Retrieve all front image data
	*
	*	@return array
	*	@param	$id		id of the front image
	*/
	function getFrontPhotoData($id)
	{
		//create the statement
		$sql	= "SELECT * FROM front_photo WHERE photo_id= '$id'";
		
		$query	= mysql_query($sql);
		$data	= array();
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			$data = array(
							 $result->photo_name,			//0
							 $result->description,			//1
							 $result->photo,				//2
							 $result->status,				//3
							 $result->added_on,				//4
							 $result->modified_on,			//5
							 
							 $result->sort_order			//6 Added On: September 22, 2011
						 );
		}
		return $data;
	}//eof
	
	/**
	*	Get Active ID
	*/
	function getActiveId()
	{
		$data	= array();
		
		//statement
		$sql 	= "SELECT photo_id FROM front_photo WHERE status='a' ORDER BY sort_order ASC, added_on DESC";
		
		//execute query
		$query 	= mysql_query($sql);
		
		//check for the rows
		if(mysql_num_rows($query) > 0)
		{
			while($row  = mysql_fetch_object($query))
			{
				$data[]  = $row->photo_id;
			}
		}
		
		//return the value
		return $data;
	}//eof

	
	
	
	
	
	/**
	*	Display banner with different pages 
	*
	*	@param
	*			$pageId			Get the static page id
	*
	*	@return 
	*/
	 function showBanner($path)
	 {
		
		 //declare var
		 $pageDtl	= array();
		 $dispBan	= "N";
		 $actBanIds	= array();
		 $slideShow	= "N";
		 
		 //get the current page id
		 $pageId	= $this->getCurrentPageId();
		// echo $pageId;exit;
		 //get the page detail
		 $pageDtl	= $this->getStaticData($pageId);
		 
		 //get the display banner option
		 $dispBan	= $pageDtl[21];
		 $slideShow	= $pageDtl[22];
		 
		 //display banner 
		 if($dispBan == 'Y')
		 {
			 //get all active banner associated with this page
			 $actBanIds	= $this->getStatBannerActiveId($pageId);
			 $actBanMaxIds= $this->getStatBannerActiveMaxId($pageId);
			 //print_r($actBanIds);exit;
			 
			 if(count($actBanIds) > 0)
			 {
				 //display image
				echo '<div id="banner">';
				
				 //check if the page has been set for slide show or not
				 if($slideShow == "Y")
				 {
					echo '<div id="slider" class="nivoSlider">';
					
					//display slide show here
					foreach($actBanIds as $k)
					{
						//echo $k; exit;
						//get the detail
						$ffDtl	=$this->getStaticBanner($k);
						//echo $ffDtl[2];exit;
						//display image
						echo '<img src="'.URL.$path.$ffDtl[2].'" width="738" height="238" 
							 alt="'.$ffDtl[0].'" title="'. $ffDtl[1].'" />';
					}
					
					 echo '</div>';

				 }
				 else
				 {
					 if(count($actBanMaxIds) > 0)
						  {
								foreach($actBanMaxIds as $i)
								{	
									$imgDetail	= $this->getStaticBanner($i);
									
								echo '<img src="'.URL.'images/static/banner/'.$imgDetail[2].'" width="738" height="238" 
							 alt="'.$imgDetail[0].'" title="'. $imgDetail[1].'" />';
                         		}
						  }
						  else 
						  {
							
						  }
				
					//echo '<img src="'.URL.'images/static/banner/banner-2.jpg" width="738" height="238" alt="Banner Image" />';
				 }
				 
				 echo '</div>';
			 }
			 else
			 {
				 //don't do anything
			 }
		 }
		 else
		 {
			//dont't do anything 
		 }
		 
	
	 }//eof
	
	
	
	/**
	*	Get current page's primary key
	*
	*	@return int
	*/
	function getCurrentPageId()
	{
		//declare var
		$currPage	= "index.php";
		$pageId		= 0;
		 
		//get the current page
		$currPage	=  basename($_SERVER['PHP_SELF']);
		
		if($currPage != 'content.php')
		{ 
			//get the corresponding static key
			$pageId = $this->getValueByKey($currPage, 'url', 'static_id', 'static', 0);
			
		}
		else
		{
			$seoNV = $_SERVER['QUERY_STRING'];
			
			//echo $seoNV; exit;
			  
			if(strpos($seoNV, '=') !== false)
			{ 
			    //get the seo url value
				$nv		= explode("=", $seoNV);
				
				$seoN	= trim($nv[0]);
				$seoV	= trim($nv[1]);	
				
				//get the corresponding static key
				$pageId = $this->getValueByKey($seoV, 'seo_url', 'static_id', 'static');
				//echo $pageId ; exit;
			 }
		}
		
		//return the value
		return $pageId;
		 
	}//eof
	
	
	
	
	
	
	/**
	*	Get page url by primary key. As a page can have it's seo url and/or external or internal page name. If any
	*	url find the function will generate link for the function, otherwise it will go for content.php
	*
	*	@date	January 21, 2012
	*
	*
	*	@return string
	*/
	function genPageURL()
	{
		//declare var
		$currPage	= "index.php";
		$pageId		= 0;
		 
		//get the current page
		$currPage	=  basename($_SERVER['PHP_SELF']);
		
		if($currPage != 'content.php')
		{
			//get the corresponding static key
			$pageId = $this->getValueByKey($currPage, 'url', 'static_id', 'static', 0);
			
		}
		else
		{
			$seoNV = $_SERVER['QUERY_STRING'];
			 
			if(strpos($seoNV, '=') !== false)
			{
			    //get the seo url value
				$nv		= explode("=", $seoNV);
				$seoN	= trim($nv[0]);
				$seoV	= trim($nv[1]);	
				
				//get the corresponding static key
				$pageId = $this->getValueByKey($seoV."/", 'seo_url', 'static_id', 'static', 0);
				
			 }
		}
		
		//return the value
		return $pageId;
		 
	}//eof
	
	
	
	//get all static download id 
	function staticDownId()
	{
		//declare variables
		$data	= array();
		
		//conditions
		$sql	= "SELECT static_download_id FROM static_download";
				
		$query	= mysql_query($sql);
		
		
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->static_download_id;
			}
		}
		return $data;
		
	}
	
	
	
	//get all static download id 
	function staticDownstatusId($id)
	{
		//declare variables
		$data	= array();
		
		//conditions
		$sql	= "SELECT static_id FROM static_download WHERE static_download_id = $id";
				
		$query	= mysql_query($sql);
		
		
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->static_download_id;
			}
		}
		return $data;
		
	}
	
	
	/**
	*	Populate a dropdown list of static id, if there is any selected static, it seletec it first.
	*	This function retrieve the data in recursive manner.
	*
	*	@date August 29, 2012
	*
	*	@param
	*			$id			Parent id of the category
	*			$level		Depth of the category
	*			$selected	Selected category by user, if not any then it will produce the normal list
	*			$type		Type decides whether the list will produce to add a category or to edit
	*						an existing category. The only constant is EDIT.
	*			$sId		Applicable for editing purpose. For editing it won't display its name in the 
	*						parent section so that the user won't add the child as it's parent
	*
	*	@return NULL
	*/
	
	
	function populateContentList($id, $level, $selected, $type, $sId)
	{
		//create conditional statement based on type criteria. This will determine whether 
		//the dropdown is for editing content or adding content
		if($type == 'EDIT')
		{
			$select = "SELECT 	* 
					   FROM 	static 
					   WHERE 	parent_static_id='$id' 
					   AND 		static_id <> $sId 
					   ORDER BY title 
					  ";
		}
		else
		{
			$select = "SELECT 	* 
					   FROM 	static 
					   WHERE 	parent_static_id='$id' 
					   ORDER BY title 
					  ";
		}
		
		//execute statement
		$query  = mysql_query($select);
		//echo $select.mysql_error();exit;
		
		//fetch the data
		while($result = mysql_fetch_array($query))
		{
			//get the static id
			$new_static_id = $result['static_id'];
			
			//check for already selected content
			if($selected == $new_static_id)
			{
				$select_string = 'selected';
			}
			else
			{
				$select_string = '';
			}
			
			//display result by concatenating the strings
			echo "<option value='".$new_static_id."' class='menuText' ".$select_string.">".str_repeat("&nbsp;&nbsp;&nbsp;",$level)." ".$result['title']."</option>";
					
				 
			
			$this->populateContentList($new_static_id, $level+1, $selected, $type, $sId);
		}
		
	}//eof
	
	
	
######################################################################################################################
#
#													Static Banner 
#
######################################################################################################################


/* 
	*	Add a new banner image. Once a image has added the old one will be automatically deleted.
	*
	*	@param	$name	Name or caption of the photo
	*	@param	$desc	Additinal description if required later, not for this version
	*	
	*	@return int
	*/
	function createStaticBanner($static_id, $banner_title, $description,  $banner_url, $open_in, $status, $sort_order)
	{
		//add security
		$banner_title 		= mysql_real_escape_string(trim($banner_title));
		$description 		= nl2br(mysql_real_escape_string(trim($description)));
		
		
		//insert and make the photo active
		$insert  = "INSERT INTO static_banner 
					(static_id, banner_title, description, banner_url, open_in,  status, sort_order, added_on)
					VALUES
					('$static_id','$banner_title','$description', '$banner_url', '$open_in', '$status', '$sort_order', now())
					";
		//execute the query 			
		$query   = mysql_query($insert);
		
		//echo $insert.mysql_error(); exit;
		
		$id      = mysql_insert_id();
		
		//return id
		return $id;
	}//eof
	
	/* 
	*	Edit a front image
	*	
	*	@param	$id		Id of teh image
	*	@param	$name	Name or caption of the photo
	*	@param	$desc	Additinal description if required later, not for this version
	*/
	function editStaticBanner($id, $banner_title, $description, $banner_url, $open_in, $sort_order, $status)
	{
		//add security
		$banner_title 		= mysql_real_escape_string(trim($banner_title));
		$description 		= nl2br(mysql_real_escape_string(trim($description)));
		
		//update
		$update  = "UPDATE static_banner 
					SET
					banner_title 			= '$banner_title',
					description				= '$description',
					banner_url				= '$banner_url',
					open_in					= '$open_in',
					sort_order				= '$sort_order',
					modified_on				=  now(),
					status					= '$status'
					WHERE 
					static_banner_id	    = '$id'
					";
		
		//execute the query			
		$query   = mysql_query($update);
		
		//echo $update.mysql_error();exit;
		
		if(!$query)
		{
			return mysql_error();
		}
	}//eof
	
	/**
	*	Delete an static banner
	*
	*	$id				Static Banner Id 
	*	$static_id		Static banner Id
	*	$path			path of the image
	*/
	function deleteStaticBanner($bid, $path)
	{
		//delete the image first
		$this->deleteFile($bid, 'static_banner_id' , $path, 'photo', 'static_banner');
		$delete = "DELETE FROM static_banner WHERE static_banner_id='$bid'";
		$query  = mysql_query($delete);
		if(!$query)
		{
			return mysql_error();
		}
	}//eof
	
	
	/**
	*	This function will delete a file from the server and update the
	*	file field, set it to blank
	*
	*	@param
	*			$id				Primary key associated with the table
	*			$column_id		Primary key column name
	*			$path			Path to the file or location of the file
	*			$column_file	Column name of the file
	*			$table			Name of the file
	*			$static_id		Static Id column name
	*			$sid			Static Id Value
	*
	*	@return NULL
	*/
	function deleteBannerImg($id, $column_id ,$path, $column_file, $table, $static_id, $sid)
	{
		//get the file name before deleting
		$select = "SELECT ".$column_file." FROM ".$table." WHERE ".$column_id."='".$id."' AND ".$static_id."='".$sid."'";
		
		$query  = mysql_query($select);
		
		$result = mysql_fetch_array($query);
		
		if(mysql_num_rows($query) > 0)
		{
			$fileName = $result[$column_file];
			@unlink($path.$fileName); 
		}
		
		//set the column value
		$sql = "UPDATE ".$table." SET ".$column_file."= '' WHERE ".$column_id."='".$id."'";
		mysql_query($sql);
		
		//echo $select." <br />".$sql;exit;
	}//eof
	
	
	
	/**
	*	Retrieve all photo id
	*	@param	$id		photo id
	*	@return array
	*/
	function getStaticBannerId($static_id){
		$data	= array();
		$sql	= "SELECT static_banner_id FROM static_banner WHERE static_id = '$static_id' ORDER BY added_on DESC";
		$query	= $this->conn->query($sql);
		if($query->num_rows > 0)
		{
			while($result = $query->fetch_object())
			{
				$data[] = $result->static_banner_id;
			}
		}
		return $data;
	}//eof
	
	
	
	/**
	*	Retrieve all static banner data
	*
	*	@return array
	*	@param	$id		id of the front image
	*/
	function getStaticBanner($id)
	{
		//create the statement
		$sql	= "SELECT * FROM static_banner WHERE static_banner_id= '$id'";
		
		$query	= mysql_query($sql);
		$data	= array();
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			$data = array(
							 $result->banner_title,			//0
							 $result->description,			//1
							 $result->photo,				//2
							 $result->status,				//3
							 $result->added_on,				//4
							 $result->modified_on,			//5
							 
							 $result->sort_order,			//6 Added On: September 22, 2011
							 $result->static_id,			//7 Added on : August 10, 2012
							 $result->banner_url,			//8
							 $result->open_in				//9
						 );
		}
		return $data;
	}//eof
	
	
	
	/**
	*	Retrieve all front image data
	*
	*	@return array
	*	@param	$id		id of the front image
	*/
	function getStaticBannerData($id,$static_id)
	{
		//create the statement
		$sql	= "SELECT * FROM static_banner
				   WHERE
				   static_id	= '$static_id'
				   AND
				   static_banner_id= '$id'";
		
		//execute the query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		$data	= array();
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			$data = array(
							 $result->banner_title,			//0
							 $result->description,			//1
							 $result->photo,				//2
							 $result->status,				//3
							 $result->added_on,				//4
							 $result->modified_on,			//5
							 
							 $result->sort_order,			//6 Added On: September 22, 2011
							 $result->static_id,			//7 Added on : August 10, 2012
							 $result->banner_url,			//8
							 $result->open_in				//9
						 );
		}
		return $data;
	}//eof
	
	
	/**
	*	Retrieve all front image data
	*
	*	@return array
	*	@param	$id		id of the front image
	*/
	function getStaticBannerDataById($id)
	{
		//create the statement
		$sql	= "SELECT * FROM static_banner
				   WHERE
				   static_banner_id= '$id'";
		
		//execute the query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		$data	= array();
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			$data = array(
							 $result->banner_title,			//0
							 $result->description,			//1
							 $result->photo,				//2
							 $result->status,				//3
							 $result->added_on,				//4
							 $result->modified_on,			//5
							 
							 $result->sort_order,			//6 Added On: September 22, 2011
							 $result->static_id,			//7 Added on : August 10, 2012
							 $result->banner_url,			//8
							 $result->open_in				//9
						 );
		}
		return $data;
	}//eof
	
	
	/**
	*	Get Active ID
	*/
	function getStatBannerActiveId($ban_id)
	{
		$data	= array();
		
		//statement
		$sql 	= "SELECT static_banner_id FROM static_banner WHERE static_banner_id= '$ban_id' AND status='a' ORDER BY  added_on DESC";
		$query 	= mysql_query($sql);
		
		//check for the rows
		if(mysql_num_rows($query) > 0)
		{
			while($row  = mysql_fetch_object($query))
			{
				$data[]  = $row->static_banner_id;
			}
		}
		
		//return the value
		return $data;
	}//eof
	
	
	/**
	*	Get Active ID
	*/
	function getStatBannerActiveMaxId($static_id)
	{
		$data	= array();
		
		//statement
		$sql 	= "SELECT static_banner_id FROM static_banner WHERE static_id = '$static_id' AND status='a' ORDER BY sort_order ASC, added_on DESC LIMIT 1";
		$query 	= mysql_query($sql);
		
		//check for the rows
		if(mysql_num_rows($query) > 0)
		{
			while($row  = mysql_fetch_object($query))
			{
				$data[]  = $row->static_banner_id;
			}
		}
		
		//return the value
		return $data;
	}//eof
	
	
	
	/**
	*	Rotate the image in a random manner in the index page.
	*
	*	@param
	*			$path		Path to the image
	*
	*	@return NULL
	*/
	function rotateImg($path)
	{
		//get all the active image
		$actIds	= $this->getStatBannerActiveId();
		
		if(count($actIds) > 0)
		{
			//generate random number
			$randNum	= mt_rand(0, (count($actIds) - 1));
			
			//get the random image id
			$imgId		= $actIds[$randNum];
			
			$imageDtl	= $this->getStaticBanner($imgId);
			
			if(count($imageDtl) > 0)
			{	
				//get the time and teh image
				$title	= $imageDtl[0];
				$image	= $imageDtl[2];
				
				//display the image
				$this->imgDisplay($path, $image, 604, 428, 0, '', $title, '');
			}
		}
		
		
	}//eof
	
	
	
	/**
	*	Display front image
	*
	*	@param
	*			$dir				Image directory
	*			$name				Image name
	*			$displayHeight		Height to be displayed
	*			$displayWidth		Width of the images to be displayed
	*			$border				If want to put any border around the image
	*			$class				If any class is aplicable
	*			$alt				Alternative text to the image
	*
	*	@return string
	*/
	function renderFrontImage($path, $displayWidth, $displayHeight, $border, $class, $alt, $str)
	{
		//declare vars
		$ffId		= 0;
		$imgStr		= '';
		
		//get front image id
		$activeIds	= $this->getStatBannerActiveId();
		
		//first entry
		if(count($activeIds) == 0)
		{
			$imgStr	.= '<img src="'.$path.'maine-coast-barn.jpg" alt="Maine Coast Barn"  width="604"
					   height="428" />
					   <div id="mainImgTextAlign" class="fVerdana fWhite cover boxcaption">
							<div class="fS13 bld padT10 padB10 padL10">Maine Coast Barn</div>
							<div class="fS11 padT5 padL10">
								This barn was designed for the rocky, forested coastline 
								of the state of Maine.				
							</div>
					    </div>
					   ';
		}
		else
		{
			//get the primary key
			$ffId	= $activeIds[0];
			
			//get the detail
			$ffDtl	 = $this->getStaticBanner($ffId);
			
			//render image
			$imgStr	.= $this->imgDisplayR($path, $ffDtl[2], $displayWidth, $displayHeight, $border, $class, $ffDtl[0], $str);
			
			//render text with effect
			$imgStr	.= '<div id="mainImgTextAlign" class="fVerdana fWhite cover boxcaption">
							<div class="fS13 bld padT10 padB10 padL10">'.$ffDtl[0].'</div>
							<div class="fS11 padT5 padL10">
								'.$ffDtl[1].'				
							</div>
					    </div>';
			
		}

		//return the image string
		return $imgStr;
		
	}//eof
	
	
	
	
	/**
	*	Generate number of sub section fields for banner
	*
	*	@param
	*			$num		Number of sub section or description
	*
	*	@return string
	*/
	function genFileImg($num)
	{
		
		//declare variables
		$data		= '';
		$num		= (int)$num;
		$arr_value	= array('a','d'); 
		$arr_label	= array('a','d');
		
		if($num >= 1)
		{
			$data	= '<table width="100%">';
			//loop
			for($k = 0; $k < $num; $k++)
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
				
				
				//status
				if(isset($_SESSION['selSubStatus'][$k]))
				{
					$selSubStatus[$k]	= $_SESSION['selSubStatus'][$k];
				}
				else
				{
					$selSubStatus[$k]	= 'd';
				}
				
				$data	.= '
							<label>Section['.$j.']</label>
						  	<div class="cl"></div>
						   
						   <label>Banner Heading</label>
						   <input name="txtSubTitle[]" type="text" class="text_box_large" 
								id="txtSubTitle[]" value="'.$txtSubTitle[$k].'" size="50" />
							<div class="cl"></div>
						   
						  <label>Short Description</label>
						  <textarea  name="txtSubDesc[]" id="txtSubDesc'.$k.'" cols="70" rows="10" class="textAr">'.$txtSubDesc[$k].'</textarea>
						  <div class="cl"></div>
						   
						   <label>Upload Banner</label>
							<input name="fileSubImg[]" type="file" class="text_box_large"
							 id="fileSubImg[]"> (max 800 X 800 pixels in width by height) 
						   <div class="cl"></div>
						   
						  <label>Status</label>
							<select name="selSubStatus[]" class="textBoxA">
								'.$this->genDropDownR($selSubStatus[$k], $arr_value, $arr_label).'
							</select>
						   ';
			}
			
			//concate
			$data	.= '</table>';
		}
		
		//return the value
		return $data;
		
	}//eof	
	
	
	
	/**
	*	Hold the sub-sections in session array
	*
	*	@param
	*			$num	Number of sub-section or additional pragraphs
	*
	*	@return array
	*/
	function bannerSubInSess($num)
	{
		//declare variables
		$data	= array();
		$num	= (int)$num;
		
		if($num >= 1)
		{
			for($m = 0; $m < $num; $m++)
			{
				//title
				if(isset($_POST['txtSubTitle'][$m]))
				{
					$_SESSION['txtSubTitle'][$m]	= $_POST['txtSubTitle'][$m];
				}
				else
				{
					$_SESSION['txtSubTitle'][$m]	= '';
				}
				
				//description
				if(isset($_POST['txtSubDesc'][$m]))
				{
					$_SESSION['txtSubDesc'][$m]	= $_POST['txtSubDesc'][$m];
				}
				else
				{
					$_SESSION['txtSubDesc'][$m]	= '';
				}
				
				//image position
				if(isset($_POST['selSubStatus'][$m]))
				{
					$_SESSION['selSubStatus'][$m]	= $_POST['selSubStatus'][$m];
				}
				else
				{
					$_SESSION['selSubStatus'][$m]	= '';
				}
				
				$data[]	= $_SESSION['txtSubTitle'][$m];
				$data[]	= $_SESSION['txtSubDesc'][$m];
				$data[]	= $_SESSION['selSubStatus'][$m];
				
			}//for
		}//if
		
		
		//return data
		return $data;
		
	}//eof
	
	
	
	/**
	*	Delete the banner sub-sections variables registered in session array
	*
	*	@param
	*			$num	Number of sub-section or additional pragraphs
	*
	*	@return null
	*/
	function delBannerSubInSess($num)
	{
		//declare variables
		$num	= (int)$num;
		
		if($num >= 1)
		{
			for($m = 0; $m < $num; $m++)
			{
				//title
				if( isset($_SESSION['txtSubTitle'][$m]) )
				{
					$_SESSION['txtSubTitle'][$m] = '';
					unset($_SESSION['txtSubTitle'][$m]);
				}
				
				//description
				if( isset($_SESSION['txtSubDesc'][$m]) )
				{
					$_SESSION['txtSubDesc'][$m] = '';
					unset($_SESSION['txtSubDesc'][$m]);
				}
				
				//image position
				if( isset($_SESSION['selSubStatus'][$m]) )
				{
					$_SESSION['selSubStatus'][$m] = '';
					unset($_SESSION['selSubStatus'][$m]);
				}
				
			}//for
			
		}//if
				
	}//eof
	
	
	
	/**
	*	Get front employer
	*	
	*	@return array
	*/
	function getsingleImg($limit)
	{
		if((int)$limit > 0)
		{
			$sql	= "SELECT static_banner_id FROM static_banner WHERE status='a' LIMIT $limit";
		}
		else
		{
			
				$sql = '';	    
		}
		
		$query	= mysql_query($sql);
		
		$data	= array();
		
		if(mysql_num_rows($query) > 0)
		{
			while($result	= mysql_fetch_array($query))
			{
				$data[]	= $result['static_banner_id'];
				//echo $result['job_id']."<br>";
			}
		}
		
		return $data;
	}//eof
	
	
	
	/**
	*	Display front
	*/
	function displayBannerImg($limit)
	{
		$jobIds	= array();
		
		$actFnt = $this->getsingleImg($limit);
		$active	= $this->getStatBannerActiveId();
		
		if(count($actFnt) > 0)
		{
			$banIds = $actFnt;
		}
		elseif(count($active) > 0)
		{
			$banIds = $active;
		}
		else
		{
			$banIds = $banIds;
		}
		
		return $banIds;
	}//eof
	
	
	
	
	/**
	*	Display static banner with delete options
	*
	*	@param 
	*			$static_id		Static Id
	*			$path			Path to the image
	*
	*	@return string
	*/
	function showDelStaticBannerDtl($static_id, $path)
	{
		//declare variables
		$data		= '';
		$arr_value	= array('a','d'); 
		$arr_label	= array('a','d');
	
		//static detail ids detail
		$statSubBanDtlIds 	= $this->getStatBannerActiveId($ban_id);
		
		$j = 1;
		if(count($statSubBanDtlIds) > 0)
		{
			$data	.=  "<table width='100%' cellspacing='0' cellpadding='0' border='0'>";
			
			foreach($statSubBanDtlIds as $x)
			{
				$staticBanSubDtl = $this->getStaticBannerData( $x, $static_id );
				
				if( ($staticBanSubDtl[2] != '' ) && (file_exists($path.$staticBanSubDtl[2])) )
				{
					$delSubStr	= "<input name=\"delSubImg[]\" type=\"checkbox\" value=\"1\"> <span class='blackLarge'>Delete this image</span>";
				}
				else
				{
					$delSubStr	= '';
				}
				
				$data	.=  '
				  
				
					 	<h4>Section['.$j.']
					 	<input name="delOption[]" type="checkbox" value="'.$x.'" />
					 	<span class="orangeLetter"> Delete </span>
						</h4>
					 <div class="cl"></div>
					 
				   <label>Title </label>
						<input name="txtSubTitle[]" type="text" class="text_box_large" 
						id="txtSubTitle[]" value="'.$staticBanSubDtl[0].'" size="50" />
					<div class="cl"></div>
					
					<label>Description</label>
						<textarea  name="txtSubDesc[]" id="txtSubDesc[]" cols="70" 
						class="textAr" rows="10" wrap="PHYSICAL" >
						'.str_replace('<br />','',trim(stripslashes($staticBanSubDtl[1]))).'
						</textarea>
					<div class="cl"></div>
				   
				   <label>Image</label>
						 <div class="fr">
						 '.$this->imgDisplay($path, $staticBanSubDtl[2], 75, 100, 0, 
						  					 'greyBorder',$staticBanSubDtl[0], "").'
						 </div>
						 <input name="fileSubImg[]" type="file" class="text_box_large"
						 id="fileSubImg[]"> (max. 800 X 800 pixels in width by height)<br />
						 '.$delSubStr.'
						  
						<div class="cl"></div>
					 
				   
				  <label>Image Position </label>
						<select name="selSubStatus[]" class="textBoxA">
							'.$this->genDropDownR($staticBanSubDtl[3], $arr_value, $arr_label).'
						</select>
				 ';
				  $j++;
			}
			
			$data	.=  " </table>";
		}
		
		//return the value
		return $data;
		
	}//eof
	
	/**
	*	Delete a static banner
	*
	*	@param 
	*			$id			Static id
	*			$path		Path to the images
	*
	*	@return string
	*/
	function delStaticBanner($id, $path)
	{
		//delete the image first
		$this->deleteFile($id, 'static_banner_id' , $path, 'photo', 'static_banner');
		
		//delete from static detail
		$sql	= "DELETE FROM static_banner WHERE static_banner_id='$id'";
		$query	= mysql_query($sql);
		
		
		$result = '';
		if(!$query)
		{
			$result = "ER103";
		}
		else
		{
			$result = "SU103";
		}
		
		//return the result
		return $result;
	}//eof
	
	/**
	* 	Add static image	
	*		
	*	@param
	*			$static_id			Static Id
	*			$title				Title of the image
	*			
	*	@return	int
	*/
	function addStaticImg($static_id, $title)
	{
		//security
		$static_id			= (int)$static_id;
		$title				= $title;

		
		//statement
		$sql 	= "INSERT INTO static_image
				   (static_id, image_name, added_on)
				   VALUES
				   ('$static_id','$title', now())";
				    
		
		//execute query
		$query	= mysql_query($sql);
		
		//echo $sql.mysql_error();exit;
		
		//get the primary key
		$result = mysql_insert_id();
		
		//return result
		return $result;
	}//eof
	
	/**
	*	Display All static image Ids
	*
	*	@param
	*		
	*		$id		static id		
	*
	*
	*	@return  array
	*/

	function getAllStaticImgIds($id)
	{
		
		$data	= array();
		
		//statement
		$sql 	= "SELECT image_id FROM static_image WHERE static_id='$id' ";
		$query 	= mysql_query($sql);
		
		//check for the rows
		if(mysql_num_rows($query) > 0)
		{
			while($row  = mysql_fetch_object($query))
			{
				$data[]  = $row->image_id;
			}
		}
		
		//return the value
		return $data;

	}//eof
	
	/**
	*	Retrieve all static image data
	*
	*	@return array
	*	@param	$id		id of the static image
	*/
	function getStaticImage($id)
	{
		//create the statement
		$sql	= "SELECT * FROM static_image WHERE image_id= '$id'";
		
		$query	= mysql_query($sql);
		$data	= array();
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			$data = array(
							 $result->static_id,			//0
							 $result->image_name,			//1
							 $result->image,				//2
							 $result->added_on,				//4
							 $result->modified_on			//5
						 );
		}
		return $data;
	}//eof
	
		/**
	*	Get parent page name
	*
	*	@param
	*			$stiticId				Static id or primary key of the page
	*
	*	@return string
	*/
	function getParentPageName($staticId){
		
		$psName	= '';
		$sql	= "SELECT title FROM static WHERE static_id = $staticId";
		$query	= $this->conn->query($sql);
		if($query->num_rows > 0){
			$result	= $query->fetch_object();
			$psName	= $result->title;
		}
		//return the result
		return $psName;

	}//eof
	
	/**
	*	Retrieve all static id depending on conditions
	*
	*	@param
	*			$id		Value of the type to search for
	*			$type	Type of result set id
	* 
	*
	*	@return array
	*/
	function getCurrentStaticId()
	{
		//declare variables
		$sql	= '';
		$data	= array();
		
		$sql	= "SELECT static_id FROM static ORDER BY added_on DESC";

		//execute the query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->static_id;
			}
		}
		return $data;
	}//eof
	
}//end of static

?>