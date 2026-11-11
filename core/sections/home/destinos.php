<?php
/**
 * Destinos — un panel con parallax por sitio del Grupo (sitio.php > 'destinos': ar, br, cl).
 * El link lleva a la home de ese sitio en el idioma actual (si el sitio lo tiene).
 */
$destinos_todos = [
  'ar' => ['titulo' => 'Argentina', 'url' => 'https://www.grupotierragaucha.com.ar', 'idiomas' => ['es', 'en', 'pt'], 'imagen' => 'destinos/argentina.webp', 'sub' => 'Bariloche · Buenos Aires'],
  'br' => ['titulo' => ['es' => 'Brasil', 'en' => 'Brazil', 'pt' => 'Brasil'], 'url' => 'https://www.grupotierragaucha.com.br', 'idiomas' => ['pt', 'es', 'en'], 'imagen' => 'parallax/brasil.webp', 'sub' => 'Foz do Iguaçu'],
  'cl' => ['titulo' => 'Chile', 'url' => 'https://www.grupotierragaucha.cl', 'idiomas' => ['es', 'en', 'pt'], 'imagen' => 'parallax/chile.webp',  'sub' => 'Grupo Tierra Gaucha Chile'],
];
$destinos = [];
foreach (sitio('destinos', []) as $cod) {
  $d = $destinos_todos[$cod];
  $d['url'] .= '/' . (LANG !== $d['idiomas'][0] && in_array(LANG, $d['idiomas'], true) ? LANG . '/' : '');
  $destinos[] = $d;
}
$destinos_col = count($destinos) >= 3 ? 'col-md-4' : 'col-md-6';
?>
<section class="section section--white destinations<?= count($destinos) >= 3 ? ' destinations--3' : '' ?>" id="destinos">
  <div class="container">
    <div class="text-center" data-aos="fade-up">
      <span class="eyebrow"><?= e(t('des_etiqueta')) ?></span>
      <h2 class="section-title"><?= e(t('des_titulo')) ?></h2>
    </div>

    <div class="row g-4">
      <?php foreach ($destinos as $i => $d): ?>
        <div class="<?= $destinos_col ?>" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
          <a href="<?= e($d['url']) ?>" target="_blank" rel="noopener" class="destination-panel">
            <span class="parallax" data-parallax="0.8" aria-hidden="true">
              <img class="parallax-img" src="<?= e(img($d['imagen'])) ?>" <?= img_dims($d['imagen']) ?> alt="" loading="lazy">
            </span>
            <span class="destination-overlay"></span>
            <span class="destination-content">
              <span class="eyebrow eyebrow--light"><?= e(tr($d['sub'])) ?></span>
              <span class="destination-title"><?= e(tr($d['titulo'])) ?></span>
              <span class="destination-link"><?= e(t('des_visitar')) ?> <i class="ph-light ph-arrow-right" aria-hidden="true"></i></span>
            </span>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
