<?php

/**
 * MercadoLibre hackaton display sub categories categories 
 * @author mezalejandro
 * @copyright 2013
 */

require_once 'includes/header.inc.php';

if(isset($_GET['id']) && !empty($_GET['id']))
{
    $body .= displaySubCategories($_GET['id']);
}

print $body;
?>