<?php
/*
Plugin Name: Unternehmen Anmeldung
Plugin URI: https://github.com/VolkanSah
Description: Ein Plugin zur Anmeldung von Unternehmen auf der Frontpage.
Version: 1.0
Author: Dein Name
Author URI: https://github.com/VolkanSah
License: GPL3
*/

// Custom Post Type erstellen
function create_unternehmen_post_type() {
    register_post_type('unternehmen',
        array(
            'labels' => array(
                'name' => __('Unternehmen'),
                'singular_name' => __('Unternehmen')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
        )
    );
}
add_action('init', 'create_unternehmen_post_type');

// Frontend-Formular
function unternehmen_anmeldung_form() {
   ?>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <input type="hidden" name="action" value="unternehmen_anmeldung_process">
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <!-- Füge hier die restlichen Formularfelder hinzu -->

        <input type="submit" value="Anmelden">
    </form>
    <?php
}
// Formularverarbeitung
function unternehmen_anmeldung_process() {
    // Überprüfe die Sicherheit und verarbeite die Formulardaten
    // Erstelle einen neuen "unternehmen" Custom Post Type mit den eingegebenen Daten

    wp_redirect($_SERVER['HTTP_REFERER']); // Nutzer zurück zum Formular leiten
    exit;
}
add_action('admin_post_unternehmen_anmeldung_process', 'unternehmen_anmeldung_process');
add_action('admin_post_nopriv_unternehmen_anmeldung_process', 'unternehmen_anmeldung_process');

// Shortcode erstellen
function unternehmen_anmeldung_shortcode() {
    ob_start();
    unternehmen_anmeldung_form();
    return ob_get_clean();
}
add_shortcode('unternehmen_anmeldung', 'unternehmen_anmeldung_shortcode');
