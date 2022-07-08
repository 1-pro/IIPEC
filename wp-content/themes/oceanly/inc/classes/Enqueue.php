<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Enqueue service.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Enqueue theme styles and scripts.
 */
class Enqueue implements Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_filter( 'wp_resource_hints', array( $this, 'resource_hints' ), 10, 2 );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		// Enqueue Google fonts.
		wp_enqueue_style( 'oceanly-fonts', $this->fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		// Theme stylesheet.
		wp_enqueue_style( 'oceanly-style', get_template_directory_uri() . '/style.min.css', array(), OCEANLY_VERSION );
		wp_style_add_data( 'oceanly-style', 'rtl', 'replace' );

		// Add output of customizer settings as inline style.
		wp_add_inline_style( 'oceanly-style', CSSRules::output() );

		// Theme script.
		wp_enqueue_script( 'oceanly-script', get_template_directory_uri() . '/js/script.min.js', array(), OCEANLY_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Add preconnect for Google fonts.
	 *
	 * @param array  $urls           URLs to print for resource hints.
	 * @param string $relation_type  The relation type the URLs are printed.
	 * @return array $urls           URLs to print for resource hints.
	 */
	public function resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'oceanly-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}

		return $urls;
	}

	/**
	 * Register Google fonts.
	 */
	public function fonts_url() {
		$fonts_url = apply_filters( 'oceanly_fonts_url', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;1,400;1,600&family=Source+Sans+Pro:ital,wght@0,600;1,600&display=swap' );

		return esc_url_raw( $fonts_url );
	}
}
