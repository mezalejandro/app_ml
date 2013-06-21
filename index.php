<?php

/**
 * MercadoLibre hackaton index page 
 * @author mezalejandro
 * @copyright 2013
 */
require_once 'includes/header.inc.php';


$userId = $meli->initConnect();

if ($userId)
{
    header("Location:home.php");
}
$body .= checkLogin();
// Login or logout url will be needed depending on current user state.
print $body;
?>