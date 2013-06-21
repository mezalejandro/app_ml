<?php

/**
 * MercadoLibre hackaton header requires classes, functions 
 * @author mezalejandro
 * @copyright 2013
 */

error_reporting(0);
require_once 'settings.inc.php';
require_once 'functions.inc.php';

require 'ml/meli.php';

$meli = new Meli(array(
	'appId'  	=> $settings['app_id'],
	'secret' 	=> $settings['app_secret'],
));

$body = '';

$userId = $meli->initConnect();
//Login check
if ($userId)
{
    $user = $meli->getWithAccessToken('/users/me');
}

if ($userId)
{
    $user_view = $user['json']['first_name'];
}
?>