<?
// Ajout Jquery
function enqueue_jquery()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

//Ajout bibliothèque Select 2
function enqueue_select2_assets() {
  wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
  wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_select2_assets');

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
        'nonce' => wp_create_nonce('load_more_photos'),
    ));
}
add_action('wp_enqueue_scripts', 'NathalieMontaTheme_register_assets');

// Fonction de chargement des photos via Ajax
function load_more_photos()
{
    check_ajax_referer('load_more_photos', 'nonce');
    $sortOrder = $_POST['sortOrder'];
    $categorie = $_POST['categories'];
    $format = $_POST['formats'];
    $page = intval($_POST['page']);
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $page,
        'order' => ($sortOrder === 'asc') ? 'ASC' : 'DESC',
        'orderby' => 'date',
        'tax_query' => array(
            'relation' => 'AND',
             array(
               'taxonomy' => 'category',
               'field' => 'slug',
               'terms' => $format,
             ),
              array(
                'taxonomy' => 'category',
               'field' => 'slug',
               'terms' => $categorie,
              ),
          ),
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


 //Filtrer les photos par catégories et formats
// Action pour traiter la demande AJAX
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

function filter_photos() {
    // Paramètres de la demande AJAX
    $categorie = $_POST['categories'];
    $format = $_POST['formats'];
    $sortOrder = $_POST['sortOrder'];
  
    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 12,
      'orderby' => 'date',
      'order' => ($sortOrder === 'asc') ? 'ASC' : 'DESC',
      'tax_query' => array(
        'relation' => 'AND',
         array(
           'taxonomy' => 'category',
           'field' => 'slug',
           'terms' => $format,
         ),
          array(
            'taxonomy' => 'category',
           'field' => 'slug',
           'terms' => $categorie,
          ),
      ),
    );
  
    // Requête WP_Query
    $query = new WP_Query($args);
  
    //HTML pour les nouveaux résultats
    ob_start();
  
    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        get_template_part('parts/photo-block');
      }
    } else {
      echo 'Aucun résultat trouvé.';
    }
  
    $response = ob_get_clean();
  
    echo $response;
    wp_die();
  }
  

  