<?php /* Template Name: Blog page */ 

get_header();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array(
		'post_type'              => 'post',
		'orderby'                => 'date',
		'order'                  => 'DESC',
		'showposts'              => 9,
		'no_rows_found'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
		'paged' => $paged
		);

$the_query = new WP_Query( $args ); ?>
 
<?php if ( $the_query->have_posts() ) : ?>

    <div class="main">

		<div class="container">

				<h2 class="page-title" style="margin-top: 30px;"><?php the_title(); ?></h2>

				<div class="row row-cols-1 row-cols-lg-3 g-4 blog-grid">
 
			    <!-- the loop -->
			    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			    	<?php $post_link = get_permalink(); ?>
			        
			        <div class="col">
    					<div class="card h-100">

							<div class="card-img-container">			
							
								<a href="<?php echo $post_link; ?>">
									<?php the_post_thumbnail( 'full', array( 'class'=>'card-img-top img-fluid' ) ); ?>
									<div class="card-img-overlay">
										<img class="plus-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/plus-icon.svg">
									</div>
								</a>
								
							</div>

							<div class="card-body">
								<div class="card-meta">
									<!--
									<div class="author">
										Objavio: <?php //the_author(); ?> 
									</div>
									-->
									<div class="date">
										<?php echo get_the_date(); ?>
									</div>
								</div>
								<a href="<?php echo $post_link; ?>"><h5 class="card-title"><?php the_title(); ?></h5></a>
								<?php the_excerpt(); ?>
								<a href="<?php echo $post_link; ?>" class="card-link">opširnije...</a>
							</div>

						</div>
					</div>
	
			    <?php endwhile; ?>
			    <!-- end of the loop -->

			</div><!-- row -->

			<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
					<nav class="prev-next-posts">
						<div class="prev-posts-link">
							<?php echo get_next_posts_link( 'Starije objave', $the_query->max_num_pages ); // display older posts link ?>
						</div>
						<div class="next-posts-link">
							<?php echo get_previous_posts_link( 'Novije objave' ); // display newer posts link ?>
						</div>
					</nav>
				<?php } ?>
			 
			    <?php wp_reset_postdata(); ?>
 
				<?php else : ?>
				    <p><?php _e( 'Nažalost nema objava za vašu pretragu.' ); ?></p>
				<?php endif; ?>

		</div>

	</div>

<?php get_footer(); ?>