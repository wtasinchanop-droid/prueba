@echo off
echo ========================================
echo    INICIANDO SISTEMA DE GESTION
echo ========================================
echo.

echo Verificando si el proyecto esta configurado...

if not exist ".env" (
    echo Copiando archivo de configuracion...
    copy .env.example .env
)

echo.
echo Iniciando servidor Laravel...
echo.
echo ========================================
echo    SERVIDOR INICIADO
echo ========================================
echo.
echo Visita: http://localhost:8000
echo Usuario: admin@example.com  
echo Password: password
echo.
echo Presiona Ctrl+C para detener el servidor
echo ========================================
echo.

php artisan serve