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

	}

	/**
	 * Add code snippet shortcode
	 *
	 * @since    1.0.0
	 */
	public function code_snippets( $atts, $content = '' ) {

		wp_enqueue_style( $this->plugin_name . '-prism' );

		wp_enqueue_script(
			sprintf( '%s-%s',
				$this->plugin_name,
				$atts['language']
			)
		);

		// Prevent extra whitespace
		$content = trim( $content );

		$return = sprintf( '<code class="language-%s">%s</code>',
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



}









// "Markup"                  => "markup",
// "CSS"                     => "css",
// "C-like"                  => "clike",
// "JavaScript"              => "javascript",
// "ABAP"                    => "abap",
// "ActionScript"            => "actionscript",
// "Ada"                     => "ada",
// "Apache Configuration"    => "apacheconf",
// "APL"                     => "apl",
// "AppleScript"             => "applescript",
// "AsciiDoc"                => "asciidoc",
// "ASP.NET (C#)"            => "aspnet",
// "AutoIt"                  =>"autoit",
// "AutoHotkey"              => "autohotkey",
// "Bash"                    => "bash",
// "BASIC"                   => "basic",
// "Batch"                   => "batch",
// "Bison"                   => "bison",
// "Brainfuck"               => "brainfuck",
// "Bro"                     => "bro",
// "C"                       => "c",
// "C#"                      => "csharp",
// "C++"                     => "cpp",
// "CoffeeScript"            => "coffeescript",
// "Crystal"                 => "crystal",
// "CSS Extras"              => "css-extras",
// "D"                       => "d",
// "Dart"                    => "dart",
// "Django/Jinja2"           => "django",
// "Diff"                    => "diff",
// "Docker"                  => "docker",
// "Eiffel"                  => "eiffel",
// "Elixir"                  => "elixir",
// "Erlang"                  => "erlang",
// "F#"                      => "fsharp",
// "Fortran"                 => "fortran",
// "Gherkin"                 => "gherkin",
// "Git"                     => "git",
// "GLSL"                    => "glsl",
// "Go"                      => "go",
// "GraphQL"                 => "graphql",
// "Groovy"                  => "groovy",
// "Haml"                    => "haml",
// "Handlebars"              => "handlebars",
// "Haskell"                 => "haskell",
// "Haxe"                    => "haxe",
// "HTTP"                    => "http",
// "Icon"                    => "icon",
// "Inform 7"                => "inform7",
// "Ini"                     => "ini",
// "J"                       => "j",
// "Jade"                    => "jade",
// "Java"                    => "java",
// "Jolie"                   => "jolie",
// "JSON"                    => "json",
// "Julia"                   => "julia",
// "Keyman"                  => "keyman",
// "Kotlin"                  => "kotlin",
// "LaTeX"                   => "latex",
// "Less"                    => "less",
// "LiveScript"              => "livescript",
// "LOLCODE"                 => "lolcode",
// "Lua"                     => "lua",
// "Makefile"                => "makefile",
// "Markdown"                => "markdown",
// "MATLAB"                  => "matlab",
// "MEL"                     => "mel",
// "Mizar"                   => "mizar",
// "Monkey"                  => "monkey",
// "NASM"                    => "nasm",
// "nginx"                   => "nginx",
// "Nim"                     => "nim",
// "Nix"                     =>" nix",
// "NSIS"                    => "nsis",
// "Objective-C"             => "objectivec",
// "OCaml"                   => "ocaml",
// "Oz"                      => "oz",
// "PARI/GP"                 => "parigp",
// "Parser"                  => "parser",
// "Pascal"                  => "pascal",
// "Perl"                    => "perl",
// "PHP"                     => "php",
// "PHP Extras"              => "php-extras",
// "PowerShell"              => "powershell",
// "Processing"              => "processing",
// "Prolog"                  => "prolog",
// ".properties"             => "properties",
// "Protocol Buffers"        => "protobuf",
// "Puppet"                  => "puppet",
// "Pure"                    => "pure",
// "Python"                  => "python",
// "Q"                       => "q",
// "Qore"                    => "qore",
// "R"                       => "r",
// "React JSX"               => "jsx",
// "Reason"                  => "reason",
// "reST (reStructuredText)" => "rest",
// "Rip"                     => "rip",
// "Roboconf"                => "roboconf",
// "Ruby"                    => "ruby",
// "Rust"                    => "rust",
// "SAS"                     => "sas",
// "Sass (Sass)"             => "sass",
// "Sass (Scss)"             => "scss",
// "Scala"                   => "scala",
// "Scheme"                  => "scheme",
// "Smalltalk"               => "smalltalk",
// "Smarty"                  => "smarty",
// "SQL"                     => "sql",
// "Stylus"                  => "stylus",
// "Swift"                   => "swift",
// "Tcl"                     => "tcl",
// "Textile"                 => "textile",
// "Twig"                    => "twig",
// "TypeScript"              => "typescript",
// "VB.Net"                  => "vbnet",
// "Verilog"                 => "verilog",
// "VHDL"                    => "vhdl"
// "vim"                     => "vim"
// "Wiki markup"             => "wiki"
// "Xojo (REALbasic)"        => "xojo",
// "YAML"                    => "yaml"
