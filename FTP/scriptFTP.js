const PotwierdzenieUsuniecia = (event) => {
    event.target.classList.toggle('display-none')
    const eventer = event.target.parentNode.querySelectorAll('.display-none');

    if (event.target.classList.contains('usuwam')){
        setTimeout(() => {
            for(i=1; i<eventer.length; i++){
                eventer[i].classList.toggle('display-none')
            }
        }, 1000);
    } else {
        for(i=1; i<eventer.length; i++){
            eventer[i].classList.toggle('display-none')
        }
    }
    
}