<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama
     */
    public function index()
    {
        // Data fitur "Why Choose Us"
        $features = [
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20a8 8 0 1 0-8-8c0 1.5 1 2.5 2 2.5s2-1 2-2.5a2 2 0 0 1 4 0c0 1.5 1 2.5 2 2.5s2-1 2-2.5a2 2 0 0 1 4 0"/><circle cx="8.5" cy="8.5" r="1"/><circle cx="11.5" cy="11.5" r="1"/><circle cx="15.5" cy="9.5" r="1"/></svg>',
                'title' => 'Custom Design',
                'desc'  => 'Buat desain sesuai keinginan Anda dengan tim desainer profesional',
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
                'title' => 'Kualitas Premium',
                'desc'  => 'Bahan canvas berkualitas tinggi yang tahan lama',
            ],
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-5l-4-4h-3v10Z"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg>',
                'title' => 'Pengiriman Cepat',
                'desc'  => 'Gratis ongkir untuk pembelian minimal 100 pcs',
            ],
        ];


        return view('pages.home', compact('features' ));
    }

    /**
     * Redirect ke WhatsApp dengan pesan produk tertentu
     */
    public function whatsappProduct(Request $request)
    {
        $produk  = $request->query('produk', 'Goodie Bag');
        $nomor   = config('app.whatsapp_number');
        $pesan   = "Halo Admin, saya tertarik untuk memesan produk: {$produk}. Bisa tolong dibantu?";
        $url     = "https://wa.me/{$nomor}?text=" . urlencode($pesan);

        return redirect($url);
    }
}
