# MakerSpace ControlServer

Service to control access to the MakerSpace workshop, storage room, the cabinets for the different tools and materials.


## Database

### Install and setup

Install PostgreSQL and setup the database. The setup script 'makerspace-controlserver-bbdd-setup.sql' must be in a directory where the postgres default user have the required permissions. The `/home/` directory should work.
```sh
sudo apt install postgresql
sudo service postgresql initdb
sudo service postgresql start

sudo -u postgres psql
```


### Schema

Database schema. Look into 'sql/makerspace-controlserver-bbdd-setup.sql' script to check more details at the postgres implementation:
```sql
DATABASE makerspacecontrol

TABLE usuarios(
uid TEXT PRIMARY KEY,
passwd TEXT NOT NULL,
nombre TEXT,
apellidos TEXT,
correo TEXT,
rol TEXT)

TABLE permisos(
uid TEXT PRIMARY KEY REFERENCES usuarios(uid) ON DELETE CASCADE,
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
armario_3d INTEGER NOT NULL)
```


## Web service

Launch web service with php-cli
```sh
sudo apt install php-cli
sudo apt-get install php-pgsql
php -S 0.0.0.0:8080 # acceder a http://localhost:8080/
```
