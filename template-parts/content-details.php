<!-- ********************* ACCES ******************-->
    <section>
        <h3>Accès</h3>
        <div role="information">
            <figure <?php $selected = get_field('acces-detail_sortie-edugeol'); if( in_array('voiture', $selected) ) { echo 'class="color-black"';} ?>>
                <i class="icon-cab<?php $selected = get_field('acces-detail_sortie-edugeol'); if( in_array('voiture', $selected) ) { echo ' color-black';} ?>"></i>
            </figure>

            <figure <?php $selected = get_field('acces-detail_sortie-edugeol'); if( in_array('bus', $selected) ) { echo 'class="color-black"';} ?>>
                <i class="icon-bus<?php $selected = get_field('acces-detail_sortie-edugeol'); if( in_array('bus', $selected) ) { echo ' color-black';} ?>"></i>
            </figure>
            <figure <?php $selected = get_field('acces-detail_sortie-edugeol'); if( in_array('pieton', $selected) ) { echo 'class="color-black"';} ?>>
                <i class="icon-walk<?php $selected = get_field('acces-detail_sortie-edugeol'); if( in_array('pieton', $selected) ) { echo ' color-black';} ?>"></i>
            </figure>
            <p> 
               <?php the_field('texte-acces-detail_sortie-edugeol'); ?>
            </p>
        </div>
    </section>

    <section>
        <h3>Accès handicapé</h3>
        <div role="information">     
            <figure <?php $selected = get_field('radio-acces_handicape-detail_sortie-edugeol'); 
                    if($selected == 'oui') { echo 'class="color-black"';} ?>>

                <i class="icon-wheelchair<?php $selected = get_field('radio-acces_handicape-detail_sortie-edugeol'); if($selected == 'oui') { echo ' color-black';} ?>"></i>
            </figure>
            <p> 
                <?php
                if($selected == 'non') { echo ' Site non accessible<br/>';} ?>
                <?php the_field('texte-acces_handicape-detail_sortie-edugeol'); ?>
            </p>
        </div>
    </section>

    <section>
        <h3>Marche d'approche</h3>
        <div role="information">
            <figure <?php $selected = get_field('distance-marche_approche-detail_sortie-edugeol'); if($selected != '') { echo 'class= "color-black"';} ?>>
                <i class="icon-resize-horizontal<?php $selected = get_field('distance-marche_approche-detail_sortie-edugeol'); if($selected != '') { echo ' color-black';} ?>"></i>                            
            </figure>
            <figcaption>
                    <b>DISTANCE :</b> <?php the_field('distance-marche_approche-detail_sortie-edugeol'); ?>
                </figcaption>
        </div>

        <div role="information">
            <figure <?php $selected = get_field('temps-marche_approche-detail_sortie-edugeol'); if($selected != '') { echo 'class= "color-black"';} ?>>
                 <i class="icon-clock<?php $selected = get_field('temps-marche_approche-detail_sortie-edugeol'); if($selected != '') { echo ' color-black';} ?>"></i>
            </figure>
            <figcaption> 
                <b>TEMPS :</b> <?php the_field('temps-marche_approche-detail_sortie-edugeol'); ?>
            </figcaption>
        </div>

        <div role="information">
            <i class="icon-shoes<?php if(get_field('difficulte-marche_approche-detail_sortie-edugeol') != '') { echo ' color-black';} ?>"></i>

            <i class="icon-shoes<?php $selected = get_field('difficulte-marche_approche-detail_sortie-edugeol'); if($selected == 'moyen' || $selected == 'difficile') { echo ' color-black';} ?>"></i>

            <i class="icon-shoes<?php $selected = get_field('difficulte-marche_approche-detail_sortie-edugeol'); if($selected == 'difficile') { echo ' color-black';} ?>"></i>

            <figcaption> 
                <b>DIFFICULTE :</b> <?php the_field('difficulte-marche_approche-detail_sortie-edugeol'); ?>
            </figcaption>
        </div>
    </section>                  

    <!-- ********************* NOMBRE DE PERSONNES ******************-->

    <section>
        <h3>Nombre de personnes</h3>
        <div role="information">
            <figure <?php $selected = get_field('personnes-detail_sortie-edugeol'); if($selected != '') { echo 'class= "color-black"';} ?>>
                <i class="icon-people<?php $selected = get_field('personnes-detail_sortie-edugeol'); if($selected != '') { echo ' color-black';} ?>"></i>

            </figure>
            <figcaption><?php the_field('personnes-detail_sortie-edugeol'); ?> personnes</figcaption>
            <p> 
               <?php the_field('texte-personnes-detail_sortie-edugeol'); ?>
            </p>
        </div>
    </section>

    <!-- ********************* SITE PROTEGE ******************-->

     <section>
        <h3<?php 
            $selected = get_field('radio-protege-detail_sortie-edugeol'); 
            if($selected == 'oui') { 
                echo " class=\"protected\">Site protégé";
            }
            else {
                echo " class=\"unprotected\">Site non protégé";
            }
            ?>                        
        </h3>
        <div role="information">
            <p>
            <?php 
                $selected = get_field('radio-protege-detail_sortie-edugeol');
                if($selected == 'oui') { echo 'Le site est protégé. <br>Il est interdit d\'échantilloner.';} else { echo 'Le site n\'est pas protégé.<br> Il est possible d\'échantilloner.';}
            ?>
            </p>
        </div>
    </section>

    <!-- ********************* SECURITE ******************-->

    <section>
        <h3>Equipement & Sécurité</h3>
            <div role="information">                             
                <p> 
                    <?php the_field('securite-detail_sortie-edugeol'); ?>
                </p>
        </div>
    </section>
    <!-- ********************* AUTEUR ******************-->

    <section>
        <h3>Auteur</h3>
            <div role="information">                             
                <h4> 
                    <?php the_author_meta(user_nicename); ?>
                </h4>
                <p><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">Voir les autres publications de l'auteur</a> 
                </p>
        </div>
    </section>
