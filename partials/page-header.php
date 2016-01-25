<?php
/**
 * Created by PhpStorm.
 * User: aaronblakeley
 * Date: 5/26/15
 * Time: 12:01 AM
 */
OffCclose();
?>
<header id="main-header" class="niblit-large-header-post">
	<a href="/" id="main-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php wp_title(); ?>"/></a>
			<div class="header-color-style">
				<a class="right-off-canvas-toggle right" id="menu-link" href="#" >Menu</a>
				<div class="niblit-header-content row">
					<div class="column small-centered small-9">
						<div class="display-table niblit-header-content-wrap">
							<div class="verticalAlign">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="header-dark">
				<div class="row">
				</div>
			</div>
</header>