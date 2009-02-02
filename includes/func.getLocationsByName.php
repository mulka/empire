<?php

require_once "includes/func.getLocationsByExactName.php";

function getLocationsByName($name){
        global $db;
        $result =& $db->getAll("SELECT locId, name FROM aka WHERE MATCH(name) AGAINST (?)", array($name));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
        return $result;
}
