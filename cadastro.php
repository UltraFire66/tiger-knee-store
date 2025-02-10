<?php

$wallpapers = array("../figures/sf6background.jpg","../figures/escorpio.jpg","../figures/narutofoda.jpg","../figures/mk.jpg","../figures/sonico.jpg", "../figures/vegetafodaa.jpg", "../figures/vegetafodaa2.jpg", "../figures/dmc4background.jpg");

    if(!isset($display)){
        $display = "none";
        $blur = "blur(0px)";
    }
    if(!isset($displayFoto)){
        $displayFoto = "none";
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
    $_SESSION["loginDB"] = $loginDB; 
    $nome = $_POST["nome"];
    $login = $_POST["login"];
    $senha = MD5($_POST["senha"]);
    $cpf = $_POST["cpf"];
    $cpfLimpo = preg_replace('/\D/', '', $cpf);
    $cep = $_POST["cep"];
    $cepLimpo = preg_replace('/\D/', '', $cep);
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
        elseif(filter_var($login, FILTER_VALIDATE_EMAIL)===false):
            $erros[] = "<li>O email inserido não é válido.</li>";
        else:
            $sqlInsert = "INSERT INTO usuario(nome,email,senha,cpf,cep,estado,cidade,rua,numero) VALUES ('$nome',
            '$login','$senha','$cpfLimpo','$cepLimpo','$estado','$cidade','$rua','$numero')";
            $insert = mysqli_query($connect, $sqlInsert); 
    if($insert){
        $displayFoto = "flex";
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


<?php 
    if(isset($_POST['btn-concluir'])){
        $foto = "../figures/profile/img".$_POST["icone"].".png"; 
        //var_dump($foto);
        //var_dump($_SESSION["loginDB"]);
        $email = $_SESSION["loginDB"];
        $sqlInsertFoto = "UPDATE usuario set foto = '$foto' WHERE email = '$email'; ";
        mysqli_query($connect, $sqlInsertFoto);
        $display = "flex";
        $blur = "blur(5px)";
    }



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="d.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <script type="text/javascript">
        function mascaraCpf(cpf) {
            cpf = cpf.replace(/\D/g, ""); // so deixa numero
            
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

            return cpf;
        }

        function mascaraCep(cep) {
            cep = cep.replace(/\D/g, ""); // so deixa numero
            
            cep = cep.replace(/(\d{5})(\d)/, "$1-$2");

            return cep;
        }


        function aplicarMascaraCpf(input) {
            let cpf = input.value;
            input.value = mascaraCpf(cpf);
        }

        function aplicarMascaraCep(input) {
            let cep = input.value;
            input.value = mascaraCep(cep);
        }

        function validarNome(input) {
            if (input.value.trim() === "") {
                return;
            }
            var regex = /^[A-Za-zÀ-ÿ\s]+$/;
            if (!regex.test(input.value)) {
                alert("O nome não pode conter números ou caracteres especiais.");
                input.value = input.value.replace(/[^A-Za-zÀ-ÿ\s]/g, "");
            }
        }
    </script>
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
                        Nome: <input type="text" name="nome" id = "nome" oninput="validarNome(this)" required style="display: flex; flex-direction: column; margin-top: 1px;">
                        Email: <input type="text" name="login" id = "login" required style="display: flex; flex-direction: column; margin-top: 1px;">
                        CPF: <input type="text" id="cpf" name="cpf" maxlength="14" oninput="aplicarMascaraCpf(this)" required style="display: flex; flex-direction: column; margin-top: 1px;">
                        CEP: <input type="text" name="cep" id = "cep" minlength="9" maxlength="9" oninput="aplicarMascaraCep(this)" required style="display: flex; flex-direction: column; margin-top: 1px;">
                    </div>
                    <img style="width: 10vw; height: 20vh; margin-left: 20%" src="../figures/sf2zangief.gif" />
                </div>
                <div class="inputs" style="">
                    <div style="display: flex; flex-direction: row; justify-content: center; gap:18%;">
                        <div class="inputs" style="align-items:center;">
                            Estado: <input type="text" name="estado" id = "estado" minlength="2" maxlength="2" style="display: flex; flex-direction: column; margin-top: 1px;">
                            Cidade: <input type="text" name="cidade" id = "cidade" style="display: flex; flex-direction: column; margin-top: 1px;">
                            Senha: <input type="password" name="senha" id = "senha" minlength="6" maxlength="16" style="display: flex; flex-direction: column; margin-top: 1px;">
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

    <div class="janelaConcluido" style = "display: <?php echo $displayFoto?>; margin-left: 17.5vw; width: 65vw; height: 93vh; background-color:  #fcf7d1; margin-top: 5vh;">

        <p style = "font-size: 50px;">Escolha sua foto de perfil:</p>
        <form action="" method="POST" >
            <div class="icones2">
                
                <?php for($i = 0 ; $i < 12 ; $i++)
                    echo <<< card
                    
                        <label class="icones" title = "text" for = "img$i">
                            <input type="radio" name="icone" id="img$i" value="$i" style="position:absolute; appearance: none;">
                            <img class="img" src = "../figures/profile/img$i.png" style = "border-radius: 100px; width: 10vw; height: 20vh; margin-left: 20px; column-gap: 2vw;  cursor: pointer;"/>
                        </label>
                    card;
                
                
                ?>

            </div>
            <div style="display: flex; align-items: center; justify-content: center; width: 65vw; height: 3vh;"><input type="submit" value="concluir" id="concluir" name="btn-concluir" ></div>
        </form>
    </div>

    <div class="janelaConcluido" style = "display: <?php echo $display?>">

        <p style = "font-size: 50px;">cadastro concluído!</p>
        <img style="width: 10vw; height: 20vh; margin-left: 20px;" src="../figures/zangiefVictoryAnimation.webp"  />
        <button onclick="location.href = '../index.php';">voltar</button>
    </div>
</body>
</html>