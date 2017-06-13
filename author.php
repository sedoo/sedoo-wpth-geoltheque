<?php
get_header();

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

$argsQuery = array (
                    'post_type' => array( 'fichesortie' ),
                    'author' => $curauth->ID
                    
                );

$the_query = new WP_Query( $argsQuery );

?>
<main role="advancedSearch">

<?php
    
    ?>

    <h1>Auteur: <?php echo $curauth->nickname;?></h1>
    
<section role="resultat-recherche" class="simple">
    <?php
    while ( $the_query->have_posts() ) :
        $the_query->the_post();
           include("embed-fichesortie.php");         
    endwhile;
    wp_reset_postdata();
    ?>

</section>

</main>
<?php
get_footer();
?>