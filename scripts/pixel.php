<?php require('../../../../wp-blog-header.php'); 

global $wpdb;

	 // Create an image, 1x1 pixel in size
  $im=imagecreate(1,1);

  // Set the background colour
  $white=imagecolorallocate($im,255,255,255);

  // Allocate the background colour
  imagesetpixel($im,1,1,$white);

  // Set the image type
  header("content-type:image/jpg");

  // Create a JPEG file from the image
  imagejpeg($im);

  // Free memory associated with the image
  imagedestroy($im);
  $cookie_name = "user";

	if(!isset($_COOKIE[$cookie_name])) {
		$wpdb->insert( CampagneStats, array( 'Campagne' => $_GET['campagne']) );
		$cookie_value = "Alex Porter";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
	}
	  
	 

?>