<ol class="breadcrumb">
    <li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
    <li class="active">Inscription</li>
</ol>

<h2 class='text-center'>Créer votre compte</h2>
<br>
<div class="form-register text-center">
    <?= $this->Form->create('User'); ?>

    <div class="well well-sm title_form">Paramètres de votre compte</div>

    <?= $this->Form->input('email', array('placeholder' => 'Adresse mail', 'label' => false,'type' => 'email', 'class' => 'form-control')) ?>
    <?= $this->Form->input('username', array('placeholder' => 'Username', 'label' => false,'type' => 'text', 'class' => 'form-control')) ?>
    <?= $this->Form->input('password', array('placeholder' => 'Mot de passe', 'label' => false, 'type' => 'password', 'class' => 'form-control'))?>

    <div class="well well-sm title_form">Adresse de livraison</div>

    <?= $this->Form->input('prenom', array('placeholder' => 'Votre prenom', 'label' => false , 'class' => 'form-control')) ?>
    <?= $this->Form->input('nom', array('placeholder' => 'Votre nom', 'label' => false , 'class' => 'form-control')) ?>
    <?= $this->Form->input('adresse', array('placeholder' => 'Adresse', 'label' => false , 'class' => 'form-control')) ?>
    <select class="form-control" id="regions" name="region">
        <option value=""> Choisissez votre région </option>
    </select>

    <select class="form-control" id="departements" name="departement">
        <option value=""> Votre département </option>
    </select>

    <select class="form-control" id="villes" name="ville">
        <option value=""> Votre ville </option>
    </select>

    <select  class="form-control" id="cpostal" name="CP">
        <option value=""> Votre code postal </option>
    </select>

    <div class="well well-sm title_form">Informations complèmentaires</div>

    <label>Vous êtes :</label>
    <input type="radio" id='sexe' name="sexe" value="Homme">Homme
    <input type="radio" id='sexe' name="sexe" value="Femme">Femme

    <?= $this->Form->input('birthday', array('placeholder' => 'Votre date de naissance', 'label' => false, 'type' => 'text', 'class' => 'form-control date', 'readonly' => 'readonly')) ?>

    <?= $this->Form->submit("Confirmer", array("class"=>"btn btn-primary text-center")); ?>

    <?= $this->Form->end()?>

    <br>
    <small>Vous avez déjà un compte et vous voulez vous connecter ? <?= $this->Html->link('Cliquez-ici',array('controller' => 'users','action' => 'login','full_base' => true));?> pour profiter de ShoesMe.</small>
</div>

<br>

<ol class="breadcrumb">
    <li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
    <li class="active">Inscription</li>
</ol>