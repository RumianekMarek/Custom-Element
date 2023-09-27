console.log(document.querySelectorAll('.text-container'));
jQuery(function ($) {
    hidden = true;
    $(".open-desc").click(function(event) {
        console.log(event.target.parentElement);
        let targetNod = '';
        if ($(event.target.parentElement).hasClass('text-container')){
            targetNod = event.target.parentElement;
        } else if ($(event.target.parentElement).hasClass('open-desc')){
            targetNod = event.target.parentElement.parentElement;
        }
        if (targetNod) {
            targetNod.find(".inside-text").slideToggle();
            targetNod.find(".open-desc").slideToggle();
        }
    });
    
    // if (inner.event_modal != ''){
    //     const rightJson = inner.event_modal
    //     .replace(/``/g, '"')
    //     .replace(/`{`/g, '[')
    //     .replace(/`}`/g, ']');

    //     const modal_info = JSON.parse(rightJson);

    //     modal_info.forEach(function(item){
    //         if(item.desc != ''){
    //             const targetSpeakerCLass = item.id.replace(/\s+/g, '.');
    //             const targerSpeaker = document.querySelector('.'+targetSpeakerCLass);

    //             console.log(targerSpeaker.children[0].currentSrc);

    //             const button = document.createElement('button');
    //             button.innerText = 'BIO';
    //             button.classList.add('speaker-bio');

    //             button.addEventListener('click', function(){
    //                 const modal = document.querySelector('#myModal');
    //                 const modalImg = document.querySelector('#modalImg');
    //                 const modalHeader = document.querySelector('#modalHeader');
    //                 const modalText = document.querySelector('#modalText');
    //                 const closeBtn = document.querySelector('.close');

    //                 modalImg.src = targerSpeaker.children[0].currentSrc;
    //                 modalImg.alt = item.id;

    //                 modalHeader.innerText = item.id;
    //                 modalText.innerText = item.desc;

    //                 setTimeout(function() {modal.style.display = "block";}, 200);
                    
    //                 closeBtn.onclick = function() {
    //                     modal.style.display = "none";
    //                 }

    //                 window.onclick = function(event) {
    //                     if (event.target == modal) {
    //                         modal.style.display = "none";
    //                     }
    //                 }
    //             });
    //             targerSpeaker.appendChild(button);
    //         }
    //     });
    // }
});