<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main">Skip to content</a>
<div class="ati-progress-bar" id="ati-progress" aria-hidden="true"></div>

<header id="masthead" class="site-header ati-header" role="banner">
  <div class="ati-wrap">
    <div class="ati-hdr-inner">

      <!-- LOGO — Image from customizer or text fallback -->
      <?php
      $logo_img = get_theme_mod('ati_logo_image','');
      $logo_name = get_theme_mod('ati_logo_name_text','AI Tool Income');
      $logo_highlight = get_theme_mod('ati_logo_highlight','Tool');
      $show_tagline = get_theme_mod('ati_logo_show_tagline', true);
      $site_tagline = get_theme_mod('ati_site_niche','Earn with AI Tools');
      ?>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="ati-logo" rel="home">
        <?php if ($logo_img) : ?>
          <img src="<?php echo esc_url($logo_img); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="ati-logo-img" width="auto" height="40">
        <?php else : ?>
          <div class="ati-logo-mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
            </svg>
          </div>
          <div class="ati-logo-text">
            <span class="ati-logo-name">
              <?php
              if ($logo_highlight && str_contains($logo_name, $logo_highlight)) {
                echo str_replace($logo_highlight, '<span>'.esc_html($logo_highlight).'</span>', esc_html($logo_name));
              } else {
                echo esc_html($logo_name);
              }
              ?>
            </span>
            <?php if ($show_tagline && $site_tagline) : ?>
            <span class="ati-logo-tagline"><?php echo esc_html($site_tagline); ?></span>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </a>

      <!-- NAVIGATION -->
      <nav id="site-navigation" class="ati-nav" role="navigation" aria-label="Primary Navigation">
        <?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'menu_class'=>'ati-nav-menu','depth'=>3,'fallback_cb'=>'ati_nav_fallback']); ?>
      </nav>

      <!-- HEADER ACTIONS -->
      <div class="ati-hdr-actions">
        <?php if (get_theme_mod('ati_show_search',true)) : ?>
        <button class="ati-icon-btn ati-open-search" aria-label="Search" aria-expanded="false">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        </button>
        <?php endif; ?>

        <?php if (get_theme_mod('ati_dark_toggle',true)) : ?>
        <button class="ati-icon-btn ati-dark-btn" aria-label="Toggle dark mode">
          <svg id="ati-dark-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </button>
        <?php endif; ?>

        <button class="ati-hamburger" aria-label="Open Menu" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>

    </div>
  </div>
</header>

<!-- SEARCH OVERLAY -->
<?php if (get_theme_mod('ati_show_search',true)) : ?>
<div id="ati-search-ov" class="ati-search-ov" role="dialog" aria-label="Search" aria-hidden="true">
  <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" name="s" placeholder="Search AI tools, guides, income strategies..." value="<?php echo esc_attr(get_search_query()); ?>" autocomplete="off" aria-label="Search">
    <button type="submit" style="display:none">Search</button>
  </form>
  <p class="ati-search-ov-hint">Press Enter to search · Esc to close</p>
  <button class="ati-search-ov-close" aria-label="Close search">
    <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
  </button>
</div>
<?php endif; ?>

<!-- BREADCRUMBS -->
<?php if (!is_front_page()) : ?>
<div class="ati-breadcrumb-bar"><div class="ati-wrap"><?php ati_breadcrumbs(); ?></div></div>
<?php endif; ?>

<!-- TOP AD -->
<?php if (is_active_sidebar('ati-ad-top')) : ?>
<div class="ati-ad"><div class="ati-wrap" style="text-align:center;"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner ati-ad-728"><?php dynamic_sidebar('ati-ad-top'); ?></div></div></div>
<?php endif; ?>
