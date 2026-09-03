// NEED TO RUN THIS SCRIPT AFTER LOADING JQUERY //
AOS.init({
  offset: -300, // All animations will trigger 300px before entering the viewport
});

const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);

const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

const audio = document.getElementById("background-music");
const clickArea = document.querySelector(".music-outer");
const openingVideo = document.querySelector(".opening-video");
const contentWedding = document.getElementById("content-wedding");

clickArea.addEventListener("click", () => {
  if (audio.paused) {
    // audio.play(); // Play the music if paused
  } else {
    audio.pause(); // Pause the music if playing
  }
});

$(window).on("scroll", function () {
  if ($(window).width() <= 1024) {
    var footerRight = $("#footer-right");
    var qrInvitation = $(".qr-invitation");
    var footerBottom = footerRight.offset().top + footerRight.outerHeight();
    var windowBottom = $(window).scrollTop() + $(window).height();

    if (
      windowBottom >= footerRight.offset().top &&
      windowBottom <= footerBottom
    ) {
      var opacity =
        1 -
        (windowBottom - footerRight.offset().top) / footerRight.outerHeight();
      qrInvitation.css("opacity", opacity);
    } else if (windowBottom > footerBottom) {
      qrInvitation.css("opacity", 0);
    } else {
      qrInvitation.css("opacity", 1);
    }
  }
});

document.addEventListener("DOMContentLoaded", function () {
  ourStoryScroll();
  // $("html, body").animate({ scrollTop: 0 }, 800); // Durasi 800ms
  // contentWedding.style.display = "none"; // Hide

  Fancybox.bind("[data-fancybox]", {});
});
// END NEED TO RUN THIS SCRIPT AFTER LOADING JQUERY //

// FUNCTIONS //
function openInvites() {
  // audio.play(); // Play the music if paused
  contentWedding.style.display = "block"; // Show
  $("#welcome").fadeOut();
  $("#header").css("opacity", 1);

  // $("body").removeClass("no-scroll");
  // $("html, body").animate(
  //   {
  //     scrollTop: $("#header").offset().top + 100,
  //   },
  //   800
  // );
}
function toggleEnvelope() {
  $(".envelope-greeting").toggleClass("expand");
  $(".envelope-info").toggleClass("expand");
}

function showQrInvitation() {
  const box = document.querySelector(".qr-invitation");
  box.classList.toggle("expanded");
}

function ourStoryScroll() {
  const timelineLine = document.querySelector(".timeline-line");
  const storyCards = document.querySelectorAll(".story-card.js-reveal");

  if (!timelineLine || storyCards.length === 0) {
    return;
  }

  let isTicking = false;

  function calculateFillPercentage() {
    const firstCard = storyCards[0];
    const lastCard = storyCards[storyCards.length - 1];

    // ----------------------------------------------------
    // 🎯 Penyesuaian Viewport (Viewport Offset)
    // ----------------------------------------------------

    // 1. START SCROLL POINT (Kapan garis mulai mengisi)
    // Kita ingin garis mulai mengisi saat kartu pertama (firstCard) baru saja masuk ke layar.
    // Kita gunakan offset 0.9 (90% dari bawah layar).
    const startCardTop = firstCard.getBoundingClientRect().top + window.scrollY;
    // Animasi dimulai ketika kartu pertama mencapai 90% dari bawah layar.
    const startScrollPoint = startCardTop - window.innerHeight * 0.9;

    // 2. END SCROLL POINT (Kapan garis terisi 100%)
    // Kita ingin garis terisi penuh saat dot terakhir sudah melewati bagian atas layar.
    // Kita gunakan offset 0.1 (10% dari atas layar).
    const lastDot = lastCard.querySelector(".dot");
    const lastDotTop = lastDot
      ? lastDot.getBoundingClientRect().top + window.scrollY
      : lastCard.getBoundingClientRect().top + window.scrollY;
    // Animasi berakhir ketika dot terakhir melewati 10% dari atas layar.
    const endScrollPoint = lastDotTop - window.innerHeight * 0.1;

    // ----------------------------------------------------

    const scrollRange = endScrollPoint - startScrollPoint;
    let currentScrollDistance = window.scrollY - startScrollPoint;

    let fillPercentage = (currentScrollDistance / scrollRange) * 100;
    fillPercentage = Math.min(100, Math.max(0, fillPercentage));

    return fillPercentage;
  }

  // Fungsi untuk memperbarui tinggi garis menggunakan requestAnimationFrame
  function updateTimelineFill() {
    if (!isTicking) {
      window.requestAnimationFrame(() => {
        const fillPercentage = calculateFillPercentage();
        timelineLine.style.height = `${fillPercentage}%`;
        isTicking = false;
      });
      isTicking = true;
    }
  }

  // Pasang event listener
  window.addEventListener("scroll", updateTimelineFill);
  window.addEventListener("resize", updateTimelineFill);
  updateTimelineFill();
}

// END FUNCTIONS //
