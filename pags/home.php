<?php
    require_once 'serverConnection.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuario WHERE idUsuario = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
    mysqli_close($connect);
?>

<?php

 $ids = array("1126190","39140","813780","366250","254460","587620","12200","323470", "220");
 $_SESSION['idsJogos'] = $ids;
 $jogos = array();
  foreach ($ids as $id){
    $link = 'https://store.steampowered.com/api/appdetails?appids='.$id;
    $jogos[] = json_decode(file_get_contents($link),true);
  }




?>



<html>
    <head>
        <title>Loja</title>
        <link rel="stylesheet"  href="../estilos/home.css" />
    </head>
    <body style = "max-width: 100vw">
        
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
            

            <p style = "align-self: end; margin: 10px; font-size: 30px">Gêneros</p>
            <p style = "align-self: end; margin: 10px; font-size: 30px">Lançamento</p>
            <p style = "align-self: end; margin: 10px; font-size: 30px">Bem avaliados</p>
            <div style = "display: flex;flex-direction: column; margin-right: 25px">
                <img style="width: 5vw; height: 10vh; align-self: center; justify-self: center" src="../figures/perfil.png" alt=""/>
                <p style = " font-size: 20px; align-self: center">Caio</p>
            </div>

        </div>

        <div style = "display: flex; flex-direction: row">
            <div style = "background-color: #A9A17A;  height: 83vh; width: 17vw; display: flex; justify-content: center; font-size: 30px">
                <p> Filtros</p>
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
                        
                        

                        $posicao = $ids[$pos];
                        $imagem_capa = $jogo[$posicao]["data"]["header_image"];
                        $nome = $jogo[$posicao]["data"]["name"];
                        $genero = $jogo[$posicao]["data"]["genres"][0]["description"];
                        //parafernalha pra colocar a virgula no preco
                        $preco_nao_formatado = $jogo[$posicao]["data"]["price_overview"]["initial"];;
                        $p = str_split($preco_nao_formatado);
                        $p[sizeof($p)] = $p[sizeof($p) - 1];
                        $p[sizeof($p) - 2] = $p[sizeof($p) - 3];
                        $p[sizeof($p) - 3] = ",";
                        $preco = implode("",$p);
                        $pos = $pos + 1;
                        
                        if(isset($_POST['pesquisar'])){
                            if(strpos(strtolower($nome),strtolower($_POST['pesquisar'])) !== false){
                                echo <<<card
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
                                        
                                        <img style = "width: 8vw; height: 5vh; align-self: center; margin-top: -7px; margin-bottom: 7px" class = "imagem" src = "../figures/rate.png">
                            
                                    
                                    <div style = "background-color: green; width: 100%; height: auto; display: flex; justify-content: center">
                                    <p style = "font-size: 25px; margin-top: 3px; margin-bottom: 3px; "> R$ $preco</p>
                                    </div>
                                    
                                </div>
                            card;
                                
                            }
                        }
                        

                        else{
                            
                            

                        echo <<<card
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
                                
                                <img style = "width: 8vw; height: 5vh; align-self: center; margin-top: -7px; margin-bottom: 7px" class = "imagem" src = "../figures/rate.png">
                    
                            
                            <div style = "background-color: green; width: 100%; height: auto; display: flex; justify-content: center">
                            <p style = "font-size: 25px; margin-top: 3px; margin-bottom: 3px; "> R$ $preco</p>
                            </div>
                            
                        </div>
                        card;
                        }
                    }
                       
                        
                    
                    ?>
                </div>
            </div>
            
        </div>
    


    </body>
</html>