<?php 

if ($is_new && class_exists('GF_Field_Hidden')) {
    $pwe_qr_code = new GF_Field_Hidden();
    $pwe_qr_code->label = 'Qr Code';
    $pwe_qr_code->inputName = 'pwe_qr_code';

    // Add QR Code field to the form
    $form['fields'][] = $pwe_qr_code;

    $pwe_qr_code_path = new GF_Field_Hidden();
    $pwe_qr_code_path->label = 'Qr Code File Path';
    $pwe_qr_code_path->inputName = 'pwe_qr_code_file_path';

    // Add QR Code Path field to the form
    $form['fields'][] = $pwe_qr_code_path;

    // Update the form with the new fields
    GFAPI::update_form($form);
}