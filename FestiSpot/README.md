# FestiSpot

Plataforma de gestión y organización de eventos para organizadores y productores.

## Requisitos

- PHP >= 8.1
- Composer
- Node.js y npm
- SQLite (o MySQL, según configuración)

## Instalación

1. **Clona el repositorio:**
	```bash
	git clone https://github.com/tu-usuario/festispot.git
	cd festispot/FestiSpot
	```

2. **Instala dependencias:**
	```bash
	composer install
	npm install
	```

3. **Configura el entorno:**
	- Copia el archivo de ejemplo:
	  ```bash
	  cp .env.example .env
	  ```
	- Genera la clave de la app:
	  ```bash
	  php artisan key:generate
	  ```

4. **Configura la base de datos:**
	- Por defecto usa SQLite. Crea el archivo si no existe:
	  ```bash
	  touch database/database.sqlite
	  ```
	- Ajusta `.env` si usas otro motor.

5. **Ejecuta migraciones y seeders:**
	```bash
	php artisan migrate --seed
	```

6. **Compila los assets:**
	```bash
	npm run dev
	```

7. **Inicia el servidor:**
	- **Opción 1: Laravel (recomendado para desarrollo)**
		```bash
		php artisan serve
		```
		Accede a [http://127.0.0.1:8000](http://127.0.0.1:8000)
	- **Opción 2: XAMPP/Apache**
		1. Inicia Apache desde el panel de XAMPP.
		2. Accede a [http://localhost/FestiSpot/public](http://localhost/FestiSpot/public) en tu navegador.

## Scripts útiles

- **Compilar assets para producción:**
  ```bash
  npm run build
  ```

- **Limpiar cachés:**
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan view:clear
  php artisan route:clear
  ```

## Trabajo en equipo

- No subas tu archivo `.env` ni archivos de base de datos locales.
- Usa ramas para nuevas funcionalidades.
- Haz pull requests para revisión de código.

## Estructura principal

- `app/` - Lógica de la aplicación (controladores, modelos, etc.)
- `resources/views/` - Vistas Blade (aquí editas tus archivos de interfaz)
- `routes/web.php` - Rutas web
- `database/` - Migraciones, seeders y base de datos local

## Créditos

Desarrollado por el equipo de Innovatec Regional.

## Notas adicionales

- **Las vistas Blade** se encuentran en `resources/views`.
- **La caché de vistas** (Laravel) se guarda en `storage/framework/views`.  
  Asegúrate de que esta carpeta tenga permisos de escritura para el servidor web.
- Si usas XAMPP, la ruta podría ser algo como `c:\xampp\htdocs\Proyecto_Innovatec_web\FestiSpot\storage\framework\views`.
- **Si usas XAMPP/Apache**, accede siempre por la ruta `/FestiSpot/public` y asegúrate de que el archivo `.htaccess` esté presente en la carpeta `public/`.
