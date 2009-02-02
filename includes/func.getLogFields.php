<?php

function getLogFields($action){
	switch($action){
	case 'editparent':
        	return array('locId', 'before', 'after');
	case 'create':
                return array('locId');
	case 'editmap':
		return array('locId', 'before', 'after');
	case 'duplicate':
                return array('locId', 'dupLocId');
	case 'addaka':
                return array('locId', 'name');
	case 'addexternal':
                return array('locId', 'source', 'key');
	default:
		return array();
	}
}
