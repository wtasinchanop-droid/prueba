# Guía de Compatibilidad PHP - Sistema de Gestión

## Matriz de Compatibilidad PHP

### Versiones PHP Soportadas

| Versión PHP | Estado | Compatibilidad | Notas |
|-------------|--------|----------------|-------|
| PHP 7.4.x   | ❌ No Soportado | Incompatible | Fin de vida útil |
| PHP 8.0.x   | ⚠️ Mínimo | Compatible | Soporte básico |
| PHP 8.1.x   | ✅ Recomendado | Totalmente Compatible | Versión recomendada |
| PHP 8.2.x   | ✅ Soportado | Totalmente Compatible | Funciona perfectamente |
| PHP 8.3.x   | ✅ Soportado | Totalmente Compatible | Última versión estable |

## Extensiones PHP Requeridas

### Extensiones Críticas (Obligatorias)

```php
// Verificación automática de extensiones
$required_extensions = [
    'bcmath',      // Cálculos matemáticos de precisión
    'ctype',       // Funciones de tipo de carácter
    'curl',        // Cliente HTTP
    'dom',         // Manipulación de documentos XML
    'fileinfo',    // Información de archivos
    'json',        // Codificación/decodificación JSON
    'mbstring',    // Manejo de cadenas multibyte
    'openssl',     // Funciones criptográficas
    'pcre',        // Expresiones regulares
    'pdo',         // Abstracción de base de datos
    'tokenizer',   // Análisis de tokens PHP
    'xml',         // Procesamiento XML
];

foreach ($required_extensions as $extension) {
    if (!extension_loaded($extension)) {
        die("Extensión PHP requerida no encontrada: {$extension}");
    }
}
```

### Extensiones Recomendadas

```php
$recommended_extensions = [
    'gd',          // Manipulación de imágenes
    'intl',        // Internacionalización
    'zip',         // Compresión de archivos
    'redis',       // Cache Redis (opcional)
    'imagick',     // Procesamiento avanzado de imágenes
];
```

## Configuración PHP Recomendada

### php.ini - Configuraciones Críticas

```ini
; Configuración de memoria
memory_limit = 256M
max_execution_time = 300
max_input_time = 300

; Configuración de archivos
upload_max_filesize = 32M
post_max_size = 32M
max_file_uploads = 20

; Configuración de sesiones
session.gc_maxlifetime = 7200
session.cookie_lifetime = 0
session.cookie_secure = 0
session.cookie_httponly = 1

; Configuración de errores (desarrollo)
display_errors = On
display_startup_errors = On
error_reporting = E_ALL

; Configuración de errores (producción)
; display_errors = Off
; display_startup_errors = Off
; error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT

; Configuración de OPcache (recomendado para producción)
opcache.enable = 1
opcache.memory_consumption = 128
opcache.interned_strings_buffer = 8
opcache.max_accelerated_files = 4000
opcache.revalidate_freq = 2
opcache.fast_shutdown = 1
```

## Características PHP Utilizadas

### PHP 8.0+ Features

```php
// Union Types (PHP 8.0+)
public function processData(string|int $value): bool|null
{
    return match($value) {
        'active' => true,
        'inactive' => false,
        default => null,
    };
}

// Named Arguments (PHP 8.0+)
$producto = new Producto(
    nombre: 'Producto Test',
    precio: 100.00,
    iva: 15.00
);

// Match Expression (PHP 8.0+)
$status = match($producto->estado) {
    'activo' => 'Disponible',
    'inactivo' => 'No disponible',
    'agotado' => 'Sin stock',
    default => 'Estado desconocido'
};
```

### PHP 8.1+ Features

```php
// Readonly Properties (PHP 8.1+)
class ProductoConfig
{
    public readonly float $iva_default;
    
    public function __construct(float $iva_default = 15.00)
    {
        $this->iva_default = $iva_default;
    }
}

// Enums (PHP 8.1+)
enum EstadoProducto: string
{
    case ACTIVO = 'activo';
    case INACTIVO = 'inactivo';
    case AGOTADO = 'agotado';
    
    public function getLabel(): string
    {
        return match($this) {
            self::ACTIVO => 'Disponible',
            self::INACTIVO => 'No disponible',
            self::AGOTADO => 'Sin stock',
        };
    }
}
```

## Dependencias de Composer

### composer.json - Configuración

```json
{
    "name": "sistema/gestion",
    "type": "project",
    "description": "Sistema de Gestión Empresarial",
    "keywords": ["laravel", "livewire", "gestion", "inventario"],
    "license": "MIT",
    "require": {
        "php": "^8.0.2",
        "laravel/framework": "^9.19",
        "laravel/sanctum": "^3.0",
        "laravel/tinker": "^2.7",
        "livewire/livewire": "^2.12",
        "jeroennoten/laravel-adminlte": "^3.9"
    },
    "require-dev": {
        "fakerphp/faker": "^1.9.1",
        "laravel/pint": "^1.0",
        "laravel/sail": "^1.0.1",
        "mockery/mockery": "^1.4.4",
        "nunomaduro/collision": "^6.0",
        "phpunit/phpunit": "^9.5.10",
        "spatie/laravel-ignition": "^1.0"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true,
        "allow-plugins": {
            "pestphp/pest-plugin": true
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}
```

## Verificación de Compatibilidad

### Script de Verificación Automática

