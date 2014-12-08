<?php
/*
Template Name: Two Column
*/
?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div id="header-title">
				<div class="container">
					<div class="head-title">
						<?php the_title(); ?>
				    </div><!-- /news -->
				</div><!-- /container -->
			</div><!-- /header -->

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'contact-page-template' ); ?>>

					<div class="container">

						<div class="row">


							<div class="col-md-2 left-side-menu">

								<?php if($post->post_parent)
									$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
								else
								$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
								if ($children) { ?>
									<ul>
										<?php echo $children; ?>
									</ul>
								<?php } ?>

							</div><!-- /.col-xs-4 .col-md-2 -->


								<div class="col-md-6 two-column-first">
									<?php
									if ( has_post_thumbnail() ) :
										the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
									endif;
									?>
									<p><?php the_content(); ?></p>
								</div><!-- /.col-xs-8 .col-md-6 -->


								<div class="col-md-4 two-column-second">
									<?php

									$image = get_field('bild_column_2');

									if ( !empty( $image ) ) : ?>

										<img src="<?php echo $image ?>" class="img-responsive" />

									<?php endif; ?>
									<h1><?php the_field( 'second_column_title' ); ?></h1>
									<p><?php the_field( 'second_column' ); ?></p>
								</div><!-- /.col-xs-6 .col-md-4 -->


						     </div><!-- /row -->


						</div><!-- /container -->


				</article><!-- #post-## -->

			<?php endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
