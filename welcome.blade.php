<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>OUMISHOP - Collection Exclusive</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;600;700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            .luxury-header {
                background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
                color: #d4af37;
                padding: 2rem 0;
                text-align: center;
                border-bottom: 3px solid #d4af37;
            }
            
            .luxury-title {
                font-family: 'Playfair Display', serif;
                font-size: 2.5rem;
                font-weight: 300;
                letter-spacing: 2px;
                margin-bottom: 0.5rem;
            }
            
            .luxury-subtitle {
                font-family: 'Montserrat', sans-serif;
                font-size: 1rem;
                color: #f5f5f5;
                letter-spacing: 1px;
            }

            .auth-buttons {
                position: absolute;
                top: 1rem;
                right: 2rem;
                display: flex;
                gap: 1rem;
            }

            .btn-auth {
                background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%);
                border: none;
                color: white;
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
                padding: 0.75rem 1.5rem;
                border-radius: 25px;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 1px;
                text-decoration: none;
                display: inline-block;
            }
            
            .btn-auth:hover {
                background: linear-gradient(135deg, #b8941f 0%, #d4af37 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
                color: white;
                text-decoration: none;
            }

            .btn-auth-secondary {
                background: transparent;
                border: 2px solid #d4af37;
                color: #d4af37;
            }

            .btn-auth-secondary:hover {
                background: #d4af37;
                color: white;
            }
            
            .product-card {
                background: white;
                border: 1px solid #e5e5e5;
                border-radius: 12px;
                overflow: hidden;
                transition: all 0.3s ease;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.15);
                border-color: #d4af37;
            }
            
            .product-image {
                width: 100%;
                height: 250px;
                object-fit: cover;
                transition: transform 0.3s ease;
            }
            
            .product-card:hover .product-image {
                transform: scale(1.05);
            }
            
            .product-info {
                padding: 1.5rem;
                overflow: hidden;
            }
            
            .product-name {
                font-family: 'Playfair Display', serif;
                font-size: 1.25rem;
                font-weight: 600;
                color: #1a1a1a;
                margin-bottom: 0.5rem;
                line-height: 1.3;
            }
            
            .product-price {
                font-family: 'Montserrat', sans-serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: #d4af37;
                margin-bottom: 0.5rem;
            }
            
            .product-stock {
                font-family: 'Montserrat', sans-serif;
                font-size: 0.875rem;
                color: #666;
                margin-bottom: 1rem;
            }
            
            .btn-luxury {
                background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%);
                border: none;
                color: white;
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
                padding: 0.5rem 1rem;
                border-radius: 25px;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-size: 0.75rem;
                text-decoration: none;
                display: inline-block;
                width: 100%;
                text-align: center;
            }
            
            .btn-luxury:hover {
                background: linear-gradient(135deg, #b8941f 0%, #d4af37 100%);
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
                color: white;
                text-decoration: none;
            }
            
            .photo-indicator {
                position: absolute;
                top: 10px;
                right: 10px;
                background: rgba(212, 175, 55, 0.9);
                color: white;
                padding: 0.25rem 0.5rem;
                border-radius: 15px;
                font-size: 0.75rem;
                font-weight: 600;
            }
            
            .image-container {
                position: relative;
                overflow: hidden;
            }

            .login-notice {
                background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);
                border: none;
                color: white;
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1rem;
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
                text-align: center;
            }
            
            .pagination-luxury .page-link {
                color: #d4af37;
                border-color: #d4af37;
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
            }
            
            .pagination-luxury .page-item.active .page-link {
                background-color: #d4af37;
                border-color: #d4af37;
                color: white;
            }
            
            .pagination-luxury .page-link:hover {
                background-color: #d4af37;
                border-color: #d4af37;
                color: white;
            }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <div class="luxury-header">
            <div class="auth-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboardClient') }}" class="btn-auth">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-auth btn-auth-secondary">Se connecter</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-auth">S'inscrire</a>
                        @endif
                    @endauth
                @endif
            </div>
            <div class="container">
                <h1 class="luxury-title">OUMISHOP COLLECTION</h1>
                <p class="luxury-subtitle">Exclusive Designer Handbags & Accessories</p>
            </div>
        </div>

        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if(!auth()->check())
                    <div class="login-notice">
                        🔐 Connectez-vous pour ajouter des produits à votre panier et passer des commandes
                    </div>
                @endif

                {{-- Récupération des produits directement dans la vue --}}
                @php
                    $products = App\Models\products::orderBy('created_at', 'desc')->paginate(12);
                @endphp

                {{-- Affichage des produits --}}
                <div class="mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <div class="product-card">
                                <div class="image-container">
                                    @if($product->photos->count() > 0)
                                        <img src="{{ asset('storage/' . $product->photos->first()->photo) }}"
                                             alt="{{ $product->nom }}"
                                             class="product-image cursor-pointer"
                                             onclick="openGallery({{ $product->id }}, 0)">
                                        
                                        @if($product->photos->count() > 1)
                                            <div class="photo-indicator">
                                                {{ $product->photos->count() }} photos
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                                            <span class="text-gray-400 text-sm">Aucune photo</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="product-info">
                                    <h3 class="product-name">{{ $product->nom }}</h3>
                                    <p class="product-price">{{ number_format($product->prix) }} FCFA</p>
                                    <p class="product-stock">En stock: {{ $product->stock }} unités</p>
                                    
                                    @auth
                                        <a href="{{ route('cart.add') }}?product_id={{ $product->id }}&quantity=1" 
                                           class="btn-luxury" 
                                           onclick="return confirm('Ajouter ce produit au panier ?')">
                                            Ajouter au panier
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn-luxury">
                                            Se connecter pour acheter
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($products->hasPages())
                        <div class="mt-8 flex justify-center">
                            <nav class="pagination-luxury">
                                {{ $products->links() }}
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Galerie modale --}}
        <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 hidden">
            <div class="relative bg-white rounded-lg p-4 max-w-4xl w-full mx-4">
                <button onclick="closeGallery()" class="absolute top-4 right-4 text-gray-700 text-3xl hover:text-gray-900">&times;</button>
                
                <div class="flex items-center justify-center">
                    <button onclick="prevImage()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 mr-4">
                        &larr; Précédent
                    </button>
                    
                    <img id="galleryImage" src="" alt="" class="max-w-full max-h-96 object-contain rounded">
                    
                    <button onclick="nextImage()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 ml-4">
                        Suivant &rarr;
                    </button>
                </div>
                
                <div class="text-center mt-4">
                    <span id="galleryCaption" class="font-semibold text-lg"></span>
                    <div class="text-sm text-gray-600 mt-2">
                        <span id="imageCounter"></span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Stocke les photos de chaque produit
            let galleries = @json($products->mapWithKeys(fn($p) => [$p->id => $p->photos->pluck('photo')]));
            let currentGallery = [];
            let currentIndex = 0;

            function openGallery(productId, index) {
                currentGallery = galleries[productId];
                currentIndex = index;
                showImage();
                document.getElementById('galleryModal').classList.remove('hidden');
            }

            function closeGallery() {
                document.getElementById('galleryModal').classList.add('hidden');
            }

            function showImage() {
                const img = document.getElementById('galleryImage');
                const caption = document.getElementById('galleryCaption');
                const counter = document.getElementById('imageCounter');
                
                img.src = '/storage/' + currentGallery[currentIndex];
                caption.textContent = `Photo ${currentIndex + 1} sur ${currentGallery.length}`;
                counter.textContent = `${currentIndex + 1} / ${currentGallery.length}`;
            }

            function prevImage() {
                currentIndex = (currentIndex - 1 + currentGallery.length) % currentGallery.length;
                showImage();
            }

            function nextImage() {
                currentIndex = (currentIndex + 1) % currentGallery.length;
                showImage();
            }

            // Fermer la galerie avec la touche Échap
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeGallery();
                }
            });
        </script>
    </body>
</html>
