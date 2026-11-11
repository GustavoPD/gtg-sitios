<?php
/**
 * Sitio: www.grupotierragaucha.com.ar (Argentina) — sitio principal.
 * Configuración propia de este sitio. El resto es común (core/).
 */
return [
  'codigo'   => 'ar',
  'url'      => 'https://www.grupotierragaucha.com.ar',
  'idiomas'  => ['es', 'en', 'pt'],          // el primero es el idioma del sitio (sin /xx/ en la URL)
  'locale_es' => 'es_AR',

  'whatsapp' => '5492944341212',             // ¡SIN el "15"!
  'telefono' => '+54 9 2944 34-1212',
  'email'    => 'centralreservas@grupotierragaucha.com.ar',

  'motor'    => true,                        // buscador conectado al motor de reservas
  'gtm'      => 'GTM-PNN2SRG5',              // Google Tag Manager (solo en producción). Los demás sitios no lo tienen.

  // Páginas internas de este sitio: slug de la URL => archivo. Las que no estén acá no se publican
  // y sus links llevan al .com.ar (ver url() en config.php).
  'paginas'  => [
    'departamentos'                                 => 'departamentos.php',
    'agencias'                                      => 'agencias.php',
    'hotelmanagement'                               => 'hotelmanagement.php',
    'club-de-puntos'                                => 'club-de-puntos.php',
    'terminos-y-condiciones-club-de-puntos'         => 'terminos-y-condiciones-club-de-puntos.php',
    'sumate'                                        => 'sumate.php',
    'politica-de-cookies'                           => 'politica-de-cookies.php',
    'politica-de-privacidad-de-grupo-tierra-gaucha' => 'politica-de-privacidad.php',
  ],

  // Navbar. Tipos: hoteles (desplegable) · pagina (slug) · ancla (sección de la home) · url (link externo).
  'menu'     => [
    ['hoteles' => true,                    'texto' => 'nav_hoteles'],
    ['pagina'  => 'departamentos',         'texto' => 'nav_departamentos'],
    ['ancla'   => '#promociones',          'texto' => 'nav_promociones'],
    ['pagina'  => 'agencias',              'texto' => 'nav_agencias'],
    ['pagina'  => 'hotelmanagement',       'texto' => 'nav_hotel_management'],
    ['ancla'   => '#contacto',             'texto' => 'nav_contacto', 'pie' => true],
  ],

  // Secciones de la home, en orden (archivos de sections/home/).
  'home'     => [
    'hero', 'marcas', 'nosotros', 'hoteles',
    // 'servicios',   // OCULTA: acá irá la info del Grupo (pendiente cliente)
    'promociones', 'agencias', 'hotel-management', 'destinos', 'galeria',
  ],

  'agencias' => ['bariloche-experience', 'foz-experience', 'tierra-gaucha-viagens'],   // banners de la home
  'destinos' => ['br', 'cl'],                                                          // "Otros destinos"

  // Redirecciones 301 extra de URLs viejas de este sitio (las comunes —index_en.php, *_port.php,
  // clubdepuntos/, páginas que el sitio no tiene— las arma el build). Formato: 'regex' => 'destino'.
  'redirecciones' => [],
];
