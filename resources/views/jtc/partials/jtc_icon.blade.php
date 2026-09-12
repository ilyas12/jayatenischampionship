{{--
    Line icons, inline so they take their colour from the text around them and
    stay sharp at any size. Exporting them from the PSD as PNGs would have
    fixed both the colour and the resolution.

    @include('jtc.partials.jtc_icon', ['name' => 'trophy', 'size' => 32])
--}}
@php
    $size   = $size ?? 24;
    $stroke = $stroke ?? 1.6;
@endphp

@switch($name)

  @case('calendar')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <rect x="3" y="5" width="18" height="16" rx="1"/><path d="M3 10h18M8 3v4M16 3v4"/>
      <path d="M7 14h2M11 14h2M15 14h2M7 17h2M11 17h2"/>
    </svg>
    @break

  @case('pin')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <path d="M12 22s7-6.4 7-12a7 7 0 1 0-14 0c0 5.6 7 12 7 12Z"/><circle cx="12" cy="10" r="2.6"/>
    </svg>
    @break

  @case('people')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <circle cx="12" cy="7" r="2.6"/><circle cx="5" cy="9" r="2.2"/><circle cx="19" cy="9" r="2.2"/>
      <path d="M7.5 18c0-2.5 2-4.2 4.5-4.2s4.5 1.7 4.5 4.2"/>
      <path d="M1.8 18c0-2 1.4-3.4 3.2-3.4M22.2 18c0-2-1.4-3.4-3.2-3.4"/>
    </svg>
    @break

  @case('trophy')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <path d="M7 4h10v5a5 5 0 0 1-10 0V4Z"/>
      <path d="M7 6H4.5v1.5A3.5 3.5 0 0 0 8 11M17 6h2.5v1.5A3.5 3.5 0 0 1 16 11"/>
      <path d="M12 14v3M9 20h6M10 17h4v3h-4z"/>
    </svg>
    @break

  @case('bracket')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <rect x="2" y="3" width="6" height="4"/><rect x="2" y="11" width="6" height="4"/><rect x="2" y="19" width="6" height="2.5"/>
      <rect x="15" y="6" width="7" height="4"/><rect x="15" y="15" width="7" height="4"/>
      <path d="M8 5h3v4M8 13h3V9M8 20h3v-3M11 9h4M11 17h4"/>
    </svg>
    @break

  @case('document')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <path d="M6 2h8l4 4v16H6z"/><path d="M14 2v4h4"/><path d="M9 11h6M9 14h6M9 17h4"/>
    </svg>
    @break

  @case('chart')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <rect x="3" y="13" width="4" height="8"/><rect x="10" y="8" width="4" height="13"/><rect x="17" y="4" width="4" height="17"/>
    </svg>
    @break

  @case('arrow-right')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <path d="M4 12h15M13 6l6 6-6 6"/>
    </svg>
    @break

  @case('chevron-down')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <path d="M6 9l6 6 6-6"/>
    </svg>
    @break

  @case('download')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <path d="M12 3v12M7 11l5 5 5-5M4 20h16"/>
    </svg>
    @break

  @case('instagram')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1.1" fill="currentColor" stroke="none"/>
    </svg>
    @break

  @case('youtube')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <rect x="2" y="5" width="20" height="14" rx="4"/><path d="M10 9.2l5 2.8-5 2.8z" fill="currentColor" stroke="none"/>
    </svg>
    @break

  @case('linkedin')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
      <path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9h4v12H3zM10 9h3.8v1.7h.05c.53-.95 1.83-1.95 3.76-1.95 4.02 0 4.76 2.5 4.76 5.76V21h-4v-5.5c0-1.31-.02-3-1.9-3-1.9 0-2.19 1.42-2.19 2.9V21h-4z"/>
    </svg>
    @break

  @case('menu')
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" aria-hidden="true">
      <path d="M4 7h16M4 12h16M4 17h16"/>
    </svg>
    @break

@endswitch
