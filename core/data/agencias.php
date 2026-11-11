<?php
/**
 * Agencias del grupo (home > Agencias). Cada una es un banner a ancho completo
 * con foto parallax oscurecida: logo, título con íconos a los costados, texto y botón.
 * imagen: assets/img/parallax/  (1920 de ancho)
 * logo:   assets/img/agencias/  (PNG con transparencia, ~600px de ancho)
 * logo_ancho: ancho en px con que se muestra el logo (para equilibrar logos de distintas proporciones)
 * iconos: 4 íconos Phosphor (2 a la izquierda del título, 2 a la derecha), sin el prefijo "ph-"
 * PENDIENTE CLIENTE: 'titulo' y 'texto' son provisorios.
 * activa: false = no se muestra.
 */
return [
  [
    'slug'   => 'bariloche-experience',
    'nombre' => 'Bariloche Experience',
    'url'    => 'https://www.barilocheexperience.com.ar',
    'imagen' => 'parallax/be.webp',
    'logo'   => 'agencias/logo-be-blanco.png',
    'logo_ancho' => 220,
    'titulo' => ['es' => 'Cotizá tus excursiones y tours en Bariloche', 'en' => 'Get a quote for tours and excursions in Bariloche', 'pt' => 'Faça a cotação dos seus passeios em Bariloche'],
    'texto'  => ['es' => 'Operador y agencia receptiva. Todo lo que necesitás para tu viaje: excursiones, traslados, actividades de nieve y tours personalizados.', 'en' => 'Tour operator and inbound agency. Everything you need for your trip: excursions, transfers, snow activities and tailor-made tours.', 'pt' => 'Operadora e agência receptiva. Tudo o que você precisa para a sua viagem: passeios, traslados, atividades na neve e roteiros personalizados.'],
    'iconos' => ['van', 'mountains', 'person-simple-hike', 'map-trifold'],
    'boton'  => ['es' => '¡Cotizá ahora!', 'en' => 'Get a quote!', 'pt' => 'Cote agora!'],
    'activa' => true,
  ],
  [
    'slug'   => 'foz-experience',
    'nombre' => 'Foz Experience',
    'url'    => 'https://www.fozexperience.com.br',
    'imagen' => 'parallax/foz-experience.webp',
    'logo'   => 'agencias/logo-fe.png',
    'logo_ancho' => 180,   // PNG chico (161px): pedir versión en mayor resolución
    'titulo' => ['es' => 'Cotizá tus excursiones y tours en Iguazú', 'en' => 'Get a quote for tours and excursions in Iguazú', 'pt' => 'Faça a cotação dos seus passeios em Foz do Iguaçu'],
    'texto'  => ['es' => 'Operador y agencia receptiva. Viví las Cataratas del lado argentino y brasileño, con traslados, paseos en lancha y tours a medida.', 'en' => 'Tour operator and inbound agency. Experience the Falls from the Argentine and Brazilian sides, with transfers, boat rides and tailor-made tours.', 'pt' => 'Operadora e agência receptiva. Viva as Cataratas do lado argentino e brasileiro, com traslados, passeios de barco e roteiros sob medida.'],
    'iconos' => ['waves', 'boat', 'binoculars', 'van'],
    'boton'  => ['es' => '¡Cotizá ahora!', 'en' => 'Get a quote!', 'pt' => 'Cote agora!'],
    'activa' => true,
  ],
  [
    'slug'   => 'tierra-gaucha-viagens',
    'nombre' => 'Tierra Gaucha Viagens',
    'url'    => 'https://tierragauchaviagens.com.br/',
    'imagen' => 'parallax/bg-tgv.webp',
    'logo'   => 'agencias/logo-tgv-blanco.png',   // versión con texto blanco (original: logo-tgv.png)
    'logo_ancho' => 200,
    'titulo' => ['es' => 'Tu próximo viaje comienza acá', 'en' => 'Your next trip starts here', 'pt' => 'A sua próxima viagem começa aqui'],
    'texto'  => ['es' => 'Descubrí nuevos destinos, encontrá paquetes turísticos, alojamiento y experiencias únicas en Argentina y Brasil.', 'en' => 'Discover new destinations and find travel packages, accommodation and unique experiences in Argentina and Brazil.', 'pt' => 'Descubra novos destinos, encontre pacotes turísticos, hospedagem e experiências únicas na Argentina e no Brasil.'],
    'iconos' => ['airplane-tilt', 'suitcase-rolling', 'snowflake', 'compass'],
    'boton'  => ['es' => 'Pedí tu cotización', 'en' => 'Request a quote', 'pt' => 'Peça a sua cotação'],
    'activa' => true,
  ],
];
