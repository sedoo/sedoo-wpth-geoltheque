<?php
/******************************************************************
* CUSTOM TAXONOMIES 
*/

add_action('init', 'my_custom_taxonomies');
function my_custom_taxonomies()
{
    /*** 
    *  COMMONS CAPABILITIES
    *
    * Capacités personnalisées à utiliser avec le plugin "User Role Editor" (URE)
    * Dans URE, ajouter les capacités créées
    *
    */
    
    $capabilities = array(
        'manage_terms'    => 'omp_manage_terms',
		'edit_terms'      => 'omp_edit_terms',
        'delete_terms'    => 'omp_delete_terms',
        'assign_terms'    => 'omp_assign_terms',
	);
    
    /*** 
    *  TAXONOMIE THEMES
    */
    
    $labels_themes = array(
        'name' => 'Themes',
        'singular_name' => 'Themes',
        'all_items' => 'Toutes les themes',
        'edit_item' => 'Éditer le theme',
        'view_item' => 'Voir le theme',
        'update_item' => 'Mettre à jour le theme',
        'add_new_item' => 'Ajouter un theme',
        'new_item_name' => 'Nouveau theme',
        'search_items' => 'Rechercher parmi les themes',
        'popular_items' => 'Themes les plus utilisées',
    );
    
    $args_themes = array (
        'label' => 'Themes',
        'labels' => $labels_themes,
        'hierarchical' => true,
        'capabilities' => $capabilities,
//        'show_admin_column' => false,
//        'show_in_nav_menus' => false,
//        'show_tagcloud' => false,
        'show_ui' => true
    );

    register_taxonomy('themes', array('fichesortie', 'arretsortie'), $args_themes);

    /*** 
    *  TAXONOMIE ACTIVITES 
    */   
    
    $labels_activites = array(
        'name' => 'Activités',
        'singular_name' => 'Activités',
        'all_items' => 'Toutes les activités',
        'edit_item' => 'Éditer l\'activité',
        'view_item' => 'Voir l\'activité',
        'update_item' => 'Mettre à jour l\'activité',
        'add_new_item' => 'Ajouter une activité',
        'new_item_name' => 'Nouvelle activité',
        'search_items' => 'Rechercher parmi les activités',
        'popular_items' => 'Activités les plus recherchées'
      );
    
    $arg_activites = array (
        'label' => 'Activités',
        'labels' => $labels_activites,
        'hierarchical' => true,
        'capabilities' => $capabilities,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'show_tagcloud' => false,
        'show_ui' => true
    );
    
    register_taxonomy('activites', array('fichesortie', 'arretsortie'), $arg_activites);

    /*** 
    *  TAXONOMIE NIVEAUX
    */

    $labels_niveaux = array(
        'name' => 'Niveau',
        'singular_name' => 'Niveau',
        'all_items' => 'Tous les niveaux',
        'edit_item' => 'Éditer le niveau',
        'view_item' => 'Voir le niveau',
        'update_item' => 'Mettre à jour le niveau',
        'add_new_item' => 'Ajouter un niveau',
        'new_item_name' => 'Nouveau niveau',
        'search_items' => 'Rechercher parmi les niveaux',
        'popular_items' => 'Niveaux les plus recherchées'
    );
    
    $arg_niveaux = array(
        'label' => 'Niveau',
        'labels' => $labels_niveaux,
        'hierarchical' => true,
        'capabilities' => $capabilities,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'show_tagcloud' => false,
        'show_ui' => true    
    );
    
    register_taxonomy('niveau', array('fichesortie', 'arretsortie'), $arg_niveaux);
      
    
    //register_taxonomy_for_object_type( 'taxonomie', 'post_type' );
    register_taxonomy_for_object_type( 'themes', 'fichesortie' );
    register_taxonomy_for_object_type( 'themes', 'arretsortie' );
    register_taxonomy_for_object_type( 'activites', 'fichesortie' );
    register_taxonomy_for_object_type( 'activites', 'arretsortie' );
    register_taxonomy_for_object_type( 'niveau', 'fichesortie' );
    register_taxonomy_for_object_type( 'niveau', 'arretsortie' );
}
?>