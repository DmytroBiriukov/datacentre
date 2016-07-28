<?php
  $MAP_STORE_DIR = '/home/dmitrij/www/ukravtodor/www/maps';
  $MAP_STORE_URL = '/maps';

  function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity)
  {   $w = imagesx($src_im);
      $h = imagesy($src_im);
      $cut = imagecreatetruecolor($src_w, $src_h);
      imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
      imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
      imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);
  }

  // fetch the request params, and generate the name of the tempfile and its URL
  $width    = $_POST['width'];  if (!$width) $width = 1024;
  $height   = $_POST['height']; if (!$height) $height = 768;
  //$tiles    = json_decode(@$_REQUEST['tiles']);
  $tiles    = json_decode(stripslashes(@$_POST['tiles'])); // use this if you use magic_quotes_gpc
  $random   = md5(microtime().mt_rand());
  $file 	= sprintf("%s/%s.png", $MAP_STORE_DIR, $random );
  $url      = sprintf("%s/%s.png", $MAP_STORE_URL, $random );

/*
$myFile = sprintf("%s/%s.txt", $MAP_STORE_DIR, $random );
$fh = fopen($myFile, 'w') or die("can't open file");
$i=0;
  foreach ($tiles as $tile) 
  { fwrite($fh, $i."\n");
    fwrite($fh, $tile->url."\n");
	
	$i++;
  }
fclose($fh);
*/

  


  // lay down an image canvas
  // Notice: in MapServer if you have set a background color
  // (eg. IMAGECOLOR 60 100 145) that color is your transparent value
  // $transparent = imagecolorallocatealpha($image,60,100,145,127);
  $image = imagecreatetruecolor($width,$height);
  imagefill($image,0,0, imagecolorallocate($image,255,255,255) ); 


  // loop through the tiles, blitting each one onto the canvas
  $i_file=0;
  foreach ($tiles as $tile) {
     // try to convert relative URLs into full URLs
     // this could probably use some improvement
     $tile->url = urldecode($tile->url);
     if (substr($tile->url,0,4)!=='http') 
	 {  $tile->url = preg_replace('/^\.\//',dirname($_SERVER['REQUEST_URI']).'/',$tile->url);
        $tile->url = preg_replace('/^\.\.\//',dirname($_SERVER['REQUEST_URI']).'/../',$tile->url);
       // $tile->url = sprintf("%s://%s:%d/%s", isset($_SERVER['HTTPS'])?'https':'http', $_SERVER['SERVER_ADDR'], $_SERVER['SERVER_PORT'], $tile->url);
	    $tile->url = sprintf("%s://%s/%s", 'http', '91.202.128.36', $tile->url);
     }
     $tile->url = str_replace(' ','+',$tile->url);

     // fetch the tile into a temp file, and analyze its type; bail if it's invalid
     $tempfile =  sprintf("%s/%s.png", $MAP_STORE_DIR, $i_file ); 
	 $i_file++;
	 
     $tile_local=str_replace("91.202.128.36", "localhost", $tile->url);
     $tile_local=str_replace("213.160.135.162:10080", "localhost", $tile_local);
     $tile_local=str_replace("datacentre.dyndns.info", "localhost", $tile_local);

	 
     file_put_contents($tempfile, file_get_contents( $tile_local));
     list($tilewidth,$tileheight,$tileformat) = @getimagesize($tempfile);
     if (!$tileformat) continue;

     // load the tempfile's image, and blit it onto the canvas
     switch ($tileformat) 
	 {  case IMAGETYPE_GIF:
           $tileimage = imagecreatefromgif($tempfile);
           break;
        case IMAGETYPE_JPEG: //IMAGETYPE_PNG:
           $tileimage = imagecreatefromjpeg($tempfile);
           break;
        default:
           $tileimage = imagecreatefrompng($tempfile);
           break;		   
     }
	 $opacity=$tile->opacity; if(!$opacity) $opacity=100;
     imagecopymerge_alpha($image, $tileimage, $tile->x, $tile->y, 0, 0, $tilewidth, $tileheight, $opacity);
	 unlink($tempfile);
  }

  // save to disk and tell the client where they can pick it up
  imagejpeg($image,$file,100);
//  if (copy($file,$file_name)) unlink($file); 


  print $url;
  
?>