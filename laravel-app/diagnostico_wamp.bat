@echo off
echo ========================================
echo DIAGNOSTICO LARAVEL WAMP64
echo ========================================
echo.

echo Verificando archivos...
echo.

if exist "public\css\admin_custom.css" (
    echo [OK] admin_custom.css existe
) else (
    echo [ERROR] admin_custom.css NO existe
)

if exist "public\vendor\livewire\livewire.js" (
    echo [OK] livewire.js existe
) else (
    echo [ERROR] livewire.js NO existe
)

echo.
echo Limpiando cache...
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo.
echo Recacheando configuracion...
php artisan config:cache

echo.
echo ========================================
echo URLs para probar:
echo ========================================
echo http://localhost/prueba/laravel-app/public
echo http://localhost/prueba/laravel-app/public/test-assets.php
echo http://localhost/prueba/laravel-app/public/css/admin_custom.css
echo http://localhost/prueba/laravel-app/public/vendor/livewire/livewire.js
echo.
pause