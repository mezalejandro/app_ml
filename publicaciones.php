<?php

/**
 * MercadoLibre hackaton home page login user 
 * @author mezalejandro
 * @copyright 2013
 */

require_once 'includes/header.inc.php';
error_reporting(1);
 if (!$userId)
{
    header("Location:index.php");
    die();
}

#Obtener ID de la imagen
$accessToken = $meli->getAccessToken();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.mercadolibre.com/users/".$user['json']['id']."/items/search?access_token=".$accessToken['value']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS);
$json=curl_exec($ch);
curl_close($ch);
$imagen=json_decode($json, true);
//$imagen["id"];
echo '<pre>';
print_r($imagen);
echo '</pre>';
echo '<hr/><br/>';
#Linkear la imagen al item
$response=$meli->postWithAccessToken('/items/'.$imagen['results'],array());

 foreach ($imagen as &$categoryItem):
		   //echo '<li><a href="sub_category.php?id=' . $categoryItem['id'] . '">'. html_entity_decode($categoryItem['name']).'</a></li>';
            echo '<pre>';
            print_r($categoryItem);
            echo '</pre>';    	
    endforeach;
?>

