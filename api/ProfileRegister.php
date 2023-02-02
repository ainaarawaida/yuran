<?php
$GLOBALS['mypwp_temp_data']['submitpost']['error'] = array();



$args = array(
    'ID'         => $GLOBALS['mypwp_temp_data']['mypwp_user']->ID,
    'user_email' => esc_attr( $_POST['profileEmail'] ),
    'display_name' => esc_attr( $_POST['profileFullName'] ),
    'user_registered' => $_POST['profileRegisterDate'], 
);
$check = wp_update_user( $args );

if(!$check->errors){
    if($_POST['profilePassword'] != ''){
        wp_set_password( $_POST['profilePassword'], $GLOBALS['mypwp_temp_data']['mypwp_user']->ID );
    }
    if(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) < 2){
        update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', 2) ; 
    } 
   
    update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'memberIc', $_POST['profileIc']) ; 
    update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'memberTelno', $_POST['profileTelno']) ; 
    update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'memberId', $_POST['profileMemberId']) ;  
    update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'groupName', $_POST['groupName']) ;  
    
    if(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) < 2){
        $GLOBALS['mypwp_temp_data']['mypwp_user']->stageDaftar = 2 ;
    } 
    $GLOBALS['mypwp_temp_data']['mypwp_user']->memberIc = $_POST['profileIc'] ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->memberTelno = $_POST['profileTelno'] ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->memberId = $_POST['profileMemberId'] ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->groupName = $_POST['groupName'] ;
}else{
    $GLOBALS['mypwp_temp_data']['submitpost']['error'][] = array( "emel"=> "Emel ini telah digunakan") ; 
}


// deb(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ));exit();









?>