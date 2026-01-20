# Proyecto Final – TaskManager PHP & MySQL (API)

## 📄 Descripción General
TaskManager es una aplicación web de gestión de tareas desarrollada en **PHP** y **MySQL**, siguiendo una arquitectura **API**.  
Permite a los usuarios registrarse, iniciar sesión, crear, editar, eliminar y listar tareas de forma dinámica.  
Toda la comunicación entre el frontend y el backend se realiza mediante **peticiones HTTP** y **respuestas JSON**, cumpliendo con buenas prácticas de programación y seguridad básica con **sesiones**.

---

## 🛠 Tecnologías Utilizadas

- **Backend:** PHP puro (sin frameworks)  
- **Frontend:** HTML, CSS, JavaScript (Fetch API)  
- **Base de datos:** MySQL  
- **Servidor local:** XAMPP (Apache + MySQL)  
- **Control de versiones:** GitHub  

---

proyecto-final/
│
├── api/                # Endpoints del backend que devuelven JSON
│   ├── auth/           # login.php, register.php, logout.php
│   └── tasks/          # create.php, list.php, update.php, delete.php
│
├── assets/             # Recursos estáticos
│   ├── css/            # style.css
│   └── js/             # auth.js, tasks.js
│
├── libs/               # Funciones y clases reutilizables
│   └── Response.php    # Ejemplo de helper para respuestas JSON
│
├── Pages/              # Vistas principales del sistema
│   ├── layout/         # header.php, footer.php
│   ├── login.php
│   ├── register.php
│   └── dashboard.php
│
├── system/             # Configuración y conexión a la base de datos
│   ├── config.php
│   └── init.php
│
├── uploads/            # Archivos subidos por usuarios (si aplica)
├── database.sql        # Script SQL para crear la base de datos y tablas
└── README.md           # Documentación del proyecto


---

## ⚙️ Requisitos del Sistema

- XAMPP con **Apache** y **MySQL** activos  
- Navegador moderno (Chrome, Firefox, Edge)  
- PHP 7.x o superior  

---

## 🏃‍♂️ Instrucciones de Instalación y Ejecución

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/proyecto-final.git
2. Copiar al directorio de XAMPP
text
Copiar código
C:\xampp\htdocs\proyecto-final
Es importante que esté dentro de htdocs para que Apache pueda servirlo.

3. Iniciar XAMPP
Abrir el Panel de Control de XAMPP

Iniciar Apache y MySQL

Ambas luces deben estar verdes

4. Crear la base de datos
Abrir navegador: http://localhost/phpmyadmin

Seleccionar Importar

Subir el archivo database.sql

Hacer clic en Continuar

Esto creará la base de datos task_manager y todas las tablas necesarias.

5. Configurar la conexión a la base de datos
Archivo: system/config.php

php
Copiar código
define('DB_HOST', 'localhost');
define('DB_USER', 'root');    // Usuario XAMPP por defecto
define('DB_PASS', '');        // Contraseña XAMPP por defecto (vacía)
define('DB_NAME', 'task_manager');
6. Abrir la aplicación en el navegador
bash
Copiar código
http://localhost/proyecto-final/Pages/login.php
Primero aparecerá el login

Si no tienes cuenta, puedes ir a register.php

Después del login, se redirige al dashboard.php

🔑 Funcionalidades Principales
Autenticación de Usuarios

Registro de nuevos usuarios

Login con sesiones

Logout con redirección a login

Validación de datos y seguridad básica

Gestión de Tareas (CRUD)

Crear tareas con título y descripción

Listar todas las tareas del usuario

Editar tareas existentes

Eliminar tareas

Todas las operaciones se realizan mediante API y JSON

Frontend Dinámico

Consumo de API mediante fetch

Actualización dinámica del listado de tareas

Botones de Editar y Eliminar visibles solo si el usuario está logueado

📦 Endpoints Principales (API)
Auth
Endpoint	Método	Descripción
api/auth/register.php	POST	Registra un nuevo usuario
api/auth/login.php	POST	Login de usuario
api/auth/logout.php	POST	Cierra sesión y destruye sesión

Tasks
Endpoint	Método	Descripción
api/tasks/create.php	POST	Crea nueva tarea
api/tasks/list.php	GET	Lista todas las tareas
api/tasks/update.php	PUT	Actualiza tarea existente
api/tasks/delete.php	DELETE	Elimina tarea existente

💻 Uso de la Aplicación
Registrar un usuario nuevo en register.php

Iniciar sesión en login.php

Crear tareas desde el dashboard

Editar o eliminar tareas con los botones correspondientes

Cerrar sesión usando el botón Logout

Nota: Si intentas acceder al dashboard sin sesión, redirige automáticamente a login.

🎨 Estilos y Scripts
CSS: assets/css/style.css

JS: assets/js/auth.js y assets/js/tasks.js

Ambos archivos gestionan la interacción dinámica con la API y la visibilidad de botones según sesión.

📝 Buenas Prácticas Aplicadas
Separación clara de backend y frontend

Validaciones de entrada en frontend y backend

Uso de JSON en todas las respuestas de API

Control de sesiones y seguridad básica

Nomenclatura consistente y código comentado

Arquitectura de carpetas organizada según especificación