<div class="row mb-3 align-items-center">
    <div class="col">
        <a href="{{ route('user.dashboard') }}">
            <img src="{{ asset('assets/images/arvore-de-natal.png') }}" alt="Natal" class="img-fluid" style="max-width: 60px;">
        </a>
    </div>
    <div class="col text-center">
        Então é <span class="text-warning">Natal!</span>
    </div>
    <div class="col">
        <div class="d-flex justify-content-end align-items-center">
            <span class="me-3">
                <i class="fa-solid fa-user-circle fa-lg text-secondary me-3"></i>{{ session('user.username') }}
            </span>
            <a href="{{ route('auth.logout') }}" class="btn btn-warning">
                Logout<i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
            </a>
        </div>
    </div>
</div>

<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.myProfile') }}">Meu Perfil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contatos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Presentes</a>
    </li>
</ul>
