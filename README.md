# OUMISHOP — by_ammaja

Plateforme e-commerce de luxe développée avec Laravel 12. Elle gère un catalogue produits, un panier d'achat, la génération de factures PDF, et un système de gestion des commandes avec deux espaces distincts : administrateur et client.

---

## Stack technique

| Couche | Technologie |
|---|---|
| Backend | Laravel 12 (PHP 8.2+) |
| Frontend | Blade, Tailwind CSS v3, Alpine.js v3 |
| Build | Vite 7 |
| Base de données | SQLite (dev) / MySQL ou PostgreSQL (prod) |
| Sessions / Cache / Queue | Pilote base de données |
| PDF | barryvdh/laravel-dompdf |
| Emails | SMTP configurable (log en dev) |

---

## Fonctionnalités

### Authentification & sécurité
- Inscription avec vérification par **code à 6 chiffres** (expiration 15 min)
- Connexion par email/mot de passe
- Réinitialisation de mot de passe par email
- Contrôle d'accès par rôle : `admin` / `client`
- Middleware `AdminOnly` protégeant toutes les routes d'administration

### Espace client
- Catalogue produits avec photos multiples
- Panier persistant (stockage JSON)
- Validation du panier → génération de facture PDF + envoi par email
- Suivi des commandes en cours (statut : EN COURS → PAYÉ → LIVRÉ)
- Historique des commandes complètes et annulées
- Gestion du profil (nom, email, téléphone, mot de passe, suppression du compte)

### Espace administrateur
- Dashboard de suivi des commandes actives
- Gestion du catalogue : ajout, modification, suppression de produits
- Upload de plusieurs photos par produit
- Gestion des stocks (décrémentation automatique à la validation du panier)
- Mise à jour du statut des commandes
- Historique global de toutes les commandes
- Notifications email à chaque nouvelle commande

---

## Prérequis

- PHP >= 8.2
- Composer
- Node.js >= 18 & npm
- Extension PHP : `pdo_sqlite` (dev) ou `pdo_mysql` / `pdo_pgsql` (prod)

---

## Installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/DA19s/OUMIPSHOP.git
cd OUMIPSHOP/oumishop

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JavaScript
npm install

# 4. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 5. Créer et migrer la base de données
php artisan migrate

# 6. Créer le lien symbolique pour le stockage public
php artisan storage:link
```

---

## Lancement en développement

```bash
# Démarre Laravel, Vite, la queue et les logs en parallèle
composer dev
```

Ou séparément :

```bash
php artisan serve          # Serveur Laravel
npm run dev                # Serveur Vite (HMR)
php artisan queue:work     # Worker de queue (emails)
```

L'application est accessible sur [http://localhost:8000](http://localhost:8000).

---

## Configuration de l'environnement

Fichier `.env` — variables principales à configurer :

```env
APP_NAME=OUMISHOP
APP_URL=http://localhost:8000

# Base de données (SQLite par défaut)
DB_CONNECTION=sqlite
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=oumishop
# DB_USERNAME=root
# DB_PASSWORD=

# Emails
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS="no-reply@oumishop.com"
MAIL_FROM_NAME="OUMISHOP"

# Admin — email de l'administrateur recevant les notifications de commandes
ADMIN_EMAIL=admin@oumishop.com
```

---

## Structure du projet

```
oumishop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                    # Inscription, login, reset password
│   │   │   ├── CartController.php       # Panier & validation commande
│   │   │   ├── ProductsController.php   # CRUD produits (admin)
│   │   │   ├── OrderController.php      # Gestion commandes (admin)
│   │   │   ├── VartController.php       # Commandes en attente (client)
│   │   │   ├── HistoriqueController.php        # Historique admin
│   │   │   ├── HistoriqueClientController.php  # Historique client
│   │   │   └── ProfileController.php    # Profil utilisateur
│   │   └── Middleware/
│   │       └── AdminOnly.php            # Protection routes admin
│   ├── Mail/                            # Classes d'email
│   └── Models/
│       ├── User.php
│       ├── products.php
│       ├── ProductPhoto.php
│       ├── Cart.php
│       ├── Vart.php                     # Commandes validées en attente
│       └── Historique.php               # Commandes finalisées
├── database/
│   └── migrations/                      # 15 migrations
├── resources/views/                     # Templates Blade (29 fichiers)
├── routes/
│   ├── web.php                          # Routes principales
│   ├── auth.php                         # Routes authentification
│   └── products.php                     # Routes produits (admin)
└── storage/app/public/
    ├── products/                        # Photos produits
    └── factures/                        # Factures PDF générées
```

---

## Schéma de la base de données

| Table | Rôle |
|---|---|
| `users` | Utilisateurs (role: admin / client) |
| `products` | Catalogue produits avec stock |
| `product_photos` | Photos associées aux produits |
| `carts` | Paniers en cours (items en JSON) |
| `varts` | Commandes validées en attente de paiement |
| `historiques` | Commandes finalisées ou annulées |
| `sessions` | Sessions utilisateurs |
| `jobs` / `cache` | Queue et cache Laravel |

---

## Workflow d'une commande

```
Client ajoute au panier
        ↓
Validation du panier
  → Décrémentation du stock
  → Génération de la facture PDF
  → Email client (facture en pièce jointe)
  → Email admin (notification nouvelle commande)
  → Création d'un enregistrement Vart
        ↓
Admin met à jour le statut
  EN COURS → PAYÉ → LIVRÉ
        ↓
Commande archivée dans Historique
```

---

## Créer le premier compte administrateur

Après migration, mettez à jour le rôle manuellement via Tinker :

```bash
php artisan tinker
```

```php
\App\Models\User::where('email', 'votre@email.com')->update(['role' => 'admin']);
```

---

## Build de production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Licence

Projet privé — tous droits réservés © by_ammaja.
