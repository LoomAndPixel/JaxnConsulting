<?php
/**
 * Jaxn theme setup.
 *
 * @package Jaxn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Cache-busting version for theme files: the file's last change time.
 */
function jaxn_asset_version( $path ) {
	$file = get_theme_file_path( $path );
	return file_exists( $file ) ? (string) filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

add_action( 'after_setup_theme', function () {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/theme.css' );
	remove_theme_support( 'core-block-patterns' );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'jaxn', get_theme_file_uri( 'assets/css/theme.css' ), array(), jaxn_asset_version( 'assets/css/theme.css' ) );
} );

/**
 * Preload the two upright fonts so headings don't flash in a fallback.
 */
add_action( 'wp_head', function () {
	foreach ( array( 'fraunces.woff2', 'instrument-sans.woff2' ) as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( 'assets/fonts/' . $font ) )
		);
	}
}, 1 );

/**
 * Favicons from the theme, unless a Site Icon has been set in the dashboard.
 */
add_action( 'wp_head', function () {
	if ( has_site_icon() ) {
		return;
	}
	$base = get_theme_file_uri( 'assets/icons/' );
	printf( '<link rel="icon" href="%s" sizes="32x32">' . "\n", esc_url( $base . 'favicon.ico' ) );
	printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( $base . 'favicon.svg' ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( $base . 'apple-touch-icon.png' ) );
} );

/**
 * Search and sharing tags: a meta description plus Open Graph / Twitter tags, so search
 * results and link previews (LinkedIn, Facebook, iMessage...) show the right text and image.
 *
 * Description: the page's excerpt if one is written, otherwise the page's intro paragraph
 * (the first "jx-lead" paragraph), otherwise the site tagline.
 * Image: the page's featured image if it has one, otherwise the theme's share card.
 * Skipped entirely when an SEO plugin is active, so the tags are never doubled.
 */
function jaxn_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || class_exists( 'The_SEO_Framework\Load' );
}

function jaxn_page_description() {
	$text = '';
	if ( is_singular() ) {
		$post = get_queried_object();
		$text = has_excerpt( $post ) ? get_the_excerpt( $post ) : '';
		if ( '' === $text && preg_match( '#<p class="[^"]*\bjx-lead\b[^"]*">(.*?)</p>#s', (string) $post->post_content, $m ) ) {
			$text = $m[1];
		}
	}
	if ( '' === $text ) {
		$text = get_bloginfo( 'description' );
	}
	$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( html_entity_decode( $text, ENT_QUOTES, 'UTF-8' ) ) ) );
	return wp_html_excerpt( $text, 160, '…' );
}

add_action( 'wp_head', function () {
	if ( jaxn_seo_plugin_active() ) {
		return;
	}
	$desc  = jaxn_page_description();
	$title = is_front_page() ? get_bloginfo( 'name' ) . ' – ' . get_bloginfo( 'description' ) : wp_get_document_title();
	$url   = is_singular() ? get_permalink() : home_url( add_query_arg( array() ) );
	$image = get_theme_file_uri( 'assets/images/og-image.jpg' );
	$w     = 1200;
	$h     = 630;
	if ( is_singular() && has_post_thumbnail() ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		if ( $src ) {
			list( $image, $w, $h ) = $src;
		}
	}
	$tags = array(
		array( 'name', 'description', $desc ),
		array( 'property', 'og:type', is_front_page() ? 'website' : 'article' ),
		array( 'property', 'og:site_name', get_bloginfo( 'name' ) ),
		array( 'property', 'og:title', $title ),
		array( 'property', 'og:description', $desc ),
		array( 'property', 'og:url', $url ),
		array( 'property', 'og:image', $image ),
		array( 'property', 'og:image:width', (string) $w ),
		array( 'property', 'og:image:height', (string) $h ),
		array( 'name', 'twitter:card', 'summary_large_image' ),
	);
	foreach ( $tags as $t ) {
		printf( '<meta %s="%s" content="%s">' . "\n", $t[0], esc_attr( $t[1] ), esc_attr( $t[2] ) );
	}
}, 5 );

add_action( 'init', function () {
	add_post_type_support( 'page', 'excerpt' );
	register_block_pattern_category( 'jaxn', array( 'label' => __( 'Jaxn', 'jaxn' ) ) );
	register_block_style( 'core/button', array( 'name' => 'small', 'label' => __( 'Small', 'jaxn' ) ) );
	register_block_style( 'core/button', array( 'name' => 'text', 'label' => __( 'Text link', 'jaxn' ) ) );
	register_block_style( 'core/button', array( 'name' => 'light', 'label' => __( 'Light (on green)', 'jaxn' ) ) );
} );

/**
 * Mark the menu link for the page being viewed, so the menu can underline it.
 * (The header uses plain links, which WordPress doesn't mark by itself.)
 */
add_filter( 'render_block_core/navigation-link', function ( $html, $block ) {
	$url = $block['attrs']['url'] ?? '';
	if ( '' === $url || str_contains( $html, 'current-menu-item' ) ) {
		return $html;
	}
	$link_path = untrailingslashit( (string) wp_parse_url( $url, PHP_URL_PATH ) );
	$here_path = untrailingslashit( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ) );
	if ( '' !== $link_path && $link_path === $here_path ) {
		$html = preg_replace( '/class="wp-block-navigation-item /', 'class="wp-block-navigation-item current-menu-item ', $html, 1 );
		$html = preg_replace( '/<a /', '<a aria-current="page" ', $html, 1 );
	} elseif ( '' !== $link_path && $link_path === jaxn_section_path() ) {
		$html = preg_replace( '/class="wp-block-navigation-item /', 'class="wp-block-navigation-item current-menu-ancestor ', $html, 1 );
	}
	return $html;
}, 10, 2 );

/**
 * Which menu section the current page belongs to, judged by its layout:
 * service pages sit under Services, case studies under Work.
 */
function jaxn_section_path() {
	static $section = null;
	if ( null === $section ) {
		$section = '';
		if ( is_singular() ) {
			$content = (string) get_post_field( 'post_content', get_queried_object_id() );
			if ( str_contains( $content, 'jx-svchero' ) ) {
				$section = '/our-services';
			} elseif ( str_contains( $content, 'jx-casehero' ) ) {
				$section = '/projects';
			}
		}
	}
	return $section;
}

/**
 * [jaxn_year] in any paragraph becomes the current year (used in the footer
 * copyright line). Done per block because template parts don't run shortcodes.
 */
add_filter( 'render_block_core/paragraph', function ( $html ) {
	return str_replace( '[jaxn_year]', esc_html( wp_date( 'Y' ) ), $html );
} );
