document.addEventListener("DOMContentLoaded", function () {
  let progressText = document.getElementById("progress-text");

  let progress = 0;
  let interval = setInterval(() => {
    progress += 10; // Increase progress
    progressText.innerText = `Preparing the big day... ${progress}%`;

    if (progress >= 100) {
      clearInterval(interval); // Stop when 100%
      setTimeout(() => {
        loader.classList.add("fade-out"); // Smooth fade-out
        setTimeout(() => {
          loader.style.display = "none"; // Hide loader
        }, 500);
      }, 500);
    }
  }, 300); // Update every 300ms
});
