<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Helpers.
 *
 * @package Oceanly
 */

namespace Oceanly;

/**
 * Theme helpers.
 */
class Helpers {
	/**
	 * Find out if we should show the excerpt or the content.
	 *
	 * @return bool Whether to show the excerpt.
	 */
	public static function show_excerpt() {
		global $post;

		// Check if the more tag is being used.
		$more_tag = apply_filters( 'oceanly_more_tag', strpos( $post->post_content, '<!--more-->' ) );

		$format = ( false !== get_post_format() ) ? get_post_format() : 'standard';

		$blog_content_default = Defaults::blog_content();

		$show_excerpt = ( 'summary' === get_theme_mod( 'set_blog_content', $blog_content_default ) );

		$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;

		$show_excerpt = ( $more_tag ) ? false : $show_excerpt;

		$show_excerpt = ( is_search() ) ? true : $show_excerpt;

		return apply_filters( 'oceanly_show_excerpt', $show_excerpt );
	}

	/**
	 * Blog sidebar.
	 *
	 * @return string.
	 */
	public static function blog_sidebar() {
		$blog_sidebar_default = Defaults::blog_sidebar();

		return get_theme_mod( 'set_blog_sidebar', $blog_sidebar_default );
	}

	/**
	 * Blog width no sidebar.
	 *
	 * @return string.
	 */
	public static function blog_width_no_sidebar() {
		$blog_width_no_sidebar_default = Defaults::blog_width_no_sidebar();

		return get_theme_mod( 'set_blog_width_no_sidebar', $blog_width_no_sidebar_default );
	}

	/**
	 * Post thumbnail hover effect.
	 *
	 * @return bool.
	 */
	public static function post_thumbnail_hover_effect() {
		$post_thumbnail_hover_effect_default = Defaults::post_thumbnail_hover_effect();

		return get_theme_mod( 'set_post_thumbnail_hover_effect', $post_thumbnail_hover_effect_default );
	}

	/**
	 * Whether to show site title or tagline.
	 *
	 * @return bool.
	 */
	public static function show_site_title_or_tagline() {
		$show_site_title_default   = Defaults::show_site_title();
		$show_site_tagline_default = Defaults::show_site_tagline();

		return ( get_theme_mod( 'set_show_site_title', $show_site_title_default ) || get_theme_mod( 'set_show_site_tagline', $show_site_tagline_default ) );
	}

	/**
	 * Whether to show site title.
	 *
	 * @return bool.
	 */
	public static function show_site_title() {
		$show_site_title_default = Defaults::show_site_title();

		return get_theme_mod( 'set_show_site_title', $show_site_title_default );
	}

	/**
	 * Whether to show site tagline.
	 *
	 * @return bool.
	 */
	public static function show_site_tagline() {
		$show_site_tagline_default = Defaults::show_site_tagline();

		return get_theme_mod( 'set_show_site_tagline', $show_site_tagline_default );
	}

	/**
	 * Styles settings.
	 *
	 * @return array.
	 */
	public static function styles() {
		$styles_default = Defaults::styles( '', true );

		return wp_parse_args(
			get_theme_mod( 'set_styles', array() ),
			$styles_default
		);
	}

	/**
	 * Branding alignment (medium / large devices).
	 *
	 * @return string.
	 */
	public static function branding_alignment_md() {
		$branding_alignment_md_default = Defaults::branding_alignment_md();

		return get_theme_mod( 'set_branding_alignment_md', $branding_alignment_md_default );
	}

	/**
	 * Branding alignment (small devices).
	 *
	 * @return string.
	 */
	public static function branding_alignment_sm() {
		$branding_alignment_sm_default = Defaults::branding_alignment_sm();

		return get_theme_mod( 'set_branding_alignment_sm', $branding_alignment_sm_default );
	}

	/**
	 * Logo alignment (medium / large devices).
	 *
	 * @return string.
	 */
	public static function logo_alignment_md() {
		$logo_alignment_md_default = Defaults::logo_alignment_md();

		return get_theme_mod( 'set_logo_alignment_md', $logo_alignment_md_default );
	}

