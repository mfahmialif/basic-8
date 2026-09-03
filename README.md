# Undangan Basic 8

Template website undangan pernikahan statis berbasis HTML, CSS, dan JavaScript. Proyek ini bisa langsung dibuka di browser tanpa proses build.

## Fitur

- Cover undangan dan halaman utama responsif.
- Section profil pasangan.
- Countdown acara.
- Detail ceremony dan reception.
- Timeline cerita pasangan.
- Galeri foto dengan Fancybox.
- Video embed YouTube.
- Form RSVP, komentar, dan wedding gift.
- QR invitation dan tombol musik.
- Animasi AOS dan Lottie.

## Struktur Proyek

```text
basic-8/
|-- index.html
|-- README.md
`-- assets/
    |-- css/
    |   |-- aos.css
    |   |-- loader.css
    |   |-- splide.min.css
    |   `-- style.css
    |-- font/
    |-- img/
    |   |-- *.webp
    |   |-- bird.gif
    |   |-- favicon.ico
    |   |-- lottie/
    |   `-- prewedding/
    `-- js/
        |-- aos.js
        |-- dotlottie-player.js
        |-- loader.js
        |-- script.js
        `-- splide.min.js
```

## Menjalankan

Cara paling sederhana:

```bash
start index.html
```

Atau jalankan server statis lokal:

```bash
python -m http.server 8000
```

Lalu buka:

```text
http://localhost:8000
```

## Catatan Aset

- Aset gambar aktif di `assets/img` sudah dikonversi ke WebP dan dikompresi maksimal 100 KiB.
- `bird.gif` dan `favicon.ico` sengaja dipertahankan sesuai format aslinya.
- `assets/img/lottie/1.lottie` bukan gambar raster, jadi tidak dikonversi.

## Teknologi

- HTML5
- CSS3
- JavaScript
- Bootstrap 5
- Bootstrap Icons
- AOS
- Fancybox
- DotLottie Player
