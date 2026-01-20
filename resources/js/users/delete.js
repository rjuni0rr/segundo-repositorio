window.confirmDeleteUser = function (encryptedId, userName) {
    document.getElementById('d-name').textContent = userName;

    const form = document.getElementById('deleteUserForm');
    form.action = `/users/${encryptedId}`;

    const modal = new bootstrap.Modal(
        document.getElementById('deleteUserModal')
    );
    modal.show();
};
