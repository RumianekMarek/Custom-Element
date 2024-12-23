<?php 

function elements_voucher_gen() {
    vc_map(array(
        'name' => __('Voucher Generator', 'my-custom-plugin'),
        'base' => 'elements_voucher_gen',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array( 
            array(
                'type' => 'textfield',
                'group' => 'PWE Element',
                'heading' => __('Insert Vouchers Form ID', 'my-custom-plugin'),
                'param_name' => 'form_id__voucher_gen',
                'save_always' => true,
                'value' => '',
            ),
        ),
    ));
}

function voucher_gen_output($atts) {
    $output = '';
    
    if (empty($atts['form_id__voucher_gen'])){
        return '<h4>Formularz nie jest podpięty, proszę o kontakt z web developerami</h4>';
    }

    if(!empty($_GET['token']) && $_GET['token'] == 'merge'){
        $output .= '
        <style>
            input[type="file"] {
                width: 100% !important;
            }
        </style>

        <div class="mass-main-container">
            <div class="form_side" style="width: 50%; min-width:400px;" >
                <form class="form__voucher_gen" action="" method="POST" enctype="multipart/form-data">
                    <label>Zamieść zamieść pierwszy plik pdf do połączenia</label><br>
                    <input type="file" id="front_upload__voucher_gen" name="front_upload" accept=".pdf" /><br><br>

                    <label>Zamieść zamieść drugi plik pdf do połączenia</label><br>
                    <input type="file" id="back_upload__voucher_gen" name="back_upload" accept=".pdf" /><br><br>

                    <button class="btn" id="merge-form__voucher_gen" name="merge-form__voucher_gen" type="submit">Generuj</button>
                </form>
            </div>
            <div class="display_side">
            </div>
        </div>';
    } else {
        $output .= '
        <style>
            input[type="file"] {
                width: 100% !important;
            }
        </style>

        <div class="mass-main-container">
            <div class="form_side" style="width: 50%; min-width:400px;" >
                <form class="form__voucher_gen" action="" method="POST" enctype="multipart/form-data">
                    <label>Wybierz Moduł</label><br>
                    <select id="module__voucher_gen" name="module">
                        <option value="">Wybierz</option>
                        <option value="qr_only">Tylko kod QR</option>
                        <option value="full">kod QR, Nazwa Firmy, Logo Firmy</option>
                    </select><br><br>
                    <label>Zamieść przód zaprosznie (będzie tam zamieszczany logotyp wystawcy)</label><br>
                    <input type="file" id="front_upload__voucher_gen" name="front_upload" accept=".png" /><br><br>

                    <label>Zamieść tył zaproszenia (będzie tam zamieszczany kod QR)</label><br>
                    <input type="file" id="back_upload__voucher_gen" name="back_upload" accept=".png" /><br><br>

                    <label>Zamieść logotyp firmy => ".png" w wymiarze 300/200px</label><br>
                    <input type="file" id="exhibitors_logo__voucher_gen" name="exhibitors_logo" accept=".png" /><br><br>

                    <label>Podaj nazwe firmy max 100 znaków</label><br>
                    <input type="text" id="comapny_title__voucher_gen" name="comapny_title" required/><br><br>

                    <label>Podaj znacznik języka dla zaproszenia</label><br>
                    <input type="text" id="language__voucher_gen" name="language" required/><br><br>

                    <label>Podaj ilość zaproszeń do wtgenerowania</label><br>
                    <input type="text" id="vouchers_count__voucher_gen" name="vouchers_count" required/><br><br>

                    <button class="btn" id="submit-form__voucher_gen" name="submit-form__voucher_gen" type="submit">Generuj</button>
                </form>
            </div>
            <div class="display_side">
            </div>
        </div>';
    }
    
    
    if(isset($_POST["submit-form__voucher_gen"])){
        if (class_exists('GFAPI')) {
            include_once 'pdf_creator.php';
            require_once (ABSPATH . '/wp-content/plugins/PWElements/assets/tcpdf/tcpdf.php');

            if (!extension_loaded('gd')) {
                echo '<script>console.log("GD picture edytor - nie dostepne")</script>';
                exit;
            }

            $vouchers_count = $_POST['vouchers_count'];
            // var_dump($_POST);
            // var_dump($_FILES);
            $entry = [
                'form_id' => $atts['form_id__voucher_gen'],
                '1' => $_POST['comapny_title'],
                '2' => $_POST['language'],
            ];

            for($i=0; $i<$vouchers_count; $i++){
                $all_entries[] = GFAPI::add_entry($entry);
            }
            
            $qr_code_id = '';

            $qr_feeds = GFAPI::get_feeds(NULL, $atts['form_id__voucher_gen']);
            if(!is_wp_error($qr_feeds)){
                foreach($qr_feeds as $single_feed){
                    if($single_feed['addon_slug'] == 'qr-code'){
                        $qr_code_id = 'qr-code_feed_' . $single_feed['id'] . '_file';
                    }
                }
            }

            foreach($all_entries as $single_entry){
                $qr_file[] = gform_get_meta($single_entry, $qr_code_id);
            }

            $page_image = $_FILES['back_upload']['tmp_name'];
            $front_image = (!empty($_FILES['front_upload'])) ? $_FILES['front_upload']['tmp_name'] : false;
            $mode = (!empty($_POST['module'])) ? $_POST['module'] : 'qr_only';
            $exhibitors_logo = (!empty($_FILES['exhibitors_logo'])) ? $_FILES['exhibitors_logo']['tmp_name'] : false;

            $triple_qr = array();
            $pdf = new TCPDF();

            foreach($qr_file as $single_qr){
                $triple_qr[] = $single_qr;
                if(count($triple_qr) == 3){
                    create_page($pdf, $mode, $page_image, $triple_qr, $_POST['comapny_title'], $front_image, $exhibitors_logo);
                    $triple_qr = array();
                }
            }

            if(count($triple_qr) > 0){
                create_page($pdf, $mode, $page_image, $triple_qr, $_POST['comapny_title'], $front_image, $exhibitors_logo);
            }

            // Zapisz plik PDF na serwerze
            $output_path = __DIR__ . '/zaproszenia.pdf';
            $pdf->Output($output_path, 'F');

            echo '
                <script>
                    window.open("/wp-content/plugins/custom-element/elements/voucher_generator/zaproszenia.pdf", "_blank");
                </script>
            ';

        } else {
            return '<h4>Coś poszło nie tak :( </h4>';
        }
    }


    if(isset($_POST["merge-form__voucher_gen"])){
        include_once 'vouchers_merge.php';
    }
    echo '</pre>';
    return $output;
}

add_action('vc_before_init', 'elements_voucher_gen');
add_shortcode('elements_voucher_gen', 'voucher_gen_output');