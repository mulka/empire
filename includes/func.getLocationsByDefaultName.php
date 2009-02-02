<?php

require_once "includes/func.getLocationsByExactDefaultName.php";

function getLocationsByDefaultName($name){
	return getLocationsByExactDefaultName('%'.$name.'%');
}
