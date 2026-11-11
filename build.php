<?php
/**
 * Build de los sitios de Grupo Tierra Gaucha.
 *
 *   php build.php            -> arma los 4 sitios
 *   php build.php cl br      -> solo esos
 *   (o doble clic en build.bat)
 *
 * Para cada sitio arma dist/{sitio}/ = core/ + sitios/{sitio}/ (lo del sitio pisa a lo de core)
 * + el .htaccess generado. dist/{sitio}/ es exactamente lo que se sube a su hosting.
 * dist/ no se edita a mano: se borra y se vuelve a generar en cada build.
 *
 * Las fechas de los archivos se conservan (redondeadas, ver marca()), así la extensión SFTP sube
 * solo lo que cambió y los ?v= de CSS/JS (cache) no cambian si el archivo no cambió.
 */

if (PHP_SAPI !== 'cli') exit("Solo por línea de comandos.\n");
date_default_timezone_set('America/Argentina/Buenos_Aires');   // hora de la PC (y la que lista el servidor FTP)

$RAIZ   = __DIR__;
$SITIOS = ['ar', 'com', 'br', 'cl'];
$AR_URL = 'https://www.grupotierragaucha.com.ar';

$pedidos = array_slice($argv, 1);
$pedidos = $pedidos ? $pedidos : $SITIOS;
foreach ($pedidos as $s) {
  if (!in_array($s, $SITIOS, true)) exit("Sitio desconocido: $s (opciones: " . implode(', ', $SITIOS) . ")\n");
}

// Páginas que existen en core (todas las posibles) y nombres viejos de archivos (sitios anteriores).
$PAGINAS_CORE = [
  'departamentos'                                 => 'departamentos.php',
  'agencias'                                      => 'agencias.php',
  'hotelmanagement'                               => 'hotelmanagement.php',
  'club-de-puntos'                                => 'club-de-puntos.php',
  'terminos-y-condiciones-club-de-puntos'         => 'terminos-y-condiciones-club-de-puntos.php',
  'sumate'                                        => 'sumate.php',
  'politica-de-cookies'                           => 'politica-de-cookies.php',
  'politica-de-privacidad-de-grupo-tierra-gaucha' => 'politica-de-privacidad.php',
];
$ARCHIVOS_VIEJOS = [   // archivo viejo (sin sufijo) => slug nuevo ('' = home)
  'index'                                 => '',
  'trabaje-con-nosotros'                  => 'sumate',
  'politica-cookies'                      => 'politica-de-cookies',
  'politica-privacidad'                   => 'politica-de-privacidad-de-grupo-tierra-gaucha',
  'departamentos'                         => 'departamentos',
  'agencias'                              => 'agencias',
  'club-de-puntos'                        => 'club-de-puntos',
  'terminos-y-condiciones-club-de-puntos' => 'terminos-y-condiciones-club-de-puntos',
  'hotelmanagement'                       => 'hotelmanagement',
];
$SUFIJOS_VIEJOS = ['' => 'es', '_en' => 'en', '_port' => 'pt'];

