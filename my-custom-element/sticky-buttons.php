<?php
    $color = ($color != '#000000') ? '#ffffff' : $color;
    $sticky_buttons_width = ($sticky_buttons_width == '') ? '170px' : $sticky_buttons_width;
    $sticky_full_width_buttons_width = ($sticky_full_width_buttons_width == '') ? '170px' : $sticky_full_width_buttons_width;
    $sticky_buttons_font_size_full_size = ($sticky_buttons_font_size_full_size == '') ? '16px' : $sticky_buttons_font_size_full_size;
    $sticky_buttons_font_size = ($sticky_buttons_font_size == '') ? '12px' : $sticky_buttons_font_size;    
    $sticky_buttons_full_size_background = ($sticky_buttons_full_size_background == '') ? 'white' : $sticky_buttons_full_size_background;
?>

<style>
    .custom_element_<?php echo $rnd_id ?> {
        opacity: 0;
    }
    #page-header {
        position: relative;
        z-index: 11;
    }
    .wpb_column:has(.custom-container-sticky-buttons) {
        padding-top: 0 !important;
    }
    .custom-sticky-buttons-full-size, .custom-sticky-buttons-cropped {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 36px 18px;
        width: 100%;
        gap: 40px;
    }
    <?php if ($sticky_buttons_dropdown === "true") { ?>
    .custom-sticky-buttons-cropped:before {
        content: "";
        background-color: rgba(255, 255, 255, 0.1);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 7;
    }
    <?php } ?>
    .custom-sticky-buttons-full-size {
        background-color: white;
        z-index: 11;
    }
    .custom-sticky-buttons-cropped-container {
        flex-direction: column;
        width: 100%;
        top: 0;
        z-index: 10;
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
        z-index: 8;

        .active{
            transform: scale(1.2);
        }
    }
    .custom-sticky-buttons-cropped .custom-sticky-button-item {
        width: <?php echo $sticky_buttons_width ?> !important;
    }
    .custom-sticky-buttons-full-size .custom-sticky-button-item {
        width: <?php echo $sticky_full_width_buttons_width ?> !important;
    }
    .custom-sticky-button-item:hover {
        transform: scale(1.03);
    }
    .custom-sticky-button-item span {
        padding: 5px;
    }
    .custom-sticky-button-item img,
    .custom-sticky-button-item div {
        border-radius: 8px;
        width: 100%;
        object-fit: cover;
        cursor: pointer;
        text-transform: uppercase;
        font-size: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: <?php echo $color ?>;
        font-weight: 600;
    }
    .custom-sticky-buttons-full-size .custom-sticky-button-item div {
        font-size: <?php echo $sticky_buttons_font_size_full_size ?> !important;
    }
    .custom-sticky-buttons-cropped .custom-sticky-button-item div {
        font-size: <?php echo $sticky_buttons_font_size ?> !important;
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
    @media (max-width: 600px) {
        .custom-sticky-buttons-full-size {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 0 auto;
            gap: 24px;
        }
        .custom-sticky-button-item img {
            width: 100%;
        }
        .custom-sticky-button-item:hover {
            transform: unset;
        }
    }
    <?php if ($sticky_buttons_full_size === 'true') { ?>
        .custom-sticky-buttons-cropped-container {
            position: absolute;
        }
    <?php } ?>
    .custom-sticky-button-item {
        transition: ease .3s;
    }
    .sticky-pin {
        position: fixed !important;
        top: 0;
        right: 0;
        left: 0;
    }
    .konferencja {
        display: none;
        scroll-margin-top: 40px;
    }

</style>
<?php

$mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);

$sticky_buttons_urldecode = urldecode($sticky_buttons);
$sticky_buttons_json = json_decode($sticky_buttons_urldecode, true);

$unique_id = rand(10000, 99999);
$element_unique_id = 'stickyButtons-' . $unique_id;

$sticky_parameter = ($sticky_parameter == '') ? 'konferencja' : $sticky_parameter;

$buttons_urls = array();
$full_size_buttons_urls = array();
$buttons_id = array();
$buttons_links = array();

