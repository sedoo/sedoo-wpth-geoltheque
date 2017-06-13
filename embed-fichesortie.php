<?php
if (get_field('fiche_arret-description_sortie-edugeol')) 
{
    $MasterFicheUrl=get_field('fiche_arret-description_sortie-edugeol');
    $MasterFicheID= url_to_postid( $MasterFicheUrl );
    $MasterFicheTitle=get_the_title( $MasterFicheID );
}

if (has_post_thumbnail()){
    $thumbnailUrl=wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
}
else {
    $thumbnailUrl=wp_get_attachment_url( get_post_thumbnail_id($MasterFicheID) );
}

?>
   

<article class="fichesortie">
    <header>
        <p>
            <?php $the_terms = the_terms( $post->ID, 'niveau', 'NIVEAU : ' ); ?>
        </p>
    </header>
    <a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo $thumbnailUrl; ?>) ">
        <h2>
            <?php the_title(); ?>
            <i class="icon-tag"></i>
        </h2>

    </a>
    <section>
       <div>
            <h3>Description</h3>
            <?php the_excerpt(); ?>
        </div>
        <div>
            <h3>Thèmes</h3>
            <ul>
                <?php
   // Creation de la liste des terms de la taxonomie nommée

            $argsTerms = array(
            'orderby'    => 'asc',
            'hide_empty' => 0
            );
            $terms=get_terms(themes,$argsTerms); 

            if  ($terms) 
                {foreach ($terms  as $term ) {
                    if( has_term( $term->slug, 'themes' ) ): 
                        { echo '<li><i class="icon-record"></i>' . $term->name . '</li>';
                        }
                endif; 
                    }   
                }
            ?>
            </ul>
        </div>

        <div>
            <h3>Activites</h3>
            <!-- *******************   ACTIVITES *******************  -->
            <div role="filtre-activites">               
                <?php
                // Creation de la liste des terms de la taxonomie nommée
                    $argsTerms = array(
                        'orderby'    => 'asc',
                        'hide_empty' => 0
                    );
                $terms=get_terms(activites,$argsTerms); 

                if  ($terms) {
                  foreach ($terms  as $term ) {
                      if( has_term( $term->slug, 'activites' ) ): {
                            echo '<figure class="active">
                                <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 245.986 254.986" enable-background="new 0 0 245.986 254.986" xml:space="preserve">

                                    <use xlink:href="#'.$term->slug.'" /> </svg>
                                </figure>';
                        }                                  
                    endif; 
                  }
                } 
                ?>                    
            </div>                        
        </div>
        <a href="<?php the_permalink(); ?>">Accéder à la fiche</a>
    </section>
</article>