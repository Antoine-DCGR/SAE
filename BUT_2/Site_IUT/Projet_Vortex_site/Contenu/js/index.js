let menubtn = document.querySelector("#menu-btn");
let navbar = document.querySelector(".menu");
menubtn.addEventListener("click", () => {});

window.onscroll = () => {
  menubtn.classList.remove("fa-times");
};

let swiper = new Swiper(".home-slider", {
  loop: true,

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

function ShowSidebar() {
  let sidebar = document.querySelector(".sidebar");
  sidebar.style.display = "flex";
}
function HideSidebar() {
  let sidebar = document.querySelector(".sidebar");
  sidebar.style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
  const portfolioContainer = document.querySelector(".portfolio-container");
  const button = document.querySelector(".voir");
  let aside = document.querySelector(".sidebar-aside");
  let taille = document.querySelectorAll(".portfolio-box"); // Utilise querySelectorAll pour obtenir tous les éléments
  let portfolio = document.querySelector(".portfolio");
  let portfolioBas = document.querySelectorAll(".portfolio-layer");

  button.addEventListener("click", () => {
    // Vérifie le texte actuel du bouton
    if (button.textContent === "Fermer") {
      portfolioContainer.classList.remove("visible");
      setTimeout(() => {
        portfolioContainer.style.display = "none";
        portfolio.style.height = `370px`;
        button.textContent = "Recent";
        // Vérifie le mode téléphone et applique les styles en conséquence
        if (window.innerWidth <= 1200) {
          aside.style.marginTop = "-230px";
          button.style.marginBottom = "190px";

          // aside.style.marginBottom = "200px";

          // Itère sur chaque élément de la liste et applique le style
          taille.forEach((element) => {
            element.style.marginBottom = "240px";
          });
        }
      }, 100); // Assurez-vous que cela correspond à la durée de l'animation
    } else {
      portfolioContainer.style.display = "flex";
      setTimeout(() => {
        portfolio.style.height = "";
        portfolioContainer.classList.add("visible");
        button.textContent = "Fermer";

        // Vérifie le mode téléphone et applique les styles en conséquence
        if (window.innerWidth <= 1200) {
          portfolioContainer.style.display = "block";
          aside.style.marginTop = "200px";
          portfolioContainer.style.display = "block";

          // Itère sur chaque élément de la liste et réinitialise le style
          taille.forEach((element) => {
            element.style.marginTop = ""; // Réinitialise le style à la valeur par défaut
          });
        }
      }, 10); // Temps court pour permettre la mise à jour de display
    }
  });

  // Fonction pour mettre à jour les liens en fonction du rôle de l'utilisateur
});
