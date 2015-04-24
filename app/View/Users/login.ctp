<ol class="breadcrumb">
    <li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
    <li class="active">Login</li>
</ol>

<h2 class='text-center'>Se connecter</h2>
<br>

<div class="form-register text-center">
  <?php  echo  $this->Form->create('User');?>
  <?= $this->Form->input('email', array('class' => 'form-control', 'label' => false, 'placeholder' => 'E-Mail', 'required' => true));?>
  <?= $this->Form->input('password', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Password', 'required' => true, 'type' => 'password'));?>

  	<?php echo $this->Form->submit('Je me connecte', array('div' => false,'class' => 'btn btn-primary')); ?>
	 <?= $this->Form->end();?>
  <br>

  	<small>Vous n'avez pas un compte ? <?= $this->Html->link('Inscrivez-vous',array('controller' => 'users','action' => 'register','full_base' => true));?> pour profiter de ShoesMe.</small>
	<br>
	<small>Vous avez perdu votre mot de passe ? <?= $this->Html->link('Cliquez ici pour le recupérer.',array('controller' => 'users','action' => 'forgot'));?></small>
</div>
<br>

<ol class="breadcrumb">
    <li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
    <li class="active">Login</li>
</ol>