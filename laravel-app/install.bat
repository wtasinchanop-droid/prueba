@echo off
echo ========================================
echo    INSTALACION DEL SISTEMA DE GESTION
echo ========================================
echo.

echo 1. Instalando dependencias de Composer...
call composer install

echo.
echo 2. Generando clave de aplicacion...
call php artisan key:generate

echo.
echo 3. Creando base de datos...
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS laravel_prueba;"

echo.
echo 4. Ejecutando migraciones...
call php artisan migrate

echo.
echo 5. Ejecutando seeders...
call php artisan db:seed

echo.
echo 6. Instalando dependencias de NPM...
call npm install

echo.
echo 7. Compilando assets...
call npm run build

echo.
echo ========================================
echo    INSTALACION COMPLETADA
echo ========================================
echo.
echo Para iniciar el servidor ejecuta:
echo php artisan serve
echo.
echo Luego visita: http://localhost:8000
echo Usuario: admin@example.com
echo Password: password
echo.
pause