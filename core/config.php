<?php
/**
 * Grupo Tierra Gaucha — configuración común a los 4 sitios (.com.ar, .com, .com.br, .cl).
 * Lo que cambia en cada sitio está en sitio.php (viene de sitios/{xx}/sitio.php al hacer el build).
 * Ver README.md y docs/PROYECTO.md.
 */

define('ROOT', __DIR__);
define('PLACEHOLDER', 'placeholder.webp');

$GLOBALS['GTG_SITIO'] = require ROOT . '/sitio.php';

/** Dato de configuración del sitio (sitio.php). */
function sitio($clave, $defecto = null)
{
  return array_key_exists($clave, $GLOBALS['GTG_SITIO']) ? $GLOBALS['GTG_SITIO'][$clave] : $defecto;
}

// ---- Comunes a todos los sitios ----------------------------------------------
define('SITE_NAME', 'Grupo Tierra Gaucha');
define('SITIO_AR', 'https://www.grupotierragaucha.com.ar');   // sitio principal: páginas que los otros no tienen (Hotel Management, Club de Puntos)
define('WHATSAPP_DEPTOS', '5492944514583');       // Lake Apartments
define('WHATSAPP_HM', '5492944534224');           // Hotel Management
define('EMAIL_HM', 'hotelmanagement@grupotierragaucha.com.ar');
define('EMAIL_RRHH', 'seleccion@grupotierragaucha.com.ar');
// reCAPTCHA v2 (dominio grupotierragaucha.com.ar; para usarlo en otro dominio hay que sumarlo en la consola de Google)
define('RECAPTCHA_SITE', '6LfkcS4sAAAAAJWf9A9SY2VBdwVXLFpXqTgMy_7l');
define('RECAPTCHA_SECRET', '6LfkcS4sAAAAAMO4UVJhAo7FBj2sEGPlhAHRhmrX');
// Motor de reservas. "Todos los hoteles" -> portal del Grupo; un hotel -> su motor (host + idHotel en data/hoteles.php).
// {lang} se reemplaza por el idioma (portal: es/en/pt · hotel: es-es/en-us/pt-br). Se usa solo si sitio('motor') es true.
define('MOTOR_PORTAL', 'https://reservas.grupotierragaucha.com.ar/portal/{lang}/hotel/?idPortal=25');
define('MOTOR_HOTEL', 'https://{host}/{lang}?idHotel={id}');
define('MOTOR_LANG_HOTEL', ['es' => 'es-es', 'en' => 'en-us', 'pt' => 'pt-br']);
define('SOCIAL', [
  'facebook'  => 'https://www.facebook.com/GrupoTierraGaucha/',
  'instagram' => 'https://www.instagram.com/grupotierragaucha/',
  'linkedin'  => 'https://www.linkedin.com/company/grupo-tierra-gaucha/',
  'tiktok'    => 'https://www.tiktok.com/@grupotierragaucha',
]);

// ---- Propios de cada sitio (sitio.php) ---------------------------------------
define('SITIO', sitio('codigo'));                         // ar · com · br · cl
define('SITE_URL', sitio('url'));
define('WHATSAPP', sitio('whatsapp'));                    // ¡SIN el "15"!
define('TELEFONO_TXT', sitio('telefono'));
define('EMAIL', sitio('email'));
define('MOTOR', (bool) sitio('motor', false));            // false = "Reservar" y el buscador van a WhatsApp
define('PAGINAS', sitio('paginas'));                      // slug de la URL => archivo .php

