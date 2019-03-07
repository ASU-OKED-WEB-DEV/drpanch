<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package panch
 */

?>
	</main>
	<footer class="main-footer">
		<div class="footer-inner grid-container">
			<div class="grid-x">
				<?php dynamic_sidebar('footer-1'); ?>
				<div class="copyright">
					Copyright © <?= date("Y"); ?> Sethuraman Panchanathan
				</div>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
