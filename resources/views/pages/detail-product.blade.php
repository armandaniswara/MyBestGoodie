@extends('layouts.app')

@section('title', 'Detail - ' . $product_selected->name)

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center">Custom {{ $product_selected->name }}</h2>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                    <div class="card-body text-center">
                        <h5>Preview Desain</h5>
                        <hr>

                        <div id="bag-preview-container"
                            style="position: relative; width: 100%; height: 400px; border: 2px dashed #ccc; border-radius: 15px; overflow: hidden; background-color: #ffffff;">

                            <div id="bag-color-layer"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                    background-color: #ffffff; /* Warna awal */
                    z-index: 1; transition: 0.3s;
                    /* KUNCI: Gunakan gambar tas transparanmu sebagai mask */
                    -webkit-mask-image: url('{{ asset($color_selected->image) }}');
                    mask-image: url('{{ asset($color_selected->image) }}');
                    -webkit-mask-size: contain; mask-size: contain;
                    -webkit-mask-position: center; mask-position: center;
                    -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat;">
                            </div>

                            <img id="bag-template" src="{{ asset($color_selected->image) }}"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                    object-fit: contain; z-index: 2; pointer-events: none;
                    /* mix-blend-mode multiply akan mengambil bayangan dari gambar tas */
                    mix-blend-mode: multiply; opacity: 0.9;">

                            <img id="logo-preview-img" src=""
                                style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%);
                    width: 80px; z-index: 3; display: none; cursor: grab;">
                        </div>

                        <p class="mt-3 text-muted">Warna Terpilih: <span id="color-hex-label" class="fw-bold">#FFFFFF</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <form action="{{ route('detail-product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_selected->id }}">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Desain</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Contoh: Tas Seminar Event A" required>
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-2" id="colorPalette">
                                @foreach ($product_selected->colors as $color)
                                    <div class="color-swatch {{ $loop->first ? 'active-swatch' : '' }}"
                                        data-color="{{ $color->color_code }}" data-image="{{ asset($color->image) }}"
                                        {{-- Ini kunci utamanya --}} title="{{ $color->name }}"
                                        style="background-color: {{ $color->color_code }}; width: 35px; height: 35px; border-radius: 50%; cursor: pointer; border: 2px solid #ddd;">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Slider Rotasi -->
                            <div class="mb-3" id="rotate-control" style="display: none;">
                                <label class="form-label fw-bold">Rotasi Logo</label>
                                <input type="range" class="form-range" id="logoRotateSlider" min="0" max="360"
                                    value="0">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">0°</small>
                                    <small id="rotate-degree-label" class="text-muted">0°</small>
                                    <small class="text-muted">360°</small>
                                </div>
                            </div>

                            <!-- Input Hidden untuk menyimpan data ke database -->
                            <input type="hidden" name="rotation" id="inputRotation" value="0">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Upload Logo (PNG Transparan Disarankan)</label>
                                <input type="file" name="image" id="logoInput" class="form-control" accept="image/*">
                                <small class="text-muted">Gunakan gambar transparan untuk hasil terbaik.</small>
                            </div>

                            <div class="mb-3" id="resize-control" style="display: none;">
                                <label class="form-label fw-bold">Ukuran Logo</label>
                                <input type="range" class="form-range" id="logoSizeSlider" min="30" max="300"
                                    value="80">
                            </div>

                            <input type="hidden" name="pos_x" id="inputPosX" value="0">
                            <input type="hidden" name="pos_y" id="inputPosY" value="0">

                            <button type="button" id="btn-download" class="btn btn-success w-100 py-3 mt-3">
                                <i class="bi bi-download"></i> Download Gambar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- CSS Tambahan (Bisa ditaruh di file CSS terpisah) --}}
@push('styles')
    <style>
        .color-swatch:hover,
        .active-swatch {
            border-color: #333 !important;
            transform: scale(1.1);
        }

        #logo-preview-img {
            cursor: grab;
            /* Kursor tangan saat di-hover */
            user-select: none;
            /* Mencegah teks ter-highlight saat digeser */
            touch-action: none;
            /* Untuk mobile nantinya */
        }

        #logo-preview-img:active {
            cursor: grabbing;
            /* Kursor mengepal saat digeser */
        }
    </style>
