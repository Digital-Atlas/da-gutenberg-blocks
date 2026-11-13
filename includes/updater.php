<?php
/**
 * Updates from GitHub Releases (Plugin Update Checker v5).
 *
 * WordPress checks about every 12 hours, or right away via "Check for updates" on the Plugins screen.
 * A new version is offered when the repo has a published Release whose tag (e.g. v2.4.1) is higher than
 * the installed Version, and the update installs that release's attached da-gutenberg-blocks.zip.
 *
 * Optional, in wp-config.php:
 *   define( 'DAGB_UPDATE_REPO', 'https://github.com/owner/repo/' );  // a different repo
 *   define( 'DAGB_GITHUB_TOKEN', 'github_pat_…' );                    // only if the repo is private
 *   define( 'DAGB_DISABLE_UPDATES', true );                           // opt a site out
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( defined( 'DAGB_DISABLE_UPDATES' ) && DAGB_DISABLE_UPDATES ) return;

$dagb_puc = DAGB_DIR . 'lib/plugin-update-checker/plugin-update-checker.php';
if ( ! is_readable( $dagb_puc ) ) return;
require_once $dagb_puc;

$dagb_update_checker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
	defined( 'DAGB_UPDATE_REPO' ) ? DAGB_UPDATE_REPO : 'https://github.com/Digital-Atlas/da-gutenberg-blocks/',
	DAGB_FILE,
	'da-gutenberg-blocks'
);

// Install the release's built zip (folder named da-gutenberg-blocks/), not GitHub's source archive.
$dagb_update_checker->getVcsApi()->enableReleaseAssets( '/da-gutenberg-blocks\.zip($|[?&#])/i' );

if ( defined( 'DAGB_GITHUB_TOKEN' ) && DAGB_GITHUB_TOKEN ) {
	$dagb_update_checker->setAuthentication( DAGB_GITHUB_TOKEN );
}

unset( $dagb_puc );
