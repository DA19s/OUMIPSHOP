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
                
                Nous sommes ravis de vous accueillir chez <strong>OumiShop</strong> ! 
                Votre compte a été créé avec succès et vous pouvez dès maintenant 
                accéder à notre collection exclusive de sacs de luxe.
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="cta-button">
                    Accéder à mon compte
                </a>
            </div>
            
            <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
                <h4 style="margin-top: 0;">�� Besoin d'aide ?</h4>
                <p style="margin: 5px 0;"><strong>Email :</strong> support@oumishop.com</p>
                <p style="margin: 5px 0;"><strong>Téléphone :</strong> +225 0123456789</p>
            </div>
        </div>
        
        <div class="footer">
            <p>© 2024 OumiShop. Tous droits réservés.</p>
            <p style="font-size: 12px; color: #999;">
                Cet email a été envoyé à {{ $user->email }}.
            </p>
        </div>
    </div>
</body>
</html>