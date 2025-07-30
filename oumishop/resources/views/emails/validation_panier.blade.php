<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue chez OumiShop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #d4af37;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 40px 30px;
        }
        .welcome-text {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .user-name {
            color: #d4af37;
            font-weight: bold;
        }
        .invoice-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #d4af37;
        }
        .invoice-details h3 {
            color: #d4af37;
            margin-bottom: 15px;
        }
        .invoice-details p {
            margin: 8px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #d4af37 0%, #b8941f 100%);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            margin: 20px 0;
        }
        .footer {
            background-color: #1a1a1a;
            color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .items-summary {
            margin: 20px 0;
            padding: 15px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .items-summary h4 {
            color: #d4af37;
            margin-bottom: 10px;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .item-row:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👜 OUMISHOP</h1>
            <p>Luxury Bags Collection</p>
        </div>
        
        <div class="content">
            <div class="welcome-text">
                Bonjour <span class="user-name">{{ $user->name }}</span>,<br><br>
                
                Votre commande a été validée avec succès !
                Voici un récapitulatif de votre commande :
            </div>

            <div class="invoice-details">
                <h3>📋 Détails de la Commande</h3>
                @if(isset($vart))
                    <p><strong>Numéro de commande :</strong> #{{ $vart->id }}</p>
                    <p><strong>Date de commande :</strong> {{ $vart->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Statut :</strong> {{ $vart->status }}</p>
                    <p><strong>Total :</strong> {{ number_format($vart->total) }} FCFA</p>
                @else
                    <p><strong>Commande en cours de traitement...</strong></p>
                @endif
            </div>

            <div class="items-summary">
                <h4>🛍️ Articles commandés :</h4>
                @if(isset($vart) && !empty($vart->items))
                    @foreach($vart->items as $item)
                        <div class="item-row">
                            <span><strong>{{ $item['name'] }}</strong> (x{{ $item['quantity'] }})</span>
                            <span>{{ number_format($item['total']) }} FCFA</span>
                        </div>
                    @endforeach
                @else
                    <p style="color: #666; font-style: italic;">Détails en cours de chargement...</p>
                @endif
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <p style="color: #d4af37; font-weight: bold; font-size: 16px;">
                    📎 Votre facture détaillée est jointe à cet email
                </p>
            </div>

            <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h4 style="color: #856404; margin-bottom: 15px;">💳 Informations de Paiement</h4>
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
                <p style="margin: 12px 0; color: #856404; font-weight: bold;">
                            ⚠️ Veuillez effectuer le paiement et envoyer la preuve par email ou sur le compte instagram by_ammaja
                </p>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="cta-button">
                    Accéder à mon compte
                </a>
            </div>
        </div>

        <div class="footer">
            <p>© 2024 OumiShop. Tous droits réservés.</p>
            <p style="font-size: 12px; color: #999;">
                Merci pour votre confiance !
            </p>
        </div>
    </div>
</body>
</html>