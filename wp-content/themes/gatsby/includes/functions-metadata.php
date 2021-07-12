<?php
require_once( get_template_directory() . '/includes/metadata/meta_values.php' );
require_once( get_template_directory() . '/includes/metadata/functions-types.php' );
require_once( get_template_directory() . '/includes/metadata/product.php' );

if ( !function_exists('gatsby_get_term_from_query_var') ) {

	function gatsby_get_term_from_query_var() {

		static $term = null;

		if ( isset($term) ) return $term;

		$qterm = get_query_var( 'term', null );
		$qtaxonomy = get_query_var( 'taxonomy', null );

		if ( $qterm && $qtaxonomy ) {
			$term = get_term_by('slug', $qterm, $qtaxonomy);
		} else {
			$term = false;
		}

		return $term;
	}

}

if ( !function_exists('gatsby_get_meta_value') ) {

	function gatsby_get_meta_value($meta_key) {

		$value = '';

		if ( gatsby_is_product_category() ) {

			$term = gatsby_get_term_from_query_var();

			if ( $term ) {
				$value = get_metadata($term->taxonomy, $term->term_id, $meta_key, true);
			}
		}

		return $value;
	}

}
