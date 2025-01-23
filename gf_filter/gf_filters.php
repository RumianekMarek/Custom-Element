<?php 

// if(is_admin()){
//     // Bulk action to download QR Codes for entries screen
//     if(isset($_GET['page']) && $_GET['page'] == 'gf_entries'){
//         $bulk_file = plugin_dir_path(__FILE__) . 'gf_bulk_action_qr_download.php';
    
//         if(file_exists($bulk_file)){
//             require_once $bulk_file;
//         } else {
//             echo '<script>console.log("file -> '.$bulk_file.' don\'t exists")</script>';
//         }
//     }

//     // //Hide Qr_code_field in form edit page
//     // if(isset($_GET['page']) && $_GET['page'] == 'gf_edit_forms'){
//     //     add_filter('gform_form_post_get_meta', function($form) {
//     //         foreach ($form['fields'] as $key => $field) {
//     //             if (in_array($field->inputName, ['pwe_qr_code', 'pwe_qr_code_file_path'])) {
//     //                 unset($form['fields'][$key]);
//     //             }
//     //         }
//     //         return $form;
//     //     });
//     // }

//     // Add PWE QR code fields for every new form
//     add_action('gform_after_save_form', function($form, $is_new) {
//         $qr_field_file = plugin_dir_path(__FILE__) . 'gf_filter_qr_field_add.php';
        
//         if(file_exists( $qr_field_file)){
//             require_once  $qr_field_file;
//         } else {
//             error_log('File ' . $qr_field_file . ' does not exist.');
//         }
//     }, 10, 2);
// }

// Action to populate Qr code table
// add_action('gform_after_submission', function($entry, $form) {
//     $qr_field_file = plugin_dir_path(__FILE__) . 'pwe_qr_code_table.php';
    
//     if(file_exists( $qr_field_file)){
//         require_once  $qr_field_file;
//     } else {
//         error_log('File ' . $qr_field_file . ' does not exist.');
//     }

//     return $form;
// }, 10, 2);
