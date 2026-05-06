<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\DetailProduct; // WAJIB: Import model ini biar nggak error
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk urusan simpan gambar

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
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
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign-icon lucide-dollar-sign"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
                'title' => 'Harga Terjangkau',
                'desc'  => 'Memberikan harga terjangkau dengan kualitas tinggi',
            ],
        ];

        return view("pages.home", compact("products", "features"));
    }

    public function showCustomize($id)
    {
        // Ambil produk beserta semua variasi warnanya
        $product_selected = Product::with('colors')->findOrFail($id);

        // Warna yang pertama kali muncul (default)
        $color_selected = $product_selected->colors->first();

        return view('pages.detail-product', compact('product_selected', 'color_selected'));
    }

    /**
     * Menyimpan data kustomisasi (POST)
     */
    public function storeColor(Request $request)
    {
        // 1. Validasi Lengkap (Harus sesuai dengan form HTML)
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name'       => 'required|string|max:255',
            'color_code' => 'required|string|max:7',
            'image'      => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        // 2. Logika Simpan Gambar ke Folder Storage
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('custom-logos', 'public');
        }

        // 3. Simpan ke Database menggunakan Model (Lebih Rapi)
        DetailProduct::create([
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'color_code' => $request->color_code,
            'image'      => $imagePath, // Menyimpan path gambarnya saja
        ]);

        return back()->with('success', 'Desain kustom kamu berhasil disimpan ke database!');
    }
}
