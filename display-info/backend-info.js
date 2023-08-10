jQuery(document).ready(function($) {
    $(document).on('click', '.vc_ui-tabs-line-trigger', function() {
        if(this.innerText === "Pop-UP"){
            let targetElement = '';
            let opisy = [];
            let eventSpeakers = $('.event_speaker')[0].value.split(',').map(item => item.trim());
            
            if ((document.querySelector('.event_modal')) && (document.querySelector('.event_modal').value != '')) {
                wrongJson = document.querySelector('.event_modal').value
                if (wrongJson.includes(`]}`)){
                    wrongJson = wrongJson.slice(0,-4);
                    wrongJson += `"}]`;
                }
                archiwOpisy = JSON.parse(wrongJson);
            }

            $('.wpb_element_label_inner').each(function() {
                if ($(this).text().includes('Modal')) {
                    targetElement = this.parentNode.parentNode;
                }
            });

            if($('#eventSpeakers')){
                $('#eventSpeakers').remove();
            }

            let element = '';       
                element = document.createElement('div');
                element.id = "eventSpeakers";
                targetElement.appendChild(element);

            for(i = 0; i<eventSpeakers.length; i++){

                const container = document.createElement('div');
                const input = document.createElement('textarea');
                const header = document.createElement('p');

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
                header.innerText = eventSpeakers[i];
                
                const opisResoult = {
                    id: eventSpeakers[i],
                    desc: input.value
                };

                opisy.push(opisResoult);
                
                input.addEventListener('input', function(event) {
                    opisResoult.desc = event.target.value;
                    document.querySelector('.event_modal').value = JSON.stringify(opisy);
                });

                element.appendChild(container);
                container.appendChild(header);
                container.appendChild(input);
            }
        }
    });    
});