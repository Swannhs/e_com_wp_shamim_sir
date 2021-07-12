<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review-meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

	<header class="gt-comment-meta">
		<p class="meta"><em><?php esc_attr_e( 'Your comment is awaiting approval', 'gatsby' ); ?></em></p>
	</header>

<?php } else { ?>

	<header class="gt-comment-meta">
		<h6 itemprop="author" class="gt-comment-author"><?php comment_author(); ?></h6>
		<?php
		if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
			echo '<em class="verified">(' . esc_attr__( 'verified owner', 'gatsby' ) . ')</em> ';
		}
		?>
		<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>" class="gt-comment-date"><?php esc_html_e('on', 'gatsby') ?> <?php echo get_comment_date( wc_date_format() ); ?> <?php esc_html_e('at', 'gatsby') ?> <?php echo get_comment_date( 'h:s' ); ?></time>

	</header>

<?php }
