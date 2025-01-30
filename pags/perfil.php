<?php
    require_once 'serverConnection.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;

    $id = $_SESSION['id_usuario'];
    //var_dump($id);
    $sql = "SELECT * FROM usuario WHERE idUsuario = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
?>



<html>
    <head>
        <title>Meu Perfil</title>
        <link rel="stylesheet"  href="c.css" />
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
                <img style="width: 5vw; height: 10vh; align-self: center; justify-self: center" src="../figures/perfil.png" alt=""/>
                <p style = " font-size: 20px; align-self: center"><a href="perfil.php" style="text-decoration: none;"><?php echo $dados['nome']; ?></a></p>
            </div>

        </div>

        <div style = "display: flex; flex-direction: row; justify-content: center;"> <!-- foto de perfil e nome -->
            <div class="card" style = "margin-top: 5%; background-color: #A9A17A"> 
                <img src="../figures/goku.jpeg" alt="Imagem de Perfil" class="profile-img">
                <div class="name"><?php echo $dados['nome'] ?></div>
                <div class="description" style="margin-top:15px"><a href="../pags/editarperfil">Editar Perfil de Usuário</a></div>
            </div>
        </div>
    
        <div style = "display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 3%;"> <!-- avaliações -->
        <div style="font-size: 50px;">Avaliações</div>
        
        <?php 
        
        $sql_avl = "SELECT * FROM interacao where idUsuario = '$id'";
        $res = mysqli_query($connect, $sql_avl);
        $avaliacao = mysqli_fetch_array($res);
        $jogo = array();
        while($avaliacao != NULL){        
        $api = 'https://store.steampowered.com/api/appdetails?appids='.$avaliacao['idjogo'];
        $jogo[$avaliacao['idjogo']] = json_decode(file_get_contents($api),true);
        $imgjogo = $jogo[$avaliacao['idjogo']][$avaliacao['idjogo']]['data']['capsule_image'];
        $codjogo = $avaliacao['idjogo'];
        $nota = mysqli_query($connect, "SELECT nota from interacao WHERE (idjogo = $codjogo and idUsuario = $id)");
        $evaristo = mysqli_fetch_array($nota);
        $alex = $evaristo[0];
        
                            $st1 = "";
                            $st2 = "";
                            $st3 = "";
                            $st4 = "";
                            $st5 = "";
                            
                            switch(intval($alex)){
                            case 1: 
                                $st1 = "checked"; 
                                break;
                            case 2: 
                                $st2 = "checked"; 
                                break;
                            case 3: 
                                $st3 = "checked"; 
                                break;
                            case 4: 
                                $st4 = "checked"; 
                                break;
                            case 5:
                                $st5 = "checked"; 
                                break;
                            default;
                        }
        echo <<<avaliacoes
            <div style = "display: flex; flex-direction: row; justify-content: center; margin-top: 5vh;"> <!-- 1 div pra cada avaliaçao mt lixo -->
                <div style = "display: flex; flex-direction: column; align-items:flex-start; justify-content: center; max-width: 100%; margin-right: 2.5vw; margin-left: 2.5vw"><img src="$imgjogo" style="max-width:100%;"><div class = "ratingComentario" style = "align-self:center">
                                                
                                                    
                                                    
                                                        <input value = "5" name = "rate2.$codjogo" id = "star15.$codjogo" type = "radio" $st5>
                                                        <label title =  "text"></label>

                                                        <input value = "4" name = "rate2.$codjogo" id = "star14.$codjogo" type = "radio" $st4>
                                                        <label title =  "text"></label>

                                                        <input value = "3" name = "rate2.$codjogo" id = "star13.$codjogo" type = "radio" $st3>
                                                        <label title =  "text"></label>

                                                        <input value = "2" name = "rate2.$codjogo" id = "star12.$codjogo" type = "radio" $st2>
                                                        <label title =  "text"></label>

                                                        <input value = "1" name = "rate2.$codjogo" id = "star11.$codjogo" type = "radio" $st1>
                                                        <label title =  "text"></label>
                                                    
                                                
                                            </div></div> 
            </div>
        
        
        avaliacoes;
        $avaliacao = mysqli_fetch_array($res);
        }
        ?>


            
            <div style="font-size: 50px; margin-top: 10vh">Comentários</div>





        <?php 
            $sql_avl = "SELECT * FROM interacao where idUsuario = '$id'";
            $res = mysqli_query($connect, $sql_avl);
            $comentario = mysqli_fetch_array($res);
            while($comentario != NULL){
            $cmt = $comentario['comentario'];
            $nome = $jogo[$comentario['idjogo']][$comentario['idjogo']]['data']['name'];
            echo <<<comentario
            <div class="comentario" style="display:flex; flex-direction:row; justify-content: flex-start; margin-top: 5vh">
                <div style="margin-right: 10vw; display:flex; flex-direction:column; justify-content: center;white-space: nowrap;">$nome:</div>
                <div>$cmt</div>
            </div>
            comentario;
            $comentario = mysqli_fetch_array($res);
        }
        ?>
    <div style="margin-top:10px;"></div>


    </body>
</html>