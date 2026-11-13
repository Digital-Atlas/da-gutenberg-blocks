# DA Gutenberg Blocks

Custom ACF-powered Gutenberg blocks for Digital Atlas dermatology sites (plugin name: *Dermatology Affiliates Custom Blocks*).

## Blocks

| Block | Folder | Purpose |
|---|---|---|
| Treatment Tabs (`acf/care-tabs`) | `blocks/tabs` | Vertical tabbed interface (e.g. "Types of Acne"); collapses to stacked on mobile |
| Pills List | `blocks/pills-list` | Pill-style list. Pills use 1.1rem (1rem on mobile) unless a font size is set in the block's Typography settings, which then applies to the pills |
| Care Journey / Timeline | `blocks/timeline` | Step timeline |
| Author / Medically Reviewed By | `blocks/author` | Reviewer box with "Clinically Verified" badge |

ACF field groups live in `acf-json/` (one group object per file — list-wrapped exports won't load).

## Theme integration

Colours follow the UiCore global palette where available, with neutral fallbacks for non-UiCore sites, e.g. the Treatment Tabs sidebar uses `var(--uicore-light-color, #F6F5F2)`.

## Requirements

- WordPress 6.x
- Advanced Custom Fields Pro (block registration via `block.json` + `acf.renderTemplate`)

## Install / update

Sites update from **GitHub Releases**, like Digital Atlas Clinic Suite (Plugin Update Checker v5 in `lib/`, wired up in `includes/updater.php`).

- WordPress checks about every 12 hours, or right away via **Check for updates** on the Plugins screen.
- An update is offered when the repo has a published Release whose tag (e.g. `v2.4.1`) is higher than the installed Version. It installs the release's attached `da-gutenberg-blocks.zip` and keeps the site's existing folder name (e.g. `da-gutenberg-blocks-main/`).
- First install on a site: upload `da-gutenberg-blocks.zip` from the latest Release (Plugins → Add New → Upload, replacing the current version). After that, updates come through WordPress.

### Releasing

1. Bump the version in **both** places in `main-custom-blocks.php`: the `Version:` header and `DAGB_VERSION`.
2. Commit, then push a matching tag: `git tag v2.4.1 && git push origin v2.4.1`.
3. The Release workflow checks the tag matches both versions, lints the PHP, builds the zip (`bin/build.sh`) and publishes the Release.

Optional, in `wp-config.php`:

```php
define( 'DAGB_UPDATE_REPO', 'https://github.com/owner/repo/' ); // a different repo
define( 'DAGB_GITHUB_TOKEN', 'github_pat_…' );                   // only if the repo is private
define( 'DAGB_DISABLE_UPDATES', true );                          // opt a site out
```

Only one copy of this plugin may be active at a time (function names are not namespaced).
