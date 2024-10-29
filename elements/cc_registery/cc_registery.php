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

                $(`input[placeholder*="name"]`).parent().after(`<hr style="border: 1px solid;">`);

                $(document).on("input", `input[placeholder*="name"]`, function() {
                    if($(this).val().length > 3 && $(this).next().length == 0){
                        $(this).after(`<input name="` + $(this).attr("name") + `" class="large" type="text" placeholder="First name and last name">`);
                    } else if($(this).val().length < 1 && $(this).next().length > 0){
                        $(this).remove();
                    }
                });

                $(`input[type="submit"]`).on("click", function(event){
                    event.preventDefault();
                    $(`.cc-registery__form`).find(`input[type="submit"]`).after("<div id=spinner class=spinner></div>");

                    let allInputs = {};
                    allInputs["form_id"] = ' . $cc_registrery__form_id . ';

                    $(".cc-registery__form :is(input, textarea, select)").map(function() {

                        if(!$(this).hasClass("gform_hidden") && $(this).attr("type") != "hidden" && $(this).attr("type") != "submit" && $(this).val() != ""){

                            if($(this).prop("placeholder").has("name")){
                                allInputs["name_id"][] = 
                            }

                            if($(this).prop("nodeName").toLowerCase() != "select"){
                                if ($(this).attr("type") && $(this).attr("type") == "checkbox") {
                                    allInputs[$(this).prop("name")] = $(this).prop("checked");
                                } else if ($(this).attr("type") && $(this).attr("type") == "radio"){
                                    if ($(this).prop("checked") === true) {
                                        allInputs[$(this).prop("name")] = $(this).val();
                                    }
                                } else if ($(this).attr("id")){
                                    allInputs[$(this).prop("name")] = $(this).val();
                                }
                            } else {
                                allInputs[$(this).attr("name")] = $(this).find("option:selected").val();
                            }
                        }
                    });

                    console.log(allInputs);
                    const dataToSend = JSON.stringify(allInputs);
                    console.log(dataToSend);

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