<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        {{-- Logo e nome --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('user.dashboard') }}">
            <img src="{{ asset('assets/images/arvore-de-natal.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
            <span class="web-site-name">HO HO HO</span>
        </a>

        {{-- Botão Hamburguer para telas pequenas --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Opções e perfil/logout --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Lista de opções centralizada em telas grandes --}}
            <ul class="navbar-nav mx-auto d-flex flex-column flex-lg-row align-items-center mb-5 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.myProfile', ['id' => session('user.id')]) }}">Meu Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.listContacts') }}">Contatos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Presentes</a>
                </li>
            </ul>

            {{-- Nome do Usuario e Logout --}}
            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center">
                <a href="{{ route('auth.logout') }}" class="btn btn-warning align-items-center mb-3 mb-lg-0">
                    Logout <i class="fa-solid fa-arrow-right-from-bracket ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
