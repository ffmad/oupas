<?php
/*
 Plugin Name: Simple Form Quote 
 Version: 0.1
 Plugin URI: http://preprod.hetic.net/p2016/barluet-wp-03/
 Description: Display a form
 Author: Ou pas Team
 Author URI: http://preprod.hetic.net/p2016/barluet-wp-03/

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
define('FORM_URL', plugin_dir_url ( __FILE__ ));
define('FORM_DIR', plugin_dir_path( __FILE__ ));


add_action( 'plugins_loaded', 'form_init' );

function form_init() {
	// On ajoute le shortcode
	add_shortcode( 'quote-form', 'form_shortcode' );

	// On se place au moment du template_redirect car aucune information n'est encore affichée
	add_action( 'template_redirect', 'form_process_form' );
}

function form_shortcode() {
	// init du global des messages pour les remplir au fur et à mesure
	global $form_messages;

	// on commence un buffer
	ob_start();

	// on affiche le fichier hetic-form.php
	include_once( FORM_DIR.'/vues/form-html.php' );

	// On récupère le texte et on le retourne !
	return ob_get_clean();
}

function form_process_form() {
	global $form_messages;

	// Si on a pas soumis le formulaire alors on ne commence pas à traiter les informations
	if( !isset( $_POST['quote_submit'] ) || !isset( $_POST['_wpnonce'] ) ) {
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

	if( !isset( $_POST['quote_tete'] ) || empty( $_POST['quote_tete'] ) ) {
		$form_messages .= 'Vous devez remplir la situation souhaitée<br/>';
	}

	if( !isset( $_POST['quote_irl'] ) || empty( $_POST['quote_irl'] ) ) {
		$form_messages .= 'Vous devez remplir la situation réelle<br/>';
	}

	// on vérifie que la catégorie a été choisie
	if( !isset( $_POST['quote_sexe'] ) || empty( $_POST['quote_sexe'] ) ) {
		$form_messages .= 'Vous devez donner votre sexe !<br/>';
	} 

	// on vérifie que la catégorie a été choisie
	if( !isset( $_POST['quote_themes'] ) || empty( $_POST['quote_themes'] ) ) {
		$form_messages .= 'Vous devez choisir un thème pour votre quote<br/>';
	} else {
		if( !term_exists( absint( $_POST['quote_themes'] ), 'themes' ) ) {
			$form_messages .= 'Vous devez choisir un thème valide pour votre quote<br/>';
		}
	}
	
	// On tag en disant que l'on ne veut pas upload de fichier
	$upload_file = false;
	// On vérifie que l'image soit présente
    if( isset( $_FILES['image'] ) && $_FILES['image']['error'] == 0 ) {

		// On tente de récupérer les dimensions de l'image puisque l'on attend d'avoir une image.
		if( ( $size = getimagesize( $_FILES['image']['tmp_name'] ) ) === false ) {
					$form_messages .= 'Vous devez fournir une image<br/>';
			} else {
					$upload_file = true;
			}
    }

	// S'il y a des messages à afficher, alors on ne continue pas.
	if( !empty( $form_messages ) ) {
		return false;
	}


	$the_query = new WP_Query( array(
		'post_type' => 'quotes',
		'posts_per_page' => 1,
		'post_status' => 'all',
	) );

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$last_title = get_the_ID();
		}
	}

	$title = $last_title + 1;
					
	//$title = wp_count_posts('quotes')->publish;
	//$title += 3;

	// on insère les données
	$inserted = wp_insert_post( array(
		'post_title' => sanitize_text_field( $title ), // On protège le titre
		'post_type' => 'quotes',
		'post_status' => 'pending'
	) );

	// On vérifie que WordPress a réussit
	if( is_wp_error( $inserted ) ) {
		$form_messages = 'Impossible d\'enregistrer votre demande !';
		return false;
	}

	// On affiche un message de succès di possible
	$form_messages = '<div class="successParent"><span class="success">Votre demande a bien été enregistrée, mais passera d\'abord par une pré-modération. Merci pour votre participation.</span></div>';

	// On insère un champs personnalisé, ici l'ip de la personne, nom et prénom
	update_post_meta( $inserted, 'auteur', sanitize_text_field( $_POST['quote_auteur'] ) ); // On protège le contenu
	update_post_meta( $inserted, 'contexte', sanitize_text_field( $_POST['quote_context'] ) ); // On protège le contenu
	update_post_meta( $inserted, 'dans_ma_tete', sanitize_text_field( $_POST['quote_tete'] ) ); // On protège le contenu
	update_post_meta( $inserted, 'en_vrai', sanitize_text_field( $_POST['quote_irl'] ) ); // On protège le contenu
	update_post_meta( $inserted, 'sexe', sanitize_text_field( $_POST['quote_sexe'] ) ); // On protège le contenu

	// On ajoute le terme au post, on vérifie que l'on ait un id
	wp_set_object_terms( $inserted, absint( $_POST['quote_themes'] ), 'themes' );
	
	// On ajoute les librairies de WP qui correpondent à l'upload de fichier
	include( ABSPATH.'/wp-admin/includes/file.php' );
	include( ABSPATH.'/wp-admin/includes/image.php' );
	include( ABSPATH.'/wp-admin/includes/media.php' );
	
	// On télécharge l'image et on l'associe tout de suite à l'article inséré plus tôt
    $thumb_id = media_handle_upload( "image", $inserted  );
    if ( is_wp_error( $thumb_id ) || (int) $thumb_id <= 0 ) {
        return false;
    }
    set_post_thumbnail( $inserted , $thumb_id);
	
	return true;
}

   