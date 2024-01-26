<?php 
if ($color != '#000000') {
    $color = 'white !important';
} else {
    $color = 'black';
}
if ($btn_color != ''){
    $btn_color = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color;
    if ($btn_color_hover) {
        $btn_color_hover = '.custom_element_'.$rnd_id.' .custom-btn-container '.$btn_color_hover;
    }
}
if ($profile_img_max_width == '') {
    $profile_img_max_width = '80%';
}
if ($profile_img_aspect_ratio == '') {
    $profile_img_aspect_ratio = '3/2';
}
if ($profile_padding_element == '') {
    $profile_padding_element = '18px 36px';
}
?>

<style>

<?php echo $btn_color ?>
<?php echo $btn_color_hover ?>

.custom_element_<?php echo $rnd_id ?> {
    margin: 0 !important;
}
.row-parent:has(.custom_element_<?php echo $rnd_id ?> .custom-container-profile) {
    max-width: 100%;
    padding: 0 !important;  
}
.custom_element_<?php echo $rnd_id ?> .custom-profile-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: <?php echo $profile_padding_element ?>;   
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
.custom-profile-text-block h4 {
    font-size: 20px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
}
.custom-profile-images-block {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.custom-profile-images-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 36px
}
.custom_element_<?php echo $rnd_id ?> .custom-profile-image {
    object-fit: cover;
    max-width: <?php echo $profile_img_max_width ?>;
    aspect-ratio: <?php echo $profile_img_aspect_ratio ?>;
}
.custom-profile-block {
    width: 50%;
    margin: 0 auto;
}
.custom-profile-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 18px 0;
}
.custom_element_<?php echo $rnd_id ?> .custom-link {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.custom_element_<?php echo $rnd_id ?> .organizator-box-shadow-left {
    margin-left: -10px;
    margin-bottom: -31px;
    box-shadow: -3px -3px <?php echo $color ?>;
    width: 170px !important;
    height: 40px;
}
.custom_element_<?php echo $rnd_id ?> .organizator-box-shadow-right {
    margin-right: -10px;
    margin-top: -46px;
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
@media (max-width: 600px) {
    .custom_element_<?php echo $rnd_id ?> .custom-profile-image {
        max-width: 100%;
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

    $unique_id = rand(10000, 99999);
    $element_unique_id = 'profil-' . $unique_id;

    if (in_array('profile_title_visitors', explode(',', $profile_title_checkbox))) {
        $profile_id = "profil-odwiedzajacego";
        $custom_profile_title = ($locale == 'pl_PL') ? "Profil odwiedzającego" : "Visitor profile"; 
    } else if (in_array('profile_title_exhibitors', explode(',', $profile_title_checkbox))) {
        $profile_id = "profil-wystawcy";
        $custom_profile_title = ($locale == 'pl_PL') ? "Profil wystawcy" : "Exhibitor profile";
    } else if (in_array('profile_title_scope', explode(',', $profile_title_checkbox))) {
        $profile_id = "zakres-branzowy";
        $custom_profile_title = ($locale == 'pl_PL') ? "Zakres branżowy" : "Industry scope";
        $custom_profile_class_title = "class=main-heading-text";
    } else {
        $custom_profile_title = $profile_title;
        $profile_id = $element_unique_id;
    }

    echo '<div id="'. $profile_id .'" class="custom-container-profile" style="background-color:'. $profile_background .';">';
        echo '<div class="custom-profile-wrapper">';
            if (in_array('border_top', explode(',', $profile_border))) {  
                echo '<p class="organizator-box-shadow-left">&nbsp;</p>';
            }
            echo'<div class="custom-profile-main-section">
                <div class="custom-profile-content">
                    <div class="custom-profile-text-block custom-profile-block">';
                        if ($custom_profile_title) {
                            echo'<div '. $custom_profile_class_title .'><h4 class="custom-uppercase" style="color:'. $color .'";>'. $custom_profile_title .'</h4></div>';
                        }
                        echo'<div style="color:'. $color .'";>'. $content .'</div>
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
                                    echo '<img class="custom-profile-image '. $t_entry_visual .'" src="'. $profile_image_url_media .'" alt="'. $profile_title .'">';
                                } else if (empty($profile_image_url_media) && !empty($profile_image_doc)) {
                                    echo '<img class="custom-profile-image '. $t_entry_visual .'" src="/doc/galeria/'. $profile_image_doc .'" alt="'. $profile_title .'">';
                                } else if (!empty($profile_image_url_media) && !empty($profile_image_doc)) {
                                    echo '<img class="custom-profile-image '. $t_entry_visual .'" src="/doc/galeria/'. $profile_image_doc .'" alt="'. $profile_title .'">';
                                }
                            }
                        echo'</div>
                    </div>
                </div>';

                if ($locale == 'pl_PL') {
                    $profile_tickets_button_link = empty($profile_tickets_button_link) ? "/bilety/" : $profile_tickets_button_link;
                    $profile_register_button_link = empty($profile_register_button_link) ? "/rejestracja/" : $profile_register_button_link;
                    $profile_exhibitors_button_link = empty($profile_exhibitors_button_link) ? "/zostan-wystawca/" : $profile_exhibitors_button_link;
                } else {
                    $profile_tickets_button_link = empty($profile_tickets_button_link) ? "/en/tickets/" : $profile_tickets_button_link;
                    $profile_register_button_link = empty($profile_register_button_link) ? "/en/registration/" : $profile_register_button_link;
                    $profile_exhibitors_button_link = empty($profile_exhibitors_button_link) ? "/en/become-an-exhibitor/" : $profile_exhibitors_button_link;
                }

                if (in_array('profile_btn_tick', explode(',', $profile_buttons)) || in_array('profile_btn_rej', explode(',', $profile_buttons)) || in_array('profile_btn_exhib', explode(',', $profile_buttons))) {
                    echo '  <div class="custom-profile-buttons">';
                    if (in_array('profile_btn_tick', explode(',', $profile_buttons))) {
                        echo '  <div class="custom-btn-container">';
                                    if ($locale == 'pl_PL'){ echo '
                                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_tickets_button_link .'" alt="link do biletów">Kup bilet</a>';
                                    } else { echo '
                                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_tickets_button_link .'" alt="link to tickets">Buy a ticket</a>';
                                    }   
                            echo'</div>';
                    }
                    if (in_array('profile_btn_rej', explode(',', $profile_buttons))) {
                        echo '  <div class="custom-btn-container">';
                                    if ($locale == 'pl_PL'){ echo '
                                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_register_button_link .'" alt="link do rejestracji">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>';
                                    } else { echo '
                                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_register_button_link .'" alt="link to registration">Register<span style="display: block; font-weight: 300;">Get a free ticket</span></a>';
                                    }   
                            echo'</div>';
                    }
                    if (in_array('profile_btn_exhib', explode(',', $profile_buttons))) {
                        echo '  <div class="custom-btn-container">';
                                    if ($locale == 'pl_PL'){ echo '
                                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_exhibitors_button_link .'" alt="link do rejestracji wystawców">Zostań wystawcą</span></a>';
                                    } else { echo '
                                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'. $profile_exhibitors_button_link .'" alt="link to exhibitor registration">Book a stand</span></a>';
                                    }   
                            echo'</div>';
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