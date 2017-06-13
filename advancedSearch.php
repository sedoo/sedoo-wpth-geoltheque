 <?php
/*
Template Name: Recherche avancée
*/

get_header(); ?>

<main role="advancedSearch">
<section role="resultat-recherche">
<?php
while ( have_posts() ) : the_post();
?>
    <h1>
        <?php the_title(); ?>
    </h1><!-- .entry-header -->
    <?php
        the_content();
    ?>

<?php
endwhile; // End of the loop.
?>
</section>
</main>
<?php
get_footer();
?>