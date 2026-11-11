<?php
/**
 * Página 404 — la sirve .htaccess (y router.php en local) para cualquier ruta inexistente, en el idioma del prefijo.
 */
require __DIR__ . '/config.php';
http_response_code(404);

$page_slug        = '';
$page_title       = t('e404_titulo') . ' | ' . SITE_NAME;
$page_description = t('e404_texto');
$header_solid     = true;
include ROOT . '/includes/head.php';
?>
<body class="page page--404">
<a class="skip-link" href="#main"><?= e(t('saltar')) ?></a>
<?php include ROOT . '/includes/header.php'; ?>

<main id="main">
  <section class="section" style="padding-top: calc(var(--header-h) + var(--topbar-h) + 5rem);">
    <div class="container text-center">
      <span class="error-code" aria-hidden="true">404</span>
      <h1 class="section-title mt-3"><?= e(t('e404_titulo')) ?></h1>
      <p class="lead-text mb-4"><?= e(t('e404_texto')) ?></p>
      <div class="feature-actions justify-content-center">
        <a href="<?= e(url()) ?>" class="btn btn-gtg"><?= e(t('btn_volver')) ?></a>
        <a href="<?= e(url('', null, '#hoteles')) ?>" class="btn btn-gtg-outline"><?= e(t('e404_hoteles')) ?></a>
      </div>
    </div>
  </section>
</main>

<?php
include ROOT . '/includes/footer.php';
include ROOT . '/includes/whatsapp.php';
include ROOT . '/includes/scripts.php';
