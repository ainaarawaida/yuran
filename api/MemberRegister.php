<?php
$GLOBALS['mypwp_temp_data']['submitpost']['error'] = array();


if($_POST['id']){ //update user
    // deb($_POST);exit();

    $args = array(
        'ID'         => $_POST['id'],
        'user_email' => esc_attr( $_POST['memberEmail'] ),
        'display_name' => esc_attr( $_POST['memberFullName'] ),
        'user_registered' => $_POST['memberRegisterDate'], 
    );
    $check = wp_update_user( $args );
    
    if(!$check->errors){
        if($_POST['memberPassword'] != ''){
            wp_set_password( $_POST['memberPassword'], $_POST['id'] );
        }
        
        update_user_meta($_POST['id'], 'memberIc', $_POST['memberIc']) ; 
        update_user_meta($_POST['id'], 'memberTelno', $_POST['memberTelno']) ; 
        update_user_meta($_POST['id'], 'memberId', $_POST['memberId']) ;  
        update_user_meta($_POST['id'], 'groupName', $_POST['groupName']) ;  
        update_user_meta($_POST['id'], 'role', $_POST['memberType']) ;  

        if(get_user_meta( $_POST['id'], 'stageDaftar', true ) < 3){
            update_user_meta($_POST['id'], 'stageDaftar', 3) ;  
        } 
        
        
        $GLOBALS['mypwp_temp_data']['submitpost']['id'] = $_POST['id'] ;
    }else{
        $GLOBALS['mypwp_temp_data']['submitpost']['error'][] = array( "emel"=> "Emel ini telah digunakan") ; 
    }


}else{  //insert user
    if($_POST['memberPassword'] === ""){
        $random_password = wp_generate_password( 12, false );
         $check = wp_create_user( $_POST['memberEmail'] , $random_password, $_POST['memberEmail'] );
          if(!$check->errors){
           wp_new_user_notification( $check, $random_password);
          }
         
    }else{
       $check = wp_create_user( $_POST['memberEmail'] , $_POST['memberPassword'], $_POST['memberEmail'] );
    }
    
    
    if(!$check->errors){
        $args = array(
            'ID'         => $check,
            'display_name' => esc_attr( $_POST['memberFullName'] ),
            'user_registered' => $_POST['memberRegisterDate'], 
        );
        $check = wp_update_user( $args );
    
        update_user_meta($check, 'memberIc', $_POST['memberIc']) ; 
        update_user_meta($check, 'memberTelno', $_POST['memberTelno']) ; 
        update_user_meta($check, 'stageDaftar', 0) ; 
        update_user_meta( $check, 'role', $_POST['memberType'] );
        update_user_meta( $check, 'groupName', $_POST['groupName'] );
        update_user_meta( $check, 'groupId', $_POST['groupId'] );
        if($_POST['memberId'] == ""){
            $_POST['memberId'] = $check ;
        }
        update_user_meta( $check, 'memberId', $_POST['memberId'] );
        if(get_user_meta( $check, 'stageDaftar', true ) < 3){
            update_user_meta($check, 'stageDaftar', 3) ;  
        } 
    
    
         $GLOBALS['mypwp_temp_data']['submitpost']['id'] = $check ;
     
        
    }else{
         $GLOBALS['mypwp_temp_data']['submitpost']['error'][] = array( "emel"=> "Email already in used") ; 
    }
    
    

}


if(get_user_meta( $GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', true ) < 3){
    update_user_meta($GLOBALS['mypwp_temp_data']['mypwp_user']->ID, 'stageDaftar', 3) ;  
    $GLOBALS['mypwp_temp_data']['mypwp_user']->stageDaftar = 3 ;
} 









?>