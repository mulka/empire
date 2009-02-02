<?php
require_once "includes/func.getExternalLocIds.php";

function pullLocIds($params){
$keys = $params['keys'];
$key = $params['key'];
$source = $params['source'];
$locIds = $params['locIds'];
if(!isset($locIds)){
        $locIds = $params['locId'];
}

if($locIds == 'all'){
	//do nothing
}else if($locIds){
        $locIds = explode(",", $locIds);
}else if($keys){
        $keys = explode(",", $keys);
        $locIds = array();
        foreach($keys as $key){
                $locIds = array_merge($locIds, getExternalLocIds($source, $key));
        }
}else{
        $locIds = getExternalLocIds($source, $key);
}

return $locIds;
}