@endpush

{{-- JAVASCRIPT --}}
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>

        // --- Referensi Elemen ---
        const logoInput = document.getElementById('logoInput');
        const logoPreview = document.getElementById('logo-preview-img');
        const container = document.getElementById('bag-preview-container');
        const resizeControl = document.getElementById('resize-control');
        const sizeSlider = document.getElementById('logoSizeSlider');

        // --- Rotasi  ---
        const rotateSlider = document.getElementById('logoRotateSlider');
        const rotateLabel = document.getElementById('rotate-degree-label');
        const inputRotation = document.getElementById('inputRotation');
        const rotateControl = document.getElementById('rotate-control');

        const inputPosX = document.getElementById('inputPosX');
        const inputPosY = document.getElementById('inputPosY');
        const inputLogoWidth = document.getElementById('inputLogoWidth');

        const swatches = document.querySelectorAll('.color-swatch');
        const bagColorLayer = document.getElementById('bag-color-layer'); // Layer Warna (Masking)
        const colorInputHidden = document.getElementById('colorInput');
        const hexLabel = document.getElementById('color-hex-label');


        // --- Referensi Tombol Download ---
        const btnDownload = document.getElementById('btn-download');

        // --- Logika Download Gambar ---
        btnDownload.addEventListener('click', function() {
            // Ubah teks tombol sementara proses render berjalan
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses Gambar...';
            this.disabled = true; // Nonaktifkan tombol agar tidak diklik berkali-kali

            // Elemen target yang akan "difoto"
            const previewContainer = document.getElementById('bag-preview-container');

            // Gunakan html2canvas
            html2canvas(previewContainer, {
                useCORS: true,
                scale: 2,
                backgroundColor: "#ffffff",
                logging: false,
                onclone: function (clonedDoc) {
                    const clonedBag = clonedDoc.getElementById('bag-template');
                    if (clonedBag) {
                        // Matikan object-fit bawaan yang bikin gepeng
                        clonedBag.style.objectFit = 'initial';

                        // Kunci proporsi agar tidak gepeng
                        clonedBag.style.width = 'auto';
                        clonedBag.style.height = '100%';
                        clonedBag.style.maxWidth = '100%';

                        // Paksa gambar ke tengah (Timpa left: 0 dari HTML)
                        clonedBag.style.left = '50%';
                        clonedBag.style.transform = 'translateX(-50%)';
                    }

                    const clonedLogo = clonedDoc.getElementById('logo-preview-img');
                    if (clonedLogo) {
                        clonedLogo.style.height = 'auto';
                    }
                }
            }).then(canvas => {
                // Konversi hasil render canvas menjadi data URL berformat PNG
                const imageURL = canvas.toDataURL("image/png");

                // Buat elemen link <a> sementara secara dinamis
                const link = document.createElement('a');
                link.href = imageURL;

                // Ambil nama desain untuk nama file (opsional)
                const designNameInput = document.querySelector('input[name="name"]').value;
                const fileName = designNameInput ? designNameInput.replace(/[^a-z0-9]/gi, '_').toLowerCase() : 'Desain_Custom';
                link.download = fileName + '.png';

                // Simulasikan klik pada link untuk memicu unduhan
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Kembalikan kondisi tombol ke semula
                btnDownload.innerHTML = originalText;
                btnDownload.disabled = false;
            }).catch(err => {
                console.error("Terjadi kesalahan saat mengunduh gambar:", err);
                alert("Gagal merender gambar. Pastikan gambar logo sudah terunggah dengan benar.");

                // Kembalikan kondisi tombol ke semula jika error
                btnDownload.innerHTML = originalText;
                btnDownload.disabled = false;
            });
        });



        // --- Logika Pilihan Warna ---
        document.querySelectorAll('.color-swatch').forEach(swatch => {
            swatch.addEventListener('click', function() {
                // 1. Ambil path gambar dari atribut data-image
                const newImage = this.getAttribute('data-image');
                const selectedColor = this.getAttribute('data-color');

                // 2. Ganti Gambar Utama (Preview)
                const mainImage = document.getElementById('bag-template');
                mainImage.src = newImage;

                // 3. Update Input Hidden (untuk simpan ke database)
                document.getElementById('colorInput').value = selectedColor;

                // 4. Update UI (Visual Feedback)
                document.querySelectorAll('.color-swatch').forEach(s => s.classList.remove(
                'active-swatch'));
                this.classList.add('active-swatch');
                document.getElementById('color-hex-label').innerText = selectedColor.toUpperCase();

                // Jika Anda masih menggunakan layer masking, update warnanya juga (opsional)
                const bagColorLayer = document.getElementById('bag-color-layer');
                if (bagColorLayer) {
                    bagColorLayer.style.backgroundColor = selectedColor;
                    bagColorLayer.style.webkitMaskImage = `url('${newImage}')`;
                }
            });
        });

        // --- Logika Preview Logo ---
        logoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.src = e.target.result;
                    logoPreview.style.display = 'block';

                    // Munculkan slider resize setelah gambar diupload
                    resizeControl.style.display = 'block';

                    // Reset posisi ke tengah setiap kali ganti logo
                    logoPreview.style.top = '45%';
                    logoPreview.style.left = '50%';
                    logoPreview.style.transform = 'translate(-50%, -50%)';

                    // Reset ukuran ke default
                    sizeSlider.value = 80;
                    logoPreview.style.width = '80px';
                    if (inputLogoWidth) inputLogoWidth.value = 80;
                }
                reader.readAsDataURL(file);
            }
        });

        // --- Logika Rotasi Logo ---
        rotateSlider.addEventListener('input', function() {
            const rotationValue = this.value;

            // Terapkan rotasi ke gambar logo
            // Kita tetap pakai transform agar rotasi mulus
            logoPreview.style.transform = `rotate(${rotationValue}deg)`;

            // Update label derajat
            rotateLabel.innerText = rotationValue + '°';

            // Simpan ke input hidden untuk dikirim ke database
            inputRotation.value = rotationValue;
        });

        // --- Logika Resize Logo (Perbesar/Perkecil) ---
        sizeSlider.addEventListener('input', function() {
            const newSize = this.value + 'px';
            logoPreview.style.width = newSize;

            // Simpan ukuran ke input hidden untuk dikirim ke database
            if (inputLogoWidth) inputLogoWidth.value = this.value;
        });

        // --- Logika Drag & Drop Logo ---
        let isDragging = false;
        let offsetX, offsetY;

        logoPreview.addEventListener('mousedown', (e) => {
            isDragging = true;
            offsetX = e.clientX - logoPreview.offsetLeft;
            offsetY = e.clientY - logoPreview.offsetTop;

            // Alih-alih 'none', pastikan rotasi tetap ada saat digeser
            const currentRotation = rotateSlider.value;
            logoPreview.style.transform = `rotate(${currentRotation}deg)`;

            logoPreview.style.cursor = 'grabbing';
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;

            let x = e.clientX - offsetX;
            let y = e.clientY - offsetY;

            // Batasan agar logo tidak keluar dari kotak container
            const minX = 0;
            const minY = 0;
            const maxX = container.clientWidth - logoPreview.clientWidth;
            const maxY = container.clientHeight - logoPreview.clientHeight;

            if (x < minX) x = minX;
            if (y < minY) y = minY;
            if (x > maxX) x = maxX;
            if (y > maxY) y = maxY;

            logoPreview.style.left = x + 'px';
            logoPreview.style.top = y + 'px';

            // Update Koordinat ke input hidden
            if (inputPosX) inputPosX.value = x;
            if (inputPosY) inputPosY.value = y;
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            logoPreview.style.cursor = 'grab';
        });

        rotateControl.style.display = 'block';
        rotateSlider.value = 0; // Reset slider
        rotateLabel.innerText = '0°';
    </script>
@endpush
