
		const exhibitorsAll = Object.entries(katalog_data.data[katalog_data.id_targow]["Wystawcy"]);
		
		let localLangKat = document.getElementById("cat").getAttribute("custom-lang");	
		const exhibitors = exhibitorsAll.reduce((acc, curr) => {
			const name = curr[1].Nazwa_wystawcy;
			const existingEntry = acc.find(item => item[1].Nazwa_wystawcy === name);

			if (!existingEntry) {
				acc.push(curr);
			}

			return acc;
		}, []);

      /* Spiner */
      const spinner = document.getElementsByClassName('spinner')[0];
      spinner.style.display = "none";
	   
    /*Segracja plików elementów ze wzlgędu na nazwę*/
		/*  ----------------------FULL ------------------------    */
		const catRoot = document.getElementById('cat');
		const divContainer = document.createElement('div');
		/* Test dobierania rozmiarów */
		function setBgSize(element, url) {
			const image = new Image();
			image.src = element.style.backgroundImage.replace(/url\(['"]?(.*?)['"]?\)/i, "$1");

			image.onload = function () {
			const containerWidth = element.clientWidth;
			const containerHeight = element.clientHeight;
			const containerRatio = containerWidth / containerHeight;

			const imageWidth = image.width;
			const imageHeight = image.height;
			const imageRatio = imageWidth / imageHeight;

			if (containerRatio > imageRatio) {
				element.style.backgroundSize = "cover";

			} else {
					element.style.backgroundSize = "contain";						
			}
			};
		}

		if (katalog_data.format == 'full') {
			const inputSearch = document.getElementById('search');
				

			const divContainerExhibitors = document.createElement('div');
			divContainerExhibitors.classList.add('exhibitors__container');

			exhibitors.map(item => {
				const singleExhibitor = document.createElement('div');
				let singleExhibitorElementHTML;
				if (item[1].URL_logo_wystawcy) {
					singleExhibitorElementHTML = `	
						<div class="exhibitors__container-list-img" style="background-image: url(${item[1].URL_logo_wystawcy})"></div>
						<h2 class="exhibitors__container-list-text-name">${item[1].Nazwa_wystawcy}</h2>`;
				} else {
					singleExhibitorElementHTML = `
						<h2 class="exhibitors__container-list-text-name">${item[1].Nazwa_wystawcy}</h2>`;
				}

				singleExhibitor.innerHTML = singleExhibitorElementHTML;
				singleExhibitor.classList.add('exhibitors__container-list');
				divContainerExhibitors.appendChild(singleExhibitor);
			});
			const divContainer = document.getElementsByClassName('exhibitors')[0];
			divContainer.appendChild(divContainerExhibitors);
			catRoot.appendChild(divContainer);

			const elements = document.getElementsByClassName("exhibitors__container-list-img");
			for (let i = 0; i < elements.length; i++) {
				setBgSize(elements[i]);
			}
			/*Search Element */
			const allExhibitorsArray = document.getElementsByClassName('exhibitors__container-list');
			inputSearch.addEventListener("input", () => {
				for (let i = 0; i < allExhibitorsArray.length; i++) {
					const exhibitorsNames = allExhibitorsArray[i].getElementsByTagName('h2')[0].innerText.toLocaleLowerCase();
					let isVisible = exhibitorsNames.includes(inputSearch.value.toLocaleLowerCase());
					allExhibitorsArray[i].classList.toggle("hide-post", !isVisible);
					allExhibitorsArray[i].classList.toggle("show-post", isVisible);
				}
			});

			/* MODAL ELEMENT */
			const modalParent = document.createElement('div');
			modalParent.classList.add('modal');
			modalParent.setAttribute('id', 'my-modal');

			for (let i = 0; i < allExhibitorsArray.length; i++) {
				allExhibitorsArray[i].addEventListener('click', () => {
					const url = exhibitors[i][1].URL_logo_wystawcy;
					url.replace('/', '$2F');

					if (katalog_data.details == 'true') {
						if (localLangKat == 'pl_PL') {
							var modalBox = `
								<div class="modal__elements">
									<div class="modal__elements-block">
										${url ? `<div class="modal__elements-img" style="background-image: url(${url});"></div>` : ''}
										<div class="modal__elements-text">
										<h3>${exhibitors[i][1].Nazwa_wystawcy}</h3>
										${exhibitors[i][1].Telefon ? `<p>Numer telefonu: <b><a href="tel:${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>` : ''}
										${exhibitors[i][1].Email ? `<p>Adres email: <b><a href="mailto:${exhibitors[i][1].Email} ">${exhibitors[i][1].Email}</a></b></p>` : ''}
										${exhibitors[i][1].www ? `<p>Strona www: <b><a href="${exhibitors[i][1].www}" target="_blank" rel="noopener noreferrer" >${exhibitors[i][1].www}</a></b></p>` : ''}
										${exhibitors[i][1].Opis_pl && localLangKat=="pl_PL" ?  `<p>${exhibitors[i][1].Opis_pl}</p>` : ''}
										${exhibitors[i][1].Opis_en && localLangKat=="en_US" ? `<p>${exhibitors[i][1].Opis_en}</p>` : ''}
										</div>
									</div>
									<div class="modal_elements-button">
										<button class="close">Zamknij</button
									</div>
								</div>`;
						} else {
							var modalBox = `
								<div class="modal__elements">
									<div class="modal__elements-block">
										${url ? `<div class="modal__elements-img" style="background-image: url(${url});"></div>` : ''}
										<div class="modal__elements-text">
										<h3>${exhibitors[i][1].Nazwa_wystawcy}</h3>
										${exhibitors[i][1].Telefon ? `<p>Phone number: <b><a href="tel:${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>` : ''}
										${exhibitors[i][1].Email ? `<p>E-mail adress: <b><a href="mailto:${exhibitors[i][1].Email} ">${exhibitors[i][1].Email}</a></b></p>` : ''}
										${exhibitors[i][1].www ? `<p>Web page: <b><a href="${exhibitors[i][1].www}" target="_blank" rel="noopener noreferrer" >${exhibitors[i][1].www}</a></b></p>` : ''}
										${exhibitors[i][1].Opis_pl && localLangKat=="pl_PL" ?  `<p>${exhibitors[i][1].Opis_pl}</p>` : ''}
										${exhibitors[i][1].Opis_en && localLangKat=="en_US" ? `<p>${exhibitors[i][1].Opis_en}</p>` : ''}
										</div>
									</div>
									<div class="modal_elements-button">
										<button class="close">Close</button
									</div>
								</div>`;
						}
						
							
					}
					else {
						if (localLangKat == 'pl_PL') {
							var modalBox = `
								${url ? `<div class="modal__elements-img" style="background-image: url(${url});"></div>` : ''}
								<div class="modal__elements-img" style="background-image: url(${url});"></div>
								<div class="modal__elements-text">
								<h3>${exhibitors[i][1].Nazwa_wystawcy}</h3>
								${exhibitors[i][1].Telefon ? `<p>Numer telefonu: <b><a href="tel:${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>` : ''}
									${exhibitors[i][1].Email  ? `<p>Adres email: <b><a href="mailto:${exhibitors[i][1].Email} ">${exhibitors[i][1].Email}</a></b></p>` : ''}
									${exhibitors[i][1].www ? `<p>Strona www: <b><a href="${exhibitors[i][1].www}" target="_blank" rel="noopener noreferrer" >${exhibitors[i][1].www}</a></b></p>` : ''}
								<button class="close">Zamknij</button>
								</div>
							</div>`;
						} else {
							var modalBox = `
								${url ? `<div class="modal__elements-img" style="background-image: url(${url});"></div>` : ''}
								<div class="modal__elements-img" style="background-image: url(${url});"></div>
								<div class="modal__elements-text">
								<h3>${exhibitors[i][1].Nazwa_wystawcy}</h3>
								${exhibitors[i][1].Telefon ? `<p>Phone number: <b><a href="tel:${exhibitors[i][1].Telefon}">${exhibitors[i][1].Telefon}</a></b></p>` : ''}
									${exhibitors[i][1].Email  ? `<p>E-mail adress: <b><a href="mailto:${exhibitors[i][1].Email} ">${exhibitors[i][1].Email}</a></b></p>` : ''}
									${exhibitors[i][1].www ? `<p>Web page: <b><a href="${exhibitors[i][1].www}" target="_blank" rel="noopener noreferrer" >${exhibitors[i][1].www}</a></b></p>` : ''}
								<button class="close">Close</button>
								</div>
							</div>`
						}
						
					}

					modalParent.innerHTML = modalBox;
					catRoot.appendChild(modalParent);
					modalParent.style.display = "flex";

					const closeBtn = modalParent.querySelector(".close");

					closeBtn.addEventListener("click", function () {
						modalParent.style.display = "none";
					});

					window.addEventListener("click", function (event) {
						if (event.target == modalParent) {
							modalParent.style.display = "none";
						}
					});
				});
			};

			/* PL -- En */		
			if (localLangKat == 'pl_PL') {
				var lang = document.querySelectorAll('.pl_PL');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			} else if (localLangKat == 'en_US') {
				var lang = document.querySelectorAll('.en_US');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			} else {
				var lang = document.querySelectorAll('.en_US');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			}
			/*  ----------------------TOP 21 ------------------------    */
		} else if (katalog_data.format == 'top21') {
			
			const imageContainer = document.createElement('div');
			imageContainer.classList.add('img-conatiner');

			let count = 0;
			let displayedCount = 0;

			while (displayedCount < 21 && count < exhibitors.length) {
				if (exhibitors[count][1].URL_logo_wystawcy) {
					const url = exhibitors[count][1].URL_logo_wystawcy;
					url.replace('/', '$2F');

					const singleLogo = document.createElement('div');
					if (url) {
						singleLogo.setAttribute("style", `background-image: url(${url})`);
						
						imageContainer.appendChild(singleLogo);
					}
					displayedCount++;
				}
				count++;
			}
			const divButton = document.createElement('div');
			if (localLangKat == 'pl_PL') {
				divButton.innerHTML= `
            						<span style="display: flex; justify-content: center;" class="btn-container">
                						<a href="/katalog-wystawcow" class="custom-link btn border-width-0 btn-accent btn-square" title="Katalog wystawców">Zobacz więcej</a>
            						</span>`;
			} else {
				divButton.innerHTML= `
            						<span style="display: flex; justify-content: center;" class="btn-container">
                						<a href="/en/exhibitors-catalog/" class="custom-link btn border-width-0 btn-accent btn-square" title="Exhibitor Catalog">See more</a>
            						</span>`;
			}
			catRoot.appendChild(imageContainer);
			catRoot.appendChild(divButton);
			/* PL -- En */		
			if (localLangKat == 'pl_PL') {
				var lang = document.querySelectorAll('.pl_PL');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			} else if (localLangKat == 'en_US') {
				var lang = document.querySelectorAll('.en_US');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			} else {
				var lang = document.querySelectorAll('.en_US');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			}
			/*  ----------------------TOP 10 ------------------------    */
		} else if (katalog_data.format == 'top10') {
			const imageContainer = document.createElement('div');
			imageContainer.classList.add('img-conatiner-top10');

			let count = 0;
			let displayedCount = 0;

			while (displayedCount < 10 && count < exhibitors.length) {
				if (exhibitors[count][1].URL_logo_wystawcy) {
					const url = exhibitors[count][1].URL_logo_wystawcy;
					url.replace('/', '$2F');
					const singleLogo = document.createElement('div');

					if (katalog_data.ticket == 'true') {
						singleLogo.classList.add('tickets');
					}

					if (url) {
						singleLogo.setAttribute("style", `background-image: url(${url})`);
						setBgSize(singleLogo, url)
						imageContainer.appendChild(singleLogo);
					}
					displayedCount++;
				}
				count++;
			}

			catRoot.appendChild(imageContainer);
		}
			/* PL -- En */		
			if (localLangKat == 'pl_PL') {
				var lang = document.querySelectorAll('.pl_PL');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			} else if (localLangKat == 'en_US') {
				var lang = document.querySelectorAll('.en_US');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			} else {
				var lang = document.querySelectorAll('.en_US');
				for (var i = 0; i < lang.length; i++) {
				lang[i].style.display = 'block';
				}
			}