<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/assets/css/Home.css"> 
    <link rel="stylesheet" href="public/assets/css/HomeResponsivo.css"> 
      <link rel="stylesheet" href="public/assets/css/base.css"> 
          <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>
<main id="Home">

  <!-- Seção de boas-vindas -->
  <section id="BoasVindas" class="section-padrao section-full">
   <!-- <h1>Bem-Vindo à Paróquia Santuário <br>São Judas Tadeu</h1>-->
    <img id="SaoJudas" src="public/assets/images/padroeiro.jpeg" alt="Imagem de São Judas Tadeu">
    <svg class="onda" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#ffffff" fill-opacity="1" d="M0,96L120,133.3C240,171,480,245,720,250.7C960,256,1200,192,1320,160L1440,128L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
    </svg>
    <svg class="onda" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#ffffff" fill-opacity="0.5" d="M0,128L40,128C80,128,160,128,240,149.3C320,171,400,213,480,229.3C560,245,640,235,720,208C800,181,880,139,960,117.3C1040,96,1120,96,1200,106.7C1280,117,1360,139,1400,149.3L1440,160L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
</svg>
  </section>
  <!-- Barra de navegação -->

  <?php include 'NavBar.php'; ?>

  <!-- Sobre a paróquia -->
  <section id="HomePG2" class="section-padrao">
    <div class="linha"> 
    <div class="itens-esquerda">
        <h1 class="tracking-in-expand-fwd-bottom">Paróquia Santuário São Judas Tadeu</h1>
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
         <h1 class="tracking-in-expand-fwd-bottom">Sobre nós</h1>
      <p class="tracking-in-expand-fwd-bottom">A paróquia- santuário São Judas Tadeu, localizada no bairro da Condor, o santo conhecido
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
      <h1 class="tracking-in-expand-fwd-bottom">Transmissões</h1>
      <p class="tracking-in-expand-fwd-bottom">Acompanhe-nos ao vivo no YouTube</p>
<iframe id="video" src="https://www.youtube.com/embed/WrllCjOtjCM?si=VNgiuDFX0Di9z7-q" 
    title="YouTube video player" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>    
