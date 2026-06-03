# The Black Door Oven — Custom WordPress Theme

Phase 1 static-first landing theme (header, footer, home). This document is the single source of truth for structure, assets, and conventions.

## Project structure

| Path | Responsibility |
|------|----------------|
| [`style.css`](style.css) | WordPress theme metadata only (Theme Name, Text Domain, version). No layout CSS here. |
| [`functions.php`](functions.php) | Enqueues, theme support, nav menus, widget areas, small helpers (`oven_*`). |
| [`header.php`](header.php) / [`footer.php`](footer.php) | Thin wrappers that `require` shared partials under `page-template/`. |
| [`page-template/header.php`](page-template/header.php) | Document head, `<body>`, site header, mobile drawer shell. |
| [`page-template/footer.php`](page-template/footer.php) | Emits closing `</main>` then the site footer, widget rows, and `wp_footer()`. Each template must open `<main id="primary">` after `get_header()` and must not close it. |
| [`front-page.php`](front-page.php) | Front page routing: static page uses its template; otherwise loads [`home.php`](home.php). |
| [`home.php`](home.php) | Home landing layout; includes [`template-parts/home/`](template-parts/home/) section partials. |
| [`index.php`](index.php) | Blog index fallback when the front page is not the custom home layout. |
| [`inc/template-tags.php`](inc/template-tags.php) | Shared path/URL helpers (standalone + WP). |
| [`assets/css/variables.css`](assets/css/variables.css) | Design tokens: colors, typography variables, spacing scale. |
| [`assets/css/common.css`](assets/css/common.css) | Base utilities, global resets, **`.oven-*`** layout and section components (no new `@media` here for this project). |
| [`assets/css/responsive.css`](assets/css/responsive.css) | **All new breakpoint rules** for `.oven-*` live inside the **existing** `@media` blocks only. |
| [`assets/js/main.js`](assets/js/main.js) | Mobile nav, Swiper inits (hero, gallery, polaroids). |
| [`assets/fonts/`](assets/fonts/) | Local `@font-face` bundle: **Bebas Neue** + **Lil Stuart** (`stylesheet.css` + `.woff2` / `.woff` files). Licensing: Lil Stuart file is marked *personal use only* — replace with a licensed webfont before production if required. |
| [`assets/images/placeholders/`](assets/images/placeholders/) | Optional; Phase 1 dummy photos use **picsum.photos** via PHP helper. |

## Asset loading strategy

Enqueue order (see [`functions.php`](functions.php)):

