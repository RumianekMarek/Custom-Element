jQuery(function ($) {
    $('.speakers-bio').on('click', function (event) {
        $('.no-touch').css("overflow", "hidden");
        element = $(event.target).parent().get(0);
        elementNumber = element.classList[1].match(/\d+/)[0];

        const modalMainDiv = $('<div>').addClass('info-modal').attr('id', 'info-modal');

        const modalDiv = $('<div>').addClass('speaker');

        if (speakers[elementNumber].speaker_bio.length < 1000) {
            $(modalDiv).css('max-width', '600px');
        } else if (speakers[elementNumber].speaker_bio.length >= 1000 && speakers[elementNumber].speaker_bio.length <= 2000) {
            $(modalDiv).css('max-width', '800');
        } else if (speakers[elementNumber].speaker_bio.length > 2000) {
            $(modalDiv).css('max-width', '1000px');
        }

        console.log(speakers[elementNumber].speaker_bio.length);

        const modalImage = $('<img>').addClass('custom-speaker-modal-img').attr('src', speakers[elementNumber].speaker_image).css({ width: '200px', height: '200px' });
        const modalName = $('<h3>').addClass('speaker-name').text(speakers[elementNumber].speaker_name);
        const modalBio = $('<p>').addClass('speaker-bio').text(speakers[elementNumber].speaker_bio);
        const modalClose = $('<i>').addClass('fa fa-times-circle-o fa-2x fa-fw info-close');

        $(modalMainDiv).append(modalDiv);

        $(modalDiv).append(modalClose);
        $(modalDiv).append(modalImage);
        $(modalDiv).append(modalName);
        $(modalDiv).append(modalBio);
        $(element).append(modalMainDiv);

        $(modalClose).on('click', function (event) {
            $(event.target).parent().parent().remove();
            $('.no-touch').css("overflow", "initial");
        });

        $(modalMainDiv).on('click', function (event) {
            if ($(event.target).is(modalMainDiv)) {
                $(event.target).remove();
                $('.no-touch').css("overflow", "initial");
            }
        });
    });
});