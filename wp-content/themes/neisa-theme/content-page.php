<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package neisa-theme
 */
?>

<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



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


<?php get_footer(); ?>
