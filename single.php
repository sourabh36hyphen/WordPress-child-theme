<?php get_header();?>

<main id="main" class="site-main">
<div class="ati-section">
<div class="ati-wrap">

<?php
$layout  =get_theme_mod('ati_single_layout','sidebar-right');
$no_side =($layout==='no-sidebar');
$left_bar=($layout==='sidebar-left');
?>
<div class="<?php echo $no_side?'':'ati-grid-main';?>" <?php echo $left_bar?'style="direction:rtl"':'';?>>

<article <?php echo(!$no_side&&$left_bar)?'style="direction:ltr"':'';?>>
<?php while(have_posts()):the_post();$cats=get_the_category();?>

  <!-- H1 FIRST — Always -->
  <h1 class="ati-post-title"><?php the_title();?></h1>

  <!-- AUTHOR BYLINE — inline, compact -->
  <div class="ati-post-byline">
    <span class="ati-post-byline-avatar">
      <?php
      $custom_img = get_theme_mod('ati_author_image','');
      if ($custom_img) {
        echo '<img src="'.esc_url($custom_img).'" alt="'.esc_attr(get_the_author()).'" class="ati-byline-avatar-img" width="36" height="36">';
      } else {
        echo get_avatar(get_the_author_meta('ID'), 36, '', '', ['class'=>'ati-byline-avatar-img']);
      }
      ?>
    </span>
    <div class="ati-post-byline-info">
      <span class="ati-post-byline-name"><?php the_author();?></span>
      <span class="ati-post-byline-sep">·</span>
      <span class="ati-post-byline-date"><?php echo esc_html(get_the_date());?></span>
      <?php if($cats):?>
      <span class="ati-post-byline-sep">·</span>
      <a href="<?php echo esc_url(get_category_link($cats[0]->term_id));?>" class="ati-post-byline-cat"><?php echo esc_html($cats[0]->name);?></a>
      <?php endif;?>
    </div>
  </div>

  <!-- FEATURED IMAGE — clean, no caption overlays -->
  <?php if(has_post_thumbnail()):?>
  <div class="ati-post-thumb">
    <?php the_post_thumbnail('ati-hero',['loading'=>'eager','decoding'=>'async','fetchpriority'=>'high']);?>
  </div>
  <?php endif;?>

  <!-- CONTENT -->
  <div class="ati-post-content"><?php the_content();?><?php wp_link_pages();?></div>

  <!-- BOTTOM AD -->
  <?php if(is_active_sidebar('ati-ad-article-bot')):?>
  <div class="ati-ad"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner ati-ad-article"><?php dynamic_sidebar('ati-ad-article-bot');?></div></div>
  <?php endif;?>

  <!-- TAGS — Proper flex wrap, one line then wraps neatly -->
  <?php $tags=get_the_tags(); if($tags):?>
  <div class="ati-post-tags">
    <span class="ati-post-tags-label">Tags</span>
    <?php foreach($tags as $tag):?>
      <a href="<?php echo esc_url(get_tag_link($tag->term_id));?>" class="ati-tag"><?php echo esc_html($tag->name);?></a>
    <?php endforeach;?>
  </div>
  <?php endif;?>

  <!-- SHARE BUTTONS — Each on separate pill, no overflow -->
  <?php if(get_theme_mod('ati_show_share',true)):
    $pu=urlencode(get_permalink());
    $pt=urlencode(get_the_title());
  ?>
  <div class="ati-share">
    <span class="ati-share-label">Share</span>
    <div class="ati-share-btns">

      <a href="https://twitter.com/intent/tweet?url=<?php echo $pu;?>&text=<?php echo $pt;?>"
         target="_blank" rel="noopener noreferrer" class="ati-share-btn ati-share-twitter">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        <span>X (Twitter)</span>
      </a>

      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $pu;?>"
         target="_blank" rel="noopener noreferrer" class="ati-share-btn ati-share-facebook">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
        <span>Facebook</span>
      </a>

      <a href="https://api.whatsapp.com/send?text=<?php echo $pt.'%20'.$pu;?>"
         target="_blank" rel="noopener noreferrer" class="ati-share-btn ati-share-whatsapp">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        <span>WhatsApp</span>
      </a>

      <a href="https://t.me/share/url?url=<?php echo $pu;?>&text=<?php echo $pt;?>"
         target="_blank" rel="noopener noreferrer" class="ati-share-btn ati-share-telegram">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
        <span>Telegram</span>
      </a>

      <button type="button" class="ati-share-btn ati-share-copy" data-url="<?php echo esc_attr(get_permalink());?>">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        <span>Copy Link</span>
      </button>

    </div>
  </div>
  <?php endif;?>

  <!-- AUTHOR BOX — Circle image, name, role, bio, themed color -->
  <?php if(get_theme_mod('ati_show_author_box',true)):?>
  <div class="ati-author-box">
    <div class="ati-author-box-avatar">
      <?php
      $custom_img=get_theme_mod('ati_author_image','');
      if ($custom_img) {
        echo '<img src="'.esc_url($custom_img).'" alt="'.esc_attr(get_the_author()).'" class="ati-author-box-img" width="72" height="72">';
      } else {
        echo get_avatar(get_the_author_meta('ID'),72,'','',['class'=>'ati-author-box-img']);
      }
      ?>
    </div>
    <div class="ati-author-box-info">
      <span class="ati-author-box-name"><?php the_author();?></span>
      <span class="ati-author-box-role"><?php echo esc_html(get_theme_mod('ati_author_role','AI Income Specialist'));?></span>
      <p class="ati-author-box-bio">
        <?php echo esc_html(get_the_author_meta('description')?:get_theme_mod('ati_author_bio','Passionate about helping people earn money with AI tools. Testing, reviewing, and writing about the best AI income strategies since 2022.'));?>
      </p>
    </div>
  </div>
  <?php endif;?>

  <!-- RELATED ARTICLES — NO big arrow after, NO prev/next nav -->
  <?php ati_related_posts(3);?>

  <!-- COMMENTS -->
  <?php if(comments_open()||get_comments_number()):?>
  <div class="ati-comments-wrap"><?php comments_template();?></div>
  <?php endif;?>