1. **Local fonts** — [`assets/fonts/stylesheet.css`](assets/fonts/stylesheet.css) (Bebas Neue, Lil Stuart PERSONAL USE ONLY)
2. **Sen** (body / “San” in the design brief) — [Google Fonts Sen](https://fonts.google.com/specimen/Sen) weights 400–800 only (no duplicate Bebas load)
3. Local Bootstrap CSS (`assets/css/bootstrap.min.css`)
4. Local Swiper CSS (`assets/css/swiper-bundle.min.css`)
5. `variables.css` → `common.css` → `responsive.css`
6. Local Bootstrap bundle JS, local Swiper JS, then `main.js` (depends on both)

Version strings use `filemtime()` on key theme CSS/JS and the local font stylesheet for cache busting.

## Typography (mandatory)

| Role | Font | Source |
|------|------|--------|
| **All `h1`–`h6`** | Bebas Neue | Local (`assets/fonts/`) |
| **`p`, `li`, form controls, body UI** | Sen | Google Fonts (enqueued as `oven-fonts-sen`) |
| **`<strong>` inside `h1`–`h6` only** | Lil Stuart + orange (`--oven-orange`) | Local; rules in [`common.css`](assets/css/common.css) |

**Accent pattern:** use semantic markup, e.g. `<h2>Food, Music & Good <strong>Times</strong></h2>`. Do not rely on extra classes inside headings for the script accent.

**Legacy utility:** `.oven-script` still exists for edge cases but new templates should prefer `<strong>` inside headings.

## Styling rules

- **Tokens**: Edit colors, fonts, and scale in [`variables.css`](assets/css/variables.css) only. Current brand approximations: forest `#1E392A`, orange `#E87D3E`, red `#D82216`, cream `#F9F5EB`.
- **Components / sections**: Use the **`oven-`** prefix (e.g. `.oven-header`, `.oven-hero`). No inline styles in PHP templates.
- **WYSIWYG / ACF**: Do not rely on custom classes inside rich text. Wrap output in a container (e.g. `.oven-prose`) and style descendants globally (`.oven-prose p`, `.oven-prose ul`, headings). For a script word in a heading from the editor, authors may use `<strong>` inside the heading.
- **Bootstrap**: Use the grid and utilities where they speed layout; skin with `.oven-*` in `common.css`.

## Responsiveness

- **New** breakpoint-specific rules for this theme: **only** inside [`responsive.css`](assets/css/responsive.css), within the **predefined** `@media` blocks (`1799px`, `1599px`, `1366px`, `1299px`, `991px`, `767px`, `599px`, `399px`).
- **Tech debt**: [`common.css`](assets/css/common.css) still contains legacy `@media` blocks (container max-widths and a `768px` block). Do not add further media queries there for new work; optionally migrate those to `responsive.css` in a later cleanup.

## WordPress integration

- **Menus**: Register locations **`primary`** (left: Home, Our Story, Menu), **`utility`** (right: Gallery, Contact, Book a Table), and **`footer`** (horizontal strip above copyright). Assign menus under **Appearance → Menus**. Fallback markup matches the latest landing labels if a location is empty.
- **Logo**: **Appearance → Customize → Site Identity** (custom logo). Fallback markup is provided if none is set.
- **Widgets**: Footer areas `footer-main` and `footer-bottom` (see [`functions.php`](functions.php)). Optional content; static copy remains as fallback when empty.
- **Front page**: **Settings → Reading**: set a static front page, or leave posts as front; [`front-page.php`](front-page.php) loads the page template when a static page is chosen, otherwise [`home.php`](home.php).

## Future ACF usage

- Prefer one field group per home section with subfields for headline lines, body, images, links, repeater for FAQ rows.
- Output through `get_field()` with array defaults; escape with `esc_html`, `esc_url`, `esc_attr`; use `wp_kses_post` only where HTML is intentional.
- Keep section markup in `template-parts/home/section-*.php` and swap static strings for field values.

## Dummy images

Phase 1 uses **picsum.photos** URLs with fixed seeds in PHP so layouts load without bundling large binaries. Replace with attachment IDs or theme `assets/images/` files when final art is ready; update [`home.php`](home.php) / partials in one place per section.

## Modifications and removals (changelog)

- Removed non-production `template_include` debug logger from `functions.php` (was writing to `ABSPATH . 'debug-5fb1da.log'`).
- Replaced broken enqueues for missing `iom-commonwealth.css`, `iom-responsive.css`, `iom-main.js` with the real `variables.css` / `common.css` / `responsive.css` / `main.js` chain and **local** Bootstrap + Swiper from `assets/`.
- Removed legacy IOM / Commonwealth home sections from [`home.php`](home.php) in favor of the pizzeria section stack.
- Merged stray `:root` brand colors from [`assets/css/style.css`](assets/css/style.css) into `variables.css`; `assets/css/style.css` is not enqueued.
- Typography: switched to **local Bebas + Lil Stuart** plus **Sen** for body; heading accents use `<strong>` inside headings (global CSS). Header no longer hard-links Google fonts — all font CSS goes through `functions.php` except what you intentionally add in templates (avoid duplicates).
- Home/footer refreshed to match updated art direction (transparent header on front page, wood product band, forest torn footer edge, footer nav + icon links, CTA/gallery copy).

## Guidelines for future updates

1. Add design tokens before hard-coding hex values.
2. Add section CSS to `common.css`; add breakpoint tweaks only to existing blocks in `responsive.css`.
3. Add Swiper or UI behavior to `main.js` with existence checks on the root selector.
4. Document any new template part or menu location in this README.
