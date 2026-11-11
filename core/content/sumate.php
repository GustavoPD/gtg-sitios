<?php
/**
 * Contenido de /sumate/ — Trabajá con nosotros (textos del sitio anterior; PT traducido).
 * Búsquedas: los links 'url' son las ofertas publicadas en Naaloo. Para quitar una, borrarla del array.
 */
$busquedas_url = [
  'recepcion' => 'https://app.naaloo.com/public/oferta/df95fb89-1657-45d3-93a1-a9d7bd218681',
  'mucama'    => 'https://app.naaloo.com/public/oferta/7cf13c2e-b984-4f95-8aa0-240992d38dc8',
  'ventas'    => 'https://app.naaloo.com/public/oferta/93a207f3-12ad-4749-9ab6-28c46046cc66',
];

return [
  'es' => [
    'meta'    => 'Trabajá en Grupo Tierra Gaucha. Conocé nuestros valores y postulate a las búsquedas abiertas en nuestros hoteles de Bariloche.',
    'titulo'  => 'Trabajá con nosotros',
    'bajada'  => 'Descubrí nuevas oportunidades',
    'etiqueta' => 'Expertos en hotelería',
    'intro_titulo' => 'Bienvenidos',
    'intro'   => [
      'Nos alegra que estés interesado en formar parte de Grupo Tierra Gaucha y en descubrir nuevas oportunidades con nosotros.',
      'Valoramos la energía, las ideas y el compromiso de quienes quieren marcar la diferencia. Si te motiva crecer junto a un equipo con propósito, este es el lugar para vos.',
      'En Grupo Tierra Gaucha nos dedicamos a desarrollar hotelería y servicios turísticos en lugares estratégicos, creando experiencias memorables para nuestros huéspedes. Lo hacemos impulsados por un equipo joven y dinámico que comparte la pasión por la excelencia y un espíritu colaborativo, con la convicción de que nuestro crecimiento individual y colectivo van de la mano.',
    ],
    'valores_etiqueta' => 'Nuestros valores',
    'valores_titulo'   => 'El motor de nuestro día a día',
    'valores' => [
      ['Compromiso', 'Nos entregamos con dedicación a cada proyecto y tarea, sabiendo que el esfuerzo de cada uno impulsa el éxito de todos.'],
      ['Responsabilidad', 'Actuamos con integridad y asumimos las consecuencias de nuestras acciones, aprendiendo juntos de cada experiencia.'],
      ['Crecimiento', 'Fomentamos el desarrollo personal y profesional de cada miembro del equipo, porque tu crecimiento es nuestro crecimiento.'],
      ['Resiliencia', 'Nos adaptamos a los desafíos y aprendemos de cada experiencia, fortaleciéndonos como equipo en el proceso.'],
      ['Trabajo en equipo', 'Colaboramos activamente para alcanzar objetivos comunes: la suma de nuestros talentos nos lleva más lejos.'],
      ['Respeto', 'Valoramos la diversidad y las contribuciones de cada persona, creando un ambiente donde todos pueden prosperar.'],
      ['Excelencia', 'Buscamos la mejora continua en todo lo que hacemos, desafiándonos para alcanzar juntos nuestro máximo potencial.'],
    ],
    'busq_etiqueta' => 'Recursos Humanos',
    'busq_titulo'   => 'Te invitamos a ver nuestras oportunidades',
    'busq_texto'    => 'Si te identificás con nuestra misión y nuestros valores, compartís nuestro propósito de crecer juntos y buscás un entorno de trabajo estimulante donde desarrollarte y contribuir al éxito colectivo, te invitamos a ver nuestras búsquedas.',
    'postular'      => 'Postularme',
    'busquedas' => [
      ['imagen' => 'paginas/sumate-recepcion.webp', 'titulo' => 'Recepción', 'texto' => 'Postulate a través de nuestra plataforma de selección.', 'url' => $busquedas_url['recepcion']],
      ['imagen' => 'paginas/sumate-mucama.webp',    'titulo' => 'Mucama',    'texto' => 'Postulate a través de nuestra plataforma de selección.', 'url' => $busquedas_url['mucama']],
      ['imagen' => 'paginas/sumate-agencias.webp',  'titulo' => 'Ventas agencias de viajes', 'texto' => 'Postulate a través de nuestra plataforma de selección.', 'url' => $busquedas_url['ventas']],
      ['imagen' => 'paginas/sumate-otros.webp',     'titulo' => 'Otras áreas', 'texto' => 'Envianos tu CV indicando en el asunto la posición: Mantenimiento · Cocina (bacha, commis, cocineros/as, pasteleros/as) · Marketing · Gerencia de hotel · Administración y Finanzas · Recursos Humanos · Ventas · Lavadero.', 'url' => 'mailto:' . EMAIL_RRHH, 'boton' => 'Enviar CV'],
    ],
  ],
  'en' => [
    'meta'    => 'Work at Grupo Tierra Gaucha. Learn about our values and apply for open positions at our hotels in Bariloche.',
    'titulo'  => 'Work with us',
    'bajada'  => 'Discover new opportunities',
    'etiqueta' => 'Hospitality experts',
    'intro_titulo' => 'Welcome',
    'intro'   => [
      'We are glad that you are interested in being part of Grupo Tierra Gaucha and discovering new opportunities with us.',
      'We value the energy, ideas and commitment of those who want to make a difference. If you are motivated by growing alongside a purpose-driven team, this is the place for you.',
      'At Grupo Tierra Gaucha we develop hospitality and tourism services in strategic locations, creating memorable experiences for our guests. We do it driven by a young and dynamic team that shares a passion for excellence and a collaborative spirit, convinced that individual and collective growth go hand in hand.',
    ],
    'valores_etiqueta' => 'Our values',
    'valores_titulo'   => 'What drives us every day',
    'valores' => [
      ['Commitment', 'We dedicate ourselves to every project and task, knowing that each person\'s effort drives everyone\'s success.'],
      ['Responsibility', 'We act with integrity and own the consequences of our actions, learning together from every experience.'],
      ['Growth', 'We encourage the personal and professional development of every team member, because your growth is our growth.'],
      ['Resilience', 'We adapt to challenges and learn from every experience, becoming a stronger team in the process.'],
      ['Teamwork', 'We actively collaborate to reach common goals: the sum of our talents takes us further.'],
      ['Respect', 'We value diversity and each person\'s contributions, creating an environment where everyone can thrive.'],
      ['Excellence', 'We strive for continuous improvement in everything we do, challenging ourselves to reach our full potential together.'],
    ],
    'busq_etiqueta' => 'Human Resources',
    'busq_titulo'   => 'Explore our opportunities',
    'busq_texto'    => 'If you identify with our mission and values, share our purpose of growing together and are looking for a stimulating work environment where you can develop and contribute to collective success, we invite you to explore our open positions.',
    'postular'      => 'Apply',
    'busquedas' => [
      ['imagen' => 'paginas/sumate-recepcion.webp', 'titulo' => 'Front desk', 'texto' => 'Apply through our recruitment platform.', 'url' => $busquedas_url['recepcion']],
      ['imagen' => 'paginas/sumate-mucama.webp',    'titulo' => 'Housekeeping', 'texto' => 'Apply through our recruitment platform.', 'url' => $busquedas_url['mucama']],
      ['imagen' => 'paginas/sumate-agencias.webp',  'titulo' => 'Travel agency sales', 'texto' => 'Apply through our recruitment platform.', 'url' => $busquedas_url['ventas']],
      ['imagen' => 'paginas/sumate-otros.webp',     'titulo' => 'Other areas', 'texto' => 'Send us your CV with the position in the subject line: Maintenance · Kitchen (dishwashers, commis, cooks, pastry chefs) · Marketing · Hotel management · Administration and Finance · Human Resources · Sales · Laundry.', 'url' => 'mailto:' . EMAIL_RRHH, 'boton' => 'Send CV'],
    ],
  ],
  'pt' => [
    'meta'    => 'Trabalhe no Grupo Tierra Gaucha. Conheça os nossos valores e candidate-se às vagas abertas em nossos hotéis de Bariloche.',
    'titulo'  => 'Trabalhe conosco',
    'bajada'  => 'Descubra novas oportunidades',
    'etiqueta' => 'Especialistas em hotelaria',
    'intro_titulo' => 'Boas-vindas',
    'intro'   => [
      'Ficamos felizes com o seu interesse em fazer parte do Grupo Tierra Gaucha e descobrir novas oportunidades conosco.',
      'Valorizamos a energia, as ideias e o compromisso de quem quer fazer a diferença. Se você se motiva a crescer junto a uma equipe com propósito, este é o lugar para você.',
      'No Grupo Tierra Gaucha nos dedicamos a desenvolver hotelaria e serviços turísticos em locais estratégicos, criando experiências memoráveis para os nossos hóspedes. Fazemos isso impulsionados por uma equipe jovem e dinâmica que compartilha a paixão pela excelência e o espírito colaborativo, com a convicção de que o crescimento individual e o coletivo andam juntos.',
    ],
    'valores_etiqueta' => 'Nossos valores',
    'valores_titulo'   => 'O motor do nosso dia a dia',
    'valores' => [
      ['Compromisso', 'Nos dedicamos a cada projeto e tarefa, sabendo que o esforço de cada um impulsiona o sucesso de todos.'],
      ['Responsabilidade', 'Agimos com integridade e assumimos as consequências das nossas ações, aprendendo juntos com cada experiência.'],
      ['Crescimento', 'Incentivamos o desenvolvimento pessoal e profissional de cada membro da equipe, porque o seu crescimento é o nosso crescimento.'],
      ['Resiliência', 'Nos adaptamos aos desafios e aprendemos com cada experiência, fortalecendo-nos como equipe no processo.'],
      ['Trabalho em equipe', 'Colaboramos ativamente para alcançar objetivos comuns: a soma dos nossos talentos nos leva mais longe.'],
      ['Respeito', 'Valorizamos a diversidade e as contribuições de cada pessoa, criando um ambiente onde todos podem prosperar.'],
      ['Excelência', 'Buscamos a melhoria contínua em tudo o que fazemos, desafiando-nos para alcançar juntos o nosso máximo potencial.'],
    ],
    'busq_etiqueta' => 'Recursos Humanos',
    'busq_titulo'   => 'Conheça as nossas oportunidades',
    'busq_texto'    => 'Se você se identifica com a nossa missão e os nossos valores, compartilha o nosso propósito de crescer juntos e busca um ambiente de trabalho estimulante para se desenvolver e contribuir para o sucesso coletivo, convidamos você a conhecer as nossas vagas.',
    'postular'      => 'Candidatar-me',
    'busquedas' => [
      ['imagen' => 'paginas/sumate-recepcion.webp', 'titulo' => 'Recepção', 'texto' => 'Candidate-se pela nossa plataforma de seleção.', 'url' => $busquedas_url['recepcion']],
      ['imagen' => 'paginas/sumate-mucama.webp',    'titulo' => 'Camareira', 'texto' => 'Candidate-se pela nossa plataforma de seleção.', 'url' => $busquedas_url['mucama']],
      ['imagen' => 'paginas/sumate-agencias.webp',  'titulo' => 'Vendas para agências de viagem', 'texto' => 'Candidate-se pela nossa plataforma de seleção.', 'url' => $busquedas_url['ventas']],
      ['imagen' => 'paginas/sumate-otros.webp',     'titulo' => 'Outras áreas', 'texto' => 'Envie o seu currículo indicando a vaga no assunto: Manutenção · Cozinha (copa, commis, cozinheiros/as, confeiteiros/as) · Marketing · Gerência de hotel · Administração e Finanças · Recursos Humanos · Vendas · Lavanderia.', 'url' => 'mailto:' . EMAIL_RRHH, 'boton' => 'Enviar currículo'],
    ],
  ],
];
