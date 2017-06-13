<?php
/********************** DESCRIPTION ******************/
?>
<h1>Données issues du terrain</h1>
<div role="description">
    <section role="tab-block">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description du site &nbsp;<i class="icon-right-dir"></i></a></li>

            <li role="presentation"><a href="#sites-a-proximite" aria-controls="sites-a-proximite" role="tab" data-toggle="tab" onclick="mapProxy()">Sites à proximité &nbsp;<i class="icon-right-dir"></i></a></li>

            <li role="presentation"><a href="#carte" aria-controls="carte" role="tab" data-toggle="tab" onclick="mapBrgm()">Carte géologique&nbsp;<i class="icon-right-dir"></i></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" role="tab-content">
            <article role="tabpanel" class="tab-pane fade in active" id="description">
                <?php the_field('description-description_sortie-edugeol');  ?>
            </article>
                
            <article role="tabpanel" class="tab-pane fade" id="sites-a-proximite">
                <section role="resultat-recherche" class="simple">
                
                    <?php 
                    if( get_field('sites_a_proximite-description_sortie-edugeol') ) 
                    {
                        $sitesProximite = get_field('sites_a_proximite-description_sortie-edugeol'); 
                        echo "<h2>Liste des sites à proximité</h2>";
                        $i=0;
                        $fiche = array();
                        foreach ($sitesProximite as $site) {
                            //recup ID à partir de l'URL
                            array_push($fiche, url_to_postid( $site ));

                            }
                        // GET PAGE BY ID                                        
                        $argsQuery = array (
                            'post_type' => array( 'fichesortie' ),
                            'post__in' => $fiche
                        );
                        addMap("mapProxy", "osm, brgm", "true", "".$location['lng'].",".$location['lat']."", "9", "true", $argsQuery, "true");

                            ?>
                        <div id="mapProxy"></div>
                        <?php



                            // The Query                             
                            $site_proximite_query = new WP_Query( $argsQuery );

                            // The Loop
                            if ( $site_proximite_query->have_posts() ) {

                                while ( $site_proximite_query->have_posts() ) {
                                    $site_proximite_query->the_post();
                                    /**********************************************************/
                                    get_template_part('embed-fichesortie');
                                    /**********************************************************/
                                }
                            } 

                            /* Restore original Post Data */
                            wp_reset_postdata();


                    } else {
                        ?>
                        <h2>
                            <span class="icon-emo-unhappy"></span> Rien en stock...
                        </h2>
                        <?php
                    }
                    ?>
                    </section>
                            
            </article>


            <article role="tabpanel" class="tab-pane fade" id="carte" >       
               <?php              
                addMap("mapBrgm", "osm, brgm", "true", "".$location['lng'].",".$location['lat']."", "10", "false", $argsQuery, "true");
                ?>
                 <div id="mapBrgm" ></div>              
            </article>
        </div>

    </section>


    <!-- ********************* ÉLÉMENTS D'INTERPRÉTATIONS/BOÎTE À OUTILS ******************/ -->

    <h1 role="titre-description">Éléments d'interprétation / Activités</h1>
    <section role="tab-block">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#aide_a_linterpretation-interpretations_sortie-edugeol" aria-controls="aide_a_linterpretation-interpretations_sortie-edugeol" role="tab" data-toggle="tab">Aide à l'interprétation &nbsp;<i class="icon-right-dir"></i></a></li>

            <li role="presentation"><a href="#pistes_pedagogiques-interpretations_sortie-edugeol" aria-controls="pistes_pedagogiques-interpretations_sortie-edugeol" role="tab" data-toggle="tab">Pistes pédagogiques &nbsp;<i class="icon-right-dir"></i></a></li>

            <li role="presentation"><a href="#bibliographie-interpretations_sortie-edugeol" aria-controls="bibliographie-interpretations_sortie-edugeol" role="tab" data-toggle="tab">Bibliographie &nbsp;<i class="icon-right-dir"></i></a></li>

            <li role="presentation"><a href="#aller_plus_loin-interpretations_sortie-edugeol" aria-controls="aller_plus_loin-interpretations_sortie-edugeol" role="tab" data-toggle="tab">Aller plus loin &nbsp;<i class="icon-right-dir"></i></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" role="tab-content">
            <article role="tabpanel" class="tab-pane fade in active" id="aide_a_linterpretation-interpretations_sortie-edugeol"><?php the_field('aide_a_linterpretation-interpretations_sortie-edugeol'); ?></article>

            <article role="tabpanel" class="tab-pane fade" id="pistes_pedagogiques-interpretations_sortie-edugeol"><?php the_field('pistes_pedagogiques-interpretations_sortie-edugeol'); ?></article>

            <article role="tabpanel" class="tab-pane fade" id="bibliographie-interpretations_sortie-edugeol"><?php the_field('bibliographie-interpretations_sortie-edugeol'); ?></article>

            <article role="tabpanel" class="tab-pane fade" id="aller_plus_loin-interpretations_sortie-edugeol"><?php the_field('aller_plus_loin-interpretations_sortie-edugeol'); ?></article>
        </div>
    </section>


    <!-- ********************* ANNEXES ******************-->
    <h1 role="titre-description">ANNEXES</h1>
    <section role="tab-block" >

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">Photos &nbsp;<i class="icon-right-dir"></i></a></li>
            <li role="presentation"><a href="#videos" aria-controls="videos" role="tab" data-toggle="tab">Vidéos &nbsp;<i class="icon-right-dir"></i></a></li>
            <li role="presentation"><a href="#ressources" aria-controls="ressources" role="tab" data-toggle="tab">Plus de ressources sur ce theme &nbsp;<i class="icon-right-dir"></i></a></li>


        </ul>

        <!-- Tab panes -->
        <div class="tab-content" role="tab-content">
            <article role="tabpanel" class="tab-pane fade in active" id="photos">
               <div>
                  <?php 


                  for ($i=1;$i<7;$i++) {
                    $image = get_field('photos_'.$i.'-annexes_sortie-edugeol');
                    if (!empty($image)) { 
                    // vars
                    $url = $image['url'];
                    $title = $image['title'];
                    $alt = $image['alt'];
                    $caption = $image['caption'];

                    // thumbnail
                    $size = 'large';
                    $thumb = $image['sizes'][ $size ];
                    $width = $image['sizes'][ $size . '-width' ];
                    $height = $image['sizes'][ $size . '-height' ];
                  ?>
                      <figure>
                         <a href="<?php echo $url; ?>" target="_blank" title="<?php echo $title; ?>">
                            <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"/>
                        </a>
                        <?php if( $caption ) { ?>
                        <figcaption><?php echo $caption; ?></figcaption>
                        <?php } ?>
                      </figure>
                  <?php 
                    }
                  }                                  
                  ?>

               </div>                            
            </article>
            <article role="tabpanel" class="tab-pane fade" id="videos"> 
               <div class="embed-container">
                <?php the_field('videos-annexes_sortie-edugeol'); ?>
               </div> 
            </article>
            <article role="tabpanel" class="tab-pane fade" id="ressources">
                <ul role="filtre-niveaux">
                <?php $terms = get_the_terms( $post->ID, 'themes'); ?>

                <?php 
                if( $terms ): 
                    $i=0;
                    foreach( $terms as $term ): ?>

                        <li><a href="http://www4.obs-mip.fr/motcle/<?php echo $term->slug; ?>" title="Voir toutes les ressources associées à ce thème" target="_blank"><?php echo $term->name; ?></a></li>

                    <?php 
                    $i++;
                    endforeach; 
                endif; 
                ?>
                </ul>
            </article>
        </div>

    </section>
</div>