<?php 
session_start();
require_once 'conexao.php';

//Verifica se o usuário tem permissão de adm
if($_SESSION['perfil'] != 1) {
    echo "<script>alert('Acesso negado!'); window.location.href='principal.php'</script>";
    exit();
}

//Inicializa variável par armazenar usuários
$usuarios = [];

//Buscar todos os usuário cadastrados em ordem alfabética

$sql = "SELECT * FROM usuario ORDER BY nome ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$usuarios = $stmt->fetchALL(PDO::FETCH_ASSOC);

//Se um id foi passado via get exclui o usuário
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Exclui o usuário do Banco de dados
    $sql = "DELETE FROM usuario WHERE id_usuario = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id',$id_usuario, PDO::PARAM_INT);

    if($stmt->execute()) {
        echo "<script>alert('Usuário excluído com sucesso!'); window.location.href='excluir_usuario.php'</script>";
        exit();
    } else {
        echo "<script>alert('Erro ao excluir o usuário');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="tabela.css">
    <title>Excluir usuário</title>
</head>
<body>
    <h2>Excluir Usuário</h2>
    <?php if(!empty($usuarios)) : ?>
        <table  border="1">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?=htmlspecialchars($usuario['id_usuario'])?></td>
                    <td><?=htmlspecialchars($usuario['nome'])?></td>
                    <td><?=htmlspecialchars($usuario['email'])?></td>
                    <td><?=htmlspecialchars($usuario['id_perfil'])?></td>
                    <td>
                        <a href="excluir_usuario.php?id=<?=htmlspecialchars($usuario['id_usuario'])?>" onclick="return confirm('Tem certeza que deseja excluir este usuario?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php else : ?>
            <p>Nenhum usuário encontrado</p>
        <?php endif; ?>
        
        <a href="principal.php">Voltar</a>
        <address>
    <br><br><br><br>
        Raquel Fernandes / Estudante / raquel_f_brito@estudante.sesisenai.org.br
 </address>
   
</body>
</html>