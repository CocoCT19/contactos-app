# contactos-app

Este proyecto es un sistema completo de agenda de contactos desarrollado en PHP con PDO, que incluye:

- Registro de usuarios y login seguro con contraseña encriptada.
- Gestión de contactos personales (Crear, Leer, Actualizar, Eliminar).
- Edición de perfil de usuario (nombre, email y contraseña opcional).
- Uso de consultas preparadas para prevenir SQL Injection.
- Validaciones básicas de datos.
- Mensajes de éxito y error.
- Base de datos relacional con llaves foráneas.

## Estructura del proyecto

contactos-app/
contactos-app/<br>
├── includes/<br>
│&nbsp;&nbsp;&nbsp;├── database.php &nbsp;&nbsp;# Conexión PDO a la base de datos<br>
│&nbsp;&nbsp;&nbsp;└── funciones.php &nbsp;&nbsp;# Funciones CRUD para usuarios y contactos<br>
├── index.php &nbsp;&nbsp;# Listado de contactos y formulario de nuevo contacto<br>
├── login.php &nbsp;&nbsp;# Inicio de sesión<br>
├── logout.php &nbsp;&nbsp;# Cerrar sesión<br>
├── regisstrarse.php &nbsp;&nbsp;# Registro de usuarios<br>
├── editar.php &nbsp;&nbsp;# Edición de datos del usuario<br>
├── contactos.sql &nbsp;&nbsp;# Script SQL para crear la base de datos y tablas<br>
└── README.md &nbsp;&nbsp;# Este archivo<br>

## Base de datos

El proyecto usa una base de datos MySQL llamada `agenda_contactos`.

Tablas principales:
- `usuarios`: información de cada usuario (id, nombre, email, contraseña).
- `contactos`: lista de contactos vinculada a cada usuario mediante `usuario_id`.

Pasos para importar la base de datos:
1. Abrir phpMyAdmin o cliente MySQL.
2. Crear la base de datos:
   ```sql
   CREATE DATABASE agenda_contactos;
Importar el archivo contactos.sql.

Configuración
Colocar el proyecto en la carpeta htdocs de XAMPP o en el directorio del servidor web.

Configurar las credenciales de MySQL en includes/database.php:

php

$host = 'localhost';
$dbname = 'agenda_contactos';
$username = 'root';
$password = '';
Asegurarse de que el servidor web y MySQL estén en ejecución.

Uso
Registro:
Abrir http://localhost/contactos-app/regisstrarse.php y crear un usuario.

Inicio de sesión:
En http://localhost/contactos-app/login.php acceder con el usuario registrado.

Gestión de contactos:

Agregar un contacto desde el formulario en index.php.

Editar un contacto desde el botón Editar.

Eliminar un contacto desde el botón Eliminar.

Editar perfil de usuario:
Abrir http://localhost/contactos-app/editar.php y actualizar nombre, email o contraseña.

Cerrar sesión:
Usar el enlace Cerrar sesión en la parte superior.

Seguridad
Contraseñas cifradas con password_hash() y password_verify().

Consultas preparadas (prepare() y execute()) para evitar inyección SQL.

Validación de sesiones para proteger rutas privadas.

Requisitos
PHP 7.4 o superior.

MySQL 5.7 o superior.

Servidor local (XAMPP, Laragon, WAMP, etc.).

Autor
Luis Guerra – Proyecto de práctica en PHP y MySQL.
