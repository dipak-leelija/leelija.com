<?php
/**
*	This is a generic utility class, offer seamless integration with many other application
*	wherever required. 	
*
*	UPDATE	March 30, 2011
*	Added function for youtube video section. Generate youtube embeded code if the url entered by the user
*	is the direct url of the video.
*
*	@author		Himadri Shekhar Roy
*	@date		December 06, 2009 
*	@version	2.0
*	@copyright	Analyze System
*	@url		http://www.ansysoft.com
*	@email		himadri.s.roy@ansysoft.com
* 
*/
 
include_once('utility.class.php');
 
class ImageUtility extends Utility
{
	
	/**
	*	This function will resize the image with a desired size, before uploading in the server
	*
	*	@param
	*			$fileName		Name of the file that is going to upload
	*			$fileIndex		File Index is required to identify the images if there are
	*							different types of images in the same directory or folder.
	*							e.g. ABC-STAT-12.jpg and ABC-CAT-12.jpg, where STAT stands for
	*							static and CAT stands for category.
	*			$newName		The unique name generated by the system after renaming the image
	*							while uploading the server.
	*			$path			Directory or folder where the images have to store
	*			$width			Desirable width limit of the image
	*			$height			Desirable height limit of the image
	*			$id				Primary key associated with the image
	*			$column_file	Column name of the image
	*			$column_id		Column name of the primary key
	*			$table			Name of the table
	*
	*	@return		string
	*
	*/
	function imgUpdResize($fileName, $fileIndex, $newName, $path, $width, $height,  $id, $column_file, $column_id, $table)					 
	{
		
		//variables and values
		$file_type = $fileName['type'];
        $file_name = $fileName['name'];
        $file_size = $fileName['size'];
        $file_tmp =  $fileName['tmp_name'];
		
		
		$newWidth 	= 0;
		$newHeight	= 0;
		
		
		//image type
		if($file_type == "image/pjpeg" || $file_type == "image/jpeg")
		{
			$new_img = @imagecreatefromjpeg($file_tmp);
		}
		elseif($file_type == "image/x-png" || $file_type == "image/png")
		{
			$new_img = @imagecreatefrompng($file_tmp);
		}
		elseif($file_type == "image/gif")
		{
			$new_img = @imagecreatefromgif($file_tmp);
		}
			
		
		//image size
		$old_size  	= @getimagesize($file_tmp);
		$old_width 	= $old_size[0];
		$old_height = $old_size[1];
		
		//create the file name
		$file_new_name = $newName; 
		
		
		if(($old_width <= $width) && ($old_height <= $height))
		{
			@move_uploaded_file($file_tmp, $path.$file_new_name);	
			 		
		}
		else
		{
			 /*   echo "OldW = ".$old_width." NewWidth = ".$width.
			 " Old Height = ".$old_height." New Height = ".$height."I am here 2"; */
			 
			//comparing the sizes
			if(($old_width <= $width) && ($old_height <= $height))
			{
				$newWidth 	= $old_width;
				$newHeight 	= $old_height;
			}
			elseif(($old_width <= $width) || ($old_height <= $height))
			{
				$wRatio	= ($old_width/$width);
				$hRatio = ($old_height / $height);
				
				if($wRatio > $hRatio)
				{
					$newWidth 	= $old_width;
					$newHeight  = (int)(($old_height/$old_width) * $newWidth);
				}
				else
				{
					$newHeight  = $old_height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
				}
			}
			elseif(($old_width > $width) && ($old_height > $height))
			{
				$wRatio	= ($old_width/$width);
				$hRatio = ($old_height / $height);
				
				if($wRatio > $hRatio)
				{
					$newWidth 	= $width;
					$newHeight  = (int)(($old_height/$old_width) * $newWidth);
				}
				else
				{
					$newHeight  = $height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
				}
			}
			elseif(($old_width > $width) || ($old_height > $height))
			{
				
				if($old_width > $old_height)
				{
					$newWidth  = $width;
					$newHeight = (int)(($old_height/$old_width) * $newWidth);
					
					if($newHeight > $height)
					{
						$newHeight = $height;
					}
				}
				elseif($old_width < $old_height)
				{
					$newHeight  = $height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
					
					
					if($newWidth > $width)
					{
						$newWidth = $width;
					}
				}
				else
				{
					$newHeight 	= $height;
					$newWidth 	= $width;
				}
			}
			else
			{
				$newHeight 	= $height;
				$newWidth 	= $width;
			}
			
		  // $percent = 0.75;
			
		  // $newWidth  = $old_width * $percent;
		  // $newHeight = $old_height * $percent;
		   
		   
		   //creating image
		   $resized_img = @imagecreatetruecolor($newWidth,$newHeight);
		  
		   @imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newWidth, $newHeight, $old_width, $old_height);
		
		   //save image
		   imagejpeg ($resized_img, $path.$file_new_name);
		   imagedestroy ($resized_img);
		   imagedestroy ($new_img);
		   
		 
	   }
	   //update the table
	   $update = "UPDATE ".$table." SET ".$column_file."='$newName' WHERE ".$column_id."='$id' ";
	   $query  = mysql_query($update);

