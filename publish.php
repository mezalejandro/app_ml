<?php

/**
 * MercadoLibre hackaton publish product 
 * @author mezalejandro
 * @copyright 2013
 */
require_once 'includes/header.inc.php';

error_reporting(1);
$body .= headerHtml($user_view);

if (!$userId)
{
    header("Location:index.php");
}

$body .= displayCategories();
       
$body .= FooterHtml();
print $body;
?>