// public/js/app.js

document.addEventListener("DOMContentLoaded", function () {

    // --- LOGIN FORM ------------------------------------------------------
    const loginForm = document.getElementById("loginForm");
    const mensajeResultado = document.getElementById("mensajeResultado");

    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Evitar el envío tradicional

            const formData = new FormData(loginForm);
            const usuario = formData.get("usuario");
            const password = formData.get("password");

            // Validaciones mínimas en front
            if (!usuario || !password) {
                mensajeResultado.textContent = "Debes ingresar usuario y contraseña.";
                mensajeResultado.style.color = "red";
                return;
            }

            // Petición con Axios
            axios.post("../../public/index.php?controller=Login&action=login", formData)
                .then(response => {
                    const data = response.data;
                    if (data.ok) {
                        // Éxito
                        mensajeResultado.style.color = "green";
                        mensajeResultado.textContent = data.msg;

                        // Redirigo si hay una URL
                        if (data.redirectUrl) {
                            window.location.href = data.redirectUrl;
                        }
                    } else {
                        // Error de credenciales
                        mensajeResultado.style.color = "red";
                        mensajeResultado.textContent = data.msg;

                        // Si hay debugOutput, lo muestro en pop-up
                        if (data.debugOutput) {
                            const debugVentana = window.open("", "debugOutput", "width=600,height=400");
                            debugVentana.document.write("<pre>" + data.debugOutput + "</pre>");
                            debugVentana.document.title = "(AXIOS, no Xajax) Debug Output";
                        }
                    }
                })
                .catch(error => {
                    console.error("Error en la petición Axios:", error);
                    mensajeResultado.style.color = "red";
                    mensajeResultado.textContent = "Ha ocurrido un error de conexión.";
                });
        });
    }
});
