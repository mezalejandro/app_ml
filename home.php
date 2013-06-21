<?php

/**
 * MercadoLibre hackaton home page login user 
 * @author mezalejandro
 * @copyright 2013
 */

require_once 'includes/header.inc.php';

 if (!$userId)
{
    header("Location:index.php");
    die();
}

echo '<pre>';
print_r($user);
echo '</pre>';
$body .= headerHtml($user_view);

$body .= displayIndexmenu();   


$body .= FooterHtml();
print $body;
?>

