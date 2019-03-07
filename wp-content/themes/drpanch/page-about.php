<?php
/**
 * The template for displaying the about page
 * Template Name: About Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package panch
 */

get_header();
?>
	<?php
		while ( have_posts() ) :
			the_post();
		?>
		<header class="large" style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-position: center <?php the_field('anchor_position'); ?>;">
		</header>
		<article>
			<section class="content grid-container inner-page">
				<div class="grid-x grid-padding-x">
					<div class="cell medium-12 large-3 small-12">
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="cell medium-12 large-9 small-12">
						<?php the_content(); ?>
					</div>
				</div>
				<hr>
				<div class="grid-x grid-padding-x">
					<div class="cell medium-6 hide-for-small-only flex-container flex-dir-column">
						<div class="particle flex-child-auto" id="particles">

						</div>
						<?php if( have_rows('downloads') ): ?>

						<div class="downloads">

								<ul>
									<?php
								while ( have_rows('downloads') ) : the_row();
									?>
										<li><a target="_blank" href="<?php echo get_sub_field('file'); ?>"><?php echo get_sub_field('file_name'); ?></a></li>
									<?php
								endwhile;
								?></ul>
						</div>
						<?php endif; ?>
						<?php if( have_rows('downloads') ): ?>
						<div class="recent-news">
							<h4>Recent news</h4>
							<ul>
								<?php
								while ( have_rows('news') ) : the_row();
									?>
										<li>
											<a target="_blank" href="<?php echo get_sub_field('article_url'); ?>"><?php echo get_sub_field('article_name'); ?></a><br/>
											<span class="sub-text"><?php echo get_sub_field('article_source'); ?> &ndash; <?php echo get_sub_field('article_date'); ?></span>
										</li>
									<?php
								endwhile;
								?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
					<div class="cell medium-6 small-12 extra-content">

						<?php the_field('extra_information'); ?>
					</div>
					<div class="cell small-12 show-for-small-only ">
						<?php if( have_rows('downloads') ): ?>

						<div class="downloads">

								<ul>
									<?php
								while ( have_rows('downloads') ) : the_row();
									?>
										<li><a target="_blank" href="<?php echo get_sub_field('file'); ?>"><?php echo get_sub_field('file_name'); ?></a></li>
									<?php
								endwhile;
								?></ul>
						</div>
						<?php endif; ?>
						<?php if( have_rows('downloads') ): ?>
						<div class="recent-news">
							<h4>Recent news</h4>
							<ul>
								<?php
								while ( have_rows('news') ) : the_row();
									?>
										<li>
											<a target="_blank" href="<?php echo get_sub_field('article_url'); ?>"><?php echo get_sub_field('article_name'); ?></a><br/>
											<span class="sub-text"><?php echo get_sub_field('article_source'); ?> &ndash; <?php echo get_sub_field('article_date'); ?></span>
										</li>
									<?php
								endwhile;
								?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</section>

		</article>

		<?php

		endwhile;
	?>
<?php
// get_sidebar();
get_footer();
