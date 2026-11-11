# Grupo Tierra Gaucha (GTG) — Sitio institucional Argentina

Documento de contexto del proyecto. **Leelo completo antes de crear o modificar archivos.**

---

## 1. Resumen

Rediseño del sitio institucional de **Grupo Tierra Gaucha** (cadena hotelera de San Carlos de Bariloche, +10 años). Reemplaza a https://www.grupotierragaucha.com.ar/.

- Objetivo: sitio **moderno, limpio y minimalista**.
- Referencias de diseño:
  - **Yatriiworld** (template HTML de viajes): hero slider a pantalla completa con etiqueta chica sobre títulos grandes, tabs que filtran tarjetas, banners con fondo fijo, contadores, tarjetas con overlay en hover.
  - **DOT Hotels** (dot-hotels.com): mucho aire, fondos claros, tipografía sobria, buscador superpuesto al hero, tarjetas de hotel con subcategoría debajo del nombre, tarjetas de promo con datos en íconos (noches, personas, incluye, precio), íconos lineales, WhatsApp flotante.
  - **Parallax**: como la banda "Tierra Gaucha Viagens" de grupotierragaucha.com.br (franja ancho completo, imagen de fondo, título encima).
- Más adelante se desarrollará un **CMS** propio. Por eso todo el contenido dinámico vive en `/data/*.php` (arrays) y las vistas solo iteran. Cuando exista el CMS, se cambia la fuente de datos por la base y las vistas no se tocan.
- Luego se harán los sitios de GTG **Brasil** y **Chile** con la misma base.

---

## 2. Stack y reglas obligatorias

- **PHP** (sin framework) + **Bootstrap 5.3**.
- **NADA por CDN.** Todas las librerías descargadas en `/assets/vendor/`. **Única excepción: Google Fonts.**
- JS con `defer`. Imágenes con `loading="lazy"` (excepto el primer slide del hero), formato **WebP** preferido, con `width`/`height` para evitar saltos de layout.
- Sin jQuery.

### Librerías (descargar a `/assets/vendor/`)

| Librería | Uso | Carpeta |
|---|---|---|
| Bootstrap 5.3 (css + bundle.js) | Base / grilla / navbar / modal | `assets/vendor/bootstrap/` |
| Swiper | Hero, hoteles, promos, logos, galería mobile | `assets/vendor/swiper/` |
| AOS | Animaciones al scroll (`once: true`, `duration: 800`, `offset: 80`) | `assets/vendor/aos/` |
| GLightbox | Lightbox de la galería | `assets/vendor/glightbox/` |
| Phosphor Icons (webfont, estilo *light*) | Íconos lineales de servicios, promos, contacto | `assets/vendor/phosphor/` |
| Flatpickr | Calendario check-in / check-out del buscador | `assets/vendor/flatpickr/` |

**Parallax:** script propio en `assets/js/parallax.js` (IntersectionObserver + `transform: translate3d`, con `requestAnimationFrame`). **No usar `background-attachment: fixed`** (no funciona en iOS). Desactivar con `prefers-reduced-motion`.

**Contadores:** script propio en `assets/js/main.js` con IntersectionObserver.

---

## 3. Identidad visual

### Colores

```css
:root {
  --gtg-dark:   #262828;  /* logo normal, textos principales, footer */
  --gtg-gold:   #af9968;  /* logo (dorado), hover de botones, detalles */
  --gtg-accent: #c2ab86;  /* botones y títulos */
  --gtg-cream:  #f3eee7;  /* fondos alternos */
  --gtg-white:  #ffffff;  /* fondo principal */
}
```

- Logo versión normal: `#262828` + `#af9968`. Versión blanca (sobre hero/fondos oscuros): blanco + `#af9968`.
- Secciones alternan fondo blanco y `--gtg-cream`.
- **Accesibilidad:** `#c2ab86` sobre blanco tiene bajo contraste para texto chico. Usarlo en **títulos grandes** y como **fondo de botones con texto `--gtg-dark`**. En hover, el botón pasa a `--gtg-gold`. Textos corridos siempre en `--gtg-dark`.

### Tipografía (Google Fonts)

- Títulos: **Cormorant Garamond** (500/600).
- Textos, menú y botones: **Jost** (300/400/500).
- Etiquetas chicas sobre títulos (estilo Yatriiworld): Jost 500, mayúsculas, `letter-spacing: .2em`, color `--gtg-gold`.

### Estilo general

- Mucho espacio en blanco: secciones con `padding: 100px 0` (60px en mobile).
- Bordes rectos o radio mínimo (4px). Sombras muy suaves.
- Botones: mayúsculas, letter-spacing, sin radio grande.

---

## 4. Estructura de carpetas

