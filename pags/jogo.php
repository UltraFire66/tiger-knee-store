<?php
    require_once 'serverConnection.php';
    session_start ();
    $string = $_SERVER["REQUEST_URI"];
    //var_dump($string);
    $idJogo = explode("?", $string);
    //var_dump($idJogo);
    $idJogo = explode("=", $idJogo[1]);
    //var_dump($idJogo);
    $api = 'https://store.steampowered.com/api/appdetails?appids='.$idJogo[1];
    //var_dump($api);
    $jogo = json_decode(file_get_contents($api),true);
    
?>
<?php
    /*if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;*/
    
    $id = $_SESSION['id_usuario'];
    $banana="banana";
    if(isset($_POST['btn-aval']) && isset($_SESSION['logado'])){
        $id = $_SESSION['id_usuario'];
        $avaliacao = mysqli_escape_string ($connect, $_POST['aval']);
        if(isset($_POST['rate'])){
            $nota = $_POST['rate'];
        }else{
            $nota=0;
        }

        $sql_insert = "INSERT INTO interacao (idjogo, nota, comentario, idUsuario) values ($idJogo[1], $nota, '$avaliacao', $id);";
        $sql_update = "UPDATE interacao SET nota=$nota, comentario='$avaliacao', idUsuario=$id WHERE (idUsuario = $id and idjogo=$idJogo[1]);";
        $sql_select = "SELECT * FROM interacao WHERE (idUsuario = $id and idjogo=$idJogo[1]);";
        $r=mysqli_query($connect, $sql_select);
        
        $dados = mysqli_fetch_array($r);
        if($dados == NULL){ 
            mysqli_query($connect, $sql_insert);
        }else{
            mysqli_query($connect, $sql_update);
        }
                                                                                
    }
?>




<?php
    
    if(!isset($display)){
        $display = "none";
        $blur = "blur(0px)"; 
    }

