<?php

/**
 * MercadoLibre hackaton index page 
 * @author mezalejandro
 * @copyright 2013
 */

require_once 'includes/header.inc.php';
echo '<pre>';
print_r($_POST);
echo '</pre>';

echo '<br/><br/><br/>';
if(isset($_POST['publicar']))
{
    /*$item = array(
        'title'         => $_POST['title'],
        'subtitle'      => $_POST['title'],
        'description'   => $_POST['description'],
        'category_id'   => $_POST['category'],
        'price'         => $_POST['price'],
        'condition'     => $_POST['conditions'],
        'listing_type_id'   => 'bronze',
        'currency_id'   =>  'ARS'
    );*/
    
    $item = array(
    "title" => $_POST['title'],
    "subtitle" => "",
    "category_id" => $_POST['category'],
    "price" => $_POST['price'],
    "currency_id" => "ARS",
    "available_quantity" => 1,
    "buying_mode" => "buy_it_now",
    "listing_type_id" => "bronze",
    "condition" => "new",
    "description" => "Item:, <strong> Ray-Ban WAYFARER Gloss Black RB2140 901 </strong> Model: RB2140. Size: 50mm. Name: WAYFARER. Color: Gloss Black. Includes Ray-Ban Carrying Case and Cleaning Cloth. New in Box",
    "video_id" => "YOUTUBE_ID_HERE",
    "warranty" => "12 month by Ray Ban",
    "pictures" => array(
        array(
            "source" => "http://upload.wikimedia.org/wikipedia/commons/f/fd/Ray_Ban_Original_Wayfarer.jpg"
        ),
        array(
            "source" => "http://en.wikipedia.org/wiki/File:Teashades.gif"
        )
        )
    );
    $item = $meli->postWithAccessToken("/items", $item);
    
   // $item = $meli->postWithAccessToken("/items", $item);
    echo '<pre>';
    print_r($item);
    echo '</pre>';
}

?>