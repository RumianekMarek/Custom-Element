<?php 
    $miniFiles = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/mini/*.{jpeg,jpg,png,JPG,JPEG,PNG}', GLOB_BRACE);
    $originalFiles = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png,JPG,JPEG,PNG}', GLOB_BRACE);

    $files = !empty($miniFiles) ? $miniFiles : $originalFiles;

    $topImages = array_slice($files, 0, 2);
    $bottomImages = array_slice($files, 2, 2);
    
    include plugin_dir_url( __FILE__ ) . 'custom-element.php';

?>

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
                    <div class="custom-btn-container">
                        <span><?php if($locale == 'pl_PL'){ echo '
                            <a class="custom-link btn border-width-0 btn-custom-black btn-flat" href="/galeria/" alt="link do galerii">Przejdź do galerii</a>
                        ';} else { echo '
                            <a class="custom-link btn border-width-0 btn-custom-black btn-flat" href="/en/gallery/" alt="link to gallery">Go to gallery</a>
                        ';} ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="custom-gallery-desc-wrapper">
                <div class="custom-gallery-desc shadow-black">
                    <div class="custom-gallery-desc-content single-block-padding custom-align-left">
                        <h3 style="margin: 0;"><?php if($locale == 'pl_PL'){ echo '
                            [trade_fair_desc]
                            ';} else { echo '
                            [trade_fair_desc_eng]
                            ';} ?>
                        </h3>

                        <p><?php if($locale == 'pl_PL'){
                                if($gallery == '') { 
                                    echo '[trade_fair_name] to nowe wydarzenie branżowe, którego celem jest zgromadzenie czołowych firm, ekspertów technicznych i praktyków związanych z sektorem [super_shortcode_1] w Polsce i całym regionie środkowo wschodniej Europy. Targi oferują doskonałą okazję do nawiązania relacji biznesowych, prezentacji innowacyjnych technologii oraz wymiany wiedzy i doświadczeń. [trade_fair_name] to miejsce, gdzie innowacje spotykają się z praktycznym zapotrzebowaniem, a potencjał branży [super_shortcode_1] jest wykorzystywany do maksimum.';
                                } else { echo urldecode(base64_decode($gallery));}
                            } else {
                                if($gallery == '') { 
                                    echo '[trade_fair_name_eng] is a new industry event that aims to bring together leading companies, technical experts and practitioners related to the [super_shortcode_2] sector in Poland and the entire Central and Eastern European region. The fair offers an excellent opportunity to establish business relationships, showcase innovative technologies and exchange knowledge and experience. [trade_fair_name_eng] is a place where innovation meets practical demand, and the potential of the [super_shortcode_2] industry is exploited to the maximum.';
                                } else { echo urldecode(base64_decode($gallery));}
                            } ?>
                        </p>
                        <?php if($tickets_available !== 'true'){
                        echo'<div class="custom-btn-container">';
                            if($locale == 'pl_PL'){
                                echo'<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/rejestracja/" alt="link do rejestracji" style="color:white !important;">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>';
                            } else {
                                echo'<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/en/registration/" alt="link to registration" style="color:white !important;">REGISTER<span style="display: block;font-weight: 300;">GET A FREE TICKET</span></a>';
                            }
                        echo'</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-row-border">
            <div class="custom-box-bottom-right-white"></div>
        </div>
    </div>
</div>
