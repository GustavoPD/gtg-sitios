<?php
/**
 * Agencias — un banner por agencia: foto parallax oscurecida + logo + título con
 * íconos a los costados + texto + botón. Datos en data/agencias.php.
 */
// Las que muestra este sitio, en el orden de sitio.php > 'agencias' (y que estén activas).
$agencias = [];
foreach (require ROOT . '/data/agencias.php' as $a) {
  $pos = array_search($a['slug'], sitio('agencias', []), true);
  if ($pos !== false && !empty($a['activa'])) $agencias[$pos] = $a;
}
ksort($agencias);
?>
<section class="agencies" id="agencias" aria-label="<?= e(t('nav_agencias')) ?>">
  <?php foreach ($agencias as $a):
    $iconos = isset($a['iconos']) ? $a['iconos'] : [];
    $izq = array_slice($iconos, 0, 2);
    $der = array_slice($iconos, 2, 2);
  ?>
    <div class="agency-banner">
      <div class="parallax" data-parallax="1" aria-hidden="true">
        <img class="parallax-img" src="<?= e(img($a['imagen'])) ?>" <?= img_dims($a['imagen']) ?> alt="" loading="lazy">
      </div>
      <div class="agency-banner-overlay"></div>

      <div class="agency-banner-content" data-aos="fade-up">
        <a class="agency-banner-brand" href="<?= e($a['url']) ?>" target="_blank" rel="noopener">
          <?php if (img_exists($a['logo'])): ?>
            <img class="agency-banner-logo" src="<?= e(img($a['logo'])) ?>" <?= img_dims($a['logo']) ?><?= !empty($a['logo_ancho']) ? ' style="width:' . (int) $a['logo_ancho'] . 'px"' : '' ?> alt="<?= e($a['nombre']) ?>" loading="lazy">
          <?php else: ?>
            <span class="agency-banner-name"><?= e($a['nombre']) ?></span>
          <?php endif; ?>
        </a>

        <div class="agency-banner-main">
          <?php if ($izq): ?>
            <div class="agency-icons" aria-hidden="true">
              <?php foreach ($izq as $ic): ?><i class="ph-light ph-<?= e($ic) ?>"></i><?php endforeach; ?>
            </div>
          <?php endif; ?>

          <div class="agency-banner-text">
            <h2 class="agency-banner-title"><?= e(tr($a['titulo'])) ?></h2>
            <p class="agency-banner-desc"><?= e(tr($a['texto'])) ?></p>
          </div>

          <?php if ($der): ?>
            <div class="agency-icons" aria-hidden="true">
              <?php foreach ($der as $ic): ?><i class="ph-light ph-<?= e($ic) ?>"></i><?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <a class="btn btn-gtg" href="<?= e($a['url']) ?>" target="_blank" rel="noopener"><?= e(tr($a['boton'])) ?></a>
      </div>
    </div>
  <?php endforeach; ?>
</section>
