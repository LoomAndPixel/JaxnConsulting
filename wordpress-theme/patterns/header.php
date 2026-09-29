<?php
/**
 * Title: Header
 * Slug: jaxn/header
 * Categories: jaxn
 * Block Types: core/template-part/header
 * Inserter: no
 *
 * @package Jaxn
 */
?>
<!-- wp:group {"tagName":"header","className":"jx-header","layout":{"type":"constrained"}} -->
<header class="wp-block-group jx-header">
<!-- wp:group {"align":"wide","className":"jx-header__bar","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} -->
<div class="wp-block-group alignwide jx-header__bar">
<!-- wp:html -->
<a class="jx-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/logo/jaxn-logo.svg' ) ); ?>" alt="Jaxn Consulting, home" width="68" height="25"></a>
<!-- /wp:html -->

<!-- wp:group {"className":"jx-header__nav","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group jx-header__nav">
<!-- wp:navigation {"overlayMenu":"mobile","className":"jx-nav","layout":{"type":"flex","justifyContent":"right"}} -->
<!-- wp:navigation-link {"label":"Services","url":"/our-services/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Work","url":"/projects/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"About","url":"/about/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Support","url":"/support/","kind":"custom"} /-->
<!-- /wp:navigation -->

<!-- wp:buttons {"className":"jx-header__cta"} -->
<div class="wp-block-buttons jx-header__cta"><!-- wp:button {"className":"is-style-small"} -->
<div class="wp-block-button is-style-small"><a class="wp-block-button__link wp-element-button" href="/contact/">Book a conversation</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</header>
<!-- /wp:group -->