<?php endwhile;?>
</article>

<!-- SIDEBAR -->
<?php if(!$no_side):?>
<aside class="ati-sidebar" <?php echo $left_bar?'style="direction:ltr"':'';?>>

  <?php if(is_active_sidebar('ati-ad-sidebar-top')):?>
  <div class="ati-widget"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner ati-ad-sidebar"><?php dynamic_sidebar('ati-ad-sidebar-top');?></div></div>
  <?php endif;?>

  <div class="ati-widget">
    <h3 class="ati-widget-title">Trending Posts</h3>
    <?php $t=new WP_Query(['posts_per_page'=>5,'orderby'=>'comment_count','no_found_rows'=>true,'ignore_sticky_posts'=>true]);
    while($t->have_posts()):$t->the_post();?>
    <div class="ati-trend-item">
      <div class="ati-trend-img"><?php if(has_post_thumbnail()) the_post_thumbnail('thumbnail',['loading'=>'lazy']);?></div>
      <div class="ati-trend-content"><div class="ati-trend-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div></div>
    </div>
    <?php endwhile;wp_reset_postdata();?>
  </div>

  <div class="ati-widget">
    <h3 class="ati-widget-title">Categories</h3>
    <?php foreach(get_categories(['orderby'=>'count','order'=>'DESC','number'=>7,'hide_empty'=>true]) as $cat):?>
    <div class="ati-cat-list-item">
      <a href="<?php echo esc_url(get_category_link($cat->term_id));?>" class="ati-cat-list-link"><?php echo esc_html($cat->name);?></a>
      <span class="ati-cat-cnt"><?php echo esc_html($cat->count);?></span>
    </div>
    <?php endforeach;?>
  </div>

  <?php dynamic_sidebar('ati-sidebar-primary');?>

  <?php if(is_active_sidebar('ati-ad-sidebar-sticky')):?>
  <div class="ati-widget" style="position:sticky;top:68px;"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner" style="min-height:600px;width:100%;"><?php dynamic_sidebar('ati-ad-sidebar-sticky');?></div></div>
  <?php endif;?>

</aside>
<?php endif;?>

</div>
</div></div>
</main>
<?php get_footer();?>
