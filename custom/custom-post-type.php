<?php
/******************************************************************
 * CUSTOM POST
 *
 */

add_action('init', 'my_custom_post_type');
function my_custom_post_type()
{
    
    /*** 
    *  CAPABILITIES
    *
    * Capacités personnalisées à utiliser avec le plugin "User Role Editor" (URE)
    * Dans URE, ajouter les capacités créées
    *
    */
    
    $capabilities_fichesortie = array(
        'publish_posts'         => 'publish_fichesortie',
        'edit_posts'            => 'edit_fichesortie',
        'edit_others_posts'     => 'edit_others_fichesortie',
        'delete_posts'          => 'delete_fichesortie',
        'delete_others_posts'   => 'delete_others_fichesortie',
        'read_private_posts'    => 'read_private_fichesortie',
        'edit_post'             => 'edit_fichesortie',
        'delete_post'           => 'delete_fichesortie',
        'read_post'             => 'read_fichesortie',
        'create_posts'          => 'create_fichesortie'
    );
    $capabilities_arretsortie = array(
        'publish_posts'         => 'publish_arretsortie',
        'edit_posts'            => 'edit_arretsortie',
        'edit_others_posts'     => 'edit_others_arretsortie',
        'delete_posts'          => 'delete_arretsortie',
        'delete_others_posts'   => 'delete_others_arretsortie',
        'read_private_posts'    => 'read_private_arretsortie',
        'edit_post'             => 'edit_arretsortie',
        'delete_post'           => 'delete_arretsortie',
        'read_post'             => 'read_arretsortie',
        'create_posts'          => 'create_arretsortie'
    );
    
    
    register_post_type(
      'fichesortie',
      array(
        'label' => 'Fiches de sorties',
        'labels' => array(
          'name' => 'Fiches de sorties',
          'singular_name' => 'Sortie',
          'all_items' => 'Toutes les Fiches de sorties',
          'add_new_item' => 'Ajouter une sortie',
          'edit_item' => 'Éditer la sortie',
          'new_item' => 'Nouveau sortie',
          'view_item' => 'Voir la sortie',
          'search_items' => 'Rechercher parmi les Fiches de sorties',
          'not_found' => 'Pas de sortie trouvé',
          'not_found_in_trash'=> 'Pas de sortie dans la corbeille'
          ),
        'public' => true,
        'capability_type' => 'post',
        'capabilities' => $capabilities_fichesortie,
        'supports' => array(
          'title',
          'thumbnail',
          'author',
          'excerpt'    
        ),
        'has_archive' => true
      )
    );
    
    register_post_type(
      'arretsortie',
      array(
        'label' => 'Arrêts de sortie',
        'labels' => array(
          'name' => 'Arrêts de sortie',
          'singular_name' => 'Arrêt',
          'all_items' => 'Toutes les Arrêts de sorties',
          'add_new_item' => 'Ajouter un arrêt',
          'edit_item' => 'Éditer l\'arrêt',
          'new_item' => 'Nouvel arrêt',
          'view_item' => 'Voir l\'arrêt',
          'search_items' => 'Rechercher parmi les Arrêts de sorties',
          'not_found' => 'Pas d\arrêt trouvé',
          'not_found_in_trash'=> 'Pas d\arrêt dans la corbeille'
          ),
        'public' => true,
        'capability_type' => 'post',
        'capabilities' => $capabilities_arretsortie,
        'supports' => array(
          'title',
          'thumbnail',
          'author',
          'excerpt'    
        ),
        'has_archive' => true
      )
    );
    

/********************** CUSTOM ROLE *****************************/

    add_role('fichesortie_author', 'Auteurs fiche sortie', array (
                                                                'publish_fichesortie' => true,
                                                                'edit_fichesortie' => true,
                                                                'edit_others_fichesortie' => false,
                                                                'delete_fichesortie' => true,
                                                                'delete_others_fichesortie' => false,
                                                                'read_private_fichesortie' => false,
                                                                'edit_fichesortie' => true,
                                                                'delete_fichesortie' => true,
                                                                'read_fichesortie' => true,
                                                                'create_fichesorties' => true,
                                                                // Arrets
                                                                'publish_arretsortie' => true,
                                                                'edit_arretsortie' => true,
                                                                'edit_others_arretsortie' => false,
                                                                'delete_arretsortie' => true,
                                                                'delete_others_arretsortie' => false,
                                                                'read_private_arretsortie' => false,
                                                                'edit_arretsortie' => true,
                                                                'delete_arretsortie' => true,
                                                                'read_arretsortie' => true,
                                                                'create_arretsorties' => true,
                                                                // more standard capabilities here
                                                                'read' => true,
                                                                'upload_files' => true
                                                            )
    );
             
} // end my_custom_post_type()
?>