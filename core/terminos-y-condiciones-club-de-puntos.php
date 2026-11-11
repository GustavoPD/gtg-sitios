<?php
/** Términos y condiciones del Club de Puntos — /terminos-y-condiciones-club-de-puntos/ (fuera del menú) */
require __DIR__ . '/config.php';
$page_slug = 'terminos-y-condiciones-club-de-puntos';
$legal_doc = 'terminos-club-de-puntos';
$textos = [
  'es' => ['titulo' => 'Términos y Condiciones del Club de Puntos', 'descripcion' => 'Términos y condiciones del Club de Puntos, el programa de fidelidad de Grupo Tierra Gaucha.'],
  'en' => ['titulo' => 'Points Club Terms and Conditions',          'descripcion' => 'Terms and conditions of the Points Club, the Grupo Tierra Gaucha loyalty program.'],
  'pt' => ['titulo' => 'Termos e Condições do Clube de Pontos',     'descripcion' => 'Termos e condições do Clube de Pontos, o programa de fidelidade do Grupo Tierra Gaucha.'],
];
$c = $textos[LANG];
include ROOT . '/includes/legal.php';
