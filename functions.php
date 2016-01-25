<?php
/**
 * Created by PhpStorm.
 * User: aaronblakeley
 * Date: 5/9/15
 * Time: 11:34 PM
 */


/*
 * Widgets
 */

function widgetGO(){

	$widgetArea['widgetAreaA'] = array(
		'name'          => 'Above Nav',
		'id'            => 'abovenav',
		'before_widget' => '<div class="small-12 column widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	);
	$widgetArea['widgetAreaB'] = array(
		'name'          => 'Bellow Nav',
		'id'            => 'bellownav',
		'before_widget' => '<div class="small-12 column widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	);
	$widgetArea['widgetAreaC'] = array(
		'name'          => 'Foot Left',
		'id'            => 'footleft',
		'before_widget' => '<div class="small-12 column widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	);
	$widgetArea['widgetAreaD'] = array(
		'name'          => 'Foot Middle',
		'id'            => 'footmiddle',
		'before_widget' => '<div class="small-12 column widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	);
	$widgetArea['widgetAreaE'] = array(
		'name'          => 'Foot Right',
		'id'            => 'footright',
		'before_widget' => '<div class="small-12 column widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	);

	foreach($widgetArea as $singleWidgetArea){
		register_sidebar($singleWidgetArea);
	}

}
add_action( 'widgets_init', 'widgetGO' );


/*
 * Widgets
 */

class niblitSearchForm extends WP_Widget {

	function niblitSearchForm() {
		// Instantiate the parent object
		parent::__construct( false, 'Niblit Search From' );
	}
	function widget( $args, $instance ) {
		?>
		<section class="search">
			<form role="search" method="get" id="searchform" class="searchform" action="<?php echo 'http://' . $_SERVER['SERVER_NAME']. '/'; ?>">
				<p>
					<input type="text" id="s" name="s" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="search by keyword">
					<input type="submit" class="searchButton">
				</p>
			</form>
		</section>
	<?php

	}
}

function register_widgets() {
	register_widget( 'niblitSearchForm');
}
add_action( 'widgets_init', 'register_widgets' );

/*
 * The Menus
 */

function registerTheMenus(){
	register_nav_menus( array(
		'main_navigation' => 'Main Navigation Menu'
	) );
}
add_action('init', 'registerTheMenus');


/*
 * Post Meta Class
 */

/**
 * Calls the class on the post edit screen.
 */
function call_niblitContent() {
	new niblitContent();
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'call_niblitContent' );
	add_action( 'load-post-new.php', 'call_niblitContent' );
}

/**
 * The Featured Class.
 */


class niblitContent{

	public function __construct(){
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
		$post_types = array('post');     //limit meta box to certain post types
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'content_niblit'
				,'niblit Content'
				,array( $this, 'render_meta_box_content' )
				,$post_type
				,'advanced'
				,'high'
			);
		}
	}
	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'content_niblit', 'content_niblit_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$featured = get_post_meta( $post->ID, 'featured_content_niblit', true );
		$niblit = get_post_meta( $post->ID, 'niblit', true );
		$source = get_post_meta( $post->ID, 'niblit-source', true );
		$styles = get_post_meta( $post->ID, 'styles', true );

		// Display the form, using the current value.
		echo '<label for="myplugin_new_field"> Is this featured content? </label> ';

		?>
		<select name="is_featured">
			<option value="no"  <?php echo ($featured == "no" ? "selected='selected'" : " "); ?> >Not Featured</option>
			<option value="yes" <?php echo ($featured == "yes" ? "selected='selected'" : " "); ?> >Featured</option>
		</select><br /><br />
		<?php
		echo '<label for="niblit_field"> Write the best phrase from the writing </label> <br/>';
		echo '<input style="width:100%" type="text" name="is_niblit" value="'.$niblit.'" /></br></br>';
		echo '<label for="niblit_field"> The source </label> <br/>';
		echo '<input style="width:100%" type="text" name="is_source" value="'.$source.'" /></br></br>';
		// Use get_post_meta to retrieve an existing value from the database.

		// Display the form, using the current value.
		echo '<label for="styles_field"> Choose a Pre Set Style </label> <br/>';
		?>
		<select name="is_styles">
			<option value="default" <?php echo ($styles == "default" ? "selected='selected'" : " "); ?> >Default</option>
			<option value="niblitOrange"  <?php echo ($styles == "niblitOrange" ? "selected='selected'" :  " "); ?> >Orange</option>
			<option value="niblitGreen" <?php echo ($styles == "niblitGreen" ? "selected='selected'" :  " "); ?> >Green</option>
		</select>
	<?php
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['content_niblit_nonce'] ) ){
			return $post_id;

		}

		$nonce = $_POST['content_niblit_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'content_niblit' ) ){
			return $post_id;

		}

		// If this is an autosave, our form has not been submitted,
		//     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
			return $post_id;

		}

		if ( ! current_user_can( 'edit_post', $post_id ) ){
			return $post_id;
		}

		/* OK, its safe for us to save the data now. */
		$mydataFeatured = $_POST['is_featured'];
		// Sanitize the user input.

		// Update the meta field.
		update_post_meta( $post_id, 'featured_content_niblit', $mydataFeatured );

		/* OK, its safe for us to save the data now. */
		$myNiblit = sanitize_text_field($_POST['is_niblit']);
		$mySource = sanitize_text_field($_POST['is_source']);


		// Update the meta field.
		update_post_meta( $post_id, 'niblit', $myNiblit );
		update_post_meta( $post_id, 'niblit-source', $mySource );

		/* OK, its safe for us to save the data now. */
		$mydata = $_POST['is_styles'];


		// Update the meta field.
		update_post_meta( $post_id, 'styles', $mydata );
	}


}


/*
 * Helper Functions
 */

function offCclose(){
	?>
	<!-- close the off-canvas menu -->
	<a class="exit-off-canvas"></a>
<?php
}

