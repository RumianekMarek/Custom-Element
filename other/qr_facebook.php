<?php
// Ustaw ścieżkę do pliku, do którego chcesz zapisać dane
$sciezka_do_pliku = 'log.txt';
$dane_do_zapisu = "\n" . date('Y-m-d H:i:s') . "\n";

if ($_SERVER['HTTP_HEAD'] == '(rR1*sS3(tT5&uU7)vV2+wW4@yY' && $_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {
    // Odbierz dane z formularza
    $przeslane_dane = $_GET;
    $dane_do_zapisu .= json_encode($przeslane_dane, JSON_PRETTY_PRINT) . "\n\n";

    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
    $entry = [];
    if($przeslane_dane['lang'] == 'en'){
        $lang = 'en';
    } else {
        $lang = 'pl';
    }
    if (file_exists($new_url)) {
        require_once($new_url);
        if (class_exists('GFAPI')) {
            $all_forms = GFAPI::get_forms();
            foreach($all_forms as $form){
                if(strpos($form['title'], '(FB)') !== false && strpos(strtolower($form['title']), $lang) !== false){
                    $entry['form_id'] = $form['id'];
                    $face_form = $form;
                    $all_fields = $form['fields'];
                    break;
                }
            }

            foreach($all_fields as $field){
                if(strpos(strtolower($field['label']), 'nazwisko') !== false){
                    $entry[$field['id']] = $przeslane_dane['name'];
                } elseif(strpos(strtolower($field['label']), 'name') !== false){
                    $entry[$field['id']] = $przeslane_dane['name'];
                } elseif(strpos(strtolower($field['label']), 'mail') !== false){
                    $entry[$field['id']] = $przeslane_dane['email'];
                } elseif(strpos(strtolower($field['label']), 'telefon') !== false){
                    $entry[$field['id']] = $przeslane_dane['phone'];
                } elseif(strpos(strtolower($field['label']), 'phon') !== false){
                    $entry[$field['id']] = $przeslane_dane['phone'];
                } elseif(strpos(strtolower($field['label']), 'nip') !== false){
                    $entry[$field['id']] = $przeslane_dane['fair'];
                }
            }
            $entry_id = GFAPI::add_entry($entry);

            $qr_feeds = GFAPI::get_feeds( NULL, $form[ 'id' ]);
            foreach($qr_feeds as $feed){
                if (gform_get_meta($entry_id, 'qr-code_feed_' . $feed['id'] . '_url')){
                    $qr_code_id = $feed['id'];
                }   
            }

            $meta_key_url = gform_get_meta($entry_id, 'qr-code_feed_' . $qr_code_id . '_url');
            $meta_key_image = '<img data-imagetype="External" src="' . $meta_key_url . '" width="200">';
            echo '<script>console.log("'.$qr_code_id.'")</script>';
            
            foreach($face_form["notifications"] as $id => $key){
                if($key["isActive"]){
                    if(strpos($key["message"], '{qrcode-url-' . $qr_code_id . '}') != false){
                        $face_form["notifications"][$id]["message"] = str_replace('{qrcode-url-' . $qr_code_id . '}', $meta_key_url . '" width="200', $key["message"]);
                    } else if (strpos($key["message"], '{qrcode-image-' . $qr_code_id . '}') != false){
                        $face_form["notifications"][$id]["message"] = str_replace('{qrcode-image-' . $qr_code_id . '}', $meta_key_image, $key["message"]);
                    }
                }
            }

            if ($entry_id && !is_wp_error($entry_id)) {
                try {
                    GFAPI::send_notifications($face_form, $entry);
                } catch (Exception $e) {
                    $dane_do_zapisu .= 'Błąd send_notifications: ' . $e->getMessage();
                }
            } else {
                $dane_do_zapisu .= 'Błąd dodawania wpisu do Gravity Forms.';
            }
        }
    }
} else {
    $dane_do_zapisu .= 'error-log ||';
    foreach($_SERVER as $id => $key){
        $dane_do_zapisu .= $id . ' => ' . $key ;
    }
    $dane_do_zapisu .= '||';
    $dane_do_zapisu .= ' empty GET -> '.empty($_GET) .' ||';
    if (!empty($_POST)){
        $dane_do_zapisu .= 'POST -> ';
        foreach($_POST as $data){
            $dane_do_zapisu .= $data. ' ';
        }
    }
}

if ($dane_do_zapisu == '') {
    $blad = error_get_last();
    $dane_do_zapisu .= $blad ? json_encode($blad, JSON_PRETTY_PRINT) : 'Brak informacji o błędzie.';
}

$plik = fopen($sciezka_do_pliku, 'a');
if ($plik) {
    fwrite($plik, $dane_do_zapisu);
    fclose($plik);
}