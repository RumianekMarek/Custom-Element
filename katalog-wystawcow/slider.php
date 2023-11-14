<?php
function custom_media_slider ($media_url, $slide_speed = 3000){
        $id_rnd = rand(10000, 99999);
        $min_image = -7;
        if(count($media_url) >= 7 && count($media_url) < 14){
                $max_image = count($media_url) + 7;
        } elseif(count($media_url) < 7){
                $max_image = count($media_url) + count($media_url);
                $min_image = -count($media_url);
        } else {
                $max_image = count($media_url);  
        }        
        $output = '<div id="custom_element_slider-'.$id_rnd.'" class="custom_element_catalog_slider">
                        <div class ="slides">';
                                for ($i = $min_image; $i < ($max_image); $i++) {
                                        if($i<0){
                                                $imageStyles = "background-image:url('".$media_url[(count($media_url) + $i)]."');";
                                        }
                                        if($i>=0 && $i<(count($media_url))){
                                                $imageStyles = "background-image:url('".$media_url[$i]."');";
                                        }
                                        if($i>=(count($media_url))){
                                                $imageStyles = "background-image:url(".$media_url[($i - count($media_url))].");";
                                        }
                                        
                                        $output .= '<div class="image-container" style="'.$imageStyles.'"></div>';
                                }
        $output .='</div>
                </div>
                <script>
                        {
                        const slides = document.querySelector("#custom_element_slider-'.$id_rnd.' .slides");
                        const images = document.querySelectorAll("#custom_element_slider-'.$id_rnd.' .slides .image-container");
                        
                        const slidesWidth = slides.clientWidth;
                        let isMouseOver = false;
                        let isDragging = false;
                        let startX = 0;
                        let scrollLeft = 0;

                        let imagesMulti = "";
                        if (window.matchMedia("(max-width: 600px)").matches) {
                                imagesMulti = 3;
                        } else if (window.matchMedia("(max-width: 959px)").matches) {
                                imagesMulti = 5;
                        } else {
                                imagesMulti = 7;
                        }
                        
                        const imageWidth = Math.floor((slidesWidth - imagesMulti * 10) / imagesMulti);
                        images.forEach((image) => {
                                image.style.minWidth = imageWidth + "px";
                        });
                        slides.style.transform = `translateX(-${(imageWidth + 10) * '.(-$min_image).'}px)`;
                        console.log(slidesWidth);
                        console.log(imageWidth);
                        console.log((imageWidth + 10) * '.(-$min_image).');
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

                        

                        slides.addEventListener("mousemove", function() {
                                isMouseOver = true;
                        });
                        
                        slides.addEventListener("mouseleave", function() {
                                isMouseOver = false;
                        });

                        setInterval(function() {
                                if(!isMouseOver && '.count($media_url).' > imagesMulti) { 
                                        nextSlide()
                                }
                        }, '.$slide_speed.');
                        }
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
.slides .image-container {
        padding:0;
        flex: 1;
        object-fit: contain !important;
        margin: 0 5px !important;
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
