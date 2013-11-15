<?php
/*
 Plugin Name: Moderation
 Version: 0.1
 Plugin URI: 
 Description: Moderation of posts
 Author: ffmad
 Author URI: 

 TODO:
	* Etape 1 : Création du plugin
	* Etape 2 : Init du shortcode
	* Etape 3 : Affichage du formulaire
	* Etape 4 : Traitement PHP du formulaire ( champs requis etc. )
	* Etape 5 : Insertion du contenu
	* Etape 6 : Sécurité
	* Etape 7 : Images
 */

// URL vers l'url du plugin et son chemin absolu
define('MODERATION_URL', plugin_dir_url ( __FILE__ ));
define('MODERATION_DIR', plugin_dir_path( __FILE__ ));

if( !class_exists('Acf') )
    include_once('acf.php' );

add_action( 'plugins_loaded', 'moderation_init' );

function moderation_init() {
	// On ajoute le shortcode
	add_shortcode( 'moderation-form', 'moderation_shortcode' );

	// On se place au moment du template_redirect car aucune information n'est encore affichée
	add_action( 'template_redirect', 'moderation_process' );
}

function moderation_shortcode() {
	// init du global des messages pour les remplir au fur et à mesure
	global $moderation_messages;

	// on commence un buffer
	ob_start();
	
	// on affiche le fichier moderation-html.php
	include_once( MODERATION_DIR.'/vues/moderation-html.php' );

	// On récupère le texte et on le retourne !
	return ob_get_clean();
}

function moderation_process() {
	global $moderation_messages;

	// Si on a pas soumis le formulaire alors on ne commence pas à traiter les informations
	/*if( !isset( $_POST['quote_submit'] ) || !isset( $_POST['_wpnonce'] ) ) {
		return false;
	}

	// On vérifie le nonce pour être sûr que c'est bien ajouté
	if( !wp_verify_nonce( $_POST['_wpnonce'], 'quote_submit' ) ) {
		$form_messages .= 'Erreur de sécurité, veuillez retenter d\'envoyer le formulaire.<br/>';
		return false;
	}

	if( !isset( $_POST['quote_auteur'] ) || empty( $_POST['quote_auteur'] ) ) {
		$form_messages .= 'Vous devez mettre un auteur<br/>';
	}

	// S'il y a des messages à afficher, alors on ne continue pas.
	if( !empty( $moderation_messages ) ) {
		return false;
	}*/
	
	$bien_nb = $_POST['bien_nb'];
	$pas_bien_nb = $_POST['pas_bien_nb'];
	$post_id = $_POST['post_id'];
	
	if (isset($_POST['valid'])) {
 
		$field_key = "field_5280ffd68d555";
		$value = $bien_nb + 1;
		update_field( $field_key, $value, $post_id );
		
		// if post has been + 20 times -> Published
		if ($value >= 5) {
			$my_post = array(
				'ID'           => $post_id,
				'post_status' => 'publish '
			);

			// Update the post into the database
			wp_update_post( $my_post );
		}
	}
	else if (isset($_POST['invalid'])) {

		$field_key = "field_528100428d556";
		$value = $pas_bien_nb + 1;
		update_field( $field_key, $value, $post_id );
		
		if ($value >= 5) {
			$my_post = array(
				'ID'           => $post_id,
				'post_status' => 'trash '
			);

			// Update the post into the database
			wp_update_post( $my_post );
		}

	}
	
	// On affiche un message de succès di possible
	//$form_messages = '<div class="successParent"><span class="success">Votre demande a bien été enregistrée, mais passera d\'abord par une pré-modération. Merci pour votre participation.</span></div>';
	
	//return true;
}

   