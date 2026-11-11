<?php
/**
 * 8.6 Promociones — Swiper de tarjetas estilo DOT + popup opcional (una vez por sesión).
 */
$lista_promos = array_values(array_filter(require ROOT . '/data/promociones.php', function ($p) { return !empty($p['activa']); }));

$promo_popup = null;
foreach ($lista_promos as $p) {
  if (!empty($p['popup'])) { $promo_popup = $p; break; }
}

// Columnas según cantidad de promos activas (en desktop): 2 promos = mitad y mitad (col-6), 3 = tercios (col-4),
// más de 3 = carrusel de a 3. Las flechas solo aparecen cuando hay más promos que columnas visibles.
$promo_cant   = count($lista_promos);
$flechas_clase = $promo_cant <= 2 ? ' d-md-none' : ($promo_cant === 3 ? ' d-xl-none' : '');
?>
<section class="section section--cream promos" id="promociones">
  <div class="container">

    <div class="section-head section-head--split" data-aos="fade-up">
      <div>
        <span class="eyebrow"><?= e(t('pro_etiqueta')) ?></span>
        <h2 class="section-title"><?= e(t('pro_titulo')) ?></h2>
        <p class="section-sub mb-0"><?= e(t('pro_bajada')) ?></p>
      </div>
      <div class="slider-nav slider-nav--inline<?= $flechas_clase ?>">
        <button type="button" class="slider-btn promos-prev" aria-label="<?= e(t('anterior')) ?>"><i class="ph-light ph-caret-left" aria-hidden="true"></i></button>
        <button type="button" class="slider-btn promos-next" aria-label="<?= e(t('siguiente')) ?>"><i class="ph-light ph-caret-right" aria-hidden="true"></i></button>
      </div>
    </div>

    <div class="swiper promos-swiper" data-count="<?= $promo_cant ?>" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper-wrapper">
        <?php foreach ($lista_promos as $p): ?>
          <div class="swiper-slide">
            <article class="promo-card">
              <div class="promo-card-media">
                <img src="<?= e(img($p['imagen'])) ?>" <?= img_dims($p['imagen']) ?> alt="<?= e(tr($p['titulo'])) ?>" loading="lazy">
              </div>
              <div class="promo-card-body">
                <h3 class="promo-card-title"><?= e(tr($p['titulo'])) ?></h3>
                <p class="promo-card-text"><?= e(tr($p['bajada'])) ?></p>
                <ul class="promo-details">
                  <?php foreach ($p['detalles'] as $d): ?>
                    <li><i class="ph-light <?= e($d[0]) ?>" aria-hidden="true"></i><span><?= e(tr($d[1])) ?></span></li>
                  <?php endforeach; ?>
                </ul>
                <a href="<?= e(wa_link(tr($p['wa_texto']))) ?>" target="_blank" rel="noopener" class="btn btn-gtg w-100"><?= e(t('mas_info')) ?></a>
              </div>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="slider-pagination promos-pagination d-md-none"></div>

  </div>
</section>

<?php if ($promo_popup): ?>
<div class="modal fade promo-modal" id="promoModal" tabindex="-1" aria-labelledby="promoModalTitle" aria-hidden="true" data-promo="<?= e($promo_popup['slug']) ?>">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <button type="button" class="promo-modal-close" data-bs-dismiss="modal" aria-label="<?= e(t('nav_cerrar')) ?>"><i class="ph-light ph-x" aria-hidden="true"></i></button>
      <div class="row g-0">
        <div class="col-md-6 promo-modal-media">
          <img src="<?= e(img($promo_popup['imagen'])) ?>" <?= img_dims($promo_popup['imagen']) ?> alt="" loading="lazy">
        </div>
        <div class="col-md-6 promo-modal-body">
          <span class="eyebrow"><?= e(t('pro_etiqueta')) ?></span>
          <h2 class="promo-modal-title" id="promoModalTitle"><?= e(tr($promo_popup['titulo'])) ?></h2>
          <p><?= e(tr($promo_popup['bajada'])) ?></p>
          <ul class="promo-details">
            <?php foreach ($promo_popup['detalles'] as $d): ?>
              <li><i class="ph-light <?= e($d[0]) ?>" aria-hidden="true"></i><span><?= e(tr($d[1])) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <a href="<?= e(wa_link(tr($promo_popup['wa_texto']))) ?>" target="_blank" rel="noopener" class="btn btn-gtg w-100"><?= e(t('mas_info')) ?></a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
