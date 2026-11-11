/**
 * Grupo Tierra Gaucha — JS principal
 * Header · AOS · Swipers · Filtro de hoteles · Buscador (Flatpickr) · Contadores · Popup promo · GLightbox
 */
(function () {
  'use strict';

  var $  = function (sel, ctx) { return (ctx || document).querySelector(sel); };
  var $$ = function (sel, ctx) { return Array.prototype.slice.call((ctx || document).querySelectorAll(sel)); };
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ----------------------------------------------------------------------
   * Header: transparente -> sólido al hacer scroll
   * -------------------------------------------------------------------- */
  var header = $('#siteHeader');
  var topbar = $('#topbar');
  var scrollTopBtn = $('#scrollTop');

  function onScrollHeader() {
    var y = window.scrollY;
    if (header) {
      header.classList.toggle('is-scrolled', y > 60);
      // El header acompaña a la banda superior mientras se va con el scroll
      var tb = topbar ? topbar.offsetHeight : 0;
      header.style.top = Math.max(0, tb - y) + 'px';
    }
    if (scrollTopBtn) scrollTopBtn.classList.toggle('is-visible', y > 500);
  }
  onScrollHeader();
  window.addEventListener('scroll', onScrollHeader, { passive: true });
  window.addEventListener('resize', onScrollHeader, { passive: true });

  if (scrollTopBtn) {
    scrollTopBtn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
    });
  }

  /* ----------------------------------------------------------------------
   * Offcanvas: cerrar al tocar un link y luego navegar al ancla
   * -------------------------------------------------------------------- */
  var offcanvasEl = $('#offcanvasMenu');
  if (offcanvasEl && window.bootstrap) {
    $$('[data-close-offcanvas]', offcanvasEl).forEach(function (link) {
      link.addEventListener('click', function (e) {
        // Solo anclas de esta misma página (ej. /2026/#hoteles estando en la home); el resto navega normal
        var u = new URL(link.href, location.href);
        if (u.pathname !== location.pathname || !u.hash) return;
        if (link.hasAttribute('data-reservar') && !$('#reservar')) return;
        var href = u.hash;
        e.preventDefault();
        var instance = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
        offcanvasEl.addEventListener('hidden.bs.offcanvas', function handler() {
          offcanvasEl.removeEventListener('hidden.bs.offcanvas', handler);
          if (link.hasAttribute('data-reservar')) { goToBooking(link.getAttribute('data-reservar')); return; }
          var target = href.length > 1 ? document.querySelector(href) : null;
          if (target) target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth' });
        });
        instance.hide();
      });
    });
  }

  /* ----------------------------------------------------------------------
   * Swipers
   * -------------------------------------------------------------------- */
  if (window.Swiper) {

    // Hero
    if ($('.hero-swiper')) {
      new Swiper('.hero-swiper', {
        effect: 'fade',
        fadeEffect: { crossFade: true },
        loop: true,
        speed: 1400,
        autoplay: reduceMotion ? false : { delay: 6000, disableOnInteraction: false },
        pagination: { el: '.hero-pagination', clickable: true }
      });
    }

    // Franja de marcas (marquee continuo)
    if ($('.brands-swiper')) {
      new Swiper('.brands-swiper', {
        slidesPerView: 'auto',
        loop: true,
        speed: 5000,
        allowTouchMove: false,
        autoplay: reduceMotion ? false : { delay: 0, disableOnInteraction: false }
      });
    }

    // Hoteles (con filtro por tabs)
    var hotelsEl = $('.hotels-swiper');
    if (hotelsEl) {
      // Guardamos todos los slides originales para poder filtrar
      var allHotelSlides = $$('.swiper-slide', hotelsEl).map(function (s) { return s.outerHTML; });
      var allHotelFilters = $$('.swiper-slide', hotelsEl).map(function (s) { return s.getAttribute('data-filtro'); });

      var hotelsSwiper = new Swiper(hotelsEl, {
        slidesPerView: 1.15,
        spaceBetween: 16,
        watchOverflow: true,
        navigation: { prevEl: '.hotels-prev', nextEl: '.hotels-next' },
        pagination: { el: '.hotels-pagination', clickable: true },
        // v1: hasta 6 cards verticales (contenedor ancho) · v2: hasta 4 cards horizontales
        breakpoints: hotelsEl.getAttribute('data-version') === 'v1' ? {
          576:  { slidesPerView: 2,   spaceBetween: 20 },
          992:  { slidesPerView: 3,   spaceBetween: 24 },
          1200: { slidesPerView: 4,   spaceBetween: 24 },
          1400: { slidesPerView: 5,   spaceBetween: 20 },
          1600: { slidesPerView: 6,   spaceBetween: 20 }
        } : {
          576:  { slidesPerView: 2,   spaceBetween: 20 },
          992:  { slidesPerView: 3,   spaceBetween: 24 },
          1200: { slidesPerView: 4,   spaceBetween: 24 }
        }
      });

      $$('.filter-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
          var filter = tab.getAttribute('data-filter');
          $$('.filter-tab').forEach(function (t) {
            t.classList.toggle('active', t === tab);
            t.setAttribute('aria-selected', t === tab ? 'true' : 'false');
          });
          var slides = allHotelSlides.filter(function (html, i) {
            return !filter || allHotelFilters[i] === filter;
          });
          hotelsSwiper.removeAllSlides();
          hotelsSwiper.appendSlide(slides);
          hotelsSwiper.update();
          hotelsSwiper.slideTo(0, 0);
          if (window.AOS) AOS.refresh();
        });
      });
    }

    // Promociones
    if ($('.promos-swiper')) {
      // Columnas según cantidad de promos: 2 promos = 2 columnas (col-6), 3 o más = 3 columnas (col-4)
      var promosN = parseInt($('.promos-swiper').getAttribute('data-count'), 10) || 3;
      new Swiper('.promos-swiper', {
        slidesPerView: 1.1,
        spaceBetween: 16,
        watchOverflow: true,
        navigation: { prevEl: '.promos-prev', nextEl: '.promos-next' },
        pagination: { el: '.promos-pagination', clickable: true },
        breakpoints: {
          768:  { slidesPerView: Math.min(2, promosN), spaceBetween: 24 },
          1200: { slidesPerView: Math.min(3, promosN), spaceBetween: 30 }
        }
      });
    }

    // Galería (mobile)
    if ($('.gallery-swiper')) {
      new Swiper('.gallery-swiper', {
        slidesPerView: 1.2,
        spaceBetween: 12,
        pagination: { el: '.gallery-pagination', clickable: true }
      });
    }

    // Destacados (galería de fotos dentro de una fila imagen + texto)
    $$('.js-feature-swiper').forEach(function (el) {
      new Swiper(el, {
        effect: 'fade',
        fadeEffect: { crossFade: true },
        loop: true,
        speed: 900,
        autoplay: reduceMotion ? false : { delay: 4500, disableOnInteraction: false },
        pagination: { el: el.querySelector('.swiper-pagination'), clickable: true }
      });
    });
  }

  /* ----------------------------------------------------------------------
   * AOS — se inicia DESPUÉS de los Swipers: antes de inicializarse, los
   * sliders apilan sus slides y AOS calcularía mal la posición de todo lo
   * que está debajo.
   * -------------------------------------------------------------------- */
  if (window.AOS) {
    AOS.init({ once: true, duration: 800, offset: 80, disable: reduceMotion });
    window.addEventListener('load', function () { AOS.refresh(); });
  }

  /* ----------------------------------------------------------------------
   * GLightbox
   * -------------------------------------------------------------------- */
  if (window.GLightbox && $('.glightbox')) {
    GLightbox({ selector: '.glightbox', touchNavigation: true, loop: true });
  }

  /* ----------------------------------------------------------------------
   * Buscador: Flatpickr (rango check-in / check-out) + envío
   * -------------------------------------------------------------------- */
  var form = $('#bookingForm');
  var fp = null;

  if (form && window.flatpickr) {
    var plugins = window.rangePlugin ? [new rangePlugin({ input: '#bkCheckout' })] : [];
    fp = flatpickr('#bkCheckin', {
      locale: (function () {
        var lang = document.documentElement.lang || 'es';
        return (flatpickr.l10ns && flatpickr.l10ns[lang]) ? flatpickr.l10ns[lang] : 'default';
      })(),
      dateFormat: 'd/m/Y',
      minDate: 'today',
      showMonths: window.innerWidth >= 768 ? 2 : 1,
      disableMobile: true,
      plugins: plugins
    });
  }

  function pad(n) { return (n < 10 ? '0' : '') + n; }
  function motorDate(d) { return pad(d.getDate()) + '-' + pad(d.getMonth() + 1) + '-' + d.getFullYear(); }   // dd-mm-aaaa

  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var dates = fp ? fp.selectedDates : [];

      // Sitio sin motor (data-wa): la consulta se arma como mensaje de WhatsApp (fechas opcionales)
      var wa = form.getAttribute('data-wa');
      if (wa) {
        var sinFecha = form.getAttribute('data-sin-fecha') || '';
        var fecha = function (d) { return d ? pad(d.getDate()) + '/' + pad(d.getMonth() + 1) + '/' + d.getFullYear() : sinFecha; };
        var label = function (id) { var l = form.querySelector('label[for="' + id + '"]'); return l ? l.textContent.trim() : ''; };
        var hSel = $('#bkHotel');
        var lineas = [
          form.getAttribute('data-wa-intro') || '',
          label('bkHotel') + ': ' + hSel.options[hSel.selectedIndex].text,
          label('bkCheckin') + ': ' + fecha(dates[0]),
          label('bkCheckout') + ': ' + fecha(dates[1]),
          label('bkAdultos') + ': ' + $('#bkAdultos').value,
          label('bkMenores') + ': ' + $('#bkMenores').value
        ];
        window.open(wa + '?text=' + encodeURIComponent(lineas.join('\n')), '_blank', 'noopener');
        return;
      }

      // Sin las dos fechas, abrimos el calendario en lugar de enviar
      if (dates.length < 2) {
        if (fp) fp.open();
        return;
      }

      // Motor de reservas: el option elegido trae la URL base (portal del Grupo o motor del hotel con su idHotel)
      var hotelSel = $('#bkHotel');
      var opt  = hotelSel.options[hotelSel.selectedIndex];
      var base = opt.getAttribute('data-motor') || form.getAttribute('action');
      var params = [
        'fechaDesde=' + motorDate(dates[0]),
        'fechaHasta=' + motorDate(dates[1]),
        'adultos=' + encodeURIComponent($('#bkAdultos').value),
        'ninios=' + encodeURIComponent($('#bkMenores').value),
        'button='
      ].join('&');
      window.open(base + (base.indexOf('?') > -1 ? '&' : '?') + params, '_blank', 'noopener');
    });
  }

  /* ----------------------------------------------------------------------
   * Botones "Reservar" (header, tarjetas): llevan al buscador
   * con el hotel preseleccionado y abren el calendario
   * -------------------------------------------------------------------- */
  function goToBooking(slug) {
    var target = $('#reservar');
    if (!target) return;
    var hotelSel = $('#bkHotel');
    if (hotelSel && slug) hotelSel.value = slug;

    var headerH = header ? header.offsetHeight : 0;
    var top = target.getBoundingClientRect().top + window.scrollY - headerH - 24;
    window.scrollTo({ top: Math.max(0, top), behavior: reduceMotion ? 'auto' : 'smooth' });

    if (fp) setTimeout(function () { fp.open(); }, reduceMotion ? 50 : 700);
  }

  document.addEventListener('click', function (e) {
    var btn = e.target.closest('[data-reservar]');
    if (!btn || btn.hasAttribute('data-close-offcanvas')) return;
    if (!$('#reservar')) return;   // páginas internas: el link lleva a la home (#reservar)
    e.preventDefault();
    goToBooking(btn.getAttribute('data-reservar'));
  });

  // Llegando desde otra página con "Reservar" (home#reservar): abrir el buscador
  if (location.hash === '#reservar' && $('#reservar')) {
    window.addEventListener('load', function () { setTimeout(function () { goToBooking(''); }, 300); });
  }

  /* ----------------------------------------------------------------------
   * Contadores animados
   * -------------------------------------------------------------------- */
  var counters = $$('.js-counter');
  if (counters.length) {
    var animate = function (el) {
      var target = parseInt(el.getAttribute('data-target'), 10) || 0;
      if (reduceMotion) { el.textContent = target; return; }
      var duration = 1800;
      var start = null;
      var step = function (ts) {
        if (!start) start = ts;
        var p = Math.min((ts - start) / duration, 1);
        var eased = 1 - Math.pow(1 - p, 3); // easeOutCubic
        el.textContent = Math.round(target * eased);
        if (p < 1) window.requestAnimationFrame(step);
      };
      window.requestAnimationFrame(step);
    };

    if ('IntersectionObserver' in window) {
      var cio = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            animate(entry.target);
            cio.unobserve(entry.target);
          }
        });
      }, { threshold: 0.5 });
      counters.forEach(function (c) { cio.observe(c); });
    } else {
      counters.forEach(function (c) { c.textContent = c.getAttribute('data-target'); });
    }
  }

  /* ----------------------------------------------------------------------
   * Popup de promoción (una vez por sesión)
   * -------------------------------------------------------------------- */
  var promoModalEl = $('#promoModal');
  if (promoModalEl && window.bootstrap) {
    var key = 'gtg_promo_' + promoModalEl.getAttribute('data-promo');
    var seen = false;
    try { seen = sessionStorage.getItem(key) === '1'; } catch (err) { /* storage bloqueado */ }

    if (!seen) {
      setTimeout(function () {
        bootstrap.Modal.getOrCreateInstance(promoModalEl).show();
        try { sessionStorage.setItem(key, '1'); } catch (err) { /* storage bloqueado */ }
      }, 2500);
    }
  }
})();
