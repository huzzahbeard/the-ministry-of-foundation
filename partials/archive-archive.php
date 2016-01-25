<div class="row" id="theContent">

	<div class="small-10 medium-6 column small-centered medium-uncentered">
		<h2>Archives by Month:</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</div>

	<div class="small-10 medium-6 column small-centered medium-uncentered">
		<h2>Archives by Subject:</h2>
		<ul>
			<?php wp_list_categories(); ?>
		</ul>
	</div>

</div>