	/**
	 * Logo alignment (small devices).
	 *
	 * @return string.
	 */
	public static function logo_alignment_sm() {
		$logo_alignment_sm_default = Defaults::logo_alignment_sm();

		return get_theme_mod( 'set_logo_alignment_sm', $logo_alignment_sm_default );
	}

	/**
	 * Logo size (large devices).
	 *
	 * @return string.
	 */
	public static function logo_size_lg() {
		$logo_size_lg_default = Defaults::logo_size_lg();

		return get_theme_mod( 'set_logo_size_lg', $logo_size_lg_default );
	}

	/**
	 * Logo size (medium devices).
	 *
	 * @return string.
	 */
	public static function logo_size_md() {
		$logo_size_md_default = Defaults::logo_size_md();

		return get_theme_mod( 'set_logo_size_md', $logo_size_md_default );
	}

	/**
	 * Logo size (small devices).
	 *
	 * @return string.
	 */
	public static function logo_size_sm() {
		$logo_size_sm_default = Defaults::logo_size_sm();

		return get_theme_mod( 'set_logo_size_sm', $logo_size_sm_default );
	}

	/**
	 * Site title size (medium / large devices).
	 *
	 * @return string.
	 */
	public static function site_title_size_md() {
		$site_title_size_md_default = Defaults::site_title_size_md();

		return get_theme_mod( 'set_site_title_size_md', $site_title_size_md_default );
	}

	/**
	 * Site title size (small devices).
	 *
	 * @return string.
	 */
	public static function site_title_size_sm() {
		$site_title_size_sm_default = Defaults::site_title_size_sm();

		return get_theme_mod( 'set_site_title_size_sm', $site_title_size_sm_default );
	}

	/**
	 * Site tagline size (medium / large devices).
	 *
	 * @return string.
	 */
	public static function site_tagline_size_md() {
		$site_tagline_size_md_default = Defaults::site_tagline_size_md();

		return get_theme_mod( 'set_site_tagline_size_md', $site_tagline_size_md_default );
	}

	/**
	 * Site tagline size (small devices).
	 *
	 * @return string.
	 */
	public static function site_tagline_size_sm() {
		$site_tagline_size_sm_default = Defaults::site_tagline_size_sm();

		return get_theme_mod( 'set_site_tagline_size_sm', $site_tagline_size_sm_default );
	}

	/**
	 * Header image parallax effect.
	 *
	 * @return bool.
	 */
	public static function hero_header_bg_fixed() {
		$hero_header_bg_fixed_default = Defaults::hero_header_bg_fixed();

		return get_theme_mod( 'set_hero_header_bg_fixed', $hero_header_bg_fixed_default );
	}

	/**
	 * Header image background position.
	 *
	 * @return string.
	 */
	public static function hero_header_bg_position() {
		$hero_header_bg_position_default = Defaults::hero_header_bg_position();

		return get_theme_mod( 'set_hero_header_bg_position', $hero_header_bg_position_default );
	}

	/**
	 * Header image background size.
	 *
	 * @return string.
	 */
	public static function hero_header_bg_size() {
		$hero_header_bg_size_default = Defaults::hero_header_bg_size();

		return get_theme_mod( 'set_hero_header_bg_size', $hero_header_bg_size_default );
	}

	/**
	 * Menu alignment (medium / large devices).
	 *
	 * @return string.
	 */
	public static function menu_alignment_md() {
		$menu_alignment_md_default = Defaults::menu_alignment_md();

		return get_theme_mod( 'set_menu_alignment_md', $menu_alignment_md_default );
	}

	/**
	 * Menu alignment (small devices).
	 *
	 * @return string.
	 */
	public static function menu_alignment_sm() {
		$menu_alignment_sm_default = Defaults::menu_alignment_sm();

		return get_theme_mod( 'set_menu_alignment_sm', $menu_alignment_sm_default );
	}

	/**
	 * Sub-menu direction (large devices).
	 *
	 * @return string.
	 */
	public static function submenu_direction_lg() {
		$submenu_direction_lg_default = Defaults::submenu_direction_lg();

		return get_theme_mod( 'set_submenu_direction_lg', $submenu_direction_lg_default );
	}

