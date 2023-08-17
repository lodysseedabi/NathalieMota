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
  let Modale = class {
    constructor(container) {
      this.container = container;
    }
    open() {
      this.container.style.display = "block";
    }
    close() {
      this.container.style.display = "none";
    }
  };

  //Ouverture de la modale de contact au clique sur l'onglet Contact du menu
  let contactmodale = new Modale(
    document.getElementById("container-contact-modal")
  );

  //Ouverture de la lightbox au clique sur la photo
  let lightboxmodale = new Modale(
    document.getElementById("container-lightbox-modal")
  );

  // Gestionnaire d'événement au clic sur l'onglet "Contact" du menu
  var contactTabs = document.querySelectorAll('a[href="#contactModal"]');
  contactTabs.forEach(function (contactTab) {
    contactTab.addEventListener("click", function (event) {
      event.preventDefault();
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

  // Gestionnaire d'événement au clic sur une photo (lightbox)
  var contactTabs = document.querySelectorAll('a[href="#lightbox"]');
  contactTabs.forEach(function (contactTab) {
    contactTab.addEventListener("click", function (event) {
      event.preventDefault();
      lightboxmodale.open();
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

  // Gestionnaire d'événement pour la croix de fermeture de la lightbox
var closeCross = document.querySelector('.cross-icon-lightbox');
if (closeCross) {
    closeCross.addEventListener('click', function() {
        lightboxmodale.close();
    });
}

  //Charger plus de photos sur la page d'accueil
  jQuery(document).ready(function ($) {
    $(".charger-plus-btn").click(function () {
      var button = $(this);
      var page = button.data("page");
      var maxPages = button.data("max-pages");
      var nonce = button.data("nonce");
      var container = $(".grid-photos");
      var sortOrder = $("#sort-order").val();
      var categories = $("#categorie-filter").val();
      var formats = $("#format-filter").val();

      if (page <= maxPages) {
        $.ajax({
          url: custom_script_vars.ajaxurl,
          type: "post",
          data: {
            action: "load_more_photos",
            nonce: nonce,
            page: page,
            sortOrder: sortOrder,
            categories: categories,
            formats: formats,
          },
          success: function (response) {
            container.append(response);
            button.data("page", page++);
            if (page >= maxPages) {
              button.hide();
            }
          },
        });
      }
    });
  });

  //Filtrer les photos par catégories et formats
  jQuery(document).ready(function ($) {
    $(".filtres select").on("change", function () {
      // Obtenez les valeurs sélectionnées des filtres
      var categories = $("#categorie-filter").val();
      var formats = $("#format-filter").val();
      var sortOrder = $("#sort-order").val();
      var button = $(".charger-plus-btn");

      // Envoyez une requête AJAX
      $.ajax({
        url: custom_script_vars.ajaxurl, // URL de l'action AJAX
        type: "POST",
        data: {
          action: "filter_photos", // Action du côté serveur
          categories: categories,
          formats: formats,
          sortOrder: sortOrder,
        },
        success: function (response) {
          button.show();
          $(".grid-photos").html(response);
        },
      });
    });
  });
});
