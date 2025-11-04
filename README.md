# ConexionAmorosa — Maqueta (Proyecto final)

Este repositorio contiene una maqueta para proyecto final: "ConexionAmorosa". Es una aplicación PHP simple que permite: registro/login, edición de perfil con intereses, y una funcionalidad de búsqueda básica.
---

## Requisitos

- Windows (WAMP instalado)
- Apache + PHP (PHP 7.x o 8.x deberían funcionar)
- MySQL / MariaDB (viene con WAMP)
- Navegador web

Ubicación de trabajo en este ejemplo: `F:\wamp64\www\ConexionAmorosa` (la carpeta del proyecto en htdocs/ equivalente).

---

## Organización de archivos

Estructura principal (resumida):

- `assets/`
  - `css/` — hojas de estilo (Perfil, Busqueda, Registro, etc.)
  - `js/` — scripts (Busqueda.js, Registro.js)
- `includes/`
  - `conexion.php` — conexión a MySQL (con lógica defensiva para crear DB/tablas si el usuario tiene privilegios)
- `*.php` (en la raíz): `index.php`, `Registro.php`, `Inicio_sesion.php`, `Busqueda.php`, `Perfil.php`, `Verificar_login.php`, `procesar.php`, `Resultado_bus.php`, etc.
- Imágenes en la raíz: `R.jpg`, `ubicacion.jpg`, `ConexiónAmorosa.gif` (no movidas automáticamente)

Nota: los archivos PHP siguen estando en la raíz para mantener las URLs públicas inalteradas (p. ej. `/ConexionAmorosa/Busqueda.php`).

---

### Base de datos: automático vs manual

- El archivo `includes/conexion.php` intenta: 1) conectarse a la base `conexionamorosa`; 2) si la DB no existe intenta crearla (requiere privilegios del usuario MySQL); 3) crear tablas esenciales (`usuarios`, `tabla_datos`, `intereses`) si no existen; 4) si hace falta, intenta `ALTER TABLE` para añadir columna `genero`.

- Si prefieres crear la base y tablas manualmente (recomendado en entornos controlados), usa el SQL siguiente en phpMyAdmin o MySQL CLI.

## Cómo probar la maqueta

1. Abre `http://localhost/ConexionAmorosa/index.php`.
2. Regístrate (si no has insertado usuario de prueba) o usa el usuario de prueba insertado anteriormente.
3. Inicia sesión (Inicio_sesion.php) — el login guarda `$_SESSION['id_usuario']` y redirige al perfil.
4. Accede a `Busqueda.php`, añade preferencias y usa funcionalidades (la búsqueda guarda datos en `tabla_datos`).

---

## Notas de desarrollo

- Para facilitar pruebas locales, el sistema intenta crear la DB y tablas si no existen. Esto facilita el uso en entornos docentes donde se usa `root` con todos los privilegios.
- Los CSS/JS fueron organizados en `assets/` y la conexión centralizada en `includes/conexion.php` para facilitar mantenimiento.

