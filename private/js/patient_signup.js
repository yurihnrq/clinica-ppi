function getAddress(cep) {
    if(cep.length != 9) {
        return ;
    }
    
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "ajax_addresses.php?cep="+cep);
    xhr.responseType = "json";

    xhr.onload = function() {
        const form = document.querySelector("form");
        if (xhr.status != 200) {
            console.error("Falha inesperada: " + xhr.responseText);
            return ;
        }
        if (xhr.response === null) {
            console.error("Resposta não obtida");
            form.address.value = "";
            form.city.value = "";
            form.state.value = "";
            return ;
        }
        const addressData = xhr.response;
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

    const form = document.querySelector('form');

    form.addEventListener("submit", e => {
        e.preventDefault();

        const data = new FormData(form);
        const xhr = new XMLHttpRequest();

        xhr.open("POST", "./sql/save_patient.php")
        xhr.onload = _ => {
            if(xhr.responseText !== "success") {
                document.getElementById("registerFail").style.display = "block";
                document.getElementById("registerSuccess").style.display = "none";
                console.error("Não foi possível cadastrar o paciente.\n" + xhr.responseText);
            }
            else {
                document.getElementById("registerFail").style.display = "none";
                document.getElementById("registerSuccess").style.display = "block";
                console.info("Paciente salvo com sucesso!");

                form.reset();
            }
        }

        xhr.send(data);
    });
}