// Base de las URLs (ruta absoluta desde la raíz del dominio): "/2026/" en staging, "/" en producción.
// Se calcula sola; si un hosting la calcula mal, fijarla a mano acá: define('BASE', '/');
// Todas las páginas (.php) están en la carpeta del sitio, así que la base es la carpeta del script ejecutado.
if (!defined('BASE')) {
  $gtg_dir = str_replace('\\', '/', dirname(isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/index.php'));
  $gtg_dir = trim($gtg_dir, '/.');
  define('BASE', '/' . ($gtg_dir !== '' ? $gtg_dir . '/' : ''));
}

// Idiomas: el primero de la lista es el del sitio (sin prefijo en la URL); los demás van con /xx/.
// El .htaccess pasa ?lang=xx.
define('LANGS', sitio('idiomas'));
define('LANG_DEFAULT', LANGS[0]);
define('LANG', (isset($_GET['lang']) && in_array($_GET['lang'], LANGS, true)) ? $_GET['lang'] : LANG_DEFAULT);
$GLOBALS['GTG_LANG'] = require ROOT . '/lang/' . LANG . '.php';
if (LANG !== 'es') {
  $GLOBALS['GTG_LANG'] += require ROOT . '/lang/es.php';   // claves que falten en en/pt caen al español
}
// Textos propios del sitio (sitio.php > 'textos' > idioma) pisan a los de lang/.
$gtg_textos = sitio('textos', []);
if (!empty($gtg_textos[LANG])) {
  $GLOBALS['GTG_LANG'] = $gtg_textos[LANG] + $GLOBALS['GTG_LANG'];
}


/* ------------------------------------------------------------------
 * Helpers
 * ------------------------------------------------------------------ */

/** Escapa texto para HTML. */
function e($str)
{
  return htmlspecialchars((string) $str, ENT_QUOTES, 'UTF-8');
}

/** Texto fijo de la interfaz (lang/xx.php). */
function t($key)
{
  return isset($GLOBALS['GTG_LANG'][$key]) ? $GLOBALS['GTG_LANG'][$key] : $key;
}

/** Link de WhatsApp con texto precargado. Nunca escribir el número a mano. */
function wa_link($texto = '', $numero = WHATSAPP)
{
  $url = 'https://wa.me/' . $numero;
  return $texto !== '' ? $url . '?text=' . rawurlencode($texto) : $url;
}

/** URL de un archivo de /assets con versión por fecha de modificación (cache busting). */
function asset($rel)
{
  $file = ROOT . '/assets/' . $rel;
  return BASE . 'assets/' . $rel . (is_file($file) ? '?v=' . filemtime($file) : '');
}

/** URL de una imagen de assets/img/. Si la imagen no existe, devuelve el placeholder. */
function img($rel)
{
  return BASE . img_path($rel);
}

/** Ruta de la imagen relativa a la carpeta del sitio (para leer el archivo). */
function img_path($rel)
{
  return 'assets/img/' . ($rel !== '' && is_file(ROOT . '/assets/img/' . $rel) ? $rel : PLACEHOLDER);
}

/**
 * URL de una página del sitio en un idioma.
 *   url()                      -> home del idioma actual  (/2026/, /2026/en/)
 *   url('sumate')              -> /2026/sumate/  ·  /2026/en/sumate/
 *   url('', 'pt', '#hoteles')  -> /2026/pt/#hoteles
 * Si la página no existe en este sitio (ej. Hotel Management en .cl), lleva a la del .com.ar en el mismo idioma.
 */
function url($slug = '', $lang = null, $ancla = '')
{
  $lang = $lang ?: LANG;
  if ($slug !== '' && !array_key_exists($slug, PAGINAS)) {
    return SITIO_AR . '/' . ($lang !== 'es' ? $lang . '/' : '') . $slug . '/' . $ancla;
  }
  return BASE . ($lang !== LANG_DEFAULT ? $lang . '/' : '') . ($slug !== '' ? $slug . '/' : '') . $ancla;
}

/** true si la URL lleva a otro dominio (se abre en otra pestaña). */
function es_externa($url)
{
  return strpos($url, 'http') === 0;
}

/** Botón "Reservar": con motor va al buscador de la home; sin motor, a WhatsApp. */
function reservar_url()
{
  return MOTOR ? url('', null, '#reservar') : wa_link(t('whatsapp_reservar'));
}

/**
 * Texto de un archivo de datos que puede venir traducido:
 * 'Hola'  ó  ['es' => 'Hola', 'en' => 'Hello', 'pt' => 'Olá']  (si falta el idioma, cae al español).
 */
function tr($valor)
{
  if (!is_array($valor)) return $valor;
  return isset($valor[LANG]) ? $valor[LANG] : (isset($valor['es']) ? $valor['es'] : reset($valor));
}

/** Contenido de una página interna (content/{slug}.php devuelve ['es' => [...], 'en' => [...], 'pt' => [...]]). */
function contenido($slug)
{
  $c = require ROOT . '/content/' . $slug . '.php';
  return isset($c[LANG]) ? $c[LANG] : $c['es'];
}

/** Formato de idioma para og:locale / html lang. */
function locale_og()
{
  $m = ['es' => sitio('locale_es', 'es_AR'), 'en' => 'en_US', 'pt' => 'pt_BR'];
  return $m[LANG];
}

/** true si la imagen existe en assets/img/. */
function img_exists($rel)
{
  return $rel !== '' && is_file(ROOT . '/assets/img/' . $rel);
}

/** Atributos width/height reales de la imagen (evita saltos de layout). */
function img_dims($rel)
{
  static $cache = [];
  $file = ROOT . '/' . img_path($rel);
  if (!isset($cache[$file])) {
    $s = @getimagesize($file);
    $cache[$file] = $s ? 'width="' . $s[0] . '" height="' . $s[1] . '"' : '';
  }
  return $cache[$file];
}
