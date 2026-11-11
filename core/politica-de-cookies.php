<?php
/** Política de cookies — /politica-de-cookies/ */
require __DIR__ . '/config.php';
$page_slug = 'politica-de-cookies';
$legal_doc = 'politica-de-cookies';
$textos = [
  'es' => ['titulo' => 'Política de Cookies',  'descripcion' => 'Política de cookies del sitio web de Grupo Tierra Gaucha: qué son, cuáles usamos y cómo desactivarlas.'],
  'en' => ['titulo' => 'Cookie Policy',        'descripcion' => 'Grupo Tierra Gaucha website cookie policy: what cookies are, which ones we use and how to disable them.'],
  'pt' => ['titulo' => 'Política de Cookies',  'descripcion' => 'Política de cookies do site do Grupo Tierra Gaucha: o que são, quais usamos e como desativá-los.'],
];
$c = $textos[LANG];
include ROOT . '/includes/legal.php';
