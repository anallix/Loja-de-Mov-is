const darkModeToggle = document.getElementById('dark-mode-toggle');
const body = document.body;

darkModeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode'); // Alternar classe para ativar ou desativar o modo escuro
});


//Função para abrir ou fechar o modal do carrinho
function abrirOuFecharCarrinho() {
    const carrinho = document.getElementById('carrinho-lateral');
    carrinho.classList.toggle('aberto');
}
//Função para remover itens do carrinho
function removerItemCarrinho(elemento) {
    const itemRemovido = elemento.parentElement;
    const precoItem = parseFloat(itemRemovido.dataset.preco);
    itemRemovido.remove();
    atualizarTotalCarrinho(-precoItem);
    atualizarQuantidadeCarrinho();
}
//Função para adicionar itens ao carrinho
function adicionarAoCarrinho(nome, preco, idQuantidade) {
    const quantidade = document.getElementById(idQuantidade).value;
    const carrinho = document.getElementById('carrinho-lateral-lista');
    for (let i = 0; i < quantidade; i++) {
        const novoItem = document.createElement('li');
        novoItem.textContent = `${nome} - R$ ${preco.toFixed(2)}`;
        novoItem.dataset.preco = preco;
        const botaoRemover = document.createElement('button');
        botaoRemover.innerHTML = '&times;'; // Ícone de X para remover
        botaoRemover.classList.add('remover-item');
        botaoRemover.onclick = function() {
            removerItemCarrinho(this);
        };
        novoItem.appendChild(botaoRemover);
        carrinho.appendChild(novoItem);
    }
    atualizarTotalCarrinho(preco * quantidade);
    atualizarQuantidadeCarrinho();
}
//Função para atualizar o valor dos itens do carrinho
function atualizarTotalCarrinho(preco) {
    const totalCarrinhoLateral = document.getElementById('total-carrinho-lateral');
    let total = parseFloat(totalCarrinhoLateral.textContent.replace('Total: R$ ', ''));
    if (isNaN(total)) {
        total = 0;
    }
    total += preco;
    totalCarrinhoLateral.textContent = `Total: R$ ${total.toFixed(2)}`;
}
//Função para atualizar a quantidade de itens do carrinho
function atualizarQuantidadeCarrinho() {
    const quantidade = document.querySelectorAll('#carrinho-lateral-lista li').length;
    const carrinhoIcon = document.getElementById('carrinho-icon');
    carrinhoIcon.textContent = quantidade;
}
//Função plus para a quantidade de itens
function incrementarQuantidade(idInput) {
    const input = document.getElementById(idInput);
    input.value = parseInt(input.value) + 1;
}
//Função de minus para a quantidade de itens
function decrementarQuantidade(idInput) {
    const input = document.getElementById(idInput);
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
//Função para limpar os itens do carrinho
function limparCarrinho() {
    const carrinhoLista = document.getElementById('carrinho-lateral-lista');
    carrinhoLista.innerHTML = ''; // Limpa todos os itens do carrinho
    document.getElementById('total-carrinho-lateral').textContent = 'Total: R$ 0,00'; // Reseta o total do carrinho      
    const carrinhoIcon = document.getElementById('carrinho-icon');
    carrinhoIcon.textContent = '0';
}
