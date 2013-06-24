<?php

/**
 * MercadoLibre hackaton publish product 
 * @author mezalejandro
 * @copyright 2013
 */
require_once 'includes/header.inc.php';


$body .= headerHtml($user_view);

if (!$userId)
{
    header("Location:index.php");
}
$error = "";
if(isset($_POST['publicar']))
{
    if(empty($_POST['title']))
    {
        $error = '<font color="red">Ingrese titulo *</font>';
    }
    else if(empty($_POST['category']))
    {
        $error = '<font color="red">Seleccione categor&iacute;a *</font>';
    }
    else if(empty($_POST['price']))
    {
        $error = '<font color="red">Ingrese precio *</font>';
    }
    else if(empty($_POST['condition']))
    {
        $error = '<font color="red">Seleccione un estado del producto *</font>';
    }
    else if(empty($_POST['description']))
    {
        $error = '<font color="red">Escribe una descripci&oacute;n *</font>';
    }
    else
    {
    
        $item = array(
        "title" => $_POST['title'],
        "subtitle" => $_POST['subtitle'],
        "category_id" => 'MLA465372341',
        "price" => $_POST['price'],
        "currency_id" => "ARS",
        "available_quantity" => 1,
        "buying_mode" => "buy_it_now",
        "listing_type_id" => "bronze",
        "condition" => $_POST['condition'],
        "description" => "Item:, <strong>'".$_POST['description']."' </strong>",
        "video_id" => $_POST['video_id'],
        "warranty" => $_POST['warranty'],
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
        
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        echo '<hr/><br/>';
        echo '<pre>';
        print_r($item);
        echo '</pre>';
        die();
    }
    
}
$body .= '<div class="content-primary">
        <form method="POST" action="publish.php" data-ajax="false">
        <ul data-role="listview" data-theme="d" data-divider-theme="d"><li data-role="list-divider">Publicar producto</li></ul><br/>
        '.$error.'<br/>
        <br/>
        <ul data-role="listview">
        <li data-role="fieldcontain">
        <label for="title">Titulo:</label>
        <input type="text" name="title" id="title" value=""/>
        </li>
        <li data-role="fieldcontain">
        <label for="title">Sub titulo:</label>
        <input type="text" name="subtitle" id="subtitle" value=""/>
        </li>
        <li data-role="fieldcontain">
        <label for="description">Descripci&oacute;n:</label>
        <textarea cols="40" rows="8" name="description" id="description"></textarea>
        </li>
        <li data-role="fieldcontain">
        <label for="description">Categor&iacute;a:</label>
        <select name="category" id="category" data-native-menu="false">
					<option>Seleccione categor&iacute;a</option>';
                    $pais = $user['json']['site_id'];
                    $category = $meli->get('/sites/'.$pais.'/categories/');

                    foreach ($category['json'] as &$categoryItem):
                		   $body .= '<option value="'.$categoryItem['id'].'">'. html_entity_decode($categoryItem['name']).'</option>';
                    	
                    endforeach;
        $body .= '
		</select>
        </li>
        <li data-role="fieldcontain">
        <label for="price">Estado:</label>
        <fieldset data-role="controlgroup">
	   
     	<input type="radio" name="condition" id="new" value="new"/>
     	<label for="new">nuevo</label>

     	<input type="radio" name="condition" id="used" value="used"/>
     	<label for="used">usado</label>
        </fieldset>
        </li>        
        <li data-role="fieldcontain">
        <label for="price">Precio:</label>
        <input type="text" name="price" id="price" value="" />
        </li>
        <li data-role="fieldcontain">
        <label for="price">Video youtube ID:</label>
        <input type="text" name="video_id" id="video_id" value=""/>
        </li>
        <li data-role="fieldcontain">
        <label for="price">Garantia:</label>
        <input type="text" name="warranty" id="warranty" value=""/>
        </li>
        <li data-role="fieldcontain">
        <label for="price">Link foto:</label>
        <input type="text" name="pictures" id="pictures" value=""/>
        </li>
        <li class="ui-body ui-body-b">
        <fieldset class="ui-grid-a">
        <div class="ui-block-a"><a href="index.php"><button type="submit" data-theme="d">Cancelar</button></a></div>
        <div class="ui-block-b"><input type="submit" data-theme="a" name="publicar" value="Publicar"></div>
        </fieldset>
        </li>
        
        </ul>
        
        </form>
        
        </div><!--/content-primary -->	';
        
$body .= FooterHtml();
print $body;
die();
?>