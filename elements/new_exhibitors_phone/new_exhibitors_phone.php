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

    $exh_data = catalog_data();
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
                                width: 18%;
                            }
                            td img{
                                max-width: unset !important;
                            }
                            
                        </style>';

    $html_returner .= '<div class="container__pwe_new_exhibitors">
                            <div class="registration-form__pwe_new_exhibitors">
                                [gravityform id="'. $new_exhibitors_phone__form_id .'" title="false" description="false" ajax="false"]
                            </div>

                            <div style=" text-align: justify; max-width: 600px; margin: 0 auto; font-family: "Open Sans", "Montserrat", sans-serif; "> 
                                <div>
                                    <img style="width: 100%" src="https://[trade_fair_domainadress]/doc/header-conference.jpg" alt="[trade_fair_name]" />
                                </div>
                                <div style="padding: 0 5px">
                                    <h3 style="font-size: 18px; margin: 20px 0 10px; text-align: left;">
                                        Dzień Dobry <span class="name__email"></span>
                                    </h3>
                                    <p style="font-size: 14px; margin: 25px 0 10px; text-align: center;">
                                        Dziękujemy za rejestrację na <strong>[trade_fair_conferance]</strong>, która odbędzie się podczas <strong>[trade_fair_name]</strong> w <strong>Ptak Warsaw Expo</strong>.<b> </b>
                                    </p>
                                    <p style="font-size: 14px; margin: 25px 0 10px; text-align: center;">
                                        <b>Szczegóły dotyczące wdarzenia znajdą Państwo na naszej stronie internetowej.</b>
                                    </p>
                                    <div style="border:3px solid #e64f31; max-width: 80%; margin: 12px auto; border-radius:20px; inline-size: fit-content;">
                                        <a target="_blank" href="https://[trade_fair_domainadress]/?exhibit={entry_id}">
                                            <img class="qr_img__email" style="padding: 10px;" src="https://[trade_fair_domainadress]/doc/qr_domain.png" width="150" height="150" />
                                        </a>
                                    </div>
                                    <div style="width: 80%; margin: 12px auto; border-radius:20px; inline-size: fit-content; text-align: center;">
                                        <a class="domain_link__email" target="_blank" href="https://[trade_fair_domainadress]/?exhibit={entry_id}">[trade_fair_domainadress]</a>
                                        <p style="font-size:11px; line-height: 18px;">Jeżeli nie widzisz kodu QR, wyłącz opcję blokowania obrazków dla tego maila.</p>
                                    </div>
                                    <div style="width: 95%; border-bottom:1px solid rgba(188,188,188, .4); margin:15px auto;"></div>
                                    <div class="exhibitors__email" style="display:inline-block; text-align:center;">
                                        <h4>Nasi wystawcy:</h4>
                                        <div>
                                            <img class="exhibitors0"/>
                                            <img class="exhibitors1"/>
                                            <img class="exhibitors2"/>
                                            <img class="exhibitors3"/>
                                            <img class="exhibitors4"/>
                                        </div>
                                        <a target="_blank" href="https://[trade_fair_domainadress]/katalog-wystawcow/"><h4>Sprawdź wszystkich wystawców</h4></a>
                                    </div>
                                    <div style="width: 95%; border-bottom:1px solid rgba(188,188,188, .4); margin:15px auto;"></div>
                                    <a target="_blank" href="https://[trade_fair_domainadress]/galeria/">
                                        <div class="gallery__email" style="display:inline-block; text-align:center;">
                                            <img style="width: 30%;" src="https://[trade_fair_domainadress]/doc/galeria/mini/mini1.webp"/>
                                            <img style="width: 30%;" src="https://[trade_fair_domainadress]/doc/galeria/mini/mini2.webp"/>
                                            <img style="width: 30%;" src="https://[trade_fair_domainadress]/doc/galeria/mini/mini3.webp"/>
                                            <h4>Zobacz galerię targów</h4>
                                        </div>
                                    </a>
                                    <div style="width: 95%; border-bottom:1px solid rgba(188,188,188, .4); margin:15px auto;"></div>
                                    <div class="patrons__email" style="display:inline-block; text-align:center;">
                                        <h4>Wspierają nas:</h4>
                                        <div>
                                            <img class="media0"/>
                                            <img class="media1"/>
                                            <img class="media2"/>
                                            <img class="media3"/>
                                            <img class="media4"/>
                                        </div>
                                    </div>
                                    <div style="width: 95%; border-bottom:1px solid rgba(188,188,188, .4); margin:15px auto;"></div>
                                    <table style="min-width:100%; background:url(https://[trade_fair_domainadress]/wp-content/plugins/PWElements/media/belka.jpg)" cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <td style="display: inline-block;  width: 48%; font-size:15px; padding:5px 0; min-width: 48%;">
                                                <a target="_blank" style="display: inline-block; width: 50px;  padding: 5px 5px 5px 15px" href="https://warsawexpo.eu/" class="btn__fb">
                                                        <img style="width:70px; height:40px;" src="https://[trade_fair_domainadress]/wp-content/plugins/PWElements/media/logo_pwe_ufi.webp" alt="fb__icon" />
                                                </a>
                                            </td>
                                            <td valign="center" align="center" style="display: inline-block;  width: 50%; padding:5px 0; min-width: 48%;">
                                                <div align="end" style="margin: 0px 0" class="socials">
                                                    <a target="_blank" style="display: inline-block; width: 40px;  padding-right: 10px;" href="[trade_fair_facebook]" class="btn__fb">
                                                        <img style="width:40px; height:40px;" src="https://[trade_fair_domainadress]/wp-content/plugins/PWElements/media/fb-cc.png" alt="fb__icon" />
                                                    </a>
                                                    <a target="_blank" style="display: inline-block; width: 40px;  " href="[trade_fair_instagram]" class="btn__fb">
                                                        <img style="width:40px; height:40px;" src="https://[trade_fair_domainadress]/wp-content/plugins/PWElements/media/instagram-cc.png" alt="insta__icon" />
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <p style="margin-top: 10px; padding: 0 5px; font-size: 12px" class="footer__rodo">
                                        Administratorem Pani/Pana danych osobowych jest spółka PTAK WARSAW EXPO sp. z o.o. z siedzibą w Nadarzynie (kod pocztowy: 05-830), przy Al. Katowickiej 62, wpisaną do rejestru przedsiębiorców Krajowego Rejestru Sądowego pod numerem KRS 0000671001, NIP 532544579. Dane osobowe będą przetwarzane zgodnie z Rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE (RODO), na podstawie art. 6 ust. 1 lit. a lub b ww. Rozporządzenia w celach wskazanych w treści ww. zgód. Dane będą przetwarzane do czasu wycofania zgody i będą podlegały okresowemu przeglądowi co 2 lata. Pani/a dane osobowe mogą być przekazane osobom trzecim, które przetwarzają dane osobowe w imieniu PTAK WARSAW EXPO sp. z o.o. na podstawie umów powierzenia tj. usługi IT, podmioty świadczące usługi marketingowe, podmioty przetwarzające dane w celu dochodzenia roszczeń i windykacji lub innych. Ma Pan/i możliwość dostępu do swoich danych, w celu ich sprostowania i usunięcia, przeniesienia danych oraz żądania ograniczenia ich przetwarzania ze względu na swoją szczególną sytuację, wniesienia sprzeciwu oraz wycofania udzielonej zgody w każdym momencie, przy czym, cofnięcie uprzednio wyrażonej zgody nie wpłynie na legalność przetwarzania przed jej wycofaniem, a także wniesienia skargi do organu nadzorczego - Prezesa Urzędu Ochrony Danych Osobowych. Dane nie będą przekazywane do państw trzecich oraz nie podlegają profilowaniu tj. automatycznemu podejmowaniu decyzji. Kontakt z administratorem możliwy jest pod adresem e-mail: rodo@warsawexpo.eu.
                                    </p>
                                </div>
                            </div>
                        </div>';
    $html_returner .= '<script>
                            jQuery(document).ready(function($){';
                                foreach ($exh_data as $exh_index => $exh_single){
                                    $html_returner .= '$(".exhibitors' . $exh_index . '").attr("src", "' . $exh_single . '");
                                                        $(".exhibitors' . $exh_index . ' input").val("' . $exh_single . '");';
                                }

                                foreach ($media_data as $media_index => $media_single){
                                    $media_src = '$(".media' . $media_index . '").attr("src", "' . $media_single . '");';
                                    $html_returner .= '$(".media' . $media_index . '").attr("src", "' . $media_single . '")
                                                        $(".media' . $media_index . ' input").val("' . $media_single . '");';
                                }
    
            $html_returner .= '$(".name_input input").on("input", function(){
                                    $(".name__email").text($(this).val());
                                });
                            });
                        </script>';
    return do_shortcode($html_returner);
}

add_action('vc_before_init', 'new_exhibitors_phone');
add_shortcode('new_exhibitors_phone', 'new_exhibitors_phone_output');