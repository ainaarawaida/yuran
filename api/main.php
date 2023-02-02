<?php

add_action( 'rest_api_init', 'mypwp_check_user');
function mypwp_check_user(){
   
    global $wpdb ; 
    if(wp_get_current_user()->ID == 0 ){
        //pentadbir1@demo.pentadbir1  
        //pentadbir1password
        $user = get_user_by('email', 'pentadbir1@demo.pentadbir1');
        $GLOBALS['mypwp_temp_data']['mypwp_user'] = $user; //<- production
    }else{
        $GLOBALS['mypwp_temp_data']['mypwp_user'] = wp_get_current_user(); //<- production
    }
    
    $GLOBALS['mypwp_temp_data']['mypwp_user']->role = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'role', true ) ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->stageDaftar = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->groupId = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'groupId', true ) ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->groupName = get_post($GLOBALS['mypwp_temp_data']['mypwp_user']->groupId)->post_title ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->groupAddress = get_post_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->groupId, 'groupAddress', true ) ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->sitePageUrl = get_post($GLOBALS['mypwp_temp_data']['mypwp_user']->groupId)->post_name ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->memberIc = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'memberIc', true ) ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->memberTelno = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'memberTelno', true ) ;
    $GLOBALS['mypwp_temp_data']['mypwp_user']->memberId = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'memberId', true ) ;
    
   
    
    // if($_POST['action'] && $_POST['action'] === 'GetUserData'){
    //     if(wp_get_current_user()->ID == 0 ){
    //         //pentadbir1@demo.pentadbir1  
    //         //pentadbir1password
    //         $user = get_user_by('email', 'pentadbir1@demo.pentadbir1');
    //         $GLOBALS['mypwp_temp_data']['mypwp_user'] = $user; //<- production
    //     }else{
    //         $GLOBALS['mypwp_temp_data']['mypwp_user'] = wp_get_current_user(); //<- production
    //     }
    //     $GLOBALS['mypwp_temp_data']['mypwp_user']->role = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'role', true ) ;
    //     $GLOBALS['mypwp_temp_data']['mypwp_user']->stageDaftar = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) ;
    //     $GLOBALS['mypwp_temp_data']['mypwp_user']->groupId = get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'groupId', true ) ;
    //     $GLOBALS['mypwp_temp_data']['mypwp_user']->groupName = get_post($GLOBALS['mypwp_temp_data']['mypwp_user']->groupId)->post_title ;
    //     $GLOBALS['mypwp_temp_data']['mypwp_user']->groupAddress = get_post_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->groupId, 'groupAddress', true ) ;
    //     $GLOBALS['mypwp_temp_data']['mypwp_user']->sitePageUrl = get_post($GLOBALS['mypwp_temp_data']['mypwp_user']->groupId)->post_name ;
    



    // }else
    if($_POST['action'] && $_POST['action'] === 'GetLogoutLink'){
        $logout_url = wp_logout_url( get_permalink() );
        $GLOBALS['mypwp_temp_data']['logout_url'] = $logout_url ;
    }else
    if($_POST['action'] && $_POST['action'] === 'GroupRegister'){
        require_once MYPLUGINWP_PATH . 'api/GroupRegister.php' ;
        
    }else
    if($_POST['action'] && $_POST['action'] === 'ProfileRegister'){
        require_once MYPLUGINWP_PATH . 'api/ProfileRegister.php' ;
        
    }else
    if($_POST['action'] && $_POST['action'] === 'MemberRegister'){
        require_once MYPLUGINWP_PATH . 'api/MemberRegister.php' ;
    }else
    if($_POST['action'] && $_POST['action'] === 'MemberList'){
        require_once MYPLUGINWP_PATH . 'api/MemberList.php' ;
    }else
    if($_POST['action'] && $_POST['action'] === 'GetMemberRegister'){
        require_once MYPLUGINWP_PATH . 'api/GetMemberRegister.php' ;
    }
    
    
    // deb($_POST);exit();
  


  

    


    
    // //http://demo.test/wp-json/jwt-auth/data
    // register_rest_route( 'jwt-auth', '/data', array(
    //     'methods' => 'POST',
    //     'callback' => 'mypwp_check_user_callback'
    // ));
    

    //http://demo.test/wp-json/api/v1/data
    register_rest_route( 'api/v1', '/data', array(
        'methods' => 'POST',
        'callback' => 'mypwp_check_user_callback'
    ));



}

function mypwp_check_user_callback(){
    return json_encode($GLOBALS['mypwp_temp_data']); 
}

?>