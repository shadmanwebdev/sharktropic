document.addEventListener("DOMContentLoaded", function () {
    const inputFields = document.querySelectorAll(".input-field");

    inputFields.forEach((inputField) => {
        const customInput = inputField.parentElement;
        
        inputField.addEventListener("focus", function () {
            customInput.classList.add("focus");
        });

        inputField.addEventListener("blur", function () {
            if (inputField.value === "") {
                customInput.classList.remove("focus");
            }
        });
    });
});