foreach ($pedidos as $codigo) {
  $t0     = microtime(true);
  $origen = "$RAIZ/sitios/$codigo";
  $dist   = "$RAIZ/dist/$codigo";
  $cfg    = require "$origen/sitio.php";

  // Lista de archivos del sitio: core + los del sitio (que pisan a los de core)
  $archivos = listar("$RAIZ/core");
  unset($archivos['.htaccess.tpl']);
  $archivos = array_merge($archivos, listar($origen));
  // Páginas que este sitio no tiene: no se publican (sus links van al .com.ar, ver url() en config.php)
  foreach ($PAGINAS_CORE as $slug => $archivo) {
    if (!isset($cfg['paginas'][$slug])) unset($archivos[$archivo]);
  }

  // Sincroniza dist/xx: copia solo lo nuevo o modificado y borra lo que ya no corresponde
  // (no se borra la carpeta entera: así no falla si VS Code tiene algún archivo abierto).
  $copiados = 0;
  foreach ($archivos as $rel => $src) {
    $dst = "$dist/$rel";
    if (is_file($dst) && filesize($dst) === filesize($src) && filemtime($dst) === marca($src)) continue;
    if (!is_dir(dirname($dst))) mkdir(dirname($dst), 0777, true);
    if (!@copy($src, $dst)) { echo "  ! No se pudo copiar $rel (¿abierto en otro programa?)\n"; continue; }
    touch($dst, marca($src));
    $copiados++;
  }
  $borrados = limpiar($dist, $dist, $archivos + ['.htaccess' => true]);

  // .htaccess: se reescribe solo si cambió (así el Sync no lo vuelve a subir)
  $ht = htaccess($RAIZ, $cfg, $ARCHIVOS_VIEJOS, $SUFIJOS_VIEJOS, $AR_URL);
  if (!is_file("$dist/.htaccess") || file_get_contents("$dist/.htaccess") !== $ht) {
    file_put_contents("$dist/.htaccess", $ht);
    $copiados++;
  }
  touch("$dist/.htaccess", marca("$dist/.htaccess"));   // fecha redondeada como el resto (ver marca())

  printf("  %-4s -> dist/%-4s  %4d archivos · %d actualizados · %d borrados  (%.1fs)\n",
    $codigo, $codigo . '/', count($archivos) + 1, $copiados, $borrados, microtime(true) - $t0);
}
echo "Listo.\n";


/* ------------------------------------------------------------------ */

function htaccess($raiz, $cfg, $viejos, $sufijos, $ar_url)
{
  $idiomas = $cfg['idiomas'];
  $def     = $idiomas[0];
  $otros   = array_slice($idiomas, 1);
  $pfx     = implode('|', $otros);
  $host    = preg_replace('#^https?://(www\.)?#', '', rtrim($cfg['url'], '/'));
  $prefijo = function ($lang) use ($def) { return $lang === $def ? '' : $lang . '/'; };
  $ar      = function ($slug, $lang) use ($ar_url) { return $ar_url . '/' . ($lang !== 'es' ? $lang . '/' : '') . ($slug !== '' ? $slug . '/' : ''); };
  $paginas = $cfg['paginas'];

  // Destino de un slug en un idioma: en este sitio, o en el .com.ar si este sitio no tiene la página
  $destino = function ($slug, $lang) use ($paginas, $prefijo, $ar, $idiomas, $def) {
    if (!in_array($lang, $idiomas, true)) $lang = $def;
    if ($slug === '' || isset($paginas[$slug])) return '%{ENV:GTG_BASE}' . $prefijo($lang) . ($slug !== '' ? $slug . '/' : '');
    return $ar($slug, $lang);
  };

  $red = [];
  // 1) Archivos .php de los sitios anteriores (index_en.php, trabaje-con-nosotros_port.php, ...)
  foreach ($viejos as $base => $slug) {
    foreach ($sufijos as $suf => $lang) {
      $archivo = $base . $suf . '.php';
      if ($suf === '' && ($base === 'index' || (isset($paginas[$slug]) && $paginas[$slug] === $archivo))) continue;   // existen en el sitio nuevo
      $red[] = 'RewriteRule ^' . q($archivo) . '$ ' . $destino($slug, $lang) . ' [L,R=301]';
    }
  }
  // 2) URLs amigables de páginas que este sitio ya no tiene -> .com.ar (en el mismo idioma)
  $todas = ['hotelmanagement', 'club-de-puntos', 'terminos-y-condiciones-club-de-puntos', 'departamentos', 'agencias', 'sumate'];
  foreach ($todas as $slug) {
    if (isset($paginas[$slug])) continue;
    foreach ($idiomas as $lang) {
      $red[] = 'RewriteRule ^' . $prefijo($lang) . q($slug) . '/?$ ' . $ar($slug, $lang) . ' [L,R=301]';
    }
  }
  // 3) Alias viejo del Club de Puntos
  foreach ($idiomas as $lang) {
    $red[] = 'RewriteRule ^' . $prefijo($lang) . 'clubdepuntos/?$ ' . $destino('club-de-puntos', $lang) . ' [L,R=301]';
  }
  // 3b) Prefijo del idioma del sitio (ej. /pt/... en el .com.br, /es/... en los demás) -> sin prefijo
  $red[] = 'RewriteRule ^' . $def . '(?:/(.*))?$ %{ENV:GTG_BASE}$1 [L,R=301]';
  // 4) Propias del sitio (sitio.php > 'redirecciones')
  foreach (isset($cfg['redirecciones']) ? $cfg['redirecciones'] : [] as $de => $a) {
    $red[] = 'RewriteRule ' . $de . ' ' . (strpos($a, 'http') === 0 ? $a : '%{ENV:GTG_BASE}' . $a) . ' [L,R=301]';
  }

  $directo = [];
  $reglas  = [];
  foreach ($paginas as $slug => $archivo) {
    $directo[] = "RewriteCond %{ENV:REDIRECT_STATUS} ^$\nRewriteRule ^" . q($archivo) . '$ %{ENV:GTG_BASE}' . $slug . '/ [L,R=301]';
    $reglas[]  = 'RewriteRule ^(?:(' . $pfx . ')/)?' . q($slug) . '/$ ' . $archivo . '?lang=$1 [L,QSA]';
  }

  $tpl = file_get_contents("$raiz/core/.htaccess.tpl");
  return strtr($tpl, [
    '{{SITIO}}'         => $cfg['codigo'],
    '{{HOST}}'          => $host,
    '{{HOST_RE}}'       => q($host),
    '{{PFX}}'           => $pfx,
    '{{PFX1}}'          => $otros[0],
    '{{SLUGS}}'         => implode('|', array_map('q', array_keys($paginas))),
    '{{REDIRECCIONES}}' => implode("\n", $red),
    '{{DIRECTO}}'       => implode("\n", $directo),
    '{{PAGINAS}}'       => implode("\n", $reglas),
  ]);
}

