<?php 

function new_exhibitors_phone() {
    vc_map(array(
        'name' => __('New Exhibitors Phone', 'my-custom-plugin'),
        'base' => 'new_exhibitors_phone',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array( 
            array(
                'type' => 'textfield',
                'group' => 'PWE Element',
                'heading' => __('Insert Form ID', 'my-custom-plugin'),
                'param_name' => 'new_exhibitors_phone__form_id',
                'save_always' => true,
                'value' => '',
            ),
        ),
    ));
}

/**
 * Retrieves exhibitor data from the trade show catalog based on the given exhibitor ID.
 *
 * Makes a request to an external API using the token and show ID, then returns the exhibitor's data
 * as an associative array.
 *
 * @param string $exhibitor_id The ID of the exhibitor.
 * @return array|null Returns the exhibitor's data as an associative array, or null if no data exists.
 */
function catalog_data() {
    $katalog_id = do_shortcode('[trade_fair_catalog]');
    $exhibitor = array();
    $today = new DateTime();
    $formattedDate = $today->format('Y-m-d');
    $token = md5("#22targiexpo22@@@#".$formattedDate);
    $canUrl = 'https://export.www2.pwe-expoplanner.com/mapa.php?token='.$token.'&id_targow='.$katalog_id;
    $json = file_get_contents($canUrl);
    if ($json != null && $json != false){
        $data_array = json_decode($json, true);
        if(!is_array($data_array)){
            return null;
        }
        $exhibitors_data = reset($data_array)['Wystawcy'];
        shuffle($exhibitors_data);
        $exh_count = 0;
        foreach($exhibitors_data as $exh_one){
            if($exh_one['URL_logo_wystawcy'] != ''){
                $exhibitor[] = $exh_one['URL_logo_wystawcy'];
                $exh_count++;
            }
            if ($exh_count >= 5){
                break;
            }
        }
    };
    return  $exhibitor;
}   

/**
 * Retrieves exhibitor data from the trade show catalog based on the given exhibitor ID.
 *
 * Makes a request to an external API using the token and show ID, then returns the exhibitor's data
 * as an associative array.
 *
 * @param string $exhibitor_id The ID of the exhibitor.
 * @return array|null Returns the exhibitor's data as an associative array, or null if no data exists.
 */
function media_data() {
    $media_domain = do_shortcode('[trade_fair_domainadress]');
    $exh_media = array();
    $canUrl = ABSPATH. 'doc/Logotypy/Rotator 2/Patron Medialny/';
    $media_json = scandir($canUrl);
    shuffle($media_json);

    $media_count = 0;
    
    foreach($media_json as $media_one){
        if (strlen(trim($media_one)) > 4) {
            $exh_media[] = 'https://' . $media_domain .'/doc/Logotypy/Rotator%202/Patron%20Medialny/'. $media_one;
            $media_count++;
        }

        if ($media_count >= 5){
            break;
        }
    }
    return  $exh_media;
}   


function new_exhibitors_phone_output($atts, $content = '') {
    extract( shortcode_atts( array(
        'new_exhibitors_phone__form_id' => '',
    ), $atts ));

    $exh_data = [];

    $exhibitors_logo_path = ABSPATH. 'doc/Logotypy/Best Exhibitors/';
    if(is_dir($exhibitors_logo_path)){
        $exhi_array = scandir($exhibitors_logo_path);
        var_dump($exhi_array);
    } else {
        $exh_data = catalog_data();
    }

    $media_data = media_data();

    $html_returner = '';
    $html_returner .= '<style>
                            .container__pwe_new_exhibitors{
                                display: flex;
                                gap: 30px;
                            }
                            h4 {
                                margin: 10px 0 0 0;
                            }
                            .exhibitors_warning__pwe_new_exhibitors{
                                display: none;
                                color:red !important;
                            }
                            a h4, .domain_link__email{
                                color: blue !important;
                                text-decoration: underline;
                            }
                            td{
                                border-bottom: 0 !important;
                                border-left: 0 !important;
                            }
                            img:not(.qr_img__email){
                                vertical-align: middle;
                                width: 23%;
                            }
                            td img{
                                max-width: unset !important;
                            }
                            
                        </style>
                        <div class="container__pwe_new_exhibitors">
                            <div class="registration-form__pwe_new_exhibitors">
                                <h4 class="exhibitors_warning__pwe_new_exhibitors">Uwaga!! Brak Katalogu Wystawców</h4>
                                <br>
                                [gravityform id="'. $new_exhibitors_phone__form_id .'" title="false" description="false" ajax="false"]
                            </div>
                            <div class="notification__pwe_new_exhibitors">';

    $file_path_pl = plugin_dir_path(__FILE__) . 'new_exhibitors_email_pl.php';
    $file_path_en = plugin_dir_path(__FILE__) . 'new_exhibitors_email_en.php';

    if (file_exists($file_path_pl)) {
        ob_start();
        require_once $file_path_pl;
        $html_returner .= ob_get_clean();
    }

    if (file_exists($file_path_en)) {
        ob_start();
        require_once $file_path_en;
        $html_returner .= ob_get_clean();
    }
    
        $html_returner .= '</div>
                        </div>
                        <script>
                            jQuery(document).ready(function($){';
                                if($exh_data != null){
                                    foreach ($exh_data as $exh_index => $exh_single){
                                        $html_returner .= '$(".exhibitors' . $exh_index . '").attr("src", "' . $exh_single . '");
                                                            $(".exhibitors' . $exh_index . ' input").val("' . $exh_single . '");';
                                    }
                                } else {
                                    $html_returner .= '$(".exhibitors__email").hide();
                                                        $(".exhibitors__email").next().hide();
                                                        $(".exhibitors_warning__pwe_new_exhibitors").show();';
                                }

                                foreach ($media_data as $media_index => $media_single){
                                    $media_src = '$(".media' . $media_index . '").attr("src", "' . $media_single . '");';
                                    $html_returner .= '$(".media' . $media_index . '").attr("src", "' . $media_single . '")
                                                        $(".media' . $media_index . ' input").val("' . $media_single . '");';
                                }
                                
            $html_returner .= ' $(".gfield--type-radio input").on("change", function(){
                                    if($(this).next().text() == "PL"){
                                        $(".notification_pl").show();
                                        $(".notification_en").hide();
                                    } else {
                                        $(".notification_pl").hide();
                                        $(".notification_en").show();
                                    }   
                                });

                                $(".name_input input").on("input", function(){
                                    $(".name__email").text($(this).val());
                                });

                                $(".contant_info_input textarea").on("input", function(){
                                    const textWithBreaks = $(this).val().replace(/\n/g, "<br>");
                                    $(".contant_info").html(textWithBreaks);
                                });
                            });
                        </script>';
    return do_shortcode($html_returner);
}

add_action('vc_before_init', 'new_exhibitors_phone');
add_shortcode('new_exhibitors_phone', 'new_exhibitors_phone_output');