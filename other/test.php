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
            <form id="csvForm" enctype="multipart/form-data" action="" method="post">
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
                <input type="password" id="password" name="password"required/>
                <button id="password-submit" name="password_submit">Log In</button>
            </form>
        </div>
    ';

    if ($_SESSION['password'] != 'D#eR$fO(lP);Y^h' && isset($_POST['password_submit']) && $_POST['password'] === 'D#eR$fO(lP);Y^h'){
        $_SESSION['password'] = $_POST['password'];
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

if (isset($_POST["submit"])) {
    $new_url = str_replace('private_html','public_html',$_SERVER["DOCUMENT_ROOT"]) .'/wp-load.php';
    if (file_exists($new_url)) {
                require_once($new_url);
    }

    if ($_FILES["csvFile"]["error"] == UPLOAD_ERR_OK) {
        $fileTmpName = $_FILES["csvFile"]["tmp_name"];

        $csvContent = file_get_contents($fileTmpName);
        $csvContent = str_replace(["\r\n", "\r"], "\n", $csvContent);
        $csvArray = explode("\n", $csvContent);

        $form_entries = array();
        $form_fields = array();
        $form_id = '';

        foreach ($csvArray as $id => $row) {
            $row_array = explode(',',$row);
            foreach($row_array as $key => $value){
                if($id == 0){
                    $form_fields[] = array(
                        'label' => $value,
                        'type' => 'text',
                        'id' => $key + 1,
                    );
                } else {
                    $form_entries[$id][] = $value;
                }
            }
        }
        $csv_name = explode('.',$_FILES["csvFile"]['name'])[0];

        $all_forms = GFAPI::get_forms();

        foreach($all_forms as $form){
            if($form['title'] == $csv_name){
                echo 'formularz o podanej nazwie juz istniej <br>';
                $form_id = $form['id'];
            }
        }

        if ($form_id == ''){
            $form_id = GFAPI::add_form(array(
                'title' => explode('.',$_FILES["csvFile"]['name'])[0],
                'fields' => $form_fields,
            ));
        }

        foreach($form_entries as $entry){
            $single_entry = {
                'form_id' -> $form_id,
            }
            
            print_r($single_entry);
            echo '<br>';
        }
    }

    // // getting qr_code url
    // $qr_feeds = GFAPI::get_feeds(NULL);
    // echo '<pre>';
    // var_dump(count($qr_feeds));
    // var_dump($qr_feeds);
    // echo '</pre>';
    // foreach ($qr_feeds as $feed) {
    //     $qr_code_url = gform_get_meta(318, 'qr-code_feed_' . $feed['id'] . '_url');
    //     if ($qr_code_url) {
    //         $qr_code_id = $feed['id'];
    //         break;
    //     }
    // }
    // var_dump($qr_code_id);
}