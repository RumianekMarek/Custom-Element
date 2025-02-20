<?php

function elements_gf_form_creator() {
    vc_map(array(
        'name' => __('PWE GF Form Creator', 'my-custom-plugin'),
        'base' => 'elements_gf_form_creator',
        'category' => __('My Elements', 'my-custom-plugin'),
    ));
}

function gf_form_output() {
    $output = '';
    $file_url = plugins_url('gf_form_creator/add_form.php', dirname(__FILE__));
    
    $output .= '
        <style>
            .mass-main-container {
                display: flex; 
                flex-direction: column;
                align-items: center; 
                justify-content: center;
            }
            #fileForm, .output_form {
                width: 50%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: flex-start;
            }
            label, select, input, button {
                font-size: 20px;
            }
            .mass-enddata {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .mass-error {
                overflow-wrap: break-word;
                color: red;
                margin: 5px;
            }
            select {
                min-width: 200px;
            }
            table, th, td {
                border: 1px solid;
            }
            td {
                padding: 0 18px;
                text-align: center;
            }
        </style>
        <div class="mass-main-container">
            <div id="fileForm" enctype="multipart/form-data" action="" method="post">
                <label>Wybierz formularz<br>Only CSV, XLS, XLSX file </label><br>
                <input type="file" id="fileUpload__form_create" name="csvFile" accept=".csv, .xls, .xlsx" required/><br><br>
                <button class="btn" id="submit-form__form_create" name="submit" type="submit">Stwórz Formularz</button>
            </div>
            <div class="output_form"></div>
        </div>        

        <script>
            window.fileUrl = "' . $file_url . '";
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script src="' . plugins_url('gf_form_creator/gf_form_creator.js', dirname(__FILE__)) . '"></script>
    ';
    return $output;
}

add_action('vc_before_init', 'elements_gf_form_creator');
add_shortcode('elements_gf_form_creator', 'gf_form_output');