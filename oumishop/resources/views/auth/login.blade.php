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
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black">            <div>
            <div>
                <a href="/">
                    <div class="w-20 h-20 flex items-center justify-center bg-gold rounded-full shadow-lg">
                        <span class="text-3xl">👜</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/95 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-2xl border border-gold/20">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-gray-800 font-semibold text-base" />
                        <x-text-input id="email" class="block mt-1 w-full border-2 border-gray-200 focus:border-gold focus:ring-gold rounded-lg text-gray-900 font-medium" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-800 font-semibold text-base" />

                        <x-text-input id="password" class="block mt-1 w-full border-2 border-gray-200 focus:border-gold focus:ring-gold rounded-lg text-gray-900 font-medium"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gold shadow-sm focus:ring-gold" name="remember">
                            <span class="ms-2 text-sm text-gray-800 font-semibold">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-700 hover:text-gold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold transition-colors font-medium" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ms-3 bg-gradient-to-r from-gold to-yellow-500 hover:from-yellow-500 hover:to-gold text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
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
            input[type="email"], input[type="password"] {
                transition: all 0.3s ease;
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
            }
            
            input[type="email"]:focus, input[type="password"]:focus {
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
        </style>
    </body>
</html>
