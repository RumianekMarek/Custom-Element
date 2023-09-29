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
    $js_file = plugins_url('jsQR.js', __FILE__);
    $js_version = filemtime(plugin_dir_path(__FILE__) . 'jsQR.js');
    wp_enqueue_script('jsQR', $js_file, array('jquery'), $js_version);

   
    echo '<div id="kamerka-container" class="wpb_column align_center col-lg-8">';
        echo '<button id="camera-start" class="btn">Włącz kamerę</button>';
        echo '<div id="camera-reader" style="display:none;">';
        echo '<button id="switch" class="btn">Przełącz kamerę</button>';
        echo '<video autoplay id="camera"></video>';
        echo '<form id="qr-search" action="" method="post">';
            echo '<input id="qr-code" name="qr-code" value=""></p>';
            echo '<button class="modal-button" id="submit-form" name="submit">Find</button>';
        echo '</form>';
        echo '</div>';
        echo '<p id="form-data"></p>';
    echo '</div>';

    if (isset($_POST["submit"])) {
        $qr_search = $_POST["qr-code"];
        echo '<script>console.log("'.$qr_search.'")</script>';
        $entry_id = preg_replace('/^[A-Za-z]+[0-9]{3}/', '', $qr_search);
        $entry_id = preg_replace('/[Rr][Nn][Dd].*/', '', $entry_id);
        if (class_exists('GFAPI')) {
            $entry = GFAPI::get_entry($entry_id);
            $form = GFAPI::get_form($entry["form_id"]);
            $entry_return = "Kod nie istnieje w aktywnej bazie danych targów.";
            if(is_wp_error($entry) || !$form["is_active"]){
                echo '<script>document.querySelector("#form-data").innerHTML = "'.$entry_return.'";</script>';
            } else {
                $qr_number = (gform_get_meta($entry['id'], "processed_feeds")['qr-code'][0]);
                $qr_meta = 'qr-code_feed_' . $qr_number . '_url';
                $qr_file = gform_get_meta($entry['id'], $qr_meta);
                echo '<script>console.log("'.$qr_file.'")</script>';
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
                    console.log(textContent);

                    let entry_return = '';
                    if("<?php echo $qr_search ?>" === code.data){
                        entry_return = "Nazwa Formularza - <?php echo $form['title'] ?><br> Numer Formularza - <?php echo $entry["form_id"] ?>";
                    }
                    document.querySelector("#form-data").innerHTML = entry_return;
                </script>
            <?php
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
}

// Rejestracja elementu wizualnego
add_action('vc_before_init', 'register_custom_qr_scanner');

// Definicja shortcode do wyświetlenia zawartości elementu
add_shortcode('qr_scanner', 'custom_qr_scanner_output');
?>