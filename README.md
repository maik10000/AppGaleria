# Laravel Project Setup

Este repositorio contiene el proyecto de la galeria en Laravel que puedes configurar e iniciar siguiendo los pasos detallados a continuación.

## Requisitos Previos

Asegúrate de tener instalados los siguientes requisitos:

- **PHP**: Versión 8.2.12 o superior.
- **Composer**:  Gestor de dependencias para PHP. Version 2.5.4
- **Base de Datos**: MySQL, MariaDB, PostgreSQL u otro compatible.
- **Servidor Web**: Apache o NGINX.

## Instrucciones para Iniciar el Proyecto

### 1. Clonar el Repositorio
Clona el repositorio en tu máquina local:

```bash
git clone https://github.com/maik10000/AppGaleria.git
cd tu-proyecto-laravel
```

### 2. Instalar Dependencias de PHP

Ejecuta el siguiente comando para instalar las dependencias de PHP definidas en `composer.json`:

```bash
composer install
```

### 3. Configurar el Archivo `.env`

Copia el archivo de configuración base:

```bash
cp .env.example .env
```

Luego, abre el archivo `.env` y configura las variables necesarias como la conexión a la base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appgaleria
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generar la Clave de la Aplicación

Laravel requiere una clave de aplicación única para el cifrado. Genera esta clave con:

```bash
php artisan key:generate
```

### 5. Ejecutar las Migraciones

Crea las tablas de la base de datos ejecutando las migraciones:

```bash
php artisan migrate
```


### 6. Iniciar el Servidor de Desarrollo

Ejecuta el servidor integrado de Laravel:

```bash
php artisan serve
```

Por defecto, el proyecto estará disponible en `http://localhost:8000`.

## Comandos útiles

- **Limpiar caché**:
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan route:clear
  ```
## Muchas Gracias!