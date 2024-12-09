<?php 

// Function adding new elemnt in wordpress admin menu
function importer_menu() {
    add_menu_page(
        'PWE Importer',                
        'PWE Importer',           
        'manage_options',        
        'importer_admin_setup',
        'importer_admin_setup_output',
        'dashicons-arrow-down-alt', 
        8
    );
}

// Function site output
function importer_admin_setup_output() {
    
    // V2 after file send,
    // Chosing columns to import and notifications
    if(isset($_POST['submit_importer'])){
        $notifications_array = array();

        // Creating Form object 
        $form = findForms($_POST['gfForm']);

        // Getting all notifications names
        foreach($form['notifications'] as $notification){
            $notifications_array[] = $notification["name"];
        }

        // Changing file_content in to the array.
        $file_content = preg_replace('/,{3,}/', '', $_POST['file_content']);
        $file_content = str_replace('\"', '"', $file_content);
        $file_content = str_replace('\\\\"', '', $file_content);
        $file_content = preg_replace("/\\\'/", "'", $file_content);
        $file_content = json_decode($file_content);

        // Creating menu labels for column import selection.
        $file_labels = explode(',' , $file_content[0]);
        $label_error = 0;

        // Stop the process if there are more than two empty column headers in the uploaded file. 
        // This helps prevent sending too much empty data.
        foreach ($file_labels as $label){
            if($label == ''){
                $label_error++;
            }
            if($label_error > 2){
                echo '<h2 style="color: red;">Znaleziono puste nagłówki kolumn w zamieszczonym pliku</h2>';
                exit;
            }
        }

        // Creating visual side.
        echo '<style>
                .pwe_gf_importer__form {
                    display: flex;
                    flex-direction: column;
                    width: 1000px;
                    gap: 15px;
                }
                .pwe_gf_importer__container{
                    display: flex;
                    gap: 10px;
                    align-items: center;
                }
                .pwe_gf_importer__form label, .pwe_gf_importer__like-label{
                    width: 150px;
                }
                .pwe_gf_importer__form select{
                    min-width: 150px;
                }
                input[type="submit"] {
                    width: fit-content;
                    padding: 5px 10px;
                }
                .contener_notification label {
                    width: 250px !important;
                }
                .custom_notifications{
                    display: none;
                    margin-left: 50px;
                }
            </style>';
            
            // Form 
            echo '<form class="pwe_gf_importer__form" action="' . admin_url('admin.php?page=importer_admin_setup') . '" method ="POST" >';
                echo '<input type="text" name="file_content" class="pwe_gf_importer__file_content" value="" style="visibility:hidden;"/>';
                echo '<input type="text" name="form_id" class="pwe_gf_importer__form_id" value="' . $_POST['gfForm'] . '" style="visibility:hidden;"/>';
                echo '<div class="pwe_gf_importer__container">
                        <h3 class="pwe_gf_importer__like-label">Form Fields</h3>
                        <h3>File Labels</h3>
                    </div>';

            // Select column to download
            foreach($form['fields'] as $field){
                if(strtolower($field['label']) != 'captcha'){
                    echo '<div class="pwe_gf_importer__container">
                        <label>' . $field['label'] . '</label>
                        <select name="pwe-importer-form-ids_' . $field['id'] . '" required>';
                        echo '<option value="">Select Field</option>';
                        foreach($file_labels as $lab){
                            echo '<option value="' . $lab . '">' . $lab . '</option>';
                        }
                        echo '<option value="dont">Don\'t Import</option>';
                    echo '</select></div>';
                }
            }

            // Select notifications options
            echo '<select class="notifications" name="notification" required>
                    <option value="notification_none">No notifications</option>
                    <option value="notification_klaviyo">Send to Klaviyo</option>
                    <option value="notification_active">Send Active Notifications</option>
                    <option value="notification_choser">Chose Notification to send</option>
                </select>';

                foreach($notifications_array as $noti){
                    echo '<div class="pwe_gf_importer__container contener_notification custom_notifications">
                        <input type="checkbox" name="' . $noti . '" class="pwe_gf_importer__notification" value="noti_chose"/>
                        <label for="' . $noti . '">' . $noti . '</lamel>
                    </div>';
                }
                echo '<input type="submit" name="import_entries" value="Import" />
            </form>';

            // Adding file content to form hidden input.
            echo '<script>
                jQuery(document).ready(function($){
                    $(".pwe_gf_importer__file_content").val("' . $_POST['file_content'] . '");

                    $(".notifications").on("change", function(){
                        if ($(this).val() == "notification_choser") {
                            $(".custom_notifications").show("fast");
                        } else {
                            $(".custom_notifications").hide("fast");
                        }
                    });
                });
            </script>';
    
    // V3 after column selections,
    // Import data to gravity forms and sending notifications.
    } else if(isset($_POST['import_entries'])){

        $filds_ids = array();
        $entries = array();
        $form_id = $_POST['form_id'];

        // Checking whitch notification is chosen
        $notifications_chosen = array();
        foreach ($_POST as $post_id => $post){
            if($post == 'noti_chose'){
                $notifications_chosen[] = $post_id;
            }
        }

        // Changing file_content in to the array.
        $file_content = preg_replace('/,{3,}/' , '' , $_POST['file_content']);
        $file_content = str_replace('\"' , '"' , $file_content);
        $file_content = str_replace('\t' , '' , $file_content);
        $file_content = str_replace('\\\\"' , '`' , $file_content);
        $file_content = preg_replace("/\\\'/", "'", $file_content);
        
        $file_content = json_decode($file_content);
        
        // Creating menu labels for column import selection.
        $file_labels = explode(',' , array_shift($file_content));

        //Finding form fields id's for data import 
        foreach($_POST as $id => $key){       
            if(strpos($id, 'pwe-importer-form-ids') !== false && $key != ''){
                foreach($file_labels as $id_l => $key_l){
                    
                    if($key_l == $key){
                        $integer_id = str_replace('pwe-importer-form-ids_' , '' , $id);
                        $filds_ids[$integer_id] = $id_l;
                    }
                }
            }
        }

        //Creating $entries[] array for Gravity forms
        foreach($file_content as $id => $cont){

            // Skip empty content
            if($cont == ''){
                continue;
            }

            // Changing line from string in to an array
            $cont_array = preg_split('/,(?=(?:[^`]|`[^`]*`)*$)/', $cont);
            $single_entry = array();
            
            foreach($filds_ids as $l_id => $l_key){
                $single_entry[$l_id] = trim(str_replace('`', '"', $cont_array[$l_key]));
            }

            //Adding entry to $entries[] array
            $entries[] = $single_entry;
        }

        // Adding entries to the form and retrieving an array of entry IDs
        $result = GFAPI::add_entries($entries, $form_id);

        // Checking for WP ERRORS
        // Sending notifications if no errors
        if(!is_wp_error($result)){
            $form = GFAPI::get_form($form_id);
            $noti_send = array();

            foreach($result as $res){
                $entry_n = GFAPI::get_entry($res);

                // Notifications options
                switch ($_POST['notification']){

                    // Option Klaviyo
                    case "notification_klaviyo" :
                        $klavio_sender_url = ABSPATH . 'wp-content/plugins/custom-element/other/klavio_sender.php';
                        if (file_exists($klavio_sender_url)){
                            include_once $klavio_sender_url;
                            klavio_sender($entry_n, $form);
                        } else {
                            echo '<h3 style="color:red">Klavio Sender not finde</h3>';
                        }
                        break;
                    
                    // Option to send only active notifications
                    // All notifications that was active befor importing data will by send
                    case "notification_active" :
                        $noti_send[] = GFAPI::send_notifications($form, $entry_n);
                        break;

                    // Option to send notifications of chose
                    case "notification_choser" :
                        foreach ($form["notifications"] as $n_id => $notification){
                            if (in_array(str_replace(' ', '_', $notification["name"]), $notifications_chosen)) {
                                $form["notifications"][$n_id]["isActive"] = true;
                            } else {
                                $form["notifications"][$n_id]["isActive"] = false;
                            }
                        }
                        $noti_send[] = GFAPI::send_notifications($form, $entry_n);
                        break;
                    // If noting of above chosen, no notification will by send
                }
            }
            // information how many entreies was added for control purposes
            echo '<h2>Dodano ' . count($result) . ' wpisów do formularza. </h2>';
        } else {
            echo '<pre>';
                var_dump($result);
            echo '</pre>';
        }

    // V1 first screan
    // Selecting data file and form to import to.
    } else {
        $all_forms_array = findForms();

        echo '<style>
                .pwe_gf_importer__form {
                    display: flex;
                    flex-direction: column;
                    width: 1000px;
                    gap: 30px;
                }
                .pwe_gf_importer__form .pwe_gf_importer__container{
                    display: flex;
                    gap: 30px;
                }
                .pwe_gf_importer__form label{
                    width: 150px;
                }
                .pwe_gf_importer__form input{
                    width: 350px;
                }
                .pwe_gf_importer__form pwe_gf_importer__newForm_container div{
                    width: 350px;
                }
                input[type="submit"] {
                    width: fit-content;
                    padding: 5px 10px;
                }
            </style>';
        echo '<div id="pwe_gf_importer" class="wrap">';
            echo '<h1>PWE Importer for Gravity Forms</h1>';
            echo '<form class="pwe_gf_importer__form" action="' . admin_url('admin.php?page=importer_admin_setup') . '" method ="POST" >';

                echo '<input type="text" name="file_content" class="pwe_gf_importer__file_content" value="" style="visibility: hidden;"/>';

                echo '<div class="pwe_gf_importer__container">
                    <label for="fileUpload">Upload data file</label>
                    <input type="file" id="fileUpload" name="fileUpload" accept=".csv, .xls, .xlsx" required>
                    </div>';

                echo '<div class="pwe_gf_importer__container">
                    <label for="gfForm">Select a form</label>
                    <select type="select" id="gfForm" name="gfForm" required>
                        <option value="">Select</option>';
                    foreach($all_forms_array as $f_id => $f_title){
                        echo '<option value="' . $f_id . '">' . $f_title .'</option>';
                    }
                echo '</select>
                </div>';

                echo '<div class="pwe_gf_importer__container new_form" style="display:none;">
                        <label for="newForm">Podaj Nazwe Formularza</label>
                        <input type="text" name"newForm" id="newForm" class="pwe_gf_importer__new-form">
                    </div>';
                
                echo '<input type="submit" name="submit_importer" value="Update" />';
            echo '</form>';
        echo '</div>';

        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
            <script>
            jQuery(document).ready(function($){
                let fileContent = "";
                let fileArray = "";

                $("#gfForm").on("change", function(){
                    if($(this).val() == "NewForm"){
                        $(".pwe_gf_importer__container.newForm").show("fast");
                    } else {
                        $(".pwe_gf_importer__container.newForm").hide();
                    }
                });
                
                $("#fileUpload").on("change", function(event) {
                    const file = event.target.files[0];

                    const fileName = file.name.split(".")[0];
                    $(".pwe_gf_importer__new-form").val(fileName);

                    const allowedExtensions = ["csv", "xls", "xlsx"];
                    const fileExtension = file.name.split(".").pop().toLowerCase();

                    if (!allowedExtensions.includes(fileExtension)) {
                        alert("Niewłaściwy typ pliku. Proszę wybrać plik CSV, XLS lub XLSX.");
                        return;
                    }

                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        fileContent = e.target.result;

                        if(file.name.split(".").pop().toLowerCase() != "csv"){
                            const data = new Uint8Array(e.target.result);
                            const workbook = XLSX.read(data, { type: "array" });
                            const firstSheetName = workbook.SheetNames[0];
                            const worksheet = workbook.Sheets[firstSheetName];
                            fileContent = XLSX.utils.sheet_to_csv(worksheet);
                        } else {
                            fileContent = e.target.result;
                        }

                        fileContent = fileContent.replace(/,{3,}/g, "");
                        fileContent = fileContent.replace(/\r/g, "");
                        fileArray = fileContent.split(/\n(?=(?:[^"]|"[^"]*")*$)/);

                        const goodArray = fileArray.map((value) => {return value.trim()}).filter((value) => value != "");
                        fileJson = JSON.stringify(goodArray);

                        $(".pwe_gf_importer__file_content").val(fileJson);
                    };

                    if (fileExtension === "csv") {
                        reader.readAsText(file);
                    } else {
                        reader.readAsArrayBuffer(file);
                    }

                });
            });

            </script>';
    }
}

function findForms($form_id = null){
    $returner = array();
    
    if(class_exists('GFAPI') ){
        if($form_id === null){
            $all_forms = GFAPI::get_forms();
        } else {
            return GFAPI::get_form($form_id);
        }
    }
    foreach($all_forms as $form){
        $returner[$form['id']] = $form['title'];
    }
    return $returner;
}
add_action( 'admin_menu', 'importer_menu' );