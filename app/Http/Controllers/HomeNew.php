<?php

namespace terre\Http\Controllers;

/**
 * The Swarnadwipa theme, sliced from "WEB YAYASAN SPD.psd" and served under
 * /home-new.
 *
 * Content is deliberately static and hardcoded here rather than read from the
 * CMS tables: the PSD is a design comp, and this route exists to preview the
 * slice. Wiring it to the database is a separate step — the copy below is the
 * shape those records would need to take.
 *
 * The theme is entirely self-contained (views under resources/views/spd,
 * assets under resources/assets/spd) so it cannot affect the live site.
 */
class HomeNew extends Controller
{
    /**
     * The three donation programmes from the PSD.
     *
     * Reproduced verbatim from the comp, including its quirks: the amounts read
     * "IDE" where "IDR" is presumably meant, "Maanfaat" is spelt as in the
     * design, and all three programmes carry identical figures. Corrected here
     * they would no longer match the design being reviewed.
     *
     * @return array
     */
    protected function programs()
    {
        $figures = [
            'required'    => 'IDE 1.000.000.000',
            'collected'   => 'IDR    500.000.000',
            'beneficiary' => 'Petani Waykambas',
        ];

        return [
            ['title' => 'PROGRAM BANTUAN PANGAN MASYARAKAT', 'image' => 'program-1.jpg'] + $figures,
            ['title' => 'PROGRAM BANTUAN PUPUK PETANI',      'image' => 'program-2.jpg'] + $figures,
            ['title' => 'PROGRAM BANTUAN BENIH PADI',        'image' => 'program-3.jpg'] + $figures,
        ];
    }

    /**
     * Landing page for the new theme. The PSD's "BERANDA" artboard is the about
     * page, so that is what /home-new shows.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('spd.tentang', ['spdActive' => 'beranda']);
    }

    /**
     * "TENTANG YAYASAN SWARNADWIPA".
     *
     * @return \Illuminate\View\View
     */
    public function tentang()
    {
        return view('spd.tentang', ['spdActive' => 'tentang']);
    }

    /**
     * "DONASI KEGIATAN KAMI".
     *
     * @return \Illuminate\View\View
     */
    public function donasi()
    {
        return view('spd.donasi', [
            'spdActive' => 'donasi',
            'programs'  => $this->programs(),
        ]);
    }
}
