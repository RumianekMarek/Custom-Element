<?php
// Ustaw ścieżkę do pliku, do którego chcesz zapisać dane
$sciezka_do_pliku = 'test.txt';
$dane_do_zapisu .= "\n" . date('Y-m-d H:i:s') . "\n";

if ($_SERVER['HTTP_HEAD'] == '(rR1*sS3(tT5&uU7)vV2+wW4@yY' && $_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {
    // Odbierz dane z formularza
    $przeslane_dane = $_GET ;
    $dane_do_zapisu .= json_encode($przeslane_dane, JSON_PRETTY_PRINT) . "\n\n";

    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
    $entry = [];
    if (file_exists($new_url)) {
        require_once($new_url);
        if (class_exists('GFAPI')) {
            $all_forms = GFAPI::get_forms();
            foreach($all_forms as $form){
                if(strpos($form['title'], 'Rejestracja') !== false){
                    $entry['form_id'] = $form['id'];
                    $face_form = $form;
                    $all_fields = $form['fields'];
                    break;
                }
            }

            foreach($all_fields as $field){
                if(strpos($field['label'], 'nazwisko') !== false){
                    $entry[$field['id']] = $przeslane_dane['name'];
                } elseif(strpos($field['label'], 'email') !== false){
                    $entry[$field['id']] = $przeslane_dane['Email'];
                } elseif(strpos($field['label'], 'telefon') !== false){
                    $entry[$field['id']] = $przeslane_dane['Phone'];
                }
            }
            $entry_id = GFAPI::add_entry($entry);

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