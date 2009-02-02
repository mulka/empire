<?php
//hack for my server... I think because its running php 4 it doesn't want to read the htaccess file
switch($_SERVER["HTTP_HOST"]){
	case "192.168.2.31":
	case "empire.kylemulka.com":
		set_include_path(".:/var/www/html/empire:/usr/local/lib/php");
		break;
}

require_once "includes/func.getLocationsByDefaultName.php";
require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.getBreadcrumbs.php";

function getLocationsByNameInTree($name){
global $db;
$result = $db->getAssoc("SELECT locId as `index`, locId, name, locB as parentLocId, COUNT(ancestorLocId) AS count FROM locations LEFT JOIN `in` ON locations.locId = locA NATURAL LEFT JOIN ancestors WHERE name LIKE ? AND locId NOT IN (SELECT fromLocId FROM redirect)  GROUP BY locId ORDER BY count DESC, name", true, array('%'.$name.'%'));

$result2 = $result;
foreach($result as $locId => $location){
        $ancestors = getBreadcrumbs($location['locId']);
        $ancestors = array_reverse($ancestors);
        foreach($ancestors as $key => $ancestor){
                if($result2[$ancestor['locId']]){
                        if(!is_array($result2[$ancestor['locId']]['children'])){
                                $result2[$ancestor['locId']]['children'] = array();
                        }
                        array_push($result2[$ancestor['locId']]['children'], $result2[$locId]);
                        unset($result2[$locId]);
                        break;
                }
        }
}


return $result2;
}
