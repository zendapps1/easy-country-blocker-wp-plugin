<?php
function ecb_plugin_help_tabs() {
    global $ecb_options_page;
    $screen = get_current_screen();
    if($screen->id != $ecb_options_page)
        return;

    $screen->add_help_tab(array(
        'id' => 'ecb-overview',
        'title' => __('Overview', 'easy-country-blocker'),
        'content' => ecb_help_tab_content('ecb-overview')
    ));
    $screen->add_help_tab(array(
        'id' => 'ecb-setup',
        'title' => __('New to Easy Country Blocker', 'easy-country-blocker'),
        'content' => ecb_help_tab_content('ecb-setup')
    ));

    $screen->add_help_tab(array(
        'id' => 'ecb-key',
        'title' => __('Enter an Country Blocker Token', 'easy-country-blocker'),
        'content' => ecb_help_tab_content('ecb-key')
    ));

    $screen->add_help_tab(array(
        'id' => 'ecb-help',
        'title' => __('Support', 'easy-country-blocker'),
        'content' => ecb_help_tab_content('ecb-help')
    ));
}

function ecb_help_tab_content($tab = 'ecb-overview') {

    if($tab == 'ecb-overview') {
        ob_start(); ?>
        <h3><?php echo esc_html__('Easy Country Blocker', 'easy-country-blocker') ?></h3>
        <p><?php echo esc_html__('Our App blocks fraud visitors so the fraud visitors can`t create any order and you are secure.', 'easy-country-blocker') ?></p>
        <p><b><?php echo esc_html__('Example:', 'easy-country-blocker') ?></b></p>
        <p><?php echo esc_html__('1. Block fraud visitors accessing your store and visible your store only for select.', 'easy-country-blocker') ?></p>
        <p><?php echo esc_html__('2. Redirect blocked country visitors to another URL if you don`t want to display.', 'easy-country-blocker') ?></p>
        <p><?php echo esc_html__('3. Customized settings for blocked pages, Block Bots, Create a blocked IP range.', 'easy-country-blocker') ?>
        </p>

        <p><?php echo esc_html__('4. Avoid unwanted traffic on your store, Password protection on the blocked page.', 'easy-country-blocker') ?>
        </p>

        <p><?php echo esc_html__('3. Restrict & Redirect specific countries from visiting your store, Block Bots, VPN.', 'easy-country-blocker') ?>
        </p>
<?php
return ob_get_clean();
}

elseif ($tab == 'ecb-setup') {
    ob_start(); ?>
    <h3><?php echo esc_html__('Easy Country Blocker setup', 'easy-country-blocker') ?></h3>
    <p><?php echo esc_html__('You need to enter an Product Blocker Token to block the fraud visitors on your site.', 'easy-country-blocker') ?></p>
    <p><?php echo esc_html__('Sign up for an account on', 'easy-country-blocker') ?> <a href="https://test-cb-saas.zend-apps.com/registration" target="_blank"><?php echo esc_html__('Easy Country Blocker', 'easy-country-blocker') ?></a> <?php echo esc_html__('to get an Country Blocker Token.', 'easy-country-blocker') ?></p>
    <?php
    return ob_get_clean();
}
elseif ($tab == 'ecb-key') {
    ob_start(); ?>
    <h3><?php echo esc_html__('Easy Country Blocker setup.', 'easy-country-blocker') ?></h3>
    <p><?php echo esc_html__('If you already have an Country Blocker Token.', 'easy-country-blocker') ?></p>
    <p>
        <?php echo esc_html__('1. Copy and paste the Country Blocker Token into the', 'easy-country-blocker') ?> <b> <?php echo esc_html__('Enter your Country Blocker Token ', 'easy-country-blocker') ?> </b><?php echo esc_html__('text field. ', 'easy-country-blocker') ?></p>
        <p><?php echo esc_html__('2. Click on', 'easy-country-blocker') ?> <b><?php echo esc_html__('Save Country Blocker Token', 'easy-country-blocker') ?></b> <?php echo esc_html__('button.', 'easy-country-blocker') ?></p>
        <?php
        return ob_get_clean();
    }
    elseif ($tab == 'ecb-help') {
        ob_start(); ?>
        <h3><?php _e('For more information', 'easy-country-blocker'); ?></h3>
        <p><a href="https://zendapps.freshdesk.com/support/solutions/folders/35000201743" target="_blank"><?php echo esc_html__('FAQ', 'easy-country-blocker') ?></a></p>
        <p><a href="javascript:void(0)" class="trigger_support"> <?php echo esc_html__('Support', 'easy-country-blocker') ?></a></p>
        <?php
        return ob_get_clean();
    } 
}