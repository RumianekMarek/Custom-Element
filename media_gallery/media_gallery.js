jQuery(function ($) {
    if (js_gallery_export.view === "Full") {
        $(".custom-image-gallery-picture, .modal-image-arrow").css("cursor", "pointer");

        const modal = $(".custom-media-gallery-modal");

        $(".custom-image-gallery-picture").each(function () {
            $(this).click(function () {
                const imageUrl = $(this).attr('src');
                $(".custom-media-gallery-modal .modal-image-gallery-picture").attr('src', imageUrl);
                modal.show();
            });

        });

        $(window).click(function (event) {
            if (event.target == modal[0]) {
                modal.hide();
            }
        });
    }
});