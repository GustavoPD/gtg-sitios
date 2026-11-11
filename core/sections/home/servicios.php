<?php
/**
 * 8.5 Servicios — 8 destacados + resto desplegable (Bootstrap collapse).
 */
$lista_servicios = require ROOT . '/data/servicios.php';
$destacados = array_filter($lista_servicios, function ($s) { return !empty($s['destacado']); });
$resto      = array_filter($lista_servicios, function ($s) { return empty($s['destacado']); });
?>
<section class="section section--white services" id="servicios">
  <div class="container">

    <div class="text-center" data-aos="fade-up">
      <span class="eyebrow"><?= e(t('ser_etiqueta')) ?></span>
      <h2 class="section-title"><?= e(t('ser_titulo')) ?></h2>
      <p class="lead-text"><?= e(t('ser_texto')) ?></p>
    </div>

    <ul class="services-grid">
      <?php $i = 0; foreach ($destacados as $s): ?>
        <li class="service" data-aos="fade-up" data-aos-delay="<?= ($i++ % 4) * 80 ?>">
          <i class="ph-light <?= e($s['icono']) ?>" aria-hidden="true"></i>
          <span><?= e($s['nombre']) ?></span>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php if ($resto): ?>
      <div class="collapse" id="serviciosMas">
        <ul class="services-grid services-grid--more">
          <?php foreach ($resto as $s): ?>
            <li class="service">
              <i class="ph-light <?= e($s['icono']) ?>" aria-hidden="true"></i>
              <span><?= e($s['nombre']) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="text-center mt-5">
        <button class="btn btn-gtg-outline services-toggle collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#serviciosMas" aria-expanded="false" aria-controls="serviciosMas">
          <span class="when-collapsed"><?= e(t('ser_ver_todos')) ?> <i class="ph-light ph-plus" aria-hidden="true"></i></span>
          <span class="when-expanded"><?= e(t('ser_ver_menos')) ?> <i class="ph-light ph-minus" aria-hidden="true"></i></span>
        </button>
      </div>
    <?php endif; ?>

  </div>
</section>
