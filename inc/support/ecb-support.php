<?php 
$current_user = wp_get_current_user();
wp_enqueue_script( 'ecb-support-script', ECB_URL.'assets/js/support.js', array('jquery'), false, true );
wp_localize_script( 'ecb-support-script', 'ecb_support',
    array( 
        'subject' => $current_user->user_url,
        'name'  => $current_user->display_name. ' (wordpress)',
        'email' => $current_user->user_email,
    )
);
?>
<script>
    window.fwSettings={
        'widget_id':35000001127
    };
    !function(){if("function"!=typeof window.FreshworksWidget){var n=function(){n.q.push(arguments)};n.q=[],window.FreshworksWidget=n}}()
</script>
<script type='text/javascript' src='https://widget.freshworks.com/widgets/35000001127.js' async defer></script>

<script>

    jQuery(document).find(".trigger_support").on("click", function() {
        jQuery("#launcher-frame").contents().find(".launcher-button.elements__Wrapper-sc-4gy1pz-0.blzvQB").click();
    });

</script>

