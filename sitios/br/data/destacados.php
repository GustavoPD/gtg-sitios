<?php
/**
 * Destacados de la home del .com.br (sección sections/home/destacados.php).
 * Textos de Foz Experience: los del sitio anterior (pt) + traducción es/en.
 * Imágenes: assets/img/destacados/ (de este sitio) o compartidas de core.
 */
return [
  [
    'id'       => 'suica',
    'etiqueta' => 'Foz do Iguaçu',
    'titulo'   => 'Hotel Suiça Iguaçu',
    'texto'    => [
      'es' => [
        'Confort y tranquilidad en Foz do Iguaçu, con piscina y jardines, a pocos minutos de las Cataratas.',
        'El punto de partida ideal para descubrir la Triple Frontera: Cataratas del lado brasileño y argentino, Parque das Aves e Itaipú.',
      ],
      'en' => [
        'Comfort and tranquility in Foz do Iguaçu, with a pool and gardens, just minutes from the Falls.',
        'The perfect base to discover the Triple Frontier: the Brazilian and Argentine sides of the Falls, Parque das Aves and Itaipu.',
      ],
      'pt' => [
        'Conforto e tranquilidade em Foz do Iguaçu, com piscina e jardins, a poucos minutos das Cataratas.',
        'O ponto de partida ideal para descobrir a Tríplice Fronteira: Cataratas do lado brasileiro e argentino, Parque das Aves e Itaipu.',
      ],
    ],
    'imagenes' => ['destacados/suica-fachada.webp', 'destacados/suica-01.webp', 'destacados/suica-02.webp'],
    'botones'  => [
      ['texto' => ['es' => 'Ver hotel', 'en' => 'View hotel', 'pt' => 'Ver hotel'], 'url' => 'https://www.hotelsuicaiguacu.com.br/', 'estilo' => 'outline'],
      ['texto' => ['es' => 'Reservar', 'en' => 'Book', 'pt' => 'Reservar'], 'url' => 'reservar'],
    ],
  ],
  [
    'id'       => 'foz-experience',
    'activo'   => false,   // reemplazado por el banner con parallax (sitio.php > 'agencias'); true para volver a mostrarlo
    'etiqueta' => 'Foz Experience',
    'titulo'   => ['es' => 'Descubrí Foz do Iguaçu con expertos', 'en' => 'Discover Foz do Iguaçu with the experts', 'pt' => 'Explore Foz do Iguaçu com quem entende'],
    'texto'    => [
      'es' => ['En Foz Experience entendemos que cada viajero es único. Por eso contamos con una amplia propuesta de servicios turísticos en Foz do Iguaçu:'],
      'en' => ['At Foz Experience, we know every traveler is unique. That is why we offer a wide range of tourist services in Foz do Iguaçu:'],
      'pt' => ['Na Foz Experience, entendemos que cada viajante é único. Por isso, contamos com um portfólio abrangente de serviços turísticos em Foz do Iguaçu:'],
    ],
    'lista'    => [
      'es' => [
        'Paseos y excursiones: Cataratas (Brasil y Argentina), Parque das Aves, Itaipú Binacional y el Hito de las Tres Fronteras.',
        'Experiencias internacionales: compras en Paraguay y propuestas gastronómicas y culturales en Argentina.',
        'Traslados: transporte privado o compartido a aeropuertos, hoteles y todos los puntos turísticos.',
        'Asesoramiento completo: entradas, cenas y cualquier servicio adicional para tu viaje.',
      ],
      'en' => [
        'Tours and excursions: the Falls (Brazil and Argentina), Parque das Aves, Itaipu Dam and the Triple Frontier Landmark.',
        'International experiences: shopping in Paraguay and food and cultural outings in Argentina.',
        'Transfers: private or shared transport to airports, hotels and every sightseeing spot.',
        'Full assistance: tickets, dinners and any extra service your trip needs.',
      ],
      'pt' => [
        'Passeios e excursões: Cataratas (Brasil e Argentina), Parque das Aves, Itaipu Binacional e o Marco das Três Fronteiras.',
        'Experiências internacionais: compras no Paraguai e roteiros gastronômicos e culturais na Argentina.',
        'Traslados: transporte privativo ou compartilhado para aeroportos, hotéis e todos os pontos turísticos.',
        'Assessoria completa: ingressos, jantares e qualquer serviço adicional que a sua viagem exija.',
      ],
    ],
    'imagenes' => ['parallax/foz-experience.webp'],
    'botones'  => [
      ['texto' => ['es' => 'Más información', 'en' => 'More info', 'pt' => 'Mais info'], 'url' => 'https://www.fozexperience.com.br'],
    ],
  ],
];
