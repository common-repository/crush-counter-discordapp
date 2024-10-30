<?php

/**
 * 
 *
 * @link       www.iware.com.br
 * @since      1.0.0
 *
 * @package    Crush_Counter_Discordapp
 * @subpackage Crush_Counter_Discordapp/admin
 */

/**
 * The admin-specific functionality of the plugin. *
 * 
 *
 * @package    Crush_Counter_Discordapp
 * @subpackage Crush_Counter_Discordapp/admin
 * @author     Djavan "Ryuuzaki" Fernando <djavan@crushcounter.com.br>
 */
class Crush_Counter_Discordapp_Admin {

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
	
	private $crush_counter_discordapp_options;
	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->crush_counter_discordapp_options = get_option($this->plugin_name);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Crush_Counter_Discordapp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Crush_Counter_Discordapp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	if ( 'settings_page_crush-counter-discordapp' == get_current_screen() -> id ) {
             // CSS stylesheet for Color Picker
             wp_enqueue_style( 'wp-color-picker' );            
             wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/crush-counter-discordapp-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );
         }

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Crush_Counter_Discordapp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Crush_Counter_Discordapp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	if ( 'settings_page_crush-counter-discordapp' == get_current_screen() -> id ) {
            wp_enqueue_media();   
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/crush-counter-discordapp-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );         
        }

	}
	
	public function add_plugin_admin_menu(){
		
		add_options_page( 'Crush Counter DiscordApp', 'CCN DiscorApp', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
				);
				
		
	}
	
	public function add_action_links( $links ) {
		/*
		 *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		 */
		$settings_link = array(
				'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );
	
	}
	
	public function display_plugin_setup_page() {
		include_once( 'partials/crush-counter-discordapp-admin-display.php' );
	}
	
	
	public function validate($input) {
		// All checkboxes inputs
		$valid = array();
	
		//Cleanup
		$valid['webhook-url'] = esc_url($input['webhook-url']);
		$valid['bot-name'] = sanitize_text_field($input['bot-name']);
		$valid['bot-avatar-id'] = (isset($input['bot-avatar-id']) && !empty($input['bot-avatar-id'])) ? absint($input['bot-avatar-id']) : 0;
		
	
		return $valid;
	}
	
	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
	
	public function bot_post_update( $post_id, $post, $update ) {
		
		
		if ( wp_is_post_revision( $post_id ) )
			return;
		
		if (isset($post->post_status) && 'publish' != $post->post_status) {
			return;
		}
	
		$post_title = get_the_title( $post_id );
		
		$post_url = get_permalink( $post_id );
	
		$this->bot_falar($post_title, $post_url);
	}
	
	private function bot_falar($titulo, $url){
				
		$bot_avatar = wp_get_attachment_image_src($this->crush_counter_discordapp_options['bot-avatar-id'], 'thumbnail');
		$bot_avatar_url = $bot_avatar[0];
		
		if( !isset( $this->crush_counter_discordapp_options['webhook-url'] ) || $this->crush_counter_discordapp_options['webhook-url'] == "" ){
			return;
		}
		$bot = new Crush_Counter_Discordapp_Bot(
				$this->crush_counter_discordapp_options['bot-name'],
				$bot_avatar_url,
				$url,
				$this->crush_counter_discordapp_options['webhook-url']
	
				);
				
		$bot->falar();
		
	}
	
	

}
