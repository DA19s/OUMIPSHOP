@echo off
echo Démarrage automatique des queues OumiShop...

REM Attendre que le serveur soit prêt
timeout /t 10 /nobreak > nul

REM Démarrer les workers
start "Queue Worker 1" /min php artisan queue:work --daemon --sleep=3 --tries=3
start "Queue Worker 2" /min php artisan queue:work --daemon --sleep=3 --tries=3

echo Queues démarrées en arrière-plan ! 