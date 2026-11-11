<?php
/**
 * Departamentos (Lake Apartments) — /departamentos/
 * Textos en content/departamentos.php · Fotos en assets/img/paginas/
 */
require __DIR__ . '/config.php';
$c = contenido('departamentos');

$page_slug        = 'departamentos';
$page_description = $c['meta'];
$hero = ['imagen' => 'paginas/departamentos-hero.webp', 'etiqueta' => $c['etiqueta'], 'titulo' => $c['titulo'], 'bajada' => $c['bajada']];

$fotos    = ['paginas/depto-01.webp', 'paginas/depto-02.webp', 'paginas/depto-03.webp', 'paginas/depto-04.webp'];
$web_url  = 'https://www.lakeapartments.com.ar';
$wa_url   = wa_link($c['wa'], WHATSAPP_DEPTOS);
$mapa_src = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d92195.43411760016!2d-71.41756969588981!3d-41.08832176077367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x961a7a6e618f721f%3A0x99d1403da9e54d28!2sA%20Orillas%20del%20Lago!5e0!3m2!1ses-419!2sar!4v1723631765687!5m2!1ses-419!2sar';

include ROOT . '/includes/page-start.php';
?>
<section class="section">
  <div class="container">
    <?php foreach ($c['filas'] as $i => $f): $par = $i % 2 === 1; ?>
      <div class="row g-4 g-lg-5 align-items-center feature-row">
        <div class="col-lg-5<?= $par ? ' order-lg-2' : '' ?>" data-aos="fade-up">
          <div class="feature-media feature-media--tall">
            <img src="<?= e(img($fotos[$i])) ?>" <?= img_dims($fotos[$i]) ?> alt="<?= e($f['titulo']) ?>" loading="lazy">
          </div>
        </div>
        <div class="col-lg-6<?= $par ? ' order-lg-1 offset-lg-1' : ' offset-lg-1' ?>" data-aos="fade-up" data-aos-delay="120">
          <span class="eyebrow"><?= e($c['etiqueta']) ?></span>
          <h2 class="section-title"><?= e($f['titulo']) ?></h2>
          <div class="prose">
            <?php foreach ($f['texto'] as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
          </div>
          <div class="feature-actions">
            <a href="<?= e($web_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg"><?= e($c['btn_web']) ?></a>
            <a href="<?= e($wa_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg-outline"><i class="ph-light ph-whatsapp-logo me-2" aria-hidden="true"></i><?= e(t('btn_whatsapp')) ?></a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="cta-band">
  <div class="parallax" data-parallax="1" aria-hidden="true">
    <img class="parallax-img" src="<?= e(img('paginas/departamentos-hero.webp')) ?>" <?= img_dims('paginas/departamentos-hero.webp') ?> alt="" loading="lazy">
  </div>
  <div class="cta-band-overlay"></div>
  <div class="container" data-aos="fade-up">
    <h2 class="section-title"><?= e($c['cta_titulo']) ?></h2>
    <p><?= e($c['cta_texto']) ?></p>
    <div class="feature-actions">
      <a href="<?= e($wa_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg"><i class="ph-light ph-whatsapp-logo me-2" aria-hidden="true"></i><?= e(t('btn_whatsapp')) ?></a>
      <a href="<?= e($web_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg-light"><?= e($c['btn_web']) ?></a>
    </div>
  </div>
</section>

<iframe class="map-frame" src="<?= e($mapa_src) ?>" title="<?= e($c['mapa']) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>

<?php include ROOT . '/includes/page-end.php'; ?>
