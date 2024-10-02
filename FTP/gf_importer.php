<?php 

// Funkcja dodająca stronę menu do panelu administracyjnego WordPress
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

// Funkcja wyświetlająca zawartość strony ustawień
function importer_admin_setup_output() {
    

    if(isset($_POST['submit_importer'])){
        $notifications_array = array();

        $form = findForms($_POST['gfForm']);
        foreach($form['notifications'] as $notification){
            $notifications_array[] = $notification["name"];
        }

        $file_content = json_decode(str_replace('\"' , '"' , $_POST['file_content']));
        $file_labels = explode(',' , $file_content[0]);
        $label_error = 0;

        foreach ($file_labels as $label){
            if($label == ''){
                $label_error++;
            }
            if($label_error > 2){
                echo '<h2 style="color: red;">Znaleziono puste nagłówki kolumn w zamieszczonym pliku</h2>';
                exit;
            }

        }

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

        

            echo '<form class="pwe_gf_importer__form" action="' . admin_url('admin.php?page=importer_admin_setup') . '" method ="POST" >';
                echo '<input type="text" name="file_content" class="pwe_gf_importer__file_content" value="" style="visibility:hidden;"/>';
                echo '<input type="text" name="form_id" class="pwe_gf_importer__form_id" value="' . $_POST['gfForm'] . '" style="visibility:hidden;"/>';
                echo '<div class="pwe_gf_importer__container">
                        <h3 class="pwe_gf_importer__like-label">Form Fields</h3>
                        <h3>File Labels</h3>
                    </div>';
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
        
    } else if(isset($_POST['import_entries'])){
        $filds_ids = array();
        $entries = array();
        $form_id = $_POST['form_id'];

        $notifications_chosen = array();
        foreach ($_POST as $post_id => $post){
            if($post == 'noti_chose'){
                $notifications_chosen[] = $post_id;
            }
        }

        $file_content = json_decode(str_replace('\"' , '"' , $_POST['file_content']));
        $file_labels = explode(',' , array_shift($file_content));

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

        foreach($file_content as $id => $cont){
            if($cont == ''){
                continue;
            }
            
            $cont_array = explode(',', $cont);
            $single_entry = array();

            foreach($filds_ids as $l_id => $l_key){
                $single_entry[$l_id] = $cont_array[$l_key];
            }
            $entries[] = $single_entry;
        }
        $result = GFAPI::add_entries($entries, $form_id);
        if(!is_wp_error($result)){
            $form = GFAPI::get_form($form_id);
            $noti_send = array();
            foreach($result as $res){
                $entry_n = GFAPI::get_entry($res);
                switch ($_POST['notification']){

                    case "notification_klaviyo" :
                        $klavio_sender_url = ABSPATH . 'wp-content/plugins/custom-element/other/klavio_sender.php';
                        if (file_exists($klavio_sender_url)){
                            include_once $klavio_sender_url;
                            klavio_sender($entry_n, $form);
                        } else {
                            echo '<h3 style="color:red">Klavio Sender not finde</h3>';
                        }
                        break;

                    case "notification_active" :
                        $noti_send[] = GFAPI::send_notifications($form, $entry_n);
                        break;

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
                }
            }
            echo '<h2>Dodano ' . count($result) . ' wpisów do formularza. </h2>';
        } else {
            echo '<pre>';
                var_dump($result);
            echo '</pre>';
        }
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

                echo '<input type="text" name="file_content" class="pwe_gf_importer__file_content" value="" style="visibility:hidden;"/>';

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

                        fileContent = fileContent.replace(/\r/g, "");
                        fileArray = fileContent.split("\n");
                        fileJson = JSON.stringify(fileArray);

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