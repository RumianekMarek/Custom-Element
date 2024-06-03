<?php
    function custom_posts_slider ($media_url_array, $slide_speed = 3000){
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
                                        

                                        if(is_array($media_url_array[$imgNumber]) && !empty($media_url_array[$imgNumber]['img']) && !empty($media_url_array[$imgNumber]['link']) && !empty($media_url_array[$imgNumber]['title'])){
                                            $imageUrl = $media_url_array[$imgNumber]['link'];
                                            $imageTitle = $media_url_array[$imgNumber]['title'];
                                            $output .= '<a class="custom-post" href="'.$imageUrl.'">
                                                            <div class="custom-post-thumbnail image-shadow">
                                                                <div class="t-entry-visual">
                                                                    <div class="image-container" style="'.$imageStyles.'"></div>
                                                                </div>
                                                            </div> 
                                                            <h5 class="custom-post-title">'.$imageTitle.'</h5>
                                                        </a>';  
                                        }
                                        
                                }
        $output .='</div>
                </div>
                <script>
                        jQuery(function ($) {                         
                                const slider = document.querySelector("#custom_element_slider-'.$id_rnd.'");
                                const slides = document.querySelector("#custom_element_slider-'.$id_rnd.' .slides");
                                const images = document.querySelectorAll("#custom_element_slider-'.$id_rnd.' .slides .custom-post");

                                let isMouseOver = false;
                                let isDragging = false;
                                
                                let imagesMulti = "";
                                const slidesWidth = slider.clientWidth; // <--------------------------------------------------<

                                if (slidesWidth < 400) {
                                        imagesMulti = 1;
                                } else if (slidesWidth < 600) {
                                        imagesMulti = 2;
                                } else if (slidesWidth < 900) {
                                        imagesMulti = 3;
                                } else if (slidesWidth < 1100) {
                                        imagesMulti = 4;
                                } else {
                                        imagesMulti = 4;
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
                                                image.style.minWidth = imageWidth + "px";
                                                image.style.maxWidth = imageWidth + "px";
                                        });
                                } else {
                                        const imageWidth = Math.floor((slidesWidth - imagesMulti * 10) / imagesMulti);
                                        images.forEach((image) => {
                                                image.style.minWidth = imageWidth + "px";
                                                image.style.maxWidth = imageWidth + "px";
                                        });

                                        const slidesTransform = (imageWidth + 18) * '.(-$min_image).';

                                        slides.style.transform = `translateX(-${slidesTransform}px)`; 

                                        function nextSlide() {
                                                slides.querySelectorAll("#custom_element_slider-'.$id_rnd.' .custom-post").forEach(function(image){
                                                        image.classList.add("slide");
                                                })
                                                slides.firstChild.classList.add("first-slide");
                                                const firstSlide = slides.querySelector(".first-slide");  

                                                slides.appendChild(firstSlide);

                                                firstSlide.classList.remove("first-slide");

                                                setTimeout(function() {
                                                        slides.querySelectorAll("#custom_element_slider-'.$id_rnd.' .custom-post").forEach(function(image){
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

                                        const links = document.querySelectorAll("#custom_element_slider-'. $id_rnd .' a");
                                        links.forEach(link => {
                                                link.addEventListener("mousedown", (e) => {
                                                e.preventDefault();
                                                });
                                        });

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
                                            
                                                if (!e.cancelable) return; // Dodajemy ten warunek, aby uniknąć błędu
                                            
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
    .custom-posts .custom_element_catalog_slider {
        width: 100%;
        overflow: hidden !important;
        margin: 0 !important;
    }
    .custom-posts .slides {
        display: flex;
        align-items: flex-start !important;
        justify-content: space-between;
        min-height : 0 !important;
        min-width : 0 !important;
        pointer-events: auto;
    }
    .custom-posts .slide {
        padding:0;
    }
    @keyframes slideAnimation {
        from {
        transform: translateX(100%);
        }
        to {
        transform: translateX(0);
        }
    }
    .custom-posts .slides .slide{
        animation: slideAnimation 0.5s ease-in-out;
    }
    @media (max-width: 1200px) {
        .custom-posts .custom_element_catalog_slider {
                overflow: visible !important;
        }
    }
    </style>

<?php
        if ($posts_full_width === 'true') {
            echo'<style>
                        .custom-posts-wrapper {
                                overflow: visible !important;
                        }
                </style>';
        }
?>