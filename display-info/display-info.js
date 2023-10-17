jQuery(function ($) {
    $(".open-desc").click(function(event) {
        let targetElement = '';
        if ($(event.target.parentElement).hasClass('text-container')){
            targetElement = $(event.target.parentElement).find(".inside-text");
            $(event.target.parentElement.parentElement).find(".open-desc i").toggleClass("rotated");
        } else if ($(event.target.parentElement).hasClass('open-desc')){
            targetElement = $(event.target.parentElement.parentElement).find(".inside-text");
            $(event.target.parentElement.parentElement).find(".open-desc i").toggleClass("rotated");
        }

        if (targetElement.css('max-height') === '77px') {
            targetElement.css('max-height', '1000px');
        } else {
            targetElement.css('max-height', '77px');
            
        }
    });

    const allLecturers = document.querySelectorAll('.chevron-slide .lecturers-bio');
    for(i=0;i<allLecturers.length; i++){
        allLecturers[i].addEventListener('click', function(event) {
            const modal = event.target.parentElement.parentElement.querySelector('.info-modal');
            modal.style.display = 'block';
            $('.no-touch').css("overflow", "hidden");

            modal.querySelector('.info-close').addEventListener('click', function(){
                modal.style.display = 'none';
                $('.no-touch').css("overflow", "initial");
            });
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                  modal.style.display = 'none';
                  $('.no-touch').css("overflow", "initial");
                }
            });
        });
    }
});