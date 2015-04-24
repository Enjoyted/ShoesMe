<ol class="breadcrumb">
  <li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
  <li class='active'>Mon profil</li>
</ol>

<div class="page-header well well-sm text-center">
  <h1>Bienvenue sur votre profil <?php echo $_SESSION['Auth']['User']['prenom'];?> 
    <small><?= $this->Html->link('Logout',array('controller' => 'users','action' => 'logout','full_base' => true), array('class' => 'logout_user'));?></small>
  </h1>
</div>

<div class="panel panel-default list_user">
  <div class="panel-heading">Mon historique</div>
  <div class="panel-body">
   <?= $this->Html->link('Voir mon historique de commandes',array('controller' => 'users','action' => 'historique'));?>
 </div>
</div>

<div class="panel panel-default list_user">
  <div class="panel-heading">Mon panier</div>
  <div class="panel-body">
   <?= $this->Html->link('Voir mon panier',array('controller' => 'paniers','action' => 'index'));?>
 </div>
</div>

<div class="panel panel-default list_user">
  <div class="panel-heading">Mes informations de connexion</div>
  <div class="panel-body">
   <?= $this->Html->link('Editer mes informations',array('controller' => 'users','action' => 'edit','full_base' => true));?>
 </div>
</div>

<br>

<ol class="breadcrumb">
  <li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
  <li class='active'>Mon profil</li>
</ol>