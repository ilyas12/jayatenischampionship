{{--
    Stand-in for a squad portrait: a tennis player mid-serve rather than a
    generic profile bust, so an unphotographed player still reads as a player.

    Inline SVG, single colour, no external request. Sized by whichever
    container it sits in — the squad card's portrait or the list's small disc.
--}}
<svg class="tennis-silhouette" viewBox="0 0 60 80" aria-hidden="true" focusable="false">
  <g fill="none" stroke="currentColor" stroke-width="9" stroke-linecap="round" stroke-linejoin="round">
    <path d="M28 27 L30 45"/>
    <path d="M28 29 L40 20"/>
    <path d="M28 31 L17 41"/>
    <path d="M30 45 L23 63 L21 71"/>
    <path d="M30 45 L38 60 L41 69"/>
  </g>
  <circle cx="27.5" cy="16" r="7.4" fill="currentColor"/>
  <g transform="rotate(-38 46 13)">
    <ellipse cx="46" cy="13" rx="6.6" ry="8.6" fill="none" stroke="currentColor" stroke-width="4.4"/>
    <path d="M46 21.6 L46 26" stroke="currentColor" stroke-width="5" stroke-linecap="round"/>
  </g>
</svg>
