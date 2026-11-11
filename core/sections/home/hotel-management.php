<?php
/**
 * Hotel Management — banda angosta con fondo parallax, dirigida a propietarios de hoteles.
 * (Reemplaza a Club de Puntos; reutiliza los estilos .club-* de style.css §17.)
 * El botón lleva a la página interna /hotelmanagement/.
 */
$beneficios = [t('hm_b1'), t('hm_b2'), t('hm_b3')];
$hm_bg      = 'parallax/hotel-management-02.webp';
$hm_url     = url('hotelmanagement');
?>
<section class="club-band" id="hotel-management">
  <div class="parallax" data-parallax="1" aria-hidden="true">
    <img class="parallax-img" src="<?= e(img($hm_bg)) ?>" <?= img_dims($hm_bg) ?> alt="" loading="lazy">
  </div>
  <div class="club-overlay"></div>

  <div class="container">
    <div class="club-inner" data-aos="fade-up">
      <div class="club-head">
        <span class="eyebrow eyebrow--light"><?= e(t('hm_etiqueta')) ?></span>
        <h2 class="section-title section-title--light mb-0"><?= e(t('hm_titulo')) ?></h2>
      </div>
      <ul class="club-benefits">
        <?php foreach ($beneficios as $b): ?>
          <li><i class="ph-light ph-check" aria-hidden="true"></i><?= e($b) ?></li>
        <?php endforeach; ?>
      </ul>
      <a href="<?= e($hm_url) ?>" class="btn btn-gtg"><?= e(t('hm_boton')) ?></a>
    </div>
  </div>
</section>
