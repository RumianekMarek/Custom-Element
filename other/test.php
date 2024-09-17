<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if ($_SESSION['password'] === 'D#eR$fO(lP);Y^h'){
echo'
  <style>
        .mass-main-container {
            margin-top: 3%;
            display: flex; 
            align-items: center; 
            justify-content: center;
        }
        label, select, input, button{
            font-size:20px;
        }
        .mass-enddata {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .mass-error{
            overflow-wrap: break-word;
            color:red;
            margin:5px;
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
';
    echo'
        <div class="mass-main-container">
            <form id="csvForm"enctype="multipart/form-data" action="" method="post">
                <label>Wybierz formularz
                <br>Only CSV file </label><br>
                <input type="file" id="csvFile" name="csvFile" accept=".csv" required/><br><br>
                <button id="submit-form" name="submit" type="submit">Sprawdź zgodność CSV</button>
            </form>
        </div>
    ';
} else {
    echo'
        <div>
            <form id="csvForm" enctype="multipart/form-data" action="" method="post">
                <label>Wpisz hasło</label><br>
                <input type="password" id="password" name="password" required/>
                <button id="password-submit" name="password_submit">Log In</button>
            </form>
        </div>
    ';

    if ($_SESSION['password'] != 'D#eR$fO(lP);Y^h' && isset($_POST['password_submit']) && $_POST['password'] === 'D#eR$fO(lP);Y^h'){
        $_SESSION['password'] = $_POST['password'];
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }
}

if (isset($_POST['submit'])) {
    $new_url = str_replace('private_html','public_html',$_SERVER['DOCUMENT_ROOT']) .'/wp-load.php';
    if (file_exists($new_url)) {
                require_once($new_url);
    }



    if ($_FILES['csvFile']['error'] == UPLOAD_ERR_OK) {
        $fileTmpName = $_FILES['csvFile']['tmp_name'];

        $csvContent = file_get_contents($fileTmpName);
        $csvContent = str_replace(["\r\n", "\r"], "\n", $csvContent);
        $csvArray = explode("\n", $csvContent);

        $form_entries = array();
        $form_fields = array();
        $form_id = '';

        foreach ($csvArray as $id => $row) {
            if($row != ''){
                if ( $id > 0 ){
                    $form_entries[$id - 1][0] = '';
                }
                $row_array = explode(',',$row);
                foreach($row_array as $key => $value){
                    if($id == 0){
                        $form_fields[] = array(
                            'label' => $value,
                            'type' => 'text',
                            'id' => $key + 1,
                        );
                    } else {
                        $form_entries[$id - 1][] = $value;
                    }
                }
            }
        }

        $csv_name = explode('.',$_FILES['csvFile']['name'])[0];

        $all_forms = GFAPI::get_forms();
        $qr_feeds = GFAPI::get_feeds();

        foreach($all_forms as $form){
            if($form['title'] == $csv_name){
                echo 'formularz ' . $csv_name . ' juz istniej <br>';
        
                // exit;
            }
        }
        
        if ($form_id == ''){
            $form_id = GFAPI::add_form(array(
                'title' => explode('.',$_FILES['csvFile']['name'])[0],
                'fields' => $form_fields,
            ));

            $form_feed_exists = false;
            
            foreach ($qr_feeds as $feed) {
                if ($feed['form_id'] == $form_id){
                    $form_feed_exists = true;
                    break;
                }
            }

            if(!$form_feed_exists){
                $qr_feed_new = array(
                    'feedName'=> 'GF-QR-' . count($qr_feeds),
                    'qrcodeLabel'=> '',
                    'qrcodeSize'=> '200',
                    'feed_condition_conditional_logic_object' => array(),
                    'feed_condition_conditional_logic' => '0',
                    'qrcodeFields'=> array(
                        0 => array(
                            'key' => 'gf_custom',
                            'custom_key' => substr($qr_feeds[0]['meta']['qrcodeFields'][0]['custom_key'], '0', 4) . str_pad($form_id, 3, '0', STR_PAD_LEFT),
                            'value'=> 'id',
                            'custom_value'=> ''
                        ),
                        1 => array(
                            'key' => 'gf_custom',
                            'custom_key' => 'rnd' . mt_rand(10000, 99999),
                            'value' => 'id',
                            'custom_value' => '',
                        ),
                    ),
                    'feedCondition' => '',
                );

                $qr_feed_exist = GFAPI::add_feed($form_id, $qr_feed_new, 'qr-code');
            }
            $entries_ids = GFAPI::add_entries($form_entries, $form_id);
        }
        
        $data_for_skr = array(
            'id_formularza' => $form_id,
            'fair_name' => do_shortcode('[trade_fair_badge]')
        );
        
        echo '
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            jQuery(document).ready(function($){
                $.post("https://bdg.warsawexpo.eu/badge_json_generator2.php",
                    { 
                        id_formularza: ' . $form_id . ', 
                        fair_name : "' .do_shortcode("[trade_fair_badge]").'"
                    },
                    function(response) {
                        console.log("Odpowiedź serwera:", response);
                    }
                );
            });
        </script>';

    }    
}