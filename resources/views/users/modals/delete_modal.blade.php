<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar exclusão</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>
                    Tem certeza que deseja excluir o usuário
                    <strong id="d-name"></strong>?
                </p>
                <p class="text-danger mb-0">
                    Essa ação não poderá ser desfeita.
                </p>
            </div>

            <div class="modal-footer">
                <form id="deleteUserForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-danger">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
