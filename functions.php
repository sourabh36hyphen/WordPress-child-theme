<?php
/**
 * AI Tool Income — Functions v4.0.0
 * GeneratePress Child Theme
 */
defined('ABSPATH') || exit;

require_once get_stylesheet_directory() . '/inc/seo.php';

/* ─── SETUP ─────────────────────────────────────────────────────────── */
function ati_setup() {
    load_child_theme_textdomain('ai-tool-income', get_stylesheet_directory().'/languages');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo',['height'=>80,'width'=>280,'flex-height'=>true,'flex-width'=>true]);
    add_theme_support('automatic-feed-links');
    add_theme_support('html5',['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_image_size('ati-card',    800, 450, true);
    add_image_size('ati-card-sm', 400, 225, true);
    add_image_size('ati-hero',   1280, 680, true);
    register_nav_menus([
        'primary'  => 'Primary Navigation',
        'footer-1' => 'Footer Column 1',
        'footer-2' => 'Footer Column 2',
        'footer-3' => 'Footer Column 3',
    ]);
}
add_action('after_setup_theme', 'ati_setup');

/* ─── ENQUEUE ───────────────────────────────────────────────────────── */
function ati_enqueue() {
    $pv = wp_get_theme('generatepress')->get('Version') ?: '3.0';
    wp_enqueue_style('gp-parent',  get_template_directory_uri().'/style.css', [], $pv);
    wp_enqueue_style('ati-fonts',  'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800;900&display=swap', [], null);
    wp_enqueue_style('ati-child',  get_stylesheet_uri(), ['gp-parent'], '4.0.0');
    wp_enqueue_script('ati-main',  get_stylesheet_directory_uri().'/assets/js/main.js', [], '4.0.0', true);
    wp_localize_script('ati-main', 'ATI', ['ajaxurl'=>admin_url('admin-ajax.php'),'nonce'=>wp_create_nonce('ati_nonce')]);
    if (is_singular() && comments_open()) wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'ati_enqueue');

add_filter('wp_resource_hints', function($u,$r){
    if ($r==='preconnect') {
        $u[]=['href'=>'https://fonts.googleapis.com'];
        $u[]=['href'=>'https://fonts.gstatic.com','crossorigin'=>'anonymous'];
    }
    return $u;
}, 10, 2);

add_action('wp_head', function(){
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}, 1);

/* ─── WIDGETS ───────────────────────────────────────────────────────── */
function ati_widgets() {
    $w = ['before_widget'=>'<div id="%1$s" class="ati-widget %2$s">','after_widget'=>'</div>','before_title'=>'<h3 class="ati-widget-title">','after_title'=>'</h3>'];
    register_sidebar($w+['name'=>'Primary Sidebar',              'id'=>'ati-sidebar-primary']);
    register_sidebar($w+['name'=>'Ad — Top Banner',              'id'=>'ati-ad-top']);
    register_sidebar($w+['name'=>'Ad — After Hero',              'id'=>'ati-ad-hero']);
    register_sidebar($w+['name'=>'Ad — In Article Top',          'id'=>'ati-ad-article-top']);
    register_sidebar($w+['name'=>'Ad — In Article Bottom',       'id'=>'ati-ad-article-bot']);
    register_sidebar($w+['name'=>'Ad — Sidebar Top (300x250)',   'id'=>'ati-ad-sidebar-top']);
    register_sidebar($w+['name'=>'Ad — Sidebar Sticky (300x600)','id'=>'ati-ad-sidebar-sticky']);
    register_sidebar($w+['name'=>'Ad — Before Posts Grid',       'id'=>'ati-ad-before-posts']);
    register_sidebar($w+['name'=>'Ad — After Posts Grid',        'id'=>'ati-ad-after-posts']);
    register_sidebar($w+['name'=>'Footer Widgets',               'id'=>'ati-footer-widgets']);
}
add_action('widgets_init', 'ati_widgets');

/* ─── CUSTOMIZER ────────────────────────────────────────────────────── */
function ati_customizer($c) {
    $c->add_panel('ati_panel',['title'=>'AI Tool Income Theme','priority'=>28]);

    /* ── GENERAL ── */
    $c->add_section('ati_general',['title'=>'General Settings','panel'=>'ati_panel']);
    ati_chk($c,'ati_dark_toggle',    'ati_general','Show Dark Mode Toggle',      true);
    ati_chk($c,'ati_back_top',       'ati_general','Show Back to Top Button',    true);
    ati_chk($c,'ati_show_search',    'ati_general','Show Search Button',         true);
    ati_chk($c,'ati_show_breadcrumbs','ati_general','Show Breadcrumbs',          true);
    ati_txt($c,'ati_copyright',      'ati_general','Footer Copyright Text',      '&copy; {year} AI Tool Income. All Rights Reserved.');
    ati_txt($c,'ati_site_niche',     'ati_general','Site Tagline (under logo)',  'Earn with AI Tools');

    /* ── LOGO ── */
    $c->add_section('ati_logo_sec',['title'=>'Logo & Branding','panel'=>'ati_panel','priority'=>5]);
    // Custom logo image upload
    $c->add_setting('ati_logo_image',['default'=>'','sanitize_callback'=>'esc_url_raw']);
    $c->add_control(new WP_Customize_Image_Control($c,'ati_logo_image',['label'=>'Logo Image (replaces text logo)','description'=>'Upload your logo. Recommended height: 40-50px. Transparent PNG preferred.','section'=>'ati_logo_sec']));
    ati_txt($c,'ati_logo_name_text', 'ati_logo_sec','Logo Name Text (if no image)','AI Tool Income');
    ati_txt($c,'ati_logo_highlight', 'ati_logo_sec','Logo Name Highlighted Word', 'Tool');
    ati_chk($c,'ati_logo_show_tagline','ati_logo_sec','Show Tagline Under Logo',  true);
    // Footer logo
    $c->add_setting('ati_footer_logo_image',['default'=>'','sanitize_callback'=>'esc_url_raw']);
    $c->add_control(new WP_Customize_Image_Control($c,'ati_footer_logo_image',['label'=>'Footer Logo Image (optional)','section'=>'ati_logo_sec']));

    /* ── COLORS ── */
    $c->add_section('ati_colors',['title'=>'Colors','panel'=>'ati_panel']);
    foreach([
        'ati_color_primary' =>['#2563EB','Primary Color (buttons, links, accents)'],
        'ati_color_dark'    =>['#0F172A','Dark Color (stats BG, dark elements)'],
    ] as $id=>[$def,$label]) {
        $c->add_setting($id,['default'=>$def,'sanitize_callback'=>'sanitize_hex_color','transport'=>'postMessage']);
        $c->add_control(new WP_Customize_Color_Control($c,$id,['label'=>$label,'section'=>'ati_colors']));
    }

    /* ── TYPOGRAPHY ── */
    $c->add_section('ati_typo',['title'=>'Typography','panel'=>'ati_panel']);
    ati_txt($c,'ati_font_heading','ati_typo','Heading Font (Google Font name)','Plus Jakarta Sans');
    ati_txt($c,'ati_font_body',  'ati_typo','Body Font (Google Font name)',   'Inter');
    $c->add_setting('ati_font_size',['default'=>'16','sanitize_callback'=>'absint']);
    $c->add_control('ati_font_size',['label'=>'Base Font Size (px)','section'=>'ati_typo','type'=>'number','input_attrs'=>['min'=>13,'max'=>22]]);

    /* ── HOMEPAGE ── */
    $c->add_section('ati_home',['title'=>'Homepage','panel'=>'ati_panel']);
    ati_txt($c,'ati_hero_badge',    'ati_home','Hero Badge Text',              'Trusted AI Income Resource');
    ati_txt($c,'ati_hero_title',    'ati_home','Hero Headline',                'Earn Real Money with AI Tools in 2025');
    ati_txt($c,'ati_hero_highlight','ati_home','Hero Headline Highlighted Word','AI Tools');
    ati_tex($c,'ati_hero_sub',      'ati_home','Hero Subheadline',             'Discover proven methods to generate income using AI tools — detailed reviews, step-by-step guides, affiliate strategies, and freelancing opportunities.');
    ati_txt($c,'ati_hero_btn1_text','ati_home','Button 1 Text',                'Get Started');
    ati_url($c,'ati_hero_btn1_url', 'ati_home','Button 1 URL',                 '#');
    ati_txt($c,'ati_hero_btn2_text','ati_home','Button 2 Text',                'Browse Guides');
    ati_url($c,'ati_hero_btn2_url', 'ati_home','Button 2 URL',                 '#');
    for($i=1;$i<=3;$i++){
        $nd=[1=>['500+','AI Tools Reviewed'],2=>['$5K+','Monthly Earned'],3=>['50K+','Monthly Readers']];
        ati_txt($c,"ati_hero_stat_{$i}_n",'ati_home',"Hero Stat $i Number",$nd[$i][0]);
        ati_txt($c,"ati_hero_stat_{$i}_l",'ati_home',"Hero Stat $i Label", $nd[$i][1]);
    }
    ati_txt($c,'ati_home_cat_title', 'ati_home','Category Section Heading',    'AI Tool Earning');
    $c->add_setting('ati_posts_per_page',['default'=>6,'sanitize_callback'=>'absint']);
    $c->add_control('ati_posts_per_page',['label'=>'Posts Per Page','section'=>'ati_home','type'=>'number','input_attrs'=>['min'=>3,'max'=>12]]);
    ati_chk($c,'ati_card_show_date',    'ati_home','Show Date on Post Cards',       true);
    ati_chk($c,'ati_show_stats',        'ati_home','Show Statistics Section',       true);
    for($i=1;$i<=4;$i++){
        $nd=[1=>['500+','AI Tools Reviewed'],2=>['50K+','Monthly Readers'],3=>['$12K+','Earned This Month'],4=>['99%','Satisfaction Rate']];
        ati_txt($c,"ati_stat_{$i}_num",'ati_home',"Stat $i Number",$nd[$i][0]);
        ati_txt($c,"ati_stat_{$i}_lbl",'ati_home',"Stat $i Label", $nd[$i][1]);
    }
    ati_chk($c,'ati_show_nl',        'ati_home','Show Newsletter Section',  true);
    ati_txt($c,'ati_nl_eyebrow',     'ati_home','Newsletter Eyebrow Text',  'Weekly Newsletter');
    ati_txt($c,'ati_nl_title',       'ati_home','Newsletter Title',         'Get Weekly AI Earning Tips');
    ati_tex($c,'ati_nl_desc',        'ati_home','Newsletter Description',   'Join 10,000+ readers getting exclusive AI tool tips, income strategies, and early access to reviews every week.');

    /* ── POSTS & ARTICLE ── */
    $c->add_section('ati_posts',['title'=>'Posts & Article','panel'=>'ati_panel']);
    $c->add_setting('ati_single_layout',['default'=>'sidebar-right','sanitize_callback'=>'sanitize_text_field']);
    $c->add_control('ati_single_layout',['label'=>'Single Post Layout','section'=>'ati_posts','type'=>'radio','choices'=>['sidebar-right'=>'Right Sidebar','no-sidebar'=>'Full Width','sidebar-left'=>'Left Sidebar']]);
    ati_chk($c,'ati_show_toc',         'ati_posts','Show ',           true);
    ati_chk($c,'ati_show_related',     'ati_posts','Show Related Articles',            true);
    ati_chk($c,'ati_show_author_box',  'ati_posts','Show Author Box (end of article)', true);
    ati_chk($c,'ati_show_share',       'ati_posts','Show Share Buttons',               true);
    // Author settings in posts section
    ati_txt($c,'ati_author_role',      'ati_posts','Default Author Role Label',        'AI Income Specialist');
    ati_tex($c,'ati_author_bio',       'ati_posts','Default Author Bio (fallback)',     'Passionate about helping people earn money with AI tools. Testing, reviewing, and writing about the best AI income strategies since 2022.');
    // Author image upload
    $c->add_setting('ati_author_image',['default'=>'','sanitize_callback'=>'esc_url_raw']);
    $c->add_control(new WP_Customize_Image_Control($c,'ati_author_image',['label'=>'Default Author Image (fallback if no Gravatar)','description'=>'Upload a square image. Used when author has no Gravatar.','section'=>'ati_posts']));

    /* ── SOCIAL MEDIA ── */
    $c->add_section('ati_social',['title'=>'Social Media Links','panel'=>'ati_panel']);
    foreach(['youtube'=>'YouTube','telegram'=>'Telegram','twitter'=>'Twitter / X','facebook'=>'Facebook','instagram'=>'Instagram','whatsapp'=>'WhatsApp','pinterest'=>'Pinterest','linkedin'=>'LinkedIn'] as $k=>$l)
        ati_url($c,"ati_social_$k",'ati_social',$l.' URL','');

    /* ── ADSENSE ── */
    $c->add_section('ati_ads',['title'=>'AdSense / Ads','panel'=>'ati_panel']);
    ati_txt($c,'ati_adsense_id',           'ati_ads','Publisher ID (pub-xxxxx)','');
    ati_chk($c,'ati_auto_ads',             'ati_ads','Enable Auto Ads',         false);
    ati_chk($c,'ati_inject_article_ad',    'ati_ads','Auto-inject In-Article Ad',true);
    $c->add_setting('ati_article_ad_para',['default'=>'after_first','sanitize_callback'=>'sanitize_text_field']);
    $c->add_control('ati_article_ad_para',['label'=>'Insert Article Ad After','section'=>'ati_ads','type'=>'select','choices'=>['after_first'=>'1st Paragraph','after_second'=>'2nd Paragraph','after_third'=>'3rd Paragraph']]);

    /* ── FOOTER ── */
    $c->add_section('ati_footer',['title'=>'Footer','panel'=>'ati_panel']);
    ati_tex($c,'ati_footer_about', 'ati_footer','Footer About Text',         'Comprehensive resource for earning money with AI tools. Honest reviews, step-by-step guides, and proven income strategies.');
    // Column titles
    ati_txt($c,'ati_footer_col_1_title','ati_footer','Column 1 Title','Quick Links');
    ati_txt($c,'ati_footer_col_2_title','ati_footer','Column 2 Title','AI Categories');
    ati_txt($c,'ati_footer_col_3_title','ati_footer','Column 3 Title','Legal');
    // Footer text color
    $c->add_setting('ati_footer_link_color',['default'=>'#64748B','sanitize_callback'=>'sanitize_hex_color']);
    $c->add_control(new WP_Customize_Color_Control($c,'ati_footer_link_color',['label'=>'Footer Link Text Color','section'=>'ati_footer']));
    $c->add_setting('ati_footer_link_hover_color',['default'=>'#2563EB','sanitize_callback'=>'sanitize_hex_color']);
    $c->add_control(new WP_Customize_Color_Control($c,'ati_footer_link_hover_color',['label'=>'Footer Link Hover Color','section'=>'ati_footer']));
    $c->add_setting('ati_footer_bg_color',['default'=>'#ffffff','sanitize_callback'=>'sanitize_hex_color']);
    $c->add_control(new WP_Customize_Color_Control($c,'ati_footer_bg_color',['label'=>'Footer Background Color','section'=>'ati_footer']));
    // Footer column links (5 per column)
    for($col=1;$col<=3;$col++){
        for($row=1;$row<=5;$row++){
            ati_txt($c,"ati_footer_{$col}_{$row}_text",'ati_footer',"Col $col Link $row Text",'');
            ati_url($c,"ati_footer_{$col}_{$row}_url", 'ati_footer',"Col $col Link $row URL",'#');
        }
    }

    /* ── SEO ── */
    $c->add_section('ati_seo',['title'=>'SEO & Schema','panel'=>'ati_panel']);
    ati_chk($c,'ati_schema_article',  'ati_seo','Article Schema Markup',    true);
    ati_chk($c,'ati_schema_website',  'ati_seo','Website Schema Markup',    true);
    ati_txt($c,'ati_gsc_verify',      'ati_seo','Google Search Console Verification Code','');
    ati_txt($c,'ati_ga4_id',          'ati_seo','Google Analytics 4 ID (G-XXXXXX)','');

    /* ── SEO ADVANCED ── */
    $c->add_section('ati_seo_advanced',['title'=>'SEO Advanced','panel'=>'ati_panel','priority'=>55]);
    ati_tex($c,'ati_meta_home_desc','ati_seo_advanced','Homepage Meta Description','Learn how to earn money with AI tools. Discover the best AI tools for income, step-by-step guides, affiliate programs and freelancing opportunities. Start earning today!');
    ati_txt($c,'ati_twitter_handle','ati_seo_advanced','Twitter/X Handle (without @)','');
}
add_action('customize_register', 'ati_customizer');

/* Customizer helpers */
function ati_chk($c,$id,$sec,$l,$d){$c->add_setting($id,['default'=>$d,'sanitize_callback'=>'wp_validate_boolean']);$c->add_control($id,['label'=>$l,'section'=>$sec,'type'=>'checkbox']);}
function ati_txt($c,$id,$sec,$l,$d){$c->add_setting($id,['default'=>$d,'sanitize_callback'=>'sanitize_text_field']);$c->add_control($id,['label'=>$l,'section'=>$sec,'type'=>'text']);}
function ati_tex($c,$id,$sec,$l,$d){$c->add_setting($id,['default'=>$d,'sanitize_callback'=>'sanitize_textarea_field']);$c->add_control($id,['label'=>$l,'section'=>$sec,'type'=>'textarea']);}
function ati_url($c,$id,$sec,$l,$d){$c->add_setting($id,['default'=>$d,'sanitize_callback'=>'esc_url_raw']);$c->add_control($id,['label'=>$l,'section'=>$sec,'type'=>'url']);}

/* Dynamic CSS — customizer values applied */
function ati_dynamic_css() {
    $blue    = sanitize_hex_color(get_theme_mod('ati_color_primary','#2563EB'));
    $navy    = sanitize_hex_color(get_theme_mod('ati_color_dark',   '#0F172A'));
    $fs      = absint(get_theme_mod('ati_font_size', 16));
    $fh      = sanitize_text_field(get_theme_mod('ati_font_heading','Plus Jakarta Sans'));
    $fb      = sanitize_text_field(get_theme_mod('ati_font_body',   'Inter'));
    $flc     = sanitize_hex_color(get_theme_mod('ati_footer_link_color','#64748B'));
    $flhc    = sanitize_hex_color(get_theme_mod('ati_footer_link_hover_color','#2563EB'));
    $fbg     = sanitize_hex_color(get_theme_mod('ati_footer_bg_color','#ffffff'));

    printf('<style id="ati-vars">:root{--blue:%s;--blue-dk:%s;--navy:%s;--f:"%s",system-ui,sans-serif;--fh:"%s","Inter",sans-serif;}html{font-size:%dpx;}.ati-footer{background:%s!important;}.ati-footer-links li a,.ati-footer-links a,.ati-footer-desc{color:%s!important;}.ati-footer-links li a:hover,.ati-footer-links a:hover{color:%s!important;}</style>',
        esc_attr($blue), esc_attr(ati_darken_hex($blue,15)), esc_attr($navy),
        esc_attr($fb), esc_attr($fh), $fs,
        esc_attr($fbg), esc_attr($flc), esc_attr($flhc)
    );
}
add_action('wp_head', 'ati_dynamic_css');

function ati_darken_hex($hex, $pct) {
    $hex = ltrim($hex,'#');
    if (strlen($hex)===3) $hex=$hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    $r=max(0,hexdec(substr($hex,0,2))-round(255*$pct/100));
    $g=max(0,hexdec(substr($hex,2,2))-round(255*$pct/100));
    $b=max(0,hexdec(substr($hex,4,2))-round(255*$pct/100));
    return '#'.sprintf('%02x%02x%02x',$r,$g,$b);
}

/* AdSense */
function ati_adsense() {
    $id = sanitize_text_field(get_theme_mod('ati_adsense_id',''));
    if (!$id || !get_theme_mod('ati_auto_ads',false)) return;
    printf('<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=%s" crossorigin="anonymous"></script>', esc_attr($id));
}
add_action('wp_head', 'ati_adsense');

/* Tracking */
function ati_tracking() {
    $gsc = sanitize_text_field(get_theme_mod('ati_gsc_verify',''));
    if ($gsc) printf('<meta name="google-site-verification" content="%s">'."\n", esc_attr($gsc));
    $ga4 = sanitize_text_field(get_theme_mod('ati_ga4_id',''));
    if ($ga4) {
        printf('<script async src="https://www.googletagmanager.com/gtag/js?id=%s"></script>'."\n", esc_attr($ga4));
        printf('<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag("js",new Date());gtag("config","%s",{"anonymize_ip":true});</script>'."\n", esc_js($ga4));
    }
}
add_action('wp_head', 'ati_tracking');

/* Schema handled in inc/seo.php */

/* ─── HELPERS ───────────────────────────────────────────────────────── */
function ati_reading_time($id=null) {
    if (!get_theme_mod('ati_show_reading_time',false)) return '';
    $wc = str_word_count(strip_tags(get_the_content(null,false,$id)));
    return max(1,ceil($wc/200)).' min read';
}

function ati_excerpt($len=20,$post=null) {
    $t = get_the_excerpt($post);
    if (!$t) $t = wp_strip_all_tags(strip_shortcodes(get_the_content(null,false,$post)));
    return wp_trim_words($t,$len,'...');
}

function ati_thumbnail($size='ati-card',$class='') {
    if (has_post_thumbnail()) {
        the_post_thumbnail($size,['class'=>esc_attr($class),'loading'=>'lazy','decoding'=>'async']);
    } else {
        $colors=['ati-nt-1','ati-nt-2','ati-nt-3','ati-nt-4','ati-nt-5','ati-nt-6'];
        echo '<div class="ati-no-thumb '.esc_attr($colors[get_the_ID()%6]).'"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" style="width:32px;height:32px;stroke:#94A3B8"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>';
    }
}

function ati_breadcrumbs() {
    if (!get_theme_mod('ati_show_breadcrumbs',true)||is_front_page()) return;
    $sep='<span class="ati-breadcrumb-sep">›</span>';
    echo '<nav class="ati-breadcrumb" aria-label="Breadcrumb">';
    echo '<a href="'.esc_url(home_url('/')).'">Home</a>'.$sep;
    if (is_single()) {
        $cats=get_the_category();
        if ($cats) echo '<a href="'.esc_url(get_category_link($cats[0]->term_id)).'">'.esc_html($cats[0]->name).'</a>'.$sep;
        echo '<span class="ati-breadcrumb-cur">'.esc_html(get_the_title()).'</span>';
    } elseif (is_category()) {
        echo '<span class="ati-breadcrumb-cur">'.esc_html(single_cat_title('',false)).'</span>';
    } elseif (is_page()) {
        echo '<span class="ati-breadcrumb-cur">'.esc_html(get_the_title()).'</span>';
    } elseif (is_search()) {
        echo '<span class="ati-breadcrumb-cur">Search: '.esc_html(get_search_query()).'</span>';
    } elseif (is_archive()) {
        echo '<span class="ati-breadcrumb-cur">'.esc_html(get_the_archive_title()).'</span>';
    }
    echo '</nav>';
}

/* Related posts — clean, no avatars */
function ati_related_posts($num=3) {
    if (!get_theme_mod('ati_show_related',true)) return;
    $cats=wp_get_post_categories(get_the_ID());
    if (!$cats) return;
    $q=new WP_Query(['post_type'=>'post','post_status'=>'publish','posts_per_page'=>$num,'category__in'=>$cats,'post__not_in'=>[get_the_ID()],'no_found_rows'=>true,'ignore_sticky_posts'=>true]);
    if (!$q->have_posts()) return;
    echo '<section class="ati-related"><span class="ati-related-title">Related Articles</span><div class="ati-grid-3">';
    while($q->have_posts()){$q->the_post();$c=get_the_category();
        echo '<article class="ati-card">';
        echo '<div class="ati-card-img"><a href="'.get_permalink().'" tabindex="-1" aria-hidden="true">';
        ati_thumbnail('ati-card-sm');
        echo '</a>';
        if($c) echo '<a href="'.esc_url(get_category_link($c[0]->term_id)).'" class="">'.esc_html($c[0]->name).'</a>';
        echo '</div><div class="ati-card-body">';
        echo '<span class="ati-card-date-line">'.esc_html(get_the_date()).'</span>';
        echo '<h4 class="ati-card-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
        echo '</div></article>';
    }
    wp_reset_postdata();
    echo '</div></section>';
}

/* Nav fallback */
function ati_nav_fallback() {
    echo '<ul class="ati-nav-menu"><li><a href="'.esc_url(home_url('/')).'">Home</a></li><li><a href="#">AI Tool Earning</a></li><li><a href="#">Reviews</a></li><li><a href="#">Guides</a></li></ul>';
}

/* Collapsible TOC */
function ati_toc($content) {
    if (!get_theme_mod('ati_show_toc',true)||!is_single()) return $content;
    preg_match_all('/<h([23])[^>]*>(.*?)<\/h[23]>/is',$content,$m);
    if (count($m[0])<3) return $content;
    $toc='<div class="ati-toc" data-open="false" role="navigation" aria-label="Table of Contents">';
    $toc.='<button class="ati-toc-toggle" type="button" aria-expanded="false">';
    $toc.='<span class="ati-toc-toggle-label">Table of Contents</span>';
    $toc.='<span class="ati-toc-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></span>';
    $toc.='</button><div class="ati-toc-body"><ol>';
    foreach($m[0] as $i=>$h){
        $text=wp_strip_all_tags($m[2][$i]);
        $slug='ati-h'.($i+1).'-'.sanitize_title($text);
        $content=str_replace($h,'<h'.$m[1][$i].' id="'.esc_attr($slug).'">'.$m[2][$i].'</h'.$m[1][$i].'>',$content);
        $toc.='<li><a href="#'.esc_attr($slug).'">'.esc_html($text).'</a></li>';
    }
    $toc.='</ol></div></div>';
    return preg_replace('/(<\/p>)/i','$1'.$toc,$content,1);
}
add_filter('the_content','ati_toc');

/* In-article ad injection */
function ati_inject_ad($content) {
    if (!is_single()||!get_theme_mod('ati_inject_article_ad',true)||!is_active_sidebar('ati-ad-article-top')) return $content;
    $pos=get_theme_mod('ati_article_ad_para','after_first');
    $nth=$pos==='after_first'?1:($pos==='after_second'?2:3);
    ob_start();
    echo '<div class="ati-ad"><span class="ati-ad-label">Advertisement</span><div class="ati-ad-inner ati-ad-article">';
    dynamic_sidebar('ati-ad-article-top');
    echo '</div></div>';
    $ad=ob_get_clean();
    $split=explode('</p>',$content);
    if (count($split)>$nth){$split[$nth-1].='</p>'.$ad;$content=implode('</p>',$split);}
    return $content;
}
add_filter('the_content','ati_inject_ad');

/* Remove updated badge from content */
function ati_remove_updated_badge($content) {
    $content=preg_replace('/<div[^>]*class="[^"]*ati-updated[^"]*"[^>]*>.*?<\/div>/s','',$content);
    return $content;
}
add_filter('the_content','ati_remove_updated_badge',1);

/* Hide read time from content */
add_filter('the_content', fn($c)=>preg_replace('/<div[^>]*class="[^"]*ati-(read|reading)[^"]*"[^>]*>.*?<\/div>/s','',$c), 1);

/* Lazy load */
add_filter('the_content',fn($c)=>str_replace('<img ','<img loading="lazy" decoding="async" ',$c));

/* Body class */
add_filter('body_class',function($c){
    if(is_singular()) $c[]='ati-layout-'.sanitize_html_class(get_theme_mod('ati_single_layout','sidebar-right'));
    return $c;
});

/* Excerpt */
add_filter('excerpt_length',fn()=>22);
add_filter('excerpt_more',fn()=>'...');

/* Newsletter AJAX */
function ati_subscribe() {
    check_ajax_referer('ati_nonce','nonce');
    $email=sanitize_email($_POST['email']??'');
    if (!is_email($email)) wp_send_json_error(['msg'=>'Invalid email address.']);
    $subs=get_option('ati_subscribers',[]);
    if (!in_array($email,$subs,true)){$subs[]=$email;update_option('ati_subscribers',$subs);}
    wp_send_json_success(['msg'=>'Successfully subscribed!']);
}
add_action('wp_ajax_ati_subscribe','ati_subscribe');
add_action('wp_ajax_nopriv_ati_subscribe','ati_subscribe');

/* Admin bar shortcut */
add_action('admin_bar_menu',function($bar){
    if (!current_user_can('manage_options')) return;
    $bar->add_node(['id'=>'ati-customize','title'=>'Theme Settings','href'=>admin_url('customize.php?autofocus[panel]=ati_panel'),'meta'=>['target'=>'_blank']]);
},100);

/* Performance */
remove_action('wp_head','print_emoji_detection_script',7);
remove_action('wp_print_styles','print_emoji_styles');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
remove_action('wp_head','rsd_link');
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','wp_generator');
remove_filter('the_content_feed','wp_staticize_emoji');
remove_filter('comment_text_rss','wp_staticize_emoji');
add_filter('wp_revisions_to_keep',fn()=>5);
add_filter('xmlrpc_enabled','__return_false');