?>
<?php
    $string = $_SERVER["REQUEST_URI"];
    $idA = explode("?", $string);
    //ar_dump($idA);
    
    //var_dump($id);
    if(isset($idA[2])){
        $id = explode("=", $idA[2]);
        if($id[1]==1){
            $display = "flex";
            $blur = "blur(5px)";
        }
        if($id[1]==0){
            $display = "none";
            $blur = "blur(0px)";
        }   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="a.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Jogo</title>
</head>
<body style="background-color: #fcf7d1; margin: 0; padding: 0; overflow-x: hidden;" >
    <div style = "display: <?php echo $display?>; position: absolute;
            background-color: white;
            border-radius: 30px;
            align-items: center;
            flex-direction: column;
            margin-left: 35vw;
            margin-top: 20vh;
            filter: blur(0px);
            width: 30vw;
            height: 60vh;
            z-index: 3;
            background-color: #444444;
            ">
           <form action="<?php echo "jogo.php?idJogo=$idJogo[1]?id=0"; ?>" method="POST" style="display: flex; justify-content: center; flex-direction: column; align-items:center;">
                <div style="display: flex; width: 28vw;  align-items: center; margin-top: 15px">
                    <p style="margin-left: 0px; font-size:50px;">Avaliação</p>
                    <div class = "rating" style="margin-left: 5vw; margin-bottom: 1vh;" >

                        <input value = "5" name = "rate" id = "star5" type = "radio">
                        <label title =  "text" for = "star5"></label>

                        <input value = "4" name = "rate" id = "star4" type = "radio">
                        <label title =  "text" for = "star4"></label>

                        <input value = "3" name = "rate" id = "star3" type = "radio">
                        <label title =  "text" for = "star3"></label>

                        <input value = "2" name = "rate" id = "star2" type = "radio">
                        <label title =  "text" for = "star2"></label>

                        <input value = "1" name = "rate" id = "star1" type = "radio">
                        <label title =  "text" for = "star1"></label>

                    </div>
                </div>
                <div style="display: flex; background-color: #fcf7d1; width: 28vw; height: 30vh; margin-top: 30px; border-radius: 30px; justify-content: center; align-items: center;">
                    <div style="display: flex;  border-radius: 30px; width: 25vw; height: 27vh; background-color:#A9A17A; justify-content: center; align-items: center;">
                        <textarea type="text" id="aval" name="aval" style="display: flex; background-color:#A9A17A; width: 23vw; height: 25vh; resize: none; outline: 0; border: 0;"></textarea>
                    </div>
                </div>
                <?php
                    echo <<< avaliar
                        <a href = "jogo.php?idJogo=$idJogo[1]?id=0" style="color: black; text-decoration: none;">
                            <div style="margin-top: 30px; width: 20vw; height: 10vh; background-color: #B52C00; display: flex; align-items: center; justify-content: center; border-radius: 150px;">
                                <input type="submit" name="btn-aval" style="border: 0; background-color: #B52C00; font-size: 30px; display: flex; align-items: center; justify-content: center; color: black; text-decoration: none;" value="Avaliar">
                            </div>
                        </a>
                    avaliar;
                ?>
            </form>
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
        <div style = "background-color:  #8C0005;
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
        
        <div id="cabecalho" style="display: flex; height: 35%; width:100%; ">
            <img src=<?php echo $jogo[$idJogo[1]]['data']['screenshots'][1]['path_full']?> style = "width:90%" alt="Cabeçalho">
        </div>

        <div class="img1-sinopse">
            <div class ="img1" style="min-width: 30%; min-height: 30%; margin-left: 10vw; ">
                <img src="<?php echo $jogo[$idJogo[1]]['data']['header_image']?>" alt="Imagem à esquerda" width="70%" height="70%">
                <div class = "ratingComentario">
                        <?php
                            $resSoma = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(nota) from interacao WHERE idJogo = $idJogo[1];"));
                            $resCount = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(nota) from interacao WHERE idJogo = $idJogo[1];"));
                            //var_dump($resSoma);
                            //var_dump($resCount);
                            if($resCount[0] == 0){
                                $notaMedia = 0;
                            }else{
                                $media = $resSoma[0]/$resCount[0];
                                $notaMedia = intval($media);
                            }
                            
                            //var_dump($notaMedia);
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
                            echo<<<notaJogo
                                <input value = "5" name = "rate2" id = "star15" type = "radio" $st5>
                                <label title =  "text"></label>

                                <input value = "4" name = "rate2" id = "star14" type = "radio" $st4>
                                <label title =  "text"></label>

                                <input value = "3" name = "rate2" id = "star13" type = "radio" $st3>
                                <label title =  "text"></label>

                                <input value = "2" name = "rate2" id = "star12" type = "radio" $st2>
                                <label title =  "text"></label>

                                <input value = "1" name = "rate2" id = "star11" type = "radio" $st1>
                                <label title =  "text"></label>
                            notaJogo;
                        ?>
                </div>
            </div>
            <div class="sinopse" style="margin-top: 10vh; margin-left: 0vw; margin-right: 10vw; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <p style="font-size:20px"> <?php echo $jogo[$idJogo[1]]['data']['detailed_description']?> </p>
            </div>
        </div>
        
        <div class="carrossel" style = "display: flex; justify-content: center; margin-top: 10vh">
            <div id="carouselExampleIndicators" class="carousel slide" style = "width: 50%; height: 50%;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="<?php echo $jogo[$idJogo[1]]['data']['screenshots'][0]['path_full']?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $jogo[$idJogo[1]]['data']['screenshots'][2]['path_full']?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $jogo[$idJogo[1]]['data']['screenshots'][3]['path_full']?>" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>
        
        <div class="avalie" style = " display: flex; align-items: center; justify-content: center; margin-top: 15vh; ">
            <div style=" width: 30vw; height: 10vh; background-color: #B52C00; display: flex; align-items: center; justify-content: center; border-radius: 150px; ">
                <!--<p style="font-size: 30px; display: flex; align-items: center; justify-content: center; margin-top: 10px;">Avalie</P>
                <a type="submit" value="Avalie" id="avalie" name="btn-avalie" style="background-color: #B52C00; border: nome!important; font-size: 30px; display: flex; align-items: center; justify-content: center;">Avalie</a>
                <button type="button"  value="Avalie" id="avalie" name="btn-avalie" style="background-color: #B52C00; border: nome!important; font-size: 30px; display: flex; align-items: center; justify-content: center; margin-top: 10px;">Avalie</button>-->
                <?php echo <<<avalie
                    <a href= "jogo.php?idJogo=$idJogo[1]?id=1" style="background-color: #B52C00; font-size: 30px; display: flex; align-items: center; justify-content: center; color: black; text-decoration: none;">Avaliar</a>
                    avalie;
                ?>
                
            </div>
        </div>

        <div>
            <?php
                require_once 'serverConnection.php';
                $sql_com = "SELECT * FROM interacao where idJogo = $idJogo[1];";
                $res = mysqli_query($connect, $sql_com);
                $comentario = mysqli_fetch_row($res);
                if($comentario != NULL){
                    
                    //var_dump($comentario);
                    $intNota = intval($comentario[2]);
                    //var_dump($intNota);
                    // var_dump($comentario[4]);
                    $sql_nome = "SELECT nome FROM usuario WHERE idusuario = $comentario[4];";
                    $nome_res = mysqli_query($connect, $sql_nome);
                    $nome = mysqli_fetch_array($nome_res);
                    $st1 = "";
                    $st2 = "";
                    $st3 = "";
                    $st4 = "";
                    $st5 = "";
                    switch($intNota){
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
                    echo<<<comentarios
                    <div class="coment" style="display: flex; justify-content: center; align-items: center; width: 100vw; height: 20vh; margin-top: 15vh;">
                        <div style="display: flex; width: 60vw; height: 20vh; background-color: #444444; border-radius: 150px; flex-direction: column;">
                            <div style="display: flex; flex-direction: row; ">
                                <div>
                                    <img src="../figures/perfil.png" style="width: 15vw; height: 20vh;">
                                </div>
                                <div>
                                    <p style="font-size:30px; margin-top:20px; color: black; margin-bot: 0px;">$nome[0]</p>
                                </div>
                                <div>
                                    <div>
                                        <div class = "ratingComentario" style="width: 15vw; height: 10vh; margin-left: 2vw; margin-top: 15px;">
                            
                                            <input value = "5" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st5>
                                            <label title =  "text"></label>

                                            <input value = "4" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st4>
                                            <label title =  "text"></label>

                                            <input value = "3" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st3>
                                            <label title =  "text"></label>

                                            <input value = "2" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st2>
                                            <label title =  "text"></label>

                                            <input value = "1" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st1>
                                            <label title =  "text"></label>

                                    </div>
                                        
                                    </div>
                                    
                                </div>
                                    
                                
                                
                            </div>
                            <div style="position: absolute; display: flex; margin-top: 10vh; margin-left: 15vw; max-width: 40vw; max-height: 10vh;">
                                    <p style="font-size:20px; color: black; ">$comentario[3]</p>
                            </div>
                            
                        </div>
                    </div>
                    comentarios;
                    $comentario = mysqli_fetch_row($res);
                }

                while($comentario != NULL){
                    $intNota = intval($comentario[2]);
                    $sql_nome = "SELECT nome FROM usuario WHERE idusuario = $comentario[4];";
                    $nome_res = mysqli_query($connect, $sql_nome);
                    $nome = mysqli_fetch_array($nome_res);
                    //var_dump($intNota);
                    $st1 = "";
                    $st2 = "";
                    $st3 = "";
                    $st4 = "";
                    $st5 = "";
                    switch($intNota){
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
                    //var_dump($comentario[4]);
                    echo<<<comentarios
                    <div class="coment" style="display: flex; justify-content: center; align-items: center; width: 100vw; height: 20vh; margin-top: 5vh;">
                        <div style="display: flex; width: 60vw; height: 20vh; background-color: #444444; border-radius: 150px; flex-direction: column;">
                            <div style="display: flex; flex-direction: row; ">
                                <div>
                                    <img src="../figures/perfil.png" style="width: 15vw; height: 20vh;">
                                </div>
                                <div>
                                    <p style="font-size:30px; margin-top:20px; color: black; margin-bottom: 0px;">$nome[0]</p>
                                </div>
                                <div>
                                    <div class = "ratingComentario" style="width: 15vw; height: 10vh; margin-left: 2vw; margin-top: 15px;" >
                                        
                                        <input value = "5" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st5>
                                        <label title =  "text"></label>

                                        <input value = "4" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st4>
                                        <label title =  "text"></label>

                                        <input value = "3" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st3>
                                        <label title =  "text"></label>

                                        <input value = "2" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st2>
                                        <label title =  "text"></label>

                                        <input value = "1" name = "rate.$comentario[4]" id = "star1.$comentario[4]" type = "radio" $st1>
                                        <label title =  "text"></label>

                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div style="position: absolute; display: flex; margin-top: 10vh; margin-left: 15vw; max-width: 40vw; max-height: 10vh;">
                                <p style="font-size:20px; color: black; ">$comentario[3]</p>
                            </div>
                            
                        </div>
                    </div>
                    comentarios;
                    $comentario = mysqli_fetch_row($res);
                }
                
            ?>
        </div>
    </div>

    
    
</body>
</html>