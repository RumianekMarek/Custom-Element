<?php

$videos_urldecode = urldecode($videos);
$videos_json = json_decode($videos_urldecode, true);

if (!empty($videos_json)) {
    if ($video_custom_title == "") {
        if($locale == 'pl_PL') {
            $video_custom_title = "Zobacz jak było na poprzednich edycjach";
        } else {
            $video_custom_title = "Check previous editions";
        } 
    } 
} else {
    if($locale == 'pl_PL') {
        $video_custom_title = "ZOBACZ JAK WYGLĄDAJĄ NASZE POZOSTAŁE TARGI";
    } else {
        $video_custom_title = "SEE WHAT OUR OTHER TRADE FAIRS LOOK LIKE";
    }
}


?>

<style>
    .custom-container-videos {
        display: flex;
        flex-direction: column;
        gap: 36px;
    }
    .custom-videos-title h4 {
        margin: 0;
    }
    .custom-videos {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 36px;
    }
    .custom-video-item {
        width: 47%;
    }
    .custom-video-item p {
        font-size: 18px;
    }
    @media (max-width:960px) {
        .custom-videos {
            flex-direction: column;
        }
        .custom-video-item {
            width: 100%;
        }
    }
</style>

<div id='customVideos' class='custom-container-videos'>
    <div class="custom-videos-title main-heading-text">
        <h4 class="custom-uppercase"><span><?php echo $video_custom_title ?></span></h4>
    </div>  
    <div class="custom-videos">
    <?php
        

        if (!empty($videos_json)) {
            foreach ($videos_json as $video) {
                $video_title = $video["video_title"];
                $video_iframe = $video["video_iframe"];

                echo'<div class="custom-video-item">';
                    echo $video_iframe;
                    echo '<p>'. $video_title .'</p>';
                echo'</div>';
            }
        } else {
            echo'<div class="custom-video-item">
                    <iframe class="iframe-shadow" width="560" height="315" data-src="https://www.youtube.com/embed/TgHh38jvkAY?si=pc01x3a22VkL-qoh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    <p>Ptak Warsaw Expo | 2023</p>
                </div>';
            $video_title_2 = ($locale == 'pl_PL') ? "Stolica Targów i Eventów w Polsce - Ptak Warsaw Expo" : "The Capital of Fairs and Events in Poland - Ptak Warsaw Expo";
            echo'<div class="custom-video-item">
                    <iframe class="iframe-shadow" width="560" height="315" data-src="https://www.youtube.com/embed/-RmRpZN1mHA?si=2QHfOrz0TUkNIJwP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    <p>'. $video_title_2 .'</p>
                </div>';
        }
    ?>
    </div>
</div>

<script>
    const iframes = document.querySelectorAll('.custom-video-item iframe');
    if (iframes) {
        iframes.forEach((iframe) => iframe.classList.add('iframe-shadow'));
    }

    document.addEventListener("DOMContentLoaded", function() {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    // Pobranie iframe i ustawienie src z data-src
                    var iframe = entry.target;
                    if (iframe.getAttribute('data-src')) {
                        iframe.src = iframe.getAttribute('data-src');
                        iframe.removeAttribute('data-src'); // Usunięcie data-src
                    }

                    // Przestajemy obserwować ten element
                    observer.unobserve(iframe);
                }
            });
        }, {
            rootMargin: '100px 0px', // Zwiększenie obszaru obserwowanego
            threshold: 0.1
        });

        // Rozpoczęcie obserwacji elementów iframe
        document.querySelectorAll('.custom-video-item iframe[data-src]').forEach(function(iframe) {
            observer.observe(iframe);
        });
    });
</script>