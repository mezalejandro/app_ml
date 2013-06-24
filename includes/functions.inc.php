<?php

/**
 * MercadoLibre hackaton functions of website 
 * @author mezalejandro
 * @copyright 2013
 */

function headerHtml($user)
{
    global $meli;
    $header = '';
    
    $header .= '
    <!DOCTYPE html> 
    <html>
    
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1"> 
    	<title>App MercadoLibre</title> 
    	<link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.3.1.min.css" />
    	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>';
    if(basename($_SERVER['SCRIPT_NAME']) == 'publish.php')
    {
        $header .= '<script type="text/javascript" src="js/reCopy.js"></script>';
        $header .= '<script type="text/javascript" src="js/script.js"></script>';
    }
    
    $header .= '
    </head> 
    <body> 
    
    <div data-role="page">
    
    	<div data-role="header">
    		<h1 style="color:#716c3b;"><img src="imagenes/user.png"/>'.$user.'</h1>';
     if(basename($_SERVER['SCRIPT_NAME']) != 'home.php')
     {
        $header .= '<a href="home.php" data-icon="home" data-iconpos="notext" data-direction="reverse">Inicio</a>';
     }
     else
     {
        $header .= '<a href="'.$meli->getLogoutUrl().'" data-role="button" data-icon="delete" class="ui-btn-left">Salir</a>';
     }
     
     $header .= '<a href="profile.php" data-role="button" data-icon="gear" class="ui-btn-right">Mi perfil</a>
    	</div><!-- /header -->';
     $header .= '<div data-role="content">';
    
    
    return $header;
}
function checkLogin()
{
    global $meli, $userId;
    
    $login = '';
    //Comprobar login
    if ($userId)
    {
        $user = $meli->getWithAccessToken('/users/me');
    }
    
    if ($userId)
    {
        header("Location:home.php");
    }
    else
    {
        
        $login .= '<!DOCTYPE html> 
        <html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>App MercadoLibre</title>';
    	$login .= '
        <link rel="stylesheet" href="jquery.mobile/jquery.mobile-1.3.1.min.css" />
    	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
        </head>';
        $login .= '<link type="text/css" href="css/style_login.css"/>';
        $login .= '<body>';
        $login .= '<div data-role="page">
    
    	<div data-role="header">
    		<h1>App ML</h1>
    	</div><!-- /header -->';
        $login .= '<img style="display: block;margin-left: auto;margin-right: auto;margin-top:3px;" src="imagenes/logosolo.png"/>
        <img src="imagenes/tipografia_1.png" style="display: block;margin-left: auto;margin-right: auto"/>';
    	$login .= '<a href="'.$meli->getLoginUrl().'"><button type="button" name="" value="" class="css3button">Ingresar</button></a>';   	
    	$login .= '</div><!-- /content -->
	
    <div data-role="footer">
    <h4>Footer content</h4>
    </div><!-- /footer -->
    
    </div><!-- /page -->
    
    </body>
    </html>';
    }
    return $login;
}

function displayCategories()
{
    global $meli,$user;
    
    $body = '';
    
    $body .= '<div class="content-primary">';
    if(isset($_GET['sub']) && !empty($_GET['sub']) )
    {
        $pais = $user['json']['site_id'];
        $sub_category = $meli->get('/categories/'.$_GET['sub']);
        foreach ($sub_category['json'] as &$nombreCat)
        {
        	   
               $nombre_category = $sub_category['json']['name'];          
        }
        
        if(count($sub_category['json']['children_categories']) == 0)
        {
            $body .= uploadNewProduct($_GET['sub'],$nombre_category);
        }
        else
        {
            $body .= '<ul data-role="listview" data-theme="d" data-divider-theme="d">';
            $body .= '<li data-role="list-divider" style="margin-bottom:10px;">Seleccione una sub categor&iacute;a de '.htmlentities($nombre_category).'</li></ul>';       
            $body .= '<ul data-role="listview">';
        }
        foreach ($sub_category['json']['children_categories'] as &$sub_categoryItem)
        {
        	   $body .= '<li><a href="?sub='.$sub_categoryItem['id'].'">'. html_entity_decode($sub_categoryItem['name']).'</a></li>';            
        }
        $body .= '</ul>';
    }
    else
    {
        $body .= '<ul data-role="listview" data-theme="d" data-divider-theme="d"><li data-role="list-divider" style="margin-bottom:10px;">Seleccione una categor&iacute;a</li></ul>';       
        $body .= '<ul data-role="listview">';
        $pais = $user['json']['site_id'];
        $category = $meli->get('/sites/'.$pais.'/categories/');
        
        foreach ($category['json'] as &$categoryItem)
        {
        	   $body .= '<li><a href="?sub='.$categoryItem['id'].'">'. html_entity_decode($categoryItem['name']).'</a></li>';
        }
        $body .= '</ul>';
    }
    
    $body .= '</div>'; 
    
    return $body;
}


