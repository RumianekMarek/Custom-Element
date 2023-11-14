jQuery(document).ready(function($) {
    $(document).on('click', '.vc_ui-tabs-line-trigger', function() {
        if(this.innerText === "Contacts"){
            let targetElement = '';
            let opisy = [];
            let contactsNumber = $('.contact_number')[0].value;
            
            //Zmiana obiektu z wordpress na tablice JS
            if ((document.querySelector('.contact_object')) && (document.querySelector('.contact_object').value != '')) {
                wrongJson = document.querySelector('.contact_object').value
                if (wrongJson.includes(`]}`)){
                    wrongJson = wrongJson.slice(0,-4);
                    wrongJson += `"}]`;
                }
                archiwOpisy = JSON.parse(wrongJson);

                archiwOpisy = archiwOpisy.filter(item => {
                    const targetId = item.id.match(/\d+/g);
                    return targetId < contactsNumber;
                });
            }

            $('.wpb_element_label_inner').each(function() {
                if ($(this).text().includes('All contacts')) {
                    targetElement = this.parentNode.parentNode;
                }
            });

            if($('#all-contacts')){
                $('#all-contacts').remove();
            }

            let element = '';       
                element = document.createElement('div');
                element.id = "all-contacts";
                targetElement.appendChild(element);

            for(i = 0; i<contactsNumber; i++){
                const container = document.createElement('div');
                    container.classList.add('contact-container');
                    container.id = "contact"+i;

                const textContainer = document.createElement('div');
                    textContainer.classList.add('contact-text-container');
                
                const head = document.createElement('p');

                const photoContainer = document.createElement('div');
                photoContainer.classList.add('photo-container');
                const photo = document.createElement('img');
                    photo.classList.add('photo'+i);
                    photo.style.width = photo.style.height = '100px';
                const photoLabel = document.createElement('label');
                    photoLabel.innerText = "Zdjęcie";

                const imieContainer = document.createElement('div');  
                const imie = document.createElement('input');
                    imie.classList.add('imie'+i);
                const imieLabel = document.createElement('label');
                    imieLabel.innerText = ("Imię i nazwisko");

                const telefonContainer = document.createElement('div');  
                const telefon = document.createElement('input');
                    telefon.classList.add('telefon'+i);
                const telefonLabel = document.createElement('label');
                    telefonLabel.innerText = ("Telefon");

                const emailContainer = document.createElement('div');  
                const email = document.createElement('input');
                    email.classList.add('email'+i);
                const emailLabel = document.createElement('label');
                    emailLabel.innerText = ("Email");

                if (typeof archiwOpisy != 'undefined'){
                    opisy = archiwOpisy;
                    for (let j = 0; j < archiwOpisy.length; j++) {
                        const targetId = archiwOpisy[j].id.toLowerCase();
                        if(targetId == targetId.slice(0, -1)+i) {
                            if (archiwOpisy[j].desc != '') {
                                switch (targetId.slice(0, -1)){
                                    case 'photo':
                                        photo.src = archiwOpisy[j].value;
                                        break;
                                    case 'imie':
                                        imie.value = archiwOpisy[j].value;
                                        break;
                                    case 'telefon':
                                       telefon.value = archiwOpisy[j].value;
                                        break;
                                    case 'email':
                                        email.value = archiwOpisy[j].value;
                                        break;
                                }
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

                photo.addEventListener('click', function(event) {
                    if (event.target.scr = ""){
                        const elementId = event.target.classList[0];
                        wp.media.editor.open(elementId);
                        wp.media.editor.send.attachment = function(props, attachment) {
                            event.target.setAttribute('src', attachment.url);
                            event.target.setAttribute('value', attachment.url);
                            PutContact(event.target);
                        }
                    } else {
                        event.target.src = "";
                        PutContact(event.target);
                    }
                });


                imie.addEventListener('input', function(event) {
                    PutContact(event.target);
                });
                telefon.addEventListener('input', function(event) {
                    PutContact(event.target);
                });
                email.addEventListener('input', function(event) {
                    PutContact(event.target);
                });

                const PutContact = (targetElement) => {
                    let eValue = '';
                    if (targetElement.src != ''){
                        eValue = targetElement.src;
                    } else {
                        eValue = targetElement.value;
                    };
                    const event_class = targetElement.classList[0];
                    const foundOpis = opisy.find((opis) => opis.id === event_class);
                    if (foundOpis === undefined) {
                        const newOpis = {
                            id: event_class,
                            value: eValue,
                        };
                        opisy.push(newOpis);
                    } else {
                        foundOpis.value = eValue;
                    }
                    document.querySelector('.contact_object').value = JSON.stringify(opisy);
                }

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