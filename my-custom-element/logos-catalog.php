<link rel="stylesheet" type="text/css" href="/wp-content/plugins/custom-element/my-custom-element/css/slick-slider.css"/>

<?php
include_once plugin_dir_path(__FILE__) . 'main-katalog-wystawcow.php';
$files = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/' . $logoscatalog . '/*.{jpeg,jpg,png,JPEG,JPG,PNG}', GLOB_BRACE);
?>

<div id="customLogos" class="custom-container-logos-gallery custom-container-logos-gallery-hide">
    <div class="custom-logos-title main-heading-text">
        <h4 class="font-weight-700 custom-uppercase pl_PL"><span><?php echo $logoscatalog; ?></span></h4>
        <h4 class="font-weight-700 custom-uppercase en_US"><span><?php echo $titlelogoEn; ?></span></h4>
    </div>
    <div class="custom-logos-gallery-wrapper single-top-padding">

        <div class="custom-logos-gallery-slider slider-inner-container" id="small-preview">
                <?php
                    foreach ($files as $file) {

                        $shortPath = substr($file, strpos($file, '/doc/'));
                        $fileName = pathinfo($file, PATHINFO_FILENAME);
                        $url = 'https://' . $fileName;
                        if ($showurl == "true") {
                            echo '<a href="' . $url . '" alt="logo ' . $fileName . '" target="_blank"><img class="custom-logo-item" src="' . $shortPath . '"></a>';
                        } else {
                            echo '<div><img class="custom-logo-item" src="' . $shortPath . '"></div>';
                        }

                    }
                ?>
        </div>

    </div>
</div>

<script src="/wp-content/plugins/custom-element/my-custom-element/js/slick-slider.js"></script>

