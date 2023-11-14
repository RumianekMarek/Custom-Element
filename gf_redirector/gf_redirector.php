<?php
function register_custom_gf_redirection() {
    vc_map(array(
        'name' => __('GF Redirector', 'my-custom-plugin'),
        'base' => 'gf_redirection',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(
            array(
              'type' => 'textfield',
              'heading' => __('Geravity ID', 'my-custom-plugin'),
              'param_name' => 'gravity_id',
              'value' => '',
              'description' => __('Set a gvaity form ID.', 'my-custom-plugin')
            ),
        )
    ));
}

function custom_gf_redirection_output($atts) {
    $atts = shortcode_atts(array(
        'gravity_id' => '',
    ), $atts);
        
    echo '<div style="width:700px;">';
            gravity_form($atts['gravity_id'], false, false, false, '', true);
    echo '</div>';
    ?>
        <script>
            var checkboxes = document.querySelectorAll("form input[type='checkbox']");
            checkboxes.forEach(function(checkbox) {
                var currentName = checkbox.getAttribute("name");
                var newName = currentName.replace(/\./g, "_");
                checkbox.setAttribute("name", newName);
            });
        </script>';
    <?php

    if(isset($_POST['submit'])){
        unset($_POST['g-recaptcha-response']);
        unset($_POST['submit']);
        $validation = true;
        echo '<script> 
                    const validArray = []; 
                    const targetElement = document.querySelectorAll(`input:not([type="hidden"])`);
                </script>';
        foreach($_POST as $id => $key){
            if(!empty($key)){
            ?>
                <script>
                    { 
                        for(i=0; i<targetElement.length; i++){
                            if (targetElement[i].type != "hidden" && targetElement[i].name === "<?php echo $id; ?>"){
                                targetElement[i].attributes[3].value = "<?php echo $key; ?>";
                                validArray.push(targetElement[i]);
                            }
                        }
                    }
                </script>
            <?php
            } else {
                $validation = false;
            }
        }
        ?>
            <script>
                for (i = 0; i < targetElement.length; i++) {
                    let validation = false;
                    validArray.forEach(item => {
                        if (targetElement[i] === item) {
                            validation = true;
                        }
                    });
                    if(validation === false && targetElement[i].type != "submit"){
                        targetElement[i].parentElement.classList.add("error-message");
                    }
                }
            </script> 
        <?php
        if($validation === true){
            $forms = GFAPI::get_forms();
            foreach ($forms as $form) {
                if ($form['title'] === "redirection-validation") {
                    $form_exists = true;
                    $form_id = $form['id'];
                    break;
                }
            }
            if($form_exists){
                $entry_exist = false;
                $entries = GFAPI::get_entries($form_id, null, null, array('offset' => 0, 'page_size' => 0));
                foreach($entries as $entry){
                    if($entry[1] === $atts['gravity_id']){
                        $entry_exist = true;
                        if ($entry[2] === 'nie') {
                            $entry[2] = 'tak';
                        } else {
                            $entry[2] = 'nie';
                        }
                        redirection_add_entry($form_id, $_POST);
                        $updated = GFAPI::update_entry($entry);
                        break;
                    } 
                }
                if($entry_exist === false) {
                    $inside_id_data = array(
                        'form_id' => $form_id,
                        1 => $atts['gravity_id'],
                        2 => 'nie',
                    );
                    $entry_id = GFAPI::add_entry($inside_id_data);
                }
            } else {
                $form_id = GFAPI::add_form(array(
                    'title' => "redirection-validation",
                    'fields' => array(
                        array(
                            'label' => 'Form_id',
                            'type' => 'text',
                            'id' => 1,
                        ),
                        array(
                            'label' => 'Form_send',
                            'type' => 'text',
                            'id' => 2,
                        ),
                    ),
                ));
            }
        }
    }   
    $css_file = plugins_url('gf_redirector.css', __FILE__);
    $css_version = filemtime(plugin_dir_path(__FILE__) . 'gf_redirector.css');
    wp_enqueue_style('gf_redirector-css', $css_file, array(), $css_version);

    $js_file = plugins_url('gf_redirector.js', __FILE__);
    $js_version = filemtime(plugin_dir_url(__FILE__) . 'gf_redirector.js');
    wp_enqueue_script('gf_redirector-js', $js_file, array('jquery'), $js_version, true);
}

function redirection_add_entry($form_id, $form_entry){
    $inside_id_data = array();

        // 'form_id' => $form_data['form_id'],
        // '2' => $form_data['2'],
        // '3' => $form_data['3'],
        // '4' => $form_data['4'],
        // '5' => $form_data['5'],
        // '6' => $form_data['6'],
        // '7' => $form_data[''],
        // '8' => $form_data['7'],
        // '10' => $form_data['10'],
        // '11' => $form_data['11'],
        // '12' => $form_data['12'],
        // '15' => $form_data['9'],

    echo '<script>console.log("'.$form_id.'")</script>';
    
    foreach($form_entry as $id => $entry){
        $id = explode('_', $id)[2];
        var_dump($id.' => '.$entry);
        echo '<br>';
    }
}

add_action('vc_before_init', 'register_custom_gf_redirection');
add_shortcode('gf_redirection', 'custom_gf_redirection_output');
?>