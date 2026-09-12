/* Jaya Tennis Championship — 2026 theme.
 *
 * Three behaviours, no dependencies: the mobile nav, tab strips, and the
 * schedule's category filter. Everything works on data already in the page —
 * this is a slice, so every row ships and is hidden client-side.
 *
 * Controls come in two kinds, told apart by whether the value has a colon:
 *
 *   data-jtc-tabs="year"          switch panes — show the one pane whose
 *                                 data-value matches, hide its siblings
 *   data-jtc-tabs="match:day"     filter rows — narrow [data-jtc-row="match"]
 *   data-jtc-filter="match:category"   by its data-day / data-category
 *
 * Row filters combine. Several controls can point at the same scope and a row
 * has to satisfy all of them, so picking Day 1 and then Men's Doubles leaves
 * the ties that are both, rather than the second control discarding the first.
 */
(function () {
  'use strict';

  var root = document.querySelector('.jtc');
  if (!root) return;

  /* -- Mobile navigation ------------------------------------------------- */
  var burger = root.querySelector('[data-jtc-burger]');
  var nav = root.querySelector('[data-jtc-nav]');

  if (burger && nav) {
    burger.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  /* -- Row filters ------------------------------------------------------- *
   * One entry per scope, holding the current value of every criterion aimed
   * at it. Re-evaluated in full on each change, so the controls compose.
   */
  var filters = {};

  function setFilter(scope, key, value) {
    var state = filters[scope] || (filters[scope] = {});
    state[key] = value;

    root.querySelectorAll('[data-jtc-row="' + scope + '"]').forEach(function (row) {
      row.hidden = !Object.keys(state).every(function (k) {
        return state[k] === 'all' || row.getAttribute('data-' + k) === state[k];
      });
    });
  }

  /* -- Panes ------------------------------------------------------------- */
  function setPane(name, value) {
    root.querySelectorAll('[data-jtc-pane="' + name + '"]').forEach(function (pane) {
      pane.hidden = !(value === 'all' || pane.getAttribute('data-value') === value);
    });
  }

  /* -- Tab strips -------------------------------------------------------- */
  root.querySelectorAll('[data-jtc-tabs]').forEach(function (strip) {
    var target = strip.getAttribute('data-jtc-tabs').split(':');

    strip.addEventListener('click', function (event) {
      var tab = event.target.closest('[data-value]');
      if (!tab || !strip.contains(tab)) return;

      strip.querySelectorAll('[data-value]').forEach(function (t) {
        var active = t === tab;
        t.classList.toggle('is-active', active);
        t.setAttribute('aria-selected', active ? 'true' : 'false');
      });

      if (target.length > 1) {
        setFilter(target[0], target[1], tab.getAttribute('data-value'));
      } else {
        setPane(target[0], tab.getAttribute('data-value'));
      }
    });
  });

  /* -- Select filters ---------------------------------------------------- */
  root.querySelectorAll('[data-jtc-filter]').forEach(function (select) {
    var target = select.getAttribute('data-jtc-filter').split(':');

    select.addEventListener('change', function () {
      setFilter(target[0], target[1], select.value);
    });
  });
})();
