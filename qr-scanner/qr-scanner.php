<?php
function register_custom_qr_scanner() {
    vc_map(array(
        'name' => __('QR Scanner', 'my-custom-plugin'),
        'base' => 'qr_scanner',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(),
    ));
}

function custom_qr_scanner_output() {
    // Dołączanie skryptu JavaScript
    var_dump('user- '.$_SERVER['HTTP_USER_AGENT']);
    $js_file = plugins_url('jsQR.js', __FILE__);
    $js_version = filemtime(plugin_dir_path(__FILE__) . 'jsQR.js');
    wp_enqueue_script('jsQR', $js_file, array('jquery'), $js_version);

    $dom_output = '<div id="kamerka-container" class="wpb_column align_center col-lg-8">';
    $dom_output .= '<button id="camera-start" class="btn">Włącz kamerę</button>';
    $dom_output .= '<div id="camera-reader" style="display:none;">';
        $dom_output .= '<button id="switch" class="btn">Przełącz kamerę</button>';
        $dom_output .= '<video autoplay id="camera"></video>';
        $dom_output .= '<form id="qr-search" action="" method="post">';
            $dom_output .= '<input id="qr-code" name="qr-code" value="">';
            $dom_output .= '<button class="modal-button" id="submit-form" name="submit">Find</button>';
        $dom_output .= '</form>';
    $dom_output .= '</div>';

    if (isset($_POST["submit"])) {

        $qr_search = $_POST["qr-code"];
        $entry_id = preg_replace('/^[A-Za-z]+[0-9]{3}/', '', $qr_search);
        $entry_id = preg_replace('/[Rr][Nn][Dd].*/', '', $entry_id);
        if (class_exists('GFAPI')) {

            $entry = GFAPI::get_entry($entry_id);
            $entry_return = "Kod nie istnieje w aktywnej bazie danych targów.";
            if(is_wp_error($entry)){
                $dom_output .= '<p id="form-data">'.$entry_return.'</p>';
            } else {
                $form = GFAPI::get_form($entry["form_id"]);
                if($form["is_active"]){
                    $qr_number = (gform_get_meta($entry['id'], "processed_feeds")['qr-code'][0]);
                    $qr_meta = 'qr-code_feed_' . $qr_number . '_url';
                    $qr_file = gform_get_meta($entry['id'], $qr_meta);
                    echo '<div class="wpb_column align_center col-lg-4"><img class="qr-image" src="'.$qr_file.'"></div>';
                    ?>
                    
                    <script src="/wp-content/plugins/custom-element/qr-scanner/jsQR.js"></script>
                    <script>
                        var isWpError = <?php echo is_wp_error($entry) ? 'true' : 'false'; ?>;
                        var isFormActive = <?php echo !$form["is_active"] ? 'true' : 'false'; ?>;
                        document.querySelector('.qr-image').src = "<?php echo $qr_file ?>";

                        // Pobierz elementy HTML
                        const qrImage = document.querySelector(".qr-image");
                        const entryDisplay = document.querySelector("#form-data");
                        // Utwórz canvas i skopiuj grafikę na canvas
                        const canvas = document.createElement("canvas");
                        const context = canvas.getContext("2d");
                        canvas.width = qrImage.width;
                        canvas.height = qrImage.height;
                        context.drawImage(qrImage, 0, 0);
                        // Skanuj kod QR z obrazu na canvas
                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                        const code = jsQR(imageData.data, canvas.width, canvas.height);
                        qrImage.style.display="none";
                        if (code) {
                            textContent = "Numer QR kodu: " + code.data;
                        } else {
                            textContent = "Nie wykryto kodu QR.";
                        }
                        let entry_return = '';
                        if("<?php echo $qr_search ?>" === code.data){
                            <?php $dom_output .= '<p id="form-data">Nazwa Formularza - "'.$form['title'].'"<br> Numer Formularza - "'.$entry['form_id'] .'"</p>'; ?>
                        }
                    </script>
                <?php
                }
            }
        }
    }

    $js_file = plugins_url('qr-scanner.js', __FILE__);
    $js_version = filemtime(plugin_dir_path(__FILE__) . 'qr-scanner.js');
    wp_enqueue_script('qr_scanner', $js_file, array('jquery'), $js_version);

    // Dołączanie stylu CSS
    $css_file = plugins_url('qr-scanner.css', __FILE__);
    $css_version = filemtime(plugin_dir_path(__FILE__) . 'qr-scanner.css');
    wp_enqueue_style('qr_scanner', $css_file, array(), $css_version);

    $dom_output .= '</div>';

    return $dom_output;
    
}

// Rejestracja elementu wizualnego
add_action('vc_before_init', 'register_custom_qr_scanner');

// Definicja shortcode do wyświetlenia zawartości elementu
add_shortcode('qr_scanner', 'custom_qr_scanner_output');
?>