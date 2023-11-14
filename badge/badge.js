document.addEventListener("DOMContentLoaded", function() {
  if(document.querySelector("#identifiers")){
    if(document.querySelector(".row-container").querySelector("#identifiers")){
          document.querySelector(".row-container").style.background = "#353535";
    }

    const changeForm = document.getElementById("change-form");
    const modal = document.getElementById("badge-modal");
    const modalSubmitButton = document.getElementById("modal-submit-button");
    
    modalSubmitButton.addEventListener("click", function(event) {
      event.preventDefault();
      if (validateForm(modal)) {
        modal.style.display = "block";
      }
    });

    changeForm.addEventListener("click", function(event) {
      event.preventDefault();
      modal.style.display = "none";
    });

    function validateForm(modal) {
      const customForm = document.querySelector("#custom-form")
      const errorMessage = document.createElement("p");
      errorMessage.classList.add("errorMessage");
      errorMessage.innerText = "Entry error";

      const allErrors = document.querySelectorAll(".errorMessage");
      for (i=0; i<allErrors.length; i++){
        allErrors[i].remove();
      }

      let allFields = Array.from(customForm.querySelectorAll("input"));
      allFields.push(...Array.from(customForm.querySelectorAll("select")));
      let returner = true;

      for (i=0; i<allFields.length; i++){
        const newId = "#"+allFields[i].id+"_check";
        const modalElem = modal.querySelector(newId);
        if (modalElem != null){
          if (allFields[i].value.trim() === "" && allFields[i].required === true) {
            const errorMessageClone = errorMessage.cloneNode(true);
            allFields[i].insertAdjacentElement("afterend", errorMessageClone);
            returner = false;
          } else if (modalElem && modalElem.id != "email_id_check" && modalElem.id != "paper_id_check"){ 
              modalElem.innerText = allFields[i].value
          } else if(modalElem.id == "email_id_check" || modalElem.id == "paper_id_check"){
            if(allFields[i].checked === true){
              modalElem.innerText = 'wysłać';
            } else {
              modalElem.innerText = 'nie wysłać';
            }
          }
        }
      }
      return returner;
    }
  }
});