<?php

	function isEqual($a, $b){
		return ($a == $b);
	}
	
function convertBoundsToMinMax(&$result){
	$bounds = $result['bounds'];
	if(!$bounds){
		$result = false;
		 return;
	}

	preg_match("/\(\((.*)\)\)/", $bounds, $matches);
	
	$points = explode(",", $matches[1]);
	foreach($points as $key => $point){
		$points[$key] = array();
		list($points[$key]['x'], $points[$key]['y']) = explode(" ", $point);
	}
	
	assert('isEqual($points[0], $points[4])');
	assert('isEqual($points[0]["x"], $points[3]["x"])');
	assert('isEqual($points[0]["y"], $points[1]["y"])');
	assert('isEqual($points[1]["x"], $points[2]["x"])');
	assert('isEqual($points[2]["y"], $points[3]["y"])');
	

	$result['minx'] = $points[0]['x'];
	$result['miny'] = $points[0]['y'];
	$result['maxx'] = $points[2]['x'];
	$result['maxy'] = $points[2]['y'];

}
