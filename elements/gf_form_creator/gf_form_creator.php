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
                #fileForm, .output_form{
                    width: 50%;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: flex-start;
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
        <div class="mass-main-container">
            <div id="fileForm" enctype="multipart/form-data" action="" method="post">
                <label>Wybierz formularz
                <br>Only CSV, XLS, XLSX file </label><br>
                <input type="file" id="fileUpload__form_create" name="csvFile" accept=".csv, .xls, .xlsx" required/><br><br>
                <button class="btn" id="submit-form__form_create" name="submit" type="submit">Stwórz Formularz</button>
            </div>
            <div class="output_form"></div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                var fileContent = "";

                $("#submit-form__form_create").on("click", function(event) {
                    let filteredArray = [];

                    const file = $("#fileUpload__form_create").prop("files")[0];
                    if (!file) {
                        alert("Nie wybrano pliku.");
                        return;
                    }

                    const allowedExtensions = ["csv", "xls", "xlsx"];
                    const fileExtension = file.name.split(".").pop().toLowerCase();

                    if (!allowedExtensions.includes(fileExtension)) {
                        alert("Niewłaściwy typ pliku. Proszę wybrać plik CSV, XLS lub XLSX.");
                        return;
                    }

                    $(".output_form").html("<div id=spinner class=spinner></div>");

                    const reader = new FileReader();
                    
                    reader.onload = function(e) {

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
                        
                        fileArray = fileContent.split(/\n(?=(?:[^"]|"[^"]*")*$)/);

                        fileArray.forEach(function(element){
                            if (element.trim() !== "" && !/^[,\s"]+$/.test(element)){
                                let newElement = element.split(/,(?=(?:[^"]|"[^"]*")*$)/);

                                newElement = newElement.map(function(elem){ 
                                    elem = elem.replace(/\\\\/g, ``);
                                    elem = elem.replace(/\\"/g, ``);
                                    return elem;
                                });

                                filteredArray.push(newElement);
                            }
                        });
                        const jsonDataArray = JSON.stringify(filteredArray);

                        let byteLength = new TextEncoder().encode(jsonDataArray).length;

                        if(byteLength > 500000){
                            $(".output_form").html("<p>Coś poszło nie tak<br><br>Za duży rozmiar pliku, popraw: <br>- max 4000 linijek,<br>- zapisz plik na komputerze w programie (openOffice, libreOffice) w formacie csv(utf8),<br>- jeżeli nie pomogło skontaktuj się z administratorem.</p>");
                            $("#spinner").remove();
                            return;
                        }
                        
                        fetch("' . $file_url . '",{
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "Authorization": "qg58yn58q3yn5v",
                                "FileName" : file.name.split(".")[0]
                            },
                            body: jsonDataArray
                        })
                        .then(response => {
                            $("#spinner").remove();

                            if (!response.ok) {
                                throw new Error("Błąd odpowiedzi serwera");
                            }

                            return response.json();
                        })
                        .then(report => {
                            console.log("Odpowiedź serwera:", report)
                            if(report["status"] == "true"){
                                $(".output_form").html("<p>Coś poszło nie tak</p><br>" + report["output"]);';

                                if ($_SERVER["SERVER_NAME"] != "mr.glasstec.pl"){
                                    $output .= '
                                        $(".output_form").html(report["output"]);

                                        $.post("https://bdg.warsawexpo.eu/badgewp-reception.php",
                                            { 
                                                id_formularza: report["id_formularza"], 
                                                fair_name : report["fair_name"],
                                                form_name : report["form_name"],
                                                entries_count : report["entries_count"]
                                            });
                                    ';
                                };
                            $output .='
                            }
                        })
                        .catch(error => {
                            $(".output_form").html("<p>Coś poszło nie tak</p><br>" + report["output"]);
                            console.error("Błąd:", error);
                        });
                    };
                        
                    if (fileExtension === "csv") {
                        reader.readAsText(file);
                    } else {
                        reader.readAsArrayBuffer(file);
                    }
                });
               
            });
        </script>
        ';
    return $output;
}

add_action('vc_before_init', 'elements_gf_form_creator');
add_shortcode('elements_gf_form_creator', 'gf_form_output');