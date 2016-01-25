<div class="row">
  <div class="small-10 small-centered medium-10 large-10 columns pageContentHolder" >
    <header class="row titleContentWrap">
      <div class="symbolWrap"><i class="fa fa-archive"></i></div>
      <hr />
      <h1><?php the_title(); ?></h1>
    </header>
    <section class="row">
      <section class="columns small-12 medium-6">
        <ul>
          <?php 
            $args = array(
              'orderby'            => 'name',
              'order'              => 'ASC',
              'style'              => 'list',
              'show_count'         => 1,
              'hide_empty'         => 1,
              'title_li'           =>""
            );
            wp_list_categories($args);
          ?>
          </ul>
      </section>
      <section class="columns small-12 medium-6">
        <ul>
        <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </section>
    </section>
  </div>
</div>