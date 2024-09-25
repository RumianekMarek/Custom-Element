<?php 

// Funkcja dodająca stronę menu do panelu administracyjnego WordPress
function importer_menu() {
    add_submenu_page(
        'moja-wtyczka-dostep-do-katalogu', // Slug rodzica (strony menu)
        'IMPORTER',                        // Tytuł podmenu
        'IMPORTER',                        // Wyświetlany tekst w menu bocznym
        'manage_options',                 // Wymagane uprawnienia
        'importer_admin_setup', // Unikalny identyfikator strony
        'importer_admin_setup_output', // Funkcja wyświetlająca zawartość strony
    );
}

// Funkcja wyświetlająca zawartość strony ustawień
function importer_admin_setup_output() {
    

    if(isset($_POST['submit_importer'])){
        echo '<pre>';
        $form = findForms($_POST['gfForm']);

        $file_content = json_decode(str_replace('\"' , '"' , $_POST['file_content']));
        $file_labels = explode(',' , $file_content[0]);
        var_dump($_POST['file_content']);
        echo '</pre>';

        echo '<style>
                .pwe_gf_importer__form {
                    display: flex;
                    flex-direction: column;
                    width: 1000px;
                    gap: 30px;
                }
                .pwe_gf_importer__container{
                    display: flex;
                    gap: 30px;
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
            </style>';

        echo '<div class="pwe_gf_importer__container">
                <h3 class="pwe_gf_importer__like-label">Form Fields</h3>
                <h3>File Labels</h3>
            </div>';

            echo '<form class="pwe_gf_importer__form" action="' . admin_url('admin.php?page=importer_admin_setup') . '" method ="POST" >';
                echo '<input type="text" name="file_content" class="pwe_gf_importer__file_content" value="" />';
                echo '<input type="text" name="form_id" class="pwe_gf_importer__form_id" value="' . $_POST['gfForm'] . '" />';

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

            echo '<input type="submit" name="import_entries" value="Import" />
            </form>';

            echo '<script>
                jQuery(document).ready(function($){
                    $(".pwe_gf_importer__file_content").val("' . $_POST['file_content'] . '");
                });
            </script>';
        
    } else if(isset($_POST['import_entries'])){
        var_dump($_POST);
        $filds_ids = array();

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
        var_dump($filds_ids);
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

                echo '<input type="text" name="file_content" class="pwe_gf_importer__file_content" value="" style="visibility: hidden;" />';

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
                        console.log($(".pwe_gf_importer__newForm_container"));
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
                        fileArray = fileContent.split("\n");
                        const fileLabel = fileArray[0].split(",");
                        console.log(fileContent);

                        fileJson = JSON.stringify(fileArray);
                        $(".pwe_gf_importer__file_content").val(fileJson);

                        fileLabel.forEach(function(event){
                            $(".pwe_gf_importer__container.new_form")
                                .append(`<div class="pwe_gf_importer__container">
                                            <label>Kolumna ` + event + `</label>
                                            <select type="select" id="` + event + `-column" name="` + event + `-column" class="selectoret">
                                                <option value="import">Import</option>
                                                <option value="dont">Do not import</option>
                                            </select>
                                        </div>`);
                        });
                
                        $("#fileContent").text(fileContent);
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