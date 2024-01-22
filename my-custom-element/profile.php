<?php 
if ($color != '#000000') {
    $color = 'white !important';
} else {
    $color = 'black';
}
if ($btn_color != ''){
    $btn_color = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color;
}
?>

<style>

<?php echo $btn_color ?>

.row-parent:has(.custom_element_<?php echo $rnd_id ?>) {
    max-width: 100%;
    padding: 0 !important;
}
.custom_element_<?php echo $rnd_id ?> {
    background-color: <?php echo $profile_background ?>;
    margin: 0 !important;
}
.custom_element_<?php echo $rnd_id ?> .custom-container-profile {
    max-width: 1200px;
    margin: 0 auto;
    padding: 42px 36px 72px;
}
.custom-profile-content {
    display: flex;
    gap: 36px;
}
.custom-profile-text-block {
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.custom-profile-images-block {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.custom-profile-images-wrapper {
    display: flex;
    flex-direction: column;
    gap: 36px
}
.custom-profile-block {
    width: 50%;
}
.custom-profile-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 18px 0;
}
.custom-link {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.custom_element_<?php echo $rnd_id ?> .organizator-box-shadow-left {
    margin-left: -18px;
    margin-bottom: -20px;
    box-shadow: -3px -3px <?php echo $color ?>;
    width: 170px !important;
    height: 40px;
}
.custom_element_<?php echo $rnd_id ?> .organizator-box-shadow-right {
    margin-right: -18px;
    margin-top: -20px;
    box-shadow: 3px 3px <?php echo $color ?>;
    width: 170px !important;
    height: 40px;
    float: right;
}

@media (max-width: 960px) {
    .custom-profile-content {
        flex-direction: column;
    }
    .custom-profile-block {
        width: 100% !important;
    }
}

</style>

<?php

    $mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);

    if ($mobile == 1) {
        echo
        '<style>
            .custom_element_'. $rnd_id .' .custom-profile-content {
                flex-direction: column-reverse;
            }
        </style>';
    } else if ($mobile != 1 && $profile_reverse_block == 'true') {
        echo
        '<style>
            .custom_element_'. $rnd_id .' .custom-profile-content {
                flex-direction: row-reverse;
            }
        </style>';
    }

    if ($profile_box_shadow == "true") {
        $t_entry_visual = "t-entry-visual";
    }

    echo '<div class="custom-container-profile">';
        echo '<div class="custom-profile-section">';
            if (in_array('border_top', explode(',', $profile_border))) {  
                echo '<p class="organizator-box-shadow-left">&nbsp;</p>';
            }
            echo'<div class="custom-profile-main-section">
                <div class="custom-profile-content">
                    <div class="custom-profile-text-block custom-profile-block">
                        <div class="'. $profile_title_class .'"><h5 class="custom-uppercase" style="color:'. $color .'";>'. $profile_title .'</h5></div>
                        <div style="color:'. $color .'";>'. $content .'</div>
                    </div>
                    <div class="custom-profile-images-block custom-profile-block">
                        <div class="custom-profile-images-wrapper image-shadow">';
                            $profile_images_urldecode = urldecode($profile_images);
                            $profile_images_json = json_decode($profile_images_urldecode, true);
                            foreach ($profile_images_json as $profile_image) {
                                $profile_image_media = $profile_image["catalog_media"];
                                $profile_image_url_media = wp_get_attachment_url($profile_image_media);
                                $profile_image_doc = $profile_image["catalog_doc"];
                                if (!empty($profile_image_url_media) && empty($profile_image_doc)) {
                                    echo '<img class="'. $t_entry_visual .'" src="'. $profile_image_url_media .'" alt="'. $profile_title .'">';
                                } else if (empty($profile_image_url_media) && !empty($profile_image_doc)) {
                                    echo '<img class="'. $t_entry_visual .'" src="/doc/galeria/'. $profile_image_doc .'" alt="'. $profile_title .'">';
                                } else if (!empty($profile_image_url_media) && !empty($profile_image_doc)) {
                                    echo '<img class="'. $t_entry_visual .'" src="/doc/galeria/'. $profile_image_doc .'" alt="'. $profile_title .'">';
                                }
                            }
                        echo'</div>
                    </div>
                </div>';

                $profile_tickets_button_link = empty($profile_tickets_button_link) ? "/bilety/" : $profile_tickets_button_link;
                $profile_register_button_link = empty($profile_register_button_link) ? "/rejestracja/" : $profile_register_button_link;
                $profile_exhibitors_button_link = empty($profile_exhibitors_button_link) ? "/zostan-wystawca/" : $profile_exhibitors_button_link;

                if (in_array('profile_btn_tick', explode(',', $profile_buttons)) || in_array('profile_btn_rej', explode(',', $profile_buttons)) || in_array('profile_btn_exhib', explode(',', $profile_buttons))) {
                    echo '  <div class="custom-profile-buttons">';
                    if (in_array('profile_btn_tick', explode(',', $profile_buttons))) {
                        echo '  <div class="custom-btn-container">
                                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_tickets_button_link .'" alt="link do biletów">Kup bilet</a>
                                </div>';
                    }
                    if (in_array('profile_btn_rej', explode(',', $profile_buttons))) {
                        echo '  <div class="custom-btn-container">
                                    <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_register_button_link .'" alt="link do rejestracji">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>
                                </div>';
                    }
                    if (in_array('profile_btn_exhib', explode(',', $profile_buttons))) {
                        echo '  <div class="custom-btn-container">
                                    <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_exhibitors_button_link .'" alt="link do rejestracji wystawców">Zostań wystawcą</span></a>
                                </div>';
                    }
                    echo '</div>';
                }
                
            echo '</div>';
            if (in_array('border_bottom', explode(',', $profile_border))) {
                echo '<p class="organizator-box-shadow-right">&nbsp;</p>';
            }
        echo '</div>
    </div>';

?>

<?php if ($mobile == 1) { ?>
<script>
    {
        const imagesProfiles = document.querySelector('.custom_element_<?php echo $rnd_id ?> .custom-profile-images-wrapper');
        if (imagesProfiles && imagesProfiles.children.length > 1) {
            for (let i = 1; i < imagesProfiles.children.length; i++) {
                imagesProfiles.children[i].style.display = 'none';
            }
        }
    }
</script>
<?php } ?>