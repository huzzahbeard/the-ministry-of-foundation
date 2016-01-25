<?php
/**
 * Created by PhpStorm.
 * User: aaronblakeley
 * Date: 5/14/15
 * Time: 10:44 PM
 */
?>

<aside class="right-off-canvas-menu" id="main-navigation">
	<!-- whatever you want goes here -->
	<div class="row">
		<?php dynamic_sidebar('Above Nav')?>
	</div>
	<nav>
		<?php wp_nav_menu( array( 'theme_location' => 'main_navigation' ) ); ?>
	</nav>
	<div class="row">
		<?php dynamic_sidebar('Bellow Nav')?>
	</div>

</aside>