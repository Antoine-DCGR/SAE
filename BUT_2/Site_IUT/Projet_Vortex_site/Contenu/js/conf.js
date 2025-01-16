function ShowSidebar() {
  let sidebar = document.querySelector(".sidebar");
  sidebar.style.display = "flex";
}
function HideSidebar() {
  let sidebar = document.querySelector(".sidebar");
  sidebar.style.display = "none";
}

function confirmAndDelete(userId) {
  if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
    // Utiliser Fetch API pour effectuer une requête POST
    fetch("?controller=authentification&action=delete", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "id=" + userId,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        // Redirection vers l'action conf après la suppression
        window.location.href = "?controller=authentification&action=conf";
      })
      .catch((error) => {
        console.error("Erreur lors de la suppression :", error);
      });
  }

  // Ne pas retourner false ici pour permettre au comportement par défaut de se produire
}
