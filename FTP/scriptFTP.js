const PotwierdzenieUsuniecia = (event) => {
    event.target.style.display = 'none';

    setTimeout(() => {
        event.target.parentNode[4].style.display = 'block';
    }, 2000);
    
}