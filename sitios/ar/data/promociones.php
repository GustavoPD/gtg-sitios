<?php
/**
 * Promociones.
 * detalles: array de [icono Phosphor, texto]
 * popup:    true = se muestra en un modal al entrar (una vez por sesión). Solo una promo debería tenerlo.
 * activa:   false = no se muestra en el sitio.
 */
return [
  [
    'slug'     => 'transferencia-15',
    'titulo'   => ['es' => '15% OFF abonando con transferencia bancaria', 'en' => '15% OFF when paying by bank transfer', 'pt' => '15% OFF pagando com transferência bancária'],
    'bajada'   => ['es' => 'Reservá tu estadía y obtené un 15% de descuento pagando por transferencia.', 'en' => 'Book your stay and get 15% off when paying by bank transfer.', 'pt' => 'Reserve a sua estadia e ganhe 15% de desconto pagando por transferência.'],
    'detalles' => [
      ['ph-moon',        ['es' => 'Mínimo 3 noches consecutivas', 'en' => 'Minimum 3 consecutive nights', 'pt' => 'Mínimo de 3 noites consecutivas']],
      ['ph-bank',        ['es' => 'Pago por transferencia bancaria', 'en' => 'Payment by bank transfer', 'pt' => 'Pagamento por transferência bancária']],
      ['ph-percent',     ['es' => '15% de descuento', 'en' => '15% discount', 'pt' => '15% de desconto']],
    ],
    'imagen'   => 'promociones/promo-01.webp',
    'wa_texto' => ['es' => '¡Hola! Quiero más información sobre la promo de 15% OFF abonando con transferencia.', 'en' => 'Hello! I would like more information about the 15% OFF bank transfer offer.', 'pt' => 'Olá! Gostaria de mais informações sobre a promoção de 15% OFF pagando com transferência.'],
    'popup'    => false,
    'activa'   => true,
  ],
  [
    'slug'     => 'cuotas',
    'titulo'   => ['es' => 'Pagá tu estadía en cuotas', 'en' => 'Pay for your stay in installments', 'pt' => 'Pague a sua estadia parcelado'],
    'bajada'   => ['es' => 'Financiá tus vacaciones en Bariloche con todas las tarjetas.', 'en' => 'Finance your Bariloche vacation with all credit cards.', 'pt' => 'Parcele as suas férias em Bariloche com todos os cartões.'],
    'detalles' => [
      ['ph-credit-card',   ['es' => 'Con todas las tarjetas', 'en' => 'With all credit cards', 'pt' => 'Com todos os cartões']],
      ['ph-calendar-check', ['es' => 'Cuotas fijas', 'en' => 'Fixed installments', 'pt' => 'Parcelas fixas']],
      ['ph-info',          ['es' => 'Consultá condiciones vigentes', 'en' => 'Ask about current conditions', 'pt' => 'Consulte as condições vigentes']],
    ],
    'imagen'   => 'promociones/promo-02.webp',
    'wa_texto' => ['es' => '¡Hola! Quiero más información sobre pagar mi estadía en cuotas.', 'en' => 'Hello! I would like more information about paying for my stay in installments.', 'pt' => 'Olá! Gostaria de mais informações sobre pagar a minha estadia parcelado.'],
    'popup'    => false,
    'activa'   => true,
  ],
  [
    'slug'     => 'black-friday',
    'titulo'   => ['es' => 'Black Friday: 40% OFF', 'en' => 'Black Friday: 40% OFF', 'pt' => 'Black Friday: 40% OFF'],
    'bajada'   => ['es' => 'Una oportunidad única para reservar tus próximas vacaciones.', 'en' => 'A unique opportunity to book your next vacation.', 'pt' => 'Uma oportunidade única para reservar as suas próximas férias.'],
    'detalles' => [
      ['ph-moon',     ['es' => 'Mínimo 3 noches', 'en' => 'Minimum 3 nights', 'pt' => 'Mínimo de 3 noites']],
      ['ph-bank',     ['es' => 'Pago por transferencia', 'en' => 'Payment by bank transfer', 'pt' => 'Pagamento por transferência']],
      ['ph-prohibit', ['es' => 'No acumulable con otras promociones', 'en' => 'Cannot be combined with other offers', 'pt' => 'Não cumulativo com outras promoções']],
    ],
    'imagen'   => 'promociones/promo-03.webp',
    'wa_texto' => ['es' => '¡Hola! Quiero aprovechar la promo Black Friday 40% OFF.', 'en' => 'Hello! I would like to take advantage of the Black Friday 40% OFF offer.', 'pt' => 'Olá! Quero aproveitar a promoção Black Friday 40% OFF.'],
    'popup'    => true,
    'activa'   => false,   // oculta: en el sitio actual no está
  ],
];
