<?php
/**
 * 8.2 Franja de marcas — todos los logos de hoteles y agencias en marquee continuo.
 */
$franja_marcas = require ROOT . '/data/marcas.php';
?>
<section class="brands-strip" aria-label="<?= e(t('foot_marcas')) ?>">
  <div class="swiper brands-swiper">
    <div class="swiper-wrapper">
      <?php foreach ($franja_marcas as $m): ?>
        <div class="swiper-slide">
          <a href="<?= e($m['url']) ?>" target="_blank" rel="noopener" class="brand-item" title="<?= e($m['nombre']) ?>">
            <?php if (img_exists($m['logo'])): ?>
              <img src="<?= e(img($m['logo'])) ?>" <?= img_dims($m['logo']) ?> alt="<?= e($m['nombre']) ?>" loading="lazy">
            <?php else: ?>
              <span class="brand-text"><?= e($m['nombre']) ?></span>
            <?php endif; ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
