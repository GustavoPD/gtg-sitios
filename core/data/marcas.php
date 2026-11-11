<?php
/**
 * Marcas que forman parte de GTG: hoteles + agencias.
 * Se usan en la franja de logos (home) y en el footer.
 * logo: assets/img/marcas/{slug}.png (PNG/SVG fondo transparente).
 * Si el logo no existe todavía, se muestra el nombre en texto.
 */
return (function () {
$hoteles = require __DIR__ . '/hoteles.php';

$marcas = [];
foreach ($hoteles as $h) {
  $marcas[] = [
    'slug'   => $h['slug'],
    'nombre' => $h['nombre'],
    'url'    => $h['url'],
    'logo'   => $h['logo'],
    'tipo'   => 'hotel',
  ];
}

$agencias = [
  [
    'slug'   => 'bariloche-experience',
    'nombre' => 'Bariloche Experience',
    'url'    => 'https://www.barilocheexperience.com.ar',
    'logo'   => 'marcas/bariloche-experience.png',
    'tipo'   => 'agencia',
  ],
  [
    'slug'   => 'foz-experience',
    'nombre' => 'Foz Experience',
    'url'    => 'https://www.fozexperience.com.br',
    'logo'   => 'marcas/foz-experience.png',
    'tipo'   => 'agencia',
  ],
  [
    'slug'   => 'tierra-gaucha-viagens',
    'nombre' => 'Tierra Gaucha Viagens',
    'url'    => 'https://tierragauchaviagens.com.br/',
    'logo'   => 'marcas/tierra-gaucha-viagens.png',
    'tipo'   => 'agencia',
  ],
];

return array_merge($marcas, $agencias);
})();
