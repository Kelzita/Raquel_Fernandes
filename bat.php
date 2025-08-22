<?php 
session_start();
require_once 'conexao.php';
require_once 'menu.php';

//Verifica se o usuário tem permissão de adm
if($_SESSION['perfil'] != 1) {
    echo "<script>alert('Acesso negado!'); window.location.href='principal.php'</script>";
    exit();
}

//Inicializa variável par armazenar usuários
$fornecedores = [];

//Buscar todos os usuário cadastrados em ordem alfabética

$sql = "SELECT * FROM fornecedor ORDER BY nome_fornecedor ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$fornecedores = $stmt->fetchALL(PDO::FETCH_ASSOC);

//Se um id foi passado via get exclui o usuário
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_fornecedor = $_GET['id'];

    // Exclui o usuário do Banco de dados
    $sql = "DELETE FROM fornecedor WHERE id_fornecedor = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id',$id_fornecedor, PDO::PARAM_INT);

    if($stmt->execute()) {
        echo "<script>alert('Fornecedor excluído com sucesso!'); window.location.href='excluir_fornecedor.php'</script>";
        exit();
    } else {
        echo "<script>alert('Erro ao excluir o Fornecedor');</script>";
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
    <title>Excluir Fornecedor</title>
</head>
<body>
    <h2>Excluir Fornecedor</h2>
    <?php if(!empty($usuarios)) : ?>
        <table  border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Contato</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($fornecedores as $fornecedor
    ) : ?>
                <tr>
                    <td><?=htmlspecialchars($fornecedor
            ['id_fornecedor'])?></td>
                    <td><?=htmlspecialchars($fornecedor
            ['nome_fornecedor'])?></td>
                    <td><?=htmlspecialchars($fornecedor
            ['endereco'])?></td>
                    <td><?=htmlspecialchars($fornecedor
            ['telefone'])?></td>
                    <td><?=htmlspecialchars($fornecedor
            ['email'])?></td>
                    <td>
                    <td><?=htmlspecialchars($fornecedor
            ['contato'])?></td>
                    <td>
                        <a href="excluir_fornecedor.php?id=<?=htmlspecialchars($fornecedor['id_fornecedor'])?>" onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php else : ?>
            <p>Nenhum fornecedor encontrado</p>
        <?php endif; ?>
        
        <a href="principal.php">Voltar</a>
        <address>
    <br><br><br><br>
        Raquel Fernandes / Estudante / raquel_f_brito@estudante.sesisenai.org.br
 </address>
   
</body>
</html>