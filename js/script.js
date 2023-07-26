console.log('coucou');

// Menu hamburger 
document.addEventListener("DOMContentLoaded", function () {
    const hamburgerIcon = document.querySelector(".hamburger-icon");
    const crossIcon = document.querySelector(".cross-icon");
    const mobileMenu = document.querySelector(".mobile-menu");
  
    // Fonction pour ouvrir le menu hamburger en version mobile
    function openMobileMenu() {
      mobileMenu.classList.add("open");
      hamburgerIcon.style.display = "none";
      crossIcon.style.display = "block";
    }
  
    // Fonction pour fermer le menu hamburger en version mobile
    function closeMobileMenu() {
      mobileMenu.classList.remove("open");
      hamburgerIcon.style.display = "block";
      crossIcon.style.display = "none";
    }
  
    // Ouverture du menu au clic sur le hamburger
    hamburgerIcon.addEventListener("click", openMobileMenu);
  
    // Fermeture du menu au clic sur la croix
    crossIcon.addEventListener("click", closeMobileMenu);
 
});

//Ouverture de la modale de contact au clique sur l'onglet Contact du menu 
document.addEventListener("DOMContentLoaded", function () {
  var modal = document.getElementById("contactModal");

  function openModal() {
    modal.classList.add("open");
  }

  function closeModal() {
    modal.classList.remove("open");
  }

  // Gestionnaire d'événement au clic sur l'onglet "Contact" du menu
  var contactTabs = document.querySelectorAll('a[href="#contactModal"]');
  contactTabs.forEach(function (contactTab) {
    contactTab.addEventListener("click", function (event) {
      event.preventDefault();
      openModal();
    });
  });

  // Gestionnaire d'événement pour fermer la modale en cliquant en dehors de celle-ci
  window.addEventListener("click", function (event) {
    if (event.target === modal) {
      closeModal();
    }
  });
});


