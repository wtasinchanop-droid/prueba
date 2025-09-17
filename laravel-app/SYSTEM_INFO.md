# Sistema de Gestión Empresarial

## Información General del Sistema

**Nombre del Proyecto:** Sistema de Gestión Empresarial  
**Versión:** 1.0.0  
**Fecha de Desarrollo:** Septiembre 2024  
**Tipo de Aplicación:** Sistema Web de Gestión  
**Arquitectura:** MVC (Model-View-Controller)  

## Descripción del Sistema

Este sistema de gestión empresarial ha sido desarrollado para facilitar la administración de productos, clientes y facturación en pequeñas y medianas empresas. La aplicación proporciona una interfaz intuitiva y moderna para el manejo eficiente de inventarios y procesos comerciales.

### Características Principales

- **Gestión de Productos**: Control completo de inventario con cálculo automático de IVA
- **Administración de Clientes**: Base de datos centralizada de información de clientes
- **Sistema de Facturación**: Generación y gestión de facturas con cálculos automáticos
- **Interfaz Responsiva**: Diseño adaptable a diferentes dispositivos
- **Tiempo Real**: Actualizaciones instantáneas sin recarga de página

## Requisitos del Sistema

### Requisitos Mínimos del Servidor

#### PHP
- **Versión Mínima:** PHP 8.0.0
- **Versión Recomendada:** PHP 8.1.0 o superior
- **Versión Máxima Probada:** PHP 8.3.0

#### Extensiones PHP Requeridas
```
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
```

#### Base de Datos
- **MySQL:** 5.7.0 o superior (Recomendado: 8.0+)
- **MariaDB:** 10.3.0 o superior
- **PostgreSQL:** 10.0 o superior (Opcional)
- **SQLite:** 3.8.8 o superior (Para desarrollo)

#### Servidor Web
- **Apache:** 2.4.0 o superior
- **Nginx:** 1.15.0 o superior
- **Soporte para:** mod_rewrite (Apache) o configuración equivalente

### Requisitos del Cliente (Navegador)

#### Navegadores Compatibles
- **Google Chrome:** 90.0 o superior ✅
- **Mozilla Firefox:** 88.0 o superior ✅
- **Microsoft Edge:** 90.0 o superior ✅
- **Safari:** 14.0 o superior ✅
- **Opera:** 76.0 o superior ✅

#### Tecnologías del Cliente
- **JavaScript:** ES6+ habilitado
- **CSS3:** Soporte completo
- **HTML5:** Soporte completo
- **WebSockets:** Para funcionalidades en tiempo real

## Stack Tecnológico

### Backend
- **Framework:** Laravel 9.x
- **Lenguaje:** PHP 8.1+
- **ORM:** Eloquent
- **Autenticación:** Laravel Sanctum
- **Validación:** Laravel Validation

### Frontend
- **Framework CSS:** AdminLTE 3.x
- **JavaScript:** Vanilla JS + Livewire
- **Componentes:** Livewire 2.x
- **Iconos:** Font Awesome 5.x
- **Responsive:** Bootstrap 4.x

### Base de Datos
- **Motor:** MySQL 8.0
- **Migraciones:** Laravel Migrations
- **Seeders:** Laravel Database Seeders
- **Relaciones:** Eloquent Relationships

## Estructura del Proyecto

```
laravel-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controladores HTTP
│   │   ├── Livewire/       # Componentes Livewire
│   │   └── Middleware/     # Middleware personalizado
│   ├── Models/             # Modelos Eloquent
│   └── Providers/          # Proveedores de servicios
├── config/                 # Archivos de configuración
├── database/
│   ├── migrations/         # Migraciones de base de datos
│   └── seeders/           # Datos de prueba
├── public/
│   ├── css/               # Estilos personalizados
│   └── js/                # Scripts JavaScript
├── resources/
│   └── views/             # Plantillas Blade
└── routes/                # Definición de rutas
```

## Configuración del Entorno

### Variables de Entorno (.env)

```env
# Configuración de la aplicación
APP_NAME="Sistema de Gestión"
APP_ENV=production
APP_KEY=base64:generated_key_here
APP_DEBUG=false
APP_URL=http://localhost

# Configuración de base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_gestion
DB_USERNAME=root
DB_PASSWORD=

# Configuración de Livewire
LIVEWIRE_ASSET_URL=/assets
```

### Configuración de Apache (.htaccess)

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

## Instalación y Configuración

### Pasos de Instalación

