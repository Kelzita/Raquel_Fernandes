function validarFormularioAlteracao(event) {
    event.preventDefault();

    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const novaSenha = document.getElementById("nova_senha") ? document.getElementById("nova_senha").value.trim() : "";
    const id_perfil = document.getElementById("id_perfil").value;

    if(nome.value.trim() == "") {
        alert("O campo nome não pode ser vazio!");
        nome.focus();
        return false;

    }

    if(email.value.trim() == "") {
        alert("O campo email não pode ser vazio!");
        email.focus();
        return false;

    }

    if (id_perfil.value === "") {
        alert("Selecione um perfil!");
        id_perfil.focus();
        return false;
    }
    
    if(nome.value.trim() == "") {
        alert("O campo nome não pode ser vazio!");
        nome.focus();
        return false;

    }
    
    
    // Validação do nome
    if (nome.length < 3) {
        alert("O nome deve ter pelo menos 3 caracteres!");
        return false;
    }

    if (/[^a-zA-ZÀ-ú\s]/.test(nome)) {
        alert("O nome não pode conter números nem caracteres especiais!");
        return false;
    }

    // Validação do e-mail
    if (email.indexOf("@") === -1) {
        alert("Digite um e-mail válido!");
        return false;
    }

    // Validação da senha (somente se for preenchida)
    if (novaSenha && novaSenha.length < 8) {
        alert("A senha deve ter pelo menos 8 caracteres!");
        return false;
    }

    // Validação do perfil
    if (id_perfil === "") {
        alert("Selecione um perfil!");
        return false;
    }

    // Se passar todas validações, envia o formulário
    event.target.submit();
}

document.addEventListener("DOMContentLoaded", () => {
    const formAlteracao = document.querySelector("form[action='processa_alteracao_usuario.php']");
    if (formAlteracao) {
        formAlteracao.addEventListener("submit", validarFormularioAlteracao);
    }
});


//=======Alterar fornecedor======
function validarFormularioFornecedorAlteracao(event) {
    event.preventDefault();
    const nome_fornecedor = document.getElementById("nome_fornecedor").value.trim();
    const email = document.getElementById("email").value.trim();
    const novaSenha = document.getElementById("nova_senha") ? document.getElementById("nova_senha").value.trim() : "";
    const id_perfil = document.getElementById("id_perfil").value;

    if(nome_fornecedor.value.trim() == "") {
        alert("O campo nome não pode ser vazio!");
        nome.focus();
        return false;

    }

    if(endereco.value.trim() == "") {
        alert("O campo endereço não pode ser vazio!");
        nome.focus();
        return false;

    }

    if(telefone.value.trim() == "") {
        alert("O campo telefone não pode ser vazio!");
        email.focus();
        return false;

    }

    if(email.value.trim() == "") {
        alert("O campo email não pode ser vazio!");
        email.focus();
        return false;

    }

    if(contato.value.trim() == "") {
        alert("O campo contato não pode ser vazio!");
        contato.focus();
        return false;

    }
    
    
    // Validação do nome
    if (nome_fornecedor.length < 3) {
        alert("O nome deve ter pelo menos 3 caracteres!");
        return false;
    }

    if (/[^a-zA-ZÀ-ú\s]/.test(nome_fornecedor)) {
        alert("O nome não pode conter números nem caracteres especiais!");
        return false;
    }

    // Validação do e-mail
    if (email.indexOf("@") === -1) {
        alert("Digite um e-mail válido!");
        return false;
    }

    // Se passar todas validações, envia o formulário
    event.target.submit();
}

document.addEventListener("DOMContentLoaded", () => {
    const formAlteracao = document.querySelector("form[action='processa_alteracao_fornecedor.php']");
    if (formAlteracao) {
        formAlteracao.addEventListener("submit", validarFormularioFornecedorAlteracao);
    }
});
