<?php

$videos_urldecode = urldecode($videos);
$videos_json = json_decode($videos_urldecode, true);
foreach ($videos_json as $video) {
    $video_iframe = $video["video_iframe"];
}

if (!empty($video_iframe)) {
    if ($video_custom_title == "") {
        $video_custom_title = ($locale == 'pl_PL') ? "Zobacz jak było na poprzednich edycjach" : "Check previous editions";
    }
} else $video_custom_title = ($locale == 'pl_PL') ? "ZOBACZ JAK WYGLĄDAJĄ NASZE POZOSTAŁE TARGI" : "SEE WHAT OUR OTHER TRADE FAIRS LOOK LIKE";     


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

        if (!empty($video_iframe)) {
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
    {
        const customIframes = document.querySelectorAll('.custom-video-item iframe');
        if (customIframes) {
            customIframes.forEach((customIframe) => customIframe.classList.add('iframe-shadow'));
        }

        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        // Pobranie iframe i ustawienie src z data-src
                        var customIframe = entry.target;
                        if (customIframe.getAttribute('data-src')) {
                            customIframe.src = customIframe.getAttribute('data-src');
                            customIframe.removeAttribute('data-src'); // Usunięcie data-src
                        }

                        // Przestajemy obserwować ten element
                        observer.unobserve(customIframe);
                    }
                });
            }, {
                rootMargin: '100px 0px', // Zwiększenie obszaru obserwowanego
                threshold: 0.1
            });

            // Rozpoczęcie obserwacji elementów iframe
            document.querySelectorAll('.custom-video-item iframe[data-src]').forEach(function(customIframe) {
                observer.observe(customIframe);
            });
        });
    }
</script>