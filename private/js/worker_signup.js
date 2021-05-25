window.onload = _ => {

    const doctorCheck = document.querySelector('#doctor');
    const doctorForm = document.querySelector('#doctor-info');

    doctorCheck.addEventListener("input", e => {
        if (e.target.checked)
            doctorForm.style.display = "block";
        else
            doctorForm.style.display = "none";
    });


    const form = document.querySelector('form');

    form.addEventListener("submit", e => {
        e.preventDefault();

        const data = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.responseType = "json";

        xhr.onload = _ => {

        }
    });

}
