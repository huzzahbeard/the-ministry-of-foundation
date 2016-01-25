<?php
/**
 * Created by PhpStorm.
 * User: aaronblakeley
 * Date: 5/27/15
 * Time: 4:09 PM
 */
?>
<div class="row" id="theLoop">

	<?php

	if(have_posts()){
		while(have_posts()){
			the_post();
			$niblit = get_post_meta( get_the_ID(), "niblit", true);
			$source = get_post_meta( get_the_ID(), "niblit-source", true);
			?>
			<article class=" small-centered small-9 columns post-niblit">
				<a class="niblit-link-wrapper row" href="<?php the_permalink(); ?>">
					<section class="column  small-12">
						<h2><?php the_title(); ?></h2>
						<p><?php
							if($niblit != "") {
								echo $niblit;
							}else {
								the_title();
							}
							?></p>
					</section>
				</a>
				<div class="arthor-source"><span class="author"><?php the_author_posts_link(); ?></span> | <span class="source">

							<?php
							if($source == ""){
								$category = get_the_category(get_the_ID());
								echo $category[0]->name;
							}else{
								echo $source;
							}

							?>

						</span></div>
				<footer class="dark row">
					<div class="niblit-categories small-6 column"><i class="fa fa-bookmark"></i><?php echo get_the_category_list(", "); ?></div>
					<div class="niblit-action-icons small-6 column text-right">

						<a href="<?php the_permalink(); ?>#disqus_thread"<i class="fa fa-comments"></i></a>
						<!--i class="fa fa-eye"></i--></div>
				</footer>
			</article>
		<?php
		}
	}

	?>

</div>