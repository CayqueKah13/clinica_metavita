<?php

namespace Source\Support;

class ImageUploader {

  // Upload Image to folder (folder after ../content/)
  static function uploadAndResizeImage($file, $target, $max_width, $max_height) {
  	// If file received is empty, returl NULL
  	$fileName = $file["name"];
  	if (empty($fileName)) {
  		return NULL;
  	}

  	// Target Folder
  	$folder = explode('/', $target);
  	$folder = end($folder);

  	// Get file extension
  	$extension = explode('.', $fileName);
  	$extension = end($extension);

  	// File name is (Number of files inside folder) + 1
  	// $counter = (count(scandir($target)) - 1);;
    $counter = count(scandir($target));
  	$imgName = "";



  	// Handle Upload according to image extension
  	if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
  		// If it is JPG, JPEG or PNG save as it is
  		$imgName = $counter.".".$extension;
  		// Move file to target
  		$target = $target."/".$imgName;
  		$success = move_uploaded_file($file["tmp_name"], $target);
  		if (!$success) {
  			return NULL;
  		}

  	} elseif ($extension == 'gif') {
  		// If it is a GIF, save as static JPG
  		$imgName = $counter.".jpg";
  		// Create GIF to JPG file
  		$image = imagecreatefromgif($file["tmp_name"]);
  		$target = $target."/".$imgName;
  		imagejpeg($image, $target);
  		imagedestroy($image);

  	} else {
  		// Return NULL if it is not a JPG, JPEG or GIF file
  		return NULL;
  	}


  	// Resize to max width and height
  	ImageUploader::resizeImageIfNeeded($target, $max_width, $max_height);

  	// Return Folder + File Name to be saved on DataBase
  	return $folder."/".$imgName;
  }











  static function resizeImageIfNeeded($target, $max_width, $max_height) {
  	// Get file extension
  	$extension = explode('.', $target);
  	$extension = end($extension);
  	// Make sure it is an image file
  	if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif') {
  		return;
  	}

  	// Get Old Width and Old Height
  	list($old_width, $old_height) = getimagesize($target);


  	// Set new Width and new height
  	$new_width = 0;
  	$new_height = 0;
  	if ($old_width > $old_height) {
  		$new_height = ($max_width*$old_height)/$old_width;
  		$new_width = $max_width;
  	} else {
  		$new_width = ($max_height*$old_width)/$old_height;
  		$new_height = $max_height;
  	}

  	// Start creating a new image
  	$new_image = imagecreatetruecolor($new_width, $new_height);


  	// Handle image resampling for each extension
  	if ($extension == 'jpg' || $extension == 'jpeg') {
  		// Create a reference to Old Image file
  		$old_image = imagecreatefromjpeg($target);
  		// Create resized copy of original file
  		imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
  		// Create resized image to target (overwrite original file)
  		imagejpeg($new_image, $target);
  		// Clear memory object
  		imagedestroy($new_image);
  		imagedestroy($old_image);
  		// -------------------------------------------
  	} elseif ($extension == 'png') {
  		// Make sure it will be transparent background
  		imagealphablending($new_image, false);
  		imagesavealpha($new_image,true);
  		$transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
  		imagefilledrectangle($new_image, 0, 0, $new_width, $new_height, $transparent);
  		// Create a reference to Old Image file
  		$old_image = imagecreatefrompng($target);
  		// Create resized copy of original file
  		imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
  		// Create resized image to target (overwrite original file)
  		imagepng($new_image, $target);
  		// Clear memory object
  		imagedestroy($new_image);
  		imagedestroy($old_image);
  		// -------------------------------------------
  	} elseif ($extension == 'gif') {
  		// Create a reference to Old Image file
  		$old_image = imagecreatefromgif($target);
  		// Create resized copy of original file
  		imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
  		// Create resized image to target (overwrite original file)
  		imagejpeg($new_image, $target);
  		// Clear memory object
  		imagedestroy($new_image);
  		imagedestroy($old_image);
  	}

  }


}




?>
