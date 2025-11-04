INVENTARIOMH

InventarioMH es un sistema web desarrollado con Laravel para la gestión completa de inventarios, empleados y ventas.
Permite registrar, consultar y administrar productos, controlar existencias y generar reportes de forma sencilla y eficiente.


CARACTERÍSTICAS PRINCIPALES

* Gestión de productos: creación, edición, eliminación y control de stock.
* Módulo de empleados: administración del personal con registro y foto de perfil.
* Módulo de ventas: registro de ventas, detalle de productos vendidos y total calculado automáticamente.
* Autenticación de usuarios con roles y permisos.
* Reportes PDF de productos, ventas o empleados.
* Búsqueda y filtrado por nombre, categoría o fecha.
* Interfaz moderna construida con Blade y Bootstrap/Tailwind.


TECNOLOGÍAS UTILIZADAS

Backend: Laravel 10+
Frontend: Blade / Bootstrap / TailwindCSS
Base de datos: MySQL o MariaDB
Autenticación: Laravel Breeze / Auth
Reportes: barryvdh/laravel-dompdf
Control de versiones: Git / GitHub



REQUISITOS PREVIOS

* PHP 8.1 o superior
* Composer
* MySQL o MariaDB
* Node.js y NPM
* Git
* Opcional: XAMPP o Laravel Sail/Docker



INSTALACIÓN

1. Clona el repositorio
   git clone [https://github.com/izzycaicedx/inventarioMH.git](https://github.com/izzycaicedx/inventarioMH.git)
   cd inventarioMH

2. Instala dependencias
   composer install
   npm install
   npm run build

3. Copia el archivo de entorno y configura tu base de datos
   cp .env.example .env
   Edita el archivo .env con tus datos de conexión:
   DB_DATABASE=inventario_mh
   DB_USERNAME=root
   DB_PASSWORD=

4. Genera la clave de la aplicación
   php artisan key:generate

5. Ejecuta las migraciones y seeders
   php artisan migrate --seed

6. Inicia el servidor
   php artisan serve
   Luego abre en tu navegador: [http://localhost:8000](http://localhost:8000)



ESTRUCTURA DEL PROYECTO

app/
├─ Http/
│   ├─ Controllers/   -> Controladores de productos, empleados, ventas
│   └─ Middleware/
├─ Models/            -> Modelos Eloquent

database/
├─ migrations/        -> Migraciones de base de datos
└─ seeders/           -> Datos iniciales

resources/
├─ views/             -> Vistas Blade
├─ css/ y js/         -> Archivos de frontend

routes/
├─ web.php            -> Rutas principales
└─ api.php            -> Rutas API



PRÓXIMAS MEJORAS

* Dashboard con estadísticas en tiempo real
* Reportes personalizados filtrados por rango de fechas
* Exportar inventario a Excel
* Notificaciones de stock bajo
* API REST para integración externa



DESARROLLADO POR

Izzy Caicedo
Juan Pablo Urbano
Seabstian Arias
Correo: [izzycaicedx@ejemplo.com](mailto:izzycaicedx@ejemplo.com)
Repositorio: [https://github.com/izzycaicedx/inventarioMH](https://github.com/izzycaicedx/inventarioMH)


