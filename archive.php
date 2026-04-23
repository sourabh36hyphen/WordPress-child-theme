<?php get_header(); ?>

<main id="main" class="site-main">
<div class="ati-section">
<div class="ati-wrap">

<?php if (is_category() || is_archive()) : ?>
<div class="ati-cat-hdr" style="margin-bottom:28px;">
  <div class="ati-cat-title">
    <div class="ati-cat-icon" aria-hidden="true"></div>
    <?php the_archive_title(); ?>
  </div>
</div>
<?php if (category_description()) : ?>
<p style="color:var(--c-text-3);margin-bottom:28px;"><?php echo category_description(); ?></p>
<?php endif; ?>
<?php endif; ?>

<div class="ati-grid-main">

  <!-- POSTS -->
  <div>
    <?php if (have_posts()) : ?>
    <div class="ati-grid-3">
      <?php while (have_posts()) : the_post(); $cats = get_the_category(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('ati-card ati-reveal'); ?>>
        <div class="ati-card-img">
          <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
            <?php ati_thumbnail('ati-card'); ?>
          </a>
          <?php if ($cats) : ?>
          <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="ati-badge ati-badge-cat" style="position:absolute;top:10px;left:10px;">
            <?php echo esc_html($cats[0]->name); ?>
          </a>
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
            <div class="ati-card-auth">
              <?php echo get_avatar(get_the_author_meta('ID'),26); ?>
              <span class="ati-card-auth-name"><?php the_author(); ?></span>
            </div>
            <a href="<?php the_permalink(); ?>" class="ati-btn ati-btn-ghost ati-btn-sm">Read →</a>
          </div>
        </div>
      </article>
      <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <div class="ati-pagination">
      <?php
      $big = 999999999;
      $links = paginate_links(['base'=>str_replace($big,'%#%',esc_url(get_pagenum_link($big))),'format'=>'?paged=%#%','current'=>max(1,get_query_var('paged')),'total'=>$GLOBALS['wp_query']->max_num_pages,'type'=>'array','prev_text'=>'← Prev','next_text'=>'Next →']);
      if ($links) foreach ($links as $link) echo '<span class="ati-pg-btn">'.$link.'</span>';
      ?>
    </div>

    <?php else : ?>
    <div class="ati-widget" style="text-align:center;padding:48px 24px;">
      <div style="font-size:3rem;margin-bottom:14px;"></div>
      <h2 style="font-size:1.3rem;margin-bottom:8px;">No Posts Found</h2>
      <p style="color:var(--c-text-3);">Nothing found. Try searching below.</p>
      <?php get_search_form(); ?>
    </div>
    <?php endif; ?>
  </div>

  <!-- SIDEBAR -->
  <?php get_sidebar(); ?>

</div>

</div></div>
</main>

<?php get_footer(); ?>
