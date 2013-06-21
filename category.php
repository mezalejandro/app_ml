<?php

/**
 * MercadoLibre hackaton display all categories 
 * @author mezalejandro
 * @copyright 2013
 */

require_once 'includes/header.inc.php';

$pais = $user['json']['site_id'];
$category = $meli->get('/sites/'.$pais.'/categories/');

foreach ($category['json'] as &$categoryItem):
	   echo '<a href="?subcat="'.$category['json']['id'].'">'. $categoryItem['name'].'</a><br/>';
	
endforeach;
echo '<hr/><br/>';

echo '<pre>';
print_r($category);
echo '<pre>';
?>