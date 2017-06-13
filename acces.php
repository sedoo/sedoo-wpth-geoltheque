 <?php
/*
Template Name: acces
*/

get_header(); ?>


<section role="resultat-recherche">
<?php
    the_ID();
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

<?php
get_footer();
?>