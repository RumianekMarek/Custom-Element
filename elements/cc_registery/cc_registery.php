<?php 

function elements_cc_registrery() {
    vc_map(array(
        'name' => __('PWE CC Registery', 'my-custom-plugin'),
        'base' => 'elements_cc_registrery',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array( 
            array(
                'type' => 'textfield',
                'group' => 'PWE Element',
                'heading' => __('Insert Form ID', 'my-custom-plugin'),
                'param_name' => 'cc_registrery__form_id',
                'save_always' => true,
                'value' => '',
            ),
        ),
    ));
}

function cc_registery_output($atts, $content = '') {
    extract( shortcode_atts( array(
        'cc_registrery__form_id' => '',
    ), $atts ));
    
    $secret = SECURE_AUTH_KEY;
    $file_url = plugins_url('add_entry.php', __FILE__);

    $output = '';
    $output .= '
        <style>
            .cc-registery__form{
                max-width: 600px;
                margin: auto;
            }
            .cc-registery__form :is(input, select){
                border-color: black !important;
            }
            .cc-registery__form select{
                padding: 10px 15px !important;
            }
        </style>
        <div class="cc-registery__form">
            ' . do_shortcode('[gravityform id=' . $cc_registrery__form_id . ' title="false" description="false" ajax="true"]') . '
        </div>

        <script>
            jQuery(document).ready(function($) {

                const create_modal = (entries) => {
                    $(".cc-registery__form").after(`<div style="border: 2px solid; border-radius: 15px; padding: 0 36px 18px; margin: auto; text-align: center; width: fit-content; position: fixed; top: 30%; left: 50%; transform: translateX(-50%); background: white;"><h3>Wysłano powiadomienia dla ` + entries.length + ` osób. <br> Za chwile strona same się odświeży.</h3></div>`);

                    setTimeout(() => {
                        location.reload();
                    }, 5000);
                }

                $(".cc-registery__form :is(input, textarea, select)[aria-required=true]").on("input", function(){
                    $(this).closest(".gfield").next(".input-error").remove();
                });

                $(".cc-registery__form :is(input, textarea, select)[aria-required=true]").each(function(){
                    $(this).attr("required", true);
                });

                $(`input[placeholder*="name"]`).parent().after(`<hr style="border: 1px solid; margin: 12px 0px 0px;">`);

                $(document).on("input", `input[placeholder*="name"]`, function() {
                    if($(this).val().length > 3 && $(this).next().length == 0){
                        $(this).after(`<input name="` + $(this).attr("name") + `" class="large" type="text" placeholder="First name and last name">`);
                    } else if($(this).val().length < 1 && $(this).next().length > 0){
                        $(this).remove();
                    }
                });

                $(`input[type="submit"]`).on("click", function(event){
                    event.preventDefault();

                    let validate = true;

                    $(".cc-registery__form :is(input, textarea, select)[aria-required=true]").each(function(){
                        if(!this.checkValidity()){
                            if($(this).closest(".gfield").next(".input-error").length == 0){
                                $(this).closest(".gfield").after(`<p class="input-error" style="background-color: rgb(255, 0, 0, 0.05); color: red; border-bottom: solid; margin: 0; padding: 0 18px;">To pole musi być wypełnione</p>`);
                            }
                            validate = false;
                        }
                    });

                    if (!validate){
                        return;
                    };

                    $(`.cc-registery__form`).find(`input[type="submit"]`).after("<div id=spinner class=spinner></div>");
                    
                    let allInputs = {};
                    allInputs["form_id"] = ' . $cc_registrery__form_id . ';
                    allInputs["all_names"] = [];

                    let keyNames = 0;
                    $(".cc-registery__form :is(input, textarea, select)").map(function() {
                        
                        if(!$(this).hasClass("gform_hidden") && $(this).attr("type") != "hidden" && $(this).attr("type") != "submit" && $(this).val() != ""){

                            if($(this).prop("nodeName").toLowerCase() != "select"){

                                if($(this).prop("placeholder").includes("name")){
                                    if (allInputs["name_id"] === undefined){
                                        allInputs["name_id"] = $(this).prop("name");
                                    }
                                    allInputs["all_names"][keyNames] = $(this).val();
                                    keyNames += 1;
                                } else if ($(this).attr("type") && $(this).attr("type") == "checkbox") {
                                    allInputs[$(this).prop("name")] = $(this).prop("checked");

                                } else if ($(this).attr("type") && $(this).attr("type") == "radio"){
                                    if ($(this).prop("checked") === true) {
                                        allInputs[$(this).prop("name")] = $(this).val();
                                    }

                                } else if ($(this).attr("id")){
                                    allInputs[$(this).prop("name")] = $(this).val();
                                }
                            } else {
                                allInputs[$(this).prop("name")] = $(this).find("option:selected").val();
                                allInputs["notification"] = $(this).find("option:selected").val();
                            }
                        }
                    });
                    const dataToSend = JSON.stringify(allInputs);

                    $.post("' . $file_url . '",
                        {   
                            secret: "' . $secret . '",
                            data: dataToSend,
                        },
                        function(response) {
                            const report = JSON.parse(response);
                            console.log("Odpowiedź serwera:", report);

                            $("#spinner").remove();

                            if(report["status"] === true){
                                create_modal(report["entries"]);
                                console.log("true");
                            } else {
                                console.log("false");
                            }
                        }
                    );
                });
            });
        </script>
    ';
    return $output;
}

add_action('vc_before_init', 'elements_cc_registrery');
add_shortcode('elements_cc_registrery', 'cc_registery_output');