<?php
    require_once 'serverConnection.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuario WHERE idUsuario = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
    mysqli_close($connect);
?>

<?php



$xml = file_get_contents('https://store.steampowered.com/api/appdetails?appids=587620');
$resultado = json_decode($xml, true);

?>



<html>
    <head>
        <title>Página restrita</title>
        <link rel="stylesheet"  href="../styles/home.css" />
    </head>
    <body>
        
        <div class="card">
            <img class = "imagem" src = <?php echo $resultado[587620]["data"]["header_image"]?>>

            <p style = "font-size: 20px;"><?php echo $resultado[587620]["data"]["name"]?></p>
            <p> <?php echo $resultado[587620]["data"]["genres"][0]["description"]?> </p>
        </div>

        <a href ="../index.php ">Sair</a>
    </body>
</html>