if(document.querySelector(".row-container").querySelector("#identifiers")){
    document.querySelector(".row-container").style.background = "#353535";
  }

  document.addEventListener("DOMContentLoaded", function() {
    const changeForm = document.getElementById("change-form");
    const modal = document.getElementById("custom-modal");
    const modalSubmitButton = document.getElementById("modal-submit-button");
    
    modalSubmitButton.addEventListener("click", function(event) {
      event.preventDefault();
      if (validateForm()) {
        modal.style.display = "block";
      }
    });

    changeForm.addEventListener("click", function() {
      event.preventDefault();
      modal.style.display = "none";
    });

    function validateForm() {
      const customForm = document.querySelector("#custom-form")
      const inputField = document.getElementById("full_name");
      const errorMessage = document.createElement("p");

      errorMessage.classList.add("errorMessage");
      errorMessage.innerText = "Entry error";

      const allErrors = document.querySelectorAll(".errorMessage");
      for (i=0; i<allErrors.length; i++){
        allErrors[i].remove();
      }

      const allFields = customForm.querySelectorAll("input");

      let returner = true;
      for (i=0; i<allFields.length; i++){
        if (allFields[i].value.trim() === "") {
          const errorMessageClone = errorMessage.cloneNode(true);
          allFields[i].insertAdjacentElement("afterend", errorMessageClone);
          returner = false;
        } else if (i<6){ 
            const newId = "#"+allFields[i].id+"_check";
            customForm.querySelector(newId).innerText = allFields[i].value
        } else if (i==6){ 
          customForm.querySelector("#panstwo_check").innerText = customForm.querySelector("#panstwo").value
        }
      }
      return returner;
    }
  });