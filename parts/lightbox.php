<div id="container-lightbox-modal" class="container-lightboxmodal">
    <div id="lightboxModal" class="modal">
        <div class="cross-icon-lightbox">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/cross.png'; ?> " alt="icon cross">
        </div>
        <div class="carrousel-img-lightbox">

            <a href="#lightboxprec" id="lightbox-prev-link">
                <div class="contener-arrow-left">
                    <img class="arrow-left"
                        src="<?php echo get_template_directory_uri() . '/assets/images/left arrow.png'; ?> "
                        alt="flèche gauche">
                    <p>Précédente</p>
                </div>
            </a>

            <div class="contener-photo-lightbox">
                <div class="div-img-lightbox">
                    <!-- Afficher la photo -->
                    <img id="img-lightbox" src="" alt="Image en grand">
                </div>
                <div class="contener-infos-lightbox">
                    <!-- Afficher la référence -->
                    <p><span id="reference-photo"></span></p>
                    <!-- Afficher la catégorie -->
                    <p><span id="lightbox-categories"></span></p>
                </div>
            </div>

            <a href="#lightboxsuiv" id="lightbox-next-link">
                <div class="contener-arrow-right">
                    <p>Suivante</p>
                    <img class="arrow-right"
                        src="<?php echo get_template_directory_uri() . '/assets/images/right arrow.png'; ?> "
                        alt="flèche droite">
                </div>
            </a>
        </div>


    </div>
</div>