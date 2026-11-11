<?php
/**
 * Destacados — filas foto (o galería) + texto, alternadas. Ej.: Hotel Suiça Iguaçu y Foz Experience en el .com.br.
 * Datos: data/destacados.php del sitio. Cada fila:
 *   'id'       => ancla opcional
 *   'etiqueta', 'titulo'  => texto (traducible: 'x' ó ['es'=>..,'en'=>..,'pt'=>..])
 *   'texto'    => párrafos (array, traducible)
 *   'lista'    => opcional: ítems con check (array, traducible)
 *   'imagenes' => 1 imagen o varias (galería con fundido)
 *   'botones'  => [['texto' => .., 'url' => .., 'estilo' => 'gtg'|'outline', 'icono' => 'whatsapp-logo']]
 *                 'url' => 'reservar' usa el botón Reservar del sitio (motor o WhatsApp)
 */
// 'activo' => false oculta una fila sin borrarla
$destacados = array_values(array_filter(require ROOT . '/data/destacados.php', function ($d) { return !isset($d['activo']) || $d['activo']; }));
?>
<section class="section section--white highlights" id="destacados">
  <div class="container">
    <?php foreach ($destacados as $i => $d): $par = $i % 2 === 1; ?>
      <div class="row g-4 g-lg-5 align-items-center feature-row"<?= !empty($d['id']) ? ' id="' . e($d['id']) . '"' : '' ?>>
        <div class="col-lg-6<?= $par ? ' order-lg-2' : '' ?>" data-aos="fade-up">
          <?php if (count($d['imagenes']) > 1): ?>
            <div class="feature-media feature-media--wide swiper js-feature-swiper">
              <div class="swiper-wrapper">
                <?php foreach ($d['imagenes'] as $k => $im): ?>
                  <div class="swiper-slide"><img src="<?= e(img($im)) ?>" <?= img_dims($im) ?> alt="<?= $k === 0 ? e(tr($d['titulo'])) : '' ?>" loading="lazy"></div>
                <?php endforeach; ?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          <?php else: ?>
            <div class="feature-media feature-media--wide">
              <img src="<?= e(img($d['imagenes'][0])) ?>" <?= img_dims($d['imagenes'][0]) ?> alt="<?= e(tr($d['titulo'])) ?>" loading="lazy">
            </div>
          <?php endif; ?>
        </div>

        <div class="col-lg-5<?= $par ? ' order-lg-1' : ' offset-lg-1' ?>" data-aos="fade-up" data-aos-delay="120">
          <?php if (!empty($d['etiqueta'])): ?><span class="eyebrow"><?= e(tr($d['etiqueta'])) ?></span><?php endif; ?>
          <h2 class="section-title"><?= e(tr($d['titulo'])) ?></h2>
          <div class="prose">
            <?php foreach (tr($d['texto']) as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
          </div>
          <?php if (!empty($d['lista'])): ?>
            <ul class="highlight-list">
              <?php foreach (tr($d['lista']) as $li): ?>
                <li><i class="ph-light ph-check" aria-hidden="true"></i><span><?= e($li) ?></span></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
          <?php if (!empty($d['botones'])): ?>
            <div class="feature-actions">
              <?php foreach ($d['botones'] as $b):
                $b_url  = $b['url'] === 'reservar' ? reservar_url() : $b['url'];
                $b_ext  = es_externa($b_url); ?>
                <a href="<?= e($b_url) ?>"<?= $b_ext ? ' target="_blank" rel="noopener"' : '' ?> class="btn <?= !empty($b['estilo']) && $b['estilo'] === 'outline' ? 'btn-gtg-outline' : 'btn-gtg' ?>">
                  <?php if (!empty($b['icono'])): ?><i class="ph-light ph-<?= e($b['icono']) ?> me-2" aria-hidden="true"></i><?php endif; ?><?= e(tr($b['texto'])) ?>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
