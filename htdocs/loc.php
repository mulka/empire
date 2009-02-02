<?php

$pathInfo = explode("/", $_SERVER['PATH_INFO']);

$_GET['locId'] = $pathInfo[1];

include("location-view.php");
