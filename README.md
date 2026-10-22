# Práctica de Sesiones en Laravel

Repositorio correspondiente a la **Práctica de Sesiones** de clase.

---

## 📋 Características Implementadas

1. **Función de Login (`AuthController@login`)**:
   - Inicia sesión verificando la contraseña con `Hash::check($request->password, $user->password)`.
   - Genera un token aleatorio con `Str::random(60)`.
   - Guarda los datos permanentes en la sesión mediante:
     ```php
     session(['token' => $token, 'name' => $user->name]);
     ```
   - Redirige al inicio con mensaje de bienvenida.

2. **Función de Logout (`AuthController@logout`)**:
   - Cierra y limpia la sesión actual según las instrucciones exactas:
     ```php
     $request->session()->invalidate();
     $request->session()->regenerateToken();
     ```
   - Redirige a la página de login (`route('login')`).

3. **Página con Formulario de Login (`/login`)**:
   - Formulario accesible con validación de campos, protección `@csrf` y visualización de errores.
   - Enlace directo a la creación de cuenta.

4. **Header Reactivo y Dinámico (`resources/views/layouts/app.blade.php`)**:
   - Si **NO hay token** en la sesión (`@if(!session()->has('token'))`):
     - Muestra los botones **Iniciar sesión** y **Crear cuenta**.
   - Si **HAY token** en la sesión (`@if(session()->has('token'))`):
     - Muestra el texto `"Hola, " + el nombre de usuario` (`Hola, {{ session('name') }}`).
     - Muestra el botón para **Cerrar sesión** (mediante formulario POST con token CSRF).

5. **Registro de Usuarios (`/register`)**:
   - Permite crear nuevas cuentas con contraseña encriptada mediante `Hash::make`.

---

## 🚀 Puesta en marcha

### 1. Clonar el repositorio
```bash
git clone <URL_DEL_REPOSITORIO>
cd practica-sesiones
```

### 2. Instalar dependencias
```bash
composer install
npm install
npm run build
```

### 3. Configurar entorno y base de datos
```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

### 4. Iniciar el servidor
```bash
php artisan serve
```
O bien acceder a través de **Laravel Herd**: `http://practica-sesiones.test`.

---

## 🔑 Credenciales de Prueba (Seeder)

El seeder incluye un usuario preparado para pruebas inmediatas:
- **Email:** `test@example.com`
- **Contraseña:** `password`

También puedes registrar un usuario nuevo en `/register`.

---

## 🧪 Pruebas Automatizadas (Pest)

Se han implementado pruebas funcionales que verifican todos los requisitos:
```bash
php artisan test
```

Todas las pruebas pasan al 100%:
- Renderizado del header sin token (muestra botones de login/registro).
- Renderizado del formulario de login.
- Fallo de autenticación ante credenciales incorrectas.
- Éxito de login guardando token y nombre en sesión.
- Renderizado del header con token (muestra "Hola, {nombre}" y botón de cerrar sesión).
- Logout con invalidación y redirección a login.
- Registro de nuevo usuario.
