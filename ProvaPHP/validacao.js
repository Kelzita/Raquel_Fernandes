let nome = document.getElementById("nome");
let email = document.getElementById("email");
let senha = document.getElementById("senha");
let id_perfil = document.getElementById("id_perfil");

function ValidacaodoFormulario(event) {
    event.preventDefault(); // Impede envio até a validação passar


    // ======= Campos não podem estar vazios =======
    if (nome.value.trim() === "") {
        alert("O campo nome deve ser preenchido!");
        nome.focus();
        return false;
    }

    if (email.value.trim() === "") {
        alert("O campo email deve ser preenchido!");
        email.focus();
        return false;
    }

    if (senha.value.trim() === "") {
        alert("O campo senha deve ser preenchido!");
        senha.focus();
        return false;
    }

    if (id_perfil.value === "") {
        alert("Selecione um perfil!");
        id_perfil.focus();
        return false;
    }
    // ================================================

    if (nome.value.length < 3) {
        alert("O nome deve ter pelo menos 3 caracteres!");
        return false;
    }

    if (/[^a-zA-Z\s]/.test(nome.value)) {
        alert("O nome não pode conter números nem caracteres especiais!");
        return false;
    }


    // Validação do e-mail
    if (email.value.indexOf("@") === -1) {
        alert("Digite um e-mail válido!");
        return false;
    }

    // Validação da senha
    if (senha.value.length < 8) {
        alert("A senha deve ter pelo menos 8 caracteres!");
        return false;
    }

    // Validação do perfil
    if (id_perfil.value === "") {
        alert("Selecione um perfil!");
        return false;
    }

    // Se passou em todas as validações, envia o formulário
    event.target.submit();
}

document.querySelector("form").addEventListener("submit", ValidacaodoFormulario);