echo '<div id="'. $element_unique_id .'" class="custom-container-sticky-buttons">';
    if ($sticky_buttons_full_size === "true") {
        echo '<div class="custom-sticky-buttons-full-size" style="display: none; background-color:'. $sticky_buttons_full_size_background .'!important;">';
        
        if (is_array($sticky_buttons_json)) {
            foreach ($sticky_buttons_json as $sticky_button) {

                $attachment_full_size_img_id = $sticky_button["sticky_buttons_full_size_images"];
                $link = $sticky_button["sticky_buttons_link"];
                $button_id = $sticky_button["sticky_buttons_id"];
                $button_color = $sticky_button["sticky_buttons_color_bg"];
                $button_text = $sticky_button["sticky_buttons_color_text"];
                $image_full_size_url = wp_get_attachment_url($attachment_full_size_img_id);
                $full_size_buttons_urls[] = $image_full_size_url;

                if (!empty($image_full_size_url)) {
                    if (!empty($link)) {
                        echo '<div class="custom-sticky-button-item">';
                            echo '<a href="'. $link .'"><img style="aspect-ratio:'. $sticky_buttons_aspect_ratio_full_size .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-full-size" src="' . esc_url($image_full_size_url) . '" alt="sticky-button-'. $attachment_full_size_img_id .'"></a>';
                        echo '</div>';
                    } else {
                        echo '<div class="custom-sticky-button-item">';
                            echo '<img style="aspect-ratio:'. $sticky_buttons_aspect_ratio_full_size .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-full-size" src="' . esc_url($image_full_size_url) . '" alt="sticky-button-'. $attachment_full_size_img_id .'">';
                        echo '</div>';
                    }
                } else {
                    if (!empty($link)) {
                        echo '<div class="custom-sticky-button-item">';
                            echo '<a href="'. $link .'"><div style="background-color:'. $button_color .'; aspect-ratio:'. $sticky_buttons_aspect_ratio_full_size .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-full-size"><span>'. $button_text .'</span></div></a>';
                        echo '</div>';
                    } else {
                        echo '<div class="custom-sticky-button-item">';
                            echo '<div style="background-color:'. $button_color .'; aspect-ratio:'. $sticky_buttons_aspect_ratio_full_size .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-full-size"><span>'. $button_text .'</span></div>';
                        echo '</div>';
                    }
                }
            }
        } else {
            echo 'Invalid JSON data.';
        }

        echo '</div>';
    }
    
    echo '
    <div class="sticky custom-sticky-buttons-cropped-container">
        <div class="custom-sticky-head-container style-accent-bg" style="display: none; background-color:'. $sticky_buttons_cropped_background .'!important">
            <h4 class="custom-sticky-head-text" style="color:'. $color .' !important;">Wybierz kongres &nbsp;</h4>
            <i class="fa fa-chevron-down fa-1x fa-fw" style="color:'. $color .' !important;"></i>
        </div>
        <div class="custom-sticky-buttons-cropped style-accent-bg" style="display: none; background-color:'. $sticky_buttons_cropped_background .'!important">';

            if (is_array($sticky_buttons_json)) {
                foreach ($sticky_buttons_json as $sticky_button) {

                    $attachment_img_id = $sticky_button["sticky_buttons_images"];
                    $link = $sticky_button["sticky_buttons_link"];
                    $button_id = $sticky_button["sticky_buttons_id"];
                    $button_color = $sticky_button["sticky_buttons_color_bg"];
                    $button_text = $sticky_button["sticky_buttons_color_text"];
                    $image_url = wp_get_attachment_url($attachment_img_id);
                    $buttons_urls[] = $image_url;
                    $buttons_colors[] = $button_color;
                    $buttons_id[] = $button_id;
                    $buttons_links[] = $link;


                    if (!empty($image_url)) {
                        if (!empty($link)) {
                            echo '<div class="custom-sticky-button-item">';
                                echo '<a href="'. $link .'"><img style="aspect-ratio:'. $sticky_buttons_aspect_ratio .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-cropped" src="' . esc_url($image_url) . '" alt="sticky-button-'. $attachment_img_id .'"></a>';
                            echo '</div>';
                        } else {
                            echo '<div class="custom-sticky-button-item">';
                                echo ' <img style="aspect-ratio:'. $sticky_buttons_aspect_ratio .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-cropped" src="' . esc_url($image_url) . '" alt="sticky-button-'. $attachment_img_id .'">';
                            echo '</div>';
                        }
                    } else {
                        if (!empty($link)) {
                            echo '<div class="custom-sticky-button-item">';
                                echo '<a href="'. $link .'"><div style="background-color:'. $button_color .'; aspect-ratio:'. $sticky_buttons_aspect_ratio .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-cropped"><span>'. $button_text .'</span></div></a>';
                            echo '</div>';
                        } else {
                            echo '<div class="custom-sticky-button-item">';
                                echo '<div style="background-color:'. $button_color .'; aspect-ratio:'. $sticky_buttons_aspect_ratio .';" id="' . $button_id . '-btn" class="custom-image-button custom-button-cropped"><span>'. $button_text .'</span></div>';
                            echo '</div>';
                        }   
                    }
                }
            } else {
                echo 'Invalid JSON data.';
            }

            if ($mobile == 1) {
                // echo '<style>.custom-sticky-buttons-cropped {gap: 10px;}</style>';
                // if (count($buttons_urls) > 3) {
                    $sticky_buttons_dropdown = "true";
                // }
            }    

            echo'</div>
        </div>
    </div>';

    $buttons_id_json = json_encode($buttons_id);
    $buttons_links_json = json_encode($buttons_id);

    $buttons_cropped_image = json_encode($buttons_urls);
    $buttons_cropped_color = json_encode($buttons_colors);
