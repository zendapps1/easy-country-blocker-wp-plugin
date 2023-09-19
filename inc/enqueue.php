<?php
add_action('admin_enqueue_scripts','ecb_admin_scripts');
function ecb_admin_scripts(){  

wp_enqueue_style('ecbs-admin',ECB_URL.'assets/css/admin.css');

wp_enqueue_script('ecbs-admin',ECB_URL.'assets/js/admin.js');
}