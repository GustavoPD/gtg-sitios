<?php
/**
 * Inicio de una página interna: <head>, header y encabezado con foto.
 * Variables (definirlas antes de incluir):
 *   $page_slug         slug de la URL (ej. 'sumate'); '' = home
 *   $page_title        <title> (si falta, se arma con el título del encabezado)
 *   $page_description  meta description
 *   $hero = [
 *     'imagen'   => 'paginas/sumate-hero.webp',
 *     'etiqueta' => 'Grupo Tierra Gaucha',   // opcional
 *     'titulo'   => 'Trabajá con nosotros',
 *     'bajada'   => '...',                   // opcional
 *     'corto'    => true,                    // opcional: encabezado más bajo (legales)
 *   ]
 */
$hero = isset($hero) ? $hero : [];
if (empty($page_title) && !empty($hero['titulo'])) {
  $page_title = $hero['titulo'] . ' | ' . SITE_NAME;
}
if (!empty($hero['imagen'])) {
  $page_og_image = $hero['imagen'];
  $page_preload  = [[img($hero['imagen']), '']];
}
include ROOT . '/includes/head.php';
?>
<body class="page page--<?= e($page_slug) ?>">
<a class="skip-link" href="#main"><?= e(t('saltar')) ?></a>

<?php include ROOT . '/includes/header.php'; ?>

<main id="main">
  <section class="page-hero<?= !empty($hero['corto']) ? ' page-hero--short' : '' ?>">
    <?php if (!empty($hero['imagen'])): ?>
      <img class="page-hero-img" src="<?= e(img($hero['imagen'])) ?>" <?= img_dims($hero['imagen']) ?> alt="" fetchpriority="high">
    <?php endif; ?>
    <div class="page-hero-overlay"></div>
    <div class="container" data-aos="fade-up">
      <?php if (!empty($hero['etiqueta'])): ?>
        <span class="eyebrow"><?= e($hero['etiqueta']) ?></span>
      <?php endif; ?>
      <h1 class="page-hero-title"><?= e($hero['titulo']) ?></h1>
      <?php if (!empty($hero['bajada'])): ?>
        <p class="page-hero-sub"><?= e($hero['bajada']) ?></p>
      <?php endif; ?>
      <ol class="breadcrumbs" aria-label="<?= e(t('migas')) ?>">
        <li><a href="<?= e(url()) ?>"><?= e(t('nav_inicio_label')) ?></a></li>
        <li aria-current="page"><?= e($hero['titulo']) ?></li>
      </ol>
    </div>
  </section>
