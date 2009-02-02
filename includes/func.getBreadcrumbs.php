<?php
require_once "includes/func.getAncestors.php";

function getBreadcrumbs($locId){
	return getAncestors($locId);
}
