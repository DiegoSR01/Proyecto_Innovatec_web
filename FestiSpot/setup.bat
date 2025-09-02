@echo off
REM Script de configuración inicial para FestiSpot API (Windows)
REM Este script configura la base de datos y las dependencias necesarias

echo 🚀 Configurando FestiSpot API...

REM Verificar si estamos en el directorio correcto
if not exist "artisan" (
    echo ❌ Error: Este script debe ejecutarse desde el directorio raíz del proyecto Laravel
    pause
    exit /b 1
)

echo.
echo 📋 Instalando dependencias de Composer...
composer install
if %errorlevel% neq 0 (
    echo ❌ Error instalando dependencias de Composer
    pause
    exit /b 1
)
echo ✅ Dependencias de Composer instaladas

REM Copiar archivo de configuración si no existe
if not exist ".env" (
    echo 📋 Copiando archivo de configuración...
    copy .env.example .env >nul
    echo ✅ Archivo .env creado
) else (
    echo ✅ Archivo .env ya existe
)

echo.
echo 📋 Generando clave de aplicación...
php artisan key:generate
echo ✅ Clave de aplicación generada

echo.
echo 📋 Configurando base de datos...
echo.
echo 📝 Configuración de Base de Datos
echo ==================================

set /p DB_HOST="Host de la base de datos (localhost): "
if "%DB_HOST%"=="" set DB_HOST=localhost

set /p DB_PORT="Puerto de la base de datos (3306): "
if "%DB_PORT%"=="" set DB_PORT=3306

set /p DB_DATABASE="Nombre de la base de datos (festispot): "
if "%DB_DATABASE%"=="" set DB_DATABASE=festispot

set /p DB_USERNAME="Usuario de la base de datos (root): "
if "%DB_USERNAME%"=="" set DB_USERNAME=root

set /p DB_PASSWORD="Contraseña de la base de datos: "

REM Crear un script temporal de PowerShell para actualizar el archivo .env
echo $content = Get-Content '.env' > update_env.ps1
echo $content = $content -replace 'DB_HOST=.*', 'DB_HOST=%DB_HOST%' >> update_env.ps1
echo $content = $content -replace 'DB_PORT=.*', 'DB_PORT=%DB_PORT%' >> update_env.ps1
echo $content = $content -replace 'DB_DATABASE=.*', 'DB_DATABASE=%DB_DATABASE%' >> update_env.ps1
echo $content = $content -replace 'DB_USERNAME=.*', 'DB_USERNAME=%DB_USERNAME%' >> update_env.ps1
echo $content = $content -replace 'DB_PASSWORD=.*', 'DB_PASSWORD=%DB_PASSWORD%' >> update_env.ps1
echo $content ^| Set-Content '.env' >> update_env.ps1

powershell -ExecutionPolicy Bypass -File update_env.ps1
del update_env.ps1

echo ✅ Configuración de base de datos actualizada

echo.
echo 📋 Ejecutando migraciones de base de datos...
php artisan migrate --force
if %errorlevel% neq 0 (
    echo ❌ Error ejecutando migraciones
    echo 💡 Verifica que la base de datos '%DB_DATABASE%' exista y las credenciales sean correctas
    pause
    exit /b 1
)
echo ✅ Migraciones ejecutadas correctamente

echo.
set /p RUN_SEEDERS="¿Deseas ejecutar los seeders para datos de prueba? (y/N): "
if /i "%RUN_SEEDERS%"=="y" (
    echo 📋 Ejecutando seeders...
    php artisan db:seed
    if %errorlevel% neq 0 (
        echo ❌ Error ejecutando seeders (esto es opcional)
    ) else (
        echo ✅ Seeders ejecutados correctamente
    )
)

echo.
echo 📋 Configurando almacenamiento...
php artisan storage:link
echo ✅ Enlace de almacenamiento creado

echo.
echo 📋 Limpiando caché...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo ✅ Caché limpiado

echo.
echo 🎉 ¡Configuración completada!
echo ================================
echo.
echo 📋 Información importante:
echo • Base de datos: %DB_DATABASE% en %DB_HOST%:%DB_PORT%
echo • Usuario: %DB_USERNAME%
echo.
echo 🚀 Para iniciar el servidor de desarrollo:
echo    php artisan serve
echo.
echo 🌐 La API estará disponible en:
echo    http://localhost:8000/api/v1
echo.
echo 📝 Endpoints principales:
echo    • GET  /api/test - Prueba de conectividad
echo    • POST /api/v1/auth/register - Registro de usuario
echo    • POST /api/v1/auth/login - Inicio de sesión
echo    • GET  /api/v1/events - Listar eventos
echo.
echo 📚 Documentación completa en README_API.md
echo.
echo 🔧 Para la aplicación Flutter:
echo    • Navega a la carpeta 'flutter/'
echo    • Sigue las instrucciones en flutter/README.md
echo.

pause
