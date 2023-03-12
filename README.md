# MakerSpace Servidor Control de Acceso

Web y base de datos para almacenar la información de los usuarios y las tarjetas para el control de acceso al MakerSpace.

## Instalar programas

Programas requeridos para ejecutar la web y la base de datos:

- sqlite3 (base de datos) 
- php-cli (servidor web php)
- php-sqlite (conector php y sqlite3)

```sh
sudo apt install sqlite3
sudo apt install php-cli
sudo apt-get install php8.1-sqlite   # Si se cuenta con otra versión de php modificar el comando
```

## Instrucciones para crear la base de datos

Crear base de datos o acceder a la base de datos si ya existe el fichero (Tener en cuenta que la que se encuentra en el repo contiene datos de prueba).

```sh
sqlite3 ./bbdd/acceso_makerspace.db # ejecutar en el directorio principal ./MakerSpace-ControlServer
```

Schema de la base de datos:

```sql

CREATE TABLE tarjetas(
id_tarjeta TEXT PRIMARY KEY,
contrasena TEXT);

CREATE TABLE usuarios(
id_usuario INTEGER PRIMARY KEY,
nombre TEXT NOT NULL,
apellidos TEXT NOT NULL,
correo TEXT NOT NULL,
rol TEXT,
id_tarjeta TEXT);

CREATE TABLE permisos(
id_usuario INTEGER PRIMARY KEY,
entrada INTEGER NOT NULL,
almacen INTEGER NOT NULL,
armario_1 INTEGER NOT NULL,
armario_2 INTEGER NOT NULL,
armario_3 INTEGER NOT NULL,
armario_4 INTEGER NOT NULL,
armario_5 INTEGER NOT NULL,
armario_6 INTEGER NOT NULL,
armario_7 INTEGER NOT NULL,
armario_8 INTEGER NOT NULL,
armario_9 INTEGER NOT NULL,
armario_3d INTEGER NOT NULL);

.quit
```

## Lanzar aplicación web

Lanzar aplicación web en localhost:

```sh
php -S 0.0.0.0:8080 # acceder a http://localhost:8080/
```