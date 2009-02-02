<?php

//TODO: I might be able to write this function in Javascript and push it to the browser
function convertToGmapsIfNeeded($mapInfo, &$locations, &$bounds){
	
	$width = $mapInfo['width'];
	$height = $mapInfo['height'];
	$max = max($width, $height);
	$min = min($width, $height);
	$adjust = ($max-$min)/2;
	if($height > $width){
		$xadjust = $adjust;
		$yadjust = 0;
	}else{
		$xadjust = 0;
		$yadjust = $adjust;
	}
	
	$info = array('yadjust' => $yadjust, 'xadjust' => $xadjust, 'max' => $max);
	
	function convertOriginalToGmaps(&$x, &$y, $info){
		$yadjust = $info['yadjust'];
		$xadjust = $info['xadjust'];
		$max = $info['max'];
		$y = -(($y + $yadjust)*180/$max-90);
		$x = ($x + $xadjust)*360/$max-180;
	}
	
	if(isset($bounds) && $bounds['format'] == 'original'){
		convertOriginalToGmaps($bounds['maxx'], $bounds['maxy'], $info);
		convertOriginalToGmaps($bounds['minx'], $bounds['miny'], $info);
	}
	
	foreach($locations as $key => $row){
		if($row['format'] == 'original'){
			$locations[$key]['format'] = 'gmaps';
			convertOriginalToGmaps($locations[$key]['minx'], $locations[$key]['miny'], $info);
			convertOriginalToGmaps($locations[$key]['maxx'], $locations[$key]['maxy'], $info);
		}
	}
}