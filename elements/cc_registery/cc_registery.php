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
                const form_inputs = $(".cc-registery__form :is(input, textarea, select)");
                const expirationTime = 2 * 60 * 60 * 1000; 
                const prefix = "form_";

                const savedTime = localStorage.getItem(prefix + "SavedTime");
                if(savedTime && (Date.now() - savedTime) > expirationTime){
                    Object.keys(localStorage).forEach(key => {
                        if (key.startsWith(prefix)) {
                            localStorage.removeItem(key);
                        }
                    });
                }

                // Przywraca zapisane wartości przy ładowaniu strony
                form_inputs.each(function() {
                    const inputType = $(this).attr("type");
                    const storageKey = prefix + ($(this).attr("name") || $(this).attr("id"));
                    const savedValue = localStorage.getItem(storageKey);

                    if (savedValue !== null) {
                        if (inputType === "checkbox") {
                            $(this).prop("checked", savedValue === "true");
                        } else if (inputType === "radio") {
                            $(this).prop("checked", $(this).val() === savedValue);
                        } else {
                            $(this).val(savedValue);
                        }
                    }
                });

                // Zapisuje wartości do localStorage przy wysłaniu formularza
                $(".cc-registery__form").on("submit", function() {
                    const currentTime = Date.now();
                    localStorage.setItem(prefix + "SavedTime", currentTime); 

                    form_inputs.each(function() {
                        const inputType = $(this).attr("type");
                        const storageKey = prefix + $(this).attr("name") || $(this).attr("id");

                        if (inputType === "checkbox") {
                            localStorage.setItem(storageKey, $(this).is(":checked"));
                        } else if (inputType === "radio" && $(this).is(":checked")) {
                            localStorage.setItem(storageKey, $(this).val());
                        } else if (inputType !== "radio") {
                            localStorage.setItem(storageKey, $(this).val());
                        }
                    });
                });
            });
        </script>
    ';
    return $output;
}

add_action('vc_before_init', 'elements_cc_registrery');
add_shortcode('elements_cc_registrery', 'cc_registery_output');