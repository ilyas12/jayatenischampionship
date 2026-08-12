{{--
    "DONASI KEGIATAN KAMI" — sliced from the donation artboard of
    "WEB YAYASAN SPD.psd".

    Content is static, verbatim from the PSD text layers. Three quirks in the
    source copy are reproduced as designed rather than silently corrected:
    "IDE" where "IDR" is presumably meant, "Maanfaat" for "Manfaat", and
    identical figures on all three programmes. See the note in the controller.
--}}
@extends('spd.layout')

@section('title', 'Donasi Kegiatan Kami')
@section('meta_description', 'Donasi kegiatan Yayasan Swarnadwipa Peduli Bangsa: program bantuan pangan masyarakat, bantuan pupuk petani, dan bantuan benih padi.')

@section('content')
    <div class="container">

        <section class="pt-5">
            <h1 class="spd-heading">DONASI KEGIATAN KAMI</h1>
        </section>

        @foreach ($programs as $program)
            <article class="row g-4 align-items-stretch mt-4 mt-lg-5">

                <div class="col-12 col-md-5 col-lg-4">
                    <div class="spd-card__media h-100">
                        <img src="{{ asset('resources/assets/spd/images/'.$program['image']) }}"
                             alt="{{ $program['title'] }}"
                             width="296" height="296" loading="lazy">
                    </div>
                </div>

                <div class="col-12 col-md-7 col-lg-8 d-flex flex-column gap-3">

                    <h2 class="spd-card__title">{{ $program['title'] }}</h2>

                    <div class="spd-card__detail">
                        <dl class="spd-facts">
                            <dt>Dana yang di perlukan</dt>
                            <dd>{{ $program['required'] }}</dd>

                            <dt>Terkumpul</dt>
                            <dd>{{ $program['collected'] }}</dd>

                            <dt>Penerima Maanfaat</dt>
                            <dd>{{ $program['beneficiary'] }}</dd>
                        </dl>

                        <div class="mt-auto pt-4 text-center">
                            <a class="spd-btn" href="#">DONASI</a>
                        </div>
                    </div>

                </div>
            </article>
        @endforeach

    </div>
@endsection