```
/
├── index.php
├── config.php                  # constantes del sitio (ver sección 6)
├── PROYECTO.md
├── includes/
│   ├── head.php                # <head>, meta, fonts, css
│   ├── header.php              # navbar
│   ├── footer.php              # footer + logos de marcas
│   ├── scripts.php             # js vendor + propios
│   └── whatsapp.php            # botón flotante
├── sections/
│   └── home/
│       ├── hero.php
│       ├── marcas.php          # franja de logos de hoteles y agencias
│       ├── nosotros.php
│       ├── hoteles.php
│       ├── servicios.php
│       ├── promociones.php
│       ├── bariloche-experience.php
│       ├── club-puntos.php
│       ├── destinos.php        # Brasil y Chile
│       └── galeria.php
├── data/
│   ├── slides.php
│   ├── hoteles.php
│   ├── marcas.php
│   ├── servicios.php
│   ├── promociones.php
│   └── galeria.php
├── lang/
│   └── es.php                  # textos fijos de la interfaz (preparado para en.php / pt.php)
└── assets/
    ├── css/
    │   └── style.css
    ├── js/
    │   ├── main.js
    │   └── parallax.js
    ├── vendor/                 # librerías descargadas (sección 2)
    └── img/                    # ver sección 5
```

---

## 5. Imágenes — `assets/img/`

Gus sube las imágenes a estas carpetas. **Usar exactamente estas rutas.** Si una imagen no existe todavía, usar un placeholder gris (`assets/img/placeholder.webp`) sin romper el layout.

```
assets/img/
├── logo/
│   ├── logo-gtg.svg            # versión normal (#262828 + #af9968)
│   ├── logo-gtg-blanco.svg     # versión blanca
│   └── favicon.png
├── hero/
│   ├── slide-01.webp           # desktop 1920x1080
│   ├── slide-01-mobile.webp    # mobile 800x1200
│   └── ...
├── hoteles/                    # foto principal de cada hotel, 800x1000 (vertical)
│   └── {slug}.webp
├── marcas/                     # logos de hoteles y agencias (PNG/SVG fondo transparente)
│   └── {slug}.png
├── agencias/
│   └── bariloche-experience.webp   # foto del bloque destacado
├── destinos/
│   ├── brasil.webp             # fondo parallax
│   └── chile.webp
├── promociones/
│   └── {slug}.webp
├── galeria/
│   └── 01.webp, 02.webp, ...
├── parallax/
│   └── club-puntos.webp
└── placeholder.webp
```

---

## 6. `config.php`

```php
define('SITE_NAME', 'Grupo Tierra Gaucha');
define('SITE_URL', 'https://www.grupotierragaucha.com.ar');
define('WHATSAPP', '5492944341212');              // ¡SIN el "15"!
define('TELEFONO_TXT', '+54 9 2944 34-1212');
define('EMAIL', 'centralreservas@grupotierragaucha.com.ar');
define('DIRECCION', 'Moreno 136, S. C. de Bariloche');
define('MAPS_URL', 'https://maps.app.goo.gl/9Vc7V7jJSrDjCM7a7');
define('BOOKING_URL', '');                        // motor propio de GTG (a definir)
define('SOCIAL', [
  'facebook'  => 'https://www.facebook.com/GrupoTierraGaucha/',
  'instagram' => 'https://www.instagram.com/grupotierragaucha/',
  'linkedin'  => 'https://www.linkedin.com/company/grupo-tierra-gaucha/',
  'tiktok'    => 'https://www.tiktok.com/@grupotierragaucha',
]);
```

Todos los links de WhatsApp se generan con una función helper `wa_link($texto)` que usa la constante `WHATSAPP` (nunca números escritos a mano).

---

## 7. Menú (header)

Header **transparente sobre el hero** con logo blanco. Al hacer scroll pasa a fondo blanco con logo normal y sombra suave.

1. Hoteles
2. Departamentos
3. Promociones
4. Agencias
5. Club de Puntos
6. **Hotel Management** (por pedido del cliente, va en el menú superior)
7. Contacto
8. Selector de idioma: ES / EN / PT (PT enlaza a grupotierragaucha.com.br)
9. Botón **Reservar** (`--gtg-accent`)

En mobile: offcanvas de Bootstrap.

---

## 8. Home — secciones en orden

### 8.1 Hero (`hero.php`)
- Swiper fullscreen (`100vh`), efecto `fade`, autoplay 6s, zoom lento tipo Ken Burns en la imagen activa.
- Imagen distinta para mobile (`<picture>`).
- Overlay oscuro suave. Etiqueta chica + título grande en Cormorant + logo GTG blanco.
- **Buscador superpuesto** abajo (estilo DOT): Hotel (select con todos los hoteles + "Todos los hoteles"), Check-in, Check-out (Flatpickr, rango), Adultos (1–6), Menores (0–6), botón **Reservar**. Envía al motor propio de GTG (`BOOKING_URL`). Mientras no esté definido, el botón abre WhatsApp con los datos cargados.

