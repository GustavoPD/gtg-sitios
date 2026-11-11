<?php
/**
 * Sitio: www.grupotierragaucha.cl (Chile).
 * Configuración propia de este sitio. El resto es común (core/). Ver sitios/ar/sitio.php (comentado).
 */
return [
  'codigo'   => 'cl',
  'url'      => 'https://www.grupotierragaucha.cl',
  'idiomas'  => ['es', 'en', 'pt'],
  'locale_es' => 'es_CL',

  'whatsapp' => '5492944341212',             // Central de reservas
  'telefono' => '+54 9 2944 34-1212',
  'email'    => 'centralreservas@grupotierragaucha.com.ar',

  'motor'    => false,                       // sin motor: "Reservar" y el buscador van a WhatsApp

  'paginas'  => [
    'departamentos'                                 => 'departamentos.php',
    'agencias'                                      => 'agencias.php',
    'sumate'                                        => 'sumate.php',
    'politica-de-cookies'                           => 'politica-de-cookies.php',
    'politica-de-privacidad-de-grupo-tierra-gaucha' => 'politica-de-privacidad.php',
  ],

  // Hotel Management lleva al del .com.ar (siempre actualizado).
  'menu'     => [
    ['hoteles' => true,              'texto' => 'nav_hoteles'],
    ['pagina'  => 'departamentos',   'texto' => 'nav_departamentos'],
    ['pagina'  => 'agencias',        'texto' => 'nav_agencias'],
    ['pagina'  => 'hotelmanagement', 'texto' => 'nav_hotel_management'],
  ],

  // El sitio anterior solo tenía slide + "Otros destinos"; se suman Somos GTG y los hoteles.
  'home'     => ['hero', 'nosotros', 'hoteles', 'destinos'],

  'agencias' => [],
  'destinos' => ['ar', 'br'],

  'textos'   => [
    'es' => ['meta_title' => 'Grupo Tierra Gaucha Chile | Cadena de hoteles en Bariloche y Brasil'],
    'en' => ['meta_title' => 'Grupo Tierra Gaucha Chile | Hotel chain in Bariloche and Brazil'],
    'pt' => ['meta_title' => 'Grupo Tierra Gaucha Chile | Rede de hotéis em Bariloche e no Brasil'],
  ],

  'redirecciones' => [],
];
