<?php
if ($logoscatalog != ''){
    $pattern = '/``id``:``(.*?)``,``url``:``(.*?)``/';
    // Search for matches and save the results to an array of $matches
    preg_match_all($pattern, $logo_url, $matches);

    $ids = $matches[1];
    $url_values = $matches[2];

    if (!is_admin()) {
        echo '<link rel="stylesheet" type="text/css" href="/wp-content/plugins/custom-element/my-custom-element/css/slick-slider.css"/>';
    }

    if ($logoscatalog == "partnerzy obiektu") {
        $files = glob($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/custom-element/my-custom-element/media/partnerzy obiektu/*.{jpeg,jpg,png,JPEG,JPG,PNG}', GLOB_BRACE);
    } else {
        $files = glob($_SERVER['DOCUMENT_ROOT'] . '/doc/' . $logoscatalog . '/*.{jpeg,jpg,png,JPEG,JPG,PNG}', GLOB_BRACE);
    } 
    $element_unique_id = 'custom-logos-gallery-' . uniqid();
    $mobile = preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);

    if($color != ''){
        echo '
            <style>
            .custom_element_'.$rnd_id.' .custom-logos-title span{
                    color: '.$color.';
                }
            </style>';
    }
    echo '<div id="customLogos" class="custom-container-logos-gallery">
            <div class="custom-logos-title main-heading-text">
                <h4 class="font-weight-700 custom-uppercase"><span>'. $titlecatalog .'</span></h4>
            </div>
            <div class="custom-logos-gallery-wrapper single-top-padding">
                <div id="'. $element_unique_id .'" class="custom-logos-gallery-slider slider-inner-container">';
                
                    foreach ($files as $index => $file) {
                        $shortPath = '';
                        if ($logoscatalog == "partnerzy obiektu") {
                            $shortPath = substr($file, strpos($file, '/wp-content/'));
                            if (strpos($shortPath, '/doc/'.$logoscatalog.'/') !== false) {
                                $altText = str_replace('/doc/'.$logoscatalog.'/', '', $shortPath);
                            } else {$altText = 'partner logotyp';}
                        } else {
                            $shortPath = substr($file, strpos($file, '/doc/'));
                            if (strpos($shortPath, '/doc/'.$logoscatalog.'/') !== false) {
                                $altText = str_replace('/doc/'.$logoscatalog.'/', '', $shortPath);
                            } else {$altText = 'logotyp';}
                        }
                        $fileName = pathinfo($file, PATHINFO_FILENAME);
                        $fileBaseName = pathinfo($file, PATHINFO_BASENAME);

                        // Looking for the index of the match "id" in the array $ids
                        $idIndex = array_search(strtolower($fileBaseName), array_map('strtolower', $ids));

                        if ($idIndex !== false && $url_values[$idIndex] !== "") {
                            if (strpos($url_values[$idIndex], 'https://www.') !== false) {
                                $url = 'https://' . preg_replace('/https:\/\/www\./i', '', $url_values[$idIndex]);
                            } else if (strpos($url_values[$idIndex], 'http://www.') !== false) {
                                $url = 'https://' . preg_replace('/http:\/\/www\./i', '', $url_values[$idIndex]);
                            } else if (strpos($url_values[$idIndex], 'www.') !== false) {
                                $url = 'https://' . preg_replace('/www\./i', '', $url_values[$idIndex]);
                            }  else if (strpos($url_values[$idIndex], 'http://') !== false) {
                                $url = 'https://' . substr($url_values[$idIndex], 7); 
                            } else if (strpos($url_values[$idIndex], 'https://') !== false) {
                                $url = $url_values[$idIndex];
                            } else {
                                $url = 'https://' . $url_values[$idIndex];
                            }
                        } else {
                            $url = "";
                        }

                        if ($showurl == "true" && $url !== "") {
                            echo '<a href="' . $url . '" alt="logo ' . $fileName . '" target="_blank"><img class="custom-logo-item" src="' . $shortPath . '" alt="' . $altText . '"></a>';
                        } else {
                            if ($showurl == "true" && $url == "") {
                                echo '<div><img class="custom-logo-item" src="' . $shortPath . '" alt="' . $altText . '"></div>';
                            } else {
                                echo '<div><img class="custom-logo-item" src="' . $shortPath . '" alt="' . $altText . '"></div>';
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
    ?>
            <script>
        { 
            const sliderDesktop = <?php echo in_array('desktop', explode(',', $slider_off)) ? 'false' : 'true'; ?>;
            const sliderMobileTablet = <?php echo in_array('mobile_tablet', explode(',', $slider_off)) ? 'true' : 'false'; ?>;
            const targetElement = document.querySelector("#<?php echo $element_unique_id ?>");
            
            if (
                (!sliderDesktop && <?php echo $mobile ?> === 0 ) || 
                (!sliderMobileTablet  && <?php echo $mobile ?> === 1) && 
                (targetElement.children.length > 4) || 
                (targetElement.children.length = 3 && window.innerWidth < 700) || 
                (targetElement.children.length = 4 && window.innerWidth < 700)) {
                
                document.querySelector(".wpb_column:has(.custom-logos-gallery-slider)").style.padding = "0px";
                
                // Full width row
                document.querySelectorAll(".row-container .row").forEach(function(rowContainerBg) {
                    if (rowContainerBg.querySelector(".custom-container-logos-gallery:has(#<?php echo $element_unique_id ?>)")) {
                        if ("<?php echo $full_width ?>" == "") { //full width on
                            rowContainerBg.classList.remove("limit-width");
                            rowContainerBg.classList.add("full-width");
                            rowContainerBg.querySelector(".custom-logos-title").style.paddingLeft = "16px"; 
                            rowContainerBg.style.marginLeft = "20px"; 
                            
                            const breakpoints = [
                                { breakpoint: 1600, divisor: 9, correctiveValue: 20 },
                                { breakpoint: 1200, divisor: 7, correctiveValue: 20 },
                                { breakpoint: 960, divisor: 5, correctiveValue: 25 },
                                { breakpoint: 800, divisor: 4, correctiveValue: 25 },
                                { breakpoint: 600, divisor: 2, correctiveValue: 30 }
                            ];

                            breakpoints.forEach(function (config) {
                                const maxWidthFull = Math.floor((targetElement.offsetWidth / config.divisor) - config.correctiveValue) + 'px';
                                
                                rowContainerBg.querySelectorAll(".custom-logo-item").forEach(function (item) {
                                    if (targetElement.offsetWidth < config.breakpoint) {
                                        item.style.width = maxWidthFull;
                                    }
                                });
                            });

                        } else if ("<?php echo $full_width ?>" == "true") { //full width off
                            rowContainerBg.classList.remove("full-width");
                            rowContainerBg.classList.add("limit-width");
                            rowContainerBg.querySelector(".custom-logos-title").style.paddingLeft = "0px";

                            const breakpoints = [
                                { breakpoint: 1200, divisor: 7, correctiveValue: 16 },
                                { breakpoint: 960, divisor: 5, correctiveValue: 16 },
                                { breakpoint: 800, divisor: 4, correctiveValue: 16 },
                                { breakpoint: 600, divisor: 2, correctiveValue: 5 }
                            ];

                            breakpoints.forEach(function (config) {
                                const maxWidthFull = Math.floor((targetElement.offsetWidth / config.divisor) - config.correctiveValue) + 'px';

                                rowContainerBg.querySelectorAll(".custom-logo-item").forEach(function (item) {
                                    if (targetElement.offsetWidth < config.breakpoint) {
                                        item.style.width = maxWidthFull;
                                    }
                                });
                            });
                        }  
                    } 
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
                        // centerMode: true,
                        slidesToShow: 7,
                        slidesToScroll: 1,
                        arrows: false,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        dots: false,
                        cssEase: "linear",
                        swipeToSlide: true,
                        variableWidth: true,
                        responsive: [
                            {
                            breakpoint: 1600,
                            settings: {
                                slidesToShow: 9,
                            }
                            },
                            {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 7,
                            }
                            },
                            {
                            breakpoint: 960,
                            settings: {
                                slidesToShow: 5,
                            }
                            },
                            {
                            breakpoint: 800,
                            settings: {
                                slidesToShow: 4,
                            }
                            },  
                            {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                            }
                            }
                        ] 
                    });
                });
                        
            }
        } 

            // Hide container if gallery length = 0
            if(document.querySelector("#<?php echo $element_unique_id ?>").children.length == 0) {
                if(document.querySelector('.media-logos')){
                    document.querySelector('.media-logos').classList.toggle("custom-display-none")
                } else {
                    jQuery(function ($) {
                        $(".row-container:has(#<?php echo $element_unique_id ?>)").toggleClass("custom-display-none");
                    });
                }
            }
            // Hide container if input value is empty
            logoscatalog = "<?php echo $logoscatalog; ?>";
            if (logoscatalog === "") {
                document.querySelector(".media-logos").classList.toggle("custom-display-none");
            }

            </script>
    <?php
        }
    }
?>