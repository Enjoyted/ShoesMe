<h2 class='text-center'>Modifier mon mot de passe</h2>
<br>
<div class="form-register text-center">
	<?= $this->Form->create('User'); ?>
	
	<?= $this->Form->input('password', array('placeholder' => 'Mot de passe', 'label' => false, 'type' => 'password', 'class' => 'form-control'))?>
	
	<?= $this->Form->submit("Valider", array("class"=>"btn btn-primary text-center")); ?>
	<?= $this->Form->end()?>

	<br>

  	<small>Vous n'avez pas un compte ? <?= $this->Html->link('Inscrivez-vous',array('controller' => 'users','action' => 'inscription','full_base' => true));?> pour profiter de ShoesMe.</small>
</div>