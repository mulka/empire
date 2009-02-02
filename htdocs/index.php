<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getNewLocations.php";

if($_SERVER['HTTP_HOST'] == "cartiki.com"){
	$featured = array(
		array('locId' => 109),
		array('locId' => 106),
		array('locId' => 617),
//		array('locId' => 81, 'name' => 'University of Michigan, North Campus'),
//		array('locId' => 352, 'name' => '1st Floor, Duderstadt Center'),
		array('locId' => 923, 'name' => 'Location of WhereCampSF 2007'),
	);


	foreach($featured as $key => $featuredLocation){
		if(!isset($featuredLocation['name'])){
			$location = getLocationById($featuredLocation['locId']);
			$featured[$key]['name'] = $location['name'];
		}
	}
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign("featured", $featured);
$smarty->assign("new", getNewLocations());
$smarty->display('index.tpl.html');
