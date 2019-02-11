<?php
/**
 * The template for displaying general pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package panch
 */

get_header();
?>

	<?php
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
	while ( have_posts() ) :
		the_post();

		if(has_post_thumbnail()){
			?>
			<header class="small" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></header>
			<?php
		}
		?>
		<article class="inner-page">
			<section class="grid-container inner-page">
				<div class="grid-x grid-padding-x">
					<div class="cell large-9 small-12">
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
					<div class="cell large-auto small-12">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</section>
		</article>
		<?php

	endwhile; // End of the loop.
	?>

<?php
get_footer();
