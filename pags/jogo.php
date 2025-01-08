<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="../styles/teste.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Jogo</title>
</head>
<body style="background-color: #fcf7d1">
    <div id="cabecalho" >
        <img src="../figures/silenthill2.png" alt="Cabeçalho" width="10%" height="10%">
    </div>
    <div class="img1-sinopse">
        <div class ="img1" style="min-width: 30%; min-height: 30%; margin-left: 10vw; ">
            <img src="../figures/silenthill2.png" alt="Imagem à esquerda" width="70%" height="70%">
            <img src="../figures/rate.png" alt="Imagem à esquerda" width="70%" height="70%">
        </div>
        <div class="sinopse" style="margin-top: 10vh; margin-left: 0vw; margin-right: 10vw; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <p style="font-size:20px">Vivencie uma verdadeira aula de terror psicológico com este jogo, aclamado como o melhor da série, no hardware mais atual com visuais sinistros e sons de arrepiar.

Assuma o papel de James Sunderland e explore a quase deserta cidade de Silent Hill neste muito aguardado remake do clássico de 2001. Atraído até este lugar misterioso por uma carta de sua esposa, que morreu há três anos, James vasculha a cidade atrás de vestígios dela.

Entre num mundo onírico e se depare com monstros perversos, o ameaçador Pyramid Head e um elenco de personagens aparentemente comuns que tentam lidar com o passado.

À medida que James aceita sua instabilidade, uma pergunta ainda restará: qual o verdadeiro motivo para ele vir a Silent Hill?</p>
        </div>
    </div>
    <div class="carrossel" style = "display: flex; justify-content: center; margin-top: 10vh">
        <div id="carouselExampleIndicators" class="carousel slide" style = "width: 30%; height: 30%;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="../figures/silenthill2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../figures/silenthill2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../figures/silenthill2.png" class="d-block w-100" alt="...">
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
    
</body>
</html>