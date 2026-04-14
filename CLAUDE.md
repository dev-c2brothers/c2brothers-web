# CLAUDE.md — Contexto de desarrollo C² Brothers

## El negocio

**C² Brothers** es una empresa fundada por dos hermanos (un desarrollador de software y un perfil de gestión/ventas) que ofrece software a medida para pequeños negocios en España. No venden productos estándar — cada proyecto empieza escuchando cómo funciona el negocio del cliente.

**Propuesta de valor:** Digitalización accesible, rápida y sin costes ocultos para negocios que aún trabajan en papel o Excel.

**Clientes objetivo (B2B):** Hostelería, talleres mecánicos, pequeña industria, comercio, distribución, salud y bienestar.

**Dominio:** c2brothers.es _(pendiente de compra — usar localhost:8000 en desarrollo)_

### Estado actual de la empresa

La empresa está en fase de arranque. El primer producto existente es una **app de gestión de stock con IA** (en desarrollo). La web corporativa que se construye aquí es la carta de presentación para conseguir los primeros clientes — no necesita un blog ni funcionalidades complejas de WordPress, solo una landing page bien hecha que convierta visitas en contactos.

---

## Sistema de diseño

### Paleta de colores (variables CSS)

```css
--navy:    #0D1F3C   /* fondo principal oscuro */
--navy2:   #162D54   /* variante navy */
--teal:    #2DD4BF   /* color de acento principal */
--teal2:   #14B8A6   /* acento hover/variante */
--white:   #FFFFFF
--gray50:  #F8FAFC
--gray100: #F1F5F9
--gray300: #CBD5E1
--gray500: #64748B
--gray700: #334155
--radius:  12px
```

### Tipografía

- **Familia:** Inter (Google Fonts)
- **Pesos usados:** 300, 400, 500, 600, 700, 800
- **Carga:** `https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap`

### Principios visuales

- Secciones alternas: navy oscuro / gris claro / blanco
- Elementos de acento siempre en teal
- Bordes sutiles: `rgba(255,255,255,0.08)` sobre fondos oscuros, `var(--gray100)` sobre fondos claros
- Cards con `box-shadow: 0 2px 12px rgba(0,0,0,0.04)`
- Hover en cards: `translateY(-4px)` + `box-shadow` con teal
- Radios: 12px base, 16px en cards de secciones, 20px en cards grandes

---

## Arquitectura del tema WordPress

El tema personalizado vive en `wp-content/themes/c2brothers/`. **No tocar los temas por defecto.**

### Archivos del tema

| Archivo | Propósito |
|---------|-----------|
| `style.css` | Header del tema (nombre, versión) — mínimo CSS aquí |
| `functions.php` | Enqueue de Inter + `main.css` + `main.js`, `add_theme_support()` |
| `front-page.php` | Plantilla completa de la home (todas las secciones en orden) |
| `header.php` | Nav fija con logo y menú |
| `footer.php` | Footer + `wp_footer()` |
| `page.php` | Plantilla genérica para páginas internas (si las hay) |
| `assets/css/main.css` | Todo el CSS del mockup |
| `assets/js/main.js` | Scroll suave + toggle menú móvil |

### Estructura de `front-page.php`

```
get_header()
  #hero
  #nosotros
  #como
  #sectores
  #porque
  #contacto  ← shortcode de Contact Form 7
get_footer()
```

---

## Secciones de la página (contenido de referencia)

### Hero
- Badge: "Software a medida para tu negocio"
- H1: "Digitalizamos tu negocio con **soluciones simples** que funcionan"
- Descripción: "Desarrollamos software pequeño y efectivo para que los negocios de siempre puedan trabajar mejor, sin complicaciones ni grandes inversiones."
- CTAs: "Hablemos de tu negocio" (→ #contacto) + "Cómo trabajamos" (→ #como)
- Visual card (3 filas): Escuchamos el problema / Construimos la solución / Te acompañamos

### Nosotros
- "Dos hermanos, un objetivo: hacer la tecnología accesible"
- 4 stat cards: `100%` a medida · `2x` más rápidos · `0` costes ocultos · `∞` soporte post-lanzamiento

### Cómo trabajamos
- Fondo navy. 4 pasos en grid: 1. Escuchamos → 2. Diseñamos → 3. Desarrollamos → 4. Acompañamos
- Línea decorativa horizontal conectando los números

### Sectores
- 6 cards: Hostelería 🍽️ · Talleres 🔧 · Industria 🏭 · Comercio 🛒 · Salud 🏥 · Otros 📦

### Por qué nosotros
- 6 cards: Primero entendemos · Soluciones rápidas · Precios justos · Software que evoluciona · Trato cercano · Foco en el resultado

### Contacto
- Fondo navy gradient. Datos: email `hola@c2brothers.es` · WhatsApp/Teléfono · Respuesta <24h · España/Remoto
- Formulario: nombre, empresa, email, sector (select), mensaje

---

## Formulario de contacto

Plugin: **Contact Form 7**. Crear un formulario con los campos del mockup e insertar el shortcode en `front-page.php`. El CSS del formulario debe sobrescribirse para mantener el estilo del diseño (fondo semitransparente, bordes rgba, labels blancos).

---

## Convenciones de desarrollo

- Todo el trabajo en `wp-content/themes/c2brothers/` — nunca en temas por defecto
- CSS en `assets/css/main.css` — no usar `style.css` para estilos de presentación
- No usar page builders (Elementor, etc.)
- El sitio es una single-page con anclas — los posts/páginas adicionales de WordPress se ignoran en la home
- Idioma del sitio: español (es_ES)
- Permalinks: `/%postname%/`

---

## Entorno Docker

```bash
# Levantar
docker compose up -d

# Parar
docker compose down

# Logs WordPress
docker compose logs -f wordpress

# Acceder a la BD directamente
docker exec -it wordpress_local-database-1 mysql -u root -p
```

| Contenedor | Servicio | Puerto |
|-----------|---------|--------|
| `wordpress_local-wordpress-1` | WordPress | :8000 |
| `wordpress_local-phpmyadmin-1` | phpMyAdmin | :8080 |
| `wordpress_local-database-1` | MySQL 8.0 | 3306 (interno) |

---

## Próximos pasos (orden recomendado)

1. Crear el tema `c2brothers` con la estructura mínima (`style.css`, `functions.php`, `index.php`)
2. Activar el tema en WP Admin → Apariencia → Temas
3. Configurar WordPress: título, idioma, permalinks, página estática de inicio
4. Trasladar el HTML del mockup a `front-page.php` + `assets/css/main.css`
5. Instalar y configurar Contact Form 7
6. Adaptar el formulario de contacto al estilo del diseño
7. Añadir menú de WordPress para que el nav sea editable desde el panel
8. Revisar responsive (breakpoints en 900px y 600px)
9. Apuntar el dominio `c2brothers.es` cuando esté disponible

---

## Referencia de diseño

El mockup HTML completo está en `design/mockup.html`. Es la fuente de verdad visual del proyecto.
