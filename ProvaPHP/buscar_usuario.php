<?php
session_start();
require_once 'conexao.php';

//Verifica se o usuário tem permissão de adm ou secretária.

if($_SESSION['perfil'] != 1 && $_SESSION['perfil'] != 2) {
    echo "<script>alert('Acesso negado!'); window.location.href='principal.php'</script>";
    exit();
}
$usuario = []; // Inicializa a variável para evitar erros.

//Se o formulário for enviado, busca o usuário pelo ID ou Nome.
if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['busca'])) {
    $busca = trim($_POST['busca']);

    // Verifica se a busca é um número ou um nome.
    if(is_numeric($busca)) {
        $sql = "SELECT *  FROM usuario WHERE id_usuario = :busca ORDER BY nome ASC "; // Faz uma busca por ID, caso seja uma numérica.
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':busca',$busca, PDO::PARAM_INT);
    } else {
        $sql = "SELECT *  FROM usuario WHERE nome LIKE :busca_nome ORDER BY nome ASC "; // Faz uma busca por ID, caso seja por nome.
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':busca_nome',"%busca%", PDO::PARAM_STR);
    }
} else {
    $sql = "SELECT *  FROM usuario ORDER BY nome ASC "; // Faz uma busca por ID, caso seja por nome.
    $stmt = $pdo->prepare($sql);
}
$stmt->execute();
$usuario= $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

