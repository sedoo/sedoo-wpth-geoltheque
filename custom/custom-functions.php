<?php 

function lithotheque_all_scriptsandstyles() {
    // Enqueue the style
    wp_enqueue_script('jquery-link', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js');
    
    wp_enqueue_style ('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
    // Enqueue the script
    wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
   
    wp_enqueue_style('fontello-geoltheque', get_template_directory_uri() . '/css/geoltheque.css');
    
}

add_action( 'wp_enqueue_scripts', 'lithotheque_all_scriptsandstyles', 0 );

add_theme_support( 'post-thumbnails' );

/******************************************************************
* CUSTOM TAXONOMIES 
*
* fonctions de déclaration des taxonomies (mots clés) personnalisés
*
*/
include 'custom-taxonomies.php';

/******************************************************************
* CUSTOM TAXONOMIES 
*
* fonctions de déclaration des types de page personnalisés
*
*/
include 'custom-post-type.php';


/******************************************************************
* MAPS OPENLAYERS
*
*/
include 'parameters-map.php';

/******************************************************************@
* GESTION DES IMAGES
*
* Support des thumbnails (images à la une)
* Tailles d'images
* Paramètre d'attachement par défaut d'une illustration (alignement/lien/taille)
* 
*/
include 'custom-config-images.php';

/******************************************************************
* ACF GOOGLE MAP API KEY
*
*/
function geoltheque_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDTsIToPYSoGidnogwBvgCJ_G_fuQCmFak');
}

add_action('acf/init', 'geoltheque_acf_init');

// function geoltheque_acf_google_map_api( $api ){
	
// 	$api['key'] = 'AIzaSyDZUik7BZl1ibw28RI5KYLr8fFEjZwL8O8';
	
// 	return $api;
	
// }

// add_filter('acf/fields/google_map/api', 'geoltheque_acf_google_map_api');