<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Widget service.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Register theme widget area.
 */
class Widget implements Serviceable {
	const FOOTER_WIDGETS = 3;

	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
	}

	/**
	 * Register widget area.
	 */
	public function widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Main Sidebar', 'oceanly' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'oceanly' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		for ( $i = 1; $i <= self::FOOTER_WIDGETS; $i++ ) {
			register_sidebar(
				array(
					/* translators: %s: footer widget area number */
					'name'          => sprintf( esc_html__( 'Footer Widget Area %s', 'oceanly' ), $i ),
					'id'            => 'footer-' . $i,
					'description'   => esc_html__( 'Add widgets here.', 'oceanly' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		}
	}

	/**
	 * Get number of active footer widgets area.
	 * return int.
	 */
	public static function footer_widgets_active() {
		$footer_widgets_active = 0;

		for ( $i = 1; $i <= self::FOOTER_WIDGETS; $i++ ) {
			if ( is_active_sidebar( 'footer-' . $i ) ) {
				$footer_widgets_active++;
			}
		}

		return $footer_widgets_active;
	}
}
