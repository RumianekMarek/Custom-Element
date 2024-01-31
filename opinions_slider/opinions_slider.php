<?php
function media_opinions() {
    vc_map(array(
        'name' => __('Opinions slider', 'my-custom-plugin'),
        'base' => 'media_opinions',
        'category' => __('My Elements', 'my-custom-plugin'),
        'params' => array(
            array(
                'type' => 'textfield',
                'group' => 'main',
                'heading' => __('Opinions Header', 'my-custom-plugin'),
                'param_name' => 'opinions_header',
                'description' => __('Header for opinions slider section', 'my-custom-plugin'),
                'save_always' => true,
            ),
            array(
                'type' => 'param_group',
                'group' => 'main',
                'param_name' => 'opinion_slides',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => __('Select Image', 'my-custom-plugin'),
                        'param_name' => 'opinions_image',
                        'description' => __('Choose logo image from the opinions slider.', 'my-custom-plugin'),
                        'save_always' => true,
                        'dependency' => array(
                            'element' => 'multiple',
                            'value' => array('false'),
                        ),
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => __('Quote', 'my-custom-plugin'),
                        'param_name' => 'opinions_quote',
                        'description' => __('Put quote max 300 characters.', 'my-custom-plugin'),
                        'save_always' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Opinions signature', 'my-custom-plugin'),
                        'param_name' => 'opinions_sign',
                        'description' => __('Put opinions author name', 'my-custom-plugin'),
                        'save_always' => true,
                        'admin_label' => true,
                    ),
                ),
            ),
        ),
    ));
}

