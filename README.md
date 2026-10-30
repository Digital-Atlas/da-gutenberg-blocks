# DA Gutenberg Blocks

Custom ACF-powered Gutenberg blocks for Digital Atlas dermatology sites (plugin name: *Dermatology Affiliates Custom Blocks*).

## Blocks

| Block | Folder | Purpose |
|---|---|---|
| Treatment Tabs (`acf/care-tabs`) | `blocks/tabs` | Vertical tabbed interface (e.g. "Types of Acne"); collapses to stacked on mobile |
| Pills List | `blocks/pills-list` | Pill-style list |
| Care Journey / Timeline | `blocks/timeline` | Step timeline |
| Author / Medically Reviewed By | `blocks/author` | Reviewer box with "Clinically Verified" badge |

ACF field groups live in `acf-json/` (one group object per file — list-wrapped exports won't load).

## Theme integration

Colours follow the UiCore global palette where available, with neutral fallbacks for non-UiCore sites, e.g. the Treatment Tabs sidebar uses `var(--uicore-light-color, #F6F5F2)`.

## Requirements

- WordPress 6.x
- Advanced Custom Fields Pro (block registration via `block.json` + `acf.renderTemplate`)

## Install / update

```bash
cd wp-content/plugins
git clone git@github.com:Digital-Atlas/da-gutenberg-blocks.git
# later
cd da-gutenberg-blocks && git pull
```

Only one copy of this plugin may be active at a time (function names are not namespaced).
