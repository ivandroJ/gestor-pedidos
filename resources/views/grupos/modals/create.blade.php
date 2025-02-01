<form action="/grupos" method="POST" onsubmit="return confirm('Tem certeza?')">
    @csrf
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 {{ old('nome') ? '' : 'hidden' }} flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/3 lg:w-1/2 p-6">
            <!-- Cabeçalho do Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Novo Grupo</h2>
                <button type="button" id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>


            <div class="mb-4">
                <x-input-text id="nome" name="nome" type="text" title="Nome"
                    placeholder="Insira o nome do Grupo" value="{{ old('nome') }}"></x-input-text>
            </div>

            <div class="mb-4">
                <x-input-text id="saldoPermitido" name="saldoPermitido" type="number" title="Saldo Permitido"
                    placeholder="Insira o saldo permitido" value="{{ old('saldoPermitido') }}"></x-input-text>
            </div>


            <!-- Corpo do Modal -->


            <!-- Rodapé do Modal -->
            <div class="flex justify-end">
                <button id="cancelModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">
                    Cancelar
                </button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Salvar
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Script para controlar o Modal -->
<script>
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');
    const cancelModalButton = document.getElementById('cancelModal');
    const modal = document.getElementById('modal');



    // Abrir o modal
    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Fechar o modal (com o botão de fechar)
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Fechar o modal (com o botão de cancelar)
    cancelModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Fechar o modal ao clicar fora dele
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
