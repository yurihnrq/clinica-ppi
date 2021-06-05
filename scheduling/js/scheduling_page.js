function addSpecialties() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "./php/get_specialties.php");
    xhr.responseType = "json";

    xhr.onload = () => {
        if (xhr.status !== 200) {
            console.error("Falha inesperada: " + xhr.responseText);
            return;
        }
        if (xhr.response === null) {
            console.error("Resposta não obtida");
            return;
        }
        const specialties = xhr.response;
        const form = document.querySelector("form");

        while (form.specialty.length != 1)
            form.specialty.removeChild(form.specialty.lastChild);

        specialties.forEach(element => {
            let specialty = document.createElement("option");
            specialty.value = element;
            specialty.innerHTML = element;
            form.specialty.appendChild(specialty);
        });
    }
    xhr.send();
}

function addDoctors(specialty) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "./php/get_doctors.php?especialidade=" + specialty);
    xhr.responseType = "json";

    xhr.onload = () => {
        if (xhr.status !== 200) {
            console.error("Falha inesperada: " + xhr.responseText)
            return;
        }
        if (xhr.response === null) {
            console.error("Resposta não obtida");
            return;
        }
        const doctors = xhr.response;
        const form = document.querySelector("form");

        while (form.doctor.length !== 1)
            form.doctor.removeChild(form.doctor.lastChild);

        doctors.forEach(element => {
            let doctor = document.createElement("option");
            doctor.innerHTML = element.nome;
            doctor.value = element.crm;
            form.doctor.appendChild(doctor);
        });
    }

    xhr.send();
}

function addHours(date, crm) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "./php/get_hours.php?data=" + date + "&crm=" + crm);
    xhr.responseType = "json";

    xhr.onload = () => {
        if (xhr.status !== 200) {
            console.error("Falha inesperada: " + xhr.responseText);
            return;
        }
        if (xhr.response === null) {
            console.error("Resposta não obtida");
            return;
        }

        const
            busyHours = xhr.response;
        const form = document.querySelector("form");

        while (form.hour.length !== 1)
            form.hour.removeChild(form.hour.lastChild);

        const possibleHours = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17];

        busyHours.forEach(element => {
            let idx = possibleHours.indexOf(element);
            if (idx !== -1)
                possibleHours.splice(idx, 1);
        })

        possibleHours.forEach(element => {
            let hour = document.createElement("option");
            hour.value = element;
            hour.innerHTML = element + "h00";
            form.hour.appendChild(hour);
        });
    }
    xhr.send();
}

window.onload = _ => {

    //Login
    const loginBtn = document.getElementById("btn-login");

    loginBtn.addEventListener("click", _ => {
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");

        const data = new FormData();
        data.append("email", emailInput.value);
        data.append("password", passwordInput.value);

        let xhr = new XMLHttpRequest();

        xhr.open("POST", "../private/php/login.php");

        xhr.onload = _ => {
            if (xhr.responseText === "success")
                window.location = "../private/index.php";
            else {
                console.log(xhr.responseText);
                document.getElementById("loginFail").style.display = "block";
                passwordInput.value = "";
                passwordInput.focus();
            }
        }

        xhr.send(data);
    })


    //Habilitar campos gradativamente
    const schedForm = document.querySelector('main form');

    schedForm.addEventListener("submit", e => {
        e.preventDefault();

        console.log("heey");
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "./php/schedule.php");

        const data = new FormData(schedForm);

        xhr.onload = _ => {
            if (xhr.responseText !== "success") {
                document.getElementById("scheduleFail").style.display = "block";
                document.getElementById("scheduleSuccess").style.display = "none";
                console.error("Não foi possível realizar o agendamento.\n" + xhr.responseText);
            }
            else {
                document.getElementById("scheduleFail").style.display = "none";
                document.getElementById("scheduleSuccess").style.display = "block";
                console.info("Agendamento realizado com sucesso!");

                schedForm.reset();
                schedForm.specialty.disabled = true;
                schedForm.specialty.value = "";

                schedForm.doctor.disabled = true;
                schedForm.doctor.value = "";

                schedForm.date.disabled = true;
                schedForm.date.value = "";

                schedForm.hour.disabled = true;
                schedForm.hour.value = "";
            }
        }
        xhr.send(data);
    })

    addSpecialties();

    schedForm.specialty.addEventListener("change", e => {
        console.log(e.target);
        addDoctors(document.getElementById("specialty").value);
    });

    schedForm.date.addEventListener("change", e => {
        addHours(document.getElementById("date").value, document.getElementById("doctor").value);
    });

    schedForm.addEventListener("input", _ => {
        if (schedForm.name.value.length >= 1 && schedForm.email.value.length >= 1 && schedForm.sex.value !== "")
            schedForm.specialty.disabled = false;
        else {
            schedForm.specialty.disabled = true;
            schedForm.specialty.value = "";
        }

        if (schedForm.specialty.value !== "")
            schedForm.doctor.disabled = false;
        else {
            schedForm.doctor.disabled = true;
            schedForm.doctor.value = "";
        }

        if (schedForm.doctor.value !== "")
            schedForm.date.disabled = false;
        else {
            schedForm.date.disabled = true;
            schedForm.date.value = "";
        }

        if (schedForm.date.value !== "")
            schedForm.hour.disabled = false;
        else {
            schedForm.hour.disabled = true;
            schedForm.hour.value = "";
        }
    });

    document.querySelector("#btn-reset").addEventListener("click", e => {
        e.preventDefault();

        schedForm.reset();
        schedForm.specialty.disabled = true;
        schedForm.specialty.value = "";

        schedForm.doctor.disabled = true;
        schedForm.doctor.value = "";

        schedForm.date.disabled = true;
        schedForm.date.value = "";

        schedForm.hour.disabled = true;
        schedForm.hour.value = "";
    });


};
