<?php
	/**
	 * Author: Jenet Alexandre 
	 * Date: 5-05-2016
	 */

	/* Number of marker */
	// Warning if you'll generate more then 500 makers (max: 999 markers. no more space)
	// don't forget to config in php.ini 
	// increase value to max_execution_time
    $nbrMarker = 100; 
    
	/* Number of marker */    
    $imageInfo = [
    	[
    		'source' => 'images/marker.png',
    		'dest' => 'markers_generated/marker-%d.png'
    	]
    	,[
    		'source' => 'images/marker-hover.png',
			'dest' => 'markers_generated/marker-%d-hover.png'
		]
    ];
    /* Font size of number */
    $textSize = 20;

    /* Define environement variable. Path of the font */
    putenv('GDFONTPATH=' . realpath('font/'));
    
    for($nbrImg = 0; $nbrImg < count($imageInfo); $nbrImg++){
		for($i = 0; $i < $nbrMarker; $i++){
			
			//
	        $imageSource = $imageInfo[$nbrImg]['source'];
	        
	        $number = $i;
	        $number++ ;
	        $text = $number;	      
	        
			// Create image on based of original image
	        $image = imagecreatefrompng($imageSource);
	        imageAlphaBlending($image, true);
	        imageSaveAlpha($image, true);
	        
	        // Define the text color
	        $textColor = imagecolorallocate($image, 255, 255, 255);
	       
	        $x = 36; 
	        $y = 43;        
	        
	        switch ($number){
		        case ($number > 99):
					$x = 22;
					break;
				case ($number > 19):
	        		$x = 29;
					break;
	        	case ($number > 9):
	        		$x = 30;
					break;
	        }
	       
	        // write on image
	        imagettftext($image, $textSize, 0, $x, $y, $textColor, 'Arial Bold.ttf', $text);
	         
			// Save image
	        imagepng($image, sprintf($imageInfo[$nbrImg]['dest'],$number), 9);
	    }
    }
    ?>
    <p><?= $nbrMarker ?> markers have been generated :)</p>