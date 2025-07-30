{{-- resources/views/hstoriqueClient/index.blade.php --}}
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
                    
                    <h2 class="text-2xl font-bold mb-4">🛒 Historique des Commandes</h2>

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
                                                <span class="font-semibold text-gray-700">Statut:</span>
                                                <span class="px-3 py-1 rounded text-sm font-semibold 
                                                    @if($vart->status == 'EN COURS') bg-yellow-100 text-yellow-800
                                                    @elseif($vart->status == 'PAYÉ') bg-green-100 text-green-800
                                                    @elseif($vart->status == 'LIVRÉ') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ $vart->status }}
                                                </span>
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
    </style>
</x-guest-layout>