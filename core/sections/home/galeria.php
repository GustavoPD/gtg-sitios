<?php
/**
 * 8.10 Galería — masonry 4 columnas en desktop, Swiper en mobile, GLightbox.
 */
$lista_galeria = require ROOT . '/data/galeria.php';
?>
<section class="section section--cream gallery" id="galeria">
  <div class="container">
    <div class="text-center" data-aos="fade-up">
      <span class="eyebrow"><?= e(t('gal_etiqueta')) ?></span>
      <h2 class="section-title"><?= e(t('gal_titulo')) ?></h2>
    </div>

    <!-- Desktop / tablet: masonry -->
    <div class="gallery-masonry d-none d-md-block">
      <?php foreach ($lista_galeria as $i => $g): ?>
        <a href="<?= e(img($g['imagen'])) ?>" class="gallery-item glightbox" data-gallery="galeria" data-aos="fade-up" data-aos-delay="<?= ($i % 4) * 80 ?>">
          <img src="<?= e(img($g['imagen'])) ?>" <?= img_dims($g['imagen']) ?> alt="<?= e(tr($g['alt'])) ?>" loading="lazy">
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Mobile: Swiper -->
    <div class="d-md-none">
      <div class="swiper gallery-swiper">
        <div class="swiper-wrapper">
          <?php foreach ($lista_galeria as $g): ?>
            <div class="swiper-slide">
              <a href="<?= e(img($g['imagen'])) ?>" class="gallery-item gallery-item--slide glightbox" data-gallery="galeria-m">
                <img src="<?= e(img($g['imagen'])) ?>" <?= img_dims($g['imagen']) ?> alt="<?= e(tr($g['alt'])) ?>" loading="lazy">
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="slider-pagination gallery-pagination"></div>
    </div>
  </div>
</section>
