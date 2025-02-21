<?php

if (!session_id()) {
    session_start();
}

add_action('wp_login', function($user_login, $user) {   
    if ($user->user_email == 'marek.rumianek+1@warsawexpo.eu') {

        if (get_role('logotype_edytor')) {
            remove_role('logotype_edytor');
        }

        add_role('logotype_edytor', 'Edytor Logotypów', [
            'read' => true,
            'edit_posts' => false,
            'upload_files' => true,
        ]);

        $user->set_role('logotype_edytor');
        $_SESSION['role_debug'] = $user;
    }
}, 10, 2);

add_action('admin_menu', function() {
    if (current_user_can('logotype_edytor')) {
        global $menu;
        
        if (!isset($menu) || !is_array($menu)) {
            return;
        }
    
        $dozwolone = ['pwe-elements'];
    
        foreach ($menu as $key => $item) {
            if (!isset($item[2]) || !in_array($item[2], $dozwolone)) {
                $_SESSION['menu1'][] = $item[2];
                unset($menu[$key]);
            }
        }
    }
}, 999);

// var_dump($_SESSION['menu1']);