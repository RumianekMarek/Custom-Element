jQuery(document).ready(function($) {
    $(document).ready(function() {
        $('.vc_ui-tabs-line-trigger').each(function() {
            console.log(this);
            if ($(this).text() === 'Hidden') {
                $(this).css('visibility', 'hidden');
            }
        });
    });

    var wyniki = [];
    $(document).on('click', '.vc_ui-tabs-line-trigger', function() {
        if(this.innerText === "Pliki"){
            if ((document.querySelector('.logo_url')) && (document.querySelector('.logo_url').value != '')) {
                wrongJson = document.querySelector('.logo_url').value
                if (wrongJson.includes(`]}`)){
                    wrongJson = wrongJson.slice(0,-4);
                    wrongJson += `"}]`;
                }
                archiwWyniki = JSON.parse(wrongJson);
            }
            
            wyniki.splice(0, wyniki.length);
            const catalog = $(".logoscatalog").val();
            let targetElement = $('.wpb_element_label_inner').filter(function() {
                return $(this).text() === "Pliki";
            });

            if($('#pliki-container')){
                $('#pliki-container').remove();
            }

            const mainDiv = document.createElement('div');
            mainDiv.id = "pliki-container";
            mainDiv.style = ("min-width:600px;")
            targetElement.after(mainDiv);

            for (i=0; i<inner.file_list.length; i++){     
                if (inner.file_list[i].includes("/"+catalog+"/")) {
                    const targetLogo = inner.file_list[i].substring(catalog.length + 2)

                    const container = document.createElement('div');
                    const element = document.createElement('p');
                    const textForm = document.createElement('input');

                    container.id = inner.file_list[i];
                    
                    if (typeof archiwWyniki != 'undefined'){
                        for (let j = 0; j < archiwWyniki.length; j++) {
                            if(archiwWyniki[j].id.toLowerCase() == targetLogo){
                                console.log('true');
                                if (archiwWyniki[j].url != '') {
                                    textForm.value = archiwWyniki[j].url;
                                    break;
                                }   
                            }
                        }
                    }

                    element.innerText = targetLogo;
                    textForm.placeholder = "insert company web page link"
                    container.style = ("display:flex; margin:5px");
                    element.style = ("min-width:300px");

                    mainDiv.append(container);
                    container.append(element);
                    container.append(textForm);

                    const resultObject = {
                        id: element.innerText,
                        url: textForm.value
                        };
                    wyniki.push(resultObject);

                    textForm.addEventListener('input', function(event) {
                        resultObject.url = event.target.value;
                        document.querySelector('.logo_url').value = JSON.stringify(wyniki);
                      });
                }
            }
        }
    });
});
