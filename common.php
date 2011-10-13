<?php
   
   error_reporting(E_ALL | E_STRICT);
   ini_set('display_errors', 'On');
   
   define('ROOT', dirname(__FILE__));
   define('CLDR_ROOT', ROOT .'/data');
   define('CLDR_COMMON', CLDR_ROOT .'/common');
   define('CLDR_SUPP', CLDR_COMMON .'/supplemental');
   define('CLDR_MAIN', CLDR_COMMON .'/main');
   
   require(ROOT .'/CldrUtil.php');
   
   spl_autoload_register(array('CldrUtil', 'autoLoad'));
   
