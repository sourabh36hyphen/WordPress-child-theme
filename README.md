# AI Tool Income — GeneratePress Child Theme v1.0.0

## Installation

1. Install & activate **GeneratePress** (free) from WordPress.org
2. Upload this folder to `wp-content/themes/ai-tool-income/`
3. Go to **Appearance → Themes** and activate **AI Tool Income**
4. Go to **Appearance → Customize → 🤖 AI Tool Income Theme** to configure everything

---

## Customizer Options

| Section | What You Can Change |
|---|---|
| ⚙️ General | Top bar, dark mode toggle, back to top, copyright |
| 🎨 Colors | Primary, secondary, accent, dark/footer colors |
| 🔤 Typography | Heading font, body font, base font size |
| 🏠 Homepage | Hero badge, title, subtitle, buttons, stats, newsletter |
| 📝 Posts & Layout | Single post layout, TOC, related posts, reading time, share |
| 📱 Social Media | YouTube, Telegram, Twitter, Facebook, Instagram, WhatsApp, LinkedIn |
| 💰 AdSense / Ads | Publisher ID, auto-inject article ads, ad position |
| 🔻 Footer | About text, footer column titles |
| 🔍 SEO & Schema | Article schema, website schema, niche text |

---

## Ad Widget Areas (Add AdSense code here)

| Widget Area | Location |
|---|---|
| Ad — Top Banner (728×90) | Top of every page |
| Ad — After Hero | Below hero on homepage |
| Ad — In Article (Top) | Auto-injected inside posts |
| Ad — In Article (Bottom) | Near end of post |
| Ad — Sidebar Top (300×250) | Top of sidebar |
| Ad — Sidebar Sticky | Sticky sidebar ad |
| Ad — Before Posts Grid | Above homepage posts |
| Ad — After Posts Grid | Below homepage posts |

> **AdSense Tip:** Just paste your AdSense ad unit code inside the widget area as a "Custom HTML" widget. No plugin needed.

---

## Create the "AI Tool Earning" Category

1. Go to **Posts → Categories**
2. Create category with:
   - **Name:** AI Tool Earning
   - **Slug:** ai-tool-earning
3. Assign posts to this category

---

## Menus

Assign menus at **Appearance → Menus**:
- **Primary Navigation** → Main header nav
- **Footer Column 1/2/3** → Footer link columns
- **Top Bar Menu** → Small links in top bar

---

## Performance Tips for 90+ PageSpeed

- Use **WebP images** (WordPress 5.8+ auto converts)
- Install **LiteSpeed Cache** or **WP Rocket**
- Enable **lazy loading** (built-in)
- Use **Cloudflare CDN** (free)
- Optimize images with **Smush** or **ShortPixel**
- The theme removes: emoji scripts, oEmbed, RSD link, generator tag

---

## Page Speed Optimizations Built-In

✅ Minimal CSS (single file)  
✅ Minimal JS (vanilla, no jQuery)  
✅ Google Fonts with `display=swap`  
✅ Font preconnect headers  
✅ Native lazy loading on all images  
✅ No render-blocking scripts  
✅ Removed all WordPress bloat  
✅ Intersection Observer animations  
✅ CSS variables for theming (no inline bloat)  
✅ Schema markup for SEO  

---

## File Structure

```
ai-tool-income/
├── style.css          ← Theme declaration + all CSS
├── functions.php      ← Theme setup, customizer, helpers
├── front-page.php     ← Homepage template
├── header.php         ← Site header
├── footer.php         ← Site footer
├── single.php         ← Single post
├── archive.php        ← Category/archive pages
├── index.php          ← Fallback index
├── sidebar.php        ← Sidebar
├── page.php           ← Static pages
├── search.php         ← Search results
├── 404.php            ← 404 page
├── assets/
│   └── js/
│       └── main.js    ← All JavaScript
└── README.md
```

---

## Support & Customization

Built by a professional theme developer for the AI Tool Income niche.  
Theme is fully documented and commented for easy customization.
