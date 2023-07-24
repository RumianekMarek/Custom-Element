<?php

if (!is_admin()) {
    echo '<link rel="stylesheet" type="text/css" href="/wp-content/plugins/custom-element/my-custom-element/css/slick-slider.css"/>';
}

include_once plugin_dir_path(__FILE__) . 'main-custom-element.php';

if ($logoscatalog == "partnerzy obiektu") {
    $files = glob($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/custom-element/my-custom-element/media/partnerzy obiektu/*.{jpeg,jpg,png,JPEG,JPG,PNG}', GLOB_BRACE);
} else {
    $files = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/' . $logoscatalog . '/*.{jpeg,jpg,png,JPEG,JPG,PNG}', GLOB_BRACE);
} 
$element_unique_id = 'custom-logos-gallery-' . uniqid();
echo '
    <div id="customLogos" class="custom-container-logos-gallery">
        <div class="custom-logos-title main-heading-text">
            <h4 class="font-weight-700 custom-uppercase"><span>'. $titlecatalog .'</span></h4>
        </div>
        <div class="custom-logos-gallery-wrapper single-top-padding">
            <div id="'. $element_unique_id .'" class="custom-logos-gallery-slider slider-inner-container">';
            foreach ($files as $file) {
                
                if ($logoscatalog == "partnerzy obiektu") {
                    $shortPath = substr($file, strpos($file, '/wp-content/'));
                    $fileName = pathinfo($file, PATHINFO_FILENAME);
                    $url = 'https://' . $fileName;
                    if ($showurl == "true") {
                        echo '<a href="' . $url . '" alt="logo ' . $fileName . '" target="_blank"><img class="custom-logo-item" src="' . $shortPath . '"></a>';
                    } else {
                        echo '<div><img class="custom-logo-item" src="' . $shortPath . '"></div>';
                    }
                } else {
                    
                    $shortPath = substr($file, strpos($file, '/doc/'));
                    $fileName = pathinfo($file, PATHINFO_FILENAME);
                    $url = 'https://' . $fileName;
                    if ($showurl == "true") {
                        echo '<a href="' . $url . '" alt="logo ' . $fileName . '" target="_blank"><img class="custom-logo-item" src="' . $shortPath . '"></a>';
                    } else {
                        echo '<div><img class="custom-logo-item" src="' . $shortPath . '"></div>';
                    }
                    
                }
            }
            echo '</div>
        </div>
    </div>';
?>
<script src="/wp-content/plugins/custom-element/my-custom-element/js/slick-slider.js"></script>

<?php
    if (isset($element_unique_id)) {
        if ($show_slider == "true") {
?>
            <script>
            if(document.querySelector("#<?php echo $element_unique_id ?>").children.length > 7) {

                // Full width row
                document.querySelectorAll(".row-container .row").forEach(function(rowContainerBg) {
                    if (rowContainerBg.querySelector(".custom-container-logos-gallery")) {
                        if (rowContainerBg.classList.contains("limit-width")) rowContainerBg.classList.remove("limit-width");
                            rowContainerBg.classList.add("full-width");
                    }
                });
                // Padding left fot title
                document.querySelectorAll(".custom-logos-title").forEach(function(element) {
                    element.style.paddingLeft = "36px";
                });
                
                jQuery(function ($) {
                    // Slick Selector
                    let slickSlider = $("#<?php echo $element_unique_id ?>");
                    // Set the number of dots, dot size and margin here.
                    let maxDots = 5;
                    let dotSize = 15; //px
                    let dotMargin = 8; //px
                    // Variables used to control the sliding animation
                    let transformXIntervalNext;
                    let transformXIntervalPrev;
                    // Keep track of the current X (left/right scroll) position
                    let transformCount = 0;
                    
                    function setBoundaries($slick, windowSize) {
                        let $dots = $(".slick-dots li");
                        // Added to dots accent bg-color
                        $dots.addClass("style-accent-bg");
                        $dots.each(function(idx) {
                            $(this).css({width:dotSize, height:dotSize, margin:"0 " + dotMargin + "px"});
                            $("button", $(this)).css({width:dotSize, height:dotSize, margin:"0 " + dotMargin + "px", font:dotSize});
                        });
                        if (windowSize < $dots.length) {
                            $slick.find(".slick-dots li").eq(windowSize-1).addClass("small");
                        }
                        let $dot = $dots.first();
                        let marginLeft = Math.round(parseFloat($dot.css("margin-left")));
                        let marginRight = Math.round(parseFloat($dot.css("margin-right")));
                        let dotWidth = $dot.width() + marginLeft + marginRight;
                        let viewportWidth = dotWidth * windowSize;
                        // Calculate the viewport width
                        $(".slick-dots-viewport").css("width", viewportWidth + "px");
                        // Define the left/right increments to smoothly scroll the dots.
                        transformXIntervalPrev = dotWidth;
                        transformXIntervalNext = -dotWidth;
                    }

                    slickSlider.on("init", function (event, slick) {
                        let $dotsholder = $(slick.options.appendDots).find("." + slick.options.dotsClass);
                        $dotsholder.wrap('<div class="slick-dots-viewport"></div>');
                        // $dots.wrap("<div class="slick-dots-viewport"></div>");
                        // Add an index to each dot so we can easily identify them.
                        $dotsholder
                            .find("li")
                            .each(function (index) {
                                $(this).addClass("dot-index-" + index);
                            });
                        // Reset the list position inside the viewport window
                        $dotsholder.css("transform", "translateX(0)");
                        // Resize the viewport and initialise the overflow dot (if necessary)
                        setBoundaries($(this), maxDots);
                    });
                    
                    slickSlider.on("beforeChange", function (event, slick, currentSlide, nextSlide) {
                        let $slider = $(this);
                        let $dotList = $slider.find("ul.slick-dots");
                        // debugger;
                        let $dots = $dotList.find("li");
                        let $firstDot = $dots.first();
                        let $lastDot = $dots.last();
                        let totalCount = $dots.length;
                        if (totalCount > maxDots) {
                            let delta = nextSlide - currentSlide;
                            if (Math.abs(delta) === totalCount - 1) {
                                // Reset the style of every dot because we re about to wrap around
                                $dots.removeClass("small");
                                let boundaryDot;
                                if (delta < 0) {
                                    // Wrapping around to the start
                                    transformCount = 0;
                                    boundaryDot = maxDots - 1;
                                } else {
                                    // Wrapping around to the end
                                    transformCount = (totalCount - maxDots) * transformXIntervalNext;
                                    boundaryDot = totalCount - maxDots;
                                }
                                $dots.filter(".dot-index-" + boundaryDot).addClass("small");
                                // Animate the dots into position
                                $dotList.css("transform", "translateX(" + transformCount + "px)");
                            } else {
                                let $nextSlide = $dots.filter(".dot-index-" + nextSlide);
                                if (nextSlide > currentSlide) {
                                    if ($nextSlide.hasClass("small")) {
                                        // We haven t reached the end of the list yet, scroll the dots to the left.
                                        transformCount = transformCount + transformXIntervalNext;
                                        // Remove the existing right-side boundary dot...
                                        $nextSlide.removeClass("small");
                                        // ...and move it one place to the right UNLESS we already reached the last dot.
                                        if (!$nextSlide.next().is($lastDot)) {
                                            $nextSlide.next().addClass("small");
                                        }
                                        // Smoothly slide the dots to the left
                                        $dotList.css("transform", "translateX(" + transformCount + "px)");
                                        // Update the left-side boundary dot.
                                        let $firstVisibleDot = $dots.eq(nextSlide - (maxDots-2));
                                        $firstVisibleDot.addClass("small").prev().removeClass("small").addClass("tiny");
                                    }
                                } else {
                                    // If the previous button has the "small" dot style...
                                    if ($nextSlide.hasClass("small")) {
                                        // We haven t reached the start of the list yet, scroll the dots to the right.
                                        transformCount = transformCount + transformXIntervalPrev;
                                        // Remove the existing left-side boundary dot...
                                        $nextSlide.removeClass("small");
                                        // ...and move it one place to the left UNLESS we already reached the first dot.
                                        if (!$nextSlide.prev().is($firstDot)) {
                                            $nextSlide.prev().addClass("small");
                                        }
                                        // Smoothly slide the dots to the left
                                        $dotList.css("transform", "translateX(" + transformCount + "px)");
                                        // Update the left-side boundary dot.
                                        let $lastVisibleDot = $dots.eq(nextSlide + (maxDots-2));
                                        $lastVisibleDot.addClass("small").next().removeClass("small").addClass("tiny");
                                    }
                                }
                            }
                        }
                    });
                    
                    slickSlider.on("afterChange", function (event, slick, currentSlide) {
                        let $slider = $(this);
                        let $dotList = $slider.find("ul.slick-dots");
                        let $dots = $dotList.find("li");
                        $dots.filter(".tiny").removeClass("tiny");
                    });
                    
                    slickSlider.slick({
                        centerMode: true,
                        slidesToShow: 7,
                        slidesToScroll: 1,
                        arrows: false,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        dots: true,
                        cssEase: "linear",
                        swipeToSlide: true,
                        responsive: [
                            {
                            breakpoint: 900,
                            settings: {
                                slidesToShow: 5,
                                autoplay: false
                            }
                            },
                            {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 4,
                                autoplay: false
                            }
                            },  
                            {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 2,
                                autoplay: false
                            }
                            },
                            {
                            breakpoint: 350,
                            settings: {
                                slidesToShow: 1,
                                autoplay: false
                            }
                            }
                        ] 
                    });
                });
            }
            </script>
<?php
        } 
?>
        <script>
        // Hide container if gallery length = 0
        if(document.querySelector("#<?php echo $element_unique_id ?>").children.length == 0) {
            if(document.querySelector('.media-logos')){
                document.querySelector('.media-logos').classList.toggle("custom-display-none")
            } else {
            document.querySelector(".row-container:has(#<?php echo $element_unique_id ?>)").classList.toggle("custom-display-none");
            }
        }
        // Hide container if input value is empty
        logoscatalog = "<?php echo $logoscatalog; ?>";
        console.log(logoscatalog);
        if (logoscatalog === "") {
            document.querySelector(".media-logos").classList.toggle("custom-display-none");
        }
        </script>
<?php
    }
?>
 
   


