@extends('jtc.jtc_layout')

@section('title', $page->page_title)
@section('description', $page->meta_description ?: 'Jaya Tennis Championship')

@section('content')

  @include('jtc.partials.jtc_page_hero', [
      'image'    => 'jtc_hero_past_winners.jpg',
      'eyebrow'  => 'Jaya Tennis Championship',
      'title'    => $page->name,
      'campaign' => [],
      'pillars'  => [],
  ])

  <section class="jtc__container jtc__section">
    {{-- Written in the admin's editor, so it arrives as HTML and is printed as
         HTML. .jtc__prose is what gives it the theme's type rather than the
         browser's defaults. --}}
    <div class="jtc__prose">
      {!! $page->content !!}
    </div>
  </section>

@endsection
