<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle commande - OumiShop</title>
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
        .admin-name {
            color: #d4af37;
            font-weight: bold;
        }
        .client-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #d4af37;
        }
        .client-info h3 {
            color: #d4af37;
            margin-bottom: 15px;
        }
        .client-info p {
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
        .alert-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
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
                Bonjour <span class="admin-name">{{ $admin->name }}</span>,<br><br>
                
                🎉 Vous avez une nouvelle commande !
            </div>

            <div class="alert-box">
                <strong>⚠️ Nouvelle commande reçue</strong><br>
                Un client vient de valider son panier et a passé une commande.
            </div>

            <div class="client-info">
                <h3>👤 Informations du Client</h3>
                <p><strong>Nom :</strong> {{ $user->name }}</p>
                <p><strong>Email :</strong> {{ $user->email }}</p>
                @if(isset($user->numero))
                    <p><strong>Téléphone :</strong> {{ $user->numero }}</p>
                @endif
                <p><strong>Date de commande :</strong> {{ now()->format('d/m/Y H:i') }}</p>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <p style="color: #d4af37; font-weight: bold; font-size: 16px;">
                    📋 Connectez-vous à votre tableau de bord pour voir les détails de la commande
                </p>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="cta-button">
                    Accéder au tableau de bord
                </a>
            </div>
        </div>

        <div class="footer">
            <p>© 2024 OumiShop. Tous droits réservés.</p>
            <p style="font-size: 12px; color: #999;">
                Notification automatique - Nouvelle commande
            </p>
        </div>
    </div>
</body>
</html> 