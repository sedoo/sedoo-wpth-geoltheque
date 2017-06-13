<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lithotheque
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--<link href='https://fonts.googleapis.com/css?family=Raleway:400,400italic,700' rel='stylesheet' type='text/css'>-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav role="navTop">
   <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="Retour à l'accueil">
    <figure>
        <img src="<?php echo get_bloginfo('template_directory') ?>/svg/logo.svg" alt="logo géoltheque sud ouest en svg">
    </figure>
    </a>
    <?php wp_nav_menu(array('menu_id' => 'primary-menu',
                            'depth' => '1'
                           )); 
    ?>
</nav>

<?php
     
//                        'container' => 'nav', 
//                        'container_id' => 'sidebar-wrapper', 
//                        'container_class' => 'navLeft',
    ?>
