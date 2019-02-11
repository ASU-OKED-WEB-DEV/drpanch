<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package panch
 */

get_header();
?>
	<?php if ( have_posts() ) : ?>
		<header class="small">
			<div class="live-background" id="particles"></div>
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell">
						<?php
						the_archive_title( '<h1>', '</h1>' );
						?>
					</div>
				</div>
			</div>
		</header>
		<section class="grid-container inner-page">
			<?php
			while ( have_posts() ) :
				the_post();

				?>
				<article class="grid-x grid-padding-x">
					<div class="featured-image cell large-4 small-12" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
					</div>
					<div class="content cell large-auto small-12">
						<header>
							<h2><?php the_title(); ?></h2>
							<div class="meta clearfix">
								<div class="date"><?= get_the_date("F j, Y"); ?></div>
								<div class="user clearfix">
									<div class="user_image"><?= get_avatar( $post->post_author ); ?></div>
									<div class="user_name"><?php the_author_meta( 'nickname' , $post->post_author ); ?></div>
								</div>
							</div>
						</header>
						<section class="copy">
							<p>
								<?php echo wp_trim_words(get_the_excerpt(), 45, '&hellip;'); ?>
							</p>
							<a href="<?php the_permalink(); ?>" class="read-more">learn more &raquo;</a>
						</section>
					</div>
				</article>
				<hr>
				<?php

			endwhile;
			?>
		</section><?php
	endif;
	?>
<?php
get_footer();
