<?php
function nathaliemota_register_assets() {
    
    // Déclarer le JS
	wp_enqueue_script( 
        'nathaliemota', 
        get_template_directory_uri() . '/js/script.js',
        array(), 
        '1.0', 
        true
    );
    
    // Déclarer le fichier style.css
    wp_enqueue_style( 
        'nathaliemota',
        get_template_directory_uri() . '/style.css',
        array(), 
        '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'nathaliemota_register_assets' );

