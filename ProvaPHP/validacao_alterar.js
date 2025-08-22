function validarFormularioAlteracao(event) {
    event.preventDefault();

    const nome = document.getElementById("nome");
    const email = document.getElementById("email");
    const novaSenha = document.getElementById("nova_senha") ? document.getElementById("nova_senha") : null;
    const id_perfil = document.getElementById("id_perfil");

    // Obtém os valores trimados
    const nomeValue = nome.value.trim();
    const emailValue = email.value.trim();
    const novaSenhaValue = novaSenha ? novaSenha.value.trim() : "";
    const id_perfilValue = id_perfil.value;

    // Validação do nome
    if(nomeValue === "") {
        alert("O campo nome não pode ser vazio!");
        nome.focus();
        return false;
    }

    if (nomeValue.length < 3) {
        alert("O nome deve ter pelo menos 3 caracteres!");
        nome.focus();
        return false;
    }

    if (/[^a-zA-ZÀ-ú\s]/.test(nomeValue)) {
        alert("O nome não pode conter números nem caracteres especiais!");
        nome.focus();
        return false;
    }

    // Validação do e-mail
    if(emailValue === "") {
        alert("O campo email não pode ser vazio!");
        email.focus();
        return false;
    }

    if (emailValue.indexOf("@") === -1) {
        alert("Digite um e-mail válido!");
        email.focus();
        return false;
    }

    // Validação da senha (somente se for preenchida)
    if (novaSenhaValue && novaSenhaValue.length < 8) {
        alert("A senha deve ter pelo menos 8 caracteres!");
        novaSenha.focus();
        return false;
    }

    // Validação do perfil
    if (id_perfilValue === "") {
        alert("Selecione um perfil!");
        id_perfil.focus();
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
   
    const nome_fornecedor = document.getElementById("nome_fornecedor");
    const endereco = document.getElementById("endereco");
    const telefone = document.getElementById("telefone");
    const email = document.getElementById("email");
    const contato = document.getElementById("contato");

    // Obtém os valores trimados
    const nome_fornecedorValue = nome_fornecedor.value.trim();
    const enderecoValue = endereco.value.trim();
    const telefoneValue = telefone.value.trim();
    const emailValue = email.value.trim();
    const contatoValue = contato.value.trim();

    // Validação do nome
    if(nome_fornecedorValue === "") {
        alert("O campo nome não pode ser vazio!");
        nome_fornecedor.focus();
        return false;
    }

    if (nome_fornecedorValue.length < 3) {
        alert("O nome deve ter pelo menos 3 caracteres!");
        nome_fornecedor.focus();
        return false;
    }

    if (/[^a-zA-ZÀ-ú\s]/.test(nome_fornecedorValue)) {
        alert("O nome não pode conter números nem caracteres especiais!");
        nome_fornecedor.focus();
        return false;
    }

    // Validação do endereço
    if(enderecoValue === "") {
        alert("O campo endereço não pode ser vazio!");
        endereco.focus();
        return false;
    }

    // Validação do telefone
    if(telefoneValue === "") {
        alert("O campo telefone não pode ser vazio!");
        telefone.focus();
        return false;
    }

    // Validação do email
    if(emailValue === "") {
        alert("O campo email não pode ser vazio!");
        email.focus();
        return false;
    }

    if (emailValue.indexOf("@") === -1) {
        alert("Digite um e-mail válido!");
        email.focus();
        return false;
    }

    // Validação do contato
    if(contatoValue === "") {
        alert("O campo contato não pode ser vazio!");
        contato.focus();
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




