//  spinder loading
window.addEventListener("load", function () {
  document.getElementById("spinner").style.display = "none";
  document.getElementById("content").classList.remove("hidden");
});

// back to top option
window.addEventListener("scroll", function () {
  const backToTop = document.getElementById("backToTop");
  if (window.scrollY > 100) {
    backToTop.classList.remove("hidden");
  } else {
    backToTop.classList.add("hidden");
  }
});

// document
//   .getElementById("backToTop")
//   .addEventListener("click", function (event) {
//     event.preventDefault();

//     // Smooth scroll effect
//     let scrollStep = -window.scrollY / 30;
//     function smoothScroll() {
//       if (window.scrollY > 0) {
//         window.scrollBy(0, scrollStep);
//         requestAnimationFrame(smoothScroll);
//       }
//     }
//     requestAnimationFrame(smoothScroll);
//   });

// testamonial pop model
function openModal(videoUrl) {
  document.getElementById("videoFrame").src = videoUrl;
  document.getElementById("videoModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("videoFrame").src = "";
  document.getElementById("videoModal").classList.add("hidden");
}

function logout() {
  swal({
    title: "Are You Sure ",
    text: "Loging Out",
    icon: "warning",
    buttons: ["No Cancel It", "I am Sure"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      swal({
        title: "Log Out",
        text: "Thank You",
        icon: "success",
      }).then(function () {
        window.location = "data/logout.php";
      });
    } else {
      swal("Cancelled", "User Not Login Out", "error");
    }
  });
}

  