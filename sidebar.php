<aside class="ati-sidebar" aria-label="Sidebar">

  <?php if (is_active_sidebar('ati-ad-sidebar-top')) : ?>
  <div class="ati-widget">
    <span class="ati-ad-label">Advertisement</span>
    <div class="ati-ad-inner ati-ad-sidebar"><?php dynamic_sidebar('ati-ad-sidebar-top'); ?></div>
  </div>
  <?php endif; ?>

  <div class="ati-widget">
    <h3 class="ati-widget-title">Trending Posts</h3>
    <?php
    $t = new WP_Query(['posts_per_page'=>5,'orderby'=>'comment_count','no_found_rows'=>true,'ignore_sticky_posts'=>true]);
    while ($t->have_posts()) : $t->the_post(); ?>
    <div class="ati-trend-item">
      <div class="ati-trend-img">
        <?php if (has_post_thumbnail()) : the_post_thumbnail('thumbnail',['loading'=>'lazy']); endif; ?>
      </div>
      <div class="ati-trend-content">
        <div class="ati-trend-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
        <div class="ati-trend-date"><?php echo get_the_date(); ?></div>
      </div>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>

  <div class="ati-widget">
    <h3 class="ati-widget-title">Categories</h3>
    <?php foreach (get_categories(['orderby'=>'count','order'=>'DESC','number'=>7,'hide_empty'=>true]) as $cat) : ?>
    <div class="ati-cat-list-item">
      <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="ati-cat-list-link"><?php echo esc_html($cat->name); ?></a>
      <span class="ati-cat-cnt"><?php echo esc_html($cat->count); ?></span>
    </div>
    <?php endforeach; ?>
  </div>

  <?php dynamic_sidebar('ati-sidebar-primary'); ?>

</aside>
