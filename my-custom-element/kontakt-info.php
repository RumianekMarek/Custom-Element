<?php
    // var_dump($atts);

    if ($color != '#ffffff'){
        $color = '#000000 !important';
    } else {
        $invert = '.custom_element_'.$rnd_id.' #contact-info .contact-info-img-default{
            filter: invert(100%);
        }';
    }
    $preset_contact_header = ($locale == 'pl_PL') ? 'Obsługa wystawców' : 'Exhibitors service' ;
    $contact_head = (!empty($contact_header)) ? $contact_header : $preset_contact_header ;
echo '
    <style>
        .custom_element_'.$rnd_id.' #contact-info :is(a, p, h4, b){
            color: <?php echo $color ?>
        }

        <?php echo $invert ?>

        .raw-custom-container {
            display: flex;
            align-items: center;
        }
        .custom-container-contact-info-items .contact-info-img-custom {
            width:120px;
            height:120px;
        }
        .custom-container-contact-info-items .contact-info-img-default {
            width:120px;
            height:100px;
        }
    </style>

    <div id="contact-info" class="custom-container-contact">
    <div class="heading-text el-text main-heading-text hal-bloack-padding">
        <h4><?php echo $contact_head ?></h4>
    </div>';

    foreach($contact_items as $id => $contact){
            echo '<div class="custom-container-contact-info-items">
                    <div class="half-block-padding">';
                        if ($contact['url']){
                            echo '<div class="image-shadow"><img class="contact-info-img-custom" src="'.wp_get_attachment_url($contact['url']).'" alt="zdjęcie"></div>';
                        } elseif ($contact['img']){
                            echo '<div class="image-shadow"><img class="contact-info-img-custom" src="'.wp_get_attachment_url($contact['img']).'" alt="zdjęcie"></div>';
                        } else {
                            echo '<div class="image-shadow"><img class="contact-info-img-default" src="/wp-content/plugins/custom-element/media/WystawcyO.jpg" alt="zdjęcie"></div>';
                        }
                    echo '</div>
                <div class="uncode_text_column">';
                if ($id === 0){
                    echo '<p>Kierownik projektu: <b>'.$contact['name'].'</b></p>';
                } else {
                    echo '<p><b>'.$contact['name'].'</b></p>';
                }   
                    echo '<p>E-mail: <a href="mailto:'.$contact['phone'].'">'.$contact['phone'].'</a></p>
                    <p>Tel.: <a href="tel'.$contact['email'].'">'.$contact['email'].'</a></p>
                </div>
            </div>';
    }
    
    if(strpos($contact_content, 'wystawca') === false){
        echo ' 
        <div class="raw-custom-container half-block-padding">
            <div class="image-shadow">
                <div class="t-entry-visual">
                    <img src="/wp-content/plugins/custom-element/media/WystawcyZ.jpg" alt="grafika wystawcy">
                </div>
            </div>
            <div class="uncode_text_column">
                <p>';
                if($locale == 'pl_PL'){ 
                    echo 'Zostań wystawcą<br><a href="tel:48 517 121 906">+48 517 121 906</a>';
                } else { 
                    echo 'Become an Exhibitor<br><a href="tel:48 517 121 906">+48 517 121 906</a>';
                }
                echo '
                </p>
            </div>
        </div>';
    }
    
    if(strpos($contact_content, 'odwiedzajacy') === false){
        echo'
        <div class="raw-custom-container half-block-padding">
            <div class="image-shadow">
                <div class="t-entry-visual">
                    <img src="/wp-content/plugins/custom-element/media/Odwiedzajacy.jpg" alt="grafika odwiedzajacy">
                </div>
            </div>
            <div class="uncode_text_column">
                <p>';
                if($locale == 'pl_PL'){ 
                    echo 'Odwiedzający<br><a href="tel:48 513 903 628">+48 513 903 628</a>';
                } else { 
                    echo 'Visitors<br><a href="tel:48 513 903 628">+48 513 903 628</a>';
                }
                echo '
                </p>
            </div>
        </div>';
    }
    
    if(strpos($contact_content, 'media') === false){
        echo'
        <div class="raw-custom-container half-block-padding">
        <div class="image-shadow">
            <div class="t-entry-visual">
                <img src="/wp-content/plugins/custom-element/media/Media.jpg"  alt="grafika media">
            </div>
        </div>
        <div class="uncode_text_column">
            <p>';
            if($locale == 'pl_PL'){ 
                echo 'Współpraca z mediami<br><a href="mailto:media@warsawexpo.eu">media@warsawexpo.eu</a>';
            } else { 
                echo 'For Media<br><a href="mailto:media@warsawexpo.eu">media@warsawexpo.eu</a>';
            }
            echo '
            </p>
        </div>
        </div>';
    }
    
    if(strpos($contact_content, 'ob_wystawcy') === false){
        echo'
        <div class="raw-custom-container half-block-padding">
        <div class="image-shadow">
            <div class="t-entry-visual">
                <img src="/wp-content/plugins/custom-element/media/WystawcyO.jpg" alt="grafika obsluga">
            </div>
        </div>
        <div class="uncode_text_column">
            <p>';
            if($locale == 'pl_PL'){ 
                echo 'Obsługa Wystawców<br><a href="tel:48 501 239 338">+48 501 239 338</a>';
            } else { 
                echo 'Exhibitor service<br><a href="tel:48 501 239 338">+48 501 239 338</a>';
            }
            echo '
            </p>
        </div>
        </div>';
    }
    
    if(strpos($contact_content, 'technicy') === false){
        echo'
        <div class="raw-custom-container half-block-padding">
        <div class="image-shadow">
            <div class="t-entry-visual">
                <img src="/wp-content/plugins/custom-element/media/Technicy.jpg" alt="grafika technicy">
            </div>
        </div>
        <div class="uncode_text_column" style="overflow-wrap: anywhere;">
            <p>';
            if($locale == 'pl_PL'){ 
                echo 'Obsługa techniczna<br><a href="mailto:konsultanttechniczny@warsawexpo.eu">konsultanttechniczny<span style="display:block;">@warsawexpo.eu</span></a>';
            } else { 
                echo 'Technical service<br><a href="mailto:konsultanttechniczny@warsawexpo.eu">konsultanttechniczny<span style="display:block;">@warsawexpo.eu</span></a>';
            }
            echo '
            </p>
        </div>
        </div>';
    }

    return $html_content;
?>