1. **Clonar o descargar el proyecto**
2. **Instalar dependencias de PHP:**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```
3. **Configurar variables de entorno:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Configurar base de datos:**
   ```bash
   php artisan migrate --seed
   ```
5. **Configurar permisos:**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

### Configuración para WAMP64

#### Configuración de Virtual Host
```apache
<VirtualHost *:80>
    DocumentRoot "c:/wamp64/www/prueba/laravel-app/public"
    ServerName sistema-gestion.local
    <Directory "c:/wamp64/www/prueba/laravel-app/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Configuración de hosts (Windows)
```
127.0.0.1 sistema-gestion.local
```

## Funcionalidades del Sistema

### Módulo de Productos
- ✅ Listado de productos con paginación
- ✅ Creación de nuevos productos
- ✅ Edición de productos existentes
- ✅ Eliminación de productos
- ✅ Cálculo automático de IVA
- ✅ Validación de datos en tiempo real
- ✅ Búsqueda y filtrado

### Módulo de Clientes
- ✅ Gestión completa de clientes
- ✅ Información de contacto
- ✅ Historial de transacciones
- ✅ Validación de datos
- ✅ Búsqueda avanzada

### Módulo de Facturación
- ✅ Generación de facturas
- ✅ Cálculos automáticos
- ✅ Gestión de estados
- ✅ Reportes básicos
- ✅ Exportación de datos

## Seguridad

### Medidas de Seguridad Implementadas
- **CSRF Protection:** Protección contra ataques CSRF
- **SQL Injection Prevention:** Uso de Eloquent ORM
- **XSS Protection:** Escape automático en plantillas Blade
- **Mass Assignment Protection:** Campos fillable definidos
- **Input Validation:** Validación robusta de datos
- **Error Handling:** Manejo seguro de errores

### Recomendaciones de Seguridad
- Mantener PHP y Laravel actualizados
- Usar HTTPS en producción
- Configurar firewall del servidor
- Realizar backups regulares
- Monitorear logs de acceso

## Rendimiento

### Optimizaciones Implementadas
- **Eloquent Relationships:** Carga eficiente de relaciones
- **Query Optimization:** Consultas optimizadas
- **Asset Compilation:** Minificación de CSS/JS
- **Caching:** Sistema de caché de Laravel
- **Lazy Loading:** Carga bajo demanda

### Métricas de Rendimiento
- **Tiempo de Carga:** < 2 segundos
- **Tiempo de Respuesta:** < 500ms
- **Memoria PHP:** < 128MB por request
- **Consultas DB:** Optimizadas con índices

## Mantenimiento

### Tareas de Mantenimiento Regular
- **Logs:** Limpiar logs antiguos mensualmente
- **Cache:** Limpiar caché semanalmente
- **Database:** Optimizar tablas mensualmente
- **Backups:** Realizar backups diarios
- **Updates:** Revisar actualizaciones mensualmente

### Comandos Útiles
```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Mantenimiento de base de datos
php artisan migrate:status
php artisan db:seed --class=ProductoSeeder
```

## Solución de Problemas

### Problemas Comunes

#### Error 500 - Internal Server Error
- Verificar permisos de carpetas storage/ y bootstrap/cache/
- Revisar configuración de .env
- Verificar logs en storage/logs/

#### Livewire no funciona
- Verificar que @livewireScripts esté incluido
- Comprobar configuración de rutas
- Revisar consola del navegador

#### Base de datos no conecta
- Verificar credenciales en .env
- Comprobar que el servicio MySQL esté activo
- Verificar permisos de usuario de base de datos

### Logs del Sistema
- **Aplicación:** `storage/logs/laravel.log`
- **Servidor:** Logs de Apache/Nginx
- **Base de Datos:** Logs de MySQL
- **PHP:** Logs de PHP según configuración

## Contacto y Soporte

### Información de Desarrollo
- **Desarrollado por:** Equipo de Desarrollo Interno
- **Metodología:** Desarrollo Ágil
- **Testing:** Pruebas unitarias y de integración
- **Documentación:** Documentación técnica completa

### Soporte Técnico
- **Nivel 1:** Problemas básicos de configuración
- **Nivel 2:** Problemas de funcionalidad
- **Nivel 3:** Problemas de arquitectura y rendimiento

---

**Nota:** Este sistema ha sido desarrollado siguiendo las mejores prácticas de desarrollo web moderno, con énfasis en la seguridad, rendimiento y mantenibilidad. Para cualquier consulta técnica, revisar la documentación del código fuente que incluye comentarios detallados en todos los archivos principales.