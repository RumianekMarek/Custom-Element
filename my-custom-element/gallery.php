<?php

    $miniFiles = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/mini/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);
    $originalFiles = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png,webp,JPEG,JPG,PNG,WEBP}', GLOB_BRACE);    

    if($gallery_images[0] != false){
        $files = $gallery_images;
        $file_count = count($files);
    } else {
        $file_count = 0;
    }

    if($file_count === 0){
        $files = !empty($miniFiles) ? $miniFiles : $originalFiles;
    } else {
        for($i=$file_count; $i<4; $i++){
            $files[] = !empty($miniFiles) ? $miniFiles[$i] : $originalFiles[$i];
        }
    }

    $topImages = array_slice($files, 0, 2);
    $bottomImages = array_slice($files, 2, 2);

    if ($btn_color != ''){
        $btn_color = '.custom_element_'.$rnd_id.' .gallery-link-btn '.$btn_color;
    }    
?>
<style>
    <?php echo $btn_color ?>
    
    .custom-gallery-wrapper {
        margin: 0 auto;
    }
    .custom-gallery-section {
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 36px;
    }
    .custom-gallery-thumbs-wrapper, .custom-gallery-desc-wrapper{
        width: 50%;
    }
    .custom-gallery-thumbs {
        display: flex;
        flex-direction: column;
        width: 100%;
    }
    .custom-gallery-desc {
        background-color: #eaeaea;
    }
    .custom-gallery-desc-wrapper .custom-btn-container, 
    .custom-gallery-thumbs-wrapper .custom-btn-container {
        display: flex;
        justify-content: left;
        text-align: center;
    } 
    .custom-gallery-thumbs-top, 
    .custom-gallery-thumbs-bottom {
        display: flex;
        width: 100%;
    }
    .custom-gallery-thumbs-top img, 
    .custom-gallery-thumbs-bottom img {
        width: 50%;
        padding: 5px;
    }
    @media (max-width: 960px) {
        .custom-gallery-section {
            flex-direction: column;
        }
        .custom-gallery-thumbs-wrapper {
            width: 100%;
        }
        .custom-gallery-desc-wrapper {
            width: 100%;
        }
    }
    @media (max-width: 500px) {
        .custom-gallery-desc-wrapper .custom-btn-container, 
        .custom-gallery-thumbs-wrapper .custom-btn-container {
            justify-content: center;
        }
    }
</style>

<div id="customGallery" class="custom-container-gallery style-accent-bg">
    <div class="custom-gallery-wrapper double-bottom-padding single-top-padding">
        <div class="custom-row-border">
            <div class="custom-box-top-left-white"></div>
        </div>
        <div class="custom-gallery-section">
            <div class="custom-gallery-thumbs-wrapper">
                <div class="custom-gallery-thumbs">
                    <div class="custom-gallery-thumbs-top">
                        <?php
                            foreach ($topImages as $file) {
                                $shortPath = substr($file, strpos($file, '/doc/'));
                                echo '<img class="mini-img" src="' . $shortPath . '" alt="mini galery picture">';
                            }
                        ?>
                    </div>
                    <div class="custom-gallery-thumbs-bottom">
                        <?php
                            foreach ($bottomImages as $file) {
                                $shortPath = substr($file, strpos($file, '/doc/'));
                                echo '<img class="mini-img" src="' . $shortPath . '" alt="mini galery picture">';
                            }
                        ?>
                    </div>
                    <div class="custom-btn-container gallery-link-btn">
                        <span><?php if($locale == 'pl_PL'){ echo '
                            <a class="custom-link btn border-width-0 btn-flat" href="/galeria/" alt="link do galerii">Przejdź do galerii</a>
                        ';} else { echo '
                            <a class="custom-link btn border-width-0 btn-flat" href="/en/gallery/" alt="link to gallery">Go to gallery</a>
                        ';} ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="custom-gallery-desc-wrapper">
                <div class="custom-gallery-desc shadow-black">
                    <div class="custom-gallery-desc-content single-block-padding custom-align-left">
                        <h3 style="margin: 0;">
                        <?php 
                            if ($gallery_title != ''){
                                echo $gallery_title;
                            } else {
                                if($locale == 'pl_PL'){ 
                                    echo '[trade_fair_desc]';
                                } else { 
                                    echo '[trade_fair_desc_eng]';
                                }
                            }
                            ?>
                        </h3>

                        <p><?php if($locale == 'pl_PL'){
                                if($gallery == '') { 
                                    echo '[trade_fair_name] to wydarzenie branżowe, którego celem jest zgromadzenie czołowych firm, ekspertów technicznych i praktyków związanych z sektorem w Polsce i całym regionie środkowo wschodniej Europy. Targi oferują doskonałą okazję do nawiązania relacji biznesowych, prezentacji innowacyjnych technologii oraz wymiany wiedzy i doświadczeń. [trade_fair_name] to miejsce, gdzie innowacje spotykają się z praktycznym zapotrzebowaniem, a potencjał branży jest wykorzystywany do maksimum.';
                                } else { echo urldecode(base64_decode($gallery));}
                            } else {
                                if($gallery == '') { 
                                    echo '[trade_fair_name_eng] is a industry event that aims to bring together leading companies, technical experts and practitioners from Poland and the entire Central and Eastern European region. The fair offers an excellent opportunity to establish business relationships, showcase innovative technologies and exchange knowledge and experience. [trade_fair_name_eng] is a place where innovation meets practical demand, and the potential of the industry is exploited to the maximum.';
                                } else { echo urldecode(base64_decode($gallery));}
                            } ?>
                        </p>
                        <?php if($tickets_available !== 'true'){
                            if($gallery_btn_link == '' && $gallery_btn_text == ''){
                                if($locale == 'pl_PL'){
                                    $gallery_btn_link ='/rejestracja/';
                                    $gallery_btn_text ='Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span>';
                                } else {
                                    $gallery_btn_link ='/en/registration/';
                                    $gallery_btn_text ='REGISTER<span style="display: block; font-weight: 300;">GET A FREE TICKET</span>';
                                }
                            }

                        echo'<div class="custom-btn-container">';
                            echo'<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="'.$gallery_btn_link.'" alt="link do rejestracji">'.$gallery_btn_text.'</a>';
                        echo'</div>';
                        } ?>
                    </div>
                </div>
                <?php if ($gallery_countdown === "true") {
                    include plugin_dir_path(__FILE__) . 'countdown.php'; 
                } ?>
            </div>
        </div>
        <div class="custom-row-border">
            <div class="custom-box-bottom-right-white"></div>
        </div>
    </div>
</div>
