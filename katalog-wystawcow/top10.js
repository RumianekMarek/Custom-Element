
		const exhibitorsAll = Object.entries(katalog_data.data[katalog_data.id_targow]["Wystawcy"]);

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
				console.log(katalog_data.ticket);
				console.log(katalog_data.format);
			}

			catRoot.appendChild(imageContainer);
