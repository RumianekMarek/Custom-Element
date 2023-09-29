jQuery(function ($) {
    $(".open-desc").click(function(event) {
        if ($(event.target.parentElement).hasClass('text-container')){
            $(event.target.parentElement).find(".inside-text").slideToggle("fast");
            $(event.target.parentElement.parentElement).find(".open-desc i").toggleClass("rotated");
        } else if ($(event.target.parentElement).hasClass('open-desc')){
            $(event.target.parentElement.parentElement).find(".inside-text").slideToggle("fast");
            $(event.target.parentElement.parentElement).find(".open-desc i").toggleClass("rotated");
        }
    });

    const allLecturers = document.querySelectorAll('.chevron-slide .lecturers-bio');
    for(i=0;i<allLecturers.length; i++){
        allLecturers[i].addEventListener('click', function(event) {
            const modal = event.target.parentElement.parentElement.querySelector('.info-modal');
            modal.style.display = 'block';
            modal.querySelector('.info-close').addEventListener('click', function(){
                modal.style.display = 'none';
            });
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                  modal.style.display = 'none';
                }
            });
        });
    }
});