<?php 
//Add TCPDF class 
require_once(ABSPATH . '/wp-content/plugins/PWElements/assets/tcpdf/tcpdf.php');

//Create PDF file from png file, and add defoult_page as back page if available
function generate_pdf_from_png($image_path, $output_path, $defoult_page = '') {
    // Utwórz nowy obiekt TCPDF
    $pdf = new TCPDF();

    // Dodaj stronę
    $pdf->AddPage();
    // Dodaj obraz PNG do PDF (x, y, szerokość, wysokość)
    $pdf->Image($image_path, 11, 10, 0, 0, 'PNG');

    if ($defoult_page){
        // Dodaj stronę 
        $pdf->AddPage();
        // Dodaj obraz PNG do PDF (x, y, szerokość, wysokość)
        $pdf->Image($defoult_page, 11, 10, 0, 0, 'PNG');
    }

    // Zapisz plik PDF na serwerze
    $pdf->Output($output_path, 'F');
}

//Check if GD method is available
if (!extension_loaded('gd')) {
    echo '<script>console.log("GD picture edytor - nie dostepne")</script>';
    exit;
}

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
        // $zip_class__qr_download = new ZipArchive();
        // if($zip_class__qr_download->open($full_zip_path, ZipArchive::CREATE) === TRUE){
            
            // Załaduj obraz tła
            $defoult_page = ABSPATH . 'doc/qr-przod.png';
            $background_image_path = ABSPATH . 'doc/qr-tyl.png';
            if (is_wp_error($background_image)) {
                return; // Obsługuje błąd w przypadku problemów z obrazem
            }

            $temp_file_path = $upload_path__custom_element. 'zaproszenie.png';
            $qr_count = 0;
            $file_count = 0;
            //Add all qr_code_url images to zip file 

            foreach ($all_qr_urls as $qr_url) {                    
                // Załaduj obraz QR kodu
                $qr_code_image_path = str_replace('https://mr.glasstec.pl/', ABSPATH, $qr_url);
                if (is_wp_error($qr_code_image_path)) {
                    return;
                }

                // Załaduj obraz tła
                $background_image = imagecreatefrompng($background_image_path);
                if (!$background_image) {
                    echo '<script>console.log("error bg")</script>';
                    return; // Obsługuje błąd w przypadku problemów z obrazem
                }

                // Załaduj obraz QR kodu
                $qr_code_image = imagecreatefrompng($qr_code_image_path);
                if (!$qr_code_image) {
                    echo '<script>console.log("error qr")</script>';
                    return; // Obsługuje błąd w przypadku problemów z obrazem
                }
                $end_width = 403 + ($qr_count * 1097);

                imagecopyresized(
                    $background_image,        // Obraz docelowy
                    $qr_code_image,      // Obraz źródłowy
                    1695, $end_width,                 // Pozycja docelowa
                    0, 0,                 // Pozycja źródłowa
                    420, 420, // Nowe wymiary
                    210, 210 // Oryginalne wymiary
                );

                // Zapisz wynikowy obraz do tymczasowego pliku
                
                imagepng($background_image, $temp_file_path);
                
                $background_image_path = $temp_file_path;
                $qr_count++;
                if($qr_count == 3){
                    $qr_count= 0;
                    $file_count++;

                    $pdf_file_path = $upload_path__custom_element . $file_count . 'zaproszenie.pdf';
                    generate_pdf_from_png($background_image_path, $pdf_file_path, $defoult_page);

                    $background_image_path = ABSPATH . 'doc/qr-tyl.png';

                    continue;
                } 
            }
            $file_count++;
            $pdf_file_path = $upload_path__custom_element . $file_count . 'zaproszenie.pdf';
            generate_pdf_from_png($background_image_path, $pdf_file_path, $defoult_page);
            unlink($temp_file_path);
            // $zip_class__qr_download->close();
            
        // }
        
        // //Check if zip file was created
        // if (file_exists($temp_file_path)) {

        //     ob_clean();
        //     flush();

        //     //Download zip file to local pc.
        //     header('Content-Type: application/zip');
        //     header('Content-Disposition: attachment; filename="' . basename($temp_file_path) . '"');
        //     header('Content-Length: ' . filesize($temp_file_path));
        //     readfile($temp_file_path);

        //     //Delet file after download.
        //     unlink($full_zip_path);
        //     exit;
        // } else {
        //     echo "Plik ZIP nie istnieje.";
        // }
    }        
}, 10, 3);
