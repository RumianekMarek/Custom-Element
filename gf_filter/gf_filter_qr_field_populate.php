<?php 
    $qr_code_index = substr(do_shortcode('trade_fair_name'), 0, 3);
    $qr_code_form_id = str_pad($form['id'], 3, '0', STR_PAD_LEFT);

    $qr_code = $qr_code_index . $qr_code_form_id . $entry['id'] .'rnd'. rand(10000, 99999) . $entry['id'];

    echo '<script>console.log("'.$qr_code.'")</script>';
    
    foreach($form['fields'] as &$field){
        if($field->inputName == 'pwe_qr_code'){
            $field->defaultValue = $qr_code;
            continue;
        }

        if($field["inputName"] == 'pwe_qr_code_file_path'){
            continue;
        }
    }