<?php
session_start();
require_once 'conexao.php';

//Verifica se o usuário tem permissão de adm
if($_SESSION['perfil'] != 1) {
    echo "<script>alert('Acesso negado!'); window.location.href='principal.php'</script>";
    exit();
}

// Inicializa variáveis 
$usuario = null;

if ($_SERVER["REQUEST_METHOD"] =="POST"){
    if(!empty($_POST['busca_usuario'])) {
        $busca = trim($_POST['busca_usuario']);

        //Verifica se a busca é um número (Id) ou um nome.
        if(is_numeric($busca)) {
            $sql = "SELECT * FROM usuario WHERE id_usuario = :busca";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':busca', $busca, PDO::PARAM_INT);

        } else {
            $sql = "SELECT * FROM usuario WHERE nome LIKE :busca_nome";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':busca_nome', '%$busca%', PDO::PARAM_STR);
        }
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        //Se o usuário não for encontrado, exibe um alerta

        if(!$usuario) {
            echo "<script>alert('Usuário não encontrado!');</script>";
        }
    }

}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Usuário</title>
    <link rel="stylesheet" href="styles.css"/>
    <!--Certifique-se de que o java script está sendo carregado corretamente-->
    <script src="scripts.js"></script>
</head>
<body>
    <h2>Alterar Usuário</h2>
    
    <form action="alterar_usuario" method="POST">
        <label for="busca_usuario">Digite o ID ou nome do Usuário:<label>
        <input type="text" id="busca_usuario" name="busca_usuario" required onkeyup="buscarSugestoes()">

    
    <div id="sugestoes"></div>
    <button type="submit">Buscar</button>
    </form>
    <?php if($usuario) : ?>
        <!--Formulário para alterar usuário-->
    <form action="processa_alteracao_usuario.php" method="GET">
        <input type="hidden" name="id_usuario" value="<?=htmlspecialchars($usuario['id_usuario']);?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?=htmlspecialchars($usuario['nome']);?>"required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?=htmlspecialchars($usuario['email']);?>"required>

        <label for="id_perfil">Perfil:</label>
        <select id="id_perfil" name="id_perfil">
            <option value="1" <?=$usuario['id_perfil'] == ?'select':''?>>Administrador</option>
            <option value="2" <?=$usuario['id_perfil'] == ?'select':''?>>Secretária</option>
            <option value="3" <?=$usuario['id_perfil'] == ?'select':''?>>Almoxarife</option>
            <option value="4" <?=$usuario['id_perfil'] == ?'select':''?>>Cliente</option>
        </select>
    </form>

    
    
</body>
</html>