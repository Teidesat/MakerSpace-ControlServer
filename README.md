# MakerSpace Servidor Control de Acceso

## Instalar sqlite3 (base de datos), php-cli (servidor web php), php-sqlite (conector php y sqlite3)

```sh
sudo apt install sqlite3
sudo apt install php-cli
sudo apt-get install php8.1-sqlite   # Si se cuenta con otra versión de php, modificar comando ej: sudo apt-get install php8.1-sqlite php8.3-sqlite
```

## Instrucciones para crear la base de datos

Crear base de datos o acceder a la base de datos si ya existe el fichero

Schema de la base de datos (instrucciones para crear las tablas)

#### Esquema aun por implementar

```sh
sqlite3 ./bbdd/acceso_makerspace.db # ejecutar en el directorio principal ./servidor_control_de_acceso
```

```sql

pragma foreign_keys = on;    -- ejecutar exta instruccion cada vez que se acceda directamente a la base de datos para forzar la foreing key

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
arm_3d INTEGER NOT NULL,
almacen INTEGER NOT NULL,
arm_1 INTEGER NOT NULL,
arm_2 INTEGER NOT NULL,
arm_3 INTEGER NOT NULL,
arm_4 INTEGER NOT NULL,
arm_5 INTEGER NOT NULL,
arm_6 INTEGER NOT NULL,
arm_7 INTEGER NOT NULL,
arm_8 INTEGER NOT NULL,
arm_9 INTEGER NOT NULL,
FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario));

.quit
```

## Lanzar aplicación web

Lanzar aplicación web en localhost:

```sh
php -S 0.0.0.0:8080 # acceder a http://localhost:8080/
```