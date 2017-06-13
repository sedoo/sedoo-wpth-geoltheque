<?php get_header(); ?>
<div class="fichesortie">
  <?php if (have_posts()) : ?>
    
     
     ?php while (have_posts()) : the_post(); ?>
      <article class="fichesortie">
          <div role="banner" style="background-image: url(images/st-cirq.jpg)">
              <h1 classe="title">                    <small>/auteur</small>
              </h1>

              <div role="niveau">
                  <p><small>Niveau</small>
                      <br> PRIMAIRE - COLLEGE
                      <br>
                  </p>
              </div>
          </div>

        <?php the_post_thumbnail( 'thumbnail' ); ?>
        <h1 class="title">
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h1>
        <div class="content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
<?php get_footer(); ?>


<?php the_terms( $post->ID, 'themes', 'THEMES : ' ); ?><br>
<?php the_terms( $post->ID, 'activites', 'ACTIVITES : ' ); ?><br>
<?php the_terms( $post->ID, 'niveau', 'NIVEAU : ' ); ?><br>

get_terms ( array|string $args = array(), array $deprecated = '' )


