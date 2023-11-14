jQuery(function ($) {
    if(js_gallery_export.view === "Full"){
        $(".custom-image-gallery-picture, .modal-image-arrow").css("cursor", "pointer");
        $(".modal-image-gallery-picture, .modal-image-arrow").hover(function () {
                // Funkcja wywoływana po najechaniu myszką
                $('.modal-image-arrow').show("normal");
        });
        $(".custom-media-gallery-modal").hover(function () {
                // Funkcja wywoływana po zjechaniu myszką z elementu
                $('.modal-image-arrow').hide("normal");
        });

        const allPictures = document.querySelectorAll(".custom-image-gallery-picture");
        const modal = $(".custom-media-gallery-modal");
        for(i=0; i<allPictures.length; i++){
            allPictures[i].addEventListener("click", function(event) {
                const targetImage = event.target.src;
                const modalImage = $(".custom-media-gallery-modal .modal-image-gallery-picture");
                modalImage.attr("src", targetImage);
                let imageIndex = js_gallery_export.gallery.indexOf(targetImage);

                $(".modal-last-image").click(function(){
                    if(imageIndex >= 0){
                        imageIndex--;
                    } else {
                        imageIndex = js_gallery_export.gallery.length - 1;
                    }
                    modalImage.attr("src", js_gallery_export.gallery[imageIndex]);
                });

                $(".modal-next-image").click(function(){
                    if(imageIndex < js_gallery_export.gallery.length - 1){
                        imageIndex++;
                    } else {
                        imageIndex = 0;
                    }
                    modalImage.attr("src", js_gallery_export.gallery[imageIndex]);
                });

                modal.css("display", "flex");

                window.addEventListener("click", function(event) {
                    if (event.target == modal[0]) {
                    modal.css("display", "none");
                    }
                });
            });
        }
    }
    if(js_gallery_export.view === "Linked"){
        
    }
});