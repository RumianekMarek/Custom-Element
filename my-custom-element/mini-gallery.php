<?php
    $miniFiles = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/mini/*.{jpeg,jpg,png,JPG,JPEG,PNG}', GLOB_BRACE);
    $originalFiles = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/galeria/*.{jpeg,jpg,png,JPG,JPEG,PNG}', GLOB_BRACE);

    $files = !empty($miniFiles) ? $miniFiles : $originalFiles;

    $topImages = array_slice($files, 0, 2);
    $bottomImages = array_slice($files, 2, 2);
?>

<div id="miniGallery" class="custom-container-mini-gallery">
    
                <div class="custom-gallery-thumbs-wrapper" style="width:100% !important;">
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

</div>
