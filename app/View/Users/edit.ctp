<H1> edit </h1>
<br /> <br />
<span id="zonesuccess" style="display:none; color:green"></span> 
<span id="zoneerrors" style="display:none; color:red"></span>
<br /> <br /> 

<?php echo $this->Form->input('username', array('label' => 'Username <a data-toggle="modal" href="#modalUsername"> Changer </a>', 'type' => 'text', 'class' => 'form-control text-input', 'default' => $_SESSION['Auth']['User']['username'])); ?> 
<?php echo $this->Form->input('email', array('label' => 'Email <a data-toggle="modal" href="#modalEmail" > Changer </a>', 'type' => 'email', 'class' => 'form-control text-input', 'default' => $_SESSION['Auth']['User']['email'] )); ?>
<hr />
<h4> Changer vos coordonnees </h4>
<?php echo $this->Form->create('User', array(
    'action' => 'edit',
    'class' => 'form-horizontal styled'
    )); ?>
    <?php echo $this->Form->input('nom', array('label' => 'Nom', 'type' => 'text', 'class' => 'form-control text-input', 'default' => $_SESSION['Auth']['User']['nom'])); ?>
    <?php echo $this->Form->input('prenom', array('label' => 'Prenom', 'type' => 'text', 'class' => 'form-control text-input', 'default' => $_SESSION['Auth']['User']['prenom'])); ?>
    <?php echo $this->Form->input('adresse', array('label' => 'Adresse', 'type' => 'text', 'class' => 'form-control text-input', 'default' => $_SESSION['Auth']['User']['adresse'])); ?>        
    <br />
    <div>
        <?php $options = array('label' => 'Changer', 'class' => 'button', 'div' => false); ?>
        <?php echo $this->Form->end($options); ?>
    </div>


    
    <!-- Modal Username -->
<div class="modal fade" id="modalUsername" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Changer votre username</h4>
      </div>
      <div class="modal-body">
		<form class="styled" action="<?php echo Router::url('/'); ?>users/editUsername" method="POST">
		        <label>Username:</label>
		        <input id="UserUsername" type="text" class="text-input required default" 
		        name="data[User][username]" title="Enter Your Full UserName" /> 
	 	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	<button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      	</div>
    </div>
  </div>
</div>

   <!-- Modal Email -->
<div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Changer votre E-Mail</h4>
      </div>
      <div class="modal-body">
        <form class="styled" action="<?php echo Router::url('/'); ?>users/editEmail" method="POST">
		        <label>E-Mail:</label>
		        <input id="UserEmail" type="text" class="text-input required default" 
		        name="data[User][email]" title="Enter Your Full E-Mail" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    		</form>
      </div>
    </div>
  </div>
</div>
<!-- 
<ol class="breadcrumb">
  <li><a href="#" onclick="window.history.back();return false;">Page précedente</a></li>
</ol>

<h2 class='text-center'>Modifier mes informations</h2>
<br>
<form class="form-register text-center" id="form-register" action="../users/register" method="POST">

    <div class="well well-sm title_form">Paramètres de votre compte</div>

    <input id="input-email" type="email" class="form-control" name="email" value="" placeholder="Email" required/>

    <input id="input-username" class="form-control"  type="text" class="" name="username" placeholder="Username" required/>

    <input id="input-password" class="form-control"  type="password" name="password"  placeholder="Mot de passe" required/>
    <div class="well well-sm title_form">Adresse de livraison</div>

    <input id="input-prenom" class="form-control"  type="text" name="prenom"  placeholder="Prenom" required/>

    <input id="input-nom" class="form-control"  type="text" class="" name="nom" placeholder="Nom" required/>
    
    <input id="input-adresse" type="text" class="form-control" name="adresse" size="100" maxlength="255" placeholder="Adresse" /> 

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
    <label> Sexe :</label>
    <input type="checkbox" name="sexe" value="Homme">Homme
    <input type="checkbox" name="sexe" value="Femme">Femme

    <input id="birthday" class="form-control date" readonly="" style='background-color: #fff' type="text" name="birthday" placeholder="Date de naissance" required/>
    <br>
    <button class="btn btn-primary" type="submit" name="submit">Valider</button>
</form> 
<br>

<ol class="breadcrumb">
  <li><a href="#" onclick="window.history.back();return false;">Page précedente</a></li>
</ol> -->