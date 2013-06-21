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
    	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
        
    </head> 
    
    <body> 
    
    <div data-role="page">
    
    	<div data-role="header">
    		<h1 style="color:#716c3b;"><img src="imagenes/user.png"/>'.$user.'</h1>';
     if(basename($_SERVER['SCRIPT_NAME']) != 'home.php' || isset($_GET['q']) && !empty($_GET['q']))
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
    global $meli;
    
    $category = '';
    
    $category = $meli->get('/sites/MLA/categories/');

    foreach ($category['json'] as &$categoryItem):
		   $category .= '<li><a href="sub_category.php?id=' . $categoryItem['id'] . '">'. html_entity_decode($categoryItem['name']).'</a></li>';
    	
    endforeach;
    
    return $category;
}

function displaySubCategories($id)
{
    global $meli;
    
    $sub_cat = '';
    
    $category = $meli->get('/categories/'.$id);
    $categoryItem = array();
    $sub_cat .= 'Nombre sub categoria: <b>'.$category['json']['name'].'<br/>';
    foreach ($category['json'] as &$categoryItem):
		   $sub_cat .= $category['json']['children_categories']['name'].'<br/>';
           //$sub_cat .= '<li><a href="sub_category.php?id=' . $categoryItem['children_categories'][id] . '">'. $categoryItem[children_categories][name].'</a></li>';
    	
    endforeach;
    
    
    return $sub_cat;
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

function displaySearchform()
{
    global $meli;
   
    $form = '';
    
    if(isset($_REQUEST['q']))
    {
    	$query = $_REQUEST['q'];
    
    	$search = $meli->get('/sites/#{siteId}/search/',array(
    		'q' => $query)
    	);
    }
    
    $form .= '<form>';
    $form .= '<label for="search-mini">Buscar productos:</label>';
    $form .= '<input type="search" name="q" value="'.$query.'" data-mini="true" />';
    $form .= '</form><br/><br/>';
    
    /*$form .= '<div class="content-primary">	
		      <ul data-role="listview">';
    	
    		foreach ($search['json']['results'] as &$searchItem)
            {
                $form .= '<li><a href="product.php?id="'.$searchItem['id'].'">
				<img src="'.$searchItem['thumbnail'].'" />
				<h3>'.$searchItem['title'].'</h3>
				<p>'.$searchItem['subtitle'].'</p>
                <p class="ui-li-aside"><strong>'.$searchItem['price'].' '.$searchItem['currency_id'].'</strong></p>
			    </a></li>';
            }
    $form .= '</ul>';
    $form .= '</div>';*/
   	
    return $form;
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
function footerHtml()
{
    $footer = '';
    
    $footer .= '
    </div><!-- /content -->
        <div data-role="footer" class="footer-docs" data-theme="c">
    					<p class="jqm-version"></p>
    				<p>Hackaton Mercado Libre &#64; 2013</p>
    	</div>
	</div><!-- /page -->
    </body>
    </html>';
    return $footer;
}
?>