function displayMenuProfile()
{
    $profile = '';
    
    $profile .= '<div class="content-primary">	
	<ul data-role="listview" data-split-icon="gear" data-split-theme="d">';
    
    $profile .= '<li><a href="?profile=misdatos">
				<h3>Mis Datos</h3>
				</a>
			    </li>';
    $profile .= '<li><a href="?profile=dni">
				<h3>Documento</h3>
				</a>
			    </li>';
    $profile .= '<li><a href="?profile=address">
				<h3>Direcci&oacute;n</h3>
				</a>
			    </li>';
    $profile .= '<li><a href="?profile=phone">
				<h3>Telefonos</h3>
				</a>
			    </li>';   
    
    $profile .= '</ul>';
    $profile .= '</div>';         
    return $profile;
}

function displayMisDatos($user,$fecha_registro,$nombre,$apellido,$email)
{
    global $meli;
    
    $misdatos = '';
    
    $misdatos .= '<div class="content-primary">';
    
    $misdatos .= '<ul data-role="listview" data-theme="d" data-divider-theme="d">';
	   $misdatos .= '<li data-role="list-divider">Mis Datos</li>';
        $misdatos .= '<li>				
					<h3>Usuario</h3>
					<p>'.$user.'</p>
					</li>';
        
        $misdatos .= '<li>
				      <h3>Fecha registro</h3>
				      <p>'.$fecha_registro.'</p>
				      </li>';
        
        $misdatos .= '<li>
				      <h3>Nombre y Apellido</h3>
				      <p>'.$nombre.' '.$apellido.'</p>
				      </li>';
        
        $misdatos .= '<li>
				      <h3>Email</h3>
				      <p>'.$email.'</p>
				      </li>';
    $misdatos .= '</ul>';
    $misdatos .= '</div>';

    return $misdatos;
}

function displayDNI($dni)
{
    $dni_view = '';
    
    $dni_view .= '<div class="content-primary">';
    
    $dni_view .= '<ul data-role="listview" data-theme="d" data-divider-theme="d">';
	   $dni_view .= '<li data-role="list-divider">Documentos</li>';
        $dni_view .= '<li>				
					<h3>Documento</h3>
					<p>'.$dni.'</p>
					</li>';
    $dni_view .= '</ul>';
    $dni_view .= '</div>';
    
    return $dni_view;
}

function displayAddress($ciudad,$direccion)
{
    $address = '';
    
    $address .= '<div class="content-primary">';
    
    $address .= '<ul data-role="listview" data-theme="d" data-divider-theme="d">';
	   $address .= '<li data-role="list-divider">Direcci&oacute;n</li>';
        
        $address .= '<li>
				      <h3>Ciudad</h3>
				      <p>'.$ciudad.'</p>
				      </li>';
                      
        $address .= '<li>				
					<h3>Direcci&oacute;n</h3>
					<p>'.$direccion.'</p>
					</li>';
    $address .= '</ul>';
    $address .= '</div>';
    
    return $address;
}

function displayPhone($phone)
{
    $telefono = '';
    
    $telefono .= '<div class="content-primary">';
    
    $telefono .= '<ul data-role="listview" data-theme="d" data-divider-theme="d">';
	   $telefono .= '<li data-role="list-divider">Numero de telefono</li>';
        $telefono .= '<li>				
					<h3>Telefono actual</h3>
					<p>'.$phone.'</p>
					</li>';
    $telefono .= '</ul>';
    $telefono .= '</div>';
    
    return $telefono;
}

