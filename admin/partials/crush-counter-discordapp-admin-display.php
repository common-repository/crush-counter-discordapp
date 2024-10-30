<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.iware.com.br
 * @since      1.0.0
 *
 * @package    Crush_Counter_Discordapp
 * @subpackage Crush_Counter_Discordapp/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <form method="post" name="crush_counter_discordapp_options" action="options.php">
    
    	<?php
	        //Grab all options
	        $options = get_option($this->plugin_name);
	
	        // Cleanup
	        $webhook_url = $options['webhook-url'];
	        $bot_name = $options['bot-name'];	        
	        $bot_avatar_id = isset($options['bot-avatar-id']) ? $options['bot-avatar-id'] : '';
	        $bot_avatar = wp_get_attachment_image_src( $bot_avatar_id, 'thumbnail' );
	        $bot_avatar_url = $bot_avatar[0];
	        
	    ?>
	
	    <?php
	        settings_fields($this->plugin_name);
	        do_settings_sections($this->plugin_name);
	    ?>
    
	    <?php settings_fields($this->plugin_name); ?>
	    
	     <fieldset>
	     	<legend class="screen-reader-text"><span><?php _e('Crush Counter DiscordApp Webhook', $this->plugin_name);?></span></legend>
	        	<label for="<?php echo $this->plugin_name; ?>-cleanup">
	        	 	<span><?php esc_attr_e('URL do Webhook', $this->plugin_name); ?></span> <br />
	                <input class="large-text" type="text" id="<?php echo $this->plugin_name; ?>-webhook-url" name="<?php echo $this->plugin_name; ?>[webhook-url]" value="<?php if(!empty($webhook_url)) echo $webhook_url; ?>" />               
	            </label>
	   
	     	
	        	<label for="<?php echo $this->plugin_name; ?>-bot-name">
	        	 	<span><?php esc_attr_e('Nome do Bot', $this->plugin_name); ?></span> <br />
	                <input class="large-text" type="text" id="<?php echo $this->plugin_name; ?>-bot-name" name="<?php echo $this->plugin_name; ?>[bot-name]" value="<?php if(!empty($bot_name)) echo $bot_name; ?>" />               
	            </label>
	            
	             <fieldset>
                
                <label for="<?php echo $this->plugin_name;?>-bot_avatar">
                    <input type="hidden" id="bot_avatar_id" name="<?php echo $this->plugin_name;?>[bot-avatar-id]" value="<?php echo $bot_avatar_id; ?>" />
                    <input id="upload_bot_avatar_button" type="button" class="button" value="<?php _e( 'Upload Avatar', $this->plugin_name); ?>" />
                    <span><?php esc_attr_e('Bot Avatar', $this->plugin_name);?></span>
                </label>
                <div id="upload_avatar_preview" class="crush-counter-discordapp-upload-preview <?php if(empty($bot_avatar_id)) echo 'hidden'?>">
                    <img src="<?php echo $bot_avatar_url; ?>" />
                    <button id="crush-counter-discordapp-delete_logo_button" class="crush-counter-discordapp-delete-image">X</button>
                </div>
            </fieldset>
	            
	           
	            
	   	</fieldset>
		
		 <?php submit_button(__('Salvar', $this->plugin_name), 'primary','submit', TRUE); ?>
    
    </form>
    
    </div>
