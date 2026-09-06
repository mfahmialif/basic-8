<?php

include_once __DIR__ . "/function/parsing.php";

if (!function_exists("dateFormat")) {
    function dateFormat($date)
    {
        if (!$date) {
            return "";
        }

        $timestamp = strtotime($date);
        if ($timestamp === false) {
            return "";
        }

        if (class_exists("IntlDateFormatter")) {
            $formatter = new IntlDateFormatter(
                "id_ID",
                IntlDateFormatter::FULL,
                IntlDateFormatter::NONE
            );
            return (string) $formatter->format($timestamp);
        }

        return date("l, d F Y", $timestamp);
    }
}

if (!function_exists("html_escape")) {
    function html_escape($value): string
    {
        return htmlspecialchars((string) ($value ?? ""), ENT_QUOTES, "UTF-8");
    }
}

if (!function_exists("decoded_text")) {
    function decoded_text($value): string
    {
        return html_entity_decode((string) ($value ?? ""), ENT_QUOTES, "UTF-8");
    }
}

$url_asset = "https://undangan.jadimudah.id/";
$root_path = "/tema/57/";

$wedding = $pengantin->json ?? (object) [];

$groomName = $wedding->nama_panggilan_pengantin_pria ?? "";
$brideName = $wedding->nama_panggilan_pengantin_wanita ?? "";
$guestName = $tamu->nama ?? "Tamu Undangan";

$coverImage = !empty($wedding->foto_sampul_depan)
    ? rep_url($wedding->foto_sampul_depan)
    : $root_path . "assets/img/prewedding/3.webp";
$backgroundImage = !empty($wedding->foto_background)
    ? rep_url($wedding->foto_background)
    : $root_path . "assets/img/bg-wed-inner.webp";
$groomImage = !empty($wedding->foto_pengantin_pria)
    ? rep_url($wedding->foto_pengantin_pria)
    : $root_path . "assets/img/man.webp";
$brideImage = !empty($wedding->foto_pengantin_wanita)
    ? rep_url($wedding->foto_pengantin_wanita)
    : $root_path . "assets/img/girl.webp";

$akadDate = $wedding->tanggal_akad ?? "";
$receptionDate = $wedding->tanggal_resepsi ?? $akadDate;
$akadDateLabel = dateFormat($akadDate);
$receptionDateLabel = dateFormat($receptionDate);

$targetTimestamp = $akadDate !== ""
    ? strtotime(trim((string) $akadDate . " " . (string) ($wedding->waktu_akad ?? "00:00")))
    : false;
$targetDateIso = $targetTimestamp !== false ? date(DATE_ATOM, $targetTimestamp) : "";

$hasStory = (string) ($wedding->fitur_ourstory ?? "0") === "1";
$hasVideo = (string) ($wedding->fitur_gallery_video ?? "0") === "1"
    && !empty($wedding->gallery_video);
$hasBank1 = (string) ($wedding->fitur_bank ?? "0") === "1";
$hasBank2 = (string) ($wedding->fitur_bank2 ?? "0") === "1";
$hasQris = (string) ($wedding->fitur_qris ?? "0") === "1";

$groomInstagram = trim((string) ($wedding->instagram_pengantin_pria ?? ""), " @");
$brideInstagram = trim((string) ($wedding->instagram_pengantin_wanita ?? ""), " @");
$hasOrganizer = isset($organizer) && (bool) ($organizer->status ?? false);

