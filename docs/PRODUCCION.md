# Pase a producción — GTG AR

## Estructura de URLs (igual que el sitio anterior)

| URL | Archivo | Idiomas |
|---|---|---|
| `/` · `/en/` · `/pt/` | `index.php` | es · en · pt |
| `/departamentos/` | `departamentos.php` | + `/en/…` `/pt/…` |
| `/agencias/` | `agencias.php` | ídem |
| `/hotelmanagement/` | `hotelmanagement.php` | ídem |
| `/sumate/` | `sumate.php` | ídem |
| `/club-de-puntos/` (fuera del menú) | `club-de-puntos.php` | ídem |
| `/terminos-y-condiciones-club-de-puntos/` | `terminos-y-condiciones-club-de-puntos.php` | ídem |
| `/politica-de-cookies/` | `politica-de-cookies.php` | ídem |
| `/politica-de-privacidad-de-grupo-tierra-gaucha/` | `politica-de-privacidad.php` | ídem |
| cualquier otra | `404.php` (status 404) | según prefijo |

Las reglas están en `.htaccess`. Redirecciones 301 de URLs viejas: `index_en.php`, `trabaje-con-nosotros*.php`,
`politica-cookies*.php`, `politica-privacidad*.php`, `*_en.php`, `clubdepuntos/`, y acceso directo a `pagina.php`.

Todas las URLs se arman con `url()` y `BASE` (config.php), así que el mismo código funciona en `/2026/` y en la raíz.

## Pasos

1. **Backup completo** de la raíz actual (archivos + `.htaccess`).
2. Copiar el contenido de `/2026/` a la raíz **excepto** `docs/` y `router.php` (solo para desarrollo local).
3. Reemplazar el `.htaccess` de la raíz por el de `/2026/` (ya incluye HTTPS y www).
4. **Mantener** la carpeta `/hotelmanagement/` con `Brochure-GTG-Management-V2.pdf`: los mails ya enviados apuntan ahí.
   (El sitio nuevo usa `assets/docs/brochure-gtg-hotel-management.pdf`.)
5. Archivos viejos de la raíz (`include_*.php`, `index_en.php`, `css/`, `js/`, `images/`, etc.): se pueden borrar después
   de verificar; las URLs públicas viejas ya redirigen.
6. En staging (`/2026/`) el sitio lleva `noindex`; en la raíz se quita solo (depende de `BASE`).
7. Verificar: formulario de Hotel Management (reCAPTCHA solo funciona en el dominio registrado), links de idioma, 404.

## Desarrollo local

- Apache de XAMPP: `http://localhost/gtg/2026/` (junction `C:\xampp\htdocs\gtg` → carpeta `Site AR`). Usa el `.htaccess` real.
- Alternativa: `php -S 127.0.0.1:8099 router.php` desde `/2026` (se cuelga con varias conexiones de Chrome; preferir Apache).

## Pendientes

- Cifras: se usa 13 hoteles en todo el sitio (en realidad son 11; se actualiza junto con los PDFs del cliente).
- CMS: promociones (hacer configurables los "promo-details"). La grilla ya se adapta sola: 2 promos = 2 columnas, 3 = 3, más = carrusel.
- Versiones A/B a decidir: `?hoteles=v1|v2`, `?buscador=v1|v2`, `?contadores=hero|nosotros` (por defecto, las nuevas).
- Motor de reservas: conectado (portal idPortal=25 + idHotel de cada hotel en `data/hoteles.php`, campo `motor`). Concept Buenos Aires (2925) en refacción.
- Logos SVG, info del Grupo (sección Servicios oculta).