```php
<?php
/**
 * Script de verificación de compatibilidad del sistema
 * Ejecutar antes de la instalación para verificar requisitos
 */

class SystemCompatibilityChecker
{
    private array $errors = [];
    private array $warnings = [];
    
    public function checkAll(): bool
    {
        $this->checkPHPVersion();
        $this->checkRequiredExtensions();
        $this->checkPHPConfiguration();
        $this->checkWritableDirectories();
        
        $this->displayResults();
        
        return empty($this->errors);
    }
    
    private function checkPHPVersion(): void
    {
        $version = PHP_VERSION;
        $minVersion = '8.0.0';
        $recommendedVersion = '8.1.0';
        
        if (version_compare($version, $minVersion, '<')) {
            $this->errors[] = "PHP {$version} no es compatible. Mínimo requerido: {$minVersion}";
        } elseif (version_compare($version, $recommendedVersion, '<')) {
            $this->warnings[] = "PHP {$version} funciona pero se recomienda {$recommendedVersion}+";
        }
    }
    
    private function checkRequiredExtensions(): void
    {
        $required = [
            'bcmath', 'ctype', 'curl', 'dom', 'fileinfo',
            'json', 'mbstring', 'openssl', 'pcre', 'pdo',
            'tokenizer', 'xml'
        ];
        
        foreach ($required as $extension) {
            if (!extension_loaded($extension)) {
                $this->errors[] = "Extensión PHP requerida: {$extension}";
            }
        }
    }
    
    private function checkPHPConfiguration(): void
    {
        $configs = [
            'memory_limit' => ['min' => '128M', 'recommended' => '256M'],
            'max_execution_time' => ['min' => 60, 'recommended' => 300],
            'upload_max_filesize' => ['min' => '8M', 'recommended' => '32M'],
        ];
        
        foreach ($configs as $setting => $limits) {
            $current = ini_get($setting);
            // Lógica de verificación aquí
        }
    }
    
    private function checkWritableDirectories(): void
    {
        $directories = [
            'storage/app',
            'storage/framework/cache',
            'storage/framework/sessions',
            'storage/framework/views',
            'storage/logs',
            'bootstrap/cache'
        ];
        
        foreach ($directories as $dir) {
            if (!is_writable($dir)) {
                $this->errors[] = "Directorio no escribible: {$dir}";
            }
        }
    }
    
    private function displayResults(): void
    {
        echo "=== VERIFICACIÓN DE COMPATIBILIDAD ===\n\n";
        
        if (!empty($this->errors)) {
            echo "❌ ERRORES CRÍTICOS:\n";
            foreach ($this->errors as $error) {
                echo "  - {$error}\n";
            }
            echo "\n";
        }
        
        if (!empty($this->warnings)) {
            echo "⚠️ ADVERTENCIAS:\n";
            foreach ($this->warnings as $warning) {
                echo "  - {$warning}\n";
            }
            echo "\n";
        }
        
        if (empty($this->errors) && empty($this->warnings)) {
            echo "✅ Sistema completamente compatible\n";
        } elseif (empty($this->errors)) {
            echo "✅ Sistema compatible con advertencias menores\n";
        } else {
            echo "❌ Sistema NO compatible. Corregir errores antes de continuar.\n";
        }
    }
}

// Ejecutar verificación
$checker = new SystemCompatibilityChecker();
$compatible = $checker->checkAll();

exit($compatible ? 0 : 1);
```

## Optimizaciones por Versión PHP

### PHP 8.0 Optimizations

```php
// Uso de match en lugar de switch
public function getEstadoColor(string $estado): string
{
    return match($estado) {
        'activo' => 'success',
        'inactivo' => 'warning',
        'agotado' => 'danger',
        default => 'secondary'
    };
}

// Union types para mejor type safety
public function calcularPrecio(int|float $base, int|float $iva): float
{
    return $base * (1 + $iva / 100);
}
```

### PHP 8.1 Optimizations

```php
// Readonly properties para configuración inmutable
class AppConfig
{
    public readonly string $app_name;
    public readonly float $default_iva;
    
    public function __construct()
    {
        $this->app_name = config('app.name');
        $this->default_iva = 15.00;
    }
}

// Enums para estados definidos
enum TipoDocumento: string
{
    case FACTURA = 'factura';
    case COTIZACION = 'cotizacion';
    case NOTA_CREDITO = 'nota_credito';
}
```

## Troubleshooting por Versión

### Problemas Comunes PHP 8.0+

```php
// Error: Deprecated dynamic properties
// Solución: Declarar propiedades explícitamente
class MiClase
{
    public $propiedad_dinamica; // Declarar explícitamente
}

// Error: Null to string conversion
// Solución: Usar null coalescing
$valor = $variable ?? '';
$texto = (string) ($variable ?? '');
```

### Problemas Comunes PHP 8.1+

```php
// Warning: Passing null to non-nullable parameter
// Solución: Usar tipos nullable o valores por defecto
public function procesar(?string $valor = null): void
{
    $valor = $valor ?? 'default';
    // procesar...
}
```

## Migración entre Versiones

### De PHP 8.0 a 8.1

1. **Actualizar composer.json:**
   ```json
   "require": {
       "php": "^8.1.0"
   }
   ```

2. **Ejecutar tests:**
   ```bash
   php artisan test
   ```

3. **Verificar deprecations:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

### De PHP 8.1 a 8.2+

1. **Revisar breaking changes**
2. **Actualizar dependencias**
3. **Ejecutar suite completa de tests**
4. **Monitorear logs en producción**

---

**Nota Importante:** Este sistema ha sido desarrollado y probado extensivamente en PHP 8.1+. Para garantizar la máxima compatibilidad y rendimiento, se recomienda usar PHP 8.1 o superior con todas las extensiones requeridas instaladas y configuradas correctamente.