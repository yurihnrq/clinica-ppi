function getAddress(cep) {
    if(cep.length != 9) {
        return ;
    }
    
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "ajax_addresses.php?cep="+cep);
    xhr.responseType = "json";

    xhr.onload = function() {
        if (xhr.status != 200) {
            console.error("Falha inesperada: " + xhr.responseText);
            return ;
        }
        if (xhr.response === null) {
            console.error("Resposta não obtida");
            return ;
        }
        const addressData = xhr.response;
        const form = document.querySelector("form");
        form.address.value = addressData.logradouro;
        form.city.value = addressData.cidade;
        form.state.value = addressData.estado;
    }

    xhr.onerror = function() {
        console.log("Erro de rede")
    }

    xhr.send()
}

window.onload = _ => {
    const inputCep = document.querySelector("#cep");
    inputCep.onkeyup = () => getAddress(inputCep.value);

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

        if(doctorCheck.checked === false) {
            xhr.open("POST", "./sql/save_worker.php")
            xhr.onload = _ => {
                if(xhr.responseText !== "success") {
                    document.getElementById("registerFail").style.display = "block";
                    document.getElementById("registerSuccess").style.display = "none";
                    console.error("Não foi possível cadastrar o funcionário.\n" + xhr.responseText);
                }
                else {
                    document.getElementById("registerFail").style.display = "none";
                    document.getElementById("registerSuccess").style.display = "block";
                    console.info("Funcionário salvo com sucesso!");

                    form.reset();
                }
            }
        }
        else {
            xhr.open("POST", "./sql/save_doctor.php")
            xhr.onload = _ => {
                if(xhr.responseText !== "success") {
                    document.getElementById("registerFail").style.display = "block";
                    document.getElementById("registerSuccess").style.display = "none";
                    console.error("Não foi possível cadastrar o funcionário.\n" + xhr.responseText);
                    
                }
                else {
                    document.getElementById("registerFail").style.display = "none";
                    document.getElementById("registerSuccess").style.display = "block";
                    console.info("Funcionário salvo com sucesso!");
                    
                    form.reset();
                }
            }
        }

        xhr.send(data);
    });

}
