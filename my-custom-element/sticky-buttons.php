<?php
    if ($color != '#000000'){
        $color = '#ffffff';
    }
?>

<style>
.wpb_column:has(.custom-container-sticky-buttons) {
    padding-top: 0 !important;
}
.custom-sticky-buttons-full-size, .custom-sticky-buttons-cropped {
    position: relative;
    display: flex;
    justify-content: center;
    padding: 18px;
    width: 100%;
    gap: 20px;
}
<?php if ($sticky_buttons_dropdown !== "true") { ?>
.custom-sticky-buttons-cropped:before {
    content: "";
    background-color: rgba(255, 255, 255, 0.1);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}
<?php } ?>
.custom-sticky-buttons-full-size {
    background-color: white;
    z-index: 3;
}
.custom-sticky-buttons-cropped-container {
    width: 100%;
    top: 0;
    z-index: 2;
}
.custom-sticky-head-container {
    padding: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    cursor: pointer;
}
.custom-sticky-head-container * {
    margin: 0;
}
.custom-sticky-button-item {
    text-align: center;
    transition: 0.3s ease;
    z-index: 2;
}
.custom-sticky-button-item:hover {
    transform: scale(1.1);
}
.custom-sticky-button-item img {
    border-radius: 8px;
    max-width: 170px;
    object-fit: cover;
    cursor: pointer;
}
.custom-button-cropped {
    aspect-ratio: 21/9;
}
.custom-button-full-size {
    aspect-ratio: 1/1;
}
.custom-container-sticky-buttons .fa-chevron-down {
    transition: 0.3s ease !important;
}
.custom-sticky-button-item-active {
    width: 100% !important;
    position: fixed !important;
    top: 0;
    z-index: 2;
    transition: transform 0.5s !important;
}
@media (max-width: 600px) {
    .custom-sticky-buttons-full-size {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 0 auto;
        gap: 10px;
     }
    .custom-sticky-button-item {
       width: 31%;
       padding: 0;
    }
    .custom-sticky-button-item img {
        width: 100%;
    }
    .custom-sticky-button-item:hover {
      transform: unset;
    }
}

</style>

<?php

$mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);

$sticky_buttons_urldecode = urldecode($sticky_buttons);
$sticky_buttons_json = json_decode($sticky_buttons_urldecode, true);

$buttons_urls = array();
$full_size_buttons_urls = array();

