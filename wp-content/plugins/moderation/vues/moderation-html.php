<form action='' method="POST" enctype='multipart/form-data' >
	<div id="error"><?php
	// On affiche les messages
	echo $moderation_messages;
	?></div>
	
	<input type="hidden" name="post_id" value="<?php echo(get_the_ID());?>">
	<input type="hidden" name="bien_nb" value="<?php the_field('bien');?>">
	<input type="hidden" name="pas_bien_nb" value="<?php the_field('pas_bien');?>">
	
	<p>
		<input id="submit" type="submit" name="valid" alt="Valider l'histoire" value="Bien !" class="btn-comment" style="width: 49%;
display: block;
float: left;
text-align: center;
background-color: rgb(159, 207, 159);">
		<input id="submit" type="submit" name="invalid" alt="C'est de la daube !" value="Pas Bien !" class="btn-comment" style="width: 49%;
display: block;
float: right;
text-align: center;
background-color: rgb(223, 196, 196);">
	</p>
</form>