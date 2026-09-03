# Andrew & Esa — Web Asset Pack

Asset ini disiapkan dari tema undangan cetak: forest green, burgundy/blush, rose pink, cream, olive, motif floral, harlequin, stripes, monogram AE, dan ornament kucing.

## Paling gampang dipakai
- Cover / opening: `theme-forest` + `forest-motif-overlay.png` + `ae-seal.png`
- Profil pasangan: forest solid + `floral-cream-left/right.png`
- Countdown / tanggal: `bg-burgundy-stripes` + `scalloped-ribbon-frame.svg`
- Detail acara: blush card / harlequin accent
- Our Story: `bg-pink-geometric`
- Gallery: forest stripes + cream floral
- RSVP: blush card + burgundy text/button
- Wedding Gift: olive stripes / harlequin
- Closing: forest + `cat-couple.png`

## File utama
- `wedding-theme.css`
- `palette.json`
- `backgrounds/*.svg` — pattern tajam dan repeatable
- `decorations/*.png` — transparan
- `decorations/scalloped-ribbon-frame.svg`
- `reference/*.webp` — referensi visual asli untuk pencocokan

## Contoh
```html
<link rel="stylesheet" href="/assets/wedding-theme.css">

<section class="theme-forest min-h-screen">
  <img src="/assets/decorations/ae-seal.png" alt="" />
  <h1 class="wedding-title">ANDREW & ESA</h1>
</section>
```

```css
.hero-floral-left {
  position: absolute;
  left: -90px;
  bottom: -40px;
  width: min(42vw, 520px);
}
```
