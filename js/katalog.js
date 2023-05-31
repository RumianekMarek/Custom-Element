json = katalog_data.data;
id_targow = katalog_data.id_targow;
details = katalog_data.details;

const exhibitors = Object.entries(json[id_targow]["Wystawcy"]);
const spinner = document.getElementsByClassName('spinner')[0];
spinner.style.display = "none";
const catRoot = document.getElementById('cat');
const divContainerHeader = document.createElement('div');
const divContainer = document.createElement('div');

divContainer.classList.add('exhibitors');

divContainerHeader.classList.add('exhibitor__header');
divContainerHeader.innerHTML ='<h1>Katalog wystawców</h1>';
divContainerHeader.style.backgroundImage = "url(https://cleanexpo.pl/doc/header.jpg)";

const inputSearch = document.createElement('input');
inputSearch.id = 'search'
inputSearch.placeholder = "Szukaj";

const divContainerExhibitors = document.createElement('div');
divContainerExhibitors.classList.add('exhibitors__container');

exhibitors.map(item => {
    const singleExhibitor = document.createElement('div');
    let singleExhibitorElementHTML;
    if (item[1].URL_logo_wystawcy) {
        singleExhibitorElementHTML =  `	
            <div class="exhibitors__container-list-img" style="background-image: url(${item[1].URL_logo_wystawcy})"></div>
            <p class="exhibitors__container-list-text-name">${item[1].Nazwa_wystawcy}</p>`;
    } else {
        singleExhibitorElementHTML =  `
            <p class="exhibitors__container-list-text-name">${item[1].Nazwa_wystawcy}</p>`;
    }

    singleExhibitor.innerHTML = singleExhibitorElementHTML;

    singleExhibitor.classList.add('exhibitors__container-list');

    divContainerExhibitors.appendChild(singleExhibitor);
});

divContainerHeader.appendChild(inputSearch);
divContainer.appendChild(divContainerHeader);
divContainer.appendChild(divContainerExhibitors);
catRoot.appendChild(divContainer);

const allExhibitorsArray = document.getElementsByClassName('exhibitors__container-list');
inputSearch.addEventListener("input", () => {
    for (let i = 0; i < allExhibitorsArray.length; i++) {
        const exhibitorsNames = allExhibitorsArray[i].getElementsByTagName('p')[0].innerText.toLocaleLowerCase();
        let isVisible = exhibitorsNames.includes(inputSearch.value.toLocaleLowerCase());
        allExhibitorsArray[i].classList.toggle("hide-post", !isVisible);
        allExhibitorsArray[i].classList.toggle("show-post", isVisible);
    }
});

const modalParent = document.createElement('div');
modalParent.classList.add('modal');
modalParent.setAttribute('id', 'my-modal');

for (let i = 0; i < allExhibitorsArray.length; i++) {
    allExhibitorsArray[i].addEventListener('click', () => {
        const url = exhibitors[i][1].URL_logo_wystawcy;
        url.replace('/', '$2F');
        if (details == 'true') { var modalBox = `
            <div class="modal__elements">
                <div class="modal__elements-img" style="background-image: url(${url});"></div>
                <div class="modal__elements-text">
                    <h3>${exhibitors[i][1].Nazwa_wystawcy}</h3>
                    <p>Numer telefonu: <b><a href="phone:+48${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>
                    <p>Adres email: <b><a href="mailto:${exhibitors[i][1].Email} ">${exhibitors[i][1].Email}</a></b></p>
                    <p>Strona www: <b><a href="${exhibitors[i][1].www}" target="_blank" rel="noopener noreferrer" >${exhibitors[i][1].www}</a></b></p>
                    <p>Opis PL: <b><a href="${exhibitors[i][1].Opis_pl}" target="_blank" rel="noopener noreferrer" >${exhibitors[i][1].Opis_pl}</a></b></p>
                    <p>Opis EN: <b><a href="${exhibitors[i][1].Opis_en}" target="_blank" rel="noopener noreferrer" >${exhibitors[i][1].Opis_en}</a></b></p>
                    <button class="close">Zamknij</button>
                </div>
            </div>`; }
            else { var modalBox = `
            <div class="modal__elements">
                <div class="modal__elements-img" style="background-image: url(${url});"></div>
                <div class="modal__elements-text">
                    <h3>${exhibitors[i][1].Nazwa_wystawcy}</h3>
                    <p>Numer telefonu: <b><a href="phone:+48${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>
                    <p>Adres email: <b><a href="mailto:${exhibitors[i][1].Email} ">${exhibitors[i][1].Email}</a></b></p>
                    <p>Strona www: <b><a href="${exhibitors[i][1].www}" target="_blank" rel="noopener noreferrer" >${exhibitors[i][1].www}</a></b></p>
                    <button class="close">Zamknij</button>
                </div>
            </div>`; }

        modalParent.innerHTML = modalBox;
        catRoot.appendChild(modalParent);
        modalParent.style.display = "flex";

        const closeBtn = modalParent.querySelector(".close");

        closeBtn.addEventListener("click", function() {
            modalParent.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modalParent) {
                modalParent.style.display = "none";
            }
        });
    });
}
