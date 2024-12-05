<?php
    require_once 'serverConnection.php';
    session_start();
    if(isset($_POST['btn-cadastrar'])):
        $erros = array();
        $loginDB = mysqli_escape_string($connect, $_POST['login']);
        $nome = $_POST["nome"];
        $login = $_POST["login"];
        $senha = md5($_POST["senha"]);
        //$senha = $_POST["senha"];
        if($login == "" or $_POST["senha"] == "" or $nome == ""):
            $erros[] = "<li>Os campos precisam ser preenchidos. </li>";
        else:
            $sql = "SELECT login FROM login where login= '$loginDB'";
            $resultado = mysqli_query($connect, $sql);
            if(mysqli_num_rows($resultado) > 0):
                $erros[] = "<li>Esse login ja existe.</li>";
            else:
                $sqlInsert = "INSERT INTO login(nome, login, senha) values ('$nome', '$login', '$senha')";
                $insert = mysqli_query($connect, $sqlInsert);
                if($insert){
                    echo '<script language="javascript" type="text/javascript"> alert("Usuario cadastrado com sucesso!"); window.location.href="index.php"</script>';   

                }else{
                    $erros[] = "<li>Nao foi possivel cadastrar o usuario. Tente novamente.</li>";
                }
            endif;
        endif;
    endif;
?>

<?php 
    $wallpapers = array("../figures/sf6background.jpg","../figures/escorpio.jpg","../figures/narutofoda.jpg","../figures/mk.jpg","../figures/sonico.jpg", "../figures/vegetafodaa.jpg", "../figures/vegetafodaa2.jpg", "../figures/dmc4background.jpg");
    $wallpaper = $wallpapers[array_rand($wallpapers)];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="../styles/cadastro.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro</title>
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

    <div class = "formulario">

        <div style = "display: flex; flex-direction:column">
            <h1>Cadastro</h1>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label>Nome:</label><input type="text" name="nome" id="nome"><br>
                <label>Login:</label><input type="text" name="login" id="login"><br>
                <label>Senha:</label><input  type="password" name="senha"><br>
                <input type="submit" value="Cadastrar" id="cadastrar" name="btn-cadastrar">
            </form>
            <?php 
                if(!empty($erros)):
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                endif;
                
            ?>

        </div>
        
        <img style="width: 10vw; height: 20vh; margin-left: 20px" src="../figures/sf2zangief.gif" alt=""/>
    </div>
    
</body>
</html>