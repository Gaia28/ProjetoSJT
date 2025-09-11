const btAdcionarEvento = document.getElementById('adicionarEvento');
const modal = document.getElementById('modalEvento');
const btFecharModal = document.getElementById('fecharModal');


function abrirModal() {
    btAdcionarEvento.addEventListener('click', ()=>{
    modal.showModal();
});
}
abrirModal();
function fecharModal() {
    btFecharModal.addEventListener('click', ()=>{
    modal.close();
});
}
fecharModal();