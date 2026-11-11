<?php
/**
 * 8.3 Somos GTG — texto, 3 pilares y banda de contadores.
 */
$contadores = require ROOT . '/data/contadores.php';

$pilares = [
  ['icono' => 'ph-map-trifold',            'titulo' => t('nos_p1_titulo'), 'texto' => t('nos_p1_texto')],
  ['icono' => 'ph-seal-check',             'titulo' => t('nos_p2_titulo'), 'texto' => t('nos_p2_texto')],
  ['icono' => 'ph-globe-hemisphere-west',  'titulo' => t('nos_p3_titulo'), 'texto' => t('nos_p3_texto')],
];

// PRUEBA: fondo con foto parallax oscurecida + pilares/contadores con fondo translúcido.
// Poner en false para volver a la versión de fondo blanco.
$nosotros_foto = true;
$nosotros_bg   = 'parallax/bg-intro.webp';
?>
<section class="section about <?= $nosotros_foto ? 'about--photo' : 'section--white' ?>" id="nosotros">
  <?php if ($nosotros_foto): ?>
    <div class="parallax" data-parallax="1" aria-hidden="true">
      <img class="parallax-img" src="<?= e(img($nosotros_bg)) ?>" <?= img_dims($nosotros_bg) ?> alt="" loading="lazy">
    </div>
    <div class="about-overlay"></div>
  <?php endif; ?>
  <div class="container">

    <div class="row justify-content-center text-center">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow"><?= e(t('nos_etiqueta')) ?></span>
        <h2 class="section-title"><?= e(t('nos_titulo')) ?></h2>
        <p class="lead-text"><?= e(t('nos_texto')) ?></p>
      </div>
    </div>

    <div class="row g-4 g-lg-5 pillars">
      <?php foreach ($pilares as $i => $p): ?>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
          <div class="pillar">
            <i class="ph-light <?= e($p['icono']) ?> pillar-icon" aria-hidden="true"></i>
            <h3 class="pillar-title"><?= e(tr($p['titulo'])) ?></h3>
            <p><?= e(tr($p['texto'])) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if (empty($hero_contadores)): // si los contadores están en el hero, acá no se repiten ?>
    <div class="counters" data-aos="fade-up">
      <?php foreach ($contadores as $c): ?>
        <div class="counter">
          <span class="counter-value"><span class="js-counter" data-target="<?= (int) $c['valor'] ?>">0</span><?= e($c['sufijo']) ?></span>
          <span class="counter-label"><?= e(tr($c['texto'])) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>
