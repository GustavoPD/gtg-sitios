/* flatpickr — locale Português (equivalente a flatpickr/dist/l10n/pt.js) */
(function () {
  if (typeof window === 'undefined' || !window.flatpickr) return;
  var Portuguese = {
    weekdays: {
      shorthand: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
      longhand: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado']
    },
    months: {
      shorthand: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      longhand: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
    },
    rangeSeparator: ' até ',
    time_24hr: true
  };
  window.flatpickr.l10ns.pt = Portuguese;
})();
