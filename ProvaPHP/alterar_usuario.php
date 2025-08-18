<?php
session_start();
require_once 'conexao.php';
require_once 'menu.php';

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
            $stmt->bindValue(':busca_nome',"%$busca%", PDO::PARAM_STR);
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
    <link rel="stylesheet" href="styles.css">
    <!--Certifique-se de que o java script está sendo carregado corretamente-->
    <script src="scripts.js"></script>
   
</head>
<body>
    <h2>Alterar Usuário</h2>
    <form action="alterar_usuario.php" method="POST">
        <label for="busca_usuario">Digite o ID ou o nome do usuário:</label>
        <input type="text" id="busca_usuario" name="busca_usuario" required onkeyup="buscarSugestoes()">

         <div id="sugestoes"></div>
         <button type="submit">Buscar</button>
    </form>
    <?php if($usuario): ?>
        <!-- Formulario para alterar o usuario -->
        <form action="processa_alteracao_usuario.php" method="POST">
            <input type="hidden" name="id_usuario" value="<?=htmlspecialchars($usuario['id_usuario'])?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Insira um nome válido" value="<?=htmlspecialchars($usuario['nome'])?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Insira um email válido" value="<?=htmlspecialchars($usuario['email']);?>" required>

            <label for="id_perfil">Perfil:</label>
            <select id="id_perfil" name="id_perfil">
                <option value="1" <?=$usuario['id_perfil'] == 1 ? 'select':''?>>Administrador</option>
                <option value="2" <?=$usuario['id_perfil'] == 2 ? 'select':''?>>Secretaria</option>
                <option value="3" <?=$usuario['id_perfil'] == 3 ? 'select':''?>>Almoxarife</option>
                <option value="4" <?=$usuario['id_perfil'] == 4 ? 'select':''?>>Cliente</option>
            </select>

            <!-- Se o usuario logado for Administrador, exibir opção de alterar  a senha -->
            <?php if ($_SESSION['perfil'] == 1): ?>
                <label for="nova_senha">Nova Senha</label>
                <input type="password" id="nova_senha" name="nova_senha" placeholder="Insira uma nova senha válida"> 
            <?php endif; ?>
        
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