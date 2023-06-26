<?php
$files = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/wystawcy/*.{jpeg,jpg,png}', GLOB_BRACE);
$counter = 0;
?>

<div id="customExhibitors" class="custom-container-exhibitors-gallery custom-container-exhibitors-gallery-hide">
    <div class="custom-exhibitors-title main-heading-text">
        <h2 class="h4 font-weight-700 custom-uppercase"><span>Wystawcy [trade_fair_actualyear]</span></h2>
    </div>
    <div class="custom-exhibitors-gallery-wrapper single-top-padding">

    <?php
        foreach ($files as $file) {
            if ($counter >= 21) {
                break;
            }
            
            $shortPath = substr($file, strpos($file, '/doc/wystawcy/'));
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $url = 'https://' . $fileName;
        
            echo '<a href="' . $url . '" alt="logo ' . $fileName . '" target="_blank"><img class="custom-logo-exhibitor" src="' . $shortPath . '"></a>';
            
            $counter++;
        }
    ?>

    </div>
    <div class="custom-btn-container">
            <span class="pl_PL">
                <a class="custom-link btn border-width-0 shadow-main2 btn-accent btn-flat" href="/katalog-wystawcow/"  target="_blank">Zobacz więcej</a>
            </span>
            <span class="en_US">
                <a class="custom-link btn border-width-0 shadow-main2 btn-accent btn-flat" href="/en/exhibitors-catalog/"  target="_blank">See more</a>
            </span>
        </div>
</div>



