<?php /* single post */

get_header(); 

    // Start the single post loop.
    while ( have_posts() ) : the_post(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container">           

                <div class="post-content">
                    <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'full', array( 'class'=>'img-fluid single-thumbnail' ) );
                        }
                    ?>
                    <div class="post-intro">
                        <h2 class="post-title"><?php the_title(); ?></h2>
                        <p class="text-muted">Objavio: <?php the_author(); ?> | <span class="post-data"><?php echo get_the_date(); ?></span></p>
                    </div>
                    <?php  the_content(); ?>
                </div>       

            </div>

        </main>
    </div>

    <?php endwhile; ?>

<?php get_footer(); ?>