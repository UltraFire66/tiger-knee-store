<?php
    require_once 'serverConnection.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;
    //pega id usuario
    $string = $_SERVER["REQUEST_URI"];
    $string = explode("?",$string);
    $idU = $string[1];
    //var_dump($id);
    $id = $_SESSION['id_usuario'];
    //var_dump($id);
    $sql = "SELECT * FROM usuario WHERE idUsuario = '$idU'";
    $resultado = mysqli_query($connect, $sql);
    $dadosU = mysqli_fetch_array($resultado);
    $sql1 = "SELECT * FROM usuario WHERE idUsuario = '$id'";
    $resultado1 = mysqli_query($connect, $sql1);
    $dados1 = mysqli_fetch_array($resultado1);
    //var_dump($dados1);
    
    if(isset($_POST['btn-cadastrar'])):
        $erros = array();
        $loginDB = mysqli_escape_string($connect, $_POST['login']);
        $_SESSION["loginDB"] = $loginDB; 
        $nome = $_POST["nome"];
        $login = $_POST["login"];
        $senha = $dadosU["senha"];
        $cpf = $_POST["cpf"];
        $cpfLimpo = preg_replace('/\D/', '', $cpf);
        $cep = $_POST["cep"];
        $cepLimpo = preg_replace('/\D/', '', $cep);
        $estado = $_POST["estado"];
        $cidade = $_POST["cidade"];
        $rua = $_POST["rua"];
        $numero = $_POST["numero"];
        $confirmasenha = MD5($_POST["confirmasenha"]);
        $verificaemail = "SELECT * FROM usuario WHERE email = '$login'";
        $resultado2 = mysqli_query($connect, $verificaemail);
        $emailU = mysqli_fetch_array($resultado2);
        $foto = "../figures/profile/img".$_POST["icone"].".png";
        $email = $_SESSION["loginDB"];
        // Inicialize a variável $set com um valor vazio.
        $set = "";

        // Verifica se cada variável foi preenchida e adiciona à cláusula SET.
        if (!empty($nome)) {
            $set .= "nome = '$nome', ";
        }
        if (!empty($login)) {
            $set .= "email = '$login', ";
        }
        if (!empty($cpfLimpo)) {
            $set .= "cpf = '$cpfLimpo', ";
        }
        if (!empty($cepLimpo)) {
            $set .= "cep = '$cepLimpo', ";
        }
        if (!empty($estado)) {
            $set .= "estado = '$estado', ";
        }
        if (!empty($cidade)) {
            $set .= "cidade = '$cidade', ";
        }
        if (!empty($rua)) {
            $set .= "rua = '$rua', ";
        }
        if (!empty($numero)) {
            $set .= "numero = '$numero', ";
        }
        if (!empty($foto)) {
            $set .= "foto = '$foto', ";
        }
        // Remove a última vírgula e espaço se houver qualquer valor.
        $set = rtrim($set, ', ');

        if(mysqli_num_rows($resultado2) > 0):
            $erros[] = "<li>Esse login já existe.</li>";
        elseif($confirmasenha != $senha):
            $erros[] = "<li>As senhas digitadas não conferem.</li>";
        elseif(filter_var($login, FILTER_VALIDATE_EMAIL)===false && $login != NULL):
            $erros[] = "<li>O email inserido não é válido.</li>";
        elseif(empty($set)):
            $erros[] = "<li>Nenhum dado foi alterado.</li>";                
        else:
            $sqlUpdate = "UPDATE usuario SET $set WHERE idUsuario = '$id'";
            $insert = mysqli_query($connect, $sqlUpdate);
        endif;
    endif;
    if($idU == $id){
        $displayq = "flex";
        $displayr = "none";
    }else{
        $displayq = "none";
        $displayr = "flex";
    }
    //var_dump($set);
    //var_dump($senha);
?>

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

