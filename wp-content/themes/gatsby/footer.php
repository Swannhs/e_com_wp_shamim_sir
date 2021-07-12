<?php
global $gatsby_config;
$sidebar_position = $gatsby_config['sidebar_position'];
?>

		<?php if ( $sidebar_position != 'gt-no-sidebar' ): ?>

			</main><!--/ #main-->

			<?php get_sidebar(); ?>

				</div><!--/ .row-->

				<?php do_action( 'gatsby_after_main_content' ) ?>

			</div><!--/ .container-->

		<?php else: ?>

					</div><!--/ .col-sm-12-->
				</div><!--/ .row-->
			</div><!--/ .container-->

		<?php endif; ?>

	</div><!--/ .gt-page-content-wrap -->

	<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

	<?php $coming_soon = absint( mad_meta( 'gatsby_coming_soon' )  ); ?>

	<?php if ( !$coming_soon ): ?>

	<div class="gt-footer-holder">

		<footer id="footer" class="gt-footer <?php echo esc_attr($gatsby_config['footer_classes']) ?>">

			<?php
			/**
			 * gatsby_footer_in_top_part hook
			 *
			 */

			do_action('gatsby_footer_in_top_part');
			?>

		</footer><!--/ #footer-->

		<!-- - - - - - - - - - - - - -/ Footer - - - - - - - - - - - - - - - - -->

	</div><!--/ .gt-footer-holder-->

	<?php endif; ?>

</div><!--/ .gt-wide-layout-type-->

<?php get_template_part( 'template-parts/panel' ); ?>

<?php wp_footer(); ?>

</body>
</html>