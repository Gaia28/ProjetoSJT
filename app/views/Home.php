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
    <h1>Bem-Vindo à Paróquia Santuário São Judas Tadeu</h1>
    <img id="SaoJudas" src="public/assets/images/padroeiro.jpeg" alt="Imagem de São Judas Tadeu">
  </section>

  <?php include 'NavBar.php'; ?>

  <!-- Sobre a paróquia -->
  <section id="HomePG2" class="section-padrao">
    <div class="linha"> 

     
    <div class="itens-esquerda">
        <h1>Paróquia Santuário São Judas Tadeu</h1>
        <button id="mostrarMapa" class="btn">Encontre-nos</button>
      <div class="links-sociais">
        <img src="public/assets/images/whatsapp.png" alt="whatsapp">
        <img src="public/assets/images/facebook.png" alt="facebook">
        <img src="public/assets/images/instagram.png" alt="instagram">
      </div>
       
        </div>
      <img class="img" id="fachada" src="public/assets/images/fachada.jpeg" alt="Fachada da igreja">
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

  <!-- Sobre nós -->
  <section id="HomePG5" class="section-padrao">
    <div class="linha">
      <h1>Sobre nós</h1>
      <img class="img" src="public/assets/images/cristo.jpeg" alt="Imagem de Cristo">
      <p>A paróquia- santuário São Judas Tadeu, localizada no bairro da Condor, o santo conhecido
como padroeiro das causas impossíveis e desesperadas é também o padroeiro do
funcionário público. Em 6 de janeiro de 2026, a Paróquia-Santuário celebrará seu jubileu de
70 anos de fundação. </p>
    </div> 
  </section>

</main>
    <script src="public/assets/js/navegacao.js"></script>
</body>
</html>
