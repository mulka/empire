<?php


$array = array(
	'cse' => 72,
	'mujo' => 104,
	'1500' => 408,
	'aa' => 108,
	'seattle' => 113,
	'ahfb' => 7,
	'ercstate' => 480,
	'umich' => 30,
	'brighton' => 384,
	'nc' => 81,
	'ugli' => 24,
	'microsoft' => 127,
	'bursley' => 43,
	'hkn' => 5,
);

$locId = $array[$_GET['q']];


if(isset($locId)){
	header("Location: /location-view.php?locId=$locId");
}else{
	header("Location: /");
}
