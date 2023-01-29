<?php
$check_author_site_name = $wpdb->get_results( 
    $wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s AND post_author = %d", array('yuranNameGroup', $GLOBALS['mypwp_temp_data']['mypwp_user']->ID)) 
);

$check_exist_post_title = $wpdb->get_results( 
    $wpdb->prepare("SELECT ID,post_author FROM {$wpdb->prefix}posts WHERE post_type =%s AND (post_title = %s)", array('yuranNameGroup', wp_strip_all_tags( $_POST['nameGroup'] ))) 
);

$check_exist_site_name = $wpdb->get_results( 
    $wpdb->prepare("SELECT ID,post_author FROM {$wpdb->prefix}posts WHERE post_type =%s AND (post_name = %s)", array('yuranNameGroup', str_replace(' ', '-', strtolower($_POST['sitePageUrl'])))) 
);



$GLOBALS['mypwp_temp_data']['post'] = "brjaya" ;





?>