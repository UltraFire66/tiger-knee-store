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
    

    $r = mysqli_query($connect, "SELECT * FROM compra WHERE idUsuario = $id and comprado = 1;");
    $dados_compra = mysqli_fetch_array($r);
    $compras = array();

    while($dados_compra != NULL){

        $compras[$dados_compra['codigo']] = $dados_compra;
        $dados_compra = mysqli_fetch_array($r);

    }

    $idjogos = array();

    foreach($compras as $compra){
        $codigoCompra = $compra['codigo'];
        $idjogos[$codigoCompra] = array();
        
        $sql = "SELECT idjogo FROM pedido inner join pedido_compra,compra WHERE compra.codigo = $codigoCompra and compra.codigo = pedido_compra.codigoCompra and pedido.codigo = pedido_compra.codigoPedido;";
        
        $r2 =  mysqli_query($connect,$sql);
        $dados_jogos = mysqli_fetch_array($r2);
        while($dados_jogos != NULL){
            
            $idjogos[$compra['codigo']][] = $dados_jogos;
            $dados_jogos = mysqli_fetch_array($r2);

        }

    }

    
    
    

    foreach($idjogos as $idjogo){
       

        for($i = 0 ; $i < sizeof($idjogo) ; $i++){

            if(!isset($jogo[$idjogo[$i]['idjogo']])){
                $api = 'https://store.steampowered.com/api/appdetails?appids='.$idjogo[$i]['idjogo'];
                $jogo[$idjogo[$i]['idjogo']] = json_decode(file_get_contents($api),true);
            }

        }

    }

    //var_dump($idjogos);
    

?>


<?php
    

    if(!isset($displayHistorico)){
        $displayHistorico = "none";
        $blur = "blur(0px)";
         
    }

    if (isset($_POST['btn-historico'])){

        $displayHistorico = "flex";
        $blur = "blur(5px)";

    }

    if (isset($_POST['btn-desconectar'])){

        $_SESSION ['logado'] = false ;
        $_SESSION ['id_usuario'] = NULL;
        header('Location:../index.php');

    }

?>


<html>
    <head>
        <title>Meu Perfil</title>
        <link rel="stylesheet"  href="c.css" />
    </head>
    <body style = "max-width: 100vw; background-color: #fcf7d1;overflow-x: hidden;">
        
        <div class = "historico" style = "display: <?php echo $displayHistorico?>; position: absolute;
                background-color: #808080;
                border-radius: 30px;
                align-items: center;
                flex-direction: column;
                margin-left: 35vw;
                margin-top: 13vh;
                filter: blur(0px);
                width: 30vw;
                height: 70vh;
                z-index: 3;
        ">



            <div style = "margin-top: 5px"></div>
            <div class = "compra" style = " width: 90%; height: 5vh; ">

                <?php
                
                    foreach($compras as $compra){
                        $codigo_compra2 = $compra['codigo'];
                        $total = 0;

                        echo <<< topo

                            
                                <p style = "margin-left: 15px">codigo da compra: $codigo_compra2</p>
                                
                            
                        topo;

                        for($i = 0 ; $i < sizeof($idjogos[$codigo_compra2]) ; $i++){

                            $id_do_jogo = $idjogos[$codigo_compra2][$i]['idjogo'];
                            $imagem = $jogo[$id_do_jogo][$id_do_jogo]['data']['header_image'];
                            $nome = $jogo[$id_do_jogo][$id_do_jogo]['data']['name'];
                            
                            $preco_nao_formatado = $jogo[$id_do_jogo][$id_do_jogo]["data"]["price_overview"]["initial"];
                            $pr = str_split($preco_nao_formatado);
                            $pr[sizeof($pr)] = $pr[sizeof($pr) - 1];
                            $pr[sizeof($pr) - 2] = $pr[sizeof($pr) - 3];
                            $pr[sizeof($pr) - 3] = ".";
                            $preco = implode("",$pr);
                            
                            $total = $total + $preco;


                            echo <<< baixo

                            <div style = "display: flex; align-items: center">  
                                <img src = "$imagem" style  = "width:  4vw ; height: 3.5vh"/>
                                <p style = "margin-left: 15px; max-width: 70%;  word-wrap: break-word;">$nome: R$$preco </p>
                            </div>
                                

                            

                            baixo;
                            
                        }
                            
                        echo <<<linha
                        <div style = "width: 100%; display:flex; justify-content: end">
                            <p>Total: R$$total</p>
                        </div>
                        
                        <div class = "linha" style = "height: 5px; background-color: white; width: 100%"></div>
                        linha;

                        

                        

                        



                    }
                
                
                ?>

                <div style = "width: 100%; display:flex; justify-content: center; margin-top: 20px">
                    
                    
                    <a href = "<?php echo "perfil.php?".$_SESSION["id_usuario"];?>" style = "width: 7vw; height: 5vh; border-radius: 10px; background-color: #B52C00; display: flex; align-items: center; justify-content: center; color: black; text-decoration: none;">voltar</a>
            
                </div>
            </div>


        </div>

        



        <div class="fundoBlur" style = "
        height: 100vh;
        width: 100vw;
        flex-direction: column; 
        align-items: center;
        justify-content: center;    
        filter: <?php echo $blur?>;
        z-index: 1;
        ">




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

                    <div style = "display: flex; flex-direction: row; justify-content: center;"> <!-- foto de perfil e nome -->
                        <div class="card" style = "margin-top: 5%; background-color: #A9A17A"> 
                            <img src="<?php echo $dadosU['foto'] ?>" alt="Imagem de Perfil" class="profile-img">
                            <div class="name"><?php echo $dadosU['nome'] ?></div>
                            <?php 
                                if($idU == $id){
                                        echo '<div class="description" style="margin-top:15px"><a href="editaperfil.php?' . $_SESSION["id_usuario"] . '">Editar Perfil de Usuário</a></div>';
                                        echo '<div class="description" style="margin-top:15px"><a href="alterarsenha.php?' . $_SESSION["id_usuario"] . '">Alterar Senha</a></div>';
                                        
                                        echo '<form action = "perfil.php?'.$_SESSION["id_usuario"] . '" method = "POST"><div class="description" style="margin-top:15px"><input type="submit" name="btn-historico" value =  "Historico de Compras"></div></form>';
                                        echo '<form action = "perfil.php?'.$_SESSION["id_usuario"] . '" method = "POST"><div class="description" style="margin-top:15px"><input type="submit" name="btn-desconectar" value =  "Desconectar da Conta"></div></form>';
                                }
                            ?>
                        </div>
                    </div>
                
                    <div style = "display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 3%;"> <!-- avaliações -->
                    <div style="font-size: 50px;">Avaliações</div>
                    
                    <?php 
                    
                        $sql_avl = "SELECT * FROM interacao where idUsuario = '$idU'";
                        $res = mysqli_query($connect, $sql_avl);
                        $avaliacao = mysqli_fetch_array($res);
                        $jogo = array();
                        while($avaliacao != NULL){        
                            $api = 'https://store.steampowered.com/api/appdetails?appids='.$avaliacao['idjogo'];
                            $jogo[$avaliacao['idjogo']] = json_decode(file_get_contents($api),true);
                            $imgjogo = $jogo[$avaliacao['idjogo']][$avaliacao['idjogo']]['data']['capsule_image'];
                            $codjogo = $avaliacao['idjogo'];
                            $nota = mysqli_query($connect, "SELECT nota from interacao WHERE (idjogo = $codjogo and idUsuario = $idU)");
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
                        $sql_avl = "SELECT * FROM interacao where idUsuario = '$idU'";
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



        

        </div>
        

    </body>
</html>