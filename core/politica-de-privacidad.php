<?php
/** Política de privacidad — /politica-de-privacidad-de-grupo-tierra-gaucha/ */
require __DIR__ . '/config.php';
$page_slug = 'politica-de-privacidad-de-grupo-tierra-gaucha';
$legal_doc = 'politica-de-privacidad';
$textos = [
  'es' => ['titulo' => 'Política de Privacidad', 'descripcion' => 'Política de privacidad de Grupo Tierra Gaucha: cómo recopilamos, usamos y protegemos tus datos personales.'],
  'en' => ['titulo' => 'Privacy Policy',         'descripcion' => 'Grupo Tierra Gaucha privacy policy: how we collect, use and protect your personal data.'],
  'pt' => ['titulo' => 'Política de Privacidade', 'descripcion' => 'Política de privacidade do Grupo Tierra Gaucha: como coletamos, usamos e protegemos os seus dados pessoais.'],
];
$c = $textos[LANG];
include ROOT . '/includes/legal.php';
