<?

class iptImageSize {
/* 
ipt_imagesize.php
La plupart des fonctions contenues dans ce module demande la librairie gd.so installée sur le serveur
*/
var $ipt_is_debug = false;

function IPT_IS_ResizePicture($source_picture, $destination_picture, $max_width, $max_height, $quality=90, $min_ratio=1,$repeat=false,$crop=0) {

	global $ipt_is_debug;
	//Ouverture du fichier image source
	$im = imagecreatefromjpeg($source_picture);				
	
	
	//print $im." is ".$source_picture."<br>";
	// Trouve le bon ratio de réduction pour que l'image soit redimensionnée en gardant ses proportions.
	//On arrondi au dixième près.
	$size = getimagesize ($source_picture);
	$im_height = $size[1];
	$im_width = $size[0];		
	$ratio = round(($im_width/$max_width),1);
	if($ratio<round(($im_height/$max_height),1)) {
		$ratio = round(($im_height/$max_height),1);
	}
	if($ratio<$min_ratio) { $ratio = $min_ratio; }
	
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - Ratio is ".$ratio."<br>"; }
  
  $Wfactor=0;
  $Hfactor=0;	
	if($repeat) {
	 $Wfactor =intval(($im_width-($crop*2))/$ratio);
	 $Hfactor= intval(($im_height-($crop*2))/$ratio);
  } 
	//Création de la nouvelle image, on arrondi les dimensions au pixel près
	$im_final=@imagecreatetruecolor (intval($im_width/$ratio)+$Wfactor,intval($im_height/$ratio)+$Hfactor);
	
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - New width is ".intval($im_width/$ratio)." pixels<br>"; }
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - New height is ".intval($im_height/$ratio)." pixels<br>"; }
	

  if($repeat) {
  // imagecopyresampled ( resource $dst_image , resource $src_image , 
//        int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
       // imagecopymerge ( resource $dst_im , resource $src_im , 
     //  int $dst_x , int $dst_y , 
      // int $src_x , int $src_y , 
      // int $src_w , int $src_h , int $pct )
   
   //	imagecopyresampled($im_final,$im,0,0,0,0,ImageSX($im_final),ImageSY($im_final),ImageSX($im),ImageSY($im)); 
 
   
   imagecopyresampled($im_final,$im,0,0,$crop,$crop,(ImageSX($im_final)-$crop)/2,(ImageSY($im_final)-$crop)/2,ImageSX($im)-$crop,ImageSY($im)-$crop); 
  imagecopyresized ($im_final,$im ,  $Wfactor-$crop,0, 0 , 0,(ImageSX($im_final)-$crop)/2,(ImageSY($im_final)-$crop)/2,ImageSX($im)-$crop,ImageSY($im)-$crop); 
    imagecopyresized ($im_final,$im ,  0,$Hfactor-$crop, 0 , 0,(ImageSX($im_final)-$crop)/2,(ImageSY($im_final)-$crop)/2,ImageSX($im)-$crop,ImageSY($im)-$crop); 
     imagecopyresized ($im_final,$im ,  $Wfactor-$crop,$Hfactor-$crop, 0 , 0,(ImageSX($im_final)-$crop)/2,(ImageSY($im_final)-$crop)/2,ImageSX($im)-$crop,ImageSY($im)-$crop); 
    
  // imagecopyresampled($im_final,$im,$Wfactor-$crop,0,$crop,$crop,(ImageSX($im_final)-$crop)/2,(ImageSY($im_final)-$crop)/2,ImageSX($im-$crop,ImageSY($im)-$crop); 
  ///   imagecopyresampled($im_final,$im,0,$Hfactor-$crop,0,0,(ImageSX($im_final)-$crop)/2,(ImageSY($im_final)-$crop)/2,ImageSX($im)-$crop,ImageSY($im)-$crop); 
 //    imagecopyresampled($im_final,$im,$Wfactor-$crop,$Hfactor-$crop,0,0,(ImageSX($im_final)-$crop)/2,(ImageSY($im_final-$crop))/2,ImageSX($im)-$crop,ImageSY($im)-$crop); 
   
   //imagecopymerge ($im_final,$im , $Wfactor , 0 , $crop , $crop ,$Wfactor ,$Hfactor  ,100 );
      
   //   imagecopyresized ($im_final,$im , 0, $Hfactor, 0 , 0,ImageSX($im_final)/2,ImageSY($im_final)/2,ImageSX($im),ImageSY($im)); 
    
   //  imagecopymerge ($im_final,$im , $Wfactor , $Hfactor, $crop , $crop ,$Wfactor ,$Hfactor  ,100 );
        
 //  imagecopymerge ($im_final,$im , 0 , (ImageSY($im_final)/2) , 0,0 , ImageSY($im),ImageSX($im), 90 );
  // imagecopymerge ($im_final,$im , (ImageSX($im_final)/2) , (ImageSY($im_final)/2)-$crop , $crop , $crop , (ImageSX($im_final)-$crop)/2,(ImageSY($im_final)-$crop)/2 , 100 );
    
   
    //imagecopyresampled($im_final,$im,$WFactor,0,0,0,ImageSX($im_final)/2,ImageSY($im_final)/2,ImageSX($im),ImageSY($im)); 
   // imagecopyresampled($im_final,$im,0,$YFactor,0,0,ImageSX($im_final)/2,ImageSY($im_final)/2,ImageSX($im),ImageSY($im)); 
   // imagecopyresampled($im_final,$im,$WFactor,$YFactor,0,0,ImageSX($im_final)/2,ImageSY($im_final)/2,ImageSX($im),ImageSY($im)); 

  


  } else {
  
 	imagecopyresampled($im_final,$im,0,0,0,0,ImageSX($im_final),ImageSY($im_final),ImageSX($im),ImageSY($im)); 
 
  }    
	Imagejpeg($im_final,$destination_picture,$quality);

	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - JPEG Quality is set to ".$quality."<br>"; }
	
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - Picture should have been written in ".$destination_picture."<br>"; }
	
	//Supression des images en mémoire
	ImageDestroy($im);
	ImageDestroy($im_final);		

}

function IPT_IS_MergePicture($destination_picture,$source_picture,$top=0,$left=0,$quality=90,$new_file="") {

	global $ipt_is_debug;
	
	$im = imagecreatefromjpeg($destination_picture);	
	$im2 = imagecreatefromjpeg($source_picture);
	ImageCopy($im,$im2,$top,$left,0,0,ImageSX($im2),ImageSY($im2)); 

	if($new_file=="") {
		$new_file = $destination_picture;
	}
	Imagejpeg($im,$new_file,$quality);

	ImageDestroy($im);
	ImageDestroy($im2);		
}

function IPT_IS_ResizeMergeDir($source_dir, $destination_dir, $background_picture = "",$quality=90,$time_limit=30) {

	global $ipt_is_debug;
	set_time_limit ($time_limit);
	if ($handle = opendir($source_dir)) {
		while (false !== ($file = readdir($handle))) {
			if($file!=".." && $file!=".") {
				if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizeMergeDir} - Reading file ".$file."<br>"; }						
				IPT_IS_ResizePicture($source_dir.$file,$destination_dir.$file,115,115,$quality);
				IPT_IS_MergePicture($background_picture,$destination_dir.$file,0,0,60,$destination_dir.$file);	
				if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizeMergeDir} - Operation done on file ".$file."<br>"; }						
			}
	   }
	   closedir($handle);
	}


}

