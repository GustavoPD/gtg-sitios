<?php
/**
 * Sitio: www.grupotierragaucha.com.br (Brasil).
 * Configuración propia de este sitio. El resto es común (core/). Ver sitios/ar/sitio.php (comentado).
 */
return [
  'codigo'   => 'br',
  'url'      => 'https://www.grupotierragaucha.com.br',
  'idiomas'  => ['pt', 'es', 'en'],          // portugués sin prefijo; /es/ y /en/

  'whatsapp' => '5492944341212',             // Central de reservas (el mismo del sitio anterior)
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

  // Hotel Management no es página de este sitio: lleva al del .com.ar en el mismo idioma (/pt/hotelmanagement/).
  'menu'     => [
    ['hoteles' => true,              'texto' => 'nav_hoteles'],
    ['pagina'  => 'departamentos',   'texto' => 'nav_departamentos'],
    ['pagina'  => 'agencias',        'texto' => 'nav_agencias'],
    ['pagina'  => 'hotelmanagement', 'texto' => 'nav_hotel_management'],
  ],

  'home'     => ['hero', 'destacados', 'agencias', 'destinos'],

  'agencias' => ['foz-experience', 'tierra-gaucha-viagens'],
  'destinos' => ['ar', 'cl'],

  'textos'   => [
    'pt' => ['meta_title' => 'Grupo Tierra Gaucha Brasil | Hotel Suiça Iguaçu em Foz do Iguaçu',
             'meta_description' => 'Grupo Tierra Gaucha no Brasil: Hotel Suiça Iguaçu em Foz do Iguaçu, passeios com a Foz Experience e viagens com a Tierra Gaucha Viagens.'],
    'es' => ['meta_title' => 'Grupo Tierra Gaucha Brasil | Hotel Suiça Iguaçu en Foz do Iguaçu',
             'meta_description' => 'Grupo Tierra Gaucha en Brasil: Hotel Suiça Iguaçu en Foz do Iguaçu, excursiones con Foz Experience y viajes con Tierra Gaucha Viagens.'],
    'en' => ['meta_title' => 'Grupo Tierra Gaucha Brazil | Hotel Suiça Iguaçu in Foz do Iguaçu',
             'meta_description' => 'Grupo Tierra Gaucha in Brazil: Hotel Suiça Iguaçu in Foz do Iguaçu, tours with Foz Experience and trips with Tierra Gaucha Viagens.'],
  ],

  'redirecciones' => [],
];
