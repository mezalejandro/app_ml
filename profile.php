<?php

/**
 * MercadoLibre hackaton profile user
 * @author mezalejandro
 * @copyright 2013
 */

require_once 'includes/header.inc.php';

 if (!$userId)
{
    header("Location:index.php");
    die();
}
$body .= headerHtml($user_view);

/**
 * Datos
 */ 

$usuario = $user['json']['nickname'];
$fecha_registro = $user['json']['registration_date'];
$email  = $user['json']['email'];
$nombre = $user['json']['first_name'];
$apellido = $user['json']['last_name'];

/**
 * Documento
 */ 
$dni = $user['json']['identification']['number'];

/**
 * Direccion
 */
$ciudad = $user['json']['address']['city'];
$direccion = $user['json']['address']['address'];  
/**
 * Telefono
 */ 
$phone = $user['json']['phone']['number'];

if(isset($_GET['profile']) && $_GET['profile'] == 'misdatos')
{
    $body .= displayMisDatos($usuario,$fecha_registro,$nombre,$apellido,$email);
}
else if(isset($_GET['profile']) && $_GET['profile'] == 'dni')
{
    $body .= displayDNI($dni);
}
else if(isset($_GET['profile']) && $_GET['profile'] == 'address')
{
    $body .= displayAddress($ciudad,$direccion);
}
else if(isset($_GET['profile']) && $_GET['profile'] == 'phone')
{
    $body .= displayPhone($phone);
}
else
{
    $body .= displayMenuProfile();    
}

$body .= FooterHtml();
print $body;
?>

