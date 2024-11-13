<?php

function elements_registration_finder() {
    vc_map(array(
        'name' => __('PWE Registration Finder', 'my-custom-plugin'),
        'base' => 'elements_registration_finder',
        'category' => __('My Elements', 'my-custom-plugin'),
    ));
}

function creteEntryAndModal($entry, $form_name, $field_entry){
    if($entry['qr-code'] == ""){
        return;
    }
    $returner ='
        <div id="' . $entry['id'] . '" class="single_entry__registration_finder">
            <h6>' . $form_name . '</h6>
            <h5>' . $field_entry . '</h5>
            <img src="' . $entry['qr-code'] . '">
        </div>
        <div class="modal_container__registration_finder modal__' . $entry['id'] . '">
            <div class="modal__registration_finder">
                <div class="left_modal__registration_finder">';
                    foreach($entry as $entry_id => $entry_val){
                        if(is_int($entry_id) && strpos(strtolower($entry_val), 'utm') === false && strpos(strtolower($entry_val), 'generator') === false){
                            $returner .='        
                                <h5>' . $entry_val . '</h5>
                            ';
                        }
                    }
                $returner .='
                </div>   
                <div> 
                    <img class="modal-img__registration_finder" src="' . $entry['qr-code'] . '">
                </div>
                <p class="modal_closer__registration_finder">X</p>
            </div>
        </div>
    ';
    return $returner;
}
function registration_finder_output() {
    $output = '';

    $output .= '
        <style>
            body :has(.qr-code_image-full-width) .menu-container{
                display: none;
            }
            .output_form__registration_finder {
                display: flex;
                flex-wrap: wrap;
                text-align: center;
                justify-content: space-evenly;
                gap:15px;
            }
            .single_entry__registration_finder {
                cursor: pointer;
                padding: 9px;
                border: 5px solid gold;
                border-radius: 15px;
                width:200px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
            }
            .single_entry__registration_finder :is(h5, h6){
                margin: 0;
                line-height: 1.2;
                overflow-wrap: anywhere;
            }
            .single_entry__registration_finder img{  
                width:100px;
            }
            .modal_container__registration_finder{
                top: 0;
                position: fixed;
                display: none;
                width: 100%;
                height: 100%;
                background: grey;
            }
            .modal_closer__registration_finder {
                height: 33px;
                margin: 0;
                padding: 3px 10px 2px;
                font-weight: 800;
                border-radius: 50%;
                color: white;
                background: red;
                cursor: pointer;
            }
            .left_modal__registration_finder{
                margin:auto;
            }
            .modal__registration_finder img{
                position: relative;
                height: 300px;
            }
            .left_modal__registration_finder h5{
                margin-top: 5px;
            }
            .spinner {
                height: 0px !important;
            }
            .qr-code_image-full-width{
                position: fixed !important;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%) !important;
                width: 80% !important;
                height: unset !important;
                aspect-ratio: 1/1;
            }
            .modal__registration_finder:has(.qr-code_image-full-width){
                height: 90% !important;
                width: 90% !important;
                max-width: 620px !important;
                max-height: 620px !important;
            }
            .modal__registration_finder:has(.qr-code_image-full-width) :is(.left_modal__registration_finder, .modal_closer__registration_finder){
                display: none;
            }
            @media(min-width: 501px){
                .modal__registration_finder img{
                    top: 50%;
                    transform: translateY(-50%);
                }
                .modal__registration_finder div{
                    width: 50%;
                }
                .modal__registration_finder{
                    position: relative;
                    display: flex;
                    margin: auto;
                    background: white;
                    border: 5px solid goldenrod;
                    border-radius: 25px;
                    width: 60%;
                    top:50%;
                    transform:translateY(-50%);
                }
                .qr-code_image-full-width{
                    max-width: 95vh !important;
                    max-height: 95% !important;
                }
            }
            @media(min-width: 501px) and (max-width: 900px){
                .modal__registration_finder img{
                    position: relative;
                    height: 200px;
                }
            }
            @media(max-width: 500px){
                .modal__registration_finder img{
                    margin: 30px 0 ;
                }
                .modal__registration_finder{
                    position: relative;
                    display: flex;
                    flex-direction: column-reverse;
                    margin: auto;
                    background: white;
                    border: 5px solid goldenrod;
                    border-radius: 25px;
                    width: 80%;
                    top:50%;
                    transform:translateY(-50%);
                } 
                .modal_closer__registration_finder {
                    width: fit-content;
                }
                .left_modal__registration_finder h5{
                    overflow-wrap: anywhere;
                    margin: 5px;
                }
                .qr-code_image-full-width{
                    max-width: 95% !important;
                    max-height: 95vw !important;
                }
            }

        </style>

        <div class="mass-main-container">
            <div id="fileForm" enctype="multipart/form-data" action="" method="post">
                <form class="form__registration_finder" action="" method="POST" >
                    <label>Podaj nazwe do wyszukania</label><br>
                    <input type="text" id="search_criteria___registration_finder" name="search_criteria" required/><br><br>
                    <button class="btn" id="submit-form___registration_finder" name="submit" type="submit">Wyszukaj</button>
                </form>
            </div>
        </div>
    ';

    if(isset($_POST["search_criteria"]) && $_POST["search_criteria"] != ''){
        $all_feeds = GFAPI::get_feeds();
        // $all_forms = GFAPI::get_forms($active = true);
        $all_entries = array();
        $search_criteria = $_POST["search_criteria"];
        $output .= '<div class="output_form__registration_finder">';

        foreach($all_feeds as $feed){
            $form = GFAPI::get_form($feed['form_id']);
            $form_name = $form['title'];
            $form_entries = GFAPI::get_entries($feed['form_id'], null, null, array( 'offset' => 0, 'page_size' => 0));
            if (count($form_entries) > 0){
                foreach($form_entries as $entry){
                    foreach($entry as $field_id => $field_entry){
                        if($entry['id'] == $search_criteria){
                            $entry['qr-code'] = gform_get_meta($entry['id'], 'qr-code_feed_' . $feed['id'] . '_url');
                            $all_entries[$entry['id']][] = $entry;
                            $output .= creteEntryAndModal($entry, $form_name, $field_entry);
                            break 3;
                        } else if(is_int($field_id) && strpos(strtolower($field_entry), strtolower($search_criteria)) !== false ){
                            $entry['qr-code'] = gform_get_meta($entry['id'], 'qr-code_feed_' . $feed['id'] . '_url');
                            $all_entries[$entry['id']][] = $entry;
                            $output .= creteEntryAndModal($entry, $form_name, $field_entry);
                            continue 2;
                        }
                    }
                }
            }
        }

        $output .= '</div>
            <script>
                jQuery(document).ready(function($){
                    $("form").on("submit",function(e){
                        $(`.form__registration_finder`).append(`<div id="spinner" class="spinner"></div>`);
                    });
                    $(`.single_entry__registration_finder`).on("click",function(){
                        const targetId = $(this).attr("id");
                        $(".modal__" + targetId).show();
                    });
                    $(`.modal_closer__registration_finder`).on("click", function(){
                        $(this).parent().parent().hide();
                    })
                    $(`.modal_container__registration_finder`).on("click", function(e){
                        if($(e.target).hasClass(`modal_container__registration_finder`)){
                            $(e.target).hide();
                            $(`.qr-code_image-full-width`).each(function(){
                                $(this).removeClass(`qr-code_image-full-width`);
                            })
                        }
                    });
                    $(`.modal-img__registration_finder`).on("click",function(e){
                        $(e.target).toggleClass(`qr-code_image-full-width`);
                    });
                });
            </script>
        ';
    }

    return $output;
}

add_action('vc_before_init', 'elements_registration_finder');
add_shortcode('elements_registration_finder', 'registration_finder_output');