
<?php
include("function/parsing.php");

function bd() // Browser Debug — shows JSON in browser
{
    $args = func_get_args();
    header('Content-Type: application/json');
    echo json_encode($args, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    die();
}

function dateFormat($date){
  $timestamp = strtotime($date);
  
  $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
  return $formatter->format($timestamp);
}


$url_asset = "https://undangan.jadimudah.id/";
$root_path = "/tema/57/";

?>

<!doctype html>
<html lang="id">
  <head>
    <script>
      <?php if (isset($root_path)) : ?>
          var root_path = <?= json_encode($root_path) ?>;
      <?php endif; ?>
      <?php if (isset($pengantin)) : ?>
          var pengantin = <?= json_encode($pengantin) ?>;
      <?php endif; ?>
      <?php if (isset($tamu)) : ?>
          var tamu = <?= json_encode($tamu) ?>;
      <?php endif; ?>
      <?php if (isset($user)) : ?>
          var user = <?= json_encode($user) ?>;
      <?php endif; ?>
    </script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?= $pengantin->json->nama_panggilan_pengantin_wanita ?> & <?= $pengantin->json->nama_panggilan_pengantin_pria ?> - Undangan Digital by Jadimudah.id</title>
    <meta name="title" content="<?= $pengantin->json->nama_pengantin_wanita ?> & <?= $pengantin->json->nama_pengantin_pria ?> - Undangan Digital by Jadimudah.id" />
    <meta name="description" content="Dengan penuh rasa syukur dan kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami." />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://jadimudah.id/" />
    <meta property="og:title" content="<?= $pengantin->json->nama_panggilan_pengantin_wanita ?> & <?= $pengantin->json->nama_panggilan_pengantin_pria ?> - Undangan Digital by Jadimudah.id" />
    <meta property="og:description" content="Dengan penuh rasa syukur dan kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami." />
    <meta property="og:image" content="<?= rep_url($pengantin->json->foto_sampul_depan) ?>" />

    <!-- <link rel="icon" type="image/x-icon" href="<?= $root_path ?>assets/img/favicon.ico" /> -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="<?= $root_path ?>assets/css/aos.css" />
    <link rel="stylesheet" href="<?= $root_path ?>assets/css/splide.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="<?= $root_path ?>assets/css/loader.css?v=1" />
    <link rel="stylesheet" href="<?= $root_path ?>assets/css/style.css?v=1.3" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/player.css">

    <style>
      .active>.page-link,
      .page-link.active {
        background-color: #617BA1 !important;
        border-color: #617BA1;
      }

      #welcome {
        background: url('<?= rep_url($pengantin->json->foto_sampul_depan) ?>') no-repeat center center / cover !important;
      }
    </style>
  </head>

  <body class="mfahmialif no-scroll">
    <!-- Wedding Loader -->
    <div id="loader">
      <div class="heart-loader"></div>
      <p id="progress-text">Preparing the big day... 0%</p>
    </div>

    <!-- <div class="snowfall-animation"></div> -->

    <section class="cover-large" data-aos="fade-down" data-aos-duration="1200">
      <h2 class="header-2 font-body cover-subtitle" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
        Kami dengan hormat mengundang Anda ke pernikahan kami
      </h2>
      <h1 class="header-1 font-heading cover-name" data-aos="fade-right" data-aos-delay="500" data-aos-duration="800"><?= $pengantin->json->nama_panggilan_pengantin_pria ?></h1>
      <h1 class="header-1 font-heading cover-ampersand" data-aos="zoom-in" data-aos-delay="700" data-aos-duration="600">&</h1>
      <h1 class="header-1 font-heading cover-name" data-aos="fade-left" data-aos-delay="900" data-aos-duration="800"><?= $pengantin->json->nama_panggilan_pengantin_wanita ?></h1>
    </section>

    <section class="main" id="main">
      <img src="<?= rep_url($pengantin->json->foto_background) ?>" class="main-bg img-grey" alt="" />
      <section id="welcome" class="custom-container" data-aos="fade-down" data-aos-duration="1000">
        <div class="welcome-container">
          <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
            <p class="welcome-label">Kepada Yth</p>
            <h2 class="welcome-guest-name"><?= $tamu->nama ?? "Tamu Undangan" ?></h2>
          </div>

          <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
            <p class="welcome-invite-text">
              Mohon doa Restu dalam rangka pernikahan:
            </p>
            <h1 class="welcome-couple-name" data-aos="fade-right" data-aos-delay="600" data-aos-duration="700"><?= $pengantin->json->nama_panggilan_pengantin_pria ?></h1>
            <p class="welcome-ampersand" data-aos="zoom-in" data-aos-delay="800" data-aos-duration="500">&</p>
            <h1 class="welcome-couple-name" data-aos="fade-left" data-aos-delay="1000" data-aos-duration="700"><?= $pengantin->json->nama_panggilan_pengantin_wanita ?></h1>
            <button
              class="btn btn-invites d-block mt-4"
              onclick="openInvites()"
              data-aos="zoom-in" data-aos-delay="1200" data-aos-duration="600"
            >
              Buka Undangan
            </button>
          </div>
        </div>
      </section>

      <section id="content-wedding" style="display: none;">
        <section id="header" class="custom-container">
          <div class="welcome-container" style="justify-content: flex-end;">

            <div>
              <p class="welcome-invite-text">
                Acara Pernikahan Dari:
              </p>
              <h1 class="welcome-couple-name"><?= $pengantin->json->nama_panggilan_pengantin_pria ?></h1>
              <p class="welcome-ampersand">&</p>
              <h1 class="welcome-couple-name"><?= $pengantin->json->nama_panggilan_pengantin_wanita ?></h1>
            </div>
          </div>
        </section>
        <!-- The Groom -->
        <section class="couple-card" data-aos="fade-right" data-aos-duration="1000" data-aos-easing="ease-out-cubic">
          <img
            src="<?= rep_url($pengantin->json->foto_pengantin_pria) ?>"
            alt="The Groom"
            class="couple-card-bg"
          />
          <div class="couple-card-overlay"></div>
          <div class="couple-card-title" data-aos="fade-down" data-aos-delay="300" data-aos-duration="700">
            <h2 class="couple-card-heading">Putra Bpk. <?= $pengantin->json->nama_panggilan_bapak_pengantin_pria ?></h2>
          </div>
          <div class="couple-card-info" data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">
            <h1 class="couple-card-name"><?= $pengantin->json->nama_panggilan_pengantin_pria ?></h1>
            <p class="couple-card-fullname">Putra dari</p>
            <p class="couple-card-parents">Bpk. <?= $pengantin->json->nama_bapak_pengantin_pria ?></p>
            <p class="couple-card-parents">&</p>
            <p class="couple-card-parents">Ibu <?= $pengantin->json->nama_ibu_pengantin_pria ?></p>
            <a href="https://instagram.com/<?= $pengantin->json->instagram_pengantin_pria ?>" class="couple-card-social">
              <i class="bi bi-instagram"></i>
            </a>
          </div>
        </section>

        <!-- The Bride -->
        <section class="couple-card" data-aos="fade-left" data-aos-duration="1000" data-aos-easing="ease-out-cubic">
          <img
            src="<?= rep_url($pengantin->json->foto_pengantin_wanita) ?>"
            alt="The Bride"
            class="couple-card-bg"
          />
          <div class="couple-card-overlay"></div>
          <div class="couple-card-title" data-aos="fade-down" data-aos-delay="300" data-aos-duration="700">
            <h2 class="couple-card-heading">Putri Bpk. <?= $pengantin->json->nama_panggilan_bapak_pengantin_wanita ?></h2>
          </div>
          <div class="couple-card-info" data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">
            <h1 class="couple-card-name"><?= $pengantin->json->nama_panggilan_pengantin_wanita ?></h1>
            <p class="couple-card-fullname">Putri dari</p>
            <p class="couple-card-parents">Bpk. <?= $pengantin->json->nama_bapak_pengantin_wanita ?></p>
            <p class="couple-card-parents">&</p>
            <p class="couple-card-parents">Ibu <?= $pengantin->json->nama_ibu_pengantin_wanita ?></p>
            <a href="https://instagram.com/<?= $pengantin->json->instagram_pengantin_wanita ?>" class="couple-card-social">
              <i class="bi bi-instagram"></i>
            </a>
          </div>
        </section>

        <section id="countdown" class="countdown-new" data-aos="fade-down" data-aos-duration="1200">
          <!-- Dark Overlay -->
          <div class="countdown-overlay"></div>

          <!-- Top Content: Names + Subtitle -->
          <div class="countdown-top" data-aos="fade-down" data-aos-delay="200" data-aos-duration="800">
            <h1 class="countdown-couple-name"><?= $pengantin->json->nama_panggilan_pengantin_pria ?> & <?= $pengantin->json->nama_panggilan_pengantin_wanita ?></h1>
            <p class="countdown-subtitle">Catat Tanggalnya</p>
          </div>

          <!-- Scroll Chevron -->
          <div class="countdown-chevron" data-aos="fade-down" data-aos-delay="400" data-aos-duration="600">
            <i class="bi bi-chevron-compact-down"></i>
            <i class="bi bi-chevron-compact-down"></i>
            <i class="bi bi-chevron-compact-down"></i>
          </div>

          <!-- Bottom Content: Countdown + Button -->
          <div class="countdown-bottom" data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000">
            <div class="countdown-numbers">
              <div class="countdown-item" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="500">
                <span class="countdown-num" id="count-day">00</span>
                <span class="countdown-label">Hari</span>
              </div>
              <div class="countdown-item" data-aos="zoom-in" data-aos-delay="750" data-aos-duration="500">
                <span class="countdown-num" id="count-hour">00</span>
                <span class="countdown-label">Jam</span>
              </div>
              <div class="countdown-item" data-aos="zoom-in" data-aos-delay="900" data-aos-duration="500">
                <span class="countdown-num" id="count-minute">00</span>
                <span class="countdown-label">Menit</span>
              </div>
              <div class="countdown-item" data-aos="zoom-in" data-aos-delay="1050" data-aos-duration="500">
                <span class="countdown-num" id="count-second">00</span>
                <span class="countdown-label">Detik</span>
              </div>
            </div>

            <button id="btn-add-calendar" class="btn-save-date mt-3" data-aos="zoom-in" data-aos-delay="1200" data-aos-duration="600">
              <i class="bi bi-calendar3"></i>
              Catat Tanggalnya
            </button>
          </div>
        </section>

        <section id="wedding-day" class="venue-section" data-aos="fade-up" data-aos-duration="1000">
          <!-- Venue Title -->
          <h2 class="venue-title" data-aos="fade-down" data-aos-delay="200" data-aos-duration="800">Hari Pernikahan</h2>

          <!-- Akad -->
          <div class="venue-event" data-aos="fade-right" data-aos-delay="300" data-aos-duration="800">
            <h3 class="venue-event-label text-start">AKAD NIKAH</h3>
            <div class="venue-date-row text-start">
              <span class="venue-date-big"><?= date('d', strtotime($pengantin->json->tanggal_akad)) ?></span>
              <div class="venue-date-detail">
                <span class="venue-day"><?= dateFormat($pengantin->json->tanggal_akad) ?></span>
              </div>
              <span class="venue-date-line"></span>
              <span class="venue-time"><?= $pengantin->json->waktu_akad ?> - <?= $pengantin->json->waktu_akad_selesai ?></span>
            </div>
          </div>

          <!-- Venue Location -->
          <div class="venue-location" data-aos="fade-right" data-aos-delay="500" data-aos-duration="800">
            <h3 class="venue-place-name text-start"><?= $pengantin->json->patokan_akad ?></h3>
            <p class="venue-address text-start">
              <?= $pengantin->json->alamat_akad ?>
            </p>
            <button class="btn-save-date mt-2" onclick="window.location=`<?= $pengantin->json->maps_akad ?>`">
              <i class="bi bi-geo-alt"></i>
              Lihat Maps
            </button>
          </div>

          <hr class="divider-wedding-day" data-aos="zoom-in" data-aos-duration="600" />
          <!-- Resepsi -->
          <div class="venue-event" data-aos="fade-left" data-aos-delay="300" data-aos-duration="800">
            <h3 class="venue-event-label text-end">RESEPSI</h3>
            <div class="venue-date-row text-end">
              <span class="venue-date-big"><?= date('d', strtotime($pengantin->json->tanggal_resepsi)) ?></span>
              <div class="venue-date-detail">
                <span class="venue-day"><?= dateFormat($pengantin->json->tanggal_resepsi) ?></span>
              </div>
              <span class="venue-date-line"></span>
              <span class="venue-time"><?= $pengantin->json->waktu_resepsi ?> - <?= $pengantin->json->waktu_resepsi_selesai ?></span>
            </div>
          </div>

          <!-- Venue Location -->
          <div class="venue-location align-items-end" data-aos="fade-left" data-aos-delay="500" data-aos-duration="800">
            <h3 class="venue-place-name text-end"><?= $pengantin->json->patokan_resepsi ?></h3>
            <p class="venue-address text-end">
              <?= $pengantin->json->alamat_resepsi ?>
            </p>
            <button class="btn-save-date mt-2" onclick="window.location=`<?= $pengantin->json->maps_resepsi ?>`">
              <i class="bi bi-geo-alt"></i>
              Lihat Maps
            </button>
          </div>
        </section>

        <?php if (($pengantin->json->fitur_ourstory ?? "0") === "1") : ?>
        <section id="our-story" class="story-section" data-aos="fade-up" data-aos-duration="1000">
          <h2 class="story-section-title" data-aos="fade-down" data-aos-delay="200" data-aos-duration="800">Our Story</h2>

          <div class="story-timeline">
            <div class="story-timeline-line"></div>

            <?php $i = 1; while (isset($pengantin->json->{"foto_ourstory_$i"})) : ?>
            <div class="story-card-dark js-reveal">
              <div class="story-card-dot"></div>
              <div class="story-card-inner">
                <img
                  src="<?= rep_url($pengantin->json->{"foto_ourstory_$i"}) ?>"
                  class="story-card-img"
                  alt="<?= html_entity_decode($pengantin->json->{"judul_ourstory_$i"}) ?>"
                />
                <div class="story-card-body">
                  <h3 class="story-card-title"><?= html_entity_decode($pengantin->json->{"judul_ourstory_$i"}) ?></h3>
                  <p class="story-card-text">
                    <?= html_entity_decode($pengantin->json->{"isi_ourstory_$i"}) ?>
                  </p>
                </div>
              </div>
            </div>
            <?php $i++; endwhile; ?>
          </div>
        </section>
        <?php endif; ?>

        <section
          id="gallery"
          class="d-flex justify-content-center mt-5 flex-column align-items-center"
          data-aos="fade-up"
          data-aos-duration="1000"
        >
          <h1
            class="font-heading text-light"
            style="font-size: 2.5rem !important"
            data-aos="zoom-in" data-aos-delay="200" data-aos-duration="800"
          >
            Galeri
          </h1>
          <br />

          <?php if (($pengantin->json->fitur_gallery_video ?? "0") === "1") : ?>
          <section id="video" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
            <br />
            <div class="video">
              <iframe
                loading="lazy"
                width="100%"
                height="100%"
                src="<?= $pengantin->json->gallery_video ?>"
                title="YouTube video player"
                frameborder="0"
                allow="
                  accelerometer;
                  autoplay;
                  clipboard-write;
                  encrypted-media;
                  gyroscope;
                  picture-in-picture;
                  web-share;
                "
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
              >
              </iframe>
            </div>
          </section>
          <?php endif; ?>

          <div class="row g-2 m-0 mx-md-2 position-relative z-3">
            <?php
              $i = 1;
              // Gambar pertama full width
              if (isset($pengantin->json->{"gallery_$i"})) :
                $galleryUrl = rep_url($pengantin->json->{"gallery_$i"});
            ?>
            <div class="col-12 gallery-item" data-aos="zoom-in" data-aos-duration="800">
              <a href="<?= $galleryUrl ?>" data-fancybox="gallery" data-caption="#<?= $i ?>">
                <img loading="lazy" src="<?= $galleryUrl ?>" alt="Image <?= $i ?>" class="gallery-img" />
              </a>
            </div>
            <?php $i++; endif; ?>

            <?php
              // Sisanya pakai pola col-8 + col-4 lalu col-4 + col-8 bergantian
              $pair = 0;
              while (isset($pengantin->json->{"gallery_$i"})) :
                $isEvenPair = ($pair % 2 === 0);
                $firstCol  = $isEvenPair ? 'col-8' : 'col-4';
                $secondCol = $isEvenPair ? 'col-4' : 'col-8';

                $url1 = rep_url($pengantin->json->{"gallery_$i"});
                $nextKey = "gallery_" . ($i + 1);
                $hasNext = isset($pengantin->json->$nextKey);
            ?>
              <div class="<?= $hasNext ? $firstCol : 'col-12' ?> gallery-item" data-aos="<?= $isEvenPair ? 'fade-right' : 'fade-left' ?>" data-aos-delay="<?= ($pair % 3) * 100 ?>" data-aos-duration="700">
                <a href="<?= $url1 ?>" data-fancybox="gallery" data-caption="#<?= $i ?>">
                  <img loading="lazy" src="<?= $url1 ?>" alt="Image <?= $i ?>" class="gallery-img" />
                </a>
              </div>
              <?php if ($hasNext) :
                $url2 = rep_url($pengantin->json->$nextKey);
              ?>
              <div class="<?= $secondCol ?> gallery-item" data-aos="<?= $isEvenPair ? 'fade-left' : 'fade-right' ?>" data-aos-delay="<?= ($pair % 3) * 100 + 150 ?>" data-aos-duration="700">
                <a href="<?= $url2 ?>" data-fancybox="gallery" data-caption="#<?= ($i + 1) ?>">
                  <img loading="lazy" src="<?= $url2 ?>" alt="Image <?= ($i + 1) ?>" class="gallery-img" />
                </a>
              </div>
              <?php $i++; endif; ?>
            <?php $i++; $pair++; endwhile; ?>
          </div>
        </section>

        <section id="attendance" data-aos="fade-up" data-aos-duration="800">
          <?php if (isset($tamu)) : ?>
          <section
            id="reservation"
            class="custom-container"
            data-aos="fade-right"
          >
            <h1 class="font-heading text-light">Reservasi</h1>
            <div class="form-container">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="bi bi-person"></i>
                </span>
                <input
                  type="text"
                  id="name"
                  name="name"
                  value="<?= $tamu->nama ?? "Tamu Undangan" ?>"
                  class="form-control"
                  placeholder="Name"
                  disabled
                />
              </div>

              <div class="input-group mt-1">
                <span class="input-group-text"> Kehadiran </span>
                <select
                  class="form-select"
                  id="status"
                  name="status"
                  aria-label="status"
                >
                  <option selected value="unknown">Apakah kamu akan hadir?</option>
                  <option value="konfirmasi_hadir">Ya, aku akan hadir.</option>
                  <option value="konfirmasi_tidak_hadir">Tidak, saya tidak bisa hadir.</option>
                </select>
              </div>

              <div id="group_jumlah_tamu" style="display:none;" class="input-group">
                <span class="input-group-text">
                  Jumlah Tamu
                </span>
                <input type="number" id="jumlah_tamu" name="jumlah_tamu" value="1" class="form-control" placeholder="Jumlah Tamu" required>
              </div>
              <div id="group_pesan" style="display:none;" class="input-group">
                <span class="input-group-text">
                  Pesan
                </span>
                <textarea type="text" id="pesan" name="pesan" class="form-control" placeholder="Ketikan Pesan" required></textarea>
              </div>

              <button
                id="btn-rsvp"
                type="submit"
                class="btn btn-invites w-100"
                style="z-index: 10"
              >
                Kirim <i class="bi bi-send"></i>
              </button>
            </div>
          </section>
          <?php endif; ?>

          <section id="message_rsvp" style="display:none;" class="custom-container" data-aos="fade-down">
            <h1 class="font-heading text-light">RSVP</h1>
            <div class="form-container">
              <p class="text-body-2 text-light">Kamu sudah mengisi RSVP Sebelumnya</p>
              <button id="btn-guestbook" class='btn-invites'><i class="fa-solid fa-file-pdf"></i> Download Guest-Book</button>
            </div>
          </section>

          <section id="comment" class="custom-container" data-aos="fade-left">
            <h1 class="font-heading text-light">Komentar</h1>
            <div id="comment_content" style="display:none;">
              <div id="list_comment" class="comment-container">
                
              </div>
            </div>
            <div class="comment-container">
              <nav aria-label="Page navigation example" align="center">
                <ul id="comment-pagination" class="pagination justify-content-center" align="center">
                </ul>
              </nav>
            </div>
          </section>
        </section>

        <section
          id="wedding-gift"
          class="gift-section-dark"
          data-aos="fade-up"
          data-aos-duration="1000"
        >
          <div class="wg-container-dark">
            <h1 class="wg-title-dark" data-aos="fade-down" data-aos-delay="200" data-aos-duration="800">Wedding Gift</h1>
            <div class="wg-text-dark">
              Your blessing and coming to our wedding are enough for us.
              However, if you want to give a gift we provide a Digital Envelope
              to make it easier for you. thank you
            </div>
            <hr class="wg-hr-dark w-100" />
            <div class="form-container w-100 p-0">
              <ul
                class="nav nav-tabs flex justify-content-center w-100 border-0"
                id="wg-tab"
                role="tablist"
              >
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link active border-0"
                    id="home-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#bank"
                    type="button"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                  >
                    E-Angpao
                  </button>
                </li>
              </ul>
              <div class="tab-content w-100 mt-3" id="wg-tab">
                <div
                  class="tab-pane fade show active"
                  id="bank"
                  role="tabpanel"
                  aria-labelledby="home-tab"
                >
                  <div class="reservation-status w-100">

                    <div class="text-body-2 mb-3 text-light text-center" style="font-size: 1.2rem;">
                        - Via Transfer -
                    </div>
                    <?php if (($pengantin->json->fitur_bank ?? null) === "1"): ?>
                    <div class="card-atm mt-3" data-aos="flip-up" data-aos-delay="300" data-aos-duration="800">
                        <div class="d-flex justify-content-between">
                          <img loading="lazy"  class="chip" src="<?= $root_path ?>assets/img/Chip.png" />
    
                          <div class="logo-atm">
                              <img loading="lazy"  src="<?= rep_url($pengantin->json->logo_bank) ?>" alt="Bank Logo">
                          </div>
                        </div>

                        <div class="account-number"><?= $pengantin->json->rekening_bank ?></div>

                        <button class="copy-button" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Copy" onclick="copyToClipboard(this, '<?= $pengantin->json->rekening_bank ?>')">Copy Nomor</button>

                        <div class="account-name">BANK <b><i><?= $pengantin->json->nama_bank?></b></i> a.n <strong><?= $pengantin->json->nama_rekening ?></strong></div>
                    </div>
                    <?php endif; ?>

                    <?php if (($pengantin->json->fitur_bank2 ?? null) === "1"): ?>
                    <div class="card-atm mt-3" data-aos="flip-up" data-aos-delay="500" data-aos-duration="800">
                        <div class="d-flex justify-content-between">
                          <img loading="lazy"  class="chip" src="<?= $root_path ?>assets/img/Chip.png" />
    
                          <div class="logo-atm">
                              <img loading="lazy"  src="<?= rep_url($pengantin->json->logo_bank2) ?>" alt="Bank Logo">
                          </div>
                        </div>

                        <div class="account-number"><?= $pengantin->json->rekening_bank2 ?></div>

                        <button class="copy-button" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Copy" onclick="copyToClipboard(this, '<?= $pengantin->json->rekening_bank2 ?>')">Copy Nomor</button>

                        <div class="account-name">BANK <b><i><?= $pengantin->json->nama_bank2?></b></i> a.n <strong><?= $pengantin->json->nama_rekening2 ?></strong></div>
                    </div>
                    <?php endif; ?>

                  </div>

                  <?php if (($pengantin->json->fitur_qris ?? "0") === "1") : ?>
                  <div class="form-bank mt-3">
                    <div class="text-body-2 mb-3 text-light text-center" style="font-size: 1.2rem;">
                        - Via QRIS -
                    </div>
                    <div class="input-group mb-2">
                      <span
                        class="input-group-text custom-input-dark border-end-0"
                      >
                        <i class="bi bi-person"></i>
                      </span>
                      <input
                        type="text"
                        id="bank-name"
                        name="bank-name"
                        class="form-control custom-input-dark border-start-0"
                        placeholder="Name"
                      />
                    </div>
                    <div class="input-group mb-2">
                      <span
                        class="input-group-text custom-input-dark border-end-0"
                      >
                        <i class="bi bi-cash"></i>
                      </span>
                      <input
                        type="number"
                        id="bank-amount"
                        name="bank-amount"
                        class="form-control custom-input-dark border-start-0"
                        placeholder="Jumlah Rp."
                      />
                    </div>
                    <div class="input-group mb-3">
                      <span
                        class="input-group-text custom-input-dark border-end-0"
                      >
                        <i class="bi bi-envelope"></i>
                      </span>
                      <input
                        type="email"
                        id="bank-email"
                        name="bank-email"
                        class="form-control custom-input-dark border-start-0"
                        placeholder="Email"
                      />
                    </div>
                    <button id="bank-btn" type="submit" class="btn w-100 btn-wg-dark">
                      Proses <i class="bi bi-send ms-1"></i>
                    </button>
                  </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        </section>

        <section id="quote" class="quote-section-dark" data-aos="fade-up" data-aos-duration="1000">
          <div class="quote-container-dark">
            <div class="quote-text-dark" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
              "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan
              pasangan-pasangan untukmu dari jenismu sendiri, agar kamu
              cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di
              antaramu rasa kasih dan sayang."
            </div>
            <div class="quote-surah-dark" data-aos="fade-up" data-aos-delay="600" data-aos-duration="700">(QS. Ar-Rum: 21)</div>
          </div>
        </section>

        <section id="thanks" class="thanks-section-dark" data-aos="fade-up" data-aos-duration="1200">
          <img
            src="<?= rep_url($pengantin->json->foto_sampul_depan) ?>"
            class="thanks-bg-image"
            alt=""
          />
          <div class="thanks-overlay"></div>
          <div class="thanks-content-dark" data-aos="zoom-in">
            <p class="thanks-text-dark">
              Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila
              Bapak/Ibu/Saudara/i berkenan hadir dan
              memberikan doa restu. Atas kehadiran dan doa restunya, kami mengucapkan terima kasih.
            </p>
            <h1 class="thanks-names-dark">
              <?= $pengantin->json->nama_panggilan_pengantin_pria ?> <br /><span
                style="
                  font-family: &quot;pinyon&quot;, cursive;
                  font-size: 3rem;
                  color: rgba(255, 255, 255, 0.5);
                "
                >&amp;</span
              ><br />
              <?= $pengantin->json->nama_panggilan_pengantin_wanita ?>
            </h1>
          </div>
        </section>

        <section id="footer-right" class="footer-dark" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
          <?php if ($organizer->status): ?>
            <div class="container" align="center">
                <img loading="lazy" src="<?= rep_url($organizer->data->image) ?>" width="70%" alt="Organizer Image">
            </div>
          <?php endif; ?>

          <div class="footer-text-dark mb-2">Designed by Jadi Mudah</div>
          <div class="footer-social-dark">
            <a href="https://www.instagram.com/jadimudah.co/#">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="http://jadimudah.id">
              <i class="bi bi-globe"></i>
            </a>
            <a href="#">
              <i class="bi bi-whatsapp"></i>
            </a>
          </div>
          <div class="footer-text-dark">
            © jadimudah.id. All rights reserved.
          </div>
        </section>
      </section>
    </section>

    <!-- maintenance here -->




    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="<?= $root_path ?>assets/js/aos.js"></script>
    <script src="<?= $root_path ?>assets/js/splide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <!-- <script src="<?= $root_path ?>assets/js/snow.js"></script> -->
    <!-- <script
      src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
      type="module"
    ></script> -->

    <script src="<?= $root_path ?>assets/js/dotlottie-player.js"></script>
    <script src="<?= $root_path ?>assets/js/loader.js?v=22"></script>
    <script src="<?= $root_path ?>assets/js/jquery.loading.min.js"></script>
    <?= view('components/music-qr') ?>
    <script src="<?= $root_path ?>assets/js/script.js?v=3"></script>

    <script>
      // Our Story scroll reveal
      const revealItems = document.querySelectorAll(".js-reveal");

      function revealOnScroll() {
        revealItems.forEach((item) => {
          const pos = item.getBoundingClientRect().top;
          if (pos < window.innerHeight - 120) item.classList.add("reveal");
        });
      }

      window.addEventListener("scroll", revealOnScroll);
      window.addEventListener("load", () => {
        revealOnScroll();
        Opening.init();
      });
    </script>
  </body>
</html>