	/**
	 * Sub-menu direction (medium devices).
	 *
	 * @return string.
	 */
	public static function submenu_direction_md() {
		$submenu_direction_md_default = Defaults::submenu_direction_md();

		return get_theme_mod( 'set_submenu_direction_md', $submenu_direction_md_default );
	}

	/**
	 * Whether to show header search form.
	 *
	 * @return bool.
	 */
	public static function show_header_search() {
		$show_header_search_default = Defaults::show_header_search();

		return get_theme_mod( 'set_show_header_search', $show_header_search_default );
	}

	/**
	 * Whether to show header breadcrumbs.
	 *
	 * @return bool.
	 */
	public static function show_header_breadcrumbs() {
		$show_header_breadcrumbs_default = Defaults::show_header_breadcrumbs();

		return get_theme_mod( 'set_show_header_breadcrumbs', $show_header_breadcrumbs_default );
	}

	/**
	 * Header block area.
	 *
	 * @param int $number Block area number.
	 * @return array.
	 */
	public static function header_block_area( $number = 1 ) {
		$set_header_block_area = get_theme_mod( 'set_header_block_area', array() );

		$header_block_area_default = Defaults::header_block_area();

		if ( array_key_exists( $number, $set_header_block_area ) ) {
			return wp_parse_args(
				$set_header_block_area[ $number ],
				$header_block_area_default
			);
		}

		return $header_block_area_default;
	}

	/**
	 * Footer widgets area per row (large devices).
	 *
	 * @return int
	 */
	public static function footer_widgets_per_row_lg() {
		$footer_widgets_per_row_lg_default = Defaults::footer_widgets_per_row_lg();

		return get_theme_mod( 'set_footer_widgets_per_row_lg', $footer_widgets_per_row_lg_default );
	}

	/**
	 * Footer widgets area per row (medium devices).
	 *
	 * @return int
	 */
	public static function footer_widgets_per_row_md() {
		$footer_widgets_per_row_md_default = Defaults::footer_widgets_per_row_md();

		return get_theme_mod( 'set_footer_widgets_per_row_md', $footer_widgets_per_row_md_default );
	}

	/**
	 * Footer widgets area per row (small devices).
	 *
	 * @return int
	 */
	public static function footer_widgets_per_row_sm() {
		$footer_widgets_per_row_sm_default = Defaults::footer_widgets_per_row_sm();

		return get_theme_mod( 'set_footer_widgets_per_row_sm', $footer_widgets_per_row_sm_default );
	}

	/**
	 * Get allowed tags for copyright text.
	 *
	 * @return array
	 */
	public static function copyright_allowed_tags() {
		return apply_filters(
			'oceanly_copyright_allowed_tags',
			array(
				'span'   => array( 'class' => array() ),
				'em'     => array(),
				'strong' => array(),
				'br'     => array(),
				'a'      => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
					'class' => array(),
				),
			)
		);
	}

	/**
	 * Get copyright text.
	 *
	 * @return string.
	 */
	public static function copyright() {
		$copyright_default = Defaults::copyright();

		return get_theme_mod( 'set_copyright', $copyright_default );
	}

	/**
	 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the BreadcrumbTrail class,
	 * which should be used in theme templates.
	 *
	 * @access public
	 *
	 * @param  array $args Arguments to pass to Breadcrumb_Trail.
	 *
	 * @return string html output.
	 */
	public static function breadcrumb_trail( $args = array() ) {
		$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

		if ( ! is_object( $breadcrumb ) ) {
			$breadcrumb = new BreadcrumbTrail( $args );
		}

		return $breadcrumb->trail();
	}

	/**
	 * Get theme author URL.
	 * Used in footer credit link.
	 *
	 * @return string
	 */
	public static function get_author_url() {
		return 'https://scriptstown.com/';
	}

	/**
	 * Get upsell buy URL.
	 * Used one time in the theme page and customizer.
	 *
	 * @return string
	 */
	public static function get_upsell_buy_url() {
		return 'https://scriptstown.com/account/signup/oceanly-premium-wordpress-theme';
	}
}
