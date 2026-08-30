/* Grandstand Open — page behaviour. Bootstrap handles collapse/nav; this is the rest. */
(function () {
  'use strict';

  /* ---------- Registration: Bootstrap native validation ---------- */
  var form = document.getElementById('registrationForm');
  if (form) {
    form.addEventListener('submit', function (e) {
      if (!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
      form.classList.add('was-validated');
    });
    form.addEventListener('reset', function () {
      form.classList.remove('was-validated');
    });
  }

  /* ---------- Registration: player repeater ---------- */
  var list = document.getElementById('memberList');
  var addBtn = document.getElementById('addMember');
  var MAX = 8;

  function renumber() {
    var rows = list.querySelectorAll('[data-member]');
    rows.forEach(function (row, i) {
      row.querySelector('[data-member-no]').textContent = i + 1;
      // keep members[N][field] indexes contiguous so Laravel receives a clean array
      row.querySelectorAll('[name]').forEach(function (input) {
        input.name = input.name.replace(/members\[\d+\]/, 'members[' + i + ']');
      });
    });
    addBtn.disabled = rows.length >= MAX;
    list.querySelectorAll('[data-remove-member]').forEach(function (btn) {
      btn.hidden = rows.length === 1;
    });
  }

  if (list && addBtn) {
    addBtn.addEventListener('click', function () {
      if (list.querySelectorAll('[data-member]').length >= MAX) return;
      var clone = list.querySelector('[data-member]').cloneNode(true);
      clone.querySelectorAll('input').forEach(function (i) { i.value = ''; });
      clone.querySelectorAll('select').forEach(function (s) { s.selectedIndex = 0; });
      clone.classList.remove('was-validated');
      list.appendChild(clone);
      renumber();
      clone.querySelector('input').focus();
    });

    list.addEventListener('click', function (e) {
      if (!e.target.matches('[data-remove-member]')) return;
      if (list.querySelectorAll('[data-member]').length === 1) return;
      e.target.closest('[data-member]').remove();
      renumber();
    });

    renumber();
  }

  /* ---------- Registration: rules modal, agree gated on reaching the end ---------- */
  var rulesModal = document.getElementById('rulesModal');
  if (rulesModal) {
    var rulesBody = rulesModal.querySelector('[data-rules-body]');
    var agreeBtn = rulesModal.querySelector('[data-rules-agree]');
    var hint = rulesModal.querySelector('[data-rules-hint]');

    function atEnd() {
      // 8px slack: sub-pixel line heights never let scrollTop land exactly on the end
      return rulesBody.scrollTop + rulesBody.clientHeight >= rulesBody.scrollHeight - 8;
    }
    function syncAgree() {
      if (!atEnd()) return;
      agreeBtn.disabled = false;
      hint.textContent = 'You have reached the end';
    }

    rulesBody.addEventListener('scroll', syncAgree);
    rulesModal.addEventListener('shown.bs.modal', function () {
      rulesBody.scrollTop = 0;
      agreeBtn.disabled = true;
      hint.textContent = 'Scroll to the end to continue \u2193';
      rulesBody.focus();
      syncAgree();   // short content, or a tall window: already at the end
    });

    agreeBtn.addEventListener('click', function () {
      var box = document.getElementById('rules');
      box.checked = true;
      box.dispatchEvent(new Event('change', { bubbles: true }));
      bootstrap.Modal.getOrCreateInstance(rulesModal).hide();
    });
  }

  /* ---------- Teams: filter ---------- */
  var grid = document.getElementById('teamGrid');
  if (grid) {
    var count = document.getElementById("teamCount");

    var playerCount = document.getElementById("playerCount");
    var empty = document.getElementById('emptyState');

    document.querySelectorAll('[data-filter]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var key = btn.dataset.filter;
        document.querySelectorAll('[data-filter]').forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');

        var shown = 0;
        grid.querySelectorAll('[data-group]').forEach(function (card) {
          var match = key === 'all' || card.dataset.group.split(' ').indexOf(key) > -1;
          card.hidden = !match;
          if (match) shown++;
        });
        if (count) count.textContent = shown;

        if (playerCount) {

          var players = 0;

          grid.querySelectorAll("[data-group]").forEach(function (card) {

            if (!card.hidden) players += card.querySelectorAll(".member-list li").length;

          });

          playerCount.textContent = players;

        }
        if (empty) empty.hidden = shown > 0;
      });
    });
  }
})();

  /* ---- Draw tabs ----------------------------------------------------------
     One bracket per category; the tabs swap which panel is shown. Separate
     from the teams-page [data-filter] handler, which hides cards inside a
     single grid rather than switching panels. */
  (function () {
    var tabs = document.querySelectorAll('[data-draw]');
    if (!tabs.length) return;

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var key = tab.getAttribute('data-draw');

        tabs.forEach(function (t) { t.classList.remove('is-active'); });
        tab.classList.add('is-active');

        document.querySelectorAll('[data-draw-panel]').forEach(function (panel) {
          panel.hidden = panel.getAttribute('data-draw-panel') !== key;
        });
      });
    });
  })();
