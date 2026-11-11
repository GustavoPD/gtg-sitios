<?php
/**
 * Slides del hero (home). El orden del array es el orden en que se muestran.
 * Imágenes: assets/img/hero/ — desktop 1920x1080, mobile 800x1200.
 * Cuando exista el CMS, esta fuente se reemplaza por la base de datos.
 */
return [
  [
    'imagen'        => 'hero/hero-01.webp',
    'imagen_mobile' => 'hero/hero-01-mobile.webp',
    'etiqueta'      => ['es' => 'Experiencia 360°', 'en' => '360° Experience', 'pt' => 'Experiência 360°'],
    'titulo'        => ['es' => 'Tu estadía, tus excursiones, tu viaje completo', 'en' => 'Your stay, your tours, your whole trip', 'pt' => 'A sua estadia, os seus passeios, a sua viagem completa'],
    'alt'           => ['es' => 'Lagos y montañas desde el Circuito Chico, Bariloche', 'en' => 'Lakes and mountains from Circuito Chico, Bariloche', 'pt' => 'Lagos e montanhas vistos do Circuito Chico, Bariloche'],
  ],
  [
    'imagen'        => 'hero/hero-02.webp',
    'imagen_mobile' => 'hero/hero-02-mobile.webp',
    'etiqueta'      => 'San Carlos de Bariloche',
    'titulo'        => ['es' => 'Hospitalidad patagónica, en cada estación', 'en' => 'Patagonian hospitality, in every season', 'pt' => 'Hospitalidade patagônica, em cada estação'],
    'alt'           => ['es' => 'Costanera de Bariloche con la Catedral y el lago Nahuel Huapi', 'en' => 'Bariloche waterfront with the Cathedral and Lake Nahuel Huapi', 'pt' => 'Orla de Bariloche com a Catedral e o lago Nahuel Huapi'],
  ],
  [
    'imagen'        => 'hero/hero-03.webp',
    'imagen_mobile' => 'hero/hero-03-mobile.webp',
    'etiqueta'      => ['es' => 'Más de 10 años', 'en' => 'Over 10 years', 'pt' => 'Mais de 10 anos'],
    'titulo'        => ['es' => 'La cadena de hoteles de Bariloche', 'en' => 'Bariloche\'s hotel chain', 'pt' => 'A rede de hotéis de Bariloche'],
    'alt'           => ['es' => 'Atardecer sobre las montañas y lagos de Bariloche', 'en' => 'Sunset over the mountains and lakes of Bariloche', 'pt' => 'Pôr do sol sobre as montanhas e lagos de Bariloche'],
  ],
];
