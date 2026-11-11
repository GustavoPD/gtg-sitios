<?php
/**
 * 8.4 Hoteles — tabs de filtro + Swiper de tarjetas.
 *   v1: 6 cards verticales (foto 4:5, logo al pasar el mouse), contenedor ancho.
 *   v2: 4 cards con foto horizontal, logo del hotel en una solapa sobre la foto y descripción breve.
 * Versión por defecto en $hoteles_version; para comparar: ?hoteles=v1 / ?hoteles=v2
 */
$lista_hoteles = require ROOT . '/data/hoteles.php';

$hoteles_version = 'v2';
if (isset($_GET['hoteles']) && in_array($_GET['hoteles'], ['v1', 'v2'], true)) {
  $hoteles_version = $_GET['hoteles'];
}

$filtros = [
  ''             => t('hot_todos'),
  'bariloche'    => t('hot_bariloche'),
  'buenos-aires' => t('hot_buenos_aires'),
  'brasil'       => t('hot_brasil'),
];
?>
<section class="section hotels hotels--<?= $hoteles_version ?>" id="hoteles">
  <div class="container<?= $hoteles_version === 'v1' ? ' container--wide' : '' ?>">

    <div class="section-head section-head--split" data-aos="fade-up">
      <div>
        <span class="eyebrow"><?= e(t('hot_etiqueta')) ?></span>
        <h2 class="section-title mb-0"><?= e(t('hot_titulo')) ?></h2>
      </div>
      <div class="filter-tabs" role="tablist" aria-label="<?= e(t('hot_filtrar')) ?>">
        <?php $first = true; foreach ($filtros as $val => $label): ?>
          <button type="button" class="filter-tab<?= $first ? ' active' : '' ?>" data-filter="<?= e($val) ?>" role="tab" aria-selected="<?= $first ? 'true' : 'false' ?>"><?= e($label) ?></button>
        <?php $first = false; endforeach; ?>
      </div>
    </div>

    <div class="hotels-slider" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper hotels-swiper" data-version="<?= $hoteles_version ?>">
        <div class="swiper-wrapper">
          <?php foreach ($lista_hoteles as $h): ?>
            <div class="swiper-slide" data-filtro="<?= e($h['filtro']) ?>">
              <?php if ($hoteles_version === 'v2'): ?>
              <article class="hotel-card hotel-card--v2">
                <div class="hotel-card-top">
                  <a href="<?= e($h['url']) ?>" target="_blank" rel="noopener" class="hotel-card-media">
                    <img src="<?= e(img($h['imagen'])) ?>" <?= img_dims($h['imagen']) ?> alt="<?= e($h['nombre']) ?>" loading="lazy">
                  </a>
                  <?php if (img_exists($h['logo'])): ?>
                    <span class="hotel-card-badge"><img src="<?= e(img($h['logo'])) ?>" <?= img_dims($h['logo']) ?> alt="" loading="lazy"></span>
                  <?php endif; ?>
                </div>
                <div class="hotel-card-body">
                  <h3 class="hotel-card-title"><a href="<?= e($h['url']) ?>" target="_blank" rel="noopener"><?= e($h['nombre']) ?></a><?php if (!empty($h['pet_friendly'])): ?> <span class="hotel-pet" title="<?= e(t('pet_friendly')) ?>"><i class="ph-light ph-paw-print" aria-hidden="true"></i>Pet Friendly</span><?php endif; ?></h3>
                  <p class="hotel-card-loc"><i class="ph-light ph-map-pin" aria-hidden="true"></i><?= e(tr($h['tipo'])) ?> <span aria-hidden="true">·</span> <?= e(tr($h['ubicacion'])) ?></p>
                  <?php if (!empty($h['descripcion'])): ?>
                    <p class="hotel-card-desc"><?= e(tr($h['descripcion'])) ?></p>
                  <?php endif; ?>
                  <div class="hotel-card-actions">
                    <a href="<?= e($h['url']) ?>" target="_blank" rel="noopener" class="btn btn-gtg-outline btn-sm"><?= e(t('ver_hotel')) ?></a>
                    <a href="#reservar" class="btn btn-gtg btn-sm" data-reservar="<?= e($h['slug']) ?>"><?= e(t('reservar')) ?></a>
                  </div>
                </div>
              </article>
              <?php else: ?>
              <article class="hotel-card">
                <a href="<?= e($h['url']) ?>" target="_blank" rel="noopener" class="hotel-card-media">
                  <img src="<?= e(img($h['imagen'])) ?>" <?= img_dims($h['imagen']) ?> alt="<?= e($h['nombre']) ?>" loading="lazy">
                  <?php if (img_exists($h['logo'])): ?>
                    <span class="hotel-card-logo"><img src="<?= e(img($h['logo'])) ?>" <?= img_dims($h['logo']) ?> alt="" loading="lazy"></span>
                  <?php endif; ?>
                </a>
                <div class="hotel-card-body">
                  <h3 class="hotel-card-title"><?= e($h['nombre']) ?><?php if (!empty($h['pet_friendly'])): ?> <span class="hotel-pet" title="<?= e(t('pet_friendly')) ?>"><i class="ph-light ph-paw-print" aria-hidden="true"></i>Pet Friendly</span><?php endif; ?></h3>
                  <p class="hotel-card-sub"><?= e(tr($h['tipo'])) ?> <span aria-hidden="true">·</span> <?= e(tr($h['ubicacion'])) ?></p>
                  <div class="hotel-card-actions">
                    <a href="<?= e($h['url']) ?>" target="_blank" rel="noopener" class="btn btn-gtg-outline btn-sm"><?= e(t('ver_hotel')) ?></a>
                    <a href="#reservar" class="btn btn-gtg btn-sm" data-reservar="<?= e($h['slug']) ?>"><?= e(t('reservar')) ?></a>
                  </div>
                </div>
              </article>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="slider-nav">
        <button type="button" class="slider-btn hotels-prev" aria-label="<?= e(t('anterior')) ?>"><i class="ph-light ph-caret-left" aria-hidden="true"></i></button>
        <div class="slider-pagination hotels-pagination"></div>
        <button type="button" class="slider-btn hotels-next" aria-label="<?= e(t('siguiente')) ?>"><i class="ph-light ph-caret-right" aria-hidden="true"></i></button>
      </div>
    </div>

  </div>
</section>
