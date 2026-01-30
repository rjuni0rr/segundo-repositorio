@include('users.modals.change_pw_modal')

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            Meu Sistema
        </a>

        <div class="d-flex align-items-center">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="user" width="32" height="32" class="rounded-circle me-2">
                    <span class="fw-semibold">
                        {{ auth()->user()->name }}
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser">
                    <li>
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            Alterar senha
                        </button>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a href="{{ route('logout') }}" class="dropdown-item text-danger">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

