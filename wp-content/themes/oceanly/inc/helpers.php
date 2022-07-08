<?php
/**
 * Helper functions and hooks which are not auto-loaded.
 *
 * @package Oceanly
 */

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
		do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
	}
}

if ( ! function_exists( 'oceanly_register_required_plugins' ) ) {
	/**
	 * Register the required plugins for this theme.
	 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
	 */
	function oceanly_register_required_plugins() {
		/*
		* Array of plugin arrays. Required keys are name and slug.
		* If the source is NOT from the .org repo, then source is also required.
		*/
		$plugins = array(
			array(
				'name'     => 'Contact Form Query',
				'slug'     => 'contact-form-query',
				'required' => false,
			),
			array(
				'name'     => 'Social Icons Sticky',
				'slug'     => 'share-social-media',
				'required' => false,
			),
			array(
				'name'     => 'Getwid – Gutenberg Blocks',
				'slug'     => 'getwid',
				'required' => false,
			),
		);

		// Don't recommend if pro version already active.
		if ( ! class_exists( 'STLSP_Login_Security_Pro' ) ) {
			array_push(
				$plugins,
				array(
					'name'     => 'Login Security reCAPTCHA',
					'slug'     => 'login-security-recaptcha',
					'required' => false,
				)
			);
		}

		/*
		* Array of configuration settings. Amend each line as needed.
		*
		* TGMPA will start providing localized text strings soon. If you already have translations of our standard
		* strings available, please help us make TGMPA even better by giving us access to these translations or by
		* sending in a pull-request with .po file(s) with the translations.
		*
		* Only uncomment the strings in the config array if you want to customize the strings.
		*/
		$config = array(
			'id'           => 'oceanly',                        // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                               // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins',          // Menu slug.
			'has_notices'  => true,                             // Show admin notices or not.
			'dismissable'  => true,                             // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                               // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                            // Automatically activate plugins after installation or not.
			'message'      => '',                               // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

add_action( 'tgmpa_register', 'oceanly_register_required_plugins' );

/**
 * Adds a theme menu page.
 */
function oceanly_create_menu() {
	$oceanly_page = add_theme_page(
		esc_html_x( 'Oceanly', 'page title', 'oceanly' ),
		esc_html_x( 'Oceanly', 'menu title', 'oceanly' ),
		'edit_theme_options',
		'oceanly-options',
		'oceanly_page'
	);
	add_action( 'admin_print_styles-' . $oceanly_page, 'oceanly_options_styles' );
}
add_action( 'admin_menu', 'oceanly_create_menu' );

if ( ! function_exists( 'oceanly_page' ) ) {
	/**
	 * Builds the content of the theme page.
	 */
	function oceanly_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="oceanly-panel">
					<div class="oceanly-container">
						<div class="oceanly-title">
							<?php
							printf(
								wp_kses(
									/* translators: %s: theme version number */
									_x( 'Oceanly <span>Version %s</span>', 'menu page heading', 'oceanly' ),
									array( 'span' => array() )
								),
								esc_html( OCEANLY_VERSION )
							);
							?>
						</div>
					</div>
				</div>

				<div class="oceanly-container">
					<div class="oceanly-panel">
						<div class="oceanly-panel-content">
							<span class="oceanly-panel-title"><?php esc_html_e( 'Customize Theme', 'oceanly' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can customize the theme using the theme options available in the customizer.', 'oceanly' ); ?>
							</p>
						</div>
						<div class="oceanly-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button"><?php esc_html_e( 'Theme Options', 'oceanly' ); ?></a>
						</div>
					</div>
					<div class="oceanly-panel">
						<div class="oceanly-panel-content">
							<span class="oceanly-panel-title"><?php esc_html_e( 'Header Image', 'oceanly' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can change the header image in the Customizer > Header Image. Also, you can change the header background color from Customizer > Colors.', 'oceanly' ); ?>
							</p>
						</div>
						<div class="oceanly-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button"><?php esc_html_e( 'Theme Options', 'oceanly' ); ?></a>
						</div>
					</div>
					<div class="oceanly-panel">
						<div class="oceanly-panel-content">
							<span class="oceanly-panel-title"><?php esc_html_e( 'Menus', 'oceanly' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can create a menu and assign it to a menu location. Oceanly comes with three menu locations which include primary menu, footer menu, and social links menu.', 'oceanly' ); ?>
							</p>
						</div>
						<div class="oceanly-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" class="button"><?php esc_html_e( 'Menus', 'oceanly' ); ?></a>
						</div>
					</div>
					<div class="oceanly-panel oceanly-panel--highlight">
						<div class="oceanly-panel-content">
							<span class="oceanly-panel-title"><?php esc_html_e( 'Premium Version', 'oceanly' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'Oceanly Premium comes with extra features which include header top bar, 4 menus, social links (in header), 3 header block areas, 6 footer widgets locations, 2 footer block areas, custom colors, custom menu color, breadcrumbs color, custom header height, customizable Google fonts, removable footer credit link, advanced theme options, and much more.', 'oceanly' ); ?>
							</p>
						</div>
						<div class="oceanly-panel-actions">
							<a target="_blank" href="<?php echo esc_url( Oceanly\Helpers::get_upsell_buy_url() ); ?>" class="button button-primary"><strong><?php esc_html_e( 'Get Premium', 'oceanly' ); ?></strong></a>
						</div>
					</div>
					<div class="oceanly-panel">
						<div class="oceanly-panel-content">
							<span class="oceanly-panel-title"><?php esc_html_e( 'Header Block Area', 'oceanly' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can enable the header block area by creating a block in the reusable block manager. Then select this block in the Customizer > Header Block Area. Oceanly comes with 1 header block area.', 'oceanly' ); ?>
							</p>
						</div>
						<div class="oceanly-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'edit.php?post_type=wp_block' ) ); ?>" class="button"><?php esc_html_e( 'Reusable Blocks Manager', 'oceanly' ); ?></a>
						</div>
					</div>
					<div class="oceanly-panel">
						<div class="oceanly-panel-content">
							<span class="oceanly-panel-title"><?php esc_html_e( 'Background', 'oceanly' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can customize the body background image in the Customizer > Background Image. Also, you can change the body background color from Customizer > Colors.', 'oceanly' ); ?>
							</p>
						</div>
						<div class="oceanly-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button"><?php esc_html_e( 'Theme Options', 'oceanly' ); ?></a>
						</div>
					</div>
					<div class="oceanly-panel">
						<div class="oceanly-panel-content">
							<span class="oceanly-panel-title"><?php esc_html_e( 'Theme Widgets', 'oceanly' ); ?></span>
							<p class="description">
								<?php esc_html_e( 'You can drag and drop widgets to the widget area. Oceanly comes with 4 widgets area locations which include a main sidebar widget area and three locations for footer widgets.', 'oceanly' ); ?>
							</p>
						</div>
						<div class="oceanly-panel-actions">
							<a target="_blank" href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="button"><?php esc_html_e( 'Widgets', 'oceanly' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'oceanly_options_styles' ) ) {
	/**
	 * Enqueue styles for the theme page.
	 */
	function oceanly_options_styles() {
		wp_enqueue_style( 'oceanly-options', get_template_directory_uri() . '/inc/theme-page.css', array(), OCEANLY_VERSION );
	}
}

/**
 * Add a notice after theme activation.
 */
function oceanly_welcome_notice() {
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) { // phpcs:ignore
		?>
		<div class="updated notice notice-success is-dismissible">
			<p>
				<?php
				echo wp_kses(
					sprintf(
						/* translators: %s: Welcome page link. */
						__( 'Welcome! Thank you for choosing Oceanly theme. To get started, visit our <a href="%s">welcome page</a>.', 'oceanly' ),
						esc_url( admin_url( 'themes.php?page=oceanly-options' ) )
					),
					array( 'a' => array( 'href' => array() ) )
				);
				?>
			</p>
			<p>
				<a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=oceanly-options' ) ); ?>">
					<?php esc_html_e( 'Get started with Oceanly', 'oceanly' ); ?>
				</a>
			</p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'oceanly_welcome_notice' );
