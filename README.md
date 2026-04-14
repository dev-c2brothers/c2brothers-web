# C² Brothers — Web Corporativa

Sitio web B2B de **C² Brothers**, empresa de software a medida para pequeños negocios. Desarrollado sobre WordPress con entorno Docker local.

**Dominio objetivo:** c2brothers.es _(pendiente de compra)_

---

## Stack

| Servicio     | Imagen                   | Puerto local |
|-------------|--------------------------|-------------|
| WordPress   | `wordpress:latest`       | `:8000`     |
| phpMyAdmin  | `phpmyadmin/phpmyadmin`  | `:8080`     |
| MySQL       | `mysql:8.0`              | `3306` (interno) |

---

## Setup local (desde cero)

### Requisitos

- Docker Desktop (o Docker Engine + Docker Compose)
- WSL2 (en Windows)

### 1. Clonar el repositorio

```bash
git clone <url-del-repo>
cd c2brothers-web
```

### 2. Levantar el entorno

```bash
docker compose up -d
```

Esto levanta WordPress en `:8000`, phpMyAdmin en `:8080` y MySQL. La primera vez descarga las imágenes y puede tardar un par de minutos.

### 3. Instalar WordPress

Abre `http://localhost:8000` y completa el asistente:

| Campo | Valor |
|-------|-------|
| Idioma | Español (España) |
| Título del sitio | `C² Brothers` |
| Usuario | el que quieras |
| Contraseña | la que quieras |
| Email | el tuyo |

### 4. Configurar WordPress (WP Admin)

- **Ajustes → General:** Título `C² Brothers`, idioma `es_ES`
- **Ajustes → Lectura:** Página de inicio estática → seleccionar cualquier página (o crear una llamada "Inicio")
- **Ajustes → Enlaces permanentes:** seleccionar `/%postname%/` y guardar

### 5. Activar el tema

**Apariencia → Temas → C2 Brothers → Activar**

### 6. Crear el menú de navegación

**Apariencia → Menús:**

1. Crear menú llamado `Principal`
2. Añadir enlaces personalizados:
   | URL | Texto |
   |-----|-------|
   | `#nosotros` | Nosotros |
   | `#como` | Cómo trabajamos |
   | `#sectores` | Sectores |
   | `#porque` | Por qué nosotros |
   | `#contacto` | Contacto |
3. Asignar a posición **Menú principal**
4. Guardar menú

### 7. Instalar y configurar Contact Form 7

1. **Plugins → Añadir nuevo → Contact Form 7 → Instalar y activar**
2. **Contact → Añadir nuevo** → crear formulario con este contenido:

```
<div class="form-row">
<div class="form-group">
<label for="nombre">Nombre</label>
[text* nombre id:nombre placeholder "Tu nombre"]
</div>
<div class="form-group">
<label for="empresa">Empresa / Negocio</label>
[text empresa id:empresa placeholder "Nombre de tu negocio"]
</div>
</div>
<div class="form-group">
<label for="email">Email</label>
[email* email id:email placeholder "tu@email.com"]
</div>
<div class="form-group">
<label for="sector">Sector</label>
[select sector id:sector "Hostelería / Restauración" "Taller / Servicio técnico" "Industria / Logística" "Comercio / Distribución" "Salud / Bienestar" "Otro"]
</div>
<div class="form-group">
<label for="mensaje">¿Cuál es tu principal problema o necesidad?</label>
[textarea* mensaje id:mensaje placeholder "Cuéntanos qué proceso te da más problemas o qué te gustaría mejorar en tu negocio..."]
</div>
[submit class:form-btn "Enviar mensaje →"]
```

3. En la pestaña **Correo**: campo **Para** → `tu-email@dominio.com`
4. Guardar y copiar el shortcode generado (ej: `[contact-form-7 id="abc123" title="Contacto C2 Brothers"]`)
5. Pegar el shortcode en `wp-content/themes/c2brothers/front-page.php` en la línea del `do_shortcode`

### 8. Configurar envío de emails (FluentSMTP)

1. **Plugins → Añadir nuevo → FluentSMTP → Instalar y activar**
2. Seleccionar **Servidor SMTP** y configurar con tu servicio de correo (Gmail recomendado con contraseña de app)

| Campo | Valor |
|-------|-------|
| SMTP Host | `smtp.gmail.com` |
| SMTP Port | `587` |
| Encryption | `TLS` |
| Authentication | activado |
| SMTP Username | tu Gmail |
| SMTP Password | contraseña de app (16 caracteres) |

---

## URLs de acceso

| Servicio    | URL                            |
|------------|-------------------------------|
| WordPress  | http://localhost:8000         |
| WP Admin   | http://localhost:8000/wp-admin |
| phpMyAdmin | http://localhost:8080         |

---

## Comandos útiles

```bash
# Levantar
docker compose up -d

# Parar
docker compose down

# Logs WordPress
docker compose logs -f wordpress

# Acceder a la BD
docker exec -it <nombre-contenedor-db> mysql -u root -p
```

---

## Estructura del proyecto

```
c2brothers-web/
├── wp-content/
│   └── themes/
│       └── c2brothers/          # Tema personalizado (desarrollo activo)
│           ├── style.css
│           ├── functions.php
│           ├── front-page.php
│           ├── header.php
│           ├── footer.php
│           └── assets/
│               ├── css/main.css
│               └── js/main.js
├── design/
│   └── mockup.html              # Mockup HTML del diseño original
├── docker-compose.yml           # Entorno Docker
├── uploads.ini                  # Configuración PHP (límites de subida)
├── .gitignore
├── CLAUDE.md                    # Contexto para desarrollo con Claude Code
└── README.md
```

> `wp_data/` (runtime de WordPress) está en `.gitignore` y no se sube al repo.

---

## Tema personalizado

Todo el desarrollo de la interfaz va en `wp-content/themes/c2brothers/`. No modificar los temas por defecto.

---

## Secciones del sitio

1. **Nav** — Logo + enlaces internos + CTA "Contáctanos"
2. **Hero** — Headline, descripción, botones CTA + card visual
3. **Nosotros** — Texto de empresa + 4 stat cards
4. **Cómo trabajamos** — 4 pasos: Escuchamos → Diseñamos → Desarrollamos → Acompañamos
5. **Sectores** — 6 sectores objetivo
6. **Por qué nosotros** — 6 diferenciadores
7. **Contacto** — Datos de contacto + formulario CF7
8. **Footer** — Logo + copyright
