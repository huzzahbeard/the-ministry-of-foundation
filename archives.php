<?php
/*
Template Name: Archives
*/
get_header();
?>
<section id="main-wrap" class="inner-wrap">
		<?php
		get_template_part("partials/page", "header");
		get_template_part("partials/all", "nav");
		get_template_part("partials/archive", "archive");
		get_template_part("partials/all", "foot");
		?>
</section>
<?php get_footer(); ?>