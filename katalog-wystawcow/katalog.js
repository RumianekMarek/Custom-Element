if (document.getElementById('#full .exhibitors')){
  document.addEventListener("DOMContentLoaded", function () {
    var exhibitorsAll = Object.entries(katalog_data.data[katalog_data.id_targow]["Wystawcy"]);
    var exhibitors = exhibitorsAll.reduce((acc, curr) => {
        const name = curr[1].Nazwa_wystawcy;
        const existingEntry = acc.find(item => item[1].Nazwa_wystawcy === name);

        if (!existingEntry) {
            acc.push(curr);
        }

        return acc;
    }, []);

    if(katalog_data.data){

      /* SEARCH ELEMENT */
      const inputSearch = document.getElementById('search');
      var allExhibitorsArray = document.getElementsByClassName('exhibitors__container-list');
      inputSearch.addEventListener("input", () => {
        for (let i = 0; i < allExhibitorsArray.length; i++) {
          const exhibitorsNames = allExhibitorsArray[i].getElementsByTagName('h2')[0].innerText.toLocaleLowerCase();
          let isVisible = exhibitorsNames.includes(inputSearch.value.toLocaleLowerCase());
          allExhibitorsArray[i].classList.toggle("hide-post", !isVisible);
          allExhibitorsArray[i].classList.toggle("show-post", isVisible);
        }
      });
      
      var localLangKat = document.getElementById(katalog_data.format).getAttribute("custom-lang");	

      /* MODAL ELEMENT */
      const modal = document.createElement('div');
      modal.classList.add('modal');
      modal.setAttribute('id', 'my-modal');

      for (let i = 0; i < allExhibitorsArray.length; i++) {
        allExhibitorsArray[i].addEventListener('click', () => {
          const url = exhibitors[i][1].URL_logo_wystawcy;
					url.replace('/', '$2F');

          var www = exhibitors[i][1].www;
          
          if (www !== false && www !== "") {
            if (www.indexOf('https://www.') !== -1) {
              www = 'https://' + www.replace(/^https:\/\/www\./i, '');
            } else if (www.indexOf('http://www.') !== -1) {
              www = 'http://' + www.replace(/^http:\/\/www\./i, '');
            } else if (www.indexOf('www.') !== -1) {
              www = 'https://' + www.replace(/^www\./i, '');
            }
          }

          var modalBox = `<div class="modal__elements">
                            <div class="modal__elements-block">
                                ${url ? `<div class="modal__elements-img" style="background-image: url(${url});"></div>` : ''}
                                <div class="modal__elements-text">
                                  <h3>${exhibitors[i][1].Nazwa_wystawcy}</h3>`;

                                  if (katalog_data.details == 'true') {
                                    if (localLangKat == 'pl_PL') {
                                        modalBox += exhibitors[i][1].Telefon ? `<p>Numer telefonu: <b><a href="tel:${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>` : '';
                                        modalBox += exhibitors[i][1].Email ? `<p>Adres email: <b><a href="mailto:${exhibitors[i][1].Email}">${exhibitors[i][1].Email}</a></b></p>` : '';
                                        modalBox += www ? `<p>Strona www: <b><a href="${www}" target="_blank" rel="noopener noreferrer">${www}</a></b></p>` : '';
                                        if (katalog_data.stand !== 'true') {
                                            modalBox += exhibitors[i][1].Numer_stoiska ? `<p>Stoisko: ${exhibitors[i][1].Numer_stoiska}</p>` : '';
                                        }
                                        modalBox += exhibitors[i][1].Opis_pl && localLangKat == "pl_PL" ? `<p>${exhibitors[i][1].Opis_pl}</p>` : '';
                                        modalBox += exhibitors[i][1].Opis_en && localLangKat == "en_US" ? `<p>${exhibitors[i][1].Opis_en}</p>` : '';
                                    } else {
                                        modalBox += exhibitors[i][1].Telefon ? `<p>Phone number: <b><a href="tel:${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>` : '';
                                        modalBox += exhibitors[i][1].Email ? `<p>E-mail adress: <b><a href="mailto:${exhibitors[i][1].Email}">${exhibitors[i][1].Email}</a></b></p>` : '';
                                        modalBox += www ? `<p>Web page: <b><a href="${www}" target="_blank" rel="noopener noreferrer">${www}</a></b></p>` : '';
                                        if (katalog_data.stand !== 'true') {
                                            modalBox += exhibitors[i][1].Numer_stoiska ? `<p>Stand: ${exhibitors[i][1].Numer_stoiska}</p>` : '';
                                        }
                                        modalBox += exhibitors[i][1].Opis_pl && localLangKat == "pl_PL" ? `<p>${exhibitors[i][1].Opis_pl}</p>` : '';
                                        modalBox += exhibitors[i][1].Opis_en && localLangKat == "en_US" ? `<p>${exhibitors[i][1].Opis_en}</p>` : '';
                                    }
                                } else {
                                    if (localLangKat == 'pl_PL') {
                                        modalBox += exhibitors[i][1].Telefon ? `<p>Numer telefonu: <b><a href="tel:${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>` : '';
                                        modalBox += exhibitors[i][1].Email ? `<p>Adres email: <b><a href="mailto:${exhibitors[i][1].Email}">${exhibitors[i][1].Email}</a></b></p>` : '';
                                        modalBox += www ? `<p>Strona www: <b><a href="${www}" target="_blank" rel="noopener noreferrer">${www}</a></b></p>` : '';
                                        if (katalog_data.stand !== 'true') {
                                            modalBox += exhibitors[i][1].Numer_stoiska ? `<p>Stoisko: ${exhibitors[i][1].Numer_stoiska}</p>` : '';
                                        }
                                    } else {
                                        modalBox += exhibitors[i][1].Telefon ? `<p>Phone number: <b><a href="tel:${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>` : '';
                                        modalBox += exhibitors[i][1].Email ? `<p>E-mail adress: <b><a href="mailto:${exhibitors[i][1].Email}">${exhibitors[i][1].Email}</a></b></p>` : '';
                                        modalBox += www ? `<p>Web page: <b><a href="${www}" target="_blank" rel="noopener noreferrer">${www}</a></b></p>` : '';
                                        if (katalog_data.stand !== 'true') {
                                            modalBox += exhibitors[i][1].Numer_stoiska ? `<p>Stand: ${exhibitors[i][1].Numer_stoiska}</p>` : '';
                                        }
                                    }
                                }

          modalBox += `</div></div>
                              <div class="modal_elements-button">`;
          if (localLangKat == 'pl_PL') {
              modalBox += '<button class="close">Zamknij</button>';
          } else {
              modalBox += '<button class="close">Close</button>';
          }
          modalBox += `</div></div>`;

          modal.innerHTML = modalBox;
          document.getElementById(katalog_data.format).appendChild(modal);
          modal.style.display = 'flex';

          const closeBtn = modal.querySelector(".close");

          closeBtn.addEventListener("click", function () {
            modal.style.display = "none";
          });

          window.addEventListener("click", function (event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          });

        });
      };
    };
  });
}