<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://nateconley.com
 * @since      1.0.0
 *
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/public
 * @author     Nate Conley <nate@nateconley.com>
 */
class Wp_Code_Snippets_Public {

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
	 * Supported languages for the plugin.
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	private $languages;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $languages ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->languages = $languages;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		// All available themes
		$themes = array(
			'coy',
			'dark',
			'funky',
			'okaidia',
			'solarizedlight',
			'tomorrow',
			'twilight',
		);

		// Register themes to be used in the admin settings area
		foreach( $themes as $theme ) {

			$file_path = plugin_dir_url( __FILE__ ) . 'prism/themes/';

			$file_name = sprintf( 'prism-%s.css', $theme );

			wp_register_style(
				$this->plugin_name . '-prism-' . $theme,
				$file_path . $file_name,
				array(),
				$this->version
			);

		}

		// This is the theme that will be used on the front end
		wp_register_style(
			$this->plugin_name . '-prism',
			plugin_dir_url( __FILE__ ) . 'prism/themes/prism.css',
			array(),
			$this->version
		);

		// Register line numbers
		wp_register_style(
			$this->plugin_name . '-prism-line-numbers',
			plugin_dir_url( __FILE__ ) . 'prism/plugins/css/prism-line-numbers.css',
			array(),
			$this->version
		);

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// Register prism base
		wp_register_script(
			$this->plugin_name . '-prism',
			plugin_dir_url( __FILE__ ) . 'prism/prism.js',
			array(),
			$this->version,
			true
		);

		// Register each component js file to be enqueued later
		foreach( $this->languages as $language ) {

			$file_path = plugin_dir_url( __FILE__ ) . 'prism/components/';

			$file_name = sprintf( 'prism-%s.min.js', $language );

			wp_register_script(
				$this->plugin_name . '-' . $language,
				$file_path . $file_name,
				array( $this->plugin_name . '-prism' ),
				$this->version,
				true
			);

		}

		// Register line numbers
		wp_register_script(
			$this->plugin_name . '-prism-line-numbers',
			plugin_dir_url( __FILE__ ) . 'prism/plugins/js/prism-line-numbers.min.js',
			array( $this->plugin_name . '-prism' ),
			$this->version,
			true
		);

	}

	/**
	 * Add code snippet shortcode
	 *
	 * @since    1.0.0
	 */
	public function code_snippets( $atts, $content = '' ) {

		wp_enqueue_script(
			sprintf( '%s-%s',
				$this->plugin_name,
				$atts['language']
			)
		);

		// Get options
		$options = get_option( $this->plugin_name . '-options' );
		$theme = $options[ 'theme' ];
		$line_numbers = $options[ 'line-numbers' ];

		if ( $theme == 'default' || $theme == '' ) {
			wp_enqueue_style( $this->plugin_name . '-prism' );
		} else {
			wp_enqueue_style( $this->plugin_name . '-prism-' . $theme );
		}

		if ( $line_numbers ) {
			wp_enqueue_style( $this->plugin_name . '-prism-line-numbers' );
			wp_enqueue_script( $this->plugin_name . '-prism-line-numbers' );
		}

		// Replace the opening <pre> tag
		$content = str_replace( '<pre>', '', $content );
		
		// Replace the closing </pre> tag
		$content = $this->str_last_replace( '</pre>', '', $content );

		// Prevent extra whitespace
		$content = str_replace( urldecode( '%3C%2Fp%3E%0A') , '', $content );
		$content = $this->str_last_replace( urldecode( '%0A%3Cp%3E' ), '', $content );

		$return = sprintf( '<pre class="%s"><code class="language-%s">%s</code></pre>',
			'line-numbers',
			$atts['language'],
			$content
		);

		return $return;

	}

	/**
	 * Register the shortcodes
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		
		add_shortcode( 'wp_code_snippets', array( $this, 'code_snippets' ) );

	}

	/**
	 * Replace the last occurance of a string
	 *
	 * @since    1.0.0
	 */
	private function str_last_replace( $search, $replace, $subject ) {

		$pos = strrpos($subject, $search);

		if( $pos !== false ) {
			$subject = substr_replace( $subject, $replace, $pos, strlen( $search ) );
		}

	    return $subject;

	}
}