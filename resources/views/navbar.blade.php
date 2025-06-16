<nav class="layout-navbar bg-light shadow-none py-0">
    <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-sm align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End-->

                <a href="/" class="navbar-brand">
                    <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">Todo App</span>
                </a>
            </div>
            <!-- Menu logo wrapper: End -->

            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto">
                    <x-navbar.item to="home">Home</x-navbar.item>

                    @guest
                        <x-navbar.item to="register.create">Register</x-navbar.item>
                        <x-navbar.item to="login.create">Login</x-navbar.item>
                    @endguest
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->

            <!-- Toolbar: Start -->
            @auth
                <ul class="navbar-nav flex-row ms-auto">
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                           data-bs-toggle="dropdown">
                            Hello, {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                            <li>
                                <form method="POST" action="{{route('logout')}}">
                                    @csrf

                                    <button type="submit" class="dropdown-item" data-theme="light">
                                        <span class="align-middle">
                                            <i class='ti ti-logout me-2'></i>
                                            Logout
                                        </span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth
            <!-- Toolbar: End -->
        </div>
    </div>
</nav>