### 8.2 Franja de marcas (`marcas.php`)
- Justo debajo del hero. **Todos los logos** de hoteles y agencias (`data/marcas.php`).
- Swiper en loop continuo (autoplay lineal tipo marquee). Logos en escala de grises, color al hover.

### 8.3 Somos GTG (`nosotros.php`)
- Fondo blanco. Etiqueta "GRUPO TIERRA GAUCHA" + título.
- Texto: "Somos Grupo Tierra Gaucha, una cadena hotelera joven y dinámica con más de una década de experiencia en el sector. Nos dedicamos a transformar tu viaje en una experiencia integral e inolvidable."
- 3 pilares con ícono:
  - **Ubicaciones privilegiadas** — Hoteles con diseño acogedor y elegante en los puntos más emblemáticos.
  - **Calidad y profesionalismo** — Garantizamos la mejor relación precio-calidad del mercado.
  - **Experiencia 360°** — Conectamos tus estadías con el mejor turismo local mediante nuestras agencias, especialistas en excursiones y traslados personalizados.
- Banda de contadores animados (valores a confirmar por el cliente): Hoteles, Años de experiencia, Destinos, Agencias.

### 8.4 Hoteles (`hoteles.php`)
- Fondo `--gtg-cream`. Etiqueta "DESCUBRÍ TU LUGAR" + título "Conocé nuestros hoteles".
- Tabs para filtrar: **Todos · Bariloche · Buenos Aires · Brasil**.
- Swiper de tarjetas verticales: foto, nombre (Cormorant), tipo/ubicación debajo (estilo "by DOT Boutique"), botones "Ver hotel" (web del hotel, `target="_blank"`) y "Reservar".

### 8.5 Servicios (`servicios.php`)
- Fondo blanco. Etiqueta "GRUPO TIERRA GAUCHA" + título "Algunos de nuestros servicios".
- Grilla con los **8 destacados** (`destacado => true`) con íconos Phosphor light en `--gtg-gold`. Botón "Ver todos los servicios" despliega el resto (Bootstrap collapse).

### 8.6 Promociones (`promociones.php`)
- Fondo `--gtg-cream`. Etiqueta "PROMOCIONES" + bajada: "Beneficios en todas las temporadas del año, en la mejor cadena de hoteles en Bariloche."
- Swiper de tarjetas estilo DOT: imagen, título, filas con íconos (noches mínimas, medio de pago, condición), botón "Más información" → WhatsApp con texto precargado.
- Popup opcional (modal) para la promo que tenga `popup => true` (ej. Black Friday). Se muestra una vez por sesión (`sessionStorage`).

### 8.7 Bariloche Experience (`bariloche-experience.php`)
- Bloque destacado a ancho completo, imagen con **parallax** + panel de texto.
- Logo de Bariloche Experience, texto:
  "Viví Bariloche al máximo con propuestas únicas pensadas para cada estilo de viajero. Ya sea que busques aventura en la naturaleza o prefieras descansar en paisajes tranquilos, acá encontrarás todo lo necesario para unas vacaciones inolvidables. ¡Tu paraíso está en Bariloche!"
- Botón "Ver tours" → https://www.barilocheexperience.com.ar
- Nota: en cada país se destaca la agencia local (AR: Bariloche Experience; BR: Foz Experience). Las tres agencias aparecen en la franja de marcas y en el footer.

### 8.8 Club de Puntos (`club-puntos.php`)
- Banda angosta estilo DOT Rewards con fondo parallax: título, 3 beneficios con check, botón "Conocer más".

### 8.9 Otros destinos — Brasil y Chile (`destinos.php`)
- Etiqueta "OTROS DESTINOS". Dos paneles lado a lado (apilados en mobile), cada uno con imagen de fondo **parallax**, overlay y título grande:
  - **BRASIL** → https://www.grupotierragaucha.com.br
  - **CHILE** → https://www.grupotierragaucha.cl

### 8.10 Galería (`galeria.php`) — arriba del footer
- Galería genérica. Grilla tipo masonry en desktop (4 columnas), Swiper en mobile.
- GLightbox para ampliar. Hover con leve zoom.