echo '<div id="stickyButtons" class="custom-container-sticky-buttons">';
    echo '<div class="custom-sticky-buttons-full-size" style="display: none; background-color: ' . $sticky_buttons_full_size_background . ' ;">';

    if (is_array($sticky_buttons_json)) {
        foreach ($sticky_buttons_json as $sticky_button) {

            $attachment_full_size_img_id = $sticky_button["sticky_buttons_full_size_images"];
            $link = $sticky_button["sticky_buttons_link"];
            $button_id = $sticky_button["sticky_buttons_id"];
            $image_full_size_url = wp_get_attachment_url($attachment_full_size_img_id);
            $full_size_buttons_urls[] = $image_full_size_url;

            if (!empty($image_full_size_url) && !empty($link)) {
                echo '<div class="custom-sticky-button-item">';
                echo '<a href="'. $link .'"><img style="aspect-ratio:'. $sticky_buttons_aspect_ratio_full_size .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-full-size" src="' . esc_url($image_full_size_url) . '" alt="sticky-button-'. $attachment_full_size_img_id .'"></a>';
                echo '</div>';
            } else if (!empty($image_full_size_url)) {
                echo '<div class="custom-sticky-button-item">';
                echo '<img style="aspect-ratio:'. $sticky_buttons_aspect_ratio_full_size .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-full-size" src="' . esc_url($image_full_size_url) . '" alt="sticky-button-'. $attachment_full_size_img_id .'">';
                echo '</div>';
            }
        }
    } else {
        echo 'Invalid JSON data.';
    }

    $buttons_urls_json = json_encode($buttons_urls);
    $full_size_buttons_urls_json = json_encode($full_size_buttons_urls);

    echo '</div>';
    echo '
    <div class="custom-sticky-buttons-cropped-container">
        <div class="custom-sticky-head-container style-accent-bg" style="display: none; background-color: ' . $sticky_buttons_cropped_background . ' ;">
            <h4 class="custom-sticky-head-text" style="color:'. $color .' !important;">Wybierz kongres &nbsp;</h4>
            <i class="fa fa-chevron-down fa-1x fa-fw" style="color:'. $color .' !important;"></i>
        </div>
        <div class="custom-sticky-buttons-cropped style-accent-bg" style="display: none; background-color: ' . $sticky_buttons_cropped_background . ' ;">
        ';

        if (is_array($sticky_buttons_json)) {
            foreach ($sticky_buttons_json as $sticky_button) {

                $attachment_img_id = $sticky_button["sticky_buttons_images"];
                $link = $sticky_button["sticky_buttons_link"];
                $button_id = $sticky_button["sticky_buttons_id"];
                $image_url = wp_get_attachment_url($attachment_img_id);
                $buttons_urls[] = $image_url;

                if (!empty($image_url) && !empty($link)) {
                    echo '<div class="custom-sticky-button-item">';
                    echo '<a href="'. $link .'"><img style="aspect-ratio:'. $sticky_buttons_aspect_ratio .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-cropped" src="' . esc_url($image_url) . '" alt="sticky-button-'. $attachment_img_id .'"></a>';
                    echo '</div>';
                } else if (!empty($image_url)) {
                    echo '<div class="custom-sticky-button-item">';
                    echo ' <img style="aspect-ratio:'. $sticky_buttons_aspect_ratio .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-cropped" src="' . esc_url($image_url) . '" alt="sticky-button-'. $attachment_img_id .'">';
                    echo '</div>';
                }
            }
        } else {
            echo 'Invalid JSON data.';
        }

        $buttons_urls_json = json_encode($buttons_urls);
        $full_size_buttons_urls_json = json_encode($full_size_buttons_urls);

            echo'</div>
        </div>
    </div>';
?>


