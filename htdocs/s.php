<?php

$path_info = explode("/", $_SERVER['PATH_INFO']);

header("Location: /location-search.php?query=".$path_info[1]);


