<form class="gt-lineform" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" autocomplete="off" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'gatsby' ) ?>" value="<?php echo get_search_query(); ?>">
	<button class="gt-lineform-btn" type="submit"><span class="lnr lnr-magnifier"></span></button>
</form>