<script>

    window.onload = function() {
        const btnLinks = "<?php echo $link ?>";
        const stickyButtonsDropdown = "<?php echo $sticky_buttons_dropdown ?>";
        const stickyButtonsFullSize = "<?php echo $sticky_buttons_full_size ?>";
        const containerTiles = document.querySelector('.row-container:has(.custom-container-sticky-buttons)');
        const tilesCroppedContainer = document.querySelector('.custom-sticky-buttons-cropped-container');
        const tilesCropped = document.querySelector('.custom-sticky-buttons-cropped');
        const tilesFullSize = document.querySelector('.custom-sticky-buttons-full-size');
        const containerMasthead = document.querySelector('#masthead .menu-container');
        const containerPageHeader = document.querySelector('#page-header');
        const adminBar = document.querySelector('#wpadminbar');
        const desktop = <?php echo $mobile ?> === 0;
        const mobile = <?php echo $mobile ?> === 1;
        const stickyHeadContainer = document.querySelector(".custom-sticky-head-container");
        const nextElement = containerTiles.nextElementSibling;
        let offsetTop;
        
        setTimeout(() => {
            let isStuckMasthead = document.querySelector('#masthead').classList.contains("is_stuck");
            if (desktop) {
                if (containerPageHeader && containerPageHeader.offsetHeight !== undefined) {
                    offsetTop = containerTiles.offsetTop + containerPageHeader.offsetHeight;
                } else if (!containerPageHeader) {
                    offsetTop = containerTiles.offsetTop;
                } 
            } else if (mobile) {
                if (containerPageHeader && containerPageHeader.offsetHeight !== undefined) {
                    offsetTop = containerTiles.offsetTop - containerPageHeader.offsetHeight - containerMasthead.offsetHeight;
                } else if (!containerPageHeader) {
                    if (isStuckMasthead && adminBar) {
                        offsetTop = containerTiles.offsetTop  - containerMasthead.offsetHeight - adminBar.offsetHeight;
                    } else if (!isStuckMasthead && adminBar) {
                        offsetTop = containerTiles.offsetTop + containerMasthead.offsetHeight - adminBar.offsetHeight;
                    } else if (isStuckMasthead && !adminBar) {
                        offsetTop = containerTiles.offsetTop  - containerMasthead.offsetHeight;
                    } else if (!isStuckMasthead) {
                        offsetTop = containerTiles.offsetTop;
                    }
                }
            }
        }, 500);

        const beforeDiv = document.createElement('div');
        beforeDiv.classList.add('before');
        beforeDiv.style.height = tilesCroppedContainer.offsetHeight + 'px';

        const hideElement = (element) => {
            element.style.display = 'none';
        };
        const showElement = (element, displayValue = 'flex') => {
            element.style.display = displayValue;
        };
        const setElementPosition = (element, position) => {
            element.style.position = position;
        };

        if (stickyButtonsDropdown !== 'true') {
            showElement(stickyHeadContainer);
            if (stickyButtonsFullSize === 'true') { // dropdown on full size on
                setElementPosition(tilesCroppedContainer, 'absolute');
                hideElement(tilesCropped);
                showElement(tilesFullSize);
            } else { // dropdown on full size off
                hideElement(tilesCropped);
            }
        } else {
            if (stickyButtonsFullSize === 'true') { // dropdown off full size on
                setElementPosition(tilesCroppedContainer, 'absolute');
                hideElement(stickyHeadContainer);
                showElement(tilesCropped);
                showElement(tilesFullSize);
            } else { // dropdown off full size off
                hideElement(tilesCroppedContainer);
                showElement(tilesFullSize);
            }
        }

        window.addEventListener('scroll', function() {
            const scrollTop = window.scrollY;
            
            if (scrollTop >= offsetTop) {
                let isStuckMasthead = document.querySelector('#masthead').classList.contains("is_stuck");
                tilesCroppedContainer.classList.add('custom-sticky-button-item-active');

                if (stickyButtonsDropdown !== "true" && stickyButtonsFullSize !== "true") {
                    nextElement.style.paddingTop = stickyHeadContainer.offsetHeight + 'px';
                    tilesCroppedContainer.style.position = 'absolute';
                }

                if (tilesCroppedContainer.classList.contains("custom-sticky-button-item-active") && isStuckMasthead && adminBar && (desktop || mobile)) {
                    tilesCroppedContainer.style.top = containerMasthead.offsetHeight + adminBar.offsetHeight + 'px';
                } else if (tilesCroppedContainer.classList.contains("custom-sticky-button-item-active") && !isStuckMasthead && adminBar && (desktop || mobile)) {
                    tilesCroppedContainer.style.top = adminBar.offsetHeight + 'px';
                } else if (tilesCroppedContainer.classList.contains("custom-sticky-button-item-active") && isStuckMasthead && !adminBar && (desktop || mobile)) {
                    tilesCroppedContainer.style.top = containerMasthead.offsetHeight + 'px';
                } else if (tilesCroppedContainer.classList.contains("custom-sticky-button-item-active") && !isStuckMasthead && !adminBar && (desktop || mobile)) {
                    tilesCroppedContainer.style.top = '0px';
                }  

            } else {
                tilesCroppedContainer.classList.remove('custom-sticky-button-item-active');
                nextElement.style.paddingTop = '0';
                if (!containerMasthead.classList.contains("is_stuck")) {
                    tilesCroppedContainer.style.top = '0';
                }
                if (stickyButtonsDropdown !== "true" && stickyButtonsFullSize !== "true") {
                    tilesCroppedContainer.style.position = 'relative';
                }
            }
        });

        if (btnLinks !== "true") {
            document.querySelectorAll('.custom-image-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    var targetId = button.id.replace('-btn', '');
                    
                    // Ukryj wszystkie elementy .vc_row.row-container
                    var hideSections = document.querySelectorAll('.page-wrapper .vc_row.row-container.hide-section');
                    hideSections.forEach(function(section) {
                        section.style.display = 'none';
                    });

                    // Pokaż elementy
                    var targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.style.display = 'block';
                    }
                });
            });
        }
        
        document.querySelectorAll(".custom-image-button").forEach(function(button) {
            let customScrollTop;
            if (containerPageHeader) {
                customScrollTop = containerPageHeader.offsetHeight + containerMasthead.offsetHeight + containerTiles.offsetHeight + "px";
            } else {
                customScrollTop = containerMasthead.offsetHeight + containerTiles.offsetHeight + "px";
            }
            const scrollTopValue = parseInt(customScrollTop);
            button.addEventListener("click", function() {
                window.scrollTo({ top: scrollTopValue, behavior: "smooth" });
            });
        });
        
        if (stickyButtonsDropdown !== "true") {

            jQuery(document).ready(function($) {
                var $congressMenuSlide = $(".custom-sticky-buttons-cropped-container");

                // Funkcja do sprawdzania, czy kliknięcie/najechanie nastąpiło poza .custom-container-sticky-buttons
                $(document).on("click", function (event) {
                    if (!$(event.target).closest(".custom-sticky-buttons-cropped-container").length) {
                        $(".custom-sticky-buttons-cropped").slideUp();
                        $(".custom-sticky-buttons-cropped-container .custom-sticky-head-container i").removeClass("fa-chevron-up").addClass("fa-chevron-down");
                    }
                });

                // Obsługa kliknięcia w .custom-sticky-head-container
                $congressMenuSlide.find(".custom-sticky-head-container").click(function () {
                    toggleMenu($(this));
                });

                // Obsługa najechania myszką na .custom-sticky-head-container tylko dla szerokości >= 1300px
                if ($(window).width() >= 1300) {
                    $congressMenuSlide.find(".custom-sticky-head-container").mouseenter(function () {
                        if (!$(this).closest(".custom-sticky-buttons-cropped-container").find(".custom-sticky-buttons-cropped").is(":visible")) {
                            toggleMenu($(this));
                        }
                    });
                }

                // Obsługa opuszczenia obszaru .custom-container-sticky-buttons myszką
                $congressMenuSlide.mouseleave(function () {
                    if ($(this).find(".custom-sticky-buttons-cropped").is(":visible")) {
                        toggleMenu($(this).find(".custom-sticky-head-container"));
                    }
                });

                function toggleMenu($container) {
                    $container.closest(".custom-sticky-buttons-cropped-container").find(".custom-sticky-buttons-cropped").slideToggle();
                    $container.find("i").toggleClass("fa-chevron-down fa-chevron-up");
                }

                // Obsługa zmiany rozmiaru okna przeglądarki
                $(window).on("resize", function () {
                    if ($(window).width() >= 1300) {
                        $congressMenuSlide.find(".custom-sticky-head-container").off("mouseenter"); // Wyłącz poprzedni event handler
                        $congressMenuSlide.find(".custom-sticky-head-container").mouseenter(function () {
                            if (!$(this).closest(".custom-sticky-buttons-cropped-container").find(".custom-sticky-buttons-cropped").is(":visible")) {
                                toggleMenu($(this));
                            }
                        });
                    } else {
                        $congressMenuSlide.find(".custom-sticky-head-container").off("mouseenter"); // Wyłącz event handler dla węższego ekranu
                    }
                });
   
            });

        } else {
            document.querySelector(".custom-sticky-head-container").style.display = "none";
            
        }
    }

</script>


