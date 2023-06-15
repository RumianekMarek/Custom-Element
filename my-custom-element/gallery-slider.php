<?php
$files = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png}', GLOB_BRACE);
?>
<link href="/wp-content/plugins/custom-element/css/fotorama.css" rel="stylesheet">

<div id="customSliderGallery" class="custom-container-slider-gallery">
    <div class="custom-slider-gallery-wrapper" style="margin: 0 auto; max-width: 1000px;">
        <div 
        id="galleryContainer"
        class="fotorama" 
        data-allowfullscreen="native" 
        data-nav="thumbs" 
        data-navposition="middle"
        data-thumbwidth="144"
        data-thumbheight="96"
        data-transition="crossfade" 
        data-loop="true" 
        data-autoplay="true" 
        data-arrows="true" 
        data-click="true"
        data-swipe="false">

        <?php
        foreach ($files as $file) { 
            $shortPath = substr($file, strpos($file, '/doc/'));
            echo '<img src="' . $shortPath . '">';
        }
        ?>

        </div>
    </div>
</div>

<script src="/wp-content/plugins/custom-element/js/fotorama.js"></script>
