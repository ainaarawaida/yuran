<?php

$GLOBALS['mypwp_temp_data']['submitpost']['error'] = array();

if($_POST['groupId'] && $_POST['groupId'] != ''){
    $check_author_site_name[0] = new stdClass();
    $check_author_site_name[0]->ID = $_POST['groupId'] ; 
    $check_author_site_name[0]->post_title = $_POST['groupName'] ; 
    $check_author_site_name[0]->post_name = $_POST['sitePageUrl'] ; 

    $check_exist_post_title = true;
    $check_exist_site_name = true;

}else{
    $check_author_site_name = $wpdb->get_results( 
        $wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s AND post_author = %d", array('yuranGroupName', $GLOBALS['mypwp_temp_data']['mypwp_user']->ID)) 
    );
    
    $check_exist_post_title = $wpdb->get_results( 
        $wpdb->prepare("SELECT ID,post_author FROM {$wpdb->prefix}posts WHERE post_type =%s AND (post_title = %s)", array('yuranGroupName', wp_strip_all_tags( $_POST['groupName'] ))) 
    );
    
    $check_exist_site_name = $wpdb->get_results( 
        $wpdb->prepare("SELECT ID,post_author FROM {$wpdb->prefix}posts WHERE post_type =%s AND (post_name = %s)", array('yuranGroupName', str_replace(' ', '-', strtolower($_POST['sitePageUrl'])))) 
    );
    

}




// deb($check_author_site_name);
// deb($check_exist_post_title);
// deb($check_exist_site_name);
// exit();

$my_post = array(
    'post_title'    => wp_strip_all_tags( $_POST['groupName'] ),
    'post_content'  => '',
    'post_status'   => 'publish',
    'post_author'   => $GLOBALS['mypwp_temp_data']['mypwp_user']->ID,
    'post_type' => 'yuranGroupName',
    'post_name' => $_POST['sitePageUrl']
);

if(!$check_author_site_name && !$check_exist_post_title && !$check_exist_site_name){
    $my_post['ID'] =  wp_insert_post( $my_post );
    update_post_meta($my_post['ID'], 'groupAddress', $_POST['groupAddress']) ; 
    if(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) < 1){
        update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', 1) ; 
    } 
   
    update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'groupId', $my_post['ID']) ; 
}
if(!$check_author_site_name && !$check_exist_post_title && $check_exist_site_name){
     $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['sitePageUrl'] = 'Site URL already exists' ; 
}
if(!$check_author_site_name && $check_exist_post_title && !$check_exist_site_name){
    $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['groupName'] = 'Name Group already exists' ; 
}
 if(!$check_author_site_name && $check_exist_post_title && $check_exist_site_name){
   
     $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['groupName'] = 'Name Group already exists' ; 
     $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['sitePageUrl'] = 'Site URL already exists' ; 
}
 if($check_author_site_name && !$check_exist_post_title && !$check_exist_site_name){
    $my_post['ID'] = $check_author_site_name[0]->ID;
   
    wp_update_post( $my_post );
    update_post_meta($my_post['ID'], 'groupAddress', $_POST['groupAddress']) ; 
    update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', 1) ; 
    update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'groupId', $my_post['ID']) ; 
}
 if($check_author_site_name && !$check_exist_post_title && $check_exist_site_name){
        $my_post['ID'] = $check_author_site_name[0]->ID;
    if($check_author_site_name[0]->post_name ===  str_replace(' ', '-', strtolower($_POST['sitePageUrl']))){
        
        wp_update_post( $my_post );
        update_post_meta($my_post['ID'], 'groupAddress', $_POST['groupAddress']) ; 
        if(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) < 1){
            update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', 1) ; 
        } 
        update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'groupId', $my_post['ID']) ; 
    }else{
        
        $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['sitePageUrl'] = 'Site URL already exists' ; 
    }

}
if($check_author_site_name && $check_exist_post_title && !$check_exist_site_name){
      $my_post['ID'] = $check_author_site_name[0]->ID;
       if($check_author_site_name[0]->post_title ===  wp_strip_all_tags( $_POST['groupName'] ) ){
          
            wp_update_post( $my_post );
            update_post_meta($my_post['ID'], 'groupAddress', $_POST['groupAddress']) ; 
            if(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) < 1){
                update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', 1) ; 
            } 
            update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'groupId', $my_post['ID']) ; 
        }else{
            
            $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['groupName'] = 'Name Group already exists' ;
             
        }

}
if($check_author_site_name && $check_exist_post_title && $check_exist_site_name){
      $my_post['ID'] = $check_author_site_name[0]->ID;
    if($check_author_site_name[0]->post_name ===  str_replace(' ', '-', strtolower($_POST['sitePageUrl']))){
        if($check_author_site_name[0]->post_title ===  wp_strip_all_tags( $_POST['groupName'] ) ){
            
            wp_update_post( $my_post );
            update_post_meta($my_post['ID'], 'groupAddress', $_POST['groupAddress']) ;  
            if(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) < 1){
                update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', 1) ; 
            } 
            update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'groupId', $my_post['ID']) ; 
        }else{
            
            $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['groupName'] = 'Name Group already exists' ; 
        }
    }else{
       
        $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['sitePageUrl'] = 'Site URL already exists' ; 
        if($check_author_site_name[0]->post_title !==  wp_strip_all_tags( $_POST['groupName'] ) ){
            $GLOBALS['mypwp_temp_data']['submitpost']['error'][]['groupName'] = 'Name Group already exists' ; 
        }
    }


   

}

if($my_post['ID'] && count($GLOBALS['mypwp_temp_data']['submitpost']['error']) == 0){
    $GLOBALS['mypwp_temp_data']['submitpost']['groupId'] = $my_post['ID'] ;
    if(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) < 1){
        $GLOBALS['mypwp_temp_data']['mypwp_user']->stageDaftar = 1 ; 
    }  
    $GLOBALS['mypwp_temp_data']['mypwp_user']->groupId = $my_post['ID'] ; 
    $GLOBALS['mypwp_temp_data']['mypwp_user']->groupName = $_POST['groupName'] ; 
    $GLOBALS['mypwp_temp_data']['mypwp_user']->groupAddress = $_POST['groupAddress'] ; 
    $GLOBALS['mypwp_temp_data']['mypwp_user']->sitePageUrl = $_POST['sitePageUrl'] ; 
}







?>