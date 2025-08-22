<?php 
session_start();
require_once 'conexao.php';
require_once 'menu.php';

//Verifica se o usuário é administrador, secretária, ou  almoxarife
if($_SESSION['perfil'] !=1 && $_SESSION['perfil'] != 2 && $_SESSION['perfil'] != 3) {
    echo "<script>alert('Acesso negado!'); window.location.href='principal.php';</script>";
    exit();
}
//Inicializa variáveis
$fornecedor = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['busca_fornecedor'])) {
        $busca = trim($_POST['busca_fornecedor']);

        //Verifica se o é id ou nome
        if(is_numeric($busca)) {
            $sql = "SELECT * FROM fornecedor WHERE id_fornecedor = :busca";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':busca', $busca, PDO::PARAM_INT);
       
        } else {
            $sql = "SELECT * FROM fornecedor WHERE nome_fornecedor LIKE :busca_nome";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':busca_nome', "$busca%", PDO::PARAM_STR);
        }
        $stmt->execute();
        $fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);

        //Se o fornecedor não ser encontrado, exibe um alerta

        if(!$fornecedor) {
            echo "<script>alert('Fornecedor não encontrado!');</script>"; 
        }
    }
}

?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Fornecedor</title>
    <link rel="stylesheet" href="styles.css"/>
    <script src="scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#telefone').mask('(00) 00000-0000');
    });
    </script>
</head>
<body>
    <h2>Alterar Fornecedor</h2>
    <form action="alterar_fornecedor.php" method="POST">
        <label for="busca_fornecedor">Digite o ID ou o Nome do Fornecedor:</label>
        <input type="text" id="busca_fornecedor" name="busca_fornecedor" placeholder= "Insira o ID ou o nome do Fornecedor" required onkeyup="buscarSugestoes()">

        <div id="sugestoes"></div>
        <button type="submit">Buscar</button>
    </form>
    <?php if($fornecedor) : ?>
        <form action="processa_alteracao_fornecedor.php" method="POST">
            <input type="hidden" name="id_fornecedor" value="<?=htmlspecialchars($fornecedor['id_fornecedor'])?>">
            
            <label for="nome_fornecedor">Nome do Fornecedor:</label>
            <input type="text" name="nome_fornecedor" id="nome_fornecedor" placeholder="Insira um nome válido" value="<?=htmlspecialchars($fornecedor['nome_fornecedor'])?>">

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" placeholder="Insira um endereço válido" value="<?=htmlspecialchars($fornecedor['endereco'])?>">

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" placeholder="Insira um telefone válido" value="<?=htmlspecialchars($fornecedor['telefone'])?>">

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Insira um e-mail válido" value="<?=htmlspecialchars($fornecedor['email'])?>">

            <label for="contato">Contato</label>
            <input type="text" name="contato" id="contato" placeholder="Insira um e-mail válido" value="<?=htmlspecialchars($fornecedor['contato'])?>">


            <button type="submit">Alterar</button>
            <button type="reset">Cancelar</button>
     </form>

     <?php endif; ?>

     <a href="principal.php">Voltar</a>
     <address>
    <br><br><br><br>
        Raquel Fernandes / Estudante / raquel_f_brito@estudante.sesisenai.org.br
    </address>
    <script src="validacao_alterar.js"></script>
  
</body>
</html>
























<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    
</body>
</html>