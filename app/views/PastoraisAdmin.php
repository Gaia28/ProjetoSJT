<form id="formPastoral" method="POST" action="salvar_pastoral.php">
  <!-- Nome da pastoral -->
  <label>Nome da Pastoral:</label>
  <input type="text" name="nome_pastoral" required>

  <!-- Coordenadores -->
  <div id="coordenadores">
    <label>Coordenador:</label>
    <input type="text" name="coordenadores[0][nome]" required>
    <input type="text" name="coordenadores[0][telefone]" placeholder="Telefone">
  </div>
  <button type="button" onclick="adicionarCoordenador()">+ Adicionar Coordenador</button>

  <!-- Encontros -->
  <div id="encontros">
    <label>Dia:</label>
    <select name="encontros[0][dia_semana]">
      <option value="">-- Selecione --</option>
      <option value="Domingo">Domingo</option>
      <option value="Segunda">Segunda</option>
      <option value="Terça">Terça</option>
      <option value="Quarta">Quarta</option>
      <option value="Quinta">Quinta</option>
      <option value="Sexta">Sexta</option>
      <option value="Sábado">Sábado</option>
    </select>
    <label>Horário:</label>
    <input type="time" name="encontros[0][horario]">
  </div>
  <button type="button" onclick="adicionarEncontro()">+ Adicionar Encontro</button>

  <br><br>
  <button type="submit">Salvar Pastoral</button>
</form>

<script>
let countCoord = 1;
let countEncontro = 1;

function adicionarCoordenador() {
  const div = document.getElementById("coordenadores");
  div.insertAdjacentHTML("beforeend", `
    <div>
      <label>Coordenador:</label>
      <input type="text" name="coordenadores[${countCoord}][nome]" required>
      <input type="text" name="coordenadores[${countCoord}][telefone]" placeholder="Telefone">
    </div>
  `);
  countCoord++;
}

function adicionarEncontro() {
  const div = document.getElementById("encontros");
  div.insertAdjacentHTML("beforeend", `
    <div>
      <label>Dia:</label>
      <select name="encontros[${countEncontro}][dia_semana]">
        <option value="">-- Selecione --</option>
        <option value="Domingo">Domingo</option>
        <option value="Segunda">Segunda</option>
        <option value="Terça">Terça</option>
        <option value="Quarta">Quarta</option>
        <option value="Quinta">Quinta</option>
        <option value="Sexta">Sexta</option>
        <option value="Sábado">Sábado</option>
      </select>
      <label>Horário:</label>
      <input type="time" name="encontros[${countEncontro}][horario]">
    </div>
  `);
  countEncontro++;
}
</script>
