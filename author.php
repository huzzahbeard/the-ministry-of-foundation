<?php get_header();?>
	<section id="main-wrap" class="inner-wrap">
		<?php
		get_template_part("partials/searchCat", "header");
		get_template_part("partials/all", "nav");
		get_template_part("partials/main", "loop");
		get_template_part("partials/all", "pagination");
		get_template_part("partials/all", "foot");
		?>
	</section>
<?php get_footer();?>