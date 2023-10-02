<style>
    .vc_row:has(#badge-generator){
        background-color: lightgray;
    }
</style>
<?php
include_once plugin_dir_path(__FILE__) . 'main-custom-element.php';

echo '<div id="badge-generator">[gravityform id="'.$badge_form_id.'" title="false" description="false" ajax="false"]</div>';

    if (isset($_POST["submit"])){
        echo '<script>
                jQuery(function ($) {
                    const gfMessage = $(".gform_confirmation_message a");
                    if (gfMessage.length) {
                        const urlMessage = gfMessage.eq(0).attr("href")+"?parametr=masowy";
                        gfMessage.eq(0).attr("href", urlMessage)
                        gfMessage.eq(1).hide();
                        window.open(gfMessage.eq(1).attr("href"));
                    }
                });
            </script>';
        $multi_badge = array();
        $multi_badge['form_id'] = $badge_form_id;
        foreach ($_POST as $key => $value) {

            if (strpos(strtolower($key), 'input') !== false) {
                preg_match_all('/\d+/', $key, $id);
                $filed = $id[0][0];
                $multi_badge[$filed] = $value;
            }
        }
        
        // for($i=1; $i<$_POST['multi_send']; $i++){  
            $entry_id = GFAPI::add_entry($multi_badge);
            $meta_key = '';

            for ($i=0; $i<=300;$i++){
                if(gform_get_meta($entry_id , 'qr-code_feed_' . $i . '_url') != ''){
                    $meta_key = 'qr-code_feed_' . $i . '_url';
                    break;
                }
            }

            echo $meta_key . '<br>';
            $qr_code_url = (gform_get_meta($entry_id, $meta_key));
            $badge_url = 'https://warsawexpo.eu/assets/badge/local/loading.html?category='.$multi_badge[3].'&amp;getname='.$multi_badge[1].'&amp;firma='.$multi_badge[2].'&amp;qrcode='.$qr_code_url;
            echo '<script>window.open('.$badge_url.');</script>';
        // }
    }
?>
<script>
    jQuery(function ($) {
        const gfWraper = $('#gform_wrapper_'+<?php echo $badge_form_id ?>);
        const gfFields = gfWraper.find('.gform_fields');
        const gfButton = gfWraper.find('.gform_button');
        gfButton.attr('name', 'submit');
        const multiInput = $('<input>', {
            placeholder: 'ilość identyfikatorów',
            type: 'text',
            id: 'multi_send',
            name: 'multi_send'
        });
        gfFields.append(multiInput);
    });
</script>