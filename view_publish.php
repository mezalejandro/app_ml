<?php

/**
 * MercadoLibre hackaton display sub categories categories 
 * @author mezalejandro
 * @copyright 2013
 */

require_once 'includes/header.inc.php';

$body .= headerHtml($user_view);

$usuario = $user['json']['nickname'];
$pais    = $user['json']['site_id'];
$body .= misPublicaciones($usuario,$pais);

$body .= FooterHtml();
print $body;
?>