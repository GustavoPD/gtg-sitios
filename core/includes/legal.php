<?php
/**
 * Plantilla de las páginas legales. Requiere $legal_doc (nombre en content/legal/) y $c (contenido de la página).
 * Si el documento no está en el idioma actual, se muestra en español con un aviso.
 */
$legal_file = ROOT . '/content/legal/' . $legal_doc . '.' . LANG . '.html';
$legal_fallback = false;
if (!is_file($legal_file)) {
  $legal_file = ROOT . '/content/legal/' . $legal_doc . '.es.html';
  $legal_fallback = true;
}
$hero = ['imagen' => 'parallax/bg-intro.webp', 'etiqueta' => SITE_NAME, 'titulo' => $c['titulo'], 'corto' => true];
$page_description = $c['descripcion'];
include ROOT . '/includes/page-start.php';
?>
<section class="section">
  <div class="container">
    <?php if ($legal_fallback): ?>
      <p class="legal-note" lang="<?= e(LANG) ?>"><?= e(t('legal_solo_es')) ?></p>
    <?php endif; ?>
    <div class="legal"<?= $legal_fallback ? ' lang="es"' : '' ?>>
      <?php readfile($legal_file); ?>
    </div>
  </div>
</section>
<?php include ROOT . '/includes/page-end.php'; ?>
