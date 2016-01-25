<?php
/**
 * Created by PhpStorm.
 * User: aaronblakeley
 * Date: 5/25/15
 * Time: 11:44 PM
 */?>

<div class="row" id="comments">
	<div class="small-10 column small-centered">
		<?php
			comment_form();
		?>
	</div>
	<div class="small-10 column small-centered">
		<div class="row">
			<?php
				$post = $wp_query->post;

				$argGetComments = array(
					'post_id' => $post->ID
				);
				$comments = get_comments($argGetComments);
				foreach($comments as $comment){
				if($comment->comment_parent == 0) {
					$commentDepth = "small-12";
				}else{
					$commentDepth = "small-10 right";
				}
			?>
			<div class="<?php echo $commentDepth; ?> column comment">
				<div class="comment-body">
					<?php echo $comment->comment_content; ?>
				</div>
				<div class="comment-meta">
					<div class="comment-reply">
						<?php
							$argComments = array("depth"=>2);
							echo comment_reply_link( $argComments, $comment->comment_ID, $comment->comment_post_ID );
						?>
					</div>
					<div class="comment-author-and-date">
						<?php echo  $comment->comment_author; ?> | <?php echo $comment->comment_date; ?>
					</div>
				</div>
			</div>
			<?php  }  ?>
		</div>
	</div>
</div>