/**
 * Fecha que se le pone al archivo en dist/: la del original redondeada al minuto (o al día si tiene
 * más de 5 meses). Por FTP la extensión SFTP lee la fecha remota con el listado del servidor, que
 * no trae segundos (y en archivos viejos, tampoco la hora): sin redondear, todo le parece distinto
 * y sube el sitio entero en cada Sync.
 */
function marca($src)
{
  $t = filemtime($src);
  return $t < time() - 150 * 86400 ? mktime(0, 0, 0, date("n", $t), date("j", $t), date("Y", $t)) : $t - $t % 60;
}

/** Archivos de una carpeta (recursivo): ['ruta/relativa' => 'ruta/completa']. */
function listar($base, $sub = '')
{
  $out = [];
  foreach (scandir("$base/$sub") as $f) {
    if ($f === '.' || $f === '..') continue;
    $rel = ltrim("$sub/$f", '/');
    if (is_dir("$base/$rel")) {
      $out += listar($base, $rel);
    } else {
      $out[$rel] = "$base/$rel";
    }
  }
  return $out;
}

/** Borra de dist/xx lo que no está en $validos (y las carpetas que quedan vacías). Solo actúa dentro de dist/. */
function limpiar($dist, $dir, $validos)
{
  if (!is_dir($dir)) return 0;
  if (strpos(str_replace('\\', '/', realpath($dir)), str_replace('\\', '/', realpath(__DIR__ . '/dist')) . '/') !== 0) {
    exit("No se borra fuera de dist/: $dir\n");
  }
  $n = 0;
  foreach (scandir($dir) as $f) {
    if ($f === '.' || $f === '..') continue;
    $ruta = "$dir/$f";
    $rel  = ltrim(substr($ruta, strlen($dist)), '/');
    if (is_dir($ruta) && !is_link($ruta)) {
      $n += limpiar($dist, $ruta, $validos);
      if (count(scandir($ruta)) === 2) @rmdir($ruta);
    } elseif (!isset($validos[$rel])) {
      if (@unlink($ruta)) $n++; else echo "  ! No se pudo borrar $rel (¿abierto en otro programa?)\n";
    }
  }
  return $n;
}

/** Escapa un texto para usarlo literal en una regex de .htaccess (solo hay letras, guiones, _ y puntos). */
function q($s)
{
  return str_replace('.', '\.', $s);
}