function media_opinions_output($atts, $content = null) {
    extract(shortcode_atts(array(
        'opinions_header' => '',
        'opinion_slides' => '',
    ), $atts));
    $opinions_id_random = rand(10000, 99999);
    $slider_local = get_locale();
    $opinion_slides = urldecode($opinion_slides);
    $opinion_slides = json_decode($opinion_slides, true);

    $opinion_placement = (count($opinion_slides) < 3 || count($opinion_slides) % 2 === 0 ) ? 'justify-content: space-evenly;' : 'justify-content: flex-end' ;
    $opinion_placement_mobile = (count($opinion_slides) < 3 || count($opinion_slides) % 2 === 0 ) ? 'justify-content: space-between !important;' : 'justify-content: space-evenly;' ;

    $html_opinions .=
    '<style>
        #opinion-slider-'.$opinions_id_random.' .opinions-slider-container{
            overflow:hidden;
            position: relative;
        }
        #opinion-slider-'.$opinions_id_random.' :is(.arrow-left, .arrow-right){
            cursor: pointer;
            z-index: 5;
            top: 50%;
            position: absolute;
            filter: brightness(0) invert(1);
        }
        #opinion-slider-'.$opinions_id_random.' .arrow-left{
            left: -3vw;
        }
        #opinion-slider-'.$opinions_id_random.' .arrow-right{
            right: -3vw;
        }
        #opinion-slider-'.$opinions_id_random.' h2{
            color: #ffffff;
            text-align: center;
            margin: 0 18px 18px;
        }
        #opinion-slider-'.$opinions_id_random.' .slide-container{
            display: flex;
            '.$opinion_placement.'
            padding-bottom: 10px;
        }
        #opinion-slider-'.$opinions_id_random.' .slide-container h4{
            margin: 9px;
        }
        #opinion-slider-'.$opinions_id_random.' .slide-container p{
            line-height: 1.4 !important;
            margin: 9px;
            color: #000000;
            font-weight: 600;

        }
        #opinion-slider-'.$opinions_id_random.' .single-slide{
            box-shadow: 9px 9px 0px -5px black;
            background: #ffffff;
            margin: 0 29px;
            padding: 18px;
            min-width: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: auto;
        }
        #opinion-slider-'.$opinions_id_random.' .container-img{
            text-align: center;
            height: 200px;
            width: 200px;
        }
        #opinion-slider-'.$opinions_id_random.' .container-img img{
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
        #opinion-slider-'.$opinions_id_random.' .single-slide :has(.opinions-hidden){
            height: 300px;
        }
        @keyframes slideAnimation {
            from {
                transform: translateX(111%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideAnimationY {
            from {
                height: 0;
            }
            to {
                height: 100%;
            }
        }
        #opinion-slider-'.$opinions_id_random.' .slidesY{
            animation: slideAnimationY 0.5s ease-in-out;
        }
        #opinion-slider-'.$opinions_id_random.' .op-slides{
            animation: slideAnimation 0.5s ease-in-out;
        }
        #opinion-slider-'.$opinions_id_random.' .slides-revers{
            animation: slideAnimation 0.5s reverse ease-in-out;
        }
        #opinion-slider-'.$opinions_id_random.' .opinions-hidden{
            overflow: hidden;
            height: 105px;
        }
        #opinion-slider-'.$opinions_id_random.' .organizator-box-shadow-left {
            margin-left: -18px;
            margin-bottom: -20px;
            box-shadow: -3px -3px #ffffff;
            width: 170px !important;
            height: 40px;
        }
        #opinion-slider-'.$opinions_id_random.' .organizator-box-shadow-right {
            margin-right: -18px;
            margin-top: -20px;
            box-shadow: 3px 3px #ffffff;
            width: 170px !important;
            height: 40px;
            float: right;
        }
        @media (min-width:900px) and (max-width: 1200px){
            #opinion-slider-'.$opinions_id_random.' .single-slide{
                padding: 9px 36px;
                margin: 0 1vw;
                min-width: 44vw;
            }
        }
        @media (max-width: 900px){
            #opinion-slider-'.$opinions_id_random.' .opinions-slider-container{
                width:80vw;
                margin: auto;
            }
            #opinion-slider-'.$opinions_id_random.' .slide-container{
                display: flex;
                '.$opinion_placement_mobile.'
            }
            #opinion-slider-'.$opinions_id_random.' .single-slide{
                min-width: 70vw;
                margin: 0 5vw;
            }
        }
        @media (max-width: 600px){
            #opinion-slider-'.$opinions_id_random.' :is(.arrow-left, .arrow-right){
                width: 5vw;
            }
        }
    </style>';

        $html_opinions .= '<div id="opinion-slider-'.$opinions_id_random.'" class="opinions-slider">';
        $html_opinions .=  '<p class="organizator-box-shadow-left">&nbsp;</p>';

        if (count($opinion_slides) > 1){
            if (count($opinion_slides) > 2 || preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])){
                $html_opinions .= '<img class="arrow-left" src="'.plugin_dir_url(__DIR__).'/media/arrow-left.webp">';
            }
        }
            $html_opinions .= '<div class="opinions-slider-container">';
                $html_opinions .= '<h2 class="opinions-header">';
                    if ($opinions_header === ""){
                        if($slider_local === "pl_PL"){
                            $html_opinions .= 'Opinie naszych gości</h2>'; 
                        } else {
                            $html_opinions .= "Guests' opinions about the fair</h2>";
                        }
                    } else {
                        $html_opinions .= $opinions_header.'</h2>';
                    }
                $html_opinions .= '<div class="slide-container">';
                if(count($opinion_slides) <3){
                    $count_min = 0;
                    $count_max = count($opinion_slides);
                } else {
                    $count_min = -1;
                    $count_max = count($opinion_slides) -1;
                }
                    for($i= $count_min; $i<$count_max; $i++){
                        if($i<0){
                            $target = count($opinion_slides) + $i;
                        } else {
                            $target = $i;
                        }
                        $html_opinions .= '<div class="single-slide">
                            <div class="container-img"><img class="op-img" src="'.wp_get_attachment_url($opinion_slides[$target]['opinions_image']).'"></div>
                            <p class="opinions-quote opinions-hidden">'.$opinion_slides[$target]['opinions_quote'].'</p>
                            <h4 class="opinions-signature">'.$opinion_slides[$target]['opinions_sign'].'</h4>
                        </div>';
                    }
                $html_opinions .= '</div>';
            $html_opinions .= '</div>';

            if (count($opinion_slides) > 1){
                if (count($opinion_slides) > 2 || preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])){
                    $html_opinions .= '<img class="arrow-right" src="'.plugin_dir_url(__DIR__).'/media/arrow-right.webp">';
                }
            }

            $html_opinions .= '<p class="organizator-box-shadow-right">&nbsp;</p>';
        $html_opinions .= '</div>';
            
        $html_opinions .= 
        '<script>
        jQuery(function ($) {
            $(".vc_row:has(div.single-slide)").addClass("style-accent-bg");

            function nextSlide_'.$opinions_id_random.'() {     
                $("#opinion-slider-'.$opinions_id_random.' .single-slide").addClass("op-slides");

                $("#opinion-slider-'.$opinions_id_random.' .single-slide:first-child").appendTo(quotesSlides);
                $("#opinion-slider-'.$opinions_id_random.' .single-slide:first-child").removeClass("first-slide");
            
                setTimeout(function() {        
                    $("#opinion-slider-'.$opinions_id_random.' .single-slide").removeClass("op-slides");
                }, 500);
            }
        
            function previousSlide_'.$opinions_id_random.'() {
                $("#opinion-slider-'.$opinions_id_random.' .single-slide").addClass("slides-revers");
            
                setTimeout(function() {
                    $("#opinion-slider-'.$opinions_id_random.' .single-slide:last-child").prependTo(quotesSlides);
                    $("#opinion-slider-'.$opinions_id_random.' .single-slide").removeClass("slides-revers");
                }, 500);
            }

            const quotesSlides = document.querySelector("#opinion-slider-'.$opinions_id_random.' .slide-container");
            let isMouseOver_'.$opinions_id_random.' = false;
            
            $("#opinion-slider-'.$opinions_id_random.'").on("mousemove", function() {
                isMouseOver_'.$opinions_id_random.' = true;
            });
            
            $("#opinion-slider-'.$opinions_id_random.'").on("mouseleave", function() {
                isMouseOver_'.$opinions_id_random.'= false;
            });

            $(document).ready(function() {
                $("#opinion-slider-'.$opinions_id_random.' .arrow-left").on("click", function() {
                    previousSlide_'.$opinions_id_random.'();
                });
                $("#opinion-slider-'.$opinions_id_random.' .arrow-right").on("click", function() {
                    nextSlide_'.$opinions_id_random.'();
                });
            });
            ';
            if (count($opinion_slides) > 1){
                if (count($opinion_slides) > 2 || preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT'])){
                $html_opinions .= '
                    setInterval(function() {
                        if(!isMouseOver_'.$opinions_id_random.') { 
                            nextSlide_'.$opinions_id_random.'()
                        }
                    }, 5000);';
                }
            } 
            
        $html_opinions .= '
        });
        
    </script>'; 

    return $html_opinions;
}

add_action('vc_before_init', 'media_opinions');
add_shortcode('media_opinions', 'media_opinions_output');
?>