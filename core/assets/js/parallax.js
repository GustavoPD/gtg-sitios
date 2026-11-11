/**
 * Parallax propio — Grupo Tierra Gaucha
 *
 * Uso:
 *   <div class="parallax" data-parallax="1">          ← contenedor (position:absolute; overflow:hidden)
 *     <img class="parallax-img" src="..." alt="">     ← imagen 130% de alto (ver style.css §15)
 *   </div>
 *
 * data-parallax = intensidad de 0 a 1 (1 = usa todo el margen disponible, ±15% del alto).
 * IntersectionObserver para procesar solo lo visible + requestAnimationFrame + translate3d.
 * No usa background-attachment: fixed (no funciona en iOS).
 * Se desactiva con prefers-reduced-motion.
 */
(function () {
  'use strict';

  var els = Array.prototype.slice.call(document.querySelectorAll('[data-parallax]'));
  if (!els.length || !('IntersectionObserver' in window)) return;

  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)');
  if (reduce.matches) return;

  var visible = new Set();
  var ticking = false;
  var ROOM = 0.15; // la imagen sobresale 15% arriba y abajo

  function update() {
    ticking = false;
    var vh = window.innerHeight;

    visible.forEach(function (el) {
      var img = el.querySelector('.parallax-img');
      if (!img) return;

      var r = el.getBoundingClientRect();
      // progreso: +1 cuando el elemento entra por abajo, -1 cuando sale por arriba
      var progress = (r.top + r.height / 2 - vh / 2) / (vh / 2 + r.height / 2);
      progress = Math.max(-1, Math.min(1, progress));

      var strength = parseFloat(el.getAttribute('data-parallax'));
      if (isNaN(strength)) strength = 1;

      var y = -progress * r.height * ROOM * strength;
      img.style.transform = 'translate3d(0,' + y.toFixed(1) + 'px,0)';
    });
  }

  function requestTick() {
    if (!ticking) {
      ticking = true;
      window.requestAnimationFrame(update);
    }
  }

  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) visible.add(entry.target);
      else visible.delete(entry.target);
    });
    requestTick();
  }, { rootMargin: '100px 0px' });

  els.forEach(function (el) { io.observe(el); });

  window.addEventListener('scroll', requestTick, { passive: true });
  window.addEventListener('resize', requestTick, { passive: true });

  // Si el usuario activa "reducir movimiento" en vivo, se apaga
  if (reduce.addEventListener) {
    reduce.addEventListener('change', function (e) {
      if (!e.matches) return;
      window.removeEventListener('scroll', requestTick);
      window.removeEventListener('resize', requestTick);
      io.disconnect();
      els.forEach(function (el) {
        var img = el.querySelector('.parallax-img');
        if (img) img.style.transform = '';
      });
    });
  }
})();
