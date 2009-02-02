<?php
	
function convertMinMaxToBounds(&$bounds){
	$bounds = "POLYGON((".
			$bounds['minx']." ".
			$bounds['miny'].",".
			$bounds['maxx']." ".
			$bounds['miny'].",".
			$bounds['maxx']." ".
			$bounds['maxy'].",".
			$bounds['minx']." ".
			$bounds['maxy'].",".
			$bounds['minx']." ".
			$bounds['miny']."))";
}