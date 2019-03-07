<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package panch
 */

get_header();
?>
	<header class="large">
		<div class="live-background" id="particles"></div>
		<div class="grid-container">
			<div class="grid-x">
				<div class="cell">
					<h1>404 - page not found</h1>
				</div>
			</div>
		</div>
	</header>
	<article>
		<footer class="grid-container ">
		<?php
			$featured_posts = new WP_Query(array(
				'posts_per_page' => 3,
				'category_name' => 'featured'
			));
			while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
			?>

			<div class="post">
				<div class="featured-img">
					<div class="bg" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></div>
				</div>
				<div class="copy">
					<h2>
						<?php the_title(); ?>
					</h2>
					<a href="<?php the_permalink(); ?>" class="read-more">Learn More &raquo;</a>
				</div>
			</div>

			<?php
			endwhile;
		?>
		</footer>
	</article>

<?php
get_footer();
