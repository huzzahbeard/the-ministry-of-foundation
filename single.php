<?php
/**
 * Created by PhpStorm.
 * User: aaronblakeley
 * Date: 5/9/15
 * Time: 11:24 PM
 */
?>
<?php get_header();?>
	<section id="main-wrap" class="inner-wrap">
		<?php
		get_template_part("partials/post", "header");
		get_template_part("partials/all", "nav");
		get_template_part("partials/content", "content");
		get_template_part("partials/comments", "comments");
		get_template_part("partials/all", "foot");
		?>
	</section>

<?php get_footer();?>