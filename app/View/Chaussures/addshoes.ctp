<h1>Add chaussures</h1>

<br>

<h4> Ajout chaussure </h4>

<?php echo $this->Form->create('Chaussure', array('action' => 'addshoes','type' => 'file')); ?>

<?php echo $this->Form->hidden('Stock.chaussure_id'); ?>

<?php echo $this->Form->hidden('Chaussure.date_mise_en_ligne'); ?>

<?php echo $this->Form->input('Chaussure.ref'); ?>

<?php echo $this->Form->input('Chaussure.nom'); ?>

<div class="input">
	<label for="ChaussureCategorie">Catégorie</label>
	<select name="data[Chaussure][categorie]" id="ChaussureCategorie">
		<option value="">choisissez</option>
		<option value="Femme">Femme</option>
		<option value="Homme">Homme</option>
		<option value="Enfant">Enfant</option>
	</select>
</div>

<?php
echo $this->Form->input('Chaussure.souscategorie_id', array(
	'type'    => 'select',
	'options' => $select_souscat,
	'empty'   => false
	));
	?>

	<?php 
	echo $this->Form->input('Chaussure.marque_id', array(
		'type'    => 'select',
		'options' => $select_marque,
		'empty'   => false
		));
		?>

		<?php echo $this->Form->input('Chaussure.content'); ?>

		<?php echo $this->Form->input('Chaussure.couleur'); ?>

		<?php echo $this->Form->input('Chaussure.matiere'); ?>

		<?php echo $this->Form->input('Chaussure.poids'); ?>

		<?php echo $this->Form->input('Chaussure.prix'); ?>

		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />

		<?php echo $this->Form->input('Path', array('type' => 'file')); ?>


		<?php echo $this->Form->End('add chaussure'); ?>
