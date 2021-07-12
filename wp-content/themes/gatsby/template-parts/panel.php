<!-- - - - - - - - - - - - - Navigation Panel - - - - - - - - - - - - - - -->

<div id="nav-panel" class="nav-panel">
	<?php
		$menu = gatsby_mobile_menu();
		if ( $menu ) {
			echo '<nav class="mobile-menu-wrap">'. $menu .'</nav>';
		}
	?>
</div><!--/ .nav-panel-->

<!-- - - - - - - - - - - - / Navigation Panel - - - - - - - - - - - - - -->