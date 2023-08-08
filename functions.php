<?
/* echo ('<pre>');
echo ('<br>');
echo ('<br>');
echo ('<br>');
var_dump('test'); 
echo ('</pre>'); */


// Ajout Jquery
function enqueue_jquery()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

// Enregistre les styles et scripts principaux du thème
function NathalieMontaTheme_register_assets()
{
    wp_enqueue_style(
        'NathalieMotaTheme',
        get_template_directory_uri() . '/style/main.css',
        array(),
        '1.0'
    );
    // Enqueue le script du thème
    wp_enqueue_script(
        'NathalieMotaTheme',
        get_template_directory_uri() . '/js/script.js',
        array('jquery'),
        '1.0',
        true
    );
    // Fournit des données au script avec wp_localize_script
    wp_localize_script('NathalieMotaTheme', 'custom_script_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('load_more_photos')
    ));
}
add_action('wp_enqueue_scripts', 'NathalieMontaTheme_register_assets');

// Fonction de chargement des photos via Ajax
function load_more_photos()
{
    check_ajax_referer('load_more_photos', 'nonce');

    $page = intval($_POST['page']);
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $page,
        'order' => 'ASC',
        'orderby' => 'date',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('parts/photo-block');
        }
    }

    wp_die();
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
