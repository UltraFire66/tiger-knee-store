<?php

$wallpapers = array("../figures/sf6background.jpg","../figures/escorpio.jpg","../figures/narutofoda.jpg","../figures/mk.jpg","../figures/sonico.jpg", "../figures/vegetafodaa.jpg", "../figures/vegetafodaa2.jpg", "../figures/dmc4background.jpg");

    if(!isset($display)){
        $display = "none";
        $blur = "blur(0px)";
    }
    if(!isset($$wallpaper)){
        $wallpaper = $wallpapers[array_rand($wallpapers)];
    }
    
    

?>

<?php
 require_once 'serverConnection.php';
 session_start();
 if(isset($_POST['btn-cadastrar'])):
 $erros = array();
 $loginDB = mysqli_escape_string($connect, $_POST['login']);
 $nome = $_POST["nome"];
 $login = $_POST["login"];
 $senha = MD5($_POST["senha"]);
 if(empty($login) or empty($senha) or empty($nome)):
 $erros[] = "<li>Os campos nome/login/senha precisam ser preenchidos.</li>";
 else:
 $sql = "SELECT email FROM usuario WHERE email = '$loginDB'";
 $resultado = mysqli_query($connect, $sql);
 if(mysqli_num_rows($resultado) > 0):
 $erros[] = "<li>Esse login já existe.</li>";
 else:
 $sqlInsert = "INSERT INTO usuario(nome,email,senha) VALUES ('$nome',
 '$login','$senha')";
 $insert = mysqli_query($connect, $sqlInsert); 
 if($insert){
    $display = "flex";
    $blur = "blur(5px)";
    }
    else{
    $erros[] = "<li>Não foi possível cadastrar o usuário.
    Tente novamente.</li>";
    }
    endif;
    endif;
    endif;
    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="../estilos/cadastro.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style = "
    
    display: flex;
    flex-direction: column;
 
    margin: 0; 
    padding: 0;
    background-size: cover;
    ">
    
    
    <div class="fundoBlur" style = "

    background-image: url(<?php echo $wallpaper; ?>);
    height: 100vh;
    width: 100vw;
    display: flex;
    flex-direction: column; 
    align-items: center;
    justify-content: center;
     background-size: cover;
     filter: <?php echo $blur?>;
    ">


    <div class="formulario">

        <div style="display: flex; flex-direction: row; align-items: center; ">
     
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
 
            <div class="titulo-form">
                <h1 style="display: flex; justify-content: center">Cadastro</h1>
            </div>

                <div class="inputs">
                    Nome: <input type="text" name="nome" id = "nome"><br>
                    Email: <input type="text" name="login" id = "login"><br>
                    Senha: <input type="password" name="senha" id = "senha"><br>
                    <input type="submit" value="Cadastrar" id="cadastrar" name="btn-cadastrar" >
                </div>
            </form>

            <img style="width: 10vw; height: 20vh; margin-left: 20px" src="../figures/sf2zangief.gif" />
        </div>

        <?php 
        if(!empty($erros)):
            foreach($erros as $erro):
                echo $erro;
            endforeach;
        endif;    
    ?>
    </div>
    

    

    </div>
    <div class="janelaConcluido" style = "display: <?php echo $display?>">

        <p style = "font-size: 50px;">cadastro concluído!</p>
        <img style="width: 10vw; height: 20vh; margin-left: 20px;" src="../figures/zangiefVictoryAnimation.webp"  />
        <button onclick="location.href = '../index.php';">voltar</button>
    </div></div>
</body>
</html>











