<?php
get_header();
?>
<main role="advancedSearch">
<h1><?php the_archive_title(); ?></h1>

<section role="resultat-recherche" class="simple">
    <?php 
    while (have_posts()) : the_post(); 

        // recup custom post type name pour affichage des fiches de sortie seulement
        $post_type = get_post_type(  $post->ID ); 
        if ( $post_type == "fichesortie") {         
            include("embed-fichesortie.php");
        }
        
    endwhile;

    ?>
</section>
</main>
<?php
get_footer();
?>