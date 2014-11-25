<?php
/*
Template Name: One Column
*/
?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'contact-page-template' ); ?>>

					<div class="container">

						<div class="row">

							<div class="col-md-2">

							<ul>
							  <li>1</li>
							  <li>2</li>
							  <li>3</li>
							  <li>4</li>
							  <li>5</li>
							</ul>


							</div><!-- /.col-xs-4 .col-md-2 -->


							<div class="col-md-10">
								<?php
								if ( has_post_thumbnail() ) :
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
								endif;
								?>
								<h1><?php the_title(); ?></h1>
								<p><?php the_content(); ?></p>
							</div><!-- /.col-xs-8 .col-md-6 -->

					    </div><!-- /row -->


					</div><!-- /container -->


				</article><!-- #post-## -->

			<?php endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
