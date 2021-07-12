<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->buildTemplate( $atts, $content );
$containerClass = trim( 'gt-call-out ' . esc_attr( implode( ' ', $this->getTemplateVariable( 'container-class' ) ) ) );
$columnLeftClasses = esc_attr( implode( ' ', $this->getTemplateVariable( 'column-left-class' ) ) );
$columnRightClasses = esc_attr( implode( ' ', $this->getTemplateVariable( 'column-right-class' ) ) );
?>
<div class="<?php echo esc_attr( $containerClass ); ?>">
	<div class="gt-t-row">

		<?php if ( !empty($columnLeftClasses) ): ?><div class="<?php echo esc_attr($columnLeftClasses)  ?>"><?php endif; ?>

			<?php echo $this->getTemplateVariable( 'heading' ); ?>
			<?php echo $this->getTemplateVariable( 'subheading' ); ?>

		<?php if ( !empty($columnLeftClasses) ): ?></div><?php endif; ?>

		<div class="<?php echo esc_attr($columnRightClasses)  ?>">

			<?php echo $this->getTemplateVariable( 'gt-actions-form' ); ?>
			<?php echo $this->getTemplateVariable( 'gt-actions-button' ); ?>

		</div>

	</div><!--/ .gt-t-row-->
</div><!--/ .gt-call-out-->