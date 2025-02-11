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
        $senha = MD5($_POST["senha"]);
        $senhaatual = $dadosU["senha"];
        $confirmasenha = MD5($_POST["confirmasenha"]);
        $senhanova = MD5($_POST["senhanova"]);

        if($senha != $senhaatual):
            $erros[] = "<li>A senha está incorreta.</li>";
        elseif($confirmasenha != $senhanova):
            $erros[] = "<li>As senhas digitadas não conferem.</li>";               
        else:
            $sqlUpdate = "UPDATE usuario SET senha = '$senhanova' WHERE idUsuario = '$id'";
            $insert = mysqli_query($connect, $sqlUpdate);
            $erros[] = "<li>Senha alterada com sucesso!</li>";
            
            $caminho = "perfil.php?".$_SESSION["id_usuario"];
            header('location:'.$caminho);
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
        <div style = "display: flex; flex-direction: row; justify-content: center; gap: 18%;">
            <div style = "display: <?php echo $displayq;?> ; flex-direction: row; justify-content: center;"> <!-- foto de perfil e nome -->
                <div class="card" style = "margin-top: 5%; background-color: #A9A17A"> 
                    <img src="<?php echo $dadosU['foto'] ?>" alt="Imagem de Perfil" class="profile-img">
                    <div class="name"><?php echo $dadosU['nome'] ?></div>
                    <h1>Alterar senha</h1>
                    
                    
                        <div style="display: flex; flex-direction: row; justify-content: center; gap:18%;">
                            <div class="inputs" style="align-items:center;">
                                Senha atual: <input type="password" name="senha" id = "senha" required style="display: flex; flex-direction: column; margin-top: 1px;">
                                Nova senha: <input type="password" name="senhanova" id = "senhanova" required style="display: flex; flex-direction: column; margin-top: 1px;">
                                Confirmar nova senha: <input type="password" name="confirmasenha" id = "confirmasenha" required style="display: flex; flex-direction: column; margin-top: 1px;">
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
        </div>
        </form>
    <div style="margin-top:10px;"></div>


    </body>
</html>