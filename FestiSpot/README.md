
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
	```bash
	php artisan serve
	```
	Accede a [http://127.0.0.1:8000](http://127.0.0.1:8000)

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
- `resources/views/` - Vistas Blade
- `routes/web.php` - Rutas web
- `database/` - Migraciones, seeders y base de datos local

## Créditos

Desarrollado por el equipo de Innovatec Regional.
