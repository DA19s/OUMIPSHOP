{{-- resources/views/vart/index.blade.php --}}
<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                    
                    <h2 class="text-2xl font-bold mb-4">🛒 Commandes</h2>

                    @if($varts->isEmpty())
                        <p class="text-gray-500">Vous n'avez aucune commande en cours.</p>
                    @else
                        @foreach($varts as $vart)
                            <div class="border rounded-lg p-6 mb-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">Commande #{{ $vart->id }}</h3>
                                    <div class="flex space-x-2">
                                    <span class="status-display 
                                        @if($vart->status === 'EN COURS') status-encours
                                        @elseif($vart->status === 'PAYÉ') status-paye
                                        @elseif($vart->status === 'LIVRÉ') status-livre
                                        @else status-encours
                                        @endif">
                                        {{ $vart->status }}
                                    </span>        
                                        <form action="{{ route('vart.cancel', $vart->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?')">
                                                ❌ Annuler
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    @foreach($vart->items as $item)
                                        <div class="flex items-center justify-between p-4 border rounded-lg">
                                            <div class="flex items-center space-x-4">
                                                <div>
                                                    <h4 class="font-semibold">{{ $item['name'] }}</h4>
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
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <div class="border-t pt-4">
                                        <div class="flex justify-between items-center">
                                            <h3 class="text-xl font-bold">Total de la commande</h3>
                                            <p class="text-2xl font-bold text-green-600">{{ number_format($vart->total) }} FCFA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
<style>
    /* Badge de statut avec les mêmes couleurs - FORCÉES */
    .status-display {
        display: inline-block !important;
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-weight: bold !important;
        font-size: 0.875rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin-right: 10px !important;
        border: 2px solid !important;
    }

    .status-display.status-encours {
        background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%) !important;
        color: white !important;
        border-color: #ff6b35 !important;
    }

    .status-display.status-paye {
        background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%) !important;
        color: white !important;
        border-color: #00d4aa !important;
    }

    .status-display.status-livre {
        background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%) !important;
        color: white !important;
        border-color: #6c5ce7 !important;
    }

    /* Style pour les messages de succès et d'erreur */
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

