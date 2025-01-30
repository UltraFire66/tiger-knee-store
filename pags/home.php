<?php
    require_once 'serverConnection.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;

    $display_carrinho = "none";

    $id = $_SESSION['id_usuario'];
    //var_dump($id);
    $sql = "SELECT * FROM usuario WHERE idUsuario = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
    $sql = "SELECT * FROM pedido WHERE idUsuario = '$id' and comprado = 0";
    $resultado_carrinho = mysqli_query($connect, $sql);
    $carrinho = mysqli_fetch_array($resultado_carrinho);
    
    $jogos_carrinho = array();
    
    

    while($carrinho != NULL){
        $display_carrinho = "flex";
        $jogos_carrinho[] = $carrinho;
        $carrinho = mysqli_fetch_array($resultado_carrinho);
    }
   
    
    
?>

<?php

    if (isset($_POST['btn-remover'])){
        $id_remover = $_POST['remove'];
        $sql = "DELETE FROM pedido WHERE idUsuario = '$id' and comprado = 0 and idjogo = $id_remover";
        mysqli_query($connect, $sql);

    }

    if (isset($_POST['btn-comprar'])){

        $sql = "DELETE FROM pedido WHERE idUsuario = '$id' and comprado = 0";
        mysqli_query($connect, $sql);

    }

?>

<?php

 $ids = array("39140","1126190","813780","366250","254460","587620","12200","323470");
 $_SESSION['idsJogos'] = $ids;
 $jogos = array();
 $para_carrinho = array();
  foreach ($ids as $id){
    $link = 'https://store.steampowered.com/api/appdetails?appids='.$id;
    $jogos[] = json_decode(file_get_contents($link),true);
    $para_carrinho[$id] = json_decode(file_get_contents($link),true);
  }


?>

<?php ?>



