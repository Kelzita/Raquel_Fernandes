<?php

session_start();
require_once 'conexao.php';
require_once 'menu.php';

//Verifica se o usuário tem permissão
// Supondo que o Perfil 1 seja o administrador

if ($_SESSION['perfil'] != 1) {
    echo "<script>alert('Acesso negado!'); window.location.href='index.php';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $id_perfil = $_POST['id_perfil'];

    $sql = "INSERT INTO usuario (nome,email,senha,id_perfil) VALUES (:nome, :email, :senha, :id_perfil)"; // ":" Utilizado para evitar SQL INJECTION!
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id_perfil', $id_perfil);


    if ($stmt->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar usuário!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="styles.css" />
</head>


<body>
    <h2>Cadastrar Usuário</h2>
    <form action="cadastro_usuario.php" method="POST">
        <label for="nome">Nome: </label>
        <input type="text" id="nome" name="nome" placeholder="Insira um nome válido"  />

        <label for="email">Email: </label>
        <input type="email" id="email" name="email" placeholder="Insira um email válido"  />

        <label for="senha">Senha: </label>
        <input type="password" id="senha" name="senha"placeholder="Insira uma senha válida"  />

        <label for="id_perfil">Perfil: </label>
        <select id="id_perfil" name="id_perfil" >
            <option value="1">Administrador</option>
            <option value="2">Secretária</option>
            <option value="3">Almoxarifado</option>
            <option value="4">Cliente</option>
        </select>
        <button type="submit">Salvar</button>
        <button type="reset">Cancelar</button>
    </form>
    <a href="principal.php">Voltar</a>
    <address>
        <br><br><br><br>
        Raquel Fernandes / Estudante / raquel_f_brito@estudante.sesisenai.org.br
    </address>

    <script src="validacao.js"></script>
</body>

</html>