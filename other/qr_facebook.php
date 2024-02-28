<?php
// Ustaw ścieżkę do pliku, do którego chcesz zapisać dane
$sciezka_do_pliku = 'log.txt';
$dane_do_zapisu .= "\n" . date('Y-m-d H:i:s') . "\n";

if ($_SERVER['HTTP_HEAD'] == '(rR1*sS3(tT5&uU7)vV2+wW4@yY' && $_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // Odbierz dane z formularza
    $przeslane_dane = $_POST;
    $dane_do_zapisu .= json_encode($przeslane_dane, JSON_PRETTY_PRINT) . "\n\n";

    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
    $entry = [];
    if (file_exists($new_url)) {
        require_once($new_url);
        if (class_exists('GFAPI')) {
            $all_forms = GFAPI::get_forms();
            foreach($all_forms as $form){
                if(strpos($form['title'], '(FB)') !== false){
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
                    $entry[$field['id']] = $przeslane_dane['email'];
                } elseif(strpos($field['label'], 'telefon') !== false){
                    $entry[$field['id']] = $przeslane_dane['phone'];
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
} else {
    $dane_do_zapisu .= 'error-log <br>';
    $dane_do_zapisu .= $_SERVER['HTTP_HEAD'] . 'powinno byc -> (rR1*sS3(tT5&uU7)vV2+wW4@yY <br>';
    $dane_do_zapisu .= $_SERVER["REQUEST_METHOD"] . '  powinno byc -> POST <br>';
    $dane_do_zapisu .= 'empty POST -> '.empty($_POST);
    if (!empty($_GET)){
        foreach($_GET as $data){
            $dane_do_zapisu .= $data;
        }
    } else {
        $dane_do_zapisu .= 'empty';
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