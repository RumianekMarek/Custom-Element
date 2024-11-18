<?php 

// Check if user is editing form entries
if(isset($_GET['page']) && $_GET['page'] == 'gf_entries'){    

    // Add QR Download as an action to bulk menu
    add_filter( 'gform_entry_list_bulk_actions', function( $actions, $form_id ){
        $actions = array_merge(['bulk_entries_qr_downlod' => 'QR Download'], $actions);
        return $actions;
    }, 10, 2 );


    add_action('gform_entry_list_action', function($action, $entries, $form_id) {
        //Check for "bulk_entries_qr_downlod" select from bulk menu 
        if ($action == 'bulk_entries_qr_downlod') {

            // Get qr_feed to find qr_code_url file
            $qr_feeds = GFAPI::get_feeds(NULL, $form_id);
            $all_qr_urls = array();

            //Create array with all file urls for qr Codes
            foreach ($entries as $entry) {
                //Check all feeds, there can by more then one for every form.
                //Only one will by good for QR Code meta data "gform_get_meta($entry, 'qr-code_feed_$feed_url)".
                foreach ($qr_feeds as $feed) {
                    $qr_code_url = gform_get_meta($entry, 'qr-code_feed_' . $feed['id'] . '_url');
                    if ($qr_code_url != ''){
                        $all_qr_urls[] = $qr_code_url;
                        break;
                    }
                }
            }

            // Create upload path for zip file
            $upload_path__custom_element = ABSPATH . 'wp-content/uploads/custom-element/';
            if (!file_exists($upload_path__custom_element)) {
                mkdir($upload_path__custom_element, 0755, true);
            }
            $zip_file_name = 'qr-downloads.zip';
            $full_zip_path = $upload_path__custom_element . $zip_file_name;

            // Create Zip File
            $zip_class__qr_download = new ZipArchive();
            if($zip_class__qr_download->open($full_zip_path, ZipArchive::CREATE) === TRUE){

                //Add all qr_code_url images to zip file 
                foreach($all_qr_urls as $qr_url){ 

                    //Get original name of the QR code image                
                    $in_zip_file_name = 'all-qr_codes/' . basename($qr_url);

                    //Add image file content to zip file
                    $file_content = file_get_contents($qr_url);
                    $zip_class__qr_download->addFromString($in_zip_file_name, $file_content);
                }

                $zip_class__qr_download->close();
            }
            
            //Check if zip file was created
            if (file_exists($full_zip_path)) {

                ob_clean();
                flush();

                //Download zip file to local pc.
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . basename($full_zip_path) . '"');
                header('Content-Length: ' . filesize($full_zip_path));
                readfile($full_zip_path);

                //Delet file after download.
                unlink($full_zip_path);
                exit;
            } else {
                echo "Plik ZIP nie istnieje.";
            }
        }        
    }, 10, 3);
}