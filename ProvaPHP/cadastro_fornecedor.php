<?php 
session_start();
require_once 'conexao.php';
require_once 'menu.php'; 

//Verifica se o usuário tem permissão, considerando que o perfil logado seja de um administrador ou almoxarife

if ($_SESSION['perfil'] != 1 && $_SESSION['perfil'] != 3) {
    echo "<script>alert('Acesso negado!'); window.location.href='principal.php';</script>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_fornecedor = $_POST['nome_fornecedor'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $contato = $_POST['contato'];

    $sql = "INSERT INTO fornecedor (nome_fornecedor, endereco, telefone, email, contato) VALUES (:nome_fornecedor, :endereco, :telefone, :email, :contato)"; 
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam (':nome_fornecedor', $nome_fornecedor);
    $stmt->bindParam (':endereco', $endereco);
    $stmt->bindParam (':telefone', $telefone);
    $stmt->bindParam (':email', $email);
    $stmt->bindParam (':contato', $contato);
    

    if($stmt->execute()) {
        echo "<script>alert('Fornecedor cadastrado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar o Fornecedor!');</script>"; 
    }
}?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Fornecedor</title>
    <link rel="stylesheet" href="styles.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#telefone').mask('(00) 00000-0000');
    });
    </script>
</head>
<body>
    <h2>Cadastrar Fornecedor</h2>
    <form action="cadastro_fornecedor.php" method="POST">
        <label for="nome_fornecedor" >Nome do Fornecedor</label>
        <input type="text" id="nome_fornecedor" name="nome_fornecedor" placeholder="Insira o nome do fornecedor"/>

        <label for="endereco" >Endereço:</label>
        <input type="text" id="endereco" name="endereco" placeholder="Insira o Endereço do fornecedor"/>

        <label for="telefone" >Telefone:</label>
        <input type="text" id="telefone" name="telefone" placeholder="Insira o Telefone do fornecedor" maxlength="20"/>

        <label for="email" >E-mail:</label>
        <input type="email" id="email" name="email" placeholder="Insira o E-mail do fornecedor"/>

        <label for="contato" >Contato:</label>
        <input type="text" id="contato" name="contato" placeholder="Insira o Contato do fornecedor"/>

        <button type="submit">Salvar</button>
        <button type="reset">Cancelar</button>
    </form>
    <a class="voltar" href="principal.php">Voltar</a>
    <address>
        <br><br><br><br>
        Raquel Fernandes / Estudante / raquel_f_brito@estudante.sesisenai.org.br
    </address>

    <script src="validacao.js"></script>
</body>
</html>

