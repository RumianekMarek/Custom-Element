<?php
    function custom_media_submenu() {
        add_submenu_page(
            'upload.php',
            'Brakujące znaczniki',
            'Brakujące znaczniki',
            'manage_options',
            'my-custom-submenu-page',
            'custom_media_submenu_callback' ); 
    }
    add_action('admin_menu', 'custom_media_submenu');
    
    function custom_media_submenu_callback() {
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h1>Dodawanie brakujących elementów do mediów</h1>';
        echo '</div>';
    }      
?>