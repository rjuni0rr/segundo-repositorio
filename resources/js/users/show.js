window.showUser = function (encryptedId) {
    fetch(`/users/${encryptedId}/show`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar usuário');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('m-name').textContent = data.name;
            document.getElementById('m-email').textContent = data.email;
            document.getElementById('m-phone').textContent = data.phone;
            document.getElementById('m-cpf').textContent = data.cpf ?? '-';
            document.getElementById('m-created').textContent = data.created_at;

            const modal = new bootstrap.Modal(
                document.getElementById('userModal')
            );
            modal.show();
        })
        .catch(() => {
            alert('Usuário inválido ou não encontrado');
        });
};
