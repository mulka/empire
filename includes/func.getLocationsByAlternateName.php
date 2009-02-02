<?php

require_once "includes/func.getLocationsByExactAlternateName.php";

function getLocationsByAlternateName($name){
	return getLocationsByExactAlternateName('%'.$name.'%');
}
