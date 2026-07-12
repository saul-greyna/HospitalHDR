# Hospital Dr. Raúl Hernández — Sitio Web

Sitio web institucional del **Hospital Dr. Raúl Hernández**, ubicado en León, Guanajuato, México. Construido como una **Single Page Application (SPA)** con **Laravel 12** en el backend y **Vue 3 + Vue Router** en el frontend, e incluye una **API REST independiente en Node.js/Express** para la gestión de doctores y autenticación.

## Tabla de contenidos

- [Descripción general](#descripción-general)
- [Arquitectura](#arquitectura)
- [Stack tecnológico](#stack-tecnológico)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Rutas del sitio (Vue Router)](#rutas-del-sitio-vue-router)
- [Módulo de Directorio Médico](#módulo-de-directorio-médico)
- [API REST (Node.js)](#api-rest-nodejs)
- [Base de datos](#base-de-datos)
- [Generación de Sitemap](#generación-de-sitemap)
- [Requisitos previos](#requisitos-previos)
- [Instalación y puesta en marcha](#instalación-y-puesta-en-marcha)
- [Uso con Docker](#uso-con-docker)
- [Variables de entorno](#variables-de-entorno)
- [Scripts disponibles](#scripts-disponibles)
- [Convenciones y notas de desarrollo](#convenciones-y-notas-de-desarrollo)
- [Roadmap / pendientes sugeridos](#roadmap--pendientes-sugeridos)

## Descripción general

El sitio ofrece información institucional del hospital: página de inicio, quiénes somos, servicios de laboratorio y un **directorio médico** con más de 49 doctores, cada uno con su propia página de detalle (`/directorio-medico/:slug`). Todo el enrutamiento del lado del cliente es manejado por Vue Router bajo una única vista Blade de entrada, lo que convierte al sitio en una SPA completa servida por Laravel.

## Arquitectura

El proyecto está compuesto por **dos aplicaciones independientes**:

1. **Aplicación principal (raíz del repo)** — Laravel 12 + Vue 3 SPA. Sirve el sitio público, las vistas Blade mínimas, los assets compilados con Vite y el comando Artisan de generación de sitemap.
2. **`api/`** — Microservicio Node.js + Express con su propio `package.json`, encargado de autenticación (JWT) y del CRUD de doctores/categorías contra MySQL, usando un patrón **Controller → Service → Repository**.

Ambas partes comparten la misma base de datos MySQL (`u932571146_HospitalDR`).

### Flujo de la SPA

```
routes/web.php  →  Route::get('/{any?}', ...) → view('home.index')
                                                        │
                                        resources/views/home/index.blade.php
                                        (extiende components.main → @vite app.js)
                                                        │
                                            resources/js/app.js (createApp)
                                                        │
                                              App.vue → layouts/Main.vue
                                                        │
                                        resources/js/router/index.js (Vue Router)
                                                        │
                        ┌───────────────┬───────────────┼───────────────────┐
                     Home.vue      Nosotros.vue   ServiciosLaboratorio.vue  DirectorioMedico.vue → Medicos.vue
```

Toda ruta (`/{any?}`) definida en `routes/web.php` devuelve la misma vista Blade; es Vue Router (modo `history`, HTML5) quien decide qué componente renderizar en el cliente.

## Stack tecnológico

**Backend (raíz)**
- PHP ^8.2
- Laravel Framework ^12.0
- Laravel Vite Plugin ^2.0
- Pest ^3.8 (testing)
- Laravel Pint (formateo de código)

**Frontend (raíz)**
- Vue 3 (^3.5.29) con `<script setup>`
- Vue Router ^5.1.0 (modo `createWebHistory`)
- Vite ^7.0.7
- Tailwind CSS ^4.3.0 (vía `@tailwindcss/vite`)
- Fuente tipográfica personalizada **Aeonik** (varios pesos, WOFF2)

**API independiente (`api/`)**
- Node.js + Express ^5.2.1
- MySQL2 ^3.22.5
- JSON Web Tokens (`jsonwebtoken` ^9.0.3)
- bcryptjs ^3.0.3 (hash de contraseñas)
- CORS, dotenv
- Nodemon (desarrollo)

**Infraestructura**
- Docker / Docker Compose (PHP-FPM 8.3, Node 24, MySQL 8.0, phpMyAdmin)

## Estructura del proyecto

```
HospitalDR/
├── api/                          # Microservicio Node.js/Express (independiente del backend Laravel)
│   └── src/
│       ├── app.js                # Entry point Express
│       ├── controllers/          # auth, categoria, doctor
│       ├── services/             # Lógica de negocio
│       ├── repositories/         # Acceso a datos (MySQL)
│       ├── routes/               # Definición de endpoints
│       ├── middleware/           # authJwt.js
│       ├── database/mysql.js     # Conexión a MySQL
│       └── utils/hateoas.js
│
├── app/
│   ├── Console/Commands/GenerateSitemap.php   # Comando artisan sitemap:generate
│   ├── Http/Controllers/Controller.php
│   ├── Models/User.php
│   └── Providers/AppServiceProvider.php
│
├── database/
│   ├── migrations/               # doctores, especialidades, categorias_especialidad,
│   │                              # estudios, servicios, servicio_estudio, users, etc.
│   ├── factories/UserFactory.php
│   └── seeders/DatabaseSeeder.php
│
├── resources/
│   ├── css/app.css               # Entrada de Tailwind
│   ├── fonts/Aeonik/              # Fuente institucional (WOFF2 + licencia)
│   ├── js/
│   │   ├── app.js                # Bootstrap de Vue (createApp + router)
│   │   ├── App.vue                # Componente raíz → MainLayout
│   │   ├── layouts/Main.vue       # Layout con Header/Footer + <router-view>
│   │   ├── router/index.js        # Definición de rutas y scrollBehavior
│   │   ├── data/
│   │   │   ├── doctores.js        # Fuente de datos de los 49 doctores (schema normalizado)
│   │   │   └── directorioState.js # Estado reactivo compartido (filtros persistentes)
│   │   └── components/
│   │       ├── Header.vue
│   │       ├── Footer.vue
│   │       ├── Home.vue
│   │       ├── Nosotros.vue
│   │       ├── ServiciosLaboratorio.vue
│   │       ├── DirectorioMedico.vue   # Listado/buscador de doctores
│   │       ├── ListaMedicos.vue       # Tarjetas de la lista
│   │       └── Medicos.vue            # Vista de detalle de un doctor
│   ├── structured-data/hospital/organization.json   # JSON-LD (SEO)
│   └── views/
│       ├── components/main.blade.php   # Layout HTML base (meta tags, OG, Twitter Cards, @vite)
│       ├── home/index.blade.php        # Única vista real de entrada de la SPA
│       ├── nosotros/index.blade.php
│       ├── servicios/index.blade.php
│       └── directorio/{index,detalle}.blade.php
│
├── routes/
│   ├── web.php                   # Wildcard route → SPA
│   └── console.php
│
├── public/
│   ├── build/                    # Assets compilados por Vite (manifest.json + hashes)
│   ├── icons/                    # Favicons, logos (horizontal/vertical), PWA manifest
│   ├── images/                   # Doctores/, Home/, Nosotros/, Servicios/, directorio/
│   ├── video/institucional_HR2.mp4
│   └── sitemap.xml               # Generado por el comando sitemap:generate
│
├── tests/                        # Pest (Feature/Unit)
├── docker-compose.yml            # app (Laravel+Node), mysql, phpmyadmin
├── Dockerfile                    # php:8.3-fpm + Node 24 + Composer
├── vite.config.js
├── composer.json
└── package.json
```

## Rutas del sitio (Vue Router)

Definidas en `resources/js/router/index.js`:

| Path                          | Nombre    | Componente            | Descripción                              |
|--------------------------------|-----------|------------------------|-------------------------------------------|
| `/`                            | `inicio`  | `Home.vue`             | Página principal                          |
| `/quienes-somos`               | `nosotros`| `Nosotros.vue`         | Información institucional                 |
| `/servicios`                   | `servicios`| `ServiciosLaboratorio.vue` | Paquetes y estudios de laboratorio    |
| `/directorio-medico`           | `lista`   | `DirectorioMedico.vue` | Listado/buscador de médicos               |
| `/directorio-medico/:slug`     | `detalle` | `Medicos.vue`          | Ficha individual de cada doctor           |

**Comportamiento de scroll (`scrollBehavior`):**
- Al volver del detalle de un doctor (`detalle`) al listado (`lista`), **se conserva la posición de scroll** previa (no se resetea).
- Cualquier otra navegación sube al inicio de la página (`{ top: 0 }`).

En el servidor, `routes/web.php` define una única ruta comodín:

```php
Route::get('/{any?}', function () {
    return view('home.index');
})->where('any', '.*');
```

Esto delega **toda** la navegación al Vue Router del cliente.

## Módulo de Directorio Médico

Es la funcionalidad más elaborada del sitio:

- **`resources/js/data/doctores.js`** — Arreglo con los 49 registros de doctores, normalizado en los campos: `grado`, `gradoPrefijo`, `nombre`, `apellido`, `alias` y `slug`. El template consume `{{ doctor.gradoPrefijo }} {{ doctor.alias }}` para el nombre mostrado.
- **`resources/js/data/directorioState.js`** — Estado reactivo compartido (`reactive()`) que persiste la lista de `slugsFiltrados` entre la vista de listado y la de detalle, para que los filtros aplicados por el usuario (especialidad, búsqueda, etc.) no se pierdan al navegar entre doctores.
- **`DirectorioMedico.vue`** — Vista de listado/buscador con filtros.
- **`ListaMedicos.vue`** — Componente de tarjetas individuales dentro del listado.
- **`Medicos.vue`** — Vista de detalle de un doctor: incluye tarjetas informativas y un enlace `tel:` para llamada directa.

Cada uno de los 49 doctores tiene:
- Una imagen de perfil en `public/images/Doctores/{slug}.webp`.
- Una entrada correspondiente en el arreglo `slugsDoctores` del comando `GenerateSitemap`.
- Una ruta única `/directorio-medico/:slug` indexable en el `sitemap.xml`.

## API REST (Node.js)

Ubicada en `api/`, es un servicio **Express** independiente (no integrado a Laravel vía HTTP interno; se ejecuta y despliega por separado).

### Estructura (patrón en capas)

```
Controller → Service → Repository → MySQL (mysql2)
```

- **`controllers/`** — `auth.controller.js`, `categoria.controller.js`, `doctor.controller.js`
- **`services/`** — Lógica de negocio equivalente por dominio
- **`repositories/`** — Acceso a datos (`doctor.repository.js`, `ategoria.repository.js` — nombre de archivo tal cual está en el repo, nótese la falta de la "c" inicial)
- **`routes/`** — `auth.routes.js`, `categoria.routes.js`, `doctor.routes.js`, montadas en `app.js` bajo `/api/auth` y `/api/doctores`
- **`middleware/authJwt.js`** — Verificación de JWT para rutas protegidas
- **`database/mysql.js`** — Conexión/pool a MySQL
- **`utils/hateoas.js`** — Helpers para respuestas con enlaces HATEOAS

### Entrypoint (`api/src/app.js`)

```js
app.use('/api/auth', require('./routes/auth.routes'));
app.use('/api/doctores', require('./routes/doctor.routes'));
app.listen(process.env.PORT, () => console.log('API iniciada'));
```

> Nota: `categoria.routes.js` existe pero actualmente **no está montada** en `app.js`; revisar si falta agregarla.

### Ejecutar la API en desarrollo

```bash
cd api
npm install
npm run dev   # nodemon src/app.js
```

Requiere su propio archivo `api/.env` con al menos `PORT` y las credenciales de conexión a MySQL.

## Base de datos

Motor: **MySQL 8.0**, base de datos por defecto: `u932571146_HospitalDR` (ver `docker-compose.yml`).

Migraciones relevantes (`database/migrations/`):

- `create_doctores_table`
- `create_especialidades_table`
- `create_categorias_especialidad_table`
- `create_estudios_table`
- `create_servicios_table`
- `create_servicio_estudio_table` (tabla pivote)
- `create_users_table`, `create_password_reset_tokens_table`, `create_sessions_table`
- `create_cache_table`, `create_cache_locks_table`
- `create_jobs_table`, `create_job_batches_table`, `create_failed_jobs_table`
- Migraciones de `add_foreign_keys_to_*` para `doctores`, `especialidades` y `servicio_estudio`

El proyecto usa `kitloong/laravel-migrations-generator` como dependencia de desarrollo, lo que sugiere que el esquema pudo generarse a partir de una base de datos existente.

## Generación de Sitemap

Comando Artisan personalizado: **`app/Console/Commands/GenerateSitemap.php`**

```bash
php artisan sitemap:generate
php artisan sitemap:generate --url=https://hospitalhdr.com
```

- Genera `public/sitemap.xml` combinando:
  - **4 rutas estáticas**: inicio (`priority=1.0`), quiénes somos, servicios, directorio médico.
  - **N rutas dinámicas**: una por cada slug definido en el arreglo interno `$slugsDoctores` (actualmente 49 entradas), con `priority=0.6` y `changefreq=monthly`.
- Prioridad de resolución de la URL base: **`--url` (flag) → `APP_URL` del `.env` → `https://hospitalhdr.com`** (fallback de producción).
- Si detecta `127.0.0.1` o `localhost` en la URL base, **advierte y pide confirmación** antes de generar el sitemap (para evitar publicar accidentalmente URLs locales).

> ⚠️ Mantenimiento: el arreglo `$slugsDoctores` del comando debe mantenerse sincronizado manualmente con `resources/js/data/doctores.js`. Si agregas/quitas un doctor en el frontend, actualiza también este arreglo para que el sitemap sea consistente.

## Requisitos previos

- PHP ^8.2 con extensiones: `pdo_mysql`, `mbstring`, `exif`, `pcntl`, `bcmath`, `gd`
- Composer 2
- Node.js 24 (recomendado, según `Dockerfile`) y npm
- MySQL 8.0 (local o vía Docker)
- (Opcional) Docker + Docker Compose

## Instalación y puesta en marcha

### 1. Clonar e instalar dependencias

```bash
composer install
npm install
```

### 2. Configurar entorno

```bash
copy .env.example .env    # Windows (o `cp .env.example .env` en Unix)
php artisan key:generate
```

Configura en `.env` las credenciales de MySQL (host, base de datos `u932571146_HospitalDR` o la que definas, usuario y contraseña).

### 3. Migrar la base de datos

```bash
php artisan migrate
```

### 4. Levantar el entorno de desarrollo

Composer expone un script `dev` que corre en paralelo el servidor PHP, el listener de colas y Vite:

```bash
composer run dev
```

Esto ejecuta simultáneamente (`concurrently`):
- `php artisan serve`
- `php artisan queue:listen --tries=1`
- `npm run dev` (Vite en `http://0.0.0.0:5173`, con polling activado — útil en entornos con sistemas de archivos virtualizados, como Docker en Windows)

Alternativamente, por separado:

```bash
php artisan serve
npm run dev
```

### 5. (Opcional) Ejecutar la API Node.js

```bash
cd api
npm install
npm run dev
```

### 6. Generar el sitemap

```bash
php artisan sitemap:generate --url=https://hospitalhdr.com/
```

## Uso con Docker

El proyecto incluye `docker-compose.yml` con tres servicios:

| Servicio     | Imagen/Build      | Puertos              | Descripción                              |
|--------------|--------------------|-----------------------|--------------------------------------------|
| `app`        | `Dockerfile` (php:8.3-fpm + Node 24) | `8000` (Laravel), `5173` (Vite) | Aplicación Laravel + assets frontend |
| `mysql`      | `mysql:8.0`        | `3306`                | Base de datos `u932571146_HospitalDR`     |
| `phpmyadmin` | `phpmyadmin/phpmyadmin` | `8080`             | Administración visual de la BD            |

```bash
docker compose up -d --build
```

El contenedor `app` monta el proyecto completo como volumen (`.:/var/www`) y usa un volumen nombrado (`node_modules`) para no pisar las dependencias instaladas dentro del contenedor. Por defecto arranca con:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

> Nota: dentro de Docker probablemente necesitas ejecutar manualmente `npm run dev` (o `composer run dev`) dentro del contenedor `app` para levantar Vite en modo desarrollo, ya que el `CMD` del Dockerfile solo arranca el servidor de Laravel.

Accesos por defecto:
- App: `http://localhost:8000`
- Vite dev server: `http://localhost:5173`
- phpMyAdmin: `http://localhost:8080` (usuario `root`, contraseña `root`)

## Variables de entorno

Archivos `.env` relevantes:

- **Raíz (`.env`)** — Configuración estándar de Laravel: `APP_URL`, credenciales de base de datos, colas, caché, mail, etc. `APP_URL` es usado además como valor por defecto en `sitemap:generate` cuando no se pasa `--url`.
- **`.env.production`** — Variante de entorno para despliegue en producción.
- **`api/.env`** — Configuración propia del microservicio Node: típicamente `PORT`, credenciales de MySQL y secreto para firmar JWT.

> Ninguno de estos archivos debe compartirse ni subirse a control de versiones con datos reales; verifica que estén en `.gitignore`.

## Scripts disponibles

**Raíz del proyecto (`package.json` + `composer.json`):**

| Comando                     | Descripción                                                        |
|------------------------------|----------------------------------------------------------------------|
| `npm run dev`                | Levanta Vite en modo desarrollo                                     |
| `npm run build`               | Compila assets de producción (`public/build`)                       |
| `npm run preview`              | Sirve una vista previa del build de producción                      |
| `composer run dev`            | Levanta servidor PHP + queue listener + Vite en paralelo             |
| `composer run test`           | Limpia config y ejecuta la suite de tests (Pest)                     |
| `php artisan sitemap:generate`| Genera `public/sitemap.xml`                                          |

**`api/package.json`:**

| Comando        | Descripción                          |
|-----------------|----------------------------------------|
| `npm run dev`   | Levanta la API con nodemon (`src/app.js`) |

## Convenciones y notas de desarrollo

- El proyecto está desarrollado principalmente en **español** (nombres de variables, rutas, comentarios), consistente con el público objetivo del sitio (México).
- El componente `main.blade.php` centraliza todo el SEO on-page: `<title>`, `meta description`, Open Graph, Twitter Cards, `canonical`, favicons y el manifest PWA (`site.webmanifest`), recibiendo `title`, `description`, `image` y `url` como props configurables por vista.
- Existe un JSON-LD de tipo `Organization` en `resources/structured-data/hospital/organization.json` para SEO estructurado.
- La tipografía institucional es **Aeonik** (versión TRIAL), cargada en múltiples pesos como WOFF2 tanto en `resources/fonts/` (fuente original) como en `public/build/assets/` (hasheada por Vite tras el build).
- Vite está configurado con `usePolling: true` para el watcher de archivos, lo cual es necesario en entornos donde el sistema de archivos no emite eventos nativos de forma confiable (por ejemplo, Docker Desktop en Windows/macOS).
- El repositorio de la API tiene una inconsistencia de nombre de archivo: `repositories/ategoria.repository.js` (falta la "c" de "categoria"); tenerlo en cuenta al importarlo.
