<nav class="navbar">
    <div class="container">
        <!-- Logo -->
        <div class="navbar-brand">
            <a href="/" class="brand-name">
                <span class="brand-my">My</span><span class="brand-cabook">Cabook</span>
            </a>
        </div>


        <!-- Menu Utama -->
        <div class="navbar-menu">
            <a href="/" class="nav-item">Home</a>
            <a href="/request-buku" class="nav-item">Request Buku</a>
            <a href="/about-us" class="nav-item">About Us</a>
            <a href="{{ route('contact') }}" class="nav-item">Contact</a>
        </div>

        <!-- Burger Menu (untuk mobile) -->
        <div class="burger-menu" id="burger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div class="mobile-menu" id="mobile-menu">
        <a href="/" class="mobile-item">Home</a>
        <a href="/request-buku" class="mobile-item">Request Buku</a>
        <a href="/about-us" class="mobile-item">About Us</a>
        <a href="/contact" class="mobile-item">Contact</a>
    </div>
</nav>
