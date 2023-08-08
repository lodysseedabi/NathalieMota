document.addEventListener("DOMContentLoaded", function () {
  // Menu hamburger
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

  //Création d'une classe modale
  let Modale = class{
    constructor(container){
      this.container=container;
    }
    open(){
      this.container.style.display = "block";
    }
    close(){
      this.container.style.display = "none";
    }
  }

   //Ouverture de la modale de contact au clique sur l'onglet Contact du menu
  let contactmodale = new Modale (document.getElementById("container-contact-modal"));

  //Ouverture de la lightbox au clique sur la photo
  //let contactmodale = new Modale (document.getElementById("utiliser le container de la photo"));

  // Gestionnaire d'événement au clic sur l'onglet "Contact" du menu
  var contactTabs = document.querySelectorAll('a[href="#contactModal"]');
  contactTabs.forEach(function (contactTab) {
    contactTab.addEventListener("click", function (event) {
      event.preventDefault();
      //openModal();
      contactmodale.open();
    });
  });

  // Gestionnaire d'événement au clic sur l'onglet "Contact" de la page d'une photo
  var contactTabs = document.querySelectorAll('a[href="#contactphoto"]');
  contactTabs.forEach(function (contactTab) {
    contactTab.addEventListener("click", function (event) {
      event.preventDefault();
      contactmodale.open();
      remplirChamp();
    });
  });

  function remplirChamp() {
    // Récupérer l'élément du formulaire par son id
    var champ = document.getElementById("wpforms-14-field_3");
    // Récupérer la valeur de l'attribut data-reference (contenant la valeur de $reference)
    var referenceElement = document.getElementById("reference-photo");
    // Définir la valeur du champ d'entrée
    champ.value = referenceElement.textContent;
  }

  // Gestionnaire d'événement pour fermer la modale en cliquant en dehors de celle-ci
  window.onclick = function (event) {
    if (event.target == contactmodale.container) {
      contactmodale.close();
    }
  };
});
