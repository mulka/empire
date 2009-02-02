<?php

require_once "includes/func.getGmapsApiKey.php";

$base_dir = "..";

require_once '/home/mulka/htdocs/Smarty-2.6.14/libs/Smarty.class.php';

class Smarty_Empire extends Smarty {

   function Smarty_Empire()
   {
        $this->Smarty();

        global $base_dir;
        $this->template_dir = $base_dir.'/smarty/templates/';
        $this->compile_dir  = $base_dir.'/smarty/templates_c/';
        $this->config_dir   = $base_dir.'/smarty/configs/';
        $this->cache_dir    = $base_dir.'/smarty/cache/';

        //these are for develepment and debugging only
        //$this->caching = false;
        //$this->force_compile = true;
        $this->debugging_ctrl = 'URL';
        
        $this->assign('app_name', 'Empire');
	$this->assign('host', $_SERVER['HTTP_HOST']);
        $this->assign('gmapsApiKey', getGmapsApiKey());
    }
}
?>
