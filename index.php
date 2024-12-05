<?php
    require_once 'pags/serverConnection.php';
    session_start ();
    if(isset ($_POST['btn-entrar'])):
        $erros = array();
        $login = mysqli_escape_string ($connect, $_POST['login']);
        $senha = mysqli_escape_string ($connect, $_POST['senha']);
            if($_POST['login'] == "" or $_POST['senha'] == ""):
                $erros[] = "<li>O campo login / senha precisa ser preenchido.</li>";
            else :
                $sql = "SELECT login FROM login WHERE login = '$login'";
                $resultado = mysqli_query ($connect, $sql );
                if( mysqli_num_rows ($resultado) > 0):
                    // Existe um registro com o login que foi informado
                    $senha2 = md5($senha);
                    $sql = "SELECT * FROM login WHERE login = '$login' AND senha = '$senha2'";
                    $resultado = mysqli_query($connect, $sql);
                    mysqli_close($connect);
                        if(mysqli_num_rows($resultado) == 1):
                            $dados = mysqli_fetch_array ($resultado);
                            $_SESSION ['logado'] = true ;
                            $_SESSION ['id_usuario'] = $dados ['id'];
                            header('Location:home.php');
                        else :
                            $erros[] = "<li>Usuário e senha não conferem.</li>";
                        endif;
                else :
                    // Não existe um registro com o login que foi informado
                    $erros[] = "<li>Usuário inexistente.</li>";
            endif;
        endif;
    endif;
?>

<?php 
    $wallpapers = array("figures/sf6background.jpg","figures/escorpio.jpg","figures/narutofoda.jpg","figures/mk.jpg","figures/sonico.jpg", "figures/vegetafodaa.jpg", "figures/vegetafodaa2.jpg", "figures/dmc4background.jpg");
    $wallpaper = $wallpapers[array_rand($wallpapers)];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="styles/login.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style = "
    background-image: url(<?php echo $wallpaper; ?>);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
    background-size: cover;
    ">
   
    <div class="formulario">

        <div style="display: flex; flex-direction: row; align-items: center; ">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="titulo-form">
                <h1 style="display: flex; justify-content: center">Login</h1>
            </div>

                <div class="inputs">
                    Login: <input type="text" name="login"><br>
                    Senha: <input type="password" name="senha"><br>
                    <button type="submit" name=btn-entrar>Entrar</button>
                </div>
            </form>

            <img style="width: 10vw; height: 20vh; margin-left: 20px" src="logo.gif" alt=""/>
        </div>
        <a href="pags/cadastro.php">Cadastre-se</a>
        <?php 
        if(!empty($erros)):
            foreach($erros as $erro):
                echo $erro;
            endforeach;
        endif;    
    ?>
    </div>
    

    

    

</body>
</html>