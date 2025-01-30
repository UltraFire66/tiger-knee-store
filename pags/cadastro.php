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
    $cpf = $_POST["cpf"];
    $cep = $_POST["cep"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $confirmasenha = MD5($_POST["confirmasenha"]);
 if(empty($login) or empty($senha) or empty($nome) or empty($cpf) or empty($cep) or empty($estado) or empty($cidade) or empty($rua) or empty($numero)):
    $erros[] = "<li>Os campos precisam ser preenchidos.</li>";
    else:
        $sql = "SELECT email FROM usuario WHERE email = '$loginDB'";
        $resultado = mysqli_query($connect, $sql);
        if(mysqli_num_rows($resultado) > 0):
            $erros[] = "<li>Esse login já existe.</li>";
        elseif($senha != $confirmasenha):
            $erros[] = "<li>As senhas digitadas não conferem.</li>";
        else:
            $sqlInsert = "INSERT INTO usuario(nome,email,senha,cpf,cep,estado,cidade,rua,numero) VALUES ('$nome',
            '$login','$senha','$cpf','$cep','$estado','$cidade','$rua','$numero')";
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
    <title>Página de Cadastro</title>
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


    <div class="formulario" style="width: 27%; height: 65%;">
        <div class="titulo-form" style="display: flex; justify-content: center;">
                <h1 style="margin-top: 1vh;">Cadastro</h1>
        </div>
        <div style="display: flex; flex-direction: row; align-items: center; ">
    
        
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                <div style="display: flex; flex-direction: row; justify-content: center;">
                    <div class="inputs" style="">
                        Nome: <input type="text" name="nome" id = "nome" style="display: flex; flex-direction: column; margin-top: 1px;">
                        Email: <input type="text" name="login" id = "login" style="display: flex; flex-direction: column; margin-top: 1px;">
                        CPF: <input type="text" name="cpf" id = "cpf" style="display: flex; flex-direction: column; margin-top: 1px;">
                        CEP: <input type="text" name="cep" id = "cep" style="display: flex; flex-direction: column; margin-top: 1px;">
                    </div>
                    <img style="width: 10vw; height: 20vh; margin-left: 20%" src="../figures/sf2zangief.gif" />
                </div>
                <div class="inputs" style="">
                    <div style="display: flex; flex-direction: row; justify-content: center; gap:18%;">
                        <div class="inputs" style="align-items:center;">
                            Estado: <input type="text" name="estado" id = "estado" style="display: flex; flex-direction: column; margin-top: 1px;">
                            Cidade: <input type="text" name="cidade" id = "cidade" style="display: flex; flex-direction: column; margin-top: 1px;">
                            Senha: <input type="password" name="senha" id = "senha" style="display: flex; flex-direction: column; margin-top: 1px;">
                        </div>
                        <div class="inputs" style="align-items:center;">
                            Número: <input type="text" name="numero" id = "numero" style="display: flex; flex-direction: column; margin-top: 1px;">
                            Rua: <input type="text" name="rua" id = "rua" style="display: flex; flex-direction: column; margin-top: 1px;">
                            Confirmar Senha: <input type="password" name="confirmasenha" id = "confirmasenha" style="display: flex; flex-direction: column; margin-top: 1px;">
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: center;"><input type="submit" value="Cadastrar" id="cadastrar" name="btn-cadastrar" ></div>
                    
                        
                </div>
            </form>

            
            
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
    </div>
</body>
</html>