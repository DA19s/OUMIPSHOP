<style>
    .luxury-navbar {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-bottom: 3px solid #d4af37;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    
    .luxury-navbar .nav-logo {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: #d4af37;
        text-decoration: none;
        letter-spacing: 1px;
    }
    
    .luxury-navbar .nav-logo:hover {
        color: #f5f5f5;
        text-decoration: none;
    }
    
    .luxury-navbar .nav-link {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: #f5f5f5 !important;
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.875rem;
        position: relative;
    }
    
    .luxury-navbar .nav-link:hover {
        color: #d4af37 !important;
        background: rgba(212, 175, 55, 0.1);
        transform: translateY(-2px);
    }
    
    .luxury-navbar .nav-link.active {
        color: #d4af37 !important;
        background: rgba(212, 175, 55, 0.2);
        border: 1px solid #d4af37;
    }
    
    .luxury-navbar .user-dropdown {
        background: rgba(212, 175, 55, 0.1);
        border: 1px solid #d4af37;
        color: #f5f5f5;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.875rem;
    }
    
    .luxury-navbar .user-dropdown:hover {
        background: rgba(212, 175, 55, 0.2);
        color: #d4af37;
        transform: translateY(-2px);
    }
    
    .luxury-navbar .hamburger-btn {
        color: #d4af37;
        border: 1px solid #d4af37;
        border-radius: 8px;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .luxury-navbar .hamburger-btn:hover {
        background: rgba(212, 175, 55, 0.1);
        color: #f5f5f5;
    }
    
    .luxury-navbar .dropdown-menu {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border: 2px solid #d4af37;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        min-width: 200px;
    }
    
    .luxury-navbar .dropdown-item {
        color: #f5f5f5;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        display: block;
        text-decoration: none;
        width: 100%;
    }
    
    .luxury-navbar .dropdown-item:hover {
        background: rgba(212, 175, 55, 0.1);
        color: #d4af37;
        text-decoration: none;
    }
    
    .luxury-navbar .dropdown-item:last-child {
        border-bottom: none;
    }
    
    .luxury-navbar .mobile-menu {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-top: 2px solid #d4af37;
    }
    
    .luxury-navbar .mobile-nav-link {
        color: #f5f5f5;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        padding: 1rem;
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .luxury-navbar .mobile-nav-link:hover {
        background: rgba(212, 175, 55, 0.1);
        color: #d4af37;
    }
    
    .luxury-navbar .mobile-nav-link.active {
        background: rgba(212, 175, 55, 0.2);
        color: #d4af37;
        border-left: 3px solid #d4af37;
    }
    
    .luxury-navbar .user-info {
        background: rgba(212, 175, 55, 0.1);
        border-top: 2px solid #d4af37;
        padding: 1rem;
    }
    
    .luxury-navbar .user-name {
        color: #d4af37;
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .luxury-navbar .user-email {
        color: #f5f5f5;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.875rem;
    }
    
    .luxury-navbar .dropdown-menu.show {
        display: block !important;
        animation: fadeIn 0.3s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');
}

// Fermer le dropdown quand on clique ailleurs
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const button = event.target.closest('.user-dropdown');
    
    if (!button && dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
    }
});
</script>

<nav x-data="{ open: false }" class="luxury-navbar">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboardClient') }}" class="nav-logo">
                        👜 LUXURY BAGS
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:flex sm:items-center sm:ms-10">
                    <a href="{{ route('dashboardClient') }}" 
                       class="nav-link {{ request()->routeIs('dashboardClient') ? 'active' : '' }}">
                        {{ __('Collection') }}
                    </a>
                </div>

                <div class="hidden space-x-4 sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('cart.index') }}" 
                       class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}">
                        {{ __('Voir mon panier') }}
                    </a>
                </div>

                <div class="hidden space-x-4 sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('vart.index') }}" 
                       class="nav-link {{ request()->routeIs('vart.index') ? 'active' : '' }}">
                        {{ __('Suivre ma commande') }}
                    </a>
                </div>

                <div class="hidden space-x-4 sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('historiqueClient.index') }}" 
                       class="nav-link {{ request()->routeIs('historiqueClient.index') ? 'active' : '' }}">
                        {{ __('Historique') }}
                    </a>
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative">
                    <button onclick="toggleDropdown()" class="user-dropdown inline-flex items-center">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-2">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <div id="userDropdown" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg dropdown-menu z-50 hidden">
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                {{ __('Mon Profil') }}
                            </a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" 
                                   class="dropdown-item"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Déconnexion') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="hamburger-btn inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboardClient') }}" 
               class="mobile-nav-link {{ request()->routeIs('dashboardClient') ? 'active' : '' }}">
                {{ __('Collection') }}
            </a>
            
            <a href="{{ route('cart.index') }}" 
               class="mobile-nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}">
                {{ __('Voir mon panier') }}
            </a>
            
            <a href="{{ route('vart.index') }}" 
               class="mobile-nav-link {{ request()->routeIs('vart.index') ? 'active' : '' }}">
                {{ __('Suivre ma commande') }}
            </a>

            <a href="{{ route('historiqueClient.index') }}" 
               class="mobile-nav-link {{ request()->routeIs('historiqueClient.index') ? 'active' : '' }}">
                {{ __('Suivre ma commande') }}
            </a>

        </div>

        <!-- Responsive Settings Options -->
        <div class="user-info">
            <div class="px-4">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="mobile-nav-link">
                    {{ __('Mon Profil') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       class="mobile-nav-link"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Déconnexion') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
