<h2 class='text-center'>Regenérer mon mot de passe</h2>
<br>
<div class="form-register text-center">
	<?= $this->Form->create('User'); ?>

	<?= $this->Form->input('email', array('placeholder' => 'Adresse mail', 'label' => false,'type' => 'email', 'class' => 'form-control')) ?>
	
	<?= $this->Form->submit("Regenerer mon mot de passe", array("class"=>"btn btn-primary text-center")); ?>
	<?= $this->Form->end()?>

	<br>

  	<small>Vous n'avez pas un compte ? <?= $this->Html->link('Inscrivez-vous',array('controller' => 'users','action' => 'inscription','full_base' => true));?> pour profiter de ShoesMe.</small>
</div>