{{-- resources/views/cart/index.blade.php --}}
<x-guest-layout>
                @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">🛒 Mon Panier</h2>

                    @if(empty($cart->items))
                        <p class="text-gray-500">Votre panier est vide.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($cart->items as $item)
                                <div class="flex items-center justify-between p-4 border rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <h3 class="font-semibold">{{ $item['name'] }}</h3>
                                            <p class="text-gray-600">Prix unitaire: {{ number_format($item['price']) }} FCFA</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-4">
                                        <div class="text-center">
                                            <p class="font-semibold">Quantité</p>
                                            <p>{{ $item['quantity'] }}</p>
                                        </div>
                                        
                                        <div class="text-center">
                                            <p class="font-semibold">Total</p>
                                            <p class="text-green-600 font-bold">{{ number_format($item['total']) }} FCFA</p>
                                        </div>
                                        
                                        <form method="POST" action="{{ route('cart.remove') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                🗑️ Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-xl font-bold">Total du panier</h3>
                                    <p class="text-2xl font-bold text-green-600">{{ number_format($cart->total) }} FCFA</p>
                                </div>
                                
                                <div class="flex space-x-4 mt-4">
                                    <form method="POST" action="{{ route('cart.validate') }}">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                            Valider le panier
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('cart.clear') }}">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                            Vider le panier
                                        </button>
                                    </form>
                                    

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
<style>
    .success-message {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
    }
    
    .error-message {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        border: none;
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
    }
    </style>
</x-guest-layout>

