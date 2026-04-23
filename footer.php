<footer id="colophon" class="ati-footer" role="contentinfo">

  <div class="ati-footer-top">
    <div class="ati-wrap">
      <div class="ati-footer-grid">

        <!-- BRAND COLUMN -->
        <div>
          <?php
          $footer_logo = get_theme_mod('ati_footer_logo_image','');
          $logo_img    = get_theme_mod('ati_logo_image','');
          $display_logo= $footer_logo ?: $logo_img;
          ?>
          <div class="ati-footer-logo">
            <?php if ($display_logo) : ?>
              <img src="<?php echo esc_url($display_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="ati-footer-logo-img" height="36" width="auto">
            <?php else : ?>
              <div class="ati-footer-logo-mark" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
                </svg>
              </div>
              <span class="ati-footer-logo-name"><?php echo esc_html(get_theme_mod('ati_logo_name_text','AI Tool Income')); ?></span>
            <?php endif; ?>
          </div>

          <p class="ati-footer-desc"><?php echo esc_html(get_theme_mod('ati_footer_about','Comprehensive resource for earning money with AI tools. Honest reviews, step-by-step guides, and proven income strategies.')); ?></p>

          <!-- SOCIAL ICONS -->
          <div class="ati-footer-social" aria-label="Social Media">
            <?php
            $socials=[
              'youtube'  =>['YouTube',  '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.54C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z" fill="currentColor" stroke="none"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" style="fill:#fff;stroke:none"/>'],
              'twitter'  =>['X/Twitter','<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" fill="currentColor" stroke="none"/>'],
              'facebook' =>['Facebook', '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>'],
              'instagram'=>['Instagram','<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>'],
              'telegram' =>['Telegram', '<path d="m22 2-7 20-4-9-9-4 20-7z"/><path d="M22 2 11 13"/>'],
              'linkedin' =>['LinkedIn', '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>'],
            ];
            foreach($socials as $k=>[$label,$icon]) {
              $url=get_theme_mod("ati_social_$k",'');
              if (!$url) continue;
              printf('<a href="%s" target="_blank" rel="noopener noreferrer" class="ati-soc-btn" aria-label="%s"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%s</svg></a>',
                esc_url($url), esc_attr($label), $icon);
            }
            ?>
          </div>
        </div>

        <!-- LINK COLUMNS — From customizer (editable links) -->
        <?php for ($col=1;$col<=3;$col++) :
          $col_title = get_theme_mod("ati_footer_col_{$col}_title",['Quick Links','AI Categories','Legal'][$col-1]);
        ?>
        <div>
          <span class="ati-footer-col-title"><?php echo esc_html($col_title); ?></span>
          <ul class="ati-footer-links">
            <?php if (has_nav_menu("footer-{$col}")) :
              wp_nav_menu(['theme_location'=>"footer-{$col}",'container'=>false,'items_wrap'=>'%3$s','depth'=>1,'fallback_cb'=>false]);
            else :
              /* Show customizer-defined links if set, else show defaults */
              $defaults_1=[['Home',home_url('/')],['About','#'],['AI Tool Reviews','#'],['Income Guides','#'],['Contact',home_url('/contact')]];
              $defaults_2=[['AI Writing Tools','#'],['AI Image Tools','#'],['AI Video Tools','#'],['AI Music Tools','#'],['Affiliate Programs','#']];
              $defaults_3=[['Privacy Policy',home_url('/privacy-policy')],['Terms of Service',home_url('/terms')],['Disclaimer',home_url('/disclaimer')],['Contact',home_url('/contact')],['Sitemap',home_url('/sitemap.xml')]];
              $defaults=[$defaults_1,$defaults_2,$defaults_3][$col-1];
              $has_custom=false;
              for($row=1;$row<=5;$row++){
                if(get_theme_mod("ati_footer_{$col}_{$row}_text",'')) {$has_custom=true;break;}
              }
              if ($has_custom) {
                for($row=1;$row<=5;$row++){
                  $txt=get_theme_mod("ati_footer_{$col}_{$row}_text",'');
                  $url=get_theme_mod("ati_footer_{$col}_{$row}_url",'#');
                  if ($txt) echo '<li><a href="'.esc_url($url).'">'.esc_html($txt).'</a></li>';
                }
              } else {
                foreach($defaults as [$txt,$url]) echo '<li><a href="'.esc_url($url).'">'.esc_html($txt).'</a></li>';
              }
            endif; ?>
          </ul>
        </div>
        <?php endfor; ?>

      </div><!-- .ati-footer-grid -->
    </div><!-- .ati-wrap -->
  </div><!-- .ati-footer-top -->

  <!-- BOTTOM — Copyright only, centered on ALL devices -->
  <div class="ati-footer-bottom">
    <div class="ati-wrap">
      <p class="ati-footer-copy">
        <?php echo wp_kses_post(str_replace('{year}',date('Y'),get_theme_mod('ati_copyright','&copy; {year} AI Tool Income. All Rights Reserved.'))); ?>
      </p>
    </div>
  </div>

</footer>

<?php if (get_theme_mod('ati_back_top',true)) : ?>
<button id="ati-back-top" type="button" aria-label="Back to top">
  <svg viewBox="0 0 24 24" width="15" height="15"><polyline points="18 15 12 9 6 15"/></svg>
</button>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