</div>  
  </section>

  <!-- Programação -->
  <section id="HomePG4" class="section-padrao">
    <div class="linha">  
        <img class="icon" src="public/assets/images/calendario.png" alt="Calendário">
        <h1 class="tracking-in-expand-fwd-bottom">Calendário Paroquial</h1>
        <p class="tracking-in-expand-fwd-bottom">Participe de nossas celebrações e fortaleça sua fé em comunidade</p>

        <?php
        if (!empty($eventos)) {
            $diasDaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
            $programacaoPorDia = array_fill_keys($diasDaSemana, []);
            foreach ($eventos as $evento) {
                $dia = $evento['dia_semana'];
                if (array_key_exists($dia, $programacaoPorDia)) {
                    $programacaoPorDia[$dia][] = $evento;
                }
            }
        }
        ?>

        <div class="calendario-semanal-container">
            <?php if (!empty($programacaoPorDia)): ?>
                <div class="calendario-grid">
                    
                    <?php foreach ($programacaoPorDia as $dia => $eventosDoDia): ?>
                        <div class="dia-coluna">
                            <div class="dia-header"><?= $dia ?></div>
                            
                            <?php if (!empty($eventosDoDia)): ?>
                                <?php foreach ($eventosDoDia as $item): ?>
                                    <div class="evento-item">
                                        <span class="horario"><?= htmlspecialchars(date('H:i', strtotime($item['horario']))) ?></span>
                                        <p class="titulo"><?= htmlspecialchars($item['titulo']) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="sem-eventos">-</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php else: ?>
                <p class="tracking-in-expand-fwd-bottom">Nenhuma programação cadastrada no momento.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

 </section>

  <section id="HomeEventos" class="section-padrao animate-on-scroll">
    <div class="linha">
        <img class="icon" src="public/assets/images/calendario.png" alt="Eventos">
        <h1 style='font-size: 3rem;'>Próximos Eventos</h1>
        <p style='font-size: 1.3rem;'>Fique por dentro das festas, retiros e celebrações especiais da nossa comunidade.</p>

        <?php if (!empty($proximosEventos)): ?>
            <div class="eventos-home-grid">
                <?php foreach ($proximosEventos as $evento): ?>
                    <div class="evento-card-home">
                        <div class="evento-card-home-img-container">
                            <?php if (!empty($evento['imagem'])): ?>
                                <img class="evento-card-home-img" src="data:image/jpeg;base64,<?= base64_encode($evento['imagem']) ?>" alt="<?= htmlspecialchars($evento['nome']) ?>">
                            <?php endif; ?>

                            <div class="evento-card-home-data">
                                <span class="dia"><?= date('d', strtotime($evento['data_evento'])) ?></span>
                                <span class="mes"><?= date('M', strtotime($evento['data_evento'])) ?></span>
                            </div>
                        </div>
                        <div class="evento-card-home-body">
                            <h3><?= htmlspecialchars($evento['nome']) ?></h3>
                            <p class="local"><?= htmlspecialchars($evento['local']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Nenhum evento especial agendado para os próximos dias.</p>
        <?php endif; ?>
    </div>
  </section>


<section id="HomePG6" class="section-padrao animate-on-scroll">
    <div class="linha">
        <img class="icon" src="public/assets/images/livro.png" alt="Liturgia">
        <h1>Liturgia Diária</h1>

        <?php if (!empty($liturgiaDiaria) && !isset($liturgiaDiaria['error'])): ?>
            <div class="liturgia-moderna-container">
                <div class="liturgia-header">
                    <h2><?= htmlspecialchars($liturgiaDiaria['data']) ?></h2>
                    <p>
                        <?= htmlspecialchars($liturgiaDiaria['liturgia']) ?>
                        <span class="liturgia-cor" style="background-color: <?= strtolower(htmlspecialchars($liturgiaDiaria['cor'])) ?>;"></span>
                    </p>
                </div>

                <div class="leituras-accordion">
                    <div class="leitura-item">
                        <div class="leitura-header">
                            <div>
                                <h3><?= htmlspecialchars($liturgiaDiaria['primeiraLeitura']['titulo']) ?></h3>
                                <span class="ref"><?= htmlspecialchars($liturgiaDiaria['primeiraLeitura']['referencia']) ?></span>
                            </div>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="leitura-conteudo">
                            <p><?= nl2br(htmlspecialchars($liturgiaDiaria['primeiraLeitura']['texto'])) ?></p>
                        </div>
                    </div>

                    <div class="leitura-item">
                        <div class="leitura-header">
                             <div>
                                <h3>Salmo Responsorial</h3>
                                <?php if (isset($liturgiaDiaria['salmo']['ref'])): ?>
                                    <span class="ref"><?= htmlspecialchars($liturgiaDiaria['salmo']['referencia']) ?></span>
                                <?php endif; ?>
                            </div>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="leitura-conteudo">
                            <p class="refrao">R. <?= htmlspecialchars($liturgiaDiaria['salmo']['refrao']) ?></p>
                            <p><?= nl2br(htmlspecialchars($liturgiaDiaria['salmo']['texto'])) ?></p>
                        </div>
                    </div>

                    <div class="leitura-item">
                        <div class="leitura-header">
                             <div>
                                <h3><?= htmlspecialchars($liturgiaDiaria['evangelho']['titulo']) ?></h3>
                                <span class="ref"><?= htmlspecialchars($liturgiaDiaria['evangelho']['referencia']) ?></span>
                            </div>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="leitura-conteudo">
                            <p><?= nl2br(htmlspecialchars($liturgiaDiaria['evangelho']['texto'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>Não foi possível carregar a liturgia de hoje. Tente novamente mais tarde.</p>
        <?php endif; ?>
    </div>
</section>

 <section class="section-padrao qrcode-section">
  <div class="linha qrcode-linha" id="doacoes">
    <div class="qrcode-texto">
      <h1 class="tracking-in-expand-fwd-bottom">Contribua com a Paróquia</h1>
      <p class="tracking-in-expand-fwd-bottom">A doação para a igreja é um ato de fé e gratidão que permite à instituição cumprir sua missão de evangelização, sustentação das atividades e apoio aos necessitados. Essa generosidade possibilita a manutenção das estruturas da igreja, a promoção de programas sociais e educacionais, e o alcance de mais pessoas com a mensagem de Cristo.</p>
      <p class="tracking-in-expand-fwd-bottom">Escaneie o QR Code e contribua para a obra do</p>
    </div>
    <div class="qrcode-container">
          <div class="qrcode-img">
      <img id="qrcode" src="public/assets/images/QRcode.png" alt="QR Code de doação">
    </div>
    <p class="tracking-in-expand-fwd-bottom">Paróquia São Judas Tádeu</p>
    <p class="tracking-in-expand-fwd-bottom">chave pix</p>
  </div>
    </div>
</section>

    <?php include 'Footer.php'; // ADICIONAR ESTA LINHA ?>
</main>

<script src="public/assets/js/navegacao.js"></script>
<script src="public/assets/js/navbar.js"></script>
<script src="public/assets/js/animations.js"></script>
<script>
</script>
 <script>
  document.addEventListener("DOMContentLoaded", () => {
    // --- LÓGICA DO ACCORDION DA LITURGIA ---
    const accordionItems = document.querySelectorAll('.leitura-item');
    accordionItems.forEach(item => {
        const header = item.querySelector('.leitura-header');
        header.addEventListener('click', () => {
            // Fecha outros itens abertos
            accordionItems.forEach(otherItem => {
                if (otherItem !== item) otherItem.classList.remove('is-active');
            });
            // Alterna o item clicado
            item.classList.toggle('is-active');
        });
    });

    // --- LÓGICA DO BOTÃO "ENCONTRE-NOS" (MAPA) ---
    const btnMapa = document.getElementById("mostrarMapa");
    const fachada = document.getElementById("fachada");
    if (btnMapa && fachada) {
        const mapa = document.createElement("iframe");
        mapa.src = 
      "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4968436772488!2d-48.4782222242187!3d-1.4746970358627465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x92a48de08c562ba7%3A0xa88030050447e38d!2sPar%C3%B3quia%20Santu%C3%A1rio%20S%C3%A3o%20Judas%20Tadeu!5e0!3m2!1spt-BR!2sbr!4v1758669193062!5m2!1spt-BR!2sbr",
        mapa.width = "100%";
        mapa.height = "450";
        mapa.style.border = "0";
        mapa.style.display = "none";
        mapa.loading = "lazy";
        mapa.allowFullscreen = true;
        mapa.classList.add('img');
        fachada.insertAdjacentElement("afterend", mapa);
        btnMapa.addEventListener("click", () => {
            if (fachada.style.display !== "none") {
                fachada.classList.add("scale-out-horizontal");
                setTimeout(() => {
                    fachada.style.display = "none";
                    mapa.style.display = "block";
                    btnMapa.textContent = "Ver Imagem";
                    fachada.classList.remove("scale-out-horizontal");
                }, 500);
            } else {
                mapa.classList.add("scale-out-horizontalmap");
                setTimeout(() => {
                    mapa.style.display = "none";
                    fachada.style.display = "block";
                    btnMapa.textContent = "Encontre-nos";
                    mapa.classList.remove("scale-out-horizontalmap");
                }, 500);
            }
        });
    }
  });
</script>

</body>
</html>