	   if(!$query)
	   {
		   return 'ER001';
	   }
	   else
	   {
		   return $fileName['tmp_name']." ".$path.$newName;
	   }
	   
	}//eof
	
	
	
	   
   /**
	*	This function will work as an array. This function will resize the image with a 
	*	desired size
	*
	*
	*	@param
	*			$fileName		Name of the file that is going to upload
	*			$fileIndex		File Index is required to identify the images if there are
	*							different types of images in the same directory or folder.
	*							e.g. ABC-STAT-12.jpg and ABC-CAT-12.jpg, where STAT stands for
	*							static and CAT stands for category.
	*			$newName		The unique name generated by the system after renaming the image
	*							while uploading the server.
	*			$path			Directory or folder where the images have to store
	*			$width			Desirable width limit of the image
	*			$height			Desirable height limit of the image
	*			$id				Primary key associated with the image
	*			$column_file	Column name of the image
	*			$column_id		Column name of the primary key
	*			$table			Name of the table
	*
	*	@return		string
	*
	*/
	function imgUpdResizeArr($i, $fileName, $fileIndex, $newName, $path, $width, $height, 
						  $id, $column_file, $column_id, $table)
	{
		
		//variables and values
		$file_type = $fileName['type'][$i];
        $file_name = $fileName['name'][$i];
        $file_size = $fileName['size'][$i];
        $file_tmp =  $fileName['tmp_name'][$i];
		
		
		//echo $file_type." ".$file_name." ".$file_size." ".$file_tmp;exit;
		
		$newWidth 	= 0;
		$newHeight	= 0;
		
		
		//image type
		if($file_type == "image/pjpeg" || $file_type == "image/jpeg")
		{
			$new_img = @imagecreatefromjpeg($file_tmp);
		}
		elseif($file_type == "image/x-png" || $file_type == "image/png")
		{
			$new_img = @imagecreatefrompng($file_tmp);
		}
		elseif($file_type == "image/gif")
		{
			$new_img = @imagecreatefromgif($file_tmp);
		}
			
		
		//image size
		$old_size  	= @getimagesize($file_tmp);
		$old_width 	= $old_size[0];
		$old_height = $old_size[1];
		
		//create the file name
		$file_new_name = $newName; 
		
		
		if(($old_width <= $width) && ($old_height <= $height))
		{
			@move_uploaded_file($file_tmp, $path.$file_new_name);	
			 		
		}
		else
		{
			 /*   echo "OldW = ".$old_width." NewWidth = ".$width.
			 " Old Height = ".$old_height." New Height = ".$height."I am here 2"; */
			 
			//comparing the sizes
			if(($old_width <= $width) && ($old_height <= $height))
			{
				$newWidth 	= $old_width;
				$newHeight 	= $old_height;
			}
			elseif(($old_width <= $width) || ($old_height <= $height))
			{
				$wRatio	= ($old_width/$width);
				$hRatio = ($old_height / $height);
				
				if($wRatio > $hRatio)
				{
					$newWidth 	= $old_width;
					$newHeight  = (int)(($old_height/$old_width) * $newWidth);
				}
				else
				{
					$newHeight  = $old_height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
				}
			}
			elseif(($old_width > $width) && ($old_height > $height))
			{
				$wRatio	= ($old_width/$width);
				$hRatio = ($old_height / $height);
				
				if($wRatio > $hRatio)
				{
					$newWidth 	= $width;
					$newHeight  = (int)(($old_height/$old_width) * $newWidth);
				}
				else
				{
					$newHeight  = $height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
				}
			}
			elseif(($old_width > $width) || ($old_height > $height))
			{
				
				if($old_width > $old_height)
				{
					$newWidth  = $width;
					$newHeight = (int)(($old_height/$old_width) * $newWidth);
					
					if($newHeight > $height)
					{
						$newHeight = $height;
					}
				}
				elseif($old_width < $old_height)
				{
					$newHeight  = $height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
					
					
					if($newWidth > $width)
					{
						$newWidth = $width;
					}
				}
				else
				{
					$newHeight 	= $height;
					$newWidth 	= $width;
				}
			}
			else
			{
				$newHeight 	= $height;
				$newWidth 	= $width;
			}
			
		  // $percent = 0.75;
			
		  // $newWidth  = $old_width * $percent;
		  // $newHeight = $old_height * $percent;
		   
		   
		   //creating image
		   $resized_img = @imagecreatetruecolor($newWidth,$newHeight);
		  
		   @imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newWidth, $newHeight, $old_width, $old_height);
		
		   //save image
		   imagejpeg ($resized_img, $path.$file_new_name);
		   imagedestroy ($resized_img);
		   imagedestroy ($new_img);
		   
		 
	   }
	   //update the table
	   $update = "UPDATE ".$table." SET ".$column_file."='$newName' WHERE ".$column_id."='$id' ";
	   $query  = mysql_query($update);
	   //echo $update.mysql_error();exit;
	   if(!$query)
	   {
		   return 'ER001';
	   }
	   else
	   {
		   return $fileName['tmp_name']." ".$path.$newName;
	   }
	   
	}//eof
	
	
	function imgUpdResizeArr2($i, $fileName, $fileIndex, $newName, $path, $width, $height, 
						  $id, $column_file, $column_id, $table)
	{
		
		//variables and values
		$file_type = $fileName['type'][$i];
        $file_name = $fileName['name'][$i];
        $file_size = $fileName['size'][$i];
        $file_tmp =  $fileName['tmp_name'][$i];
		
		
		//echo $file_type." ".$file_name." ".$file_size." ".$file_tmp;exit;
		
		$newWidth 	= 0;
		$newHeight	= 0;
		
		
		//image type
		if($file_type == "image/pjpeg" || $file_type == "image/jpeg")
		{
			$new_img = @imagecreatefromjpeg($file_tmp);
		}
		elseif($file_type == "image/x-png" || $file_type == "image/png")
		{
			$new_img = @imagecreatefrompng($file_tmp);
		}
		elseif($file_type == "image/gif")
		{
			$new_img = @imagecreatefromgif($file_tmp);
		}
			
		
		//image size
		$old_size  	= @getimagesize($file_tmp);
		$old_width 	= $old_size[0];
		$old_height = $old_size[1];
		
		//create the file name
		$file_new_name = $newName; 
		
		
		if(($old_width <= $width) && ($old_height <= $height))
		{
			@move_uploaded_file($file_tmp, $path.$file_new_name);	
			 		
		}
		else
		{
			 /*   echo "OldW = ".$old_width." NewWidth = ".$width.
			 " Old Height = ".$old_height." New Height = ".$height."I am here 2"; */
			 
			//comparing the sizes
			if(($old_width <= $width) && ($old_height <= $height))
			{
				$newWidth 	= $old_width;
				$newHeight 	= $old_height;
			}
			elseif(($old_width <= $width) || ($old_height <= $height))
			{
				$wRatio	= ($old_width/$width);
				$hRatio = ($old_height / $height);
				
				if($wRatio > $hRatio)
				{
					$newWidth 	= $old_width;
					$newHeight  = (int)(($old_height/$old_width) * $newWidth);
				}
				else
				{
					$newHeight  = $old_height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
				}
			}
			elseif(($old_width > $width) && ($old_height > $height))
			{
				$wRatio	= ($old_width/$width);
				$hRatio = ($old_height / $height);
				
				if($wRatio > $hRatio)
				{
					$newWidth 	= $width;
					$newHeight  = (int)(($old_height/$old_width) * $newWidth);
				}
				else
				{
					$newHeight  = $height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
				}
			}
			elseif(($old_width > $width) || ($old_height > $height))
			{
				
				if($old_width > $old_height)
				{
					$newWidth  = $width;
					$newHeight = (int)(($old_height/$old_width) * $newWidth);
					
					if($newHeight > $height)
					{
						$newHeight = $height;
					}
				}
				elseif($old_width < $old_height)
				{
					$newHeight  = $height;
					$newWidth 	= (int)(($old_width/$old_height) * $newHeight);
					
					
					if($newWidth > $width)
					{
						$newWidth = $width;
					}
				}
				else
				{
					$newHeight 	= $height;
					$newWidth 	= $width;
				}
			}
			else
			{
				$newHeight 	= $height;
				$newWidth 	= $width;
			}
			
		  // $percent = 0.75;
			
		  // $newWidth  = $old_width * $percent;
		  // $newHeight = $old_height * $percent;
		   
		   
		   //creating image
		   $resized_img = @imagecreatetruecolor($newWidth,$newHeight);
		  
		   @imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newWidth, $newHeight, $old_width, $old_height);
		
		   //save image
		   imagejpeg ($resized_img, $path.$file_new_name);
		   imagedestroy ($resized_img);
		   imagedestroy ($new_img);
		   
		 
	   }
	   //update the table
	   $update = "UPDATE ".$table." SET ".$column_file."='$newName' WHERE ".$column_id."='$id' ";
	   $query  = mysql_query($update);
	   //echo $update.mysql_error();exit;
	   if(!$query)
	   {
		   return 'ER001';
	   }
	   else
	   {
		   //return $fileName['tmp_name']." ".$path.$newName;
	   }
	   
	}//eof
	
	
	
	/**
	*	This function will resize the image with a desired size, with fixed height and width
	*	thumb.
	*
	*	This function will resize the image with a desired size, before uploading in the server
	*
	*	@param
	*			$fileName		Name of the file that is going to upload
	*			$fileIndex		File Index is required to identify the images if there are
	*							different types of images in the same directory or folder.
	*							e.g. ABC-STAT-12.jpg and ABC-CAT-12.jpg, where STAT stands for
	*							static and CAT stands for category.
	*			$newName		The unique name generated by the system after renaming the image
	*							while uploading the server.
	*			$path			Directory or folder where the images have to store
	*			$width			Desirable width limit of the image
	*			$height			Desirable height limit of the image
	*			$id				Primary key associated with the image
	*			$column_file	Column name of the image
	*			$column_id		Column name of the primary key
	*			$table			Name of the table
	*
	*	@return		string
	*
	*/
	function imgCropResize($fileName, $fileIndex, $newName, $path, $width, $height,
						      $id, $column_file, $column_id, $table)
	{
		
		//variables and values
		$file_type = $fileName['type'];
        $file_name = $fileName['name'];
        $file_size = $fileName['size'];
        $file_tmp =  $fileName['tmp_name'];
		
		// echo $file_type."<br/>".$file_name."<br/>".$file_size."<br/>".$file_tmp;exit;
		
		//redefine the width and height
		if($width <= 0)
		{
			$width	= 1;
		}
		else
		{
			$width	= $width;
		}
		
		if($height <= 0)
		{
			$height	= 1;
		}
		else
		{
			$height	= $height;
		}
		
		
		$newWidth 	= $width;
		$newHeight	= $height;
		
		//get the desirable ratio
		$desRatio	= ($width/$height);
		
		
		//image type
		if($file_type == "image/pjpeg" || $file_type == "image/jpeg")
		{
			$new_img = imagecreatefromjpeg($file_tmp);
		}
		elseif($file_type == "image/x-png" || $file_type == "image/png")
		{
			$new_img = imagecreatefrompng($file_tmp);

			// echo $new_img;
		}
		elseif($file_type == "image/gif")
		{
			$new_img = imagecreatefromgif($file_tmp);
		}
			
		
		//image size
		$old_size  	= @getimagesize($file_tmp);
		$old_width 	= $old_size[0];
		$old_height = $old_size[1];
		
		//get the current image ratio
		$currRatio	= ($old_width/$old_height);
		
		//create the file name
		$file_new_name = $newName; 
		
		//define thumb image
		$resized_img = @imagecreatetruecolor($newWidth,$newHeight);
		
		//resize the image
		if($currRatio > $desRatio)
		{
			//corp the image
			@imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newWidth, $newHeight, $old_width, $old_height); 
		}
		else if($currRatio < $desRatio)
		{
			//resize the image in height
			$old_height	= ($old_width/$newWidth)* $newHeight;
			
			//corp the image
			@imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newWidth, $newHeight, $old_width, $old_height);
		}
		else
		{
			//corp the image
			@imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newWidth, $newHeight, $old_width, $old_height); 
		}
		
	   //save image
	   imagejpeg ($resized_img, $path.$file_new_name);
	   imagedestroy ($resized_img);
	   imagedestroy ($new_img);
		   
		 
	  
	   //update the table
	   $update = "UPDATE ".$table." SET ".$column_file."='$newName' WHERE ".$column_id."='$id' ";
	   $query  = $this->conn->query($update);
	   //echo $update;
	   if(!$query){
		   return 'ER001';
	   }else{
		   return $fileName['tmp_name']." ".$path.$newName;
	   }
	   
	}//eof
	
	   
   

	
	
	/**
	*	
	*	This function is the upgraded version of the previous function. This function is applicable for images which are in 
	*	array. Otherwise the functions are same. 
	*
	*	This function will resize the image with a desired size, before uploading in the server.
	*
	*	@param
	*			$fileName		Name of the file that is going to upload
	*			$fileIndex		File Index is required to identify the images if there are
	*							different types of images in the same directory or folder.
	*							e.g. ABC-STAT-12.jpg and ABC-CAT-12.jpg, where STAT stands for
	*							static and CAT stands for category.
	*			$newName		The unique name generated by the system after renaming the image
	*							while uploading the server.
	*			$path			Directory or folder where the images have to store
	*			$width			Desirable width limit of the image
	*			$height			Desirable height limit of the image
	*			$id				Primary key associated with the image
	*			$column_file	Column name of the image
	*			$column_id		Column name of the primary key
	*			$table			Name of the table
	*
	*	@return		string
	*
	*/
	function imgCropResizeArr($i, $fileName, $fileIndex, $newName, $path, $width, $height, 
						      $id, $column_file, $column_id, $table)
	{
		
		//variables and values
		$file_type = $fileName['type'][$i];
        $file_name = $fileName['name'][$i];
        $file_size = $fileName['size'][$i];
        $file_tmp =  $fileName['tmp_name'][$i];
		
		//redefine the width and height
		if($width <= 0)
		{
			$width	= 1;
		}
		else
		{
			$width	= $width;
		}
		
		if($height <= 0)
		{
			$height	= 1;
		}
		else
		{
			$height	= $height;
		}
		
		
		$newWidth 	= $width;
		$newHeight	= $height;
		
		//get the desirable ratio
		$desRatio	= ($width/$height);
		
		
		//image type
		if($file_type == "image/pjpeg" || $file_type == "image/jpeg")
		{
			$new_img = imagecreatefromjpeg($file_tmp);
		}
		elseif($file_type == "image/x-png" || $file_type == "image/png")
		{
			$new_img = imagecreatefrompng($file_tmp);
		}
		elseif($file_type == "image/gif")
		{
			$new_img = imagecreatefromgif($file_tmp);
		}
			
		
		//image size
		$old_size  	= @getimagesize($file_tmp);
		$old_width 	= $old_size[0];
		$old_height = $old_size[1];
		
		//get the current image ratio
		$currRatio	= ($old_width/$old_height);
		
		//create the file name
		$file_new_name = $newName; 
		
		//define thumb image
		$resized_img = @imagecreatetruecolor($newWidth,$newHeight);
		
		//resize the image
		@imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newWidth, $newHeight, $old_width, $old_height); 
		
	   //save image
	   imagejpeg ($resized_img, $path.$file_new_name);
	   imagedestroy ($resized_img);
	   imagedestroy ($new_img);
		   
		 
	  
	   //update the table
	   $update = "UPDATE ".$table." SET ".$column_file."='$newName' WHERE ".$column_id."='$id' ";
	   $query  = mysql_query($update);
	   //echo $update;
	   if(!$query)
	   {
		   return 'ER001';
	   }
	   else
	   {
		   return $fileName['tmp_name']." ".$path.$newName;
	   }
	   
	}//eof
	
	
	#########################################################################################
	
	
	
	/**
	*	This function will verify images before uploading them. It will check the image size 
	*	in bytes as well as the image size in Pixels. This function will also check for the 
	*	allowed image type.
	*
	*	@param
	*			$fileName		File name 
	*			$kb				If the restriction is on bytes
	*			$w				If the restriction is on width
	*			$h				The restriction is on height
	*
	*	@return	string
	*	
	*/

	function verifyImage($fileName, $kb, $w, $h)
	{
		$result		= '';

		$imageSize  = @getimagesize($fileName['tmp_name']);
		$width		= $imageSize[0];
		$height		= $imageSize[1];
		$sizeByte	= $fileName['size'];

		$file = explode('.',$fileName['name']);
		
		/*COUNTING THE NUMBER OF ELEMENT IN THE ARRAY*/
		$num = (int)count($file);

		//GETTING THE FILE EXTENSIONS, APPLICABLE SPECIALLY WHEN USER PUT 2 OR 3 DOTS BEFORE THE EXTENSION, LIKE 1.JPG.JPG
		$file_extension = strtolower($file[$num - 1]);

		//file extention array
		$extArr = array('gif','jpg','pcx','png','jpeg');

		if(!in_array($file_extension, $extArr))
		{
			$result	= 'Error: invalid image';
		}
		else
		{
			if($sizeByte > 1024 * $kb)
			{
				$result	= 'Error: invalid image size, image should be less than '.$kb;
			}
			else
			{
				if(($width > $w) || ($height > $h))
				{
					$result	= 'Error: invalid image size (width or height). It should not exceed '.$w.' pixels in width X '.$h.' pixels in height';
				}
				else
				{
					$result = '1';
				}
			}
		}//else

		//return the result
		return $result;

	}//eof

		
	/**
	*	Returns the image size in array
	*	@return array
	*/
	function getImageSize($dir, $name)
	{
		$imageSize  = @getimagesize( $dir . $name );
		$width		= $imageSize[0];
		$height		= $imageSize[1];
		$data 		= array($width, $height);

		//return the data
		return $data;

	}//eof
	
	
	
	
	################################################################################################################
	#
	#									Work with Youtube Video and Other video
	#
	################################################################################################################
	
	/**
	* 	This function will add or update a video link to the video column associated with respective primary key.
	*
	*	@param
	*			$url 			URL or link to the video
	*			$keyId			Primary key value
	*			$keyColumn		Primary key column name
	*			$videoColumn	Column name of the video
	*			$table			Name of the table to update 
	*
	*	@return string
	*/
	function videoUpdate($url, $keyId, $keyColumn, $videoColumn, $table)
	{
		//declare vars
		$resUpd	= '';
		$sql	= '';
		
		//generate the statement
		$sql = "UPDATE 	$table 
				SET		$videoColumn = '$url'
				WHERE 	$keyColumn	= $keyId";
		
		//query
		$query	= mysql_query($sql);
		
		if($query)
		{
			$resUpd	= "SU";
		}
		else
		{
			$resUpd	= "ER";
		}
		
		//return result
		return $resUpd;
		
	}//eof
	
	
	
	/**
	*	Generate Youtube URL if user enter the youtube video URL while refering to youtube video.
	*
	*	@param
	*			$url		URL or link to Youtube video only
	*
	*	@return string
	*/
	function generateYoutubeEmbedURL($url)
	{
		//declare vars
		$strUrl			= '';
		$videoPath 		= '';
		$queryStr		= '';
		$videoId		= '';
		//$youtubeBase	= 'http://www.youtube.com/embed/v/';
		$youtubeBase	= 'http://www.youtube.com/embed/';
		$youtubeEnd		= '?wmode=transparent&amp;fs=1&amp;hl=en_US';
		$urlResArr		= array();
		$pathElementArr	= array();
		$videoElemArr	= array();
		
		//parse the url
		$urlResArr 		= parse_url($url);
		
		
		
		//get the path
		$videoPath 		=  $urlResArr['path'];
		
		//get the query elements
		$queryStr 		=  $urlResArr['query'];
			
		if(strpos($videoPath, 'embed') === false )
		{
			
			//explode file around & or &amp;
			if(strpos($queryStr, '&amp;') > 0 )
			{
				//get the query string elemeny
				$pathElementArr = explode('&', $queryStr);
				
				//get the video element array
				$videoElemArr	= explode('=', $pathElementArr[0]);
			}
			else if(strpos($queryStr, '&') >0  )
			{
				//get the query string elemeny
				$pathElementArr = explode('&', $queryStr);
				
				//get the video element array
				$videoElemArr	= explode('=', $pathElementArr[0]);
			}
			else
			{
				//get the video element array
				$videoElemArr	= explode('=', $queryStr);
			}
			
			//get the video id
			$videoId	= $videoElemArr[1];
			
	
			//generate the url
			$strUrl	= $youtubeBase.$videoId.$youtubeEnd;
		}
		else
		{
			$strUrl	= $url;
		}
		
		//return the result
		return $strUrl;
		
	}//eof
	
	
	/**
	*	Display youtube video 
	*
	*	@param
	*			$url		URL of the video
	*			$height		Height of the video
	*			$width		Width of the video
	*
	*/
	function showYoutubeVideo($url, $height, $width)
	{
		//declare var
		$urlStr	  = $this->generateYoutubeEmbedURL($url);
		
		//generate the video
		$videoRes = '<iframe class="youtube-player" type="text/html" width="'.$width.'" height="'.$height.'" 
					src="'.$urlStr.'" frameborder="0">
					</iframe>';
					
		//return the video
		return $videoRes;
	
	}//eof
	
	

	
}//eoc

?>