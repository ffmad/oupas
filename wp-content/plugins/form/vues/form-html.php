<form action='' method="POST" enctype='multipart/form-data' >
	<div id="error"><?php
	// On affiche les messages
	echo $form_messages;
	?></div>
	<p>
		<label for="quote_auteur">Pseudonyme</label>
		<input type="text" id="quote_auteur" value="<?php echo ( isset( $_POST['quote_auteur'] ) ) ? esc_attr( $_POST['quote_auteur'] ) : '' ; ?>" name="quote_auteur" placeholder="Qui êtes vous ?">
	</p>
	<p>
		<label for="quote_sexe" >Sexe</label>
		<select id="quote_sexe" name="quote_sexe">
			<option value="male">Homme</option>
			<option value="female">Femme</option>
		</select>
	</p>
	<p style="padding-bottom: 10px;">
		<label for="quote_sexe" >Avatar</label>
		<input type="file" name="image" id="quote_avatar">
	</p>
	<p>
		<label for="quote_themes" >Thèmes</label>
		<select id="quote_themes" name="quote_themes" placeholder="Le thème de votre quote">
			<?php foreach( get_terms( 'themes', array( 'hide_empty' => false ) ) as $term ): ?>	
				<option value="<?php echo $term->term_id; ?>" <?php selected( $term->term_id ) ?> > <?php echo $term->name; ?> </option>
			<?php endforeach; ?>
		</select>
	</p>

	<p>
		<label for="quote_tete">L'histoire :</label><br/>
		<textarea  name="quote_tete" id="quote_tete" placeholder="Ecrivez ce qu'il aurait du se passer"><?php echo ( isset( $_POST['quote_tete'] ) ) ? esc_attr( $_POST['quote_tete'] ) : '' ; ?></textarea>
	</p>

	<p>
		<label for="quote_irl">La réalité : </label><br/>
		<textarea  name="quote_irl" id="quote_irl" placeholder="Donnez la vraie conclusion de votre histoire."><?php echo ( isset( $_POST['quote_irl'] ) ) ? esc_attr( $_POST['quote_irl'] ) : '' ; ?></textarea>
	</p>
	
	<p>
	<p class="submit">
		<input type="submit" value="Envoyer votre histoire ! " name="quote_submit" id="quote_submit" />
	</p>
	<?php wp_nonce_field( 'quote_submit' ); ?>
</form>