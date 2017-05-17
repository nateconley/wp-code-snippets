<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://nateconley.com
 * @since      1.0.0
 *
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/admin
 * @author     Nate Conley <nate@nateconley.com>
 */
class Wp_Code_Snippets_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		if ( $hook !== 'settings_page_wp-code-snippets-settings' ) {
			return;
		}

		// The available themes
		$themes = array(
			'coy',
			'dark',
			'funky',
			'okaidia',
			'solarizedlight',
			'tomorrow',
			'twilight',
		);

		// Enqueue the default theme
		wp_enqueue_style(
			$this->plugin_name . '-prism'
		);

		// Enqueue all of the themes
		foreach( $themes as $theme ) {

			wp_enqueue_style(
				$this->plugin_name . '-prism-' . $theme
			);

		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		if ( $hook !== 'settings_page_wp-code-snippets-settings' ) {
			return;
		}

		// Enqueue standard admin js that handles previews toggling
		wp_enqueue_script(
			$this->plugin_name . '-admin',
			plugin_dir_url( __FILE__ ) . 'js/wp-code-snippets-admin.js',
			array( 'jquery' ),
			$this->version,
			true
		);

		// The languages used on the preview screen
		$preview_languages = array(
			'php',
			'javascript',
			'json',
		);

		// Enqueue prism scripts on the settings page for previews
		foreach( $preview_languages as $language ) {

			wp_enqueue_script(
				sprintf( '%s-%s',
					$this->plugin_name,
					$language
				)
			);

		}
	}

	/**
	 * Add a submenu page for options
	 *
	 * @since 1.0.0
	 */
	public function settings_page() {

		add_submenu_page(
			'options-general.php',
			__( 'WP Code Snippets Settings', 'wp-code-snippets' ),
			__( 'WP Code Snippets', 'wp-code-snippets' ),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'settings_page_view' )
		);

	}

	/**
	 * Settings page view
	 *
	 * @since 1.0.0
	 */
	public function settings_page_view() {

		require_once( plugin_dir_path( __FILE__ ) . 'partials/wp-code-snippets-admin-display.php' );

	}

}
