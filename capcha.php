<?php session_start(); ?>

<html>
<script src="captcha.js"></script>

<body>

<?php
create_image();
function create_image()
{
    //Let's generate a totally random string using md5
    $md5 = md5(rand(0,999)); 
    //We don't need a 32 character long string so we trim it down to 5 
    $pass = substr($md5, 10, 5); 
	
	//Set the session to store the security code
    $_SESSION["security_code"] = $pass;

    //Set the image width and height
    $width = 130;
    $height = 50; 

    //Create the image resource representing a black image of the specified size
    $image = imagecreatetruecolor($width, $height);  
	
	$textColor = hexToRGB('#162453');	
	$textColor = imagecolorallocate($image, $textColor['r'],$textColor['g'],$textColor['b']);
	$fontSize = $height * 0.45;
	$font = './font/PTC55F.ttf';
	
	$white = ImageColorAllocate($image, 255, 255, 255); 
	$grey = ImageColorAllocate($image, 204, 204, 204); 

	ImageFill($image, 0, 0, $white); 
    ImageRectangle($image,0,0,$width-1,$height-1,$grey); 

    //Make the background black 
	$backgroundColor='';
	//echo $backgroundColor;
	if($backgroundColor==''){/*select random color*/
			$colorCode=array('#56aad8', '#61c4a8', '#d3ab92');
			$backgroundColor = hexToRGB($colorCode[rand(0, count($colorCode)-1)]);
			//	echo $backgroundColor;

			$backgroundColor = imagecolorallocate($image, $backgroundColor['r'],$backgroundColor['g'],$backgroundColor['b']);
			
		}
	else{/*select background color as provided*/
			$backgroundColor = hexToRGB($backgroundColor);
			$backgroundColor = imagecolorallocate($image, $backgroundColor['r'],$backgroundColor['g'],$backgroundColor['b']);
		} 
	
	$lineColor = hexToRGB('#162453');
	$lineColor = imagecolorallocate($image, $lineColor['r'],$lineColor['g'],$lineColor['b']);

    //Throw in some lines to make it a little bit harder for any bots to break 
	for( $i=0; $i<10; $i++ ) {				
			imageline($image, mt_rand(0,$width), mt_rand(0,$height),
			mt_rand(0,$width), mt_rand(0,$height), $lineColor);
		}
			
	for( $i=0; $i<25; $i++ ) {	
			imagefilledellipse($image, mt_rand(0,$width),
			mt_rand(0,$height), 3, 3, $textColor);

	}
	
    //Add randomly generated string in white to the image
	
    imagettftext($image, $fontSize, 0, mt_rand($width/8,$width/2), mt_rand($height/2.4, $height), $textColor, $font, $pass);		

	header('Content-Type: image/jpeg');/* defining the image type to be shown in browser widow */
	imagejpeg($image,'capi.jpg');
	imagedestroy($image);
}

function hexToRGB($colour)
{
		if ( $colour[0] == '#' ) {
				$colour = substr( $colour, 1 );
		}
		if ( strlen( $colour ) == 6 ) {
				list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
		} elseif ( strlen( $colour ) == 3 ) {
				list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
		} else {
				return false;
		}
	
		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );
		echo $r." ".$g." ".$b;
		return array( 'r' => $r, 'g' => $g, 'b' => $b );
}		
?>
</body>


</html>