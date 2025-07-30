{{-- resources/views/order/index.blade.php --}}
<x-app-layout>
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

                    @if(empty($vart))
                        <p class="text-gray-500">Vous n'avez aucune commande.</p>
                    @else
                        <div class="space-y-6">
                            @foreach($vart as $vart)
                                <div class="border rounded-lg p-6 bg-gray-50">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h3 class="font-semibold text-lg">Client: {{ $vart->user->name }}</h3>
                                            <p class="text-gray-600">ID de la commande: {{ $vart->id }}</p>
                                            <div class="flex items-center space-x-4 mt-2">                                          
                                            <form method="POST" action="{{ route('order.update-status', $vart->id) }}" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="border border-gray-300 rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                        <option value="EN COURS" {{ $vart->status == 'EN COURS' ? 'selected' : '' }}>EN COURS</option>
                                                        <option value="PAYÉ" {{ $vart->status == 'PAYÉ' ? 'selected' : '' }}>PAYÉ</option>
                                                        <option value="LIVRÉ" {{ $vart->status == 'LIVRÉ' ? 'selected' : '' }}>LIVRÉ</option>
                                                    </select>
                                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition-colors">
                                                        Mettre à jour
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('order.historique', $vart->id) }}" class="flex items-center space-x-2">
                                                    @csrf
                                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition-colors">
                                                        Supprimer et envoyer vers l'historique
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-green-600">{{ number_format($vart->total) }} FCFA</p>
                                        </div>
                                    </div>
                                    
                                    @if(!empty($vart->items))
                                        <div class="space-y-3">
                                            <h4 class="font-semibold text-gray-700">Articles commandés :</h4>
                                            @foreach($vart->items as $item)
                                                <div class="flex items-center justify-between p-3 bg-white rounded border">
                                                    <div class="flex-1">
                                                        <h5 class="font-semibold">{{ $item['name'] }}</h5>
                                                        <p class="text-gray-600">Prix unitaire: {{ number_format($item['price']) }} FCFA</p>
                                                    </div>
                                                    <div class="flex items-center space-x-6">
                                                        <div class="text-center">
                                                            <p class="font-semibold text-sm text-gray-600">Quantité</p>
                                                            <p class="font-bold">{{ $item['quantity'] }}</p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="font-semibold text-sm text-gray-600">Total</p>
                                                            <p class="text-green-600 font-bold">{{ number_format($item['total']) }} FCFA</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 italic">Aucun article dans cette commande.</p>
                                    @endif
                                </div>
                            @endforeach
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

    /* Styles pour le select avec couleurs */
    select[name="status"].status-encours {
        background: #ff8c00 !important;
        color: white !important;
        border-color: #ff8c00 !important;
    }

    select[name="status"].status-paye {
        background: #28a745 !important;
        color: white !important;
        border-color: #28a745 !important;
    }

    select[name="status"].status-livre {
        background: #007bff !important;
        color: white !important;
        border-color: #007bff !important;
    }

    /* Style par défaut du select */
    select[name="status"] {
        background: white;
        border: 2px solid #d4af37;
        border-radius: 8px;
        padding: 8px 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 120px;
        color: #333;
    }

    select[name="status"]:focus {
        border-color: #b8941f;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        outline: none;
    }

    /* Animation hover pour le select */
    select[name="status"]:hover {
        border-color: #b8941f;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.2);
    }

    /* Badge de statut actuel visible */
    .status-display {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-right: 10px;
    }

    .status-encours {
        background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
        color: white;
        border: 2px solid #ff6b35;
    }

    .status-paye {
        background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
        color: white;
        border: 2px solid #00d4aa;
    }

    .status-livre {
        background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
        color: white;
        border: 2px solid #6c5ce7;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('select[name="status"]');
    
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            
            // Supprimer toutes les classes de couleur
            this.classList.remove('status-encours', 'status-paye', 'status-livre');
            
            // Ajouter la classe correspondante
            if (selectedValue === 'EN COURS') {
                this.classList.add('status-encours');
            } else if (selectedValue === 'PAYÉ') {
                this.classList.add('status-paye');
            } else if (selectedValue === 'LIVRÉ') {
                this.classList.add('status-livre');
            }
        });
        
        // Appliquer la couleur initiale
        const currentValue = statusSelect.value;
        if (currentValue === 'EN COURS') {
            statusSelect.classList.add('status-encours');
        } else if (currentValue === 'PAYÉ') {
            statusSelect.classList.add('status-paye');
        } else if (currentValue === 'LIVRÉ') {
            statusSelect.classList.add('status-livre');
        }
    }
});
</script>
</x-app-layout>