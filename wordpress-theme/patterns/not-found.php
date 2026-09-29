<?php
/**
 * Title: Page not found (404)
 * Slug: jaxn/not-found
 * Categories: jaxn
 * Inserter: no
 *
 * @package Jaxn
 */

$jaxn_links = array(
	array( 'Home', '/', 'Start from the beginning.' ),
	array( 'Services', '/our-services/', 'What we do, from cloud to phones.' ),
	array( 'Work', '/projects/', 'Recent projects and results.' ),
	array( 'Support', '/support/', 'Existing client with an issue?' ),
);
?>
<!-- wp:group {"className":"jx-404","layout":{"type":"constrained"}} -->
<div class="wp-block-group jx-404">
<!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center","className":"jx-404__text"} -->
<div class="wp-block-column is-vertically-aligned-center jx-404__text">
<!-- wp:paragraph {"className":"jx-eyebrow"} -->
<p class="jx-eyebrow">Page not found</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"jx-404__big"} -->
<p class="jx-404__big" aria-hidden="true">404<span>.</span></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">This page took a <em><mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-green-color">wrong turn.</mark></em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>It may have moved, or it never existed. No problem: here are a few good places to pick up from.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:group {"className":"jx-list jx-list--compact","layout":{"type":"default"}} -->
<div class="wp-block-group jx-list jx-list--compact">
<?php foreach ( $jaxn_links as $jaxn_link ) : ?>
<!-- wp:group {"className":"jx-list__item","layout":{"type":"default"}} -->
<div class="wp-block-group jx-list__item">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><a href="<?php echo esc_url( home_url( $jaxn_link[1] ) ); ?>"><?php echo esc_html( $jaxn_link[0] ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $jaxn_link[2] ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p>Looking for something specific? Email <a href="mailto:info@jaxnconsulting.com">info@JaxnConsulting.com</a>.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
