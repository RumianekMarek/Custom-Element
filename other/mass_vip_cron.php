<?php

if($argv[1] == 'fM8mYEIEr4HC'){
    if($_SERVER["DOCUMENT_ROOT"] != ""){
        $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
    } else {
        $args_array = explode('wp-content', $argv[0]);
        $new_url = $args_array[0] . '/wp-load.php';
    }
    
    if (file_exists($new_url)) {
        require_once($new_url);
        if (class_exists('GFAPI')) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'mass_exhibitors_invite_query';
            $limit_maili = "100";
            if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") == $table_name) {

                $query = $wpdb->prepare("
                    SELECT id, gf_entry_id 
                    FROM $table_name 
                    WHERE status = %s 
                    ORDER BY id ASC 
                    LIMIT $limit_maili", 'new');

                $results = $wpdb->get_results($query);

                if(count($results) > 0){

                    $form_entry = GFAPI::get_entry($results[0]->gf_entry_id);
                    $form = GFAPI::get_form($form_entry['form_id']);

                    foreach($results as $result){

                        $entry = GFAPI::get_entry($result->gf_entry_id);
                        $send = GFAPI::send_notifications($form, $entry);

                        $wpdb->update(
                            $table_name,
                            array('status' => 'send'),
                            array('id' => $result->id),
                            array('%s'),
                            array('%d')
                        );
                    }
                }
            }
        }
    }
}