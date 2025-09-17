@echo off
echo Configurando Laravel para WAMP64...

REM Limpiar cache
php artisan config:clear
php artisan view:clear
php artisan route:clear

REM Publicar assets de Livewire
php artisan livewire:publish --assets

REM Optimizar para produccion
php artisan config:cache
php artisan route:cache

echo.
echo ========================================
echo Laravel configurado para WAMP64
echo ========================================
echo.
echo Accede a tu aplicacion en:
echo http://localhost/prueba/laravel-app/public
echo.
echo O directamente:
echo http://localhost/prueba/laravel-app
echo.
pause