@echo off
echo Ejecutando migracion para agregar campos de precio a productos...
php artisan migrate

echo.
echo Actualizando seeders con datos de precios...
php artisan db:seed --class=ProductoSeeder

echo.
echo Proceso completado. Los productos ahora incluyen:
echo - Precio base
echo - Porcentaje de IVA (15%% por defecto)
echo - Precio con IVA (calculado automaticamente)
echo.
pause