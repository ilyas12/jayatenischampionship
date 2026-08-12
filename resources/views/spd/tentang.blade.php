{{--
    "TENTANG YAYASAN SWARNADWIPA" — sliced from the about artboard of
    "WEB YAYASAN SPD (1).psd".

    Content is static, verbatim from the PSD text layers. The hero is full-bleed
    in the comp, so it sits outside the container; everything below it is inside.
--}}
@extends('spd.layout')

@section('title', 'Tentang Yayasan Swarnadwipa')
@section('meta_description', 'Yayasan Swarnadwipa Peduli Bangsa adalah lembaga sosial yang berdiri pada bulan September tahun 2024, berdedikasi meningkatkan kualitas hidup masyarakat.')

@section('content')

    <div class="spd-hero">
        <img src="{{ asset('resources/assets/spd/images/hero.jpg') }}"
             alt="Pengurus Yayasan Swarnadwipa Peduli Bangsa di area persawahan"
             width="1200" height="900">
    </div>

    <div class="container">
        <section class="pt-5">
            <h1 class="spd-heading spd-heading--section">TENTANG YAYASAN SWARNADWIPA</h1>

            <div class="spd-prose mt-4">
                <p>
                    Yayasan Swarnadwipa Peduli Bangsa adalah lembaga sosial yang berdiri
                    pada bulan September tahun 2024 yang berdedikasi untuk meningkatkan
                    kualitas hidup masyarakat melalui program-program di bidang
                    pendidikan, sosial, kemanusiaan, pemberdayaan ekonomi, kesehatan, dan
                    pelestarian lingkungan.
                </p>
                <p>
                    Berlandaskan semangat gotong royong, kepedulian, dan keberlanjutan,
                    yayasan hadir sebagai mitra masyarakat dalam menciptakan perubahan
                    yang nyata serta membangun masa depan bangsa yang lebih sejahtera.
                </p>
            </div>
        </section>
    </div>

@endsection
