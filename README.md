# 🧩 Inventario de Activos de TI

**Inventario de Activos de TI** es una aplicación web desarrollada con **Laravel** que permite gestionar y controlar los activos tecnológicos de una organización, tales como equipos, marcas, categorías, empleados y accesorios.  
Incluye control de acceso basado en roles y permisos, reportes en PDF y exportaciones a Excel, con un diseño administrativo moderno utilizando **AdminLTE**.

---

## 🚀 Características principales

- 📦 **CRUD completo** de:
  - Marcas
  - Categorías
  - Empleados
  - Accesorios
- 🔐 **Autenticación y autorización** con [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
- 📊 **Tablas interactivas** con DataTables (búsqueda, paginación y ordenamiento)
- 📁 **Importación y exportación** de datos en formato Excel (Maatwebsite/Excel)
- 🧾 **Generación de reportes PDF** (DomPDF)
- 🧠 **Interfaz moderna** basada en AdminLTE y estilos personalizados (`admin_custom.css`)
- ⚙️ **Arquitectura limpia y mantenible**, con controladores organizados y seeders configurados

---

## 🧱 Tecnologías utilizadas

| Tipo | Tecnología |
|------|-------------|
| Framework principal | Laravel 10 |
| Autenticación | Laravel Breeze / Sanctum |
| Interfaz de administración | AdminLTE |
| Roles y permisos | Spatie Laravel Permission |
| Exportación/Importación | Maatwebsite Excel |
| Generación de PDFs | DomPDF |
| Interactividad | jQuery + DataTables |
| Entorno de desarrollo | Laravel Sail / Laragon |
| Pruebas | PHPUnit |

---

## ⚙️ Instalación

Sigue estos pasos para levantar el proyecto localmente:

### 1️ Clonar el repositorio
```bash
git clone https://github.com/tuusuario/inventario-ti.git
cd inventario-ti
```

### 2 Instalar dependencias
```bash
composer install
npm install && npm run build
```

### 3 Configurar el archivo .env
```bash
cp .env.example .env
```

Edita los siguientes valores según tu entorno:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### 4 Generar la clave de aplicación
```bash
php artisan key:generate
```

### 5 Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```

Si deseas ejecutar un seeder específico:
```bash
php artisan db:seed --class=SeederTabla
```

### 6 Correr con el comando
```bash
php artisan serve
```