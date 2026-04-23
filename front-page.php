<?php get_header(); ?>

<section class="ati-hero">
<div class="ati-wrap">
<div class="ati-hero-grid">
  <div>
    <div class="ati-hero-kicker"><span class="ati-hero-kicker-dot"></span><?php echo esc_html(get_theme_mod('ati_hero_badge','Trusted AI Income Resource')); ?></div>
    <?php
    $title=get_theme_mod('ati_hero_title','Earn Real Money with AI Tools in 2025');
    $hi   =get_theme_mod('ati_hero_highlight','AI Tools');
    $out  =($hi&&str_contains($title,$hi))?str_replace($hi,'<span>'.esc_html($hi).'</span>',esc_html($title)):esc_html($title);
    ?>
    <h1 class="ati-hero-h1"><?php echo wp_kses_post($out); ?></h1>
    <p class="ati-hero-sub"><?php echo esc_html(get_theme_mod('ati_hero_sub','Discover proven methods to generate income using AI tools — detailed reviews, step-by-step guides, affiliate strategies, and freelancing opportunities.')); ?></p>
    <div class="ati-hero-btns">
      <a href="<?php echo esc_url(get_theme_mod('ati_hero_btn1_url','#')); ?>" class="ati-btn ati-btn-pri ati-btn-lg"><?php echo esc_html(get_theme_mod('ati_hero_btn1_text','Get Started')); ?></a>
      <a href="<?php echo esc_url(get_theme_mod('ati_hero_btn2_url','#')); ?>" class="ati-btn ati-btn-sec ati-btn-lg"><?php echo esc_html(get_theme_mod('ati_hero_btn2_text','Browse Guides')); ?></a>
    </div>
    <div class="ati-hero-stats">
      <?php for($i=1;$i<=3;$i++):
        $n=get_theme_mod("ati_hero_stat_{$i}_n",['500+','$5K+','50K+'][$i-1]);
        $l=get_theme_mod("ati_hero_stat_{$i}_l",['AI Tools Reviewed','Monthly Earned','Monthly Readers'][$i-1]);
      ?>
        <?php if($i>1) echo '<div class="ati-hero-stat-sep"></div>'; ?>
        <div><div class="ati-hero-stat-n"><?php echo esc_html($n); ?></div><div class="ati-hero-stat-l"><?php echo esc_html($l); ?></div></div>
      <?php endfor; ?>
    </div>
  </div>
  <div class="ati-hero-visual" aria-hidden="true">
    <div class="ati-hero-card">
      <div class="ati-hero-card-hdr"><span class="ati-hero-card-ttl">Top Earning AI Tools</span><span class="ati-live-dot">Live</span></div>
      <?php foreach([['ChatGPT','Content Writing','+$800/mo'],['Midjourney','AI Art & Design','+$600/mo'],['Synthesia','AI Video Creation','+$1,200/mo'],['Jasper AI','Copywriting','+$500/mo'],['ElevenLabs','AI Voice & Audio','+$400/mo']] as $t): ?>
      <div class="ati-earn-item">
        <div class="ati-earn-left">
          <div class="ati-earn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="var(--blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="12" height="12"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
          <div><div class="ati-earn-name"><?php echo esc_html($t[0]); ?></div><div class="ati-earn-cat"><?php echo esc_html($t[1]); ?></div></div>
        </div>
        <div class="ati-earn-amt"><?php echo esc_html($t[2]); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
</div>
</section>

<?php if(is_active_sidebar('ati-ad-hero')):?><div class="ati-ad"><div class="ati-wrap" style="text-align:center;"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner ati-ad-728"><?php dynamic_sidebar('ati-ad-hero');?></div></div></div><?php endif;?>

<div class="ati-cats-bar">
  <div class="ati-cats-bar-inner">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="ati-cat-pill active">All Posts</a>
    <?php foreach(get_categories(['orderby'=>'count','order'=>'DESC','number'=>10,'hide_empty'=>true]) as $cat): ?>
    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="ati-cat-pill"><?php echo esc_html($cat->name); ?></a>
    <?php endforeach; ?>
  </div>
</div>

<main id="main" class="site-main">
<div class="ati-section">
<div class="ati-wrap">

<?php if(is_active_sidebar('ati-ad-before-posts')):?><div class="ati-ad" style="margin-top:0;"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner ati-ad-728"><?php dynamic_sidebar('ati-ad-before-posts');?></div></div><?php endif;?>

<div class="ati-grid-main">

  <!-- POSTS -->
  <div>
    <div class="ati-cat-hdr">
      <div class="ati-cat-title"><?php echo esc_html(get_theme_mod('ati_home_cat_title','AI Tool Earning')); ?></div>
      <?php $ai=get_category_by_slug('ai-tool-earning'); if($ai): ?><a href="<?php echo esc_url(get_category_link($ai->term_id)); ?>" class="ati-view-all">View All</a><?php endif; ?>
    </div>
    <?php
    $q=new WP_Query(['post_type'=>'post','post_status'=>'publish','posts_per_page'=>intval(get_theme_mod('ati_posts_per_page',6)),'category_name'=>'ai-tool-earning','no_found_rows'=>true,'ignore_sticky_posts'=>true]);
    if(!$q->have_posts()) $q=new WP_Query(['post_type'=>'post','post_status'=>'publish','posts_per_page'=>intval(get_theme_mod('ati_posts_per_page',6)),'no_found_rows'=>true]);
    ?>
    <div class="ati-grid-3">
    <?php while($q->have_posts()):$q->the_post();$cats=get_the_category();?>
    <article id="post-<?php the_ID();?>" <?php post_class('ati-card ati-reveal');?>>
      <div class="ati-card-img">
        <a href="<?php the_permalink();?>" tabindex="-1" aria-hidden="true"><?php ati_thumbnail('ati-card');?></a>
        <?php if($cats): ?><a href="<?php echo esc_url(get_category_link($cats[0]->term_id));?>" class=""><?php echo esc_html($cats[0]->name);?></a><?php endif;?>
      </div>
      <div class="ati-card-body">
        <?php if(get_theme_mod('ati_card_show_date',true)):?><span class="ati-card-date-line"><?php echo esc_html(get_the_date());?></span><?php endif;?>
        <h2 class="ati-card-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
        <p class="ati-card-exc"><?php echo esc_html(ati_excerpt(18));?></p>
        <div class="ati-card-foot">
          <span class="ati-card-auth-name"><?php the_author();?></span>
          <a href="<?php the_permalink();?>" class="ati-card-read-link">
            Read
            <svg viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></svg>
          </a>
        </div>
      </div>
    </article>
    <?php endwhile;wp_reset_postdata();?>
    </div>
    <?php if(is_active_sidebar('ati-ad-after-posts')):?><div class="ati-ad" style="margin-bottom:0;"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner ati-ad-728"><?php dynamic_sidebar('ati-ad-after-posts');?></div></div><?php endif;?>
  </div>

  <!-- SIDEBAR -->
  <aside class="ati-sidebar">
    <?php if(is_active_sidebar('ati-ad-sidebar-top')):?><div class="ati-widget"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner ati-ad-sidebar"><?php dynamic_sidebar('ati-ad-sidebar-top');?></div></div><?php endif;?>
    <div class="ati-widget">
      <h3 class="ati-widget-title">Trending Posts</h3>
      <?php $t=new WP_Query(['posts_per_page'=>5,'orderby'=>'comment_count','no_found_rows'=>true,'ignore_sticky_posts'=>true]);
      while($t->have_posts()):$t->the_post();?>
      <div class="ati-trend-item">
        <div class="ati-trend-img"><?php if(has_post_thumbnail()) the_post_thumbnail('thumbnail',['loading'=>'lazy','decoding'=>'async']);?></div>
        <div class="ati-trend-content">
          <div class="ati-trend-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
        </div>
      </div>
      <?php endwhile;wp_reset_postdata();?>
    </div>
    <div class="ati-widget">
      <h3 class="ati-widget-title">Categories</h3>
      <?php foreach(get_categories(['orderby'=>'count','order'=>'DESC','number'=>8,'hide_empty'=>true]) as $cat):?>
      <div class="ati-cat-list-item">
        <a href="<?php echo esc_url(get_category_link($cat->term_id));?>" class="ati-cat-list-link"><?php echo esc_html($cat->name);?></a>
        <span class="ati-cat-cnt"><?php echo esc_html($cat->count);?></span>
      </div>
      <?php endforeach;?>
    </div>
    <?php dynamic_sidebar('ati-sidebar-primary');?>
  </aside>

</div>
</div></div>
</main>

<?php if(get_theme_mod('ati_show_stats',true)):?>
<section class="ati-stats-sec">
<div class="ati-wrap"><div class="ati-stats-grid">
  <?php for($i=1;$i<=4;$i++):
    $n=get_theme_mod("ati_stat_{$i}_num",['500+','50K+','$12K+','99%'][$i-1]);
    $l=get_theme_mod("ati_stat_{$i}_lbl",['AI Tools Reviewed','Monthly Readers','Earned This Month','Satisfaction Rate'][$i-1]);
  ?>
  <div class="ati-stat-item ati-reveal">
    <div class="ati-stat-num" data-target="<?php echo absint(preg_replace('/[^0-9]/','', $n));?>" data-suffix="<?php echo esc_attr(preg_replace('/[0-9]/','', $n));?>"><?php echo esc_html($n);?></div>
    <div class="ati-stat-lbl"><?php echo esc_html($l);?></div>
  </div>
  <?php endfor;?>
</div></div>
</section>
<?php endif;?>

<?php if(get_theme_mod('ati_show_nl',true)):?>
<section class="ati-nl-section">
<div class="ati-wrap">
  <div class="ati-nl-wrap ati-reveal">
    <span class="ati-nl-eyebrow"><?php echo esc_html(get_theme_mod('ati_nl_eyebrow','Weekly Newsletter'));?></span>
    <h2 class="ati-nl-title"><?php echo esc_html(get_theme_mod('ati_nl_title','Get Weekly AI Earning Tips'));?></h2>
    <p class="ati-nl-desc"><?php echo esc_html(get_theme_mod('ati_nl_desc','Join 10,000+ readers getting exclusive AI tool tips, income strategies, and early access to reviews every week.'));?></p>
    <form class="ati-nl-form" novalidate>
      <?php wp_nonce_field('ati_nonce','ati_nl_nonce');?>
      <input type="email" class="ati-nl-input" placeholder="Enter your email address" required autocomplete="email" aria-label="Email Address">
      <button type="submit" class="ati-btn ati-btn-pri">Subscribe</button>
    </form>
    <span class="ati-nl-note">No spam. Unsubscribe at any time.</span>
  </div>
</div>
</section>
<?php endif;?>

<?php if(is_active_sidebar('ati-footer-widgets')):?><div class="ati-section-sm"><div class="ati-wrap"><?php dynamic_sidebar('ati-footer-widgets');?></div></div><?php endif;?>

<?php get_footer();?>
