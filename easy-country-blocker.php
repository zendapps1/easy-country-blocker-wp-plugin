<?php
/*
Plugin Name: Easy Country Blocker
Description: In the online site, the site owner does not want to show his online site in a specific country.  If you are frustrated about receiving fake international orders, then the right solution is here:  Meet the “Easy Country Blocker” Plugin.
Version: 1.0
Author: easycountryblocker
Author URI: https://easycountryblocker.com/
Text Domain: easy-country-blocker
Requires PHP: 5.6
*/


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
    define( 'ECB_PATH', plugin_dir_path( __FILE__ ) ); // Plugin dir
    define( 'ECB_URL', plugin_dir_url( __FILE__ ) ); // plugin url

/**
 * Check WP plugin is active
 *
 * @package Easy Country Blocker
 * 
*/

add_action( 'plugins_loaded', 'ecb_loaded' );

function ecb_loaded()
{
   if ( current_user_can( 'administrator' ) )
   {
    add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ecb_add_action_links' );

    function ecb_add_action_links( $ecbactions ){

        $ecblinks = array(
          '<a href="' . admin_url( 'admin.php?page=ecb-settings' ) . '">Settings</a>',
      );

        $ecbactions = array_merge( $ecbactions, $ecblinks );
        return $ecbactions;
    }

    require( ECB_PATH.'inc/enqueue.php' );

    add_action('admin_menu', 'ecb_admin_add_page');

    function ecb_admin_add_page() {
        global $ecb_options_page;
        $ecb_options_page = add_menu_page(__('Country Blocker Help Tabs', 'easy-country-blocker'), __('Country Blocker', 'easy-country-blocker'), 'manage_options', 'ecb-settings', 'ecb_options_page', ECB_URL. 'assets/img/menu-logo.png');

        add_action("load-$ecb_options_page", 'ecb_plugin_help_tabs');
    }

    require( ECB_PATH.'inc/ecb-help-tab/ecb-help-tab.php' );

    function ecb_options_page(){

      if ( isset($_REQUEST['nonce']) && wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__)))
      { 

        $script_key =  ( !empty( $_POST['ecb_token'] ) ) ? $_POST['ecb_token']  : '';

        $existing_script_key = get_option( 'ecb_script_token' );

        if ( false !== $existing_script_key ) {

            update_option( 'ecb_script_token', $script_key ); 
            echo '<div class="alert alert-success">Country Blocker script token update successfully</div>';
        }else{
            add_option( 'ecb_script_token', $script_key );
            echo '<div class="alert alert-success">Country Blocker token saved successfully</div>';
        }  
    }


    $ecb_script_key = get_option( 'ecb_script_token' );

    if(strlen($ecb_script_key) == 36){

        $btn_txt = __('Country Blocker Dashboard', 'easy-country-blocker');

    }else{

        $btn_txt =  __('Country Blocker Login', 'easy-country-blocker');
    }
    ?>
    <div id="eplp-plugin-container">
        <div class="eplp-head">
            <div class="eplp-head__inside-container">
                <div class="eplp-head__logo-container ">
                    <img class="eplp-head__logo" src="<?php echo esc_url( ECB_URL .'assets/img/blocker-logo.png' ); ?>"/>
                    <p><?php echo esc_html__('Easy Country Blocker', 'easy-country-blocker') ?></p> 
                </div>
            </div>
        </div>

        <div class="eplp-lower">
            <div class="eplp-boxes">
                <div class="eplp-box eplp-config">
                    <div class="centered eplp-box-header">
                        <h2><?php echo esc_html__('Blocks fraud visitors.','easy-country-blocker');?></h2>
                    </div>  
                    <div class="eplp-setup-instructions">

                        <p><?php echo esc_html__('Block fraud visitors accessing your website by Countries, State, VPN, IP`s, Bots and other options to secure your websites.','easy-country-blocker');?></p>

                        <a href="https://test-cb-saas.zend-apps.com/dashboard" target="_blank">
                            <button type="button" class="eplp-button eplp-is-primary">
                                <?php echo esc_html($btn_txt);?>
                            </button>
                        </a>

                    </div>
                </div> 
                <br>
                <div class="eplp-box">
                    <div class="eplp-enter-api-key-box centered">
                        <div class="enter-api-key">
                            <form id="epl_key" method="post">
                                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
                                <p style="width: 100%; display: flex; flex-wrap: nowrap; box-sizing: border-box;">

                                    <input id="key" name="ecb_token" type="text" size="15" value="<?php echo esc_attr($ecb_script_key);?>" placeholder="Enter country blocker Token" class="regular-text code" style="flex-grow: 1; margin-right: 1rem;" maxlength=36>

                                    <input type="submit" name="submit" id="submit" class="eplp-button" value="Save Token">
                                </p>

                            </form>
                        </div>
                    </div>
                </div> 
                <br>
                <div class="eplp-box">
                    <div class="eplp-faq-box">

                        <div class="eplp-box-faq-header">
                            <h3><?php echo esc_html__('FAQ','easy-country-blocker'); ?></h3>
                        </div>

                        <div class="eplp-setup-faq">
                            <a href="<?php echo esc_url('https://zendapps.freshdesk.com/support/solutions/articles/35000213670-how-to-generate-the-country-blocker-token')?> " target="_blank">
                                <?php echo esc_html__('1. How to generate country blocker token?','easy-country-blocker');?></a>


                            </div>

                            <div class="eplp-setup-faq">
                              <a href="<?php echo esc_url('https://zendapps.freshdesk.com/support/solutions/articles/35000213725-how-to-block-fraud-visitors-to-access-your-website')?> " target="_blank">
                                <?php echo esc_html__('2. How to block fraud visitors to access your website? ','easy-country-blocker');?>
                            </a>
                        </div>
                    </div>
                </div> 

            </div>
        </div>
    </div>

    <?php 
    
    require(ECB_PATH.'inc/support/ecb-support.php');
}

// ecb load script
$existing = get_option( 'ecb_script_token' );


if (!empty($existing)) 
{
    function ecb_load_my_scripts()
    {
        $existing = get_option( 'ecb_script_token' );
        wp_enqueue_script('script', 'https://test-cb-saas.zend-apps.com/scripts/wordpress'.'/'.$existing.'.js', null, null);
    }
    add_action('wp_head', 'ecb_load_my_scripts');
}
}
}