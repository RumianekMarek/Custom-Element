    <?php
    function custom_media_slider ($media_url_array, $slide_speed = 3000){
        if(is_array($media_url_array[0])){
                foreach($media_url_array as $url){
                        $media_url[] = $url['img'];
                }
        } else {
                $media_url = $media_url_array;
        }
        /*Random "id" if there is more then one element on page*/  
        $id_rnd = rand(10000, 99999);

        /*Counting min elements for the gallery slider thats */   
        if(count($media_url) > 10){
                $max_image = floor(count($media_url) * 1.5);
                $min_image = floor(-count($media_url) / 2);
        } else {
                $max_image = count($media_url) * 2; 
                $min_image = -count($media_url);
        }
        /*Creating DOM */   
        $output = '<div id="custom_element_slider-'.$id_rnd.'" class="custom_element_catalog_slider">
                        <div class ="slides">';
                                for ($i = $min_image; $i < ($max_image); $i++) {
                                        if($i<0){
                                            $imgNumber = count($media_url) + $i;
                                            $imageStyles = "background-image:url('".$media_url[$imgNumber]."');";
                                        } elseif($i>=0 && $i<(count($media_url))){
                                            $imgNumber = $i;
                                            $imageStyles = "background-image:url('".$media_url[$imgNumber]."');";
                                        } elseif($i>=(count($media_url))){
                                            $imgNumber = ($i - count($media_url));
                                            $imageStyles = "background-image:url(".$media_url[$imgNumber].");";
                                        }
                                        
                                        $imageUrl = $media_url_array[$imgNumber]['site'];
                                        $imageClass = $media_url_array[$imgNumber]['class'];
                                        $imageStyle = $media_url_array[$imgNumber]['style'];
                                        if (is_array($media_url_array[$imgNumber]) && !empty($media_url_array[$imgNumber]['site']) && !empty($media_url_array[$imgNumber]['class'])){
                                                $output .= '<a href="'.$imageUrl.'" target="_blank" class="image-container"><div class="'.$imageClass.'" style="'.$imageStyles . ' ' . $imageStyle.'"></div></a>';
                                        } else if (is_array($media_url_array[$imgNumber]) && !empty($media_url_array[$imgNumber]['site'])) {
                                                $output .= '<a href="'.$imageUrl.'" target="_blank" class="image-container"><div style="'.$imageStyles . ' ' . $imageStyle.'"></div></a>';
                                        } else {
                                                $output .= '<div class="image-container '.$imageClass.'" style="'.$imageStyles . ' ' . $imageStyle.'"></div>';
                                        }
                                }
        $output .='</div>
                </div>
                <script>
                        jQuery(function ($) {                         
                                const slider = document.querySelector("#custom_element_slider-'.$id_rnd.'");
                                const slides = document.querySelector("#custom_element_slider-'.$id_rnd.' .slides");
                                const images = document.querySelectorAll("#custom_element_slider-'.$id_rnd.' .slides div");

                                
                                let isMouseOver = false;
                                let isDragging = false;
                                
                                let imagesMulti = "";
                                const slidesWidth = slides.clientWidth;
                                
                                if (slidesWidth < 400) {
                                        imagesMulti = 2;
                                } else if (slidesWidth < 600) {
                                        imagesMulti = 3;
                                } else if (slidesWidth < 959) {
                                        imagesMulti = 5;
                                } else {
                                        imagesMulti = 7;
                                }
                                
                                if(imagesMulti >=  '.count($media_url).'){
                                        $("#custom_element_slider-'.$id_rnd.' .slides").each(function(){
                                                $(this).css("justify-content", "center");
                                                if ($(this).children().length > '.count($media_url).'){
                                                        $(this).children().slice('.count($media_url).').remove();
                                                };

                                        });
                                        const imageWidth = Math.floor((slidesWidth - imagesMulti * 10) / imagesMulti);
                                        images.forEach((image) => {
                                                image.style.maxWidth = imageWidth + "px";
                                        });
                                } else {
                                        const imageWidth = Math.floor((slidesWidth - imagesMulti * 10) / imagesMulti);
                                        images.forEach((image) => {
                                                image.style.minWidth = imageWidth + "px";
                                        });
                                        const slidesTransform =  (imageWidth + 10) * '.(-$min_image).';

                                        slides.style.transform = `translateX(-${slidesTransform}px)`;

                                        function nextSlide() {
                                                slides.querySelectorAll("#custom_element_slider-'.$id_rnd.' .image-container").forEach(function(image){
                                                        image.classList.add("slide");
                                                })
                                                slides.firstChild.classList.add("first-slide");
                                                const firstSlide = slides.querySelector(".first-slide");  

                                                slides.appendChild(firstSlide);

                                                firstSlide.classList.remove("first-slide");

                                                setTimeout(function() {
                                                        slides.querySelectorAll("#custom_element_slider-'.$id_rnd.' .image-container").forEach(function(image){
                                                                image.classList.remove("slide");
                                                        })
                                                }, '.($slide_speed / 2).');
                                        }                       

                                        slider.addEventListener("mousemove", function() {
                                                isMouseOver = true;
                                        });
                                        
                                        slider.addEventListener("mouseleave", function() {
                                                isMouseOver = false;
                                        });

                                        let isDown = false;
                                        let startX;
                                        let startY;
                                        let slideMove = 0;

                                        slider.addEventListener("mousedown", (e) => {
                                                isDown = true;
                                                slider.classList.add("active");
                                                startX = e.pageX - slider.offsetLeft;
                                        });

                                        slider.addEventListener("mouseleave", () => {
                                                isDown = false;
                                                slider.classList.remove("active");
                                                resetSlider(slideMove);
                                                slideMove = 0;
                                        });

                                        slider.addEventListener("mouseup", () => {
                                                isDown = false;
                                                slider.classList.remove("active");
                                                resetSlider(slideMove);
                                                slideMove = 0;
                                        });

                                        slider.addEventListener("mousemove", (e) => {
                                                if (!isDown) return;
                                                e.preventDefault();
                                                let preventDefaultNextTime = true;

                                                $(e.target).parent().on("click", function(event) {
                                                        if (preventDefaultNextTime) {
                                                                event.preventDefault();
                                                                preventDefaultNextTime = true;

                                                                setTimeout(() => {
                                                                        preventDefaultNextTime = false;
                                                                }, 200);
                                                        }
                                                });
                                                const x = e.pageX - slider.offsetLeft;
                                                const walk = (x - startX);
                                                const transformWalk = slidesTransform - walk;
                                                slides.style.transform = `translateX(-${transformWalk}px)`;
                                                slideMove = (walk / imageWidth);
                                        });

                                        // Kod obsługujący przesuwanie dotykiem na urządzeniach mobilnych

                                        slider.addEventListener("touchstart", (e) => {
                                                isDown = true;
                                                slider.classList.add("active");
                                                startX = e.touches[0].pageX - slider.offsetLeft;
                                                startY = e.touches[0].pageY;
                                        });

                                        slider.addEventListener("touchend", () => {
                                                isDown = false;
                                                slider.classList.remove("active");
                                                resetSlider(slideMove);
                                                slideMove = 0;
                                        });

                                        slider.addEventListener("touchmove", (e) => {
                                                if (!isDown) return;
    
                                                const x = e.touches[0].pageX - slider.offsetLeft;
                                                const y = e.touches[0].pageY;
                                                const walk = (x - startX);
                                                const verticalDiff = Math.abs(y - startY);

                                                if (Math.abs(walk) > verticalDiff) { // Tylko jeśli ruch poziomy jest większy niż pionowy
                                                        e.preventDefault();
                                                        const transformWalk = slidesTransform - walk;
                                                        slides.style.transform = `translateX(-${transformWalk}px)`;
                                                        slideMove = (walk / imageWidth);
                                                }
                                        });
                                        
                                        const resetSlider = (slideWalk) => {
                                                const slidesMove = Math.abs(Math.round(slideWalk));
                                                for(i = 0; i< slidesMove; i++){
                                                        if(slideWalk > 0){
                                                                slides.lastChild.classList.add("last-slide");
                                                                const lastSlide = slides.querySelector(".last-slide");  
                                                                slides.insertBefore(lastSlide, slides.firstChild);
                                                                lastSlide.classList.remove("last-slide");
                                                        } else {
                                                                slides.firstChild.classList.add("first-slide");
                                                                const firstSlide = slides.querySelector(".first-slide");  
                                                                slides.appendChild(firstSlide);
                                                                firstSlide.classList.remove("first-slide");
                                                        }
                                                }
                                                slides.style.transform = `translateX(-${slidesTransform}px)`;
                                        }
                                        setInterval(function() {
                                                if(!isMouseOver) { 
                                                        nextSlide()
                                                }
                                        }, '.$slide_speed.');
                                }
                        });                 
                </script>
                ';
        return $output;
    }
    ?>

    <style>
    .custom_element_catalog_slider {
        width: 100%;
        overflow: hidden;
        margin: 0 !important;
    }
    .slides {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 0 !important;
        min-height : 0 !important;
        min-width : 0 !important;
        pointer-events: auto;
    }
    .slides div {
        padding:0;
        /* flex: 1; */
        object-fit: contain !important;
    }
    .slides .image-container div{
        margin: 5px !important;
    }
    @keyframes slideAnimation {
        from {
        transform: translateX(100%);
        }
        to {
        transform: translateX(0);
        }
    }
    .slides .slide{
        animation: slideAnimation 0.5s ease-in-out;
    }
    </style>
