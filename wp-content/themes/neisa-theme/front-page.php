<?php
/**
 * The template for front page
 *
 * @package sydljus-theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	            <div class="front-page-container">

					<div class="container">

						<div class="row">

						        <div class="col-md-8">
						        	<h2><?php _e( 'NEISA', 'neisa-theme' ); ?></h2>
						        	<hr>
									<?php the_content(); ?>
								</div>

						        <div class="col-md-4">
									<h2><?php _e( 'NYHETER', 'neisa-theme' ); ?></h2>
									<hr>

						        	<?php $news = new WP_Query(
																array(
																'post_type'      => 'post',
																'posts_per_page' => 3,
																));

									if ( $news->have_posts() ) :

										while ( $news->have_posts() ) : $news->the_post(); ?>

											<li>
												<a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
											</li>

										<?php endwhile; ?>

									<?php else: ?>

									<?php endif; ?>

									<?php wp_reset_postdata(); ?>

						       </div>

						</div><!-- /row -->


					</div><!-- /container -->

	            </div><!-- .front-page-container -->

			<?php endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<!--<?php // get_sidebar(); ?>-->
<?php get_footer(); ?>