### 8.11 Footer (`footer.php`)
- Fondo `--gtg-dark`, logo blanco.
- Texto: "Grupo Tierra Gaucha es una cadena joven y dinámica que desarrolla, comercializa y opera desde hace más de 10 años en San Carlos de Bariloche. Nuestra filosofía se basa en ofrecer una excelente relación precio-calidad, siguiendo criterios de estricta profesionalidad."
- Contacto (teléfono, email, dirección con link a Maps) y redes.
- "FORMAN PARTE DE GRUPO TIERRA GAUCHA": **todos los logos** de `data/marcas.php`.
- Links: Política de Cookies · Política de Privacidad · Trabajá con Nosotros.
- © año dinámico.

### 8.12 WhatsApp flotante (`whatsapp.php`)
- Abajo a la derecha, usando `wa_link()`.

---

## 9. Datos iniciales (`/data/`)

### `hoteles.php`
Campos: `slug`, `nombre`, `tipo`, `ubicacion`, `filtro` (bariloche | buenos-aires | brasil), `url`, `imagen`, `logo`.

| slug | nombre | ubicación / filtro | url |
|---|---|---|---|
| pioneros-suites | Pioneros Suites | Bariloche | https://www.pionerossuites.com.ar/ |
| concept-bariloche | Hotel Concept Bariloche | Bariloche | https://www.hotelconceptbariloche.com.ar |
| hotel-bariloche | Hotel Bariloche by Tierra Gaucha | Bariloche | https://hotelbarilochebytierragaucha.com.ar/ |
| hotel-plaza | Hotel Plaza Bariloche | Bariloche | https://www.hotelplazabariloche.com/ |
| hotel-tierra-gaucha | Hotel Tierra Gaucha | Bariloche | https://hoteltierragaucha.com.ar/ |
| lake-apartments | Lake Apartments | Bariloche | https://lakeapartments.com.ar/ |
| m382 | Hotel M382 | Bariloche | https://m382hotelbariloche.com.ar/ |
| m383 | Hotel M383 | Bariloche | https://m383hotelbariloche.com.ar/ |
| tierra-gaucha-boutique | Tierra Gaucha Hotel Boutique | Bariloche | https://www.tierragauchahotelboutique.com.ar/ |
| concept-buenos-aires | Hotel Concept Buenos Aires | Buenos Aires | https://hotelconceptbuenosaires.com.ar/ |
| suica-iguacu | Hotel Suiça Iguaçu | Foz do Iguaçu / brasil | https://www.hotelsuicaiguacu.com.br/ |

`tipo` (Hotel, Boutique, Suites, Apartamentos…) queda **a confirmar** por el cliente.

### `marcas.php`
Los 11 hoteles anteriores + las 3 agencias:
- Bariloche Experience — https://www.barilocheexperience.com.ar — `bariloche-experience.png`
- Foz Experience — https://www.fozexperience.com.br — `foz-experience.png`
- Tierra Gaucha Viagens — https://tierragauchaviagens.com.br/ — `tierra-gaucha-viagens.png`

### `servicios.php`
Campos: `nombre`, `icono` (clase Phosphor), `destacado` (bool).
Destacados: Desayuno, WiFi alta conectividad, Recepción 24 hs, Céntricos, Vista al lago, Spa, Pileta, Pet friendly.
Resto: Caja fuerte, Áreas de trabajo, Cerradura electrónica, Guarda equipaje, Parking, Ascensor – accesibilidad, Media pensión, Cantidad de habitaciones, Frigobar, Patio exterior, Restaurante, Bar, Salón de eventos, Espacio infantil, Cocina, Espacio motorhome.

### `promociones.php`
Campos: `slug`, `titulo`, `bajada`, `detalles` (array de [icono, texto]), `imagen`, `wa_texto`, `popup` (bool), `activa` (bool).
1. **15% OFF abonando con transferencia bancaria** — mínimo 3 noches consecutivas.
2. **Pagá tu estadía en cuotas** — con todas las tarjetas.
3. **Black Friday: 40% OFF** — mínimo 3 noches, pago por transferencia, no acumulable. `popup => true`.

### `galeria.php` y `slides.php`
Arrays de rutas a `assets/img/galeria/` y `assets/img/hero/` (+ textos de cada slide).

---

## 10. Páginas internas (etapa siguiente)

`hoteles.php`, `departamentos.php`, `promociones.php`, `agencias.php`, `club-de-puntos.php`, `hotel-management.php`, `contacto.php`, `politica-de-cookies.php`, `politica-de-privacidad.php`, `sumate.php`. Reutilizan includes y `/data/`.

---

## 11. Pendientes del cliente

- [ ] Integración del motor de reservas propio de GTG (URL y parámetros).
- [ ] Tipo de cada hotel.
- [ ] Valores de los contadores.
- [ ] Textos del Club de Puntos.
- [ ] Imágenes en `assets/img/`.
