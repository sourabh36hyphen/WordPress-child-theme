<?php get_header(); ?>
<main id="main" class="site-main">
<div class="ati-section"><div class="ati-wrap">
<?php while(have_posts()):the_post(); ?>
<div style="max-width:800px;margin:0 auto;">
  <h1 class="ati-post-title" style="margin-bottom:20px;"><?php the_title(); ?></h1>
  <div class="ati-post-content"><?php the_content(); ?></div>
</div>
<?php endwhile; ?>
</div></div>
</main>
<?php get_footer(); ?>
