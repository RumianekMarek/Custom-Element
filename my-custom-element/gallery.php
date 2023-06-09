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
            <div class="border-top-left"></div>
        </div>
        <div class="custom-gallery-section">

            <div class="custom-gallery-thumbs-wrapper">
                <div class="custom-gallery-thumbs">
                    <div class="custom-gallery-thumbs-top">
                        <?php
                            foreach ($topImages as $file) {
                                $shortPath = substr($file, strpos($file, '/doc/'));
                                echo '<img class="mini-img" src="' . $shortPath . '">';
                            }
                        ?>
                    </div>
                    <div class="custom-gallery-thumbs-bottom">
                        <?php
                            foreach ($bottomImages as $file) {
                                $shortPath = substr($file, strpos($file, '/doc/'));
                                echo '<img class="mini-img" src="' . $shortPath . '">';
                            }
                        ?>
                    </div>
                    <div class="custom-btn-container">
                        <span class="pl_PL">
                            <a class="custom-link btn border-width-0 shadow-white btn-flat" href="/galeria/"  target="_blank" style="color:white !important;">Przejdź do galerii</a>
                        </span>
                        <span class="en_US">
                            <a class="custom-link btn border-width-0 shadow-white btn-flat" href="/en/gallery/"  target="_blank" style="color:white !important;">Go to gallery</a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="custom-gallery-desc-wrapper">
                <div class="custom-gallery-desc shadow-black">
                    <div class="custom-gallery-desc-content single-block-padding custom-align-left">
                        <h3 style="margin: 0;" class="pl_PL">[trade_fair_desc]</h3>
                        <p class="pl_PL"><?php if($gallery == '') { 
                            echo '[trade_fair_name] to nowe wydarzenie branżowe, którego celem jest zgromadzenie czołowych firm, ekspertów technicznych i praktyków związanych z sektorem [super_shortcode_1] w Polsce i całym regionie środkowo wschodniej Europy. Targi oferują doskonałą okazję do nawiązania relacji biznesowych, prezentacji innowacyjnych technologii oraz wymiany wiedzy i doświadczeń. [trade_fair_name] to miejsce, gdzie innowacje spotykają się z praktycznym zapotrzebowaniem, a potencjał branży [super_shortcode_1] jest wykorzystywany do maksimum.';
                            } else {echo urldecode(base64_decode($gallery));} ?></p>
                        <h3 style="margin: 0;" class="en_US">[trade_fair_desc_eng]</h3>
                        <p class="en_US">[trade_fair_name_eng] is a new industry event that aims to bring together leading companies, technical experts and practitioners related to the [super_shortcode_2] sector in Poland and the entire Central and Eastern European region. The fair offers an excellent opportunity to establish business relationships, showcase innovative technologies and exchange knowledge and experience. [trade_fair_name_eng] is a place where innovation meets practical demand, and the potential of the [super_shortcode_2] industry is exploited to the maximum.</p>
                        <?php if($tickets_available !== 'true'){
                        echo'<div class="custom-btn-container">';
                            echo'<span class="pl_PL">';
                                echo'<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/rejestracja/"  target="_blank">Zarejestruj się<span style="display: block; font-weight: 300;">Odbierz darmowy bilet</span></a>';
                            echo'</span>';
                            echo'<span class="en_US">';
                                echo'<a class="custom-link btn border-width-0 shadow-black btn-accent btn-flat" href="/en/registration/"  target="_blank">REGISTER<span style="display: block; font-weight: 300;">GET A FREE TICKET</span></a>';
                            echo'</span>';
                        echo'</div>';
                        } ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="custom-row-border">
            <div class="border-bottom-right"></div>
        </div>
    </div>
</div>