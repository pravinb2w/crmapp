<nav class="navbar navbar-expand-lg p-0 bg-dark-50 sticky-top w-100" id="top-navbar-animated">
    <div class="container">
        <!-- logo -->
        <a href="#contact-us" class="navbar-brand me-lg-5 ">
            <img src="{{ $result->page_logo }}" alt="{{ $result->page_title }}" class="logo-dark"
                height="60" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="mdi text-white mdi-menu" style="text-shadow: 0 2px black;"></i>
        </button>

        <!-- menus -->
        @include('front.customer.layout.menu')
    </div>
</nav>