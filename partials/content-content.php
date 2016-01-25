<?php
/**
 * Created by PhpStorm.
 * User: aaronblakeley
 * Date: 5/25/15
 * Time: 11:12 PM
 */
?>

<div class="row" id="theContent">

	<div class="small-10 column small-centered">

		<?php

		if(have_posts()){
			while(have_posts()){
				the_post();
				the_content();
			}
		}

		?>
	</div>

</div>