<?php

/**
 * Fired during plugin activation
 *
 * @link       http://nateconley.com
 * @since      1.0.0
 *
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Code_Snippets
 * @subpackage Wp_Code_Snippets/includes
 * @author     Nate Conley <nate@nateconley.com>
 */
class Wp_Code_Snippets_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		update_option( 'wp-code-snippets-options', array( 
			'theme' => 'default',
			'line-numbers' => false 
		) );

	}

}
