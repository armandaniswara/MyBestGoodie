document.addEventListener('DOMContentLoaded', function () {

    // =============================================
    // 1. Update Tahun Footer Otomatis
    // =============================================
    const yearElement = document.getElementById('year');
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }

    // =============================================
    // 2. Tombol WhatsApp per Produk
    // Nomor diambil dari meta tag agar tidak hardcode di JS
    // =============================================
    const nomorWA = document.querySelector('meta[name="whatsapp-number"]')?.content ?? '6281219632138';

    document.querySelectorAll('.whatsapp-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const namaProduk = this.getAttribute('data-produk');
            const pesan = `Halo Admin, saya tertarik untuk memesan produk: ${namaProduk}. Bisa tolong dibantu?`;
            const waLink = `https://wa.me/${nomorWA}?text=${encodeURIComponent(pesan)}`;
            window.open(waLink, '_blank');
        });
    });

    // =============================================
    // 3. Smooth Scroll untuk Anchor Link di Navbar
    // =============================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // =============================================
    // 4. Navbar Aktif berdasarkan Scroll
    // =============================================
    const sections = document.querySelectorAll('section[id], header[id]');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (window.scrollY >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active', 'fw-semibold');
            if (link.getAttribute('href')?.includes(current)) {
                link.classList.add('active', 'fw-semibold');
            }
        });
    });

});
