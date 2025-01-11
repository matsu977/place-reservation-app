<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/bunchi-logo.png') }}" 
                alt="バンチカンリ" 
                style="max-height: 40px; width: auto;"
                class="me-2">
        </a>

        <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvas">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title">メニュー</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link px-3 text-gray-600 hover:text-gray-900" href="{{ route('guide') }}">
                        <i class="bi bi-book me-1"></i>
                        使い方
                    </a>
                    <a class="nav-link px-3 text-gray-600 hover:text-gray-900" href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        ログアウト
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>