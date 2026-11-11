<?php
/**
 * Hotel Management — /hotelmanagement/
 * Textos en content/hotelmanagement.php
 * Formulario: igual que el sitio anterior (reCAPTCHA v2 + mail() con el link al folleto al propietario
 * y copia a EMAIL_HM), con validación, campo trampa anti-spam y protección contra inyección de cabeceras.
 */
require __DIR__ . '/config.php';
$c = contenido('hotelmanagement');

$brochure_url = rtrim(SITE_URL, '/') . BASE . 'assets/docs/brochure-gtg-hotel-management.pdf';
$campos = ['nombre', 'apellido', 'nombre_hotel', 'telefono', 'email', 'pais'];
$datos  = array_fill_keys($campos, '');
$form_estado = isset($_GET['enviado']) ? 'ok' : null;
$form_error  = '';

/** Verifica la respuesta de reCAPTCHA v2 contra Google. */
function hm_recaptcha_ok($respuesta)
{
  if ($respuesta === '') return false;
  $post = http_build_query(['secret' => RECAPTCHA_SECRET, 'response' => $respuesta, 'remoteip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '']);
  $json = false;
  if (function_exists('curl_init')) {
    $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
    curl_setopt_array($ch, [CURLOPT_POST => true, CURLOPT_POSTFIELDS => $post, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 10]);
    $json = curl_exec($ch);
    curl_close($ch);
  } else {
    $ctx  = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-Type: application/x-www-form-urlencoded', 'content' => $post, 'timeout' => 10]]);
    $json = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $ctx);
  }
  $r = $json ? json_decode($json, true) : null;
  return !empty($r['success']);
}

/** Quita saltos de línea (evita inyección de cabeceras en el mail). */
function hm_limpio($v)
{
  return trim(str_replace(["\r", "\n", "%0a", "%0d"], ' ', (string) $v));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hm_form'])) {
  foreach ($campos as $k) {
    $datos[$k] = mb_substr(hm_limpio(isset($_POST[$k]) ? $_POST[$k] : ''), 0, 150);
  }
  $trampa = isset($_POST['website']) ? trim($_POST['website']) : '';
  $completo = !in_array('', $datos, true) && filter_var($datos['email'], FILTER_VALIDATE_EMAIL);

  if ($trampa !== '') {
    $form_estado = 'ok';   // bot: se responde "ok" sin enviar nada
  } elseif (!$completo) {
    $form_estado = 'error';
    $form_error  = t('form_obligatorios');
  } elseif (!hm_recaptcha_ok(isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '')) {
    $form_estado = 'error';
    $form_error  = t('form_error_captcha');
  } else {
    $h = array_map(function ($v) { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }, $datos);
    $cuerpo  = '<!doctype html><html><head><meta charset="utf-8"></head><body style="font-family:Arial,sans-serif;font-size:14px;color:#262828">';
    $cuerpo .= '<p>' . sprintf(htmlspecialchars($c['mail_hola'], ENT_QUOTES, 'UTF-8'), $h['nombre']) . '</p>';
    $cuerpo .= '<p>' . htmlspecialchars($c['mail_texto'], ENT_QUOTES, 'UTF-8') . '</p>';
    $cuerpo .= '<p><a href="' . htmlspecialchars($brochure_url, ENT_QUOTES, 'UTF-8') . '" style="display:inline-block;padding:12px 22px;background:#c2ab86;color:#fff;text-decoration:none;border-radius:5px">' . htmlspecialchars($c['brochure'], ENT_QUOTES, 'UTF-8') . '</a></p>';
    $cuerpo .= '<p><strong>' . htmlspecialchars($c['mail_datos'], ENT_QUOTES, 'UTF-8') . '</strong><br>';
    $cuerpo .= htmlspecialchars(t('form_nombre') . ' / ' . t('form_apellido'), ENT_QUOTES, 'UTF-8') . ': ' . $h['nombre'] . ' ' . $h['apellido'] . '<br>';
    $cuerpo .= htmlspecialchars(t('form_telefono'), ENT_QUOTES, 'UTF-8') . ': ' . $h['telefono'] . '<br>';
    $cuerpo .= htmlspecialchars(t('form_pais'), ENT_QUOTES, 'UTF-8') . ': ' . $h['pais'] . '<br>';
    $cuerpo .= htmlspecialchars(t('form_hotel'), ENT_QUOTES, 'UTF-8') . ': ' . $h['nombre_hotel'] . '<br>';
    $cuerpo .= htmlspecialchars(t('form_email'), ENT_QUOTES, 'UTF-8') . ': ' . $h['email'] . '</p>';
    $cuerpo .= '<p>Grupo Tierra Gaucha — Hotel Management</p></body></html>';

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= 'From: Grupo Tierra Gaucha <' . EMAIL_HM . ">\r\n";
    $headers .= 'Cc: ' . EMAIL_HM . "\r\n";
    $headers .= 'Reply-To: ' . EMAIL_HM . "\r\n";
    $asunto   = '=?UTF-8?B?' . base64_encode($c['mail_asunto']) . '?=';

    if (@mail($datos['email'], $asunto, $cuerpo, $headers)) {
      header('Location: ' . url('hotelmanagement') . '?enviado=1#hablemos', true, 303);
      exit;
    }
    $form_estado = 'error';
    $form_error  = t('form_error');
  }
}

$page_slug        = 'hotelmanagement';
$page_description = $c['meta'];
$page_scripts     = ['https://www.google.com/recaptcha/api.js?hl=' . (LANG === 'pt' ? 'pt-BR' : LANG)];
$hero = ['imagen' => 'paginas/hm-hero.webp', 'etiqueta' => $c['etiqueta'], 'titulo' => $c['titulo']];

$wa_url   = wa_link($c['wa'], WHATSAPP_HM);
$iconos_cards    = ['ph-chart-line-up', 'ph-handshake', 'ph-stack'];
$iconos_features = ['ph-medal', 'ph-globe-hemisphere-west', 'ph-coins', 'ph-map-pin', 'ph-device-mobile', 'ph-briefcase'];

/** Párrafo con **negritas**. */
function hm_parrafo($t)
{
  return preg_replace('/\*\*(.+?)\*\*/u', '<strong>$1</strong>', e($t));
}

include ROOT . '/includes/page-start.php';
?>
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 text-center" data-aos="fade-up">
        <span class="eyebrow"><?= e($c['intro_etiqueta']) ?></span>
        <h2 class="section-title"><?= e($c['intro_titulo']) ?></h2>
      </div>
      <div class="col-lg-9" data-aos="fade-up">
        <div class="prose">
          <?php foreach ($c['intro'] as $p): ?><p><?= hm_parrafo($p) ?></p><?php endforeach; ?>
        </div>
      </div>
    </div>
    <ul class="stats mt-5" data-aos="fade-up">
      <?php foreach ($c['stats'] as $s): ?>
        <li><span class="stats-value"><?= e($s[0]) ?></span><span class="stats-label"><?= e($s[1]) ?></span></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section section--cream">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($c['cards'] as $i => $card): ?>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
          <div class="info-card">
            <i class="ph-light <?= e($iconos_cards[$i]) ?> info-card-icon" aria-hidden="true"></i>
            <span class="eyebrow"><?= e($card['etiqueta']) ?></span>
            <h3 class="info-card-title"><?= e($card['titulo']) ?></h3>
            <p><?= e($card['texto']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6" data-aos="fade-up">
        <a href="<?= e(img('paginas/hm-planes.webp')) ?>" class="glightbox feature-media d-block">
          <img src="<?= e(img('paginas/hm-planes.webp')) ?>" <?= img_dims('paginas/hm-planes.webp') ?> alt="<?= e($c['planes_alt']) ?>" loading="lazy">
        </a>
      </div>
      <div class="col-lg-5 offset-lg-1" data-aos="fade-up" data-aos-delay="120">
        <span class="eyebrow"><?= e($c['planes_etiqueta']) ?></span>
        <h2 class="section-title"><?= e($c['planes_titulo']) ?></h2>
        <ul class="icon-grid icon-grid--2">
          <?php foreach ($c['features'] as $i => $f): ?>
            <li><i class="ph-light <?= e($iconos_features[$i]) ?>" aria-hidden="true"></i><?= e($f) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="section section--cream" id="hablemos">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5" data-aos="fade-up">
        <span class="eyebrow"><?= e($c['form_etiqueta']) ?></span>
        <h2 class="section-title"><?= e($c['form_titulo']) ?></h2>
        <p class="prose"><?= e($c['form_texto']) ?></p>
        <div class="feature-actions">
          <a href="<?= e($wa_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg-outline"><i class="ph-light ph-whatsapp-logo me-2" aria-hidden="true"></i><?= e(t('btn_whatsapp')) ?></a>
          <a href="mailto:<?= e(EMAIL_HM) ?>" class="btn btn-gtg-outline"><i class="ph-light ph-envelope-simple me-2" aria-hidden="true"></i><?= e(t('btn_email')) ?></a>
        </div>
      </div>
      <div class="col-lg-7" data-aos="fade-up" data-aos-delay="120">
        <div class="form-card">
          <?php if ($form_estado === 'ok'): ?>
            <div class="form-alert form-alert--ok" role="status"><i class="ph-light ph-check-circle" aria-hidden="true"></i><span><?= e(t('form_ok')) ?></span></div>
            <a href="<?= e($brochure_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg"><i class="ph-light ph-file-pdf me-2" aria-hidden="true"></i><?= e($c['brochure']) ?></a>
          <?php else: ?>
            <?php if ($form_estado === 'error'): ?>
              <div class="form-alert form-alert--error" role="alert"><i class="ph-light ph-warning-circle" aria-hidden="true"></i><span><?= e($form_error) ?></span></div>
            <?php endif; ?>
            <form class="gtg-form" method="post" action="<?= e(url('hotelmanagement')) ?>#hablemos">
              <input type="hidden" name="hm_form" value="1">
              <div class="hp-field" aria-hidden="true">
                <label for="hmWebsite">Website</label>
                <input type="text" id="hmWebsite" name="website" tabindex="-1" autocomplete="off">
              </div>
              <div class="row g-3">
                <div class="col-sm-6">
                  <label class="form-label" for="hmNombre"><?= e(t('form_nombre')) ?></label>
                  <input class="form-control" type="text" id="hmNombre" name="nombre" value="<?= e($datos['nombre']) ?>" required autocomplete="given-name" maxlength="150">
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="hmApellido"><?= e(t('form_apellido')) ?></label>
                  <input class="form-control" type="text" id="hmApellido" name="apellido" value="<?= e($datos['apellido']) ?>" required autocomplete="family-name" maxlength="150">
                </div>
                <div class="col-12">
                  <label class="form-label" for="hmHotel"><?= e(t('form_hotel')) ?></label>
                  <input class="form-control" type="text" id="hmHotel" name="nombre_hotel" value="<?= e($datos['nombre_hotel']) ?>" required autocomplete="organization" maxlength="150">
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="hmTel"><?= e(t('form_telefono')) ?></label>
                  <input class="form-control" type="tel" id="hmTel" name="telefono" value="<?= e($datos['telefono']) ?>" required autocomplete="tel" maxlength="150">
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="hmEmail"><?= e(t('form_email')) ?></label>
                  <input class="form-control" type="email" id="hmEmail" name="email" value="<?= e($datos['email']) ?>" required autocomplete="email" maxlength="150">
                </div>
                <div class="col-12">
                  <label class="form-label" for="hmPais"><?= e(t('form_pais')) ?></label>
                  <input class="form-control" type="text" id="hmPais" name="pais" value="<?= e($datos['pais']) ?>" required autocomplete="country-name" maxlength="150">
                </div>
                <div class="col-12">
                  <div class="g-recaptcha" data-sitekey="<?= e(RECAPTCHA_SITE) ?>"></div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-gtg w-100"><?= e(t('form_enviar')) ?></button>
                </div>
              </div>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include ROOT . '/includes/page-end.php'; ?>