<html>
    <head>
        <title>Loja</title>
        <link rel="stylesheet"  href="b.css" />
    </head>
    <body style = "max-width: 100vw;  margin: 0;
    border: 0;
    padding: 0;">
        
        <div style = "background-color: #8C0005;
        width: 100%;
        height: 17vh;
        display: flex;
        flex-direction: row;
        justify-content: space-between" >

            <div style = "display:flex; flex-direction: row">
                <div style = "font-size: 30px; color: #9EA407; margin-left: 15px; display:flex; align-items: center; justify-content: center; flex-direction: column; width: 10vw; height: 100%;">
                        <p style = "margin: 0; padding: 5px;">TYGER</p>
                        <p style = "margin: 0 0 0 40px; padding: 5px;">KNEE</p>
                        <p style = "margin: 0; padding: 5px;">STORE</p>
                </div>
                    <img style="width: 5vw; height: 10vh; margin-left: 20px; align-self: center" src="../figures/logo.gif" alt=""/>
            </div>
            

            <div style = "display: flex;flex-direction: column; margin-right: 25px">
                <img style="width: 5vw; height: 10vh; align-self: center; justify-self: center" src="../figures/perfil.png" alt=""/>
                <a href = "perfil.php" style = "text-decoration: none; color: black"><p style = " font-size: 20px; align-self: center"><?php echo $dados['nome']?></p></a>
            </div>

        </div>

        <div style = "display: flex; flex-direction: row">
            <div style = "background-color: #A9A17A;  height: 83vh; width: 17vw; display: <?php echo $display_carrinho?>; align-items: center; font-size: 30px; flex-direction: column; gap: 15px">
                <p> Carrinho</p>

                
                <?php
                 $total_carrinho = 0;
                foreach($jogos_carrinho as $jogo_carrinho){
                    
                   

                    $preco_carrinho_nao_formatado = $para_carrinho[$jogo_carrinho[2]][$jogo_carrinho[2]]["data"]["price_overview"]["initial"];
                    $pr = str_split($preco_carrinho_nao_formatado);
                    $pr[sizeof($pr)] = $pr[sizeof($pr) - 1];
                    $pr[sizeof($pr) - 2] = $pr[sizeof($pr) - 3];
                    $pr[sizeof($pr) - 3] = ".";
                    $preco_carrinho = implode("",$pr);
                    $imagem_capa = $para_carrinho[$jogo_carrinho[2]][$jogo_carrinho[2]]["data"]["header_image"];
                    $quantidade = $jogo_carrinho[1];

                    $total_carrinho = $total_carrinho + (floatval($preco_carrinho) * $quantidade);

                    echo 
                    <<<carrinho
                    <div style = "display: flex; flex-direction: column; align-items: center; background-color: white; border-radius: 10px; width: 90%">
                        <form action = "home.php" method = "POST" style = "display: flex; width: 100%">
                            <textarea type="text" id="remove" name="remove" style="display: none;">$jogo_carrinho[2]</textarea>
                            <input type="submit" name="btn-remover" style = "margin-left: 4px; margin-top:4px; background-color:red; width: 1.2vw; height: 2vh; display: flex; justify-content: center; align-self: start" value = "X">
                        </form>
                        <img style = "margin-top: 10px; border-radius: 10px; width: 13vw; height: 10vh" src = $imagem_capa></img>
                        <div style = "display: flex; flex-direction: row; justify-content: center;">
    
                            <p style = "font-size: 20px"> R$: $preco_carrinho   X  $quantidade</p>
                        </div>
                    </div>
                    
                    carrinho;

                }
               


                ?>

                
                <p style = "font-size: 20px">Total: R$ <?php echo $total_carrinho?></p>
                <form action = "home.php" method = "POST">
                    <input name = "btn-comprar" type="submit" style = "font-size: 30px, display: flex; justify-content: center; align-items: center; width: 12vw; height: 4vh; background-color: #8cfc03; border-radius: 20px; justify-self: end; margin-bottom: 20px" value = "Comprar">
                </form>


            </div>
      
            <div style="display: flex; flex-direction: column; min-width: 83vw" >
                <div style = " height: 7vh; display: flex; align-items: center; justify-content: center; margin-top: 20px"> 
                    <div style = "width: 28vw ; height: 5vh; background-color: #444444; display: flex; align-items: center; border-radius: 15px">
                        <form method = "POST" style = "display: flex; align-items: center;">
                            <input type="text" id = "pesquisar" name = "pesquisar" style = "margin-top: 10px;margin-left: 10px; border-radius: 5px; height: 3vh; width: 20vw; background-color: #A9A17A">
                            <button style = "margin-left: 15px; margin-top: 10px" type = "submit"> <img src = "../figures/lupa.png" style = "width: 2vw; height: 3vh;"> </img></button>
                        </form>
                        
                    </div>
                    
                    


                </div>
                <div style = "width = 83vw , height: 83vh , background-color: blue ; display: grid; grid-template-columns: auto auto auto auto auto">
                    <?php
                    $pos = 0;
                    foreach($jogos as  $jogo){
                        
                        
                        
                        $codJogo = $ids[$pos];
                        $imagem_capa = $jogo[$codJogo]["data"]["header_image"];
                        $nome = $jogo[$codJogo]["data"]["name"];
                        $genero = $jogo[$codJogo]["data"]["genres"][0]["description"];
                        //parafernalha pra colocar a virgula no preco
                        $preco_nao_formatado = $jogo[$codJogo]["data"]["price_overview"]["initial"];;
                        $p = str_split($preco_nao_formatado);
                        $p[sizeof($p)] = $p[sizeof($p) - 1];
                        $p[sizeof($p) - 2] = $p[sizeof($p) - 3];
                        $p[sizeof($p) - 3] = ".";
                        $preco = implode("",$p);
                        $pos = $pos + 1;
                        
                        if(isset($_POST['pesquisar'])){
                            if(strpos(strtolower($nome),strtolower($_POST['pesquisar'])) !== false){

                                $resSoma = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(nota) from interacao WHERE idjogo = $codJogo;"));
                            $resCount = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(nota) from interacao WHERE idjogo = $codJogo;"));
                            //var_dump($resSoma);
                            //var_dump($resCount);
                            if($resCount[0] == 0){
                                $notaMedia = 0;
                            }else{
                                $media = $resSoma[0]/$resCount[0];
                                $notaMedia = intval($media);
                            }
                                                    
                            
                            $st1 = "";
                            $st2 = "";
                            $st3 = "";
                            $st4 = "";
                            $st5 = "";
                            switch($notaMedia){
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


                                echo <<<card
                                <a href="jogo.php?idJogo=$codJogo" style="text-decoration: none; color: black;">
                                    <div class="card" style = "
                                    display: flex;
                                    justify-content: center;
            
                                    margin-top: 4vh;
                                    margin-left: 3vw;
            
                                    flex-direction: column;
                                    height: 28.5vh;
                                    width: 12vw;
                                    box-shadow: 10px 10px 5px gray;
            
                                    ">
                                        <img class = "imagem-capa" style = "width: auto; height: auto" src = $imagem_capa>
                                        
                                            <div style = "margin-left: 15px">
                                                <p style = "font-size: 15px; align-self: center; margin-top: 3px"> $nome</p>
                                                <p style = "font-size: 10px;  align-self: center; margin-top: -14px">  $genero</p>
                                            </div>
                                            
                                            <div class = "ratingComentario" style = "align-self:center">
                                                
                                                    
                                                    
                                                        <input value = "5" name = "rate2.$codJogo" id = "star15.$codJogo" type = "radio" $st5>
                                                        <label title =  "text"></label>

                                                        <input value = "4" name = "rate2.$codJogo" id = "star14.$codJogo" type = "radio" $st4>
                                                        <label title =  "text"></label>

                                                        <input value = "3" name = "rate2.$codJogo" id = "star13.$codJogo" type = "radio" $st3>
                                                        <label title =  "text"></label>

                                                        <input value = "2" name = "rate2.$codJogo" id = "star12.$codJogo" type = "radio" $st2>
                                                        <label title =  "text"></label>

                                                        <input value = "1" name = "rate2.$codJogo" id = "star11.$codJogo" type = "radio" $st1>
                                                        <label title =  "text"></label>
                                                    
                                                
                                            </div>
                                
                                        
                                        <div style = "background-color: green; width: 100%; height: auto; display: flex; justify-content: center">
                                            <p style = "font-size: 25px; margin-top: 3px; margin-bottom: 3px; "> R$ $preco</p>
                                        </div>
                                        
                                    </div>
                                </a>
                            card;
                                
                            }
                        }
                        

                        else{
                            
                            $resSoma = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(nota) from interacao WHERE idjogo = $codJogo;"));
                            $resCount = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(nota) from interacao WHERE idjogo = $codJogo;"));
                            //var_dump($resSoma);
                            //var_dump($resCount);
                            if($resCount[0] == 0){
                                $notaMedia = 0;
                            }else{
                                $media = $resSoma[0]/$resCount[0];
                                $notaMedia = intval($media);
                            }
                                                    
                            
                            $st1 = "";
                            $st2 = "";
                            $st3 = "";
                            $st4 = "";
                            $st5 = "";
                            switch($notaMedia){
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

                            echo <<<card
                            
                                <a href="jogo.php?idJogo=$codJogo" style="display: block; margin-top: 4vh; margin-left: 3vw; width: 12vw ;text-decoration: none; color: black; ">
                                    <div class="card" style = "
                                    display: flex;
                                    justify-content: center;

                                    

                                    flex-direction: column;
                                    height: 28.5vh;
                                    width: 100%;
                                    box-shadow: 10px 10px 5px gray;

                                    ">

                                        <img class = "imagem-capa" style = "width: auto; height: auto" src = $imagem_capa>
                                        
                                            <div style = "margin-left: 15px">
                                                <p style = "font-size: 15px; align-self: center; margin-top: 3px"> $nome</p>
                                                <p style = "font-size: 10px;  align-self: center; margin-top: -14px">  $genero</p>
                                            </div>
                                            
                                            <div class = "ratingComentario" style = "align-self:center">
                                                
                                                    
                                                    
                                                        <input value = "5" name = "rate2.$codJogo" id = "star15.$codJogo" type = "radio" $st5>
                                                        <label title =  "text"></label>

                                                        <input value = "4" name = "rate2.$codJogo" id = "star14.$codJogo" type = "radio" $st4>
                                                        <label title =  "text"></label>

                                                        <input value = "3" name = "rate2.$codJogo" id = "star13.$codJogo" type = "radio" $st3>
                                                        <label title =  "text"></label>

                                                        <input value = "2" name = "rate2.$codJogo" id = "star12.$codJogo" type = "radio" $st2>
                                                        <label title =  "text"></label>

                                                        <input value = "1" name = "rate2.$codJogo" id = "star11.$codJogo" type = "radio" $st1>
                                                        <label title =  "text"></label>
                                                    
                                                
                                            </div>
                                
                                        
                                        <div style = "background-color: green; width: 100%; height: auto; display: flex; justify-content: center">
                                        <p style = "font-size: 25px; margin-top: 3px; margin-bottom: 3px; "> R$ $preco</p>
                                        </div>
                                        
                                    </div>
                                </a>
                            card;
                        }
                    }
                       
                        
                    
                    ?>
                </div>
            </div>
            
        </div>
    


    </body>
</html>