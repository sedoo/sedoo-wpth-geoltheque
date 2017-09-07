<?php get_header(); 
include("js/commons-map.php"); 
?>
    
<div class="homeContainer">
    <!-- CARTE -->
    <section role="carte">
        <h1>Choix sur la carte <i></i></h1>
        <p>Cliquez sur un point de la carte pour choisir votre sortie</p>
        <?php
        // Utilisation de la fonction addMap()
        
        // WP_Query arguments
        $argsQuery = array (
            'post_type' => array( 'fichesortie' )
        );
        
        addMap("mapHome", "osm, brgm", "true", "1.438161,43.601699", "8", "true", $argsQuery, "false");
        ?>
        
        <div id="mapHome"></div>

    </section>

   <section role="activites">
       <h1>
           Choix par activités <i></i>
        </h1>
       <p>Accédez aux sorties en choisissant des activités</p>
       <div role="filtre-activites">               
            <?php
            // Creation de la liste des terms de la taxonomie nommée
                $argsTerms = array(
                    'orderby'    => 'asc',
                    'hide_empty' => true,
                );
            $terms=get_terms(activites,$argsTerms); 

            if  ($terms) {
              foreach ($terms  as $term ) {
                echo '<figure class="active">';
                echo '
                <a href="'.get_term_link( $term ).'" title="Voir toutes les sorties de cette activité">
                <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px" viewBox="0 0 245.986 254.986" enable-background="new 0 0 245.986 254.986" xml:space="preserve">

                    <use xlink:href="#'.$term->slug.'" /> </svg>
                    <figcaption>
                    ' . $term->name . '
                    </figcaption>   
                    </a>
                </figure>';
              }
            } 
            ?>                    
        </div>
   </section>
   <section>
       <h1>Choix par thèmes <i></i></h1>
       <p>Accédez aux sorties en choisissant des thèmes</p>
       <ul role="filtre-themes">
           <?php
               // Creation de la liste des terms de la taxonomie nommée
                                        
            $argsTerms = array(
            'orderby'    => 'asc',
            'hide_empty' => true,
            );
            $terms=get_terms(themes,$argsTerms); 

            if ($terms) {
                foreach ($terms  as $term ) {
                    echo '<li><a href="'.get_term_link( $term ).'" title="Voir toutes les sorties de ce thème">' . $term->name . '</a> </li>';
                    }  
                } 
            ?>
           
       </ul>
   </section>
   <section>
       <h1>Choix par niveaux <i></i></h1>
       <p>Accédez aux sorties en choisissant des niveaux</p>
       <ul role="filtre-niveaux">
           <?php
               // Creation de la liste des terms de la taxonomie nommée
                                        
            $argsTerms = array(
            'order'    => 'ASC',
            'orderby'    => 'slug',
            'hide_empty' => true,
            );
            $terms=get_terms(niveau,$argsTerms); 

            if ($terms) {
                foreach ($terms  as $term ) {
                    echo '<li><a href="'.get_term_link( $term ).'" title="Voir toutes les sorties de ce niveau">' . $term->name . '</a> </li>';
                    }  
                } 
            ?>
       </ul>
   </section>

</div>

<?php
get_footer();
?>