<?php
    require_once 'serverConnection.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
    mysqli_close($connect);
?>
<html>
    <head>
        <title>Página restrita</title>
    </head>
    <body>
        <h1 >Olá <?php echo $dados ['nome']; ?></h1 >
        <a href ="../index.php ">Sair</a>
    </body>
</html>