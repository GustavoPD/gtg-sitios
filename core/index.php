<?php
require __DIR__ . '/config.php';

$slides = require ROOT . '/data/slides.php';

// Precarga del primer slide (desktop / mobile) para mejorar el LCP
$page_preload = [];
if (!empty($slides)) {
  $page_preload[] = [img($slides[0]['imagen_mobile']), '(max-width: 767.98px)'];
  $page_preload[] = [img($slides[0]['imagen']), '(min-width: 768px)'];
  $page_og_image  = $slides[0]['imagen'];
}

include ROOT . '/includes/head.php';
?>
<body class="home">
<a class="skip-link" href="#main"><?= e(t('saltar')) ?></a>

<?php include ROOT . '/includes/header.php'; ?>

<main id="main">
  <?php
  // Secciones de la home de este sitio, en orden (sitio.php > 'home').
  foreach (sitio('home') as $gtg_seccion) {
    include ROOT . '/sections/home/' . $gtg_seccion . '.php';
  }
  ?>
</main>

<?php
include ROOT . '/includes/footer.php';
include ROOT . '/includes/whatsapp.php';
include ROOT . '/includes/scripts.php';
