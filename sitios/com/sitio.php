<?php
/**
 * Sitio: www.grupotierragaucha.com (internacional). Idioma por defecto: español (pedido del cliente).
 * Configuración propia de este sitio. El resto es común (core/). Ver sitios/ar/sitio.php (comentado).
 */
return [
  'codigo'   => 'com',
  'url'      => 'https://www.grupotierragaucha.com',
  'idiomas'  => ['es', 'en', 'pt'],

  'whatsapp' => '5492944341212',             // Central de reservas
  'telefono' => '+54 9 2944 34-1212',
  'email'    => 'centralreservas@grupotierragaucha.com.ar',

  'motor'    => false,                       // sin motor: "Reservar" y el buscador van a WhatsApp

  'paginas'  => [
    'sumate'                                        => 'sumate.php',
    'politica-de-cookies'                           => 'politica-de-cookies.php',
    'politica-de-privacidad-de-grupo-tierra-gaucha' => 'politica-de-privacidad.php',
  ],

  // "Nosotros" del sitio anterior -> desplegable de Hoteles. Servicios se quitó.
  'menu'     => [
    ['hoteles' => true,              'texto' => 'nav_hoteles'],
    ['ancla'   => '#destinos',       'texto' => 'nav_destinos'],
    ['url'     => 'https://tierragauchaviagens.com.br/', 'texto' => 'nav_mayorista'],
    ['pagina'  => 'hotelmanagement', 'texto' => 'nav_hotel_management'],   // -> .com.ar/hotelmanagement/
  ],

  // Igual que el sitio anterior: hoteles, Somos GTG, destinos (AR/BR/CL) y experiencias (agencias receptivas).
  'home'     => ['hero', 'marcas', 'nosotros', 'hoteles', 'destinos', 'agencias'],

  'agencias' => ['bariloche-experience', 'foz-experience'],
  'destinos' => ['ar', 'br', 'cl'],

  'textos'   => [
    'es' => ['meta_title' => 'Grupo Tierra Gaucha | Cadena hotelera en Argentina y Brasil',
             'des_etiqueta' => 'Destinos', 'des_titulo' => 'Grupo Tierra Gaucha en la región'],
    'en' => ['meta_title' => 'Grupo Tierra Gaucha | Hotel chain in Argentina and Brazil',
             'des_etiqueta' => 'Destinations'],
    'pt' => ['meta_title' => 'Grupo Tierra Gaucha | Rede hoteleira na Argentina e no Brasil',
             'des_etiqueta' => 'Destinos'],
  ],

  'redirecciones' => [],
];
