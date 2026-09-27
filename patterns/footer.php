<?php
/**
 * Title: Footer
 * Slug: jaxn/footer
 * Categories: jaxn
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * @package Jaxn
 */
?>
<!-- wp:group {"tagName":"footer","className":"jx-footer","backgroundColor":"ink","layout":{"type":"constrained"}} -->
<footer class="wp-block-group jx-footer has-ink-background-color has-background">
<!-- wp:group {"align":"wide","className":"jx-footer__bar","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group alignwide jx-footer__bar">
<!-- wp:group {"className":"jx-footer__brand","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group jx-footer__brand">
<!-- wp:html -->
<a class="jx-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/logo/jaxn-logo-reverse.svg' ) ); ?>" alt="Jaxn Consulting, home" width="68" height="25"></a>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"jx-footer__small"} -->
<p class="jx-footer__small">Jaxn Consulting · Memphis, TN · Authorized GoTo Connect partner</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:navigation {"overlayMenu":"never","className":"jx-footer__nav","layout":{"type":"flex","justifyContent":"left"}} -->
<!-- wp:navigation-link {"label":"Services","url":"/our-services/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Work","url":"/projects/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"About","url":"/about/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Support","url":"/support/","kind":"custom"} /-->
<!-- wp:navigation-link {"label":"Contact","url":"/contact/","kind":"custom"} /-->
<!-- /wp:navigation -->

<!-- wp:paragraph {"className":"jx-footer__small"} -->
<p class="jx-footer__small">© [jaxn_year] Jaxn Consulting · <a href="/privacy-policy/">Privacy</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</footer>
<!-- /wp:group -->