function displayIndexmenu()
{
    $menu = '';
    
    $menu .= '<div class="content-primary">';
    
    $menu .= '<ul data-role="listview" data-theme="d" data-divider-theme="d">';
	   $menu .= '<li data-role="list-divider">Menu</li>';
        /*$menu .= '<li><a href="view_publish.php">			
					<h3>Productos publicados</h3>
					<p>Ver todas los productos ya publicados</p>
					</a></li>';*/
        
        $menu .= '<li><a href="publish.php">
				      <h3>Vender producto</h3>
				      <p>Publicar producto</p>
				      </a></li>'; 
        
    $menu .= '</ul>';
    $menu .= '</div>';
    
    return $menu;
}


function uploadNewProduct($cat_id,$cat_name)
{
    global $meli, $user;
    
    $form = '';
    
    $error = "";
    if(isset($_POST['publicar']))
    {
        if(empty($_POST['title']))
        {
            $error = '<font color="red">Ingrese titulo *</font>';
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
            
            foreach($_FILES['pictures']['tmp_name'] as $key => $tmp_name )
            {
        		$file_name = $key.$_FILES['pictures']['name'][$key];
        		$file_size =$_FILES['pictures']['size'][$key];
        		$file_tmp =$_FILES['pictures']['tmp_name'][$key];
        		$file_type=$_FILES['pictures']['type'][$key];	
                
            }
            $item = array(
            "title" => $_POST['title'],
            "subtitle" => $_POST['subtitle'],
            "category_id" => $cat_id,
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
                                    array("source" => $_FILES['pictures']['name'])
                                       
                                    
                                )
            );
            /*$accessToken = $meli->getAccessToken();
        	$ch = curl_init();
        	$data = array('file' => $_FILES['pictures']['name']);
        	curl_setopt($ch, CURLOPT_URL, "https://api.mercadolibre.com/pictures?access_token=".$accessToken['value']);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        	$json=curl_exec($ch);
        	curl_close($ch);
        	$imagen=json_decode($json, true);
        	$imagen["id"];
        	#Linkear la imagen al item
        	$response=$meli->postWithAccessToken('/items/MLA462432007/pictures',array('id' => $imagen['id']));*/
        	
            $item = $meli->postWithAccessToken("/items", $item);
            
            echo 'ok';
            echo '<pre>';
            print_r($item);
            echo '</pre>';
            
            die();
        }
        
    }
    $form .= '<div class="content-primary">
        <form method="POST" action="publish.php?sub='.$_GET['sub'].'" data-ajax="false" enctype="multipart/form-data">
        <ul data-role="listview" data-theme="d" data-divider-theme="d" style="margin-bottom:10px;"><li data-role="list-divider">Publicar producto para '.$cat_name.'</li></ul><br/>
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
        <label for="fotos">Fotos:</label>
        <input type="file" name="pictures[]" id="pictures" data-clear-btn="true">
        <input type="file" name="pictures[]" id="pictures" data-clear-btn="true">
        <input type="file" name="pictures[]" id="pictures" data-clear-btn="true">
        <input type="file" name="pictures[]" id="pictures" data-clear-btn="true">
        <input type="file" name="pictures[]" id="pictures" data-clear-btn="true">
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
    
    return $form;
}
function footerHtml()
{
    $footer = '';
    
    $footer .= '
    </div><!-- /content -->
    <div data-role="footer" class="footer-docs" data-theme="c">
    <p class="jqm-version"></p>
    <p>Hackaton Mercado Libre &#64; 2013</p>';
    if(basename($_SERVER['SCRIPT_NAME']) == 'publish.php' && isset($_GET['sub']))                
    {
        $footer .= '<a href="publish.php" data-role="button" data-theme="a" data-icon="arrow-l" class="ui-btn-right">Volver</a>';
    }
    $footer .= '</div>
    </div><!-- /page -->
    </body>
    </html>';
    return $footer;
}
?>