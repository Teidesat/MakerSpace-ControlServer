ALTER USER postgres PASSWORD 'postgres';

CREATE DATABASE makerspacecontrol;

\c makerspacecontrol

alter database makerspacecontrol owner to postgres;
grant all privileges on database makerspacecontrol to postgres;

CREATE TABLE usuarios(
uid TEXT PRIMARY KEY,
passwd TEXT NOT NULL,
nombre TEXT,
apellidos TEXT,
correo TEXT,
rol TEXT);

CREATE TABLE permisos(
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
armario_3d INTEGER NOT NULL);