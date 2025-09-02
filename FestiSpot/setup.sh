#!/bin/bash

# Script de configuración inicial para FestiSpot API
# Este script configura la base de datos y las dependencias necesarias

echo "🚀 Configurando FestiSpot API..."

# Verificar si estamos en el directorio correcto
if [ ! -f "artisan" ]; then
    echo "❌ Error: Este script debe ejecutarse desde el directorio raíz del proyecto Laravel"
    exit 1
fi

# Función para mostrar mensajes de estado
show_status() {
    echo "📋 $1"
}

# Función para mostrar éxito
show_success() {
    echo "✅ $1"
}

# Función para mostrar error
show_error() {
    echo "❌ $1"
}

# 1. Instalar dependencias de Composer
show_status "Instalando dependencias de Composer..."
if composer install; then
    show_success "Dependencias de Composer instaladas"
else
    show_error "Error instalando dependencias de Composer"
    exit 1
fi

# 2. Copiar archivo de configuración si no existe
if [ ! -f ".env" ]; then
    show_status "Copiando archivo de configuración..."
    cp .env.example .env
    show_success "Archivo .env creado"
else
    show_success "Archivo .env ya existe"
fi

# 3. Generar clave de aplicación
show_status "Generando clave de aplicación..."
php artisan key:generate
show_success "Clave de aplicación generada"

# 4. Configurar base de datos
show_status "Configurando base de datos..."

# Preguntar configuración de la base de datos
echo "📝 Configuración de Base de Datos"
echo "=================================="

read -p "Host de la base de datos (localhost): " DB_HOST
DB_HOST=${DB_HOST:-localhost}

read -p "Puerto de la base de datos (3306): " DB_PORT
DB_PORT=${DB_PORT:-3306}

read -p "Nombre de la base de datos (festispot): " DB_DATABASE
DB_DATABASE=${DB_DATABASE:-festispot}

read -p "Usuario de la base de datos (root): " DB_USERNAME
DB_USERNAME=${DB_USERNAME:-root}

read -p "Contraseña de la base de datos: " -s DB_PASSWORD
echo

# Actualizar archivo .env con la configuración de la base de datos
sed -i "s/DB_HOST=.*/DB_HOST=$DB_HOST/" .env
sed -i "s/DB_PORT=.*/DB_PORT=$DB_PORT/" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env

show_success "Configuración de base de datos actualizada"

# 5. Ejecutar migraciones
show_status "Ejecutando migraciones de base de datos..."
if php artisan migrate --force; then
    show_success "Migraciones ejecutadas correctamente"
else
    show_error "Error ejecutando migraciones"
    echo "💡 Verifica que la base de datos '$DB_DATABASE' exista y las credenciales sean correctas"
    exit 1
fi

# 6. Ejecutar seeders
read -p "¿Deseas ejecutar los seeders para datos de prueba? (y/N): " RUN_SEEDERS
if [[ $RUN_SEEDERS =~ ^[Yy]$ ]]; then
    show_status "Ejecutando seeders..."
    if php artisan db:seed; then
        show_success "Seeders ejecutados correctamente"
    else
        show_error "Error ejecutando seeders (esto es opcional)"
    fi
fi

# 7. Configurar almacenamiento
show_status "Configurando almacenamiento..."
php artisan storage:link
show_success "Enlace de almacenamiento creado"

# 8. Limpiar caché
show_status "Limpiando caché..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
show_success "Caché limpiado"

# 9. Configurar permisos (Linux/Mac)
if [[ "$OSTYPE" == "linux-gnu"* ]] || [[ "$OSTYPE" == "darwin"* ]]; then
    show_status "Configurando permisos..."
    sudo chown -R www-data:www-data storage bootstrap/cache
    sudo chmod -R 775 storage bootstrap/cache
    show_success "Permisos configurados"
fi

echo ""
echo "🎉 ¡Configuración completada!"
echo "================================"
echo ""
echo "📋 Información importante:"
echo "• Base de datos: $DB_DATABASE en $DB_HOST:$DB_PORT"
echo "• Usuario: $DB_USERNAME"
echo ""
echo "🚀 Para iniciar el servidor de desarrollo:"
echo "   php artisan serve"
echo ""
echo "🌐 La API estará disponible en:"
echo "   http://localhost:8000/api/v1"
echo ""
echo "📝 Endpoints principales:"
echo "   • GET  /api/test - Prueba de conectividad"
echo "   • POST /api/v1/auth/register - Registro de usuario"
echo "   • POST /api/v1/auth/login - Inicio de sesión"
echo "   • GET  /api/v1/events - Listar eventos"
echo ""
echo "📚 Documentación completa en README_API.md"
echo ""
echo "🔧 Para la aplicación Flutter:"
echo "   • Navega a la carpeta 'flutter/'"
echo "   • Sigue las instrucciones en flutter/README.md"
echo ""
