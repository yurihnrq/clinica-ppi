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
}
