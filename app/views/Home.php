<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/assets/css/Home.css"> 
</head>
<body>
<main id="Home">

  <!-- Seção de boas-vindas -->
  <section id="BoasVindas" class="section-padrao section-full">
    <h1>Bem-Vindo à Paróquia Santuário <br>São Judas Tadeu</h1>
    <img id="SaoJudas" src="public/assets/images/padroeiro.jpeg" alt="Imagem de São Judas Tadeu">
    <div class="scroll-mouse">
      <div class="mouse">
          <div class="wheel"></div>
      </div>
  </section>

  <?php include 'NavBar.php'; ?>

  <!-- Sobre a paróquia -->
  <section id="HomePG2" class="section-padrao">
    <div class="linha"> 
    <div class="itens-esquerda">
        <h1>Paróquia Santuário São Judas Tadeu</h1>
        <button id="mostrarMapa" class="btn">Encontre-nos</button>
      <div class="links-sociais">
        <img id="whatsapp" src="public/assets/images/whatsapp.png" alt="whatsapp">
        <img id="facebook" src="public/assets/images/facebook.png" alt="facebook">
        <img id="instagram" src="public/assets/images/instagram.png" alt="instagram">
      </div>
       
        </div>
      <img class="img" id="fachada" src="public/assets/images/fachada.jpeg" alt="Fachada da igreja">
    </div>
  </section>

<section id="HomePG5" class="section-padrao">
    <div class="linha">
      <img class="img" src="public/assets/images/cristo.jpeg" alt="Imagem de Cristo">
     <div class="itens-direita"> 
         <h1>Sobre nós</h1>
      <p>A paróquia- santuário São Judas Tadeu, localizada no bairro da Condor, o santo conhecido
como padroeiro das causas impossíveis e desesperadas é também o padroeiro do
funcionário público. Em 6 de janeiro de 2026, a Paróquia-Santuário celebrará seu jubileu de
70 anos de fundação. </p>
    </div> 
     </div>
  </section>
  <!-- Transmissões -->
  <section id="HomePG3" class="section-padrao">
    <div class="linha"> 
        <img class="icon" id="igreja" src="public/assets/images/youtube.png" alt="youTube"> 
      <h1>Transmissões</h1>
      <p>Acompanhe-nos ao vivo no YouTube</p>
<iframe id="video" src="https://www.youtube.com/embed/WrllCjOtjCM?si=VNgiuDFX0Di9z7-q" 
    title="YouTube video player" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>    
</div>  
  </section>

  <!-- Programação -->
  <section id="HomePG4" class="section-padrao">
    <div class="linha">  
        <img class="icon" src="public/assets/images/calendario.png" alt="">      
      <h1>Calendário Paroquial</h1>
      <p>Participe de nossas celebrações e fortaleça sua fé em comunidade</p>

      <div class="eventos">
        <?php if (!empty($eventos)): ?>
          <?php foreach ($eventos as $evento): ?>
            <article class="card">
              <h2><?= htmlspecialchars($evento['titulo']) ?></h2>
              <p><strong>Tipo:</strong> <?= htmlspecialchars($evento['tipo']) ?></p>
              <p><strong>Dia:</strong> <?= htmlspecialchars($evento['dia_semana']) ?></p>
              <p><strong>Horário:</strong> <?= htmlspecialchars($evento['horario']) ?></p>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Nenhum evento cadastrado no momento.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>


  <section id="HomePG6" class="section-padrao">
    <div class="linha">
      <h1>Liturgia diária</h1>

      <div class="liturgia-container">
        <?php include 'app/controllers/LiturgiaController.php'; 
        $liturgiaController = new LiturgiaController();
        $liturgia = $liturgiaController->mostrarLiturgia();
        ?>
      </div>
    </div>

   <section class="section-padrao qrcode-section">
  <div class="linha qrcode-linha">
    <div class="qrcode-texto">
      <h2>Contribua com a Paróquia</h2>
      <p>A doação para a igreja é um ato de fé e gratidão que permite à instituição cumprir sua missão de evangelização, sustentação das atividades e apoio aos necessitados. Essa generosidade possibilita a manutenção das estruturas da igreja, a promoção de programas sociais e educacionais, e o alcance de mais pessoas com a mensagem de Cristo.</p>
      <p>Escaneie o QR Code ao lado e contribua para a obra do</p>
    </div>
    <div class="qrcode-img">
      <img id="qrcode" src="public/assets/images/QRcode.png" alt="QR Code de doação">
    </div>
  </div>
</section>


</main>
    <script src="public/assets/js/navegacao.js"></script>
    <script>
  document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("mostrarMapa");
    const fachada = document.getElementById("fachada");

    // Cria o iframe do Google Maps
    const mapa = document.createElement("iframe");
    mapa.src =
      "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4968436772488!2d-48.4782222242187!3d-1.4746970358627465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x92a48de08c562ba7%3A0xa88030050447e38d!2sPar%C3%B3quia%20Santu%C3%A1rio%20S%C3%A3o%20Judas%20Tadeu!5e0!3m2!1spt-BR!2sbr!4v1758669193062!5m2!1spt-BR!2sbr",
    mapa.width = "100%";
    mapa.height = "400";
    mapa.style.border = "0";
    mapa.style.display = "none"; // começa oculto
    mapa.loading = "lazy";
    mapa.allowFullscreen = true;

    // insere o iframe logo depois da imagem da fachada
    fachada.insertAdjacentElement("afterend", mapa);

    btn.addEventListener("click", () => {
      if (fachada.style.display !== "none") {
        fachada.style.display = "none";
        mapa.style.display = "block";
        btn.textContent = "Ver imagem";
      } else {
        fachada.style.display = "block";
        mapa.style.display = "none";
        btn.textContent = "Encontre-nos";
      }
    });
  });
</script>

</body>
</html>
