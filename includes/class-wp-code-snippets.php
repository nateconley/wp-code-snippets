<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://nateconley.com
 * @since      1.0.0
 *
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/includes
 * @author     Nate Conley <nate@nateconley.com>
 */
class Wp_Code_Snippets {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wp_Code_Snippets_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Supported languages for the plugin.
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $languages;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'wp-code-snippets';
		$this->version = '1.0.0';
		$this->languages = array(
			"Markup"                  => "markup",
			"CSS"                     => "css",
			"C-like"                  => "clike",
			"JavaScript"              => "javascript",
			"ABAP"                    => "abap",
			"ActionScript"            => "actionscript",
			"Ada"                     => "ada",
			"Apache Configuration"    => "apacheconf",
			"APL"                     => "apl",
			"AppleScript"             => "applescript",
			"AsciiDoc"                => "asciidoc",
			"ASP.NET (C#)"            => "aspnet",
			"AutoIt"                  => "autoit",
			"AutoHotkey"              => "autohotkey",
			"Bash"                    => "bash",
			"BASIC"                   => "basic",
			"Batch"                   => "batch",
			"Bison"                   => "bison",
			"Brainfuck"               => "brainfuck",
			"Bro"                     => "bro",
			"C"                       => "c",
			"C#"                      => "csharp",
			"C++"                     => "cpp",
			"CoffeeScript"            => "coffeescript",
			"Crystal"                 => "crystal",
			"CSS Extras"              => "css-extras",
			"D"                       => "d",
			"Dart"                    => "dart",
			"Django/Jinja2"           => "django",
			"Diff"                    => "diff",
			"Docker"                  => "docker",
			"Eiffel"                  => "eiffel",
			"Elixir"                  => "elixir",
			"Erlang"                  => "erlang",
			"F#"                      => "fsharp",
			"Fortran"                 => "fortran",
			"Gherkin"                 => "gherkin",
			"Git"                     => "git",
			"GLSL"                    => "glsl",
			"Go"                      => "go",
			"GraphQL"                 => "graphql",
			"Groovy"                  => "groovy",
			"Haml"                    => "haml",
			"Handlebars"              => "handlebars",
			"Haskell"                 => "haskell",
			"Haxe"                    => "haxe",
			"HTTP"                    => "http",
			"Icon"                    => "icon",
			"Inform 7"                => "inform7",
			"Ini"                     => "ini",
			"J"                       => "j",
			"Jade"                    => "jade",
			"Java"                    => "java",
			"Jolie"                   => "jolie",
			"JSON"                    => "json",
			"Julia"                   => "julia",
			"Keyman"                  => "keyman",
			"Kotlin"                  => "kotlin",
			"LaTeX"                   => "latex",
			"Less"                    => "less",
			"LiveScript"              => "livescript",
			"LOLCODE"                 => "lolcode",
			"Lua"                     => "lua",
			"Makefile"                => "makefile",
			"Markdown"                => "markdown",
			"MATLAB"                  => "matlab",
			"MEL"                     => "mel",
			"Mizar"                   => "mizar",
			"Monkey"                  => "monkey",
			"NASM"                    => "nasm",
			"nginx"                   => "nginx",
			"Nim"                     => "nim",
			"Nix"                     =>" nix",
			"NSIS"                    => "nsis",
			"Objective-C"             => "objectivec",
			"OCaml"                   => "ocaml",
			"Oz"                      => "oz",
			"PARI/GP"                 => "parigp",
			"Parser"                  => "parser",
			"Pascal"                  => "pascal",
			"Perl"                    => "perl",
			"PHP"                     => "php",
			"PHP Extras"              => "php-extras",
			"PowerShell"              => "powershell",
			"Processing"              => "processing",
			"Prolog"                  => "prolog",
			".properties"             => "properties",
			"Protocol Buffers"        => "protobuf",
			"Puppet"                  => "puppet",
			"Pure"                    => "pure",
			"Python"                  => "python",
			"Q"                       => "q",
			"Qore"                    => "qore",
			"R"                       => "r",
			"React JSX"               => "jsx",
			"Reason"                  => "reason",
			"reST (reStructuredText)" => "rest",
			"Rip"                     => "rip",
			"Roboconf"                => "roboconf",
			"Ruby"                    => "ruby",
			"Rust"                    => "rust",
			"SAS"                     => "sas",
			"Sass (Sass)"             => "sass",
			"Sass (Scss)"             => "scss",
			"Scala"                   => "scala",
			"Scheme"                  => "scheme",
			"Smalltalk"               => "smalltalk",
			"Smarty"                  => "smarty",
			"SQL"                     => "sql",
			"Stylus"                  => "stylus",
			"Swift"                   => "swift",
			"Tcl"                     => "tcl",
			"Textile"                 => "textile",
			"Twig"                    => "twig",
			"TypeScript"              => "typescript",
			"VB.Net"                  => "vbnet",
			"Verilog"                 => "verilog",
			"VHDL"                    => "vhdl",
			"vim"                     => "vim",
			"Wiki markup"             => "wiki",
			"Xojo (REALbasic)"        => "xojo",
			"YAML"                    => "yaml",
		);

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wp_Code_Snippets_Loader. Orchestrates the hooks of the plugin.
	 * - Wp_Code_Snippets_i18n. Defines internationalization functionality.
	 * - Wp_Code_Snippets_Admin. Defines all hooks for the admin area.
	 * - Wp_Code_Snippets_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-code-snippets-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-code-snippets-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-code-snippets-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-code-snippets-public.php';

		$this->loader = new Wp_Code_Snippets_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wp_Code_Snippets_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wp_Code_Snippets_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wp_Code_Snippets_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles', 20 );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts', 20 );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'settings_page' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wp_Code_Snippets_Public( $this->get_plugin_name(), $this->get_version(), $this->get_languages() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		/**
		 * Also register and enqueue on admin 
		 * (bad, but prevents having double the amount of files)
		 */
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_public, 'enqueue_styles', 10 );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_public, 'enqueue_scripts', 10 );

		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wp_Code_Snippets_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the languages of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_languages() {
		return $this->languages;
	}

}
