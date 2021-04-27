<?php /* page.php */
 
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container">           

                <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'full', array( 'class'=>'img-fluid single-thumbnail' ) );
                    }
                ?>

                <div class="post-content">
                    <div class="post-intro">
                        <h2 class="page-title"><?php the_title(); ?></h2>
                    </div>
                    <?php  the_content(); ?>
                </div>       

            </div>

        </main>
    </div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>