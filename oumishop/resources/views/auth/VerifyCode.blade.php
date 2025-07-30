<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
            <div>
                <a href="/">
                    <div class="w-20 h-20 flex items-center justify-center bg-gold rounded-full shadow-lg">
                        <span class="text-3xl">👜</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-2xl border border-gold/20">
                @if(session('info'))
                    <div class="mb-4 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded">
                        {{ session('info') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Vérification du code
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 mt-2 font-medium">
                        Veuillez saisir le code de vérification envoyé à votre adresse email.
                    </p>
                </div>

                <form method="POST" action="{{ route('validate-code') }}">
                    @csrf

                    <!-- Code -->
                    <div>
                        <x-input-label for="code" :value="__('Code de vérification')" class="text-gray-800 font-semibold text-base" />
                        <x-text-input id="code" class="block mt-1 w-full border-2 border-gray-200 focus:border-gold focus:ring-gold rounded-lg text-gray-900 font-medium text-center text-lg tracking-widest" type="text" name="code" :value="old('code')" required autofocus autocomplete="code" placeholder="Entrez le code à 6 chiffres" maxlength="6" />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="w-full bg-gradient-to-r from-gold to-yellow-500 hover:from-yellow-500 hover:to-gold text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                            {{ __('Valider le code') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-700 dark:text-gray-300 font-medium">
                        Vous n'avez pas reçu le code ? 
                        <a href="{{ route('register') }}" class="text-gold hover:text-yellow-500 font-semibold underline">
                            Créer un nouveau compte
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <style>
            :root {
                --gold: #d4af37;
                --gold-hover: #b8941f;
            }
            
            .text-gold {
                color: var(--gold);
            }
            
            .border-gold {
                border-color: var(--gold);
            }
            
            .focus\:border-gold:focus {
                border-color: var(--gold);
            }
            
            .focus\:ring-gold:focus {
                --tw-ring-color: var(--gold);
            }
            
            .bg-gold {
                background-color: var(--gold);
            }
            
            .from-gold {
                --tw-gradient-from: var(--gold);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(212, 175, 55, 0));
            }
            
            .to-gold {
                --tw-gradient-to: var(--gold);
            }
            
            .hover\:text-gold:hover {
                color: var(--gold);
            }
            
            .hover\:from-yellow-500:hover {
                --tw-gradient-from: #eab308;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(234, 179, 8, 0));
            }
            
            .hover\:to-gold:hover {
                --tw-gradient-to: var(--gold);
            }
            
            body {
                font-family: 'Montserrat', sans-serif;
            }
            
            .font-sans {
                font-family: 'Montserrat', sans-serif;
            }
            
            /* Animation pour le logo */
            .fill-current {
                transition: all 0.3s ease;
            }
            
            .fill-current:hover {
                transform: scale(1.05);
                filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.5));
            }
            
            /* Style pour les inputs */
            input[type="text"] {
                transition: all 0.3s ease;
                font-family: 'Montserrat', sans-serif;
                font-size: 18px;
                letter-spacing: 0.5em;
            }
            
            input[type="text"]:focus {
                box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
                transform: translateY(-1px);
            }
            
            /* Style pour le bouton */
            button[type="submit"] {
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
                letter-spacing: 0.5px;
            }
            
            /* Style pour les liens */
            a {
                font-family: 'Montserrat', sans-serif;
                font-weight: 500;
            }
            
            /* Style pour les labels */
            label {
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
            }
            
            /* Style pour les messages */
            .bg-blue-100 {
                background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
                border: 2px solid #3b82f6;
                color: #1e40af;
                font-weight: 600;
            }
            
            .bg-red-100 {
                background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
                border: 2px solid #ef4444;
                color: #dc2626;
                font-weight: 600;
            }
        </style>
    </body>
</html>
