<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://nateconley.com
 * @since      1.0.0
 *
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/admin/partials
 */

// The available themes
$themes = array(
	'default',
	'coy',
	'dark',
	'funky',
	'okaidia',
	'solarizedlight',
	'tomorrow',
	'twilight',
);
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
	<h1><?php echo get_admin_page_title(); ?></h1>

	<select name="" id="">
		<?php
			// Option for each available theme
			foreach( $themes as $theme ) {
				printf( '<option val="%1$s">%1$s</option>',
					$theme
				);
			}
		?>
	</select>

	<h3>Preview</h3>
	<h4>PHP</h4>
	<pre>
		<code class="language-php">
			echo 'Hello World';
			
			class My_Class {
				function __construct() {
					$this->hello();
				}
				
				public function hello() {
					echo 'Hello World';
				}
			}

			$hello = new My_Class();
		</code>
	</pre>

	<h4>JavaScript</h4>
	<pre>
		<code class="language-javascript">
			var hello = document.getElementById( 'hello' );

			hello.addEventListener( 'click', function() {
				console.log('Hello World');
			} );
		</code>
	</pre>

	<h4>JSON</h4>
	<pre>
		<code class="language-json">
			{
				"Hello": "World",
				"Lorem": "Ipsum",
				"animals": {
					"cat",
					"dog",
				},
			}
		</code>
	</pre>
</div>
