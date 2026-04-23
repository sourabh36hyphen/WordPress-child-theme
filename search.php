<?php get_header(); ?>
<main id="main" class="site-main">
<div class="ati-section"><div class="ati-wrap">
<div class="ati-grid-main">
<div>
  <h1 class="ati-sec-title" style="margin-bottom:24px;">
    Search Results for: <span>"<?php echo esc_html(get_search_query()); ?>"</span>
  </h1>
  <?php if (have_posts()) : ?>
  <div class="ati-grid-3">
    <?php while(have_posts()):the_post(); $cats=get_the_category(); ?>
    <article <?php post_class('ati-card ati-reveal'); ?>>
      <div class="ati-card-img">
        <a href="<?php the_permalink(); ?>"><?php ati_thumbnail('ati-card'); ?></a>
        <?php if ($cats) : ?>
        <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="ati-badge ati-badge-cat" style="position:absolute;top:10px;left:10px;"><?php echo esc_html($cats[0]->name); ?></a>
        <?php endif; ?>
      </div>
      <div class="ati-card-body">
        <div class="ati-card-meta">
          <span class="ati-card-date"> <?php echo get_the_date(); ?></span>
          <span class="ati-card-date"> <?php echo ati_reading_time(); ?></span>
        </div>
        <h2 class="ati-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="ati-card-exc"><?php echo esc_html(ati_excerpt(18)); ?></p>
        <div class="ati-card-foot">
          <span class="ati-card-auth-name"><?php the_author(); ?></span>
          <a href="<?php the_permalink(); ?>" class="ati-btn ati-btn-ghost ati-btn-sm">Read →</a>
        </div>
      </div>
    </article>
    <?php endwhile; ?>
  </div>
  <?php else : ?>
  <div class="ati-widget" style="text-align:center;padding:48px;">
    <div style="font-size:3rem;margin-bottom:14px;"></div>
    <p style="color:var(--c-text-3);">No results found for "<?php echo esc_html(get_search_query()); ?>". Try a different term.</p>
    <?php get_search_form(); ?>
  </div>
  <?php endif; ?>
</div>
<?php get_sidebar(); ?>
</div>
</div></div>
</main>
<?php get_footer(); ?>
