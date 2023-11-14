jQuery(document).ready(function($) {
    $(document).on("click", ".vc_ui-tabs-line-trigger", function(event) {
        if(this.innerText === "Linki"){
            const targetElement =  event.target.attributes[0].value;
            const container = $(targetElement);
            let linki = [];
            const mediaImages = $(".vc_wrapper-param-type-attach_images img");
            if($(".image-link-container")){
                $(".image-link-container").remove();
            }

            if ((document.querySelector(".custom_image_links")) && (document.querySelector(".custom_image_links").value != "")) {
                wrongJson = document.querySelector(".custom_image_links").value
                if (wrongJson.includes(`]}`)){
                    wrongJson = wrongJson.slice(0,-4);
                    wrongJson += `"}]`;
                }
                archiwLinki = JSON.parse(wrongJson);
            }

            for(i=0; i<mediaImages.length; i++){
                imgUrl = $(mediaImages[i]).attr("src");
                imgId = $(mediaImages[i]).attr("rel");
                const inner = $("<div>");
                inner.attr("id", "image-" + imgId);
                inner.attr("class", "image-link-container");
                const imgElement =$("<img>");
                imgElement.attr("src", imgUrl);

                const inputer = $("<input>");
                
                if (typeof archiwLinki != "undefined"){
                    for (let j = 0; j < archiwLinki.length; j++) {
                        if(archiwLinki[j].id.toLowerCase() === inner.attr("id")){
                            if (archiwLinki[j].desc != "") {
                                inputer.attr("value", archiwLinki[j].desc);
                            }   
                        }
                    }
                }
                
                const imageLink = {
                    id: "image-" + imgId,
                    desc: inputer.attr("value")
                };
                linki.push(imageLink);

                $(inputer).on("input", function(event){
                    imageLink.desc = event.target.value;
                    document.querySelector(".custom_image_links").value = JSON.stringify(linki);
                });

                $(container).append(inner);
                $(inner).append(imgElement);
                $(inner).append(inputer);
            }
        }
    });    
});