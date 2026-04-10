# Kayla Canfield — Portfolio Website
**kaylacanfield.com** &nbsp;|&nbsp; Static-first build, WordPress-ready

---

## Project Overview

This is a complete portfolio website for Kayla Canfield, instructional designer, writer, and researcher. The site uses a static-first HTML/CSS/JS build that can be deployed immediately and migrated to WordPress on Hostinger when ready.

**Design aesthetic:** Soft vintage, bookish, mid-century editorial. Palette of parchment cream, sage, dusty blue, terracotta, and antique gold. Custom fonts: Jullina (signature), Meadow Notes (accent), Anas Rusty Typewriter (typewriter details), Playfair Display (headings), Lora (body), Jost (UI).

---

## Repository Structure

```
kc_site/
├── index.html                  # Homepage
├── pages/
│   ├── about.html              # About page
│   ├── work.html               # Portfolio / Work archive
│   ├── writing.html            # Writing archive
│   ├── blog.html               # Blog
│   └── contact.html            # Contact
├── assets/
│   ├── css/
│   │   ├── main.css            # Design tokens, base, components, nav, footer
│   │   ├── home.css            # Homepage-specific styles
│   │   ├── about.css           # About page styles
│   │   ├── work.css            # Work/portfolio styles
│   │   ├── writing.css         # Writing archive styles
│   │   ├── blog.css            # Blog styles
│   │   └── contact.css         # Contact page styles
│   ├── js/
│   │   └── main.js             # All interactive JS
│   ├── fonts/
│   │   └── web/                # Custom font files (TTF/OTF)
│   └── images/
│       └── photos/             # Portrait photos (portrait-hero.jpg, portrait-square.jpg)
└── wordpress-theme/
    └── kayla-canfield/         # Complete WordPress theme (zip this folder to install)
        ├── style.css           # Theme header
        ├── functions.php       # Setup, CPTs, SEO, customizer, AJAX contact
        ├── header.php
        ├── footer.php
        ├── front-page.php
        ├── index.php
        ├── page.php
        ├── single.php
        ├── archive-project.php
        ├── single-project.php
        └── assets/             # (symlink or copy from root assets/)
```

---

## Hard-Coded vs. Editable Content

### Hard-coded in static HTML (update manually or via WordPress template tags):
| Content | Location | How to update in WP |
|---------|---------|---------------------|
| Site name "Kayla Canfield" | All pages, header | Settings > General > Site Title |
| Tagline | All pages, header | Appearance > Customize > Contact Info |
| Email address | Contact page, footer | Appearance > Customize > Contact & Social |
| LinkedIn URL | Footer, contact | Appearance > Customize > Contact & Social |
| CV PDF URL | Header button, footer | Appearance > Customize > Contact & Social |
| Bio text | About page | Edit the About page in WP Admin |
| Project cards | Work page | Work > Add New in WP Admin |
| Writing pieces | Writing page | Writing > Add New in WP Admin |
| Blog posts | Blog page | Posts > Add New in WP Admin |

### Dynamically generated in WordPress:
- All project cards (from `project` custom post type)
- All writing pieces (from `writing` custom post type)
- Blog posts (standard WP posts)
- Navigation menus (Appearance > Menus)
- Footer links (Appearance > Menus > Footer)
- CV/Resume URLs (Appearance > Customize)

---

## WordPress Migration Steps

### 1. Install WordPress on Hostinger
- Log into Hostinger hPanel
- Go to **Websites > Manage > Auto Installer**
- Install WordPress on kaylacanfield.com
- Set admin username and password

### 2. Install the Theme
- In WordPress Admin, go to **Appearance > Themes > Add New > Upload Theme**
- Upload `wordpress-theme/kayla-canfield.zip`
- Click **Activate**

### 3. Configure Menus
- Go to **Appearance > Menus**
- Create a menu called "Primary" with: Home, About, Work, Writing, Blog, Contact
- Assign it to the **Primary Navigation** location
- Create a "Footer" menu and assign it to **Footer Navigation**

### 4. Set Up Pages
Create these pages in **Pages > Add New**:
- Home (set as front page in Settings > Reading)
- About (use page template: About)
- Contact (use page template: Contact)
- Blog (set as posts page in Settings > Reading)

### 5. Configure Customizer
- Go to **Appearance > Customize > Contact & Social**
- Enter your email, LinkedIn URL, CV PDF URL, and Resume PDF URL

### 6. Add Projects
- Go to **Work > Add New**
- Add title, description, featured image, project category, and skills
- Add custom fields: `_kc_context`, `_kc_role`, `_kc_tools`, `_kc_outcome`, `_kc_year`

### 7. Add Writing Pieces
- Go to **Writing > Add New**
- Add title, abstract (as excerpt), full text, writing category, and skills/tags

### 8. Recommended Plugins
| Plugin | Purpose |
|--------|---------|
| Yoast SEO or RankMath | Full SEO, sitemap, schema |
| Contact Form 7 or WPForms Lite | Contact form (replaces static form) |
| Advanced Custom Fields (ACF) | Easier project metadata management |
| Smush or ShortPixel | Image optimization |
| W3 Total Cache | Performance caching |
| UpdraftPlus | Automated backups |

---

## SEO Notes

The static site includes:
- Semantic HTML5 structure with proper heading hierarchy
- Meta description and Open Graph tags on every page
- Schema.org Person JSON-LD on homepage
- Descriptive alt text on all images
- Clean URL structure

For WordPress, install Yoast SEO or RankMath and connect Google Search Console after launch.

**Target keywords:** instructional design portfolio, instructional designer writer, MEd instructional design technology, higher education instructional designer, digital humanities researcher, Kayla Canfield

---

## Long-Term Maintenance

**Easiest path:** Use the WordPress version on Hostinger. Add projects and writing pieces through the admin panel. Update bio and CV via the Customizer. Write blog posts in the standard WP editor.

**For design changes:** Edit `assets/css/main.css` for global changes. Page-specific CSS files are clearly named. All design tokens (colors, fonts, spacing) are in the `:root` block at the top of `main.css`.

**For content that is currently hard-coded** in the static HTML (bio text, skills list, stats), these become editable page content in WordPress. The About page content lives in the About page editor. The skills section can be managed via a widget or a custom page builder block.

---

## Credits

- **Fonts:** Jullina (handwriting), Meadow Notes (accent), Anas Rusty Typewriter (typewriter) — licensed for web use
- **Design assets:** Paper Note Nostalgic Design Toolkit by Basia Stryjecka
- **Google Fonts:** Playfair Display, Lora, Jost
- **Portrait photography:** Kayla Canfield
