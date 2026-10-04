
console.log("app.js loaded");


function openModal(id) {

    const modal = document.getElementById(id);

    if (!modal) {
        console.error("Modal not found:", id);
        return;
    }

    modal.classList.add("active");

    document.body.style.overflow = "hidden";
}


function closeModal(id) {

    const modal = document.getElementById(id);

    if (!modal) {
        return;
    }

    modal.classList.remove("active");

    document.body.style.overflow = "";

    resetForm(id);
}


function resetForm(modalId) {

    const modal = document.getElementById(modalId);

    if (!modal) {
        return;
    }


    // Reset form
    const form = modal.querySelector("form");

    if (form) {
        form.reset();
    }


    // Reset password fields
    const passwordInputs =
        modal.querySelectorAll(
            'input[name="password"]'
        );

    passwordInputs.forEach(function (input) {

        input.type = "password";

    });


    // Reset password icons
    const icons =
        modal.querySelectorAll(
            ".toggle-password"
        );

    icons.forEach(function (icon) {

        icon.textContent = "👁️";

    });


    // Hide error message
    const errorMsg =
        modal.querySelector(".error-msg");

    if (errorMsg) {

        errorMsg.style.display = "none";

    }
}


function togglePassword(
    inputId,
    iconElement
) {

    const password =
        document.getElementById(inputId);

    if (!password) {
        return;
    }


    if (password.type === "password") {

        password.type = "text";

        iconElement.textContent = "🙈";

    } else {

        password.type = "password";

        iconElement.textContent = "👁️";

    }
}


// Close modal when clicking the overlay
document.addEventListener(
    "click",
    function (event) {

        if (
            event.target.classList.contains(
                "modal-overlay"
            )
        ) {

            closeModal(event.target.id);

        }

    }
);


// Close modal with Escape
document.addEventListener(
    "keydown",
    function (event) {

        if (event.key === "Escape") {

            document
                .querySelectorAll(
                    ".modal-overlay.active"
                )
                .forEach(function (modal) {

                    closeModal(modal.id);

                });

        }

    }
);

