<?php
/**
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package panch
 */

get_header();
?>

	<?php
	$about_query = new WP_Query( 'pagename=about panch' );
    while ( $about_query->have_posts() ) : $about_query->the_post();
	?>

	<article class="parallax about" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url(); ?>">
		<div class="bg"></div>
		<div class="content">

			<div class="grid-container">
				<div class="grid-x">
					<div class="cell small-12 medium-6">
						<h1><span class="thin">Sethuraman</span><br/>Panchanathan</h1>
						<hr>
						<p class="hide-for-small-only">
							<?php echo wp_trim_words(get_the_excerpt(), 36, '&hellip;'); ?>
						</p>
						<a href="<?php echo get_page_link(); ?>" class="read-more">about panch &raquo;</a>
					</div>
				</div>
			</div>
		</div>
	</article>

	<?php
    endwhile;
    wp_reset_postdata();
	?>
	<?php
	$featured_posts = new WP_Query();
	$featured_posts->query('showposts=4' . '&category_name=featured');
    while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
	?>

	<article class="parallax featured-story" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url(); ?>">
		<div class="bg"></div>
		<div class="content">
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell small-12 medium-8">
						<h2><?php the_title(); ?></h2>
						<hr>
						<div class="meta clearfix">
							<div class="date"><?php echo get_the_date("F j, Y"); ?></div>
							<div class="user clearfix">
								<div class="user_image"><?php echo get_avatar( get_the_author_ID() )?></div>
								<div class="user_name"><?php the_author_meta( 'nickname' , get_the_author_ID() ); ?></div>
							</div>
						</div>
						<p>
							<?php echo wp_trim_words(get_the_excerpt(), 36, '&hellip;'); ?>
						</p>
						<a href="<?php the_permalink(); ?>" class="read-more">learn more &raquo;</a>
					</div>
				</div>
			</div>
		</div>
	</article>

	<?php
    endwhile;
    wp_reset_postdata();
	?>

<?php
// get_sidebar();
get_footer();
