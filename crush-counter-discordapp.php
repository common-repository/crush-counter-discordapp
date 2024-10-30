<?php

/**
 * 
 *
 * This plugin was made to help Integration with DiscordApp
 *
 * @link              www.iware.com.br
 * @since             1.0.0
 * @package           Crush_Counter_Discordapp
 *
 * @wordpress-plugin
 * Plugin Name:       Crush Counter DiscordApp
 * Plugin URI:        http://wordpress.org/plugins/crush-counter-discordapp
 * Description:       Fornece integração com algumas funcionalidades do DiscordApp. Gives integration with some DiscorApp Functionalities.
 * Version:           1.0.1
 * Author:            Djavan "Ryuuzaki" Fernando
 * Author URI:        www.iware.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       crush-counter-discordapp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-crush-counter-discordapp-activator.php
 */
function activate_crush_counter_discordapp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-crush-counter-discordapp-activator.php';
	Crush_Counter_Discordapp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-crush-counter-discordapp-deactivator.php
 */
function deactivate_crush_counter_discordapp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-crush-counter-discordapp-deactivator.php';
	Crush_Counter_Discordapp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_crush_counter_discordapp' );
register_deactivation_hook( __FILE__, 'deactivate_crush_counter_discordapp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-crush-counter-discordapp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_crush_counter_discordapp() {

	$plugin = new Crush_Counter_Discordapp();
	$plugin->run();

}
run_crush_counter_discordapp();
