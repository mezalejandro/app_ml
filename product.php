<?php

/**
 * MercadoLibre hackaton view a product 
 * @author mezalejandro
 * @copyright 2013
 */

require 'includes/header.inc.php';

$body .= headerHtml($user_view);

if (!$userId)
{
    header("Location:index.php");
}

if(isset($_GET['id']) && !empty($_GET['id']))
{
    $item = $meli->get("/items/".$_GET['id']);
    $body .= $item;      
}

$body .= FooterHtml();
print $body;
?>