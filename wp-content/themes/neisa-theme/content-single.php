<?php
/**
 * @package neisa-theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="container">

						<div class="row">


							<div class="col-md-8">
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
