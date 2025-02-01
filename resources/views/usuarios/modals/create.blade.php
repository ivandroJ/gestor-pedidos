
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 {{ old('nome') ? '' : 'hidden' }} flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/3 lg:w-1/2 p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Novo Usuário</h2>
                <button type="button" id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

           @livewire('usuarios.form-create-usuario')

        </div>
    </div>


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
