
<?
 /* echo ('<pre>');
 echo ('<br>');
 echo ('<br>');
 echo ('<br>');
 var_dump('test'); 
 echo ('</pre>'); */

 function NathalieMontaTheme_register_assets() {
     // Déclarer le JS
     wp_enqueue_script( 
         'NathalieMotaTheme', 
         get_template_directory_uri() . '/js/script.js', 
         array(), 
         '1.0', 
         true
     );
     
     // Déclarer le fichier CSS à un autre emplacement
     wp_enqueue_style( 
         'NathalieMotaTheme', 
         get_template_directory_uri() . '/style/main.css',
         array(), 
         '1.0'
     );
 }
 add_action( 'wp_enqueue_scripts', 'NathalieMontaTheme_register_assets' );

  