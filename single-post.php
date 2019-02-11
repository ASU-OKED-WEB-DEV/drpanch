<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package panch
 */

get_header();
?>
	<?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
		while ( have_posts() ) : the_post();
			$postCategory = '';
			$postCategoryURL = '';
			foreach(get_the_category() as $category) {
				if($category->slug != 'featured' || $category->slug != 'uncategorized'){
					$postCategory = $category->slug;
					$postCategoryURL = get_category_link($category->cat_ID);
					break;
				}
			}
	?>
	<article class="inner-page">

		<section class="grid-container inner-page">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 large-9">
					<h1><?php the_title(); ?></h1>
					<hr>
					<div class="meta clearfix">
						<div class="date"><?= get_the_date("F j, Y"); ?></div>
						<div class="user clearfix">
							<div class="user_image"><?= get_avatar( $post->post_author ); ?></div>
							<div class="user_name"><?php the_author_meta( 'nickname' , $post->post_author ); ?></div>
						</div>
					</div>
					<?php the_content(); ?>

					<a href="<?= $postCategoryURL; ?>" class="read-more">&laquo; <?= $postCategory; ?></a>
				</div>
				<div class="cell large-auto keywords hide-for-small-only">
					<?php
					$post_tags = get_the_tags();
					if ( $post_tags ) : ?>
						<h3>Keywords</h3>
						<ul class=""><?php
						foreach( $post_tags as $tag ) : ?>
							<li><a href="<?= get_term_link($tag->term_id); ?>"><?= $tag->name; ?></a></li>
						<?php endforeach;
						?></ul><?php
					endif;
					?>
				</div>
			</div>
		</section>
		<footer class="grid-container ">
			<?php
				$featured_posts = new WP_Query(array(
					'posts_per_page' => 3,
					'category_name' => $postCategory,
					'post__not_in' => array(get_the_ID())
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
	<?php endwhile; ?>

<?php
get_footer();
