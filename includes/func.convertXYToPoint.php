<?php

function convertXYToPoint($x, $y){
	assert(is_numeric($x));
	assert(is_numeric($y));
	return "POINT($x $y)";
}