?>
<!doctype html>
<html lang="id">
  <head>
    <script>
      <?php if (isset($root_path)) : ?>
        var root_path = <?= json_encode($root_path, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      <?php endif; ?>
      <?php if (isset($pengantin)) : ?>
        var pengantin = <?= json_encode($pengantin, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      <?php endif; ?>
      <?php if (isset($tamu)) : ?>
        var tamu = <?= json_encode($tamu, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      <?php endif; ?>
      <?php if (isset($user)) : ?>
        var user = <?= json_encode($user, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      <?php endif; ?>
    </script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= html_escape($groomName) ?> &amp; <?= html_escape($brideName) ?> - Undangan Digital by Jadimudah.id</title>
    <meta
      name="title"
      content="<?= html_escape($wedding->nama_pengantin_pria ?? $groomName) ?> &amp; <?= html_escape($wedding->nama_pengantin_wanita ?? $brideName) ?> - Undangan Digital by Jadimudah.id"
    />
    <meta
      name="description"
      content="Dengan penuh rasa syukur dan kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami."
    />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://jadimudah.id/" />
    <meta
      property="og:title"
      content="<?= html_escape($groomName) ?> &amp; <?= html_escape($brideName) ?> - Undangan Digital by Jadimudah.id"
    />
    <meta
      property="og:description"
      content="Dengan penuh rasa syukur dan kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami."
    />
    <meta property="og:image" content="<?= html_escape($coverImage) ?>" />
    <link rel="icon" type="image/x-icon" href="<?= html_escape($root_path) ?>assets/img/favicon.ico" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="<?= html_escape($root_path) ?>assets/css/aos.css" />
    <link rel="stylesheet" href="<?= html_escape($root_path) ?>assets/css/splide.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="<?= html_escape($root_path) ?>assets/css/loader.css?v=1" />
    <link rel="stylesheet" href="<?= html_escape($root_path) ?>assets/css/style.css?v=1.3" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <style>
      .active > .page-link,
      .page-link.active {
        background-color: var(--wedding-burgundy) !important;
        border-color: var(--wedding-burgundy) !important;
      }

      .main-bg {
        background-image: url("<?= html_escape($backgroundImage) ?>");
      }
    </style>
  </head>

  <body class="meirahmawati no-scroll">
    <div id="loader">
      <div class="heart-loader"></div>
      <p id="progress-text">Preparing the big day... 0%</p>
    </div>

    <!-- Cover desktop -->
    <section class="cover-large" data-aos="fade-down">
      <img
        src="<?= html_escape($root_path) ?>assets/decorations/ae-seal.png"
        class="cover-seal"
        alt="Monogram pasangan"
      />
      <h2 class="header-2 font-body" style="font-size: 2rem !important; letter-spacing: 2px;">
        THE WEDDING OF
      </h2>
      <h1 class="header-1 font-heading" style="font-size: 4.5rem !important">
        <?= html_escape($groomName) ?> &amp; <?= html_escape($brideName) ?>
      </h1>
      <h1 class="header-1 font-body" style="font-size: 1.3rem !important">
        <b><?= html_escape($akadDateLabel) ?></b>
      </h1>
    </section>

    <section class="main" id="main">
      <img
        src="<?= html_escape($backgroundImage) ?>"
        class="main-bg img-grey"
        alt=""
        aria-hidden="true"
      />

      <!-- Opening screen -->
      <section id="welcome" class="welcome-screen" data-aos="fade-down">
        <div class="welcome-bg-motif"></div>

        <div class="welcome-wrapper">
          <div class="welcome-card-royal">
            <img
              src="<?= html_escape($root_path) ?>assets/decorations/floral-cream-left.png"
              class="welcome-floral-left"
              alt=""
              aria-hidden="true"
            />
            <img
              src="<?= html_escape($root_path) ?>assets/decorations/floral-cream-right.png"
              class="welcome-floral-right"
              alt=""
              aria-hidden="true"
            />

            <div class="welcome-seal-wrapper">
              <img
                src="<?= html_escape($root_path) ?>assets/decorations/ae-seal.png"
                class="welcome-seal-img"
                alt="Monogram pasangan"
              />
            </div>

            <div class="welcome-portrait-window">
              <img
                src="<?= html_escape($coverImage) ?>"
                class="welcome-portrait-img"
                alt="Foto <?= html_escape($groomName) ?> dan <?= html_escape($brideName) ?>"
              />
              <div class="welcome-portrait-overlay"></div>
            </div>

            <div class="welcome-locket-divider">
              <img
                src="<?= html_escape($root_path) ?>assets/decorations/bell-bow-cream.png"
                alt=""
                aria-hidden="true"
              />
            </div>

            <div class="welcome-details">
              <p class="welcome-pretitle">THE WEDDING OF</p>
              <h1 class="welcome-couple-name">
                <?= html_escape($groomName) ?> &amp; <?= html_escape($brideName) ?>
              </h1>
              <p class="welcome-date">
                <i class="bi bi-calendar2-heart me-1"></i>
                <?= html_escape($akadDateLabel) ?>
              </p>

              <div class="welcome-guest-card">
                <span class="guest-salutation">Kepada Yth. Bapak/Ibu/Saudara/i:</span>
                <h3 class="guest-name" id="guest-name"><?= html_escape($guestName) ?></h3>
              </div>
            </div>

            <div class="welcome-action-wrap">
              <button
                class="btn btn-invites btn-welcome-action"
                type="button"
                onclick="openInvites()"
              >
                <i class="bi bi-envelope-open-heart-fill me-2"></i> Buka Undangan
              </button>
              <span class="welcome-sound-hint">
                <i class="bi bi-music-note-beamed me-1"></i> Mengandung latar musik
              </span>
            </div>
          </div>
        </div>
      </section>

      <!-- Main invitation content -->
      <section id="content-wedding" style="display: none;">
        <section id="header" class="custom-container" data-aos="fade-down">
          <div
            class="welcome-container"
            style="border-radius: 20px; justify-content: center; align-items: center;"
          >
            <div class="text-center">
              <img
                src="<?= html_escape($root_path) ?>assets/decorations/ae-seal.png"
                class="header-seal"
                alt="Monogram pasangan"
              />
              <h2 class="header-2 font-body" style="letter-spacing: 2px;">THE WEDDING OF</h2>
              <h1 class="header-1 font-heading" style="font-size: 4rem !important">
                <?= html_escape($groomName) ?><br />&amp;<br /><?= html_escape($brideName) ?>
              </h1>
              <h2 class="header-2 font-body mt-2"><?= html_escape($akadDateLabel) ?></h2>
            </div>
            <dotlottie-player
              src="<?= html_escape($root_path) ?>assets/img/lottie/1.lottie"
              background="transparent"
              speed="1"
              style="width: 50px; height: 50px"
              loop
              autoplay
            ></dotlottie-player>
          </div>
        </section>

        <section id="wedding-of" class="custom-container">
          <img
            src="<?= html_escape($root_path) ?>assets/decorations/floral-cream-left.png"
            class="wedding-floral-left"
            alt=""
            aria-hidden="true"
          />
          <img
            src="<?= html_escape($root_path) ?>assets/decorations/floral-cream-right.png"
            class="wedding-floral-right"
            alt=""
            aria-hidden="true"
          />

          <h2 class="font-title">MEMPELAI</h2>

          <div class="couple man mt-3" data-aos="fade-left">
            <img
              src="<?= html_escape($groomImage) ?>"
              class="wedding-of-frame"
              alt="<?= html_escape($groomName) ?>"
              loading="lazy"
            />
            <div class="couple-details mt-3">
              <div class="font-heading-latin-1 text-center"><?= html_escape($groomName) ?></div>
              <p class="text-body-1"><?= html_escape($wedding->nama_pengantin_pria ?? $groomName) ?></p>
              <p class="text-body-4">
                Putra dari <?= html_escape($wedding->nama_bapak_pengantin_pria ?? "") ?>
                &amp; <?= html_escape($wedding->nama_ibu_pengantin_pria ?? "") ?>
              </p>
              <?php if ($groomInstagram !== "") : ?>
              <a
                class="invites-icon text-decoration-none"
                href="https://instagram.com/<?= html_escape($groomInstagram) ?>"
                target="_blank"
                rel="noopener"
                aria-label="Instagram <?= html_escape($groomName) ?>"
              >
                <i class="bi bi-instagram"></i>
              </a>
              <?php endif; ?>
            </div>
          </div>

          <div class="divider-curly">
            <img
              src="<?= html_escape($root_path) ?>assets/decorations/bell-bow-cream.png"
              style="max-width: 65px; filter: drop-shadow(0 3px 8px rgba(0,0,0,0.4));"
              alt=""
              aria-hidden="true"
            />
          </div>

          <div class="couple girl mt-3" data-aos="fade-left">
            <img
              src="<?= html_escape($brideImage) ?>"
              class="wedding-of-frame"
              alt="<?= html_escape($brideName) ?>"
              loading="lazy"
            />
            <div class="couple-details mt-3">
              <div class="font-heading-latin-1 text-center"><?= html_escape($brideName) ?></div>
              <p class="text-body-1"><?= html_escape($wedding->nama_pengantin_wanita ?? $brideName) ?></p>
              <p class="text-body-4">
                Putri dari <?= html_escape($wedding->nama_bapak_pengantin_wanita ?? "") ?>
                &amp; <?= html_escape($wedding->nama_ibu_pengantin_wanita ?? "") ?>
              </p>
              <?php if ($brideInstagram !== "") : ?>
              <a
                class="invites-icon text-decoration-none"
                href="https://instagram.com/<?= html_escape($brideInstagram) ?>"
                target="_blank"
                rel="noopener"
                aria-label="Instagram <?= html_escape($brideName) ?>"
              >
                <i class="bi bi-instagram"></i>
              </a>
              <?php endif; ?>
            </div>
          </div>
        </section>

        <section id="countdown" class="custom-container" data-aos="fade-down">
          <div class="countdown-section-elegant text-center w-100">
            <h1 class="font-title my-2">Catat Tanggalnya</h1>
            <p class="text-body-5 mb-4" style="color: var(--wedding-burgundy-stripe); font-weight: 600;">
              <?= html_escape($akadDateLabel) ?>
            </p>

            <div class="d-flex justify-content-center w-100 countdown-box-container">
              <div class="d-flex flex-column align-items-center justify-content-center countdown-box-elegant">
                <span class="countdown-number-elegant" id="cd-days">00</span>
                <span class="countdown-label-elegant">HARI</span>
              </div>
              <div class="d-flex flex-column align-items-center justify-content-center countdown-box-elegant">
                <span class="countdown-number-elegant" id="cd-hours">00</span>
                <span class="countdown-label-elegant">JAM</span>
              </div>
              <div class="d-flex flex-column align-items-center justify-content-center countdown-box-elegant">
                <span class="countdown-number-elegant" id="cd-minutes">00</span>
                <span class="countdown-label-elegant">MENIT</span>
              </div>
              <div class="d-flex flex-column align-items-center justify-content-center countdown-box-elegant">
                <span class="countdown-number-elegant" id="cd-seconds">00</span>
                <span class="countdown-label-elegant">DETIK</span>
              </div>
            </div>

            <p class="text-body-4 mt-4 px-3 countdown-text-elegant mx-auto">
              Kami sangat menantikan kehadiran Anda untuk merayakan momen bahagia ini bersama,
              diiringi dengan doa, tawa, dan kenangan indah.
            </p>

            <button id="btn-add-calendar" type="button" class="btn btn-invites mt-3 countdown-btn-elegant">
              Simpan ke Kalender <i class="bi bi-calendar countdown-icon-elegant"></i>
            </button>
          </div>
        </section>

        <section id="wedding-day" class="custom-container" data-aos="fade-down">
          <div class="wd-container frame-rounded" data-aos="fade-left">
            <div class="custom-container wd-content">
              <img
                src="<?= html_escape($root_path) ?>assets/decorations/bell-bow.png"
                class="wd-ornament"
                alt=""
                aria-hidden="true"
              />
              <h1 class="font-title reseptionist">Akad Nikah</h1>
              <div class="text-body-5 fw-bold"><?= html_escape($akadDateLabel) ?></div>
              <div class="text-body-5 mt-2">
                <?= html_escape($wedding->waktu_akad ?? "") ?> - <?= html_escape($wedding->waktu_akad_selesai ?? "") ?>
              </div>
              <div class="divider mt-3"><i class="bi bi-heart-fill"></i></div>
              <div class="text-body-1 mt-3"><?= html_escape($wedding->patokan_akad ?? "") ?></div>
              <div class="text-body-5 mt-2">
                <?= nl2br(html_escape($wedding->alamat_akad ?? "")) ?>
              </div>
              <?php if (!empty($wedding->maps_akad)) : ?>
              <a
                href="<?= html_escape($wedding->maps_akad) ?>"
                target="_blank"
                rel="noopener"
                class="btn btn-invites my-3 text-decoration-none"
              >
                <i class="bi bi-geo-alt"></i> Lihat Maps
              </a>
              <?php endif; ?>
            </div>
          </div>

          <div class="wd-container frame-rounded" style="margin-top: 40px" data-aos="fade-left">
            <div class="custom-container wd-content">
              <img
                src="<?= html_escape($root_path) ?>assets/decorations/bell-bow.png"
                class="wd-ornament"
                alt=""
                aria-hidden="true"
              />
              <h1 class="font-title reseptionist">Resepsi</h1>
              <div class="text-body-5 fw-bold"><?= html_escape($receptionDateLabel) ?></div>
              <div class="text-body-5 mt-2">
                <?= html_escape($wedding->waktu_resepsi ?? "") ?> - <?= html_escape($wedding->waktu_resepsi_selesai ?? "") ?>
              </div>
              <div class="divider mt-3"><i class="bi bi-heart-fill"></i></div>
              <div class="text-body-1 mt-3"><?= html_escape($wedding->patokan_resepsi ?? "") ?></div>
              <div class="text-body-5 mt-2">
                <?= nl2br(html_escape($wedding->alamat_resepsi ?? "")) ?>
              </div>
              <?php if (!empty($wedding->maps_resepsi)) : ?>
              <a
                href="<?= html_escape($wedding->maps_resepsi) ?>"
                target="_blank"
                rel="noopener"
                class="btn btn-invites my-3 text-decoration-none"
              >
                <i class="bi bi-geo-alt"></i> Lihat Maps
              </a>
              <?php endif; ?>
            </div>
          </div>
        </section>

        <?php if ($hasStory && !empty($wedding->{"foto_ourstory_1"})) : ?>
        <section
          id="our-story"
          class="d-flex justify-content-center flex-column align-items-center position-relative"
          data-aos="fade-up"
        >
          <div class="story-scallop-top" aria-hidden="true">
            <img src="<?= html_escape($root_path) ?>assets/decorations/scallop-divider-top.svg" alt="" />
          </div>
          <h1 class="font-title my-3">Our Story</h1>
          <br />
          <div class="story-wrapper">
            <div class="timeline-track"></div>
            <div class="timeline-line"></div>

            <?php for ($i = 1; $i <= 20; $i++) :
                $storyPhoto = $wedding->{"foto_ourstory_" . $i} ?? null;
                if (empty($storyPhoto)) {
                    break;
                }
                $storyTitle = decoded_text($wedding->{"judul_ourstory_" . $i} ?? "");
                $storyText = decoded_text($wedding->{"isi_ourstory_" . $i} ?? "");
            ?>
            <div class="story-card js-reveal" data-aos="fade-up">
              <span class="dot"></span>
              <img
                src="<?= html_escape(rep_url($storyPhoto)) ?>"
                class="story-img"
                alt="<?= html_escape($storyTitle) ?>"
                loading="lazy"
              />
              <div class="p-3">
                <h3 class="font-heading3"><?= html_escape($storyTitle) ?></h3>
                <p class="story-text"><?= nl2br(html_escape($storyText)) ?></p>
              </div>
            </div>
            <?php endfor; ?>
          </div>
          <div class="story-scallop-bottom" aria-hidden="true">
            <img src="<?= html_escape($root_path) ?>assets/decorations/scallop-divider-bottom.svg" alt="" />
          </div>
        </section>
        <?php endif; ?>

        <section
          id="gallery"
          class="d-flex justify-content-center flex-column align-items-center"
          data-aos="fade-up"
        >
          <h1
            class="font-title badge"
            style="background: rgba(44, 67, 45, 0.7); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid var(--wedding-cream); color: var(--wedding-cream); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2); font-size: 2rem; padding: 10px 25px;"
          >
            Gallery
          </h1>
          <br />

          <div class="row g-2 m-0 mx-md-2 position-relative z-3 w-100 px-2">
            <?php
              $galleryIndex = 1;
              $firstGallery = $wedding->{"gallery_1"} ?? null;
              if (!empty($firstGallery)) :
                  $firstGalleryUrl = rep_url($firstGallery);
            ?>
            <div class="col-md-12 gallery-item">
              <a
                href="<?= html_escape($firstGalleryUrl) ?>"
                data-fancybox="gallery"
                data-caption="#1"
              >
                <img
                  loading="lazy"
                  src="<?= html_escape($firstGalleryUrl) ?>"
                  alt="Gallery 1"
                  class="gallery-img"
                />
              </a>
            </div>
            <?php $galleryIndex++; endif; ?>

            <?php $pair = 0; if ($galleryIndex > 1) : ?>
            <div class="col-md-12 gallery-item">
              <div class="row g-2">
                <?php while (!empty($wedding->{"gallery_" . $galleryIndex})) :
                    $isEvenPair = ($pair % 2 === 0);
                    $firstCol = $isEvenPair ? "col-8" : "col-4";
                    $secondCol = $isEvenPair ? "col-4" : "col-8";
                    $galleryOne = rep_url($wedding->{"gallery_" . $galleryIndex});
                    $nextGalleryKey = "gallery_" . ($galleryIndex + 1);
                    $hasNextGallery = !empty($wedding->{$nextGalleryKey});
                ?>
                <div class="<?= $hasNextGallery ? $firstCol : "col-12" ?> gallery-item">
                  <a
                    href="<?= html_escape($galleryOne) ?>"
                    data-fancybox="gallery"
                    data-caption="#<?= $galleryIndex ?>"
                  >
                    <img
                      loading="lazy"
                      src="<?= html_escape($galleryOne) ?>"
                      alt="Gallery <?= $galleryIndex ?>"
                      class="gallery-img"
                    />
                  </a>
                </div>
                <?php if ($hasNextGallery) :
                    $galleryTwo = rep_url($wedding->{$nextGalleryKey});
                ?>
                <div class="<?= $secondCol ?> gallery-item">
                  <a
                    href="<?= html_escape($galleryTwo) ?>"
                    data-fancybox="gallery"
                    data-caption="#<?= $galleryIndex + 1 ?>"
                  >
                    <img
                      loading="lazy"
                      src="<?= html_escape($galleryTwo) ?>"
                      alt="Gallery <?= $galleryIndex + 1 ?>"
                      class="gallery-img"
                    />
                  </a>
                </div>
                <?php $galleryIndex++; endif; ?>
                <?php $galleryIndex++; $pair++; endwhile; ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </section>

        <?php if ($hasVideo) : ?>
        <section id="video" data-aos="fade-down">
          <div class="video">
            <iframe
              loading="lazy"
              width="100%"
              height="100%"
              src="<?= html_escape($wedding->gallery_video) ?>"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin"
              allowfullscreen
            ></iframe>
          </div>
        </section>
        <?php endif; ?>

        <section id="attendance" data-aos="fade-up">
          <?php if (isset($tamu)) : ?>
          <section id="reservation" class="custom-container" data-aos="fade-right">
            <h1 class="font-title">Reservasi</h1>
            <div class="form-container">
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input
                  type="text"
                  id="name"
                  name="name"
                  value="<?= html_escape($guestName) ?>"
                  class="form-control"
                  placeholder="Nama"
                  disabled
                />
              </div>

              <div class="input-group mt-1">
                <span class="input-group-text">Kehadiran</span>
                <select class="form-select" id="status" name="status" aria-label="status">
                  <option selected value="unknown">Apakah kamu akan hadir?</option>
                  <option value="konfirmasi_hadir">Ya, aku akan hadir.</option>
                  <option value="konfirmasi_tidak_hadir">Tidak, saya tidak bisa hadir.</option>
                </select>
              </div>

              <div id="group_jumlah_tamu" style="display: none;" class="input-group">
                <span class="input-group-text">Jumlah Tamu</span>
                <input
                  type="number"
                  id="jumlah_tamu"
                  name="jumlah_tamu"
                  value="1"
                  class="form-control"
                  placeholder="Jumlah Tamu"
                  required
                />
              </div>
              <div id="group_pesan" style="display: none;" class="input-group">
                <span class="input-group-text">Pesan</span>
                <textarea
                  id="pesan"
                  name="pesan"
                  class="form-control"
                  placeholder="Ketikkan Pesan"
                  required
                ></textarea>
              </div>

              <button id="btn-rsvp" type="submit" class="btn btn-invites w-100" style="z-index: 10">
                Kirim <i class="bi bi-send"></i>
              </button>
            </div>
          </section>
          <?php endif; ?>

          <section id="message_rsvp" style="display: none;" class="custom-container" data-aos="fade-down">
            <h1 class="font-title">RSVP</h1>
            <div class="form-container">
              <p class="text-body-2">Kamu sudah mengisi RSVP sebelumnya.</p>
              <button id="btn-guestbook" class="btn btn-invites" type="button">
                <i class="fa-solid fa-file-pdf"></i> Download Guest-Book
              </button>
            </div>
          </section>

          <section id="comment" class="custom-container" data-aos="fade-left">
            <h1 class="font-title">Ucapan &amp; Doa</h1>
            <div class="form-comment-container">
              <div class="form-floating w-100">
                <input
                  type="text"
                  id="gvyw"
                  name="comment"
                  class="form-control custom-input"
                  placeholder="Tulis Ucapan &amp; Doa"
                />
                <label for="gvyw">Tulis Ucapan &amp; Doa</label>
              </div>
              <button type="submit" class="btn btn-invites w-100">
                Kirim Ucapan <i class="bi bi-send ms-1"></i>
              </button>
            </div>
            <div id="comment_content" style="display: none;">
              <div id="list_comment" class="comment-container"></div>
            </div>
            <div class="comment-container">
              <nav aria-label="Navigasi komentar" align="center">
                <ul id="comment-pagination" class="pagination justify-content-center" align="center"></ul>
              </nav>
            </div>
          </section>
        </section>

        <section id="wedding-gift" class="custom-container" data-aos="fade-down">
          <div class="wg-container">
            <h1 class="font-title">Wedding Gift</h1>
            <div class="text-body-2 mt-2">
              Doa restu Anda merupakan karunia yang paling berarti bagi kami. Jika Anda ingin memberi tanda kasih,
              kami menyediakan amplop digital di bawah ini.
            </div>
            <hr class="w-100 my-3" />

            <div class="form-container w-100">
              <ul class="nav nav-tabs flex justify-content-center" id="wg-nav-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link active"
                    id="bank-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#bank"
                    type="button"
                    role="tab"
                    aria-controls="bank"
                    aria-selected="true"
                  >
                    E-Angpao
                  </button>
                </li>
              </ul>

              <div class="tab-content w-100 mt-3" id="wg-tab-content">
                <div class="tab-pane fade show active" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                  <div class="reservation-status w-100">
                    <?php if (!$hasBank1 && !$hasBank2) : ?>
                    <p class="text-body-2 text-center">Informasi rekening belum tersedia.</p>
                    <?php endif; ?>

                    <?php if ($hasBank1) :
                        $bankLogo1 = !empty($wedding->logo_bank) ? rep_url($wedding->logo_bank) : "";
                        $account1 = (string) ($wedding->rekening_bank ?? "");
                    ?>
                    <div class="card-wg mt-2" data-aos="flip-up">
                      <div>
                        <?php if ($bankLogo1 !== "") : ?>
                        <img
                          loading="lazy"
                          src="<?= html_escape($bankLogo1) ?>"
                          alt="Logo <?= html_escape($wedding->nama_bank ?? "Bank") ?>"
                          style="max-width: 100px; max-height: 42px; object-fit: contain; margin-bottom: 12px;"
                        />
                        <?php endif; ?>
                        <p class="fw-bold" style="letter-spacing: 1px;">
                          BANK <?= html_escape($wedding->nama_bank ?? "") ?>
                        </p>
                        <p style="font-size: 13px; opacity: 0.8;">Nomor Rekening</p>
                        <p class="fw-bold fs-5" style="letter-spacing: 1px;">
                          <?= html_escape($account1) ?>
                        </p>
                        <p style="font-size: 13px; opacity: 0.9;">
                          a.n. <?= html_escape($wedding->nama_rekening ?? "") ?>
                        </p>
                        <button
                          type="button"
                          class="btn btn-invites btn-sm copy-account"
                          data-account="<?= html_escape($account1) ?>"
                        >
                          Salin Nomor
                        </button>
                      </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($hasBank2) :
                        $bankLogo2 = !empty($wedding->logo_bank2) ? rep_url($wedding->logo_bank2) : "";
                        $account2 = (string) ($wedding->rekening_bank2 ?? "");
                    ?>
                    <div class="card-wg mt-2" data-aos="flip-up">
                      <div>
                        <?php if ($bankLogo2 !== "") : ?>
                        <img
                          loading="lazy"
                          src="<?= html_escape($bankLogo2) ?>"
                          alt="Logo <?= html_escape($wedding->nama_bank2 ?? "Bank") ?>"
                          style="max-width: 100px; max-height: 42px; object-fit: contain; margin-bottom: 12px;"
                        />
                        <?php endif; ?>
                        <p class="fw-bold" style="letter-spacing: 1px;">
                          BANK <?= html_escape($wedding->nama_bank2 ?? "") ?>
                        </p>
                        <p style="font-size: 13px; opacity: 0.8;">Nomor Rekening</p>
                        <p class="fw-bold fs-5" style="letter-spacing: 1px;">
                          <?= html_escape($account2) ?>
                        </p>
                        <p style="font-size: 13px; opacity: 0.9;">
                          a.n. <?= html_escape($wedding->nama_rekening2 ?? "") ?>
                        </p>
                        <button
                          type="button"
                          class="btn btn-invites btn-sm copy-account"
                          data-account="<?= html_escape($account2) ?>"
                        >
                          Salin Nomor
                        </button>
                      </div>
                    </div>
                    <?php endif; ?>
                  </div>

                  <?php if ($hasQris) : ?>
                  <div class="form-bank mt-3">
                    <div class="text-body-2 mb-3 text-center" style="font-size: 1.2rem;">- Via QRIS -</div>
                    <div class="input-group mb-2">
                      <span class="input-group-text custom-input"><i class="bi bi-person"></i></span>
                      <input type="text" id="bank-name" name="bank-name" class="form-control custom-input" placeholder="Nama Pengirim" />
                    </div>
                    <div class="input-group mb-2">
                      <span class="input-group-text custom-input"><i class="bi bi-cash"></i></span>
                      <input type="number" id="bank-amount" name="bank-amount" class="form-control custom-input" placeholder="Jumlah Rp." />
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text custom-input"><i class="bi bi-envelope"></i></span>
                      <input type="email" id="bank-email" name="bank-email" class="form-control custom-input" placeholder="Email" />
                    </div>
                    <button id="bank-btn" type="submit" class="btn btn-invites w-100">
                      Proses <i class="bi bi-send ms-1"></i>
                    </button>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section id="quote" class="custom-container" data-aos="fade-down">
          <div class="quote-container text-center">
            <div class="text-body-2">
              "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari
              jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu
              rasa kasih dan sayang."
            </div>
            <div class="font-heading3 text-center mt-3 surah">(QS. Ar-Rum: 21)</div>
          </div>
        </section>

        <section id="thanks" data-aos="fade-down">
          <div class="custom-container" data-aos="fade-down">
            <div class="thanks-frame">
              <div class="custom-container thanks-content">
                <img
                  src="<?= html_escape($root_path) ?>assets/decorations/cat-couple.png"
                  class="thanks-cat"
                  alt="Ilustrasi pasangan"
                  loading="lazy"
                />
                <div class="thanks-bottom">
                  <p class="text-body-5">
                    Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir
                    untuk memberikan doa restu kepada kedua mempelai.
                  </p>
                  <h1 class="header-1 font-heading">
                    <?= html_escape($groomName) ?><br />&amp;<br /><?= html_escape($brideName) ?>
                  </h1>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section id="footer-right" class="custom-container">
          <?php if ($hasOrganizer && isset($organizer->data->image)) : ?>
          <div class="container text-center mb-3">
            <img
              loading="lazy"
              src="<?= html_escape(rep_url($organizer->data->image)) ?>"
              width="70%"
              alt="Organizer"
            />
          </div>
          <?php endif; ?>
          <div class="text-body-2"><b><?= html_escape($groomName) ?> &amp; <?= html_escape($brideName) ?> Wedding Invitation</b></div>
          <div class="social-media my-3">
            <?php if ($groomInstagram !== "") : ?>
            <a href="https://instagram.com/<?= html_escape($groomInstagram) ?>" class="invites-icon" target="_blank" rel="noopener" aria-label="Instagram">
              <i class="bi bi-instagram"></i>
            </a>
            <?php endif; ?>
            <a href="https://jadimudah.id" class="invites-icon" target="_blank" rel="noopener" aria-label="Website">
              <i class="bi bi-globe"></i>
            </a>
          </div>
          <div class="text-body-2" style="font-size: 13px; opacity: 0.8;">
            &copy; <?= date("Y") ?> <?= html_escape($groomName) ?> &amp; <?= html_escape($brideName) ?>. All rights reserved.
          </div>
        </section>
      </section>
    </section>

    <!-- Komponen server menyediakan kontrol musik dan QR invitation. -->
    <?= view("components/music-qr") ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYF0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="<?= html_escape($root_path) ?>assets/js/aos.js"></script>
    <script src="<?= html_escape($root_path) ?>assets/js/splide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="<?= html_escape($root_path) ?>assets/js/dotlottie-player.js"></script>
    <script src="<?= html_escape($root_path) ?>assets/js/loader.js?v=22"></script>
    <script src="<?= html_escape($root_path) ?>assets/js/jquery.loading.min.js"></script>
    <script src="<?= html_escape($root_path) ?>assets/js/script.js?v=3"></script>

    <script>
      const revealItems = document.querySelectorAll(".js-reveal");

      function revealOnScroll() {
        revealItems.forEach((item) => {
          const pos = item.getBoundingClientRect().top;
          if (pos < window.innerHeight - 80) item.classList.add("reveal");
        });
      }

      function updateCountdown() {
        const targetDate = <?= json_encode($targetDateIso) ?>;
        const difference = targetDate ? new Date(targetDate).getTime() - Date.now() : 0;
        const values = difference > 0
          ? {
              days: Math.floor(difference / (1000 * 60 * 60 * 24)),
              hours: Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
              minutes: Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60)),
              seconds: Math.floor((difference % (1000 * 60)) / 1000),
            }
          : { days: 0, hours: 0, minutes: 0, seconds: 0 };

        ["days", "hours", "minutes", "seconds"].forEach((key) => {
          const element = document.getElementById(`cd-${key}`);
          if (element) element.textContent = String(values[key]).padStart(2, "0");
        });
      }

      function downloadCalendarFile() {
        const eventDate = <?= json_encode($targetDateIso) ?>;
        if (!eventDate) return;

        const start = eventDate.replace(/[-:]/g, "").replace(/\.\d{3}/, "");
        const endDate = new Date(new Date(eventDate).getTime() + 2 * 60 * 60 * 1000);
        const end = endDate.toISOString().replace(/[-:]/g, "").replace(/\.\d{3}/, "");
        const ics = [
          "BEGIN:VCALENDAR",
          "VERSION:2.0",
          "BEGIN:VEVENT",
          `DTSTART:${start}`,
          `DTEND:${end}`,
          "SUMMARY:<?= html_escape($groomName) ?> & <?= html_escape($brideName) ?>",
          "DESCRIPTION:Undangan pernikahan",
          "END:VEVENT",
          "END:VCALENDAR",
        ].join("\\r\\n");
        const link = document.createElement("a");
        link.href = URL.createObjectURL(new Blob([ics], { type: "text/calendar" }));
        link.download = "undangan-pernikahan.ics";
        link.click();
        URL.revokeObjectURL(link.href);
      }

      async function copyToClipboard(button, account) {
        try {
          await navigator.clipboard.writeText(account);
          const originalText = button.textContent;
          button.textContent = "Tersalin";
          setTimeout(() => { button.textContent = originalText; }, 1600);
        } catch (error) {
          window.prompt("Salin nomor rekening berikut:", account);
        }
      }

      document.addEventListener("DOMContentLoaded", () => {
        updateCountdown();
        setInterval(updateCountdown, 1000);
        revealOnScroll();

        const calendarButton = document.getElementById("btn-add-calendar");
        if (calendarButton) calendarButton.addEventListener("click", downloadCalendarFile);

        document.querySelectorAll(".copy-account").forEach((button) => {
          button.addEventListener("click", () => copyToClipboard(button, button.dataset.account || ""));
        });

        const urlParams = new URLSearchParams(window.location.search);
        const guest = urlParams.get("to") || urlParams.get("u") || urlParams.get("nama");
        const guestElement = document.getElementById("guest-name");
        if (guest && guestElement) guestElement.textContent = guest;
      });

      window.addEventListener("scroll", revealOnScroll, { passive: true });
      window.addEventListener("load", () => {
        revealOnScroll();
        if (window.Opening && typeof window.Opening.init === "function") {
          window.Opening.init();
        }
      });
    </script>
  </body>
</html>
