<?php

function getLogTable($action){
        switch($action){
        case 'editparent':
                return 'logparent';
        case 'create':
                return 'logcreate';
        case 'editmap':
                return 'logmap';
        case 'duplicate':
                return 'logduplicate';
        case 'addaka':
                return 'logaddaka';
        case 'addexternal':
                return 'logaddexternal';
	default:
		//die("action <b>".$action."</b> not recognised");
        }
}
