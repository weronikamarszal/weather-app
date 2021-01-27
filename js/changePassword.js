let x = document.getElementById("inputPassword");
let y = document.getElementById("inputPassword2");
let err = document.getElementById("passError");

function showPassword() {
    if (x.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

function funcSuccess() {
    err.innerText = "Hasło zostało zmienione";
    err.style.color = "green";
    x.value = "";
    y.value = "";
    return false;
}

function changePassword() {
    if (x.value !== "" || y.value !== "") {
        if (x.value === y.value) {
            $.ajax({
                url: "http://localhost:63342/test2/changePassword.php?_ijt=rd97bab58eo5f7kdbfpjnvp76m",
                type: "POST",
                data: ({password: x.value}),
                dataType: "text",
                //success: funcSuccess
            });
            err.innerText = "Hasło zostało zmienione";
            err.style.color = "green";
            x.value = "";
            y.value = "";
            return false;
        } else {
            err.innerText = "Podane hasła nie są zgodne";
            err.style.color = "red";
            x.value = "";
            y.value = "";
            return false;
        }
    } else {
        err.innerText = "Masz najpierw wpisać hasła";
        err.style.color = "black";
        x.value = "";
        y.value = "";
        return false;
    }
}