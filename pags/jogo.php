<?php
    require_once 'serverConnection.php';
    session_start ();
    if(isset($_POST['btn-aval'])){
        $avaliacao = mysqli_escape_string ($connect, $_POST['aval']);
        if($_POST['aval'] != "" ){
            $sql = "INSERT INTO interacao (codigo, idjogo, nota, comentario, idUsuario) values (1, 2, 3, '$avaliacao', 5);";
            $r = mysqli_query($connect, $sql);
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
    if(isset($_GET['id'])){
        if($_GET['id']==1){
            $display = "flex";
            $blur = "blur(5px)";
        }
        if($_GET['id']==0){
            $display = "none";
            $blur = "blur(0px)";
        }   
    }
?>
<?php
    
    $jogo = json_decode(file_get_contents('https://store.steampowered.com/api/appdetails?appids=323470'),true);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="teste.css"/>
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
            z-index: 2;
            background-color: #444444;
            ">
           <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="display: flex; justify-content: center; flex-direction: column; align-items:center;">
                <div style="display: flex; width: 28vw;  align-items: center; margin-top: 15px">
                    <p style="margin-left: 0px; font-size:50px;">Avaliação</p>
                </div>
                <div style="display: flex; background-color: #fcf7d1; width: 28vw; height: 30vh; margin-top: 30px; border-radius: 30px; justify-content: center; align-items: center;">
                    <div style="display: flex;  border-radius: 30px; width: 25vw; height: 27vh; background-color:#A9A17A; justify-content: center; align-items: center;">
                        <textarea type="text" id="aval" name="aval" style="display: flex; background-color:#A9A17A; width: 23vw; height: 25vh; resize: none; outline: 0; border: 0;"></textarea>
                    </div>
                </div>
                <div style="margin-top: 30px; width: 20vw; height: 10vh; background-color: #B52C00; display: flex; align-items: center; justify-content: center; border-radius: 150px;">
                    <input type="submit" name="btn-aval" style="border: 0; background-color: #B52C00; font-size: 30px; display: flex; align-items: center; justify-content: center; color: black; text-decoration: none;" value="Avaliar">
                </div>
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
            <img src=<?php echo $jogo['323470']['data']['screenshots'][1]['path_full']?> style = "width:90%" alt="Cabeçalho">
        </div>

        <div class="img1-sinopse">
            <div class ="img1" style="min-width: 30%; min-height: 30%; margin-left: 10vw; ">
                <img src="<?php echo $jogo['323470']['data']['header_image']?>" alt="Imagem à esquerda" width="70%" height="70%">
                <div class = "rating">

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
            <div class="sinopse" style="margin-top: 10vh; margin-left: 0vw; margin-right: 10vw; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <p style="font-size:20px"> <?php echo $jogo['323470']['data']['detailed_description']?> </p>
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
                    <img src="<?php echo $jogo['323470']['data']['screenshots'][0]['path_full']?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $jogo['323470']['data']['screenshots'][2]['path_full']?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo $jogo['323470']['data']['screenshots'][3]['path_full']?>" class="d-block w-100" alt="...">
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
        
        <div class="avalie" style = " display: flex; align-items: center; justify-content: center; margin-top: 20vh;">
            <div style=" width: 30vw; height: 10vh; background-color: #B52C00; display: flex; align-items: center; justify-content: center; border-radius: 150px;">
                <!--<p style="font-size: 30px; display: flex; align-items: center; justify-content: center; margin-top: 10px;">Avalie</P>
                <a type="submit" value="Avalie" id="avalie" name="btn-avalie" style="background-color: #B52C00; border: nome!important; font-size: 30px; display: flex; align-items: center; justify-content: center;">Avalie</a>
                <button type="button"  value="Avalie" id="avalie" name="btn-avalie" style="background-color: #B52C00; border: nome!important; font-size: 30px; display: flex; align-items: center; justify-content: center; margin-top: 10px;">Avalie</button>-->
                <a href= "jogo.php?id=1" style="background-color: #B52C00; font-size: 30px; display: flex; align-items: center; justify-content: center; color: black; text-decoration: none;">Avaliar</a>
                
                
            </div>
        </div>

        <div class="coment" style="display: flex; justify-content: center; align-items: center; width: 100vw; height: 20vh; margin-top: 20vh;">
            <div style="display: flex; width: 60vw; height: 20vh; background-color: #444444; border-radius: 150px; flex-direction: column;">
                <div style="display: flex; flex-direction: row; ">
                    <div>
                        <img src="../figures/perfil.png" style="width: 15vw; height: 20vh;">
                    </div>
                    <div>
                        <p style="font-size:30px; margin-top:20px; color: black; margin-bot: 0px;">Guilherme França</p>
                    </div>
                    <div>
                        <img src="../figures/rate.png" style="width: 15vw; height: 10vh; margin-left: 5vw; margin-bot:0px;">
                    </div>
                    
                </div>
                <div style="position: absolute; display: flex; margin-top: 10vh; margin-left: 15vw; max-width: 40vw; max-height: 10vh;">
                    <p style="font-size:20px; color: black; ">Jogo de bosta 🤮 </p>
                </div>
                
            </div>
            
        </div>  
    </div>

    
    
</body>
</html>