<?php 

function create_page($pdf, $mode, $back_image, $addon_image, $addon_title = false, $front_image = '', $exhibitors_logo = false){

    // Załaduj obraz tła
    $background_image = imagecreatefrompng($back_image);
    if (!$background_image) {
        echo '<script>console.log("error bg")</script>';
        return; // Obsługuje błąd w przypadku problemów z obrazem
    }

    if (!empty($front_image)){
        $front_background_image = imagecreatefrompng($front_image);
        if (!$front_background_image) {
            echo '<script>console.log("error bg")</script>';
            return; // Obsługuje błąd w przypadku problemów z obrazem
        }

        if ($mode = "full" && !empty($exhibitors_logo)){
            $exhibitors_logo_image = imagecreatefrompng($exhibitors_logo);
            if (!$exhibitors_logo_image) {
                echo '<script>console.log("error bg")</script>';
                return; // Obsługuje błąd w przypadku problemów z obrazem
            }

            foreach ($addon_image as $title_index => $single_title){

                $start_height = 580 + ($title_index * 1097);

                imagecopyresized(
                    $front_background_image,        // Obraz docelowy
                    $exhibitors_logo_image,      // Obraz źródłowy
                    1300, $start_height,                 // Pozycja docelowa
                    0, 0,                 // Pozycja źródłowa
                    360, 240, // Nowe wymiary
                    300, 200 // Oryginalne wymiary
                );
            }
        }

        $temp_front_path = __DIR__ . '/front.png';
        imagepng($front_background_image, $temp_front_path);

        // Dodaj stronę 
        $pdf->AddPage();
        // Dodaj obraz PNG do PDF (x, y, szerokość, wysokość)
        $pdf->Image($temp_front_path, 11, 10, 0, 0, 'PNG');
    }

    foreach ($addon_image as $addon_index => $single_addon_image){
        // Załaduj obraz QR kodu
        $qr_code_image = imagecreatefrompng($single_addon_image);
        if (!$qr_code_image) {
            echo '<script>console.log("error qr")</script>';
            return; // Obsługuje błąd w przypadku problemów z obrazem
        }

        $start_height = 403 + ($addon_index * 1097);

        imagecopyresized(
            $background_image,
            $qr_code_image,
            1695, $start_height, 
            0, 0,
            420, 420,
            210, 210
        );
        if($mode == "full"){

            $start_height = 400 + ($addon_index * 1097);
            $font_path = __DIR__ . '/Serif.ttf';
            $font_size = 50;

            $bbox = imagettfbbox($font_size, 0, $font_path, $addon_title);
            $start_width = 800 - $bbox[2]/2;

            imagettftext(
                $background_image,                
                $font_size,                              
                0,                                
                $start_width , $start_height,                  
                imagecolorallocate($background_image, 0, 0, 0),
                $font_path,                       
                $addon_title                      
            );
        }
    }

    $temp_file_path = __DIR__ . '/temp_' . uniqid() . '.png';
    imagepng($background_image, $temp_file_path);

    // Dodaj stronę
    $pdf->AddPage();
    // Dodaj obraz PNG do PDF (x, y, szerokość, wysokość)
    $pdf->Image($temp_file_path, 11, 10, 0, 0, 'PNG');

    unlink($temp_file_path);
    
    return;
}

//Add TCPDF class 
require_once(ABSPATH . '/wp-content/plugins/PWElements/assets/tcpdf/tcpdf.php');