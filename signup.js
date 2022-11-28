// password Visiability

const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });


// password visibilty

//form validation
function validate() {

    var name = document.forms.signup_form.name.value;
    var email = document.forms.signup_form.mail.value;
    var pass = document.forms.signup_form.password.value;

    
    
}