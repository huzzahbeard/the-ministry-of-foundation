<?php
/**
 * Created by PhpStorm.
 * User: aaronblakeley
 * Date: 5/25/15
 * Time: 10:54 PM
 */
	OffCclose()
	?>
	<header id="main-header" class="niblit-large-header-post">
		<a href="/" id="main-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php wp_title(); ?>"/></a>
				<?php
				if(have_posts()){
					while(have_posts()){
						the_post();
					$niblit = get_post_meta( get_the_ID(), "niblit", true);
					$source = get_post_meta( get_the_ID(), "niblit-source", true);
					$niblitstyle = get_post_meta(get_the_ID(), "styles", true );
				?>
				<div class="header-color-style <?php echo $niblitstyle; ?>">
					<a class="right-off-canvas-toggle right" id="menu-link" href="#" >Menu</a>

					<div class="niblit-header-content row">
						<div class="column small-centered small-9">
							<div class="display-table niblit-header-content-wrap">
								<div class="verticalAlign">
										<h1><?php the_title(); ?></h1>
										<p><?php echo $niblit; ?></p>
								</div>
							</div>
							<div class="author-source"><span class="author"><?php the_author_posts_link(); ?></span> | <span class="source">

								<?php
								if($source == ""){
									$category = get_the_category(get_the_ID());
									echo $category[0]->name;
								}else{
									echo $source;
								}

								?>

							</span></div>
						</div>
					</div>

				</div>

				<div class="header-dark <?php echo $niblitstyle; ?>">
					<div class="row">
						<div class="niblit-categories small-6 column"><i class="fa fa-bookmark"></i><?php echo get_the_category_list(", "); ?></div>
						<div class="niblit-action-icons small-6 column text-right">
							<a href="<?php the_permalink(); ?>#disqus_thread"<i class="fa fa-comments"></i></a>
							<!--i class="fa fa-eye"></i--></div>
					</div>
				</div>
		<?php
		}
		}
		?>
	</header>