?>


<script>
{
    window.onload = function() {
        const btnLinks = '<?php echo $buttons_links_json ?>';
        const btnsId = '<?php echo $buttons_id_json ?>';
        const stickyButtonsDropdown = "<?php echo $sticky_buttons_dropdown ?>";
        const stickyButtonsFullSize = "<?php echo $sticky_buttons_full_size ?>";
        const tilesCroppedContainer = document.querySelector('.custom_element_<?php echo $rnd_id ?> .custom-sticky-buttons-cropped-container');
        const tilesCropped = document.querySelector('.custom_element_<?php echo $rnd_id ?> .custom-sticky-buttons-cropped');
        const tilesFullSize = document.querySelector('.custom_element_<?php echo $rnd_id ?> .custom-sticky-buttons-full-size');
        const containerMasthead = document.querySelector('#masthead .menu-container');
        const containerPageHeader = document.querySelector('#page-header');
        const containerCustomHeader = document.querySelector('#customHeader');
        const adminBar = document.querySelector('#wpadminbar');
        const desktop = <?php echo $mobile ?> === 0;
        const mobile = <?php echo $mobile ?> === 1;
        const stickyHeadContainer = document.querySelector(".custom_element_<?php echo $rnd_id ?> .custom-sticky-head-container");

        let customElement = document.querySelector('.custom_element_<?php echo $rnd_id ?>');
        customElement.style.opacity = 1;
        customElement.style.transition = 'opacity 0.3s ease';

        const hideElement = (element) => {
            element.style.display = 'none';
        };
        const showElement = (element, displayValue = 'flex') => {
            element.style.display = displayValue;
        };
        const setElementPosition = (element, position) => {
            element.style.position = position;
        };

        const buttonsCroppedImage = <?php echo $buttons_cropped_image ?>;
        const buttonsCroppedColor = <?php echo $buttons_cropped_color ?>;
        const combinedArray = buttonsCroppedImage.concat(buttonsCroppedColor);
        if (combinedArray.every(value => value === false || value === "")) {
            hideElement(tilesCroppedContainer);
        }

        if (stickyButtonsDropdown !== 'true') {
            hideElement(stickyHeadContainer);
            if (stickyButtonsFullSize === 'true') { // dropdown on full size on
                setElementPosition(tilesCroppedContainer, 'absolute');
                showElement(tilesCropped);
                showElement(tilesFullSize);
            } else { // dropdown on full size off
                showElement(tilesCropped);
            }
        } else if (stickyButtonsDropdown === 'true') {
            showElement(stickyHeadContainer);
            if (stickyButtonsFullSize === 'true') { // dropdown off full size on
                setElementPosition(tilesCroppedContainer, 'absolute');
                showElement(stickyHeadContainer);
                hideElement(tilesCropped);
                showElement(tilesFullSize);
            } else { // dropdown off full size off
                showElement(tilesCroppedContainer);
                
            }
        }

        const stickyElement = document.querySelector('.sticky');
        const stickyClass = 'sticky-pin';
        let stickyPos;
        let stickyHeight;

        // Create a negative margin to prevent content 'jumps':
        var jumpPreventDiv = document.createElement('div');
        jumpPreventDiv.className = 'jumps-prevent';
        stickyElement.parentNode.insertBefore(jumpPreventDiv, stickyElement.nextSibling);

        if (containerMasthead && desktop) {
            stickyPos = stickyElement.getBoundingClientRect().top + window.scrollY - containerMasthead.offsetHeight;
        } else {
            stickyPos = stickyElement.getBoundingClientRect().top + window.scrollY;
        }
        function jumpsPrevent() {
            stickyHeight = stickyElement.offsetHeight;
            stickyElement.style.marginBottom = '-' + stickyHeight + 'px';
            stickyElement.nextElementSibling.style.paddingTop = stickyHeight + 'px';
        }
        if (!tilesFullSize) {
            jumpsPrevent(); // Run

            // Function trigger:
            window.addEventListener('resize', function () {
                jumpsPrevent();
            });
        }
        
        // Sticker function:
        function stickerFn() {
            const isStuckMasthead = document.querySelector('#masthead').classList.contains("is_stuck");
            const stickyElementFixed = document.querySelector('.sticky-pin');
            const winTop = window.scrollY;
            // Check element position:
            if (winTop >= stickyPos) {
                stickyElement.classList.add(stickyClass);
                if (stickyElement) {
                    if (containerMasthead && adminBar && desktop) {
                        stickyElement.style.top = containerMasthead.offsetHeight + adminBar.offsetHeight + "px";
                    } else if (containerMasthead && !adminBar && desktop) {
                        stickyElement.style.top = containerMasthead.offsetHeight + "px";
                    } else if (isStuckMasthead && mobile) {
                        stickyElement.style.top = containerMasthead.offsetHeight + "px";
                    } else {
                        stickyElement.style.top = "0px";
                    }
                }
            } else {
                stickyElement.classList.remove(stickyClass);
                if (tilesFullSize) {
                    stickyElement.style.top = "0px";
                }
            }
        }

        stickerFn(); // Run

        // Function trigger:
        window.addEventListener('scroll', function () {
            stickerFn();
        });

        if (btnsId && typeof btnsId === 'string') {
            try {
                const btnsIdArray = JSON.parse(btnsId);
                if (Array.isArray(btnsIdArray)) {
                    btnsIdArray.forEach(function(btnId) {
                        const trimmedBtnId = btnId.trim();
                        const vcRow = document.getElementById(trimmedBtnId);
                        if (vcRow) {
                            vcRow.classList.add('hide-section');
                        }
                    });
                } else {
                    console.error('Nie udało się przekształcić btnsId w tablicę.');
                }
            } catch (error) {
                console.error('Błąd podczas parsowania JSON w btnsId:', error);
            }
        }

        if (btnsId !== "") {
            document.querySelectorAll('.custom-image-button').forEach(function(button, index) {

                button.style.transition = '.3s ease';

                var hideSections = document.querySelectorAll('.page-wrapper .row-container.hide-section');

                // Ukrywamy wszystkie sekcje oprócz pierwszej
                if ("<?php echo $sticky_hide_sections ?>" === "true") {
                    for (var i = 1; i < hideSections.length; i++) {
                        hideSections[i].style.display = 'none';
                    }
                    if (index === 0 && button) {
                        button.classList.add('active');
                    }
                } else {
                    for (var i = 0; i < hideSections.length; i++) {
                        hideSections[i].style.display = "none";
                    }
                }
                
                button.addEventListener('click', function() {
                    var targetId = button.id.replace('-btn', '');

                    // Ukrywamy wszystkie elementy .vc_row.row-container
                    hideSections.forEach(function(section) {
                        section.style.display = 'none';
                    });
                    
                    // Wyświetlamy elementy
                    var targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.style.display = 'block';
                    }
                    
                    if (button) {
                        button.classList.add('active');
                    }
                    document.querySelectorAll('.custom-image-button').forEach(function(otherButton) {
                        if (otherButton !== button && otherButton.classList.contains('active')) {
                            otherButton.classList.remove('active');
                        }
                    });
                });
                
            });
        }

        document.querySelectorAll(".custom-image-button").forEach(function(button) {
            let customScrollTop;

                if (containerPageHeader) {
                    customScrollTop = containerPageHeader.offsetHeight;
                } else if (containerCustomHeader) {
                    customScrollTop = containerCustomHeader.offsetHeight;
                } else {
                    customScrollTop = containerMasthead.offsetHeight;
                }

                if (document.querySelectorAll("header.menu-transparent").length > 0 && desktop) {
                    customScrollTop -= containerMasthead.offsetHeight;
                }

                customScrollTop += "px";
            
            const scrollTopValue = parseInt(customScrollTop);
            button.addEventListener("click", function() {
                window.scrollTo({ top: scrollTopValue, behavior: "smooth" });
            });
        });
        
        if (stickyButtonsDropdown === "true") {

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

                // // Obsługa najechania myszką na .custom-sticky-head-container tylko dla szerokości >= 1300px
                // if ($(window).width() >= 1300) {
                //     $congressMenuSlide.find(".custom-sticky-head-container").mouseenter(function () {
                //         if (!$(this).closest(".custom-sticky-buttons-cropped-container").find(".custom-sticky-buttons-cropped").is(":visible")) {
                //             toggleMenu($(this));
                //         }
                //     });
                // }

                // // Obsługa opuszczenia obszaru .custom-container-sticky-buttons myszką
                // $congressMenuSlide.mouseleave(function () {
                //     if ($(this).find(".custom-sticky-buttons-cropped").is(":visible")) {
                //         toggleMenu($(this).find(".custom-sticky-head-container"));
                //     }
                // });

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

    function handleQueryParam() {
        setTimeout(() => {
            // Pobierz parametr "konferencja" z aktualnego adresu URL
            var urlParams = new URLSearchParams(window.location.search);
            var conferenceParam = urlParams.get("<?php echo $sticky_parameter ?>");

            // Sprawdź, czy istnieje parametr "konferencja"
            if (conferenceParam) {
                // Pokaż elementy o klasie "konferencja" z odpowiednim id, ukryj pozostałe
                var allElements = document.querySelectorAll(".<?php echo $sticky_parameter ?>");

                allElements.forEach(function (element) {
                    if (element.id === conferenceParam) {
                        element.style.display = "block";
                        // element.classList.remove("desktop-hidden", "tablet-hidden", "mobile-hidden");
                        // Przewiń do elementu o id z kotwicy
                        element.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        element.style.display = "none";
                        // element.classList.add("desktop-hidden", "tablet-hidden", "mobile-hidden");
                    }
                });                            
                
                // Dodaj klasę .active do elementu z id z kotwicy + -btn
                var activeBtn = document.getElementById(conferenceParam + "-btn");
                if (activeBtn) {
                    activeBtn.classList.add("active");
                }
            }
        }, 1000);
    }

    // Wywołaj funkcję obsługi przy załadowaniu strony
    document.addEventListener("DOMContentLoaded", handleQueryParam);
    // Nasłuchuj zmiany parametru "konferencja" w adresie URL
    window.addEventListener("popstate", handleQueryParam);
    
}
</script>





