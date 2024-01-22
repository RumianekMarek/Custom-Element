<?php 
if ($color != '#000000') {
    $color = 'white !important';
} else {
    $color = 'black';
}
if ($btn_color != ''){
    $btn_color = '.custom_element_'.$rnd_id.' .gallery-link-btn '.$btn_color;
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
        padding: 36px;
    }


.custom-profile-content {
    display: flex;
}
.custom-profile-text-block {
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.custom-profile-block {
    width: 50%;
}
.custom-profile-buttons {
    display: flex;
    justify-content: space-around;
    padding: 18px 0;
}
.custom-link {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.organizator-box-shadow-left {
    margin-left: -18px;
    margin-bottom: -20px;
    box-shadow: -3px -3px <?php echo $color ?>;
    width: 170px !important;
    height: 40px;
}
.organizator-box-shadow-right {
    margin-right: -18px;
    margin-top: -20px;
    box-shadow: 3px 3px <?php echo $color ?>;
    width: 170px !important;
    height: 40px;
    float: right;
}

</style>

<!-- $profile_border
$profile_border_color -->

<?php

$unique_id = 'section-' . rand(10000, 99999);

    $profile_image_url = wp_get_attachment_url($profile_image);

    echo '<div class="custom-container-profile">';

        // var_dump($profile_section_background);
        echo '<div class="custom-profile-section">
            <p class="organizator-box-shadow-left">&nbsp;</p>
            <div class="custom-profile-main-section">
                <div class="custom-profile-content">
                    <div class="custom-profile-text-block custom-profile-block">
                        <h5 style="color:'. $profile_title_color .'";>'. $profile_title .'</h5>
                        <div style="color:'. $profile_text_color .'";>'. $content .'</div>
                    </div>
                    <div class="custom-profile-image-block custom-profile-block">
                        <div>
                            <img src="'. $profile_image_url .'" alt="'. $profile_title .'">
                        </div>
                    </div>
                </div>
                <div class="custom-profile-buttons">';
                if (in_array('profile_btn_tick', explode(',', $profile_buttons))) {
                    echo '<div class="custom-btn-container">
                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/bilety/" alt="link do biletów">Kup bilet</a>
                    </div>';
                }
                if (in_array('profile_btn_rej', explode(',', $profile_buttons))) {
                    echo '<div class="custom-btn-container">
                        <a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/rejestracja/" alt="link do rejestracji">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>
                    </div>';
                }
                echo '</div>
            </div>
            <p class="organizator-box-shadow-right">&nbsp;</p>
        </div>';
    echo '</div>';

    

?>


    
