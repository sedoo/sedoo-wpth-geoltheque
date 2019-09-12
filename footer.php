<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lithotheque
 */

?>
    <footer>
        <section role="partenaires">
           <h1>Partenaires</h1>
            <figure>
                <a href="http://edu.obs-mip.fr" title="Lien vers le site du service éducatif de l'Observatoire Midi-Pyrénées" target="_blank"><img src="<?php echo get_bloginfo('template_directory') ?>/images/logo_serveduOMP.png" alt=""></a>
            </figure>
            <figure>
                <a href="http://www.ac-toulouse.fr/" title="Lien vers le site de l'académie de Toulouse" target="_blank"><img src="<?php echo get_bloginfo('template_directory') ?>/images/logo_academieToulouse.png" alt=""></a>
            </figure>
        </section>
        <section role="links">
            <h1>Sites outils</h1>
            <ul>
                <li>
                    <a href="https://disciplines.ac-toulouse.fr/svt/des-sig-dans-l-enseignement-des-svt" title="Accéder aux ressources par thèmes d'activités et par outils logiciels"><img width="50px" src="<?php echo get_bloginfo('template_directory') ?>/images/logoSIGs.jpg" alt="">SIGthèque</a>
                </li>
                <li><a href="http://planet-terre.ens-lyon.fr/" title="Planet Terre ENS de Lyon"><img width="50px" src="<?php echo get_bloginfo('template_directory') ?>/images/logo-pt2.png" alt="">Planet Terre</a></li>
                <li><a href="http://infoterre.brgm.fr/"><img width="50px" src="<?php echo get_bloginfo('template_directory') ?>/images/logo-it.png" alt="">Info Terre</a></li>
                <li><a href="http://www.geoportail.gouv.fr/accueil" title="Interface cartographique GéoPortail"><img width="50px" src="<?php echo get_bloginfo('template_directory') ?>/images/logo-gp.png" alt="">Géo Portail</a></li>
                <li><a href="http://www.edusismo.org/" title="Sismos à l'école"><img width="50px" src="<?php echo get_bloginfo('template_directory') ?>/images/logo-sism.jpg" alt="">Sismo Ecoles</a></li>
                <li><a href="http://www.brgm.fr/decouverte/jeunes-education/edutheque-ressources-enseignement-geosciences" title="Eduthèque : des ressources pour l’enseignement des géosciences"><img width="50px" src="<?php echo get_bloginfo('template_directory') ?>/images/logo-et.jpg" alt="">Edu Terre</a></li>
                <li><a href="https://lithotheque.ac-montpellier.fr/geoduc" title="Portail national de ressources éduscol, Sciences de la Vie et de la Terre"><img width="50px" src="<?php echo get_bloginfo('template_directory') ?>/images/educ-nat1.gif" alt="">Lithothèques</a></li>
            </ul>
        </section>
        <section></section>
    </footer>
    <!-- #colophon -->
<?php include("svg/pictos.svg"); ?>

    <?php wp_footer(); ?>

        </body>

        </html>