<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture OumiShop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #ffffff;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 2px solid #d4af37;
            border-radius: 10px;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #d4af37;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        .client-info, .invoice-details {
            flex: 1;
        }
        .client-info h3, .invoice-details h3 {
            color: #d4af37;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .client-info p, .invoice-details p {
            margin: 5px 0;
            font-size: 14px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        .items-table th {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #d4af37;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        .items-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        .items-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total-section {
            margin-top: 30px;
            text-align: right;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 16px;
        }
        .total-final {
            font-size: 20px;
            font-weight: bold;
            color: #d4af37;
            border-top: 2px solid #d4af37;
            padding-top: 10px;
        }
        .footer {
            background-color: #1a1a1a;
            color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        .status-encours {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-paye {
            background-color: #d4edda;
            color: #155724;
        }
        .status-livre {
            background-color: #cce5ff;
            color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👜 OUMISHOP</h1>
            <p>Luxury Bags Collection</p>
            <p style="margin-top: 15px; font-size: 18px;">FACTURE</p>
        </div>
        
        <div class="content">
            <div class="invoice-info">
                <div class="client-info">
                    <h3>Informations Client</h3>
                    <p><strong>Nom :</strong> {{ $user->name }}</p>
                    <p><strong>Email :</strong> {{ $user->email }}</p>
                    @if(isset($user->numero))
                        <p><strong>Téléphone :</strong> {{ $user->numero }}</p>
                    @endif
                    <p><strong>Date de commande :</strong> {{ $vart->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="invoice-details">
                    <h3>Détails de la Facture</h3>
                    <p><strong>Numéro de commande :</strong> #{{ $vart->id }}</p>
                    <p><strong>Statut :</strong> 
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '', $vart->status)) }}">
                            {{ $vart->status }}
                        </span>
                    </p>
                    <p><strong>Date d'émission :</strong> {{ now()->format('d/m/Y') }}</p>
                </div>
            </div>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vart->items as $item)
                        <tr>
                            <td><strong>{{ $item['name'] }}</strong></td>
                            <td>{{ number_format($item['price']) }} FCFA</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td><strong>{{ number_format($item['total']) }} FCFA</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-section">
                <div class="total-row">
                    <span>Sous-total :</span>
                    <span>{{ number_format($vart->total) }} FCFA</span>
                </div>
                <div class="total-row">
                    <span>Frais de livraison :</span>
                    <span>0 FCFA</span>
                </div>
                <div class="total-row total-final">
                    <span>TOTAL :</span>
                    <span>{{ number_format($vart->total) }} FCFA</span>
                </div>
            </div>

            <div style="margin-top: 40px; padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
                <h3 style="color: #d4af37; margin-bottom: 15px;">Informations de Paiement</h3>
                <p><strong>Mode de paiement :</strong> {{ $vart->status == 'PAYÉ' ? 'Paiement effectué' : 'En attente de paiement' }}</p>
                @if($vart->status == 'PAYÉ')
                    <p><strong>Date de paiement :</strong> {{ $vart->updated_at->format('d/m/Y H:i') }}</p>
                @else
                    <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 8px; margin: 15px 0;">
                        <h4 style="color: #856404; margin-bottom: 10px;">💳 Paiement Wave</h4>
                        <p style="margin: 8px 0;"><strong>Méthode de paiement :</strong> Wave Money</p>
                        <p style="margin: 8px 0;"><strong>Numéro Wave :</strong> 
                            @php
                                $admin = App\Models\User::where('role', 'admin')->first();
                                echo $admin && isset($admin->numero) ? $admin->numero : 'Non configuré';
                            @endphp
                        </p>
                        <p style="margin: 8px 0;"><strong>Nom du destinataire :</strong> 
                            @php
                                echo $admin ? $admin->name : 'Admin OumiShop';
                            @endphp
                        </p>
                        <p style="margin: 8px 0; color: #856404; font-weight: bold;">
                            ⚠️ Veuillez effectuer le paiement et envoyer la preuve par email ou sur le compte instagram by_ammaja
                        </p>
                    </div>
                @endif
                <p><strong>Méthode de livraison :</strong> Livraison standard</p>
                <p><strong>Délai de livraison estimé :</strong> 3-5 jours ouvrables</p>
            </div>
        </div>

        <div class="footer">
            <p><strong>OumiShop - Luxury Bags Collection</strong></p>
            <p>Merci pour votre confiance !</p>
            <p style="font-size: 12px; color: #999; margin-top: 10px;">
                © 2024 OumiShop. Tous droits réservés.
            </p>
        </div>
    </div>
</body>
</html>