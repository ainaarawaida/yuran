<?php

// deb($_POST);exit();
$getMemberList = $wpdb->get_results( 
    $wpdb->prepare("
    SELECT 
    a.ID, 
    memberId.meta_value as memberId, 
    a.display_name as memberFullName,
    memberIc.meta_value as memberIc, 
    groupName.meta_value as groupName,
    memberTelno.meta_value as memberTelno,
    stageDaftar.meta_value as stageDaftar,
    a.user_registered as memberRegisterDate, 
    a.user_email as memberEmail,
    role.meta_value as role,
    groupId.meta_value as groupId
   
    FROM {$wpdb->prefix}users a 
    LEFT JOIN 
    (SELECT user_id, meta_value FROM {$wpdb->prefix}usermeta WHERE meta_key = 'groupId' ) groupId 
    ON a.ID = groupId.user_id
    LEFT JOIN 
    (SELECT user_id, meta_value FROM {$wpdb->prefix}usermeta WHERE meta_key = 'memberId' ) memberId 
    ON a.ID = memberId.user_id

    LEFT JOIN 
    (SELECT user_id, meta_value FROM {$wpdb->prefix}usermeta WHERE meta_key = 'memberIc' ) memberIc 
    ON a.ID = memberIc.user_id

    LEFT JOIN 
    (SELECT user_id, meta_value FROM {$wpdb->prefix}usermeta WHERE meta_key = 'groupName' ) groupName 
    ON a.ID = groupName.user_id

    LEFT JOIN 
    (SELECT user_id, meta_value FROM {$wpdb->prefix}usermeta WHERE meta_key = 'memberTelno' ) memberTelno 
    ON a.ID = memberTelno.user_id

    LEFT JOIN 
    (SELECT user_id, meta_value FROM {$wpdb->prefix}usermeta WHERE meta_key = 'stageDaftar' ) stageDaftar 
    ON a.ID = stageDaftar.user_id

    LEFT JOIN 
    (SELECT user_id, meta_value FROM {$wpdb->prefix}usermeta WHERE meta_key = 'role' ) role 
    ON a.ID = role.user_id
   
    WHERE 
    groupId.meta_value = '{$GLOBALS['mypwp_temp_data']['mypwp_user']->groupId}'
    ") 
);


$GLOBALS['mypwp_temp_data']['submitpost']['getMemberList'] = $getMemberList ;








?>