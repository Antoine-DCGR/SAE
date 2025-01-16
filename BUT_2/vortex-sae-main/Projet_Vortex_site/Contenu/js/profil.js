let menubtn = document.querySelector("#menu-btn");
let navbar = document.querySelector(".menu");
menubtn.addEventListener("click", () => {
  navbar.classList.toggle("active");
});

window.onscroll = () => {
  menubtn.classList.remove("fa-times");
  navbar.classList.remove("active");
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
function updateLinksBasedOnRole(userRole) {
  let emploiDuTempsLink = document.querySelector(".att");
  let messageLink = document.querySelector(".att1");
  let matiereLink = document.querySelector(".att2");
  let sous1 = document.querySelector(".sous1");
  let sous2 = document.querySelector(".sous2");
  let sous3 = document.querySelector(".sous3");
  let sous4 = document.querySelector(".sous4");
  let sous5 = document.querySelector(".sous5");
  let sous6 = document.querySelector(".sous6");

  switch (userRole) {
    case "Directeur":
      emploiDuTempsLink.textContent = "Tableau de bord";
      messageLink.textContent = "Message";
      matiereLink.textContent = "Enseignants";
      matiereLink.href = "?Controller=authentification&&action=conf"; // URL pour Directeur
      sous1.textContent = "Sous1";
      sous2.textContent = "Sous2";
      sous3.textContent = "Sous3";
      sous4.textContent = "Sous4";
      sous5.textContent = "Sous5";
      sous6.textContent = "Sous6";
      break;

    case "chefDepartement":
      emploiDuTempsLink.textContent = "Formation";
      messageLink.textContent = "Message";
      matiereLink.textContent = "Départements";
      matiereLink.href = "?Controller=authentification&&action=conf"; // URL différente pour chefDepartement
      sous1.textContent = "Sous1";
      sous2.textContent = "Sous2";
      sous3.textContent = "Sous3";
      sous4.textContent = "Sous4";
      sous5.textContent = "Sous5";
      sous6.textContent = "Sous6";
      break;

    case "Enseignant":
      emploiDuTempsLink.textContent = "Emploi du temps";
      messageLink.textContent = "Message";
      matiereLink.textContent = "Matière";
      matiereLink.href = "?Controller=authentification&&action=matiere"; // URL différente pour Enseignant
      emploiDuTempsLink.href = "?Controller=authentification&&action=emploiDuTemps";
      sous1.textContent = "Sous1";
      sous2.textContent = "Sous2";
      sous3.textContent = "Sous3";
      sous4.textContent = "Sous4";
      sous5.textContent = "Sous5";
      sous6.textContent = "Sous6";
      break;

    case "Secretaire":
      emploiDuTempsLink.textContent = "Emploi du temps";
      messageLink.textContent = "Message";
      matiereLink.style.display = "none";
      disparait.style.display = "none";
      disparait2.style.display = "none";
      sous1.textContent = "Sous1";
      sous2.textContent = "Sous2";
      sous3.textContent = "Sous3";
      sous4.textContent = "Sous4";
      sous5.textContent = "Sous5";
      sous6.textContent = "Sous6";
      break;
  }
}

// document.addEventListener("DOMContentLoaded", function () {
//   let saveButton = document.getElementById("saveButton");
//   if (saveButton) {
//     saveButton.addEventListener("click", function () {
//       let fullNameInput = document.getElementById("fullName");
//       let emailInput = document.getElementById("email");

//       if (fullNameInput && emailInput) {
//         let fullName = fullNameInput.value;
//         let email = emailInput.value;

//         console.log("Nom complet :", fullName);
//         console.log("Email :", email);

//         // Effectuez la logique pour sauvegarder les changements en utilisant AJAX
//         $.ajax({
//           url: "?Controller=authentification&&action=updateProfile",
//           type: "POST",
//           dataType: "json",
//           data: {
//             id: id,
//             fullName: fullName,
//             email: email,
//           },
//           success: function (response) {
//             console.log("Succès :", response);
//             // Vous pouvez gérer la réponse de succès ici, par exemple, afficher un message de réussite
//           },
//           error: function (error) {
//             console.error("Erreur :", error);
//             // Vous pouvez gérer la réponse d'erreur ici, par exemple, afficher un message d'erreur
//           },
//         });
//       }
//     });
//   }
// });

// $(document).ready(function () {
//   $("#saveButton").click(function () {
//     // Récupération des valeurs des champs
//     let fullName = $("#fullName").val();
//     let email = $("#email").val();

//     // Envoi des données via AJAX
//     $.ajax({
//       url: "?Controller=authentification&&action=updateProfile",
//       type: "POST",
//       dataType: "json", // Spécifiez que le type de données attendu est JSON
//       data: {
//         fullName: fullName,
//         email: email,
//       },
//       success: function (response) {
//         console.log("Réponse du serveur :", response);
//         // Affichage du message de confirmation
//         alert("Informations mises à jour avec succès.");
//       },
//       error: function (xhr, status, error) {
//         console.error("Erreur AJAX :", status, error);
//         console.log("Réponse du serveur :", xhr.responseText); // Ajout de cette ligne
//         // Gérer l'erreur ici
//       },
//     });
//   });
// });