<html>
    <head>
        <title>Editar perfil</title>
        <link rel="stylesheet"  href="e.css" />
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
    <body style = "max-width: 100vw; background-color: #fcf7d1">
        
        <div style = "background-color: #8C0005;
        width: 100%;
        height: 17vh;
        display: flex;
        flex-direction: row;
        justify-content: space-between" >

            <a href = "home.php" style = "display:flex; flex-direction: row; text-decoration: none">
                <div style = "font-size: 30px; color: #9EA407; margin-left: 15px; display:flex; align-items: center; justify-content: center; flex-direction: column; width: 10vw; height: 100%;">
                        <p style = "margin: 0; padding: 5px;">TYGER</p>
                        <p style = "margin: 0 0 0 40px; padding: 5px;">KNEE</p>
                        <p style = "margin: 0; padding: 5px;">STORE</p>
                </div>
                    <img style="width: 5vw; height: 10vh; margin-left: 20px; align-self: center" src="../figures/logo.gif" alt=""/>
            </a>
            

            
            <div style = "display: flex;flex-direction: column; margin-right: 25px">
                <img style="width: 5vw; height: 10vh; align-self: center; justify-self: center; border-radius: 100%; margin-top:2vh;" src="<?php echo $dados1["foto"]?>" alt=""/>
                <p style = " font-size: 20px; align-self: center"><a href = "<?php echo "perfil.php?".$_SESSION["id_usuario"];?>" style = "text-decoration: none; color: black"><?php echo $dados1["nome"]?></a></p>
            </div>

        </div>

        <div style = "display: <?php echo $displayr;?> ; flex-direction: row; justify-content: center;"> <!-- div a ser exibida se o usuario tentar editar o perfil de outro id -->
            <div class="card" style = "margin-top: 5%; background-color: #A9A17A"> 
                Acesso negado.
            </div>
        </div>
        <form action="" method="POST">
        <div style = "display: flex; flex-direction: row; justify-content: center; ">
            <div style = "display: <?php echo $displayq;?> ; flex-direction: row; justify-content: center;"> <!-- foto de perfil e nome -->
                <div class="card" style = "margin-top: 5%; background-color: #A9A17A"> 
                    <img src="<?php echo $dadosU['foto'] ?>" alt="Imagem de Perfil" class="profile-img">
                    <div class="name"><?php echo $dadosU['nome'] ?></div>
                    <h1>Editar Perfil de Usuário</h1>
                    
                    
                        <div style="display: flex; flex-direction: row; justify-content: center; gap:18%;">
                            <div class="inputs" style="align-items:center;">
                                Nome: <input type="text" name="nome" id = "nome" oninput="validarNome(this)" style="display: flex; flex-direction: column; margin-top: 1px;">
                                Email: <input type="text" name="login" id = "login" style="display: flex; flex-direction: column; margin-top: 1px;">
                                CPF: <input type="text" id="cpf" name="cpf" maxlength="14" oninput="aplicarMascaraCpf(this)" style="display: flex; flex-direction: column; margin-top: 1px;">
                                CEP: <input type="text" name="cep" id = "cep" minlength="9" maxlength="9" oninput="aplicarMascaraCep(this)" style="display: flex; flex-direction: column; margin-top: 1px;">
                                Estado: <input type="text" name="estado" id = "estado" minlength="2" maxlength="2" style="display: flex; flex-direction: column; margin-top: 1px;">
                                Cidade: <input type="text" name="cidade" id = "cidade" style="display: flex; flex-direction: column; margin-top: 1px;">
                                Número: <input type="text" name="numero" id = "numero" style="display: flex; flex-direction: column; margin-top: 1px;">
                                Rua: <input type="text" name="rua" id = "rua" style="display: flex; flex-direction: column; margin-top: 1px;">
                                Confirmar senha: <input type="password" name="confirmasenha" id = "confirmasenha" required style="display: flex; flex-direction: column; margin-top: 1px;">
                                <div style="display: flex; flex-direction: row; justify-content: center; margin-top: 1vh;"><input type="submit" value="Salvar Alterações" id="cadastrar" name="btn-cadastrar" ></div>
                                <?php 
                                    if(!empty($erros)):
                                        foreach($erros as $erro):
                                        echo $erro;
                                        endforeach;
                                    endif;    
                                ?>
                            </div>
                        </div>
                    
                </div>
            </div>
            <div class="janelaConcluido" style = "display: <?php echo $displayq?>; height: 50vh; background-color:  #fcf7d1;">

                <p style = "font-size: 20px;">Escolha sua foto de perfil:</p>
                    <div class="icones2">
                        
                        <?php for($i = 0 ; $i < 12 ; $i++)
                            echo <<< card
                            
                                <label class="icones" title = "text" for = "img$i">
                                    <input type="radio" name="icone" id="img$i" value="$i" style="appearance: none;">
                                    <img class="img" src = "../figures/profile/img$i.png" style = "border-radius: 100px; width: 10vw; height: 20vh; margin-left: 10px; column-gap: 2vw;  cursor: pointer;"/>
                                </label>
                            card;
                        
                        
                        ?>

                    </div>
            </div>
        </div>
        </form>
    <div style="margin-top:10px;"></div>


    </body>
</html>