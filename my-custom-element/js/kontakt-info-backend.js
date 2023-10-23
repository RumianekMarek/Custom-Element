jQuery(document).ready(function($) {
    $(document).on('click', '.vc_ui-tabs-line-trigger', function() {
        if(this.innerText === "Contacts"){
            let targetElement = '';
            let opisy = [];
            let contactsNumber = $('.contact_number')[0].value;
            console.log(contactsNumber);
            
            //Zmiana obiektu z wordpress na tablice JS
            if ((document.querySelector('.event_object')) && (document.querySelector('.event_object').value != '')) {
                wrongJson = document.querySelector('.event_object').value
                if (wrongJson.includes(`]}`)){
                    wrongJson = wrongJson.slice(0,-4);
                    wrongJson += `"}]`;
                }
                archiwOpisy = JSON.parse(wrongJson);
            }


            $('.wpb_element_label_inner').each(function() {
                if ($(this).text().includes('All contacts')) {
                    targetElement = this.parentNode.parentNode;
                }
            });

            if($('#eventSpeakers')){
                $('#eventSpeakers').remove();
            }

            let element = '';       
                element = document.createElement('div');
                element.id = "all-contacts";
                targetElement.appendChild(element);

            for(i = 0; i<contactsNumber; i++){
                console.log(i);
                const container = document.createElement('div');
                    container.classList.add('contact-container');

                const textContainer = document.createElement('div');
                    textContainer.classList.add('contact-text-container');
                
                const head = document.createElement('p');

                const photoContainer = document.createElement('div');
                photoContainer.classList.add('photo-container');
                const photo = document.createElement('img');
                    photo.style.width = photo.style.height = '100px';
                const photoLabel = document.createElement('label');
                    photoLabel.innerText = "Zdjęcie";

                const imieContainer = document.createElement('div');  
                const imie = document.createElement('input');
                const imieLabel = document.createElement('label');
                    imieLabel.innerText = ("Imię i nazwisko");

                const telefonContainer = document.createElement('div');  
                const telefon = document.createElement('input');
                const telefonLabel = document.createElement('label');
                    telefonLabel.innerText = ("Telefon");

                const emailContainer = document.createElement('div');  
                const email = document.createElement('input');
                const emailLabel = document.createElement('label');
                    emailLabel.innerText = ("Email");

                if (typeof archiwOpisy != 'undefined'){
                    for (let j = 0; j < archiwOpisy.length; j++) {
                        if(archiwOpisy[j].id.toLowerCase() == eventSpeakers[i]){
                            if (archiwOpisy[j].desc != '') {
                                input.value = archiwOpisy[j].desc;
                                break;
                            }   
                        }
                    }
                }

                container.id = "event-speaker"+i;
                if (i === 0){
                    head.innerText = "Kierownik projektu";
                } else {
                    head.innerText = "Kontakt";
                }
                
                // console.log(opisResoult);

                // opisy.push(opisResoult);
                
                // input.addEventListener('input', function(event) {
                //     opisResoult.desc = event.target.value;
                //     document.querySelector('.event_object').value = JSON.stringify(opisy);
                // });

                element.appendChild(container);

                container.appendChild(head);
                
                container.appendChild(photoContainer);
                photoContainer.appendChild(photoLabel);
                photoContainer.appendChild(photo);

                container.appendChild(textContainer);
                
                textContainer.appendChild(imieContainer);
                imieContainer.appendChild(imieLabel);
                imieContainer.appendChild(imie);

                textContainer.appendChild(telefonContainer);
                telefonContainer.appendChild(telefonLabel);
                telefonContainer.appendChild(telefon);
                
                textContainer.appendChild(emailContainer);
                emailContainer.appendChild(emailLabel);
                emailContainer.appendChild(email);
            }
        }
    });    
});