function IPT_IS_ResizePicture2($source_picture, $destination_picture, $max_width, $max_height, $quality=90, $min_ratio=1) {

	global $ipt_is_debug;
	//Ouverture du fichier image source
	$im = imagecreatefromjpeg("images_temp/".$source_picture);				
	
	// Trouve le bon ratio de réduction pour que l'image soit redimensionnée en gardant ses proportions.
	//On arrondi au dixième près.
	$size = getimagesize ("images_temp/".$source_picture);
	$im_height = $size[1];
	$im_width = $size[0];		
	$ratio = round(($im_width/$max_width),1);
	if($ratio<round(($im_height/$max_height),1)) {
		$ratio = round(($im_height/$max_height),1);
	}
	if($ratio<$min_ratio) { $ratio = $min_ratio; }
	
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - Ratio is ".$ratio."<br>"; }
	
	//Création de la nouvelle image, on arrondi les dimensions au pixel près
	$im_final=@imagecreatetruecolor (intval($im_width/$ratio),intval($im_height/$ratio));
	
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - New width is ".intval($im_width/$ratio)." pixels<br>"; }
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - New height is ".intval($im_height/$ratio)." pixels<br>"; }
	
	imagecopyresampled($im_final,$im,0,0,0,0,ImageSX($im_final),ImageSY($im_final),ImageSX($im),ImageSY($im)); 
	Imagejpeg($im_final,$destination_picture,$quality);

	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - JPEG Quality is set to ".$quality."<br>"; }
	
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - Picture should have been written in ".$destination_picture."<br>"; }
	
	//Supression des images en mémoire
	ImageDestroy($im);
	ImageDestroy($im_final);		
	return "../images_temp/".$source_picture;
}



                                         



function IPT_IS_CropPicture($source_picture, $destination_picture, $left, $top,$width,$height, $quality=90, $min_ratio=1) {

	global $ipt_is_debug;
	//Ouverture du fichier image source
	$im = imagecreatefromjpeg($source_picture);				
	
	
	//print $im." is ".$source_picture."<br>";
	// Trouve le bon ratio de réduction pour que l'image soit redimensionnée en gardant ses proportions.
	//On arrondi au dixième près.
	$size = getimagesize ($source_picture);
	$im_height = $size[1];
	$im_width = $size[0];		
	$ratio = 1;
	
	//Création de la nouvelle image, on arrondi les dimensions au pixel près
	$im_final=@imagecreatetruecolor (intval($im_width/$ratio)-$width,intval($im_height/$ratio)-$height);
	
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - New width is ".intval($im_width/$ratio)." pixels<br>"; }
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - New height is ".intval($im_height/$ratio)." pixels<br>"; }
	
	imagecopyresampled($im_final,$im,0,0,$left,$top,ImageSX($im_final),ImageSY($im_final),ImageSX($im)-$width,ImageSY($im)-$height); 
	Imagejpeg($im_final,$destination_picture,$quality);

	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - JPEG Quality is set to ".$quality."<br>"; }
	
	if($ipt_is_debug) { print "{IPT_IS_DEBUG:IPT_IS_ResizePicture} - Picture should have been written in ".$destination_picture."<br>"; }
	
	//Supression des images en mémoire
	ImageDestroy($im);
	ImageDestroy($im_final);		

}

			
	}
		
			
		
?>